<?php
require('dmxConnectLib/dmxConnect.php');

$app = new \lib\App();

$app->exec(<<<'JSON'
{
	"steps": [
		"Connections/servodb",
		"SecurityProviders/servo_login",
		{
			"module": "auth",
			"action": "restrict",
			"options": {"permissions":"Manager","loginUrl":"login.php","forbiddenUrl":"login.php","provider":"servo_login"}
		}
	]
}
JSON
, TRUE);
?><!doctype html>
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
<link rel="stylesheet" href="fontawesome5/css/all.min.css" />
</head>

<body is="dmx-app" id="departments">
<dmx-scheduler id="scheduler1" dmx-on:tick=""></dmx-scheduler>
<dmx-serverconnect id="list_shifts" url="dmxConnect/api/servo_shifts/list_shifts.php"></dmx-serverconnect>
<dmx-serverconnect id="load_branches" url="dmxConnect/api/servo_refered_fields_loading/load_branches.php"></dmx-serverconnect>
<dmx-serverconnect id="total_sales_per_waiter" url="dmxConnect/api/servo_data/total_sales_per_waiter.php" dmx-param:user_id="session_variables.data.user_id"></dmx-serverconnect>
<dmx-session-manager id="session_variables"></dmx-session-manager>

    <dmx-serverconnect id="read_shift" url="dmxConnect/api/servo_shifts/read_shift.php" dmx-param:id="id" noload dmx-param:item_id="" dmx-param:branch_id="read_item_branch.data.queryReadBranch.branch_id" dmx-param:department_id="" dmx-param:order_id="tableRepeat2[0].order_id" dmx-param:shift_id="list_shifts.data.query_list_shifts[0].shift_id"></dmx-serverconnect>
    <dmx-serverconnect id="shifts_table" url="dmxConnect/api/servo_shifts/list_shifts.php" dmx-param:user_id="session_variables.data.user_id"></dmx-serverconnect>
<dmx-serverconnect id="load_users" url="dmxConnect/api/servo_users/list_users.php"></dmx-serverconnect>
    <div is="dmx-browser" id="browser1"></div>
    <dmx-notifications id="notifies1" timeout="100" position="bottom" extended-timeout="200"></dmx-notifications>
    <?php include 'header.php'; ?>
    <main class="mt-4">

<div class="modal" id="SelectTableModal" is="dmx-bs5-modal" tabindex="-1">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Please Select Table</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
<div class="container">
<div class="row">
<div class="d-flex flex-wrap flex-row justify-content-center flex-sm-wrap flex-md-row justify-content-md-center col">
<div dmx-repeat:repeat2="load_tables.data.query_list_tables">
<button id="btn2" class="btn btn-lg mt-0 mb-2 ms-0 me-2 pt-5 pb-5 ps-5 pe-5 btn-warning" dmx-text="table_name" dmx-on:click="session_variables.set('table_id',table_id);SelectTableModal.hide();CreateOrderModal.show()">Button</button>

</div>


</div>
</div>
</div>
      </div>
      <div class="modal-footer">

      </div>
    </div>
  </div>
</div>
<div class="modal" id="OrderDetailsModal" is="dmx-bs5-modal" tabindex="-1">
  <div class="modal-dialog modal-xl modal-fullscreen-lg-down modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Order Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success">
<i class="fas fa-check fa-lg"></i>
</button>
      </div>
    </div>
  </div>
</div>
<div class="modal" id="AddProductsModal" is="dmx-bs5-modal" tabindex="-1" dmx-on:hidden-bs-modal="total_sales_per_waiter.load({});session_variables.remove('table_id');session_variables.remove('current_order')">
  <div class="modal-dialog modal-xl modal-fullscreen-lg-down" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <h5 class="modal-title">
