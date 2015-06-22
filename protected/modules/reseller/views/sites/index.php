<?php $this->showMessages(); ?>
<h2 class="page-title">
    Ваши сайты
</h2>
<div class="row">
    <div class="col-md-12 form-group">
        <a href="<?=$this->createUrl('/reseller/sites/create')?>" class="btn btn-sm btn-warning"><i class="fa fa-plus"></i> Создать новый сайт</a>
    </div>
</div>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $dataProvider,
    'columns'=>array(
        'name',          // display the 'title' attribute
        'url',  // display the 'name' attribute of the 'category' relation
        'domain',
        [
            'header' => '',
            'type' => 'raw',
            'value' => 'Html::GetSiteButton($data->id)',
        ]
    ),
    'itemsCssClass' => 'table table-striped',
    'htmlOptions' => ['class' => 'items table table-striped']
));
?>