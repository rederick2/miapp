<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />



    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />


	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/flat-ui.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/flatten.css" />

    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/jquery.pnotify.default.css" media="all" rel="stylesheet" type="text/css" />
    <!-- Include this file if you are using Pines Icons. -->
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/jquery.pnotify.default.icons.css" media="all" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/ICanHaz.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.isotope.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/imagesloaded.min.js"></script>
    
	<?php //Yii::app()->bootstrap->register(); ?>
</head>

<body>


<div id="lightbox">
    <div class="iclose"><i class="icon-remove"></i></div>
    <div id="icontent"><div id="image-loading"></div></div>
    <div id="sidebar">
        
        <textarea rows="6" class="span8" name="ContactForm[body]" id="ContactForm_body"></textarea>

    </div>
</div>

<div id="loading">
    <div id="image-loading"></div>
</div>

<?php

    $this->widget("ext.SoundManager.ESoundManagerSimplePlayList", 
    array(  "playListId"=>"playList1", 
            "playListClass"=>"list1", 
            "autoPlay"=>true, "autoNext"=>true, 
            "playCallback"=>"onPlay", 
            "stopCallback"=>"onStop", 
            "pauseCallback"=>"onPause", 
            "resumeCallback"=>"onResume", 
            "finishCallback"=>"onFinish"));


/*$this->widget('ext.MjmChat.MjmChat', array(
                'title'=>'Chat room',
                'rooms'=>array(),
                'host'=>'http://localhost',
                'port'=>'3000',
            )
);*/

?>

<?php

	if(!Yii::app()->user->isGuest){

		$username	=	Yii::app()->user->name;
   		$user 		=	User::model()->find('LOWER(username)=?',array($username));
   		$picture 	=   '<a href="#" class="picProfile thumbnail"><img src="'.$user->picture.'" width="40" /></a>';

	}else{
		$picture = '';
	}

	$model=new LoginForm;
	
?>

<?php /*$this->widget('bootstrap.widgets.TbNavbar',array(
	'collapse' => true,
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items'=>array(
                array('label'=>'Home', 'url'=>array('/site/index')),
                array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
                array('label'=>'Contact', 'url'=>array('/site/contact')),
                array('label'=>'Timeline', 'url'=>array('/site/timeline')),
                array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest , 'itemOptions' => array('data-toggle' =>'modal' , 'data-target'=>'#loginModal')),
                array('label'=>Yii::app()->user->name, 'visible'=>!Yii::app()->user->isGuest , 'items' => array(
                    array('label'=>'Edit Profile', 'url'=>array('/site/editProfile')),
                    array('label'=>'Crear Fecha', 'url'=>array('/timeline/createDate')),
                    array('label'=>'Logout', 'url'=>array('/site/logout'))
                ))
            ),
        ),
        $picture,
    ),
)); */?>

<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'loginModal')); ?>

  <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id'=>'login-form',
        'type'=>'horizontal',
        'action' =>Yii::app()->baseUrl.'/site/login',
        'enableAjaxValidation' => true,
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
    )); ?>
 
        <div class="modal-header">
            <a class="close" data-dismiss="modal">&times;</a>
            <h4>Modal header</h4>
        </div>
         
        <div class="modal-body">
            <?php $this->widget('application.widgets.facebook.Facebook',array('appId'=>$_SERVER['REMOTE_ADDR'] == '127.0.0.1' ? '210521229054903' : '295295450589424')); ?>

            <p class="note">Fields with <span class="required">*</span> are required.</p>

            <?php echo $form->textFieldRow($model,'username'); ?>

            <?php echo $form->passwordFieldRow($model,'password'); ?>

            <?php echo $form->checkBoxRow($model,'rememberMe'); ?>

        </div>
         
        <div class="modal-footer">

                <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'buttonType'=>'submit',
                    //'type'=>'primary',
                    'label'=>'Login',
                )); ?>

            <?php $this->widget('bootstrap.widgets.TbButton', array(
                'label'=>'Close',
                'url'=>'#',
                'htmlOptions'=>array('data-dismiss'=>'modal'),
            )); ?>

        </div>

    <?php $this->endWidget(); ?>
 
