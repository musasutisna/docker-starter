# Set mariadb environment
mv ./mariadb/.env.example ./mariadb/.env

# Set nginx environment
mv ./nginx/.env.example ./nginx/.env

# Set nginx logs
mv ./nginx/logs/access.log.example ./nginx/logs/access.log
mv ./nginx/logs/error.log.example ./nginx/logs/error.log

# Set php environment
mv ./php/.env.example ./php/.env

# You got installed so don't need me after that!
rm install.sh
