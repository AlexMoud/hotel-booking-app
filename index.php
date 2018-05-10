<!DOCTYPE html>
<html lang="en">

<head>  
    <?php include 'head.html' ?>
    <link rel="stylesheet" type="text/css" href="css/landing.css">
</head>

<body>
    <!-- Upper Menu -->
    <?php include 'header.html' ?>
    
    <!-- Search Box -->
    <div class="container">
        <form action="list.php" method="POST">
        <div class="row">
                <div class="col-lg-12">
                    <p id="searchQuote">Search and find the perfect room for you...</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <select id="city" name="city">
                        <option value="">City</opiton>
                        <?php 
                            include_once('php/db.php');
                            $sql =  'SELECT DISTINCT city FROM room';
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $row["city"];?>"><?php echo $row["city"];?></option>
                            <?php 
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="col-lg-6">
                    <select id="roomType" name="roomType">
                        <option value="">Room Type</opiton>
                        <?php 
                            include_once('php/db.php');
                            $sql =  'SELECT * FROM room_type';
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $row["id"];?>"><?php echo $row["room_type"];?></option>
                            <?php 
                                }
                            }
                            ?>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="calendarIcon"><i class="fa fa-calendar"></i></span>
                        </div>
                           <input id="checkIn" name="checkIn" type="text" class="datepicker form-control" placeholder="Check-in Date" readonly>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="calendarIcon2"><i class="fa fa-calendar"></i></span>
                        </div>
                            <input id="checkOut" name="checkOut" type="text" class="datepicker form-control" placeholder="Check-out Date" readonly>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <input type="submit" class="btn btn-danger" value="Search">
                </div>
            </div>
        </form>
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
    <script src="js/datepicker.js"></script>
</body>

</html>