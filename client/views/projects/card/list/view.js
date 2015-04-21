'use strict';

angular.module('api.list', ['ngRoute'])

    .config(function ($routeProvider) {
        $routeProvider.when('/list/:pageNumb', {
            templateUrl: 'views/projects/card/list/view.html',
            controller: 'ListCards'
        });
    })
    
    .factory('cacheManager', function($cacheFactory) {
        return $cacheFactory('cache');
     })
     
    .controller('ListCards', function ($http, $scope, $routeParams, cacheManager) {        
        $scope.apiData = {};
        $scope.predicate = '';
        
        var pagination =  function(arrayJsonObjects, numbOfItensPerPage, actualPage){
            var arrayToDisplay = [];
            if(arrayJsonObjects !== null){
                var numgOfObjects = arrayJsonObjects.length
                var numbOfPages = Math.ceil(numgOfObjects/ numbOfItensPerPage);
                var end = actualPage * numbOfItensPerPage;
                var start = end - numbOfItensPerPage;
                var obejctToEachPage = {};
                
                for(var i = start; end > i; i++ ){
                    if(arrayJsonObjects[i] !== undefined){
                        arrayToDisplay.push(arrayJsonObjects[i]);
                    }
                }
                
                $scope.obejctToEachPage = {};
                
                for(var i = 1; numbOfPages >= i; i++ ){
                    $scope.obejctToEachPage[i] =  i;
                }
             }
            return arrayToDisplay; 
        }
        
        var cache = cacheManager.get('list');
        if (!cache) {
            $http.get('http://phpengine-deler.rhcloud.com/v1/cards/list').success(function (apiReturn) {
                $scope.apiData = pagination(apiReturn.data, 8, $routeParams.pageNumb);
                cacheManager.put('list', apiReturn.data);
            });
        } else {
            $scope.apiData = pagination(cache, 8, $routeParams.pageNumb);
        }
    })
    
    .controller('CallUpdatePage', function ($scope, $http, $location) { //transforma um service
        $scope.getIdForUpdate = function () {
            $location.path("/edit/" + this.card.IDScheduleSend)
        };
    })
    
    .controller('DeleteCards', function ($scope, $http, cacheManager) { //transforma um service
        $scope.deleteCards = function () {
            creatArrayWithChekedElements();
            deleteItenOnAPI({idCard: $scope.idsSelected});
        };

        var creatArrayWithChekedElements = function () {
            $scope.indexOfElements = [];
            $scope.idsSelected = [];
            angular.forEach($scope.apiData, function (card, index) { 
                if (card.idToDelete) {
                    $scope.idsSelected.push(card.IDScheduleSend);
                    $scope.indexOfElements.push(index);
                }
            });
        }

        var deleteItendFromScope = function (arrayIndexItensDeleted) {
            angular.forEach(arrayIndexItensDeleted, function () {
                $scope.apiData.splice(arrayIndexItensDeleted, 1);
            })
        }

        var deleteItenOnAPI = function (jsonPostVar) {
            $http.post('http://phpengine-deler.rhcloud.com/v1/cards/delete', jsonPostVar).success(function (apiReturn) {
                if (apiReturn.response == 'success') {
                    deleteItendFromScope($scope.indexOfElements);
                    $scope.apiResponse = apiReturn.response;
                    $scope.numbOfDeletedItems = apiReturn.data.numbOfDeletedItems;
                    cacheManager.remove('list');
                }
            });
        }

    });