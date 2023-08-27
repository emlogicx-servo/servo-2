<!doctype html>
<html>

<head>
    <meta name="ac:base" content="/servo">
    <base href="/servo/">
    <script src="dmxAppConnect/dmxAppConnect.js"></script>
    <meta charset="UTF-8">
    <title>Untitled Document</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="bootstrap/5/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" integrity="sha384-ejwKkLla8gPP8t2u0eQyL0Q/4ItcnyveF505U0NIobD/SMsNyXrLti6CWaD0L52l" crossorigin="anonymous" />
    <link rel="stylesheet" href="fontawesome5/css/all.min.css" />
    <script src="js/jquery-3.5.1.slim.min.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>



    <style>
        body {
            background: rgb(204, 204, 204);
            align-items: center;
        }

        page {
            background: white;
            display: block;
            margin: 0 auto;
            /* margin-bottom: 900px; */
            /* margin-bottom: 1.5cm; */
            box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
            background-image: url("uploads/bgcud.png");
            /*background-size:cover;*/

        }

        page[size="A4"][layout="landscape"] {

            height: 2480px;
            width: 3508px;

            padding: 12%;
        }

        /*
@media print {
  body, page {
    margin: 0;
    box-shadow: 0;
    /* background-image: url("imagebg_permis de batir_hd.png"); */

        }
        }

        #cameroon-french * {
            text-align: center !important;
        }


        hr {

            height: 6px;
            width: 20%;
            margin: 0 25% 0 40%;
            margin-top: -4 !important;
            background: #144f72;
            /*margin-left:400px!important; 
    margin-right:400px !important;  
*/
        }

        .col-4 {
            text-align: center;
        }

        h4 {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 85px;
            color: #144f72 !important;

        }

        h2 {
            color: #da682f !important;
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bolder;
            padding-left: 10px;
            padding-right: 10px;
            font-size: 220px;
            text-shadow: 2px -2px 0 #144f72,
                2px 2px 0 #144f72,
                2px 2px 0 #144f72,
                2px 2px 0 #144f72;
        }

        .hd13,
        .logo1,
        .logo2,
        .hd12,
        .hd14 {
            font-family: Arial, Helvetica, sans-serif;
            color: #144f72 !important;
        }

        .hd13 {
            font-size: 40px;
        }

        .hd12 {
            font-weight: bolder;
            font-size: 60px;
        }

        .hd14 {
            font-size: 50px;
            margin-top: -2%;
        }

        .hd1 {
            font-family: Arial, Helvetica, sans-serif;
            color: #144f72 !important;
            font-size: 60px;
        }

        .logo1 {
            font-size: 30px !important;
            color: #da682f !important;
        }

        .logo2 {
            font-size: 60px !important;
            color: #da682f !important;
            margin-top: -2%;
        }

        .b {
            margin-top: -2%;
            margin-bottom: 2%;
            font-size: 55px;
            color: #144f72;
        }

        .p {
            font-size: 60px;
            font-weight: bolder;
            font-family: Arial, Helvetica, sans-serif;
            color: #144f72 !important;
        }

        .number {
            margin-bottom: 50px;
            margin-top: -35px;
            font-size: 120px;
            color: #da682f !important;

        }

        h6 {
            margin-top: -1%;
            font-size: 90px;
            padding-bottom: 2%;
        }

        span {
            color: #144f72 !important;
            font-size: bolder;
        }

        .rotate {
            transform: rotate(-90deg);
            position: absolute;
            font-size: 60px;
            font-weight: border;
            margin-top: 200px;
            margin-left: -100px;
        }

        h3 {
            text-align: center;
            font-weight: bolder;
            padding: 2px;
            font-size: 60px;
        }

        h5 {
            font-size: 50px;
            margin-top: %
        }

        .cntr {
            padding-left: 50px;
        }

        .permis,
        .number {
            text-align: center !important;
        }


        #qr {
            margin-top: 250px !important;
        }

        .main-container {
            margin-top: 20px;
        }
    </style>
    <script src="dmxAppConnect/dmxStateManagement/dmxStateManagement.js" defer></script>

</head>

