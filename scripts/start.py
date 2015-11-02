import os
import shutil
import subprocess

# Change working directory
os.chdir("/var/www/html/")

# Set the good htaccess
if os.environ.get('SYMFONY_STATE'):
    if os.environ.get('SYMFONY_STATE') == 'dev':
        shutil.copyfile("/docker/htaccess_dev", "/var/www/html/web/.htaccess")
    else:
        shutil.copyfile("/docker/htaccess_prod", "/var/www/html/web/.htaccess")

# Check symfony app configuration
if os.environ.get('SYMFONY_STATE') == 'dev':
    os.system("composer update")
    os.system("composer install")
    os.system("php app/console cache:clear --env=dev")
    os.system("php app/console assetic:dump --env=dev")
else:
    os.system("composer update --no-dev --optimize-autoloader")
    os.system("php app/console cache:clear --env=prod --no-debug")
    os.system("php app/console assetic:dump --env=prod --no-debug")

# Check symfony app configuration
os.system("php app/check.php")

os.system("chown 1000:www-data /var/www/html -R")

# Execute Apache daemon
os.system("apache2 -D FOREGROUND")
