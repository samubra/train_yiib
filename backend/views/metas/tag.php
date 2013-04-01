<?php
$this->breadcrumbs = array (
		Metas::label ( 2 ),
		Yii::t ( 'app', 'Index' ) 
);

$this->menu = array (
		array (
				'label' => Yii::t ( 'app', 'Create' ) . ' ' . Metas::label (),
				'url' => array (
						'create' 
				) 
		),
		array (
				'label' => Yii::t ( 'app', 'Manage' ) . ' ' . Metas::label ( 2 ),
				'url' => array (
						'admin' 
				) 
		) 
);
Yii::app()->clientScript->registerScriptFile(app()->theme->baseUrl.'/public/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js',CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScript('scall', "
(function($){
        $(window).load(function(){
            $(\".scorll\").mCustomScrollbar();
        });
    })(jQuery);
");
?>
<div class="span8">
	<div class="head clearfix">
		<div class="isw-list"></div>
		<h1><?php echo Metas::getTypeText($type);?>列表</h1>
	</div>
	<div class="block scorll"  style="height: 460px;">
	<?php

$this->widget ( 'bootstrap.widgets.TbGridView', array (
		'type' => 'bordered',
		'dataProvider' => $model,
		'template' => "{items}",
		'hideHeader'=>true,
		'columns' => array (
				array(
					'class'=>'CLinkColumn',
					'labelExpression'=>'$data->name',
					'urlExpression'=>'url("/metas",array("id"=>$data->id,"type"=>$data->type))'
					
				),
				array(
					'htmlOptions' => array('nowrap'=>'nowrap','width'=>'100px'),
					'class'=>'bootstrap.widgets.TbButtonColumn',
					'viewButtonUrl'=>null,
					'updateButtonUrl'=>null,
					'deleteButtonUrl'=>null,
				)
		)
		 
) );
?>
</div>
</div>
<div class="span4">
	<div class="head clearfix">
		<div class="isw-archive"></div>
		<h1>添加<?php echo Metas::getTypeText($type);?></h1>
	</div>
	<div class="block">
		<?php
		$this->renderPartial('_form', array(
				'model' => $metasModel,
				'buttons' => 'create'));
		?>
	</div>
</div>