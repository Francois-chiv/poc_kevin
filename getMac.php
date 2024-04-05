<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "my_db"; 

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

    $sql = "SELECT pk_id, mac FROM t_mac";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = array();

    while ($row = $result->fetch_assoc()) {
        $data[] = array(
            "pk_id" => $row["pk_id"],
            "mac" => $row["mac"]
        );    
	}
	
    echo json_encode($data);
    $stmt->close();


// Close connection
$conn->close();
?>