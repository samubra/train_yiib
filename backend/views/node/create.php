<?php
$this->breadcrumbs = array(
    $model->label(2) => array('index'),
    Yii::t('app', 'Create'),
);
$this->headTitle = GxHtml::encode($model->label()) . '管理';
$this->menu = array(
    array('label' => Yii::t('app', 'List') . ' ' . $model->label(2), 'url' => array('index')),
    array('label' => Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url' => array('admin')),
);
?>



        <?php
        $this->renderPartial('_form', array(
            'model' => $model,
            'category' => $category,
            'item'=>$item,
            'validatedItem'=>$validatedItem,
            'buttons' => 'create'));
        ?>