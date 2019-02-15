FROM fluent/fluentd:latest

RUN mkdir /var/log/fluent/ \
    && chmod -R 777 /var/log/fluent

RUN apk add ruby ruby-nokogiri

RUN gem install fluent-plugin-azure-storage-append-blob

