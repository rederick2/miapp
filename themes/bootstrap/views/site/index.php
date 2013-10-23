<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;

$this->widget('ext.dropzone.EDropzone', array(
    'model' => $model,
    'attribute' => 'file',
    'url' => $this->createUrl('site/upload'),
    'mimeTypes' => array('image/jpeg', 'image/png'),
    //'onSuccess' => 'someJsFunction();',
    'onRemove' => 'console.log(file);',
    'options' => array('addRemoveLinks' =>true),
));

?>







