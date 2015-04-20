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
    <i class="iconfont i-setting" ng-class="{'route-status': route =='setting'}" ng-click="toRoute('setting');getEmail()">&#xe60c;</i>
    <p class="user-phone">{{personInfo.phoneNumber}}</p>
    <p class="user-name">{{personInfo.userName}}</p>
    <section class="login-info">
        <img src="../images/logo.png" ng-click="toRoute('person')"/>
        <p class="last-login">上次登陆</p>
        <p class="last-date">{{personInfo.lastDate}}</p>
        <p class="last-location">{{personInfo.location}}</p>
    </section>
    <p class="person-info person-info-first">已投金额(元): <span> {{personInfo.hasVote}}</span></p>
    <p class="person-info">当月投资个数: <span> {{personInfo.voteNumbers}}</span></p>
    <p class="person-info">历史投资个数: <span> {{personInfo.voteNumberHistory}}</span></p>
    <p class="route-w-icon" ng-class="{'route-status': route =='assetsList'}" ng-click="toRoute('assetsList')"><i class="iconfont">&#xe607;</i>资产列表</p>
    <p class="route-w-icon" ng-class="{'route-status': route =='fund'}" ng-click="toRoute('fund');getFundType();getFundProduce();fundRoute('list', '基金产品')"><i class="iconfont">&#xe606;</i>基金</p>
    <p class="route-w-icon" ng-class="{'route-status': route =='love'}" ng-click="toRoute('love');honouredAndLoveRoute('index', '爱心捐款');getLoveAndHonouredData('love')"><i class="iconfont">&#xe608;</i>爱心捐款</p>
    <p class="route-w-icon" ng-class="{'route-status': route =='honoured'}" ng-click="toRoute('honoured');honouredAndLoveRoute('index', '贵宾优享');getLoveAndHonouredData('honoured')"><i class="iconfont">&#xe609;</i>贵宾优享</p>
