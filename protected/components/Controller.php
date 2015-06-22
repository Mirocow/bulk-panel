<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to 'column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

    public function showMessages($model = null)
    {
        if($model === null)
            $errors = array();
        else
            $errors = $model->getErrors();

        if(count($errors) > 0)
        {
            echo '<div class="row">';
            foreach($errors as $error)
            {
                echo '<div class="alert alert-danger alert-dismissible col-lg-12 col-md-12 col-sm-12 col-xs-12" role="alert">'.$error[0].'</div>';
                break;
            }
            echo '</div>';
        }
        elseif(Yii::app()->user->hasFlash('SUCCESS'))
        {
            echo '<div class="row">';
            echo '<div class="alert alert-success alert-dismissible col-lg-12 col-md-12 col-sm-12 col-xs-12" role="alert">'.Yii::app()->user->getFlash('SUCCESS').'</div>';
            echo '</div>';
        }
        elseif(Yii::app()->user->hasFlash('ERROR'))
        {
            echo '<div class="row">';
            echo '<div class="alert alert-danger alert-dismissible col-lg-12 col-md-12 col-sm-12 col-xs-12" role="alert">'.Yii::app()->user->getFlash('ERROR').'</div>';
            echo '</div>';
        }
    }
}