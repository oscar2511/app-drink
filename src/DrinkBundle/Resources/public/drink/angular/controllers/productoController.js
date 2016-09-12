
(function() {

    'use strict';

    var productoController = function($scope, $http, $timeout) {

        $scope.mostrarLoader = false;
        $scope.mostrarExito  = false;
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
         * Editar producto
         * @param formulario
         */
        $scope.editarProducto = function(formulario){
            $scope.mostrarLoader = true;
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
                    $scope.mostrarLoader = false;
                    if(response.data.estado === 200) {
                        $scope.mostrarExito = true
                        $timeout(function() {
                            $scope.mostrarExito = false;
                        }, 3000);

                    }else{
                        alert("Ocurrió un error editando el producto")
                    }

                }).catch(function(){
                    $scope.mostrarLoader = false;
                    alert("Ocurrió un error editando el producto")
                });
        };

        /**
         * Editar producto
         * @param formulario
         */
        $scope.crearProducto = function(formulario){
            $scope.mostrarLoader = true;
            var datosProducto ={
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

            var url = 'http://localhost/app-drink/web/app_dev.php/producto/ajax/crear';
            $http.post(url, datosProducto)
                .then(function(response){
                    $scope.mostrarLoader = false;
                    if(response.data.estado === 200) {
                        $scope.mostrarExito = true;
                        $timeout(function() {
                            $scope.mostrarExito = false;
                        }, 3000);

                    }else{
                        alert("Ocurrió un error editando el producto")
                    }

                }).catch(function(){
                    $scope.mostrarLoader = false;
                    alert("Ocurrió un error editando el producto")
                });


        };


    };


    angular.module('drink.Controllers')
        .controller('productoController', [
            '$scope',
            '$http',
            '$timeout',
            productoController
        ]);

})();