

var editApp = angular.module('editApp', ['ui.sortable']).config(function($interpolateProvider){
    $interpolateProvider.startSymbol('{[{').endSymbol('}]}');
}); //creamos la nueva app con diferente nomenclatura para las expresiones


//----Creacion de una directiva para que los botones sirvan de href
editApp.directive( 'goClick', function ( $window ) {
  return function ( scope, element, attrs ) {
    var path;

    attrs.$observe( 'goClick', function (val) {
      path = val;
    });

    element.bind( 'click', function () {
      scope.$apply( function () {
        $window.document.location.pathname= path ;
      });
    });
  };
});

editApp.controller('editCtrl',['$scope','$http','$window',function($scope,$http,$window){
$scope.hola="hola mundo";

//modelo principal
var levelEditing = $window.level_index;
$scope.levelData;
var lessonsData=[];
$scope.levelLessons=[];
$scope.unassignedLessons=[];

//http requets inicial

$http({
	method:'GET',
	url:'/api/v1/levels/'+levelEditing+'/edit/'
}).then(function(response){
	$scope.levelData=response.data.data.level;
	if (response.data.length==0){
		console.log("Error")	
	}else{
		console.log(response.data.data);
		for(i=0;i<response.data.data.lessons.length;i++){
			lessonsData.push(response.data.data.lessons[i]);
		}
	}
	$scope.init();
});//close http.then

//metodos

$scope.init=function(){
	separarLecciones();

}

function separarLecciones(){
	for(i=0;i<lessonsData.length;i++){
		if(lessonsData[i].level_id==null){
			$scope.unassignedLessons.push(lessonsData[i]);
		}else{
			$scope.levelLessons.push(lessonsData[i]);
		}
	}//close For
	//console.log($scope.levelLessons,$scope.unassignedLessons);
}//close separarLecciones

$scope.sortableOptions
}]);//close controller