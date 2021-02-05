# Set mariadb environment
mv ./mariadb/.env.example ./mariadb/.env

# Set apache virtual host directory
mv ./php-apache/etc-example ./php-apache/etc

# Set php apache environment
mv ./php-apache/.env.example ./php-apache/.env

# Set php custom configuration
mv ./php-apache/custom.ini.example ./php-apache/custom.ini

# You got installed so don't need me after that!
rm install.sh
