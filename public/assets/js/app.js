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
   		});
   	}
   	
});

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