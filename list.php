

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <title>WAD Project</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4"
        crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/main.css">                        
    <link rel="stylesheet" type="text/css" href="css/list.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
</head>

<body>
    <?php include 'header.html' ?>

    <!-- MAIN CONTAINER -->
    <div class="container" id="mainBody">
        <div class="row">
            <!-- SIDE MENU - FILTERS -->
            <div class="col-lg-3" id="filters">
                <h5 style="text-align: center">FIND THE PERFECT HOTEL</h5>
                <!-- FORM -->
                <form>
                    <select id="CountOfGuests" >
                        <option value="">Count of guests</opiton>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                    <select id="roomType" >
                        <option value="">Room Type</opiton>
                        <option value="1">Single Room</option>
                        <option value="2">Double Room</option>
                        <option value="3">Triple Room</option>
                        <option value="4">Fourfold Room</option>
                    </select>
                    <select id="city" >
                        <option value="">City</opiton>
                        <option value="Athens">Athens</option>
                        <option value="Thessaloniki">Thessaloniki</option>
                        <option vakue="Kavala">Kavala</option>
                        <option value="Santorini">Santorini</option>
                    </select>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <input type="text" id="min" readonly style="border:0;font-size:0.9em">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <input type="text" id="max" readonly style="border:0;font-size:0.9em">
                        </div>
                    </div>
                    <div id="slider-range"></div>
                    <input id="checkIn" type="text" class="datepicker" placeholder="Check-in Date" 
                    value="<?php if (isset($_POST["checkIn"])) {
                        echo $_POST['checkIn'];
                    } 
                    ?>">
                    <input id="checkOut" type="text" class="datepicker" placeholder="Check-out Date"
                     value="<?php if(isset($_POST["checkOut"])){
                         echo $_POST['checkOut'];
                     }
                    ?>">
                    <!-- <input type="submit" class="btn btn-danger" value="FIND A HOTEL" width="100%"> -->
                </form>
            </div>

            <!-- MAIN BODY - ROOMS -->
            <div class="col-lg-9">
                <div class="bookingHeading">
                    <h5>Search Results</h5>
                </div>
                <!-- RESULTS HERE -->
                <div id="result">
                <?php  
                include_once('php/db.php');
                
                if(isset($_POST["city"]) && $_POST["city"]!== "") {
                    $city = $_POST["city"];
                    if(isset($_POST["roomType"]) && $_POST["roomType"] !== "") {
                        $roomType= $_POST["roomType"];
                        $sql =  "SELECT * FROM room WHERE city='$city' AND room_type=$roomType";
                    } else {
                        $sql =  "SELECT * FROM room WHERE city='$city'"; 
                    }
                } else if(isset($_POST["roomType"]) && $_POST["roomType"] !== "") {
                    $roomType= $_POST["roomType"];
                    $sql =  "SELECT * FROM room WHERE room_type=$roomType";                  
                } else {
                    $sql = 'SELECT * FROM room';
                }
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        if($row["room_type"]==1){
                            $row["room_type"] = "Single Room";
                        }
                        if($row["room_type"]==2){
                            $row["room_type"] = "Double Room";
                        }
                        if($row["room_type"]==3){
                            $row["room_type"] = "Triple Room";
                        }   
                        if($row["room_type"]==4){
                            $row["room_type"] = "Fourfold Room";
                        } ?>
                        <div class="container resultItem">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                        <img src="images/rooms/<?php echo $row["photo"]?>">
                                    </div>
                                    
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" id="itemBody">
                                        <h5><?php echo $row["name"]?></h5>
                                        <h6><?php echo $row["city"].','.$row["area"];?></h6>
                                        <p><?php echo $row["short_description"];?></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <button class="btn btn-danger goToRoom" onclick="goToRoom('<?php echo $row["name"];?>')">Go to Room</button>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                        <div class="price">
                                            <p>Per Night: <?php echo $row["price"];?>€</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                                        <div class="info">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <p>Count of Guests: <?php echo $row["count_of_guests"];?></p>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <p>Type of Room: <?php echo $row["room_type"];?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                    }
                } else {
                    echo "<h5>No Results :(</h5>";
                }
                $conn->close();
            ?>
                </div>
            </div>
        </div>
        <!-- mainContainer -->
    </div>
    
    <?php include 'footer.html' ?>

    <!-- Date picker jQuery -->
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- Bootstrap JS Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
        crossorigin="anonymous"></script>
    <script>
        
        
        $(function () {
            $(".datepicker").datepicker();
        });

        $(function () {
            $("#slider-range").slider({
                range: true,
                min: 0,
                max: 1000,
                values: [0, 1000],
                slide: function (event, ui) {
                    $("#min").val(ui.values[0]);
                    $("#max").val(ui.values[1]);
                    var city = document.getElementById("city").value;
                    var roomType = document.getElementById("roomType").value;
                    var CountOfGuests = document.getElementById("CountOfGuests").value;
                    var min = document.getElementById("min").value;
                    var max = document.getElementById("max").value;

                    var obj = { "city": city, "roomType": roomType, "CountOfGuests": CountOfGuests, "min": min, "max": max };
                    var myJSON = JSON.stringify(obj);
                    $.ajax({
                        url: "php/getResults.php",
                        dataType: "html",
                        type: 'POST',
                        data: myJSON,
                        success: function (data) {
                            $("#result").html(data);
                        }
                    });
                    }
            });
            $("#min").val($("#slider-range").slider("values", 0));
            $("#max").val($("#slider-range").slider("values", 1));
        });

        function goToRoom(name) {
            var checkIn = $('#checkIn').val();
            var checkOut = $('#checkOut').val();
            if($("#checkIn").val()!=="" && $("#checkOut").val()!=="") {
                window.location.href = "room.php?name=" + name +"&checkIn="+checkIn+"&checkOut="+checkOut;
            } else {
                alert("You must give a check in and check out value");
            }
        }

        $(function send() {
            
            $('#city').change(function(){
                var city = document.getElementById("city").value;
                var roomType = document.getElementById("roomType").value;
                var CountOfGuests = document.getElementById("CountOfGuests").value;
                var min = document.getElementById("min").value;
                var max = document.getElementById("max").value;

                var obj = { "city": city, "roomType": roomType, "CountOfGuests": CountOfGuests, "min": min, "max": max };
                var myJSON = JSON.stringify(obj);
                $.ajax({
                    url: "php/getResults.php",
                    dataType: "html",
                    type: 'POST',
                    data: myJSON,
                    success: function (data) {
                        $("#result").html(data);
                    }
                });
            });
                
            

            $('#CountOfGuests').change(function(){
                var city = document.getElementById("city").value;
                var roomType = document.getElementById("roomType").value;
                var CountOfGuests = document.getElementById("CountOfGuests").value;
                var min = document.getElementById("min").value;
                var max = document.getElementById("max").value;

                var obj = { "city": city, "roomType": roomType, "CountOfGuests": CountOfGuests, "min": min, "max": max };
                var myJSON = JSON.stringify(obj);
                $.ajax({
                    url: "php/getResults.php",
                    dataType: "html",
                    type: 'POST',
                    data: myJSON,
                    success: function (data) {
                        $("#result").html(data);
                    }
                });
            });
            
            $('#roomType').change(function(){
                var city = document.getElementById("city").value;
                var roomType = document.getElementById("roomType").value;
                var CountOfGuests = document.getElementById("CountOfGuests").value;
                var min = document.getElementById("min").value;
                var max = document.getElementById("max").value;

                var obj = { "city": city, "roomType": roomType, "CountOfGuests": CountOfGuests, "min": min, "max": max };
                var myJSON = JSON.stringify(obj);
                $.ajax({
                    url: "php/getResults.php",
                    dataType: "html",
                    type: 'POST',
                    data: myJSON,
                    success: function (data) {
                        $("#result").html(data);
                    }
                });
            });
        });
    </script>
</body>

</html>