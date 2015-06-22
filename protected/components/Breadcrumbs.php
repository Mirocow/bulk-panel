<?php
class BreadCrumbs
{
    public static function render($breadcrumbs, $class = 'default')
    {
        $content = '';
        if(count($breadcrumbs) > 0)
        {
            $content .= '<div class="row"><div class="btn-group btn-breadcrumb">'.PHP_EOL;
            $first = true;

            foreach($breadcrumbs as $title => $url)
            {
                $params = [];
                $route = $url[0];

                if(count($url) > 1)
                    $params = $url[1];

                if($first)
                {
                    $content .= '<a href="'.self::createUrl($route,$params).'" class="btn btn-'.$class.'"><i class="glyphicon glyphicon-home"></i></a>';
                    $first = false;
                    continue;
                }

                if(!is_numeric($title))
                {
                    $content .= '<a href="'.self::createUrl($route,$params).'" class="btn btn-'.$class.'">'.$title.'</a>';
                }
                else
                    $content .= '<button href="#" class="btn btn-'.$class.'" disabled="disabled">'.$title.'</button>';
            }
            $content .= '</div></div>';
        }

        return $content;
    }

    public static function createUrl($route, $params = [], $ampersand = '&')
    {
        return Yii::app()->createUrl(trim($route,'/'),$params,$ampersand);
    }
}