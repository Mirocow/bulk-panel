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
            <div class="row">
                <div class="col-md-4">
                    <table class="table has-buttons">
                        <tbody>
                            <tr>
                                <th class="text-td">Логин:</th>
                                <td><?=$model->login?></td>
                            </tr>
                            <tr>
                                <th class="text-td">Пароль:</th>
                                <td><?=$model->password?></td>
                            </tr>
                            <tr>
                                <th class="text-td">Email:</th>
                                <td><a href="mailto:<?=$model->email?>"><?=$model->email?></a></td>
                            </tr>
                            <tr>
                                <th class="text-td">Телефон:</th>
                                <td><?=$model->phone?></td>
                            </tr>
                            <tr>
                                <th class="text-td">Имя:</th>
                                <td><?=$model->name?></td>
                            </tr>
                            <tr>
                                <th class="text-td">Имя организации:</th>
                                <td><?=$model->organization_name?></td>
                            </tr>
                            <tr>
                                <th class="text-td">Дата регистрации:</th>
                                <td><?=Html::SQLDateFormat($model->created)?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <legend>Баланс: <?=$model->getBalance()?> <i class="fa fa-rub"></i></legend>
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