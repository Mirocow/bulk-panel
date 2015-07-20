<?php
/* @var $this SitesController */
/* @var $model Site */
/* @var $form CActiveForm */
/* @var $styles string[] */
/* @var $services string */
/* @var $activeServices string */
?>
<script>
    var services = JSON.parse('<?=$services?>');
    var activeServices = JSON.parse('<?=$activeServices?>');
</script>
<?php $this->showMessages($model);?>
<div class="row">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'login-form',
        'enableAjaxValidation'=>true,
    )); ?>
        <div class="panel panel-default with-tabs">
            <div class="panel-heading">
                <h3 class="panel-title pull-right">
                    <?=$model->name?>
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
                            <?php echo $form->textField($model, 'name', ['class' => 'form-control', 'placeholder' => 'Название сайта']); ?>
                        </div>
                        <div class="form-group">
                            <?=$form->label($model, 'url')?>
                            <?php echo $form->textField($model, 'url', ['class' => 'form-control', 'placeholder' => 'Адрес сайта']); ?>
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
                        <p>Здесь вы можете задать данные для платежных систем. Параметры вводятся через перевод строки в заданном порядке.</p>
                        <div class="form-group">
                            <?=$form->label($model, 'robokassa')?>
                            <div class="row">
                                <div class="col-xs-6">
                                    <?php echo $form->textArea($model, 'robokassa', ['class' => 'form-control', 'placeholder' => '']); ?>
                                </div>
                                <div class="col-xs-6 hint">
                                    <button type="button" class="btn btn-xs btn-info hint-btn pull-right"><i class="fa fa-question-circle"></i></button>
                                    <div class="tooltiptext">
                                        <p>Для возможности принятия платежей в системе РобоКасса необходимо:</p>
                                        <ol>
                                            <li>Ознакомиться с условиями подключения и зарегистрироваться на сайте РобоКасса (<a href="http://www.robokassa.ru/ru/Index.aspx">http://www.robokassa.ru/ru/Index.aspx</a>).</li>
                                            <li>После регистрации в личном кабинете магазина в разделе “<b>Администрирование</b>” необходимо указать следующие данные:<br>
                                                Пароль #1 – представляет собой поле “<b>Пароль 1</b>” для данной платежной системы в настройках экспортного сайта в нашем сервисе;<br>
                                                Пароль #2 – представляет собой поле “<b>Пароль 2</b>” для данной платежной системы в настройках экспортного сайта в нашем сервисе;<br>
                                                Result URL – <a>http://your_domain/transaction/robokassa/result</a>;<br>
                                                Метод отсылки данных по Result URL – POST;<br>
                                                Success URL – <a>http://your_domain/transaction/robokassa/success</a>;<br>
                                                Метод отсылки данных по Success URL – POST;<br>
                                                Fail URL – <a>http://your_domain/transaction/robokassa/fail</a>;<br>
                                                Метод отсылки данных по Fail URL – POST.</li><br>
                                            <li>В качестве поля “<b>Логин</b>” необходимо указать логин от личного кабинета магазина в платежной системе РобоКасса.</li>
                                        </ol>
                                    </div>
                                    <br/>
                                    Логин<br/>
                                    Пароль 1<br/>
                                    Пароль 2<br/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab5">
                        <?php $this->renderPartial('_tariffs', ['tariffs' => $tariffs, 'mode' => 'view']) ?>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i></button>
                <a href="<?=$this->createUrl('/reseller/sites/delete', ['id' => $model->id])?>" class="btn btn-danger pull-right delete-submit">
                    <i class="fa fa-close"></i>
                </a>
            </div>
        </div>
    <?php $this->endWidget(); ?>
</div>

<script>
    $(document).ready(function(){
        var dropdown = $('#services-dropdown');
        $(dropdown).select2({
                placeholder: "Выберите минимум один сервис",
                escapeMarkup: function (markup) { return markup; },
                templateResult: formatState,
                allowClear: false,
                data: services
            }
        );
        var values = [];
        $(activeServices).each(function(){
            values.push(this.id);
        });
        dropdown.val(values).trigger('change');

        $('.hint-btn').each(function() {
            $(this).qtip({
                content: {
                    text: $(this).next('.tooltiptext').html(),
                    button: true
                },
                position: {
                    my: 'top center',  // Position my top left...
                    at: 'bottom center' // at the bottom right of...
                },
                show: {
                    event: 'click'
                },
                hide: {
                    event: 'click'
                },
                style: {
                    width: '400px'
                }
            });
        });
    });

    function formatState (service) {
        if (service.loading) return service.text;
        return '<span class="service-option"><i class="' + service.icon + '" style="color: #' + service.color + ';"></i><span class="service-name"> ' + service.text + '</span></span>';
    }
</script>