<?php
/* global config for scripts */
$pgsql_server = ''; // ip address or hostname for pgsql
$pgsql_port = ''; // port number to access pgsql database
$pgsql_username = ''; // username for pgsql
$pgsql_password = ''; // password for pgsql
$pgsql_database = ''; // database to run query on
$ftp_server = ''; // ip address or hostname for ftp server
$ftp_user_name = ''; // username for ftp
$ftp_user_pass = ''; // password for ftp
$ftp_directory = '/Jira_SR_Data/'; // directory to store contents in. must start and end with /. Example: '/Jira_SR_Data/'

$lineFeed = "\r\n"; // invisible characters for carriage return at the end of each line.
$replaceBlanksWith = "NULL"; // if a blank cell is found, this value will be used in place of the blank
$replaceLineFeedCharactersWith = "~"; // if a UNIX or DOS linefeed character is encountered in the result, it will be replaced with the value here. For example: \r\n will be replaced by ~
$seperator = "~"; // the seperator used to denote where a cell ends and the next begins
$date = date('Ymd'); // date formatting to be used in filename. Uses PHP Date() function for formatting. http://php.net/manual/en/function.date.php

/* config for main report ONLY */
$fileIdentifier = "_RT_SR_"; // middle part of file name, after the customer pkey. Default: "_JIRA_SR_"
$extension = ".csv"; // file extension to be used. default ".csv"

?>