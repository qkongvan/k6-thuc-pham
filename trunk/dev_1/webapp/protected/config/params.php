<?php

// this contains the application parameters that can be maintained via GUI
return array(
	// this is displayed in the header section
	'title'=>'My Yii Blog',
	// this is used in error pages
	'adminEmail'=>'webmaster@example.com',
	// number of posts displayed per page
	'postsPerPage'=>10,
	// maximum number of comments that can be displayed in recent comments portlet
	'recentCommentCount'=>10,
	// maximum number of tags that can be displayed in tag cloud portlet
	'tagCloudCount'=>20,
	// whether post comments need to be approved before published
	'commentNeedApproval'=>true,
	// the copyright information displayed in the footer section
	'copyrightInfo'=>'Copyright &copy; 2011 by o0www0o.',
	// System salt
	'systemSalt'=>'31ba34f34f123',
	// System mail
	'mailer' => array(
		'host' => 'smtp.gmail.com',
		'port' => '587',
		'secure' => 'tls',
		'username' => 'justlookwd@gmail.com',
		'password' => 'toancauxanh',
		'name' => 'JustLook',
	),
);
