var app = angular.module('verticalApp', ['ui.select', 'ngSanitize'],
	function ($interpolateProvider) {
		$interpolateProvider.startSymbol('<%');
		$interpolateProvider.endSymbol('%>');
	}
);

$(document).ready(function() {

    // page is now ready, initialize the calendar...

    $('#calendar').fullCalendar({
        // put your options and callbacks here
    })

});

app.controller('scheduleCtrl', ['$scope', function ($scope) {

    $scope.days = [{ 'day_id': 1 }];

    $scope.addDay = function () {
       $scope.days.push({ 'day_id': null });
    }

    $scope.removeDay = function (index) {
        if ($scope.days.length > 1) $scope.days.splice(index, 1);
    }

}]);

app.controller('lessonCtrl', ['$scope', '$http', function ($scope, $http) {

	$scope.is_pole = document.getElementById('is_pole').value;
	$scope.date = document.getElementById('date').value;
	$scope.agenda_id = document.getElementById('agenda_id').value;

	$scope.$watch('date', function (newVal, oldVal) {
		console.log($scope.date);
		$scope.isEnrolled();
		if ($scope.is_pole == 'true') $scope.getPoles();
		else $scope.getEnrolled();

	});

	$scope.isEnrolled = function () {
		$http({
			'method': 'GET',
			'url': '/json/checkIfEnrolled/'+$scope.agenda_id+'/'+$scope.date
		}).then(function (res) {
			$scope.enrolled = res.data.enrolled;
			console.log($scope.enrolled);
		});
	}

	$scope.getPoles = function () {
		$http({
			'method': 'GET',
			'url': '/json/getPoles/'+$scope.agenda_id+'/'+$scope.date
		}).then(function (res) {
			$scope.poles = res.data;
		});
	}

	$scope.getEnrolled = function () {
		$http({
			'method': 'GET',
			'url': '/json/getEnrolled/'+$scope.agenda_id+'/'+$scope.date
		}).then(function (res) {
			$scope.students = res.data;
		});
	}

}]);

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
   			console.log(vm.people);
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