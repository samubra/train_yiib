<?php

$this->breadcrumbs = array(
	Category::label(2),
	Yii::t('app', 'Index'),
);

$this->menu = array(
	array('label'=>Yii::t('app', 'Create') . ' ' . Category::label(), 'url' => array('create')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . Category::label(2), 'url' => array('admin')),
);
?>

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
                                    <div class="btn-group">
                                        <button class="btn btn-small tip" id="faqOpenAll" title="Open all"><span class="icon-chevron-down icon-white"></span></button>
                                        <button class="btn btn-small tip" id="faqCloseAll" title="Close all"><span class="icon-chevron-up icon-white"></span></button>
                                    </div>
                                </div>
                            </div>                                                        
                            <div class="faq">
                                
                          <?php Category::model()->renderTree();?>
                            </div>
                        </div>
                    </div>
                    <div class="span4"> 
                        
                        
                        <div class="block-fluid nm without-head">
                            <div class="toolbar nopadding-toolbar clear clearfix">
                                <h4>Still have questions?</h4>
                            </div>                            
                            
                                <div class="row-form clearfix">
                                    <div class="span3">Name</div>
                                    <div class="span9">                                      
                                        <input type="text" placeholder="Name">
                                    </div>
                                </div>
                                <div class="row-form clearfix">
                                    <div class="span3">Email</div>
                                    <div class="span9">                                    
                                        <input type="text" placeholder="Email">
                                    </div>
                                </div>                                
                                <div class="row-form clearfix">
                                    <div class="span12">
                                        <textarea name="text"></textarea> 
                                   </div>
                                </div>                                                                          
                            
                            <div class="footer tar">
                                <button class="btn">Send</button>
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
        $(\".faq .item .title\").click(function(){
        var text = $(this).parent('.item').find('.text');
        
        if(text.is(':visible'))
            text.fadeOut();
        else
            text.fadeIn();                
    });

    
    $(\"#faqListController a\").click(function(){
        var open = $(this).attr('href');
        $(open).find('.text').fadeIn();
    });
    
    $(\"#faqOpenAll\").click(function(){
        $(\".faq\").find('.text').fadeIn();
    });
    
    $(\"#faqCloseAll\").click(function(){
        $(\".faq\").find('.text').fadeOut();
    });
    })(jQuery);
" );

?>