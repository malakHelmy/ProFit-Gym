<?php

require_once("Model.php");
include_once "ptPackageModel.php";
include_once "ClientModel.php";
include_once "CoachesModel.php";
include_once "EmployeeModel.php";


class ptMemberships extends Model
{

    private $ID;
    private $ClientID;
    private $CoachID;
    private $PrivateTrainingPackageID;
    private $SessionsCount;
    private $isActivated;
    private $date;

    function __construct()
    {
        $this->db = $this->connect();
    }

    public function getID()
    {
        return $this->ID;
    }

    public function setID($ID)
    {
        $this->ID = $ID;
    }

    public function setdate($date)
    {
        $this->date = $date;
    }
    public function getdate($date)
    {
       return $this->date ;
    }
    public function getClientID()
    {
        return $this->ClientID;
    }

    public function setClientID($ClientID)
    {
        $this->ClientID = $ClientID;
    }

    public function getCoachID()
    {
        return $this->CoachID;
    }

    public function setCoachID($CoachID)
    {
        $this->CoachID = $CoachID;
    }

    public function getPrivateTrainingPackageID()
    {
        return $this->PrivateTrainingPackageID;
    }

    public function setPrivateTrainingPackageID($PrivateTrainingPackageID)
    {
        $this->PrivateTrainingPackageID = $PrivateTrainingPackageID;
    }

    public function getSessionsCount()
    {
        return $this->SessionsCount;
    }

    public function setSessionsCount($SessionsCount)
    {
        $this->SessionsCount = $SessionsCount;
    }

    public function getIsActivated()
    {
        return $this->isActivated;
    }

    public function setIsActivated($isActivated)
    {
        $this->isActivated = $isActivated;
    }


