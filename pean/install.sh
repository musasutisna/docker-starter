# Set postgres environment
cp ./postgres/.env.example ./postgres/.env

# Set app environment
cp ./app/.env.example ./app/.env

# Set nodejs entrypoint
cp ./app/entrypoint.sh.example ./app/entrypoint.sh

# Set nginx configuration
cp ./nginx/conf.d/default.conf.example ./nginx/conf.d/default.conf

# You got installed so don't need me after that!
# rm install.sh
