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

function animateMenu(x) {
    x.classList.toggle("change");

    openNav();
}

/* Set the width of the side navigation to 250px */
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}

/* Set the width of the side navigation to 0 */
function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}

// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementById("closeModal");

// When the user clicks on the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
function closeModal() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

$('a').click(function(){
	closeNav();
    $('html, body').animate({
        scrollTop: $( $(this).attr('href') ).offset().top
    }, 500);
    return false;

});