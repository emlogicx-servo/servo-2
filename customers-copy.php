<!doctype html>
<html>
<head>

<link rel="stylesheet" href="css/bootstrap-icons.css" />

<script src="dmxAppConnect/dmxAppConnect.js"></script><script src="dmxAppConnect/dmxBootstrap5Navigation/dmxBootstrap5Navigation.js" defer=""></script>

<script src="dmxAppConnect/dmxScheduler/dmxScheduler.js" defer=""></script>

<script src="dmxAppConnect/dmxTyped/dmxTyped.js" defer=""></script>

<script src="dmxAppConnect/dmxTyped/typed.min.js" defer=""></script>

<link rel="stylesheet" href="dmxAppConnect/dmxNotifications/dmxNotifications.css" />

<script src="dmxAppConnect/dmxNotifications/dmxNotifications.js" defer=""></script>

<script src="dmxAppConnect/dmxBootstrap5Modal/dmxBootstrap5Modal.js" defer=""></script>

<script src="dmxAppConnect/dmxStateManagement/dmxStateManagement.js" defer=""></script>

<script src="dmxAppConnect/dmxBrowser/dmxBrowser.js" defer=""></script>

<link rel="stylesheet" href="dmxAppConnect/dmxBootstrap5TableGenerator/dmxBootstrap5TableGenerator.css" />


<meta name="ac:base" content="/servo">
<base href="/servo/">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="css/style.css" />
<link rel="stylesheet" href="bootstrap/5/darkly/bootstrap.min.css" />
<title>SERVO</title>
<link rel="stylesheet" href="fontawesome5/css/all.min.css" />
<script src="dmxAppConnect/dmxFormatter/dmxFormatter.js" defer=""></script>
<link rel="stylesheet" href="dmxAppConnect/dmxDropzone/dmxDropzone.css" />
<script src="dmxAppConnect/dmxDropzone/dmxDropzone.js" defer=""></script>
<link rel="stylesheet" href="dmxAppConnect/dmxValidator/dmxValidator.css" />
<script src="dmxAppConnect/dmxValidator/dmxValidator.js" defer=""></script>
</head>
<body is="dmx-app" id="brands">
<dmx-query-manager id="listcustomerstate"></dmx-query-manager>
<dmx-value id="currentCustomer"></dmx-value>
<dmx-session-manager id="session_variables"></dmx-session-manager>

<dmx-value id="lang" dmx-bind:value="browser1.language"></dmx-value>
<dmx-json-datasource id="trans" is="dmx-serverconnect" url="assets/translation/translation.JSON"></dmx-json-datasource>

<dmx-serverconnect id="list_customer_orders" url="dmxConnect/api/servo_customer_cash_transactions/list_customer_orders.php" dmx-param:id="id" noload="" dmx-param:item_id="" dmx-param:user_id="" dmx-param:customer_id=""></dmx-serverconnect>
<dmx-serverconnect id="list_customer_transactions" url="dmxConnect/api/servo_customer_cash_transactions/list_transactions_customer.php" dmx-param:id="id" noload="" dmx-param:item_id="" dmx-param:user_id="" dmx-param:customer_id=""></dmx-serverconnect><dmx-serverconnect id="read_customer" url="dmxConnect/api/servo_customers/read_customer.php" dmx-param:id="id" noload dmx-param:item_id="" dmx-param:user_id="" dmx-param:customer_id="session_variables.data.current_customer"></dmx-serverconnect>

<dmx-serverconnect id="delete_item_user_profile" url="dmxConnect/api/servo_user_profiles/delete_user_profile.php"></dmx-serverconnect><dmx-serverconnect id="list_customers" url="dmxConnect/api/servo_customers/list_customers.php" dmx-param:sort="query.sort" dmx-param:dir="query.dir"></dmx-serverconnect><div is="dmx-browser" id="browser1"></div>
<dmx-notifications id="notifies1"></dmx-notifications>
<?php include 'header.php'; ?><main class="mt-4">
<div class="modal create-modal" id="createItemModal" is="dmx-bs5-modal" tabindex="-1">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{trans.data.newCustomer[lang.value]}}</h5>

        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
<div class="row"><form is="dmx-serverconnect-form" id="serverconnectFormCreateUser" method="post" action="dmxConnect/api/servo_customers/create_customer.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-on:success="notifies1.success('Success!');list_customers.load();serverconnectFormCreateUser.reset()">
<div class="mb-3 row">
  <label for="inp_customer_first_name" class="col-sm-2 col-form-label">{{trans.data.name[lang.value]}}</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" id="inp_customer_first_name" name="customer_first_name" aria-describedby="inp_customer_first_name_help">
  </div>
