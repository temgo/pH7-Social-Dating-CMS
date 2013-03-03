<?php
/**
 * @author         Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright      (c) 2012-2013, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License; See PH7.LICENSE.txt and PH7.COPYRIGHT.txt in the root directory.
 * @package        PH7 / App / System / Module / Admin / From
 */
namespace PH7;

use
PH7\Framework\Mvc\Model\DbConfig,
PH7\Framework\File\File,
PH7\Framework\Mvc\Request\HttpRequest,
PH7\Framework\Mvc\Router\UriRoute;

class MetaMainForm
{

    public static function display()
    {
        if (isset($_POST['submit_meta']))
        {
            if (\PFBC\Form::isValid($_POST['submit_meta']))
                new MetaMainFormProcessing;

            Framework\Url\HeaderUrl::redirect();
        }

        $sWhereLang = (new HttpRequest)->get('meta_lang');
        $oMeta = DbConfig::getMetaMain($sWhereLang);

        // Generate form Meta Tags
        $oForm = new \PFBC\Form('form_meta', 500);
        $oForm->configure(array('action' => ''));
        $oForm->addElement(new \PFBC\Element\Hidden('submit_meta', 'form_meta'));
        $oForm->addElement(new \PFBC\Element\Token('admin_meta'));

        $oForm->addElement(new \PFBC\Element\HTMLExternal('<div class="center divShow">'));
        $oFile = new File();
        $aLangs = $oFile->getDirList(PH7_PATH_APP_LANG);
        $oForm->addElement(new \PFBC\Element\HTMLExternal('<h3 class="underline"><a href="#showDiv_listLang" title="' . t('Click here to show/hide the languages') . '">' . t('Change language for the Meta Tags') . '</a></h3>'));
        $oForm->addElement(new \PFBC\Element\HTMLExternal('<ul class="hidden" id="showDiv_listLang">'));

        $i = 1;
        foreach ($aLangs as $sLang) $oForm->addElement(new \PFBC\Element\HTMLExternal('<li>' . $i++ . ') ' . '<a class="bold" href="' . UriRoute::get(PH7_ADMIN_MOD, 'setting', 'metamain', $sLang, false) . '">' . $sLang . '</a></li>'));

        $oForm->addElement(new \PFBC\Element\HTMLExternal('</ul>'));
        unset($oFile, $aLangs);
        $oForm->addElement(new \PFBC\Element\HTMLExternal('</div>'));

        $oForm->addElement(new \PFBC\Element\Textbox(t('Language:'), 'lang_id', array('value' => $oMeta->langId, 'description' => t('EX: "en", "fr", "es", "jp"'), 'validation' => new \PFBC\Validation\Str(5, 5), 'required' => 1)));
        $oForm->addElement(new \PFBC\Element\Textbox(t('Home page title:'), 'page_title', array('value' => $oMeta->pageTitle, 'validation' => new \PFBC\Validation\Str(2, 100), 'required' => 1)));
        $oForm->addElement(new \PFBC\Element\Textbox(t('Slogan:'), 'slogan', array('value' => $oMeta->slogan, 'validation' => new \PFBC\Validation\Str(2, 200), 'required' => 1)));
        $oForm->addElement(new \PFBC\Element\Textbox(t('Description (meta tag):'), 'meta_description', array('value' => $oMeta->metaDescription, 'validation' => new \PFBC\Validation\Str(2, 255), 'required' => 1)));
        $oForm->addElement(new \PFBC\Element\Textbox(t('Keywords (meta tag):'), 'meta_keywords', array('description' => t('Separate keywords by commas.'), 'value' => $oMeta->metaKeywords, 'validation' => new \PFBC\Validation\Str(2, 255), 'required' => 1)));
        $oForm->addElement(new \PFBC\Element\Textbox(t('Robots (meta tag):'), 'meta_robots', array('value' => $oMeta->metaRobots, 'validation' => new \PFBC\Validation\Str(2, 50), 'required' => 1)));
        $oForm->addElement(new \PFBC\Element\Textbox(t('Author (meta tag):'), 'meta_author', array('value' => $oMeta->metaAuthor, 'validation' => new \PFBC\Validation\Str(2, 50), 'required' => 1)));
        $oForm->addElement(new \PFBC\Element\Textbox(t('Copyright (meta tag):'), 'meta_copyright', array('value' => $oMeta->metaCopyright, 'validation' => new \PFBC\Validation\Str(2, 50), 'required' => 1)));
        $oForm->addElement(new \PFBC\Element\Textbox(t('Rating (meta tag):'), 'meta_rating', array('value' => $oMeta->metaRating, 'validation' => new \PFBC\Validation\Str(2, 50), 'required' => 1)));
        $oForm->addElement(new \PFBC\Element\Textbox(t('Distribution (meta tag):'), 'meta_distribution', array('value' => $oMeta->metaDistribution, 'validation' => new \PFBC\Validation\Str(2, 50), 'required' => 1)));
        $oForm->addElement(new \PFBC\Element\Textbox(t('Categorys (meta tag):'), 'meta_category', array('value' => $oMeta->metaCategory, 'validation' => new \PFBC\Validation\Str(2, 50), 'required' => 1)));
        $oForm->addElement(new \PFBC\Element\Button);
        $oForm->render();
    }

}