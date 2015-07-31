</div> <!--- CONTAINER-->
<div class="land-image">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <img src="<?=Yii::app()->request->baseUrl?>/images/0.jpeg"/>
                </div>
                <div class="col-md-6 text">
                    <?=Yii::t('Text/Landing', 'Представляем сервис для массовых рекламных сообщений')?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h4><?=Yii::t('Text/Landing', 'Доступные службы')?>:</h4>
            <p>
                <img src="<?=Yii::app()->request->baseUrl?>/images/logos/mts.jpg" title="МТС" class="service-logo"/>
                <img src="<?=Yii::app()->request->baseUrl?>/images/logos/beeline.png" title="Билайн" class="service-logo"/>
                <img src="<?=Yii::app()->request->baseUrl?>/images/logos/megafon.png" title="Мегафон" class="service-logo"/>
                <img src="<?=Yii::app()->request->baseUrl?>/images/logos/whatsapp.png" title="WatsApp" class="service-logo"/>
                <img src="<?=Yii::app()->request->baseUrl?>/images/logos/viber.png" title="Viber" class="service-logo"/>
                <img src="<?=Yii::app()->request->baseUrl?>/images/logos/skype.png" title="Skype" class="service-logo"/>
            </p>
            <h4><?=Yii::t('Text/Landing', 'Приемущества')?></h4>
            <ul>
                <li><?=Yii::t('Text/Landing', 'высокая стабильность работы')?></li>
                <li><?=Yii::t('Text/Landing', 'быстрая доставка срочных сообщений')?></li>
                <li><?=Yii::t('Text/Landing', 'конфиденциальность и защита данных')?></li>
                <li><?=Yii::t('Text/Landing', 'оперативная поддержка клиентов')?></li>
            </ul>
            <h4><?=Yii::t('Text/Landing', 'Онлайн поддержка')?></h4>
            <ul class="no-bullets support-methods">
                <li>
                    <img src="<?=Yii::app()->request->baseUrl?>/images/logos/skype.png" title="Skype" class="contact-logo"/> rustamgagiev95
                </li>
                <li>
                    <img src="<?=Yii::app()->request->baseUrl?>/images/logos/skype.png" title="Skype" class="contact-logo"/> slashman500
                </li>
            </ul>
            <h4><?=Yii::t('Text/Landing', 'Способы оплаты')?></h4>
            <ul class="no-bullets payment-methods">
                <li><img src="<?=Yii::app()->request->baseUrl?>/images/methods/robokassa.jpg" title="Робокасса"/></li>
            </ul>
            <h4><?=Yii::t('Text/Landing', 'Правила')?></h4>
            <p><?=Yii::t('Text/Landing', 'Запрещены к рассылке следующие типы сообщений')?>:</p>
            <ul>
                <li><?=Yii::t('Text/Landing', 'Сообщения, противоречащие действующему законодательству')?>;</li>
                <li><?=Yii::t('Text/Landing', 'Сообщения, содержащие угрозы, оскорбления или вымогательства')?>;</li>
                <li><?=Yii::t('Text/Landing', 'Сообщения, призывающие отправлять SMS на платные номера')?>;</li>
            </ul>
            <p><?=Yii::t('Text/Landing', 'Если у вас возникли какие-то вопросы или проблемы, то обратитесь в службу поддержки, и наши специалисты оперативно ответят на любой вопрос и при необходимости окажут помощь в подключении и настройке сервиса')?>.</p>
        </div>
    </div>