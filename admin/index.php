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

require_once __DIR__ . '/admin_header.php';
xoops_cp_header();

$adminObject  = \Xmf\Module\Admin::getInstance();

$start     = XoopsRequest::getInt('start', 0, 'POST');// xtubeCleanRequestVars($_REQUEST, 'start', 0);
$start1    = XoopsRequest::getInt('start1', 0, 'POST');// xtubeCleanRequestVars($_REQUEST, 'start1', 0);
$start2    = XoopsRequest::getInt('start2', 0, 'POST');// xtubeCleanRequestVars($_REQUEST, 'start2', 0);
$start3    = XoopsRequest::getInt('start3', 0, 'POST');// xtubeCleanRequestVars($_REQUEST, 'start3', 0);
$start4    = XoopsRequest::getInt('start4', 0, 'POST');// xtubeCleanRequestVars($_REQUEST, 'start4', 0);
$start5    = XoopsRequest::getInt('start5', 0, 'POST');// xtubeCleanRequestVars($_REQUEST, 'start5', 0);
$totalcats = XoopstubeUtility::xtubeGetTotalCategoryCount();

$result = $GLOBALS['xoopsDB']->query('SELECT COUNT(*) FROM ' . $GLOBALS['xoopsDB']->prefix('xoopstube_broken'));
list($totalbrokenvideos) = $GLOBALS['xoopsDB']->fetchRow($result);
$result2 = $GLOBALS['xoopsDB']->query('SELECT COUNT(*) FROM ' . $GLOBALS['xoopsDB']->prefix('xoopstube_mod'));
list($totalmodrequests) = $GLOBALS['xoopsDB']->fetchRow($result2);
$result3 = $GLOBALS['xoopsDB']->query('SELECT COUNT(*) FROM ' . $GLOBALS['xoopsDB']->prefix('xoopstube_videos') . ' WHERE published = 0');
list($totalnewvideos) = $GLOBALS['xoopsDB']->fetchRow($result3);
$result4 = $GLOBALS['xoopsDB']->query('SELECT COUNT(*) FROM ' . $GLOBALS['xoopsDB']->prefix('xoopstube_videos') . ' WHERE published > 0');
list($totalvideos) = $GLOBALS['xoopsDB']->fetchRow($result4);

//$xxx='<a href="brokenvideo.php">' . _AM_XOOPSTUBE_SBROKENSUBMIT . '</a><b>';

$adminObject->addInfoBox(_AM_XOOPSTUBE_MINDEX_VIDEOSUMMARY);
if ($totalcats > 0) {
    $adminObject->addInfoBoxLine(sprintf('<infolabel>' . '<a href="category.php">' . _AM_XOOPSTUBE_SCATEGORY . '</a><b>' . '</infolabel>', $totalcats), '', 'Green');
} else {
    $adminObject->addInfoBoxLine(sprintf('<infolabel>' . _AM_XOOPSTUBE_SCATEGORY . '</infolabel>', $totalcats), '', 'Green');
}

if ($totalvideos > 0) {
    $adminObject->addInfoBoxLine(sprintf('<infolabel>' . '<a href="main.php">' . _AM_XOOPSTUBE_SFILES . '</a><b>' . '</infolabel>', $totalvideos), '', 'Green');
} else {
    $adminObject->addInfoBoxLine(sprintf('<infolabel>' . _AM_XOOPSTUBE_SFILES . '</infolabel>', $totalvideos), '', 'Green');
}

if ($totalnewvideos > 0) {
    $adminObject->addInfoBoxLine(sprintf('<infolabel>' . '<a href="newvideos.php">' . _AM_XOOPSTUBE_SNEWFILESVAL . '</a><b>' . '</infolabel>', $totalnewvideos), '', 'Red');
} else {
    $adminObject->addInfoBoxLine(sprintf('<infolabel>' . _AM_XOOPSTUBE_SNEWFILESVAL . '</infolabel>', $totalnewvideos), '', 'Red');
}
if ($totalmodrequests > 0) {
    $adminObject->addInfoBoxLine(sprintf('<infolabel>' . '<a href="modifications.php">' . _AM_XOOPSTUBE_SMODREQUEST . '</a><b>' . '</infolabel>', $totalmodrequests), '', 'Red');
} else {
    $adminObject->addInfoBoxLine(sprintf('<infolabel>' . _AM_XOOPSTUBE_SMODREQUEST . '</infolabel>', $totalmodrequests), '', 'Red');
}

