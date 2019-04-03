# LimeHome Coding Challenge

This is my repository for the coding challenge as requested.  
The Project is Build on Laravel 5.7 and Vue 2.x. Pretty straight forward.  
Having some Controller handling the Google API out of the backend  
and mapping some Data structure for final usage in the frontend.  
Apart of having a Booking Controller which is handling the public api  
requests as of storing the bookings.  

## How to run this project
Clone the repo  
install composer requirements ```composer install```  
install npm requirements ```npm i```  
build files ```npm run dev```  
Add a valid Google Maps API key in the ```.env``` file  
Add valid mySQL credentials  
You may need generate a new Application Key with ```php artisan key:generate```  
You may need generate a new JWT Secret Key with ```php artisan jwt:secret```  


## Ready to migrate
Run database migration ```php artisan migrate```


## Things to consider
To get the users location I have used the navigator.geolocation Object with it's callbacks  
to determine the users lang and long values. After that passing them to google maps and voila.  

Depending on the users location the GooglePlaceController requests the google place api for
all near properties within 1500m. The parameters can be setup in the GooglePlaceController.  

Wile the 2nd Job was to post fake bookings of a user specified to a property,  
there was the 3rd option to return bookings of a specific user which only can  
work with a User Management System. For this I've used the Laravel Basic auth Process.  
So only a logged in user can book something. I lowered the complexity of the needen password  
for registering, so this is a ease. But you have to fill in your bare minimum of Information  
of firstname, lastname and mobile number.  



## Notes
Actually I was suprised about the new policy that google runs with the paid api keys only.  
It took me a while to search for alternatives and then came back to google due the broad  
way of supporting so much stuff.  

After that the Google Place Controller took a while to make it clear, structed and recursive usable.  
A good example is the method for mapping all the photos within a place Object, this is awesome.  
Also I thought about additional data mapping, filtering or validating before the response goes
out to the frontend. There are several ways of doing it, I have made some of them in my code as you can see.  

Without the research and configuration for the Google API I've used aprox. 3 hours on the GooglePlaceController.
On top of that I spend time on doing coding clean and building the frontend up more then required.

The Google Map Markers have a click event listener, which is currently not used but I have planed
that on click a little Overlay goes over the map and describes the nessesary Information about the property.  

There are two components to list the places in response, currently they are displayed as cards but  
there is also a list component already prepared. Checkout the get-started view and change the data  
value of show from 'card' to 'list', which will give you a straight forward table.  
In both views are two buttons. Detail and Check-In. Details is not used yet but I got great Ideas for it.  
By Check-In I mean like more Info or get into the place information.  

Also the frontend have a Profile Backend which needs to be filled for a better usability for the user  
while booking properties. A little overview area about profile information and thats it.  
