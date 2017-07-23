<!DOCTYPE html>

<html lang="en" dir="rtl">
  <head>
    <?php include $GLOBALS['webhost']['metadata']; ?>
    <title>صندوقي | التسوق عليك، التوصيل علينا</title>
    <link rel="stylesheet" href="<?php echo $GLOBALS['webhost']['base_url']; ?>/app/views/home/home.css">
  </head>

<body>
  <?php include $GLOBALS['webhost']['navbar']; ?>
  
		<div class="backdrop">
      <div class="container" style="height: 90px;"><!--SPACER--></div>
      <div class="container">
        <div class="row">
          <?php if($this->userIsLoggedIn()) : ?>
          <div class="col-lg-12 text-center" style="background-color: rgba(0, 0, 0, 0.4); padding: 15px 0 0 0; border-radius: 5px;">
            <h2 class="heading-3">أهلاً بك في صندوقي</h2><br>
            <i class="fa fa-smile-o fa-5x" style="color: white;" aria-hidden="true"></i>
            <p class="main-paragraph">نتمنى لك تسوقاً ممتعاً</p><br>
            <a href="<?php echo $GLOBALS['webhost']['base_url'].'/profile/address'; ?>"><button class="btn btn-warning custom-btn">أرني عنوان صندوقي</button></a>
            <a href="<?php echo $GLOBALS['webhost']['base_url'].'/profile/address#instructions'; ?>"><button class="btn btn-secondary custom-btn-two">كيف أستخدم صندوقي؟</button></a>
          </div>
          <?php else : ?>
          <div class="col-lg-6">
            
          </div>
          <div class="col-lg-6 text-right" style="background-color: rgba(255, 255, 255, 0.6); padding-top: 15px; padding-bottom: 15px; border-radius: 5px;">
            <h2 class="register-heading">إحصل على صندوقك الآن.. <strong style="font-size: 46px;">مجاناً</strong>!</h2>
            <form class="user-register" method="post">
              <div class="form-group">
                <input class="form-control" type="email" placeholder="البريد الإلكتروني" id="register-email" name="user_email" value="example@email.com">
              </div>
              <div class="form-group">
                <input class="form-control" type="text" placeholder="رقم الجوال" id="register-mobile" name="user_mobile" value="0501234567">
              </div>
              <div class="form-group">
                <input class="form-control" type="password" placeholder="كلمة السر" id="register-password" name="user_pass" value="1234">
              </div>
              <hr style="width: 80%; border: 1px solid orange;">
              <div class="form-group">
                <input class="form-control" type="text" placeholder="الإسم الكامل" id="register-name" name="user_name" value="سلطان مبين جودت أبوغزال">
              </div>
              <div class="form-group row">
                <div class="col-lg-6">
                  <input class="form-control" type="text" placeholder="المحافظة" id="register-city" name="user_city" value="نابلس">
                </div>
                <div class="col-lg-6">
                  <input class="form-control" type="text" placeholder="العنوان" id="register-address" name="user_address" value="سبسطية">
                </div>
              </div>
              <div class="form-group">
                <input class="form-control" type="text" placeholder="بالقرب من؟" id="register-nearby" name="user_nearby" value="قرب البلدية">
              </div>
              <div class="form-check text-left" dir="ltr">
                <label class="form-check-label" style="color: white">
                  <input class="form-check-input" type="checkbox" value="">
                     أنا أوافق على <a href="">الشروط والاحكام</a>
                </label>
              </div>
              <div class="errors-box text-center" style="color: red" dir="ltr"></div>
              <div class="text-left">
                <button class="btn btn-secondary" onclick="register(); return false;" style="color: white; font-family: 'Cairo', sans-serif; font-weight: 600; letter-spacing: 1px; background-color: orange; border: none; height: 40px; width: 40%;">إكمال التسجيل</button>
              </div>
            </form>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
    
    
  <div class="container" id="how-it-works">
    <div class="container" style="height: 40px;"><!--SPACER--></div>
    <hr style="width: 100%; border: 1px solid orange;">
    <h1 class="heading-1 text-center">كيف نعمل؟</h1><br><br>
    <div class="row">
      <div class="col-md-6"></div>
      <div class="col-md-6"></div>
    </div>
    <div class="text-center">
      <img style="width: 70%" src="<?php echo $GLOBALS['webhost']['base_url']; ?>/app/assets/images/cycle-small.png" alt="how-it-works-figure">      
    </div>
  </div>

  <div class="container" id="prices">
    <div class="container" style="height: 40px;"><!--SPACER--></div>
    <hr style="width: 100%; border: 1px solid orange;"><br>
    <div class="row">
      <div class="col-md-6" style="margin: 100px 0 70px 0;">
        <h2 class="heading-2">أسعارنا</h2>
        <p class="paragraph">
          تعتمد أسعار الشحن لدينا على وزن الطرود. تكلفة أول 1/2 كيلو جرام هي 70 شيقل جديد بحيث يضاف 30 شيقل جديد لكل 1/2 كيلو جرام إضافي.
        </p>
      </div>
      <div class="col-md-6 text-center">
        <img src="<?php echo $GLOBALS['webhost']['base_url']; ?>/app/assets/images/prices-ad.png" style="width: 100%" alt="price-ad">
      </div>
    </div>
  </div>

  <div class="container" id="contact-us">
    <div class="container" style="height: 40px;"><!--SPACER--></div>
    <hr style="width: 100%; border: 1px solid orange;">
    <h1 class="heading-1 text-center">للتواصل والإستفسار</h1><br>
    <div class="container" style="height: 800px;"><!--SPACER--></div>
  </div>

  <?php include $GLOBALS['webhost']['footer']; ?>

  <?php include $GLOBALS['webhost']['scripts']; ?>
  <script src="<?php echo $GLOBALS['webhost']['base_url']; ?>/app/views/home/home.js"></script>
</body>

</html>