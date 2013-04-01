<div class="modal-header">
	<a class="close" data-dismiss="modal">×</a>
	<h4><?php echo $model->isNewRecord?'添加':'修改';?>分类</h4>
</div>
<?php

$form = $this->beginWidget ( 'bootstrap.widgets.TbActiveForm', array (
		'id' => 'metas-form',
		'htmlOptions' => array (
				'class' => 'well' 
		) 
) );
?>
<div class="modal-body">
	<?php echo $form->textFieldRow($model, 'name', array('class'=>'span12')); ?>
		<?php echo $form->textFieldRow($model, 'slug', array('class'=>'span12')); ?>
		<?php 
		if($parent)
			echo $form->hiddenField($model,'parent',array('value'=>$parent));
		 ?>
		
		<?php echo $form->textAreaRow($model, 'description', array('class'=>'span12')); ?>
</div>

<div class="modal-footer">
	<?php
	
	$this->widget ( 'bootstrap.widgets.TbButton', array (
			'type' => 'primary',
			'buttonType'=>'submit',
			'label' => '保存',
			'url' => '#',
			'htmlOptions' => array (
					//'data-dismiss' => 'modal' 
			) 
	) );
	?>
	 <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'重置')); ?>
	<?php
	
	$this->widget ( 'bootstrap.widgets.TbButton', array (
			'label' => '关闭',
			'url' => '#',
			'htmlOptions' => array (
					'data-dismiss' => 'modal' 
			) 
	) );
	?>

</div>
<?php
$this->endWidget ();
?>
		

