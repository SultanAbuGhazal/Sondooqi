<div class="col-md-3 custom-item-container">
	<div class="custom-item">
        <div class="img-thumbnail" style="display: flex; flex-direction: column; justify-content: center; height: 240px; background-color: white;">
		    <img style="max-width: 100%; max-height: 100%;" src="<?php echo $GLOBALS['services']['images'] . $data['photo']; ?>" alt="item">
        </div>
		<div class="item-description">
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
                    <?php 
                    $weight = doubleval($data['weight']);
                    $weight -= 0.5;
                    $halfs = $weight / 0.5;
                    echo number_format( 70 + (30 * $halfs), 2); 
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