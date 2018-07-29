function bookRoom() {
    var room_id = document.getElementById("room_id").getAttribute("value");
    var checkIn = document.getElementById("urlCheckIn").getAttribute("value");
    var checkOut = document.getElementById("urlCheckOut").getAttribute("value");
    var obj = { "room_id": room_id, "checkIn": checkIn, "checkOut": checkOut };
    var myJSON = JSON.stringify(obj);
    var x = document.getElementById("bookButton").value;
    if (x === "Already Booked") {
        console.log(x);
    } else {
        $.ajax({
            url: "php/bookRoom.php",
            dataType: "html",
            type: 'POST',
            data: myJSON,
            success: function () {
                $("#bookButton").removeClass("btn-success");
                $("#bookButton").addClass("btn-danger")
                $("#bookButton").text("Already Booked");
                $("#bookButton").attr('value', 'Already Booked');
            }
        });
    }
}

function addReview() {
    if (document.getElementById('star1').checked) {
        var rate = 1;
    } else if (document.getElementById('star2').checked) {
        var rate = 2;
    } else if (document.getElementById('star3').checked) {
        var rate = 3;
    } else if (document.getElementById('star4').checked) {
        var rate = 4;
    } else if (document.getElementById('star5').checked) {
        var rate = 5;
    } else {
        var rate = 0;
        alert("You must give a rating from 1 to 5");
        return;
    }


    var reviewText = document.getElementById("reviewText").value;
    var room_id = document.getElementById("room_id").getAttribute("value");
    var obj = { "reviewText": reviewText, "room_id": room_id, "rate": rate };
    var myJSON = JSON.stringify(obj);
    $.ajax({
        url: "php/addReview.php",
        dataType: "html",
        type: 'POST',
        data: myJSON,
        success: function (data) {
            $("#reviews").text(data);
        }
    });
}

$(function addFavorite() {
    var status = document.getElementById("status").getAttribute("value");
    if (status == 1) {
        $("#heart").prop('checked', true);
    }

    $("#heart").change(function () {
        if (document.getElementById('heart').checked) {
            var room_id = document.getElementById("room_id").getAttribute("value");
            var obj = { "room_id": room_id };
            var myJSON = JSON.stringify(obj);
            $.ajax({
                url: "php/addFavorite.php",
                dataType: "html",
                type: 'POST',
                data: myJSON,
                success: function (data) {
                    // $('#successAddFavorite').show();
                    alert("You succesfully added room to favorite")
                }
            });
        } else {
            var room_id = document.getElementById("room_id").getAttribute("value");
            var obj = { "room_id": room_id };
            var myJSON = JSON.stringify(obj);
            $.ajax({
                url: "php/addFavorite.php",
                dataType: "html",
                type: 'POST',
                data: myJSON,
                success: function (data) {
                    // $('#successRemoveFavorite').show();
                    alert("You succesfully removed room to favorite")
                }
            });
        }
    });
});