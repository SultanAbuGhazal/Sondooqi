<!DOCTYPE html>

<html lang="en" dir="rtl">
  <head>
    <?php include $GLOBALS['webhost']['metadata']; ?>
    <title>صندوقي | عناويني</title>
    <link rel="stylesheet" href="<?php echo $GLOBALS['webhost']['base_url']; ?>/app/views/address/address.css">
  </head>

<body style="background-color: rgb(237, 237, 237);">
  <?php include $GLOBALS['webhost']['navbar']; ?>

  <div class="container" style="height: 125px;"><!--SPACER--></div>

  <div class="container card">
    <div class="row">
      <div class="col-md-6">
        <h1 class="heading">استخدم</h1>
        <p class="lead paragraph">هذا العنوان عند الشراء من مواقع التسوق الإلكتروني المفضلة لديك اللتي لا توفر خدمة التوصيل إلى داخل الأراضي الفلسطينية.</p>
      </div>
      <div class="col-md-6">
        <table class="table table-sm">
          <tbody>
            <tr> <th scope="row"></th> <td>الإسم</td>
              <td><?php echo $data['addresses'][0]['fullname']; ?></td> </tr>
            <tr> <th scope="row"></th> <td>المنطقة</td>
              <td><?php echo $data['addresses'][0]['province']; ?></td> </tr>
            <tr> <th scope="row"></th> <td>الشارع</td>
              <td><?php echo $data['addresses'][0]['street']; ?></td> </tr>
            <tr> <th scope="row"></th> <td>العنوان</td>
              <td><?php echo $data['addresses'][0]['line_one'].", ".$data['addresses'][0]['line_two']; ?></td> </tr>
            <tr> <th scope="row"></th> <td>المدينة</td>
              <td><?php echo $data['addresses'][0]['city'].", ".$data['addresses'][0]['country']; ?></td> </tr>
            <tr> <th scope="row"></th> <td>رقم التواصل</td>
              <td><?php echo $data['addresses'][0]['mobile']; ?></td> </tr>
          </tbody>
        </table>
        <div class="text-center">
          <a href="#instructions"><button class="btn btn-warning" style="width: 30%"><strong>تعليمات الإستخدام</strong></button></a>
          <a href="<?php echo $GLOBALS['webhost']['base_url']."/profile/box"; ?>"><button class="btn btn-secondary" style="width: 65%"><strong>أرني محتويات صندوقي هذا</strong></button></a>
        </div>
      </div>
    </div>
  </div>

  <div class="container" style="height: 50px;"><!--SPACER--></div>
  <hr style="width: 40%; border: 1px solid orange;">

  <div class="container card-padding">
    <h1 class="notice-title text-center">ملاحظات هامة</h1><br>
    <ul class="custom-list">
      <li>يمكنك إستخدام هذا العنوان عند الشراء من أي موقع من مواقع التسوق الإلكتروني الموجودة في دولة الإمارات العربية المتحدة فقط.</li><br>
      <li>بما أن هذه المواقع تعمل -في الغالب- خارج نطاق الدولة التي تقطن أنت فيها، يجب الدفع عن طريق بطاقة إئتمانية وعدم إستخدام طريقة الدفع عند الإستلام.</li><br>
      <li>في بعض الحلات النادرة، قد يكون هناك تكاليف جمركية سيتم إضافتها إلى تكاليف الشحن.</li><br>
      <li>تدفع تكاليف الشحن كاملة نقداً عند الإستلام.</li><br>
      <li><strong>هام جداً:</strong> رقم صندوقي هو رقم مكون من ثمانية رموز يبدأ بحرفي "BX" وهو رقم مهم جدا. إنه الطريقة الوحيدة التي تمكننا من معرفة محتويات صندوقك، لذلك يجب التأكد من ذكر هذا الرقم في العنوان عند موقع التسوق لضمان عدم ضياع محتويات صندوقك وضمان وصولها إليك.</li>
      <div class="row">
        <img style="height: 100%; width: 60%; margin: 15px auto 15px auto;" src="..\app\assets\images\note-one.png" alt="note-one">
      </div>
      <li>عند التسوق من موقعك المفضل، تأكد أنك تتسوق من موقع متاح في الدولة المذكورة في عنوان صندوقك. </li>
      <div class="row">
        <img style="height: 100%; width: 100%; margin: 0px auto 15px auto;" src="..\app\assets\images\note-two.png" alt="note-one">
      </div>
      <li>بعض مواقع التسوق قد تطلب تأكيداً إجبارياً لرقم الجوال عبر رسالة نصية قصيرة، في هذه الحالة إستخدم رقمك الخاص للتأكيد وضع الرقم المصاحب لعنوان صندوقك فى خانة الملاحظات أو أي خانة أخرى.</li>
    </ul>
  </div>

  <div class="container" style="height: 25px;" id="instructions"><!--SPACER--></div>
  <hr style="width: 40%; border: 1px solid orange;">

  <div class="container card-padding">
    <h1 class="notice-title text-center">تعليمات الإستخدام</h1><br>
    <p class="text-center paragraph2">إستخدم عنوان صندوقي الخاص بك <a href="<?php echo $GLOBALS['webhost']['base_url'].'/profile/address'; ?>">هذا</a> عند التسوق من مواقع التسوق الإلكتروني التي تعمل في دولة الإمارات واللتي لا توفر خدمة التوصيل إلى داخل الأراضي الفلسطينية.</p><br>
    <ul class="custom-list">
      <li><strong>المثال الأول:</strong> في حالة وجود "Address line 1" و "Address line 2"</li><br>
      <div class="row" dir="ltr">
        <form class="col-md-6 offset-md-3" id="example-form-one">
          <fieldset disabled>
            <div class="form-group row">
              <label class="col-sm-3 col-form-label text-right">Full Name</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" value="<?php echo $data['addresses'][0]['fullname']; ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 col-form-label text-right">Address Line 1</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" value="<?php echo $data['addresses'][0]['line_one']; ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 col-form-label text-right">Address Line 2</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" value="<?php echo $data['addresses'][0]['line_two']; ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 col-form-label text-right">Country</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" value="<?php echo $data['addresses'][0]['country']; ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 col-form-label text-right">City</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" value="<?php echo $data['addresses'][0]['city']; ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 col-form-label text-right">State/Area</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" value="<?php echo $data['addresses'][0]['province']; ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 col-form-label text-right">Street</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" value="<?php echo $data['addresses'][0]['street']; ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 col-form-label text-right">Phone number</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" value="<?php echo $data['addresses'][0]['mobile']; ?>">
              </div>
            </div>
          </fieldset>
        </form>
      </div><br>
      <li><strong>المثال الثاني:</strong> في حالة وجود خانة "الملاحظات"</li><br>
      <div class="row" dir="ltr">
        <form class="col-md-6 offset-md-3" id="example-form-one">
          <fieldset disabled>
            <div class="form-group row" dir="rtl">
              <label class="col-sm-3 col-form-label text-right">الإسم</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" value="<?php echo $data['addresses'][0]['fullname']; ?>">
              </div>
            </div>
            <div class="form-group row" dir="rtl">
              <label class="col-sm-3 col-form-label text-right" style="font-size: 14px;">إسم/رقم العمارة</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" value="<?php echo $data['addresses'][0]['line_one']; ?>">
              </div>
            </div>
            <div class="form-group row" dir="rtl">
              <label class="col-sm-3 col-form-label text-right">بلد الإقامة</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" value="<?php echo $data['addresses'][0]['country']; ?>">
              </div>
            </div>
            <div class="form-group row" dir="rtl">
              <label class="col-sm-3 col-form-label text-right">المدينة</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" value="<?php echo $data['addresses'][0]['city']; ?>">
              </div>
            </div>
            <div class="form-group row" dir="rtl">
              <label class="col-sm-3 col-form-label text-right">المنطقة</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" value="<?php echo $data['addresses'][0]['province']; ?>">
              </div>
            </div>
            <div class="form-group row" dir="rtl">
              <label class="col-sm-3 col-form-label text-right">الشارع</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" value="<?php echo $data['addresses'][0]['street']; ?>">
              </div>
            </div>
            <div class="form-group row" dir="rtl">
              <label class="col-sm-3 col-form-label text-right">رقم الموبايل</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" value="<?php echo $data['addresses'][0]['mobile']; ?>">
              </div>
            </div>
            <div class="form-group row" dir="rtl">
              <label class="col-sm-3 col-form-label text-right">الملاحظات</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" value="<?php echo $data['addresses'][0]['line_two']; ?>">
              </div>
            </div>
          </fieldset>
        </form>
      </div>
      </li>
      <br><br>
      <div class="text-center paragraph">للإستفسارات والمزيد من المعلومات يرجى <a href="<?php echo $GLOBALS['webhost']['base_url'].'/home#contact-us'; ?>">التواصل معنا</a></div>
    </ul>
  </div>

  <div class="container" style="height: 25px;"><!--SPACER--></div>
  <hr style="width: 40%; border: 1px solid orange;">

  <div class="container card-padding">
    <h1 class="notice-title text-center">أكثر المواقع شعبية</h1>
    <?php 
      $this->getSnippet("favWebsites"); 
    ?>
  </div>

  <?php include $GLOBALS['webhost']['footer']; ?>

  <?php include $GLOBALS['webhost']['scripts']; ?>
  <script src="<?php echo $GLOBALS['webhost']['base_url']; ?>/app/views/address/address.js"></script>
</body>

</html>
