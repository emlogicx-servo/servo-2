<!doctype html>
<html>

<head>
    <meta name="ac:base" content="/servo">
    <base href="/servo/">
    <script src="dmxAppConnect/dmxAppConnect.js"></script>
    <meta charset="UTF-8">
    <title>Untitled Document</title>

    <link rel="stylesheet" href="fontawesome5/css/all.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="bootstrap/5/darkly/bootstrap.min.css" />
    <script src="js/jquery-3.5.1.slim.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap-icons.css" />
    <link rel="stylesheet" href="css/style.css" />
    <script src="dmxAppConnect/dmxBrowser/dmxBrowser.js" defer></script>
    <script src="dmxAppConnect/dmxScheduler/dmxScheduler.js" defer></script>
</head>

<body is="dmx-app" id="gugrcordo">
    <dmx-scheduler id="scheduler1" dmx-on:tick="browser1.goto('gugr-home.php')" delay="1"></dmx-scheduler>
    <div is="dmx-browser" id="browser1">

    </div>
    <script src="bootstrap/5/js/bootstrap.bundle.min.js"></script>
</body>

</html>