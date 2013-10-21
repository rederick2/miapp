<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form TbActiveForm */

$this->pageTitle=Yii::app()->name . ' - Edit Profile';
$this->breadcrumbs=array(
	'Register',
);
?>

<h1>Registar</h1>

<?php if(Yii::app()->user->hasFlash('register')): ?>

    <?php $this->widget('bootstrap.widgets.TbAlert', array(
        'alerts'=>array('register'),
    )); ?>

<?php else: ?>

<p>
If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
</p>

<?php endif; ?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'register-profile-form',
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

			<?php echo $form->textFieldRow($model,'first_name' ); ?>

			<?php echo $form->textFieldRow($model,'last_name'); ?>

		    <?php echo $form->textFieldRow($model,'username'); ?>

		    <?php echo $form->textFieldRow($model,'e_mail'); ?>

		    <?php echo $form->passwordFieldRow($model,'password'); ?>

		    <?php echo $form->passwordFieldRow($model,'password_repeat'); ?>

		    <?php echo $form->datepickerRow(
		            $model,
		            'username',
		            array(
		                'options' => array('language' => Yii::app()->language),
		                'hint' => 'Click inside! This is a super cool date field.',
		                'prepend' => '<i class="icon-calendar"></i>'
		            )
		        ); 
		    ?>

		    <?php echo CHtml::hiddenField('UserForm[picture]'); ?>

		</div>

		<div class="span4">

			<?php
			  /* $this->widget('ext.imageSelect.ImageSelect',  array(
			        'path'=>'../uploads/image.jpg',
			        'alt'=>'alt text',
			        'uploadUrl'=>'Upload',
			        'htmlOptions'=>array('class'=>'thumbnail' , 'width' => 250)
			   ));*/
			?>

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

