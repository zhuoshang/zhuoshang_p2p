<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta content="yes" name="apple-touch-fullscreen" />
    <meta content="telephone=no,email=no" name="format-detection" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <meta name="viewport" id="viewport" />
    <link rel="stylesheet" href="../css/index.css"/>
    <script>(function(){var b,a,e,c,d;window.dpi=window.devicePixelRatio;d=1/window.dpi;document.getElementById("viewport").setAttribute("content","width=device-width, initial-scale="+d+",maximum-scale="+d+",minimum-scale="+d+", user-scalable=no");window.system=window.navigator.userAgent.match(/iPhone|iPad|Android/);if(window.system){window.system=window.system[0]}window.url_path=window.location.origin;b=document.documentElement;b.setAttribute("dpi",window.dpi);a=b.getBoundingClientRect();c=a.width;e=window.innerHeight;if(e>=c){document.documentElement.style.fontSize=c/16+"px"}else{document.documentElement.style.fontSize=e/16+"px"}}).call(this);</script>
    <script src="../js/bower_components/angular/angular.js"></script>
    <script src="../js/bower_components/angular-touch/angular-touch.js"></script>
    <script src="../js/index.mobile.js"></script>
    <title></title>
</head>
<body ng-app="personFun" ng-controller="funController">
    <section class="person-list" ng-if="personList==true">
        <p class="user-phone">188****5678</p>
        <p class="user-name">王果冻</p>
        <section class="login-info">
            <img src="../images/logo.png" />
            <p class="last-login">上次登陆</p>
            <p class="last-date">2015.01.27 14:55</p>
            <p class="last-location">中国北京</p>
        </section>
        <p class="person-info person-info-first">已投金额(元): <span> 5000.000.00</span></p>
        <p class="person-info">当月投资个数: <span> 5</span></p>
        <p class="person-info">历史投资个数: <span> 24</span></p>
        <p class="route-w-icon" ng-class="{'route-status': route =='assetsList'}" ng-click="toRoute('assetsList')"><i class="iconfont">&#xe607;</i>资产列表</p>
        <p class="route-w-icon" ng-class="{'route-status': route =='fund'}" ng-click="toRoute('fund');getFundType();getFundProduce()"><i class="iconfont">&#xe606;</i>基金</p>
        <p class="route-w-icon"><i class="iconfont">&#xe608;</i>爱心卷狂</p>
        <p class="route-w-icon"><i class="iconfont">&#xe609;</i>贵宾优享</p>
    </section>
    <section class="assets-list" ng-if="route=='assetsList'" ng-class="{'to-personList': personList}">
        <header class="header-fun">
            <nav>
                <i class="iconfont h-i-list" ng-if="assets.funStatus=='list'" ng-click="toPersonList()">&#xe600;</i>
                <i class="iconfont h-i-return" ng-if="assets.funStatus!='list'" ng-click="toList()">&#xe601;</i>
                <span class="h-i-model">{{assets.modelName}}</span>
                <i class="iconfont h-i-time" ng-click="toCalendar()" ng-show="assets.funStatus!='date' && assets.funStatus !='history'">&#xe602;</i>
            </nav>
        </header>
        <section class="content-fun">
            <section class="fun-list" ng-if="assets.funStatus=='list' || assets.funStatus=='history'">
                <div class="list-header" ng-click="cPList()">
                    <i class="iconfont s-l-previous">&#xe603;</i>
                </div>
                <div class="lists-content">
                    <div class="list-rotate-info">
                        <div class="rotate rotate-bond-line">
                            <div class="rotate-left">
                                <div class="rotate-half rotate-left-half rotate-bond-out" ng-style="{'-webkit-transform': 'rotate(' + loadingRotateLeft + 'deg)'}"></div>
                            </div>
                            <div class="rotate-right">
                                <div class="rotate-half rotate-right-half rotate-bond-out" ng-style="{'-webkit-transform': 'rotate(' + loadingRotateRight + 'deg)'}"></div>
                            </div>
                            <div class="c-bond-value">
                                <span class="b-title">债券进度</span>
                                <span class="b-number">{{listInfo[currentList].bondLoading}}<span>%</span></span>
                                <span class="b-leave">{{listInfo[currentList].continuousTime}}天</span>
                            </div>
                        </div>
                        <div class="current-total">
                            <div class="shadow-number">{{currentList}}</div>
                            <div class="c-total">
                                <div class="c-total-left"></div>
                                {{currentList + 1}}
                                <div class="c-total-right"></div>
                            </div>
                            <div class="shadow-number">{{currentList + 2}}</div>
                        </div>
                        <div class="j-box">
                            <div class="rotate rotate-value-line" ng-class="{'rotate-value-line-error': isNetWorth, 'rotate-value-line-earn': !isNetWorth}">
                                <div class="rotate-left">
                                    <div class="rotate-half rotate-left-half rotate-value-out" ng-class="{'rotate-value-error': isNetWorth}"></div>
                                </div>
                                <div class="rotate-right rotate-default">
                                    <div class="rotate-half rotate-right-half rotate-value-out" ng-class="{'rotate-value-error': isNetWorth}"></div>
                                </div>
                            </div>
                            <div class="c-j-value">
                                <span class="j-title">净值</span>
                                <span class="j-number"  ng-class="{'j-number-error': isNetWorth}">{{listInfo[currentList].netWorth}}</span>
                            <span class="j-status" ng-class="{'j-status-error': isNetWorth}">
                                <i class="iconfont j-up">&#xe605;</i>
                            </span>
                            </div>
                        </div>
                    </div>
                    <div class="list-vote-info">
                        博尚鸿鼎风险预备金
                        <b class="l-v-v">{{listInfo[currentList].riskMoney}}</b> 万
                    </div>
                    <div class="list-vote-info">
                        本月投入
                        <b class="l-v-v">{{listInfo[currentList].voteMoney}}</b> 万，
                        获益
                        <b class="l-v-e">{{listInfo[currentList].earnMoney}}</b> 万
                    </div>
                    <div class="list-base-info">
                        <div class="b-i-bond">
                            <span class="b-i-title">债券价值</span>
                        <span class="b-i-value">
                            <b>{{listInfo[currentList].bondValue | transNumber}}</b> 万
                        </span>
                        </div>
                        <div class="b-i-interest">
                            <span class="i-i-title">利息</span>
                          <span class="b-i-value">
                            <b>{{listInfo[currentList].interest}}</b> %
                        </span>
                        </div>
                    </div>
                    <div class="list-base-info">
                        <div class="b-i-trend">
                            <span class="i-t-title">价值走势</span>
                        <span class="i-t-status">
                            <b>{{listInfo[currentList].movements}}</b>
                        </span>
                        </div>
                        <div class="b-i-debt">
                            <span class="i-d-title">还款情况</span>
                          <span class="i-d-value">
                            <b>{{listInfo[currentList].debt}}</b>
                        </span>
                        </div>
                    </div>
                </div>
                <div class="list-footer" ng-click="cNList()">
                    <i class="iconfont s-l-next">&#xe604;</i>
                    <span class="s-l-notify">点击切换下一张债卷</span>
                </div>
            </section>
            <section class="fun-date" ng-if="assets.funStatus=='date'">
                <div class="list-header" ng-click="toLastYear()">
                    <i class="iconfont d-l-previous">&#xe603;</i>
                </div>
                <div class="date-box">
                    <div class="data-year">
                        {{year}}
                    </div>
                    <div class="d-month" ng-repeat="month in monthDate">
                        <div class="month-box" ng-click="getBondMonth()">
                            <span class="d-c">{{month.n}}</span>
                            <span class="d-e">{{month.e}}</span>
                        </div>
                    </div>
                </div>
                <div class="list-footer" ng-click="toNextYear()">
                    <i class="iconfont d-l-next">&#xe604;</i>
                    <span class="s-l-notify">点击切换更多年份</span>
                </div>
            </section>
        </section>
    </section>
    <section class="fund-list" ng-if="route=='fund'" ng-class="{'to-personList': personList}">
        <header class="header-fund">
            <nav>
                <i class="iconfont h-i-list" ng-click="toPersonList()">&#xe600;</i>
                <i class="iconfont h-i-return" ng-if="fund.status !='list'">&#xe601;</i>
                <span class="h-i-model">基金产品</span>
                <i class="i-q">?</i>
            </nav>
        </header>
        <section class="fund-product" ng-if="fund.status == 'list'">
            <section class="search-box" ng-if="fund.isSearch == true">
                <div class="search-model" ng-class="{'search-model-activity': fund.search.status == search}" ng-repeat="search in fund.search.type" ng-click="cSeachModel(search)">
                    <i class="iconfont">&#xe60a;</i> {{search}}
                </div>
            </section>
            <section class="person-money-tittle">
                历史认购总额 <b>500</b> 万 下期认购金额 <b>500</b> 万
                <span class="fun-s" ng-click="showSearch()">{{fund.search.status}}</span>
            </section>
            <div class="fund-product-list" ng-repeat="foundPInfo in fund.showList">
                <header>
                    <span class="f-p-title">{{foundPInfo.title}}</span>
                    <span class="f-p-type">债券投资基金</span>
                </header>
                <div class="f-p-is">
                    <div class="f-p-i">
                        <b>{{foundPInfo.newWorth}}</b>
                        <span>基金净值</span>
                    </div>
                    <div class="f-p-i">
                        <b>{{foundPInfo.interest}} <i>%</i></b>
                        <span>基金利息</span>
                    </div>
                    <div class="f-p-i">
                        <b>{{foundPInfo.boundValue}} <span>万</span></b>
                        <span>基金净值</span>
                    </div>
                    <div class="f-p-i f-p-ic">
                        <i class="iconfont i-d">&#xe60b;</i>
                    </div>
                </div>
                <div class="f-p-b">
                    <div class="f-p-bl">
                        <div class="f-p-b-loading" ng-style="{width: foundPInfo.bondLoading + 'rem'}"></div>
                        <div class="f-p-b-text">{{foundPInfo.bondLoading * 10}}%</div>
                    </div>
                    <div class="f-p-s" ng-if="foundPInfo.status == 1">置顶</div>
                    <div class="f-p-s f-p-s-c"  ng-if="foundPInfo.status == 0">推荐</div>
                </div>
            </div>
        </section>
    </section>
</body>
</html>