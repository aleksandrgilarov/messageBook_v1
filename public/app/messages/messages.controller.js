GuestBook.controller('messagesController', function messagesController($scope, $http, $location, constants, vcRecaptchaService, $uibModal) {

    $scope.message = {};
    $scope.currentPage = 1;
    $scope.lastPage = null;
    $scope.total = null;
    $scope.maxSize = 5;
    $scope.errorMessage = '';
    $scope.hasErr = false;
    $scope.propertyName = 'created_at';
    $scope.order = 'desc'; //default sorting value
    $scope.err = '';
    $scope.classCrAt = "glyphicon glyphicon-arrow-down";
    $scope.className = "";
    var modalInstance;

    //retrieve messages listing from API
    $scope.getMessages = function() {
        $http.get(constants.API_URL + "messages?sort=" + $scope.propertyName + '&order=' + $scope.order)
            .success(function (response) {
                $scope.messages = response.data;
                $scope.currentPage = response.current_page;
                $scope.lastPage = response.last_page;
                $scope.total = response.total;
            });
    };

    $scope.sortBy = function(propertyName) {
        if (propertyName === 'created_at'){
            $scope.className = '';
            if ($scope.classCrAt === 'glyphicon glyphicon-arrow-down'){
                $scope.classCrAt = 'glyphicon glyphicon-arrow-up';
                $scope.order = 'asc';
            } else {
                $scope.classCrAt = "glyphicon glyphicon-arrow-down";
                $scope.order = 'desc';
            }
        } else if (propertyName === 'name') {
            $scope.classCrAt = '';
            if ($scope.className === 'glyphicon glyphicon-arrow-down'){
                $scope.className = 'glyphicon glyphicon-arrow-up';
                $scope.order = 'desc';
            } else {
                $scope.className = "glyphicon glyphicon-arrow-down";
                $scope.order = 'asc';
            }
        }
      $scope.propertyName = propertyName;
      $scope.getMessages();
    };

    var widgetId;
    $scope.onWidgetCreate = function(_widgetId){
        widgetId = _widgetId;
    };

	$scope.getPaginationData = function(page) {
	    var url = constants.API_URL + "messages?sort=" + $scope.propertyName + '&order=' + $scope.order + "&page=" + page;
	    if (url!=null) {
	    $http.get(url)
			.success(function(response) {
				$scope.messages = response.data;
				$scope.currentPage = response.current_page;
				$scope.lastPage = response.last_page;
                $scope.total = response.total;
			});
	    }
	};

    $scope.open = function () {
        modalInstance =  $uibModal.open({
            animation: true,
            ariaLabelledBy: 'modal-title',
            ariaDescribedBy: 'modal-body',
            templateUrl: 'myModalContent.html',
            controller: 'messageController',
            scope: $scope
        });
    };
});
