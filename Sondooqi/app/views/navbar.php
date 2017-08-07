
<nav class="navbar navbar-toggleable-md fixed-top navbar-light bg-faded"
	style="background-color: rgba(255, 218, 151, 0.7); border-bottom: 1px solid grey;
    box-shadow: 0px 0px 16px 0px rgba(0,0,0,0.7);">
	<button class="navbar-toggler navbar-toggler-left" type="button" data-toggle="collapse" data-target="#navbar-toggle" aria-controls="navbar-toggle" aria-expanded="false" aria-label="Toggle navigation">
	<span class="navbar-toggler-icon"></span>
	</button>
	<a class="navbar-brand" href="#">
	<img src="<?php echo $GLOBALS['webhost']['base_url']; ?>/app/assets/images/logo-ar.png" height="35" class="d-inline-block align-top" alt="logo-ar">
	</a>
	<div class="collapse navbar-collapse" id="navbar-toggle">
		<ul class="navbar-nav ml-auto mt-2 mt-md-0">
			<li class="nav-item">
				<a class="nav-link" href="<?php echo $GLOBALS['webhost']['base_url']."/home"; ?>">الرئيسية <span class="sr-only">(current)</span></a>
			</li>
			<?php if($this->userIsLoggedIn()) : ?>
				<?php if($this->userIsAdmin()) : ?>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo $GLOBALS['webhost']['base_url']."/admin/dashboard"; ?>">لوحة التحكم</a>
				</li>
				<?php endif; ?>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo $GLOBALS['webhost']['base_url']."/profile/box"; ?>">محتويات صندوقي</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo $GLOBALS['webhost']['base_url']."/profile/address"; ?>">عنوان صندوقي</a>
				</li>
			<?php endif; ?>
			<li class="nav-item">
				<a class="nav-link" href="<?php echo $GLOBALS['webhost']['base_url']."/home#how-it-works"; ?>">كيف نعمل؟</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?php echo $GLOBALS['webhost']['base_url']."/home#contact-us"; ?>">تواصل معنا</a>
			</li>
		</ul>
		<?php if($this->userIsLoggedIn()) : ?>
		<!-- login modal trigger -->
		<button onclick="logout()" type="button" class="btn btn-danger" id="logout-btn">
		تسجيل خروج
		</button>
		<?php else : ?>
		<!-- login modal trigger -->
		<button onclick="showLoginModal();" type="button" class="btn btn-primary" id="login-btn" data-toggle="modal" data-target="#login-modal">
		تسجيل دخول
		</button>
		<?php endif; ?>
	</div>
</nav>

<?php if(!$this->userIsLoggedIn()) : ?>
<!-- Login Modal -->
<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="login-modal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="login-modal">تسجيل دخول</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body text-center">
				<img src="<?php echo $GLOBALS['webhost']['base_url']; ?>/app/assets/images/logo-ar.png" class="login-modal-logo" alt="sondooqi-logo">
				<form class="user-login" method="post">
					<div class="login-form-group">
						<input type="email" class="form-control form-control-lg" value="example@email.com" id="login-email" name="user_email" placeholder="بريدك الإكتروني" tabindex="1" autofocus>
					</div>
					<div class="login-form-group">
						<input type="password" class="form-control form-control-lg" id="login-password" name="user_pass" placeholder="كلمة السر" tabindex="2">
					</div>
					<div class="login-form-group text-center errors-box" dir="ltr" style="color: red">
					</div>
					<div class="login-form-group">
						<button onclick="login(); return false;" class="btn btn-primary form-control form-control-lg" style="color: white; font-family: 'Cairo', sans-serif; font-weight: 600; letter-spacing: 1px; background-color: orange; border: none;">دخــــول</button>
					</div>
				</form>
				<div class="login-form-undertext">
					<small><a onclick="showPasswordResetModal(); return false;" href=" ">نسيت كلمة السر الخاصة بك؟</a></small><br>
					<small>ليس لديك حساب؟<a href="<?php echo $GLOBALS['webhost']['base_url']; ?>/home">  سجل هنا </a></small>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Forgot Password Modal -->
