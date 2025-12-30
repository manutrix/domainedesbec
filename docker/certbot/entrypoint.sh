#!/bin/sh
set -eu

DOMAIN="${DOMAIN:?DOMAIN is required}"
LE_EMAIL="${LE_EMAIL:?LE_EMAIL is required}"
LE_STAGING="${LE_STAGING:-0}"
LE_CERT_NAME="${LE_CERT_NAME:-$DOMAIN}"

DOMAINS="${LE_DOMAINS:-$DOMAIN}"

STAGING_ARG=""
if [ "$LE_STAGING" = "1" ]; then
  STAGING_ARG="--staging"
fi

DOMAIN_ARGS=""
for d in $DOMAINS; do
  DOMAIN_ARGS="$DOMAIN_ARGS -d $d"
done

CERT_DIR="/etc/letsencrypt/live/${LE_CERT_NAME}"
RENEWAL_CONF="/etc/letsencrypt/renewal/${LE_CERT_NAME}.conf"

# First issue: keep retrying until DNS/ports are ready
# NOTE: live/ can exist even without a valid Certbot lineage (e.g. a self-signed bootstrap).
if [ ! -f "$RENEWAL_CONF" ]; then
  echo "[certbot] No cert found. Trying initial issuance for: $DOMAINS"

  if [ -d "$CERT_DIR" ] && [ ! -f "$RENEWAL_CONF" ]; then
    echo "[certbot] Removing unmanaged live dir: $CERT_DIR"
    rm -rf "$CERT_DIR" || true
  fi

  while true; do
    certbot certonly --webroot -w /var/www/certbot \
      $STAGING_ARG \
      $DOMAIN_ARGS \
      --cert-name "$LE_CERT_NAME" \
      --email "$LE_EMAIL" \
      --agree-tos \
      --no-eff-email \
      --rsa-key-size 4096 \
      --keep-until-expiring \
      && break

    echo "[certbot] Initial issuance failed. Retrying in 60s..."
    sleep 60
  done
fi

# Renew loop
while true; do
  certbot renew --webroot -w /var/www/certbot --quiet || true
  sleep 12h
done
