<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Yii::t('app', 'Manage'),
);

$this->menu = array(
		array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
		array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
	);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('metas-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php 
$this->widget('bootstrap.widgets.TbGridView', array(
'type'=>'condensed',
'dataProvider'=>$model->search(),
'template'=>"{items}",
'columns'=>array(
    'id',
'uid',
'name',
'slug',
'type',
'description',
'count',
/*
 
'order',
'parent',
*/
),
));
?>