ORDER: {{session_variables.data.current_order}}</h5>
<button id="btn9" class="btn text-warning" data-bs-toggle="offcanvas" data-bs-target="#orderdetailsoffcanvas">
<i class="far fa-eye"></i>
</button>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
<div class="container">
<div class="row">
<header>
<h1>Order Total:&nbsp;</h1>
</header>
</div>
<div class="row">
<div class="d-flex flex-wrap w-auto flex-xl-row flex-xxl-row flex-xxl-wrap flex-sm-row flex-sm-wrap flex-md-wrap flex-md-row col-md mb-md-0 col-sm ms-0 flex-row flex-lg-row justify-content-sm-around justify-content-around justify-content-md-around justify-content-lg-around"><div class="flex-md-wrap flex-md-row justify-content-md-center rounded align-content-center bg-secondary mt-2 mb-2 ms-1 me-1 pt-3 pb-3 ps-3 pe-3 col-12 col-sm-5 offset-md-1 col-md-5 col-lg-5 col-xxl-3" dmx-repeat:products="load_products.data.query_list_products">
<h2 class="text-center text-warning">{{product_name}}</h2>
<h3 class="text-center">{{product_price}}</h3>
<form id="form3" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_order_items/create_order_item.php" dmx-on:success="form3.reset();list_order_items_current.load({order_id: session_variables.data.current_order});notifies1.success('Success:'+product_name+' Added to Order')">
<input id="inp_order_item_quantity" name="order_item_quantity" type="number" class="form-control mb-sm-1 mb-2" placeholder="1">
<input id="inp_order_time_ordered" name="order_time_ordered" type="datetime-local" class="form-control mb-sm-1 mb-2 visually-hidden">
<input id="inp_order_time_ready" name="order_time_ready" type="datetime-local" class="form-control mb-sm-1 mb-2 visually-hidden">
<input id="inp_order_time_delivered" name="order_time_delivered" type="datetime-local" class="form-control mb-sm-1 mb-2 visually-hidden">
<input id="inp_order_item_status" name="order_item_status" class="form-control mb-sm-1 mb-2 visually-hidden" value="Ordered">
<input id="inp_order_id" name="servo_orders_order_id" type="number" class="form-control mb-sm-1 mb-2 visually-hidden" dmx-bind:value="session_variables.data.current_order">
<input id="inp_order_product_id" name="servo_products_product_id" type="number" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="1" dmx-bind:value="product_id">
<input id="inp_order_item_price" name="order_item_price" type="number" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="1" dmx-bind:value="product_price">
<input id="inp_order_item_discount" name="order_item_discount" type="number" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="1" dmx-bind:value="product_discount">
<textarea id="inp_order_notes" class="form-control" name="order_item_notes"></textarea>
<button id="btn8" class="add-item-button btn btn-warning mt-2 align-self-end btn-lg" type="submit">
<i class="fas fa-plus fa-lg"></i>
</button>
</form>
</div></div>

</div>
</div>

      </div>
<div class="offcanvas w-auto offcanvas-start" id="orderdetailsoffcanvas" is="dmx-bs5-offcanvas" tabindex="-1">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title">Order #{{session_variables.data.current_order}}</h5>
<h5 class="offcanvas-title">Table:</h5>
<h5 class="offcanvas-title" dmx-text="list_order_items_current.data.query.sum(`(order_item_price * order_item_quantity)`)">{{tableRepeat2[0].order_time}}</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
  <div class="row" dmx-on:click="">
<div class="col">
<table class="table">
  <thead>
    <tr>
      <th>Time</th>
      <th>Product</th>
      <th>Price</th>
      <th>Quantity</th>
      <th>Note</th>
      <th>Discount</th>
      <th>Total</th>
    </tr>
  </thead>
  <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_order_items_current.data.query" id="tableRepeat3">
    <tr>
      <td dmx-text="order_time_ordered"></td>
      <td dmx-text="product_name"></td>
      <td dmx-text="order_item_price.formatNumber(2, '.', ',')"></td>
      <td dmx-text="order_item_quantity"></td>
      <td dmx-text="order_item_notes"></td>
      <td dmx-text="order_item_discount"></td>
      <td dmx-text="(order_item_price * order_item_quantity).formatNumber(2, '.', ',')"></td>
    </tr>
  </tbody>
</table>
</div>
</div></div>
</div>
      <div class="modal-footer">


      </div>
    </div>
  </div>
