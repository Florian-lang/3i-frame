FROM nginx:stable-alpine

RUN apk add openssl;
RUN openssl req -x509 -sha256 -nodes -newkey rsa:2048 -days 365 \
    -subj "/C=FR/ST=./L=./O=./CN=." \
    -keyout /etc/ssl/private/localhost.key \
    -out /etc/ssl/certs/localhost.crt
