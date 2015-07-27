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
                Пользователь <?=$model->name?> (ID <?=$model->id?>)
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
                                <th class="text-td">Имя:</th>
                                <td><?=$model->name?></td>
                            </tr>
                            <tr>
                                <th class="text-td">Дата регистрации:</th>
                                <td><?=Html::SQLDateFormat($model->created)?></td>
                            </tr>
                            <?php if($model->site_id): ?>
                                <tr>
                                    <th class="text-td">Сайт:</th>
                                    <td><?=$model->site->name?></td>
                                </tr>
                                <?php if($model->site->reseller_id): ?>
                                    <tr>
                                        <th class="text-td">Реселлер:</th>
                                        <td><a href="<?=$this->createUrl('/admin/reseller/view',['id' => $model->site->reseller_id])?>"><?=$model->site->reseller->name?></a></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <legend>Баланс: <?=$model->getBalance()?> <i class="fa fa-rub"></i></legend>
            <div class="form-group">
                <label>Сумма:</label>
                <?php echo $form->textField($transaction, 'amount', ['class' => 'form-control', 'placeholder' => 'Баланс']); ?>
            </div>
            <div class="form-group">
                <label>Тип:</label>
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