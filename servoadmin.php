<!doctype html>
<html>

<head>
    <script src="dmxAppConnect/dmxAppConnect.js"></script>
    <meta name="ac:base" content="/servo">
    <base href="/servo/">
    <meta charset="UTF-8">
    <title>SERVO</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/style.css" />
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js" integrity="sha256-CutOzxCRucUsn6C6TcEYsauvvYilEniTXldPa6/wu0k=" crossorigin="anonymous"></script>
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
    <link rel="stylesheet" href="dmxAppConnect/dmxDatePicker/daterangepicker.min.css" />
    <script src="dmxAppConnect/dmxDatePicker/daterangepicker.min.js" defer=""></script>
    <link rel="stylesheet" href="dmxAppConnect/dmxDatePicker/dmxDatePicker.css" />
    <script src="dmxAppConnect/dmxDatePicker/dmxDatePicker.js" defer=""></script>


    <script src="dmxAppConnect/dmxFormatter/dmxFormatter.js" defer=""></script>
    <link rel="stylesheet" href="dmxAppConnect/dmxDatePicker/bgthemes/dark-calendar.css" />


    <script src="dmxAppConnect/dmxBootstrap5Tooltips/dmxBootstrap5Tooltips.js" defer=""></script>
<link rel="stylesheet" href="dmxAppConnect/dmxAnimateCSS/animate.min.css" />
<script src="dmxAppConnect/dmxAnimateCSS/dmxAnimateCSS.js" defer=""></script>
<script src="dmxAppConnect/dmxMasonry/dmxMasonry.js" defer=""></script>
<script src="dmxAppConnect/dmxBootstrap5Collapse/dmxBootstrap5Collapse.js" defer=""></script>
<script src="dmxAppConnect/dmxBootstrap5Offcanvas/dmxBootstrap5Offcanvas.js" defer=""></script>
</head>

<body is="dmx-app" id="departments">

    <dmx-notifications id="notifies1" timeout="100" position="bottom" extended-timeout="200"></dmx-notifications>
    <?php include 'header.php'; ?>
    <main><div class="container mt-auto">




            <div class="row servo-page-header">
                <div class="col">
<ul class="nav nav-tabs" id="navTabs1_tabs" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="navTabs1_1_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_1" role="tab" aria-controls="navTabs1_1" aria-selected="true">Create Admin</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="navTabs1_2_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_2" role="tab" aria-controls="navTabs1_2" aria-selected="false">Create Branch</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="navTabs1_3_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_3" role="tab" aria-controls="navTabs1_3" aria-selected="false">Create Shift</a>
  </li>
</ul>
<div class="tab-content" id="navTabs1_content">
  <div class="tab-pane fade show active mt-3" id="navTabs1_1" role="tabpanel">
  <form is="dmx-serverconnect-form" id="serverconnectform1" method="post" action="dmxConnect/api/servo_users/create_user.php" dmx-generator="bootstrap5" dmx-form-type="horizontal">
<div class="mb-3 row">
  <label for="inp_user_fname" class="col-sm-2 col-form-label">User fname</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" id="inp_user_fname" name="user_fname" aria-describedby="inp_user_fname_help" placeholder="Enter User fname">
  </div>
</div>
<div class="mb-3 row">
  <label for="inp_user_lname" class="col-sm-2 col-form-label">User lname</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" id="inp_user_lname" name="user_lname" aria-describedby="inp_user_lname_help" placeholder="Enter User lname">
  </div>
</div>
<div class="mb-3 row">
  <label for="inp_user_username" class="col-sm-2 col-form-label">User username</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" id="inp_user_username" name="user_username" aria-describedby="inp_user_username_help" placeholder="Enter User username">
  </div>
</div>
<div class="mb-3 row">
  <label for="inp_password" class="col-sm-2 col-form-label">Password</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" id="inp_password" name="password" aria-describedby="inp_password_help" placeholder="Enter Password">
  </div>
