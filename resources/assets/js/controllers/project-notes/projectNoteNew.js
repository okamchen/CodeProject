angular.module('app.controllers')
	.controller('ProjectNoteNewController', 
	['$scope', '$location', '$routeParams', 'ProjectNote', 
	function ($scope, $location, $routeParams, ProjectNote) {
		$scope.projectNote = new ProjectNote();

		$scope.save = function(){
			if($scope.form.$valid){
				$scope.projectNote.project_id = $routeParams.id;

				ProjectNote.save({id : $routeParams.id}, $scope.projectNote, function(){
					$location.path('/project/'+ $routeParams.id +'/note');
				});
			}
		}	
	}]);