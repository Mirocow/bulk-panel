<?php
/* @var $this TemplateController */
/* @var $form CActiveForm */
/* @var $model Campaign */
/* @var $templates Template[] */
/* @var $receivers Receiver[] */
?>

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
                <i class="fa fa-envelope"></i> Создание новой кампании
            </div>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <?=$form->label($model, 'name')?>
                <?php echo $form->textField($model, 'name', ['class' => 'form-control', 'placeholder' => 'Название']); ?>
            </div>
            <div class="form-group">
                <?=$form->label($model, 'template_id')?>
                <?php echo $form->dropDownList($model, 'template_id', $templates, ['class' => 'form-control', 'id' => 'template-select']); ?>
            </div>
            <div class="form-group">
                <?=$form->label($model, 'receiver_id')?>
                <?php echo $form->dropDownList($model, 'receiver_id', $receivers, ['class' => 'form-control', 'id' => 'receiver-select']); ?>
            </div>
        </div>
        <div class="panel-footer">
            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i></button>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>

<script>
    $(document).on('change', '#template-select', function(){
        $('button[type=submit]').prop('disabled', true);

        var templateId = $('#template-select').val();
        $.get(
            Yii.app.createUrl('/user/receivers/getJson', {template_id: templateId})
        ).done(function(templates){
                var html = '';
                $('#receiver-select option').remove();

                templates = JSON.parse(templates);

                $(templates).each(function(){
                    html += '<option value="' + this.id + '">' + this.value + '</option>';
                });

                $('#receiver-select').html(html);

                if($('#receiver-select option').length > 0)
                    $('button[type=submit]').prop('disabled', false);
        });
    });
</script>