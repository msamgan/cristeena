<div class="text-center" style="width: 75%; margin: 0 auto;" >
    <?= $this->Flash->render() ?>
</div>
<div class="auth-box ">
    <div class="left">
        <div class="content">
            <div class="header">
                <div class="logo text-center"><img src="/assets/img/logo-dark.png" alt="Klorofil Logo"></div>
                <p class="lead">Login to your account</p>
            </div>
            <form class="form-auth-small" id="login-form">
                <div class="form-group">
                    <label for="signin-email" class="control-label sr-only">Email</label>
                    <input type="email" class="form-control" id="signin-email" placeholder="Email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="signin-password" class="control-label sr-only">Password</label>
                    <input type="password" class="form-control" id="signin-password" placeholder="Password" name="password" required>
                </div>
                <!--<div class="form-group clearfix">
                    <label class="fancy-checkbox element-left">
                        <input type="checkbox">
                        <span>Remember me</span>
                    </label>
                </div>-->
                <button type="submit" class="btn btn-primary btn-lg btn-block">LOGIN</button>
                <div class="bottom">
                    <!--<span class="helper-text"><i class="fa fa-lock"></i> <a href="#">Forgot password?</a></span>-->
                </div>
            </form>
        </div>
    </div>
    <div class="right">
        <div class="overlay"></div>
        <div class="content text">
            <h1 class="heading">Billing System </h1>
            <p>for Microsoft Cloud Service Provider</p>
        </div>
    </div>
    <div class="clearfix"></div>
</div>