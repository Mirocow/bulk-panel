<?php

class SiteController extends Controller
{
	public $layout='site';

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

    public function actionIndex()
    {
        $this->render('index');
    }
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
        $this->layout = 'error';

	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}
	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm(CUserIdentity::ROLE_RESELLER);

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
			if($model->validate() && $model->login(CUserIdentity::ROLE_RESELLER))
				$this->redirect(['/reseller/status/index']);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

    public function actionRegister()
    {
        $model = new Reseller();

        if(isset($_POST['Reseller']))
        {
            $model->attributes = $_POST['Reseller'];
            $model->created = new CDbExpression('NOW()');

            if($model->validate() && $model->save())
            {
                Yii::app()->user->setFlash('SUCCESS', 'Вы успешно зарегистрированы');
                $this->redirect(['/site/login']);
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
		$this->redirect(Yii::app()->homeUrl);
	}
}
