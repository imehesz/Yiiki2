<?php
$this->breadcrumbs=array(
'Pages'=>array('index'),
$model->title,
);
?>
<h1><?php echo strtoupper($model->title); ?></h1>

<div>
<?php echo CHtml::link('Oldalak Listaja',array('index')); ?> 
<?php echo CHtml::link('Oldal Frissitese',array('update','title'=>$model->title)); ?> 
<?php echo CHtml::linkButton('Oldal Torlese',array('submit'=>array('delete','title'=>$model->title),'confirm'=>'Biztos, hogy toroljem?')); ?> 
</div>

<div style="margin-top:20px;">
<?php echo $model->body; ?>
</div>
