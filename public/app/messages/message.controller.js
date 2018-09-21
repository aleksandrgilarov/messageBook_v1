GuestBook.controller('messageController', function ($http, constants, vcRecaptchaService, $scope, $uibModalInstance) {

    $scope.message = {};
    $scope.err = '';
    $scope.addMessage = function () {
        $http.post(constants.API_URL + "messages", $scope.message)
            .success(function () {
                $scope.getMessages();
                $scope.dropzone.processQueue();
                $uibModalInstance.close();
            })
            .error(function (response, status, headers, config) {
                $scope.err = response.errors;
            });
    };

    $scope.cancel = function () {
        $uibModalInstance.dismiss('cancel');
    };

    $scope.cancelPic = function(){
        $scope.dropzone.removeAllFiles();
    };
});
