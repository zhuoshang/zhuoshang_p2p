/**
 * Created by QH on 15/3/27.
 */
angular.module("loginAndRegister", ["ngTouch"])
    .controller("CLR", ["$scope", "$http", function ($scope, $http) {
        $scope.where = "init";
        $scope.formTop = 10.5;
        $scope.user = {};

        $scope.toLogin = function () {
            $scope.where = "login";
        };

        $scope.toRegister = function () {
            $scope.where = "register";
        };

        $scope.setUnTouched = function (input) {
            input.$setUntouched();
        };

        $scope.toInit = function () {
            $scope.where = "init";
        };

        $scope.sRegister = function (form) {
            if (form.$valid) {
                $http.post("/", $scope.user)
                    .success(function (data) {});
            }
        };

        $scope.sLogin = function (form) {
            console.log(form);
            if (form.$valid) {
                $http.post("/", $scope.user)
                    .success(function (data) {});
            }
        }
    }]);