var app = angular.module('verticalApp', ['ui.select', 'ngSanitize'],
	function ($interpolateProvider) {
		$interpolateProvider.startSymbol('<%');
		$interpolateProvider.endSymbol('%>');
	}
);

app.controller('uiSearchCtrl', function ($scope, $http, $timeout, $interval) {
   	var vm = this;

   	vm.disabled = undefined;
   	vm.searchEnabled = undefined;

   	getUsers();

   	function getUsers () {
   		$http({
   			method: 'GET',
   			url: '/user/list'
   		}).then(function (res) {
   			vm.people = res.data;
   			// console.log(vm.people);
   		});
   	}
   	
});

app.controller('daysController', function ($scope) {
	$scope.days = [{ 'date': null },];

	$scope.addDays = function () {
		$scope.days.push({ 'date': null });
	}

	$scope.removeDays = function (index) {
		if ($scope.days.length > 1) $scope.days.splice(index, 1);
	}
}),

app.filter('propsFilter', function() {
  	return function(items, props) {
	    var out = [];

	    if (angular.isArray(items)) {
	      	var keys = Object.keys(props);
	        
	      	items.forEach(function(item) {
	        	var itemMatches = false;

		        for (var i = 0; i < keys.length; i++) {
		          	var prop = keys[i];
		          	var text = props[prop].toLowerCase();
		          	if (item[prop].toString().toLowerCase().indexOf(text) !== -1) {
		            	itemMatches = true;
		            	break;
		          	}
		        }

		        if (itemMatches) {
		          	out.push(item);
		        }
	      	});
	    } else {
	      out = items;
	    }

	    return out;
  	};
});