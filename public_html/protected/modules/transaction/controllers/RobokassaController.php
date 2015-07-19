<?php

class RobokassaController extends Controller
{
    public function actionResult()
    {
        $robokassa = new Robokassa();

        if($robokassa->valid($_REQUEST))
        {
            $transaction = Transaction::model()->findByPk($robokassa->transaction);
            $transaction->status = Transaction::STATUS_COMPLETE;
            $transaction->in = 1;
            $transaction->method = 'ROBOKASSA';

            $transaction->save();
        }
    }
    public function actionSuccess()
    {
        Yii::app()->user->setFlash('SUCCESS', 'Платеж успешно произведен');

        $url = '/';

        switch(AuthHelper::getRole())
        {
            case AuthHelper::ROLE_USER: $url = '/user/payment/index'; break;
            case AuthHelper::ROLE_CLIENT: $url = '/client/payment/index'; break;
            default: $url = '/';
        }

        $this->redirect([$url]);
    }
    public function actionFail()
    {
        Yii::app()->user->setFlash('ERROR', 'Ошибка при совершении платежа');

        $url = '/';

        switch(AuthHelper::getRole())
        {
            case AuthHelper::ROLE_USER: $url = '/user/payment/index'; break;
            case AuthHelper::ROLE_CLIENT: $url = '/client/payment/index'; break;
            default: $url = '/';
        }

        $this->redirect([$url]);
    }
}