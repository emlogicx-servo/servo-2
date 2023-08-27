<!doctype html>
<html>
<head>

    <style>
        @media print{
         #invoiceHead, .invoiceHead            
            {
               display:none;
            }
        * 
            
            {
                color: black !important;
            }
        
        .modal-footer
        {
            diaplay: none !important;
        }

         }
    </style>

<link rel="stylesheet" href="css/bootstrap-icons.css" />

<script src="dmxAppConnect/dmxAppConnect.js"></script><script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js" integrity="sha256-CutOzxCRucUsn6C6TcEYsauvvYilEniTXldPa6/wu0k=" crossorigin="anonymous"></script><script src="dmxAppConnect/dmxBootstrap5Navigation/dmxBootstrap5Navigation.js" defer=""></script>

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
<script src="dmxAppConnect/dmxBootstrap5PagingGenerator/dmxBootstrap5PagingGenerator.js" defer=""></script>
<script src="dmxAppConnect/dmxBootstrap5Offcanvas/dmxBootstrap5Offcanvas.js" defer=""></script>
<link rel="stylesheet" href="dmxAppConnect/dmxAnimateCSS/animate.min.css" />
<script src="dmxAppConnect/dmxAnimateCSS/dmxAnimateCSS.js" defer=""></script>
<link rel="stylesheet" href="dmxAppConnect/dmxDatePicker/daterangepicker.min.css" />
<script src="dmxAppConnect/dmxDatePicker/daterangepicker.min.js" defer=""></script>
<link rel="stylesheet" href="dmxAppConnect/dmxDatePicker/dmxDatePicker.css" />
<script src="dmxAppConnect/dmxDatePicker/dmxDatePicker.js" defer=""></script>


<script src="dmxAppConnect/dmxCharts/Chart.min.js" defer=""></script>
<script src="dmxAppConnect/dmxCharts/dmxCharts.js" defer=""></script>
</head>
<body is="dmx-app" id="brands">
<dmx-query-manager id="listCustomerOrders"></dmx-query-manager>
<dmx-query-manager id="listCustomerCoveredOrders"></dmx-query-manager><dmx-query-manager id="listcustomers"></dmx-query-manager>

<dmx-value id="currentCustomer"></dmx-value>
<dmx-session-manager id="session_variables"></dmx-session-manager>

<dmx-value id="lang" dmx-bind:value="browser1.language"></dmx-value>
<dmx-json-datasource id="trans" is="dmx-serverconnect" url="assets/translation/translation.JSON"></dmx-json-datasource>

<dmx-serverconnect id="list_customer_orders" url="dmxConnect/api/servo_customer_cash_transactions/list_customer_orders_paged.php" dmx-param:id="id" dmx-param:customer_id="session_variables.data.current_customer" dmx-param:offset="listCustomerOrders.data.customerOrdersOffset" dmx-param:limit="c_order_sort_limit.value"></dmx-serverconnect>
<dmx-serverconnect id="list_customer_covered_orders" url="dmxConnect/api/servo_customer_cash_transactions/list_customer_covered_orders_paged.php" dmx-param:id="id" noload="" dmx-param:customer_id="session_variables.data.current_customer" dmx-param:offset="listCustomerCoveredOrders.data.offset" dmx-param:limit="c_order_sort_limit2.value"></dmx-serverconnect>
<dmx-serverconnect id="list_customer_data_reading_sessions" url="dmxConnect/api/servo_data_reading_session/list_data_reading_sessions_customer.php" dmx-param:id="id" noload="" dmx-param:customer_id="session_variables.data.current_customer" dmx-param:offset="listCustomerOrders.data.offset" dmx-param:limit="c_order_sort_limit.value"></dmx-serverconnect>
<dmx-serverconnect id="list_customer_data_field_readings" url="dmxConnect/api/servo_data_field_readings/list_data_field_readings.php" dmx-param:id="id" dmx-param:customer_id="session_variables.data.current_customer" dmx-param:offset="listCustomerOrders.data.offset" dmx-param:limit="c_order_sort_limit.value" noload dmx-param:data_reading_session_id="session_variables.data.current_data_reading_session"></dmx-serverconnect>
<dmx-serverconnect id="list_customer_data_fields" url="dmxConnect/api/servo_data_fields/list_data_fields.php" dmx-param:id="id" dmx-param:customer_id="session_variables.data.current_customer" dmx-param:offset="listCustomerOrders.data.offset" dmx-param:limit="c_order_sort_limit.value" dmx-param:data_reading_session_id="read_customer_data_reading_sessions.data.query_read_data_reading_session.data_reading_session_id"></dmx-serverconnect>
<dmx-serverconnect id="read_customer_data_reading_sessions" url="dmxConnect/api/servo_data_reading_session/read_data_reading_session.php" dmx-param:id="id" noload="" dmx-param:customer_id="session_variables.data.current_customer" dmx-param:offset="listCustomerOrders.data.offset" dmx-param:limit="c_order_sort_limit.value" dmx-param:data_reading_session_id="data_reading_session_id"></dmx-serverconnect>
<dmx-serverconnect id="companyInfo" url="dmxConnect/api/servo_company_information/read_company_information.php" dmx-param:id="id" dmx-param:item_id="" dmx-param:user_id="" dmx-param:customer_id="session_variables.data.current_customer" dmx-param:offset="listCustomerOrders.data.offset" dmx-param:limit="c_order_sort_limit.value" dmx-param:company_info_id="1"></dmx-serverconnect>
<dmx-serverconnect id="payment_methods" url="dmxConnect/api/servo_payment_methods/list_payment_methods.php" dmx-param:id="id" dmx-param:item_id="" dmx-param:user_id="" dmx-param:customer_id="session_variables.data.current_customer" dmx-param:offset="listCustomerOrders.data.offset" dmx-param:limit="c_order_sort_limit.value"></dmx-serverconnect>
<dmx-serverconnect id="list_customer_transactions" url="dmxConnect/api/servo_customer_cash_transactions/list_transactions_customer.php" dmx-param:id="id" noload="" dmx-param:item_id="" dmx-param:user_id="" dmx-param:customer_id="session_variables.data.current_customer"></dmx-serverconnect>
<dmx-serverconnect id="list_customer_transactions_amounts" url="dmxConnect/api/servo_customer_cash_transactions/list_transactions_customer_amounts.php" dmx-param:id="id" noload="" dmx-param:item_id="" dmx-param:user_id="" dmx-param:customer_id="session_variables.data.current_customer"></dmx-serverconnect>
<dmx-serverconnect id="list_customer_orders_totals" url="dmxConnect/api/servo_customer_cash_transactions/list_customer_orders_totals.php" dmx-param:id="id" noload="" dmx-param:item_id="" dmx-param:user_id="" dmx-param:customer_id="session_variables.data.current_customer"></dmx-serverconnect>
<dmx-serverconnect id="read_customer_transaction" url="dmxConnect/api/servo_customer_cash_transactions/read_transaction.php" dmx-param:id="id" noload="" dmx-param:item_id="" dmx-param:user_id="" dmx-param:customer_id="session_variables.data.current_customer" dmx-param:customer_cash_transaction_id="session_variables.data.current_transaction"></dmx-serverconnect>
<dmx-serverconnect id="list_customer_transactions_order" url="dmxConnect/api/servo_customer_cash_transactions/list_transactions_customer_order.php" dmx-param:id="id" noload="" dmx-param:item_id="" dmx-param:user_id="" dmx-param:customer_id="session_variables.data.current_customer" dmx-param:order_id="session_variables.data.current_order"></dmx-serverconnect>
<dmx-serverconnect id="list_customer_transactions_order_totals" url="dmxConnect/api/servo_customer_cash_transactions/list_customer_transactions_order_totals.php" dmx-param:id="id" noload="" dmx-param:item_id="" dmx-param:user_id="" dmx-param:customer_id="session_variables.data.current_customer" dmx-param:order_id="session_variables.data.current_order"></dmx-serverconnect><dmx-serverconnect id="read_customer" url="dmxConnect/api/servo_customers/read_customer.php" dmx-param:id="id" noload dmx-param:item_id="" dmx-param:user_id="" dmx-param:customer_id="session_variables.data.current_customer"></dmx-serverconnect>

<dmx-serverconnect id="delete_item_user_profile" url="dmxConnect/api/servo_user_profiles/delete_user_profile.php"></dmx-serverconnect><dmx-serverconnect id="list_customers" url="dmxConnect/api/servo_customers/list_customers_paged.php" dmx-param:sort="" dmx-param:dir="" dmx-param:limit="customer_sort_limit.value" dmx-param:offset="listcustomers.data.offset" dmx-param:customerfilter="customerfilter.value" dmx-param:customerfilter2="customerfilter2.value"></dmx-serverconnect>
<dmx-serverconnect id="list_customers_special" url="dmxConnect/api/servo_customers/list_customers_special.php" dmx-param:sort="" dmx-param:dir="" dmx-param:limit="customer_sort_limit.value" dmx-param:offset="listcustomers.data.offset" dmx-param:customerfilter="customerfilter.value"></dmx-serverconnect>

<dmx-serverconnect id="readCustomerOrder" url="dmxConnect/api/servo_orders/read_order.php" dmx-param:id="id" noload dmx-param:item_id="" dmx-param:branch_id="read_item_branch.data.queryReadBranch.branch_id" dmx-param:department_id="" dmx-param:order_id="session_variables.data.current_order"></dmx-serverconnect>
<dmx-serverconnect id="list_order_items" url="dmxConnect/api/servo_order_items/list_order_items_current.php" dmx-param:order_id=""></dmx-serverconnect>
<dmx-serverconnect id="list_order_items_deleted" url="dmxConnect/api/servo_order_items/list_order_items_deleted.php" dmx-param:order_id=""></dmx-serverconnect>
<dmx-serverconnect id="load_products" url="dmxConnect/api/servo_products/list_products_per_service.php" dmx-param:category="" dmx-param:name="" dmx-param:search="AddProductsToOrderOffCanvas.searchProducts2.value" dmx-param:department_id="list_user_shift_info.data.query_list_user_shift[0].user_shift_department_id" dmx-param:service_id="list_user_shift_info.data.query_list_user_shift[0].servo_service_service_id" dmx-param:product_filter=""></dmx-serverconnect>
<dmx-serverconnect id="load_product_groups" url="dmxConnect/api/servo_product_groups/list_product_groups.php" dmx-param:category="" dmx-param:name="" dmx-param:search="searchProduct.value" dmx-param:department_id="list_user_shift_info.data.query_list_user_shift[0].user_shift_department_id" dmx-param:product_group_id="load_product_groups.data.list_product_groups[0].product_group_id"></dmx-serverconnect>
<div is="dmx-browser" id="browser1"></div>
<dmx-notifications id="notifies1"></dmx-notifications>
<?php include 'header.php'; ?>
<main id="createItem"><div class="modal create-modal" id="createItemModal" is="dmx-bs5-modal" tabindex="-1">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{trans.data.newCustomer[lang.value]}}</h5>

        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
<div class="row"><form is="dmx-serverconnect-form" id="serverconnectFormCreateUser" method="post" action="dmxConnect/api/servo_customers/create_customer.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-on:success="notifies1.success('Success!');list_customers.load();serverconnectFormCreateUser.reset()">
<div class="mb-3 row">
  <label for="inp_customer_first_name1" class="col-sm-2 col-form-label">{{trans.data.name[lang.value]}}</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" id="inp_customer_first_name" name="customer_first_name" aria-describedby="inp_customer_first_name_help">
  </div>
</div>
<div class="mb-3 row">
  <label for="inp_customer_last_name1" class="col-sm-2 col-form-label">{{trans.data.surname[lang.value]}}</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" id="inp_customer_last_name" name="customer_last_name" aria-describedby="inp_customer_last_name_help">
  </div>
</div>
<div class="mb-3 row">
  <label for="inp_customer_last_name1" class="col-sm-2 col-form-label">{{trans.data.sex[lang.value]}}</label>
  <div class="col-sm-10">
<select id="select6" class="form-select" name="customer_sex">
<option value="male">{{trans.data.male[lang.value]}}</option><option value="female">{{trans.data.female[lang.value]}}</option></select>
  </div>
</div>
<div class="mb-3 row">
  <label for="inp_customer_last_name1" class="col-sm-2 col-form-label">{{trans.data.dob[lang.value]}}</label>
  <div class="col-sm-10">
<input id="date1" name="customer_dob" type="date" is="dmx-date-picker">
  </div>
</div>
<div class="mb-3 row">
  <label for="inp_customer_last_name1" class="col-sm-2 col-form-label">{{trans.data.age[lang.value]}}</label>
  <div class="col-sm-10">
<input id="text6" name="customer_age" type="number" class="form-control">
  </div>
</div>
<div class="mb-3 row">
  <label for="inp_customer_last_name1" class="col-sm-2 col-form-label">{{trans.data.address[lang.value]}}</label>
  <div class="col-sm-10">
    <textarea type="text" class="form-control" id="customeraddress" name="customer_address" aria-describedby="inp_customer_last_name_help"></textarea>
  </div>
</div>
<div class="mb-3 row">
  <label for="inp_customer_phone_number1" class="col-sm-2 col-form-label">{{trans.data.phoneNumber[lang.value]}}</label>

  <div class="col-sm-10">
    <input type="number" class="form-control" id="customerphonenumber" name="customer_phone_number" aria-describedby="inp_customer_phone_number_help">
  </div>
</div>
<div class="mb-3 row">
  <label for="inp_customer_phone_number1" class="col-sm-2 col-form-label">{{trans.data.class[lang.value]}}</label>

  <div class="col-sm-8">
<select id="select5" class="form-select" name="customer_class">
<option selected="" value="standard">{{trans.data.standard[lang.value]}}</option><option value="special">{{trans.data.special[lang.value]}}</option></select>
  </div>
</div>
<div class="row">
<label for="inp_customer_phone_number1" class="col-sm-2 col-form-label"><i class="fas fa-portrait fa-2x"></i></label>

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
</div></main><main class="mt-4" id="readItem">

<div class="modal readitem" id="readItemModal" is="dmx-bs5-modal" tabindex="-1">
  <div class="modal-dialog modal-xl" role="document" style="margin: 0px !important; width: 100% !important; height: 99% !important; max-width: 100% !important; max-height: 99% !important;">
    <div class="modal-content" style="max-height: 100% !important; height: 100% !important;">
      <div class="modal-header text-sm-start">

        <div class="d-block me-2" style="width: 40px; height: 40px;">

          <img dmx-bind:src="'/servo/uploads/customer_pictures/'+read_customer.data.query_read_customer.customer_picture" class="rounded-circle shadow-none mt-2 me-2" width="100%" dmx-hide="(read_customer.data.query_read_customer.customer_picture == null)" loading="lazy" style="object-fit: cover;" height="100%">

          <img class="rounded-circle img-fluid" width="100%" src="uploads/servo_no_image.jpg" dmx-show="(read_customer.data.query_read_customer.customer_picture == null)" height="100%">




        </div>
        
<div class="d-block"><h4 class="modal-title mt-2 text-white">{{read_customer.data.query_read_customer.customer_first_name+' '+read_customer.data.query_read_customer.customer_last_name}}</h4></div><div class="d-block">
<form is="dmx-serverconnect-form" id="create_order_form" method="post" action="dmxConnect/api/servo_orders/create_order.php" dmx-on:success="notifies1.success('Order #'+create_order_form.data.custom[0]['last_insert_id()']+' Created');readCustomerOrder.load({order_id: create_order_form.data.custom[0]['last_insert_id()']});list_order_items.load({order_id: create_order_form.data.custom[0]['last_insert_id()']});session_variables.set('current_order',create_order_form.data.custom[0]['last_insert_id()']);list_customer_orders.load({customer_id: session_variables.data.current_customer, offset: listCustomerOrders.data.offset, limit: c_order_sort_limit.value});create_order_form.reset();customerOrderModal.show();list_customer_transactions_order.load({order_id: create_order_form.data.custom[0]['last_insert_id()']});list_order_items_deleted.load({order_id: create_order_form.data.custom[0]['last_insert_id()']})">
        <input id="order_time" name="order_time" type="text" class="form-control visually-hidden">
        <input id="orderCustomer" name="order_customer" class="form-control visually-hidden" dmx-bind:value="session_variables.data.current_customer">
        <input id="order_discount" name="order_discount" type="hidden" class="form-control visually-hidden" dmx-bind:value="0">
        <input id="order_status" name="order_status" type="hidden" class="form-control visually-hidden" dmx-bind:value="'Ordered'">
        <input id="user_id" name="servo_user_user_id" type="hidden" class="form-control visually-hidden" dmx-bind:value="session_variables.data.user_id">
        <input id="shift_id" name="servo_shift_shift_id" type="hidden" class="form-control visually-hidden" dmx-bind:value="session1.data.current_shift">
        <input id="serviceId" name="servo_service_service_id" type="hidden" class="form-control visually-hidden" dmx-bind:value="list_user_shift_info.data.query_list_user_shift[0].servo_service_service_id">

        <div class="row row-cols-1">
            <div class="d-flex border-warning col mt-2 ms-3">
            <button id="btn7" class="btn btn-success fw-bold" type="submit" style="background: #02b843 !important; border: none;">{{trans.data.createOrder[lang.value]}}
</button>
</div>
        </div>
    </form>

</div>
<div class="d-block" id="createDataReadingSession">
<form is="dmx-serverconnect-form" id="create_data_reading_session" method="post" action="dmxConnect/api/servo_data_reading_session/create_data_reading_sesssion.php" dmx-on:success="notifies1.success('Order #'+create_order_form.data.custom[0]['last_insert_id()']+' Created');create_data_reading_session.reset();session_variables.set('current_data_reading_session',create_order_form.data.custom[0]['last_insert_id()']);customerDataReadingSessionModal.show();list_customer_data_reading_sessions.load({customer_id: session_variables.data.current_customer});read_customer_data_reading_sessions.load({data_reading_session_id: create_data_reading_session.data.custom[0]['last_insert_id()']});list_customer_data_field_readings.load({})">
        <input id="drs_date" name="data_reading_session_date" type="datetime-local" class="form-control visually-hidden" dmx-bind:value="dateTime.datetime">
        <input id="drs_user" name="data_reading_session_user" class="form-control visually-hidden" dmx-bind:value="session_variables.data.user_id">
        <input id="drs_customer" name="data_reading_session_customer" type="hidden" class="form-control visually-hidden" dmx-bind:value="session_variables.data.current_customer">
        <input id="drs_notes" name="data_reading_session_notes" type="hidden" class="form-control visually-hidden">

        <div class="row row-cols-1">
            <div class="d-flex border-warning col mt-2 ms-3">
            <button id="btn19" class="btn fw-bold btn-info" type="submit" style="border: none;">
<i class="fas fa-clipboard-list"></i>
</button>
</div>
        </div>
    </form>

</div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col">
            <ul class="nav nav-tabs" id="navTabs1_tabs" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="navTabs1_1_tab1" data-bs-toggle="tab" href="#" data-bs-target="#tabPane1" role="tab" aria-controls="navTabs1_1" aria-selected="true" dmx-on:click="list_customer_transactions_amounts.load({customer_id: session_variables.data.current_customer});list_customer_orders_totals.load({customer_id: session_variables.data.current_customer})">{{trans.data.overview[lang.value]}}</a>
              </li><li class="nav-item">
                <a class="nav-link " id="navTabs1_1_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_1" role="tab" aria-controls="navTabs1_1" aria-selected="true">{{trans.data.orders[lang.value]}}
                </a>
              </li>
<li class="nav-item">
                <a class="nav-link text-warning" id="navTabs1_1_tab2" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_8" role="tab" aria-controls="navTabs1_1" aria-selected="true" dmx-hide="(read_customer.data.query_read_customer.customer_class == 'standard')"><i class="fas fa-people-arrows fa-sm"></i></a>
              
</li>

              <li class="nav-item">
                <a class="nav-link" id="navTabs1_2_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_2" role="tab" aria-controls="navTabs1_2" aria-selected="false">{{trans.data.transactions[lang.value]}}</a>
              </li>
<li class="nav-item">
                <a class="nav-link" id="navTabs1_2_tab1" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_6" role="tab" aria-controls="navTabs1_2" aria-selected="false">{{trans.data.data[lang.value]}}</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="navTabs1_3_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_3" role="tab" aria-controls="navTabs1_3" aria-selected="false">{{trans.data.info[lang.value]}}</a>
              </li>
            </ul>
            <div class="tab-content" id="navTabs1_content">
<div class="tab-pane fade show active" id="tabPane1" role="tabpanel">
<dmx-value id="variableTotalCustomerDebt" dmx-bind:value="variableTotalCustomerDebtVariable.value.toNumber()"></dmx-value>
<dmx-value id="variableTotalCustomerTransactions" dmx-bind:value="list_customer_transactions_amounts.data.custom_list_transaction_amounts[0].Settlements.toNumber()"></dmx-value>
<dmx-value id="variableTotalCustomerDebtVariable" dmx-bind:value="((list_customer_transactions_amounts.data.custom_list_transaction_amounts[0].Settlements).toNumber().default(0) -(list_customer_orders_totals.data.custom_list_customer_orders_totals[0]['Customer Orders Totals']).toNumber().default(0)).formatNumber('0',',',',')"></dmx-value>
<dmx-value id="variableTotalCustomerCoverageDebt" dmx-bind:value="((list_customer_transactions_amounts.data.custom_list_transaction_amounts[0].Settlements).toNumber().default(0) -(list_customer_orders_totals.data.custom_list_customer_orders_totals[0]['Customer Orders Totals']).toNumber().default(0)).formatNumber('0',',',',')"></dmx-value>
<dmx-value id="variableTotalCoverageDebt" dmx-bind:value="((list_customer_orders_totals.data.custom_list_customer_orders_totals[0]['Coverage Totals']).toNumber().default(0)).formatNumber('0',',',',')"></dmx-value>
<dmx-value id="variableTotalCovered" dmx-bind:value="((list_customer_orders_totals.data.custom_list_customer_orders_totals[0]['Total Covered']).toNumber().default(0)).formatNumber('0',',',',')"></dmx-value>
<div class="row">

