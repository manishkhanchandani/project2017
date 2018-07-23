<?php

class G
{
  public function getList($tableName, $max=100, $page=0, $totalRows_rsView=0, $keyword='', $params=array(), $lat='', $lng='', $radius='', $uid='', $status=1, $deleted=0, $approved=1, $cacheTime=900) {
    global $modelGeneral;
    $return = array();
    $maxRows_rsView = (int) $max;
    $startRow_rsView = (int) $page * $maxRows_rsView;
    $pageNum_rsView = $page;
    //$maxRows_rsView = (int) $max;
    //$startRow_rsView = (int) $start;
    //$pageNum_rsView = floor($startRow_rsView / $maxRows_rsView);
    $return['max'] = $maxRows_rsView;
    $return['page'] = $pageNum_rsView;
    $return['start'] = $startRow_rsView;
    $return['cacheTime'] = $cacheTime;
    $distance = '';
    $distanceWhere = '';
    $orderBy = ' ORDER BY m.updated_dt DESC';
    if (!empty($lat) && !empty($lng) && !empty($radius)) {
      $lat = (double) $lat;
      $lng = (double) $lng;
      $radius = (int) $radius;
      $distance = ", (ROUND(
      DEGREES(ACOS(SIN(RADIANS(".$lat.")) * SIN(RADIANS(m.lat)) + COS(RADIANS(".$lat.")) * COS(RADIANS(m.lat)) * COS(RADIANS(".$lng." -(m.lng)))))*60*1.1515,2)) as distance";
      $distanceWhere = " AND (ROUND(
      DEGREES(ACOS(SIN(RADIANS(".$lat.")) * SIN(RADIANS(m.lat)) + COS(RADIANS(".$lat.")) * COS(RADIANS(m.lat)) * COS(RADIANS(".$lng." -(m.lng)))))*60*1.1515,2)) <= ".$radius;
      $orderBy = ' ORDER BY distance ASC, m.updated_dt DESC';
    }
    $mainSql = "select * $distance";
    
    $sql = " from $tableName as p LEFT JOIN nodes as m ON m.node_id = p.node_id WHERE 1 $distanceWhere AND m.status = $status AND m.deleted = $deleted AND m.approved = $approved ";

    if (!empty($keyword)) {
      $sql .= " AND (m.title like ".$modelGeneral->qstr('%'.$keyword.'%')." OR m.description like ".$modelGeneral->qstr('%'.$keyword.'%').")";
    }
    //end keyword
    
    if (!empty($uid)) {
      $sql .= " AND (m.uid = ".$modelGeneral->qstr($uid).")";
    }//end uid
    
    
    if (!empty($params['mia'])) {
      $minAge = date('Y') - $params['mia'];
      $sql .= " AND (p.birth_year <= ".$minAge.")";
    }//end mia
    
    if (!empty($params['maa'])) {
      $maxAge = date('Y') - $params['maa'];
      $sql .= " AND (p.birth_year >= ".$maxAge.")";
    }//end maa
    
    if (!empty($params['n'])) {
      $tmp = implode(', ', $params['n']);
      $sql .= " AND (p.nature IN (".$tmp."))";
    }//end n
    
    if (!empty($params['h'])) {
      $tmp = implode(', ', $params['h']);
      $sql .= " AND (p.hosting IN (".$tmp."))";
    }//end h

    $sql_limit_rsView = sprintf("%s LIMIT %d, %d", $mainSql.$sql.$orderBy, $startRow_rsView, $maxRows_rsView);

    $data = $modelGeneral->fetchAll($sql_limit_rsView, array(), $cacheTime);

    $queryTotalRows = 'select count(*) as cnt '.$sql;
    if (empty($totalRows_rsView)) {
      $rowCountResult = $modelGeneral->fetchRow($queryTotalRows, array(), $cacheTime);
      $totalRows_rsView = (int) $rowCountResult['cnt'];
    }
    $sql2 = $queryTotalRows;
    $totalPages_rsView = ceil($totalRows_rsView/$maxRows_rsView)-1;
    $return['totalRows'] = $totalRows_rsView;
    $return['totalPages'] = $totalPages_rsView;
    $return['data'] = $data;
    $return['sql1'] = $sql_limit_rsView;
    $return['sql2'] = $sql2;
    return $return;
  }
  
}
?>