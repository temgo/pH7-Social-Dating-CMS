<?php
/**
 * @author         Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright      (c) 2012-2013, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License; See PH7.LICENSE.txt and PH7.COPYRIGHT.txt in the root directory.
 * @package        PH7 / App / System / Module / Forum / Form
 */
namespace PH7;
use PH7\Framework\Config\Config, PH7\Framework\Mvc\Request\HttpRequest;

class EditCategoryForm
{

    public static function display()
    {
        if(isset($_POST['submit_category_edit'])) {
            if(\PFBC\Form::isValid($_POST['submit_category_edit']))
                new EditCategoryFormProcessing();

            Framework\Url\HeaderUrl::redirect();
        }

        $oCategoryData = (new ForumModel)->getCategory((new HttpRequest)->get('category_id'), 0, 1);

        $oForm = new \PFBC\Form('form_category_edit', '100%');
        $oForm->configure(array('action' => ''));
        $oForm->addElement(new \PFBC\Element\Hidden('submit_category_edit', 'form_category_edit'));
        $oForm->addElement(new \PFBC\Element\Token('category_edit'));
        $oForm->addElement(new \PFBC\Element\Textbox(t('Category Name:'), 'title', array('id'=>'str_category', 'value'=>$oCategoryData->title, 'onblur'=>'CValid(this.value,this.id,4,60)', 'validation'=>new \PFBC\Validation\RegExp(Config::getInstance()->values['module.setting']['url_title.pattern']))));
        $oForm->addElement(new \PFBC\Element\HTMLExternal('<span class="input_error str_category"></span>'));
        $oForm->addElement(new \PFBC\Element\Button);
        $oForm->addElement(new \PFBC\Element\HTMLExternal('<script src="'.PH7_URL_STATIC.PH7_JS.'validate.js"></script>'));
        $oForm->render();
    }

}