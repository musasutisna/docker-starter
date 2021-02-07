# Set mongodb environment
cp ./mongodb/.env.example ./mongodb/.env
cp ./mongodb/mongod.log.example ./mongodb/mongod.log

# Set app environment
cp ./app/.env.example ./app/.env

# You got installed so don't need me after that!
rm install.sh
