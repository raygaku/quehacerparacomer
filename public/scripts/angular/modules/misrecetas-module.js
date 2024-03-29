var lanapp = angular.module('lanapp',[]);

lanapp.controller('MainController',['$scope','$http',function($scope,$http)
{



    idDeRecetasArecomendar = [];
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
          //console.log(i+ " es igual a  " + $scope.rcalificaciones.todas_calificadas[j].receta_id)
          contador++
        }

      }
      if(contador >= 3)
        {
          recetasAComparar[recetasAComparar.length] = i
        }
    }


    //console.log(recetasAComparar)

    var compararPersonal = []
    var recetaComparaPersonal = {recetaid:'',score:'',usurioid:''}
    var recetasFinalesAComparar = []
    function compararAmisRecetas(item,index){
      for (var i = 0 ; i < $scope.rcalificaciones.mis_calificaciones.length; i++)
      {
        if( item == $scope.rcalificaciones.mis_calificaciones[i].receta_id){
          recetasFinalesAComparar[recetasFinalesAComparar.length] = item

          compararPersonal[compararPersonal.length] = recetaComparaPersonal = {
            recetaid:$scope.rcalificaciones.mis_calificaciones[i].receta_id,
            score:$scope.rcalificaciones.mis_calificaciones[i].calificacion,
            usuarioid:$scope.rcalificaciones.mis_calificaciones[i].usuario_id,
          }
        }
      }
    }
    recetasAComparar.map(compararAmisRecetas)
    console.log(compararPersonal)

    var compararLosDemas = []
    var recetaComparaLosDemas = {recetaid:'',score:'',usurioid:''}
    var usuariosAComparar = []
    function compararAlasDemas(item,index){
      for(var i = 0; i < $scope.rcalificaciones.las_demas_calificaciones.length;i++)
      {
        if(item == $scope.rcalificaciones.las_demas_calificaciones[i].receta_id){
          compararLosDemas[compararLosDemas.length] = recetaComparaLosDemas = {
          recetaid:$scope.rcalificaciones.las_demas_calificaciones[i].receta_id,
          score:$scope.rcalificaciones.las_demas_calificaciones[i].calificacion,
          usurioid:$scope.rcalificaciones.las_demas_calificaciones[i].usuario_id
            }
          usuariosAComparar[usuariosAComparar.length] = $scope.rcalificaciones.las_demas_calificaciones[i].usuario_id
          }
        }
      }
    recetasFinalesAComparar.map(compararAlasDemas)
    //console.log(compararLosDemas)
    //console.log(usuariosAComparar)
    var usuariosACompararFinal = []
    function quitarSobras(item,index){
      var contadorq = 0
      for (var thing in usuariosAComparar){
        //console.log(item + " es igual " + usuariosAComparar[thing] + (item == usuariosAComparar[thing]))
        if(item == usuariosAComparar[thing]){
          contadorq++
        }
      }
      if(contadorq >= compararPersonal.length){
        usuariosACompararFinal[usuariosACompararFinal.length] = item
      }
    }
    //quitarSobras(7)
    usuariosAComparar.map(quitarSobras)
    //console.log(usuariosACompararFinal)
    Array.prototype.unique=function(a){
    return function(){return this.filter(a)}}(function(a,b,c){return c.indexOf(a,b+1)<0
    });
    usuariosACompararFinal = usuariosACompararFinal.unique()
    //console.log(usuariosACompararFinal)
    compararAlasDemasFinal = []

    recetasdeOtrosAComparar = []
    function quitarSobrasRecetas(item, index){
     for (var i in compararLosDemas){
      if(item ==  compararLosDemas[i].usurioid){
        recetasdeOtrosAComparar[recetasdeOtrosAComparar.length] = compararLosDemas[i]
      }
     }
    }

    usuariosACompararFinal.map(quitarSobrasRecetas)
    console.log(recetasdeOtrosAComparar)


