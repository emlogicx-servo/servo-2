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
<script src="dmxAppConnect/dmxDataTraversal/dmxDataTraversal.js" defer=""></script>
<link rel="stylesheet" href="dmxAppConnect/dmxValidator/dmxValidator.css" />
<script src="dmxAppConnect/dmxValidator/dmxValidator.js" defer=""></script>
<link rel="stylesheet" href="fontawesome5/css/all.min.css" />
</head>

<body is="dmx-app" id="departments">

<dmx-value id="lang" dmx-bind:value="browser1.language"></dmx-value>
<dmx-json-datasource id="trans" is="dmx-serverconnect" url="assets/translation/translation.JSON"></dmx-json-datasource>

<dmx-serverconnect id="list_user_shifts" url="dmxConnect/api/servo_user_shifts/list_user_shifts.php" dmx-param:shift_id="read_shift.data.query_read_shift.shift_id"></dmx-serverconnect>
<dmx-serverconnect id="list_users" url="dmxConnect/api/servo_users/list_users.php" dmx-param:existing_user_id="list_user_shifts.data.query_list_user_shift[0].user_id"></dmx-serverconnect>
<dmx-serverconnect id="list_users_select_shift" url="dmxConnect/api/servo_users/list_users_shift_select.php" dmx-param:existing_user_id="" dmx-param:existing_users="list_user_shifts.data.query_list_user_shift.values(`user_id`)"></dmx-serverconnect>
<dmx-scheduler id="scheduler1" dmx-on:tick=""></dmx-scheduler>
<dmx-serverconnect id="list_shifts" url="dmxConnect/api/servo_shifts/list_shifts.php"></dmx-serverconnect>
<dmx-serverconnect id="load_branches" url="dmxConnect/api/servo_refered_fields_loading/load_branches.php"></dmx-serverconnect>
<dmx-serverconnect id="total_sales_per_waiter" url="dmxConnect/api/servo_data/total_sales_per_waiter.php" dmx-param:user_id="session_variables.data.user_id"></dmx-serverconnect>
<dmx-session-manager id="session_variables"></dmx-session-manager>

    <dmx-serverconnect id="read_shift" url="dmxConnect/api/servo_shifts/read_shift.php" dmx-param:id="id" noload dmx-param:item_id="" dmx-param:branch_id="read_item_branch.data.queryReadBranch.branch_id" dmx-param:department_id="" dmx-param:order_id="tableRepeat2[0].order_id" dmx-param:shift_id="list_shifts.data.query_list_shifts[0].shift_id"></dmx-serverconnect>
    <dmx-serverconnect id="shifts_table" url="dmxConnect/api/servo_shifts/list_shifts.php" dmx-param:user_id="session_variables.data.user_id"></dmx-serverconnect>
    <div is="dmx-browser" id="browser1"></div>
    <dmx-notifications id="notifies1" timeout="10" position="bottom" extended-timeout="10" closable="true" offset-x="" offset-y=""></dmx-notifications>
    <?php include 'header.php'; ?>
    <main class="mt-4">

        <div class="modal create-modal" id="createItemModal" is="dmx-bs5-modal" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{trans.data.createShift[lang.value]}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <form is="dmx-serverconnect-form" id="serverconnectCreateShift" method="post" action="dmxConnect/api/servo_shifts/create_shift.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-on:success="notifies1.success('Success');list_shifts.load();serverconnectCreateShift.reset();createItemModal.hide()">
<div class="mb-3 row">
  <label for="inp_shift_start" class="col-sm-2 col-form-label">{{trans.data.start[lang.value]}}</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" id="inp_shift_start" name="shift_start" aria-describedby="inp_shift_start_help" placeholder="Enter Shift Start" is="dmx-date-picker" timepicker="" use24hours="true">
  </div>
</div>
<div class="mb-3 row">
  <label for="inp_shift_stop" class="col-sm-2 col-form-label">{{trans.data.stop[lang.value]}}</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" id="inp_shift_stop" name="shift_stop" aria-describedby="inp_shift_stop_help" placeholder="Enter Shift Stop" is="dmx-date-picker" timepicker="" use24hours="true">
  </div>
</div>
<div class="mb-3 row">
  <label for="inp_servo_branches_branch_id" class="col-sm-2 col-form-label">{{trans.data.branch[lang.value]}}</label>
  <div class="col-sm-10">
<select id="select1" class="form-select" dmx-bind:options="load_branches.data.query" optiontext="branch_name" optionvalue="branch_id" name="servo_branches_branch_id">
</select>
  </div>