</div>
<div class="mb-3 row">
  <label for="inp_customer_last_name" class="col-sm-2 col-form-label">{{trans.data.surname[lang.value]}}</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" id="inp_customer_last_name" name="customer_last_name" aria-describedby="inp_customer_last_name_help">
  </div>
</div>
<div class="mb-3 row">
  <label for="inp_customer_phone_number" class="col-sm-2 col-form-label">{{trans.data.phoneNumber[lang.value]}}</label>

  <div class="col-sm-10">
    <input type="number" class="form-control" id="inp_customer_phone_number" name="customer_phone_number" aria-describedby="inp_customer_phone_number_help">
  </div>
</div>
<div class="row">
<label for="inp_customer_phone_number" class="col-sm-2 col-form-label"><i class="fas fa-portrait fa-2x"></i></label>

<div class="col">
<input id="text2" name="customer_picture" type="text" class="form-control visually-hidden">
<input id="customerPictureFile" name="customer_picture_file" type="file" class="form-control"></div>
</div>


<div class="mb-3 row">
  <div class="col-sm-2">&nbsp;</div>
  <div class="col-sm-10 mt-2">
    <button type="submit" class="btn btn-primary">Save</button>
  </div>
</div>
</form></div>
        
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
        <h2 class="modal-title text-warning">{{read_customer.data.query_read_customer.customer_first_name+' '+read_customer.data.query_read_customer.customer_last_name}}</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
<div class="row">
<div class="col">
<ul class="nav nav-tabs" id="navTabs1_tabs" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="navTabs1_1_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_1" role="tab" aria-controls="navTabs1_1" aria-selected="true">{{trans.data.orders[lang.value]}}</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="navTabs1_2_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_2" role="tab" aria-controls="navTabs1_2" aria-selected="false">{{trans.data.transactions[lang.value]}}</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="navTabs1_3_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_3" role="tab" aria-controls="navTabs1_3" aria-selected="false">{{trans.data.info[lang.value]}}</a>
  </li>
</ul>
<div class="tab-content" id="navTabs1_content">
  <div class="tab-pane fade show active" id="navTabs1_1" role="tabpanel">
<div class="row mt-2">
<div class="col">
<div class="table-responsive">
<table class="table table-hover table-sm">
  <thead>
    <tr>
      <th>#</th>
      <th>{{trans.data.dateTime[lang.value]}}</th>
      <th>{{trans.data.status[lang.value]}}</th>
      <th>{{trans.data.waiter[lang.value]}}</th>
      <th>{{trans.data.table[lang.value]}}</th>
      <th>{{trans.data.notes[lang.value]}}</th>
      <th>{{trans.data.paymentMethod[lang.value]}}</th>
      <th>{{trans.data.service[lang.value]}}</th>
    </tr>
  </thead>
  <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_customer_orders.data.query_list_customer_orders" id="tableRepeat3">
    <tr>
      <td dmx-text="order_id"></td>
      <td dmx-text="order_time"></td>
      <td dmx-text="order_status"></td>
      <td dmx-text="user_username"></td>
      <td dmx-text="table_name"></td>
      <td dmx-text="order_notes"></td>
      <td dmx-text="servo_payment_methods_payment_method"></td>
      <td dmx-text="service_name"></td>
    </tr>
  </tbody>
</table>
</div>
</div>
</div>
<div class="row"></div>
  </div>
  <div class="tab-pane fade" id="navTabs1_2" role="tabpanel">
<div class="row mt-2">
<div class="flex-lg-wrap justify-content-lg-start col-12">
<form id="createCustomerTransaction" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_customer_cash_transactions/create_transaction.php" class="d-flex" dmx-on:success="notifies1.success('Sucess!');createCustomerTransaction.reset();list_customer_transactions.load({customer_id: read_customer.data.query_read_customer.customer_id})">

<input id="customerId" name="customer_id" type="text" class="form-control visually-hidden" dmx-bind:value="read_customer.data.query_read_customer.customer_id">
<input id="userApproved" name="user_approved_id" type="text" class="form-control visually-hidden" dmx-bind:value="session_variables.data.user_id">

