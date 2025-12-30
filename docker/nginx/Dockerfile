FROM nginx:1.27-alpine

RUN apk add --no-cache openssl gettext

COPY default.conf.template /etc/nginx/templates/default.conf.template
COPY ssl.conf /etc/nginx/snippets/ssl.conf
COPY entrypoint.sh /entrypoint.sh

RUN chmod +x /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]
CMD ["nginx", "-g", "daemon off;"]
