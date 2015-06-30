<?php
use \PayPal\Api\Payer;
use \PayPal\Api\Amount;
use \PayPal\Api\Payment;
use \PayPal\Api\ItemList;
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
	        	$this->render('error', array_merge(['error' => $error], $error));
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
        $model = new User();

        if(isset($_POST['User']))
        {
            $model->attributes = $_POST['User'];
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

    public function actionResellerClaim()
    {
        $model = new ResellerClaim();


        if(isset($_POST['ResellerClaim']))
        {
            $model->attributes = $_POST['ResellerClaim'];
            $model->created = new CDbExpression('NOW()');

            if($model->validate() && $model->save())
            {
                Yii::app()->user->setFlash('SUCCESS', 'Ваша заявка отправлена! Мы с нами свяжемся');
                $this->redirect(['/site/claimSent']);
            }
        }

        $this->render('resellerClaim', ['model' => $model]);
    }

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

    public function actionLol()
    {
        CVarDumper::dump(TariffHelper::getTariffs(1), 100, true);
    }
}
