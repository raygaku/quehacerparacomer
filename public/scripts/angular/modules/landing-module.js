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
        });

    $scope.leer = function(id)
    {
        $http.post('/cogerRecetaPorID',{id:id})
            .success(function(data)
            {
                $scope.recetaElegida = data;
            })

        var lectura = $.post("/cogerRecetaPorID",{id : id});
        lectura.done(function(data)
        {
            console.log("Lei a receta")

            console.log(data[0]['texto'])
            var receta = data[0]['texto']
            // quill.setContents(receta)
            setear(receta)
        })
    }

    $http.post('/cogerCategorias',{})
        .success(function(data){
            $scope.categorias = data
        })
        .error(function(data){
            console.log("Ocurrio error 505")
        })

}]);