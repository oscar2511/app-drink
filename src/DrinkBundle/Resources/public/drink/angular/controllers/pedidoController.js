
(function() {

    'use strict';

    var pedidoController = function($scope, $http) {

        $scope.mostrarLoader = false;
        $scope.mostrarExito  = false;

        /**
         * Cambia el estado de un pedido
         * @param estado
         * @param idpedido
         */
        $scope.cambiarEstado = function(estado, idpedido){
            var params = {
                estado:   estado,
                idPedido: idpedido
            };
            var config = {
                headers : {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            };

            var url = 'http://localhost/app-drink/web/app_dev.php/pedido/ajax/cambiar-estado/';
            $http.post(url, params, config)
                .then(function(response){
                    $scope.mostrarLoader = true;
                    if(response.data.estado != 200) {
                        $scope.mostrarLoader = false;
                        alert("Ocurrió un error actualizando el estado");
                    }
                    else {
                        $scope.estadoActual = response.data.nuevo_estado;
                        $scope.mostrarLoader = false;
                        $scope.mostrarExito = true;
                    }
                });
        };

        /**
         * Setea el estado actual del pedido
         * @param  estado integer
         */
        $scope.setearEstadoActual = function(estado){
            $scope.estadoActual = estado;
        };


    };


    angular.module('drink.Controllers')
        .controller('pedidoController', [
            '$scope',
            '$http',
            pedidoController
        ]);

})();