<?php
/**
 * Created by PhpStorm.
 * User: slashman
 * Date: 25.07.15
 * Time: 3:10
 */
?>
<p>
    <a href="<?=$this->createUrl('/reseller/sites/create')?>"><?=Yii::t('Module/Reseller', 'Назад')?></a>
</p>
<h2><?=Yii::t('Module/Reseller', 'Инструкция по настройке вашего домена')?></h2>
<p><?=Yii::t('Module/Reseller', 'Для того, чтобы подключить ваш сайт к нашей системе, необходимо иметь свой домен и иметь DNS-сервер, настройки которого вы можете редактировать')?>.</p>
<p><?=Yii::t('Module/Reseller', 'Если у вас нет DNS-сервера, вы можете воспользоваться <a href="https://help.yandex.ru/pdd/hosting.xml">DNS-хостингом Яндекса</a>')?>.</p>
<p><?=Yii::t('Module/Reseller', 'Например, у вас есть домен <i>mydomain.ru</i> и вы хотите сделать так, чтобы обращаясь к поддомену <i>bulk.mydomain.ru</i> пользователь попадал на ваш сайт в нашем сервисе')?>.</p>
<p><?=Yii::t('Module/Reseller', 'Для этого, вам необходимо добавить следующую запись в ваш DNS-сервер')?></p>
<pre>bulk.mydomain.ru CNAME bulkreseller.ru</pre>
<p><?=Yii::t('Module/Reseller', 'После этого, при переходе на домен <i>bulk.mydomain.ru</i> пользователь будет попадать на ваш сайт в нашем сервисе и сможет оформлять заказы на рассылку')?>.</p>