<?php
/**
 * @author         Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright      (c) 2012-2013, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License; See PH7.LICENSE.txt and PH7.COPYRIGHT.txt in the root directory.
 * @package        PH7 / App / System / Core / Model
 */
namespace PH7;

use PH7\Framework\Mvc\Model\Engine\Util\Various;

class UpgradeCoreModel extends Framework\Mvc\Model\Engine\Model
{

    /**
     * Executes sql queries for the upgrade of the software.
     *
     * @param string $sSqlUpgradeFile File SQL
     * @return mixed (boolean | array) Returns TRUE if there are no errors, otherwise returns an ARRAY of error information.
     */
    public function run($sSqlUpgradeFile)
    {
        return Various::execFileQuery($sSqlUpgradeFile);
    }

}