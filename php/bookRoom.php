<html>
<body>

<?php
    
    include_once('db.php');

    $str_json = file_get_contents('php://input'); //($_POST doesn't work here)
    
    $response = json_decode($str_json,true); // decoding received JSON to array
	
    $room_id = $response['room_id'];
    $checkIn = $response['checkIn'];
    $checkOut = $response['checkOut'];  
    
    $sql =  "SELECT * FROM bookings WHERE room_id=$room_id";
	$result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $conn->close();  
    } else {
        $tsql =  "INSERT INTO bookings (check_in_date,check_out_date,user_id,room_id) VALUES ('$checkIn','$checkOut',1,$room_id)";
        if ($conn->query($tsql) === TRUE) {
            echo "Already Booked";
            $conn->close();  
        } else {
            echo "Error: " . $tsql . "<br>" . $conn->error;
        }
    } 
?>

</body>
</html>