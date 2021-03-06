<?php

/**
 * Module: XoopsTube
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 *
 * PHP version 5
 *
 * @category        Module
 * @package         Xoopstube
 * @author          XOOPS Development Team
 * @copyright       2001-2016 XOOPS Project (http://xoops.org)
 * @license         GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @link            http://xoops.org/
 * @since           1.0.6
 */
class XtubeTextSanitizer extends MyTextSanitizer
{
    /**
     * @param $text
     *
     * @return string
     */
    public function htmlSpecialCharsStrip($text)
    {
        return $this->htmlSpecialChars($this->stripSlashesGPC($text));
    }
}
