GuestBook.controller('messagesController', function messagesController($scope, $http, $location, constants, vcRecaptchaService) {

    $scope.currentPage = 1;
    $scope.lastPage = null;
    $scope.total = null;
    $scope.maxSize = 5;
    $scope.propertyName = 'created_at';
    $scope.order = 'desc'; //default sorting value
    $scope.err = '';
    $scope.classCrAt = "glyphicon glyphicon-arrow-down";
    $scope.className = "";
    $scope.dropzoneConfig = {
        'options': { // passed into the Dropzone constructor
            'url': constants.API_URL + 'upload-image',
            'autoProcessQueue': false,
            'maxFiles': 1
        },
        'eventHandlers': {
            'sending': function (file, xhr, formData) {
                formData.append('_token', csrfToken);
            }
        }
    };
    Dropzone.autoDiscover = false;

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

    $scope.cancelPic = function(){
        $scope.dropzone.removeAllFiles();
    };

    $scope.addMessage = function() {
        $http.post(constants.API_URL + "messages", $scope.message)
            .success(function () {
                $scope.closeModal();
                $scope.getMessages();
                $scope.message = {};
                //upload picture
                $scope.dropzone.processQueue();
                vcRecaptchaService.reload(widgetId);
            })
            .error(function (response, status, headers, config) {
                $scope.err = response.errors;
            });
    };

    var widgetId;
    $scope.onWidgetCreate = function(_widgetId){
        widgetId = _widgetId;
    };

    $scope.showModal = function() {
        $scope.err = '';
        $('#addMessageModal').modal('show');
    };

    $scope.closeModal = function() {
        $('#addMessageModal').modal('hide');
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
});