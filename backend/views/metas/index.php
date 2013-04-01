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
Yii::app ()->clientScript->registerScriptFile ( app ()->theme->baseUrl . '/public/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js', CClientScript::POS_HEAD );
Yii::app ()->clientScript->registerScript ( 'scall', "
(function($){
        $(window).load(function(){
            $(\".scorll\").mCustomScrollbar();
        });
    })(jQuery);
" );
Yii::app ()->clientScript->registerScript ( 'ajaxform', "
$('#document').ready(function(){
    $('.openDlg').live('click', function(){
        var dialogId = $(this).attr('class').replace('openDlg ', \"\");
        $.ajax({
            'type': 'POST',
            'url' : $(this).attr('href'),
            success: function (data) {
                $('#'+dialogId+' div.divForForm').html(data);
                $( '#'+dialogId ).dialog( 'open' );
            },
            dataType: 'html'
        });
        return false; // prevent normal submit
    })
});
" );
?>
<div class="span8">
	<div class="head clearfix">
		<div class="isw-list"></div>
		<h1>分类列表</h1>
		<ul class="buttons">
			<li>
			<?php
			
			echo CHtml::link ( '<i class="isw-plus"></i>', array (
					'metas/create',
					'new' => true 
			), array (
					'class' => 'openDlg myModal',
					'data-original-title' => '添加分类',
					'ral' => 'tooltip',
					'data-toggle' => 'modal',
					'data-target' => '#myModal' 
			) );
			?>
			
			</li>
		</ul>
	</div>

	<div class="block scorll" style="height: 460px;">
	<?php
	
	$this->widget ( 'bootstrap.widgets.TbGridView', array (
			'type' => 'bordered',
			'dataProvider' => $categoryModel,
			'template' => "{items}",
			'hideHeader' => true,
			'enablePagination' => false,
			'columns' => array (
					array(
					/*'class'=>'CLinkColumn',
					'labelExpression'=>'$data->name',
					'urlExpression'=>'url("/metas",array("id"=>$data->id,"type"=>$data->type))'*/
					'name' => 'name',
							'value' => array (
									$this,
									'getNameText' 
							) 
					),
					array (
							'htmlOptions' => array (
									'nowrap' => 'nowrap',
									'width' => '100px' 
							),
							'class' => 'bootstrap.widgets.TbButtonColumn',
							'template' => '{child}{update}{view}{delete}',
							'buttons' => array (
									'child' => array (
											'label' => '添加子级分类',
											'url' => 'url("metas/create",array("id"=>$data->id))',
											'icon' => 'plus-sign',
											'options' => array (
													'class' => 'openDlg myModal',
													'data-toggle' => 'modal',
													'data-target' => '#myModal' 
											) 
									),
									'view' => array (
											// 'label' => '添加子级分类',
											'url' => 'url("metas/view",array("id"=>$data->id))',
											// 'icon' => 'plus-sign',
											'options' => array (
													'class' => 'openDlg myModal',
													'data-toggle' => 'modal',
													'data-target' => '#myModal' 
											) 
									),
									'update' => array (
											// 'label' => '添加子级分类',
											'url' => 'url("metas/update",array("id"=>$data->id))',
											// 'icon' => 'plus-sign',
											'options' => array (
													'class' => 'openDlg myModal',
													'data-toggle' => 'modal',
													'data-target' => '#myModal' 
											) 
									) 
							) 
					) 
			) 
	) );
	
	?>
</div>
</div>
<div class="span4">
	<div class="head clearfix">
		<div class="isw-archive"></div>
		<h1>标签列表</h1>
	</div>
	<div class="block">
		<?php
		$labelList = array (
				'success',
				'warning',
				'important',
				'info',
				'inverse' 
		);
		foreach ( $tagModel as $data ) {
			$label = array_rand ( $labelList, 1 );
			echo '<span class="text-' . $labelList [$label] . '" style="font-size:' . CHtml::encode ( $data->count + 12 ) . 'px"><a href="' . url ( '/node/index', array (
					'id' => CHtml::encode ( $data->id ) 
			) ) . '">' . CHtml::encode ( $data->name ) . '</a></span>';
		}
		?>
	</div>
</div>
<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'myModal')); ?>
<div class="divForForm"></div>
<?php $this->endWidget(); ?>
