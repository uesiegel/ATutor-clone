<?php
// create group
function links_create_group($group_id) {
    queryDB('INSERT INTO %slinks_categories VALUES (NULL, %s, %d, "", 0)', array(TABLE_PREFIX, LINK_CAT_GROUP, $group_id));
}

// delete group
function links_delete_group($group_id) {
    $sqlParams = array(TABLE_PREFIX, LINK_CAT_GROUP, $group_id);
    $result = queryDB('SELECT cat_id FROM %slinks_categories WHERE owner_type=%s AND owner_id=%d', $sqlParams);
    foreach ($result as $i => $value) {
        $row = $result[$i];
        queryDB('DELETE FROM %slinks WHERE cat_id=%d', array(TABLE_PREFIX, $row['cat_id']));
    }
    queryDB('DELETE FROM %slinks_categories WHERE owner_type=%s AND owner_id=%d', $sqlParams);
}
?>