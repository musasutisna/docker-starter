# Set postgres environment
mv ./postgres/.env.example ./postgres/.env

# Set nginx configuration
cp ./nginx/conf.d/default.conf.example ./nginx/conf.d/default.conf

# Set php environment
mv ./php/.env.example ./php/.env

# You got installed so don't need me after that!
rm install.sh
