angular.module("personFun", ["ngTouch"])
    .controller("funController", ["$scope", function ($scope) {
        //default fun
        $scope.funStatus = "list";
        $scope.modelName = "资产列表";

        $scope.toCalendar = function () {
            $scope.funStatus = "date";
            $scope.modelName = "历史债券"
        };

        $scope.toList = function () {
            $scope.funStatus = "list";
            $scope.modelName = "资产列表";
        }
    }]);