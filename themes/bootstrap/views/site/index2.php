<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<?php /*$this->beginWidget('bootstrap.widgets.TbHeroUnit',array(
    'heading'=>'Welcome to '.CHtml::encode(Yii::app()->name),
    'htmlOptions' => array('data-0'=>'opacity:0;left:-180px;' , 'data-100'=>'opacity:1;left:180px;'),
)); */?>

<p>Congratulations! You have successfully created your Yii application.</p>

<?php //$this->endWidget(); ?>

<?php
 
$this->widget('ext.timeago.JTimeAgo', array(
    'selector' => ' .timeago',

 
));
 
?>
 
<abbr class="timeago" title="2008-07-17T09:24:17Z">July 17, 2008</abbr>
 
<abbr class="timeago" title="<?php echo  date(DATE_ISO8601,time());  ?>"><?php echo  date('Y m d');  ?></abbr>

<?php

/*$this->widget(
    'ext.jui.EJuiDateTimePicker',
    array(
        'model'     => $model,
        'attribute' => 'username',
        'language'=> Yii::app()->language,
        'mode'    => 'datetime',//'datetime' or 'time' ('datetime' default)
        'options'   => array(
            'dateFormat' => 'dd.mm.yy',
            'timeFormat' => '',//'hh:mm tt' default
        ),
    )
);

$this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'name'=>'publishDate',
    'language'=> Yii::app()->language,
    // additional javascript options for the date picker plugin
    'options'=>array(
        'showAnim'=>'fold',
        'dateFormat' => 'yy,mm,dd',
    ),
    'htmlOptions'=>array(
        'style'=>'height:20px;'
    ),
));*/


?>

<p>

<ul>
    <li>View file: <code><?php echo __FILE__; ?></code></li>
    <li>Layout file: <code><?php echo $this->getLayoutFile('main'); ?></code></li>
</ul>

</p>

<p>For more details on how to further develop this application, please read
    the <a href="#" data-location="<?php echo Yii::app()->baseUrl; ?>/site/contact">documentation</a>.
    Feel free to ask in the <a href="http://www.yiiframework.com/forum/">forum</a>,
    should you have any questions.</p>

<?php /*$this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
    'dataProvider'=>$gridDataProvider,
    'template'=>"{items}",
    'columns'=>array(
        array('name'=>'id', 'header'=>'#'),
        array('name'=>'firstName', 'header'=>'First name'),
        array('name'=>'lastName', 'header'=>'Last name'),
        array('name'=>'language', 'header'=>'Language'),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width:0$data[id]px'),
            'viewButtonUrl'=>'"post?id=".$data["id"]',
            'updateButtonUrl'=>null,
            'deleteButtonUrl'=>null,
           
        ),
    )

));*/

?>


<!--<iframe src="http://localhost/miapp/site/timeline/" name="contentFrame" id="contentFrame" width="100%" frameborder="0" height="600px"/>-->




<h1>Login</h1>

<div>
    <p><span id="startSound">00:00</span>/<span id="endSound">00:00</span></p>
</div>

<?php

/*$this->widget('zii.widgets.jui.CJuiSlider', array(
    'value'=>50,
    'options'=>array(
        'min'=>0,
        'max'=>100,
        'slide'=>'js:function(event, ui) { $("#TextBoxId").val(ui.value);}'
    ),
    'htmlOptions'=>array(
        'style'=>'height:12px;'
    ),
));*/

/*$this->widget('zii.widgets.jui.CJuiSlider', array(
    'id'=> 'slider',
    'options'=>array(
        'orientation'=> "horizontal",
        'max'=> 1000,
        'range'=>'min',
        'value'=>50,
        'slide'=>'js:function(event, ui) { var pos = ui.value; soundManager.setPosition($(".play_list").attr("id") , pos);}'
    ),
));

$this->widget('zii.widgets.jui.CJuiSlider', array(
    'id'=> 'volumen',
    'options'=>array(
        'orientation'=> "horizontal",
        'max'=> 100,
        'range'=>'min',
        'value'=>50,
        'slide'=>'js:function(event, ui) { var volume = ui.value; soundManager.setVolume($(".play_list").attr("id") , volume);}'
    ),
));*/

?>



 


<ul id="mySound" class="play_list"></ul>


<script id="user" type="text/html">
      <li>
        <p>{{title}}</p>
      </li>
</script>

<script type="text/javascript">
      // when the dom's ready
      $(document).ready(function () {
        // add a simple click handler for the "add user" button.
        $('a.list1').click(function (e) {

            e.preventDefault();

            var user_data, user;

            var title = $(this).text();
            var url = $(this).attr('href');
            var id = $(this).attr('id');

            // build a simple user object, in a real app this
            // would probably come from a server somewhere.
            // Otherwise hardcoding here is just silly.
            user_data = {
                title: title
            };

            // Here's all the magic.
            user = ich.user(user_data);

            // append it to the list, tada!
            //Now go do something more useful with this.
            $('.play_list').html(user);
            $('.play_list').attr('id', id);

            //playList(url , id);
        });
      });
    </script>


<script type="text/javascript">

        function pad(n, length){
           n = n.toString();
           while(n.length < length) n = "0" + n;
           return n;
        }
    
    //var r = setTimeout(function(){
        function playList(url, id){

            soundManager.stopAll();

             var mySoundObject = soundManager.createSound({
                 // optional id, for getSoundById() look-ups etc. If omitted, an id will be generated.
                 id: id,
                 url: url,
                 // optional sound parameters here, see Sound Properties for full list
                 volume: 50,
                // autoPlay: true,
                 whileplaying: function() { //console.log(this.id + ' is loading'); 
                        //$('#slider').slider('value' , this.position);
                        var current = this.position;
                        //console.log(current);
                        $('#slider').slider('option' , 'max' , this.duration);
                        $('#slider').slider('value' , current);

                        var min = parseInt((this.position)/60000);
                        var seg = parseInt((this.position)/1000);
                        $('#endSound').html(pad(min,2)+":"+pad(seg,2));
                    },
                onPlay: function(){
                    $('#endSound').html(this.duration);
                }
                });

             soundManager.play(id);


        };

       

    //}, 3000);
            

</script>









