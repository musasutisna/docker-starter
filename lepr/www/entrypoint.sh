php MessageBroker/Init.php >> MessageBroker/logs/init-$(date +"%F").log &
php-fpm &

# Wait for any process to exit
wait -n

# Exit with status of process that exited first
exit $?
