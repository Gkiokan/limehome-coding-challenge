# LimeHome Coding Challenge

This is my repository for the coding challenge as requested.
The Project is Build on Laravel 5.7 and Vue 2.x.
Pretty straight forward.
Having some Controller handling the Google API out of the backend
and mapping some Data structure for final usage in the frontend.
Apart of having a Booking Controller which is handling the public api
requests as of storing the bookings.

## How to run this project
clone the repo
install composer requirements ```composer install```
install npm requirements ```npm i```
build files ```npm run dev```
Add a valid Google Maps API key in the .env file
Add valid mySQL credentials
You may need generate a new Application Key with ```php artisan key:generate```
You may need generate a new JWT Secret Key with ```php artisan jwt:secret```

## Ready to migrate
Run database migration ```php artisan migrate```


## Things to consider
Wile the 2nd Job was to post fake bookings of a user specified to a property,
there was the 3rd option to return bookings of a specific user which only can
work with a User Management System. For this I've used the Laravel Basic auth Process.
So only a logged in user can book something. I lowered the complexity of the needen password
for registering, so this is a ease. But you have to fill in your bare minimum of Information
of firstname, lastname and mobile number.
