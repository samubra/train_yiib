<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
                    <div class="span12">                    
                        <div class="head clearfix">
                            <div class="<?php echo $this->blockIcon;?>"></div>
                            <h1><?php echo CHtml::encode($this->blockTitle);?></h1>   
                            <?php if($this->menu){?>
                            <ul class="buttons">
                                <li>
                                    <a href="index.html#" class="isw-settings"></a>
                                    <?php 
                                    $this->widget('Menu', array(
										'items'=>$this->menu,
										'htmlOptions'=>array('class'=>'dd-list'),
									));
									?>
                                </li>
                            </ul> 
                            <?php }?>                       
                        </div>
                        <div class="block">
                            <?php echo $content; ?>
                        </div>
                    </div>   


<?php $this->endContent(); ?>