<div class="col-12 col-lg-6"><div class="row mt-2 ms-0">
<div id="totalDebt" class="bg-info text-center mt-2 me-2 pt-4 pb-4 ps-4 pe-4 col" style="background: #ff2a5c !important;">
<div class="row">
<div class="col">
<i class="fas fa-arrow-circle-up fa-lg"></i>
</div>
</div>
<div class="row">
<div class="col">
<h1 dmx-text="variableTotalCustomerDebtVariable.value"></h1>
</div>
</div>
<div class="row">
<div class="col">
<h4 dmx-text="trans.data.totalDebt[lang.value]">{{trans.data.totalOrders[lang.value]}}</h4>
</div>
</div>
</div><div class="bg-info text-center mt-2 me-2 pt-4 pb-4 ps-4 pe-4 col" id="totalDeposits" style="background: #ff2afa !important;"><div class="row">
<div class="col">
<i class="fas fa-piggy-bank fa-lg"></i>
</div>
</div>
<div class="row">
<div class="col">
<h1 dmx-text="(list_customer_transactions_amounts.data.custom_list_transaction_amounts[0].Deposits).toNumber().formatNumber('0',',',',').default(0)"></h1>
</div>
</div>
<div class="row">
<div class="col">

<h4 dmx-text="trans.data.totalDeposits[lang.value]"></h4></div>
</div></div>

<div id="totalSettlements" class="bg-info text-center mt-2 me-2 pt-4 pb-4 ps-4 pe-4 col" style="background: #07b853 !important;"><div class="row">
<div class="col">
<i class="fas fa-arrow-circle-down fa-lg"></i>
</div>
</div>
<div class="row">
<div class="col">
<h1 dmx-text="list_customer_transactions_amounts.data.custom_list_transaction_amounts[0].Settlements.toNumber().formatNumber('0', ',', ',').default(0)"></h1>
</div>
</div>
<div class="row">
<div class="col">
<h4>{{trans.data.totalSettlements[lang.value]}}</h4>
</div>
</div></div>
<div id="totalOrders4" class="bg-info text-center mt-2 me-2 pt-4 pb-4 ps-4 pe-4 col" style="background: #606370 !important;">
<div class="row">
<div class="col">
<i class="fas fa-clipboard-list fa-lg"></i>
</div>
</div>
<div class="row">
<div class="col">
<h1 dmx-text="list_customer_orders.data.query_list_customer_orders.data.count().formatNumber('0',',',',').default(0)">{{trans.data.totalOrders[lang.value]}}</h1>
</div>
</div>
<div class="row">
<div class="col">

<h4 dmx-text="trans.data.orders[lang.value]"></h4></div>
</div>
</div>
<div id="totalCoverageDebt" class="bg-info text-center mt-2 me-2 pt-4 pb-4 ps-4 pe-4 col" style="background: #ff8f2b !important;">
<div class="row">
<div class="col">
<i class="fas fa-people-arrows fa-lg"></i>
</div>
</div>
<div class="row">
<div class="col">
<h1 dmx-text="variableTotalCoverageDebt.value.default(0)">{{trans.data.totalOrders[lang.value]}}</h1>
</div>
</div>
<div class="row">
<div class="col">

<h4 dmx-text="trans.data.totalCoverage[lang.value]"></h4></div>
</div>
</div>
<div id="totalCovered" class="text-center mt-2 me-2 pt-4 pb-4 ps-4 pe-4 col" style="background: #5e1011 !important;" dmx-hide="(read_customer.data.query_read_customer.customer_class == 'standard')">
<div class="row">
<div class="col">
<i class="fas fa-arrow-circle-up fa-lg"></i>
</div>
</div>
<div class="row">
<div class="col">
<h1 dmx-text="variableTotalCovered.value.default(0)">{{trans.data.totalOrders[lang.value]}}</h1>
</div>
</div>
<div class="row">
<div class="col">

<h4 dmx-text="trans.data.totalCovered[lang.value]"></h4></div>
</div>
</div>
</div></div>
<div class="mt-3 col-lg-6">
<div class="row">
<div class="col">
<dmx-chart id="chart1" responsive="true" dmx-bind:data="list_customer_transactions.data.query" label-x="list_customer_transactions.data.query[0].transaction_date" dataset-1:value="transaction_amount" smooth="true" thickness="3" height="350" colors="colors9"></dmx-chart>
</div>
</div>
<div class="row">
<div class="col">
</div>
</div>
</div></div>

</div>
              <div class="tab-pane fade" id="navTabs1_1" role="tabpanel">
                <div class="row mt-2">
                  <div class="col">
                    <div class="row justify-content-sm-between justify-content-md-between justify-content-lg-between justify-content-xl-between justify-content-xxl-between mt-2 justify-content-between">
                      <div class="col-lg-3 col-12 col-sm d-flex flex-sm-wrap col-sm-12"><input id="customerorderfilter" name="customerorderfilter" type="text" class="form-control mb-2 form-control-sm" dmx-bind:placeholder="trans.data.search[lang.value]+'  '" style="background: #242424 !important;"></div>

                      <div class="d-flex flex-sm-wrap col-md-5 justify-content-lg-end col-xl-6 justify-content-xl-end justify-content-xxl-end flex-wrap col-sm col-lg flex-lg-wrap flex-xl-wrap flex-xxl-wrap col">
<ul class="pagination" dmx-populate="list_customer_orders.data.query_list_customer_orders" dmx-state="listCustomerOrders" dmx-offset="customerOrdersOffset" dmx-generator="bs5paging">
  <li class="page-item" dmx-class:disabled="list_customer_orders.data.query_list_customer_orders.page.current == 1" aria-label="First">
    <a href="javascript:void(0)" class="page-link" dmx-on:click="listCustomerOrders.set('customerOrdersOffset',list_customer_orders.data.query_list_customer_orders.page.offset.first)"><span aria-hidden="true">&lsaquo;&lsaquo;</span></a>
  </li>
  <li class="page-item" dmx-class:disabled="list_customer_orders.data.query_list_customer_orders.page.current == 1" aria-label="Previous">
    <a href="javascript:void(0)" class="page-link" dmx-on:click="listCustomerOrders.set('customerOrdersOffset',list_customer_orders.data.query_list_customer_orders.page.offset.prev)"><span aria-hidden="true">&lsaquo;</span></a>
  </li>
  <li class="page-item" dmx-class:active="title == list_customer_orders.data.query_list_customer_orders.page.current" dmx-class:disabled="!active" dmx-repeat="list_customer_orders.data.query_list_customer_orders.getServerConnectPagination(2,1,'...')">
    <a href="javascript:void(0)" class="page-link" dmx-on:click="listCustomerOrders.set('customerOrdersOffset',(page-1)*list_customer_orders.data.query_list_customer_orders.limit)">{{title}}</a>
  </li>
  <li class="page-item" dmx-class:disabled="list_customer_orders.data.query_list_customer_orders.page.current ==  list_customer_orders.data.query_list_customer_orders.page.total" aria-label="Next">
    <a href="javascript:void(0)" class="page-link" dmx-on:click="listCustomerOrders.set('customerOrdersOffset',list_customer_orders.data.query_list_customer_orders.page.offset.next)"><span aria-hidden="true">&rsaquo;</span></a>
  </li>
  <li class="page-item" dmx-class:disabled="list_customer_orders.data.query_list_customer_orders.page.current ==  list_customer_orders.data.query_list_customer_orders.page.total" aria-label="Last">
    <a href="javascript:void(0)" class="page-link" dmx-on:click="listCustomerOrders.set('customerOrdersOffset',list_customer_orders.data.query_list_customer_orders.page.offset.last)"><span aria-hidden="true">&rsaquo;&rsaquo;</span></a>
  </li>
</ul>
                      </div>
                      <div class="col-lg-1 col-xl-1 col-md-2 col-sm-2 offset-lg-1 col-3"><select id="c_order_sort_limit" class="form-select" name="c_order_sort_limit" dmx-on:updated="list_customer_orders.load({customer_id: session_variables.data.current_customer, offset: listCustomerOrders.data.customerOrdersOffset, limit: c_order_sort_limit.value})">
                          <option value="5">5</option>
                          <option selected="" value="25">25</option>
                          <option value="50">50</option>
                          <option value="100">100</option>
                          <option value="''">{{trans.data.all[lang.value]}}</option>
                        </select></div>
                    </div>
                    <div class="table-responsive">
                      <table class="table table-hover table-sm">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>{{trans.data.dateTime[lang.value]}}</th>
                            <th>{{trans.data.waiter[lang.value]}}</th>
                            <th>{{trans.data.notes[lang.value]}}</th>
                            <th>{{trans.data.service[lang.value]}}</th>
<th class="text-center">{{trans.data.status[lang.value]}}</th>
<th class="text-center">{{trans.data.coverageStatus[lang.value]}}</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_customer_orders.data.query_list_customer_orders.data" id="tableRepeat3">
                          <tr>
                            <td dmx-text="order_id"></td>
                            <td dmx-text="order_time"></td>
                            <td dmx-text="user_username"></td>
                            <td dmx-text="order_notes"></td>
                            <td dmx-text="service_name"></td>
<td class="text-center">
<button id="btn11" class="btn w-100 fw-bolder" dmx-text="trans.data.getValueOrKey(order_status)[lang.value]" dmx-class:paid="(order_status)=='Paid'" dmx-class:pending="(order_status)=='Pending'" dmx-class:ordered="(order_status)=='Ordered'">Button</button>
</td>
<td class="text-center">
<button id="btn25" class="btn w-100 fw-bolder" dmx-text="trans.data.getValueOrKey(coverage_payment_status)[lang.value]" dmx-class:paid="(coverage_payment_status)=='Paid'" dmx-class:pending="(coverage_payment_status)=='Pending'" dmx-class:ordered="(coverage_payment_status)=='Ordered'" dmx-hide="(coverage_partner == NULL)">Button</button>
</td>
                            <td>
                              <button id="btn8" class="btn text-light" data-bs-toggle="modal" data-bs-target="#customerOrderModal" dmx-on:click="session_variables.set('current_order',order_id);list_order_items.load({order_id: order_id});readCustomerOrder.load({order_id: order_id});list_customer_transactions_order.load({order_id: order_id});list_customer_transactions_order_totals.load({order_id: order_id});list_order_items_deleted.load({order_id: order_id})" dmx-bind:value="order_id"><i class="fas fa-expand-alt fa-lg"></i>
                              </button>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="row"></div>
              </div>
<div class="tab-pane fade" id="navTabs1_8" role="tabpanel" dmx-hide="(read_customer.data.query_read_customer.customer_class == 'standard')">
                <div class="row mt-2">
                  <div class="col">
                    <div class="row justify-content-sm-between justify-content-md-between justify-content-lg-between justify-content-xl-between justify-content-xxl-between mt-2 justify-content-between">
                      <div class="col-lg-3 col-12 col-sm d-flex flex-sm-wrap col-sm-12"><input id="customerorderfilter2" name="customerorderfilter2" type="text" class="form-control mb-2 form-control-sm" dmx-bind:placeholder="trans.data.search[lang.value]+'  '" style="background: #242424 !important;"></div>

                      <div class="d-flex flex-sm-wrap col-md-5 justify-content-lg-end col-xl-6 justify-content-xl-end justify-content-xxl-end flex-wrap col-sm col-lg flex-lg-wrap flex-xl-wrap flex-xxl-wrap col">
<ul class="pagination" dmx-populate="list_customer_covered_orders.data.query_list_customer_covered_orders" dmx-state="listCustomerOrders" dmx-offset="offset" dmx-generator="bs5paging">
  <li class="page-item" dmx-class:disabled="list_customer_covered_orders.data.query_list_customer_covered_orders.page.current == 1" aria-label="First">
    <a href="javascript:void(0)" class="page-link" dmx-on:click="listCustomerCoveredOrders.set('offset',list_customer_covered_orders.data.query_list_customer_covered_orders.page.offset.first)"><span aria-hidden="true">&lsaquo;&lsaquo;</span></a>
  </li>
  <li class="page-item" dmx-class:disabled="list_customer_covered_orders.data.query_list_customer_covered_orders.page.current == 1" aria-label="Previous">
    <a href="javascript:void(0)" class="page-link" dmx-on:click="listCustomerCoveredOrders.set('offset',list_customer_covered_orders.data.query_list_customer_covered_orders.page.offset.prev)"><span aria-hidden="true">&lsaquo;</span></a>
  </li>
  <li class="page-item" dmx-class:active="title == list_customer_covered_orders.data.query_list_customer_covered_orders.page.current" dmx-class:disabled="!active" dmx-repeat="list_customer_covered_orders.data.query_list_customer_covered_orders.getServerConnectPagination(2,1,'...')">
    <a href="javascript:void(0)" class="page-link" dmx-on:click="listCustomerCoveredOrders.set('offset',(page-1)*list_customer_covered_orders.data.query_list_customer_covered_orders.limit)">{{title}}</a>
  </li>
  <li class="page-item" dmx-class:disabled="list_customer_covered_orders.data.query_list_customer_covered_orders.page.current ==  list_customer_covered_orders.data.query_list_customer_covered_orders.page.total" aria-label="Next">
    <a href="javascript:void(0)" class="page-link" dmx-on:click="listCustomerCoveredOrders.set('offset',list_customer_covered_orders.data.query_list_customer_covered_orders.page.offset.next)"><span aria-hidden="true">&rsaquo;</span></a>
  </li>
  <li class="page-item" dmx-class:disabled="list_customer_covered_orders.data.query_list_customer_covered_orders.page.current ==  list_customer_covered_orders.data.query_list_customer_covered_orders.page.total" aria-label="Last">
    <a href="javascript:void(0)" class="page-link" dmx-on:click="listCustomerCoveredOrders.set('offset',list_customer_covered_orders.data.query_list_customer_covered_orders.page.offset.last)"><span aria-hidden="true">&rsaquo;&rsaquo;</span></a>
  </li>
</ul>
                      </div>
                      <div class="col-lg-1 col-xl-1 col-md-2 col-sm-2 offset-lg-1 col-3"><select id="c_order_sort_limit2" class="form-select" name="c_order_sort_limit2" dmx-on:changed="list_customer_covered_orders.load({customer_id: session_variables.data.current_customer, offset: listCustomerCoveredOrders.data.offset, limit: c_order_sort_limit.value});list_customer_covered_orders.load({customer_id: session_variables.data.current_customer, offset: listCustomerCoveredOrders.data.offset, limit: c_order_sort_limit2.value})">
                          <option value="5">5</option>
                          <option selected="" value="25">25</option>
                          <option value="50">50</option>
                          <option value="100">100</option>
                          <option value="''">{{trans.data.all[lang.value]}}</option>
                        </select></div>
                    </div>
                    <div class="table-responsive">
                      <table class="table table-hover table-sm">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>{{trans.data.dateTime[lang.value]}}</th>
                            <th>{{trans.data.waiter[lang.value]}}</th>
                            <th>{{trans.data.notes[lang.value]}}</th>
                            <th>{{trans.data.service[lang.value]}}</th>
<th class="text-center">{{trans.data.status[lang.value]}}</th>
<th class="text-center">{{trans.data.coverageStatus[lang.value]}}</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_customer_covered_orders.data.query_list_customer_covered_orders.data" id="tableRepeat6">
                          <tr>
                            <td dmx-text="order_id"></td>
                            <td dmx-text="order_time"></td>
                            <td dmx-text="user_username"></td>
                            <td dmx-text="order_notes"></td>
                            <td dmx-text="service_name"></td>
<td class="text-center">
<button id="btn26" class="btn w-100 fw-bolder" dmx-text="trans.data.getValueOrKey(order_status)[lang.value]" dmx-class:paid="(order_status)=='Paid'" dmx-class:pending="(order_status)=='Pending'" dmx-class:ordered="(order_status)=='Ordered'">Button</button>
</td>
<td class="text-center">
<button id="btn26" class="btn w-100 fw-bolder" dmx-text="trans.data.getValueOrKey(coverage_payment_status)[lang.value]" dmx-class:paid="(coverage_payment_status)=='Paid'" dmx-class:pending="(coverage_payment_status)=='Pending'" dmx-class:ordered="(coverage_payment_status)=='Ordered'" dmx-hide="(coverage_partner == NULL)">Button</button>
</td>
                            <td>
                              <button id="btn26" class="btn text-light" data-bs-toggle="modal" data-bs-target="#customerCoverageModal" dmx-on:click="session_variables.set('current_order',order_id);list_order_items.load({order_id: order_id});readCustomerOrder.load({order_id: order_id});list_customer_transactions_order.load({order_id: order_id});list_customer_transactions_order_totals.load({order_id: order_id})" dmx-bind:value="order_id"><i class="fas fa-expand-alt fa-lg"></i>
                              </button>
                            </td>
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
                  <form id="createCustomerTransaction" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_customer_cash_transactions/create_transaction.php" dmx-on:success="notifies1.success('Sucess!');createCustomerTransaction.reset();list_customer_transactions.load({customer_id: read_customer.data.query_read_customer.customer_id});list_customer_transactions_amounts.load({customer_id: session_variables.data.current_customer});list_customer_orders_totals.load({customer_id: session_variables.data.current_customer})">
                    <div class="row">
                      <div class="col visually-hidden"><input id="customerId" name="customer_id" type="text" class="form-control visually-hidden" dmx-bind:value="read_customer.data.query_read_customer.customer_id"></div>
                      <div class="col visually-hidden"><input id="userApproved" name="user_approved_id" type="text" class="form-control visually-hidden" dmx-bind:value="session_variables.data.user_id"></div>
                      <div class="col-auto col-8 mb-2 col-sm-auto col-md-auto"><input id="transactionAmount1" name="transaction_amount" type="number" class="form-control ms-2" dmx-bind:placeholder="trans.data.amount[lang.value]"></div>
                      <div class="col-auto mb-2 col-sm-auto col-md-auto"><input id="transactionDate1" name="transaction_date" type="datetime-local" class="form-control ms-2" dmx-bind:value="dateTime.datetime"></div>
                      <div class="col-auto mb-2 col-sm-auto col-md-auto col-9"><select id="transactionType1" class="form-select ms-2" name="transaction_type">
                        <option value="Deposit">{{trans.data.deposit[lang.value]}}</option><option value="Payment">{{trans.data.payment[lang.value]}}</option></select></div>
                      <div class="col-auto mb-2 col-sm-auto col-md-auto"><select id="transactionPaymentMethod1" class="form-select ms-2" name="transaction_payment_method" dmx-bind:options="payment_methods.data.query" optiontext="payment_method_name" optionvalue="payment_method_id">
                          <option value="">----</option>
                        </select></div>
                      <div class="mb-2 col-sm-auto col-md-auto col-auto offset-0"><button id="btn3" class="btn ms-2 btn-success" type="submit">
                          <i class="fas fa-check"></i>
                        </button></div>
                    </div>







                  </form>
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
                            <th>{{trans.data.concerned[lang.value]}}</th>
                            <th>{{trans.data.dateTime[lang.value]}}</th>
                            <th>{{trans.data.date[lang.value]}}</th>
                          </tr>
                        </thead>
                        <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_customer_transactions.data.query" id="tableRepeat2">
                          <tr>
                            <td dmx-text="customer_transaction_id"></td>
                            <td dmx-text="transaction_amount.formatNumber('0', ',', ',')"></td>
                            <td dmx-text="trans.data.getValueOrKey(transaction_type)[lang.value]"></td>
                            <td dmx-text="transaction_order"></td>
                            <td dmx-text="user_username"></td>
                            <td dmx-text="transaction_date"></td>
                            <td>
<div class="row" is="dmx-if" id="conditional6" dmx-bind:condition="(profile_privileges.data.profile_privileges[0].delete_order == 'Yes')"><form id="deleteTransaction" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_customer_cash_transactions/delete_transaction.php" dmx-on:success="list_customer_transactions.load({customer_id: session_variables.data.current_customer});notifies1.success('Success!')" onsubmit=" return confirm('CONFIRM DELETE?');">
                                <input id="customerTransactionId" name="customer_transaction_id" type="text" class="form-control visually-hidden" dmx-bind:value="customer_transaction_id">
                                <button id="btn4" class="btn text-danger" type="submit"><i class="far fa-trash-alt"></i>
                                </button>
                              </form></div>
                              

                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="navTabs1_6" role="tabpanel">
                <div class="row mt-2">
                  <div class="col">
                    <div class="row justify-content-sm-between justify-content-md-between justify-content-lg-between justify-content-xl-between justify-content-xxl-between mt-2 justify-content-between">
                      <div class="col-lg-3 col-12 col-sm d-flex flex-sm-wrap col-sm-12"><input id="customerorderfilter1" name="customerorderfilter1" type="text" class="form-control mb-2 form-control-sm" dmx-bind:placeholder="trans.data.search[lang.value]+'  '" style="background: #242424 !important;"></div>

                      <div class="d-flex flex-sm-wrap col-md-5 justify-content-lg-end col-xl-6 justify-content-xl-end justify-content-xxl-end flex-wrap col-sm col-lg flex-lg-wrap flex-xl-wrap flex-xxl-wrap col">
<ul class="pagination" dmx-populate="list_customer_orders.data.query_list_customer_orders" dmx-state="listCustomerOrders" dmx-offset="offset" dmx-generator="bs5paging">
  <li class="page-item" dmx-class:disabled="list_customer_orders.data.query_list_customer_orders.page.current == 1" aria-label="First">
    <a href="javascript:void(0)" class="page-link" dmx-on:click="listCustomerOrders.set('offset',list_customer_orders.data.query_list_customer_orders.page.offset.first)"><span aria-hidden="true">‹‹</span></a>
  </li>
  <li class="page-item" dmx-class:disabled="list_customer_orders.data.query_list_customer_orders.page.current == 1" aria-label="Previous">
    <a href="javascript:void(0)" class="page-link" dmx-on:click="listCustomerOrders.set('offset',list_customer_orders.data.query_list_customer_orders.page.offset.prev)"><span aria-hidden="true">‹</span></a>
  </li>
  <li class="page-item" dmx-class:active="title == list_customer_orders.data.query_list_customer_orders.page.current" dmx-class:disabled="!active" dmx-repeat="list_customer_orders.data.query_list_customer_orders.getServerConnectPagination(2,1,'...')">
    <a href="javascript:void(0)" class="page-link" dmx-on:click="listCustomerOrders.set('offset',(page-1)*list_customer_orders.data.query_list_customer_orders.limit);list_customer_orders.load({customer_id: session_variables.data.current_customer, offset: listCustomerOrders.data.offset, limit: c_order_sort_limit.value})">{{title}}</a>
  </li>
  <li class="page-item" dmx-class:disabled="list_customer_orders.data.query_list_customer_orders.page.current ==  list_customer_orders.data.query_list_customer_orders.page.total" aria-label="Next">
    <a href="javascript:void(0)" class="page-link" dmx-on:click="listCustomerOrders.set('offset',list_customer_orders.data.query_list_customer_orders.page.offset.next)"><span aria-hidden="true">›</span></a>
  </li>
  <li class="page-item" dmx-class:disabled="list_customer_orders.data.query_list_customer_orders.page.current ==  list_customer_orders.data.query_list_customer_orders.page.total" aria-label="Last">
    <a href="javascript:void(0)" class="page-link" dmx-on:click="listCustomerOrders.set('offset',list_customer_orders.data.query_list_customer_orders.page.offset.last)"><span aria-hidden="true">››</span></a>
  </li>
