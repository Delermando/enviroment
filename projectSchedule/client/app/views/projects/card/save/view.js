'use strict';

angular.module('api.save', ['ngRoute'])
.config(['$routeProvider', function ($routeProvider) {
    $routeProvider.when('/save', {
        templateUrl: 'views/projects/card/save/view.html',
        controller: 'SaveCard'
    });
}])

.controller('SaveCard', function ($scope, $http, cacheManager) {
    $scope.submitForm = function (isValid) {
        if (isValid) {
            var jsonPostVar = {
                fromName: $scope.formSaveCard.fromName.$viewValue,
                fromEmail: $scope.formSaveCard.fromEmail.$viewValue,
                toName: $scope.formSaveCard.toName.$viewValue,
                toEmail: $scope.formSaveCard.toEmail.$viewValue,
                message: $scope.formSaveCard.message.$viewValue,
                date: $scope.formSaveCard.selectDay.$viewValue + "-"
                        + $scope.formSaveCard.selectMonth.$viewValue + "-"
                        + $scope.formSaveCard.selectYear.$viewValue
            };
            $http.post('http://enviroment-deler.rhcloud.com/v1/cards/save', jsonPostVar).success(function (apiReturn) {
                $scope.apiResponse = apiReturn.response;
                cacheManager.remove('list');
            });
        }
    };
});


