<?php

$this->breadcrumbs = array(
	Item::label(2),
	Yii::t('app', 'Index'),
);
$this->headTitle=GxHtml::encode(Item::label(2));
$this->menu = array(
	array('label'=>Yii::t('app', 'Create') . ' ' . Item::label(), 'url' => array('create')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . Item::label(2), 'url' => array('admin')),
);
?>
								<div class="widget-box span6">
          <div class="widget-title"> <span class="icon"><i class="icon-repeat"></i></span>
            <h5>Recent Activity</h5>
          </div>
          <div class="widget-content nopadding">
          <?php $this->widget('zii.widgets.CListView', array(
				'dataProvider'=>$dataProvider,
				'itemView'=>'_view',
			)); ?>
            <ul class="activity-list">
            
              <li><a href="#"> <i class="icon-user"></i> <strong>Themeforest</strong>Approved My college theme <strong>1 user</strong> <span>2 hours ago</span> </a></li>
              <li><a href="#"> <i class="icon-file"></i> <strong>My College is PSD Template </strong> Theme <strong>Psd Theme</strong> <span>2months ago</span> </a></li>
              <li><a href="#"> <i class="icon-envelope"></i> <strong>Lorem ipsum doler set</strong> adag<strong>agg</strong> <span>2 days ago</span> </a></li>
              <li><a href="#"> <i class="icon-picture"></i> <strong>ITs my First Admin</strong> so very<strong>exited</strong> <span>2 days ago</span> </a></li>
              <li><a href="#"> <i class="icon-user"></i> <strong>Admin</strong> bans <strong>3 users</strong> <span>week ago</span> </a></li>
            </ul>
          </div>
        </div>

	