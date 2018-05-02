// define the 'Burgerpedia' module
// also include ngRoute for all our routing needs
var GuestBook = angular.module('GuestBook', ['ngRoute']);

 // define our canstant for the API
GuestBook.constant('constants', {
		API_URL: 'http://localhost:8000//api/'
	});
	
// configure our routes
GuestBook.config(function($routeProvider) {
	$routeProvider
		// route for the hamburgers page
		.when('/', {
			templateUrl : 'app/messages/messages.template.htm',
			controller  : 'messagesController'
		})

		// route for a single hamburger 
		.when('/hamburger/:hamburgerID', {
			templateUrl : 'app/hamburger/hamburger.template.htm',
			controller  : 'hamburgerController'
		})

		// default route
		.otherwise({
               redirectTo: '/'
        });
		
			
});

	