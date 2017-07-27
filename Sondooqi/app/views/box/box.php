<!DOCTYPE html>
<html lang="en" dir="rtl">
	<head>
		<?php include $GLOBALS['webhost']['metadata']; ?>
		<title>صندوقي | محتويات صندوقي</title>
		<link rel="stylesheet" href="<?php echo $GLOBALS['webhost']['base_url']; ?>/app/views/box/box.css">
	</head>
	<body style="background-color: rgb(237, 237, 237);">
    <?php include $GLOBALS['webhost']['navbar']; ?>
    
    <div class="container" style="height: 125px;"><!--SPACER--></div>    
    
    <div class="container">
      <div id="boxes-accordion" role="tablist" aria-multiselectable="true">
        <div class="card">
          <div class="card-header" role="tab" id="heading-uae">
          <h5 class="mb-0">
            <div class="d-flex p-1">
              <a data-toggle="collapse" data-parent="#boxes-accordion" href="#collapse-uae" aria-expanded="true" aria-controls="collapseOne">
                <span class="ml-auto box-heading">محتويات صندوقي في الإمارات العربية المتحدة</span>
              </a>
              <div class="mr-auto p-1">صندوق رقم: <?php echo $data['boxes'][0]['boxid'] ?></div>
            </div>
          </h5>
          </div>
          <div id="collapse-uae" class="collapse show" role="tabpanel" aria-labelledby="heading-uae">
            <div class="card-block" style="padding-right: 25px; padding-left: 25px;">

                <?php $sum = 0;?>
                <?php if(empty($data['boxes'][0]['items'])) : ?>
                <div class="row">
                  <div class="col-md-12 text-center">
                    <br>
                    <h2 class="heading-1">للأسف!</h2>            
                    <p class="cairo-font">لا يوجد لديك أي طرود في هذا الصندوق حالياً</p>            
                    <a href="<?php echo $GLOBALS['webhost']['base_url'].'/profile/address#instructions'; ?>"><button class="btn btn-primary nothing-btn">كيف أحصل على طرود</button></a>
                    <br>
                  </div>
                </div>
                <?php else : ?>
                <div class="row">
                <?php foreach($data['boxes'][0]['items'] as $item) : ?>
                  <?php
                  $weight = doubleval($item['weight']);
                  $halfs = ($weight-0.5) / 0.5;
                  $cost = $weight == 0 ? 0 : (70 + (30 * $halfs));               
                  $item['cost'] = $cost;
                  $sum += $cost;
                  $this->getSnippet("boxItemTemplate", $item); 
                  ?>
                <?php endforeach; ?>
                </div>
                <?php endif; ?>

              <br>
              <h4 class="total-cost">العدد الكلي: <span><?php echo sizeof($data['boxes'][0]['items']); ?></span> طرد</h4>
              <h4 class="total-cost">مجموع تكلفة الشحن: <span><?php echo number_format($sum, 2); ?></span> ش.ج.</h4> 
              <div class="text-left" style="font-family: 'Cairo', 'sans-serif'; color: red;">             
                <small>تُدفع تكاليف الشحن نقداً عند الإستلام.</small><br>
                <small>في بعض الحلات النادرة، قد يكون هناك تكاليف جمركية سيتم إضافتها إلى تكاليف الشحن.</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="container" style="height: 100px;"><!--SPACER--></div>    

		<?php include $GLOBALS['webhost']['footer']; ?>
		<?php include $GLOBALS['webhost']['scripts']; ?>
		<script src="<?php echo $GLOBALS['webhost']['base_url']; ?>/app/views/box/box.js"></script>
	</body>
</html>