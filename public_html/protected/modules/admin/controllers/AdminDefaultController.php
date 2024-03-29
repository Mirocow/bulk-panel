<?php

class AdminDefaultController extends AdminBaseController
{
    public $layout = 'default';
    public $defaultAction = 'login';

	public function actionLogin()
	{
        $model=new LoginForm(AuthHelper::ROLE_ADMIN);

        // if it is ajax validation request
        if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if(isset($_POST['LoginForm']))
        {
            $model->attributes=$_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if($model->validate() && $model->login(AuthHelper::ROLE_ADMIN))
                $this->redirect(['/admin/reseller/index']);
        }
        // display the login form
        $this->render('login',array('model'=>$model));
	}
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(['/admin']);
    }
}