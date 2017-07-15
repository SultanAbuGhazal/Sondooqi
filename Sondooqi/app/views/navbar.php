
<nav class="navbar navbar-toggleable-md navbar-light bg-faded"
	style="background-color: #f5f5f5 ; border-bottom: 4px solid black">
	<button class="navbar-toggler navbar-toggler-left" type="button" data-toggle="collapse" data-target="#navbar-toggle" aria-controls="navbar-toggle" aria-expanded="false" aria-label="Toggle navigation">
	<span class="navbar-toggler-icon"></span>
	</button>
	<a class="navbar-brand" href="#">
	<img src="<?php echo $GLOBALS['webhost']['base_url']; ?>/app/assets/images/logo-ar.png" height="35" class="d-inline-block align-top" alt="logo-ar">
	</a>
	<div class="collapse navbar-collapse" id="navbar-toggle">
		<ul class="navbar-nav ml-auto mt-2 mt-md-0">
			<li class="nav-item">
				<a class="nav-link" href="#">الرئيسية <span class="sr-only">(current)</span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">كيف نعمل؟</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">تواصل معنا</a>
			</li>
		</ul>
		<!-- login modal trigger -->
		<button type="button" class="btn btn-primary" id="login-btn" data-toggle="modal" data-target="#login-modal">
		تسجيل دخول
		</button>
	</div>
</nav>


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
						<input type="email" class="form-control form-control-lg" value="example@email.com" id="login-email" name="user_email" placeholder="بريدك الإكتروني">
					</div>
					<div class="login-form-group">
						<input type="password" class="form-control form-control-lg" id="login-password" name="user_pass" placeholder="كلمة السر">
					</div>
					<div class="login-form-group text-center errors-box" dir="ltr" style="color: red">
					</div>
				</form>
				<div class="login-form-group">
					<button onclick="login()" class="btn btn-primary form-control form-control-lg">دخول</button>
				</div>
				<div class="login-form-undertext">
					<small><a href="#">نسيت كلمة السر الخاصة بك؟</a></small><br>
					<small>ليس لديك حساب؟<a href="#">  سجل هنا </a></small>
				</div>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
function login(){
    $.post(webhost+"/user/login", $("form.user-login").serialize())
    .done(function(d){
		$("form.user-login .errors-box").empty();
		var response_json = d;
		if(response_json['goto'] != "")
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
<style type="text/css">
.nav-item{
  margin-left: 15px;
}
#login-btn{
	color: black;
	border: 1px solid grey;
	border-radius: 50px;
	width: 120px;
	line-height: 0.5;
	height: 35px;
	background-color: transparent;
	margin: auto 35px auto 20px;
}
#login-btn:hover{
	background-color: rgba(255, 255, 255, 0.9);
}
</style>