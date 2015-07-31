<?php /* @var $payModule object */ ?>

<h2 class="page-title"><?=Yii::t('Module/User', 'Подтверждение оплаты')?> <?=$payModule->getAmount()?> <i class="fa fa-rub"></i></h2>
<table class="table">

</table>
<?= $payModule->getPaymentButton() ?>