</section>
<section class="love-and-honoured" ng-if="route == 'love' || route == 'honoured'" ng-class="{'to-personList': personList}">
    <header class="header-fun" ng-if="honouredAndLove.status != 'pay'">
        <nav>
            <i class="iconfont h-i-list" ng-if="honouredAndLove.status =='index'" ng-click="toPersonList()">&#xe600;</i>
            <i class="iconfont h-i-return" ng-if="honouredAndLove.status !='index'" ng-click="honouredAndLoveRouteBack('index')">&#xe601;</i>
            <span class="h-i-model">{{honouredAndLove.modelName}}</span>
            <span class="wfz30" ng-click="honouredAndLoveRoute('detail', '明细')" ng-if="honouredAndLove.status == 'index'">明细</span>
        </nav>
    </header>
    <section class="love-and-honoured-index" ng-if="honouredAndLove.status == 'index'">
        <div class="l-h-i-box" ng-repeat="showData in honouredAndLove.showData.index">
            <div class="l-h-i-img-todo">
                <img ng-src="{{showData.pic}}" />
                <span class="todo">{{showData.title}}</span>
            </div>
            <div class="l-h-i-l-info">
                <div class="i-left">
                    <p class="i-l-f">捐助时间: <span ng-class="{'i-activity': showData.status == 1, 'i-no-activity': showData.status == 0}">2014.01.30 - 2015.03.30</span></p>
                    <p class="i-l-s">
                        <span>
                            <i class="iconfont">&#xe615;</i> {{showData.clicks}}
                        </span>
                        <span>
                            <i class="iconfont">&#xe616;</i> {{showData.words}}
                        </span>
                        <span>
                            <i class="iconfont">&#xe614;</i> {{showData.pics}}
                        </span>
                    </p>
                </div>
                <div class="i-right i-notify-activity" ng-class="{'i-notify-activity': showData.status == 1, 'i-no-notify-activity': showData.status == 0}">
                    进行中
                </div>
            </div>
        </div>
       <!-- <div class="l-h-i-box">
            <div class="l-h-i-img-todo">
                <img src="#" />
                <span class="todo">给给给给</span>
            </div>
            <div class="l-h-i-l-info">
                <div class="i-left">
                    <p class="i-l-f">捐助时间: <span class="i-no-activity">2014.01.30 - 2015.03.30</span></p>
                    <p class="i-l-s">
                        <span>
                            <i class="iconfont">&#xe615;</i> 1024
                        </span>
                        <span>
                            <i class="iconfont">&#xe616;</i> 1024
                        </span>
                        <span>
                            <i class="iconfont">&#xe614;</i> 1024
                        </span>
                    </p>
                </div>
                <div class="i-right i-no-notify-activity">
                    已结束
                </div>
            </div>
        </div>-->
    </section>
    <section class="love-and-honoured-detail" ng-if="honouredAndLove.status == 'detail'">
        <header>435345345</header>
        <table>
            <thead>
            <tr>
                <td>序号</td>
                <td>捐款者</td>
                <td>捐款方式</td>
                <td>捐款金额
                    (元)</td>
                <td>制单日期</td>
                <td>备注</td>
            </tr>
            </thead>
        </table>
    </section>
    <section class="love-and-honoured-exercise" ng-if="honouredAndLove.status == 'exercise'">
        <header>
            <h1 class="exercise-title">1212</h1>
            <p class="exercise-time">
                捐助时间: <b class="active">2015-</b>
            </p>
            <p class="exercise-info">
                <span>
                    <i class="iconfont">&#xe615;</i> 1024
                </span>
                <span>
                    <i class="iconfont">&#xe616;</i> 1024
                </span>
                <span>
                    <i class="iconfont">&#xe614;</i> 1024
                </span>
            </p>
        </header>
        <img src="../images/about-logo.png" class="exercise-cover" />
        <div class="exercise-content">
            2313123
        </div>
        <footer class="f-d-c f-d-c-a" ng-click="honouredAndLoveRoute('pay', '付款页面')">我要捐款</footer>
    </section>
    <section class="section-pay" ng-if="honouredAndLove.status =='pay'">
        <i class="iconfont h-i-return"  ng-click="honouredAndLoveRouteBack('exercise')">&#xe601;</i>
        <div class="logo-pay-get"></div>
        <form class="form-pay" novalidate name="pForm">
            <div class="g-notify">
                <span class="s-left">支付方式</span>
                <span class="s-right">默认线下支付</span>
            </div>
            <label for="d-money">
                <input type="text" id="d-money" name="dMoney" placeholder="请输入支付金额" ng-model="person.payMonery" />
            </label>
            <label for="p-verify">
                <input type="text" id="d-verify" class="d-verify" name="dVerify" placeholder="验证码" required />
            </label>
            <div class="pp-verify">
                点击获取
            </div>
            <input type="submit" class="p-sure" value="确定" />
        </form>
    </section>
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
        <section class="fun-list" ng-if="assets.funStatus=='list'" ng-click="test()">
            <div class="list-header" myclick="cPList()">
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
            <div class="list-footer" myclick="cNList()">
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
    <header class="header-fund" ng-if="fund.status != 'pay'">
        <nav>
            <i class="iconfont h-i-list" ng-click="toPersonList()" ng-if="fund.status == 'list'">&#xe600;</i>
            <i class="iconfont h-i-return" ng-if="fund.status !='list'" ng-click="fundRoute('list', '基金产品')">&#xe601;</i>
            <span class="h-i-model">{{fund.modelName}}</span>
            <i class="i-q" ng-if="fund.status == 'list'" ng-click="fundRoute('introduce', '公司介绍')">?</i>
        </nav>
    </header>
    <section class="fund-product-detail" ng-if="fund.status == 'detail'">
        <div class="fund-product-list">
            <header>
                <span class="f-p-title">{{fund.detailBaseInfo.title}}</span>
                <span class="f-p-type">{{fund.detailBaseInfo.type}}</span>
            </header>
            <div class="f-p-is">
                <div class="f-p-i">
                    <b>{{fund.detailBaseInfo.newWorth}}</b>
                    <span>基金净值</span>
                </div>
                <div class="f-p-i">
                    <b>{{fund.detailBaseInfo.interest}} <i>%</i></b>
                    <span>基金利息</span>
                </div>
                <div class="f-p-i">
                    <b>{{fund.detailBaseInfo.boundValue | transNumber }} <span>万</span></b>
                    <span>基金净值</span>
                </div>
                <div class="f-p-i f-p-ic">
                    <i class="iconfont i-d">&#xe60b;</i>
                </div>
            </div>
            <div class="f-p-b">
                <div class="f-p-bl">
                    <div class="f-p-b-loading" ng-style="{width: fund.detailBaseInfo.bondLoading + 'rem'}"></div>
                    <div class="f-p-b-text">{{fund.detailBaseInfo.bondLoading * 10}}%</div>
                </div>
                <div class="f-p-s" ng-if="fund.detailBaseInfo.status == 1">置顶</div>
                <div class="f-p-s f-p-s-c"  ng-if="fund.detailBaseInfo.status == 0">推荐</div>
            </div>
        </div>
        <section class="f-d">
            <header class="f-d-h">
                <span ng-click="fundDeatilRoute('base')" ng-class="{'f-d-a': fund.detailRoute == 'base'}">基本信息</span>
                <span ng-click="fundDeatilRoute('protect')" ng-class="{'f-d-a': fund.detailRoute == 'protect'}">债券保障</span>
                <span ng-click="fundDeatilRoute('history')" ng-class="{'f-d-a': fund.detailRoute == 'history'}">投资纪录</span>
            </header>
            <section class="f-d-base" ng-if="fund.detailRoute == 'base'">
                <img ng-src="{{imgsrc}}" ng-repeat="imgsrc in fund.voteInfo.img"/>
                <p>{{fund.voteInfo.text}}</p>
            </section>
            <section class="f-d-product" ng-if="fund.detailRoute == 'protect'">
                <img ng-src="{{fund.voteProtect}}"/>
            </section>
            <section class="f-d-history" ng-if="fund.detailRoute == 'history'">
                <div ng-repeat="voteHistory in fund.voteHistory">
                    <span class="h-user">{{voteHistory.userName}}</span>
                    <span class="h-money">{{voteHistory.voteMoney}}</span>
                    <span class="h-date">{{voteHistory.date}}</span>
                </div>
            </section>
        </section>
        <footer class="f-d-c" ng-class="{'f-d-c-a': fund.allowVote == 1, 'f-d-c-na': fund.allowVote == 0}" ng-click="voteFund(fund)">我要投资</footer>
    </section>
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
        <div class="fund-product-list" ng-repeat="foundPInfo in fund.showList" ng-click="toFundDetailProduct()">
            <header>
                <span class="f-p-title">{{foundPInfo.title}}</span>
                <span class="f-p-type">{{foundPInfo.type}}</span>
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
                    <b>{{foundPInfo.boundValue | transNumber }} <span>万</span></b>
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
    <section class="fund-introduce" ng-if="fund.status == 'introduce'">
        1231231
    </section>
    <section class="fund-pay" ng-if="fund.status == 'pay'">
        <i class="iconfont h-i-return f-i-reutrn" ng-click="fundRoute('detail', '基金详情')">&#xe601;</i>
        <div class="logo-pay-get"></div>
        <form class="form-get" novalidate name="f-p-form">
            <div class="g-notify">
                <span class="s-left">支付方式</span>
                <span class="s-right">默认线下支付</span>
            </div>
            <label for="f-money">
                <input type="text" id="f-money" name="fMoney" placeholder="请输入提现金额" ng-model="person.getMoney" required />
            </label>
            <label for="f-verify">
                <input type="text" id="f-verify" class="f-verify" name="fVerify" placeholder="验证码" required />
            </label>
            <div class="gg-verify">
                点击获取
            </div>
            <input type="submit" class="g-sure" value="确定" ng-click="fundPay(f-p-form)" />
        </form>
    </section>
