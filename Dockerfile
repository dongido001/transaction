FROM creativitykills/nginx-php-server:1.1.1
MAINTAINER Neo Ighodaro <neo@hotels.ng>
ADD supervisord.conf /etc/supervisord.conf
COPY init.sh /init.sh
RUN chmod 755 /init.sh
CMD ["/init.sh"]