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
    <script src="dmxAppConnect/dmxBootstrap5PagingGenerator/dmxBootstrap5PagingGenerator.js" defer=""></script>

    <link rel="stylesheet" href="bootstrap/5/css/bootstrap.min.css" />
</head>

<body is="dmx-app" id="departments">
    <dmx-query-manager id="listShifts"></dmx-query-manager>
    <dmx-serverconnect id="list_services" url="dmxConnect/api/servo_services/list_services.php"></dmx-serverconnect>
    <dmx-serverconnect id="get_user_info" url="dmxConnect/api/servo_users/get_user_info.php" dmx-param:user_id="" noload></dmx-serverconnect>
    <dmx-serverconnect id="list_sales_points" url="dmxConnect/api/servo_sales_points/list_sales_points.php"></dmx-serverconnect>

    <dmx-value id="lang" dmx-bind:value="browser1.language"></dmx-value>
    <dmx-json-datasource id="trans" is="dmx-serverconnect" url="assets/translation/translation.JSON"></dmx-json-datasource>

    <dmx-serverconnect id="list_user_shifts" url="dmxConnect/api/servo_user_shifts/list_user_shifts.php" dmx-param:shift_id="session_variables.data.current_shift_edit"></dmx-serverconnect>
    <dmx-serverconnect id="list_users" url="dmxConnect/api/servo_users/list_users.php" dmx-param:existing_user_id="list_user_shifts.data.query_list_user_shift[0].user_id"></dmx-serverconnect>
    <dmx-serverconnect id="list_users_sorted_for_shift" url="dmxConnect/api/servo_users/list_users_sorted_for_shift.php" dmx-param:existing_user_id="list_user_shifts.data.query_list_user_shift[0].user_id" dmx-param:shift_id="session_variables.data.current_shift_edit"></dmx-serverconnect>
    <dmx-serverconnect id="list_users_assigned" url="dmxConnect/api/servo_users/list_users.php" dmx-param:assignment_shift="session_variables.data.current_shift"></dmx-serverconnect>
    <dmx-serverconnect id="list_departments" url="dmxConnect/api/servo_departments/list_departments.php" dmx-param:existing_user_id="list_user_shifts.data.query_list_user_shift[0].user_id"></dmx-serverconnect>
    <dmx-serverconnect id="list_users_select_shift" url="dmxConnect/api/servo_users/list_users_shift_select.php" dmx-param:existing_user_id="" dmx-param:existing_users="list_user_shifts.data.query_list_user_shift.values(`user_id`)"></dmx-serverconnect>
    <dmx-scheduler id="scheduler1" dmx-on:tick=""></dmx-scheduler>
    <dmx-serverconnect id="list_shifts_paged" url="dmxConnect/api/servo_shifts/list_shifts_paged.php" dmx-param:offset="listShifts.data.offset" dmx-param:limit="shift_sort_limit.value" dmx-param:shiftfilter="shiftfilter.value"></dmx-serverconnect>
    <dmx-serverconnect id="load_branches" url="dmxConnect/api/servo_refered_fields_loading/load_branches.php"></dmx-serverconnect>
    <dmx-serverconnect id="total_sales_per_waiter" url="dmxConnect/api/servo_data/total_sales_per_waiter.php" dmx-param:user_id="session_variables.data.user_id"></dmx-serverconnect>
    <dmx-session-manager id="session_variables"></dmx-session-manager>

    <dmx-serverconnect id="read_shift" url="dmxConnect/api/servo_shifts/read_shift.php" dmx-param:id="id" noload dmx-param:item_id="" dmx-param:branch_id="read_item_branch.data.queryReadBranch.branch_id" dmx-param:department_id="" dmx-param:order_id="tableRepeat2[0].order_id" dmx-param:shift_id="list_shifts.data.query_list_shifts[0].shift_id"></dmx-serverconnect>
    <dmx-serverconnect id="shifts_table" url="dmxConnect/api/servo_shifts/list_shifts.php" dmx-param:user_id="session_variables.data.user_id" noload></dmx-serverconnect>
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
                            <form is="dmx-serverconnect-form" id="serverconnectCreateShift" method="post" action="dmxConnect/api/servo_shifts/create_shift.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-on:success="notifies1.success('Success');serverconnectCreateShift.reset();createItemModal.hide();list_shifts_paged.load()">
                                <div class="mb-3 row">
                                    <label for="inp_shift_start13" class="col-sm-2 col-form-label">{{trans.data.start[lang.value]}}</label>
                                    <div class="col-sm-10">
                                        <input type="datetime-local" class="form-control" id="inp_shift_start" name="shift_start" aria-describedby="inp_shift_start_help" placeholder="Enter Shift Start" required="" data-msg-required="!" dmx-bind:min="dateTime.datetime">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inp_shift_stop14" class="col-sm-2 col-form-label">{{trans.data.stop[lang.value]}}</label>
                                    <div class="col-sm-10">
                                        <input type="datetime-local" class="form-control" id="inp_shift_stop" name="shift_stop" aria-describedby="inp_shift_stop_help" required="" data-msg-required="!" dmx-bind:min="inp_shift_start.value">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <legend class="col-sm-2 col-form-label visually-hidden">{{trans.data.status[lang.value]}}</legend>
                                    <div class="col-sm-10 visually-hidden">
                                        <select id="shift_status" class="form-select" name="shift_status">
                                            <option value="Active">Active</option>
                                            <option selected="" value="Pending">Pending</option>
                                            <option value="Closed">Closed</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
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
        <div class="modal readitem" id="readItemModal" is="dmx-bs5-modal" tabindex="-1">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">






                        <div class="d-block d-flex">

                            <h5 class="rounded pt-2 pb-2 ps-3 pe-3 text-white" dmx-class:bg-success="read_shift.data.query_read_shift.shift_status=='Active'" dmx-class:bg-danger="read_shift.data.query_read_shift.shift_status=='Closed'" dmx-class:bg-warning="read_shift.data.query_read_shift.shift_status=='Pending'"><i class="fas fa-hourglass-half fa-sm" style="margin-right: 3px"></i>{{trans.data.shift[lang.value]}}: {{read_shift.data.query_read_shift.shift_id}}</h5>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col d-flex">


                                <div class="text-danger float-right">

                                </div>
                            </div>
                            <main>
                                <div class="container">
                                    <ul class="nav nav-tabs nav-fill" id="navTabs1_tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active style25" id="navTabs1_1_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_1" role="tab" aria-controls="navTabs1_1" aria-selected="true"><i class="fas fa-users" style="margin-right: 5px;"></i>

                                                {{trans.data.activeStaff[lang.value]}}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="navTabs1_2_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_2" role="tab" aria-controls="navTabs1_2" aria-selected="false"><i class="fas fa-users-slash" style="margin-right: 5px;"></i>{{trans.data.inactiveStaff[lang.value]}}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="navTabs1_3_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_3" role="tab" aria-controls="navTabs1_3" aria-selected="false"><i class="fas fa-info" style="margin-right: 5px;"></i>
                                                {{trans.data.info[lang.value]}}</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="navTabs1_content">
                                        <div class="tab-pane fade show active scrollable" id="navTabs1_1" role="tabpanel">
                                            <div class="row mt-3">
                                                <div class="col">
                                                    <div class="table-responsive">
                                                        <table class="table" id="user_shift_table">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>{{trans.data.name[lang.value]}}</th>
                                                                    <th>{{trans.data.user[lang.value]}}</th>
                                                                    <th>{{trans.data.profile[lang.value]}}</th>
                                                                    <th>{{trans.data.service[lang.value]}}</th>
                                                                    <th>{{trans.data.salesPoint[lang.value]}}</th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_user_shifts.data.query_list_user_shifts" id="userShiftTableBody">
                                                                <tr>
                                                                    <td dmx-text="user_shift_id"></td>
                                                                    <td dmx-text="user_fname+' '+user_lname"></td>
                                                                    <td dmx-text="user_username"></td>
                                                                    <td dmx-text="trans.data.getValueOrKey(user_profile)[lang.value]"></td>

                                                                    <td>
                                                                        <h6 class="text-secondary" dmx-hide="user_profile!=='Cashier'"><i class="fas fa-brain fa-2x"></i>
                                                                        </h6>

                                                                        <form id="userAssignedService" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_user_shifts/update_user_shift_service.php" class="d-flex" dmx-on:success="notifies1.success('Sucess!');list_user_shifts.load({shift_id: session_variables.data.current_shift_edit}); list_user_info.load({user_id: list_user_info.data.query_list_user_info.user_id})">
                                                                            <div class="row">
                                                                                <div class="col">
                                                                                    <select id="shiftsDropdown" class="form-select" optiontext="service_name" optionvalue="service_id" name="servo_service_service_id" dmx-bind:options="list_services.data.query_list_services" dmx-bind:value="servo_service_service_id">
                                                                                        <option selected="" value="">---</option>
                                                                                    </select>
                                                                                    <input id="userShiftId1" name="user_shift_id" type="text" class="form-control visually-hidden" dmx-bind:value="user_shift_id">
                                                                                </div>
                                                                                <div class="col"><button id="btn4" class="btn text-success" type="submit"><i class="fas fa-check"></i>
                                                                                    </button></div>
                                                                            </div>


                                                                        </form>
                                                                    </td>
                                                                    <td>
                                                                        <form id="userAssignedPOS" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_user_shifts/update_user_shift_sales_point.php" dmx-hide="(user_profile == 'Waiter' || user_profile == 'Service') " class="d-flex" dmx-on:success="notifies1.success('Sucess!');list_user_shifts.load({shift_id: session_variables.data.current_shift_edit}); list_user_info.load({user_id: list_user_info.data.query_list_user_info.user_id})">
                                                                            <div class="row">
                                                                                <div class="col">
                                                                                    <select id="posDropdown" class="form-select" optiontext="sales_point_name" name="servo_sales_point_sales_point_id" dmx-bind:value="servo_sales_point_sales_point_id" dmx-bind:options="list_sales_points.data.query_list_sales_points" optionvalue="sales_point_id">
                                                                                        <option selected="" value="">---</option>
                                                                                    </select>
                                                                                    <input id="userShiftId2" name="user_shift_id" type="text" class="form-control visually-hidden" dmx-bind:value="user_shift_id">
                                                                                </div>
                                                                                <div class="col"><button id="btn10" class="btn text-success" type="submit"><i class="fas fa-check"></i>
                                                                                    </button></div>
                                                                            </div>


                                                                        </form>
                                                                    </td>
                                                                    <td>
                                                                        <form id="deleteUserShift" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_user_shifts/delete_user_shift.php" dmx-on:success="notifies1.success('Success!');list_user_shifts.load();list_users_sorted_for_shift.load(); list_user_info.load({user_id: list_user_info.data.query_list_user_info.user_id})">
                                                                            <input id="userShiftId" name="user_shift_id" type="text" class="form-control visually-hidden" dmx-bind:value="user_shift_id">
                                                                            <button id="btn3" class="btn text-danger" type="submit"><i class="far fa-trash-alt fa-lg"></i>
                                                                            </button>
                                                                        </form>

                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="tab-pane fade scrollable" id="navTabs1_2" role="tabpanel">
                                            <div class="container mt-3">
                                                <div class="row row-cols-12 row-cols-sm-12">
                                                    <div class="w-auto flex-xl-row flex-xxl-row flex-xxl-wrap flex-sm-row flex-sm-wrap flex-md-wrap flex-md-row col-md mb-md-0 col-sm ms-0 flex-lg-row justify-content-sm-around justify-content-md-around justify-content-lg-around justify-content-xl-center flex-xl-wrap col">
                                                        <div class="table-responsive">
                                                            <table class="table table-hover table-sm">
                                                                <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>{{trans.data.name[lang.value]}}</th>
                                                                        <th>{{trans.data.surname[lang.value]}}</th>
                                                                        <th>{{trans.data.username[lang.value]}}</th>
                                                                        <th>{{trans.data.profile[lang.value]}}</th>
                                                                        <th>{{trans.data.department[lang.value]}}</th>
                                                                        <th></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_users_sorted_for_shift.data.custom_list_users_sorted_for_shift" id="tableRepeat1">
                                                                    <tr>
                                                                        <td dmx-text="user_id"></td>
                                                                        <td dmx-text="user_fname"></td>
                                                                        <td dmx-text="user_lname"></td>
                                                                        <td dmx-text="user_username"></td>
                                                                        <td dmx-text="trans.data.getValueOrKey(user_profile)[lang.value]"></td>
                                                                        <td dmx-text="department_name"></td>
                                                                        <td>
                                                                            <button id="btn9" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#assignDepartmentModal" dmx-bind:value="list_users_assigned.data.query_list_users[0].user_id" dmx-on:click="session_variables.set('userToAssign',user_id);get_user_info.load({user_id: session_variables.data.userToAssign})" dmx-show="user_profile!=='Waiter'"><i class="fas fa-arrow-circle-right"></i></button>
                                                                            <button id="btn5" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#assignServiceModal" dmx-bind:value="list_users_assigned.data.query_list_users[0].user_id" dmx-on:click="session_variables.set('userToAssign',user_id);get_user_info.load({user_id: session_variables.data.userToAssign})" dmx-show="user_profile=='Waiter'"><i class="fas fa-arrow-circle-right"></i></button>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>


                                                        <div class="flex-md-wrap flex-md-row justify-content-md-center rounded align-content-center bg-secondary mt-2 mb-2 ms-1 me-1 pt-3 pb-3 ps-3 pe-3 col-12 col-sm-5 offset-md-1 col-md-5 col-lg-5 col-xxl-3" dmx-repeat:products="load_products.data.query_list_products">
                                                            <h3 class="text-center text-warning">{{product_name}}</h3>
                                                            <h4 class="text-center">{{product_price}}</h4>
                                                            <form id="add_products_to_order_form" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_user_shifts/create_user_shift.php" dmx-on:success="form3.reset();list_users.load();notifies1.success('Success:'+product_name+' Added to Order')">
                                                                <p><label for="forrm_user_id">User:</label><input id="user_id" name="user_id" type="number" value=""></p>
                                                                <p><label for="time_checkin">Time checkin:</label><input id="time_checkin" name="time_checkin" type="datetime" value=""></p>
                                                                <p><label for="time_checkout">Time checkout:</label><input id="time_checkout" name="time_checkout" type="datetime" value=""></p>
                                                                <p><label for="balance_checkin">Balance checkin:</label><input id="balance_checkin" name="balance_checkin" type="number" value=""></p>
                                                                <p><label for="balance_checkout">Balance checkout:</label><input id="balance_checkout" name="balance_checkout" type="number" value=""></p>
                                                                <p><label for="servo_user_user_id">Servo user user:</label><input id="servo_user_user_id" name="servo_user_user_id" type="number" value=""></p>
                                                                <p><label for="servo_shifts_shift_id">Servo shifts shift:</label><input id="servo_shifts_shift_id" name="servo_shifts_shift_id" type="number" value=""></p>
                                                                <p><label for="user_shift_notes">User shift notes:</label><input id="user_shift_notes" name="user_shift_notes" type="text" value=""></p>
                                                            </form>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade scrollable" id="navTabs1_3" role="tabpanel">
                                            <div class="row bg-secondary border rounded row-cols-1 mt-3 ms-0 me-0 pt-2 pb-2 ps-2 pe-2">
                                                <form is="dmx-serverconnect-form" id="updateShift" method="post" action="dmxConnect/api/servo_shifts/update_shift.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="read_shift.data.query_read_shift" dmx-on:success="list_shifts_paged.load({});notifies1.success('Sucess');readItemModal.hide()">
                                                    <div class="mb-3 row">
                                                        <label for="inp_shift_id" class="col-sm-2 col-form-label">Shift</label>
                                                        <div class="col-sm-10">
                                                            <input type="number" class="form-control" id="inp_shift_id" name="shift_id" dmx-bind:value="read_shift.data.query_read_shift.shift_id" aria-describedby="inp_shift_id_help" readonly="true">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="inp_shift_start13" class="col-sm-2 col-form-label">Shift Start</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control mb-2" id="inp_shift_start12" name="shift_start" dmx-bind:value="read_shift.data.query_read_shift.shift_start" aria-describedby="inp_shift_start_help" utc="true" type="datetime-local" required="" data-msg-required="!">

                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="inp_shift_stop14" class="col-sm-2 col-form-label">Shift Stop</label>
                                                        <div class="col-sm-10 lh-base">
                                                            <input class="form-control mb-2" id="inp_shift_stop11" name="shift_stop" dmx-bind:value="read_shift.data.query_read_shift.shift_stop" aria-describedby="inp_shift_stop_help" type="datetime-local" utc="true" required="" data-msg-required="!">

                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <legend class="col-sm-2 col-form-label">Status</legend>
                                                        <div class="col-sm-10">
                                                            <select id="shift_status1" class="form-select" name="shift_status" dmx-bind:value="trans.data.getValueOrKey(read_shift.data.query_read_shift.shift_status)[lang.value] ">
                                                                <option value="Active">{{trans.data.Active[lang.value]}}</option>
                                                                <option value="Pending">{{trans.data.Pending[lang.value]}}</option>
                                                                <option value="Closed">{{trans.data.Closed[lang.value]}}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <div class="col-sm-10">
                                                            <button type="submit" class="btn btn-primary" dmx-bind:value="read_shift.data.query_read_shift.Save">Save</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </main>

                        </div>





                    </div>
                    <div class="modal-footer">
                        <form id="form1" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_shifts/delete_shift.php" dmx-on:success="notifies1.success('Success');list_shifts_paged.load();readItemModal.hide()" onsubmit=" return confirm('CONFIRM DELETE?');">
                            <input id="text1" name="shift_id" type="hidden" class="form-control" dmx-bind:value="read_shift.data.query_read_shift.shift_id">

                            <button id="btn6" class="btn text-danger" type="submit">
                                <i class="far fa-trash-alt fa-lg"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal bg-secondary" id="assignDepartmentModal" is="dmx-bs5-modal" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title text-body">Assign Department:&nbsp;&nbsp;</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col d-flex">
                                <div id="repeatPOS" is="dmx-repeat" dmx-bind:repeat="list_sales_points.data.query_list_sales_points" key="sales_point_id">
                                    <form id="assignUserToShift1" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_user_shifts/create_user_shift.php" dmx-on:success="list_users_sorted_for_shift.load({});list_user_shifts.load();notifies1.success('Success!');assignDepartmentModal.hide();readItemModal.show(); list_user_info.load({user_id: list_user_info.data.query_list_user_info.user_id})" dmx-on:error="notifies1.danger('Error!')">
                                        <input id="userId1" name="servo_user_user_id" type="text" class="form-control visually-hidden" dmx-bind:value="session_variables.data.userToAssign">
                                        <input id="shiftId1" name="servo_shifts_shift_id" type="text" class="form-control visually-hidden" dmx-bind:value="session_variables.data.current_shift_edit">
                                        <input id="userShiftCode1" name="user_shift_code" type="text" class="form-control visually-hidden" dmx-bind:value="session_variables.data.current_shift_edit+'@'+session_variables.data.userToAssign">
                                        <input id="assignedStatus1" name="assigned" type="text" class="form-control visually-hidden" dmx-bind:value="'yes'">
                                        <input id="salesPointID" name="servo_sales_point_sales_point_id" type="text" class="form-control visually-hidden" dmx-bind:value="sales_point_id">
                                        <button id="btn7" class="btn btn-lg mb-2 me-2 pt-3 pb-3 ps-3 pe-3 text-white btn-info" dmx-text="sales_point_name" type="submit"></button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal bg-secondary" id="assignServiceModal" is="dmx-bs5-modal" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title text-body">Assign Department:&nbsp;&nbsp;</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col d-flex">
                                <div id="repeatServices1" is="dmx-repeat" dmx-bind:repeat="list_services.data.query_list_services" key="service_id">
                                    <form id="assignUserToShift" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_user_shifts/create_user_shift.php" dmx-on:success="list_users_sorted_for_shift.load({});list_user_shifts.load();notifies1.success('Success!');assignServiceModal.hide();readItemModal.show();list_user_info.load({user_id: list_user_info.data.query_list_user_info.user_id})" dmx-on:error="notifies1.danger('Error!')">
                                        <input id="userId2" name="servo_user_user_id" type="text" class="form-control visually-hidden" dmx-bind:value="session_variables.data.userToAssign">
                                        <input id="shiftId2" name="servo_shifts_shift_id" type="text" class="form-control visually-hidden" dmx-bind:value="session_variables.data.current_shift_edit">
                                        <input id="userShiftCode2" name="user_shift_code" type="text" class="form-control visually-hidden" dmx-bind:value="session_variables.data.current_shift_edit+'@'+session_variables.data.userToAssign">
                                        <input id="assignedStatus2" name="assigned" type="text" class="form-control visually-hidden" dmx-bind:value="'yes'">
                                        <input id="serviceid1" name="servo_service_service_id" type="text" class="form-control visually-hidden" dmx-bind:value="service_id">
                                        <button id="btn11" class="btn btn-lg mb-2 me-2 pt-3 pb-3 ps-3 pe-3 btn-info text-white" dmx-text="service_name" type="submit"></button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <main>
        <div class="mt-auto ms-2 me-2">




            <div class="row servo-page-header">
                <div class="col-auto" dmx-animate-enter="slideInLeft">
                    <i class="fas fa-user-clock fa-2x" style="color: #ff9518 !important;"></i>
                </div>
                <div class="col-auto page-heading">
                    <h4 class="servo-page-heading">{{trans.data.shifts[lang.value]}}</h4>
                </div>
                <div class="col style13 page-button d-flex justify-content-sm-end justify-content-end" id="pagebuttons">

                    <button id="btn1" class="btn style12 fw-light add-button rounded bg-info text-white" data-bs-toggle="modal" data-bs-target="#createItemModal" style="float: right;"><i class="fas fa-plus style14 fa-sm"></i></button>
                </div>
            </div>
            <div class="row">
                <div class="col">

                    <div class="row justify-content-sm-between justify-content-md-between justify-content-lg-between justify-content-xl-between justify-content-xxl-between justify-content-between mt-2 mb-2 sorter bg-light rounded">
                        <div class="col-lg-3 col-12 col-sm-12"><input id="shiftfilter" name="shiftfilter" type="datetime-local" class="form-control mb-2 form-control-sm" dmx-bind:placeholder="trans.data.search[lang.value]+'  '"></div>

                        <div class="d-flex flex-sm-wrap col-md-5 col-lg-7 justify-content-lg-end col-xl-6 justify-content-xl-end justify-content-xxl-end col-auto flex-wrap col-sm-auto">
                            <ul class="pagination" dmx-populate="list_shifts_paged.data.query_list_shifts" dmx-state="listShifts" dmx-offset="offset" dmx-generator="bs5paging">
                                <li class="page-item" dmx-class:disabled="list_shifts_paged.data.query_list_shifts.page.current == 1" aria-label="First">
                                    <a href="javascript:void(0)" class="page-link" dmx-on:click="listShifts.set('offset',list_shifts_paged.data.query_list_shifts.page.offset.first)"><span aria-hidden="true">&lsaquo;&lsaquo;</span></a>
                                </li>
                                <li class="page-item" dmx-class:disabled="list_shifts_paged.data.query_list_shifts.page.current == 1" aria-label="Previous">
                                    <a href="javascript:void(0)" class="page-link" dmx-on:click="listShifts.set('offset',list_shifts_paged.data.query_list_shifts.page.offset.prev)"><span aria-hidden="true">&lsaquo;</span></a>
                                </li>
                                <li class="page-item" dmx-class:active="title == list_shifts_paged.data.query_list_shifts.page.current" dmx-class:disabled="!active" dmx-repeat="list_shifts_paged.data.query_list_shifts.getServerConnectPagination(2,1,'...')">
                                    <a href="javascript:void(0)" class="page-link" dmx-on:click="listShifts.set('offset',(page-1)*list_shifts_paged.data.query_list_shifts.limit)">{{title}}</a>
                                </li>
                                <li class="page-item" dmx-class:disabled="list_shifts_paged.data.query_list_shifts.page.current ==  list_shifts_paged.data.query_list_shifts.page.total" aria-label="Next">
                                    <a href="javascript:void(0)" class="page-link" dmx-on:click="listShifts.set('offset',list_shifts_paged.data.query_list_shifts.page.offset.next)"><span aria-hidden="true">&rsaquo;</span></a>
                                </li>
                                <li class="page-item" dmx-class:disabled="list_shifts_paged.data.query_list_shifts.page.current ==  list_shifts_paged.data.query_list_shifts.page.total" aria-label="Last">
                                    <a href="javascript:void(0)" class="page-link" dmx-on:click="listShifts.set('offset',list_shifts_paged.data.query_list_shifts.page.offset.last)"><span aria-hidden="true">&rsaquo;&rsaquo;</span></a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-1 col-xl-1 col-md-2 col-sm-2 col-3 offset-lg-1 offset-1 offset-sm-3"><select id="shift_sort_limit" class="form-select" name="shift_sort_limit">
                                <option value="5">5</option>
                                <option selected="" value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="''">{{trans.data.all[lang.value]}}</option>
                            </select></div>
                    </div>
                    <div class="row">
                        <div class="col rounded bg-light ms-3 me-3">
                            <div class="table-responsive servo-shadow">
                                <table class="table table-hover table-sm table-borderless">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{trans.data.start[lang.value]}}</th>
                                            <th>{{trans.data.stop[lang.value]}}</th>
                                            <th>{{trans.data.status[lang.value]}}</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_shifts_paged.data.query_list_shifts.data" id="tableRepeat5">
                                        <tr dmx-class:text-success="shift_status=='Active'">
                                            <td dmx-text="shift_id"></td>
                                            <td dmx-text="shift_start"></td>
                                            <td dmx-text="shift_stop"></td>
                                            <td>{{trans.data.getValueOrKey(shift_status)[lang.value]}}</td>
                                            <td class="text-center"><button id="btn2" class="btn open" data-bs-target="#productInfo" dmx-on:click="readItemModal.show();read_shift.load({shift_id: shift_id});session_variables.set('current_shift_edit',shift_id)" dmx-bind:value="list_shifts.data.query_list_shifts[0].shift_id" wappler-empty="Editable" wappler-command="editContent"><i class="fas fa-expand-alt fa-lg"><br></i></button></td>
                                            <td>
                                                <form id="form2" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_shifts/activate_shift.php" dmx-on:success="list_shifts_paged.load();notifies1.success('Activated!')">
                                                    <input id="text2" name="shift_id" type="text" class="form-control visually-hidden" dmx-bind:value="shift_id"><button id="btn8" class="btn text-success" type="submit" dmx-bind:disabled="(shift_stop)<dateTime.datetime">
                                                        <i class="fas fa-play"></i>
                                                    </button>

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
        </div>
    </main>
    <script src="bootstrap/5/js/bootstrap.bundle.min.js"></script>
    <script src="bootstrap/5/js/bootstrap.min.js"></script>
</body>

</html>