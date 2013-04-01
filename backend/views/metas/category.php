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

<div class="span6">
	<div class="head clearfix">
		<div class="isw-list"></div>
		<h1>分类列表</h1>
	</div>
	
	<div class="block scorll"  style="height: 460px;">
	<?php

$this->widget ( 'bootstrap.widgets.TbGridView', array (
		'type' => 'bordered',
		'dataProvider' => $model,
		'template' => "{items}",
		'hideHeader'=>true,
		'enablePagination'=>false,
		'columns' => array (
				array(
					/*'class'=>'CLinkColumn',
					'labelExpression'=>'$data->name',
					'urlExpression'=>'url("/metas",array("id"=>$data->id,"type"=>$data->type))'*/
					'name'=>'name',
					'value'=>array($this,'getNameText')
						
				),
				/*array(
					'htmlOptions' => array('nowrap'=>'nowrap','width'=>'100px'),
					'class'=>'bootstrap.widgets.TbButtonColumn',
					'viewButtonUrl'=>null,
					'updateButtonUrl'=>null,
					'deleteButtonUrl'=>null,
				)*/
		)
		 
) );

?>
</div>
</div>
<div class="span6">
	<div class="head clearfix">
		<div class="isw-archive"></div>
		<h1>标签列表</h1>
	</div>
	<div class="block">
		
	</div>
</div>