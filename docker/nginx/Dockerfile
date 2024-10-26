FROM nginx:alpine

RUN apk --update add \
    bash

RUN adduser -u 1000 -D -S -G www-data www-data


# supervisor
# RUN apk add --no-cache supervisor \
#         && mkdir -p /var/log/supervisor

# COPY supervisor/* /etc/supervisor/

# ENV SUPERVISOR_LOG_DIR /var/log/supervisor