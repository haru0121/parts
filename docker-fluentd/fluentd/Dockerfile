FROM fluent/fluentd:latest

ADD conf/fluentd.conf /fluentd/etc/

RUN /usr/bin/fluent-gem install fluent-plugin-s3 --no-document

RUN mkdir -p /var/log/fluent/s3 && \
    mkdir -p /var/log/td-agent && \
    chmod 777 /var/log/*