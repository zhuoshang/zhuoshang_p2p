<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta content="yes" name="apple-touch-fullscreen" />
    <meta content="telephone=no,email=no" name="format-detection" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <meta name="viewport" id="viewport" />
    <link rel="stylesheet" href="css/index.css"/>
    <script>(function(){var b,a,e,c,d;window.dpi=window.devicePixelRatio;d=1/window.dpi;document.getElementById("viewport").setAttribute("content","width=device-width, initial-scale="+d+",maximum-scale="+d+",minimum-scale="+d+", user-scalable=no");window.system=window.navigator.userAgent.match(/iPhone|iPad|Android/);if(window.system){window.system=window.system[0]}window.url_path=window.location.origin;b=document.documentElement;b.setAttribute("dpi",window.dpi);a=b.getBoundingClientRect();c=a.width;e=window.innerHeight;if(e>=c){document.documentElement.style.fontSize=c/16+"px"}else{document.documentElement.style.fontSize=e/16+"px"}}).call(this);</script>
    <script src="js/bower_components/angular/angular.js"></script>
    <script src="js/bower_components/angular-touch/angular-touch.js"></script>
    <script src="js/index.mobile.js"></script>
    <title></title>
</head>
<body ng-app="personFun" ng-controller="funController">
    <header class="header-fun">
        <nav>
            <i class="iconfont h-i-list" ng-if="funStatus=='list'">&#xe600;</i>
            <i class="iconfont h-i-return" ng-if="funStatus!='list'" ng-click="toList()">&#xe601;</i>
            <span class="h-i-model">{{modelName}}</span>
            <i class="iconfont h-i-time" ng-click="toCalendar()" ng-show="funStatus!='date' && funStatus !='history'">&#xe602;</i>
        </nav>
    </header>
    <section class="content-fun">
        <section class="fun-list" ng-if="funStatus=='list' || funStatus=='history'">
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
        <section class="fun-date" ng-if="funStatus=='date'">
            <div class="list-header" ng-click="toLastYear()">
                <i class="iconfont d-l-previous">&#xe603;</i>
            </div>
            <div class="list-footer" ng-click="toNextYear()">
                <i class="iconfont d-l-next">&#xe604;</i>
                <span class="s-l-notify">点击切换更多年份</span>
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
        </section>
    </section>
</body>
</html>