<div class="modal fade" id="forgot-password-modal" tabindex="-1" role="dialog" aria-labelledby="forgot-password-modal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">طلب تغير كلمة السر</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body text-center">
				<form class="forgot-password-form" method="post">
					<div class="form-group">
						<input type="email" class="form-control form-control-lg" id="forgot-password-email" name="user_email" placeholder="بريدك الإكتروني" tabindex="1" autofocus required>
					</div>
					<div class="text-center errors-box" dir="ltr" style="color: red"></div>
					<div class="text-center success-reset-msg" dir="ltr" style="color: green; display: none;">!تم إرسال رسالة إلى بريدك الإلكتروني<br>..ستتم إعادة التحويل خلال ثوان</div><br>
					<div class="form-group">
						<button onclick="resetPassword(); return false;" class="btn btn-danger form-control form-control-lg" style="font-family: 'Cairo', sans-serif; font-weight: 600; letter-spacing: 1px;">طلب التغيير</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>

<?php if($this->userIsLoggedIn()) : ?>
<script type="text/javascript">
function logout(){
    $.post(webhost+"/user/logout")
    .done(function(d){
		var response_json = d;
		if(response_json['goto'] != "")
			window.location = response_json['goto'];
    })
    .fail(function(d){
		alert("Sondooqi: Logout Failed!");   
    });
};
</script>
<?php else : ?>
<script type="text/javascript">
function showLoginModal(){
	$("#login-modal").on('shown.bs.modal', function(){
		$("input#login-email").focus();
	});
};
function showPasswordResetModal(){	
	$("#login-modal").modal('hide');
	$("#forgot-password-modal").modal('show');
}
function resetPassword(){
	var formSelector = "form.forgot-password-form";
    $.post(webhost+"/user/forgotPassword", $(formSelector).serialize())
    .done(function(d){
		$(formSelector+" .errors-box").empty();
        $("div.success-reset-msg").css('display', 'block');
        setTimeout(function(){ 
			var response_json = d;
			if(response_json['goto'] != "");
				window.location = response_json['goto'];
        }, 3000);
    })
    .fail(function(d){
		$(formSelector+" .errors-box").empty();
		var response_json = JSON.parse(d.responseText);
        $.each(response_json['errors'], function(i, v){
			if(i) $(formSelector+" .errors-box").append("<br/>");
            $(formSelector+" .errors-box").append(v);
		});   
	});
};
function login(){
    $.post(webhost+"/user/login", $("form.user-login").serialize())
    .done(function(d){
		$("form.user-login .errors-box").empty();
		var response_json = d;
		if(response_json['goto'] != "");
			window.location = response_json['goto'];
    })
    .fail(function(d){
		$("form.user-login .errors-box").empty();
		var response_json = JSON.parse(d.responseText);
        $.each(response_json['errors'], function(i, v){
			if(i) $("form.user-login .errors-box").append("<br/>");
            $("form.user-login .errors-box").append(v);
		});    
	});
};
</script>
<?php endif; ?>
<style type="text/css">
.nav-item{
  	margin-left: 15px;
	font-family: 'Cairo', sans-serif;
}
#login-btn,
#logout-btn{
	color: green;
	border: 1px solid green;
	border-radius: 50px;
	width: 120px;
	line-height: 0.5;
	height: 35px;
	background-color: rgba(255, 255, 255, 0.4);
	margin: auto 35px auto 20px;
}
#logout-btn{
	border: 2px solid rgba(244, 66, 89, 0.4);
	color: red;
}
#login-btn:hover,
#logout-btn:hover{
	background-color: rgba(255, 255, 255, 0.9);
}
.login-modal-logo{
    width: 40%;
    margin: 15px 0 35px 0;
}
.login-form-group{
    margin: 10px auto 0 auto;
}
.login-form-undertext{
    margin: 15px 0 0 0;
}
</style>