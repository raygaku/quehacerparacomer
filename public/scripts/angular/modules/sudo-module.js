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


    $scope.recetaObj = {titulo: '', descripcion: '', texto: '', categoria: '', portada:''}
    $scope.publicarReceta = function()
    {
        $http.post('/recogerNuevaReceta',$scope.recetaObj)
            .success(function(data){
                console.log($scope.recetaObj)
                swal("Receta Enviada");
                $scope.recetaObj.titulo = ''
                $scope.recetaObj.descripcion = ''
                $scope.recetaObj.texto = ''
                $scope.recetaObj.categoria = ''

            })
            .error(function(data){
                console.log("Ocurrio un error 505")
            })
    }
}]);

