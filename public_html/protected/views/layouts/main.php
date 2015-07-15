<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="ru" />
    <link rel="stylesheet" href="<?=Yii::app()->request->baseUrl?>/plugins/bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?=Yii::app()->request->baseUrl?>/plugins/fa/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="<?=Yii::app()->request->baseUrl?>/plugins/bower_components/bootstrap-sweetalert/lib/sweet-alert.css"/>
    <link rel="stylesheet" href="<?=Yii::app()->request->baseUrl?>/plugins/bower_components/bootstrap-sweetalert/lib/sweet-alert-animations.css"/>
    <link rel="stylesheet" href="<?=Yii::app()->request->baseUrl?>/plugins/bower_components/select2/dist/css/select2.min.css"/>
    <link rel="stylesheet" href="<?=Yii::app()->request->baseUrl?>/plugins/bower_components/qtip2/jquery.qtip.min.css"/>
    <link rel="stylesheet" href="<?=Yii::app()->request->baseUrl?>/css/breadcrumb.css"/>
    <link rel="stylesheet" href="<?=Yii::app()->request->baseUrl?>/css/style.css"/>

    <script type="application/javascript" src="<?=Yii::app()->request->baseUrl?>/plugins/jquery.js"></script>
    <script type="application/javascript" src="<?=Yii::app()->request->baseUrl?>/plugins/jquery.mask.min.js"></script>
    <script type="application/javascript" src="<?=Yii::app()->request->baseUrl?>/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script type="application/javascript" src="<?=Yii::app()->request->baseUrl?>/plugins/bower_components/bootstrap-sweetalert/lib/sweet-alert.min.js"></script>
    <script type="application/javascript" src="<?=Yii::app()->request->baseUrl?>/plugins/bower_components/select2/dist/js/select2.min.js"></script>
    <script type="application/javascript" src="<?=Yii::app()->request->baseUrl?>/plugins/bower_components/qtip2/jquery.qtip.min.js"></script>
    <script type="application/javascript" src="<?=Yii::app()->request->baseUrl?>/js/common.js"></script>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
    <div class="wrapper">
        <?php echo $content; ?>
    </div>
</body>
</html>