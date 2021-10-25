<?php
    require '../Connection.php';
    $keyword = $_POST["txtSearch"];

    $query = "SELECT
                AnnouncementID, 
                ATID, 
                Title, 
                Details, 
                isActive, 
                isPublished, 
                PublishedBy, 
                PublishedDateTime, 
                UnpublishedBy, 
                UnpublishedDateTime, 
                ExpiryDate,
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
                    WHEN isActive = 0 THEN 'Inactive'
                    WHEN CONVERT(ExpiryDate, DATE) >= CONVERT(CURRENT_TIMESTAMP, DATE) THEN 'Expired'
                    WHEN isActive = 1 AND isPublished = 1 THEN 'Published'
                    WHEN isActive = 1 AND IFNULL(isPublished,0) = 0 THEN 'Active - Pending'
                END as AnnouncementStatus

                FROM Announcements 
                WHERE   Title LIKE '%$keyword%'
                        AND     isPublished = 1
                        AND     isActive = 1 
                        AND     (CONVERT(ExpiryDate, DATE) >= CONVERT(CURRENT_TIMESTAMP, DATE))
        ";

    $sql = $conn -> query($query);

    $data = $sql -> fetch_all(MYSQLI_ASSOC);

    echo json_encode($data);

    $conn -> close();