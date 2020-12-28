

### 1. clone the Package & install the packages

```
git clone https://github.com/le-meet-projet/backend.git
```
```
composer install
```

### 1. setup env file
   
   Run this commands from the Terminal:

	 cp .env.example .env
	 php artisan key:generate


### 2. Next make sure to create a new database and add your database credentials to your .env file:

```
DB_HOST=localhost
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```


### 3. setup the database & add admin & some dummy data

Run this commands from the Terminal:

	 php artisan migrate
	 php artisan make:admin
	 php artisan make:data

 
### 4. you can login to dashboard  
	
you can login from  /dashboard
 
	user : admin@admin.com
	pass : 1234

### 5. Api Side
```
$ php artisan passport:keys
```
