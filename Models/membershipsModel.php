<?php

require_once("Model.php");

include_once "ClientModel.php";
include_once "PackageModel.php";

class Memberships extends Model
{
    private $ID;
    private $clientId;
    private $packageId;
    private $startDate;
    private $endDate;
    private $visitsCount;
    private $invitationsCount;
    private $inbodyCount;
    private $privateTrainingSessionsCount;
    private $freezeCount;
    private $freezed;
    private $isActivated;

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

    public function getClientId()
    {
        return $this->clientId;
    }

    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
    }

    public function getPackageId()
    {
        return $this->packageId;
    }

    public function setPackageId($packageId)
    {
        $this->packageId = $packageId;
    }

    public function getStartDate()
    {
        return $this->startDate;
    }

    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    }

    public function getEndDate()
    {
        return $this->endDate;
    }

    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
    }

    public function getVisitsCount()
    {
        return $this->visitsCount;
    }

    public function setVisitsCount($visitsCount)
    {
        $this->visitsCount = $visitsCount;
    }

    public function getInvitationsCount()
    {
        return $this->invitationsCount;
    }

    public function setInvitationsCount($invitationsCount)
    {
        $this->invitationsCount = $invitationsCount;
    }

    public function getInbodyCount()
    {
        return $this->inbodyCount;
    }

    public function setInbodyCount($inbodyCount)
    {
        $this->inbodyCount = $inbodyCount;
    }

    public function getPrivateTrainingSessionsCount()
    {
        return $this->privateTrainingSessionsCount;
    }

    public function setPrivateTrainingSessionsCount($privateTrainingSessionsCount)
    {
        $this->privateTrainingSessionsCount = $privateTrainingSessionsCount;
    }

    public function getFreezeCount()
    {
        return $this->freezeCount;
    }

    public function setFreezeCount($freezeCount)
    {
        $this->freezeCount = $freezeCount;
    }

    public function getFreezed()
    {
        return $this->freezed;
    }

    public function setFreezed($freezed)
    {
        $this->freezed = $freezed;
    }

    public function getIsActivated()
    {
        return $this->isActivated;
    }

    public function setIsActivated($isActivated)
    {
        $this->isActivated = $isActivated;
    }

    public function getAllMemberships()
    {
        $sql = "SELECT * FROM `membership`";
        $result = $this->db->query($sql);
        $memberships = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $membership = new Memberships();
                $membership->ID = $row['ID'];
                $membership->clientId = $row['ClientID'];
                $membership->packageId = $row['PackageID'];
                $membership->startDate = $row['StartDate'];
                $membership->endDate = $row['EndDate'];
                $membership->visitsCount = $row['VisitsCount'];
                $membership->invitationsCount = $row['InvitationsCount'];
                $membership->inbodyCount = $row['InbodyCount'];
                $membership->privateTrainingSessionsCount = $row['PrivateTrainingSessionsCount'];
                $membership->freezeCount = $row['FreezeCount'];
                $membership->freezed = $row['Freezed'];
                if ($membership->freezed == 1) {
                    $membership->dropScheduledUnfreeze($membership->ID);
                    $membership->freezed = 0;
                }
                $memberships[] = $membership;
            }
        }
        return $memberships;
    }

    public function deleteMembership($membershipID)
    {
        $sql = "DELETE from membership where ID =" . $membershipID;
        $result = $this->db->query($sql);
        return $result;
    }
    public function deleteMembershipClient($clientID)
    {
        $sql = "DELETE from membership where ClientID =" . $clientID;
        $result = $this->db->query($sql);
        return $result;
    }
    public function createMembershipEmployeeSide($clientId, $packageId)
    {
        $isActivated = "Activated";
        $client = new Client();
        $package = new Package();
        $findClient = $client->checkClient($clientId);
        $findPackage = $package->checkPackage($packageId);
        if ($findClient && $findPackage) {
            $Package = $package->getPackage($packageId);
            $startDate = date("Y-m-d");
            $endDate = date("Y-m-d", strtotime("+" . $Package->getNumOfMonths() . "months"));
            $freezed = 0;
            $numOfInv = $Package->getNumOfInvitations();
            $numOfInb = $Package->getNumOfInbodySessions();
            $privTrain = $Package->getNumOfPrivateTrainingSessions();
            $freezeCount = $Package->getFreezeLimit();
            $freezed = 0;
            $isActivated = 'Activated';
            $sql = "INSERT INTO `membership` (ClientID, PackageID, StartDate, EndDate, VisitsCount, InvitationsCount, InbodyCount, PrivateTrainingSessionsCount, FreezeCount, Freezed, isActivated)
                                  VALUES ('$clientId', '$packageId', '$startDate', '$endDate', '0', '$numOfInv', '$numOfInb', '$privTrain','$freezeCount', '$freezed','$isActivated')";
            return $this->db->query($sql);
        }
        return false;
    }


    public function createMembershipUserSide($packageId)
    {
        $pck = new Package();
        $client = new Client();
        $isActivated = "Not Activated";
        $findClient = $client->checkClient($_SESSION['ID']); // Use $_SESSION['ID'] directly
        $findPackage = $pck->checkPackage($packageId);

        if ($findClient && $findPackage) {
            $Package = $pck->getPackage($packageId);

            $check1Sql = "SELECT * FROM `membership` WHERE PackageID ='$packageId' AND ClientID = " . $_SESSION['ID'];
            $check1Result = $this->db->query($check1Sql);
            $alreadyThisMembershipExists = mysqli_num_rows($check1Result) > 0;

            $check2Sql = "SELECT * FROM `membership` WHERE ClientID = " . $_SESSION['ID'];
            $check2Result = $this->db->query($check2Sql);
            $alreadyAnotherMembershipExists = mysqli_num_rows($check2Result) > 0;

            if ($alreadyThisMembershipExists) {
                return array('alreadyThisMembershipExists' => true, 'alreadyAnotherMembershipExists' => false, 'success' => false);
            } else if ($alreadyAnotherMembershipExists) {
                return array('alreadyThisMembershipExists' => false, 'alreadyAnotherMembershipExists' => true, 'success' => false);
            } else {
                $numOfmonths = $Package->getNumOfMonths();
                $startDate = date("Y-m-d");
                $endDate = date("Y-m-d", strtotime("+$numOfmonths months"));
                $numOfInv = $Package->getNumOfInvitations();
                $numOfInb = $Package->getNumOfInbodySessions();
                $privTrain = $Package->getNumOfPrivateTrainingSessions();
                $freezeCount = $Package->getFreezeLimit();
                $freezed = 0;
                $sql = "INSERT INTO `membership` (ClientID, PackageID, StartDate, EndDate, VisitsCount, InvitationsCount, InbodyCount, PrivateTrainingSessionsCount, FreezeCount, Freezed, isActivated)
                    VALUES ('" . $_SESSION['ID'] . "', '$packageId', '$startDate', '$endDate', '0', '$numOfInv', '$numOfInb', '$privTrain', '$freezeCount', '$freezed' , '$isActivated')";
                $insertResult = $this->db->query($sql);

                return array('alreadyThisMembershipExists' => false, 'alreadyAnotherMembershipExists' => false, 'success' => $insertResult);
            }
        }
    }

    public function hasActiveMembership($clientId)
    {
        $currentDate = date("Y-m-d");

        $sql = "SELECT * FROM `membership` WHERE `ClientID` = '$clientId'";
        $result = $this->db->query($sql);
        $found = false;
        if ($result && $result->num_rows > 0) {
            $membership = $result->fetch_assoc();
            if ($currentDate >= $membership['StartDate'] && $currentDate <= $membership['EndDate']) {
                $found = true;
            }
        }
        return $found;
    }
    public function hasMembership($clientId)
    {
        $sql = "SELECT * FROM `membership` WHERE `ClientID` = '$clientId'";
        $result = $this->db->query($sql);
        
        return $result;
    }

    public function getMembershipByID($membershipID)
    {

        $sql = "SELECT * FROM `membership` WHERE `ID` = '$membershipID'";

        $result = $this->db->query($sql);
        if ($result) {
            $membershipData = $result->fetch_assoc();
            $membership = new Memberships();
            $membership->ID = $membershipData["ID"];
            $membership->clientId = $membershipData["ClientID"];
            $membership->packageId = $membershipData["PackageID"];
            $membership->startDate = $membershipData["StartDate"];
            $membership->endDate = $membershipData["EndDate"];
            $membership->visitsCount = $membershipData["VisitsCount"];
            $membership->inbodyCount = $membershipData["InvitationsCount"];
            $membership->privateTrainingSessionsCount = $membershipData["PrivateTrainingSessionsCount"];
            $membership->freezeCount = $membershipData["FreezeCount"];
            if ($membership->freezed == 1) {
                $membership->dropScheduledUnfreeze($membershipID);
                $membership->freezed = 0;
            }
            $membership->freezed = $membershipData["Freezed"];

            return $membership;
        }
        return null;
    }

    public function getMembershipByClientID($clientId) //byClientID
    {
        $currentDate = date("Y-m-d");

        $sql = "SELECT * FROM `membership` WHERE `ClientID` = '$clientId'";

        $result = $this->db->query($sql);

        if ($result) {
            $membershipData = $result->fetch_assoc();

            if ($membershipData) {
                $membership = new Memberships();
                $membership->ID = $membershipData["ID"];
                $membership->clientId = $membershipData["ClientID"];
                $membership->packageId = $membershipData["PackageID"];
                $membership->startDate = $membershipData["StartDate"];
                $membership->endDate = $membershipData["EndDate"];
                $membership->visitsCount = $membershipData["VisitsCount"];
                $membership->inbodyCount = $membershipData["InvitationsCount"];
                $membership->privateTrainingSessionsCount = $membershipData["PrivateTrainingSessionsCount"];
                $membership->freezeCount = $membershipData["FreezeCount"];
                $membership->freezed = $membershipData["Freezed"];
                if ($membership->freezed == 1) {
                    $membership->dropScheduledUnfreeze($membership->ID);
                    $membership->freezed = 0;
                }
                $membership->isActivated = $membershipData["isActivated"];
            } else {
                $membership = null;
            }


            return $membership;
        }

        return false;
    }

    public function getClientMembershipInfo()
    {
        $isActivated = "Activated";

        $sql = "SELECT package.Title, package.NumOfInvitations, package.NumOfInbodySessions, package.NumOfPrivateTrainingSessions,
            package.FreezeLimit, package.Price , membership.StartDate, membership.EndDate, membership.InvitationsCount, membership.InbodyCount,
            membership.PrivateTrainingSessionsCount, membership.FreezeCount
            FROM package 
            INNER JOIN membership ON package.ID = membership.PackageID 
            WHERE membership.isActivated = '$isActivated' AND membership.ClientID = " . $_SESSION['ID'];

        $result = $this->db->query($sql);

        $results = array();

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $results[] = array(
                    'Title' => $row['Title'],
                    'NumOfInvitations' => $row['NumOfInvitations'],
                    'Price' => $row['Price'],
                    'NumOfInbodySessions' => $row['NumOfInbodySessions'],
                    'NumOfPrivateTrainingSessions' => $row['NumOfPrivateTrainingSessions'],
                    'FreezeLimit' => $row['FreezeLimit'],
                    'StartDate' => $row['StartDate'],
                    'EndDate' => $row['EndDate'],
                    'InvitationsCount' => $row['InvitationsCount'],
                    'InbodyCount' => $row['InbodyCount'],
                    'PrivateTrainingSessionsCount' => $row['PrivateTrainingSessionsCount'],
                    'FreezeCount' => $row['FreezeCount']
                );
                $membership = new Memberships();
                $membership = $membership->getMembershipByClientID($_SESSION['ID']);
                if ($membership->freezed == 1) {
                    $membership->dropScheduledUnfreeze($membership->ID);
                }
            }
            return $results;
        }
    }

    public function freezeMembership($membershipId, $selectedDate)
    {
        $membership = Memberships::getMembershipByID($membershipId);

        if ($membership) {
            $freezeEndDate = date("Y-m-d", strtotime($selectedDate));
            $startDateTime = new DateTime();
            $endDateTime = new DateTime($selectedDate);

            $interval = $startDateTime->diff($endDateTime);
            $days = $interval->days;

            $newEndDate = date("Y-m-d", strtotime($membership->endDate . " + " . $days . " days"));
            $newFreezeCount = $membership->freezeCount - $days;


            $sql = "UPDATE `membership` SET EndDate='$newEndDate', Freezed = 1, FreezeCount='$newFreezeCount' WHERE ID='$membershipId'";
            $result = $this->db->query($sql);

            $freezeStartDate = date("Y-m-d");

            $sql2 = "INSERT INTO `scheduled_unfreeze` (membership_id, freezeEndDate, freezeStartDate, freezeCount) VALUES 
            ('$membership->ID','$freezeEndDate', '$freezeStartDate', '$newFreezeCount')";

            $result2 = $this->db->query($sql2);

            if ($result && $result2) {
            } else {
                return false;
            }
            return $result;
        } else {
            return false;
        }
    }

    public function getScheduledUnFreeze($membershipId)
    {
        $sql = "SELECT * FROM `scheduled_unfreeze` WHERE `membership_id` = '$membershipId'";
        $result = $this->db->query($sql);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            return $row;
        } else {
            return false;
        }
    }

    public function unFreezeMembership($membershipId)
    {
        $membership = Memberships::getMembershipByID($membershipId);

        $scheduledUnFreeze = Memberships::getScheduledUnFreeze($membershipId);

        if ($membership && $scheduledUnFreeze) {
            $currDate = new DateTime();
            $freezeStartDate = new DateTime($scheduledUnFreeze['freezeStartDate']);
            $freezeEndDate = new DateTime($scheduledUnFreeze['freezeEndDate']);
            if ($currDate < $freezeEndDate) {
                $package = new Package();
                $Package = $package->getPackage($membership->packageId);
                $interval = $currDate->diff($freezeStartDate);
                $days = $interval->days;

                $oldFreezeDuration = $freezeEndDate->diff($freezeStartDate);
                $freezeDays = $oldFreezeDuration->days;
                $newFreezeDuration = $days;
                $difference = $freezeDays - $newFreezeDuration - 1;
                $newFreezeCount = $membership->freezeCount + $difference;

                $numOfMonths = $Package->getNumOfMonths();
                $newEndDate = date("Y-m-d", strtotime($membership->startDate . " +$numOfMonths months +$days days"));
                $sql = "UPDATE `membership` SET EndDate='$newEndDate',FreezeCount = '$newFreezeCount', Freezed = 0 WHERE ID='$membershipId'";
                $result = $this->db->query($sql);

                $sql2 = "DELETE FROM scheduled_unfreeze WHERE `membership_id` = '$membershipId'";
                $result2 = $this->db->query($sql2);

                if ($result && $result2) {
                } else {
                    return false;
                }
            } else if ($currDate >= $freezeEndDate) {
                $sql = "UPDATE `membership` SET Freezed = 0 WHERE ID='$membershipId'";
                $result = $this->db->query($sql);
                $sql2 = "DELETE FROM scheduled_unfreeze WHERE `membership_id` = '$membershipId'";
                $result2 = $this->db->query($sql2);

                if ($result && $result2) {
                } else {
                    return false;
                }
            }
            return $result;
        } else {
            return false;
        }
    }
    public function dropScheduledUnfreeze($membershipId)
    {
        $scheduledUnFreeze = Memberships::getScheduledUnFreeze($membershipId);
        $currDate = new DateTime();
        $freezeEndDate = new DateTime($scheduledUnFreeze['freezeEndDate']);
        if ($currDate >= $freezeEndDate) {
            $sql = "UPDATE `membership` SET Freezed = 0 WHERE ID='$membershipId'";
            $result = $this->db->query($sql);
            $sql2 = "DELETE FROM scheduled_unfreeze WHERE `membership_id` = '$membershipId'";
            $result2 = $this->db->query($sql2);
        }
    }
    public function getMembershipRequests()
    {

        $isActivated = "Not Activated";

        $sql = "SELECT client.ID,client.FirstName,package.Title,package.NumOfMonths,membership.StartDate,membership.EndDate,package.Price,membership.ID AS membershipID
        FROM membership
        INNER JOIN client ON client.ID = membership.ClientID
        INNER JOIN package ON package.ID = membership.PackageID
        WHERE membership.isActivated = '$isActivated'";

        $result = $this->db->query($sql);

        $results = array();

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $results[] = array(
                    'ID' => $row['ID'],
                    'FirstName' => $row['FirstName'],
                    'Title' => $row['Title'],
                    'NumOfMonths' => $row['NumOfMonths'],
                    'StartDate' => $row['StartDate'],
                    'EndDate' => $row['EndDate'],
                    'Price' => $row['Price'],
                    'membershipID' => $row['membershipID']
                );
            }
            return $results;
        }
    }

    public function acceptMembership($membershipID)
    {

        $isActivated = "Activated";

        $sql = "UPDATE membership 
        SET isActivated='$isActivated' 
        WHERE ID = $membershipID";

        return $this->db->query($sql);
    }

    public function calculateRemainingFreezeAttempts($userInput)
    {
        if ($this->freezeCount !== null && $this->freezeCount > 0) {
            $remainingFreezeAttempts = max(0, $this->freezeCount - $userInput);
            $this->freezeCount = $remainingFreezeAttempts;

            return $remainingFreezeAttempts;
        } else {
            return 0;
        }
    }

    public function getClientsAndTheirMembership()
    {
        $isActivated = 'Activated';

        $sql = "SELECT client.ID,client.FirstName,client.LastName,package.Title,package.VisitsLimit,
        membership.EndDate,membership.Freezed,membership.VisitsCount
        FROM membership
        INNER JOIN client ON client.ID = membership.ClientID
        INNER JOIN PACKAGE ON package.ID = membership.PackageID
        where membership.isActivated= '$isActivated' AND membership.EndDate > CURDATE() 
        AND (package.VisitsLimit = 0 OR (package.VisitsLimit > 0 AND package.VisitsLimit > membership.VisitsCount))";

        $result = $this->db->query($sql);

        $results = array();

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $results[] = array(
                    'ID' => $row['ID'],
                    'FirstName' => $row['FirstName'],
                    'LastName' => $row['LastName'],
                    'Title' => $row['Title'],
                    'VisitsLimit' => $row['VisitsLimit'],
                    'EndDate' => $row['EndDate'],
                    'Freezed' => $row['Freezed'],
                    'VisitsCount' => $row['VisitsCount']
                );
            }
            return $results;
        }
    }

    public function checkinClient($clientID)
    {
        $sql = "UPDATE membership 
        SET VisitsCount = VisitsCount + 1
        WHERE ClientID = $clientID";

        return $this->db->query($sql);
    }
}
?>
