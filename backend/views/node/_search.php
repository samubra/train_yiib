<div class="wide form">

<?php $form = $this->beginWidget('GxActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model, 'id'); ?>
		<?php echo $form->textField($model, 'id', array('maxlength' => 10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'text'); ?>
		<?php echo $form->textArea($model, 'text'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'created'); ?>
		<?php echo $form->textField($model, 'created', array('maxlength' => 10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'modified'); ?>
		<?php echo $form->textField($model, 'modified', array('maxlength' => 10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'uid'); ?>
		<?php echo $form->textField($model, 'uid', array('maxlength' => 10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'status'); ?>
		<?php echo $form->textField($model, 'status', array('maxlength' => 16)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'extent'); ?>
		<?php echo $form->textField($model, 'extent'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'parent'); ?>
		<?php echo $form->textField($model, 'parent'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'itemNum'); ?>
		<?php echo $form->textField($model, 'itemNum', array('maxlength' => 10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'aloowPublic'); ?>
		<?php echo $form->textField($model, 'aloowPublic', array('maxlength' => 1)); ?>
	</div>

	<div class="row buttons">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
