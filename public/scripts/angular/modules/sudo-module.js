/**
 * Created by edgar on 6/09/16.
 */
var sudoapp = angular.module('sudoapp',[]);

sudoapp.controller('MainController',['$scope','$http','upload',function($scope,$http,upload)
{

    $http.post('/cogerCategorias',{})
        .success(function(data){
            $scope.categorias = data
        })
        .error(function(data){
            console.log("Ocurrio error 505")
        })


    $scope.recetaObj = {titulo: '', descripcion: '', texto: '', categoria: '', portada: ''}

    $scope.uploadFile = function()
    {
      var name = "photo"
      var file = $scope.file;
      //console.log(file)
      upload.uploadFile(name,file).then(function(res)
    {
      $scope.recetaObj.portada = res.data;
      console.log(res);
    })

    }
    $scope.publicarReceta = function()
    {
        $http.post('/recogerNuevaReceta',$scope.recetaObj)
            .success(function(data){
                console.log($scope.recetaObj)
                swal("Receta Enviada");
                

            })
            .error(function(data){
                console.log("Ocurrio un error 505")
            })
    }
}]);

sudoapp.directive('uploaderModel', ["$parse",function($parse){
  return {
    restrict : 'A',
    link: function(scope,iElement,iAttrs)
    {
      iElement.on("change",function(e)
    {
      $parse(iAttrs.uploaderModel).assign(scope,iElement[0].files[0])
    });
    }
  }
}]);

sudoapp.service('upload',["$http","$q",function($http,$q){
  this.uploadFile = function(name,file)
  {
    var deferred = $q.defer();
    var formData = new FormData();
    formData.append("name",name);
    formData.append("file",file);
    return $http.post("/cogerPoradaReceta", formData,{
      headers : {
        "Content-type" : undefined
      },
      transformRequest : formData
    })
    .success(function(res,data){


      deferred.resolve(res)
    })
    .error(function(msg,code,err){
      deferred.reject(msg)
      console.log(err);
    })
    return deferred.promise;
  }
}])
