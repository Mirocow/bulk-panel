<?php
/* @var $this StyleController */
/* @var $form CActiveForm */
/* @var $model Sender */
/* @var $services string[] */
?>

<?php $this->showMessages($model); ?>
<div class="row">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id' => 'login-form',
        'enableAjaxValidation' => true,
        'htmlOptions' => ['enctype' => 'multipart/form-data']
    )); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                <i class="fa fa-plus"></i> <?=Yii::t('Module/User','Добавить базу получателей')?>
            </div>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label><?=Yii::t('Module/User','Название')?></label>
                <?php echo $form->textField($model, 'name', ['class' => 'form-control', 'placeholder' => Yii::t('Module/User','Название')]); ?>
            </div>
            <div class="form-group">
                <label><?=Yii::t('Module/User','Служба')?></label>
                <?php echo $form->dropDownList($model, 'service_id', $services, ['class' => 'form-control']); ?>
            </div>
            <div class="form-group">
                <label><?=Yii::t('Module/User','Файл')?></label>
                <?php echo $form->fileField($model, 'file', $services, ['class' => 'form-control']); ?>
            </div>
        </div>
        <div class="panel-footer">
            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i></button>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>