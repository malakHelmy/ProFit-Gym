<?php


require_once("Model.php");

include_once "EmployeeModel.php";
include_once "ClientModel.php";
include_once "CoachesModel.php";
include_once "MembershipsModel.php";


class ptPackages extends Model implements Subject
{
    private $ID;
    private $Name;
    private $NumOfSessions;
    private $MinPackageMonths;
    private $Price;
    private $isActivated;

    private $observers = [];


    function __construct()
    {
        $this->db = $this->connect();
        
        $coach = new Coach();
        $client = new Client();

        $this->addObserver($coach);
        $this->addObserver($client);
    }

    public function getID()
    {
        return $this->ID;
    }

    public function setID($ID)
    {
        $this->ID = $ID;
    }

    public function getName()
    {
        return $this->Name;
    }

    public function setName($Name)
    {
        $this->Name = $Name;
    }

    public function getNumOfSessions()
    {
        return $this->NumOfSessions;
    }

    public function setNumOfSessions($NumOfSessions)
    {
        $this->NumOfSessions = $NumOfSessions;
    }

    public function getMinPackageMonths()
    {
        return $this->MinPackageMonths;
    }

    public function setMinPackageMonths($MinPackageMonths)
    {
        $this->MinPackageMonths = $MinPackageMonths;
    }

    public function getPrice()
    {
        return $this->Price;
    }

    public function setPrice($Price)
    {
        $this->Price = $Price;
    }

    public function getIsActivated()
    {
        return $this->isActivated;
    }

    public function setIsActivated($isActivated)
    {
        $this->isActivated = $isActivated;
    }

    public function getAllPtPackagesforEmployee()
    {

        $sql = "SELECT * FROM `private training package`";
        $result = $this->db->query($sql);

        if ($result) {
            $ptpackages = $result->fetch_all(MYSQLI_ASSOC);

            $result->free_result();

            // Return the packages
            return $ptpackages;
        } else {
            return [];
        }
    }

    public function getAllPtPackagesforClient()
    {
        $sql = "SELECT * FROM `private training package` WHERE isActivated='Activated'";
        $result = $this->db->query($sql);

        if ($result) {
            $packages = $result->fetch_all(MYSQLI_ASSOC);

            $result->free_result();

            return $packages;
        } else {
            return [];
        }
    }

    public function getActivePtPackagesForClient($clientID)
    {
        $currentDate = date("Y-m-d");
        $Memberships = new Memberships();
        $clientMembership = $Memberships->hasActiveMembership($clientID);
        if ($clientMembership) {

            $sql = "SELECT * FROM `private training package` WHERE `isActivated` = 'Activated'";

            $result = $this->db->query($sql);
            if ($result) {
                $membership = $Memberships->getMembershipByClientID($clientID);
                $packages = array();
                while ($row = $result->fetch_assoc()) {
                    if (strtotime($membership->getendDate()) >= strtotime($currentDate . " + " . $row['MinPackageMonths'] . " months")) {
                        $package = new ptPackages();
                        $package->ID = $row["ID"];
                        $package->Name = $row["Name"];
                        $package->MinPackageMonths = $row["MinPackageMonths"];
                        $package->NumOfSessions = $row["NumOfSessions"];
                        $package->Price = $row["Price"];
                        $packages[] = $package;
                    }
                }
                return $packages;
            }
        }
        return null;
    }

    public function addptPacks($ptPackage)
    {

        $Name = $ptPackage->Name;
        $NumOfSessions = $ptPackage->NumOfSessions;
        $MinPackageMonths = $ptPackage->MinPackageMonths;
        $Price = $ptPackage->Price;
        $isActivated = "Activated";

        $sql = "INSERT INTO `private training package` (Name, NumOfSessions, MinPackageMonths, Price, isActivated) 
                VALUES ('$Name', '$NumOfSessions', '$MinPackageMonths', '$Price','$isActivated')";


        $this->notifyObservers("New PT Package Added: " . $ptPackage->getName());

        return $this->db->query($sql);
    }


    public function activatePtPackage($ptpackageID)
    {
        $sql = "UPDATE `private training package` SET isActivated='Activated' WHERE ID='$ptpackageID'";

        return $this->db->query($sql);
    }


    public function deactivatePtPackage($ptpackageID)
    {
        $sql = "UPDATE `private training package` SET isActivated='Deactivated' WHERE ID='$ptpackageID'";

        return $this->db->query($sql);
    }

    public function getPtPackageByID($ptPackageID)
    {
        $sql = "SELECT * FROM `private training package` WHERE ID='$ptPackageID'";
        $result = $this->db->query($sql);
        if ($result) {
            $row = $result->fetch_assoc();
            $ptPackage = new PtPackages();
            $ptPackage->ID = $row["ID"];
            $ptPackage->Name = $row["Name"];
            $ptPackage->NumOfSessions = $row["NumOfSessions"];
            $ptPackage->MinPackageMonths = $row["MinPackageMonths"];
            $ptPackage->Price = $row["Price"];
            $ptPackage->isActivated = $row["isActivated"];

            return $ptPackage;
        }
        return null;
    }

    public function addObserver(Observer $observer)
    {
        $this->observers[] = $observer;
    }

    public function notifyObservers($message)
    {
        foreach ($this->observers as $observer) {
            $observer->update($message);
        }
    }
}
