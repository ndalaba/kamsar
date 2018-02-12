<style>
    .clearfix{*zoom:1}.clearfix:before,.clearfix:after{display:table;content:"";line-height:0}.clearfix:after{clear:both}.login{background-color:#f9f9f9;padding-top:60px}.login .logo,.login .single-sign-on,.login .footer{margin:0 auto;text-align:center}.login .logo{padding:15px;font-size:23px}.login .box{background-color:#fff;width:350px;margin:0 auto;border:1px solid #d9d9d9;border-top:5px solid #4d7496}.login .box .content{padding:30px;padding-top:10px;padding-bottom:15px}.login .box form{padding:0;margin:0}.login .box .form-title{text-align:center;font-weight:300;margin-bottom:25px}.login .box .form-group{margin:0;padding:0;margin-bottom:15px}.login .box .form-actions{background-color:#fff;border-top:0;padding:10px 0;margin:0}.login .box .input-icon{position:relative}.login .box .input-icon input{border-left:2px solid #4d7496}.login .box .has-error .input-icon input{border-left-color:#b94a48}.login .box .has-success .input-icon input{border-left-color:#468847}.login .box .checkbox{margin-top:7px}.login .box .inner-box{background-color:#f9f9f9;border-top:1px solid #c0c0c0;-webkit-box-shadow:0 1px 1px rgba(0,0,0,0.05) inset;-moz-box-shadow:0 1px 1px rgba(0,0,0,0.05) inset;box-shadow:0 1px 1px rgba(0,0,0,0.05) inset}.login .box .inner-box .content{padding:12px 30px;text-align:center}.login .box .inner-box a{color:#555;font-size:12px;font-weight:600}.login .box .inner-box a:hover{text-decoration:none;color:#4d7496}.login .box .inner-box .close{font-size:12px;margin-top:-3px;margin-right:-20px}.login .box .inner-box .close.hide-default{display:none}.login .box .inner-box form{margin-top:10px;margin-bottom:10px}.login .box .inner-box a+form{margin-top:20px}.login .box .inner-box .form-group{margin-bottom:10px}.login .box .inner-box .forgot-password-done{padding:10px 0}.login .box .inner-box .forgot-password-done .success-icon,.login .box .inner-box .forgot-password-done .danger-icon{display:block;font-size:30px;padding:15px;padding-top:0}.login .box .inner-box .forgot-password-done .success-icon{color:#94b86e}.login .box .inner-box .forgot-password-done .danger-icon{color:#e25856}.login .box .inner-box .forgot-password-done span{font-weight:600}.login .single-sign-on{width:350px;padding:15px 0;opacity:.5;-webkit-transition:opacity 200ms ease-out;-moz-transition:opacity 200ms ease-out;-o-transition:opacity 200ms ease-out;transition:opacity 200ms ease-out}.login .single-sign-on:hover{opacity:1}.login .single-sign-on span{text-transform:uppercase;font-weight:600;margin-bottom:15px;display:block;color:#888}.login .single-sign-on .btn i{padding-right:5px}.login .footer{width:350px;padding-top:30px}.login .footer a{font-size:13px;color:#6f6f6f}.login .footer a:hover{text-decoration:none;color:#4d7496}.login .spacing-top{padding-top:7px!important}
</style>
<div class="logo"> <img width="29" src="<?php echo Uri::create('assets/img/logo-afrimarine.png') ?>" alt="logo"> <strong>AFRI</strong>MARINE </div>
<div class="box">
    <div class="content">
        <form class="form-vertical login-form" action="<?php echo Uri::create('user/login') ?>" method="post">
            <h3 class="form-title">Connexion</h3> 
            <?php if (isset($error)): ?>
                <div class="alert fade in alert-danger"> 
                    <i class="icon-remove close" data-dismiss="alert"></i> Login ou mot de passe incorrect! 
                </div>
            <?php endif; ?>
            <div class="form-group">
                <div class="input-icon"> <i class="icon-user"></i> 
                    <input type="text" name="login" class="form-control" placeholder="Login" autofocus="autofocus" required autocomplete="off"/>
                </div>
            </div>
            <div class="form-group">
                <div class="input-icon"> <i class="icon-lock"></i> 
                    <input type="password" name="pwd" class="form-control" placeholder="Mot de passe" required required autocomplete="off"/>
                </div>
            </div>
            <div class="form-actions">           
                <button type="submit" class="submit btn btn-primary pull-right"> Envoyer <i class="icon-angle-right"></i> </button> 
            </div>
        </form>
    </div>  
</div>