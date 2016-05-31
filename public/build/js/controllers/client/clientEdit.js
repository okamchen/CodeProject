angular.module('app.controllers')
	.controller('ClientEditController', 
	['$scope', '$location', '$routeParams','Client', 
	function ($scope, $location, $routeParams, Client) {
		$scope.client = Client.get({id: $routeParams.id});

		$scope.save = function(){
			if($scope.form.$valid){
				//Client se refere ao service criado em client.js
				Client.update({id : $scope.client.id}, $scope.client, function(){
					$location.path('/clients');
				});
			}
		}	
	}]);