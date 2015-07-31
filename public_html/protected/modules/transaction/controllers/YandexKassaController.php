<?php

class YandexKassaController extends Controller
{
    public function actionCheck()
    {
        file_put_contents('check.txt', var_dump($_POST));
    }
    public function actionAviso()
    {
        file_put_contents('aviso.txt', var_dump($_POST));
    }
}