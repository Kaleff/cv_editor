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

3) Run the composer installation in the project directory

```
composer install
```

4) Generate APP_KEY for .env file

```
php artisan key:generate
```


5) Run the application using SAIL, make sure the docker engine is running

```
./vendor/bin/sail up
```

6) Run the migrations
```
./vendor/bin/sail artisan migrate:fresh
```

7) Register inside the application and proceeed with building and interacting with CVs

Things I would implement but they were out of the scope of the task, or were not required.
1) The Unit Tests, I would've implemented if the task required to do so, since it's good practice to test the code.
2) Laravel REST-api back-end, and react front-end, however here, with the task at hand, I implemented simple Laravel application with Blade templates, since it was the least costly option in terms of work to be done.
3) Swagger API documentation for the API endpoints, nice to have, however not necessary here at all, considering this is not an REST api application.
4) User privelegy checker to see if they're authorized to request out of supposed reach of their own files, since I wasn't sure if authorization/authentication functionality was a part of the required task. 