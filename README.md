## Configure the project

- npm install -> to get the packages of package.json
- composer install -> to get the packages of composer.json
- php artisan migrate -> to set up the DB 
- php artisan db:seed -> to populate the DB 
- Don't forget to change the .env with your credentials,DB info etc also i used cloudinary so you should change to your cloudinary account if you want to manage the images correctly
- I used santum with Coockies sessions so you will have to set ur domain in the santum config file at Config/sanctum.php 

## Launch the project

- npm run watch -> to look if you change something on Vue Side
- php artisan serve -> to launch the serve 

## Demo

https://lbds.herokuapp.com/
