<!doctype html>
<html>
<head>
<script src="dmxAppConnect/dmxAppConnect.js"></script>
<meta name="ac:base" content="/servo">
<base href="/servo/">
<meta charset="UTF-8">
<title>SERVO</title>

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="css/style.css" />
<script src="dmxAppConnect/dmxBootstrap5Navigation/dmxBootstrap5Navigation.js" defer=""></script>
<link rel="stylesheet" href="bootstrap/5/darkly/bootstrap.min.css" />
<link rel="stylesheet" href="dmxAppConnect/dmxBootstrap5TableGenerator/dmxBootstrap5TableGenerator.css" />
<script src="dmxAppConnect/dmxScheduler/dmxScheduler.js" defer=""></script>
<script src="dmxAppConnect/dmxTyped/dmxTyped.js" defer=""></script>
<script src="dmxAppConnect/dmxTyped/typed.min.js" defer=""></script>
<link rel="stylesheet" href="dmxAppConnect/dmxNotifications/dmxNotifications.css" />
<script src="dmxAppConnect/dmxNotifications/dmxNotifications.js" defer=""></script>
<script src="dmxAppConnect/dmxBootstrap5Modal/dmxBootstrap5Modal.js" defer=""></script>
<script src="dmxAppConnect/dmxStateManagement/dmxStateManagement.js" defer=""></script>
<script src="dmxAppConnect/dmxBrowser/dmxBrowser.js" defer=""></script>
<link rel="stylesheet" href="fontawesome5/css/all.min.css" />
<script src="dmxAppConnect/dmxBootstrap5PagingGenerator/dmxBootstrap5PagingGenerator.js" defer=""></script>
</head>
<body id="brands" is="dmx-app">
<dmx-serverconnect id="resetServoDBCount" url="dmxConnect/api/servo_installation/reset_servo_db_count.php" noload></dmx-serverconnect>

<dmx-value id="lang" dmx-bind:value="browser1.language"></dmx-value>
<dmx-json-datasource id="trans" is="dmx-serverconnect" url="assets/translation/translation.JSON"></dmx-json-datasource>

<div is="dmx-browser" id="browser1"></div>
<dmx-notifications id="notifies1"></dmx-notifications>
<main class="mt-4">
<div class="container">
<div class="row">
<div class="col text-center">
<button id="btn1" class="btn btn-danger" dmx-on:click="resetServoDBCount.load()">
<i class="fas fa-database fa-2x"></i>
</button>
<h1>{{trans.data.installServo[lang.value]}}</h1>
</div>
</div>
</div>
</main>
<script src="bootstrap/5/js/bootstrap.bundle.min.js"></script>
</body>
</html>
