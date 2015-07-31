<?php
/* @var $this TemplateController */
/* @var $form CActiveForm */
/* @var $model Campaign */
/* @var $campaign Campaign */
/* @var $templates string[] */
/* @var $service Service */
?>

<?php $this->showMessages($model); ?>
<?php $this->showMessages($campaign); ?>
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
                <i class="<?=$service->icon?>" style="color: #<?=$service->color?>"></i> Создание новой кампании
            </div>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <?=$form->label($model, 'name')?>
                <?php echo $form->textField($model, 'name', ['class' => 'form-control', 'placeholder' => 'Название']); ?>
            </div>
            <div class="form-group">
                <?=$form->label($campaign, 'country')?>
                <?php echo $form->textField($campaign, 'country', ['class' => 'form-control']); ?>
            </div>
            <div class="form-group">
                <?=$form->label($campaign, 'city')?>
                <?php echo $form->textField($campaign, 'city', ['class' => 'form-control']); ?>
            </div>
            <div class="form-group">
                <?=$form->label($campaign, 'skype_template_id')?>
                <?php echo $form->dropDownList($campaign, 'skype_template_id', $templates, ['class' => 'form-control']); ?>
            </div>
            <div class="form-group">
                <?=$form->label($campaign, 'quantity')?>
                <?php echo $form->numberField($campaign, 'quantity', ['class' => 'form-control']); ?>
            </div>
        </div>
        <div class="panel-footer">
            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i></button>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>