</div>
<div class="modal" id="AddProductsModalToOrder" is="dmx-bs5-modal" tabindex="-1" dmx-on:hidden-bs-modal="session_variables.removeAll()">
  <div class="modal-dialog modal-xl modal-fullscreen-lg-down" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <h5 class="modal-title">
ORDER: {{session_variables.data.current_order}}</h5>
<button id="btn3" class="btn text-warning" data-bs-toggle="offcanvas" data-bs-target="#orderdetailsoffcanvas">
<i class="far fa-eye"></i>
</button>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">


      </div>
<div class="offcanvas w-auto offcanvas-start" id="orderdetailsoffcanvas1" is="dmx-bs5-offcanvas" tabindex="-1">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title">Order #{{session_variables.data.current_order}}</h5>
<h5 class="offcanvas-title">Table:</h5>
<h5 class="offcanvas-title" dmx-text="list_order_items_current.data.query.sum(`(order_item_price * order_item_quantity)`)">{{tableRepeat2[0].order_time}}</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
  <div class="row" dmx-on:click="">
<div class="col">
<table class="table">
  <thead>
    <tr>
      <th>Time</th>
      <th>Product</th>
      <th>Price</th>
      <th>Quantity</th>
      <th>Note</th>
      <th>Discount</th>
      <th>Total</th>
    </tr>
  </thead>
  <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_order_items_current.data.query" id="tableRepeat1">
    <tr>
      <td dmx-text="order_time_ordered"></td>
      <td dmx-text="product_name"></td>
      <td dmx-text="order_item_price.formatNumber(2, '.', ',')"></td>
      <td dmx-text="order_item_quantity"></td>
      <td dmx-text="order_item_notes"></td>
      <td dmx-text="order_item_discount"></td>
      <td dmx-text="(order_item_price * order_item_quantity).formatNumber(2, '.', ',')"></td>
    </tr>
  </tbody>
</table>
</div>
</div></div>
</div>
      <div class="modal-footer">


      </div>
    </div>
  </div>
