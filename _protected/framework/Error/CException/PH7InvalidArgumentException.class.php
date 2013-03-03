<?php
/**
 * @title          PH7 Invalid Argument Exception Class
 * @desc           Exception Invalid Argument handling.
 *
 * @author         Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright      (c) 2012-2013, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License; See PH7.LICENSE.txt and PH7.COPYRIGHT.txt in the root directory.
 * @package        PH7/ Framework / Error / CException
 * @version        1.0
 */

namespace PH7\Framework\Error\CException;
defined('PH7') or exit('Restricted access');

class PH7InvalidArgumentException extends \InvalidArgumentException
{

    use Escape;

    public function __construct($sMsg)
    {
        static::init($sMsg);
    }

}