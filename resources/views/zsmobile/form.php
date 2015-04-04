<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta content="yes" name="apple-touch-fullscreen" />
    <meta content="telephone=no,email=no" name="format-detection" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <meta name="viewport" id="viewport" />
    <link rel="stylesheet" href="../css/form.css"/>
    <script>(function(){var b,a,e,c,d;window.dpi=window.devicePixelRatio;d=1/window.dpi;document.getElementById("viewport").setAttribute("content","width=device-width, initial-scale="+d+",maximum-scale="+d+",minimum-scale="+d+", user-scalable=no");window.system=window.navigator.userAgent.match(/iPhone|iPad|Android/);if(window.system){window.system=window.system[0]}window.url_path=window.location.origin;b=document.documentElement;b.setAttribute("dpi",window.dpi);a=b.getBoundingClientRect();c=a.width;e=window.innerHeight;if(e>=c){document.documentElement.style.fontSize=c/16+"px"}else{document.documentElement.style.fontSize=e/16+"px"}}).call(this);</script>
    <script src="../js/bower_components/angular/angular.js"></script>
    <script src="../js/bower_components/angular-touch/angular-touch.js"></script>
    <script src="../js/form.mobile.js"></script>
    <title></title>
</head>
<body ng-app="loginAndRegister" ng-controller="CLR">
    <div class="logo"></div>
    <i class="iconfont t-i" ng-click="toInit()" ng-if="where!='init'">&#xe601;</i>
    <section class="c-l-or-r" ng-if="where=='init'">
        <div class="c-login" ng-click="toLogin()">
            <span>登陆</span>
        </div>
        <div class="c-register" ng-click="toRegister()">
            注册账号?
        </div>
    </section>
    <section class="m-login" ng-if="where=='login'">
        <form class="login-form" novalidate name="login">
            <label for="l-user">
                <input type="text" id="l-user" name="lUser" placeholder="请输入您的手机号" ng-focus="setUnTouched(login.lUser)" ng-model="user.phoneNumber" required ng-maxlength="11" ng-minlength="11" />
            </label>
            <label for="l-password">
                <input type="password" id="l-password" name="lPassword" placeholder="请输入8～16位密码" ng-focus="setUnTouched(login.lPassword)" ng-model="user.password" required ng-minlength="8" ng-maxlength="16" />
            </label>
            <div class="f-password">
                忘记密码
            </div>
            <div class="r-password">
                <label for="r-password">
                    <input type="checkbox" id="r-password" class="r-password-i" name="r-password" ng-model="user.rPassword" />
                    记住密码
                </label>
            </div>
            <input type="submit" class="m-login-t" value="登陆" ng-click="sLogin(login)" />
        </form>
    </section>
    <section class="m-register" ng-if="where=='register'">
        <form class="register-form" name="register" ng-style="{'top':  formTop + 'rem'}" novalidate>
            <label for="r-user">
                <input type="text" id="r-user" name="rUser" placeholder="请输入您的手机号"  ng-focus="setUnTouched(register.rUser)" ng-model="user.phoneNumber" required ng-maxlength="11" ng-minlength="11" />
            </label>
            <label for="rr-password">
                <input type="password" id="rr-password" name="rPassword" placeholder="请输入8～16位密码" ng-focus="setUnTouched(register.rPassword)" ng-model="user.password" required ng-minlength="8" ng-maxlength="16"/>
            </label>
            <label for="rr-verify">
                <input type="text" id="rr-verify" class="rr-verify"  ng-model="user.registerNumber" name="rVerify" placeholder="验证码" ng-focus="setUnTouched(register.rVerify)" required />
            </label>
            <div class="g-verify">
                点击获取
            </div>
            <input type="submit" class="m-register-t" value="注册" ng-click="sRegister(register)" />
        </form>
    </section>
</body>
</html>