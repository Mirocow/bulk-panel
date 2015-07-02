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
                        <div class="row">
                            <div class="col-md-4">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th>Баланс:</th>
                                            <td><?=$model->getBalance()?> <i class="fa fa-rub"></i></td>
                                        </tr>
                                        <tr>
                                            <th>Сайт:</th>
                                            <td><?=$model->site->name?></i></td>
                                        </tr>
                                        <tr>
                                            <th>Отправленных сообщений:</th>
                                            <td><?=$model->getSentCount()?></i></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab3">
                        <h2 class="page-title">
                            Баланс
                            <span class="label label-success">
                                <?=$model->getBalance()?>
                                <i class="fa fa-rub"></i>
                            </span>
                        </h2>
                        <h3>История платежей:</h3>

                        <?php
                        $this->widget('zii.widgets.grid.CGridView', array(
                            'dataProvider' => $paymentsDataProvider,
                            'columns'=>array(
                                [
                                    'header' => '',
                                    'name' => 'in',
                                    'value' => '$data->getType()',
                                ],
                                [
                                    'header' => 'Время совершения',
                                    'name' => 'occurred',
                                    'value' => 'Html::SQLDateFormat($data->occurred)',
                                ],
                                'method',
                                [
                                    'name' => 'status',
                                    'value' => '$data->getStatus()',
                                ],
                            ),
                            'itemsCssClass' => 'table table-striped',
                            'htmlOptions' => ['class' => 'items table table-striped'],
                            'pager' => [
                                'htmlOptions' => ['class' => 'pagination'],
                                'selectedPageCssClass' => 'active',
                            ]
                        ));
                        ?>
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