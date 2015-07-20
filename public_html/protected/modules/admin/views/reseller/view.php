<?php
/* @var $this ResellerController */
/* @var $model Reseller */
/* @var $form CActiveForm */
?>
<?php $this->showMessages($model);?>
<?php $form=$this->beginWidget('CActiveForm'); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                Редактирование реселлера <?=$model->organization_name?>
            </div>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <?=$form->label($model, 'balance')?>
                <?php echo $form->textField($model, 'balance', ['class' => 'form-control', 'placeholder' => 'Баланс']); ?>
            </div>
        </div>
        <div class="panel-footer">
            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i></button>
            <a href="<?=$this->createUrl('/admin/reseller/delete', ['id' => $model->id])?>" class="btn btn-danger pull-right delete-submit">
                <i class="fa fa-close"></i>
            </a>
        </div>
    </div>
<?php $this->endWidget(); ?>