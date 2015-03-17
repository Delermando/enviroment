'use strict';

angular.module('api', [
    'ngRoute',
    'api.home',
    'api.list',
    'api.save',
    'api.update',
    'api.version'
])
.config(['$routeProvider', '$httpProvider', '$sceDelegateProvider', function ($routeProvider, $httpProvider, $sceDelegateProvider) {
    $httpProvider.defaults.headers = {'Content-Type': 'application/x-www-form-urlencoded'};
    $routeProvider.otherwise({redirectTo: '/home'});
}]);


