<!doctype html>
<html>

<head>
    <meta name="ac:base" content="/servo">
    <base href="/servo/">
    <script src="dmxAppConnect/dmxAppConnect.js"></script>
    <meta charset="UTF-8">
    <title>Untitled Document</title>

    <script src="js/jquery-3.5.1.slim.min.js"></script>
    <link rel="stylesheet" href="fontawesome6/css/all.min.css" />
    <link rel="stylesheet" href="css/bootstrap-icons.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="bootstrap/5/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="dmxAppConnect/dmxValidator/dmxValidator.css" />
    <script src="dmxAppConnect/dmxValidator/dmxValidator.js" defer></script>
</head>

<body is="dmx-app" id="ProdUpload">
    <main>
        <div class="row">
            <div class="col">

                <form id="form1" action="ProductUpload.php" method="post" enctype="multipart/form-data">

                    <div class="form-group mb-3">
                        <label for="fileToUpload" class="form-label">Image upload</label>

                        <input type="file" class="form-control" id="fileToUpload" name="fileToUpload" aria-describedby="input2_help">

                        <small id="input2_help" class="form-text text-muted">Select here your image for upload.</small>

                    </div><button id="btn1" class="btn btn-primary" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </main>
    <script src="bootstrap/5/js/bootstrap.min.js"></script>
    <script src="bootstrap/5/js/bootstrap.bundle.min.js"></script>
</body>

</html>