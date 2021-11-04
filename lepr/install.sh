# Set nginx configuration
cp ./nginx/conf.d/default.conf.example ./nginx/conf.d/default.conf

# Set php environment
cp ./php/.env.example ./php/.env

# Set message broker config
cp ./www/MessageBroker/Config.example.php ./www/MessageBroker/Config.php

# You got installed so don't need me after that!
# rm install.sh
