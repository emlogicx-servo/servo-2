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
    <script src="dmxAppConnect/dmxFormatter/dmxFormatter.js" defer=""></script>
    <script src="dmxAppConnect/dmxRouting/dmxRouting.js" defer></script>
    <link rel="stylesheet" href="fontawesome5/css/all.min.css" />
</head>

<body id="brands" is="dmx-app" dmx-on:ready="">
    <dmx-session-manager id="session_variables"></dmx-session-manager>
    <dmx-datetime id="var1"></dmx-datetime>
    <dmx-serverconnect id="load_active_user_shift" url="dmxConnect/api/servo_user_shifts/load_active_user_shift.php" dmx-param:user_id="login_session.data.user_id"></dmx-serverconnect>
    <dmx-serverconnect id="load_user_shift_info" url="dmxConnect/api/servo_user_shifts/list_user_shift_info.php" dmx-param:user_id="login_session.data.user_id" dmx-param:shift_id="tableRepeat1[0].user_shift_checkin_form.user_shift_id.value"></dmx-serverconnect>
    <dmx-session-manager id="login_session"></dmx-session-manager>
    <dmx-serverconnect id="serverconnectListUsers" url="dmxConnect/api/servo_users/list_users.php"></dmx-serverconnect>
    <div is="dmx-browser" id="browser1">
    </div>
    <dmx-notifications id="notifies1"></dmx-notifications>
    <main class="mt-4">
        <div class="container mt-auto">




            <div class="row servo-page-header">

                <div class="col d-flex justify-content-center flex-wrap">
                    <h3 class="servo-page-heading fw-lighter text-body">Welcome {{login_session.data.current_user}}</h3>
                    <button id="btn1" class="btn ms-2 btn-success text-white" dmx-on:click="browser1.goto(login_session.data.user_profile+'.php?department='+login_session.data.user_department_id)" dmx-hide="((session_variables.data.user_profile) !=='Admin')&amp;&amp;((session_variables.data.user_profile) !=='Manager')">
                        <i class="fas fa-forward fa-2x"></i>
                    </button>
                </div>
            </div>
            <div class="row servo-page-header">
                <div class="col d-flex justify-content-center flex-wrap">
                    <h3 class="servo-page-heading fw-lighter text-success">Today is: {{var1.datetime}}&nbsp;</h3>
                </div>
            </div>
            <div class="row servo-page-header">
                <div class="col d-flex justify-content-center flex-wrap">
                    <h1 class="servo-page-heading fw-lighter">Select your shift</h1>
                </div>
            </div>
            <div class="row">
                <div class="col d-flex flex-wrap flex-row justify-content-center">
                    <div class="d-block">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Shift #</th>
                                        <th>Start</th>
                                        <th>Stop</th>
                                        <th>Notes</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="load_active_user_shift.data.query_load_active_user_shift" id="tableRepeat1">
                                    <tr>
                                        <td dmx-text="user_shift_id"></td>
                                        <td dmx-text="shift_start"></td>
                                        <td dmx-text="shift_stop"></td>
                                        <td dmx-text="user_shift_notes"></td>
                                        <td dmx-text="shift_status"></td>
                                        <td>
                                            <form id="user_shift_checkin_form" is="dmx-serverconnect-form" method="post" action="dmxConnect/api/servo_user_shifts/update_user_shift.php" dmx-on:success="notifies1.success('CONFIRMATION');login_session.remove('current_shift');login_session.set('current_shift',user_shift_id.value);browser1.goto(login_session.data.user_profile+'.php?department='+login_session.data.user_department_id)">
                                                <input id="user_shift_id" name="user_shift_id" type="number" class="form-control visually-hidden" dmx-bind:value="servo_shifts_shift_id" style="display: hidden;">
                                                <input id="time_checkin" name="time_checkin" type="datetime-local" class="form-control visually-hidden" dmx-bind:value="var1.datetime">
                                                <button id="btn2" class="btn text-success" data-bs-target="#productInfo" type="submit"><i class="fas fa-check fa-2x"><br></i></button>
                                            </form>

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </main>
    <script src="bootstrap/5/js/bootstrap.bundle.min.js"></script>
</body>

</html>