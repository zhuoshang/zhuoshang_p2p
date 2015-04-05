function isEarn ($scope, $filter) {
    $scope.isNetWorth = $filter("newWorth")($scope.listInfo[$scope.currentList].netWorth);
}

function reminding ($scope, $filter) {
    var _rotate = $filter("loading")($scope.listInfo[$scope.currentList].bondLoading);

    $scope.loadingRoateLeft = _rotate.left;
    $scope.loadingRotateRight = _rotate.right;

}

function modelC ($scope, obj) {
    $scope.assets.funStatus = obj.status;
    $scope.assets.modelName = obj.modelName;
}

angular.module("personFun", ["ngTouch"])
    .controller("funController", ["$scope", "$http", "$filter", function ($scope, $http, $filter) {
        $scope.currentList = 0;
        $scope.year = new Date().getFullYear();
        $scope.route = "assetsList";
        $scope.personList = false;
        $scope.assets = {};
        $scope.fund = {
            search: {
                type: ["全部"],
                status: "全部"
            }
        };

        $http.get("../test/list", {
            cache: true
        })
            .success(function (data, status) {
                if (data.status == 200) {
                    $scope.listInfo =  data.data;
                    $scope.listTotal = data.data.length;
                    isEarn($scope, $filter);
                    reminding($scope, $filter);
                    modelC($scope, {
                        status: "list",
                        modelName: "资产列表"
                    });
                }
        })
            .error(function (data, status) {});

        $scope.monthDate = [
            {
                "n": "01",
                "e": "January"
            },
            {
                "n": "02",
                "e": "February"
            },
            {
                "n": "03",
                "e": "March"
            },
            {
                "n": "04",
                "e": "April"
            },
            {
                "n": "05",
                "e": "May"
            },
            {
                "n": "06",
                "e": "June"
            },
            {
                "n": "07",
                "e": "July"
            },
            {
                "n": "08",
                "e": "August"
            },
            {
                "n": "09",
                "e": "September"
            },
            {
                "n": "10",
                "e": "October"
            },
            {
                "n": "11",
                "e": "November"
            },
            {
                "n": "12",
                "e": "December"
            }
        ];

        $scope.toCalendar = function () {
            modelC($scope, {
                status: "date",
                modelName: "历史债券"
            })
        };

        $scope.toList = function () {
            modelC($scope, {
                status: "list",
                modelName: "资产列表"
            })
        };

        $scope.cNList = function () {
            if ($scope.currentList + 1 == $scope.listTotal) {
                alert("没有更多债券了");
                return;
            }
            $scope.currentList = $scope.currentList + 1;
            isEarn($scope, $filter);
            reminding($scope, $filter);
        };

        $scope.cPList = function () {
            if ($scope.currentList == 0) {
                alert("没有更多债券了");
                return;
            }
            $scope.currentList = $scope.currentList - 1;
            isEarn($scope, $filter);
            reminding($scope, $filter);
        };
        $scope.toNextYear = function () {
            $scope.year =  $scope.year + 1;
        };
        $scope.toLastYear = function () {
            $scope.year =  $scope.year - 1;
        };
        $scope.getBondMonth = function () {
            var _month = Math.round(this.month.n, 10);

            $http.get("../monthlist?month=" + _month + "&year=" + $scope.year, {cache: true})
                .success(function (data, status) {
                    if (data.status == 200) {
                        $scope.listInfo =  data.data;
                        $scope.listTotal = data.data.length;
                        isEarn($scope, $filter);
                        reminding($scope, $filter);
                        modelC($scope, {
                            status: "history",
                            modelName: $scope.year  + "." + _month
                        })
                    }
                })
        };
        $scope.toRoute = function (routeName) {
            $scope.personList = false;
            $scope.route = routeName;
        };
        $scope.toPersonList = function () {
            $scope.personList = true;
        };
        $scope.showSearch = function () {
            $scope.fund.isSearch = true;
        };
        $scope.cSeachModel = function (searchType) {
            $scope.fund.isSearch = false;
            $scope.fund.search.status= searchType;
        };
        $scope.getFundType = function () {
            $scope.fund.status = "list";

            $http.get("../test/fundType.json",{
                cache: true
            })
                .success(function (data) {
                    $scope.fund.search.type = $scope.fund.search.type.concat(data);
                });
        };
        $scope.getFundProduce = function () {
            $http.get("../test/fundProduct.json",{
                cache: true
            })
                .success(function (data) {
                    data = data.map(function (value) {
                        value.bondLoading = $filter("fundLoading")(value.bondLoading);
                        return value;
                    });

                    $scope.fund.showList = data;
                });
        }
    }])
    .filter("newWorth", function () {
        return function(input) {
            var _float = parseInt(input);

            if (_float < 1) {
                return true;
            }
        }
    })
    .filter("loading", function () {
        return function (input) {
            var _left, _right, _float;

            _float = (parseFloat(input) / 100) * 360;

            if (_float <= 180) {
                _right = _float;
                _left = 0;
            }else{
                _right = 180;
                _left = _float - 180
            }

            return {
                left: _left,
                right: _right
            }
        }
    })
    .filter("transNumber", function () {
        return function(input) {
           return input/10000;
        }
    })
    .filter("fundLoading", function () {
        return function (input) {
            return parseFloat(input, 10)/100 * 10;
        }
    });
