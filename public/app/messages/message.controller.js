GuestBook.controller('messageController', function ($http, constants, vcRecaptchaService, $scope, $uibModalInstance) {

    $scope.message = {};
    $scope.addMessage = function () {
        $http.post(constants.API_URL + "messages", $scope.message)
            .success(function () {
                $scope.getMessages();
                $scope.dropzone.processQueue();
            })
            .error(function (response, status, headers, config) {
                $scope.err = response.errors;
                console.log($scope);
            });
        $uibModalInstance.close();
    };

    $scope.cancel = function () {
        $uibModalInstance.dismiss('cancel');
    };

    $scope.cancelPic = function(){
        $scope.dropzone.removeAllFiles();
    };
});
