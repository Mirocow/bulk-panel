<?php
/* @var $this TemplateController */
/* @var $form CActiveForm */
/* @var $model Template */
/* @var $template WhatsappTemplate */
/* @var $sendersListData string[] */
/* @var $service Service */
?>
<?php $this->showMessages($template); ?>
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
                <i class="<?=$service->icon?>" style="color: #<?=$service->color?>;"></i> <?=$model->name?>
            </div>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label><?=Yii::t('Module/User', 'Название')?></label>
                <?php echo $form->textField($model, 'name', ['class' => 'form-control', 'placeholder' => Yii::t('Module/User', 'Название')]); ?>
            </div>
            <div class="form-group">
                <label><?=Yii::t('Module/User', 'Отправитель')?></label>
                <?php echo $form->dropDownList($template, 'sender_id', $sendersListData, ['class' => 'form-control']); ?>
            </div>
            <div class="form-group">
                <label><?=Yii::t('Module/User', 'Текстовое содержимое')?></label>
                <?php echo $form->textArea($template, 'text_content', ['class' => 'form-control', 'placeholder' => Yii::t('Module/User', 'Текстовое содержимое')]); ?>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label><?=Yii::t('Module/User', 'Файл')?></label>
                        <?php echo $form->fileField($template, 'file', ['class' => 'form-control']); ?>
                    </div>
                </div>
                <div class="col-md-6 template-file-view">
                    <?php if($template->file_name): ?>
                        <div class="form-group">
                            <a href="<?=Yii::app()->request->baseUrl?>/files/template/<?=$template->file_name?>" target="_blank">
                                <i class="fa fa-download"></i> <?=$template->file_name?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i></button>
            <a href="<?=$this->createUrl('/client/template/delete', ['id' => $model->id])?>" class="btn btn-danger pull-right delete-submit"><i class="fa fa-close"></i></a>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>