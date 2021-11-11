<?php
    header("Access-Control-Allow-Origin: *");
    require 'Connection.php';
    $ID = $_GET["ID"];

    $query = "SELECT
                ann.AnnouncementID, 
                ann.ATID, 
                ann.Title, 
                ann.Details, 
                ann.isActive, 
                ann.isPublished, 
                GetDataCenterCompleteName(ann.PublishedBy) as PublishedBy,
                ann.PublishedDateTime, 
                GetDataCenterCompleteName(ann.UnpublishedBy) as UnpublishedBy,
                ann.UnpublishedDateTime, 
                ann.ExpiryDate,
                GetDataCenterCompleteName(ann.CreatedBy) as CreatedBy,
                ann.CreatedDateTime,
                GetDataCenterCompleteName(ann.UpdatedBy) as UpdatedBy,
                ann.UpdatedDateTime,
                CASE 
                    WHEN ann.isActive = 0 THEN 'Inactive'
                    WHEN CONVERT(ann.ExpiryDate, DATE) <= CONVERT(CURRENT_TIMESTAMP, DATE) THEN 'Expired'
                    WHEN ann.isActive = 1 AND ann.isPublished = 1 THEN 'Published'
                    WHEN ann.isActive = 1 AND IFNULL(ann.isPublished,0) = 0 THEN 'Active - Pending'
                END as AnnouncementStatus,
                annType.Description as AnnouncementType,
                CASE
                    WHEN    (ann.isActive = 1
                            AND IFNULL(ann.isPublished,0) = 0
                            AND (
                                    UnpublishedBy IS NULL 
                                    OR
                                    (UnpublishedBy IS NOT NULL AND IFNULL(ann.isPublished,0) = 0 AND CONVERT(ann.ExpiryDate, DATE) > CONVERT(CURRENT_TIMESTAMP, DATE))
                                )
                            AND (CONVERT(ann.ExpiryDate, DATE) > CONVERT(CURRENT_TIMESTAMP, DATE)) 
                            )
                                THEN true
                    ELSE false  
                END isAllowPublish,
                CASE
                    WHEN    ann.isActive = 1 
                            AND IFNULL(ann.isPublished,0) = 1
                            AND UnpublishedBy IS NULL 
                            AND (CONVERT(ann.ExpiryDate, DATE) > CONVERT(CURRENT_TIMESTAMP, DATE)) 
                                THEN true
                    ELSE false  
                END isAllowUnpublish

                FROM Announcements ann
                LEFT JOIN AnnouncementTypes annType
                    ON ann.ATID = annType.ATID
                WHERE AnnouncementID = '$ID'
            ";

    $sql = $conn -> query($query);
    $data = $sql -> fetch_assoc();

    echo json_encode($data);

    $conn -> close();