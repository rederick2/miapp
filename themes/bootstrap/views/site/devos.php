<div id="lightbox">
	<div class="iclose"><i class="icon-remove"></i></div>
	<div id="icontent"></div>
	<div id="sidebar"></div>
</div>

<?php
	
	//print_r($devos);
	echo '<div class="devos">';
	foreach ($devos as $devo) {
		$style = $devo->id_devo == 2 || $devo->id_devo == 4 ? 'width:66.3%; height:600px':'';
		echo '<div class="item-devo" style="'.$style.'">';
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
		$style = $devo->id_devo == 1 || $devo->id_devo == 5 ? 'width:66.3%; height:600px':'';
		echo '<div class="item-devo" style="'.$style.'">';
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
		$style = $devo->id_devo == 3  ? 'width:66.3%; height:600px':'';
		echo '<div class="item-devo" style="'.$style.'">';
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

<script id="devo" type="text/html">
      <div id="devo-view">
      	<div id="title">{{title}}</div>
        <div id="image-devo"><img src="{{url}}"/></div>
        <div id="text">{{text}}</div>
      </div>
</script>

<script>


	$('.link-devo').hover(function () {

		//var alto = $(this).children('#info-devo').height() + $(this).children('#info-devo').children('#details').height();

		$(this).children('#info-devo').animate({bottom : '30px'} , 300);
		$(this).children('#info-devo').children('#details').animate({opacity : '1'} , 200);	
	},
	function(){
		$(this).children('#info-devo').animate({bottom : '0px'} , 300);
		$(this).children('#info-devo').children('#details').animate({opacity : '0'} , 200);
		
	});

	$('.link-devo').click(function(e){

		e.preventDefault(e);
		var devo_data, devo;

		var self = $(this);

		$.ajax({
			url:'<?php echo Yii::app()->baseUrl; ?>/devo/devobyid',
			type: 'POST',
			data : {id:$(this).attr('data-id')}
		}).done(function(msg){
			console.log(msg);
			//text.push(msg);
			devo_data = {
	            title: self.children('#info-devo').children('h4').text(),
	            url: self.children('img').attr('src'),
	            text: msg,
          	};

			// Here's all the magic.
			devo = ich.devo(devo_data);

			// append it to the list, tada!
			//Now go do something more useful with this.
			$('#icontent').html(devo);

		});

          
		$('#lightbox').fadeIn(300);

	});

	$('.iclose').click(function(){
		$(this).parent().fadeOut(300);
	});
	

</script>