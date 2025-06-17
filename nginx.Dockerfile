FROM nginx:stable-alpine

RUN mkdir -p /var/www/html/public

COPY config/default.conf /etc/nginx/conf.d/default.conf

EXPOSE 80