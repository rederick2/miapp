<?php

$this->pageTitle=Yii::app()->name . ' - Crear Fecha';
$this->breadcrumbs=array(
	'Date',
);
?>


<h1>Crear Fecha</h1>

<?php if(Yii::app()->user->hasFlash('create')): ?>

    <?php $this->widget('bootstrap.widgets.TbAlert', array(
        'alerts'=>array('create'),
    )); ?>

<?php else: ?>

<p>
If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
</p>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'contact-form',
    'type'=>'horizontal',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldRow($model,'startDate'); ?>

    <?php echo $form->textFieldRow($model,'endDate'); ?>

    <?php echo $form->textFieldRow($model,'headline'); ?>

    <?php echo $form->textFieldRow($model,'text',array('size'=>60,'maxlength'=>128)); ?>

    <?php echo $form->textFieldRow($model,'tag'); ?>

    <tr></tr>

    <p>
		Agrega url de: imagen, video(vimeo, youtube) o musica.
	</p>

    <?php echo $form->textFieldRow($model,'media'); ?>

    <?php echo $form->textFieldRow($model,'credit'); ?>

    <?php echo $form->textFieldRow($model,'caption'); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton',array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>'Submit',
        )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php endif; ?>