</ul>
                      </div>
                      <div class="col-lg-1 col-xl-1 col-md-2 col-sm-2 offset-lg-1 col-3"><select id="c_order_sort_limit1" class="form-select" name="c_order_sort_limit1" dmx-on:changed="list_customer_orders.load({customer_id: session_variables.data.current_customer, offset: listCustomerOrders.data.offset, limit: c_order_sort_limit.value})">
                          <option value="5">5</option>
                          <option selected="" value="25">25</option>
                          <option value="50">50</option>
                          <option value="100">100</option>
                          <option value="''">{{trans.data.all[lang.value]}}</option>
                        </select></div>
                    </div>
                    <div class="table-responsive">
<table class="table table-hover table-sm">
  <thead>
    <tr>
      <th>#</th>
      <th>{{trans.data.dateTime[lang.value]}}</th>
      <th>{{trans.data.attention[lang.value]}}</th>
<th>{{trans.data.note[lang.value]}}</th>
      <th></th>
    </tr>
  </thead>
  <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_customer_data_reading_sessions.data.query_list_data_reading_sessions" id="tableDataReadingSession">
    <tr>
      <td dmx-text="data_reading_session_id"></td>
      <td dmx-text="data_reading_session_date"></td>
      <td dmx-text="user_username"></td>
      <td dmx-text="data_reading_session_notes"></td>
<td>
<button id="btnDataReadingSession" class="btn" dmx-bind:value="data_reading_session_id" data-bs-toggle="modal" data-bs-target="#customerDataReadingSessionModal" dmx-on:click="session_variables.set('current_data_reading_session',data_reading_session_id);read_customer_data_reading_sessions.load({data_reading_session_id: data_reading_session_id});list_customer_data_field_readings.load({data_reading_session_id: data_reading_session_id})"><i class="fas fa-expand-alt fa-lg"></i>
</button>
</td>
    </tr>
  </tbody>
</table>
</div>
                  </div>
                </div>
                <div class="row"></div>
              </div><div class="tab-pane fade" id="navTabs1_3" role="tabpanel">
                <div class="row mt-2">
                  <div class="col d-flex flex-row-reverse"></div>
                </div>
                <div class="row">
                  <div class="col">
                    <h1 class="text-warning">{{read_item_user.data.query.user_username}}</h1>
                  </div>
                </div>
                <div class="row">
                  <div class="pt-2 pb-2 col-xl-4 col-lg-6 col-12 text-sm-center text-center col-md-6 text-md-center"><img dmx-bind:src="'/servo/uploads/customer_pictures/'+read_customer.data.query_read_customer.customer_picture" class="img-fluid rounded-circle" width="45%" dmx-hide="(read_customer.data.query_read_customer.customer_picture == null)" loading="lazy" height="45%">
                    <img class="rounded-circle img-fluid" width="45%" src="uploads/servo_no_image.jpg" dmx-show="(read_customer.data.query_read_customer.customer_picture == null)" height="45%">
                    <div class="row">
                      <div class="col" is="dmx-if" id="conditional5" dmx-bind:condition="(profile_privileges.data.profile_privileges[0].edit_customer == 'Yes')">
                        <form id="deleteCustomerPicture" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_customers/delete_customer_picture.php" dmx-on:success="notifies1.success('Success!');read_customer.load({customer_id: session_variables.data.current_customer})" dmx-hide="(read_customer.data.query_read_customer.customer_picture == null)">
                          <input id="customer_id_delete" name="customer_id" type="text" class="form-control visually-hidden" dmx-bind:value="read_customer.data.query_read_customer.customer_id"><input id="customer_picture_file_delete" name="customer_picture_file" type="text" class="form-control visually-hidden" dmx-bind:value="read_customer.data.query_read_customer.customer_picture">
                          <input id="customer_picture_ref_delete" name="customer_picture_ref" type="text" class="form-control visually-hidden" dmx-bind:value="NULL">
                          <input id="customer_picture_delete" name="customer_picture" type="text" class="form-control visually-hidden" dmx-bind:value="null">
                          <button id="btn5" class="btn mt-2 text-secondary" type="submit">
                            <i class="fas fa-times fa-2x"></i>
                          </button>
                        </form>

                      </div>
                    </div>
                    <div class="row" id="replacePicture" dmx-show="(read_customer.data.query_read_customer.customer_picture == null)">

                      <div class="col text-xxl-center text-center">
                        <div class="row mt-2">
<div id="conditional3" is="dmx-if" dmx-bind:condition="(profile_privileges.data.profile_privileges[0].edit_customer == 'Yes')"><form id="replacePicture2" class="d-flex" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_customers/replace_customer_picture.php" dmx-on:success="notifies1.success('Success!');read_customer.load({customer_id: session_variables.data.current_customer})"><input id="text4" name="customer_picture" type="text" class="form-control visually-hidden">
                            <input id="text5" name="customer_id" type="text" class="form-control visually-hidden" dmx-bind:value="read_customer.data.query_read_customer.customer_id"><input name="customer_picture_file" type="file" class="form-control" required="" data-rule-maxfiles="1" accept=".jpg, .png">
                            <button id="btn7" class="btn btn-success ms-xxl-2 ms-xl-2 ms-lg-2 ms-md-2 ms-sm-2 ms-2" type="submit" dmx-show="replacePicture.customer_picture_file.value+'!='+null">
                              <i class="fas fa-upload"></i>
                            </button>
                          </form></div>
                          
                        </div>
                      </div>


                    </div>
                  </div>
                  <div class="col">
                    <form is="dmx-serverconnect-form" id="readitem" method="post" action="dmxConnect/api/servo_customers/update_customer.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="read_customer.data.query_read_customer" dmx-on:success="list_customers.load({});list_customers_special.load();notifies1.success('Success!')" dmx-on:error="notifies1.warning('Error!')" dmx-on:submit="">
                      <div class="mb-3 row">
                        <label for="inp_customer_id" class="col-sm-2 col-form-label">{{trans.data.customer[lang.value]}}</label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control" id="inp_customer_id" name="customer_id" dmx-bind:value="read_customer.data.query_read_customer.customer_id" aria-describedby="inp_customer_id_help" readonly="true">
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <label for="inp_customer_first_name1" class="col-sm-2 col-form-label">{{trans.data.name[lang.value]}}</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inp_customer_first_name1" name="customer_first_name" dmx-bind:value="read_customer.data.query_read_customer.customer_first_name" aria-describedby="inp_customer_first_name_help">
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <label for="inp_customer_last_name1" class="col-sm-2 col-form-label">{{trans.data.surname[lang.value]}}</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inp_customer_last_name1" name="customer_last_name" dmx-bind:value="read_customer.data.query_read_customer.customer_last_name" aria-describedby="inp_customer_last_name_help">
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <label for="inp_customer_phone_number1" class="col-sm-2 col-form-label">{{trans.data.phoneNumber[lang.value]}}</label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control" id="inp_customer_phone_number1" name="customer_phone_number" dmx-bind:value="read_customer.data.query_read_customer.customer_phone_number" aria-describedby="inp_customer_phone_number_help">
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <label for="inp_customer_last_name1" class="col-sm-2 col-form-label">{{trans.data.sex[lang.value]}}</label>
                        <div class="col-sm-10">
                          <select id="select63" class="form-select" name="customer_sex" dmx-bind:value="read_customer.data.query_read_customer.customer_sex">
                            <option value="male">{{trans.data.male[lang.value]}}</option>
                            <option value="female">{{trans.data.female[lang.value]}}</option>
                          </select>
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <label for="inp_customer_last_name1" class="col-sm-2 col-form-label">{{trans.data.dob[lang.value]}}</label>
                        <div class="col-sm-10">
                          <input id="date12" name="customer_dob" type="date" is="dmx-date-picker" dmx-bind:value="read_customer.data.query_read_customer.customer_dob">
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <label for="inp_customer_last_name1" class="col-sm-2 col-form-label">{{trans.data.age[lang.value]}}</label>
                        <div class="col-sm-10">
                          <input id="text61" name="customer_age" type="number" class="form-control" dmx-bind:value="read_customer.data.query_read_customer.customer_age" required="" data-msg-required="!">
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <label for="inp_customer_last_name1" class="col-sm-2 col-form-label">{{trans.data.address[lang.value]}}</label>
                        <div class="col-sm-10">
                          <textarea type="text" class="form-control" id="customeraddress2" name="customer_address" aria-describedby="inp_customer_last_name_help" dmx-bind:value="read_customer.data.query_read_customer.customer_address"></textarea>
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <label for="inp_customer_phone_number1" class="col-sm-2 col-form-label">{{trans.data.class[lang.value]}}</label>

                        <div class="col-sm-8">
                          <select id="select61" class="form-select" name="customer_class" dmx-bind:value="read_customer.data.query_read_customer.customer_class" required="" data-msg-required="!">
                            <option value="standard">{{trans.data.standard[lang.value]}}</option>
                            <option value="special">{{trans.data.special[lang.value]}}</option>
                          </select>
                        </div>
                      </div>
                      <div class="row">

                        <label for="inp_customer_phone_number1" class="col-sm-2 col-form-label"><i class="fas fa-portrait fa-2x"></i></label>
                        <div class="mb-3 row">

                          <div class="col-sm-2">&nbsp;</div>
                          
                        <div class="col-sm-10" dmx-bind:condition="(profile_privileges.data.profile_privileges[0].edit_customer == 'Yes')">
                            
<div id="conditional4" is="dmx-if" dmx-bind:condition="(profile_privileges.data.profile_privileges[0].edit_customer == 'Yes')"><button type="submit" class="btn btn-primary" dmx-bind:value="read_customer.data.query_read_customer.Save">Save</button></div>
                          </div>
                  </div>
              </form>

                </div>
              </div>
            </div>
          </div>
        </div>


      </div>
      <div class="modal-footer">
        <div id="conditional2" is="dmx-if" dmx-bind:condition="(profile_privileges.data.profile_privileges[0].delete_customer == 'Yes')"><form id="deleteCustomer" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_customers/delete_customer.php" dmx-on:success="notifies1.success('Success');list_customers.load({});readItemModal.hide()" onsubmit=" return confirm('CONFIRM DELETE?');" dmx-on:error="notifies1.warning('Error!')">

          <input id="text1" name="customer_id" type="hidden" class="form-control" dmx-bind:value="read_customer.data.query_read_customer.customer_id">

          <button id="btn6" class="btn text-danger" type="submit">
            <i class="far fa-trash-alt fa-lg"></i>
          </button>
        </form></div>
      </div>
    </div>
  </div>
</div>
</div>
</main>
<main class="mt-4" id="printInvoice">

<div class="modal readitem" id="printInvoiceModal" is="dmx-bs5-modal" tabindex="-1" dmx-on:hidden-bs-modal="customerOrderModal.show()" style="z-index: 9000000000000; background: white !important; border: none !important;">
  <div class="modal-dialog modal-xl" role="document" style="margin: 0px !important; width: 100% !important; height: 99% !important; max-width: 100% !important; max-height: 99% !important; boder: none !important;">
    <div class="modal-content" style="max-height: 100% !important; height: 100% !important; border: none !important;">
<dmx-value id="InvoiceTitleContent" dmx-bind:value="trans.data.receipt[lang.value]"></dmx-value>
      <div class="modal-header" id="invoiceHead">
<button id="proFormaButton" class="btn text-light btn-outline-light me-2" dmx-on:click="InvoiceTitleContent.setValue(trans.data.proFormaInvoice[lang.value])">{{trans.data.proFormaInvoice[lang.value]}}
</button>
<button id="invoiceButton" class="btn text-light btn-outline-light me-2" dmx-on:click="InvoiceTitleContent.setValue(trans.data.invoice[lang.value])">{{trans.data.invoice[lang.value]}}
</button>
<button id="printInvoiceButton3" class="btn text-light btn-outline-light me-2" dmx-on:click="InvoiceTitleContent.setValue(trans.data.receipt[lang.value])">{{trans.data.receipt[lang.value]}}
</button>
<button id="printInvoiceButton2" class="btn text-light" onclick="window.print()"><i class="fas fa-print fa-lg"></i>
</button>

        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="invoice" style="background: white;">
<div class="container" id="customerInvoiceContent">
<div class="row justify-content-between" id="invoiceHeader">
<div class="col">
<img dmx-bind:src="'uploads/'+companyInfo.data.query.company_logo" width="300">
</div>
<div class="col">
</div>
<div class="col">
<h5 class="text-info fw-bolder" dmx-text="companyInfo.data.query.company_address"></h5>
</div>
</div>
<div class="row justify-content-center row-cols-1" id="receiptNumber">

<div class="col">
<h3 class="text-info fw-bolder text-center" dmx-text="InvoiceTitleContent.value+' : '+readCustomerOrder.data.query.order_id" id="invoiceTitle"></h3>
</div></div>
<div class="row justify-content-center row-cols-1" id="receiptInformation">

<div class="col">
<h5 class="text-info fw-bolder text-start" dmx-text="trans.data.customer[lang.value]+' : '+read_customer.data.query_read_customer.customer_id"></h5>
<h5 class="text-info fw-bolder text-start" dmx-text="trans.data.name[lang.value]+' : '+read_customer.data.query_read_customer.customer_first_name+' '+read_customer.data.query_read_customer.customer_last_name"></h5>
<h5 class="text-info fw-bolder text-start" dmx-text="trans.data.dateTime[lang.value]+' : '+dateTime.datetime"></h5>
<h5 class="text-info fw-bolder text-start" dmx-text="trans.data.user[lang.value]+' : '+list_customer_orders.data.query_list_customer_orders.data[0].user_username"></h5>
</div></div>
<div class="row justify-content-center row-cols-1" id="receiptTable">

<div class="col">
    <div class="table-responsive bg-white" id="ReceiptOrderDetails" style="/* background: white */ /* border-color: white */ color: black !important;">
        <table class="table" style="background: white;">
            <thead style="background: #b0b0b0 !important;">
                <tr style="color: black !important;">
                    <th>{{trans.data.product[lang.value]}}</th>
                    <th>{{trans.data.note[lang.value]}}</th>
                    <th>{{trans.data.quantity[lang.value]}}</th>
                    <th>{{trans.data.price[lang.value]}}</th>
                    <th>{{trans.data.total[lang.value]}}</th>
                </tr>
            </thead>
            <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_order_items.data.query" id="receiptDetails">
                <tr style="color: black !important;" class="fw-bold">
                    <td dmx-text="product_name"></td>
                    <td dmx-text="order_item_notes"></td>
                    <td dmx-text="order_item_quantity.formatNumber('O', ',', ',')">

                    </td>
                    <td dmx-text="order_item_price.formatNumber('O', ',', ',')">

                    </td>
<td dmx-text="(order_item_quantity * order_item_price).formatNumber('O', ',', ',')">

                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div></div>
<div class="row justify-content-end">
<div class="col">
<h5 dmx-text="trans.data.total[lang.value]">Fancy display heading</h5>
</div>
<div class="col">
<h5 dmx-text="">Fancy display heading</h5>
</div>
</div>
<div class="row" style="color: black !important;">
    <dmx-value id="varOrderTotal" dmx-bind:value="(list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`)).formatNumber('0', ',', ',')"></dmx-value>
    <dmx-value id="varOrderPaid" dmx-bind:value="list_customer_transactions_order.data.query.sum(`transaction_amount`)"></dmx-value>
    <dmx-value id="varCustomerTotal" dmx-bind:value="((list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))-((readCustomerOrder.data.query.coverage_percentage /100) * (list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))))"></dmx-value>
    <dmx-value id="varCustomerOwing" dmx-bind:value="(((list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))-((readCustomerOrder.data.query.coverage_percentage /100) * (list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))))- ((list_customer_transactions_order.data.query.sum(`transaction_amount`))))"></dmx-value>
    <div class="col" style="color: black !important;">
        <div class="row row-cols-12 justify-content-start">
            <div class="justify-content-xl-end col-xl-auto col-auto" id="total">
                <h6 class="ms-2 pt-2">{{trans.data.total[lang.value]}}:</h6>
            </div>


            <div class="justify-content-xl-end col-xl-auto offset-xl-0 col-auto rounded-pill rounded-2 align-self-center align-self-xxl-center align-self-xl-center align-self-lg-center align-self-md-center pt-2" id="totalAmount">
                <h6 class="fw-bold text-white">{{(list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`)).formatNumber('0', ',', ',')}}</h6>
            </div>
            
            



            
            
            
            
            
            
            
            

            
            
        </div>
<div class="row"><div class="justify-content-xl-end col-xl-auto offset-0 col-auto" id="owing">
                <h6 class="ms-2 pt-2">{{trans.data.owing[lang.value]}}:</h6>
            </div><div class="justify-content-xl-end col-xl-auto offset-xl-0 col-auto rounded-pill rounded-2 align-self-center align-self-xxl-center align-self-xl-center align-self-lg-center align-self-md-center pt-2" id="owingAmount">
                <h6 class="fw-bold" dmx-text="(((list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))-((readCustomerOrder.data.query.coverage_percentage /100) * (list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))))- ((list_customer_transactions_order.data.query.sum(`transaction_amount`)))).formatNumber('0', ',', ',')">{{list_customer_transactions_order.data.query.sum(`transaction_amount`)}}</h6>
            </div></div>
<div class="row"><div class="justify-content-xl-end col-xl-auto offset-0 col-auto" id="paid">
                <h6 class="ms-2 pt-2">{{trans.data.Paid[lang.value]}}:</h6>
            </div><div class="justify-content-xl-end col-xl-auto offset-xl-0 col-auto rounded-pill rounded-2 align-self-center align-self-xxl-center align-self-xl-center align-self-lg-center align-self-md-center pt-2" id="paidAmount">
                <h6 class="fw-bold" dmx-text="list_customer_transactions_order.data.query.sum(`transaction_amount`).formatNumber('0', ',', ',')"></h6>
            </div></div>
<div class="row"><div class="justify-content-xl-end col-xl-auto col-auto" id="coverageToPay">
                <h6 class="ms-2 pt-2">{{trans.data.coverageTotal[lang.value]}}:</h6>
            </div><div class="justify-content-xl-end col-xl-auto offset-xl-0 col-auto rounded-pill rounded-2 align-self-center align-self-xxl-center align-self-xl-center align-self-lg-center align-self-md-center pt-2" id="coverageToPayAmount">
                <h6 dmx-text="((list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))-(((100 - readCustomerOrder.data.query.coverage_percentage) /100) * (list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`)))).formatNumber('0', ',', ',')" class="fw-bold">{{list_customer_transactions_order.data.query.sum(`transaction_amount`)}}</h6>
            </div></div>
<div class="row"><div class="justify-content-xl-end col-xl-auto col-auto" id="toPay">
                <h6 class="ms-2 pt-2">{{trans.data.customerTotal[lang.value]}}:</h6>
            </div><div class="justify-content-xl-end col-xl-auto offset-xl-0 col-auto rounded-pill rounded-2 align-self-center align-self-xxl-center align-self-xl-center align-self-lg-center align-self-md-center pt-2" id="toPayAmount">
                <h6 class="fw-bold text-white" dmx-text="((list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))-((readCustomerOrder.data.query.coverage_percentage /100) * (list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`)))).formatNumber('0', ',', ',')"></h6>
            </div></div>
<div class="row"><div class="justify-content-xl-end col-xl-auto col-auto" id="coverge">
                <h6 class="ms-2 pt-2">{{trans.data.coverage[lang.value]}}:</h6>
            </div><div class="justify-content-xl-end col-xl-auto offset-xl-0 col-auto rounded-pill rounded-2 align-self-center align-self-xxl-center align-self-xl-center align-self-lg-center align-self-md-center pt-2" id="coverageAmount">
                <h6 class="fw-bold text-white">{{readCustomerOrder.data.query.coverage_percentage}}%</h6>
            </div></div>
<div class="row"><div class="justify-content-xl-end col-xl-auto col-auto" id="discount">
                <h6 class="ms-2 pt-2 text-white">{{trans.data.discount[lang.value]}}:</h6>
            </div><div class="justify-content-xl-end col-xl-auto offset-xl-0 col-auto rounded-pill rounded-2 align-self-center align-self-xxl-center align-self-xl-center align-self-lg-center align-self-md-center pt-2" id="disocuntAmount">
                <h6 class="fw-bold text-white" dmx-text="((list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))-((readCustomerOrder.data.query.order_discount / 100) * (list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`)))).formatNumber('0', ',', ',')"></h6>
            </div></div>
<div class="row"></div>
<div class="row"></div>
    </div>
<div class="col" style="">
        <div class="row row-cols-12 justify-content-start">
            <div class="justify-content-xl-end col-xl-auto col-auto" id="total1"><h6 class="ms-2 pt-2">{{trans.data.total1.lang.value]}}:</h6></div>


            <div class="justify-content-xl-end col-xl-auto offset-xl-0 col-auto rounded-pill rounded-2 align-self-center align-self-xxl-center align-self-xl-center align-self-lg-center align-self-md-center pt-2" id="totalAmount1">
                <h6 class="fw-bold text-white">{{(list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`)).formatNumber('0', ',', ',')}}</h6>
            </div>
            
            



            
            
            
            
            
            
            
            

            
            
        </div>
<div class="row"><div class="justify-content-xl-end col-xl-auto offset-0 col-auto" id="owing1">
                <h6 class="ms-2 pt-2 text-white">{{trans.data.owing[lang.value]}}:</h6>
            </div><div class="justify-content-xl-end col-xl-auto offset-xl-0 col-auto rounded-pill rounded-2 align-self-center align-self-xxl-center align-self-xl-center align-self-lg-center align-self-md-center pt-2" id="owingAmount1">
                <h6 class="fw-bold" dmx-text="(((list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))-((readCustomerOrder.data.query.coverage_percentage /100) * (list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))))- ((list_customer_transactions_order.data.query.sum(`transaction_amount`)))).formatNumber('0', ',', ',')">{{list_customer_transactions_order.data.query.sum(`transaction_amount`)}}</h6>
            </div></div>
<div class="row"><div class="justify-content-xl-end col-xl-auto offset-0 col-auto" id="paid1">
                <h6 class="ms-2 pt-2">{{trans.data.Paid[lang.value]}}:</h6>
            </div><div class="justify-content-xl-end col-xl-auto offset-xl-0 col-auto rounded-pill rounded-2 align-self-center align-self-xxl-center align-self-xl-center align-self-lg-center align-self-md-center pt-2" id="paidAmount1">
                <h6 class="fw-bold" dmx-text="list_customer_transactions_order.data.query.sum(`transaction_amount`).formatNumber('0', ',', ',')"></h6>
            </div></div>
<div class="row"><div class="justify-content-xl-end col-xl-auto col-auto" id="coverageToPay1">
                <h6 class="ms-2 pt-2">{{trans.data.coverageTotal[lang.value]}}:</h6>
            </div><div class="justify-content-xl-end col-xl-auto offset-xl-0 col-auto rounded-pill rounded-2 align-self-center align-self-xxl-center align-self-xl-center align-self-lg-center align-self-md-center pt-2" id="coverageToPayAmount1">
                <h6 dmx-text="((list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))-(((100 - readCustomerOrder.data.query.coverage_percentage) /100) * (list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`)))).formatNumber('0', ',', ',')" class="fw-bold">{{list_customer_transactions_order.data.query.sum(`transaction_amount`)}}</h6>
            </div></div>
