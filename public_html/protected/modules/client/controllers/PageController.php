<?php
/**
 * Created by PhpStorm.
 * User: slashman
 * Date: 23.06.15
 * Time: 2:03
 */

class PageController extends ClientBaseController
{
    public function actionContact()
    {
        $this->render('contact');
    }
    public function actionInvoiceDetails()
    {
        $this->render('invoiceDetails');
    }
    public function actionTariffs()
    {
        $tariffs = TariffHelper::getTariffs();

        $this->render('tariffs', compact('tariffs'));
    }
}