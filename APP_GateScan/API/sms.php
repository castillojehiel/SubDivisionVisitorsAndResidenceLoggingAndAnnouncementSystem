<?php
    include 'Connection.php';
    require_once "vendor/autoload.php";
    function SendSMSToHouseHoldContactPersons($HouseHoldID, $Message){
        //query for all HouseholdID contact person mobile numbers
        
        $basic  = new \Vonage\Client\Credentials\Basic("3b2aa728", "k87dDzouF4ri7Idy");
        $client = new \Vonage\Client($basic);

        $query = "SELECT 
                        dc.ContactNo
                    FROM householdcontactpersons hhcp
                        LEFT JOIN DataCenter dc
                            ON hhcp.ResidentID = dc.DataCenterID
                    WHERE hhcp.HouseHoldID = '$HouseHoldID'";
        $sql = $conn -> query($query);
        while($data = $sql -> fetch_assoc()){
            $ContactNo = "63" . substr($data["ContactNo"],-10);
            $response = $client->sms()->send(
                new \Vonage\SMS\Message\SMS($ContactNo, "Fiesta Homes SMS", $Message . "\n" . ".")
            );
            
            $message = $response->current();
        }
    }

    function SendSMS($MobileNo, $Message){
        $basic  = new \Vonage\Client\Credentials\Basic("3b2aa728", "k87dDzouF4ri7Idy");
        $client = new \Vonage\Client($basic);

        $ContactNo = "63" . substr($MobileNo,-10);
            $response = $client->sms()->send(
                new \Vonage\SMS\Message\SMS($ContactNo, "Fiesta Homes SMS", $Message . "\n" . ".")
            );
            
            $message = $response->current();
    }