<?php
/* @var $this SitesController */
/* @var $model Site */
/* @var $form CActiveForm */
/* @var $styles string[] */
/* @var $services string */
/* @var $tariffs string[] */
?>
<script>
    var services = JSON.parse('<?=$services?>');
</script>
<?php $this->showMessages($model); ?>
<div class="row">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'login-form',
        'enableAjaxValidation'=>true,
    )); ?>
        <div class="panel panel-primary with-tabs">
            <div class="panel-heading">
                <h3 class="panel-title pull-right" id="new-name-title">
                    Новый сайт
                </h3>
                <span class="">
                    <!-- Tabs -->
                    <ul class="nav panel-tabs">
                        <li class="active"><a href="#tab1" data-toggle="tab">Сайт</a></li>
                        <li><a href="#tab2" data-toggle="tab">Контакты</a></li>
                        <li><a href="#tab3" data-toggle="tab">Реквизиты</a></li>
                        <li><a href="#tab4" data-toggle="tab">Платежные системы</a></li>
                        <li><a href="#tab5" data-toggle="tab">Тарифы</a></li>
                    </ul>
                </span>
            </div>
            <div class="panel-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab1">
                        <div class="form-group">
                            <?=$form->label($model, 'name')?>
                            <?php echo $form->textField($model, 'name', ['class' => 'form-control', 'id' => 'new-name', 'placeholder' => 'Название сайта']); ?>
                        </div>
                        <div class="form-group">
                            <?=$form->label($model, 'domain')?>
                            <?php echo $form->textField($model, 'domain', ['class' => 'form-control', 'placeholder' => 'Ваш поддомен: sub.mysite.ru']); ?>
                        </div>
                        <div class="form-group">
                            <?=$form->label($model, 'email')?>
                            <?php echo $form->textField($model, 'email', ['class' => 'form-control', 'placeholder' => 'E-mail службы поддержки']); ?>
                        </div>
                        <div class="form-group">
                            <?=$form->label($model, 'title')?>
                            <?php echo $form->textField($model, 'title', ['class' => 'form-control', 'placeholder' => 'Заголовок']); ?>
                        </div>
                        <div class="form-group">
                            <label for="services-dropdown">Сервисы</label>
                            <select multiple="multiple" id="services-dropdown" name="Services[]" style="width: 100%;"></select>
                        </div>
                        <div class="form-group">
                            <?=$form->label($model, 'style_id')?>
                            <?php echo $form->dropDownList($model, 'style_id', $styles, ['class' => 'form-control']); ?>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab2">
                        <div class="form-group">
                            <?=$form->label($model, 'contacts')?>
                            <?php echo $form->textArea($model, 'contacts', ['class' => 'form-control', 'placeholder' => '']); ?>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab3">
                        <div class="form-group">
                            <?=$form->label($model, 'invoice_details')?>
                            <?php echo $form->textArea($model, 'invoice_details', ['class' => 'form-control', 'placeholder' => '']); ?>
                        </div>
                        <div class="form-group">
                            <?=$form->label($model, 'e_wallets')?>
                            <?php echo $form->textArea($model, 'e_wallets', ['class' => 'form-control', 'placeholder' => '']); ?>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab4">
                        <div class="form-group">
                            <?=$form->label($model, 'yandex_money')?>
                            <?php echo $form->textArea($model, 'yandex_money', ['class' => 'form-control', 'placeholder' => '']); ?>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab5">
                        <?=$this->renderPartial('_tariffs', compact('tariffs'))?>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i></button>
            </div>
        </div>
    <?php $this->endWidget(); ?>
</div>

<script>
    $(document).ready(function(){
        $('#services-dropdown').select2({
                placeholder: "Выберите минимум один сервис",
                escapeMarkup: function (markup) { return markup; },
                templateResult: formatState,
                allowClear: false,
                data: services
            }
        );
    });

    function formatState (service) {
        if (service.loading) return service.text;
        return '<span class="service-option"><i class="' + service.icon + '" style="color: #' + service.color + ';"></i><span class="service-name"> ' + service.text + '</span></span>';
    }
</script>