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
    .directive("myclick", function() {

        return function(scope, element, attrs) {

            element.bind('touchstart click', function(event) {

                event.preventDefault();
                event.stopPropagation();

                scope.$apply(attrs['myclick']);
            });
        };
    })
    .controller("funController", ["$scope", "$http", "$filter", function ($scope, $http, $filter) {
        $scope.currentList = 0;
        $scope.year = new Date().getFullYear();
        $scope.route = "assetsList";
        $scope.historyRoute = "assetsList";
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
            modelName: "设置",
            status: "index",
            data: {}
        };
        $scope.person = {
            status: "index"
        };
        $scope.honouredAndLove = {
            status: "exercise",
            modelName: "活动详情"
        };

        $scope.honouredAndLoveRoute = function (status, modelName) {
            $scope.honouredAndLove.historyModelName = $scope.honouredAndLove.modelName;
            $scope.honouredAndLove.status = status;
            $scope.honouredAndLove.modelName = modelName;
        };
        $scope.honouredAndLoveRouteBack = function (status) {
            $scope.honouredAndLove.status = status;
            $scope.honouredAndLove.modelName = $scope.honouredAndLove.historyModelName;
        };

        $http.get("../userinfo", {
            cache: true
        })
            .success(function (data) {
                if (data.status == 200) {
                    $scope.personInfo = data.data;
                }
            });

        $http.get("../list", {
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
            };
            $scope.currentList = $scope.currentList + 1;
            isEarn($scope, $filter);
            reminding($scope, $filter);
        };

        $scope.cPList = function () {
            if ($scope.currentList == 0) {
                alert("没有更多债券了");
                return;
            };
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

            $http.get("../test/monthlist?month=" + _month + "&year=" + $scope.year, {cache: true})
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

            if (routeName != "person") {
                $scope.historyRoute = $scope.route;
            }
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
            $http.get("../debtTypeList",{
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
            $http.get("../debtTable",{
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
            var _id = this.foundPInfo.id;
            console.log(this.foundPInfo);
            $scope.fund.detailBaseInfo = this.foundPInfo;
            $scope.fund.status = "detail";
            $scope.fund.modelName = "基金详情";


            $http.get("../debtContent?id=" + _id, {cache: true})
                .success(function (data) {
                    if (data.status == 200) {
                        var _data = data.data;
                        console.log(_data);
                        $scope.fund.voteInfo = _data.voteInfo;
                        $scope.fund.voteHistory = _data.voteHistory;
                        $scope.fund.voteProtect = _data.voteProtect;
                        $scope.fund.allowVote = _data.allowVote;
                        $scope.fund._id = _id;
                    }
                });
        };
        $scope.setRoute = function (status, modelName) {
            $scope.set.modelName = modelName;
            $scope.set.status = status;
        };
        $scope.sendInfo = function () {
            if ($scope.set.status == "email") {
                $http.post("../email", {
                    email: $scope.set.data.sendInfo
                }).success(function (data) {
                    if (data.status == 200) {
                        alert("修改成功");
                        $scope.set.data.email = $scope.set.data.sendInfo;
                    }
                });
            };

            if ($scope.set.status == "suggest") {
                $http.post("../message", {
                    message: $scope.set.data.sendInfo
                }).success(function (data) {
                    if (data.status == 200) {
                        alert("建议提交成功");
                        $scope.set.data.sendInfo = "";
                    }
                });
            }
            console.log($scope.set.data.sendInfo);
        };
        $scope.setEmail = function () {
            $scope.set.data.sendInfo = $scope.set.data.email;
        };
        $scope.getSecondInfo = function (name) {
            $scope.set.data.secondData = name;
        };
        $scope.backLastStatus = function () {
            $scope.personList = true;
            $scope.route = $scope.historyRoute;
        };
        $scope.payRoute = function (name) {
            $scope.person.status = name;
        };
        $scope.getMoney = function (form) {
            console.log(form);
        };
        $scope.payMoney = function (form) {
            console.log(form);
        };
        $scope.voteFund = function (fund) {
            if (fund.allowVote == 1) {
                $scope.fund.status = "pay";
            }
        };
        $scope.getEmail = function () {
            $http.get("../email").
                success(function (data) {
                    if (data.status == 200) {
                        console.log(data.data);
                        $scope.set.data.email = data.data;
                    }
                });
        };
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
