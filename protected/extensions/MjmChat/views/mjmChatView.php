<div id="mjmChatBlock">
	<div id="mjmChatIcon" title="Open chatroom">
		<span id="mjmChatSlectRoom"><?php echo $title; ?></span>
	</div>
	<ul id="mjmChatRooms">
		<?php
		foreach ($rooms as $roomKey=>$roomValue) {
			echo '<li title="'.$roomKey.'">'.$roomValue.'</li>';
		}
		?>
	</ul>
</div>
<div id="rooms">
<?php foreach ($rooms as $roomKey=>$roomValue) { ?>
<div id="mjmChatRoom" class="room_<?php echo $roomKey; ?>" active="1" style="left:<?php echo (($roomKey-1)*600); ?>px">
	<div id="mjmChatRoomHead">
		<span id="mjmChatRoomTitle" title="Minimize"></span>
		<span id="mjmChatRoomClose" title="Close">X</span>
		<span id="mjmChatRoomMinimize" title="Minimize">-</span>
	</div>
	<div id="mjmChatRoomBody">
		<ul id="mjmChatMessages"></ul>
		<ul id="mjmChatUsersList"></ul>
	</div>
	<div id="mjmChatRoomSend">
		<textarea id="mjmChatMessage"<?php if($messagePlaceHolder) echo ' placeholder="'.$messagePlaceHolder.'"'; ?>></textarea>
		<button id="mjmChatSend"><?php echo $sendButtonText; ?></button>
	</div>
</div>
<?php } ?>
</div>