<?php

// note: shell_exec statements below may need to be modified depending on where these scripts reside

/*************************************************************************************************************************/
/********************************** Logic - do NOT modify below this line! ******************************************/
/*************************************************************************************************************************/
// read in configuration file (lines of commands)
$output = shell_exec('/opt/lampp/bin/php /home/esamsaj/rt-scripts/rtMainReport.php '.$line);
echo $output."\r\n";
?>