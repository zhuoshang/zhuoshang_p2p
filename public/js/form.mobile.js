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
                $http.post("../register", $scope.user)
                    .success(function (data) {
                        if (data.status == 200) {
                            window.location.href = data.data;
                        }else{
                            alert(data.msg);
                        }
                    });
            }
        };

        $scope.getCheckCode = function (name) {
            $http.post("../smsSent", {
                option: name,
                phoneNumber: $scope.user.phoneNumber
            }).success(function (data) {
                console.log(data);
            });
        };

        $scope.sLogin = function (form) {
            if (form.$valid) {
                $http.post("../login", $scope.user)
                    .success(function (data) {
                        if (data.status == 200) {
                            window.location.href = data.data;
                        }else{
                            alert(data.msg);
                        }
                    });
            }
        }
    }]);