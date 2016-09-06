var lanapp = angular.module('lanapp',[]);

lanapp.controller('MainController',['$scope','$http',function($scope,$http)
{
    $http.post('/recetas',{})
        .success(function(data)
        {
            console.log(data)
            $scope.recetasExistentes = data;
        })
        .error(function()
        {
            console.log("not found")
        })
    $scope.leer = function(id)
    {
        console.log(id)
        $scope.datosEnviar = {'id' : id}
        $http.post('/cogerRecetaPorID',$scope.datosEnviar)
            .success(function(data)
            {
                console.log(data)
                $scope.recetaElegida = data
            })
            .error(function(err)
            {
                console.log("Ocurrio un error")
            })

    }
}]);