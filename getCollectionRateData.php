<?php

require_once('dbconnect.php');

$study = $_GET['study'] ?: 'BBPSP';

$STUDY_SPC_TOTALS = <<<STUDY_SPC_TOTALS_END
SELECT CONCAT(YEAR(created_at), '-Q', QUARTER(created_at)) as quarter, count(id) as count
   FROM specimen_webtable
   WHERE study='{$study}'
   GROUP BY YEAR(created_at), QUARTER(created_at)
   ORDER BY YEAR(created_at), QUARTER(created_at)
STUDY_SPC_TOTALS_END;

$mysqli = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_NAME);
if ($mysqli->connect_errno) {
   echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$table = array();
$table['cols'] = array(
   array('id' => 'A', 'label' => 'Quarter', 'type' => 'string'),
   array('id' => 'B', 'label' => '# Samples', 'type' => 'number')
   );

$table['rows'] = array();
$res = $mysqli->query($STUDY_SPC_TOTALS);
while ($row = $res->fetch_assoc()) {
   //echo " quarter = {$row['quarter']}, count: {$row['count']}\n";
   array_push($table['rows'], array('c' => array(array('v' => $row['quarter']), array('v' => $row['count']))));
}

echo json_encode($table);

?>