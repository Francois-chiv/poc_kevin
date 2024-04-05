<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "my_db"; 

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['fk_mac'])) {
	$sql = "SELECT pk_id, data FROM t_data WHERE fk_mac = ?";
    $stmt = $conn->prepare($sql);
	$stmt->bind_param("s", $_GET['fk_mac']);
    $stmt->execute();
    $result = $stmt->get_result();
	
    $data = array();

    while ($row = $result->fetch_assoc()) {
        $data[] = array(
            "pk_id" => $row["pk_id"],
            "data" => $row["data"]
        );    
	}
	
    echo json_encode($data);
    $stmt->close();
} else {
	echo "null";
}

// Close connection
$conn->close();
?>