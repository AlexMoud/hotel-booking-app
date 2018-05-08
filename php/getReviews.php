<html>
<body>

<?php
    
    include_once('db.php');

    $str_json = file_get_contents('php://input'); //($_POST doesn't work here)
    
    // $response = json_decode($str_json,true); // decoding received JSON to array
	

    $sql =  "SELECT * FROM reviews";
	$result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // output data of each row
        $counter = 0;
        while($row1 = $result->fetch_assoc()) {
            $rate = $row1["rate"];         
            $counter++;   
            $sql1 =  'SELECT * FROM room WHERE room_id='.$row1["room_id"].'';
            $result1 = $conn->query($sql1);
            while($row = $result1->fetch_assoc()) { ?>
                <h6><?php echo $counter.". ".$row["name"];?></h6>
                <h5>
                <?php for ($i = 0; $i < $rate ; $i++) { ?>
                    <i class="fa fa-star"></i>
                <?php } ?>
                </h5>
            <?php
            }
        }   
    } else {
        echo "<h5>No Results :(</h5>";
    }
    $conn->close();
?>

</body>
</html>