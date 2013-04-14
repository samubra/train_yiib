<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
                
	<!--Header-part-->
	<div id="header">
		<h1>
			<a href="<?php echo r()->baseUrl;?>"><?php echo app()->name;?></a>
		</h1>
	</div>
	<!--close-Header-part-->

	<!--top-Header-menu-->
	<div id="user-nav" class="navbar navbar-inverse">

		<ul class="nav">
			<li class="dropdown" id="profile-messages">
				<a title="" href="widgets.html#" data-toggle="dropdown"
					data-target="#profile-messages" class="dropdown-toggle">
					<i class="icon icon-user"></i>
					<span class="text"><?php echo h(app()->user->getRoleName()),'：',h(Yii::app()->user->name);?></span>
					<b class="caret"></b>
				</a>
				<ul class="dropdown-menu">
					<li>
						<a href="#">
							<i class="icon-user"></i>
							我的个人资料
						</a>
					</li>
					<li class="divider"></li>
					<li>
						<a href="<?php echo url('site/logout');?>">
							<i class="icon-key"></i>
							注销
						</a>
					</li>
				</ul>
			</li>
			<li class="dropdown" id="menu-messages">
				<a href="widgets.html#" data-toggle="dropdown"
					data-target="#menu-messages" class="dropdown-toggle">
					<i class="icon icon-envelope"></i>
					<span class="text">信息中心</span>
					<span class="label label-important">5</span>
					<b class="caret"></b>
				</a>
				<ul class="dropdown-menu">
					<li>
						<a class="sAdd" title="" href="widgets.html#">
							<i class="icon-plus"></i>
							new message
						</a>
					</li>
					<li class="divider"></li>
					<li>
						<a class="sInbox" title="" href="widgets.html#">
							<i class="icon-envelope"></i>
							inbox
						</a>
					</li>
					<li class="divider"></li>
					<li>
						<a class="sOutbox" title="" href="#">
							<i class="icon-arrow-up"></i>
							outbox
						</a>
					</li>
					<li class="divider"></li>
					<li>
						<a class="sTrash" title="" href="widgets.html#">
							<i class="icon-trash"></i>
							trash
						</a>
					</li>
				</ul>
			</li>
			<li class="">
				<a title="" href="#">
					<i class="icon icon-cog"></i>
					<span class="text">设置</span>
				</a>
			</li>
			<li class="">
				<a title="" href="<?php echo url('site/logout');?>">
					<i class="icon icon-share-alt"></i>
					<span class="text">注销</span>
				</a>
			</li>
		</ul>
	</div>

	<!--start-top-serch-->
	<div id="search">
		<input type="text" placeholder="Search here..." />
		<button type="submit" class="tip-bottom" title="Search">
			<i class="icon-search icon-white"></i>
		</button>
	</div>
	<!--close-top-serch-->

	<!--sidebar-menu-->
	<div id="sidebar">
		<a href="widgets.html#" class="visible-phone">
			<i class="icon icon-inbox"></i>
			Widgets
		</a>
<?php

/**
 * zii.widgets.C*
 */
$this->widget ( 'Menu', array (
		'linkLabelWrapper' => 'span',
		'iconWrapper' => 'i',
		'activateParents' => true,
		'activeCssClass' => 'active open',
		'items' => array (
				// Important: you need to specify url as 'controller/action',
				// not just as 'controller' even if default acion is used.
				array (
						'label' => '首页',
						'url' => array (
								'site/index' 
						),
						'icon' => 'icon icon-dashboard' 
				),
				// 'Products' menu item will be selected no matter which tag parameter value is since it's not specified.
				array (
						'label' => '班级管理',
						'url' => array (
								'product/index' 
						),
						'items' => array (
								array (
										'label' => '特种作业培训',
										'url' => array (
												'site/contact' 
										) 
								),
								array (
										'label' => '微企培训管理',
										'url' => array (
												'site/page',
												'view' => 'about' 
										) 
								) 
						),
						'itemOptions' => array (
								'class' => 'submenu' 
						),
						'icon' => 'icon icon-sitemap' 
				),
				array (
						'label' => '项目管理',
						'url' => array (
								'item/index'
						),
						'icon' => 'icon icon-cogs',
						'visible'=>(Yii::app()->user->canAccess(8)),
				),
				array (
						'label' => '文档生成管理',
						'url' => array (
								'product/index'
						),
						'items' => array (
								array (
										'label' => '特种作业培训',
										'url' => array (
												'site/contact'
										)
								),
								array (
										'label' => '微企培训管理',
										'url' => array (
												'site/page',
												'view' => 'about'
										)
								)
						),
						'itemOptions' => array (
								'class' => 'submenu'
						),
						'icon' => 'icon icon-folder-close'
				),
		) 
) );
?>
</div>
	<!--sidebar-menu-->

	<!--main-container-part-->
	<div id="content">
		<div id="content-header">
  <?php
		$this->widget ( 'zii.widgets.CBreadcrumbs', array (
				'htmlOptions'=>array('id'=>'breadcrumb'),
				'links' => $this->breadcrumbs,
				'separator'=>''
		) );
		?>
		</div>
		<div class="container-fluid">
			<div class="row-fluid">
				<?php echo $content;?>
				
			</div>
			
		</div>
	</div>
	<!--main-container-part-->

	<!--Footer-part-->
	<div class="row-fluid">
		<div id="footer" class="span12">
			2013 &copy; Matrix Admin. Brought to you by
			<a href="http://themedesigner.in">Themedesigner.in</a>
		</div>
	</div>
	<!--end-Footer-part-->
	


<?php $this->endContent(); ?>