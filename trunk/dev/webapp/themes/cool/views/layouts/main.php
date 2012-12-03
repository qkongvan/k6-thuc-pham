<!DOCTYPE html>
<!--[if lt IE 7]> <html class="ie6 msie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="ie7 msie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="ie8 msie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	
	<!--[if lte IE 8]>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<![endif]-->
	
	<!--meta name="viewport" content="width=device-width,initial-scale=1"-->
	<link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon.ico">
	
	<!--[if lt IE 9]>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/javascript/html5.js"></script>
	<![endif]-->
	
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/stylesheets/form.css">
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/stylesheets/base.css">
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/stylesheets/content.css">
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/stylesheets/collapsibleLists.css">
	<!--link rel="stylesheet" media="all and (min-width: 1002px) and (max-width: 1247px)" href="<?php echo Yii::app()->request->baseUrl; ?>/stylesheets/978.css"-->
	<!--link rel="stylesheet" media="all and (min-width: 768px) and (max-width: 1001px)" href="<?php echo Yii::app()->request->baseUrl; ?>/stylesheets/748.css"-->
	<!--link rel="stylesheet" media="all and (min-width: 0px) and (max-width: 767px)" href="<?php echo Yii::app()->request->baseUrl; ?>/stylesheets/300.css"-->
	
	<?php Yii::app()->getClientScript()->registerCssFile('/stylesheets/grid960.css'); ?>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body data-theme="none">

<!-- page -->
<div id="container">

	<!-- header -->
	<div id="header-wrapper">
		<header id="header" role="banner">
			<center><div id="banner"></div></center>
			<!--h1><a href="#"></a><span><?php echo CHtml::encode(Yii::app()->name); ?></span></h1-->
			<div id="i18n">
				<a href="#" title="Tiếng Việt"><img src="/images/flag_vn.png" alt="Tiếng Việt"/></a>
				<a href="#" title="English"><img src="/images/flag_en.png" title="English"/></a>
			</div>
			<fieldset id="search">
				<label for="keyword">Search</label>
				<input type="text" placeholder="Search..." id="keyword" name="keyword">
				<input type="submit" value="Search">
			</fieldset>
			<!-- mainmenu -->
			<nav id="nav">
				<?php $this->widget('widgets.HMenu',array(
					'activeCssClass'=>'current',
					'items'=>array(
						//array('label'=>'Trang Chủ', 'url'=>array('/site/index'), 'linkOptions'=>array('data-theme'=>'green')),
						array('label'=>'Trang Chủ', 'url'=>array('/products/shop'), 'linkOptions'=>array('data-theme'=>'green')),
						array('label'=>'Giới Thiệu', 'url'=>array('/site/page', 'view'=>'about'), 'linkOptions'=>array('data-theme'=>'green')),
		                // array('label'=>'Đối Tác', 'url'=>array('/doitac/index'), 'linkOptions'=>array('data-theme'=>'green')),
						array('label'=>'Tin Tức', 'url'=>array('/news/index'), 'linkOptions'=>array('data-theme'=>'green')),
						array('label'=>'Liên Hệ', 'url'=>array('/site/contact'), 'linkOptions'=>array('data-theme'=>'green')),
						array('label'=>'Tuyển Dụng', 'url'=>array('/site/recruitment'), 'linkOptions'=>array('data-theme'=>'green')),
		                // Module User
						// array('label'=>Yii::app()->getModule('user')->t("Login"), 'url'=>array('/user/login'), 'visible'=>Yii::app()->user->isGuest, 'linkOptions'=>array('data-theme'=>'green')),
						// array('label'=>Yii::app()->getModule('user')->t("Register"), 'url'=>array('/user/register'), 'visible'=>Yii::app()->user->isGuest, 'linkOptions'=>array('data-theme'=>'green')),
						// array('label'=>Yii::app()->getModule('user')->t("Profile"), 'url'=>array('/user/profile'), 'visible'=>!Yii::app()->user->isGuest, 'linkOptions'=>array('data-theme'=>'green')),
						// array('label'=>Yii::app()->getModule('user')->t("Logout").' ('.Yii::app()->user->name.')', 'url'=>array('/user/logout'), 'visible'=>!Yii::app()->user->isGuest, 'linkOptions'=>array('data-theme'=>'green')),
					),
				)); ?>
			</nav>
			<!-- mainmenu -->
		</header>
	</div>
	
	<div id="main-wrapper">
		<!-- main -->
		<div id="main" class="clearfix" role="main">
			<?php echo $content; ?>
		</div>
	</div>

	<!-- footer -->
	<div id="footer-wrapper">
		<footer id="footer" role="contentinfo">
			<h2 style="position:relative;text-indent: 3.5em;padding:55px 0 0px">
				<img src="/images/logo2.png" width="120" style="position:absolute;top:-6px;left:0px"/>DNTN Phú Tứ
			</h2>
			<div class="group">
				<section>
					<h3>Rau sạch Thành Vinh - Rau sạch Nghệ An</h3>
					<nav>
						<ul>
							<li>Số 05 - Nguyễn Bỉnh Khiêm - TP. Vinh - Nghệ An</li>
							<li>Email: rausachthanhphovinh@gmail.com</li>
							<li>Sykpe: rausachthanhphovinh</li>
							<li>Yahoo: rausachthanhphovinh</li>
						</ul>
					</nav>
				</section>
			</div>
		</footer>
	</div>

</div>

<?php
Yii::app()->clientScript->registerCssFile(
	Yii::app()->assetManager->publish(
		Yii::app()->basePath . '/extensions/jquery-ui-1.8.16.custom/css/start/'
	).'/jquery-ui-1.8.16.custom.css',
	'screen'
);
?>
<?php $this->widget('widgets.HDialog.HjQueryUiDialogWidget'); ?>

<!-- scripts -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/javascript/plugins.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/javascript/script.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/javascript/swfobject.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/javascript/CollapsibleLists.compressed.js"></script>

<!--[if lte IE 8]>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/javascript/jquery.media-query.min.js"></script>
<![endif]-->

<script type="text/javascript">
	swfobject.embedSWF("/images/banner.swf", "banner", "1218", "240", "9.0.0", "/images/expressInstall.swf", {}, {wmode:'transparent'});
	CollapsibleLists.apply();
</script>
</body>
</html>