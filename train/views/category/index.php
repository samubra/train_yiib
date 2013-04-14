<?php

$this->breadcrumbs = array(
	Category::label(2)=>array('index'),
	Yii::t('app', 'Index'),
);

$this->menu = array(
	array('label'=>Yii::t('app', 'Create') . ' ' . Category::label(), 'url' => array('create')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . Category::label(2), 'url' => array('admin')),
);
?>
<div id="categorylistview">
<div class="span8">     
                        <div class="headInfo">   
                        <h5>分类列表</h5>                
                            <div class="arrow_down"></div>
                        </div>
                        <div class="block-fluid">
                            <div class="toolbar clearfix">
                                <div class="left">
                                    <div id="faqSearchResult" class="note"></div>
                                </div>
                                <div class="right">
                                    <div class="btn-group" id="treeviewcontrol_nav">
                                        <button class="btn btn-small tip" id="faqOpenAll" rel="tooltip" title="闭合所有"><a class="icon-chevron-up "></a></button>
                                        <button class="btn btn-small tip" id="faqCloseAll" rel="tooltip" title="展开所有"><a class="icon-chevron-down"></a></button>
                                        <button class="btn btn-small tip" id="faqChangeAll" rel="tooltip" title="切换"><a class="icon-retweet"></a></button>
                                    </div>
                                </div>
                            </div>                                                        
                            <div class="faq" style="height:430px" >
                                
                                <?php

                                $this->widget('common.extensions.MTreeView.MTreeView',array(
                                		'collapsed'=>false,
                                		'animated'=>'fast',
                                		//---MTreeView options from here
                                		'table'=>'{{category}}',//what table the menu would come from
                                		'hierModel'=>'adjacency',//hierarchy model of the table
                                		'conditions'=>array('uid=:ui',array(':ui'=>user()->id)),//other conditions if any
                                        //'options'=>array('class'=>'modal','data-target'=>'#myModal'),
                                		'fields'=>array(//declaration of fields
                                				'text'=>'name',//no `text` column, use `title` instead
                                				'alt'=>false,//skip using `alt` column
                                				'id_parent'=>'parent',//no `id_parent` column,use `parent_id` instead
                                				'task'=>false,
                                				'icon'=>false,
                                                'position'=>false,
                                                'tooltip'=>'description',

                                				'url'=>array('/category/view',array('id'=>'id'))
                                                //'url'=>false,
                                		),
                                        'ajaxOptions' => array ('update' => '#categoryinfo' ),
                                        'control' => '#treeviewcontrol_nav'
                                ));
                                ?>
                                
                            </div>

                        </div>
                    </div>
                    <div class="span4"> 
                        <div id="categoryinfo">
                            <div class="block-fluid nm without-head">
                                <div class="toolbar nopadding-toolbar clear clearfix">
                                    <h4>添加分类</h4>
                                </div> 
                                 <?php
                                    $this->renderPartial('_form', array(
                                            'model' => new Category));
                                    ?>                           
                            </div>
                        </div>
                    </div>
                    
</div>
<?php 
Yii::app ()->clientScript->registerScriptFile ( app ()->theme->baseUrl . '/public/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js', CClientScript::POS_END );
Yii::app ()->clientScript->registerScript ( 'scall', "
(function($){
        $(window).load(function(){
            $(\".faq\").mCustomScrollbar();
        });
        
    })(jQuery);
" );

?>
