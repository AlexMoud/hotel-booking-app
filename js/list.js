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
    if ($("#checkIn").val() !== "" && $("#checkOut").val() !== "") {
        window.location.href = "room.php?name=" + name + "&checkIn=" + checkIn + "&checkOut=" + checkOut;
    } else {
        alert("You need to assign check in and check out values to continue.");
    }
}

$(function send() {
    $('#city').change(function () {
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
                $("#result").hide().html(data).fadeIn("slow");
            }
        });
    });

    $('#CountOfGuests').change(function () {
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
                $("#result").hide().html(data).fadeIn("slow");
            }
        });
    });

    $('#roomType').change(function () {
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
                $("#result").hide().html(data).fadeIn("slow");
            }
        });
    });
});