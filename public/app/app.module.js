var GuestBook = angular.module('GuestBook', ['ngRoute']);

 // define our constant for the API
GuestBook.constant('constants', {
		API_URL: 'http://192.168.1.191/api/'
	});
	
// configure our routes
GuestBook.config(function($routeProvider) {
	$routeProvider
		.when('/', {
			templateUrl : 'app/messages/messages.template.htm',
			controller  : 'messagesController'
		})
		.otherwise({
               redirectTo: '/'
        });
});

	