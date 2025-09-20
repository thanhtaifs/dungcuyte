<?php

/**
 * @Project NUKEVIET 4.x
 * @Author NHÍM THỦ LĨNH (contact@vinanat.vn)
 * @Copyright (C) 2014 Pa Software Solutions (http://vinanat.vn). All rights reserved
 * @Createdate Nov 18, 2014, 02:32:08 PM
 */

if ( ! defined( 'NV_IS_FILE_ADMIN' ) ) die( 'Stop!!!' );

$id = $nv_Request->get_int( 'id', 'post', 0 );
if ( empty( $id ) ) die( "NO_" . $id );

$query = "SELECT `weight` FROM `" . NV_PREFIXLANG . "_" . $module_data . "` WHERE `id`=" . $id;
$result = $db->query( $query );
$numrows = $result->rowCount();
if ( $numrows != 1 ) die( 'NO_' . $id );

$new_weight = $nv_Request->get_int( 'new_weight', 'post', 0 );
if ( empty( $new_weight ) ) die( 'NO_' . $mod );

$query = "SELECT `id` FROM `" . NV_PREFIXLANG . "_" . $module_data . "` WHERE `id`!=" . $id . " ORDER BY `weight` ASC";
$result = $db->query( $query );
$weight = 0;
while ( $row = $result->fetch() )
{
 $weight++;
 if ( $weight == $new_weight ) $weight++;
 $sql = "UPDATE `" . NV_PREFIXLANG . "_" . $module_data . "` SET `weight`=" . $weight . " WHERE `id`=" . $row['id'];
 $db->query( $sql );
}

$sql = "UPDATE `" . NV_PREFIXLANG . "_" . $module_data . "` SET `weight`=" . $new_weight . " WHERE `id`=" . $id;
$db->query( $sql );
nv_del_moduleCache( $module_name );
include ( NV_ROOTDIR . "/includes/header.php" );
echo 'OK_' . $id;
include ( NV_ROOTDIR . "/includes/footer.php" );

?>