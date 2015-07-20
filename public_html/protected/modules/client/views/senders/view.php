<?php
/* @var $this StyleController */
/* @var $form CActiveForm */
/* @var $model Sender */
/* @var $services string[] */
?>

<?php $this->showMessages($model); ?>
<div class="row">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'login-form',
        'enableAjaxValidation'=>true,
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
                <?php echo $form->textField($model, 'name', ['class' => 'form-control', 'placeholder' => 'Имя отправителя']); ?>
            </div>
            <div class="form-group">
                <?=$form->label($model, 'file')?>
                <?php echo $form->fileField($model, 'file', ['class' => 'form-control']); ?>
            </div>
            <?php if($model->has_avatar): ?>
                <div class="form-group avatar-container">
                    <img src="<?=Yii::app()->request->baseUrl?>/files/sender_avatars/<?=$model->file_name?>"/>
                </div>
            <?php endif; ?>
        </div>
        <div class="panel-footer">
            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i></button>
            <a href="<?=$this->createUrl('/client/senders/delete', ['id' => $model->id])?>" class="btn btn-danger pull-right delete-submit"><i class="fa fa-close"></i></a>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>