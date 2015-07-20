<?php
/* @var $model Campaign */
/* @var $this CampaignController */
/* @var $form CActiveForm */
/* @var $statuses string[] */
?>
<?php $this->showMessages($model);?>
<?php $form=$this->beginWidget('CActiveForm'); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                Просмотр кампании <?=$model->name?>
            </div>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4">
                    <table class="table has-buttons">
                        <tbody>
                            <tr>
                                <th class="text-td">Пользователь:</th>
                                <td>
                                    <a href="<?=$this->createUrl('/admin/users/view', ['id' => $model->user_id])?>">
                                        <?=$model->user->name?> (ID <?=$model->id?>)
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <th class="text-td">Служба:</th>
                                <td><?=$model->template->service->name?></td>
                            </tr>
                            <tr>
                                <th class="text-td">Имя отправителя:</th>
                                <td><?=$model->template->sender->name?></td>
                            </tr>
                            <?php if($model->template->sender->has_avatar): ?>
                                <tr>
                                    <th class="button-td">Аватар отправителя:</th>
                                    <td><a href="/files/sender_avatars/<?=$model->template->sender->file_name?>" target="_blank" class="btn btn-xs btn-default"><i class="fa fa-download"></i></a></td>
                                </tr>
                            <?php endif; ?>
                            <tr>
                                <th class="button-td">Файл с получателями:</th>
                                <td><a href="/files/receivers/<?=$model->receiver->file_name?>" target="_blank" class="btn btn-xs btn-default"><i class="fa fa-download"></i></a></td>
                            </tr>
                            <?php if(intval($model->template->templateType->id) === 1): ?>
                                <tr>
                                    <th class="text-td">Текст сообщения:</th>
                                    <td><?=$model->template->text_content?></td>
                                </tr>
                            <?php else: ?>
                                <tr>
                                    <th class="button-td">Файл сообщения:</th>
                                    <td><a href="/files/template/<?=$model->template->file_name?>" target="_blank" class="btn btn-xs btn-default"><i class="fa fa-download"></i></a></td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="form-group">
                <?=$form->label($model, 'status')?>
                <?php echo $form->dropDownList($model, 'status', $statuses, ['class' => 'form-control', 'placeholder' => 'Баланс']); ?>
            </div>
        </div>
        <div class="panel-footer">
            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i></button>
            <a href="<?=$this->createUrl('/admin/campaign/delete', ['id' => $model->id])?>" class="btn btn-danger pull-right delete-submit">
                <i class="fa fa-close"></i>
            </a>
        </div>
    </div>
<?php $this->endWidget(); ?>