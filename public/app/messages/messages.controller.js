// create the controller and inject Angular's $scope
    GuestBook.controller('messagesController', function messagesController($scope, $http, $location, constants) {
		// set our current page for pagination purposes
		 $scope.currentPage=1;
		 $scope.prev_page_url=null;
		 $scope.next_page_url=null;
		 $scope.lastPage=null;
		 $scope.pages = [];
		
		//retrieve messages listing from API
		$scope.getMessages = function() {
            $http.get(constants.API_URL + "messages", {params: {page: $scope.currentPage}})
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

		$scope.propertyName = 'created_at';
  		$scope.reverse = true;

  $scope.sortBy = function(propertyName) {
    $scope.reverse = ($scope.propertyName === propertyName) ? !$scope.reverse : false;
    $scope.propertyName = propertyName;
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

$scope.addMessage = function() {


    let string1 = $scope.mainCaptcha;
    let string2 = $scope.c;
    if (string1 == string2) {
        $http.post(constants.API_URL + "messages", $scope.message)//add the new message to our listing
            .success(function () {
                $scope.closeModal();
                //retrieve messages listing from API
                $scope.getMessages();
                $scope.message = {};
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

		};
		
		
		
		// display the modal form
		$scope.showModal = function() {
			$('#addMessageModal').modal('show');


		};
		
		// close the modal form
		$scope.closeModal = function() {
			$('#addMessageModal').modal('hide');
		};

		$scope.getPaginationData = function(page_url) {
	    var url = page_url;
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

	$scope.getPaginationData2 = function(page) {
	    var url = constants.API_URL + "messages?page="+page;
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
	}
	});