</section>
<section class="set-list" ng-if="route=='setting'"  ng-class="{'to-personList': personList}">
    <header class="header-set">
        <nav>
            <i class="iconfont h-i-list" ng-if="set.status == 'index'" ng-click="toPersonList()">&#xe600;</i>
            <i class="iconfont h-i-return" ng-if="set.status !='index' && set.status !='second'" ng-click="setRoute('index', '设置')">&#xe601;</i>
            <i class="iconfont h-i-return" ng-if="set.status =='second'" ng-click="setRoute('about', '关于我们')">&#xe601;</i>
            <span class="h-i-model">{{set.modelName}}</span>
            <span class="h-i-submit" ng-click="sendInfo()" ng-if="set.status =='suggest' || set.status == 'email'">确认</span>
        </nav>
    </header>
    <section class="set-index" ng-if="set.status =='index'">
        <section class="s-info">
            <div class="s-user">
                <i class="iconfont i-user">&#xe612;</i>
                <span>用户名</span>
                <span class="info">{{personInfo.userName}}</span>
            </div>
            <div class="s-phone">
                <i class="iconfont i-phone">&#xe611;</i>
                <span>手机号码</span>
                <span class="info">{{personInfo.phoneNumber}}</span>
            </div>
            <div class="s-mail" ng-click="setRoute('email', '更换邮箱');setEmail()">
                <i class="iconfont i-mail">&#xe60f;</i>
                <span>邮箱</span>
            <span class="info">{{set.data.email}}
                <i class="iconfont">&#xe613;</i>
            </span>
            </div>
        </section>
        <section class="s-pay">
            <div class="s-out">
                <i class="iconfont i-out">&#xe610;</i>
                <span>默认支付方式</span>
                <span class="info">线下支付</span>
            </div>
            <div class="s-get">
                <i class="iconfont i-in">&#xe610;</i>
                <span>默认提现方式</span>
                <span class="info">线下提现</span>
            </div>
        </section>
        <section class="s-su">
            <div class="s-suggest" ng-click="setRoute('suggest', '意见反馈')">
                <i class="iconfont i-suggest">&#xe60e;</i>
                <span>意见反馈</span>
            <span class="info">
                  <i class="iconfont">&#xe613;</i>
            </span>
            </div>
            <div class="s-about" ng-click="setRoute('about', '关于我们')">
                <i class="iconfont i-about">&#xe60d;</i>
                <span>关于我们</span>
                <span class="info">
                      <i class="iconfont">&#xe613;</i>
                </span>
            </div>
        </section>
        <form action="../logout">
            <section>
                <input type="submit" value="退出登录" class="s-exit" />
            </section>
        </form>
    </section>
    <section class="set-suggest" ng-if="set.status == 'suggest'">
        <textarea name="suggest" placeholder="博尚鸿鼎团队正在真正仔细的聆听您的意