//PROMEDIOS

    var promedioPorUsuario = {usuarioid:'',promedio:''}
    var promedioMiUsuario
    var sumaMiPromedio = 0
    for (var i=0; i<compararPersonal.length; i++){
        sumaMiPromedio += compararPersonal[i].score
    }
    var mipromedio = parseFloat(sumaMiPromedio / compararPersonal.length)
    promedioMiUsuario = mipromedio.toFixed(4)

    for (var x=0; x<usuariosACompararFinal.length; x++){
      var suma=0
      for (var y=0; y<recetasdeOtrosAComparar.length; y++){
          if (usuariosACompararFinal[x] == recetasdeOtrosAComparar[y].usurioid){
            suma+= $scope.rcalificaciones.las_demas_calificaciones[y].calificacion
          }
        //console.log(usuariosACompararFinal[x] + " es igual a "  + recetasdeOtrosAComparar[y].usurioid + " " + (usuariosACompararFinal[x] == recetasdeOtrosAComparar[y].usurioid))
      }
      promedio = parseFloat(suma/compararPersonal.length)
      promedioPorUsuario[x] = {usuarioid: usuariosACompararFinal[x], promedio: promedio.toFixed(3)}
    }
    //console.log(promedioPorUsuario)
    //console.log(promedioMiUsuario)
