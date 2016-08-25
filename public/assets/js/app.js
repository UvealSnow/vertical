var app = angular.module('verticalApp', ['ui.select', 'ngSanitize', 'ng-currency'],
	function ($interpolateProvider) {
		$interpolateProvider.startSymbol('<%');
		$interpolateProvider.endSymbol('%>');
	}
);

app.controller('uiSearchCtrl', function ($scope, $http, $timeout, $interval) {
   	var vm = this;

   	vm.disabled = undefined;
   	vm.searchEnabled = undefined;

   	$scope.concepts = [{'name': null, 'concept': null, 'desc': null},];
   	$scope.selected = [];

   	function getUsers () {
   		$http({
   			method: 'GET',
   			url: '/user/list'
   		}).then(function (res) {
   			vm.people = res.data;
   		});
   	}

   	$scope.submitClient = function () {
		var data = {'first': this.first, 'last': this.last, 'email': this.email, 'tel': this.tele, 'comp': this.comp };
		$http({
			method: 'POST',
			url: '/clients/new',
			data: data
		}).then(function (res) {
			$scope.created = true;
			$scope.clients = res.data;
			$('#addClient').modal('hide');
			getClients();

		}, function (res) {
			console.log(data);
		});
	}

	$scope.submitConcept = function () {
		var data = {'name': this.name, 'cost': this.cost };
		$http({
			method: 'POST',
			url: '/concepts/new',
			data: data
		}).then(function (res) {
			$scope.created = true;
			$scope.clients = res.data;
			$('#addConcept').modal('hide');
			getConcepts();
		}, function (res) {
			console.log('nope');
		});
	}

	$scope.addConcepts = function () {
		$scope.concepts.push({'name': null, 'concept': null, 'desc': null});
		getConcepts();
	}

	$scope.deleteConcept = function (index) {
		if ($scope.concepts.length != 1) $scope.concepts.splice(index, 1);
	}
   	
});