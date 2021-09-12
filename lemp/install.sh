# Set mariadb environment
mv ./mariadb/.env.example ./mariadb/.env

# Set nginx logs
mv ./nginx/logs/access.log.example ./nginx/logs/access.log
mv ./nginx/logs/error.log.example ./nginx/logs/error.log

# Set nginx configuration
cp ./nginx/conf.d/default.conf.example ./nginx/conf.d/default.conf

# Set php environment
mv ./php/.env.example ./php/.env

# You got installed so don't need me after that!
rm install.sh
