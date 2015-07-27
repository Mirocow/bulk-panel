<?php
/* @var $model Campaign */
/* @var $this CampaignController */
/* @var $form CActiveForm */
/* @var $statuses string[] */
/* @var $campaign WhatsappCampaign */
?>
<?php $this->showMessages($model);?>
<?php $this->showMessages($campaign);?>
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
                                <td><i class="<?=$model->service->icon?>" style="color: #<?=$model->service->color?>;"></i> <?=$model->service->name?></td>
                            </tr>
                            <tr>
                                <th class="text-td">Имя отправителя:</th>
                                <td><?=$campaign->whatsappTemplate->sender->name?></td>
                            </tr>
                            <?php if($campaign->whatsappTemplate->sender->has_avatar): ?>
                                <tr>
                                    <th class="button-td">Аватар отправителя:</th>
                                    <td><a href="/files/sender_avatars/<?=$campaign->whatsappTemplate->sender->file_name?>" target="_blank" class="btn btn-xs btn-default"><i class="fa fa-download"></i></a></td>
                                </tr>
                            <?php endif; ?>
                            <tr>
                                <th class="button-td">Файл с получателями:</th>
                                <td><a href="/files/receivers/<?=$campaign->receiver->file_name?>" target="_blank" class="btn btn-xs btn-default"><i class="fa fa-download"></i></a></td>
                            </tr>
                            <?php if($campaign->whatsappTemplate->text_content): ?>
                                <tr>
                                    <th class="text-td">Текст сообщения:</th>
                                    <td><?=$campaign->whatsappTemplate->text_content?></td>
                                </tr>
                            <?php endif;?>
                            <?php if($campaign->whatsappTemplate->file_name): ?>
                                <tr>
                                    <th class="button-td">Файл сообщения:</th>
                                    <td><a href="<?=Yii::app()->request->baseUrl?>/files/template/<?=$campaign->whatsappTemplate->file_name?>" target="_blank" class="btn btn-xs btn-default"><i class="fa fa-download"></i></a></td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="form-group">
                <?=$form->label($model, 'price')?>
                <?php echo $form->numberField($model, 'price', $statuses, ['class' => 'form-control', 'placeholder' => 'Стоимость кампании']); ?>
            </div>
            <div class="form-group">
                <?=$form->label($model, 'status')?>
                <?php echo $form->dropDownList($model, 'status', $statuses, ['class' => 'form-control']); ?>
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