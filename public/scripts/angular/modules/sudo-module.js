/**
 * Created by edgar on 6/09/16.
 */
var sudoapp = angular.module('sudoapp',[]);

sudoapp.controller('MainController',['$scope','$http',function($scope,$http)
{

    $http.post('/cogerCategorias',{})
        .success(function(data){
            $scope.categorias = data
        })
        .error(function(data){
            console.log("Ocurrio error 505")
        })


    $scope.recetaObj = {titulo: '', descripcion: '', texto: '', categoria: ''}
    $scope.publicarReceta = function()
    {
        console.log($scope.recetaObj)
    }
}]);

