var App = angular.module('App',['ngAnimate', 'ngResource']);

App.controller('AppController',['$scope','Git',function($scope, Git){
    $scope.settings = {
        view: 'grid',
        search: '',
        sort: 'name',
        reverse: false
    }
    $scope.year = new Date().getFullYear();
    $scope.repos = [];
    
    $scope.sortName = function(){
        if ($scope.settings.sort == 'name') {
            $scope.settings.reverse = !$scope.settings.reverse;
        }else{
            $scope.settings.sort = 'name';
            $scope.settings.reverse = false;
        }
    }
    $scope.sortTime= function(){
        if ($scope.settings.sort == 'updated_at') {
            $scope.settings.reverse = !$scope.settings.reverse;
        }else{
            $scope.settings.sort = 'updated_at';
            $scope.settings.reverse = false;
        }
    }
     $scope.sortWatchers = function(){
        if ($scope.settings.sort == 'stargazers_count') {
            $scope.settings.reverse = !$scope.settings.reverse;
        }else{
            $scope.settings.sort = 'stargazers_count';
            $scope.settings.reverse = true;
        }
    }
    
    $scope.openSourceCount = 0;
    $scope.openSourcePercentage = 0;
    
    Git.query().$promise.then(function(data){
        $scope.repos = data;
        
        for(var i = 0; i < $scope.repos.length; i++){
            if ($scope.repos[i].private === false) {
                ++$scope.openSourceCount;             
            }
            $scope.openSourcePercentage = ($scope.openSourceCount / $scope.repos.length) * 100;
        }
    });
}]);

App.factory('Git', ['$resource', function($resource) {
    return $resource('/service.php', {}, {
	'query': {method: 'GET', isArray: true }
    });
}]);
