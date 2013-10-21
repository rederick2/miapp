<ul class="playlist">

  <a class="profile <?php echo !Yii::app()->user->isGuest ? 'link':''; ?>" data-toggle="modal" data-target="#loginModal" href="#" data-location="<?php echo !Yii::app()->user->isGuest ? Yii::app()->baseUrl.'/'.Yii::app()->user->name :Yii::app()->baseUrl.'/site/login'; ?>"><span><?php echo !Yii::app()->user->isGuest ? Yii::app()->user->name : 'Inicia Sesión'; ?></span></a>
  
  <li id="player">
    
    <button class="btn"><i class="icon-search"></i></button>
    <input  class="search-song" type="text" placeholder="Buscar canciones ..." style="height: 6px; margin: 0; border: 0; border-radius: 2px;">
    <button class="btn previous" ><i class="icon-backward icon-black"></i></button>
    <button class="btn pause" ><i class="icon-pause"></i></button>
    <button class="btn play" ><i class="icon-play"></i></button>
    <button class="btn next" ><i class="icon-forward"></i></button>
  
      
    <div id="controlsPlayer">

          <div id="title">
           
          </div>

          <div class="timing">
           <div id="sm2_timing" class="timing-data">
            <span class="sm2_position">0:00</span> / <span class="sm2_total">0:00</span>
           </div>
          </div>

          <div class="controls">
           <div class="statusbar">
            <div class="loading"></div>
            <div class="position"></div>
           </div>
          </div>

          

          <div class="peak" style="display:none">
           <div class="peak-box"><span class="l"></span><span class="r"></span></div>
          </div>

         <div class="spectrum-container">
          <div class="spectrum-box">
           <div class="spectrum"></div>
          </div>
         </div>
  </div>
  <div id="playerList">
    <button class="btn repeat" title="Repeat"><i class="icon-repeat"></i></button>
    <button class="btn mute" title="Mute"><i class="icon-volume-off"></i></button>
    <button class="btn" data-toggle="tooltip" data-placement="bottom" title="Lista de Canciones"><i class="icon-th-list"></i></button>
    <div id="wrapper">
      <ol class="playlist2">
        <li><a href="<?php echo Yii::app()->baseUrl.'/uploads/audio1.ogg'; ?>" id="singlePlayer_2" class="list1">Audio 2</a><i class="icon-remove-sign remove"></i></li>
        <li><a href="<?php echo Yii::app()->baseUrl; ?>/uploads/salvation-is-here-hillsong.ogg" id="singlePlayer_3" class="list1">Hillsong - Salvation Is Here</a><i class="icon-remove-sign remove"></i></li>
        <li><a href="<?php echo Yii::app()->baseUrl; ?>/uploads/audio4.ogg" id="singlePlayer_1" class="list1">Audio 1</a><i class="icon-remove-sign remove"></i></li>
       
      </ol>
    </div>
  </div>

  </li>

</ul>