<div class="row"><div class="justify-content-xl-end col-xl-auto col-auto" id="toPay1">
                <h6 class="ms-2 pt-2">{{trans.data.customerTotal[lang.value]}}:</h6>
            </div><div class="justify-content-xl-end col-xl-auto offset-xl-0 col-auto rounded-pill rounded-2 align-self-center align-self-xxl-center align-self-xl-center align-self-lg-center align-self-md-center pt-2 h-50" id="toPayAmount1">
                <h6 class="fw-bold text-white" dmx-text="((list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))-((readCustomerOrder.data.query.coverage_percentage /100) * (list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`)))).formatNumber('0', ',', ',')"></h6>
            </div></div>
<div class="row"><div class="justify-content-xl-end col-xl-auto col-auto" id="coverge1">
                <h6 class="ms-2 pt-2">{{trans.data.coverage[lang.value]}}:</h6>
            </div><div class="justify-content-xl-end col-xl-auto offset-xl-0 col-auto rounded-pill rounded-2 align-self-center align-self-xxl-center align-self-xl-center align-self-lg-center align-self-md-center pt-2" id="coverageAmount1">
                <h6 class="fw-bold text-white">{{readCustomerOrder.data.query.coverage_percentage}}%</h6>
            </div></div>
<div class="row"><div class="justify-content-xl-end col-xl-auto col-auto" id="discount1">
                <h6 class="ms-2 pt-2 text-white">{{trans.data.discount[lang.value]}}:</h6>
            </div><div class="justify-content-xl-end col-xl-auto offset-xl-0 col-auto rounded-pill rounded-2 align-self-center align-self-xxl-center align-self-xl-center align-self-lg-center align-self-md-center pt-2" id="disocuntAmount1">
                <h6 class="fw-bold text-white" dmx-text="((list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))-((readCustomerOrder.data.query.order_discount / 100) * (list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`)))).formatNumber('0', ',', ',')"></h6>
            </div></div>
<div class="row"></div>
<div class="row"></div>
    </div>
</div>
</div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>


</div></main>
<main class="mt-4" id="printCoverageInvoice">

<div class="modal readitem" id="printCoverageInvoiceModal" is="dmx-bs5-modal" tabindex="-1" dmx-on:hidden-bs-modal="customerOrderModal.show()" style="z-index: 9000000000000; background: white !important; border: none !important;">
  <div class="modal-dialog modal-xl" role="document" style="margin: 0px !important; width: 100% !important; height: 99% !important; max-width: 100% !important; max-height: 99% !important; boder: none !important;">
    <div class="modal-content" style="max-height: 100% !important; height: 100% !important; border: none !important;">
<dmx-value id="InvoiceTitleContent1" dmx-bind:value="trans.data.receipt[lang.value]"></dmx-value>
      <div class="modal-header" id="invoiceHead1">
<button id="proFormaButton1" class="btn text-light btn-outline-light me-2" dmx-on:click="InvoiceTitleContent.setValue(trans.data.proFormaInvoice[lang.value])">{{trans.data.proFormaInvoice[lang.value]}}
</button>
<button id="invoiceButton1" class="btn text-light btn-outline-light me-2" dmx-on:click="InvoiceTitleContent.setValue(trans.data.invoice[lang.value])">{{trans.data.invoice[lang.value]}}
</button>
<button id="printInvoiceButton1" class="btn text-light btn-outline-light me-2" dmx-on:click="InvoiceTitleContent.setValue(trans.data.receipt[lang.value])">{{trans.data.receipt[lang.value]}}
</button>
<button id="printInvoiceButton2" class="btn text-light" onclick="window.print()"><i class="fas fa-print fa-lg"></i>
</button>

        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="invoice1" style="background: white;">
<div class="container" id="customerInvoiceContent1">
<div class="row justify-content-between" id="invoiceHeader1">
<div class="col">
<img dmx-bind:src="'uploads/'+companyInfo.data.query.company_logo" width="300">
</div>
<div class="col">
</div>
<div class="col">
<h5 class="text-info fw-bolder" dmx-text="companyInfo.data.query.company_address"></h5>
</div>
</div>
<div class="row justify-content-center row-cols-1" id="receiptNumber1">

<div class="col">
<h3 class="text-info fw-bolder text-center" dmx-text="InvoiceTitleContent.value+' : '+readCustomerOrder.data.query.order_id" id="invoiceTitle1"></h3>
</div></div>
<div class="row justify-content-center row-cols-1" id="receiptInformation1">

<div class="col">
<h5 class="text-info fw-bolder text-start" dmx-text="trans.data.customer[lang.value]+' : '+read_customer.data.query_read_customer.customer_id"></h5>
<h5 class="text-info fw-bolder text-start" dmx-text="trans.data.name[lang.value]+' : '+read_customer.data.query_read_customer.customer_first_name+' '+read_customer.data.query_read_customer.customer_last_name"></h5>
<h5 class="text-info fw-bolder text-start" dmx-text="trans.data.dateTime[lang.value]+' : '+dateTime.datetime"></h5>
<h5 class="text-info fw-bolder text-start" dmx-text="trans.data.user[lang.value]+' : '+list_customer_orders.data.query_list_customer_orders.data[0].user_username"></h5>
</div></div>
<div class="row justify-content-center row-cols-1" id="receiptTable1">

<div class="col">
    <div class="table-responsive bg-white" id="ReceiptOrderDetails1" style="/* background: white */ /* border-color: white */ color: black !important;">
        <table class="table" style="background: white;">
            <thead style="background: #b0b0b0 !important;">
                <tr style="color: black !important;">
                    <th>{{trans.data.product[lang.value]}}</th>
                    <th>{{trans.data.note[lang.value]}}</th>
                    <th>{{trans.data.quantity[lang.value]}}</th>
                    <th>{{trans.data.price[lang.value]}}</th>
                    <th>{{trans.data.total[lang.value]}}</th>
                </tr>
            </thead>
            <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_order_items.data.query" id="receiptDetails1">
                <tr style="color: black !important;" class="fw-bold">
                    <td dmx-text="product_name"></td>
                    <td dmx-text="order_item_notes"></td>
                    <td dmx-text="order_item_quantity.formatNumber('O', ',', ',')">

                    </td>
                    <td dmx-text="order_item_price.formatNumber('O', ',', ',')">

                    </td>
<td dmx-text="(order_item_quantity * order_item_price).formatNumber('O', ',', ',')">

                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div></div>
<div class="row justify-content-end">
<div class="col">
<h5 dmx-text="trans.data.total[lang.value]">Fancy display heading</h5>
</div>
<div class="col">
<h5 dmx-text="">Fancy display heading</h5>
</div>
</div>
<div class="row" style="color: black !important;">
    <dmx-value id="varOrderTotal1" dmx-bind:value="(list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`)).formatNumber('0', ',', ',')"></dmx-value>
    <dmx-value id="varOrderPaid1" dmx-bind:value="list_customer_transactions_order.data.query.sum(`transaction_amount`)"></dmx-value>
    <dmx-value id="varCustomerTotal1" dmx-bind:value="((list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))-((readCustomerOrder.data.query.coverage_percentage /100) * (list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))))"></dmx-value>
    <dmx-value id="varCustomerOwing1" dmx-bind:value="(((list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))-((readCustomerOrder.data.query.coverage_percentage /100) * (list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))))- ((list_customer_transactions_order.data.query.sum(`transaction_amount`))))"></dmx-value>
    <div class="col" style="color: black !important;">
        <div class="row row-cols-12 justify-content-start">
            <div class="justify-content-xl-end col-xl-auto col-auto" id="total4">
                <h6 class="ms-2 pt-2">{{trans.data.total[lang.value]}}:</h6>
            </div>


            <div class="justify-content-xl-end col-xl-auto offset-xl-0 col-auto rounded-pill rounded-2 align-self-center align-self-xxl-center align-self-xl-center align-self-lg-center align-self-md-center pt-2" id="totalAmount4">
                <h6 class="fw-bold text-white">{{(list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`)).formatNumber('0', ',', ',')}}</h6>
            </div>
            
            



            
            
            
            
            
            
            
            

            
            
        </div>
<div class="row"><div class="justify-content-xl-end col-xl-auto offset-0 col-auto" id="owing3">
                <h6 class="ms-2 pt-2">{{trans.data.owing[lang.value]}}:</h6>
            </div><div class="justify-content-xl-end col-xl-auto offset-xl-0 col-auto rounded-pill rounded-2 align-self-center align-self-xxl-center align-self-xl-center align-self-lg-center align-self-md-center pt-2" id="owingAmount3">
                <h6 class="fw-bold" dmx-text="(((list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))-((readCustomerOrder.data.query.coverage_percentage /100) * (list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))))- ((list_customer_transactions_order.data.query.sum(`transaction_amount`)))).formatNumber('0', ',', ',')">{{list_customer_transactions_order.data.query.sum(`transaction_amount`)}}</h6>
            </div></div>
<div class="row"><div class="justify-content-xl-end col-xl-auto offset-0 col-auto" id="paid4">
                <h6 class="ms-2 pt-2">{{trans.data.Paid[lang.value]}}:</h6>
            </div><div class="justify-content-xl-end col-xl-auto offset-xl-0 col-auto rounded-pill rounded-2 align-self-center align-self-xxl-center align-self-xl-center align-self-lg-center align-self-md-center pt-2" id="paidAmount4">
                <h6 class="fw-bold" dmx-text="list_customer_transactions_order.data.query.sum(`transaction_amount`).formatNumber('0', ',', ',')"></h6>
            </div></div>
<div class="row"><div class="justify-content-xl-end col-xl-auto col-auto" id="coverageToPay4">
                <h6 class="ms-2 pt-2">{{trans.data.coverageTotal[lang.value]}}:</h6>
            </div><div class="justify-content-xl-end col-xl-auto offset-xl-0 col-auto rounded-pill rounded-2 align-self-center align-self-xxl-center align-self-xl-center align-self-lg-center align-self-md-center pt-2" id="coverageToPayAmount4">
                <h6 dmx-text="((list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))-(((100 - readCustomerOrder.data.query.coverage_percentage) /100) * (list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`)))).formatNumber('0', ',', ',')" class="fw-bold">{{list_customer_transactions_order.data.query.sum(`transaction_amount`)}}</h6>
            </div></div>
<div class="row"><div class="justify-content-xl-end col-xl-auto col-auto" id="toPay3">
                <h6 class="ms-2 pt-2">{{trans.data.customerTotal[lang.value]}}:</h6>
            </div><div class="justify-content-xl-end col-xl-auto offset-xl-0 col-auto rounded-pill rounded-2 align-self-center align-self-xxl-center align-self-xl-center align-self-lg-center align-self-md-center pt-2" id="toPayAmount4">
                <h6 class="fw-bold text-white" dmx-text="((list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))-((readCustomerOrder.data.query.coverage_percentage /100) * (list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`)))).formatNumber('0', ',', ',')"></h6>
            </div></div>
<div class="row"><div class="justify-content-xl-end col-xl-auto col-auto" id="coverge4">
                <h6 class="ms-2 pt-2">{{trans.data.coverage[lang.value]}}:</h6>
            </div><div class="justify-content-xl-end col-xl-auto offset-xl-0 col-auto rounded-pill rounded-2 align-self-center align-self-xxl-center align-self-xl-center align-self-lg-center align-self-md-center pt-2" id="coverageAmount4">
                <h6 class="fw-bold text-white">{{readCustomerOrder.data.query.coverage_percentage}}%</h6>
            </div></div>
<div class="row"><div class="justify-content-xl-end col-xl-auto col-auto" id="discount4">
                <h6 class="ms-2 pt-2 text-white">{{trans.data.discount[lang.value]}}:</h6>
            </div><div class="justify-content-xl-end col-xl-auto offset-xl-0 col-auto rounded-pill rounded-2 align-self-center align-self-xxl-center align-self-xl-center align-self-lg-center align-self-md-center pt-2" id="disocuntAmount4">
                <h6 class="fw-bold text-white" dmx-text="((list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))-((readCustomerOrder.data.query.order_discount / 100) * (list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`)))).formatNumber('0', ',', ',')"></h6>
            </div></div>
<div class="row"></div>
<div class="row"></div>
    </div>
<div class="col" style="">
        <div class="row row-cols-12 justify-content-start">
            <div class="justify-content-xl-end col-xl-auto col-auto" id="total4">
                <h6 class="ms-2 pt-2">{{trans.data.total[lang.value]}}:</h6>
            </div>


            <div class="justify-content-xl-end col-xl-auto offset-xl-0 col-auto rounded-pill rounded-2 align-self-center align-self-xxl-center align-self-xl-center align-self-lg-center align-self-md-center pt-2" id="totalAmount4">
                <h6 class="fw-bold text-white">{{(list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`)).formatNumber('0', ',', ',')}}</h6>
            </div>
            
            



            
            
            
            
            
            
            
            

            
            
        </div>
<div class="row"><div class="justify-content-xl-end col-xl-auto offset-0 col-auto" id="owing3">
                <h6 class="ms-2 pt-2 text-white">{{trans.data.owing[lang.value]}}:</h6>
            </div><div class="justify-content-xl-end col-xl-auto offset-xl-0 col-auto rounded-pill rounded-2 align-self-center align-self-xxl-center align-self-xl-center align-self-lg-center align-self-md-center pt-2" id="owingAmount3">
                <h6 class="fw-bold" dmx-text="(((list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))-((readCustomerOrder.data.query.coverage_percentage /100) * (list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))))- ((list_customer_transactions_order.data.query.sum(`transaction_amount`)))).formatNumber('0', ',', ',')">{{list_customer_transactions_order.data.query.sum(`transaction_amount`)}}</h6>
            </div></div>
<div class="row"><div class="justify-content-xl-end col-xl-auto offset-0 col-auto" id="paid4">
                <h6 class="ms-2 pt-2">{{trans.data.Paid[lang.value]}}:</h6>
            </div><div class="justify-content-xl-end col-xl-auto offset-xl-0 col-auto rounded-pill rounded-2 align-self-center align-self-xxl-center align-self-xl-center align-self-lg-center align-self-md-center pt-2" id="paidAmount4">
                <h6 class="fw-bold" dmx-text="list_customer_transactions_order.data.query.sum(`transaction_amount`).formatNumber('0', ',', ',')"></h6>
            </div></div>
<div class="row"><div class="justify-content-xl-end col-xl-auto col-auto" id="coverageToPay4">
                <h6 class="ms-2 pt-2">{{trans.data.coverageTotal[lang.value]}}:</h6>
            </div><div class="justify-content-xl-end col-xl-auto offset-xl-0 col-auto rounded-pill rounded-2 align-self-center align-self-xxl-center align-self-xl-center align-self-lg-center align-self-md-center pt-2" id="coverageToPayAmount4">
                <h6 dmx-text="((list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))-(((100 - readCustomerOrder.data.query.coverage_percentage) /100) * (list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`)))).formatNumber('0', ',', ',')" class="fw-bold">{{list_customer_transactions_order.data.query.sum(`transaction_amount`)}}</h6>
            </div></div>
<div class="row"><div class="justify-content-xl-end col-xl-auto col-auto" id="toPay3">
                <h6 class="ms-2 pt-2">{{trans.data.customerTotal[lang.value]}}:</h6>
            </div><div class="justify-content-xl-end col-xl-auto offset-xl-0 col-auto rounded-pill rounded-2 align-self-center align-self-xxl-center align-self-xl-center align-self-lg-center align-self-md-center pt-2 h-50" id="toPayAmount4">
                <h6 class="fw-bold text-white" dmx-text="((list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))-((readCustomerOrder.data.query.coverage_percentage /100) * (list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`)))).formatNumber('0', ',', ',')"></h6>
            </div></div>
<div class="row"><div class="justify-content-xl-end col-xl-auto col-auto" id="coverge4">
                <h6 class="ms-2 pt-2">{{trans.data.coverage[lang.value]}}:</h6>
            </div><div class="justify-content-xl-end col-xl-auto offset-xl-0 col-auto rounded-pill rounded-2 align-self-center align-self-xxl-center align-self-xl-center align-self-lg-center align-self-md-center pt-2" id="coverageAmount4">
                <h6 class="fw-bold text-white">{{readCustomerOrder.data.query.coverage_percentage}}%</h6>
            </div></div>
<div class="row"><div class="justify-content-xl-end col-xl-auto col-auto" id="discount4">
                <h6 class="ms-2 pt-2 text-white">{{trans.data.discount[lang.value]}}:</h6>
            </div><div class="justify-content-xl-end col-xl-auto offset-xl-0 col-auto rounded-pill rounded-2 align-self-center align-self-xxl-center align-self-xl-center align-self-lg-center align-self-md-center pt-2" id="disocuntAmount4">
                <h6 class="fw-bold text-white" dmx-text="((list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))-((readCustomerOrder.data.query.order_discount / 100) * (list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`)))).formatNumber('0', ',', ',')"></h6>
            </div></div>
<div class="row"></div>
<div class="row"></div>
    </div>
</div>
</div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>


</div></main>
<?php include 'printTransactionReceipt.php'; ?>
<main id="customerOrder"><div class="modal readitem shadow" id="customerOrderModal" is="dmx-bs5-modal" tabindex="-1" dmx-on:hidden-bs-modal="total_sales_per_waiter.load();updateOrderCashier.reset();readCustomerOrder.load({order_id: session_variables.data.current_order});list_customer_orders.load({}); readItemModal.show();list_customer_transactions_amounts.load({customer_id: session_variables.data.current_customer})">
    <dmx-value id="orderTotal" dmx-bind:value="list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`)"></dmx-value>
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">






                
                
<div class="d-block">
<main><div class="row justify-content-start justify-content-xxl-start justify-content-lg-start justify-content-md-start justify-content-sm-start justify-content-xl-start row-cols-xl-7 rounded-pill">
                    <div class="d-flex col-xl-auto rounded rounded-3 col-auto">
                    <h4 class="text-light">{{trans.data.order[lang.value]}}</h4></div>
<div class="d-flex col-xl-auto rounded rounded-3 col-auto">
                    <h4 class="text-light" dmx-text="readCustomerOrder.data.query.order_id"></h4></div>

                    
                    
                </div></main>
</div><button id="btn13" class="btn float-right text-warning ms-4" data-bs-target="#printInvoiceModal" dmx-on:click="printReceipt.show()" dmx-animate-enter.duration:20000.delay:100="pulse" dmx-class:show-print-2="(read_item_order.data.query.order_status == 'Paid')" data-bs-toggle="modal">
                    <i class="fas fa-receipt fa-2x" style="color: #189aff !important;"></i>
                </button><button id="btn10" class="btn text-success float-right" data-bs-toggle="offcanvas" data-bs-target="#AddProductsToOrderOffCanvas" dmx-on:click="" dmx-hide="(read_item_order.data.query.order_status == 'Paid')" style="color: #ffec66 !important;">
                    <i class="fas fa-plus fa-2x"></i>
                </button>
<form id="close_order" is="dmx-serverconnect-form" method="post" action="dmxConnect/api/servo_orders/close_customer_order.php" dmx-on:success="notifies1.success('Success!');list_customer_orders.load({customer_id: session_variables.data.current_customer, offset: listCustomerOrders.data.offset, limit: c_order_sort_limit.value});list_order_items.load({order_id: session_variables.data.current_order});readCustomerOrder.load({order_id: session_variables.data.current_order})">
<input id="update_order_order_id" name="order_id" type="text" class="form-control visually-hidden" dmx-bind:value="session_variables.data.current_order">
<input id="update_order_user_id" name="servo_users_cashier_id" type="text" class="form-control visually-hidden" dmx-bind:value="session_variables.data.user_id">
<input id="update_order_status" name="order_status" type="text" class="form-control visually-hidden" dmx-bind:value="'Paid'">
<button id="btn18" class="btn float-right text-danger" data-bs-target="#AddProductsToOrderOffCanvas" dmx-hide="(variableCustomerTotalToPay.value !== 0)" style="color: #9bff66 !important;" type="submit" dmx-bind:disabled="(readCustomerOrder.data.query.order_status == 'Paid')">
                    <i class="fas fa-lock fa-2x"></i>
                </button></form>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body">
<div class="offcanvas offcanvas-start" id="AddProductsToOrderOffCanvas" is="dmx-bs5-offcanvas" tabindex="-1" style="width: 99%;">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title">{{trans.data.addProducts[lang.value]}}</h5>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
          <div class="offcanvas-body">
<div class="row">
<div class="col"><input id="searchProducts1" name="text1" type="text" class="form-control mb-1 form-control-lg" dmx-bind:value="searchProducts1.value" dmx-on:changed="load_products.load({service_id: list_user_shift_info.data.query_list_user_shift[0].servo_service_service_id, search: searchProducts1.value})"></div>
<div class="col"><button id="btn17" class="btn btn-outline-warning ms-2 me-2 btn-lg" dmx-on:click="searchProducts1.setValue(null);load_products.load({service_id: list_user_shift_info.data.query_list_user_shift[0].servo_service_service_id})">
<i class="fas fa-backspace"></i>
</button></div>
</div><div class="row scrollable row-cols-xxl-12 mt-2" id="productDisplay">
<div class="col">
<ul class="nav nav-tabs" id="navTabs1_tabs" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="navTabs1_1_1tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_1_1" role="tab" aria-controls="navTabs1_1" aria-selected="true">{{trans.data.simple[lang.value]}}</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="navTabs1_2_2tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_2_2" role="tab" aria-controls="navTabs1_2" aria-selected="false">{{trans.data.grouped[lang.value]}}</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="navTabs1_3_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_3" role="tab" aria-controls="navTabs1_3" aria-selected="false"></a>
  </li>
</ul>
<div class="tab-content" id="navTabs1_1content">
  <div class="tab-pane fade show active" id="navTabs1_1_1" role="tabpanel">
