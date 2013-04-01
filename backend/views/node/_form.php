<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'node-form',
	'enableAjaxValidation' => true,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'text'); ?>
		<?php echo $form->textArea($model, 'text'); ?>
		<?php echo $form->error($model,'text'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'created'); ?>
		<?php echo $form->textField($model, 'created', array('maxlength' => 10)); ?>
		<?php echo $form->error($model,'created'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'modified'); ?>
		<?php echo $form->textField($model, 'modified', array('maxlength' => 10)); ?>
		<?php echo $form->error($model,'modified'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'uid'); ?>
		<?php echo $form->textField($model, 'uid', array('maxlength' => 10)); ?>
		<?php echo $form->error($model,'uid'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model, 'status', array('maxlength' => 16)); ?>
		<?php echo $form->error($model,'status'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'extent'); ?>
		<?php echo $form->textField($model, 'extent'); ?>
		<?php echo $form->error($model,'extent'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'parent'); ?>
		<?php echo $form->textField($model, 'parent'); ?>
		<?php echo $form->error($model,'parent'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'itemNum'); ?>
		<?php echo $form->textField($model, 'itemNum', array('maxlength' => 10)); ?>
		<?php echo $form->error($model,'itemNum'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'aloowPublic'); ?>
		<?php echo $form->textField($model, 'aloowPublic', array('maxlength' => 1)); ?>
		<?php echo $form->error($model,'aloowPublic'); ?>
		</div><!-- row -->

		<label><?php echo GxHtml::encode($model->getRelationLabel('metas')); ?></label>
		<?php echo $form->checkBoxList($model, 'metas', GxHtml::encodeEx(GxHtml::listDataEx(Metas::model()->findAllAttributes(null, true)), false, true)); ?>
		<label><?php echo GxHtml::encode($model->getRelationLabel('item')); ?></label>
		<?php echo $form->checkBoxList($model, 'item', GxHtml::encodeEx(GxHtml::listDataEx(Item::model()->findAllAttributes(null, true)), false, true)); ?>
		<label><?php echo GxHtml::encode($model->getRelationLabel('chiledNode')); ?></label>
		<?php echo $form->checkBoxList($model, 'chiledNode', GxHtml::encodeEx(GxHtml::listDataEx(Node::model()->findAllAttributes(null, true)), false, true)); ?>

<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->