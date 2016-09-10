/**
 *
 * List controller
 *
 * @author Oscar Rodriguez <oscar.rodriguez@leadsius.com>
 *
 */
(function() {

    'use strict';

    var pedidoController = function($scope) {

        $scope.test = "test de angular";


    };


    angular.module('drink.Controllers')
        .controller('pedidoController', [
            '$scope',
            pedidoController
        ]);

})();