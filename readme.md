## Installation

### Requirements

```
- PHP >= 5.6.4
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- Mongodb 3.x
```
### Install mongodb extension with pecl
```
sudo pecl install mongodb
```
### checkout the source code to [example path: /home/pandian/budget-team]
```
git clone https://github.com/ace05/budget-team.git
cd budget-team
```
### Run the composer install command
```
composer install
```

### create configuration
```
sudo ln -s .development.env .env
```
### Update Mongodb credentials on .env file
```
DB_CONNECTION=mongodb
DB_HOST=localhost
DB_PORT=27017
DB_DATABASE=budget
DB_USERNAME=
DB_PASSWORD=
```

### Folder permissions required
```
sudo chmod 777 -R storage/
sudo chmod 777 -R bootstrap/cache/
```
### Do the db migration
```
php artisan migrate
php artisan db:seed
```

## Run the application using virtual host witn nginx
- Add virtual host to your hosts /etc/hosts
    ```
    127.0.0.1	team-budget.dev
    ```
- Add configuration to nginx site enable /etc/nginx/sites-enabled/team-budget.dev with following configuration like this
    ```
    server {
	listen 80;

	root /usr/share/nginx/html/team-budget/public; ## Project path upto pulblic folder

	index index.php index.html index.htm;

	server_name team-budget.dev;


	location / {
        try_files $uri $uri/ /index.php$is_args$args;
    }
	
	location ~ \.php$ {
		fastcgi_pass unix:/run/php/php7.0-fpm.sock;
	    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
   	    include fastcgi_params;
	    include snippets/fastcgi-php.conf;
	}}
	```

 ## Then restart the nginx server
    sudo service nginx restart
    
  ## Note:
  - I have used php 7.0 and MongoDB 3.4
  - Driver is mongodb-1.2
  - Web server php-fpm 7.0 and nginx/1.10.0
  - The above configuration is based on above verions and it may vary based on the down versions.

     



