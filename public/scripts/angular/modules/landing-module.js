var lanapp = angular.module('lanapp',[]);

lanapp.controller('MainController',['$scope','$http',function($scope,$http)
{



  $scope.pin = function(rec)
  {
    $scope.piner = {recetaid : rec}
    //console.log("El id es " + $scope.piner.recetaid);
    $http.post('/pin',$scope.piner)
    .success(function(data){
      if(data == 1){
        //swal("Inicia sesión y vuelve a intentarlo")
        $('#myModalLogin').modal('show');
        $('#alertaGuardar').show();

      }
      else {
        swal("Guardado :\)")
      }
    })
  }

$scope.valor = {valor:''}
  $scope.enviarCalf = function(id, valor)
  {
    console.log($scope.valor);
    console.log(id + " "+ valor);
    $scope.calificacion = {rating : valor, rid : id}
    $http.post('/calificar', $scope.calificacion )
    .success(function(data){
      if (data==0) {
        swal("Guardado : \)")
      } else {
        $scope.rec.calificacion = 0
        $('#myModalLogin').modal('show');
        $('#alertaGuardar').show();
      }


  })
  .error(function(err){
    console.log(err)
  })
  }



  $scope.ratings =  0;
  //
  // $scope.insertdata=function(rec){
  //   $scope.piner = {recetaid : rec}
  //   $http.post("",{$scope.piner, 'ratings':$scope.ratings})
  //   .success(function(data,status,headers,config){
  //     console.log("data inserted");
  //   });
  // }
  $scope.cal = function(rec)
  {
    $scope.piner = {recetaid : rec}
    $scope.ratings = {rating : ratings}
    $http.post('/calificar', $scope.ratings)
    .success(function(data){
      if(data == 1){
        $('#myModalLogin').modal('show');
        $('#alertaGuardar').show();
      }
      else {
        swal("Guardado :\)")
      }
    })


  }





  $scope.userToLog = {correo:'',pwd:''}
  $scope.loginU = function()
  {
    $http.post('/login',$scope.userToLog)
    .success(function(data){
      if(data == 1)
      {
        swal("Revisa la información :/")
      }
      else {
        location.reload();
      }
    })
    .error(function(data){
      console.log("er");
    })
  }

$scope.busqueda = {titulo:''}
$scope.buscar = function()
{
  $scope.busqueda.titulo = $("#ingenieur").val();
  //console.log($scope.busqueda);
  var index = $scope.awlist.indexOf($scope.busqueda.titulo)
  //console.log(index);
  $scope.busquedaId = $scope.awlist[index + 1]
  //console.log($scope.busquedaId);
  $scope.leer($scope.busquedaId)
  $("#launcher").click();
}
  angular.element(document).ready(function () {

/*
    // lo nuevo
    $http.post('/loginStatus',{})
    .success(function(data){
      console.log(data);
    })
    .error(function(data){
      console.log("err");
    });
*/
    $http.post('/obtenerAccesos',{})
    .success(function(data){
    //  console.log(data);
      $scope.accesos = data;
    });

    //lo nuevo
    var input = document.getElementById("ingenieur");
    var awesomplete = new Awesomplete(input);
    $http.post('/cogerTitulosRecetas',{})
    .success(function(data){
      //console.log(data);
      $scope.awlist = data;
      awesomplete.list = data;
    })
    .error(function() {
      console.log("Not found");
    });
    $http.post('/recetas',{})
        .success(function(data)
        {
          $scope.recetasExistentes = data;
          console.log(data);
        })
        .error(function(err)
        {
            console.log(err)
        });


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
            //console.log("Lei a receta")

            //console.log(data[0]['texto'])
            var receta = data[0]['texto']
            // quill.setContents(receta)
            setear(receta)
        })
    }

    //Código para registrarUsuario
   $scope.usuarioAregistrar = {correo:'',pwd:''};
   $scope.registrarU = function()
   {
     if(($scope.usuarioAregistrar.correo == undefined || $scope.usuarioAregistrar.pwd == "") || $scope.usuarioAregistrar.correo == "")
     {
      // console.log($scope.usuarioAregistrar);
       swal("Por favor ingresa correctamente los datos");
     }
     else {
       $scope.realizarRegistro();
     }
   }

$scope.task= function(funcion)
{

  switch (funcion) {
    case "cerrarSesion":
    //console.log("logout");
      $http.post('/logout',{})
      .success(function(data){
        location.reload();
      })
      .error(function(err){
          console.log("Err");
      })
    break;
    case "login":
    $('#alertaGuardar').hide();
    break;
    case "misRecetas":
    window.location = '/misRecetas'
    break;

   default:

  }

}

   $scope.realizarRegistro = function(){
     $http.post('/registrarUsuario',$scope.usuarioAregistrar)
     .success(function(data){

       if(data == 1)
       {
         swal("Ese correo ya está registrado")
       }
       else {


         location.reload();

         //console.log($scope.usuarioAregistrar);
       }

       console.log("id" + data);

     })
     .error(function(err){
       swal("Ocurrio un error inesperado :,x")
       //console.log($scope.usuarioAregistrar);
     })
   }

    $http.post('/cogerCategorias',{})
        .success(function(data){
            $scope.categorias = data
        })
        .error(function(data){
          //  console.log("Ocurrio error 505")
        })

}]);