if ($totalbrokenvideos > 0) {
    $adminObject->addInfoBoxLine(sprintf('<infolabel>' . '<a href="brokenvideo.php">' . _AM_XOOPSTUBE_SBROKENSUBMIT . '</a><b>' . '</infolabel><infotext>',
                                $totalbrokenvideos . '</infotext>'), '', 'Red');
} else {
    $adminObject->addInfoBoxLine(sprintf('<infolabel>' . _AM_XOOPSTUBE_SBROKENSUBMIT . '</infolabel><infotext>', $totalbrokenvideos . '</infotext>'), '', 'Red');
}

//------ create directories ---------------
/*
$folderMode = $GLOBALS['xoopsModuleConfig']['dirmode'];
//require_once __DIR__ . '/../class/utility.php';
foreach (array_keys($uploadFolders) as $i) {
    XoopstubeUtility::prepareFolder($uploadFolders[$i], $folderMode);
    $adminObject->addConfigBoxLine($uploadFolders[$i], 'folder');
    //    $adminObject->addConfigBoxLine(array($uploadFolders[$i], $folderMode), 'chmod');
}
*/

require_once __DIR__ . '/../testdata/index.php';
$adminObject->addItemButton(_AM_XOOPSTUBE_ADD_SAMPLEDATA, '__DIR__ . /../../testdata/index.php?op=load', 'add');

$adminObject->displayNavigation(basename(__FILE__));
$adminObject->displayButton('left', '');
$adminObject->displayIndex();

/*
//------ check directories ---------------
require_once __DIR__ . '/../include/directorychecker.php';

$adminObject->addConfigBoxLine('');
$redirectFile = $_SERVER['PHP_SELF'];

$languageConstants = array(
    _AM_XOOPSTUBE_AVAILABLE,
    _AM_XOOPSTUBE_NOTAVAILABLE,
    _AM_XOOPSTUBE_CREATETHEDIR,
    _AM_XOOPSTUBE_NOTWRITABLE,
    _AM_XOOPSTUBE_SETMPERM,
    _AM_XOOPSTUBE_DIRCREATED,
    _AM_XOOPSTUBE_DIRNOTCREATED,
    _AM_XOOPSTUBE_PERMSET,
    _AM_XOOPSTUBE_PERMNOTSET
);

$path = $GLOBALS['xoopsModuleConfig']['uploaddir'] . '/';
$adminObject->addConfigBoxLine(DirectoryChecker::getDirectoryStatus($path, 0777, $languageConstants, $redirectFile));

$path = XOOPS_ROOT_PATH . '/' . $GLOBALS['xoopsModuleConfig']['screenshots'] . '/';
$adminObject->addConfigBoxLine(DirectoryChecker::getDirectoryStatus($path, 0777, $languageConstants, $redirectFile));

$path = XOOPS_ROOT_PATH . '/' . $GLOBALS['xoopsModuleConfig']['catimage'] . '/';
$adminObject->addConfigBoxLine(DirectoryChecker::getDirectoryStatus($path, 0777, $languageConstants, $redirectFile));

$path = XOOPS_ROOT_PATH . '/' . $GLOBALS['xoopsModuleConfig']['mainimagedir'] . '/';
$adminObject->addConfigBoxLine(DirectoryChecker::getDirectoryStatus($path, 0777, $languageConstants, $redirectFile));

//$adminObject->displayNavigation(basename(__FILE__));
//$adminObject->displayIndex();
//echo wfd_serverstats();
//---------------------------

xtubeFileChecks();

*/

require_once __DIR__ . '/admin_footer.php';
