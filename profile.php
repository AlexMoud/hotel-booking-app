<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">        
    <title>WAD Project</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4"
        crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/main.css">                                
    <link rel="stylesheet" type="text/css" href="css/profile.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
</head>

<body>
    <?php include 'header.html'?>

    <!-- Main Body -->
    <div class="container" id="mainBody">
        <div class="row">
            <div class="col-lg-3">
                <h5>Favorites</h5>
                <div id="favoriteResults">

                </div>
                <h5>Reviews</h5>
                <div id="reviewResults">

                </div>
            </div>
            <!-- MAIN BODY - ROOMS -->
            <div class="col-lg-9">
                <div class="bookingHeading">
                    <h5>My Bookings</h5>
                </div>
                <!-- RESULTS HERE -->
                <div id="result"></div>
            </div>

        </div>
    </div>

    <?php include 'footer.html'?>


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
            var obj = {};
            var myJSON = JSON.stringify(obj);
            
            $.ajax({
                url: "php/getBookings.php",
                dataType: "html",
                type: 'POST',
                data: myJSON,
                success: function (data) {
                    $("#result").html(data);
                }
            });
            
            $.ajax({
                url: "php/getReviews.php",
                dataType: "html",
                type: 'POST',
                data: myJSON,
                success: function (data) {
                    $("#reviewResults").html(data);
                }
            });

            $.ajax({
                url: "php/getFavorites.php",
                dataType: "html",
                type: 'POST',
                data: myJSON,
                success: function (data) {
                    $("#favoriteResults").html(data);
                }
            });

        });

        function goToRoom(name) {
            window.location.href = "room.php?name=" + name;
        }
    </script>
</body>

</html>