<?php $this->endWidget(); ?>

<div id="menu">

    <img class="imgProfile" src="<?php echo Yii::app()->user->isGuest || $user->picture == '' ? Yii::app()->baseUrl.'/uploads/user.png' : $user->picture; ?>" />

    <ul>
        <li><a href="#" class="link" data-location="<?php echo Yii::app()->baseUrl.'/site/devos'; ?>"><i class="icon-book"></i>Devocionales</a></li>
        <li><a href="#" class="link" data-location="<?php echo Yii::app()->baseUrl.'/site/music'; ?>"><i class="icon-calendar"></i>Eventos</a></li>
        <li><a href="#" class="link" data-location="<?php echo Yii::app()->baseUrl.'/site/music'; ?>"><i class="icon-music"></i>Musica</a></li>
        <li><a href="#" class="link" data-location="<?php echo Yii::app()->baseUrl.'/site/music'; ?>"><i class="icon-group"></i>Amigos</a></li>
        <li><a href="<?php echo Yii::app()->baseUrl.'/site/logout'; ?>"><i class="icon-reply"></i>Salir</a></li>
    </ul>

</div>


    <div class="container" id="page">

	<?php echo $content; ?>

    </div><!-- page -->

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> La Red de Adolescentes. All Rights Reserved.<br/>
		<?php //echo Yii::powered(); ?>
	</div><!-- footer -->



<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/skrollr.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/iscroll.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.cookie.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.pnotify.min.js"></script>

<!--<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.history.js"></script>-->

<script type="text/javascript">
    var s = skrollr.init({
        edgeStrategy: 'set',
        easing: {
            WTF: Math.random,
            inverted: function(p) {
                return 1-p;
            }
        }
    });

   /*$('.devos').isotope({
      // options
      itemSelector : '.item-devo',
      layoutMode : 'fitRows'
    });*/
</script>

<script>
      $(document).ready(function() {

         if (window.history && history.pushState) {
          historyedited = false;
          $(window).bind('popstate', function(e) {
           if (historyedited) {
            loadContent(location.pathname + location.search);
           }
          });
          doPager();
         }

        });

        function doPager() {
         $('.link').click(function(e) {
          e.preventDefault();
          $('.iclose').click();
          loadContent($(this).attr('data-location'));
          history.pushState(null, null, $(this).attr('data-location'));
          historyedited = true;
          return false;
         });
 
        }

        function loadContent(url) {
            $('#loading').show();
            $.ajax({
                type : 'Post',
                url : url,
            }).done(function(data){
                $('#content').html(data);
                $('#loading').fadeOut();
                doPager();
            });
        }

</script>

<script id="devo" type="text/html">
      <div id="devo-view">
        <div id="ititle">{{title}}</div>
        <div id="image-devo"><img src="{{url}}"/></div>
        <div id="itext">{{text}}</div>
      </div>
</script>

<script>


    $('.item-devo').live({ 
        mouseenter: function(){
                $(this).children('#info-devo').animate({bottom : '30px'} , 300);
                $(this).children('#info-devo').children('#details').animate({opacity : '1'} , 200);
                //$(this).children('a').addClass('gradiente');
        },
        mouseleave: function() {
             $(this).children('#info-devo').animate({bottom : '0px'} , 300);
             $(this).children('#info-devo').children('#details').animate({opacity : '0'} , 200);
             //$(this).children('a').removeClass('gradiente');
        }
    });
   
    $('.link-devo').live('click' , function(e){

        e.preventDefault(e);
        var devo_data, devo;

        var self = $(this);

        $.ajax({
            url:'<?php echo Yii::app()->baseUrl; ?>/devo/devobyid',
            type: 'POST',
            data : {id:$(this).attr('data-id')}
        }).done(function(msg){
            //console.log(msg);
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

    $('.iclose').live('click' , function(){
        $(this).parent().fadeOut(300);
        $('#icontent').html('<div id="image-loading"></div>');
    });
    
    $('body').keyup(function(e){
       // alert(e.keyCode);
        if(e.keyCode == 27){
            // Close my modal window
            $('.iclose').click();
        }
    });

</script>

</body>
</html>
