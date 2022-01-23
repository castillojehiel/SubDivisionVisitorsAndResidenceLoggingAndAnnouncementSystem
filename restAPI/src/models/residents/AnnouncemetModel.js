const dbConn = require('../../../config/db.config');

let Announcement = (announcements) =>{
    this.AnnouncementID = announcements.AnnouncementID;
    this.ATID = announcements.ATID;
    this.CreatedBy = announcements.CreatedBy;
    this.CreatedDateTime = announcements.CreatedDateTime;
    this.Details = announcements.Details;
    this.ExpiryDate = announcements.ExpiryDate;
    this.isActive = announcements.isActive;
    this.isPublished = announcements.isPublished;
    this.PublishedBy = announcements.PublishedBy;
    this.PublishedDateTime = announcements.PublishedDateTime;
    this.Title = announcements.Title;
    this.UnpublishedBy = announcements.UnpublishedBy;
    this.UnpublishedDateTime = announcements.UnpublishedDateTime;
    this.UpdatedBy = announcements.UpdatedBy;
    this.UpdatedDateTime = announcements.UpdatedDateTime;
}

Announcement.GetRecentAnnouncements = (result) =>{

    dbConn.query(`SELECT
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
    WHERE   ann.isActive = 1
            AND ann.isPublished = 1
            AND ann.ExpiryDate > CONVERT(CURRENT_TIMESTAMP, DATE)
            AND (
                    (MONTH(CONVERT(PublishedDateTime, DATE)) = MONTH(CURRENT_TIMESTAMP))
                    AND
                    (YEAR(CONVERT(PublishedDateTime, DATE)) = YEAR(CURRENT_TIMESTAMP))
                )
    ORDER BY ann.PublishedDateTime DESC`, (err, res) =>{
        if(err){
            console.log("Error..." , err);
            result(null, err);
        }
        else{
            console.log("Success", res);
            result(null, res);
        }
    });
}

module.exports = Announcement;