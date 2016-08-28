var foodfireApp = angular.module('foodfireadmin', [], function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });

foodfireApp.controller('foodfireadminController', ['$scope', function($scope) {

}]);

var collapseDefault = 0;

$(document).ready(function(){

	
	if(!($('#top-header').is(':hidden')))
	{
		// Mobile
		console.log('Mobile');
		collapseDefault = 1;
	}else{

		if(typeof(sessionStorage.collapseDefault) != 'undefined'){
			console.log('storage defined');
			collapseDefault = sessionStorage.collapseDefault;
		}
	}
	mobCheckSidebar(collapseDefault);

	
});

function sidebarCollapse(){
	if(collapseDefault == 0){
		collapseDefault = 1;
		if(typeof(Storage) !== "undefined"){
			sessionStorage.collapseDefault = 1;
		}
	}else{
		collapseDefault = 0;
		if(typeof(Storage) !== "undefined"){
			sessionStorage.collapseDefault = 0;
		}
	}
	mobCheckSidebar(collapseDefault);
}

function mobCheckSidebar(collapsevisible){
	if(!($('#top-header').is(':hidden')))
	{
		sidebar(1,collapsevisible);
	}else{
		sidebar(0,collapsevisible);
	}

}

function sidebar(mob,hide){
	$(".sidebar").hide("slide",{direction:'left'});
	$(".collapse-sidebar").hide("slide",{direction:'left'});
	if(mob==0 && hide == 0){
		$(".main-sidebar").show("slide");
		$(".ffa-container").animate({"margin-left":"230px"});
		$(".ff-brand").animate({"width":"230px"});
		$(".ff-brand-bars").animate({"margin-left":"245px"});
		$(".ff-brand").html("<center><span><b>Food</b><span style='color:#fff; font-family: \'Varela Round\', sans-serif;'><b>Fire</b></span></center>")
	}else if(mob==0 && hide == 1){
		$(".ffa-container").animate({"margin-left":"50px"});
		$(".collapse-sidebar").show("slide");
		$(".ff-brand").animate({"width":"50px"});
		$(".ff-brand-bars").animate({"margin-left":"65px"});
		$(".ff-brand").html("<center><span><b>F</b><span style='color:#fff; font-family: \'Varela Round\', sans-serif;'><b>F</b></span></center>")
	}else if(mob==1 && hide == 0){
		$(".main-sidebar").show("slide");
		$(".ffa-container").animate({"margin-left":"230px"});
	}else if(mob==1 && hide == 1){
		$(".ffa-container").animate({"margin-left":"0px"});
	}
}


