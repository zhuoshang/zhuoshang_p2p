/**
 * Created by QH on 15/3/27.
 */
angular.module("loginAndRegister", ["ngTouch"])
    .controller("CLR", ["$scope", "$http", function ($scope, $http) {
        $scope.where = "register";
        $scope.formTop = 10.5;

        $scope.toLogin = function () {
            $scope.where = "login";
        };

        $scope.toRegister = function () {
            $scope.where = "register";
        };

        $scope.moveForm = function () {
            $scope.formTop = 8.5;
        };

        $scope.recoverForm = function () {
            $scope.formTop = 10.5;
        };

        $scope.toInit = function () {
            $scope.where = "init";
        }
    }]);