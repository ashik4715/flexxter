<?php

	$servername = "localhost";
    	$username = "root";
    	$password = "";
	$dbname = "flexxter";
	
	$conn = new mysqli($servername, $username, $password, $dbname);
	$machine = new Machine($servername, $username, $password, $dbname);

	

class Machine 
{
	public $servername;
	public $username;
	public $password;
	public $dbname;
	public $conn;

	/** 
	 * Constructor for Machine Class
 	*/
	
	function __construct ($servername, $username, $password, $dbname) 
	{
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "flexxter";
		$conn = new mysqli($servername, $username, $password, $dbname);
		
		if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
		}else{
			// echo "Database successfully connected.";
		}

		$sql ="SELECT `EmployeeID`, `Surname`, `Password`, `Email` FROM `tblemployees` WHERE `Surname` = 'Sandy'";

		$result = $conn->query($sql);
		$userid = 0;

		if ($result) {
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				$userid =  $row["EmployeeID"];
				printf ("%s (%s) (%s) \n", $row["EmployeeID"], $row["Surname"], $row["Email"]);
			}
		}
		
		if($userid) {
		$sql ="SELECT * from `tblmachines` where employeeID= $userid AND borrowed = '1'";
		$result2 = mysqli_query($conn, $sql);
		
		echo "<br>"; 
		echo "<br>"; 
		
		if ($result2) {
			while ($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
				printf ("%s (%s) (%s) (%s) \n", $row["EmployeeID"], $row["MachineID"], $row["Title"] , $row["borrowed"]);
			}
		}

		$machines = array();
			if (mysqli_num_rows($result2) > 0) 
			{
				while ($obj = $result2 -> fetch_object()) 
				{
					array_push($machines, $obj);
				}		
				return $machines;		
			} else {
				var_dump($machines);
			}
			
		}

	}

	/**
	* Machine's unique id
	* @var int $id
	*/

	public $id;

	/**
	* Machine's title
	* @var string $title
	*/

	public $title;

	/**
	* assigns the machine to the given employee (checks the machine out)
	* @param Employee $employee the employee who wants to check out the machine
	*/

	public function checkout(Employee $employee, Machine $machine) : void
	{
		$sql = "UPDATE `tblmachines` 
		SET EmployeeID ='".$employee->$id."', borrowed= 'TRUE'
		WHERE MachineID='".$machine->$id."';";

		if ($conn->query($sql) === TRUE) {
			echo "Record updated successfully";
		} else {
			echo "Error updating record: " . $conn->error;
		}   
	}

	/**
	* Indicates that no employee has taken the machine with them
	* and that the employee put the machine back to the warehouse
	*/
	public function back_to_warehouse() : void
	{
		$sql = "UPDATE `tblmachines` 
		SET EmployeeID =NULL, borrowed= 'FALSE'
		WHERE MachineID='".$machine->$id."';";

		if ($conn->query($sql) === TRUE) {
			echo "Record updated successfully";
		} else {
			echo "Error updating record: " . $conn->error;
		}  
	}
}

class Employee
{
	/**
	* Employee's unique id
	* @var int $id
	*/
	public $id;

	/**
	* Employee's surname
	* @var string $surname
	*/

	public $surname;

	/**
	* Employee's email
	* @var string $email
	*/

	public $email;

	/**
	* Hashed als salted password
	* @var string $password
	*/

	public $password;
}


?>