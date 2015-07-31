<?php
/**
 * Created by PhpStorm.
 * User: slashman
 * Date: 23.06.15
 * Time: 1:47
 */

class PaymentController extends ClientBaseController
{
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('Transaction',[
            'criteria'=>array(
                'condition'=>'t.user_id = :userId',
                'params' => [':userId' => Yii::app()->user->getId()]
            ),
            'countCriteria'=>array(
                'condition'=>'user_id = :userId',
                'params' => [':userId' => Yii::app()->user->getId()]
            ),
            'sort' => [
                'defaultOrder' => 't.occurred DESC',
                'attributes' => [
                    'status' => [
                        'asc' => 'status ASC',
                        'desc' => 'status DESC',
                    ],
                    'in' => [
                        'asc' => 'in ASC',
                        'desc' => 'in DESC',
                    ],
                    'occurred' => [
                        'asc' => 'occurred ASC',
                        'desc' => 'occurred DESC',
                    ],
                    'method' => [
                        'asc' => 'method ASC',
                        'desc' => 'method DESC',
                    ],
                ]
            ],
            'pagination'=>array(
                'pageSize'=>20,
            ),
        ]);

        $this->render('index', compact('dataProvider'));
    }

    public function actionPay()
    {
        $methods = [];
        $methods[] = ['name' => 'ROBOKASSA', 'img' => 'robokassa.jpg', 'code' => 'ROBOKASSA'];

        if(isset($_POST['Pay']))
        {
            $amount = str_replace('.','',str_replace(',','',$_POST['Pay']['amount']));
            $method = $_POST['Pay']['method'];

            if(!is_numeric($amount))
            {
                Yii::app()->user->setFlash('ERROR', Yii::t('Common/Flash', 'Введите сумму'));
            }
            else
            {
                $transaction = new Transaction();
                $transaction->amount = $amount;
                $transaction->user_id = Yii::app()->user->getId();
                $transaction->method = $method;
                $transaction->occurred = new CDbExpression('NOW()');
                $transaction->status = Transaction::STATUS_PROCESS;
                $transaction->in = 1;
                if($transaction->save())
                {
                    $this->redirect(['/client/payment/submit', 'id' => $transaction->getPrimaryKey()]);
                }
            }
        }

        $this->render('pay', compact('methods'));
    }

    public function actionSubmit($id)
    {
        $transaction = Transaction::model()->findByAttributes(['user_id' => Yii::app()->user->getId(), 'id' => $id]);

        if(!$transaction)
            throw new CHttpException(404);

        switch($transaction->method)
        {
            case 'ROBOKASSA': $payModule = new Robokassa(true); break;
            default: throw new CHttpException(404);
        }

        $payModule->setAmount($transaction->amount);
        $payModule->setDescription("Пополнение баланса на сайте bulkreseller.ru");
        $payModule->setTransactionId($transaction->getPrimaryKey());
        $this->render('submit', compact('payModule'));
    }
}