<?php
/**
 * @title          Admin Controller
 *
 * @author         Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright      (c) 2012-2013, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License; See PH7.LICENSE.txt and PH7.COPYRIGHT.txt in the root directory.
 * @package        PH7 / App / System / Module / Payment / Controller
 * @version        1.0
 */
namespace PH7;
use PH7\Framework\Url\HeaderUrl, PH7\Framework\Mvc\Router\UriRoute;

class AdminController extends MainController
{

    public function index()
    {
        $this->sTitle = t('Administration of Payment System');
        $this->view->page_title = $this->sTitle;
        $this->view->h2_title = $this->sTitle;
        $this->output();
    }

    public function config()
    {
        $this->sTitle = t('Config Payment Gateway');
        $this->view->page_title = $this->sTitle;
        $this->view->h2_title = $this->sTitle;
        $this->output();
    }

    public function membershipList()
    {
        $oMembership = $this->oPaymentModel->getMemberships();

        if(empty($oMembership)) {
            $this->displayPageNotFound(t('No membership found!'));
        } else {
            $this->sTitle = t('Memberships List');
            $this->view->page_title = $this->sTitle;
            $this->view->h2_title = $this->sTitle;
            $this->view->memberships = $oMembership;
            $this->output();
        }
    }

    public function addMembership()
    {
        $this->sTitle = t('Add Membership');
        $this->view->page_title = $this->sTitle;
        $this->view->h2_title = $this->sTitle;
        $this->output();
    }

    public function editMembership()
    {
        $this->sTitle = t('Update Membership');
        $this->view->page_title = $this->sTitle;
        $this->view->h2_title = $this->sTitle;
        $this->output();
    }

    public function deleteMembership()
    {
        $this->oPaymentModel->deleteMembership( $this->httpRequest->post('id') );
        HeaderUrl::redirect(UriRoute::get('payment', 'admin', 'membershiplist'), t('The Membership has been removed!'));
    }

}