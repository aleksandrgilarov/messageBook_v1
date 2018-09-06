var GuestBook = angular.module('GuestBook', ['ngRoute','ngAnimate', 'ngSanitize', 'ui.bootstrap', 'vcRecaptcha']);

 // define our constant for the API
GuestBook.constant('constants', {
		API_URL: 'http://192.168.1.191/api/'
	});
	
// configure our routes
GuestBook.config(function($routeProvider) {
	$routeProvider
		.when('/', {
			templateUrl : 'messages.html',
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

        scope.dropzone.on("complete", function(file) {
            scope.dropzone.removeFile(file);
        });
    };
    return {
        restrict: "A",
        scope: false,
        link: link
    };
});

	