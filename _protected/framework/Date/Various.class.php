<?php
/**
 * @title            Various Date Class
 * @desc             Various Date methods Class.
 *
 * @author           Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright        (c) 2012-2013, Pierre-Henry Soria. All Rights Reserved.
 * @license          GNU General Public License; See PH7.LICENSE.txt and PH7.COPYRIGHT.txt in the root directory.
 * @package          PH7 / Framework / Date
 * @version          1.1
 */

namespace PH7\Framework\Date;
defined('PH7') or exit('Restricted access');

class Various
{

    /**
     * Convert the time (e.g. hour:minutes:seconds) to seconds.
     *
     * @static
     * @param integer $iHMS Hours/Minutes/Seconds
     * @return integer
     */
    public static function timeToSec($iHMS)
    {
        list($iH, $iM, $iS) = explode(':', $iHMS);
        $iSeconds = 0;
        $iSeconds += (intval($iH) * 3600);
        $iSeconds += (intval($iM) * 60);
        $iSeconds += (intval($iS));
        return $iSeconds;
    }

    /**
     * Convert the seconds to time.
     *
     * @static
     * @param integer $iSeconds
     * @return string Example: 00:00
     */
    public static function secToTime($iSeconds)
    {
        $iSeconds = (int)$iSeconds;

        $iTime1 = floor($iSeconds / 60);
        $iTime2 = ($iSeconds % 60);
        return static::checkSecToTime($iTime1) . ':' . static::checkSecToTime($iTime2);
    }

    /**
     * Creates the text of the time stamp.
     *
     * @static
     * @param mixed (integer | string) Unix Timestamp or a simple Date string.
     * @return string Returns the text of the time stamp.
     */
    public static function textTimeStamp($mTime)
    {
        if (is_string($mTime)) {
            // Converting the date string format to TimeStamp.
            $mTime = strtotime($mTime);
        }

        $iTimeDiff = time() - $mTime;
        $iSeconds = $iTimeDiff;
        $iMinutes = round($iTimeDiff / 60);
        $iHours = round($iTimeDiff / 3600);
        $iDays = round($iTimeDiff / 86400);
        $iWeeks = round($iTimeDiff / 604800);
        $iMonths = round($iTimeDiff / 2419200);
        $iYears = round($iTimeDiff / 29030400);

        if ($iSeconds == 0) {
            $sTxt = t('%0% seconds ago.', 0.5);
        } elseif ($iSeconds < 60) {
            $sTxt = t('%0% seconds ago.', $iSeconds);
        } elseif ($iMinutes < 60) {
            if ($iMinutes == 1) {
                $sTxt = t('one minute ago.');
            } else {
                $sTxt = t('%0% minutes ago.', $iMinutes);
            }
        } elseif ($iHours < 24) {
            if ($iHours == 1) {
                $sTxt = t('one hour ago.');
            } else {
                $sTxt = t('%0% hours ago.', $iHours);
            }
        } else
            if ($iDays < 7) {
                if ($iDays == 1) {
                    $sTxt = t('one day ago.');
                } else {
                    $sTxt = t('%0% days ago.', $iDays);
                }
            } elseif ($iWeeks < 4) {
                if ($iWeeks == 1) {
                    $sTxt = t('one week ago.');
                } else {
                    $sTxt = t('%0% weeks ago.', $iWeeks);
                }
            } elseif ($iMonths < 12) {
                if ($iMonths == 1) {
                    $sTxt = t('one month ago.');
                } else {
                    $sTxt = t('%0% months ago.', $iMonths);
                }
            } else {
                if ($iYears == 1) {
                    $sTxt = t('one year ago.');
                } else {
                    $sTxt = t('%0% years ago.', $iYears);
                }
            }

            return $sTxt;
    }

    /**
     * Checks the value format 00:00 of the conversion of seconds to the time.
     *
     * @see \PH7\Framework\Date\Various\secToTime
     * @static
     * @return integer
     */
    protected static function checkSecToTime($iVal)
    {
        return (strlen($iVal) == 1) ? 0 . $iVal : $iVal;
    }

}