<?php
/* @var $this UsersController */
/* @var $model User */
/* @var $form CActiveForm */
/* @var $styles string[] */
?>

<?php $this->showMessages($model);?>
<div class="row">
    <?php $form=$this->beginWidget('CActiveForm'); ?>
        <div class="panel panel-default with-tabs">
            <div class="panel-heading">
                <h3 class="panel-title pull-right">
                    <?=$model->name?>
                </h3>
                <span class="">
                    <!-- Tabs -->
                    <ul class="nav panel-tabs">
                        <li class="active"><a href="#tab1" data-toggle="tab">Общие данные</a></li>
                        <li><a href="#tab2" data-toggle="tab">Статистика</a></li>
                        <li><a href="#tab3" data-toggle="tab">Баланс</a></li>
                    </ul>
                </span>
            </div>
            <div class="panel-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab1">
                        <div class="form-group">
                            <?=$form->label($model, 'login')?>
                            <?php echo $form->textField($model, 'login', ['class' => 'form-control', 'placeholder' => 'Логин пользователя']); ?>
                        </div>
                        <div class="form-group">
                            <?=$form->label($model, 'name')?>
                            <?php echo $form->textField($model, 'name', ['class' => 'form-control', 'placeholder' => 'Имя']); ?>
                        </div>
                        <div class="form-group">
                            <?=$form->label($model, 'email')?>
                            <?php echo $form->textField($model, 'email', ['class' => 'form-control', 'placeholder' => 'E-mail']); ?>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab2">
                        Статистика
                    </div>
                    <div class="tab-pane" id="tab3">
                        Баланс: <?=$model->balance;?>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i></button>
                <a href="<?=$this->createUrl('/reseller/users/delete', ['id' => $model->id])?>" class="btn btn-danger pull-right delete-submit">
                    <i class="fa fa-close"></i>
                </a>
            </div>
        </div>
    <?php $this->endWidget(); ?>
</div>