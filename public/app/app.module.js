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

GuestBook.directive('dropzone', function () {

    var link = function (scope, element, attrs) {
        var config;

        config = scope[attrs.dropzone];

        // create a Dropzone for the element with the given options
        scope.dropzone = new Dropzone(element[0], config.options);

        // bind the given event handlers
        angular.forEach(config.eventHandlers, function (handler, event) {
            scope.dropzone.on(event, handler);
        });
    };
    return {
        restrict: "A",
        scope: false,
        link: link
    };
});

	