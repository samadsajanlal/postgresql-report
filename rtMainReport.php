<?php
include("./rtReportGlobalConfig.php"); // include mysql and ftp connection details, do not remove this line

/* VARIABLES REQUIRED FOR SCRIPT */

$UTF8 = false; // boolean value to determine if UTF-8 encoding should be used. Default for this report: false

// csv file header - column labels
$number_of_columns = 29; // this is the number of columns to parse, based on headers below. default is 23
$headers = "\"id\"~\"effectiveid\"~\"ismerged\"~\"queue\"~\"type\"~\"issuestatement\"~\"resolution\"~\"owner\"~\"subject\"~\"initialpriority\"~\"finalpriority\"~\"priority\"~\"timeestimated\"~\"timeworked\"~\"status\"~\"timeleft\"~\"told\"~\"starts\"~\"started\"~\"due\"~\"resolved\"~\"lastupdatedby\"~\"lastupdated\"~\"creator\"~\"created\"~\"disabled\"~\"queue_name\"~\"custom_field_name\"~\"custom_field_value\"";

/* SQL QUERY */
$query = "select t.*, q.name as queue_name, c.name as custom_field_name, o.content as custom_field_value
from tickets t, objectcustomfieldvalues o, customfields c, queues q
where t.id=o.objectid and c.id = o.customfield and q.id = t.queue
order by t.id, t.subject;";

/*************************************************************************************************************************/
/********************************** Logic - do NOT modify below this line! ******************************************/
/*************************************************************************************************************************/
	$file = "RT-".$fileIdentifier.$date.$extension; 

	include('./rtReportFunctionality.php');
?>