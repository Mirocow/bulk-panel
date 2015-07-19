<?php
/* @var $model Template */
/* @var $form CActiveForm */
?>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <?=$form->label($model, 'file')?>
            <?php echo $form->fileField($model, 'file', ['class' => 'form-control']); ?>
        </div>
    </div>
    <div class="col-md-6 template-file-view">
        <?php if($model->file_name && $model->templateType->attachment): ?>
            <div class="form-group">
                <a href="<?=Yii::app()->user->getId()?>/files/template/<?=$model->file_name?>" target="_blank"><i class="fa fa-download"></i> <?=$model->file_name?></a>
            </div>
        <?php endif; ?>
    </div>
</div>