<?php
    require '../../Connection.php';

    $Description = $_POST["txtDescription"];
    $ID = $_POST["txtID"];
    $isActive = false;
    if(isset($POST["chkIsActive"])){
		$isActive = $_POST["chkIsActive"];
	}
    $UpdatedBy = 1;
	if(isset($_SESSION["UserID"])){
		$UpdatedBy = $_SESSION["UserID"];
    }

    $query = "UPDATE reporttypes 
                SET 
                    Description = '$Description', 
                    isActive = '$isActive', 
                    UpdatedBy = '$UpdatedBy', 
                    UpdatedDateTime = CURRENT_TIMESTAMP
                WHERE ReportTypeID = '$ID'
                    ";
    $sql = $conn -> query($query);

    echo json_encode(array("result" => $sql));

    $conn -> close();
