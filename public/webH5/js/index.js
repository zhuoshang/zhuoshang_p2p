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
            modelName: "基金详情",
            status: "list",
            search: {
                type: ["全部"],
                status: "全部"
            },
            detailRoute: "base"
        };
        $scope.set = {
            modelName: "更换邮箱",
            status: "index",
            data: {
                email: "123"
            }
        };

        $http.get("../test/userinfo", {
            cache: true
        })
            .success(function (data) {
                if (data.status == 200) {
                    $scope.personInfo = data.data;
                }
            });

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
                    })
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
            var _data;

            $scope.fund.isSearch = false;
            $scope.fund.search.status= searchType;


            if (searchType == "全部") {
                $scope.fund.showList = angular.copy($scope.fund.allData);
                return;
            }

            _data = $scope.fund.allData.filter(function (value) {
                return value.type.match(searchType);
            });

            if (_data[0]){
                $scope.fund.showList = _data;
            }else{
                alert("没有此类型的基金");
            }

        };
        $scope.fundRoute = function (route, name) {
            $scope.fund.status = route;
            $scope.fund.modelName = name;
        };
        $scope.getFundType = function () {
            $http.get("../test/debtTypeList",{
                cache: true
            })
                .success(function (data) {
                    if (data.status == 200) {
                        $scope.fund.search.type = $scope.fund.search.type.concat(data.data.map(function (value) {
                            for (var i in value) {
                                return value[i]
                            }
                        }));
                    }
                });
        };
        $scope.getFundProduce = function () {
            $http.get("../test/debtTable",{
                cache: true
            })
                .success(function (data) {
                    if (data.status == 200) {
                        data = data.data.map(function (value) {
                            value.bondLoading = $filter("fundLoading")(value.bondLoading);
                            for (var i in value.type) {
                                value.type = value.type[i];
                            }
                            return value;
                        });
                        $scope.fund.allData = angular.copy(data);
                        $scope.fund.showList = data;
                    }

                });
        };
        $scope.fundDeatilRoute = function (name) {
            $scope.fund.detailRoute = name;
        };
        $scope.toFundDetailProduct = function () {
            $scope.fund.detailBaseInfo = this.foundPInfo;
            $scope.fund.status = "detail";
            $scope.fund.modelName = "基金详情";
            $http.get("../test/detail",{cache: true})
                .success(function (data) {
                    if (data.status == 200) {
                        var _data = data.data;
                        $scope.fund.voteInfo = _data.voteInfo;
                        $scope.fund.voteHistory = _data.voteHistory;
                        $scope.fund.voteProtect = _data.voteProtect;
                    }
                });
        };
        $scope.getSettingInfo = function () {
           $scope.set.data.userName = $scope.personInfo.userName;
           $scope.set.data.phoneNumber = $scope.personInfo.phoneNumber;
        };
        $scope.setRoute = function (status, modelName) {
            $scope.set.modelName = modelName;
            $scope.set.status = status;
        };
        $scope.sendInfo = function () {
            console.log($scope.set.status);
            console.log($scope.set.data.sendInfo);
        };
        $scope.setEmail = function () {
            $scope.set.data.sendInfo = $scope.set.data.email;
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
