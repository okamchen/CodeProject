angular.module('app.controllers')
	.controller('LoginController', ['$scope', '$location', 'OAuth', function ($scope, $location, OAuth) {
		$scope.user = {
			username : '',
			password : ''
		};

		$scope.error = {
			message : '',
			error : false
		};

		$scope.login = function(){
			if($scope.form.$valid){
				OAuth.getAccessToken($scope.user).then(function(){
					$location.path('home');
				}, function(object){
					$scope.error.error = true;
					$scope.error.message = object.data.error_description;
				});
			}
		};
	}]);