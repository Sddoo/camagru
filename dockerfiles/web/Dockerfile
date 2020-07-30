FROM nginx:latest
 
RUN apt-get update -y \
    && apt-get install nano openssl -y \
    && rm -rf /var/lib/apt/lists/*

# ssl certificate installation
RUN openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout /etc/ssl/private/nginx-selfsigned.key -out /etc/ssl/certs/nginx-selfsigned.crt -subj "/C=AT/ST=Vienna/L=Vienna/O=Security/OU=Development/CN=localhost" \
    && openssl dhparam -out /etc/ssl/certs/dhparam.pem 2048
