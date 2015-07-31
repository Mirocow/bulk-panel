<?php
/* @var $this ResellerController */
/* @var $resellersDataProvider CActiveDataProvider */
/* @var $claimsDataProvider CActiveDataProvider */
?>
<h2 class="page-title">
    Реселлеры
</h2>
<?php $this->showMessages(); ?>
<div>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#resellers" aria-controls="home" role="tab" data-toggle="tab">Реселлеры</a></li>
        <li role="presentation"><a href="#claims" aria-controls="profile" role="tab" data-toggle="tab">Заявки <span class="badge"><?=$claimsCount?></span></a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="resellers">
            <?php
            $this->widget('zii.widgets.grid.CGridView', array(
                'dataProvider' => $resellersDataProvider,
                'columns'=>array(
                    'login',
                    'name',
                    'organization_name',
                    'balance',
                    'phone',
                    'email',
                    [
                        'header' => 'Зарегистрирован',
                        'name' => 'created',
                        'value' => 'Html::SQLDateFormat($data->created)',
                    ],
                    [
                        'header' => '',
                        'type' => 'raw',
                        'value' => 'Html::GetResellerButton($data->id)',
                    ]
                ),
                'itemsCssClass' => 'table table-striped',
                'htmlOptions' => ['class' => 'items table table-striped'],
                'pager' => [
                    'htmlOptions' => ['class' => 'pagination'],
                    'selectedPageCssClass' => 'active',
                ]
            ));
            ?>
        </div>
        <div role="tabpanel" class="tab-pane" id="claims">
            <?php
            $this->widget('zii.widgets.grid.CGridView', array(
                'dataProvider' => $claimsDataProvider,
                'columns'=>array(
                    'login',
                    'name',
                    'organization_name',
                    'balance',
                    'phone',
                    'email',
                    [
                        'header' => '',
                        'type' => 'raw',
                        'value' => '',
                    ],
                    [
                        'header' => '',
                        'type' => 'raw',
                        'value' => 'Html::GetClaimDeclineButton($data->id).Html::GetClaimApproveButton($data->id)',
                    ]
                ),
                'itemsCssClass' => 'table table-striped',
                'htmlOptions' => ['class' => 'items table table-striped'],
                'pager' => [
                    'htmlOptions' => ['class' => 'pagination'],
                    'selectedPageCssClass' => 'active',
                ]
            ));
            ?>
        </div>
    </div>

</div>