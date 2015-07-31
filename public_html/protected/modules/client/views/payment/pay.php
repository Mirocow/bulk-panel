<?php
/* @var $this PaymentController */
/* @var $methods string[] */
?>
<h2 class="page-title"><?= Yii::t('Module/User', 'Пополнение баланса')?></h2>
<div class="row">
    <div class="col-md-3">
        <form method="POST">
            <div class="form-group">
                <label for="amount"><?= Yii::t('Module/User', 'Сумма')?>:</label>
                <div class="input-group">
                    <input type="text" name="Pay[amount]" id="amount" class="form-control">
                    <div class="input-group-addon"><i class="fa fa-rub"></i></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 control-label">
                    <?= Yii::t('Module/User', 'Способ оплаты')?>:
                </div>
            </div>
            <?php foreach($methods as $method): ?>
                <div class="radio">
                    <label>
                        <input type="radio" name="Pay[method]" value="<?=$method['code']?>" checked>
                        <img src="<?=Yii::app()->request->baseUrl?>/images/methods/<?=$method['img']?>"/>
                    </label>
                </div>
            <?php endforeach; ?>
            <button type="submit" class="btn btn-sm btn-success"><?= Yii::t('Module/User', 'Перейти к оплате')?></button>
        </form>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#amount').mask('#.##0,000', {reverse: true});
    })
</script>