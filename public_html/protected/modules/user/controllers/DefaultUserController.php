<?php

class DefaultUserController extends UserBaseController
{
    public $layout = 'default';

    public function filters() {
        return [
            ['application.filters.UserFilter -index,register,logout'],
        ];
    }

	public function actionIndex()
	{
        $model=new LoginForm(AuthHelper::ROLE_USER);

        if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if(isset($_POST['LoginForm']))
        {
            $model->attributes=$_POST['LoginForm'];
            if($model->validate() && $model->login(AuthHelper::ROLE_USER))
                $this->redirect(['/user/campaign/index']);
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
            $model->site_id = $this->site->id;

            if($model->validate() && $model->save())
            {
                Yii::app()->user->setFlash('SUCCESS', 'Вы успешно зарегистрированы');
                $this->redirect(['/user/defaultUser/index']);
            }
            else
            {
                Yii::app()->user->setFlash('ERROR', 'Ошибка регистрации');
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
        $this->redirect(['/user/defaultUser/index']);
    }
}