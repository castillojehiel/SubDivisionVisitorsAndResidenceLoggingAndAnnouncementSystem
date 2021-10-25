<?php
    require '../Connection.php';

    $AnnouncementType = $_POST["cboAnnouncementType"];
    $Title = $_POST["txtTitle"];
    $ExpiryDate = $_POST["txtExpiryDate"];
    $Details = $_POST["txtDetails"];
    $CreatedBy = 1;
	if(isset($_SESSION["UserID"])){
		$CreatedBy = $_SESSION["UserID"];
    }

    $query = "INSERT INTO announcements (
                ATID,
                Title,
                Details,
                isActive,
                ExpiryDate,
                CreatedBy,
                CreatedDateTime
            )
            VALUES(
                '$AnnouncementType',
                '$Title',
                '$Details',
                1,
                '$ExpiryDate',
                '$CreatedBy',
                CURRENT_TIMESTAMP
            )
            ";
    $sql = $conn -> query($query);
    
    echo json_encode(array("result" => $sql));

	$conn -> close();
    