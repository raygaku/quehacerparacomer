var sudoapp = angular.module('sudoapp',[]);

sudoapp.controller('MainController',['$scope','$http',function($scope,$http){
  $scope.sudoLog = {username : '', password : ''};
  $scope.sudoLogin = function()
  {
    $http.post('/sudoLogin',$scope.sudoLog)
    .success(function(data){
      if(data.codigo == 0)
      {

        window.location ="/sudoPanel";

      }
      else {
        swal("Credenciales inválidas")


      }
    })
  }
}]);
