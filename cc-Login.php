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
    <script src="js/jquery-3.5.1.slim.min.js"></script>
    <script src="dmxAppConnect/dmxBootstrap5Navigation/dmxBootstrap5Navigation.js" defer=""></script>
    <link rel="stylesheet" href="bootstrap/5/servodark/bootstrap.min.css" />
    <link rel="stylesheet" href="dmxAppConnect/dmxBootstrap5TableGenerator/dmxBootstrap5TableGenerator.css" />
    <script src="dmxAppConnect/dmxScheduler/dmxScheduler.js" defer=""></script>
    <script src="dmxAppConnect/dmxTyped/dmxTyped.js" defer=""></script>
    <script src="dmxAppConnect/dmxTyped/typed.min.js" defer=""></script>
    <link rel="stylesheet" href="dmxAppConnect/dmxNotifications/dmxNotifications.css" />
    <script src="dmxAppConnect/dmxNotifications/dmxNotifications.js" defer=""></script>
    <script src="dmxAppConnect/dmxBootstrap5Modal/dmxBootstrap5Modal.js" defer=""></script>
    <script src="dmxAppConnect/dmxStateManagement/dmxStateManagement.js" defer=""></script>
    <script src="dmxAppConnect/dmxBrowser/dmxBrowser.js" defer=""></script>
    <link rel="stylesheet" href="css/bootstrap-icons.css" />
    <link rel="stylesheet" href="fontawesome5/css/all.min.css" />
    <script src="dmxAppConnect/dmxFormatter/dmxFormatter.js" defer=""></script>
    <link rel="stylesheet" href="dmxAppConnect/dmxAnimateCSS/animate.min.css" />
    <script src="dmxAppConnect/dmxAnimateCSS/dmxAnimateCSS.js" defer></script>

</head>

<body id="brands" is="dmx-app" dmx-on:load="login_session.removeAll();local1.removeAll()" dmx-on:ready="login_session.removeAll();local1.removeAll()">
    <dmx-local-manager id="local1"></dmx-local-manager>

    <dmx-value id="lang" dmx-bind:value="browser1.language"></dmx-value>
    <dmx-json-datasource id="trans" is="dmx-serverconnect" url="assets/translation/translation.JSON"></dmx-json-datasource>

    <dmx-session-manager id="login_session"></dmx-session-manager>
    <dmx-serverconnect id="serverconnectListUsers" url="dmxConnect/api/servo_users/list_users.php" noload></dmx-serverconnect>
    <div is="dmx-browser" id="browser1"></div>
    <dmx-notifications id="notifies1"></dmx-notifications>
    <main class="mt-4">
        <div class="container mt-auto">




            <div class="row servo-page-header" dmx-animate-inview="pulse">
                <div class="col d-flex justify-content-center flex-wrap">
                    <h2 class="servo-page-heading fw-lighter">{{trans.data.login[lang.value]}}</h2>
                </div>
            </div>
            <div class="row">
                <div class="col"></div>

                <div class="col d-flex justify-content-center flex-wrap mt-3 ms-5 me-5 pt-4 pb-4 ps-4 pe-4 bg-secondary rounded" dmx-animate-inview.delay:200="pulse">
                    <div class="d-block">
                        <form id="servo_login_form" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_users/login.php" dmx-on:success="run([{run:{action:`servo_login_form.reset()`}},{run:{action:`notifies1.success(\'Success\')`}},{run:{action:`login_session.removeAll()`}},{run:{action:`login_session.set(\'current_user\',servo_login_form.data.query_get_user_role[0].user_username)`}},{run:{action:`login_session.set(\'user_profile\',servo_login_form.data.query_get_user_role[0].user_profile)`}},{run:{action:`login_session.set(\'user_id\',servo_login_form.data.query_get_user_role[0].user_id)`}},{run:{action:`login_session.set(\'user_department\',servo_login_form.data.query_get_user_role[0].department_name)`}},{run:{action:`login_session.set(\'user_department_id\',servo_login_form.data.query_get_user_role[0].servo_user_departments_department_id)`}},{condition:{if:`(servo_login_form.data.query_get_user_role[0].user_profile==\'cc-pm\'||\'cc-gu\'||\'cc-pm\'||\'cc-admin\')`,then:{steps:{run:{action:`browser1.goto(servo_login_form.data.query_get_user_role[0].user_profile+\'.php\')`}}}}}])" dmx-on:error="servo_login_form.reset();notifies1.danger('Error')" dmx-on:unauthorized="servo_login_form.reset();browser1.alert('UNAUTHORISED')">

                            <input id="username" name="user_username" type="text" class="form-control mt-2" placeholder="Enter Username">
                            <input id="password" name="password" type="password" class="form-control mt-2 mb-2" placeholder="Enter Password">
                            <button id="btn2" class="btn btn-info text-white" type="submit" dmx-on:click="username.setValue(username.value.lowercase())">
                                <i class="fas fa-sign-in-alt fa-lg"></i>
                            </button>
                        </form>
                    </div>


                </div>
                <div class="col"></div>

            </div>
        </div>
    </main>
    <script src="bootstrap/5/js/bootstrap.bundle.min.js"></script>
</body>

</html>