见哦..." id="suggest" ng-model="set.data.sendInfo" required></textarea>
    </section>
    <section class="set-email" ng-if="set.status == 'email'">
        <div class="c-email">
            <label for="set-email">输入邮箱
                <input id="set-email" type="text" ng-model="set.data.sendInfo" />
            </label>
        </div>
    </section>
    <section class="set-about" ng-if="set.status == 'about'">
        <img src="../images/about-logo.png" class="about-logo" />
        <section class="s-us">
            <div class="s-welcome">
                <span>欢迎页</span>
                   <span class="info">
                      <i class="iconfont">&#xe613;</i>
                </span>
            </div>
            <div class="s-deal" ng-click="setRoute('second', '用户协议');getSecondInfo('用户协议')">
                <span>用户协议</span>
                   <span class="info">
                      <i class="iconfont">&#xe613;</i>
                </span>
            </div>
            <div class="s-com" ng-click="setRoute('second', '公司介绍');getSecondInfo('公司介绍')">
                <span>介绍博尚鸿鼎公司</span>
                   <span class="info">
                      <i class="iconfont">&#xe613;</i>
                </span>
            </div>
        </section>
        <p class="s-phone-title">客户电话(按照当地市话标准收费)</p>
        <a class="s-p" href="tel:1-408-555-5555">1-408-555-5555</a>
    </section>
    <section class="set-about-second" ng-if="set.status == 'second'">
        {{set.data.secondData}}
    </section>
</section>
<section class="person-pay" ng-if="route=='person'">
    <i class="iconfont h-i-return" ng-if="person.status =='index'" ng-click="backLastStatus()">&#xe601;</i>
    <i class="iconfont h-i-return" ng-if="person.status !='index'" ng-click="payRoute('index')">&#xe601;</i>
    <section class="person-list-big" ng-if="person.status =='index'">
        <img src="../images/logo.png" class="logo" />
        <form>
            <input type="submit" value="退出登陆" class="exit"/>
        </form>
        <img src=../images/logo.png class="person-img" />
        <p class="p-user-name">{{personInfo.userName}}</p>
        <p class="p-user-vote">
            已投金额: <b>{{personInfo.hasVote}}</b>元
        </p>
        <p class="p-user-location">
            上次登陆: <b>{{personInfo.lastDate}} {{personInfo.location}}</b>
        </p>
        <div class="blur">
            <div class="pay" ng-click="payRoute('pay')">
                <i class="iconfont pay-out">&#xe610;</i>
                <span>充 值</span>
            </div>
            <div class="get" ng-click="payRoute('get')">
                <i class="iconfont get-in">&#xe610;</i>
                <span>提 现</span>
            </div>
        </div>
    </section>
    <section class="section-pay" ng-if="person.status =='pay'">
        <div class="logo-pay-get"></div>
        <form class="form-pay" novalidate name="pForm">
            <div class="g-notify">
                <span class="s-left">支付方式</span>
                <span class="s-right">默认线下支付</span>
            </div>
            <label for="p-money">
                <input type="text" id="p-money" name="pMoney" placeholder="请输入支付金额" ng-model="person.payMoney" />
            </label>
            <label for="p-verify">
                <input type="text" id="p-verify" class="p-verify" name="pVerify" placeholder="验证码" required />
            </label>
            <div class="pp-verify">
                点击获取
            </div>
            <input type="submit" class="p-sure" value="确定" ng-click="payMoney(pForm)" />
        </form>
    </section>
    <section class="section-get" ng-if="person.status =='get'">
        <div class="logo-pay-get"></div>
        <form class="form-get" novalidate name="gForm">
            <div class="g-notify">
                <span class="s-left">提现方式</span>
                <span class="s-right">默认线下提现</span>
            </div>
            <label for="g-money">
                <input type="text" id="g-money" name="gMoney" placeholder="请输入提现金额" ng-model="person.getMoney" required />
            </label>
            <label for="g-verify">
                <input type="text" id="g-verify" class="g-verify" name="gVerify" placeholder="验证码" required />
            </label>
            <div class="gg-verify">
                点击获取
            </div>
            <input type="submit" class="g-sure" value="确定" ng-click="getMoney(gForm)" />
        </form>
    </section>
</section>
</body>
</html>