<input id="transactionAmount" name="transaction_amount" type="number" class="form-control ms-2" dmx-bind:placeholder="trans.data.amount[lang.value]">
<input id="transactionDate" name="transaction_date" type="datetime-local" class="form-control ms-2" dmx-bind:value="dateTime.datetime"><select id="transactionType" class="form-select ms-2" name="transaction_type">
<option value="Credit">{{trans.data.credit[lang.value]}}</option><option value="Debit">{{trans.data.debit[lang.value]}}</option><option value="Pending">{{trans.data.pending[lang.value]}}</option></select>
<button id="btn3" class="btn ms-2 btn-success" type="submit">
<i class="fas fa-check"></i>
</button></form>
</div>
</div>
<div class="row mt-lg-2 mt-2">
<div class="col">
<div class="table-responsive">
<table class="table table-hover table-sm">
  <thead>
    <tr>
      <th>#</th>
      <th>{{trans.data.total[lang.value]}}</th>
      <th>{{trans.data.transaction[lang.value]}}</th>
      <th>{{trans.data.concerned[lang.value]}}</th>
      <th>{{trans.data.dateTime[lang.value]}}</th>
<th>{{trans.data.date[lang.value]}}</th>
    </tr>
  </thead>
  <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_customer_transactions.data.query" id="tableRepeat2">
    <tr>
      <td dmx-text="customer_transaction_id"></td>
      <td dmx-text="transaction_amount"></td>
      <td dmx-text="transaction_type"></td>
      <td dmx-text="user_username"></td>
      <td dmx-text="transaction_date"></td>
<td>
<form id="deleteTransaction" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_customer_cash_transactions/delete_transaction.php" dmx-on:success="list_customer_transactions.load({customer_id: session_variables.data.current_customer});notifies1.success('Success!')">
<input id="customerTransactionId" name="customer_transaction_id" type="text" class="form-control visually-hidden" dmx-bind:value="customer_transaction_id">
<button id="btn4" class="btn text-danger" type="submit"><i class="far fa-trash-alt"></i>
</button></form>

</td>
    </tr>
  </tbody>
</table>
</div>
</div>
</div>
  </div>
  <div class="tab-pane fade" id="navTabs1_3" role="tabpanel">
<div class="row mt-2">
<div class="col d-flex flex-row-reverse"></div>
</div>
<div class="row">
<div class="col"><h1 class="text-warning">{{read_item_user.data.query.user_username}}</h1></div>
</div>
<div class="row">
<div class="pt-2 pb-2 col-xl-4 col-lg-6 col-12 text-sm-center text-center col-md-6 text-md-center"><img dmx-bind:src="'/servo/uploads/customer_pictures/'+read_customer.data.query_read_customer.customer_picture" class="img-fluid img-thumbnail rounded-0" width="300" dmx-hide="(read_customer.data.query_read_customer.customer_picture == null)" loading="lazy">
<img class="rounded-circle img-fluid" width="300" src="uploads/servo_no_image.jpg" dmx-show="(read_customer.data.query_read_customer.customer_picture == null)">
<div class="row">
<div class="col">
<form id="deleteCustomerPicture" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_customers/delete_customer_picture.php" dmx-on:success="notifies1.success('Success!');read_customer.load({customer_id: session_variables.data.current_customer})" dmx-hide="(read_customer.data.query_read_customer.customer_picture == null)">
<input id="customer_id_delete" name="customer_id" type="text" class="form-control visually-hidden" dmx-bind:value="read_customer.data.query_read_customer.customer_id"><input id="customer_picture_file_delete" name="customer_picture_file" type="text" class="form-control visually-hidden" dmx-bind:value="read_customer.data.query_read_customer.customer_picture">
<input id="customer_picture_ref_delete" name="customer_picture_ref" type="text" class="form-control visually-hidden" dmx-bind:value="NULL">
<input id="customer_picture_delete" name="customer_picture" type="text" class="form-control visually-hidden" dmx-bind:value="null">
<button id="btn5" class="btn btn-danger mt-2" type="submit">
<i class="far fa-trash-alt fa-lg"></i>
</button>
</form>

</div>
</div><div class="row" id="replacePicture" dmx-show="(read_customer.data.query_read_customer.customer_picture == null)">

<div class="col text-xxl-center text-center">
<div class="row mt-2"><form id="replacePicture" class="d-flex" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_customers/replace_customer_picture.php" dmx-on:success="notifies1.success('Success!');read_customer.load({customer_id: session_variables.data.current_customer})"><input id="text4" name="customer_picture" type="text" class="form-control visually-hidden">
<input id="text5" name="customer_id" type="text" class="form-control visually-hidden" dmx-bind:value="read_customer.data.query_read_customer.customer_id"><input name="customer_picture_file" type="file" class="form-control" required="" data-rule-maxfiles="1" accept=".jpg, .png">
<button id="btn7" class="btn btn-success ms-xxl-2 ms-xl-2 ms-lg-2 ms-md-2 ms-sm-2 ms-2" type="submit" dmx-show="replacePicture.customer_picture_file.value+'!='+null">
<i class="fas fa-upload"></i>
</button>
</form>
</div>
</div>


