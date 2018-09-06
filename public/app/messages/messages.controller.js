GuestBook.controller('messagesController', function messagesController($scope, $http, $location, constants, vcRecaptchaService) {

    $scope.currentPage = 1;
    $scope.lastPage = null;
    $scope.total = null;
    $scope.maxSize = 5;
    $scope.propertyName = 'created_at';
    $scope.reverse = 'desc';
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

    //retrieve messages listing from API
    $scope.getMessages = function() {
        $http.get(constants.API_URL + "messages?sort=" + $scope.propertyName + '&order=' + $scope.reverse)
            .success(function (response) {
                $scope.messages = response.data;
                $scope.currentPage = response.current_page;
                $scope.lastPage = response.last_page;
                $scope.total = response.total;
            });
    };

    $scope.sortBy = function(propertyName) {
      if ($scope.reverse === 'desc'){
        $scope.reverse = 'asc';
        if (propertyName === 'created_at'){
            $scope.classCrAt = "glyphicon glyphicon-arrow-up";
            $scope.className = "";
        } else {
            $scope.className = "glyphicon glyphicon-arrow-up";
            $scope.classCrAt = "";
        }
      } else {
            $scope.reverse = 'desc';
            if (propertyName === 'created_at') {
              $scope.classCrAt = "glyphicon glyphicon-arrow-down";
              $scope.className = "";
            } else {
                $scope.className = "glyphicon glyphicon-arrow-down";
                $scope.classCrAt = "";
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
	    var url = constants.API_URL + "messages?sort=" + $scope.propertyName + '&order=' + $scope.reverse + "&page=" + page;
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