<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $txt = $_POST['msg'];
        $x = $_POST['lat'];
        $y = $_POST['lng'];

        $servername = "127.0.0.1";
        $dbusername = "root";
        $dbpassword = "";
        $dbname = "maps";
    
        $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
        if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        }
    
        $sql = "INSERT INTO coordenadas (texto, x, y) VALUES ('$txt', '$x', '$y')";
    
        if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
        } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    
        mysqli_close($conn);

        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa Site</title>
    <link rel="stylesheet" href="cssheet.css">
</head>
<body>
    
    <div class="topnav">
        <a class="active" href="index.php">Message in the World</a>
    </div>

    <div id="map" style="height:500px"> </div>
    
    <script src="jquery-3.2.1.min.js"></script>
    <script>

        function myMap() {
            let myCenter = new google.maps.LatLng(44.508742,-0.120850);
            let mapCanvas = document.getElementById("map");
            let mapOptions = {center: myCenter, zoom: 3, draggable: true, streetViewControl: false};
            let map = new google.maps.Map(mapCanvas, mapOptions);

            let flag=0,marker;

            map.addListener('click', function(e) {
                if(flag)
                    marker.setMap(null);
                else
                    flag=1;
                    marker = new google.maps.Marker({
                    position: e.latLng,
                    map: map});
                    let lat = marker.getPosition().lat();
                    let lng = marker.getPosition().lng();
                    console.log(`Lat: ${lat} e Lng: ${lng}`);
                    document.getElementById("lat").value = lat;
                    document.getElementById("lng").value = lng;
                });
        
            }
        

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=DontKnowAboutThePolicyOfSharingKeysSoIWontShow&callback&callback&callback&callback=myMap"></script>
    <br><br>
    <div class="about" id="about">
        <div class="titleabout"> Enviar mensagem
            <div>
                <form action="" method="POST">
                    <input class="Latlnginput" type="text" placeholder="Latitude" name="lat" id="lat" readonly>
                    <input class="Latlnginput" type="text" placeholder="Longitude" name="lng" id="lng" readonly>
                    <br> <br>
                    <textarea id="msg" name="msg" class="Msginput" rows="5" cols="33" placeholder="Insira sua mensagem"></textarea>
                    <br> <br>
                    <input class="Formbut" type = "submit">
                </form>
            </div>

            <div class="contact">
                <br><br>
                Relatar um bug? Contate-nos: gustavo.muraoka@unifesp.br
            </div>
            <br>
        </div>
    </div>
</body>
</html>