</div>
<div class="modal" id="CreateOrderModal" is="dmx-bs5-modal" tabindex="-1">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Create Order for : {{session_variables.data.table_id}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
<div class="container">
<div class="row">
<div class="col d-flex justify-content-center">
<div class="row">
<div class="col d-flex justify-content-center ms-1 me-1 flex-wrap">
<form is="dmx-serverconnect-form" id="create_order_form" method="post" action="dmxConnect/api/servo_orders/create_order.php" dmx-on:success="notifies1.success('Order #'+create_order_form.data.custom[0]['last_insert_id()']+' Created');session_variables.set('current_order',create_order_form.data.custom[0]['last_insert_id()']);CreateOrderModal.hide();list_orders.load();create_order_form.reset();AddProductsModal.show()">
<input id="order_time" name="order_time" type="text" class="form-control visually-hidden">
<input id="order_customer" name="order_customer" type="hidden" class="form-control visually-hidden">
<input id="order_discount" name="order_discount" type="hidden" class="form-control visually-hidden" dmx-bind:value="0">
<input id="order_status" name="order_status" type="hidden" class="form-control visually-hidden" dmx-bind:value="'Pending'">
<input id="table" name="servo_customer_table_table_id" type="hidden" class="form-control visually-hidden" dmx-bind:value="session_variables.data.table_id">
<input id="user_id" name="servo_user_user_id" type="hidden" class="form-control visually-hidden" dmx-bind:value="session_variables.data.user_id">

<div class="row row-cols-1">
<div class="d-flex border border-warning col"><button id="btn7" class="btn me-0 btn-lg text-warning" type="submit">CREATE ORDER</button>
</div>
</div></form>

</div>
</div>


</div>
</div>
</div>
      </div>
      <div class="modal-footer">

      </div>
    </div>
  </div>
</div>
        <div class="modal create-modal" id="createItemModal" is="dmx-bs5-modal" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Create New Shift</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <form is="dmx-serverconnect-form" id="serverconnectCreateShift" method="post" action="dmxConnect/api/servo_shifts/create_shift.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-on:success="notifies1.success('Success');list_shifts.load();serverconnectCreateShift.reset();createItemModal.hide()">
<div class="mb-3 row">
  <label for="inp_shift_start" class="col-sm-2 col-form-label">Shift Start</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" id="inp_shift_start" name="shift_start" aria-describedby="inp_shift_start_help" placeholder="Enter Shift Start" is="dmx-date-picker" timepicker="" use24hours="true">
  </div>
</div>
<div class="mb-3 row">
  <label for="inp_shift_stop" class="col-sm-2 col-form-label">Shift Stop</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" id="inp_shift_stop" name="shift_stop" aria-describedby="inp_shift_stop_help" placeholder="Enter Shift Stop" is="dmx-date-picker" timepicker="" use24hours="true">
  </div>
</div>
<div class="mb-3 row">
  <label for="inp_servo_branches_branch_id" class="col-sm-2 col-form-label">Branch</label>
  <div class="col-sm-10">
<select id="select1" class="form-select" dmx-bind:options="load_branches.data.query" optiontext="branch_name" optionvalue="branch_id" name="servo_branches_branch_id">
</select>
  </div>
</div>
<div class="mb-3 row">
  <legend class="col-sm-2 col-form-label">Status</legend>
  <div class="col-sm-10">
<select id="shift_status" class="form-select" name="shift_status">
<option value="Active">Active</option><option value="Pending">Pending</option><option value="Closed">Closed</option></select>
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
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal readitem" id="readItemModal" is="dmx-bs5-modal" tabindex="-1" dmx-on:hidden-bs-modal="total_sales_per_waiter.load()">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
<div class="d-block"><h2 class="fw-bold text-warning">Shift Details&nbsp;</h2></div>





                        
                        <button id="btn10" class="btn text-success float-right" data-bs-toggle="offcanvas" data-bs-target="#AddProductsToOrderOffCanvas" dmx-on:click="">
<i class="fas fa-plus fa-lg"></i>
</button><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
<div class="offcanvas offcanvas-start" id="AddProductsToOrderOffCanvas" is="dmx-bs5-offcanvas" tabindex="-1">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title">Add Products To Order</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
  <div class="container">
<div class="row">
<header>
<h1>Order Total:&nbsp;</h1>
</header>
</div>
<div class="row row-cols-7">
<div class="d-flex flex-wrap w-auto flex-xl-row flex-xxl-row flex-xxl-wrap flex-sm-row flex-sm-wrap flex-md-wrap flex-md-row col-md mb-md-0 col-sm ms-0 flex-row flex-lg-row justify-content-sm-around justify-content-around justify-content-md-around justify-content-lg-around col"><div class="flex-md-wrap flex-md-row justify-content-md-center rounded align-content-center bg-secondary mt-2 mb-2 ms-1 me-1 pt-3 pb-3 ps-3 pe-3 col-12 col-sm-5 offset-md-1 col-md-5 col-lg-5 col-xxl-3" dmx-repeat:products="load_products.data.query_list_products">
<h3 class="text-center text-warning">{{product_name}}</h3>
<h4 class="text-center">{{product_price}}</h4>
<form id="add_products_to_order_form" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_order_items/add_order_item_to_order.php" dmx-on:success="form3.reset();list_order_items.load({order_id: read_item_order.data.query.order_id});notifies1.success('Success:'+product_name+' Added to Order')">
<input id="inp_order_item_quantity1" name="order_item_quantity" type="number" class="form-control mb-sm-1 mb-2" placeholder="1">
<input id="inp_order_time_ordered1" name="order_time_ordered" type="datetime-local" class="form-control mb-sm-1 mb-2 visually-hidden">
<input id="inp_order_time_ready1" name="order_time_ready" type="datetime-local" class="form-control mb-sm-1 mb-2 visually-hidden">
<input id="inp_order_time_delivered1" name="order_time_delivered" type="datetime-local" class="form-control mb-sm-1 mb-2 visually-hidden">
<input id="inp_order_item_status1" name="order_item_status" class="form-control mb-sm-1 mb-2 visually-hidden" value="Ordered">
<input id="inp_order_id1" name="servo_orders_order_id" type="number" class="form-control mb-sm-1 mb-2 visually-hidden" dmx-bind:value="session_variables.data.current_order">
<input id="inp_order_product_id1" name="servo_products_product_id" type="number" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="1" dmx-bind:value="product_id">
<input id="inp_order_item_price1" name="order_item_price" type="number" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="1" dmx-bind:value="product_price">
<input id="inp_order_item_discount1" name="order_item_discount" type="number" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="1" dmx-bind:value="product_discount">
<textarea id="inp_order_notes1" class="form-control" name="order_item_notes"></textarea>
<button id="btn3" class="add-item-button btn btn-warning mt-2 align-self-end btn-lg" type="submit">
<i class="fas fa-plus fa-lg"></i>
</button>
</form>
</div></div>

</div>
</div></div>
</div><div class="row">
<div class="col d-flex"><div class="d-block">
<h3>Shift</h3>
</div><div class="d-block">
<h3 class="text-success">{{list_order_items.data.query[0].table_name}}&nbsp;</h3>
</div><div class="d-block">
<h3>Total:&nbsp;</h3>
</div><div class="d-block text-danger">
<h3>{{list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`)}}</h3>
</div>
<div class="text-danger float-right">

</div></div>
</div>
                        <h1>{{read_item_department.data.query.department_name}}</h1>
                        <div class="row">
                            <div class="col">
                                <div class="table-responsive" id="order_details_table">
<table class="table">
  <thead>
    <tr>
      <th>Product</th>
      <th>Time</th>
      <th>Status</th>
      <th>Att</th>
      <th>Notes</th>
      <th>Quantity</th>
      <th>Price</th>
      <th>Discount</th>
<th>Discount</th>
    </tr>
  </thead>
  <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_order_items.data.query" id="tableRepeat4">
    <tr>
      <td dmx-text="product_name"></td>
      <td dmx-text="order_time_ordered"></td>
      <td dmx-text="order_item_status"></td>
      <td dmx-text="servo_user_user_prepared_id"></td>
      <td dmx-text="order_item_notes"></td>
      <td dmx-text="order_item_quantity"></td>
      <td dmx-text="order_item_price"></td>
      <td dmx-text="order_item_discount"></td>
    <td>

<form id="form2" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_order_items/delete_order_item.php" dmx-on:success="notifies1.success('Success');list_order_items.load()"><input id="text2" name="order_item_id" type="text" class="form-control visually-hidden" dmx-bind:value="order_item_id"><button id="btn2" class="btn text-danger" data-bs-target="#productInfo" type="submit"><i class="far fa-trash-alt fa-lg"><br></i></button></form>
        
    </td>
    </tr>
  </tbody>
</table>
</div>
                            </div>

                        </div>
                        <div class="row">
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
                    <h5 class="servo-page-heading fw-lighter"><i class="far fa-user fa-xs"></i>&nbsp;{{session_variables.data.current_user}}</h5>
                </div>
            </div>
            <div class="row">
                <div class="col">


                    <div class="table-responsive">
<table class="table table-hover table-sm">
  <thead>
    <tr>
      <th>Shift</th>
      <th>Shift start</th>
      <th>Shift stop</th>
      <th>Servo branches branch</th>
      <th>Shift status</th>
<th></th>
    </tr>
  </thead>
  <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_shifts.data.query_list_shifts" id="tableRepeat5">
    <tr>
      <td dmx-text="shift_id"></td>
      <td dmx-text="shift_start"></td>
      <td dmx-text="shift_stop"></td>
      <td dmx-text="servo_branches_branch_id"></td>
      <td dmx-text="shift_status"></td>
    <td>
        <button id="btn2" class="btn text-info" data-bs-target="#productInfo" dmx-on:click="readItemModal.show();read_shift.load({shift_id: shift_id})" dmx-bind:value="list_shifts.data.query_list_shifts[0].shift_id"><i class="far fa-eye fa-lg"><br></i></button>
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