//FIN DE PROMEDIOS

   var similitudPorUsuario = {usuarioid:'', similitud:''}
    for (var x=0; x<usuariosACompararFinal.length; x++){
      var suma_num = 0
      var suma_raiz_1=0
      var suma_raiz_2=0
      var contador = 0
      for (var y=0; y<recetasdeOtrosAComparar.length; y++){
          if (usuariosACompararFinal[x] == recetasdeOtrosAComparar[y].usurioid){
              suma_num += (compararPersonal[contador].score - promedioMiUsuario) * ($scope.rcalificaciones.las_demas_calificaciones[y].calificacion - promedioPorUsuario[x].promedio)
              suma_raiz_1 += Math.pow((compararPersonal[contador].score - promedioMiUsuario),2)
              suma_raiz_2 += Math.pow(($scope.rcalificaciones.las_demas_calificaciones[y].calificacion - promedioPorUsuario[x].promedio),2)
              contador++
          }
      }
      raiz_1 = Math.pow(suma_raiz_1, 0.5)
      raiz_2 = Math.pow(suma_raiz_2, 0.5)
      similitud = suma_num / (raiz_1 * raiz_2)
      similitudPorUsuario[x] = {usuarioid:usuariosACompararFinal[x], similitud:similitud.toFixed(3)}
    }
    console.log(similitudPorUsuario)

    var similitudMayor = {usuarioid:'',similitud:''}
    sim_max = 0
    for(i=0; i<usuariosACompararFinal.length; i++){
      if(parseFloat(similitudPorUsuario[i].similitud) > sim_max){
          similitudMayor = {usuarioid:usuariosACompararFinal[i], similitud:similitudPorUsuario[i].similitud}
          sim_max = similitudPorUsuario[i].similitud
      }
    }

    var usuariosSimilares = [];
    usuariosSimilares[usuariosSimilares.length] = similitudMayor;
    //usuariosSimilares[usuariosSimilares.length] = {usuarioid: 10, similitud:"0.180"};
    console.log(similitudMayor);
    var recetasDelSimilitudMayor = [];
    function recetasDelElegido(item,index){
      //console.log(similitudMayor.usuarioid)
      if (similitudMayor.usuarioid == item.usuario_id){
        recetasDelSimilitudMayor[recetasDelSimilitudMayor.length] = item;
      }
    }
    $scope.rcalificaciones.las_demas_calificaciones.map(recetasDelElegido);
    console.log(recetasDelSimilitudMayor);

    //console.log(compararPersonal);
    var recetasARecomendar01 = []
    function quitarRecetasRepetidas(item, intex){
      var contador = 0;
      for(var i  = 0 ; i < compararPersonal.length; i++)
      {
        if(item.receta_id == compararPersonal[i].recetaid){
          contador++;
        }
      }
      if(contador == 0){
        recetasARecomendar01[recetasARecomendar01.length] = item;
      }
    }

    recetasDelSimilitudMayor.map(quitarRecetasRepetidas);
    console.log(recetasARecomendar01);
    console.log(usuariosSimilares);

    var k = 0;
    function calcularK(item,index)
    {
      k += parseFloat(item.similitud);
      return k;
    }

    k = usuariosSimilares.map(calcularK);
    kfn = k[k.length -1] // esta es la k, el denominador de la funcion para predecir
    console.log(kfn)
    promediosdeUSimilares = []
    function promediosDeSimilares(item,index){
      for(var i = 0; i < usuariosACompararFinal.length; i++){
        //console.log(item)
        if(item.usuarioid == promedioPorUsuario[i].usuarioid){
          promediosdeUSimilares[promediosdeUSimilares.length] = promedioPorUsuario[i];
        }
      }
    }

    usuariosSimilares.map(promediosDeSimilares);
    console.log(promediosdeUSimilares);
    console.log(recetasARecomendar01)
    var productoDesumatoria = 0;
    var productosDesumatoria = [];
    function numeradorPredictor(item,index){
      for(var i = 0; i < recetasARecomendar01.length; i++)
      {
        productoDesumatoria = 0;
        if(recetasARecomendar01[i].usuario_id == item.usuarioid){
          productoDesumatoria = item.similitud * parseFloat(recetasARecomendar01[i].calificacion - parseFloat(promediosdeUSimilares[index].promedio));
          prediccion = parseFloat(productoDesumatoria/Math.abs(kfn)) + parseFloat(promedioMiUsuario);
          productosDesumatoria[productosDesumatoria.length] = {recetaid:recetasARecomendar01[i].receta_id,calificacion:prediccion}
        }
      }
    }
    usuariosSimilares.map(numeradorPredictor);
    console.log(productosDesumatoria);
    console.log(promedioMiUsuario);
    console.log(usuariosSimilares);

   idDeRecetasArecomendar = [];
    for(var i in productosDesumatoria){
      //console.log(productosDesumatoria[i])
      if(productosDesumatoria[i].calificacion >= 3.0)
      {
        idDeRecetasArecomendar[idDeRecetasArecomendar.length] = productosDesumatoria[i].recetaid;
      }
    }

    console.log(idDeRecetasArecomendar)
    //aquí termina el sistema de recomendación

    if(idDeRecetasArecomendar.length != 0){
      $scope.recetasRecomendadas = [];
        for(var i = 0; i < idDeRecetasArecomendar.length; i++){
          $scope.idArecomendar = {id:idDeRecetasArecomendar[i]};
          console.log($scope.idArecomendar)

          $http.post('/cogerRecetaPorID',$scope.idArecomendar)
            .success(function(data){
              $scope.recetasRecomendadas[$scope.recetasRecomendadas.length] = data;
              console.log("$scope.recetasRecomendadas ");
              console.log($scope.recetasRecomendadas);
            })
            .error(function(err){
              console.log(err)
            })

        }
//$app->post('/cogerRecetaPorID', 'recetasController@cogerRecetasPorId');
    }
    else{
      console.log("no hay que recomendar")
    }

  })
  .error(function(err){
    console.log(err)
  })

 //console.log(idDeRecetasArecomendar);

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




        $scope.valor = {valor:''}
          $scope.enviarCalf = function(id, valor)
          {
            console.log($scope.valor);
            console.log(id + " "+ valor);
            $scope.calificacion = {rating : valor, rid : id}
            $http.post('/calificar', $scope.calificacion )
            .success(function(data){
              if (data==0) {

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

}]);
