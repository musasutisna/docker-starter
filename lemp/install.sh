# Set mariadb environment
mv ./mariadb/.env.example ./mariadb/.env

# Set nginx configuration
cp ./nginx/conf.d/default.conf.example ./nginx/conf.d/default.conf

# Set php environment
mv ./php/.env.example ./php/.env

# You got installed so don't need me after that!
rm install.sh
