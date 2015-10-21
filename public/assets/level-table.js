
var listaApp = angular.module('listaApp', ['ui.sortable']).config(function($interpolateProvider){
    $interpolateProvider.startSymbol('{[{').endSymbol('}]}');
}); //creamos la nueva app con diferente nomenclatura para las expresiones


listaApp.controller('li-ctrl',['$scope','$http',function($scope,$http){ //creamos el controlador de la tabla pasamos http para hacer el get y el post de información

	$scope.holamundo='holamundo'; //variable de prueba
	$scope.init=function(){//al iniciar esta funcion es la que quita el loading de la tabla una vez se cuente con el contenido
		$scope.loadDocument=true;
		document.getElementById('listaTabla').className="";
	}
	var isChange=false; //variable pibote para asegurar si despues de un drag & drop realmente hubo cambios
	$scope.sortableOptions={ //opciones sobre la funcionabilidad del ui-sortable de angular
		update:function(){//esta funcion solo se acciona si hay cambios en el orden
			//console.log("updating");
			isChange=true;//mandamos a decir que hubo cambios
		},
		stop:function(){//esta funcion se detona al terminar la accion de drag & drop
			if (isChange){//solo si hubo cambios se detonará
			for(i=0;i<$scope.jsonData.length;i++){//con este bucle igualamos la posicion de la tabla (a travez de la posicion $index) a la variable level_index
				$scope.jsonData[i].level_index=(i+1);
			}
			//console.log($scope.jsonData);
			$http.post("/admin/levels/getjson",$scope.jsonData);//enviamos via post el array nuevo...
			isChange=false;//ponemos en sin cambios para cambios posterio
			}
		}
    }
	$scope.jsonData=[{id:0,level_index:0,title:"",description:"",lessons:[]}];
	$scope.sinNiveles=false;
	$http({
		method:'GET',
		url:'/admin/levels/getjson'
	}).then(function(response){
		$scope.init();
		if (response.data.length==0){
			$scope.sinNiveles=true;
		}else{
			$scope.jsonData=response.data.map(function(level){
			var obj=level;
			return obj;
		});
		}
	});

	$scope.showLessons=function(indexList,idLevel){
		console.log("idLevel:"+idLevel+" IndexList:"+indexList);
	};

}]);
