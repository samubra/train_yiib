<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'category-form',
	'enableAjaxValidation' => true,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'uid'); ?>
		<?php echo $form->textField($model, 'uid', array('maxlength' => 10)); ?>
		<?php echo $form->error($model,'uid'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'parent'); ?>
		<?php echo $form->textField($model, 'parent', array('maxlength' => 10)); ?>
		<?php echo $form->error($model,'parent'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model, 'name', array('maxlength' => 200)); ?>
		<?php echo $form->error($model,'name'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'slug'); ?>
		<?php echo $form->textField($model, 'slug', array('maxlength' => 200)); ?>
		<?php echo $form->error($model,'slug'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->textField($model, 'type', array('maxlength' => 32)); ?>
		<?php echo $form->error($model,'type'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model, 'description', array('maxlength' => 200)); ?>
		<?php echo $form->error($model,'description'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'count'); ?>
		<?php echo $form->textField($model, 'count', array('maxlength' => 10)); ?>
		<?php echo $form->error($model,'count'); ?>
		</div><!-- row -->

		<label><?php echo GxHtml::encode($model->getRelationLabel('node')); ?></label>
		<?php echo $form->checkBoxList($model, 'node', GxHtml::encodeEx(GxHtml::listDataEx(Node::model()->findAllAttributes(null, true)), false, true)); ?>

<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->