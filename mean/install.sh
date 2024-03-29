# Set mongodb environment
cp ./mongodb/.env.example ./mongodb/.env
cp ./mongodb/mongod.log.example ./mongodb/mongod.log

# Set mariadb environment
cp ./mariadb/.env.example ./mariadb/.env

# Set app environment
cp ./app/.env.example ./app/.env

# Set nodejs entrypoint
cp ./app/entrypoint.sh.example ./app/entrypoint.sh

# Set nginx configuration
cp ./nginx/conf.d/default.conf.example ./nginx/conf.d/default.conf

# You got installed so don't need me after that!
# rm install.sh
