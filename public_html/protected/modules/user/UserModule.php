<?php

class UserModule extends CWebModule
{
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'user.models.*',
			'user.components.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
            /*if(AuthHelper::isUser() && !Yii::app()->user->isGuest)
                Yii::app()->user->logout();*/

            return Domain::isSubDomain() || true; //@todo
		}
		else
			return false;
	}
}
