FROM rabbitmq:management

# Install plugins
ADD https://github.com/rabbitmq/rabbitmq-delayed-message-exchange/releases/download/3.9.0/rabbitmq_delayed_message_exchange-3.9.0.ez /opt/rabbitmq/plugins/
RUN chown rabbitmq:rabbitmq /opt/rabbitmq/plugins/rabbitmq_delayed_message_exchange-3.9.0.ez
RUN chmod 755 /opt/rabbitmq/plugins/rabbitmq_delayed_message_exchange-3.9.0.ez
