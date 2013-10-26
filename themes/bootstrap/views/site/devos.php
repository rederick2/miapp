<?php

	 $this->widget('ext.timeago.JTimeAgo', array(
        'selector' => ' .timeago',
    ));

    
	echo '<div class="tools"></div>';
	echo '<div class="devos">';

	foreach ($devos as $devo) {
		$style = '';//$devo->id_devo == 1 || $devo->id_devo == 5 ? 'destacada':'';
		echo '<div class="item-devo '.$style.'">';
		echo '<a href="#" class="link-devo gradiente" data-id="'.$devo->id_devo.'">';
		echo '<img src="'.Yii::app()->baseUrl.'/uploads'.$devo->image.'"/>';
		echo '</a>';
		echo '<div id="info-devo">';
		echo '<h4>'.$devo->title.'</h4>';
		echo '<div id="details"><i class="icon-eye-open"></i> 325 views</div>';
		echo '</div>';
		echo '</div>';
	};
	
	echo '</div>';

	echo '<div id="sidebar"></div>'
	
?>

<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.isotope.min.js"></script>

<script>
	/*$('.devos').isotope({
      // options
      itemSelector : '.item-devo',
      layoutMode : 'fitRows'
    });


    setTimeout(function(){
        $('.devos').isotope({
	      // options
	      itemSelector : '.item-devo',
	      layoutMode : 'fitRows'
	    });
    }, 100);

    $(window).height(300);*/

</script>

