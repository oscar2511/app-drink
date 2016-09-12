
(function() {

    'use strict';

    var productoController = function($scope, $http) {

        /**
         *
         * @param id
         * @param categoria
         * @param nombre
         * @param precio
         * @param descripcion
         * @param stock
         */
        $scope.setProducto = function(id,
                                      categoria,
                                      nombre,
                                      precio,
                                      descripcion,
                                      stock){
            $scope.id          = id;
            $scope.categoria   = categoria;
            $scope.nombre      = nombre;
            $scope.precio      = precio;
            $scope.descripcion = descripcion;
            $scope.stock       = stock;

        };

        /**
         *
         * @param formulario
         */
        $scope.editarProducto = function(formulario){
            console.log($scope.nombre);

            var datosProducto ={
                'id'   :       parseInt(formulario.id.$viewValue),
                'categoria':   formulario.categoria.$viewValue,
                'nombre':      $scope.nombre,
                'precio':      formulario.precio.$viewValue,
                'descripcion': formulario.descripcion.$viewValue,
                'stock':       formulario.stock.$viewValue
            };

            var config = {
                headers : {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            };

            var url = 'http://localhost/app-drink/web/app_dev.php/producto/ajax/editar';
            $http.post(url, datosProducto)
                .then(function(response){

                })


        };
    };


    angular.module('drink.Controllers')
        .controller('productoController', [
            '$scope',
            '$http',
            productoController
        ]);

})();