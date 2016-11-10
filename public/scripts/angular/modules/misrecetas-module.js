var lanapp = angular.module('lanapp',[]);

lanapp.controller('MainController',['$scope','$http',function($scope,$http)
{

  

  $scope.rcalificaciones = {las_demas_calificaciones:'' , mis_calificaciones:'',todas_calificadas:''}
  $http.post('/recomendarRecetasAPI',{})
  .success(function(data){
    $scope.rcalificaciones.las_demas_calificaciones = data["las_demas_calificaciones"]
    $scope.rcalificaciones.mis_calificaciones = data["mis_calificaciones"]
    $scope.rcalificaciones.todas_calificadas =  data["todas_calificadas"]
    //Aquí empieza el sistema de recomendación
    //console.log($scope.rcalificaciones.todas_calificadas.length)
    var recetaMayor = 0
    for(var i = 0; i < $scope.rcalificaciones.todas_calificadas.length ; i++){
      if(parseInt($scope.rcalificaciones.todas_calificadas[i].receta_id) > recetaMayor ){
        recetaMayor = $scope.rcalificaciones.todas_calificadas[i].receta_id
      }
    }
    //console.log(recetaMayor)
    var recetaMenor = recetaMayor
    for(var i = 0; i < $scope.rcalificaciones.todas_calificadas.length ; i++){
      if(parseInt($scope.rcalificaciones.todas_calificadas[i].receta_id) < recetaMenor ){
        recetaMenor = $scope.rcalificaciones.todas_calificadas[i].receta_id
      }
    }
    //console.log($scope.rcalificaciones.todas_calificadas)
    //console.log(recetaMenor)
    var recetasAComparar = []
    var todos = 0
    var contador = 0
    //console.log(" calificadas " + $scope.rcalificaciones.las_demas_calificaciones.length)

    for(var i = recetaMenor ; i <= recetaMayor ; i++)
    {
      contador = 0
      for(var j = 0 ; j < $scope.rcalificaciones.todas_calificadas.length; j++)
      {
        //console.log($scope.rcalificaciones.todas_calificadas[j].receta_id)
        
        if(i == $scope.rcalificaciones.todas_calificadas[j].receta_id)
        {
          console.log(i+ " es igual a  " + $scope.rcalificaciones.todas_calificadas[j].receta_id)
          contador++
        }
        
      }
      if(contador >= 4)
        {
          recetasAComparar[recetasAComparar.length] = i
        }
    }
    
    
    console.log(recetasAComparar)

    //aquí termina el sistema de recomendación
  })
  .error(function(err){
    console.log(err)
  })




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

// Mis recetas
$http.post('/obtenerMisRecetas',{})
.success(function(data){
  //console.log("Mis recetas");
  $scope.misrecetasson = data;
  //console.log(data);
})
.error(function(data) {
  /* Act on the event */
  console.log("err");
});

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
          //  console.log(data)
            $scope.recetasExistentes = data;

        })
        .error(function()
        {
            console.log("not found")
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
    console.log("logout");
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
    /*console.log("Tus recetas");

      $http.post('/obtenerUsrId',{})
      .success(function(data){
        console.log(data);
      })
      .error(function(data){
        console.log(err);
      })
      */
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