</div></div><div class="col"><form is="dmx-serverconnect-form" id="readitem" method="post" action="dmxConnect/api/servo_customers/update_customer.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="read_customer.data.query_read_customer" dmx-on:success="list_customers.load({});notifies1.success('Success!')">
<div class="mb-3 row">
  <label for="inp_customer_id" class="col-sm-2 col-form-label">{{trans.data.customer[lang.value]}}</label>
  <div class="col-sm-10">
    <input type="number" class="form-control" id="inp_customer_id" name="customer_id" dmx-bind:value="read_customer.data.query_read_customer.customer_id" aria-describedby="inp_customer_id_help" readonly="true">
  </div>
</div>
<div class="mb-3 row">
  <label for="inp_customer_first_name" class="col-sm-2 col-form-label">{{trans.data.name[lang.value]}}</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" id="inp_customer_first_name" name="customer_first_name" dmx-bind:value="read_customer.data.query_read_customer.customer_first_name" aria-describedby="inp_customer_first_name_help">
  </div>
</div>
<div class="mb-3 row">
  <label for="inp_customer_last_name" class="col-sm-2 col-form-label">{{trans.data.surname[lang.value]}}</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" id="inp_customer_last_name" name="customer_last_name" dmx-bind:value="read_customer.data.query_read_customer.customer_last_name" aria-describedby="inp_customer_last_name_help">
  </div>
</div>
<div class="mb-3 row">
  <label for="inp_customer_phone_number" class="col-sm-2 col-form-label">{{trans.data.phoneNumber[lang.value]}}</label>
  <div class="col-sm-10">
    <input type="number" class="form-control" id="inp_customer_phone_number" name="customer_phone_number" dmx-bind:value="read_customer.data.query_read_customer.customer_phone_number" aria-describedby="inp_customer_phone_number_help">
  </div>
</div>
<div class="mb-3 row">
  <div class="col-sm-2">&nbsp;</div>
  <div class="col-sm-10">
    <button type="submit" class="btn btn-primary" dmx-bind:value="read_customer.data.query_read_customer.Save">Save</button>
  </div>
</div>
</form></div>

</div>
  </div>
</div>
</div>
</div>


      </div>
      <div class="modal-footer">
<form id="deleteCustomer" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_customers/delete_customer.php" dmx-on:success="notifies1.success('Success');list_customers.load({});readItemModal.hide()" onsubmit=" return confirm('CONFIRM DELETE?');" dmx-on:error="notifies1.warning('Error!')">
<input id="text1" name="customer_id" type="hidden" class="form-control" dmx-bind:value="read_customer.data.query_read_customer.customer_id">

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
<h2 class="servo-page-heading fw-lighter">{{trans.data.customers[lang.value]}}</h2>
</div>
<div class="col style13 page-button" id="pagebuttons">
<button id="btn1" class="btn style12 fw-light text-warning" data-bs-toggle="modal" data-bs-target="#createItemModal" style="float: right;"><i class="fas fa-plus fa-2x style14"></i>
</button>
</div>
</div><div class="row">
<div class="col">


<div class="table-responsive" id="customerList">
<table class="table table-hover table-sm table-borderless">
  <thead>
    <tr>
      <th>#</th>
      <th>{{trans.data.name[lang.value]}}</th>
      <th>{{trans.data.surname[lang.value]}}</th>
      <th>{{trans.data.phoneNumber[lang.value]}}</th>
<th></th>
    </tr>
  </thead>
  <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_customers.data.query_list_customers" id="tableRepeat1">
    <tr>
      <td dmx-text="customer_id"></td>
      <td dmx-text="customer_first_name"></td>
      <td dmx-text="customer_last_name"></td>
      <td dmx-text="customer_phone_number"></td>
<td class="text-center">

        <button id="btn2" class="btn" data-bs-target="#readItemModal" dmx-bind:value="customer_id" dmx-on:click="session_variables.set('current_customer',customer_id); readItemModal.show();read_customer.load({customer_id: customer_id});list_customer_transactions.load({customer_id: customer_id});list_customer_orders.load({customer_id: customer_id})"><i class="far fa-eye fa-lg"><br></i></button>

</td>
    </tr>
  </tbody>
</table>
</div>
</div>
</div>
</div></main>
<script src="bootstrap/5/js/bootstrap.bundle.min.js"></script>
</body>
</html>
