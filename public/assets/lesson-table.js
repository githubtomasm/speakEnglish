var listaApp = angular.module('lessonApp', ['ui.sortable']).config(function($interpolateProvider){
    $interpolateProvider.startSymbol('{[{').endSymbol('}]}');
}); //creamos la nueva app con diferente nomenclatura para las expresiones

listaApp.directive('ngEnter', function() {
        return function(scope, element, attrs) {
            element.bind("keydown keypress", function(event) {
                if(event.which === 13) {
                        scope.$apply(function(){
                                scope.$eval(attrs.ngEnter);
                        });
                        
                        event.preventDefault();
                }
            });
        };
});


listaApp.controller("lesson-ctrl",["$scope","$window","$http",function($scope,$window,$http){

	$scope.lessonsData=[{"id":0,"title":"","description":"","video_id":"","level_id":0,"user_id":0,"status_id":0,"published_at":"","deleted_at":"","created_at":"","updated_at":"","level":{}}];

	$scope.init=function(){//al iniciar esta funcion es la que quita el loading de la tabla una vez se cuente con el contenido
		$scope.loadDocument=true;
		document.getElementById('listaTabla').className="";
	};

	$scope.fastEdit=function(obj,element){
		if (obj.change) {

		jsonPOST=[{type:"lessonFastEdit"},{id:obj.id}]
		jsonPOST[1][element]=obj[element];

		$http.post("/admin/lessons/",jsonPOST);
			obj.change=false;
		};

	}


	$http({
		method:'GET',
		url:'/admin/lessons/getjson'
	}).then(function(response){
		$scope.init();

		if (response.data.length==0){
		  document.getElementById('noHayLecciones').className="";
		}else{
			//	console.log(response);
				$scope.lessonsData=response.data.map(function(lesson){
				if (lesson.level_id!=null){
				var obj=lesson;
				return obj;
				}else{
					lesson.level_id=0;
				var obj=lesson;
				return obj;
				}
			});
		
		}
	});
	
}]);