<div class="row mt-md-1 ms-md-1 me-md-1 mt-sm-1 ms-sm-1 me-sm-1 mt-xxl-1 ms-xxl-1 me-xxl-1 mt-xl-1 ms-xl-1 me-xl-1 mt-lg-1 ms-lg-1 me-lg-1 mt-0 ms-1 me-1" style="margin: 2px !important;">
<div class="flex-md-wrap flex-md-row justify-content-md-center rounded align-content-center mt-2 mb-2 ms-1 me-1 pt-3 pb-3 ps-3 pe-3 offset-md-1 col-sm-5 shadow-lg border-dark bg-secondary col-xxl-3 col-xl-3 col-lg-3 col-md-5 col-12" dmx-repeat:repeatproducts="load_products.data.repeat" style="padding-top: 0px !important; margin-top: .5rem !;" id="productRepeats">
<form id="form3" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_order_items/create_order_item.php" dmx-on:success="form3.reset();list_order_items.load({order_id: session_variables.data.current_order});notifies1.success('Success:'+product_name+' Added to Order')" dmx-on:error="notifies1.danger('Error!')">
<div class="row mt-xxl-2">
    <div class="col text-center" style="padding: 0px !important; height: 200px;" dmx-hide="product_picture==null">
        <img dmx-bind:src="'/servo/uploads/product_pictures/'+product_picture" width="100%" height="95%" loading="lazy" style="object-fit: cover;">
    </div>
<div class="col text-center" style="padding: 0px !important; height: 200px;" dmx-hide="product_picture!==null">
<img width="100%" height="95%" loading="lazy" style="object-fit: cover;" src="uploads/servo_no_image2.jpg">
    </div></div><div class="row mt-2">
<div class="col d-flex justify-content-start"><h4 class="text-center fw-bold text-warning">{{product_name}}</h4>
</div>
<div class="col d-flex justify-content-end"><h4 class="text-center text-white">{{product_price}}</h4>
</div></div>


<div class="row justify-content-between mb-2 text-center">
<div class="col-4">
<button id="btn5" class="btn btn-lg btn-secondary text-light shadow" dmx-on:click="form3.inp_order_item_quantity.setValue((inp_order_item_quantity.value.toNumber()-1) )"><i class="fas fa-minus"></i>
</button>
</div>

<div class="col-4 text-center" style="padding: 0px !important;"><input id="inp_order_item_quantity" name="order_item_quantity" type="number" class="form-control mb-sm-1 mb-2 form-control-lg" placeholder="1" min="" data-rule-min="1" data-msg-min="Min. 1" style="width: 100% !important; border: 1px solid #696969 !important; border: none; background-color: transparent !important; color: #a1a1a1 !important;" dmx-bind:value="1"></div>
<div class="col-4">
<button id="btn16" class="btn btn-lg shadow btn-secondary text-light" dmx-on:click="form3.inp_order_item_quantity.setValue((inp_order_item_quantity.value.toNumber()+1) )"><i class="fas fa-plus"></i>
</button>
</div></div><input id="inp_order_time_ordered" name="order_time_ordered" class="form-control mb-sm-1 mb-2 visually-hidden" type="datetime-local" dmx-bind:value="var1.datetime"><input id="inp_order_item_status" name="order_item_status" class="form-control mb-sm-1 mb-2 visually-hidden" value="Ordered"><input id="inp_order_id" name="servo_orders_order_id" type="number" class="form-control mb-sm-1 mb-2 visually-hidden" dmx-bind:value="session_variables.data.current_order"><input id="inp_order_product_id" name="servo_products_product_id" type="number" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="1" dmx-bind:value="product_id"><input id="inp_order_item_price" name="order_item_price" type="number" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="1" dmx-bind:value="product_price">
<input id="inp_order_item_type" name="order_item_type" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="1" dmx-bind:value="'Simple'">
<input id="inp_order_item_user_ordered2" name="servo_users_user_ordered" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="1" dmx-bind:value="session_variables.data.user_id" type="number">

<input id="orderitemDepartment" name="servo_departments_department_id" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="1" dmx-bind:value="sdc_department_id" type="number">
<textarea id="inp_order_notes" class="form-control" name="order_item_notes"></textarea><div class="row row-cols-xxl-7 mt-2 mt-sm-2 mt-md-2 mt-lg-2 mt-xl-2 mt-xxl-2" id="optionsrow">
<div class="col w-25 flex-xxl-wrap justify-content-xxl-start">
<div id="repeatOptions" is="dmx-repeat" dmx-bind:repeat="query_list_options">
<button class="btn mb-xxl-2 me-xxl-2 button-repeat btn-info" dmx-text="category_option_option" dmx-bind:value="category_option_option" dmx-on:click="form3.inp_order_notes.setValue(form3.inp_order_notes.value+' '+optionsButton.value+' ')" id="optionsButton">Button</button></div>



</div>

</div>
<div class="row row-cols-xxl-7 justify-content-between mt-2 mb-2" id="buttons">
<div class="col w-25 flex-xxl-wrap justify-content-xxl-start d-flex justify-content-start">



<button id="btn8" class="add-item-button btn align-self-end btn-lg lh-1 text-muted" dmx-on:click="form3.inp_order_notes.setValue(null)">
<i class="fas fa-undo fa-lg"></i>
</button></div>
<div class="col w-25 flex-xxl-wrap justify-content-xxl-start d-flex justify-content-end">



<button id="btn12" class="add-item-button btn btn-warning align-self-end btn-lg" type="submit">
<i class="fas fa-plus"></i>
</button></div>

</div>
</div></div>

  </div>
  <div class="tab-pane fade" id="navTabs1_2_2" role="tabpanel">
  <div class="row mt-md-1 mt-2"><div class="flex-xxl-wrap border border-secondary col-md-4 mb-sm-2 me-sm-2 col-lg-3 col-xl-3 col-xxl-3 mt-xxl-0 mb-xxl-3 me-xxl-3 pt-xxl-3 pb-xxl-1 ps-xxl-1 pe-xxl-1 mb-1 me-1" dmx-repeat:repeatproductgroups="load_product_groups.data.repeat_list_product_groups">
<form id="form4"></form>
<div class="row mt-2">
<div class="col"><h3 class="text-center text-warning" dmx-text="product_group_name"></h3>
</div>
</div><form id="addGroupedItemsToOrder" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_product_groups/add_grouped_products_to_order.php" dmx-on:success="form3.reset();list_order_items.load({order_id: session_variables.data.current_order});notifies1.success('Success:'+product_name+' Added to Order')">
<input id="text6" name="servo_orders_order_id" type="text" class="form-control visually-hidden" dmx-bind:value="session_variables.data.current_order">
<input id="text7" name="servo_users_user_ordered" type="text" class="form-control visually-hidden" dmx-bind:value="session_variables.data.user_id">
<input id="text8" name="product_group_id" type="text" class="form-control visually-hidden" dmx-bind:value="product_group_id">
<input id="text9" name="order_time_ordered" type="text" class="form-control visually-hidden" dmx-bind:value="dateTime.datetime">


<div class="row row-cols-xxl-7 justify-content-between mt-2 mb-2" id="buttons1">
<div class="col w-25 flex-xxl-wrap justify-content-xxl-start d-flex justify-content-end">



<button id="btn14" class="add-item-button btn btn-warning align-self-end btn-lg" type="submit">
<i class="fas fa-plus"></i>
</button></div>

</div>
</form></div></div></div>
  <div class="tab-pane fade" id="navTabs1_3" role="tabpanel">
  </div>
</div>
</div>


</div>





</div>
                </div>
<div class="row" id="customerOrderHeader">
<dmx-value id="variableOrderTotal" dmx-bind:value="(list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))"></dmx-value>
<dmx-value id="variableOrderPaid" dmx-bind:value="list_customer_transactions_order_totals.data.custom_list_customer_transactions_order_totals[0].Settlements"></dmx-value>
<dmx-value id="variableOrderDiscount" dmx-bind:value="list_order_items.data.query[0].order_discount"></dmx-value>
<dmx-value id="variableOrderCoverage" dmx-bind:value="list_order_items.data.query[0].coverage_percentage"></dmx-value>
<dmx-value id="variableOrderCoverageTotal" dmx-bind:value="((list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))-(((100 - readCustomerOrder.data.query.coverage_percentage) /100) * (list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))))"></dmx-value>
<dmx-value id="variableOrderCoveragePaid" dmx-bind:value="list_customer_transactions_order_totals.data.custom_list_customer_transactions_order_totals[0]['Coverage Settlements']"></dmx-value>
<dmx-value id="variableCustomerTotal" dmx-bind:value="{{(variableOrderTotal.value * ((100 - variableOrderDiscount.value)/100) * ((100 - variableOrderCoverage.value)/100))}}"></dmx-value>
<dmx-value id="variableCustomerTotalToPay" dmx-bind:value="(variableOrderPaid.value - variableCustomerTotal.value)"></dmx-value>
<dmx-value id="variableCustomerOwing" dmx-bind:value="(((list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))-((readCustomerOrder.data.query.coverage_percentage /100) * (list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))))- ((list_customer_transactions_order.data.query.sum(`transaction_amount`))))"></dmx-value>
<div class="col" style="">
  
  <div class="row row-cols-12 justify-content-start" id="orderInfo"><div class="justify-content-xl-end col-xl-auto col-auto" id="total01">
                        <h6 class="ms-2 pt-2">{{trans.data.total[lang.value]}}:</h6>
                    </div>


<div class="justify-content-xl-end col-xl-auto offset-xl-0 col-auto bg-secondary rounded-pill rounded-2 align-self-center align-self-xxl-center align-self-xl-center align-self-lg-center align-self-md-center pt-2" id="totalAmount">
                        <h6 class="text-success fw-bold">{{(list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`)).formatNumber('0', ',', ',')}}</h6>
                    </div>
<div class="justify-content-xl-end col-xl-auto col-auto" id="discount">
                        <h6 class="ms-2 pt-2">{{trans.data.discount[lang.value]}}:</h6>
                    </div><div class="justify-content-xl-end col-xl-auto offset-xl-0 col-auto bg-secondary rounded-pill rounded-2 align-self-center align-self-xxl-center align-self-xl-center align-self-lg-center align-self-md-center pt-2" id="disocuntAmount">
                        <h6 class="text-success fw-bold" dmx-text="((list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))-((readCustomerOrder.data.query.order_discount / 100) * (list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`)))).formatNumber('0', ',', ',')"></h6>
                    </div>



<div class="justify-content-xl-end col-xl-auto col-auto" id="coverge">
                        <h6 class="ms-2 pt-2">{{trans.data.coverage[lang.value]}}:</h6>
                    </div><div class="justify-content-xl-end col-xl-auto offset-xl-0 col-auto bg-secondary rounded-pill rounded-2 align-self-center align-self-xxl-center align-self-xl-center align-self-lg-center align-self-md-center pt-2" id="coverageAmount">
                        <h6 class="text-success fw-bold">{{readCustomerOrder.data.query.coverage_percentage}}%</h6>
                    </div><div class="justify-content-xl-end col-xl-auto col-auto" id="toPay">
                        <h6 class="ms-2 pt-2">{{trans.data.customerTotal[lang.value]}}:</h6>
                    </div><div class="justify-content-xl-end col-xl-auto offset-xl-0 col-auto rounded-pill rounded-2 align-self-center align-self-xxl-center align-self-xl-center align-self-lg-center align-self-md-center pt-2 bg-secondary" id="toPayAmount">
                        <h6 class="fw-bold text-white">{{(variableOrderTotal.value * ((100 - variableOrderDiscount.value)/100) * ((100 - variableOrderCoverage.value)/100)).formatNumber('0',',',',')}}</h6>
                    </div><div class="justify-content-xl-end col-xl-auto offset-0 col-auto" id="paid">
                        <h6 class="ms-2 pt-2">{{trans.data.Paid[lang.value]}}:</h6>
                    </div><div class="justify-content-xl-end col-xl-auto offset-xl-0 col-auto rounded-pill rounded-2 align-self-center align-self-xxl-center align-self-xl-center align-self-lg-center align-self-md-center pt-2 bg-success" id="paidAmount">
                    <h6 class="fw-bold" dmx-text="list_customer_transactions_order_totals.data.custom_list_customer_transactions_order_totals[0].Settlements.toNumber().formatNumber('0', ',', ',').default(0)"></h6></div><div class="justify-content-xl-end col-xl-auto offset-0 col-auto" id="owing">
                        <h6 class="ms-2 pt-2">{{trans.data.owing[lang.value]}}:</h6>
                    </div><div class="justify-content-xl-end col-xl-auto offset-xl-0 col-auto rounded-pill rounded-2 align-self-center align-self-xxl-center align-self-xl-center align-self-lg-center align-self-md-center pt-2 bg-danger" id="owingAmount">
                    <h6 class="fw-bold">{{(variableCustomerTotalToPay.value).formatNumber('0',',',',')}}</h6></div>
<div class="justify-content-xl-end col-xl-auto col-auto fw-bold" id="coverageToPay6">
                        <h6 class="ms-2 pt-2 text-warning fw-bold">{{trans.data.coverageTotal[lang.value]}}:</h6>
                    </div>

<div class="justify-content-xl-end col-xl-auto offset-xl-0 col-auto rounded-pill rounded-2 align-self-center align-self-xxl-center align-self-xl-center align-self-lg-center align-self-md-center pt-2 border-warning bg-transparent text-warning border" id="coverageToPayAmount">
                    <h6 dmx-text="variableOrderCoverageTotal.value.formatNumber('0',',',',').default(0)" class="fw-bold">{{list_customer_transactions_order.data.query.sum(`transaction_amount`)}}</h6></div>
<div class="justify-content-xl-end col-xl-auto col-auto" id="coveragePaid">
                        <h6 class="ms-2 pt-2 text-warning fw-bold">{{trans.data.coveragePaid[lang.value]}}:</h6>
                    </div>
<div class="justify-content-xl-end col-xl-auto offset-xl-0 col-auto rounded-pill rounded-2 align-self-center align-self-xxl-center align-self-xl-center align-self-lg-center align-self-md-center pt-2 text-warning bg-transparent border-warning border" id="coveragePaidAmount">
                    <h6 dmx-text="variableOrderCoveragePaid.value.toNumber().formatNumber('0',',',',').default(0)" class="fw-bold">{{list_customer_transactions_order.data.query.sum(`transaction_amount`)}}</h6></div>
<div class="justify-content-xl-end col-xl-auto col-auto fw-bold" id="coverageOwing">
                        <h6 class="ms-2 pt-2 text-warning fw-bold">{{trans.data.coverageOwing[lang.value]}}:</h6>
                    </div><div class="justify-content-xl-end col-xl-auto offset-xl-0 col-auto rounded-pill rounded-2 align-self-center align-self-xxl-center align-self-xl-center align-self-lg-center align-self-md-center pt-2 bg-warning" id="coverageOwingAmount">
                    <h6 dmx-text="(variableOrderCoveragePaid.value  -variableOrderCoverageTotal.value).formatNumber('0',',',',').default(0)" class="fw-bold">{{list_customer_transactions_order.data.query.sum(`transaction_amount`)}}</h6></div>





</div>
</div>
</div>

                
                
                <div class="row mt-4">
                    <div class="col">
                        <ul class="nav nav-tabs" id="navTabs1_tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active text-light" id="navTabs1_13_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_13" role="tab" aria-controls="navTabs1_1" aria-selected="true">
                                    <i class="fas fa-eye fa-lg"></i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-light" id="navTabs1_23_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_23" role="tab" aria-controls="navTabs1_2" aria-selected="false">
                                    <i class="fas fa-cash-register fa-lg"></i>
                                </a>
                            </li>
<li class="nav-item">
                                <a class="nav-link text-light" id="navTabs1_23_tab1" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_4" role="tab" aria-controls="navTabs1_2" aria-selected="false">
                                    <i class="fas fa-coins fa-lg"></i>
                                </a>
                            </li>
<li class="nav-item">
                                <a class="nav-link text-warning" id="navTabs1_23_tab2" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_5" role="tab" aria-controls="navTabs1_2" aria-selected="false">
                                    <i class="fas fa-people-arrows fa-lg"></i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-light" id="navTabs1_23_tab5" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_10" role="tab" aria-controls="navTabs1_2" aria-selected="false" dmx-on:click="list_order_items_deleted.load({order_id: session_variables.data.current_order})">
                                    <i class="fas fa-trash-alt fa-sm"></i>
                                <button id="btn30" class="btn text-danger fw-bold btn-sm mb-n1" dmx-text="list_order_items_deleted.data.list_order_items_deleted.count()"><span class="badge bg-secondary"></span>
</button></a>
                                
                            </li>
                        </ul>
                        <div class="tab-content" id="navTabs13_content">
                            <div class="tab-pane fade show active" id="navTabs1_13" role="tabpanel">

                                <div class="row">
                                    <div class="col">
        <div class="table-responsive" id="order_details_table" style="">
            <table class="table">
                <thead>
                                                    <tr>
                                                        <th>{{trans.data.product[lang.value]}}</th>
                                                        <th>{{trans.data.dateTime[lang.value]}}</th>
                                                        <th>{{trans.data.status[lang.value]}}</th>
                                                        <th>{{trans.data.note[lang.value]}}</th>
                                                        <th>{{trans.data.quantity[lang.value]}}</th>
                                                        <th>{{trans.data.price[lang.value]}}</th>
                                                        <th>{{trans.data.attention[lang.value]}}</th>
                                                        <th></th>
                                                    </tr>
    </thead>
        <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_order_items.data.query" id="tableRepeat4">
                                                    <tr>
                                                        <td dmx-text="product_name"></td>
                                                        <td dmx-text="order_time_ordered"></td>
                                                        <td dmx-text="trans.data.getValueOrKey(order_item_status)[lang.value]"></td>
                                                        <td dmx-text="order_item_notes"></td>
                                                        <td>

                                                            <form id="editQuantity" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_order_items/update_order_item_quantity.php" dmx-on:success="notifies1.success('Success');list_order_items.load({order_id: session_variables.data.current_order})">
                                                                <div class="row">
                                                                    <div class="col d-flex"><input id="newQuantity" name="order_item_quantity" type="number" class="form-control inline-edit" dmx-bind:value="order_item_quantity" dmx-bind:disabled="(read_item_order.data.query.order_status == 'Paid')" min="" data-rule-min="1" data-msg-min="Min. 1">
                                                                        <input id="editOrderId" name="order_item_id" type="number" class="form-control inline-edit visually-hidden" dmx-bind:value="order_item_id"><button id="btn21" class="btn text-success" data-bs-target="#productInfo" type="submit" dmx-hide="(read_item_order.data.query.order_status == 'Paid')"><i class="fas fa-check"><br></i></button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </td>
                                                        <td>
<form id="editPrice" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_order_items/update_order_item_price.php" dmx-on:success="notifies1.success('Success');list_order_items.load({order_id: session_variables.data.current_order})">
                                                                <div class="row">
                                                                    <div class="col d-flex"><input id="newPrice" name="order_item_price" type="number" class="form-control inline-edit" dmx-bind:value="order_item_price" dmx-bind:disabled="(readCustomerOrder.data.query.order_status == 'Paid')&amp;&amp;(profile_privileges.data.profile_privileges[0].edit_order_item_price == 'No')" min="" data-rule-min="0" data-msg-min="Min. 0">
                                                                        <input id="editOrderItemPrice" name="order_item_id" type="number" class="form-control inline-edit visually-hidden" dmx-bind:value="order_item_id"><button id="btn23" class="btn text-success" data-bs-target="#productInfo" type="submit" dmx-hide="(read_item_order.data.query.order_status == 'Paid')&amp;&amp;(profile_privileges.data.profile_privileges[0].edit_order_item_price == 'No')"><i class="fas fa-check"><br></i></button>
                                                                    </div>
                                                                </div>
                                                            </form>

                                                            
                                                        </td>
                                                        <td dmx-text="user_username">

                                                        </td>
                                                        <td>
<div class="row" is="dmx-if" id="conditional8" dmx-bind:condition="(profile_privileges.data.profile_privileges[0].delete_order_item == 'Yes')"><form id="form2" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_order_items/delete_order_item.php" dmx-on:success="notifies1.success('Success');list_order_items.load({order_id: session_variables.data.current_order})" dmx-class:hidethis="" onsubmit=" return confirm('CONFIRM DELETE?');">
<input id="text22" name="order_item_id" type="text" class="form-control visually-hidden" dmx-bind:value="order_item_id">
<input id="text101" name="order_id" type="text" class="form-control visually-hidden" dmx-bind:value="session_variables.data.current_order">
<input id="text111" name="user_deleted" type="text" class="form-control visually-hidden" dmx-bind:value="list_user_shift_info.data.query_list_user_shift[0].servo_user_user_id">
<input id="text121" name="deleted_product_id" type="text" class="form-control visually-hidden" dmx-bind:value="servo_products_product_id">
<button id="btn212" class="btn text-secondary" data-bs-target="#productInfo" type="submit"><i class="far fa-trash-alt fa-lg"><br></i></button></form></div>

                                                            

                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                                <div class="row" id="orderUpdate">
    <form is="dmx-serverconnect-form" id="updateOrderCashierStandard" method="post" action="dmxConnect/api/servo_orders/update_order_discount_note.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="read_item_order.data.query" dmx-on:success="notifies1.success('Success');list_order_items.load({order_id: session_variables.data.current_order});readCustomerOrder.load({order_id: session_variables.data.current_order})">


                                        <div class="mb-3 row">
                                            <label for="inp_order_notes3" class="col-sm-2 col-form-label">{{trans.data.note[lang.value]}}</label>

                                            <div class="col-sm-10">
                                                <textarea type="textarea" class="form-control" id="inp_order_notes3" name="order_notes" dmx-bind:value="readCustomerOrder.data.query.order_notes" aria-describedby="inp_order_notes_help"></textarea>
                                            </div>
                                        </div><input id="order_id3" name="order_id" class="form-control visually-hidden" dmx-bind:value="readCustomerOrder.data.query.order_id">

                                        <div class="row">
