<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
                <div id="content">
		<div id="content-header">
  <?php
		$this->widget ( 'zii.widgets.CBreadcrumbs', array (
				'htmlOptions'=>array('id'=>'breadcrumb'),
				'links' => $this->breadcrumbs,
		) );
		?>
		</div>
		<div class="container-fluid">
			<div class="row-fluid">
				
				<div class="span12">
					<div class="widget-box">
						<div class="widget-title">
							<span class="icon">
								<i class="icon-time"></i>
							</span>
							<h5>To Do List</h5>
						</div>
						<div class="widget-content nopadding">
							<?php echo $content;?>
						</div>
					</div>
					
				</div>
			</div>
			
		</div>
	</div>


<?php $this->endContent(); ?>