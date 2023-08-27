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
<link rel="stylesheet" href="css/style.css" />
<script src="dmxAppConnect/dmxStateManagement/dmxStateManagement.js" defer=""></script>
<link rel="stylesheet" href="fontawesome5/css/all.min.css" />
</head>
<body is="dmx-app" id="productdetails">
<dmx-session-manager id="session1"></dmx-session-manager>
<main>
<div class="container">
<p>{{session1.data.thisproduct}}</p>
</div>
</main>
<script src="bootstrap/5/js/bootstrap.bundle.min.js"></script>
</body>
</html>
