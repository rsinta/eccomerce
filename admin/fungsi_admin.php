<?php

function enum_values($conn, $table_name, $column_name) {
    $sql = "
        SELECT COLUMN_TYPE 
        FROM INFORMATION_SCHEMA.COLUMNS
        WHERE TABLE_NAME = '" . mysql_real_escape_string($table_name) . "' 
            AND COLUMN_NAME = '" . mysql_real_escape_string($column_name) . "'
    ";
    $result = mysqli_query($conn, $sql) or die (mysqli_error($conn));
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $enum_list = explode(",", str_replace("'", "", substr($row['COLUMN_TYPE'], 5, (strlen($row['COLUMN_TYPE'])-6))));
    // die();
    return $enum_list;
}

function cek($data) {
	echo "<pre>";
	print_r($data);
	echo "</pre>";
}

?>