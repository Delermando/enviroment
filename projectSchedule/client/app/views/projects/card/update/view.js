'use strict';

angular.module('api.update', ['ngRoute'])

.config(['$routeProvider', function ($routeProvider) {
        $routeProvider.when('/edit/:idCard', {
            templateUrl: 'views/projects/card/update/view.html',
            controller: 'UpdateCard'
        });
    }])

.controller('UpdateCard', function ($scope, $http, $routeParams, cacheManager) {
    $http.get('http://enviroment-deler.rhcloud.com/v1/cards/list' + $routeParams.idCard).success(function (apiReturn) {
          if(apiReturn.data !== null){
            var arrayDate = (apiReturn.data[0].dateToSend).split('-');
            $scope.apiData = apiReturn.data[0];
            $scope.apiData['day'] = arrayDate[0];
            $scope.apiData['month'] = arrayDate[1];
            $scope.apiData['year'] = arrayDate[2];
          }      
    });

    $scope.submitFormUpdate = function (isValid) {
        if (isValid) {
            var jsonPostVar = {
                idCard: $routeParams.idCard,
                fromName: $scope.formUpdateCard.fromName.$viewValue,
                fromEmail: $scope.formUpdateCard.fromEmail.$viewValue,
                toName: $scope.formUpdateCard.toName.$viewValue,
                toEmail: $scope.formUpdateCard.toEmail.$viewValue,
                message: $scope.formUpdateCard.message.$viewValue,
                date: $scope.formUpdateCard.selectDay.$viewValue + "-"
                        + $scope.formUpdateCard.selectMonth.$viewValue + "-"
                        + $scope.formUpdateCard.selectYear.$viewValue
            };

            $http.post('http://enviroment-deler.rhcloud.com/v1/cards/update', jsonPostVar).success(function (apiReturn) {
                $scope.apiResponse = apiReturn.response;
                cacheManager.remove('list');
            });
        }
    };
});