<label for="inp_order_notes3" class="col-sm-2 col-form-label">{{trans.data.discount[lang.value]}}</label><div class="col"><input id="orderDiscount" name="order_discount" class="form-control" dmx-bind:value="readCustomerOrder.data.query.order_discount" required="" type="number" data-msg-required="!" min="" data-rule-min="0" data-msg-min="Min 0!" dmx-bind:max="100">
<input id="orderCustomer" name="order_customer" class="form-control visually-hidden" dmx-bind:value="readCustomerOrder.data.query.order_customer">
</div>
</div><div class="mb-3 row">

    <div class="mb-3 row">
        <div class="col-sm-10 d-flex justify-content-start">
                                                    <button class="btn btn-warning me-md-1 pt-md-2 pb-md-2 ps-md-2 pe-md-2 me-2" dmx-bind:value="read_item_order.data.query.Save" type="submit" dmx-hide="(read_item_order.data.query.order_status == 'Paid')">
                                                        <i class="fas fa-check fa-2x"></i>
                                                    </button>
                        </div>

                                            </div>
                                    
                                </div></form>
                                        


                            </div>

                        </div>
                        
                        <div class="tab-pane fade" id="navTabs1_23" role="tabpanel">
                            <div class="row mt-2 visually-hidden">
                                <form is="dmx-serverconnect-form" id="updateOrderCashier" method="post" action="dmxConnect/api/servo_orders/update_order_ordered_paid.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="read_item_order.data.query" dmx-on:success="notifies1.success('Success');list_orders_all_shift_department.load({current_shift: session_variables.data.current_shift, department_id: list_user_shift_info.data.query_list_user_shift[0].user_shift_department_id});updateOrderCashier.reset();readItemModal.hide()">
                                    <input id="order_id1" name="order_id" class="form-control visually-hidden" dmx-bind:value="session_variables.data.current_order">
                                    <div class="mb-3 row">
                                        <label for="inp_order_amount_tendered" class="col-sm-2 col-form-label">{{trans.data.amountTendered[lang.value]}}</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" id="inp_order_amount_tendered" name="order_amount_tendered" dmx-bind:value="readCustomerOrder.data.query.order_amount_tendered" aria-describedby="inp_order_notes_help" required="" data-msg-required="!" min="" data-msg-min="Min 0" dmx-bind:min="list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`)" dmx-bind:disabled="(readCustomerOrder.data.query.order_status == 'Paid')" data-rule-min="1">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="inp_order_balance" class="col-sm-2 col-form-label">{{trans.data.balance[lang.value]}}</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" id="inp_order_balance" name="order_balance" aria-describedby="inp_order_notes_help" dmx-bind:value="(updateOrderCashier.inp_order_amount_tendered.value - orderTotal.value)" disabled="true" dmx-bind:disabled="(readCustomerOrder.data.query.order_status == 'Paid')">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-10 visually-hidden">
                                            <input type="number" class="form-control" id="inp_order_cashier_id" name="servo_users_cashier_id" aria-describedby="inp_order_notes_help" dmx-bind:value="session_variables.data.user_id">
                                        </div>
                                        <div class="col-sm-10 visually-hidden">
                                            <input class="form-control" id="inp_order_order_status" name="order_status" dmx-bind:value="'Ordered'" aria-describedby="inp_order_notes_help">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="customersearch" class="col-sm-2 col-form-label">{{trans.data.paymentMethod[lang.value]}}</label>
                                        <div class="col-sm-10">




                                            <select id="select2" class="form-select" dmx-bind:options="payment_methods.data.query" optiontext="payment_method_name" optionvalue="payment_method_id" dmx-bind:value="readCustomerOrder.data.query.servo_payment_methods_payment_method" name="servo_payment_methods_payment_method" dmx-bind:disabled="(read_item_order.data.query.order_status == 'Paid')">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">

                                    </div>


                                    <div class="mb-3 row">
                                        <div class="col-sm-2">
                                            &nbsp;</div>
                                        <div class="col-sm-10 d-flex justify-content-start">
                                            <button class="btn btn-success pt-md-2 pb-md-2 ps-md-2 pe-md-2" id="receive_payment" dmx-on:click="updateOrderCashier.inp_order_order_status.setValue('Paid');updateOrderCashier.submit()" dmx-bind:disabled="(read_item_order.data.query.order_status == 'Paid')"><i class="fas fa-hand-holding-usd fa-2x"></i></button>
                                        </div>

                                    </div>
                                </form>
                            </div>
<div class="row mt-2">
                                <form is="dmx-serverconnect-form" id="createOrderTransaction" method="post" action="dmxConnect/api/servo_customer_cash_transactions/create_transaction.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="read_item_order.data.query" dmx-on:success="createOrderTransaction.reset();list_customer_transactions.load({customer_id: session_variables.data.current_customer});list_customer_transactions_order.load({order_id: session_variables.data.current_order});notifies1.success('Success');updateOrderCashier.reset();readItemModal.hide();list_customer_transactions_amounts.load({customer_id: session_variables.data.current_customer});list_customer_orders_totals.load({customer_id: session_variables.data.current_customer});list_customer_transactions_order_totals.load({order_id: session_variables.data.current_order})" dmx-on:error="notifies1.danger('Error!')">
                                    <input id="transactionOrderId" name="transaction_order" class="form-control visually-hidden" dmx-bind:value="session_variables.data.current_order">
<input id="transactionCustomer" name="customer_id" class="form-control visually-hidden" dmx-bind:value="session_variables.data.current_customer">
<input id="transactionDate" name="transaction_date" class="form-control visually-hidden" dmx-bind:value="dateTime.datetime">
<input id="transactionUserApproved" name="user_approved_id" class="form-control visually-hidden" dmx-bind:value="session_variables.data.user_id">
<input id="transactionType" name="transaction_type" class="form-control visually-hidden" dmx-bind:value="'Settlement'">
                                    <div class="mb-3 row">
                                        <label for="transactionAmount1" class="col-sm-2 col-form-label">{{trans.data.total[lang.value]}}</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" id="transactionAmount" name="transaction_amount" aria-describedby="inp_order_notes_help" required="" data-msg-required="!" min="" data-msg-min="Min 0" dmx-bind:min="1" data-rule-min="1" dmx-bind:value="-(variableCustomerTotalToPay.value)" dmx-bind:max="-(variableCustomerTotalToPay.value)" max="" data-msg-max=">Max!">
                                        </div>
                                    </div>
<div class="mb-3 row">
                                        <label for="transactionAmountTendered" class="col-sm-2 col-form-label">{{trans.data.amountTendered[lang.value]}}</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" id="transactionAmountTendered" name="transaction_amount_tendered" aria-describedby="inp_order_notes_help" required="" data-msg-required="!" min="" data-msg-min="Min 0" dmx-bind:min="createOrderTransaction.transactionAmount.value" data-rule-min="1">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="transactinBalance" class="col-sm-2 col-form-label">{{trans.data.balance[lang.value]}}</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" id="transactinBalance" name="transaction_balance" aria-describedby="inp_order_notes_help" dmx-bind:value="(createOrderTransaction.transactionAmountTendered.value - createOrderTransaction.transactionAmount.value)" readonly="true">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="customersearch" class="col-sm-2 col-form-label">{{trans.data.paymentMethod[lang.value]}}</label>
                                        <div class="col-sm-10">




                                            <select id="select1" class="form-select" dmx-bind:options="payment_methods.data.query" optiontext="payment_method_name" optionvalue="payment_method_id" name="transaction_payment_method" dmx-bind:disabled="(read_item_order.data.query.order_status == 'Paid')">
                                            </select>
                                        </div>
                                    </div>


                                    <div class="mb-3 row">
                                        <div class="col-sm-2">
                                            &nbsp;</div>
                                        <div class="col-sm-10 d-flex justify-content-start">
                                            <button class="btn btn-success pt-md-2 pb-md-2 ps-md-2 pe-md-2" id="receive_payment1" dmx-on:click="updateOrderCashier.inp_order_order_status.setValue('Paid');updateOrderCashier.submit()" dmx-bind:disabled="(read_item_order.data.query.order_status == 'Paid')" type="submit"><i class="fas fa-hand-holding-usd fa-2x"></i></button>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>


<div class="tab-pane fade" id="navTabs1_4" role="tabpanel">
                            <div class="row mt-2">
<div class="col">
<div class="table-responsive">
<table class="table table-hover table-sm">
  <thead>
    <tr>
      <th>#</th>
      
      <th>{{trans.data.type[lang.value]}}</th>
      <th>{{trans.data.attention[lang.value]}}</th>
      <th>{{trans.data.paymentMethod[lang.value]}}</th>
      <th>{{trans.data.dateTime[lang.value]}}</th>
      <th>{{trans.data.status[lang.value]}}</th>
      <th>{{trans.data.note[lang.value]}}</th>
      <th>{{trans.data.total[lang.value]}}</th><th>{{trans.data.amountTendered[lang.value]}}</th><th>{{trans.data.balance[lang.value]}}</th>
<th></th>
<th></th>
      
    </tr>
  </thead>
  <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_customer_transactions_order.data.query" id="tableRepeat5">
    <tr>
      <td dmx-text="customer_transaction_id"></td>
      
      <td dmx-text="transaction_type"></td>
      <td dmx-text="user_fname+user_lname"></td>
      <td dmx-text="payment_method_name"></td>
      <td dmx-text="transaction_date"></td>
      <td dmx-text="transaction_status"></td>
      <td dmx-text="transaction_note"></td>
      
      <td dmx-text="transaction_amount.formatNumber('0', ',', ',')"></td><td dmx-text="transaction_amount_tendered.formatNumber('0', ',', ',')"></td>
    <td dmx-text="transaction_balance.formatNumber('0', ',', ',')"></td>
<td>
<button id="btn15" class="btn" data-bs-toggle="modal" data-bs-target="#printTransactionReceiptModal" dmx-on:click="read_customer_transaction.load({customer_cash_transaction_id: customer_transaction_id})"><i class="fas fa-receipt fa-lg"></i>
</button>
</td>
<td>
<form id="deleteOrderTransaction" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_customer_cash_transactions/delete_transaction.php" dmx-on:success="list_customer_transactions_order.load({order_id: readCustomerOrder.data.query.order_id});list_customer_transactions.load({customer_id: session_variables.data.current_customer});list_customer_transactions_order_totals.load({order_id: session_variables.data.current_order})" onsubmit=" return confirm('CONFIRM DELETE?');">
<input id="text3" name="customer_transaction_id" type="text" class="form-control visually-hidden" dmx-bind:value="customer_transaction_id">
<button id="btn9" class="btn text-secondary" type="submit">
<i class="far fa-trash-alt fa-lg"></i>
</button>
</form>
</td></tr>
  </tbody>
</table>
</div>
</div>
                            </div><div class="row mt-2 visually-hidden">
                            </div>

                        </div>
                    <div class="tab-pane fade" id="navTabs1_5" role="tabpanel">
                            <div class="row mt-2 visually-hidden">
                                <form is="dmx-serverconnect-form" id="updateOrderCashier1" method="post" action="dmxConnect/api/servo_orders/update_order_ordered_paid.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="read_item_order.data.query" dmx-on:success="notifies1.success('Success');list_orders_all_shift_department.load({current_shift: session_variables.data.current_shift, department_id: list_user_shift_info.data.query_list_user_shift[0].user_shift_department_id});updateOrderCashier.reset();readItemModal.hide()">
                                    <input id="order_id2" name="order_id1" class="form-control visually-hidden" dmx-bind:value="session_variables.data.current_order">
                                    <div class="mb-3 row">
                                        <label for="inp_order_amount_tendered1" class="col-sm-2 col-form-label">{{trans.data.amountTendered[lang.value]}}</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" id="inp_order_amount_tendered1" name="order_amount_tendered1" dmx-bind:value="readCustomerOrder.data.query.order_amount_tendered" aria-describedby="inp_order_notes_help" required="" data-msg-required="!" min="" data-msg-min="Min 0" dmx-bind:min="list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`)" dmx-bind:disabled="(readCustomerOrder.data.query.order_status == 'Paid')" data-rule-min="1">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="inp_order_balance1" class="col-sm-2 col-form-label">{{trans.data.balance[lang.value]}}</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" id="inp_order_balance1" name="order_balance1" aria-describedby="inp_order_notes_help" dmx-bind:value="(updateOrderCashier.inp_order_amount_tendered.value - orderTotal.value)" disabled="true" dmx-bind:disabled="(readCustomerOrder.data.query.order_status == 'Paid')">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-10 visually-hidden">
                                            <input type="number" class="form-control" id="inp_order_cashier_id1" name="servo_users_cashier_id1" aria-describedby="inp_order_notes_help" dmx-bind:value="session_variables.data.user_id">
                                        </div>
                                        <div class="col-sm-10 visually-hidden">
                                            <input class="form-control" id="inp_order_order_status1" name="order_status1" dmx-bind:value="'Ordered'" aria-describedby="inp_order_notes_help">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="customersearch" class="col-sm-2 col-form-label">{{trans.data.paymentMethod[lang.value]}}</label>
                                        <div class="col-sm-10">




                                            <select id="select3" class="form-select" dmx-bind:options="payment_methods.data.query" optiontext="payment_method_name" optionvalue="payment_method_id" dmx-bind:value="readCustomerOrder.data.query.servo_payment_methods_payment_method" name="servo_payment_methods_payment_method1" dmx-bind:disabled="(read_item_order.data.query.order_status == 'Paid')">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">

                                    </div>


                                    <div class="mb-3 row">
                                        <div class="col-sm-2">
                                            &nbsp;</div>
                                        <div class="col-sm-10 d-flex justify-content-start">
                                            <button class="btn btn-success pt-md-2 pb-md-2 ps-md-2 pe-md-2" id="receive_payment2" dmx-on:click="updateOrderCashier.inp_order_order_status.setValue('Paid');updateOrderCashier.submit()" dmx-bind:disabled="(read_item_order.data.query.order_status == 'Paid')"><i class="fas fa-hand-holding-usd fa-2x"></i></button>
                                        </div>

                                    </div>
                                </form>
                            </div>
<div class="row mt-2">
                                <form is="dmx-serverconnect-form" id="coveragePartner" method="post" action="dmxConnect/api/servo_orders/update_order_coverage_partner.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="read_item_order.data.query" dmx-on:success="notifies1.success('Success');readCustomerOrder.load({order_id: session_variables.data.current_order});list_order_items.load({order_id: session_variables.data.current_order})" dmx-on:error="notifies1.danger('Error!')">
                                    <input id="orderIdCoverage" name="order_id" class="form-control visually-hidden" dmx-bind:value="session_variables.data.current_order">
                                    <div class="mb-3 row">
                                        <label for="transactionAmount1" class="col-sm-2 col-form-label">{{trans.data.coverage[lang.value]}}</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" id="coveragePercentage" name="coverage_percentage" aria-describedby="inp_order_notes_help" required="" data-msg-required="!" dmx-bind:value="readCustomerOrder.data.query.coverage_percentage" min="" data-rule-min="0" data-msg-min="MIn 0!" dmx-bind:max="100">
                                        </div>
                                    </div>
<div class="mb-3 row">
                                        <label for="coveragePartner" class="col-sm-2 col-form-label">{{trans.data.Partner[lang.value]}}</label>
                                        <div class="col-sm-10">
<select id="select4" class="form-select" dmx-bind:options="list_customers_special.data.query_list_customers" optiontext="customer_first_name+' '+customer_last_name+' '+customer_phone_number" optionvalue="customer_id" name="coverage_partner" dmx-bind:value="readCustomerOrder.data.query.coverage_partner">
<option value="%">{{trans.data.partner[lang.value]}}</option></select>
                                        </div>
                                    </div>


                                    <div class="mb-3 row">
                                        <div class="col-sm-10 d-flex justify-content-start">
                                            <button class="btn btn-success pt-md-2 pb-md-2 ps-md-2 pe-md-2" id="receive_payment22" dmx-bind:disabled="(read_item_order.data.query.order_status == 'Paid')" type="submit"><i class="fas fa-check"></i></button>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div><div class="tab-pane fade show active" id="navTabs1_10" role="tabpanel">

                                <div class="row">
                                    <div class="col">
        <div class="table-responsive">
<table class="table table-hover table-sm">
  <thead>
    <tr>
      <th>{{trans.data.product[lang.value]}}</th>
      <th>{{trans.data.dateTime[lang.value]}}</th>
      <th>{{trans.data.user[lang.value]}}</th>
    </tr>
  </thead>
  <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_order_items_deleted.data.list_order_items_deleted" id="tableRepeat9">
    <tr>
      <td dmx-text="product_name"></td>
      <td dmx-text="time_deleted"></td>
      <td dmx-text="user_username"></td>
    </tr>
  </tbody>
</table>
</div>
                                    </div>

                                </div>

                        </div></div>
                </div>




            </div>
            <div class="modal-footer">
                
            </div>
<div class="row text-end" is="dmx-if" id="conditional7" dmx-bind:condition="(profile_privileges.data.profile_privileges[0].delete_order == 'Yes')"><form id="form1" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_orders/delete_order_and_items.php" dmx-on:success="notifies1.success('Success');list_orders_all_shift.load();customerOrderModal.hide();list_customer_orders_totals.load({customer_id: session_variables.data.current_customer});list_customer_transactions_amounts.load({customer_id: session_variables.data.current_customer})" onsubmit=" return confirm('CONFIRM DELETE?');">
                    <input id="text12" name="order_id" type="number" class="form-control visually-hidden" dmx-bind:value="readCustomerOrder.data.query.order_id">

                    <button id="btn16" class="btn text-secondary" type="submit">
                        <i class="far fa-trash-alt fa-lg"></i>
                    </button>
                </form></div>
        </div>
    </div>
</div>

</main>
<main id="customerCoverageOrder"><div class="modal readitem shadow" id="customerCoverageModal" is="dmx-bs5-modal" tabindex="-1" dmx-on:hidden-bs-modal="total_sales_per_waiter.load();updateOrderCashier.reset();readCustomerOrder.load({order_id: session_variables.data.current_order});list_customer_orders.load({}); readItemModal.show()">
    <dmx-value id="orderTotal" dmx-bind:value="list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`)"></dmx-value>
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">






                
                
<div class="d-block">
<main><div class="row justify-content-start justify-content-xxl-start justify-content-lg-start justify-content-md-start justify-content-sm-start justify-content-xl-start row-cols-xl-7 rounded-pill">
                    <div class="d-flex col-xl-auto rounded rounded-3 col-auto">
                    <h4 class="text-light">{{trans.data.coverageOrder[lang.value]}}</h4></div>
<div class="d-flex col-xl-auto rounded rounded-3 col-auto">
                    <h4 class="text-light" dmx-text="readCustomerOrder.data.query.order_id"></h4></div>

                    
                    
                </div></main>
</div><button id="btn27" class="btn float-right text-warning ms-4" data-bs-target="#printCoverageInvoiceModal" dmx-on:click="printReceipt.show()" dmx-animate-enter.duration:20000.delay:100="pulse" dmx-class:show-print-2="(read_item_order.data.query.order_status == 'Paid')" data-bs-toggle="modal">
                    <i class="fas fa-receipt fa-2x" style="color: #189aff !important;"></i>
                </button><button id="btn27" class="btn text-success float-right visually-hidden" data-bs-toggle="offcanvas" data-bs-target="#AddProductsToOrderOffCanvas" dmx-on:click="" dmx-hide="(read_item_order.data.query.order_status == 'Paid')" style="color: #ffec66 !important;">
                    <i class="fas fa-plus fa-2x"></i>
                </button>
<form id="close_order_coverage" is="dmx-serverconnect-form" method="post" action="dmxConnect/api/servo_orders/close_customer_coverage_order.php" dmx-on:success="notifies1.success('Success!');list_customer_orders.load({customer_id: session_variables.data.current_customer, offset: listCustomerOrders.data.offset, limit: c_order_sort_limit.value});list_customer_covered_orders.load({customer_id: session_variables.data.current_customer, offset: listCustomerCoveredOrders.data.offset, limit: c_order_sort_limit2.value})">
<input id="update_coverage_order_order_id" name="order_id" type="text" class="form-control visually-hidden" dmx-bind:value="session_variables.data.current_order">
<input id="update_coverage_order_status" name="coverage_payment_order_status" type="text" class="form-control visually-hidden" dmx-bind:value="'Paid'">
<button id="btn27" class="btn float-right text-danger" data-bs-target="#AddProductsToOrderOffCanvas" dmx-hide="(variableCustomerTotalToPay.value !== 0)" style="color: #9bff66 !important;" type="submit" dmx-bind:disabled="(readCustomerOrder.data.query.coverage_payment_status == 'Paid')">
                    <i class="fas fa-lock fa-2x"></i>
                </button></form>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body">
<div class="offcanvas offcanvas-start" id="AddProductsToOrderOffCanvas1" is="dmx-bs5-offcanvas" tabindex="-1" style="width: 99%;">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title">{{trans.data.addProducts[lang.value]}}</h5>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
          <div class="offcanvas-body">
<div class="row">
<div class="col"><input id="searchProducts2" name="text2" type="text" class="form-control mb-1 form-control-lg" dmx-bind:value="searchProducts1.value" dmx-on:changed="load_products.load({service_id: list_user_shift_info.data.query_list_user_shift[0].servo_service_service_id, search: searchProducts1.value})"></div>
<div class="col"><button id="btn27" class="btn btn-outline-warning ms-2 me-2 btn-lg" dmx-on:click="searchProducts1.setValue(null);load_products.load({service_id: list_user_shift_info.data.query_list_user_shift[0].servo_service_service_id})">
<i class="fas fa-backspace"></i>
</button></div>
</div><div class="row scrollable row-cols-xxl-12 mt-2" id="productDisplay1">
<div class="col">
<ul class="nav nav-tabs" id="navTabs1_tabs2" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="navTabs1_1_1tab1" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_1_1" role="tab" aria-controls="navTabs1_1" aria-selected="true">{{trans.data.simple[lang.value]}}</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="navTabs1_2_2tab1" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_2_2" role="tab" aria-controls="navTabs1_2" aria-selected="false">{{trans.data.grouped[lang.value]}}</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="navTabs1_3_tab1" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_3" role="tab" aria-controls="navTabs1_3" aria-selected="false"></a>
  </li>
</ul>
<div class="tab-content" id="navTabs1_1content1">
  <div class="tab-pane fade show active" id="navTabs1_1_2" role="tabpanel">
<div class="row mt-md-1 ms-md-1 me-md-1 mt-sm-1 ms-sm-1 me-sm-1 mt-xxl-1 ms-xxl-1 me-xxl-1 mt-xl-1 ms-xl-1 me-xl-1 mt-lg-1 ms-lg-1 me-lg-1 mt-0 ms-1 me-1" style="margin: 2px !important;">
<div class="flex-md-wrap flex-md-row justify-content-md-center rounded align-content-center mt-2 mb-2 ms-1 me-1 pt-3 pb-3 ps-3 pe-3 offset-md-1 col-sm-5 shadow-lg border-dark bg-secondary col-xxl-3 col-xl-3 col-lg-3 col-md-5 col-12" dmx-repeat:repeatproducts="load_products.data.repeat" style="padding-top: 0px !important; margin-top: .5rem !;" id="productRepeats1">
<form id="form5" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_order_items/create_order_item.php" dmx-on:success="form3.reset();list_order_items.load({order_id: session_variables.data.current_order});notifies1.success('Success:'+product_name+' Added to Order')" dmx-on:error="notifies1.danger('Error!')">
<div class="row mt-xxl-2">
    <div class="col text-center" style="padding: 0px !important; height: 200px;" dmx-hide="product_picture==null">
        <img dmx-bind:src="'/servo/uploads/product_pictures/'+product_picture" width="100%" height="95%" loading="lazy" style="object-fit: cover;">
    </div>
