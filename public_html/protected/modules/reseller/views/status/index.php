<?php
/* @var $reseller Reseller*/
?>
<h1 class="page-title">
    <?=Yii::t('Module/Reseller', 'Информация')?>
</h1>
<div class="row">
    <div class="col-md-4">
        <table class="table">
            <tbody>
                <tr>
                    <th><?=Yii::t('Module/Reseller', 'Название организации')?>:</th>
                    <td><?=$reseller->organization_name?></td>
                </tr>
                <tr>
                    <th><?=Yii::t('Module/Reseller', 'Имя контактного лица')?>:</th>
                    <td><?=$reseller->name?></td>
                </tr>
                <tr>
                    <th><?=Yii::t('Module/Reseller', 'Баланс')?>:</th>
                    <td><?=$reseller->balance?> <i class="fa fa-rub"></i></td>
                </tr>
                <tr>
                    <th><?=Yii::t('Module/Reseller', 'Сайтов')?>:</th>
                    <td><?=count($reseller->sites)?></i></td>
                </tr>
                <tr>
                    <th><?=Yii::t('Module/Reseller', 'Клиентов')?>:</th>
                    <td><?=$reseller->countUsers()?></i></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>