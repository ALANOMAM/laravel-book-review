FROM nginx:stable-alpine

WORKDIR /etc/nginx/conf.d

#copy the nginx.conf file from the nginx folder inside the working directory
COPY nginx/nginx.conf .

#rename the nginx.conf file to default.conf 
RUN mv nginx.conf default.conf

#switch working directory
WORKDIR /var/www/html

COPY src .