<!DOCTYPE html>
<html lang="en">
<head>
<script
		src="<?php echo app()->theme->baseUrl;?>/public/js/jquery.min.js"></script>
	<script
		src="<?php echo app()->theme->baseUrl;?>/public/js/bootstrap.min.js"></script>
	<script
		src="<?php echo app()->theme->baseUrl;?>/public/js/jquery.ui.custom.js"></script>
		<title><?php echo app()->name;?></title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet"
	href="<?php echo app()->theme->baseUrl;?>/public/css/matrix-style.css" />
<link rel="stylesheet"
	href="<?php echo app()->theme->baseUrl;?>/public/css/matrix-media.css" />
<link
	href="<?php echo app()->theme->baseUrl;?>/public/font-awesome/css/font-awesome.css"
	rel="stylesheet" />
<link
	href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800'
	rel='stylesheet' type='text/css'>
	
</head>
<body>

	<!--Header-part-->
	<div id="header">
		<h1>
			<a href="<?php echo r()->baseUrl;?>">Matrix Admin</a>
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
					<span class="text">Welcome User</span>
					<b class="caret"></b>
				</a>
				<ul class="dropdown-menu">
					<li>
						<a href="widgets.html#">
							<i class="icon-user"></i>
							My Profile
						</a>
					</li>
					<li class="divider"></li>
					<li>
						<a href="widgets.html#">
							<i class="icon-check"></i>
							My Tasks
						</a>
					</li>
					<li class="divider"></li>
					<li>
						<a href="login.html">
							<i class="icon-key"></i>
							Log Out
						</a>
					</li>
				</ul>
			</li>
			<li class="dropdown" id="menu-messages">
				<a href="widgets.html#" data-toggle="dropdown"
					data-target="#menu-messages" class="dropdown-toggle">
					<i class="icon icon-envelope"></i>
					<span class="text">Messages</span>
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
						<a class="sOutbox" title="" href="widgets.html#">
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
				<a title="" href="widgets.html#">
					<i class="icon icon-cog"></i>
					<span class="text">Settings</span>
				</a>
			</li>
			<li class="">
				<a title="" href="login.html">
					<i class="icon icon-share-alt"></i>
					<span class="text">Logout</span>
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
						'label' => 'Home',
						'url' => array (
								'site/index' 
						),
						'icon' => 'icon icon-home' 
				),
				// 'Products' menu item will be selected no matter which tag parameter value is since it's not specified.
				array (
						'label' => 'Products',
						'url' => array (
								'product/index' 
						),
						'items' => array (
								array (
										'label' => 'Home',
										'url' => array (
												'site/contact' 
										) 
								),
								array (
										'label' => 'Most Popular',
										'url' => array (
												'site/page',
												'view' => 'about' 
										) 
								) 
						),
						'itemOptions' => array (
								'class' => 'submenu' 
						),
						'icon' => 'icon icon-inbox' 
				),
				array (
						'label' => 'Login',
						'url' => array (
								'site/login' 
						),
						'visible' => Yii::app ()->user->isGuest 
				) 
		) 
) );
?>
</div>
	<!--sidebar-menu-->

	<!--main-container-part-->
	<?php echo $content;?>
	<!--main-container-part-->

	<!--Footer-part-->
	<div class="row-fluid">
		<div id="footer" class="span12">
			2013 &copy; Matrix Admin. Brought to you by
			<a href="http://themedesigner.in">Themedesigner.in</a>
		</div>
	</div>
	<!--end-Footer-part-->
	
	<script src="<?php echo app()->theme->baseUrl;?>/public/js/matrix.js"></script>
</body>
</html>