    public function getAllPtMemberships()
    {
        $isActivated = "Activated";

        $sql = "SELECT client.FirstName AS clientFirstName , client.LastName AS clientLastName, employee.Name AS employeeName,  `private training package`.Name AS ptPackageName, 
        `private training package`.NumOfSessions, `private training package`.Price, `private training membership`.SessionsCount, `private training membership`.ID
        FROM `private training membership`
        INNER JOIN `private training package` ON `private training membership`.PrivateTrainingPackageID = `private training package`.ID 
        INNER JOIN client ON `private training membership`.ClientID = client.ID
        INNER JOIN employee ON `private training membership`.CoachID = employee.ID
        WHERE `private training membership`.isActivated = '$isActivated'";

        $result = $this->db->query($sql);

        $results = array();

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $results[] = array(
                    'ID' => $row['ID'],
                    'clientFirstName' => $row['clientFirstName'],
                    'clientLastName' => $row['clientLastName'],
                    'employeeName' => $row['employeeName'],
                    'ptPackageName' => $row['ptPackageName'],
                    'NumOfSessions' => $row['NumOfSessions'],
                    'Price' => $row['Price'],
                    'SessionsCount' => $row['SessionsCount'],
                );
            }
            return $results;
        }
    
    }

    public function AddptMemberships($ptMembership, $PackageMinMonths)
    {
        $ClientID = $ptMembership->ClientID;
        $CoachID = $ptMembership->CoachID;
        $Sessions = $ptMembership->SessionsCount;
        $PackageID = $ptMembership->PrivateTrainingPackageID;
        $isActivated = "Not Activated";

        // check if client has active membership
        $checkMembershipSql = "SELECT * FROM  membership WHERE ClientID = '$ClientID' AND isActivated = 'Activated'";
        $checkMembershipResult = $this->db->query($checkMembershipSql);
        $hasActiveMembership = mysqli_num_rows($checkMembershipResult) > 0;

        // check if client already is subscribed to private training package
        $check1Sql = "SELECT * FROM `private training membership` WHERE PrivateTrainingPackageID ='$PackageID' AND ClientID = '$ClientID'";
        $check1Result = $this->db->query($check1Sql);
        $alreadyThisMembershipExists = mysqli_num_rows($check1Result) > 0;

        // check if client is subscribed to any other private training package
        $check2Sql = "SELECT * FROM `private training membership` WHERE ClientID = '$ClientID'";
        $check2Result = $this->db->query($check2Sql);
        $alreadyAnotherMembershipExists = mysqli_num_rows($check2Result) > 0;

        // get active membership number of months
        $check3Sql = "SELECT package.NumOfMonths, membership.PackageID
                FROM package 
                INNER JOIN membership ON package.ID = membership.PackageID
                WHERE membership.ClientID = '$ClientID'";
        $check3Result = $this->db->query($check3Sql);

        if(!$hasActiveMembership){
            return array('noActiveMembership' => true,'alreadyThisMembershipExists' => false, 'alreadyAnotherMembershipExists' => false, 'success' => false, 'error' => false);
        }else if ($alreadyThisMembershipExists) {
            return array('noActiveMembership' => false,'alreadyThisMembershipExists' => true, 'alreadyAnotherMembershipExists' => false, 'success' => false, 'error' => false);
        } elseif ($alreadyAnotherMembershipExists) {
            return array('noActiveMembership' => false,'alreadyThisMembershipExists' => false, 'alreadyAnotherMembershipExists' => true, 'success' => false, 'error' => false);
        } else {
            if ($check3Result && $check3Result->num_rows > 0) {
                $row = $check3Result->fetch_assoc();
                $packageMonths = $row['NumOfMonths'];
                // add membership if active membership's number of months is greater than or equal to private training ackage minimum number of months
                if ($packageMonths >= $PackageMinMonths) {
                    $current_date=date('Y-m-d');
                    $sql = "INSERT INTO `private training membership`(ClientID, CoachID, PrivateTrainingPackageID, SessionsCount, isActivated,date)
                        VALUES ('$ClientID', '$CoachID', '$PackageID', '$Sessions', '$isActivated','$current_date')";
                    $insertResult = $this->db->query($sql);
                    return array('noActiveMembership' => false,'alreadyThisMembershipExists' => false, 'alreadyAnotherMembershipExists' => false, 'success' => $insertResult, 'error' => false);
                } else {
                    return array('noActiveMembership' => false,'alreadyThisMembershipExists' => false, 'alreadyAnotherMembershipExists' => false, 'success' => false, 'error' => true);
                }
            }
        }
    }

    public function addPtMembershipForClient($clientID, $ptPackageID, $coachID)
    {
        $Client = new Client();
        $Employee = new Employee();
        $findClient = $Client->checkClient($clientID);
        if ($findClient) {
            $Memberships = new Memberships();
            $checkMembership = $Memberships->hasActiveMembership($clientID);
            if ($checkMembership) {
                $coach = $Employee->getEmployeeByID($coachID);
                if ($coach) {
                    $ptPackage = new ptPackages();
                    $ptPackage = $ptPackage->getPtPackageByID($ptPackageID);
                    $ptID = $ptPackage->getID();
                    $ptSessions = $ptPackage->getNumOfSessions();
                    if ($ptPackage) {
                        $sql = "INSERT INTO `private training membership` (ClientID, CoachID, PrivateTrainingPackageID, SessionsCount, isActivated)
                        VALUES ('$clientID', '$coachID','$ptID', '$ptSessions', 'Activated')";
                        return $this->db->query($sql);
                    }
                }
            }
        }
        return false;
    }
    public function hasPtMembership($clientId)
    {
        $sql = "SELECT * FROM `private training membership` WHERE `ClientID` = '$clientId'";
        $result = $this->db->query($sql);
        if ($result) {
            $found = true;
        } else {
            $found = false;
        }
        return $found;
    }

    public function getClientPtMembershipInfo()
    {

        $isActivated = "Activated";

        $sql = "SELECT `private training membership`.SessionsCount, `private training package`.NumOfSessions, `private training package`.Price, employee.Name
                FROM `private training membership`
                INNER JOIN `private training package` ON `private training package`.ID = `private training membership`.PrivateTrainingPackageID 
                INNER JOIN employee ON employee.ID = `private training membership`.CoachID
                WHERE `private training membership`.isActivated = '$isActivated' AND `private training membership`.ClientID = " . $_SESSION['ID'];

        $result = $this->db->query($sql);

        $results = array();

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $results[] = array(
                    'SessionsCount' => $row['SessionsCount'],
                    'NumOfSessions' => $row['NumOfSessions'],
                    'Name' => $row['Name'],
                    'Price' => $row['Price']
                );
            }
            return $results;
        }
    }
    public function getClientPtMembership($clientID)
    {

        $isActivated = "Activated";

        $sql = "SELECT `private training membership`.SessionsCount, `private training package`.NumOfSessions, `private training package`.Price, employee.Name
                FROM `private training membership`
                INNER JOIN `private training package` ON `private training package`.ID = `private training membership`.PrivateTrainingPackageID 
                INNER JOIN employee ON employee.ID = `private training membership`.CoachID
                WHERE `private training membership`.isActivated = '$isActivated' AND `private training membership`.ClientID = '$clientID'";

        $result = $this->db->query($sql);

        $results = array();

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $results[] = array(
                    'SessionsCount' => $row['SessionsCount'],
                    'NumOfSessions' => $row['NumOfSessions'],
                    'Name' => $row['Name'],
                    'Price' => $row['Price']
                );
            }
            return $results;
        }
    }


    public function getPtMembershipRequests()
    {

        $isActivated = "Not Activated";

        $sql = "SELECT client.ID AS ClientID,client.FirstName,Client.LastName,`private training package`.Name AS ptPackageName,`private training package`.NumOfSessions,
        `private training package`.Price,`private training membership`.SessionsCount,`private training membership`.ID AS ptMembershipID ,employee.Name AS employeeName
        FROM `private training membership`
        INNER JOIN client ON client.ID = `private training membership`.ClientID
        INNER JOIN `private training package` ON `private training package`.ID = `private training membership`.PrivateTrainingPackageID
        INNER JOIN employee ON employee.ID = `private training membership`.CoachID
        WHERE `private training membership`.isActivated = '$isActivated'";

        $result = $this->db->query($sql);

        $results = array();

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $results[] = array(
                    'ClientID' => $row['ClientID'],
                    'FirstName' => $row['FirstName'],
                    'LastName' => $row['LastName'],
                    'ptPackageName' => $row['ptPackageName'],
                    'NumOfSessions' => $row['NumOfSessions'],
                    'Price' => $row['Price'],
                    'SessionsCount' => $row['SessionsCount'],
                    'ptMembershipID' => $row['ptMembershipID'],
                    'employeeName' => $row['employeeName']

                );
            }
            return $results;
        }
    }

    public function acceptPtMembership($PrivateTrainingPackageID)
    {
        $isActivated = "Activated";

        $sql = "UPDATE `private training membership` 
        SET isActivated='$isActivated' 
        WHERE ID = $PrivateTrainingPackageID";

        return $this->db->query($sql);
    }
    public function deletePTMembership($ptmembershipID)
    {
        $sql = "DELETE from `private training membership` where ID =" . $ptmembershipID;
        $result = $this->db->query($sql);
        return $result;
    }
    public function deletePTMembershipClient($clientID)
    {
        $sql = "DELETE from `private training membership` where ClientID =" . $clientID;
        $result = $this->db->query($sql);
        return $result;
    }

}
?>