<div class="col-md-3" style="padding: 0 3px 6px 3px;">
	<div class="item" style="padding: 10px; border: 1px solid lightgrey; border-radius: 2px;">
        <div class="img-thumbnail" style="display: flex; flex-direction: column; justify-content: center; height: 240px; background-color: white;">
		    <img style="max-width: 100%; max-height: 100%;" src="<?php echo $GLOBALS['services']['images'] . $data['photo']; ?>" alt="item">
        </div>
		<div style="padding: 5px 10px 0 10px; font-family: 'Cairo', sans-serif;">
			<div class="d-flex">
				<span class="ml-auto"><strong>الوزن</strong></span>
				<span class="mr-auto"><?php echo $data['weight']; ?> كجم</span>
			</div>
			<div class="d-flex">
				<span class="ml-auto"><strong>وقت الوصول</strong></span>
				<span class="mr-auto">قبل <?php echo $this->timeElapsedString($data['origin_arrival_time']); ?></span>
			</div>
			<div class="d-flex">
				<span class="ml-auto"><strong>تكلفة الشحن</strong></span>
				<span class="mr-auto">
                    <?php echo number_format($data['cost'], 2);
                    //$GLOBALS['prices']['first_half_kg']
                    ?> ش.ج.</span>
			</div>
			<div class="d-flex">
				<span class="ml-auto"><strong>الحالة</strong></span>
				<span class="mr-auto"><?php echo $data['status_text_ar']; ?></span>
			</div>
		</div>
	</div>
</div>