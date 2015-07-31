<?php

class DefaultClientController extends ClientBaseController
{
    public $layout = '//layouts/site';

    public function filters() {
        return [
            ['application.filters.ClientFilter -index,register,logout'],
        ];
    }

	public function actionIndex()
	{
        $model=new LoginForm(AuthHelper::ROLE_CLIENT);

        if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if(isset($_POST['LoginForm']))
        {
            $model->attributes=$_POST['LoginForm'];
            if($model->validate() && $model->login(AuthHelper::ROLE_CLIENT))
                $this->redirect(['/client/campaign/index']);
        }

        $this->render('login',array('model'=>$model));
    }

    public function actionRegister()
    {
        $model = new User();

        if(isset($_POST['User']))
        {
            $model->attributes = $_POST['User'];
            $model->created = new CDbExpression('NOW()');
            $model->site_id = null;

            if($model->validate() && $model->save())
            {
                Yii::app()->user->setFlash('SUCCESS', Yii::t('Common/Flash', 'Вы успешно зарегистрированы'));
                $this->redirect(['/client/defaultClient/index']);
            }
            else {
                Yii::app()->user->setFlash('ERROR', Yii::t('Common/Flash', 'Ошибка регистрации'));
            }
        }

        $this->render('register', ['model' => $model]);
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(['/client/defaultClient/index']);
    }
}