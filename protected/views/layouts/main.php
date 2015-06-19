<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="ru" />
    <link rel="stylesheet" href="<?=Yii::app()->request->baseUrl?>/plugins/bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?=Yii::app()->request->baseUrl?>/plugins/fa/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="<?=Yii::app()->request->baseUrl?>/plugins/bower_components/bootstrap-sweetalert/lib/sweet-alert.css"/>
    <link rel="stylesheet" href="<?=Yii::app()->request->baseUrl?>/plugins/bower_components/bootstrap-sweetalert/lib/sweet-alert-animations.css"/>
    <link rel="stylesheet" href="<?=Yii::app()->request->baseUrl?>/css/style.css"/>

    <script type="application/javascript" src="<?=Yii::app()->request->baseUrl?>/plugins/jquery.js"></script>
    <script type="application/javascript" src="<?=Yii::app()->request->baseUrl?>/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script type="application/javascript" src="<?=Yii::app()->request->baseUrl?>/plugins/bower_components/bootstrap-sweetalert/lib/sweet-alert.min.js"></script>
    <script type="application/javascript" src="<?=Yii::app()->request->baseUrl?>/js/common.js"></script>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
	<?php echo $content; ?>
</body>
</html>