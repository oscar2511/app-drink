
(function() {

    'use strict';

    var dashboardController = function($scope, $http) {

        $scope.labels = ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"];
        $scope.series = ['Semana actual', 'Semana anterior'];
        $scope.data = [
            [25, 13, 10, 67, 113, 150, 32],
            [13, 24, 17, 55, 100, 190, 40]
        ];
        $scope.onClick = function (points, evt) {
            console.log(points, evt);
        };
        $scope.datasetOverride = [{ yAxisID: 'y-axis-1' }, { yAxisID: 'y-axis-2' }];

        $scope.options = {
            scales: {
                yAxes: [
                    {
                        id: 'y-axis-1',
                        type: 'linear',
                        display: true,
                        position: 'left'
                    },
                    {
                        id: 'y-axis-2',
                        type: 'linear',
                        display: true,
                        position: 'right'
                    }
                ]
            }
        };


        $scope.labelsEstado = ["Download Sales", "In-Store Sales", "Mail-Order Sales"];
        $scope.dataEstado = [300, 500, 100];


    };


    angular.module('drink.Controllers')
        .controller('dashboardController', [
            '$scope',
            '$http',
            dashboardController
        ]);

})();