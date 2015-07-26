<?php
/* @var $this ResellerController */
/* @var $model Reseller */
/* @var $claim ResellerClaim */
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
                <?=$form->label($model, 'login')?>
                <?php echo $form->textField($model,'login', ['class' => 'form-control', 'placeholder' => '']); ?>
            </div>
            <div class="form-group">
                <?=$form->label($model, 'password')?>
                <?php echo $form->textField($model,'password', ['class' => 'form-control', 'placeholder' => '']); ?>
            </div>
            <div class="form-group">
                <?=$form->label($model, 'name')?>
                <?php echo $form->textField($model,'name', ['class' => 'form-control', 'placeholder' => 'Иванов Иван']); ?>
            </div>
            <div class="form-group">
                <?=$form->label($model, 'organization_name')?>
                <?php echo $form->textField($model,'organization_name', ['class' => 'form-control', 'placeholder' => 'ООО Рога и копыта']); ?>
            </div>
            <div class="form-group">
                <?=$form->label($model, 'email')?>
                <?php echo $form->textField($model,'email', ['class' => 'form-control', 'placeholder' => 'admin@ultrasms.ru']); ?>
            </div>
            <div class="form-group">
                <?=$form->label($model, 'phone')?>
                <?php echo $form->textField($model,'phone', ['class' => 'form-control', 'placeholder' => '+79031234500']); ?>
            </div>
        </div>
        <div class="panel-footer">
            <button type="submit" class="btn btn-success"><i class="fa fa-check"></i></button>
            <a href="<?=$this->createUrl('/admin/reseller/declineClaim', ['id' => $claim->id])?>" class="btn btn-danger pull-right delete-submit">
                <i class="fa fa-close"></i>
            </a>
        </div>
    </div>
<?php $this->endWidget(); ?>