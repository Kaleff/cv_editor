# CV Builder/Editor built on Laravel.

This is the project that allows to build, work and edit multiple cvs for multiple users
# Launching laravel application

> [!NOTE]
> I've used Laravel Sail approach for building an application Dockerized.
> To run laravel sail you need to utilise MAC, LINUX or Windows with WSL2 and a docker engine running.
> In case you are using Windows WSL2, make sure to mount this project repository in WSL2 and run from there.
> Further info is available here: https://laravel.com/docs/11.x/sail

1) Make sure that apache is not running to avoid possible conflicts

```
sudo /etc/init.d/apache2 stop
```
2) Copy the .env.example file and rename the copy to 
```
.env
```

3) Generate APP_KEY for .env file

```
php artisan key:generate
```


3) Run the application using SAIL, make sure the docker engine is running

```
./vendor/bin/sail up
```

4) Run the migrations
```
./vendor/bin/sail artisan migrate:fresh
```

5) Register inside the application and proceeed with building and interacting with CVs