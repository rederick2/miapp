<?php if(Yii::app()->user->isGuest): ?>
    <div id="<?php echo $this->fbLoginButtonId; ?>"><a href="#" class="btn btn-info"><?php echo $this->facebookButtonTitle; ?></a></div>
<?php endif; ?>