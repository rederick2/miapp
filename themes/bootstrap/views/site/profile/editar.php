<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form TbActiveForm */

$this->pageTitle=Yii::app()->name . ' - Edit Profile';
$this->breadcrumbs=array(
	'EditProfile',
);
?>

<h1>Editar Perfil</h1>

<?php if(Yii::app()->user->hasFlash('contact')): ?>

    <?php $this->widget('bootstrap.widgets.TbAlert', array(
        'alerts'=>array('contact'),
    )); ?>

<?php else: ?>

<p>
If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
</p>

<?php endif; ?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'edit-profile-form',
    'type'=>'horizontal',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="container">

		<div class="span5">

			<?php echo $form->textFieldRow($model,'first_name' , array('value' => $user->first_name)); ?>

			<?php echo $form->textFieldRow($model,'last_name', array('value' => $user->last_name)); ?>

		    <?php echo $form->textFieldRow($model,'username' , array('value' => $user->username)); ?>

		    <?php echo $form->textFieldRow($model,'e_mail' , array('value' => $user->e_mail)); ?>

		    <?php echo $form->passwordFieldRow($model,'password' , array('value' => $user->password)); ?>

		    <?php echo $form->passwordFieldRow($model,'password_repeat' , array('value' => $user->password)); ?>

		</div>

		<div class="span4">

			<a href="#" class="picProfile thumbnail"><img src="<?php echo $user->picture;?>" width="150" /></a>

		</div>

	</div>

    <?php //echo $form->textFieldRow($model,'subject',array('size'=>60,'maxlength'=>128)); ?>

    <?php //echo $form->textAreaRow($model,'body',array('rows'=>6, 'class'=>'span8')); ?>

	<?php if(CCaptcha::checkRequirements()): ?>
		<?php //echo $form->captchaRow($model,'verifyCode',array(
            //'hint'=>'Please enter the letters as they are shown in the image above.<br/>Letters are not case-sensitive.',
        //)); ?>
	<?php endif; ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton',array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>'Submit',
        )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

