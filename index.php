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
        <a class="active" href="#map">Message in the World</a>
        <a href="#about">Como funciona? </a>
        <a class="submit" href="sendmsg.php" style="margin-left:60%">Envie uma mensagem!</a>
    </div>

    <div id="map" style="height:500px"> </div>
    
    <script src="jquery-3.2.1.min.js"></script>
    <script>
        function myMap() {
            var myCenter = new google.maps.LatLng(44.508742,-0.120850);// centro do mapa
            var mapCanvas = document.getElementById("map");//área do mapa
            var mapOptions = {center: myCenter, zoom: 3, draggable: true, streetViewControl: false};
            var map = new google.maps.Map(mapCanvas, mapOptions);

            $.ajax({
                    url: 'getCoords.php',
                    type: 'POST',
                    dataType: 'json'
            })

            .done(function(data)
            {
                let pos;
                let marker;
                let vetmarker = [];
                let mrkinfo = [];

                for(let i in data){
                    pos = new google.maps.LatLng(data[i].x,data[i].y);
                    marker = new google.maps.Marker({position:pos});
                    marker.setMap(map);
                    mrkinfo[i] = {
                        position: pos,
                        texto: data[i].texto
                    };
                    
                    vetmarker.push(marker);

                    google.maps.event.addListener(marker, 'click', function() {               
                        clickMarkerEvent(mrkinfo[i].texto, i, vetmarker);
                    }); 
                }

                function clickMarkerEvent(infos, i, vetmrk){
                    let infowindow = new google.maps.InfoWindow({content: infos});
                    infowindow.open(map, vetmrk[i]);
                }
            });
        }

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=DontKnowAboutThePolicyOfSharingKeysSoIWontShow&callback&callback&callback&callback=myMap"></script>
    <br><br>
    <div class="about" id="about">
        <div class="titleabout"> Já pensou em enviar uma mensagem para qualquer lugar do mundo? 
            <div class="aboutcontent"> 
                <br>
                Agora enviar uma mensagem para qualquer lugar do mundo é fácil e grátis, com poucos cliques você pode enviar uma mensagem que aparecerá para que qualquer um possa ver, apenas clicando no botão no topo da página e escrevendo o conteúdo que você deseja compartilhar com o mundo!
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