<body is="dmx-app" id="printPlaque" dmx-on:ready="session_variables.set('current_asset',query.asset)">
    <dmx-session-manager id="session_variables"></dmx-session-manager>
    <dmx-serverconnect id="read_asset" url="dmxConnect/api/servo_assets/read_customer_asset.php" dmx-param:asset_id="query.asset"></dmx-serverconnect>

    <button type="button" class="btn btn-primary btn-lg cmd">generate PDF</button>
    <div class="container main-container">

        <page id="page" size="A4" layout="landscape">

            <div id="cameroon-row" class="row" style="text-align:center !important;">
                <div id="cameroon-french" class="col-sm-5">
                    <h4 id="cameroon">République du Cameroun</h4>
                    <p id="peace-work" class="hd1">Paix - Travail - Patrie</p>
                    <hr>
                    <p id="douala" class="hd12">Ville de Douala</p>
                    <p id="communaute" class="hd14">Communauté Urbaine</p>
                    <p id="guichet" class="hd13">Guichet Unique de facilitation de la Délivrance<br>
                        des Actes Administratifs Relatifs à l’Utilisation du Sol et à la Construction</p>

                </div>
                <div id="logo" class="col-sm-2">
                    <img class="imaglogo" src="uploads/log.png" alt="" />
                    <!-- <p class="logo1 font-monospace">VILLE  CITY</p>
                    <p class="logo2">DOUALA</p>
                -->
                </div>

                <div id="cameroon-english" class="col-sm-5">
                    <h4>Republic of Cameroon</h4>
                    <p class="hd1">Peace - Work - Fatherland</p>
                    <hr>
                    <p class="hd12">Douala City</p>
                    <p class="hd14">City Council</p>
                    <p class="hd13">Single Window for Facilitating the Delivery<br>
                        of Administrative Certificates Relating to<br>
                        Land Use and Land Construction</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="permis"> PERMIS DE CONSTRUIRE</h2>
                    <h4 class="p number">N°:{{read_asset.data.query_read_customer_asset.permit_number}}</h4>
                </div>
            </div>

            <div class="row cntr">
                <div class="col-sm-8">
                    <p class="p"> Maître d’Ouvrage : <span>{{read_asset.data.query_read_customer_asset.maitre_douvrage}}</span></p>
                    <p class="b">Contracting Authority</p>

                    <p class="p">Maître d’Oeuvre : <span> {{read_asset.data.query_read_customer_asset.maitre_doeuvre}}</span></p>
                    <p class="b">Construction Manager</p>

                    <p class="p">Type de Construction : <span> {{read_asset.data.query_read_customer_asset.construction_type}}</span></p>
                    <p class="b">Type of Construction</p>

                    <p class="p">Surface Cumulée (m2) :<span> {{read_asset.data.query_read_customer_asset.combined_surface_area}}</span> </p>
                    <p class="b">Combined Surface Area</p>

                    <p class="p">Quartier :<span> {{read_asset.data.query_read_customer_asset.neighborhood}}</span></p>
                    <p class="b">District</p>

                    <p class="p">N° ou Nom de la Rue:<span> {{read_asset.data.query_read_customer_asset.street_name}}</span></p>
                    <p class="b">N° or Street Name</p>

                </div>
                <div class="col-sm-2 qr">
                    <p class="p"></p>
                    <div id="qr"></div>
                </div>
                <div class="col-sm-2">
                    <p class="rotate"> {{read_asset.data.query_read_customer_asset.asset_lat}},{{read_asset.data.query_read_customer_asset.asset_long}}</p>

                </div>


            </div>
        </page>

    </div>
</body>
<script src="qr/qrcode.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function(){

var specialElementHandlers = {
'#editor': function (element, renderer) {
return true;
}
};

$('.cmd').click(function () {
var pdf = new jsPDF(
{ orientation: 'landscape',
unit: 'px',
format: 'a4',
putOnlyUsedFonts:true
});

pdf.addHTML($('#page'), {

"elementHandlers":specialElementHandlers},

function(){
pdf.autoPrint({variant: 'non-conform'});
pdf.save('web.pdf');


});
})
});

</script>

<script>
    $(document).ready(function($) 
    { 
    var assetvalue = sessionStorage.getItem('dmxState-current_asset');
    var assetv = dmx.parse('query.asset');
    console.log('assetv=' + assetv);
    console.log(assetvalue);
    
    new QRCode(document.getElementById("qr"), "https://douala.buildingcontrolcm.com/asset-dash.php?asset=" + assetv);
    });
</script>


<script src="bootstrap/5/js/bootstrap.bundle.min.js">
</script>

</html>