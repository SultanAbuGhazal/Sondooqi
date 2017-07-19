<!DOCTYPE html>

<html lang="en" dir="rtl">
  <head>
    <?php include $GLOBALS['webhost']['metadata']; ?>
    <title>صندوقي | عناويني</title>
    <link rel="stylesheet" href="<?php echo $GLOBALS['webhost']['base_url']; ?>/app/views/address/address.css">
  </head>

<body style="background-color: rgb(237, 237, 237);">
  <?php include $GLOBALS['webhost']['navbar']; ?>

  <div class="container" style="height: 45px;"><!--SPACER--></div>

  <div class="container card">
    <div class="row">
      <div class="col-md-6">
        <h1 class="heading">استخدم</h1>
        <p class="lead paragraph">هذا العنوان عند الشراء من مواقع التسوق الإلكتروني المفضلة لديك.</p>
      </div>
      <div class="col-md-6">
        <table class="table table-sm">
          <tbody>
            <tr> <th scope="row"></th> <td>المنطقة</td>
              <td><?php echo $data['addresses'][0]['province']; ?></td> </tr>
            <tr> <th scope="row"></th> <td>العنوان</td>
              <td><?php echo $data['addresses'][0]['line_one'].", ".$data['addresses'][0]['line_two'].", BXfgKh6E"; ?></td> </tr>
            <tr> <th scope="row"></th> <td>المدينة</td>
              <td><?php echo $data['addresses'][0]['city'].", ".$data['addresses'][0]['country']; ?></td> </tr>
            <tr> <th scope="row"></th> <td>رقم التواصل</td>
              <td><?php echo $data['addresses'][0]['mobile']; ?></td> </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="container" style="height: 25px;"><!--SPACER--></div>
  <hr style="width: 40%; border: 1px solid orange;">

  <div class="container card-padding">
    <h1 class="notice-title text-center">ملاحظات هامة</h1>
    <ul class="custom-list">
      <li>يمكنك إستخدام هذا العنوان عند الشراء من أي موقع من مواقع التسوق الإلكتروني الموجودة في دولة الإمارات العربية المتحدة.</li>
      <li>بما أن هذه المواقع تعمل -في الغالب- خارج نطاق الدولة التي تقطن أنت فيها، يجب عليك الدفع عن طريق بطاقة إئتمانية وعدم إستخدام طريقة الدفع عند الإستلام.</li>
      <li>هذا الرقم مهم</li>
      <li></li>
    </ul>
  </div>

  <div class="container" style="height: 25px;"><!--SPACER--></div>
  <hr style="width: 40%; border: 1px solid orange;">

  <div class="container card-padding">
    <h1 class="notice-title text-center">تعليمات الإستخدام</h1>
    <ul class="custom-list">
      <li>مثال 1: مثال عربي</li>
      <li>مثال 2: مثال إنجليزي</li>
    </ul>
  </div>

  <div class="container" style="height: 25px;"><!--SPACER--></div>
  <hr style="width: 40%; border: 1px solid orange;">

  <div class="container card-padding">
    <h1 class="notice-title text-center">مواقعنا المفضلة</h1>
      <div class="websites-row row">
        <div class="col-lg-4 text-center website-item">
          <img src="..\app\assets\images\wadi-logo.png" alt="wadi-logo" height="140"><br><br>
          <p class="website-item-desc">
            وادي دوت كوم هو موقع للتسوق الالكتروني يهدف أن يكون حلقة الوصل لتوفير مختلف المنتجات في دولة الإمَارَات العَرَبيّة المُتّحِدة . يقوم وادي بشكل أساسي على توصيل العملاء بأفضل الموردين عبر دول مجلس التعاون الخليجي لضمان أفضل العروض.
          </p>
          <p><a class="btn btn-secondary" href="https://ar-ae.wadi.com/" role="button">إذهب إلى الموقع &raquo;</a></p>
        </div>
        <div class="col-lg-4 text-center website-item">
          <img src="..\app\assets\images\souq-logo.png" alt="souq-logo" height="140"><br><br>
          <p class="website-item-desc">
            سوق.كوم, هو أكبر موقع للتجارة الإلكترونية في العالم العربي، ويضم أكثر من 400،000 منتج من مختلف الفئات التي تشمل الإلكترونيات، والأزياء، والمنتجات المنزلية، والساعات، والعطور، وغيرها.
          </p>
          <p><a class="btn btn-secondary" href="https://uae.souq.com/ae-ar/" role="button">إذهب إلى الموقع &raquo;</a></p>
        </div>
        <div class="col-lg-4 text-center website-item">
          <img src="..\app\assets\images\namshi-logo.jpg" alt="namshi-logo" height="140"><br><br>
          <p class="website-item-desc">
            نمشي، مزيج من روح الشباب والمرح والأصالة. أصبحت نمشي النافذة الأوسع التي يطل منها عشاق الموضة، وخاصة الشباب، على أحدث الإتجاهات وآخر الصرعات وأرقى الماركات في عالم الأزياء.                         
          </p>
          <p><a class="btn btn-secondary" href="https://ar-ae.namshi.com/" role="button">إذهب إلى الموقع &raquo;</a></p>
        </div>
        <div class="col-lg-4 text-center website-item">
          <img src="..\app\assets\images\mumzworld-logo.png" alt="mumzworld-logo" style="max-width: 100%; max-height: 140px; margin: 25px 0 25px 0;"><br><br>
          <p class="website-item-desc">
            ممزورلد، تصفحي كتالوج منتجاتنا الذي يحتوي أوسع تشكيلة بأسعار منافسة. بدأً من المنتجات المحلية الأكثر مبيعاً، والمنتجات الحائزة على الجوائز عالمياً، إضافة إلى منتجات فريدة من الضروري اقتناءها لكل أم، وكل ما قد تحتجنه منذ اليوم الأول لولادة الطفل وحتى عمر 12 عام.
          </p>
          <p><a class="btn btn-secondary" href="http://www.mumzworld.com/ar/" role="button">إذهب إلى الموقع &raquo;</a></p>
        </div>
        <div class="col-lg-4 text-center website-item">
          <img src="..\app\assets\images\zeroohm-logo.png" alt="zeroohm-logo" style="max-width: 100%; max-height: 140px;"><br><br>
          <p class="website-item-desc">
            Zero Ohm General Trading LLC is an electronics and electromechanics company based in Dubai, United Arab Emirates. In Zero Ohm, we provide an easy access for high quality electronics components that targets universities, schools and laboratories.
          </p>
          <p><a class="btn btn-secondary" href="https://www.zeroohm.com/" role="button">إذهب إلى الموقع &raquo;</a></p>
        </div>
        <div class="col-lg-4 text-center website-item">
          <img src="..\app\assets\images\crazydeals-logo.png" alt="crazydeals-logo" style="max-width: 100%; max-height: 140px; margin: 35px 0 35px 0;"><br><br>
          <p class="website-item-desc">
            عند التسوق على Crazydeals.com، يمكنك أن تطمئن حول صحة وجودة المنتجات التي تختارها . مع العديد من الشركاء العلامة التجارية الموثوقة خلال الشحن الجوي، ونحن نضمن لك المنتجات و العلامة التجارية بأسعار لا مثيل لها!
          </p>
          <p><a class="btn btn-secondary" href="http://www.crazydeals.com/" role="button">إذهب إلى الموقع &raquo;</a></p>
        </div>
      </div>
  </div>

  <?php include $GLOBALS['webhost']['footer']; ?>

  <?php include $GLOBALS['webhost']['scripts']; ?>
  <script src="<?php echo $GLOBALS['webhost']['base_url']; ?>/app/views/address/address.js"></script>
</body>

</html>