</div>
<div class="mb-3 row">
  <label for="inp_servo_user_departments_department_id" class="col-sm-2 col-form-label">Servo user departments department</label>
  <div class="col-sm-10">
    <input type="number" class="form-control" id="inp_servo_user_departments_department_id" name="servo_user_departments_department_id" aria-describedby="inp_servo_user_departments_department_id_help" placeholder="Enter Servo user departments department">
  </div>
</div>
<div class="mb-3 row">
  <label for="inp_user_profile" class="col-sm-2 col-form-label">User profile</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" id="inp_user_profile" name="user_profile" aria-describedby="inp_user_profile_help" placeholder="Enter User profile">
  </div>
</div>
<div class="mb-3 row">
  <div class="col-sm-2">&nbsp;</div>
  <div class="col-sm-10">
    <button type="submit" class="btn btn-primary">Save</button>
  </div>
</div>
</form></div>
  <div class="tab-pane fade" id="navTabs1_2" role="tabpanel">
  <form is="dmx-serverconnect-form" id="serverconnectform2" method="post" action="dmxConnect/api/servo_branches/create_branch.php" dmx-generator="bootstrap5" dmx-form-type="horizontal">
<div class="mb-3 row">
  <label for="inp_branch_name" class="col-sm-2 col-form-label">Branch name</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" id="inp_branch_name" name="branch_name" aria-describedby="inp_branch_name_help" placeholder="Enter Branch name">
  </div>
</div>
<div class="mb-3 row">
  <label for="inp_branch_date_registered" class="col-sm-2 col-form-label">Branch date registered</label>
  <div class="col-sm-10">
    <input type="date" class="form-control" id="inp_branch_date_registered" name="branch_date_registered" aria-describedby="inp_branch_date_registered_help" placeholder="Enter Branch date registered">
  </div>
</div>
<div class="mb-3 row">
  <div class="col-sm-2">&nbsp;</div>
  <div class="col-sm-10">
    <button type="submit" class="btn btn-primary">Save</button>
  </div>
</div>
</form></div>
  <div class="tab-pane fade" id="navTabs1_3" role="tabpanel">
<form is="dmx-serverconnect-form" id="serverconnectform3" method="post" action="dmxConnect/api/servo_shifts/create_shift.php" dmx-generator="bootstrap5" dmx-form-type="horizontal">
<div class="mb-3 row">
  <label for="inp_shift_start" class="col-sm-2 col-form-label">Shift start</label>
  <div class="col-sm-10">
    <input type="date" class="form-control" id="inp_shift_start" name="shift_start" aria-describedby="inp_shift_start_help" placeholder="Enter Shift start">
  </div>
</div>
<div class="mb-3 row">
  <label for="inp_shift_stop" class="col-sm-2 col-form-label">Shift stop</label>
  <div class="col-sm-10">
    <input type="date" class="form-control" id="inp_shift_stop" name="shift_stop" aria-describedby="inp_shift_stop_help" placeholder="Enter Shift stop">
  </div>
</div>
<div class="mb-3 row">
  <label for="inp_servo_branches_branch_id" class="col-sm-2 col-form-label">Servo branches branch</label>
  <div class="col-sm-10">
    <input type="number" class="form-control" id="inp_servo_branches_branch_id" name="servo_branches_branch_id" aria-describedby="inp_servo_branches_branch_id_help" placeholder="Enter Servo branches branch">
  </div>
</div>
<div class="mb-3 row">
  <legend class="col-sm-2 col-form-label">Shift status</legend>
  <div class="col-sm-10">
<select id="select1" class="form-select" dmx-bind:value="'Active'" name="shift_status">
</select>
  </div>
</div>
<div class="mb-3 row">
  <div class="col-sm-2">&nbsp;</div>
  <div class="col-sm-10">
    <button type="submit" class="btn btn-primary">Save</button>
  </div>
</div>
</form>


  </div>
</div>
                </div>
            </div>
        </div></main><script src="bootstrap/5/js/bootstrap.bundle.min.js"></script>
</body>

</html>