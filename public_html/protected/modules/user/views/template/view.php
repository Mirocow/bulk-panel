<?php
/* @var $this TemplateController */
/* @var $form CActiveForm */
/* @var $model Template */
/* @var $services string */
/* @var $mainForm string */
/* @var $typesListData string */
/* @var $types string[] */
/* @var $senders string[] */
?>
<script>
    var services = JSON.parse('<?=$services?>');
    var typesListData = JSON.parse('<?=$typesListData?>');
    var modelId = <?=$model->id?>;
    var serviceId = <?=$model->service_id?>;
    var typeId = <?=$model->template_type_id?>;
</script>
<?php $this->showMessages($model); ?>
<div class="row">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'login-form',
        'enableAjaxValidation'=>true,
        'htmlOptions' => [
            'enctype' => 'multipart/form-data',
        ],
    )); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                <i class="fa fa-pencil"></i> <?=$model->name?>
            </div>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <?=$form->label($model, 'name')?>
                <?php echo $form->textField($model, 'name', ['class' => 'form-control', 'placeholder' => 'Название']); ?>
            </div>
            <div class="form-group">
                <?=$form->label($model, 'service_id')?>
                <?php echo $form->dropDownList($model, 'service_id', [], ['class' => 'form-control', 'id' => 'service-select']); ?>
            </div>
            <div class="form-group">
                <?=$form->label($model, 'template_type_id')?>
                <?php echo $form->dropDownList($model, 'template_type_id', [], ['class' => 'form-control', 'id' => 'type-select']); ?>
            </div>
            <div class="form-group">
                <?=$form->label($model, 'sender_id')?>
                <?php echo $form->dropDownList($model, 'sender_id', $senders, ['class' => 'form-control']); ?>
            </div>
            <div class="main-form">
                <?=$mainForm?>
            </div>
        </div>
        <div class="panel-footer">
            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i></button>
            <a href="<?=$this->createUrl('/user/sender/delete', ['id' => $model->id])?>" class="btn btn-danger pull-right delete-submit"><i class="fa fa-close"></i></a>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>

<script>
    $(document).ready(function(e){
        $('#service-select').select2({
            placeholder: "Выберите минимум один сервис",
            escapeMarkup: function (markup) { return markup; },
            templateResult: formatService,
            templateSelection: formatService,
            allowClear: false,
            data: services
        }).val(serviceId).trigger('change');

        $('#type-select').select2({
            escapeMarkup: function (markup) { return markup; },
            templateResult: formatType,
            templateSelection: formatType,
            allowClear: false,
            data: typesListData
        }).val(typeId).trigger('change');


        $('#type-select, #service-select').change(function(e){
            var currentType = $('#type-select').val();
            var currentService = $('#service-select').val();

            $.get(
                Yii.app.createUrl('/user/template/getView', {id: modelId, type: currentType, service: currentService})
            ).done(function(form){
                $('.main-form').html(form);
            });
        });
    });

    function formatService (service) {
        if (service.loading) return service.text;
        return '<span class="service-option"><i class="' + service.icon + '" style="color: #' + service.color + ';"></i><span class="service-name"> ' + service.text + '</span></span>';
    }
    function formatType (type) {
        if (type.loading) return type.text;
        return '<span class="type-option"><i class="' + type.class + '"></i><span class="type-name"> ' + type.text + '</span></span>';
    }
</script>