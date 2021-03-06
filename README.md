# Recipe Application
Simple MVC type application that serves as repository of recipes, build using [Laravel](https://laravel.com/) and [Vue JS](https://vuejs.org/) and containerized using [Docker](https://www.docker.com/) developed by the students of AI32.  

[![Build Status](https://github.com/kharl112/recipe-application.git)]
## Prerequisites
To run without encountering any problems make sure you have installed or configured the following technologies:

- A root user
- Docker for containerization see [here](https://docs.docker.com/get-docker/)

## Installation
Open up your terminal and run these commands.

Clone repository:
```
git clone https://github.com/kharl112/recipe-application.git
```

Navigate to the directory:
```
cd recipe-application
```
Install dependencies in frontend:
```
cd frontend
npm install
npm update 
```

Install dependencies in backend:
```
cd ../backend
composer install
```

Running and building the application:
```
cd ../
docker-compose up
```

View running containers:
```
docker ps
```

### Configuring backend

Entering backend container:
```
docker-compose exec backend bash
```

Copy env variables to .env file:
```
cp .env.example .env
```

Generate JWT key:
```
php artisan jwt:secret
```

Run migration scripts:
```
php artisan migrate:install
php artisan migrate:fresh
php artisan db:seed --class=CategoriesSeeder
```





