<?php
	
	//print_r($devos);
	echo '<div class="devos">';
	foreach ($devos as $devo) {
		echo '<div class="item-devo">';
		echo '<h4>'.$devo->title.'</h4>';
		echo '<img src="'.Yii::app()->baseUrl.'/uploads'.$devo->image.'"/>';
		echo '</div>';
	}
	foreach ($devos as $devo) {
		echo '<div class="item-devo">';
		echo '<h4>'.$devo->title.'</h4>';
		echo '<img src="'.Yii::app()->baseUrl.'/uploads'.$devo->image.'"/>';
		echo '</div>';
	}
	foreach ($devos as $devo) {
		echo '<div class="item-devo">';
		echo '<h4>'.$devo->title.'</h4>';
		echo '<img src="'.Yii::app()->baseUrl.'/uploads'.$devo->image.'"/>';
		echo '</div>';
	}
	echo '</div>';
	
?>