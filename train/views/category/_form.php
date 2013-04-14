<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'category-form',
    'action'=>$model->isNewRecord?url('/category/create'):url('/category/update',array('id'=>$model->id)),
    'htmlOptions'=>array('class'=>'well'),
    'enableAjaxValidation' => false,
)); 

?>
<?php echo $form->textFieldRow($model, 'name', array('maxlength' => 200,'class'=>'span12')); ?>
	<?php echo $form->dropDownListRow($model, 'parent', $model->getParentOptionTree(),array('class'=>'span12')); ?>
	
	<?php echo $form->textFieldRow($model, 'slug', array('maxlength' => 200)); ?>
	<?php echo $form->redactorRow($model, 'description', array('class'=>'span4', 'rows'=>5));?>
<div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>t('app|Submit'))); ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>t('app|Reset'))); ?>
        <?php if(!$model->isNewRecord){$this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'ajaxLink', 'type'=>'danger', 'label'=>t('app|Delete'),'url'=>array('delete','id'=>$model->id),'ajaxOptions'=>array('type' =>'POST','replace'=>'#categorylistview')));} ?>
    </div>
<?php $this->endWidget(); ?>