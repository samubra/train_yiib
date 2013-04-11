<?php
/** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'node-form',
    'type' => 'vertical', //
    'htmlOptions' => array('class' => 'well'),
    'enableAjaxValidation' => false,
        ));
$itemFormConfig = array(
    'elements' => array(
        'text' => array(
            'type' => 'textarea',
            'maxlength' => 40,
            'class'=>'span12'
        ),
        'correct' => array(
            'type' => 'checkbox',
            'class'=>'span2'
        ),
        
        
        ));
?>
<?php echo $form->errorSummary($model); ?>

<?php echo $form->ckEditorRow($model, 'text', array('options' => array('fullpage' => 'js:true'))); ?>
<div class='row-fluid'>
    <div class="span8 well">
        <fieldset>

            <?php
            Yii::app()->bootstrap->registerAssetCss('redactor.css');
		Yii::app()->bootstrap->registerAssetJs('redactor.min.js');
            $this->widget('ext.multimodelform.MultiModelForm', array(
                'id' => 'id_item', //the unique widget id
                'formConfig' => $itemFormConfig, //the form configuration array
                'model' => $item, //instance of the form model
                //if submitted not empty from the controller,
                'removeText' => '<i class="icon-remove"></i>', 
                'addItemText'=>'<i class="icon-plus"></i>添加选项',
                'addItemAsButton'=>true,
                'removeConfirm'=>'你确定要删除它？',
                'bootstrapLayout'=>true,
                'tableView'=>true,
                'limit'=>2,
                //the form will be rendered with validation errors
                'validatedItems' => $validatedItem,
               // 'jsAfterNewId' => "function(){\$(\'#+this.attr('id')+\').redactor();}",
                //array of member instances loaded from db
                'data' => $item->findAll('nid=:nid', array(':nid' => $model->id)),
            ));
            ?>
        </fieldset>
    </div>

    <div class='span4 well'>
        <fieldset>
<?php echo $form->dropDownListRow($model, 'cid', $category->getParentOptionTree()); ?>


            <?php echo $form->textFieldRow($model, 'extent', array('hint' => 'In addition to freeform text, any HTML5 text-based input appears like so.'));
            ?>
<?php echo $form->radioButtonListInlineRow($model, 'aloowPublic', array('否', '是')); ?>
            <?php echo $form->checkBoxListRow($model, 'tag', GxHtml::encodeEx(GxHtml::listDataEx(Tag::model()->findAllAttributes(null, true)), true, true)); ?>
        </fieldset>
    </div>
</div>
<div class="form-actions">
<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'primary', 'label' => 'Submit')); ?>
<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'reset', 'label' => 'Reset')); ?>
</div>
    <?php
    $this->endWidget();
    ?>