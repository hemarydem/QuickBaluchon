<?php
/*
 * buildsLIkes
 * set in $where the parte of the sql command is needing
 * set in $params the parameter match with ?
 */
function buildsLIkes(array $where,array $params, array $listAttribut) :array {
    foreach ($listAttribut as $key => $value) {
        if(strcmp($key,"limit") == 0 || strcmp($key, "offset") == 0)
            continue;
        array_push($where, $key . ' LIKE ?');
        $params[] = "%" . $value . "%";
    }
    $res [0] = $where;
    $res [1] = $params;
    return  $res;
}
//TODO fuction to build the r sql request by attribut params
//function buildAttribs(string )
