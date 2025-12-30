#!/bin/sh
set -eu

DOMAIN="${DOMAIN:-localhost}"
NGINX_SERVER_NAME="${NGINX_SERVER_NAME:-$DOMAIN}"
LE_CERT_NAME="${LE_CERT_NAME:-$DOMAIN}"

LE_FULLCHAIN="/etc/letsencrypt/live/${LE_CERT_NAME}/fullchain.pem"
LE_PRIVKEY="/etc/letsencrypt/live/${LE_CERT_NAME}/privkey.pem"
LE_RENEWAL="/etc/letsencrypt/renewal/${LE_CERT_NAME}.conf"

export NGINX_SERVER_NAME
export LE_CERT_NAME

mkdir -p /var/www/certbot

SELF_DIR="/etc/nginx/selfsigned"
SELF_FULLCHAIN="${SELF_DIR}/fullchain.pem"
SELF_PRIVKEY="${SELF_DIR}/privkey.pem"

select_cert_paths() {
  if [ -f "$LE_FULLCHAIN" ] && [ -f "$LE_PRIVKEY" ] && [ -f "$LE_RENEWAL" ]; then
    export SSL_CERT_PATH="$LE_FULLCHAIN"
    export SSL_KEY_PATH="$LE_PRIVKEY"
    return
  fi

  if [ ! -f "$SELF_FULLCHAIN" ] || [ ! -f "$SELF_PRIVKEY" ]; then
    echo "[nginx] No valid Let's Encrypt cert yet for '$LE_CERT_NAME'. Generating a temporary self-signed cert..."
    mkdir -p "$SELF_DIR"
    openssl req -x509 -nodes -newkey rsa:2048 -days 1 \
      -keyout "$SELF_PRIVKEY" \
      -out "$SELF_FULLCHAIN" \
      -subj "/CN=$DOMAIN" >/dev/null 2>&1 || true
  fi

  export SSL_CERT_PATH="$SELF_FULLCHAIN"
  export SSL_KEY_PATH="$SELF_PRIVKEY"
}

render_nginx_conf() {
  select_cert_paths
  envsubst '${NGINX_SERVER_NAME} ${LE_CERT_NAME} ${SSL_CERT_PATH} ${SSL_KEY_PATH}' \
    < /etc/nginx/templates/default.conf.template \
    > /etc/nginx/conf.d/default.conf
}

render_nginx_conf

# Periodic re-render+reload so new/renewed certs are picked up automatically
(
  while true; do
    sleep 5m
    render_nginx_conf
    nginx -s reload >/dev/null 2>&1 || true
  done
) &

exec "$@"
