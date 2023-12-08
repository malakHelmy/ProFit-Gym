<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once("Model.php");
include_once "EmployeeModel.php";
include_once "ClassesModel.php";
include_once "ptPackageModel.php";

class Coach extends Employee
{

    public function __construct() {
        parent::__construct();
    }

    public function GetAllCoaches()
    {
        $results = array(); // Initialize the array

        $sql = "SELECT employee.ID, employee.Name, employee.Email, employee.PhoneNumber, employee.Salary, employee.Address, job_titles.Name AS JobTitleName,employee.Img
            FROM employee  
            INNER JOIN job_titles 
            ON (job_titles.Name = 'Coach' OR job_titles.Name = 'Fitness-manager') 
            AND employee.JobTitle = job_titles.Id";

        $result = $this->db->query($sql);

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $results[] = array(
                    'CoachID' => $row['ID'],
                    'Name' => $row['Name'],
                    'Email' => $row['Email'],
                    'PhoneNumber' => $row['PhoneNumber'],
                    'Salary' => $row['Salary'],
                    'Address' => $row['Address'],
                    'JobTitleName' => $row['JobTitleName'],
                    'Img' => $row['Img']
                );
            }
        }

        return $results;
    }

    public function getCoachNameByID($CoachID)
    {
        $sql = "SELECT Name
    FROM employee
    where ID = $CoachID";

        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $name = $row['Name'];
        } else {
            $name = null;
        }

        return $name;
    }

    public function getClassesForCoach($coachID)
    {

        $sql = "SELECT c.Name,ac.StartTime,ac.EndTime,ac.Date,ac.CoachID,ac.ID from assignedclass ac join class c on ac.ClassID=c.ID  where ac.CoachID=$coachID";

        $result = $this->db->query($sql);
        return $result;
    }


}
?>
