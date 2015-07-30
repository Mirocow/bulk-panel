<?php
/* @var $reseller Reseller*/
?>
<h1 class="page-title">
    Информация
</h1>
<div class="row">
    <div class="col-md-4">
        <table class="table">
            <tbody>
                <tr>
                    <th>Название организации:</th>
                    <td><?=$reseller->organization_name?></td>
                </tr>
                <tr>
                    <th>Имя контактного лица:</th>
                    <td><?=$reseller->name?></td>
                </tr>
                <tr>
                    <th>Баланс:</th>
                    <td><?=$reseller->balance?> <i class="fa fa-rub"></i></td>
                </tr>
                <tr>
                    <th>Сайтов:</th>
                    <td><?=count($reseller->sites)?></i></td>
                </tr>
                <tr>
                    <th>Клиентов:</th>
                    <td><?=$reseller->countUsers()?></i></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?php
    echo Yii::t('Models/l','Привет');