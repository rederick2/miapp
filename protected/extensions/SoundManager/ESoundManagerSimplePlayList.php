<?php
/**
 * 
 * This widget is used to create a playlist using the SoundManager2 http://www.schillmania.com/projects/soundmanager2/demo/play-mp3-links/
 * 
 * Example:
 * <code>
 * 	<a href="/mp3/rain.mp3" id="singlePlayer_1" class="list1">Rain</a>
 *  <a href="/mp3/walking.mp3" id="singlePlayer_2" class="list1">Rain 2</a>
 *	<a href="/mp3/mak.mp3" id="singlePlayer_3" class="list1">Rain 3</a>
 *	<a href="/mp3/fancy-beer-bottle-pop.mp3" id="singlePlayer_4" class="list1">Rain 4</a>
 *  <?php
 *  $this->widget("ext.SoundManager.ESoundManagerSimplePlayList", array("playListId"=>"playList1", "playListClass"=>"list1", "autoPlay"=>true, "autoNext"=>true));
 *  ?>
 * </code>
 * After creating the widget, a js var named "playList1" (the same as playListId) is created. This var is a js object of the class SmPlayList
 * from which you can get the id of the current player or you can call resetPlayList() function to re-initialize the playlist (e.g., after ajax in a CGridView) 
 * @author Vu Khuu <vu.khuu@glandoresystems.com>
 *
 */
class ESoundManagerSimplePlayList extends CWidget {
	public $playListId;
	public $playListClass;
	public $autoPlay = false;
	public $autoNext = false;
	public $playCallback = "function(){}";
	public $pauseCallback = "function(){}";
	public $stopCallback = "function(){}";
	public $resumeCallback = "function(){}";
	public $finishCallback = "function(){}";
	
	public function run() {
		
		$assetManager = Yii::app()->assetManager;
		$assetUrl = $assetManager->publish(dirname(__FILE__).'/assets');
		$cs = Yii::app()->clientScript;
		// Register jQuery
		$cs->registerCoreScript("jquery");
		// Register SoundManager js & css
		//$cs->registerCssFile($assetUrl.'/css/player.css');
		$cs->registerCssFile($assetUrl.'/css/demo/demo.css');
		$cs->registerCssFile($assetUrl.'/css/demo/page-player.css');
		$cs->registerCssFile($assetUrl.'/css/flashblock.css');
		//$cs->registerCssFile($assetUrl.'/css/demo/optional-annotations.css');
		$cs->registerCssFile($assetUrl.'/css/demo/optional-themes.css');
		//$cs->registerScriptFile($assetUrl.'/js/soundmanager2-nodebug.js');
		$cs->registerScriptFile($assetUrl.'/js/soundmanager2.js');
		//$cs->registerScriptFile($assetUrl.'/js/SmPlayList.js');

		$cs->registerScriptFile($assetUrl.'/js/demo/page-player.js');
		$cs->registerScriptFile($assetUrl.'/js/jquery.hoverIntent.min.js');
		$cs->registerScriptFile($assetUrl.'/js/demo/optional-page-player-metadata.js');
		
		// Initial script
		$initScript = <<<EOD
			soundManager.url = '{$assetUrl}/swf/';
			soundManager.flashVersion = 9;
			//soundManager.useFlashBlock = true;
			soundManager.preferFlash= true;
			soundManager.useHighPerformance= true; 
			soundManager.wmode= 'transparent';

			var PP_CONFIG = {
			  autoStart: false,      // begin playing first sound when page loads
			  playNext: true,        // stop after one sound, or play through list until end
			  useThrottling: false,  // try to rate-limit potentially-expensive calls (eg. dragging position around)</span>
			  usePeakData: true,     // [Flash 9 only] whether or not to show peak data (left/right channel values) - nor noticable on CPU
			  useWaveformData: false,// [Flash 9 only] show raw waveform data - WARNING: LIKELY VERY CPU-HEAVY
			  useEQData: false,      // [Flash 9 only] show EQ (frequency spectrum) data
			  useFavIcon: false     // try to apply peakData to address bar (Firefox + Opera) - performance note: appears to make Firefox 3 do some temporary, heavy disk access/swapping/garbage collection at first(?) - may be too heavy on CPU
			}

			soundManager.useFlashBlock = true;

			soundManager.onready(function() {
			  pagePlayer = new PagePlayer();
			  pagePlayer.init(typeof PP_CONFIG !== 'undefined' ? PP_CONFIG : null);
			  try {
				    if (localStorage.position) {
				        storage = localStorage;
				        var position = JSON.parse(storage.position);
				        var id = position.id;
				        var timing = position.timing;

				        //console.log(timing);
				        pagePlayer.handleClick({target:$('#'+id)[0]});
				        //pagePlayer.lastSound.setPosition(timing);

				        if(position.repeat){
				        	var t = $('.repeat');
				        	$(t).removeClass('repeat');
							$(t).addClass('norepeat');
							$(t).css('background-color', '#95A5A6');
				        };
				    }
				} catch(e) {
				    storage = {};
				}
			});


EOD;
		$cs->registerScript("SoundManagerInitialScript", $initScript);
		
		$autoPlayText = $this->autoPlay ? "true" : "false";
		$autoNextText = $this->autoNext ? "true" : "false";
		
		$smScript = <<<EOD
			// Global reference to SoundManager sound object

					var storage;
			
			$('.pause').click(function(){
		        pagePlayer.lastSound.pause();
		    });

		    $('.playing').live('click' , function(){
		        pagePlayer.lastSound.play();
		    });

			$('.resume').live('click' , function(){
		        pagePlayer.lastSound.resume();
		    });

			$('.mute').live('click' , function(){
				$(this).removeClass('mute');
				$(this).addClass('volume');
				$(this).html('<i class="icon-volume-up"></i>');
		        pagePlayer.lastSound.toggleMute();
		    });

			$('.volume').live('click' , function(){
				$(this).removeClass('volume');
				$(this).addClass('mute');
				$(this).html('<i class="icon-volume-off"></i>');
		        pagePlayer.lastSound.toggleMute();
		    });

			$('.repeat').live('click' , function(){
				$(this).removeClass('repeat');
				$(this).addClass('norepeat');
				$(this).css('background-color', '#95A5A6');
		        pagePlayer.loopSound();
		    });

			$('.norepeat').live('click' , function(){
				$(this).removeClass('norepeat');
				$(this).addClass('repeat');
				$(this).css('background-color', '#434343');
		        pagePlayer.noloopSound();
		    });

		    $('.next').click(function(){
		        pagePlayer.playNext(pagePlayer.lastSound);
		        $('.play').focus();
		    });

		    $('.previous').click(function(){
		        //var oSound = soundManager.get
		        pagePlayer.playPrevious(pagePlayer.lastSound);
		        $('.play').focus();
		    });

			$('#player').hoverIntent({
				over : function() {
			    		$('#playerList ol').slideDown('slow');
			  	},
			  	out : function() {
			   		 $('#playerList ol').slideUp('slow');
			  	},
			  	timeout: 1000,
			});

			var myScroll = new iScroll('wrapper');

			$('.remove').live("click", function() {
		            $(this).parent().remove();
			});
			  
EOD;
		$cs->registerScript("SoundManagerPlayList_" . $this->playListId, $smScript);

		$this->render('soundPlayer');
	}
}
?>