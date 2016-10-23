/**
 * Created by edgar on 6/09/16.
 */
var sudoapp = angular.module('sudoapp',[]);

sudoapp.controller('MainController',['$scope','$http','upload',function($scope,$http,upload)
{
  $scope.cerrarSesion = function()
  {
    $http.post('/logout',{})
    .success(function(data){
      location.reload();
    })
    .error(function(err){
        console.log("Err");
    })
  }

    $http.post('/cogerCategorias',{})
        .success(function(data){
            $scope.categorias = data
        })
        .error(function(data){
            console.log("Ocurrio error 505")
        })

        $http.post('/cogerCategoriasDesactivadas',{})
            .success(function(data){
                $scope.categoriasDesactivadas = data
            })
            .error(function(data){
                console.log("Ocurrio error 505")
            })
    $scope.categoriaADesactivar = {id:''}
    $scope.desactivarCategoria = function()
    {
      $http.post('/desactivarCategoria',$scope.categoriaADesactivar)
      .success(function(data){
        swal("Se desactivo exitosamente")
      })
    }

    $scope.categoriaAactivar = {id:''}


    $scope.activarCategoria = function()
    {
     $http.post('/activarCategoria',$scope.categoriaAactivar)
     .success(function(data){
       swal("Se activo correctamente")
     })
    }

    $scope.nuevaCategoria = {nombre:''}
    $scope.agregarCategoria = function()
    {
      $http.post('/agregarCategoria',$scope.nuevaCategoria)
      .success(function(data){
        if(data == 0)
        {
          swal("Se agregó correctamente")
        }
        else
        {
          swal("Esa categoria ya existe")
        }
      })
    }


    $scope.recetaObj = {titulo: '', descripcion: '', texto: '', categoria: '', portada: ''}

    $scope.uploadFile = function()
    {
      var name = "photo"
      var file = $scope.file;
      console.log(file)
      upload.uploadFile(name,file).then(function(res)
    {
      $scope.recetaObj.portada = res;
      //console.log($scope.recetaObj.portada);
    })

    }
    $scope.publicarReceta = function()
    {
        $http.post('/recogerNuevaReceta',$scope.recetaObj)
            .success(function(data){
                //console.log($scope.recetaObj)
                swal("Receta Enviada");
                $scope.recetaObj = {titulo: '', descripcion: '', texto: '', categoria: '', portada: ''}


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
    //console.log(name + "El nombre " + file + " el archivo" );

$http.post('/cogerPortadaReceta',formData,{
  transformRequest: angular.identity,
  headers: {'Content-Type': undefined}
})
.success(function(res,data){
  //console.log(data);
  deferred.resolve(res)
})
.error(function(msg,code){
  console.log(err);
  deferred.reject(msg)

})
return deferred.promise;

  }
}])
