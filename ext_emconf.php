<?php

########################################################################
# Extension Manager/Repository config file for ext: "l10nserver"
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'L10n Server',
	'description' => 'Collaborative Translation System',
	'category' => 'plugin',
	'shy' => 0,
	'version' => '0.0.1',
	'dependencies' => 'extbase,fluid',
	'conflicts' => '',
	'priority' => '',
	'loadOrder' => '',
	'module' => '',
	'state' => 'alpha',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearcacheonload' => 1,
	'lockType' => '',
	'author' => 'Andriy Kushnarov',
	'author_email' => 'akushnarov@gmail.com',
	'author_company' => '',
	'CGLcompliance' => '',
	'CGLcompliance_note' => '',
	'constraints' => array(
		'depends' => array(
			'php' => '5.2.0-0.0.0',
			'typo3' => '4.3.dev-4.3.99',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:28:{s:12:"ext_icon.gif";s:4:"e499";s:14:"ext_tables.php";s:4:"8802";s:14:"ext_tables.sql";s:4:"eafe";s:37:"Classes/Controller/BlogController.php";s:4:"e2d3";s:40:"Classes/Controller/CommentController.php";s:4:"25fc";s:37:"Classes/Controller/PostController.php";s:4:"3dcb";s:29:"Classes/Domain/Model/Blog.php";s:4:"bd01";s:39:"Classes/Domain/Model/BlogRepository.php";s:4:"f656";s:32:"Classes/Domain/Model/Comment.php";s:4:"e575";s:29:"Classes/Domain/Model/Post.php";s:4:"dd62";s:39:"Classes/Domain/Model/PostRepository.php";s:4:"bc4b";s:28:"Classes/Domain/Model/Tag.php";s:4:"7d61";s:41:"Configuration/FlexForms/flexform_list.xml";s:4:"ed1a";s:25:"Configuration/TCA/tca.php";s:4:"d2f7";s:34:"Configuration/TypoScript/setup.txt";s:4:"375b";s:65:"Resources/Private/Icons/icon_tx_blogexample_domain_model_blog.gif";s:4:"50a3";s:68:"Resources/Private/Icons/icon_tx_blogexample_domain_model_comment.gif";s:4:"50a3";s:65:"Resources/Private/Icons/icon_tx_blogexample_domain_model_post.gif";s:4:"50a3";s:64:"Resources/Private/Icons/icon_tx_blogexample_domain_model_tag.gif";s:4:"50a3";s:40:"Resources/Private/Language/locallang.xml";s:4:"e770";s:43:"Resources/Private/Language/locallang_db.xml";s:4:"2e5d";s:42:"Resources/Private/Templates/Blog/edit.html";s:4:"52dc";s:43:"Resources/Private/Templates/Blog/index.html";s:4:"feca";s:41:"Resources/Private/Templates/Blog/new.html";s:4:"20dc";s:42:"Resources/Private/Templates/Post/edit.html";s:4:"bff4";s:43:"Resources/Private/Templates/Post/index.html";s:4:"f78f";s:41:"Resources/Private/Templates/Post/new.html";s:4:"51e2";s:42:"Resources/Private/Templates/Post/show.html";s:4:"f0a4";}',
);

?>
