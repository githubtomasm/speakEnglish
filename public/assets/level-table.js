
var listaApp = angular.module('listaApp', []).config(function($interpolateProvider){
    $interpolateProvider.startSymbol('{[{').endSymbol('}]}');
});


