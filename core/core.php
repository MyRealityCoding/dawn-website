<?php
/* Core file that includes all necessary files like the configuration and
 * a basic layout.
 * 
 * @author Miguel Gonzalez <miguel-gonzalez@gmx.de>
 * @since 1.0
 * @version 1.0
 * @link http://my-reality.de Website of the author
 * @copyright (c) 2013, Miguel Gonzalez
 */

// Include needed files
include_once('config.php');
include_once('DawnLayout.php');
include_once('functions.php');
include_once('DawnTeam.php');

$metaData = getMetaData('https://galacticum.googlecode.com/svn/trunk/res/xml/meta.xml');
$layout = new DawnLayout();

?>
