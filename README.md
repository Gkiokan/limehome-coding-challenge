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
Run database migration ```php artisan migrate```
Run database seed for example users ```php artisan db:seed``` (user: demo, password: test)   
Serve the project with ```valet``` on the project root or mount ```htdocs``` of your webserver to ```/public```


## Things to consider
To get the users location I have used the navigator.geolocation Object with it's callbacks  
to determine the users lang and long values. After that passing them to google maps and voila.  

Depending on the users location the GooglePlaceController requests the google place api for
all near properties within 1500m. The parameters can be setup in the GooglePlaceController.  
I have set only the radius parameter to get the most of all properties that google offers us.  
This should be obviously changed or defined as you need.  

While the 2nd Job was to post fake bookings of a user specified to a property,  
there was the 3rd option to return bookings of a specific user which only can  
work with a User Management System. For this I've used the Laravel Basic auth Process.  
So only a logged in user can book something. I lowered the complexity of the needen password  
for registering, so this is a ease to create an account go on. But you have to fill in your  
bare minimum of Information  of firstname, lastname and mobile number.  
This only allows the current user to book something specific for this name only,  
I've expanded this feature to enter guest information on booking. In example I can book  
something for someoneelse or even make a bulk booking, which can be easly adapted with the guest feature.   

Public API is working and not secured though oAuth or api_token.  
/bookings returns a list of all bookings  
/users/{userID}/bookings returns a list of all bookings for the specific user or 404  
Even Though all Bookings Objects will have a guest Object in it to being specific about the Guest data.  
This seems for me more practicable in a real world application if you don't expect the user to be the guest.  


## Notes for development (just my 2 cents, you can skip that)  
Actually I was suprised about the new policy that google runs with the paid api keys only.  
It took me a while to search for alternatives and then came back to google due the broad  
way of supporting so much stuff. So I extended my account and configured it all the way down.  

After that the Google Place Controller took a while to make it clear, structed and recursive usable.  
A good example is the method for mapping all the photos within a place Object, this is awesome.  
Also I thought about additional data mapping, filtering or validating before the response goes
out to the frontend. There are several ways of doing it, I have made some of them in my code as you can see.  

Without the research and configuration for the Google API I've used aprox. 3 hours on the GooglePlaceController.
On top of that I spend time on coding clean and building the frontend up more then required.
All Requests are handled by the GooglePlaceController and there are all the basic settings for the requests  
which goes then out to google.

The Google Map Markers have a click event listener, which is currently not used but I have planed
that on click a little Overlay goes over the map and describes the nessesary Information about the property.  

There are two components to list the places in response, currently they are displayed as cards but  
there is also a list component already prepared. Checkout the get-started view and change the data  
value of show from 'card' to 'list', which will give you a straight forward table.  
In both views are two buttons. Detail and Check-In. Details is not used yet but I got great Ideas for it.  
By Check-In I mean like more Info or get into the place information.  

On the Place-info view you get a nice and simple Bootstrap Slider with all the Photos in it.  

Also the frontend have a User Backend. A little overview area about Profile information and thats it.  

Checkout the BookingForm alert message when data policy is not accepted.  

Login is possible though username or email.  
