<?php
/**
 * Created by PhpStorm.
 * User: slashman
 * Date: 02.07.15
 * Time: 19:52
 */

class AdminBaseController extends Controller
{
    public $layout = 'admin';

    public function filters() {
        return [
            ['application.filters.SiteFilter'],
            ['application.filters.AdminFilter -login,logout'],
        ];
    }
}