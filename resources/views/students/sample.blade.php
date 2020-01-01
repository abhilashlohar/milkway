<?php
$data = "enrolment_n,name,fathers_name,mothers_name,course,stream,year,Sem,Result,\n";


header('Content-Type: application/csv');
header('Content-Disposition: attachment; filename="sample.csv"');
echo $data; exit();
?>