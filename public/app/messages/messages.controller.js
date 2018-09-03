// create the controller and inject Angular's $scope
    GuestBook.controller('messagesController', function messagesController($scope, $http, $location, constants) {
		// set our current page for pagination purposes
		 $scope.currentPage=1;
		 $scope.prev_page_url=null;
		 $scope.next_page_url=null;
		 $scope.lastPage=null;
		 $scope.pages = [];
		 $scope.propertyName = 'created_at';
		 $scope.reverse = 'desc';
		
		//retrieve messages listing from API
		$scope.getMessages = function() {
            $http.get(constants.API_URL + "messages?sort=" + $scope.propertyName + '&order=' + $scope.reverse)
                .success(function (response) {
                    $scope.messages = response.data;
                    $scope.currentPage = response.current_page;
                    $scope.lastPage = response.last_page;
                    $scope.prev_page_url = response.prev_page_url;
                    $scope.next_page_url = response.next_page_url;
                    //console.log($scope);
                    for (var i = 0; i < $scope.lastPage; i++) {
                        $scope.pages[i] = i + 1;
                    }
                });
        };

  $scope.sortBy = function(propertyName) {
      if ($scope.reverse === 'desc'){
    $scope.reverse = 'asc';}
    else{$scope.reverse = 'desc'}
    $scope.propertyName = propertyName;
    $scope.getMessages();
  };

  $scope.Captcha = function() {
    var alpha = new Array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');
    var i;
    var code = "";
    for (i = 0; i < 6; i++) {
        code = code + alpha[Math.floor(Math.random() * alpha.length)];
    }
//    var code = a + ' ' + b + ' ' + ' ' + c + ' ' + d + ' ' + e + ' ' + f + ' ' + g;
    $scope.mainCaptcha = code;
};

$scope.ValidCaptcha = function () {
    let string1 = $scope.mainCaptcha;
    let string2 = $scope.c;
    if (string1 == string2) {
        alert(true);
    }
    else {
        alert(false);
    }
};
        $scope.dropzoneConfig = {
            'options': { // passed into the Dropzone constructor
                'url': constants.API_URL + 'upload-image',
                'autoProcessQueue': false
            },
            'eventHandlers': {
                'sending': function (file, xhr, formData) {
                    console.log('Sending');
                    formData.append('_token', csrfToken);
                },
                'success': function (file, response) {
                    console.log('Success');
                    console.log(response);
                }
            }
        };

$scope.addMessage = function() {

    let string1 = $scope.mainCaptcha;
    let string2 = $scope.c;
    if (string1 === string2) {
        $http.post(constants.API_URL + "messages", $scope.message)//add the new message to our listing
            .success(function () {
                $scope.closeModal();
                //retrieve messages listing from API
                $scope.getMessages();
                $scope.message = {};
                console.log('added msg');
            })

            .error(function (response, status, headers, config) {
                // alert and log the response
                alert('Failed to add the message: [Server response: ' + status + '] - ' + response.name[0]);
                console.log(response);

            });
        $scope.Captcha();
    }
    else {
        $scope.Captcha();
        alert("Invalid Captcha");
    }
    $scope.c = "";
    $scope.dropzone.processQueue();

		};
		
		// display the modal form
		$scope.showModal = function() {
			$('#addMessageModal').modal('show');
		};
		
		// close the modal form
		$scope.closeModal = function() {
			$('#addMessageModal').modal('hide');
		};

		//pagination
	$scope.getPaginationData = function(page) {
	    var url = constants.API_URL + "messages?sort=" + $scope.propertyName + '&order=' + $scope.reverse + "&page=" + page;
	    if (url!=null) {
	    $http.get(url)
			.success(function(response) {
				$scope.messages = response.data;
				$scope.currentPage = response.current_page;
				$scope.lastPage = response.last_page;
				$scope.prev_page_url= response.prev_page_url;
				$scope.next_page_url= response.next_page_url;
				//console.log($scope);
				for (var i =0; i < $scope.lastPage; i++) {
					$scope.pages[i] = i+1;
				}
			});}
	};

	$scope.getPrevPage = function (page) {
	    page--;
	    if (page != 0) 
        $scope.getPaginationData(page);
    };

	$scope.getNextPage = function (page) {
	    page++;
	    if (page <= $scope.lastPage)
	    $scope.getPaginationData(page);
	};
	});