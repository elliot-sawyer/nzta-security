# nzta-security

## installation (apache)
1. Check out the project
2. Create a new virtualhost pointing to /path/to/nzta-security.zaita.com/public
3. `cd /path/to/nzta-security.zaita.com/`
4. `composer install`
5. Change your database settings to mysql if you don't want to use postgres
6. Create a .env file and use appropriate database credentials
7. Make a new app key with php artisan key:generate. It will magically be written to the .env file
8. Enable your vhost and restart Apache