</div>
<div class="mb-3 row">
  <legend class="col-sm-2 col-form-label">{{trans.data.status[lang.value]}}</legend>
  <div class="col-sm-10">
<select id="shift_status" class="form-select" name="shift_status">
<option value="Active">Active</option><option value="Pending">Pending</option><option value="Closed">Closed</option></select>
  </div>
</div>
<div class="mb-3 row">
  <div class="col-sm-2">&nbsp;</div>
  <div class="col-sm-10">
    <button type="submit" class="btn btn-primary">{{trans.data.ok[lang.value]}}</button>
  </div>
</div>
</form>
                        </div>

                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal readitem" id="readItemModal" is="dmx-bs5-modal" tabindex="-1" dmx-on:hidden-bs-modal="session_variables.remove('current_shift')">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
<div class="d-block"><h2 class="fw-bold text-warning">{{trans.data.shift[lang.value]}}</h2></div>





                        
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
<div class="row">
<div class="col d-flex"><div class="d-block">
<h3>{{trans.data.shift[lang.value]}}:&nbsp;</h3>
</div><div class="d-block">
<h3 class="text-success">{{read_shift.data.query_read_shift.shift_id}}&nbsp;</h3>
</div><div class="d-block">
<h3>{{trans.data.total[lang.value]}}:&nbsp;</h3>
</div><div class="d-block text-danger">
<h3>{{list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`)}}</h3>
</div>
<div class="text-danger float-right">

</div></div><main>
<div class="container">
<ul class="nav nav-tabs" id="navTabs1_tabs" role="tablist">
  <li class="nav-item">
    <a class="nav-link active style25" id="navTabs1_1_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_1" role="tab" aria-controls="navTabs1_1" aria-selected="true">{{trans.data.shifts[lang.value]}}</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="navTabs1_2_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_2" role="tab" aria-controls="navTabs1_2" aria-selected="false">{{trans.data.staff[lang.value]}}</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="navTabs1_3_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_3" role="tab" aria-controls="navTabs1_3" aria-selected="false">{{trans.data.info[lang.value]}}</a>
  </li>
</ul>
<div class="tab-content" id="navTabs1_content">
  <div class="tab-pane fade show active" id="navTabs1_1" role="tabpanel">
  <div class="row mt-3">
                            <div class="col">
                                <div class="table-responsive">
<table class="table" id="user_shift_table">
  <thead>
    <tr>
      <th>#</th>
      <th>{{trans.data.name[lang.value]}}</th>
      <th>{{trans.data.surname[lang.value]}}</th>
      <th>{{trans.data.user[lang.value]}}</th>
      <th>{{trans.data.checkin[lang.value]}}</th>
      <th>{{trans.data.checkout[lang.value]}}</th>
      <th>{{trans.data.shift[lang.value]}}</th>
      <th>{{trans.data.note[lang.value]}}</th>
<th></th>
    </tr>
  </thead>
  <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_user_shifts.data.query_list_user_shift" id="tableRepeat4">
    <tr>
      <td dmx-text="user_shift_id"></td>
      <td dmx-text="user_fname"></td>
      <td dmx-text="user_lname"></td>
      <td dmx-text="user_id"></td>
      <td dmx-text="time_checkin"></td>
      <td dmx-text="time_checkout"></td>
      <td dmx-text="servo_shifts_shift_id"></td>
      <td dmx-text="user_shift_notes"></td>
<td>
<form id="deleteUserShift" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_user_shifts/delete_user_shift.php" dmx-on:success="notifies1.success('Success!');list_user_shifts.load()">
<input id="userShiftId" name="user_shift_id" type="text" class="form-control visually-hidden" dmx-bind:value="user_shift_id">
<button id="btn3" class="btn text-danger" type="submit"><i class="far fa-trash-alt fa-lg"></i>
</button></form>

</td>
    </tr>
  </tbody>
</table>
</div>
                            </div>

                        </div></div>
  <div class="tab-pane fade" id="navTabs1_2" role="tabpanel">
  <div class="container mt-3">
<div class="row row-cols-7 justify-content-center align-items-stretch">
<div class="w-auto flex-xl-row flex-xxl-row flex-xxl-wrap flex-sm-row flex-sm-wrap flex-md-wrap flex-md-row col-md mb-md-0 col-sm ms-0 flex-lg-row justify-content-sm-around justify-content-md-around justify-content-lg-around justify-content-xl-center flex-xl-wrap col d-flex">
<div dmx-repeat:repeat1="list_users_select_shift.data.query_list_users_shift_select"><main>
<form id="add_user_to_shift" is="dmx-serverconnect-form" method="post" action="dmxConnect/api/servo_user_shifts/create_user_shift.php" dmx-on:success="btn11.disable();notifies1.success('Success');list_user_shifts.load();list_users_select_shift.load({})" dmx-on:error="notifies1.danger('Error - Repeat Entry')">
<input id="forrm_user_id" name="servo_user_user_id" type="text" class="form-control visually-hidden" dmx-bind:value="user_id">
<input id="form_shift_id" name="servo_shifts_shift_id" type="number" class="form-control visually-hidden" dmx-bind:value="read_shift.data.query_read_shift.shift_id">
<input id="form_user_shift_code" name="user_shift_code" class="form-control visually-hidden" dmx-bind:value="read_shift.data.query_read_shift.shift_id+'@'+user_id">


<div class="row me-3" dmx-hide="(tableRepeat4[0].servo_user_user_id == user_id)">
<div class="col">
<div class="row">
<div class="col d-flex justify-content-center"><button id="btn11" class="btn btn-warning ms-1 me-1 pt-3 pb-3 ps-3 pe-3" dmx-bind:name="" type="submit">
<i class="fas fa-plus"></i>
</button></div>
</div>
<div class="row">
<div class="col d-flex flex-row justify-content-center"><h4 dmx-text="user_fname+' '">{{user_fname+' '+user_lname}}</h4></div>
</div></div>
</div>

</form>
</main>
</div>


<div class="flex-md-wrap flex-md-row justify-content-md-center rounded align-content-center bg-secondary mt-2 mb-2 ms-1 me-1 pt-3 pb-3 ps-3 pe-3 col-12 col-sm-5 offset-md-1 col-md-5 col-lg-5 col-xxl-3" dmx-repeat:products="load_products.data.query_list_products">
<h3 class="text-center text-warning">{{product_name}}</h3>
<h4 class="text-center">{{product_price}}</h4>
<form id="add_products_to_order_form" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_user_shifts/create_user_shift.php" dmx-on:success="form3.reset();list_users.load();notifies1.success('Success:'+product_name+' Added to Order')"><p><label for="forrm_user_id">User:</label><input id="user_id" name="user_id" type="number" value=""></p>
<p><label for="time_checkin">Time checkin:</label><input id="time_checkin" name="time_checkin" type="datetime" value=""></p>
<p><label for="time_checkout">Time checkout:</label><input id="time_checkout" name="time_checkout" type="datetime" value=""></p>
<p><label for="balance_checkin">Balance checkin:</label><input id="balance_checkin" name="balance_checkin" type="number" value=""></p>
<p><label for="balance_checkout">Balance checkout:</label><input id="balance_checkout" name="balance_checkout" type="number" value=""></p>
<p><label for="servo_user_user_id">Servo user user:</label><input id="servo_user_user_id" name="servo_user_user_id" type="number" value=""></p>
<p><label for="servo_shifts_shift_id">Servo shifts shift:</label><input id="servo_shifts_shift_id" name="servo_shifts_shift_id" type="number" value=""></p>
<p><label for="user_shift_notes">User shift notes:</label><input id="user_shift_notes" name="user_shift_notes" type="text" value=""></p></form>
</div></div>

</div>
</div></div>
  <div class="tab-pane fade" id="navTabs1_3" role="tabpanel">
  <div class="row mt-3">
<form is="dmx-serverconnect-form" id="updateShift" method="post" action="dmxConnect/api/servo_shifts/update_shift.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="read_shift.data.query_read_shift" dmx-on:success="list_shifts.load({});notifies1.success('Sucess');readItemModal.hide()">
<div class="mb-3 row">
  <label for="inp_shift_id" class="col-sm-2 col-form-label">Shift</label>
  <div class="col-sm-10">
    <input type="number" class="form-control" id="inp_shift_id" name="shift_id" dmx-bind:value="read_shift.data.query_read_shift.shift_id" aria-describedby="inp_shift_id_help" placeholder="Enter Shift" readonly="true">
  </div>
</div>
<div class="mb-3 row">
  <label for="inp_shift_start" class="col-sm-2 col-form-label">Shift Start</label>
  <div class="col-sm-10">
    <input class="form-control" id="inp_shift_start" name="shift_start" dmx-bind:value="read_shift.data.query_read_shift.shift_start" aria-describedby="inp_shift_start_help" placeholder="Enter Shift Start" type="text" is="dmx-date-picker" timepicker="" use24hours="true">
  </div>
</div>
<div class="mb-3 row">
  <label for="inp_shift_stop" class="col-sm-2 col-form-label">Shift Stop</label>
  <div class="col-sm-10">
    <input class="form-control" id="inp_shift_stop" name="shift_stop" dmx-bind:value="read_shift.data.query_read_shift.shift_stop" aria-describedby="inp_shift_stop_help" placeholder="Enter Shift Stop" type="text" is="dmx-date-picker" timepicker="" use24hours="true">
  </div>
</div>
<div class="mb-3 row">
    <label for="inp_servo_branches_branch_id" class="col-sm-2 col-form-label">Branch</label>
    <div class="col-sm-10">
        <select id="select1" class="form-select" dmx-bind:options="load_branches.data.query" optiontext="branch_name" optionvalue="branch_id" name="servo_branches_branch_id" dmx-bind:value="read_shift.data.query_read_shift.servo_branches_branch_id">
        </select>
    </div>
</div>
<div class="mb-3 row">
    <legend class="col-sm-2 col-form-label">Status</legend>
    <div class="col-sm-10">
        <select id="shift_status" class="form-select" name="shift_status" dmx-bind:value="read_shift.data.query_read_shift.shift_status">
            <option value="Active">Active</option>
            <option value="Pending">Pending</option>
            <option value="Closed">Closed</option>
        </select>
    </div>
</div>
<div class="mb-3 row">
  <div class="col-sm-2">&nbsp;</div>
  <div class="col-sm-10">
    <button type="submit" class="btn btn-primary" dmx-bind:value="read_shift.data.query_read_shift.Save">Save</button>
  </div>
</div>
</form>
                        </div></div>
</div>
</div>
</main>

</div>
                        
                        
                        


                    </div>
                    <div class="modal-footer">
                        <form id="form1" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_orders/delete_order_and_items.php" dmx-on:success="notifies1.success('Success');list_orders.load();readItemModal.hide()" onsubmit=" return confirm('CONFIRM DELETE?');">
                            <input id="text1" name="order_id" type="hidden" class="form-control" dmx-bind:value="read_item_order.data.query.order_id">

                            <button id="btn6" class="btn text-danger" type="submit">
                                <i class="far fa-trash-alt fa-lg"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        

    </main>
    <main><div class="container mt-auto">




            <div class="row servo-page-header">
                <div class="col">
                    <h5 class="servo-page-heading fw-lighter">{{trans.data.shifts[lang.value]}}</h5>
                </div>
                <div class="col style13 page-button d-flex justify-content-sm-end justify-content-end" id="pagebuttons">
                    
                <button id="btn1" class="btn style12 fw-light" data-bs-toggle="modal" data-bs-target="#createItemModal" style="float: right;"><i class="fas fa-plus fa-2x style14"></i></button></div>
            </div>
            <div class="row">
                <div class="col">


                    <div class="table-responsive">
<table class="table table-hover table-sm table-borderless">
  <thead>
    <tr>
      <th>#</th>
      <th>{{trans.data.start[lang.value]}}</th>
      <th>{{trans.data.stop[lang.value]}}</th>
      <th>{{trans.data.branch[lang.value]}}</th>
      <th>{{trans.data.status[lang.value]}}</th>
<th></th>
    </tr>
  </thead>
  <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_shifts.data.query_list_shifts" id="tableRepeat5">
    <tr>
      <td dmx-text="shift_id"></td>
      <td dmx-text="shift_start"></td>
      <td dmx-text="shift_stop"></td>
      <td dmx-text="servo_branches_branch_id"></td>
      <td dmx-text="shift_status" dmx-hide=""></td>
    <td class="text-center">
        <button id="btn2" class="btn text-success" data-bs-target="#productInfo" dmx-on:click="readItemModal.show();read_shift.load({shift_id: shift_id});session_variables.set('current_shift',read_shift.data.query_read_shift.shift_id)" dmx-bind:value="list_shifts.data.query_list_shifts[0].shift_id"><i class="far fa-eye fa-lg"><br></i></button>
    </td>
<td dmx-text=""></td>
    </tr>
  </tbody>
</table>
</div>
                </div>
            </div>
        </div></main><script src="bootstrap/5/js/bootstrap.bundle.min.js"></script>
</body>

</html>