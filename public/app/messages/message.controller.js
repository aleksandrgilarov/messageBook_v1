GuestBook.controller('messageController', function ($http, constants, vcRecaptchaService, $scope, $uibModalInstance) {

    $scope.message = {};
    $scope.dropzoneConfig = {
        'options': { // passed into the Dropzone constructor
            'url': constants.API_URL + 'upload-image',
            'autoProcessQueue': false,
            'maxFiles': 1,
            'acceptedFiles' : "image/jpeg,image/jpg,image/bmp,image/png",
            init : function() {
                $scope.errorMessage = '';
                this.on("error", function(file, response) {
                    $scope.errorMessage = response;
                    $scope.$apply();
                });
            }
        },
        'eventHandlers': {
            'sending': function (file, xhr, formData) {
                formData.append('_token', csrfToken);
            }
        },
    };

    Dropzone.autoDiscover = false;

    $scope.addMessage = function () {
        $http.post(constants.API_URL + "messages", $scope.message)
            .success(function () {
                $scope.dropzone.processQueue();
                $uibModalInstance.close();
                $scope.getMessages();
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
