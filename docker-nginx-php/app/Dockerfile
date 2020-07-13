FROM php:7.3-fpm

COPY php.ini /usr/local/etc/php/

RUN apt-get update && apt-get install -y \
  cron \
  supervisor \
  libfreetype6-dev \
  libjpeg62-turbo-dev \
  libmcrypt-dev \
  libpng-dev \
  && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
  && docker-php-ext-install -j$(nproc) gd

RUN apt-get update && apt-get install -y \
  vim \
  sudo \
  zlib1g-dev \
  libicu-dev \
  g++ \
  libzip-dev \
  git \
  unzip \
  ffmpeg \
  && rm -rf /var/lib/apt/lists/* \
  && docker-php-ext-install intl &&\
  docker-php-ext-configure intl &&\
  docker-php-ext-install pdo_mysql mysqli zip
RUN apt-get update && apt-get install -y libnginx-mod-http-image-filter

RUN pecl install mcrypt-1.0.2
ENV LANG ja_JP.UTF-8
ENV TZ=Asia/Tokyo
RUN /bin/cp /usr/share/zoneinfo/Asia/Tokyo /etc/localtime
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf
# crontabファイルをコピー
ADD simple-cron /etc/cron.d/simple-cron
RUN chmod 0644 /etc/cron.d/simple-cron
ADD script.sh /script.sh
RUN chmod +x /script.sh


CMD ["/usr/bin/supervisord","-c", "/etc/supervisor/conf.d/supervisord.conf"]
# CMD cron && touch /etc/cron.d/simple-cron && tail -f /dev/null && docker-php-entrypoint php-fpm
#CMD cron && touch /etc/cron.d/simple-cron && tail -f /dev/null
# busybox crond -f -L /dev/stderr
# RUN apt-get update && apt-get install -y \
#   libmcrypt-dev \
#   vim \
#   sudo \
#   libfreetype6-dev \
#   libjpeg62-turbo-dev \
#   libpng-dev \
#   zlib1g-dev \
#   libicu-dev \
#   g++ \
#   libzip-dev \
#   git \
#   unzip \
#   && rm -rf /var/lib/apt/lists/* \
#   && docker-php-ext-configure gd --with-png-dir=/usr --with-jpeg-dir=/usr && \
#   docker-php-ext-configure intl &&\
#   docker-php-ext-install intl &&\
#   docker-php-ext-install pdo_mysql mysqli gd zip
# RUN apt-get update && apt-get install -y libnginx-mod-http-image-filter

#RUN apt-get -y update
#RUN apt-get install -y vim
#RUN apt-get install -y \
#  libfreetype6-dev \
#  libjpeg62-turbo-dev \
#  libpng-dev
#RUN apt-get install -y libicu-dev


#RUN apt-get -y update && apt-get install -y mailutils
# RUN chmod 644 /etc/ssmtp/ssmtp.conf