<div class="col text-center" style="padding: 0px !important; height: 200px;" dmx-hide="product_picture!==null">
<img width="100%" height="95%" loading="lazy" style="object-fit: cover;" src="uploads/servo_no_image2.jpg">
    </div></div><div class="row mt-2">
<div class="col d-flex justify-content-start"><h4 class="text-center fw-bold text-warning">{{product_name}}</h4>
</div>
<div class="col d-flex justify-content-end"><h4 class="text-center text-white">{{product_price}}</h4>
</div></div>


<div class="row justify-content-between mb-2 text-center">
<div class="col-4">
<button id="btn27" class="btn btn-lg btn-secondary text-light shadow" dmx-on:click="form3.inp_order_item_quantity.setValue((inp_order_item_quantity.value.toNumber()-1) )"><i class="fas fa-minus"></i>
</button>
</div>

<div class="col-4 text-center" style="padding: 0px !important;"><input id="inp_order_item_quantity1" name="order_item_quantity1" type="number" class="form-control mb-sm-1 mb-2 form-control-lg" placeholder="1" min="" data-rule-min="1" data-msg-min="Min. 1" style="width: 100% !important; border: 1px solid #696969 !important; border: none; background-color: transparent !important; color: #a1a1a1 !important;" dmx-bind:value="1"></div>
<div class="col-4">
<button id="btn27" class="btn btn-lg shadow btn-secondary text-light" dmx-on:click="form3.inp_order_item_quantity.setValue((inp_order_item_quantity.value.toNumber()+1) )"><i class="fas fa-plus"></i>
</button>
</div></div><input id="inp_order_time_ordered1" name="order_time_ordered1" class="form-control mb-sm-1 mb-2 visually-hidden" type="datetime-local" dmx-bind:value="var1.datetime"><input id="inp_order_item_status1" name="order_item_status1" class="form-control mb-sm-1 mb-2 visually-hidden" value="Ordered"><input id="inp_order_id1" name="servo_orders_order_id1" type="number" class="form-control mb-sm-1 mb-2 visually-hidden" dmx-bind:value="session_variables.data.current_order"><input id="inp_order_product_id1" name="servo_products_product_id1" type="number" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="1" dmx-bind:value="product_id"><input id="inp_order_item_price1" name="order_item_price1" type="number" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="1" dmx-bind:value="product_price">
<input id="inp_order_item_type1" name="order_item_type1" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="1" dmx-bind:value="'Simple'">
<input id="inp_order_item_user_ordered1" name="servo_users_user_ordered1" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="1" dmx-bind:value="session_variables.data.user_id" type="number">

<input id="orderitemDepartment1" name="servo_departments_department_id1" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="1" dmx-bind:value="sdc_department_id" type="number">
<textarea id="inp_order_notes2" class="form-control" name="order_item_notes1"></textarea><div class="row row-cols-xxl-7 mt-2 mt-sm-2 mt-md-2 mt-lg-2 mt-xl-2 mt-xxl-2" id="optionsrow1">
<div class="col w-25 flex-xxl-wrap justify-content-xxl-start">
<div id="repeatOptions1" is="dmx-repeat" dmx-bind:repeat="query_list_options">
<button class="btn mb-xxl-2 me-xxl-2 button-repeat btn-info" dmx-text="category_option_option" dmx-bind:value="category_option_option" dmx-on:click="form3.inp_order_notes.setValue(form3.inp_order_notes.value+' '+optionsButton.value+' ')" id="optionsButton1">Button</button></div>



</div>

</div>
<div class="row row-cols-xxl-7 justify-content-between mt-2 mb-2" id="buttons2">
<div class="col w-25 flex-xxl-wrap justify-content-xxl-start d-flex justify-content-start">



<button id="btn27" class="add-item-button btn align-self-end btn-lg lh-1 text-muted" dmx-on:click="form3.inp_order_notes.setValue(null)">
<i class="fas fa-undo fa-lg"></i>
</button></div>
<div class="col w-25 flex-xxl-wrap justify-content-xxl-start d-flex justify-content-end">



<button id="btn27" class="add-item-button btn btn-warning align-self-end btn-lg" type="submit">
<i class="fas fa-plus"></i>
</button></div>

</div>
</form></div></div>

  </div>
  <div class="tab-pane fade" id="navTabs1_2_1" role="tabpanel">
  <div class="row mt-md-1 mt-2"><div class="flex-xxl-wrap border border-secondary col-md-4 mb-sm-2 me-sm-2 col-lg-3 col-xl-3 col-xxl-3 mt-xxl-0 mb-xxl-3 me-xxl-3 pt-xxl-3 pb-xxl-1 ps-xxl-1 pe-xxl-1 mb-1 me-1" dmx-repeat:repeatproductgroups="load_product_groups.data.repeat_list_product_groups">

<div class="row mt-2">
<div class="col"><h3 class="text-center text-warning" dmx-text="product_group_name"></h3>
</div>
</div><form id="addGroupedItemsToOrder1" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_product_groups/add_grouped_products_to_order.php" dmx-on:success="form3.reset();list_order_items.load({order_id: session_variables.data.current_order});notifies1.success('Success:'+product_name+' Added to Order')">
<input id="text11" name="servo_orders_order_id1" type="text" class="form-control visually-hidden" dmx-bind:value="session_variables.data.current_order">
<input id="text11" name="servo_users_user_ordered1" type="text" class="form-control visually-hidden" dmx-bind:value="session_variables.data.user_id">
<input id="text11" name="product_group_id1" type="text" class="form-control visually-hidden" dmx-bind:value="product_group_id">
<input id="text11" name="order_time_ordered1" type="text" class="form-control visually-hidden" dmx-bind:value="dateTime.datetime">


<div class="row row-cols-xxl-7 justify-content-between mt-2 mb-2" id="buttons2">
<div class="col w-25 flex-xxl-wrap justify-content-xxl-start d-flex justify-content-end">



<button id="btn27" class="add-item-button btn btn-warning align-self-end btn-lg" type="submit">
<i class="fas fa-plus"></i>
</button></div>

</div>
</form></div></div></div>
  <div class="tab-pane fade" id="navTabs1_9" role="tabpanel">
  </div>
</div>
</div>


</div>





</div>
                </div>
                
                
                <div class="row" id="customerOrderHeader2">
<dmx-value id="variableOrderTotal" dmx-bind:value="(list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))"></dmx-value>
<dmx-value id="variableOrderPaid" dmx-bind:value="list_customer_transactions_order_totals.data.custom_list_customer_transactions_order_totals[0].Settlements"></dmx-value>
<dmx-value id="variableOrderDiscount" dmx-bind:value="list_order_items.data.query[0].order_discount"></dmx-value>
<dmx-value id="variableOrderCoverage" dmx-bind:value="list_order_items.data.query[0].coverage_percentage"></dmx-value>
<dmx-value id="variableOrderCoverageTotal" dmx-bind:value="((list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))-(((100 - readCustomerOrder.data.query.coverage_percentage) /100) * (list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))))"></dmx-value>
<dmx-value id="variableOrderCoveragePaid" dmx-bind:value="list_customer_transactions_order_totals.data.custom_list_customer_transactions_order_totals[0]['Coverage Settlements']"></dmx-value>
<dmx-value id="variableOrderCoverageOwing" dmx-bind:value="(variableOrderCoveragePaid.value  -variableOrderCoverageTotal.value)"></dmx-value>
<dmx-value id="variableCustomerTotal" dmx-bind:value="{{(variableOrderTotal.value * ((100 - variableOrderDiscount.value)/100) * ((100 - variableOrderCoverage.value)/100))}}"></dmx-value>
<dmx-value id="variableCustomerTotalToPay" dmx-bind:value="(variableOrderPaid.value - variableCustomerTotal.value)"></dmx-value>
<dmx-value id="variableCustomerOwing" dmx-bind:value="(((list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))-((readCustomerOrder.data.query.coverage_percentage /100) * (list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))))- ((list_customer_transactions_order.data.query.sum(`transaction_amount`))))"></dmx-value>
<div class="col" style="">
  
  <div class="row row-cols-12 justify-content-start" id="orderInfo1"><div class="justify-content-xl-end col-xl-auto col-auto" id="total3">
                        <h6 class="ms-2 pt-2">{{trans.data.total[lang.value]}}:</h6>
                    </div>


<div class="justify-content-xl-end col-xl-auto offset-xl-0 col-auto bg-secondary rounded-pill rounded-2 align-self-center align-self-xxl-center align-self-xl-center align-self-lg-center align-self-md-center pt-2" id="totalAmount3">
                        <h6 class="text-success fw-bold">{{(list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`)).formatNumber('0', ',', ',')}}</h6>
                    </div>
<div class="justify-content-xl-end col-xl-auto col-auto" id="discount3">
                        <h6 class="ms-2 pt-2">{{trans.data.discount[lang.value]}}:</h6>
                    </div><div class="justify-content-xl-end col-xl-auto offset-xl-0 col-auto bg-secondary rounded-pill rounded-2 align-self-center align-self-xxl-center align-self-xl-center align-self-lg-center align-self-md-center pt-2" id="disocuntAmount3">
                        <h6 class="text-success fw-bold" dmx-text="((list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))-((readCustomerOrder.data.query.order_discount / 100) * (list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`)))).formatNumber('0', ',', ',')"></h6>
                    </div>



<div class="justify-content-xl-end col-xl-auto col-auto" id="coverge3">
                        <h6 class="ms-2 pt-2">{{trans.data.coverage[lang.value]}}:</h6>
                    </div><div class="justify-content-xl-end col-xl-auto offset-xl-0 col-auto bg-secondary rounded-pill rounded-2 align-self-center align-self-xxl-center align-self-xl-center align-self-lg-center align-self-md-center pt-2" id="coverageAmount3">
                        <h6 class="text-success fw-bold">{{readCustomerOrder.data.query.coverage_percentage}}%</h6>
                    </div><div class="justify-content-xl-end col-xl-auto col-auto" id="toPay2">
                        <h6 class="ms-2 pt-2">{{trans.data.customerTotal[lang.value]}}:</h6>
                    </div><div class="justify-content-xl-end col-xl-auto offset-xl-0 col-auto rounded-pill rounded-2 align-self-center align-self-xxl-center align-self-xl-center align-self-lg-center align-self-md-center pt-2 bg-secondary" id="toPayAmount3">
                        <h6 class="fw-bold text-white">{{(variableOrderTotal.value * ((100 - variableOrderDiscount.value)/100) * ((100 - variableOrderCoverage.value)/100)).formatNumber('0',',',',')}}</h6>
                    </div><div class="justify-content-xl-end col-xl-auto offset-0 col-auto" id="paid3">
                        <h6 class="ms-2 pt-2">{{trans.data.Paid[lang.value]}}:</h6>
                    </div><div class="justify-content-xl-end col-xl-auto offset-xl-0 col-auto rounded-pill rounded-2 align-self-center align-self-xxl-center align-self-xl-center align-self-lg-center align-self-md-center pt-2 bg-success" id="paidAmount3">
                    <h6 class="fw-bold" dmx-text="list_customer_transactions_order_totals.data.custom_list_customer_transactions_order_totals[0].Settlements.toNumber().formatNumber('0', ',', ',').default(0)"></h6></div><div class="justify-content-xl-end col-xl-auto offset-0 col-auto" id="owing2">
                        <h6 class="ms-2 pt-2">{{trans.data.owing[lang.value]}}:</h6>
                    </div><div class="justify-content-xl-end col-xl-auto offset-xl-0 col-auto rounded-pill rounded-2 align-self-center align-self-xxl-center align-self-xl-center align-self-lg-center align-self-md-center pt-2 bg-danger" id="owingAmount2">
                    <h6 class="fw-bold">{{(variableCustomerTotalToPay.value).formatNumber('0',',',',')}}</h6></div>
<div class="justify-content-xl-end col-xl-auto col-auto fw-bold" id="coverageToPay3">
                        <h6 class="ms-2 pt-2 text-warning fw-bold">{{trans.data.coverageTotal[lang.value]}}:</h6>
                    </div>

<div class="justify-content-xl-end col-xl-auto offset-xl-0 col-auto rounded-pill rounded-2 align-self-center align-self-xxl-center align-self-xl-center align-self-lg-center align-self-md-center pt-2 border-warning bg-transparent text-warning border" id="coverageToPayAmount3">
                    <h6 dmx-text="variableOrderCoverageTotal.value.formatNumber('0',',',',').default(0)" class="fw-bold">{{list_customer_transactions_order.data.query.sum(`transaction_amount`)}}</h6></div>
<div class="justify-content-xl-end col-xl-auto col-auto" id="coveragePaid1">
                        <h6 class="ms-2 pt-2 text-warning fw-bold">{{trans.data.coveragePaid[lang.value]}}:</h6>
                    </div>
<div class="justify-content-xl-end col-xl-auto offset-xl-0 col-auto rounded-pill rounded-2 align-self-center align-self-xxl-center align-self-xl-center align-self-lg-center align-self-md-center pt-2 text-warning bg-transparent border-warning border" id="coveragePaidAmount1">
                    <h6 dmx-text="variableOrderCoveragePaid.value.toNumber().formatNumber('0',',',',').default(0)" class="fw-bold">{{list_customer_transactions_order.data.query.sum(`transaction_amount`)}}</h6></div>
<div class="justify-content-xl-end col-xl-auto col-auto fw-bold" id="coverageOwing1">
                        <h6 class="ms-2 pt-2 text-warning fw-bold">{{trans.data.coverageOwing[lang.value]}}:</h6>
                    </div><div class="justify-content-xl-end col-xl-auto offset-xl-0 col-auto rounded-pill rounded-2 align-self-center align-self-xxl-center align-self-xl-center align-self-lg-center align-self-md-center pt-2 bg-warning" id="coverageOwingAmount1">
                    <h6 dmx-text="(variableOrderCoveragePaid.value  -variableOrderCoverageTotal.value).formatNumber('0',',',',').default(0)" class="fw-bold">{{list_customer_transactions_order.data.query.sum(`transaction_amount`)}}</h6></div>





</div>
</div>
</div><div class="row mt-4">
                    <div class="col">
                        <ul class="nav nav-tabs" id="navTabs1_tabs2" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active text-light" id="navTabs1_13_tab2" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_91" role="tab" aria-controls="navTabs1_1" aria-selected="true">
                                    <i class="fas fa-eye fa-lg"></i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-light" id="navTabs1_23_tab4" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_92" role="tab" aria-controls="navTabs1_2" aria-selected="false">
                                    <i class="fas fa-cash-register fa-lg"></i>
                                </a>
                            </li>
<li class="nav-item">
                                <a class="nav-link text-light" id="navTabs1_23_tab4" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_93" role="tab" aria-controls="navTabs1_2" aria-selected="false">
                                    <i class="fas fa-coins fa-lg"></i>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content" id="navTabs13_content2">
                            <div class="tab-pane fade show active" id="navTabs1_91" role="tabpanel">

                                <div class="row">
                                    <div class="col">
        <div class="table-responsive" id="order_details_table1" style="">
            <table class="table">
                <thead>
                                                    <tr>
                                                        <th>{{trans.data.product[lang.value]}}</th>
                                                        <th>{{trans.data.dateTime[lang.value]}}</th>
                                                        <th>{{trans.data.status[lang.value]}}</th>
                                                        <th>{{trans.data.note[lang.value]}}</th>
                                                        <th>{{trans.data.quantity[lang.value]}}</th>
                                                        <th>{{trans.data.price[lang.value]}}</th>
                                                        <th>{{trans.data.attention[lang.value]}}</th>
                                                        <th></th>
                                                    </tr>
    </thead>
        <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_order_items.data.query" id="tableRepeat7">
                                                    <tr>
                                                        <td dmx-text="product_name"></td>
                                                        <td dmx-text="order_time_ordered"></td>
                                                        <td dmx-text="trans.data.getValueOrKey(order_item_status)[lang.value]"></td>
                                                        <td dmx-text="order_item_notes"></td>
                                                        <td>

                                                            <form id="editQuantity1" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_order_items/update_order_item_quantity.php" dmx-on:success="notifies1.success('Success');list_order_items.load({order_id: session_variables.data.current_order})">
                                                                <div class="row">
                                                                    <div class="col d-flex"><input id="newQuantity1" name="order_item_quantity1" type="number" class="form-control inline-edit" dmx-bind:value="order_item_quantity" dmx-bind:disabled="(read_item_order.data.query.order_status == 'Paid')" min="" data-rule-min="1" data-msg-min="Min. 1">
                                                                        <input id="editOrderId1" name="order_item_id1" type="number" class="form-control inline-edit visually-hidden" dmx-bind:value="order_item_id"><button id="btn27" class="btn text-success" data-bs-target="#productInfo" type="submit" dmx-hide="(read_item_order.data.query.order_status == 'Paid')"><i class="fas fa-check"><br></i></button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </td>
                                                        <td>

                                                            <form id="editPrice1" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_order_items/update_order_item_price.php" dmx-on:success="notifies1.success('Success');list_order_items.load({order_id: session_variables.data.current_order})">
                                                                <div class="row">
                                                                    <div class="col d-flex"><input id="newPrice1" name="order_item_price1" type="number" class="form-control inline-edit" dmx-bind:value="order_item_price" dmx-bind:disabled="(read_item_order.data.query.order_status == 'Paid')" min="" data-rule-min="0" data-msg-min="Min. 0">
                                                                        <input id="editOrderItemPrice1" name="order_item_id1" type="number" class="form-control inline-edit visually-hidden" dmx-bind:value="order_item_id"><button id="btn27" class="btn text-success" data-bs-target="#productInfo" type="submit" dmx-hide="(read_item_order.data.query.order_status == 'Paid')"><i class="fas fa-check"><br></i></button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </td>
                                                        <td dmx-text="user_username">

                                                        </td>
                                                        <td>

                                                            <form id="form5" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_order_items/delete_order_item.php" dmx-on:success="notifies1.success('Success');list_order_items.load({order_id: session_variables.data.current_order})" dmx-class:hidethis="" onsubmit=" return confirm('CONFIRM DELETE?');"><input id="text11" name="order_item_id1" type="text" class="form-control visually-hidden" dmx-bind:value="order_item_id"><button id="btn27" class="btn text-secondary" data-bs-target="#productInfo" type="submit"><i class="far fa-trash-alt fa-lg"><br></i></button></form>

                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                                <div class="row" id="orderUpdate1">
    <form is="dmx-serverconnect-form" id="updateOrderCashierStandard1" method="post" action="dmxConnect/api/servo_orders/update_order_discount_note.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="read_item_order.data.query" dmx-on:success="notifies1.success('Success');list_order_items.load({order_id: session_variables.data.current_order});readCustomerOrder.load({order_id: session_variables.data.current_order})">


                                        <div class="mb-3 row">
                                            <label for="inp_order_notes2" class="col-sm-2 col-form-label">{{trans.data.note[lang.value]}}</label>

                                            <div class="col-sm-10">
                                                <textarea type="textarea" class="form-control" id="inp_order_notes2" name="order_notes2" dmx-bind:value="readCustomerOrder.data.query.order_notes" aria-describedby="inp_order_notes_help"></textarea>
                                            </div>
                                        </div><input id="order_id5" name="order_id3" class="form-control visually-hidden" dmx-bind:value="readCustomerOrder.data.query.order_id">

                                        <div class="row">
