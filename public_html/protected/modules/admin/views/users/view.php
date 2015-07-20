<?php
/* @var $this UsersController */
/* @var $model User */
/* @var $transaction Transaction */
/* @var $form CActiveForm */
?>
<?php $this->showMessages($model);?>
<?php $form=$this->beginWidget('CActiveForm'); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                Баланс пользователя <?=$model->name?> (ID <?=$model->id?>)
            </div>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <?=$form->label($transaction, 'amount')?>
                <?php echo $form->textField($transaction, 'amount', ['class' => 'form-control', 'placeholder' => 'Баланс']); ?>
            </div>
            <div class="form-group">
                <?=$form->label($transaction, 'in')?>
                <?php echo $form->dropDownList($transaction, 'in', [
                    0 => 'Списать',
                    1 => 'Начислить',
                ], ['class' => 'form-control', 'placeholder' => 'Баланс']); ?>
            </div>
        </div>
        <div class="panel-footer">
            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i></button>
            <a href="<?=$this->createUrl('/admin/users/delete', ['id' => $model->id])?>" class="btn btn-danger pull-right delete-submit">
                <i class="fa fa-close"></i>
            </a>
        </div>
    </div>
<?php $this->endWidget(); ?>