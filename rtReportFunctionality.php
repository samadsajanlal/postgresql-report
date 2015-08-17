<?php
/*this file contains most of the logic required for generating the report
some things (such as UTF-8 encoding) have been left out of this file on purpose
you likely do not need to modify this file. */

//if it already exists when the script starts, it needs to be deleted and recreated
if (file_exists($file)) { unlink ($file); }

// convert to UTF-8 if we enable it
if($UTF8) {
	file_put_contents($file, "\xEF\xBB\xBF", FILE_APPEND | LOCK_EX);
}

//write the headers
file_put_contents($file, $headers.$lineFeed, FILE_APPEND | LOCK_EX);

// set up mysql connection
//$link = mysqli_connect($mysql_server, $mysql_username, $mysql_password, $mysql_database);
$link = pg_connect("host=".$pgsql_server." port=".$pgsql_port." dbname=".$pgsql_database." user=".$pgsql_username." password=".$pgsql_password);


/* retrieve all rows for report */
if ($result = pg_query($query) or die('Query failed: ' . pg_last_error())) {
    while ($row = pg_fetch_array($result, null, PGSQL_ASSOC)) {
		$resultRow = "";
		foreach ($row as $col_value) {
			if($col_value != "") {
				// replace line feed characters before outputting to file
				$searchFor = array("\r\n", "\n", "\r");
				$tmp = str_replace($searchFor,$replaceLineFeedCharactersWith,$col_value);
				//$resultRow.= "\"".$col_value."\"" . $seperator;
				$resultRow.= "\"".$tmp."\"" . $seperator;
			} else {
				$resultRow.= $replaceBlanksWith.$seperator;
			}
		}
		$resultRow = substr($resultRow, 0, -1); //cut off extra seperator
		$resultRow.= $lineFeed;
		file_put_contents($file, $resultRow, FILE_APPEND | LOCK_EX);
    }
    /* free result set */
    pg_free_result($result);
}

// Closing connection
pg_close($dbconn);

// now we execute the jar to format the data properly
$output = shell_exec('java -jar /home/esamsaj/rt-scripts/rt_data_conversion.jar /home/esamsaj/rt-scripts/'.$file);
echo $output."\r\n";

// transmit file to remote server
$remote_file = $ftp_directory.$file;

// set up basic connection
$conn_id = ftp_connect($ftp_server);

// login with username and password
$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

// upload a file
if (ftp_put($conn_id, $remote_file, "converted_data.csv", FTP_BINARY)) { // we really should use FTP_ASCII but this adds extra blank lines
 echo "successfully uploaded $file".$lineFeed;
} else {
 echo "There was a problem while uploading $file".$lineFeed;
}

// close the connection
ftp_close($conn_id);

//finally, delete the file
if (file_exists($file)) { unlink ($file); }
if (file_exists("converted_data.csv")) { unlink ("converted_data.csv"); }
?>