<label for="inp_order_notes2" class="col-sm-2 col-form-label">{{trans.data.discount[lang.value]}}</label><div class="col"><input id="orderDiscount2" name="order_discount2" class="form-control" dmx-bind:value="readCustomerOrder.data.query.order_discount" required="" type="number" data-msg-required="!" min="" data-rule-min="0" data-msg-min="Min 0!" dmx-bind:max="100">
<input id="orderCustomer2" name="order_customer2" class="form-control visually-hidden" dmx-bind:value="readCustomerOrder.data.query.order_customer">
</div>
</div><div class="mb-3 row">

    <div class="mb-3 row">
        <div class="col-sm-10 d-flex justify-content-start">
                                                    <button class="btn btn-warning me-md-1 pt-md-2 pb-md-2 ps-md-2 pe-md-2 me-2" dmx-bind:value="read_item_order.data.query.Save" type="submit" dmx-hide="(read_item_order.data.query.order_status == 'Paid')">
                                                        <i class="fas fa-check fa-2x"></i>
                                                    </button>
                        </div>

                                            </div>
                                    
                                </div></form>
                                        


                            </div>

                        </div>
                        <div class="tab-pane fade" id="navTabs1_92" role="tabpanel">
                            <div class="row mt-2 visually-hidden">
                                <form is="dmx-serverconnect-form" id="updateOrderCashier2" method="post" action="dmxConnect/api/servo_orders/update_order_ordered_paid.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="read_item_order.data.query" dmx-on:success="notifies1.success('Success');list_orders_all_shift_department.load({current_shift: session_variables.data.current_shift, department_id: list_user_shift_info.data.query_list_user_shift[0].user_shift_department_id});updateOrderCashier.reset();readItemModal.hide()">
                                    <input id="order_id5" name="order_id3" class="form-control visually-hidden" dmx-bind:value="session_variables.data.current_order">
                                    <div class="mb-3 row">
                                        <label for="inp_order_amount_tendered2" class="col-sm-2 col-form-label">{{trans.data.amountTendered[lang.value]}}</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" id="inp_order_amount_tendered2" name="order_amount_tendered2" dmx-bind:value="readCustomerOrder.data.query.order_amount_tendered" aria-describedby="inp_order_notes_help" required="" data-msg-required="!" min="" data-msg-min="Min 0" dmx-bind:min="list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`)" dmx-bind:disabled="(readCustomerOrder.data.query.order_status == 'Paid')" data-rule-min="1">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="inp_order_balance2" class="col-sm-2 col-form-label">{{trans.data.balance[lang.value]}}</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" id="inp_order_balance2" name="order_balance2" aria-describedby="inp_order_notes_help" dmx-bind:value="(updateOrderCashier.inp_order_amount_tendered.value - orderTotal.value)" disabled="true" dmx-bind:disabled="(readCustomerOrder.data.query.order_status == 'Paid')">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-10 visually-hidden">
                                            <input type="number" class="form-control" id="inp_order_cashier_id2" name="servo_users_cashier_id2" aria-describedby="inp_order_notes_help" dmx-bind:value="session_variables.data.user_id">
                                        </div>
                                        <div class="col-sm-10 visually-hidden">
                                            <input class="form-control" id="inp_order_order_status2" name="order_status2" dmx-bind:value="'Ordered'" aria-describedby="inp_order_notes_help">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="customersearch" class="col-sm-2 col-form-label">{{trans.data.paymentMethod[lang.value]}}</label>
                                        <div class="col-sm-10">




                                            <select id="select7" class="form-select" dmx-bind:options="payment_methods.data.query" optiontext="payment_method_name" optionvalue="payment_method_id" dmx-bind:value="readCustomerOrder.data.query.servo_payment_methods_payment_method" name="servo_payment_methods_payment_method2" dmx-bind:disabled="(read_item_order.data.query.order_status == 'Paid')">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">

                                    </div>


                                    <div class="mb-3 row">
                                        <div class="col-sm-2">
                                            &nbsp;</div>
                                        <div class="col-sm-10 d-flex justify-content-start">
                                            <button class="btn btn-success pt-md-2 pb-md-2 ps-md-2 pe-md-2" id="receive_payment3" dmx-on:click="updateOrderCashier.inp_order_order_status.setValue('Paid');updateOrderCashier.submit()" dmx-bind:disabled="(read_item_order.data.query.order_status == 'Paid')"><i class="fas fa-hand-holding-usd fa-2x"></i></button>
                                        </div>

                                    </div>
                                </form>
                            </div>
<div class="row mt-2">
                                <form is="dmx-serverconnect-form" id="createOrderCoverageTransaction" method="post" action="dmxConnect/api/servo_customer_cash_transactions/create_transaction.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="read_item_order.data.query" dmx-on:success="createOrderCoverageTransaction.reset();list_customer_transactions.load({customer_id: session_variables.data.current_customer});list_customer_transactions_order.load({order_id: session_variables.data.current_order});notifies1.success('Success');updateOrderCashier.reset();readItemModal.hide();list_customer_transactions_amounts.load({customer_id: session_variables.data.current_customer});list_customer_transactions_order_totals.load({order_id: session_variables.data.current_order})" dmx-on:error="notifies1.danger('Error!')">
                                    <input id="transactionOrderId1" name="transaction_order" class="form-control visually-hidden" dmx-bind:value="session_variables.data.current_order">
<input id="transactionCustomer1" name="customer_id" class="form-control visually-hidden" dmx-bind:value="session_variables.data.current_customer">
<input id="transactionDate2" name="transaction_date" class="form-control visually-hidden" dmx-bind:value="dateTime.datetime">
<input id="transactionUserApproved1" name="user_approved_id" class="form-control visually-hidden" dmx-bind:value="session_variables.data.user_id">
<input id="transactionType2" name="transaction_type" class="form-control visually-hidden" dmx-bind:value="'Coverage Settlement'">
                                    <div class="mb-3 row">
                                        <label for="transactionAmount1" class="col-sm-2 col-form-label">{{trans.data.total[lang.value]}}</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" id="transactionAmount2" name="transaction_amount" aria-describedby="inp_order_notes_help" required="" data-msg-required="!" min="" data-msg-min="Min 0" dmx-bind:min="1" data-rule-min="1" dmx-bind:value="-(variableOrderCoverageOwing.value)" dmx-bind:max="variableCoverageOwing.value" max="" data-msg-max=">Max!">
                                        </div>
                                    </div>
<div class="mb-3 row">
                                        <label for="transactionAmountTendered1" class="col-sm-2 col-form-label">{{trans.data.amountTendered[lang.value]}}</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" id="transactionAmountTendered1" name="transaction_amount_tendered" aria-describedby="inp_order_notes_help" required="" data-msg-required="!" min="" data-msg-min="Min 0" dmx-bind:min="createOrderCoverageTransaction.transactionAmount2.value" data-rule-min="1">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="transactionBalance1" class="col-sm-2 col-form-label">{{trans.data.balance[lang.value]}}</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" id="transactionBalance1" name="transaction_balance" aria-describedby="inp_order_notes_help" dmx-bind:value="(createOrderCoverageTransaction.transactionAmountTendered1.value - createOrderCoverageTransaction.transactionAmount2.value)" readonly="true">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="customersearch" class="col-sm-2 col-form-label">{{trans.data.paymentMethod[lang.value]}}</label>
                                        <div class="col-sm-10">




                                            <select id="select7" class="form-select" dmx-bind:options="payment_methods.data.query" optiontext="payment_method_name" optionvalue="payment_method_id" name="transaction_payment_method" dmx-bind:disabled="(read_item_order.data.query.order_status == 'Paid')">
                                            </select>
                                        </div>
                                    </div>


                                    <div class="mb-3 row">
                                        <div class="col-sm-2">
                                            &nbsp;</div>
                                        <div class="col-sm-10 d-flex justify-content-start">
                                            <button class="btn btn-success pt-md-2 pb-md-2 ps-md-2 pe-md-2" id="receive_payment3" dmx-on:click="updateOrderCashier.inp_order_order_status.setValue('Paid');updateOrderCashier.submit()" dmx-bind:disabled="(read_item_order.data.query.order_status == 'Paid')" type="submit"><i class="fas fa-hand-holding-usd fa-2x"></i></button>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>


<div class="tab-pane fade" id="navTabs1_93" role="tabpanel">
                            <div class="row mt-2">
<div class="col">
<div class="table-responsive">
<table class="table table-hover table-sm">
  <thead>
    <tr>
      <th>#</th>
      
      <th>{{trans.data.type[lang.value]}}</th>
      <th>{{trans.data.attention[lang.value]}}</th>
      <th>{{trans.data.paymentMethod[lang.value]}}</th>
      <th>{{trans.data.dateTime[lang.value]}}</th>
      <th>{{trans.data.status[lang.value]}}</th>
      <th>{{trans.data.note[lang.value]}}</th>
      <th>{{trans.data.total[lang.value]}}</th><th>{{trans.data.amountTendered[lang.value]}}</th><th>{{trans.data.balance[lang.value]}}</th>
<th></th>
<th></th>
      
    </tr>
  </thead>
  <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_customer_transactions_order.data.query" id="tableRepeat7">
    <tr>
      <td dmx-text="customer_transaction_id"></td>
      
      <td dmx-text="transaction_type"></td>
      <td dmx-text="user_fname+user_lname"></td>
      <td dmx-text="payment_method_name"></td>
      <td dmx-text="transaction_date"></td>
      <td dmx-text="transaction_status"></td>
      <td dmx-text="transaction_note"></td>
      
      <td dmx-text="transaction_amount.formatNumber('0', ',', ',')"></td><td dmx-text="transaction_amount_tendered.formatNumber('0', ',', ',')"></td>
    <td dmx-text="transaction_balance.formatNumber('0', ',', ',')"></td>
<td>
<button id="btn27" class="btn" data-bs-toggle="modal" data-bs-target="#printTransactionReceiptModal" dmx-on:click="read_customer_transaction.load({customer_cash_transaction_id: customer_transaction_id})"><i class="fas fa-receipt fa-lg"></i>
</button>
</td>
<td>
<form id="deleteOrderCoverageTransaction" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_customer_cash_transactions/delete_transaction.php" dmx-on:success="list_customer_transactions_order.load({order_id: readCustomerOrder.data.query.order_id});list_customer_transactions.load({customer_id: session_variables.data.current_customer});list_customer_transactions_order_totals.load({order_id: session_variables.data.current_order})" onsubmit=" return confirm('CONFIRM DELETE?');">
<input id="text11" name="customer_transaction_id" type="text" class="form-control visually-hidden" dmx-bind:value="customer_transaction_id">
<button id="btn27" class="btn text-secondary" type="submit">
<i class="far fa-trash-alt fa-lg"></i>
</button>
</form>
</td></tr>
  </tbody>
</table>
</div>
</div>
                            </div><div class="row mt-2 visually-hidden">
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

</div></main>
<main id="customerDataReadingSession"><div class="modal readitem shadow" id="customerDataReadingSessionModal" is="dmx-bs5-modal" tabindex="-1" dmx-on:hidden-bs-modal="total_sales_per_waiter.load();updateOrderCashier.reset();readCustomerOrder.load({order_id: session_variables.data.current_order});list_customer_orders.load({}); readItemModal.show()">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">






                
                
<div class="d-block">
<main><div class="row justify-content-start justify-content-xxl-start justify-content-lg-start justify-content-md-start justify-content-sm-start justify-content-xl-start row-cols-xl-7 rounded-pill">
                    <div class="d-flex col-xl-auto rounded rounded-3 col-auto">
                    <h4 class="text-white">{{trans.data.dataCollection[lang.value]}} N°</h4></div>
<div class="d-flex col-xl-auto rounded rounded-3 col-auto">
                    <h4 class="text-white" dmx-text="read_customer_data_reading_sessions.data.query_read_data_reading_session.data_reading_session_id"></h4></div>

                    
                    
                </div></main>
</div><button id="btn22" class="btn float-right text-warning ms-4" data-bs-target="#printInvoiceModal" dmx-on:click="printReceipt.show()" dmx-animate-enter.duration:20000.delay:100="pulse" dmx-class:show-print-2="(read_item_order.data.query.order_status == 'Paid')" data-bs-toggle="modal">
                    <i class="fas fa-receipt fa-2x" style="color: #189aff !important;"></i>
                </button>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body">
                
                
                <div class="row mt-4">
                    <div class="col">
                        <ul class="nav nav-tabs" id="navTabs1_tabs1" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active text-light" id="navTabs1_13_tab1" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_7" role="tab" aria-controls="navTabs1_1" aria-selected="true">
                                    <i class="fas fa-eye fa-lg"></i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-light" id="navTabs1_23_tab3" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_77" role="tab" aria-controls="navTabs1_2" aria-selected="false">
                                    <i class="fas fa-clipboard-check fa-lg"></i>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content" id="navTabs13_content1">
                            <div class="tab-pane fade show active" id="navTabs1_7" role="tabpanel">

                                <div class="row mt-2 ms-2 justify-content-center">
<div class="mt-2 col-auto" dmx-repeat:repeatfieldsandvalues="list_customer_data_fields.data.query_list_data_fields">


<button id="btn20" class="btn pt-3 pb-3 ps-3 pe-3 bg-info" dmx-text="data_field_name" dmx-on:click="datafieldReading.inp_data_field_reading_data_field.setValue(data_field_id);currentReading.setValue(data_field_name);currentReadingUnit.setValue(data_field_unit)">Button</button></div>

                                </div>
                                <div class="row">
<div class="col"><dmx-value id="currentReading" dmx-bind:value="('')"></dmx-value>
<dmx-value id="currentReadingUnit"></dmx-value><h1 wappler-command="editContent" id="readingHeading" dmx-text="currentReading.value" class="text-center mt-2 mb-2"></h1></div>
</div><div class="row mt-2 justify-content-center row-cols-1" dmx-show="(currentReading.value !== '')">

<div class="col ms-4 text-xxl-center">

<form id="datafieldReading" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_data_field_readings/create_data_field_reading.php" dmx-on:success="notifies1.success('Success!');list_customer_data_fields.load({data_reading_session_id: read_customer_data_reading_sessions.data.query_read_data_reading_session.data_reading_session_id});list_customer_data_field_readings.load({data_reading_session_id: read_customer_data_reading_sessions.data.query_read_data_reading_session.data_reading_session_id});datafieldReading.inp_data_field_reading_value.setValue(NULL);datafieldReading.inp_data_field_reading_note.setValue(NULL);currentReading.setValue((''));currentReadingUnit.setValue((''))">
<div class="row justify-content-xl-center"><div class="col-sm-10 d-flex justify-content-center">
    <input type="number" class="form-control" id="inp_data_field_reading_value" name="data_field_reading_value" aria-describedby="inp_data_field_reading_value_help" style="WIDTH: 75% !important; background: transparent !important; /* border: none !important */ font-size: 45px !important; text-align: center !important;">
    <h2 dmx-text="currentReadingUnit.value" class="mt-2 ms-1 pt-3 pb-2"></h2>
  </div><div class="col-sm-10 mt-2 d-flex justify-content-center">
    <textarea type="text" class="form-control" id="inp_data_field_reading_note" name="data_field_reading_note" aria-describedby="inp_data_field_reading_note_help"></textarea>
  </div></div>

<div class="form-group mb-3 row">
  <div class="col-sm-10 visually-hidden">
    <input type="number" class="form-control" id="inp_data_field_reading_data_field" name="data_field_reading_data_field" aria-describedby="inp_data_field_reading_data_field_help">
  </div>
<div class="col-sm-10 visually-hidden">
    <input type="datetime-local" class="form-control" id="inp_data_field_reading_date" name="data_field_reading_date" aria-describedby="inp_data_field_reading_date_help" dmx-bind:value="dateTime.datetime">
  </div><div class="col-sm-10 visually-hidden">
    <input type="number" class="form-control" id="inp_data_field_reading_user" name="data_field_reading_user" aria-describedby="inp_data_field_reading_user_help" dmx-bind:value="list_user_info.data.query_list_user_info[0].user_id">
  </div><div class="col-sm-10 visually-hidden">
    <input type="number" class="form-control" id="inp_data_reading_session_id" name="data_reading_session_id" aria-describedby="inp_data_reading_session_id_help" placeholder="Enter Data reading session" dmx-bind:value="read_customer_data_reading_sessions.data.query_read_data_reading_session.data_reading_session_id">
  </div></div>


<div class="form-group mb-3 row">
  <div class="col-sm-10 d-flex justify-content-center">
    <button type="submit" class="btn text-info" wappler-command="editContent">
<i class="fas fa-check fa-4x"></i>
</button>
  </div>
</div>
</form></div>
</div>
                                

                        </div>
                        <div class="tab-pane fade" id="navTabs1_77" role="tabpanel"><div class="row" id="dataReadingSessionUpdate">
<div class="col">
<div class="table-responsive">
<table class="table table-hover table-sm">
  <thead>
    <tr>
      <th wappler-command="editContent">{{trans.data.field[lang.value]}}</th>
      <th wappler-command="editContent">{{trans.data.value[lang.value]}}</th>
      <th wappler-command="editContent">{{trans.data.unit[lang.value]}}</th>
      <th wappler-command="editContent">{{trans.data.dateTime[lang.value]}}</th>
      <th wappler-command="editContent">{{trans.data.user[lang.value]}}</th>
      <th wappler-command="editContent">{{trans.data.notes[lang.value]}}</th>
      <th wappler-command="editContent">{{trans.data.notes[lang.value]}}</th>
    </tr>
  </thead>
  <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_customer_data_field_readings.data.list_data_field_readings" id="tableRepeat10">
    <tr>
      <td dmx-text="data_field_name" wappler-command="editContent"></td>
      <td dmx-text="data_field_reading_value" wappler-command="editContent"></td>
      <td dmx-text="data_field_unit" wappler-command="editContent"></td>
      <td dmx-text="data_field_reading_date" wappler-command="editContent"></td>
      <td dmx-text="user_username" wappler-command="editContent"></td>
      <td dmx-text="data_field_reading_note" wappler-command="editContent"></td>
    <td>
<form id="deleteDataReading" is="dmx-serverconnect-form" method="post" action="dmxConnect/api/servo_data_field_readings/delete_data_field_reading.php" dmx-on:success="list_customer_data_field_readings.load({data_reading_session_id: read_customer_data_reading_sessions.data.query_read_data_reading_session.data_reading_session_id});list_customer_data_fields.load({data_reading_session_id: read_customer_data_reading_sessions.data.query_read_data_reading_session.data_reading_session_id})">
<input id="text13" name="data_field_reading_id" type="text" class="form-control visually-hidden" dmx-bind:value="data_field_reading_id">
<button id="btn24" class="btn text-secondary" type="submit"><i class="far fa-trash-alt fa-lg"></i>
</button></form>

    </td>
    </tr>
  </tbody>
</table>
</div>
</div>
                                        


                            </div><div class="row mt-2 visually-hidden" wappler-empty="Row" wappler-command="addElementInside">
                            </div></div>


                    </div>
                </div>




            </div>
            <div class="modal-footer">
                <form id="form44" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_data_reading_session/delete_data_reading_session.php" dmx-on:success="notifies1.success('Success');list_customer_data_reading_sessions.load({customer_id: session_variables.data.current_customer}); customerDataReadingSessionModal.hide()" onsubmit=" return confirm('CONFIRM DELETE?');">
                    <input id="text10" name="data_reading_session_id" type="number" class="form-control visually-hidden" dmx-bind:value="list_customer_data_reading_sessions.data.query_list_data_reading_sessions[0].data_reading_session_id">

                    <button id="btn22" class="btn text-secondary" type="submit">
                        <i class="far fa-trash-alt fa-lg"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

</div></main>
<main>
    <div class="container mt-auto">




        <div class="row servo-page-header">
            <div class="col-auto" dmx-animate-enter="slideInLeft">
                <i class="fas fa-users fa-2x" style="color: #afff18 !important;"></i>
            </div>
            <div class="col-auto page-heading">
                <h4 class="servo-page-heading">{{trans.data.customers[lang.value]}}</h4>
            </div>
            <div class="col style13 page-button" id="pagebuttons">
<div id="conditional1" is="dmx-if" dmx-bind:condition="(profile_privileges.data.profile_privileges[0].create_customer == 'Yes')"><button id="btn1" class="btn style12 fw-light add-button" data-bs-toggle="modal" data-bs-target="#createItemModal" style="float: right;"><i class="fas fa-plus fa-2x style14"></i>
                </button></div>
                
            </div>
        </div>
        <div class="row">
            <div class="col">

                <div class="row justify-content-sm-between justify-content-md-between justify-content-lg-between justify-content-xl-between justify-content-xxl-between justify-content-between sorter mt-2 mb-2 ms-0 me-0">
                    <div class="col-auto col-9 col-sm-9 col-lg-3 d-flex col-xxl"><input id="customerfilter" name="customerfilter" type="text" class="form-control mb-2 search form-control-sm" dmx-bind:placeholder="trans.data.name[lang.value]+'  '" style="background: #242424 !important;">
                    <input id="customerfilter2" name="customerfilter1" type="text" class="form-control search form-control-sm ms-lg-2 mb-2 ms-2" dmx-bind:placeholder="trans.data.surname[lang.value]+'  '" style="background: #242424 !important;"></div>
<div class="col-sm-2 col-lg-1 col-auto">
<button id="btn29" class="btn align-self-lg-start btn-outline-secondary btn-sm" dmx-on:click="customerfilter.setValue(NULL); customerfilter2.setValue(NULL)">
<i class="fas fa-backspace"></i>
</button>
</div>

                    <div class="d-flex flex-sm-wrap col-md-5 justify-content-lg-end col-xl-6 justify-content-xl-end justify-content-xxl-end col-auto flex-wrap col-sm-auto col-lg-6">
                        <ul class="pagination flex-xl-wrap flex-xxl-wrap flex-lg-wrap flex-md-wrap flex-sm-wrap flex-wrap" dmx-populate="list_customers.data.query_list_customers" dmx-state="listcustomers" dmx-offset="offset" dmx-generator="bs5paging">
                            <li class="page-item" dmx-class:disabled="list_customers.data.query_list_customers.page.current == 1" aria-label="First">
                                <a href="javascript:void(0)" class="page-link" dmx-on:click="listcustomers.set('offset',list_customers.data.query_list_customers.page.offset.first)"><span aria-hidden="true">&lsaquo;&lsaquo;</span></a>
                            </li>
                            <li class="page-item" dmx-class:disabled="list_customers.data.query_list_customers.page.current == 1" aria-label="Previous">
                                <a href="javascript:void(0)" class="page-link" dmx-on:click="listcustomers.set('offset',list_customers.data.query_list_customers.page.offset.prev)"><span aria-hidden="true">&lsaquo;</span></a>
                            </li>
                            <li class="page-item" dmx-class:active="title == list_customers.data.query_list_customers.page.current" dmx-class:disabled="!active" dmx-repeat="list_customers.data.query_list_customers.getServerConnectPagination(2,1,'...')" style="">
                                <a href="javascript:void(0)" class="page-link" dmx-on:click="listcustomers.set('offset',(page-1)*list_customers.data.query_list_customers.limit)">{{title}}</a>
                            </li>
                            <li class="page-item" dmx-class:disabled="list_customers.data.query_list_customers.page.current ==  list_customers.data.query_list_customers.page.total" aria-label="Next">
                                <a href="javascript:void(0)" class="page-link" dmx-on:click="listcustomers.set('offset',list_customers.data.query_list_customers.page.offset.next)"><span aria-hidden="true">&rsaquo;</span></a>
                            </li>
                            <li class="page-item" dmx-class:disabled="list_customers.data.query_list_customers.page.current ==  list_customers.data.query_list_customers.page.total" aria-label="Last">
                                <a href="javascript:void(0)" class="page-link" dmx-on:click="listcustomers.set('offset',list_customers.data.query_list_customers.page.offset.last)"><span aria-hidden="true">&rsaquo;&rsaquo;</span></a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xl-1 col-md-2 col-sm-2 col-3 offset-lg-1 col-lg col-lg-1"><select id="customer_sort_limit" class="form-select" name="customer_sort_limit">
                            <option value="5">5</option>
                            <option selected="" value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="'250">250</option>
                            <option value="500">500</option>
                        </select></div>
                </div>
                <div class="table-responsive servo-shadow" id="customerList">
                    <table class="table table-hover table-sm table-borderless">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{trans.data.name[lang.value]}}</th>
                                <th>{{trans.data.surname[lang.value]}}</th>
                                <th>{{trans.data.phoneNumber[lang.value]}}</th>
<th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_customers.data.query_list_customers.data" id="tableRepeat1">
                            <tr>
                                <td dmx-text="customer_id"></td>
                                <td dmx-text="customer_first_name"></td>
                                <td dmx-text="customer_last_name"></td>
                                <td dmx-text="customer_phone_number"></td>
<td>
<button id="btn28" class="btn text-warning" dmx-hide="(customer_class == 'standard')"><i class="fas fa-people-arrows fa-sm"></i></button>

</td>
                                <td class="text-center">

                                    <button id="btn2" class="btn open" data-bs-target="#readItemModal" dmx-bind:value="customer_id" dmx-on:click="session_variables.set('current_customer',customer_id); readItemModal.show();read_customer.load({customer_id: customer_id});list_customer_transactions.load({customer_id: customer_id});list_customer_orders.load({customer_id: customer_id, offset: listCustomerOrders.data.customerOrdersOffset, limit: c_order_sort_limit.value});list_customer_data_reading_sessions.load({customer_id: customer_id});list_customer_transactions_amounts.load({customer_id: customer_id});list_customer_orders_totals.load({customer_id: customer_id});list_customer_covered_orders.load({customer_id: customer_id, offset: listCustomerCoveredOrders.data.offset, limit: c_order_sort_limit2.value})"><i class="fas fa-expand-alt fa-lg " style="color: #afff18 !important;"><br></i></button>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="bootstrap/5/js/bootstrap.bundle.min.js"></script>
</body>
</html>
