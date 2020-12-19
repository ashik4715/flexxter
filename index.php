<?php
	
	$machineController = new MachineController('localhost', 'root', '', 'flexxter');
	$machineController->getCheckedOutMachinesByEmployees('Sandy');

	$employee = new Employee('1','Sandy','sandy123','sandy125@gmail.com');
	$machine = new Machine('125','driller','1');

	// $machineController->checkout($employee,$machine);
	// $machineController->back_to_warehouse();

class MachineController 
{
	private $conn ="";

	/** 
	 * Constructor for MachineController Class
 	*/
	function __construct ($servername, $username, $password, $dbname) 
	{
		$this->conn = new mysqli($servername, $username, $password, $dbname);
		
		if ($this->conn->connect_error) {
		die("Connection failed: " . $this->conn->connect_error);
		}else{
			echo "Database successfully connected.";
		}
	}

	/**
	* returns all resources as objects of type Machine that are currently checked out by the employee named 'Sandy'
	* @param name $name the employee employee named 'Sandy'
	*/
	function getCheckedOutMachinesByEmployees($name)
	{
		$sql ="SELECT `EmployeeID`, `Surname`, `Password`, `Email` FROM `tblemployees` WHERE `Surname` = '".$name."'";

		$result = $this->conn->query($sql);
		$userid;

		if ($result) {
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				$userid =  $row["EmployeeID"];
				// printf ("%s (%s) (%s) \n", $row["EmployeeID"], $row["Surname"], $row["Email"]);
			}
		}
		
		$machines = array();
		
		if($userid) {
		$sql2 ="SELECT * from `tblmachines` where employeeID= '".$userid."' AND borrowed = '1'";
		$result2 = mysqli_query($this->conn, $sql2);

			if ($result2 = $this->conn-> query($sql2)) {
				while ($obj = $result2 -> fetch_object()) {
					array_push($machines, $obj);
				}
			}		
		}
		echo "<br>"; echo "<br>"; var_dump($machines);
		return $machines;
	}

	/**
	* assigns the machine to the given employee (checks the machine out)
	* @param Employee $employee the employee who wants to check out the machine
	*/
	
	/**
	* assigns the employee to the particular machine.
	* @param Machine $machine the machine that is assigned to employee
	*/

	public function checkout(Employee $employee, Machine $machine) : void
	{
		$sql = "UPDATE `tblmachines` 
		SET EmployeeID ='".$employee->id."', borrowed= '1'
		WHERE MachineID='".$machine->id."';";

		if ($this->conn->query($sql) === TRUE) {
			echo "checkout Record updated successfully";
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
		$findMachineQuery ="SELECT * from `tblmachines` where borrowed = '1'";

		$findMachineID;
		$result3 = $this->conn->query($findMachineQuery);
		if ($result3) {
			while ($row = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
				$findMachineID =  $row["MachineID"];
			}
		}

		$sql = "UPDATE `tblmachines` 
		SET EmployeeID =NULL, borrowed= '0'
		WHERE MachineID='".$findMachineID."';";

		if ($this->conn->query($sql) === TRUE) {
			echo "<br>";
			echo "back_to_warehouse Record updated successfully";
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

	/** 
	 * Constructor for Employee Class
 	*/
	function __construct($id,$surname,$email,$password)
	{	
		$this->id = $id;		
		$this->surname = $surname;		
		$this->email = $email;		
		$this->password = $password;		
	}

}

class Machine 
{
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
	 * Constructor for Machine Class
 	*/
	function __construct($id,$title)
	{	
		$this->id = $id;		
		$this->title = $title;				
	}
}

?>