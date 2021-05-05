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

function buildsSelectAndattributs(array $tab,string $tabNameInDb) :string {
    $str = "SELECT";
    if(!empty($tab)) {
        //echo "n'est pas vide " ;
        foreach ($tab as $key => $value) {
            if(strcmp($value,"1") == 0) {
                $str .= " " . $key . ",";
            }
        }
        //echo "avant le substr " . $str. "\n";
        $str = substr($str, 0, -1);
        $str .= " FROM " . $tabNameInDb;
        //echo $str;
        return  $str;
    } else {
        $str .= "* FROM " . $tabNameInDb;
        return  $str;
    }
}

function buildsSelectAndattributByParam(array $tab,string $tabNameInDb) :string {
    $str = "SELECT ";
    if (!empty($tab)) {
        foreach ($tab as $key => $value) {
            $str .= " " . $key . ",";
        }
        $str = substr($str, 0, -1);
        $str .= " FROM " . $tabNameInDb;
        //echo $str;
        return $str;
    } else {
        $str .= " * FROM " . $tabNameInDb;
        return $str;
    }
}

function buildsSelectAndattributsForMixePrimaryKey(array $tab, string $tabNameInDb):string {
    $str = "SELECT ";
    $nbKeys = count($tab);
    $i = 0;
    if ($nbKeys) {
        $str .= " * FROM " . $tabNameInDb . " WHERE ";
        foreach ($tab as $key => $value) {
            if($i == $nbKeys - 1) {
                $str .= $key. "= ?";
            } else {
                $str .= $key. "= ? AND ";
            }
            $i++;
        }
        return $str;
    } else {
        http_response_code(400);
        exit(1);
    }
}

function buildsSelectattributs(array $tab,string $tabNameInDb) :string {
    $str = "SELECT * FROM " . $tabNameInDb . " WHERE ";
    foreach ($tab as $key=> $value ) {
        $str = $str . $key ."=? AND ";
    }
    $str = substr($str, 0, -4);
    return  $str;
}

