<?php

class ResellerModule extends CWebModule
{
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'reseller.models.*',
			'reseller.components.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
            return !Domain::isSubDomain() || true; //@todo
			//return true;
		}
		else
			return false;
	}
}
