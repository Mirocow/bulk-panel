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
        $contact = Domain::getCurrentSite()->contacts;

        $this->render('contact', compact('contact'));
    }
    public function actionInvoiceDetails()
    {
        $invoiceDetails = Domain::getCurrentSite()->invoice_details;

        $this->render('invoiceDetails', compact('invoiceDetails'));
    }
    public function actionTariffs()
    {
        $tariffs = TariffHelper::getTariffs(Domain::getCurrentSiteId());

        $this->render('tariffs', compact('tariffs'));
    }
}