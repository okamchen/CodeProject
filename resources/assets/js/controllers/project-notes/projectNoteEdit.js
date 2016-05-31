angular.module('app.controllers')
	.controller('ProjectNoteEditController', 
	['$scope', '$location', '$routeParams','ProjectNote', 
	function ($scope, $location, $routeParams, ProjectNote) {
		$scope.projectNote = ProjectNote.get({id: $routeParams.id, noteId: $routeParams.noteId});

		$scope.save = function(){
			if($scope.form.$valid){
				//Client se refere ao service criado em client.js
				ProjectNote.update({
					id: $scope.projectNote.project_id, 
					noteId: $scope.projectNote.id
				}, $scope.projectNote, function(){
					$location.path('/project/'+ $routeParams.id +'/note');
				});
			}
		}	
	}]);