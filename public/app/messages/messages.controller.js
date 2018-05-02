// create the controller and inject Angular's $scope
    GuestBook.controller('messagesController', function messagesController($scope, $http, $location, constants) {
		// set our current page for pagination purposes
		 $scope.currentPage=1;
		 $scope.lastPage=1;
		 $scope.loadMoreText='Показать больше сообщений...';
		
		//retrieve messages listing from API
		$http.get(constants.API_URL + "messages", {params: { page: $scope.currentPage }})
			.success(function(response) {
				$scope.messages = response.data;
				$scope.currentPage = response.current_page;
				$scope.lastPage = response.last_page;
				
				if($scope.currentPage >= $scope.lastPage){
					$scope.loadMoreText='Все сообщения отображены!';
				}
			});
		
		// infinite scroll of the messages
		$scope.loadMoreMessages = function() {
			// increase our current page index
			$scope.currentPage++;
			
			
			//retrieve messages listing from API and append them to our current list
			$http.get(constants.API_URL + "messages", {params: { page: $scope.currentPage }})
				.success(function(response) {
					$scope.messages = $scope.messages.concat(response.data);
					$scope.currentPage = response.current_page;
					$scope.lastPage = response.last_page;
					
					if($scope.currentPage >= $scope.lastPage){
						$scope.loadMoreText='Все сообщения отображены!';
					}
				});
				
		};

		$scope.propertyName = 'name';
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
}

$scope.ValidCaptcha = function () {
    var string1 = $scope.mainCaptcha;
    var string2 = $scope.c;
    if (string1 == string2) {
        alert(true);
    }
    else {
        alert(false);
    }
}

$scope.addMessage = function() {
				
			//add the new message to our listing
			$http.post(constants.API_URL + "messages", $scope.message)
				.success(function(response) {
					var string1 = $scope.mainCaptcha;
    				var string2 = $scope.c;
					console.log(response);
				    if (string1 == string2) {
        			$scope.closeModal();
					//reload the page
					location.reload();
    }
    else {
        alert(false);
    }
					
					// close the modal
					//$scope.closeModal();
					//reload the page
					//location.reload();
					
					

				})
				.error(function(response, status, headers, config) {
					// alert and log the response
					alert('Failed to add the message: [Server response: '+status + '] - ' +response.name[0]);
					console.log(response);
					
				});

		}
		
		
		
		// display the modal form
		$scope.showModal = function() {
			$('#addMessageModal').modal('show');
		}
		
		// close the modal form
		$scope.closeModal = function() {
			$('#addMessageModal').modal('hide');
		}
	});