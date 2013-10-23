<?php
	echo '<div class="devos">';
	foreach ($devos as $devo) {
		$style = $devo->id_devo == 2 || $devo->id_devo == 4 ? 'destacada':'';
		echo '<div class="item-devo '.$style.'">';
		echo '<a href="#" class="link-devo" data-id="'.$devo->id_devo.'">';
		echo '<img src="'.Yii::app()->baseUrl.'/uploads'.$devo->image.'"/>';
		echo '<div id="info-devo">';
		echo '<h4>'.$devo->title.'</h4>';
		echo '<div id="details"><i class="icon-eye-open"></i> 325 views</div>';
		echo '</div>';
		echo '</a>';
		echo '</div>';
	};

	foreach ($devos as $devo) {
		$style = $devo->id_devo == 2 || $devo->id_devo == 4 ? 'destacada':'';
		echo '<div class="item-devo '.$style.'">';
		echo '<a href="#" class="link-devo" data-id="'.$devo->id_devo.'">';
		echo '<img src="'.Yii::app()->baseUrl.'/uploads'.$devo->image.'"/>';
		echo '<div id="info-devo">';
		echo '<h4>'.$devo->title.'</h4>';
		echo '<div id="details"><i class="icon-eye-open"></i> 325 views</div>';
		echo '</div>';
		echo '</a>';
		echo '</div>';
	};

	foreach ($devos as $devo) {
		$style = $devo->id_devo == 2 || $devo->id_devo == 4 ? 'destacada':'';
		echo '<div class="item-devo '.$style.'">';
		echo '<a href="#" class="link-devo" data-id="'.$devo->id_devo.'">';
		echo '<img src="'.Yii::app()->baseUrl.'/uploads'.$devo->image.'"/>';
		echo '<div id="info-devo">';
		echo '<h4>'.$devo->title.'</h4>';
		echo '<div id="details"><i class="icon-eye-open"></i> 325 views</div>';
		echo '</div>';
		echo '</a>';
		echo '</div>';
	};
	
	echo '</div>';
	
?>

<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/masonry.min.js"></script>

<script>
	
	 var $container = $('.devos');
                // initialize
                $container.masonry({itemSelector: '.item-devo' });

                setTimeout(function(){
                    $container.masonry({itemSelector: '.item-devo' });
                }, 100);

</script>