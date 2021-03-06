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
    
    <div id="idialog">
    <div class="iclose"><i class="icon-remove"></i></div>
    <div id="icontent"><div id="image-loading"></div></div>
    <div id="sidebar">
        <div class="sidebar-block"></div>
        <div id="list_comments"></div>
        <?php if (!Yii::app()->user->isGuest) : ?>
            <h6>Agrega Comentario:</h6>
            <textarea rows="2" class="span7" id="text_comment" name="text_comment" data-id="<?php echo Yii::app()->user->id; ?>" placeholder="Comentario..."></textarea>
        <?php else : ?>
            <a class="btn <?php echo !Yii::app()->user->isGuest ? 'link':''; ?>" data-toggle="modal" data-target="#loginModal" href="#" data-location="<?php echo !Yii::app()->user->isGuest ? Yii::app()->baseUrl.'/'.Yii::app()->user->name :Yii::app()->baseUrl.'/site/login'; ?>"><span><?php echo !Yii::app()->user->isGuest ? Yii::app()->user->name : 'Inicia sesión para comentar'; ?></span></a>
        <?php endif ?>
    </div>
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

    $this->widget('ext.timeago.JTimeAgo', array(
        'selector' => ' .timeago',
    ));


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
            $('.iclose').click();
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
      <div id="devo-view" data-id="{{id}}">
        <div id="ititle">{{title}}</div>
        <div id="image-devo"><img src="{{url}}"/></div>
        <div id="itext">{{text}}</div>
      </div>
</script>

<script id="userInfo" type="text/html">
    
    <div id="owner-icon-info" class="cfix">
                <div id="owner-icon" class="user-img-50 left ">
                    <a href="<?php echo Yii::app()->baseUrl.'/'; ?>{{username}}">
                        <img src="{{pictureProfile}}">
                    </a>
                </div>
                <div id="owner-info" class="left">
                    <div id="owners" class="cfix">
                        <a id="owner" class="text-ellipsis" href="<?php echo Yii::app()->baseUrl.'/'; ?>{{username}}">{{first_name}} {{last_name}}</a>
                    </div> 
                </div>
    </div>
    <div id="owner-buttons-container" class="clear">
        <button class="btn btn-info fshare" data-id="{{iduser}}"><i class="icon-facebook"></i></button>
        <button class="btn btn-primary" data-id="{{iduser}}">Seguir</button>
        <button class="btn" data-id="{{<?php echo Yii::app()->user->id; ?>}}"><i class="icon-share"></i> Compartir</button>
    </div>

</script>

<script id="comment" type="text/html">
    
    <div id="owner-icon-info" class="cfix">
                <div id="owner-icon" class="user-img-50 left ">
                    <a href="<?php echo Yii::app()->baseUrl.'/'; ?>{{username}}">
                        <img src="{{pictureProfile}}">
                    </a>
                </div>
                <div id="owner-info" class="left">
                    <div id="owners" class="cfix">
                        <a id="owner" class="text-ellipsis" href="<?php echo Yii::app()->baseUrl.'/'; ?>{{username}}">{{first_name}} {{last_name}}</a>
                        <p>{{text}}</p>
                        <abbr class="timeago" title="{{time}}">{{time}}</abbr>
                    </div> 
                </div>
                <div di="comment">{{comment}}</div>
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

        history.pushState(null, null, '<?php echo Yii::app()->baseUrl; ?>/devo/'+$(this).attr('data-id'));
        historyedited = true;


        var devo_data, devo, userInfo_data, userInfo;

        var self = $(this);

        $.ajax({
            url:'<?php echo Yii::app()->baseUrl; ?>/devo/devobyid',
            type: 'POST',
            data : {id:$(this).attr('data-id')}
        }).done(function(msg){
            
            //text.push(msg);
            var datos = eval(msg);
            //console.log(datos);
            devo_data = {
                id: self.attr('data-id'),
                title: self.parent().children('#info-devo').children('h4').text(),
                url: self.children('img').attr('src'),
                text: datos[0].text,
            };

            userInfo_data = {
                pictureProfile: datos[0].picture,
                username: datos[0].username,
                iduser : datos[0].iduser,
                first_name: datos[0].first_name,
                last_name : datos[0].last_name,
            };

            // Here's all the magic.
            devo = ich.devo(devo_data);

            userInfo = ich.userInfo(userInfo_data);

            // append it to the list, tada!
            //Now go do something more useful with this.
            $('#icontent').html(devo);
            $('.sidebar-block').html(userInfo);

            //console.log(datos[0].comments);
            var comment, comment_data, comments, picture;
                //console.log(datos);

                comments = datos[0].comments;

                for (x in comments){

                    if (comments[x].user.picture == '' ){
                        picture = "<?php echo Yii::app()->baseUrl.'/uploads/user.png' ?>";
                    }else{
                        picture = comments[x].user.picture;
                    };

                    comment_data = {
                        pictureProfile: picture,
                        username: comments[x].user.username,
                        text : comments[x].text,
                        first_name: comments[x].user.first_name,
                        last_name : comments[x].user.last_name,
                        time : comments[x].create_time,
                    };

                    // Here's all the magic.

                    comment = ich.comment(comment_data);

                    // append it to the list, tada!
                    //Now go do something more useful with this.
                    $('#list_comments').append(comment);
                }

                $('.timeago').timeago();

        });

          
        $('#lightbox').fadeIn(300);

    });

    $('.iclose').live('click' , function(){
        $('#lightbox').fadeOut(300);
        $('#icontent').html('<div id="image-loading"></div>');
        $('#list_comments').html('');
    });
    
    $('body').keyup(function(e){
       // alert(e.keyCode);
        if(e.keyCode == 27){
            // Close my modal window
            $('.iclose').click();
        }
    });

    $('#text_comment').keyup(function(e){
       // alert(e.keyCode);
        if(e.keyCode == 13){

           var self = $(this);

           $.ajax({
                url:'<?php echo Yii::app()->baseUrl; ?>/devo/comment',
                type: 'POST',
                data : {    id_user:self.attr('data-id'), 
                            id: $('#devo-view').attr('data-id'),
                            text: self.val()

                        }
            }).done(function(msg){
                
                //text.push(msg);
                var datos = eval(msg);
                var comment, comment_data;
                //console.log(datos);

                comment_data = {
                    pictureProfile: datos[0].picture,
                    username: datos[0].username,
                    text : datos[0].text,
                    first_name: datos[0].first_name,
                    last_name : datos[0].last_name,
                    time : datos[0].create_time,
                };

                // Here's all the magic.

                comment = ich.comment(comment_data);

                // append it to the list, tada!
                //Now go do something more useful with this.
                $('#list_comments').append(comment);

                $('#list_comments').animate({scrollTop: $('#list_comments').height()}, 500);

                self.val('');
                //self.focus();
                $('.timeago').timeago();

            });
        }
    });

</script>

</body>
</html>
