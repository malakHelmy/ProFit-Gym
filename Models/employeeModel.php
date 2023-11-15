<?php


include_once "../includes/dbh.inc.php";


class Employee
{
    public $ID;
    public $Name;
    public $Email;
    public $Password;
    public $Salary;
    public $JobTitle;
    public $Address;
    public $PhoneNumber;

    public static function getAllEmployees()
    {
        global $conn;

        $sql = "SELECT * FROM employee";
        $result = $conn->query($sql);

        $employees = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $employee = new Employee();
                $employee->ID = $row['ID'];
                $employee->Name = $row['Name'];
                $employee->Email = $row['Email'];
                $employee->Password = $row['Password'];
                $employee->Salary = $row['Salary'];
                $employee->JobTitle = $row['JobTitle'];
                $employee->Address = $row['Address'];
                $employee->PhoneNumber = $row['PhoneNumber'];

                $employees[] = $employee;
            }
        }

        return $employees;
    }

    public function addEmployee($employee)
    {
        global $conn;

        $name = $employee->Name;
        $Sal = $employee->Salary;
        $address = $employee->Address;
        $phoneNumber = $employee->PhoneNumber;
        $jobTitle = $employee->JobTitle;
        $Email = $employee->Email;
        $Password = $employee->Password;

        $sql = "INSERT INTO employee (Name, Salary, Address, PhoneNumber, JobTitle, Email, Password) 
                VALUES ('$name', '$Sal', '$address', '$phoneNumber', '$jobTitle','$Email', '$Password')";
        return mysqli_query($conn, $sql);
    }
    public function updateEmployee($employee)
    {
        global $conn;

        $name = $employee->Name;
        $Sal = $employee->Salary;
        $address = $employee->Address;
        $phoneNumber = $employee->PhoneNumber;
        $jobTitle = $employee->JobTitle;
        $Email = $employee->Email;
        $Password = $employee->Password;

        $employee_id = $_SESSION['ID'];

        if (!empty($Password)) {
            $hashedPassword = password_hash($Password, PASSWORD_DEFAULT);
            $sql = "UPDATE employee SET Name='$name', Email='$Email', Password='$hashedPassword', Salary='$Sal', PhoneNumber='$phoneNumber', Address='$address', 
            JobTitle='$jobTitle'
                    WHERE ID = $employee_id";
            return $conn->query($sql);
        } else {
            // Update with the new password
            $sql = $sql = "UPDATE employee SET Name='$name', Email='$Email', Salary='$Sal', PhoneNumber='$phoneNumber', Address='$address', 
            JobTitle='$jobTitle'
                    WHERE ID = $employee_id";
            return $conn->query($sql);
        }
    }

    public function deleteEmployee()
    {
        global $conn;

        $sql = "DELETE from employee where ID =" . $_SESSION['ID'];

        return mysqli_query($conn, $sql);
    }
}