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
      <div class="container" style="height: 80px;"><!--SPACER--></div>
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
                <input class="form-control" type="email" placeholder="البريد الإلكتروني" id="register-email" name="user_email" maxlength="128" required>
              </div>
              <div class="form-group">
                <input class="form-control" type="text" placeholder="رقم الجوال بدون المفتاح، مثال: 0590000000" id="register-mobile" name="user_mobile" maxlength="16" required>
              </div>
              <div class="form-group">
                <input class="form-control" type="password" placeholder="كلمة السر" id="register-password" name="user_pass" minlength="8" maxlength="32" required>
              </div>
              <hr style="width: 80%; border: 1px solid orange;">
              <div class="form-group">
                <input class="form-control" type="text" placeholder="الإسم الكامل" id="register-name" name="user_name" maxlength="128" required>
              </div>
              <div class="form-group row">
                <div class="col-lg-6">
                  <input class="form-control" type="text" placeholder="المحافظة" id="register-city" name="user_city" maxlength="64" required>
                </div>
                <div class="col-lg-6">
                  <input class="form-control" type="text" placeholder="العنوان" id="register-address" name="user_address" maxlength="256" required>
                </div>
              </div>
              <div class="form-group">
                <input class="form-control" type="text" placeholder="بالقرب من؟" id="register-nearby" name="user_nearby" maxlength="256" required>
              </div>
              <div class="form-check text-left" dir="ltr">
                <label class="form-check-label" style="color: white">
                  <input class="form-check-input" type="checkbox" id="user_accept" name="user_accept" required>
                     أنا أوافق على <a href="<?php echo $GLOBALS['webhost']['base_url']."/home/terms"; ?>">الشروط والاحكام</a>
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
    <hr style="width: 100%; border: 1px solid orange;"><br>
    <h1 class="heading-2 text-center">كيف نعمل؟</h1><br><br>
    <div class="row">
      <div class="col-md-8 text-center">
        <img style="width: 70%" src="<?php echo $GLOBALS['webhost']['base_url']; ?>/app/assets/images/cycle-small.png" alt="how-it-works-figure">      
      </div>
      <div class="col-md-4 how-it-works-container">
        <h2 class="heading-1">نمنحك</h2>
        <p class="paragraph">
          القدرة على التسوق من مواقع تسوق إلكتروني خارج الأراضي الفلسطينية بكل راحة بال وبأفضل الأسعار.. التسوق عليك والشحن علينا.
        </p>
      </div>
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

  <div class="container card-padding">
    <div class="container" style="height: 40px;"><!--SPACER--></div>
    <hr style="width: 100%; border: 1px solid orange;"><br><br>
    <h1 class="heading-1 text-center">أكثر المواقع شعبية</h1>
    <?php 
      $this->getSnippet("favWebsites"); 
    ?>
  </div>

  <div class="container" id="contact-us">
    <div class="container" style="height: 40px;"><!--SPACER--></div>
    <hr style="width: 100%; border: 1px solid orange;"><br>
    <h1 class="heading-1 text-center">للتواصل والإستفسار</h1><br>
    <div class="text-center"><br>
      <img src="<?php echo $GLOBALS['webhost']['base_url']; ?>/app/assets/images/whatsapp-logo.png" style="max-height: 100px;" alt="whatsapp-logo">    
    </div>
    <div class="text-center">
      <span class="heading-2" dir="ltr" style="color: black; font-size: 48px;">+971 50 123-1234</span>
    </div>
  </div>    

  <div class="container" style="height: 100px;"><!--SPACER--></div>
  <?php include $GLOBALS['webhost']['footer']; ?>

  <?php include $GLOBALS['webhost']['scripts']; ?>
  <script src="<?php echo $GLOBALS['webhost']['base_url']; ?>/app/views/home/home.js"></script>
</body>

</html>