<!DOCTYPE html>
<html lang="en" dir="rtl">
	<head>
		<?php include $GLOBALS['webhost']['metadata']; ?>
		<title>صندوقي | تأكيد مستخدم جديد</title>
		<link rel="stylesheet" href="<?php echo $GLOBALS['webhost']['base_url']; ?>/app/views/confirm/confirm.css">
	</head>
	<body style="background-color: rgb(237, 237, 237);">
        <?php include $GLOBALS['webhost']['navbar']; ?>
    
        <div class="container" style="height: 125px;"><!--SPACER--></div>
        
        <div class="container text-center">
            <h2 class="heading">تأكيد مستخدم جديد</h2>
            <p class="paragraph"> لضمان وصول الطرود الخاصة بك إليك في أسرع وقت، يجب تأكيد رقم الجوال المزود من خلال رسالة نصية.</p>
            <p class="paragraph">سوف يتم إرسال رسالة نصية إلى الرقم التالي</p>
            <h3 class="number"><?php echo $data['mobile']; ?></h3>
            <p><a href="#" class="paragraph">أريد تعديل رقم الجوال</a></p>
            <p class="paragraph">فيها رقم مكون من ستة رموز، الرجاء كتابة هذا الرقم في المكان المخصص أدناه.</p><br>
            
            <form method="post" id="user-confirm">
              <div class="form-group">
                <input class="form-control form-control-lg" type="text" placeholder="إكتب الرموز هنا" id="code-textbx" name="confirm-code" maxlength="6" minlength="6" required>
              </div>
              <div class="errors-box text-center" style="color: red; margin-bottom: 15px;"></div>
              <div class="success-msg text-center" style="color: green; display: none;">تم التأكيد! <br> سوف تتم إعادة التوجيه خلال ثواني..<br><br> </div>
              <button  onclick="confirm(); return false;" class="btn btn-success form-control form-control-lg confirm-btn">تأكيد رقم الجوال</button>
            </form>

            <br>
            <div id="resend-btn-container">
              <button onclick="resend();"><a class="paragraph">لم أستلم رسالة نصية</a></button>
            </div>
            <br>
        </div>    
        <div class="container bottom-spacer"><!--SPACER--></div>

		<?php include $GLOBALS['webhost']['footer']; ?>
		<?php include $GLOBALS['webhost']['scripts']; ?>
		<script src="<?php echo $GLOBALS['webhost']['base_url']; ?>/app/views/confirm/confirm.js"></script>
	</body>
</html>