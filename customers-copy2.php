<!doctype html>
<html>
<head>

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


</head>
<body is="dmx-app" id="brands">
<dmx-query-manager id="listcustomers"></dmx-query-manager>
<dmx-query-manager id="listCustomerOrders"></dmx-query-manager>
<dmx-value id="currentCustomer"></dmx-value>
<dmx-session-manager id="session_variables"></dmx-session-manager>

<dmx-value id="lang" dmx-bind:value="browser1.language"></dmx-value>
<dmx-json-datasource id="trans" is="dmx-serverconnect" url="assets/translation/translation.JSON"></dmx-json-datasource>

<dmx-serverconnect id="list_customer_orders" url="dmxConnect/api/servo_customer_cash_transactions/list_customer_orders_paged.php" dmx-param:id="id" noload="" dmx-param:item_id="" dmx-param:user_id="" dmx-param:customer_id="session_variables.data.current_customer" dmx-param:offset="listCustomerOrders.data.offset" dmx-param:limit="c_order_sort_limit.value"></dmx-serverconnect>
<dmx-serverconnect id="companyInfo" url="dmxConnect/api/servo_company_information/read_company_information.php" dmx-param:id="id" dmx-param:item_id="" dmx-param:user_id="" dmx-param:customer_id="session_variables.data.current_customer" dmx-param:offset="listCustomerOrders.data.offset" dmx-param:limit="c_order_sort_limit.value" dmx-param:company_info_id="1"></dmx-serverconnect>
<dmx-serverconnect id="payment_methods" url="dmxConnect/api/servo_payment_methods/list_payment_methods.php" dmx-param:id="id" dmx-param:item_id="" dmx-param:user_id="" dmx-param:customer_id="session_variables.data.current_customer" dmx-param:offset="listCustomerOrders.data.offset" dmx-param:limit="c_order_sort_limit.value"></dmx-serverconnect>
<dmx-serverconnect id="list_customer_transactions" url="dmxConnect/api/servo_customer_cash_transactions/list_transactions_customer.php" dmx-param:id="id" noload="" dmx-param:item_id="" dmx-param:user_id="" dmx-param:customer_id="session_variables.data.current_customer"></dmx-serverconnect>
<dmx-serverconnect id="list_customer_transactions_order" url="dmxConnect/api/servo_customer_cash_transactions/list_transactions_customer_order.php" dmx-param:id="id" noload="" dmx-param:item_id="" dmx-param:user_id="" dmx-param:customer_id="session_variables.data.current_customer" dmx-param:order_id="session_variables.data.current_order"></dmx-serverconnect><dmx-serverconnect id="read_customer" url="dmxConnect/api/servo_customers/read_customer.php" dmx-param:id="id" noload dmx-param:item_id="" dmx-param:user_id="" dmx-param:customer_id="session_variables.data.current_customer"></dmx-serverconnect>

<dmx-serverconnect id="delete_item_user_profile" url="dmxConnect/api/servo_user_profiles/delete_user_profile.php"></dmx-serverconnect><dmx-serverconnect id="list_customers" url="dmxConnect/api/servo_customers/list_customers_paged.php" dmx-param:sort="" dmx-param:dir="" dmx-param:limit="customer_sort_limit.value" dmx-param:offset="listcustomers.data.offset" dmx-param:customerfilter="customerfilter.value"></dmx-serverconnect>

<dmx-serverconnect id="readCustomerOrder" url="dmxConnect/api/servo_orders/read_order.php" dmx-param:id="id" noload dmx-param:item_id="" dmx-param:branch_id="read_item_branch.data.queryReadBranch.branch_id" dmx-param:department_id="" dmx-param:order_id="session_variables.data.current_order"></dmx-serverconnect>
<dmx-serverconnect id="list_order_items" url="dmxConnect/api/servo_order_items/list_order_items_current.php" dmx-param:order_id=""></dmx-serverconnect>
<div is="dmx-browser" id="browser1"></div>
<dmx-notifications id="notifies1"></dmx-notifications>
<?php include 'header.php'; ?><main class="mt-4">

<div class="modal create-modal" id="createItemModal" is="dmx-bs5-modal" tabindex="-1">
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
</div>
<div class="modal readitem shadow" id="customerOrderModal2" is="dmx-bs5-modal" tabindex="-1" dmx-on:hidden-bs-modal="total_sales_per_waiter.load();updateOrderCashier.reset();readCustomerOrder.load({order_id: session_variables.data.current_order});list_customer_orders.load({}); readItemModal.show()">
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
</div><button id="btn13" class="btn float-right text-warning ms-4" data-bs-target="#printInvoice" dmx-on:click="printReceipt.show()" dmx-animate-enter.duration:20000.delay:100="pulse" dmx-class:show-print-2="(read_item_order.data.query.order_status == 'Paid')" data-bs-toggle="modal">
                    <i class="fas fa-receipt fa-2x" style="color: #189aff !important;"></i>
                </button><button id="btn10" class="btn text-success float-right" data-bs-toggle="offcanvas" data-bs-target="#AddProductsToOrderOffCanvas" dmx-on:click="" dmx-hide="(read_item_order.data.query.order_status == 'Paid')" style="">
                    <i class="fas fa-plus fa-2x"></i>
                </button><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body">
<div class="offcanvas offcanvas-start" id="AddProductsToOrderOffCanvas" is="dmx-bs5-offcanvas" tabindex="-1" style="width: 99%;">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title">{{trans.data.addProducts[lang.value]}}</h5>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-xxl-5 col-md-7 col-12 col-sm-6 col-lg-5">



                                    <form id="searchProductOrder"><input id="searchProduct" name="search2" type="text" class="form-control mb-1 mb-xxl-2">
                                        <button id="btn11" class="btn btn-warning w-100" dmx-on:click="AddProductsToOrderOffCanvas.searchProductOrder.reset()">
                                            <i class="fas fa-backspace"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="row justify-content-xxl-start scrollable mt-xxl-2 row-cols-7 row-cols-xxl-7">
                                <div class="w-auto flex-xl-row flex-sm-row flex-sm-wrap flex-md-wrap flex-md-row col-md mb-md-0 col-sm ms-0 flex-lg-row justify-content-sm-around justify-content-md-around justify-content-lg-around col d-flex col-xxl flex-xxl-wrap justify-content-xxl-start flex-wrap justify-content-start">
                                    <div class="flex-md-wrap flex-md-row justify-content-md-center rounded align-content-center bg-secondary mt-2 mb-2 ms-1 me-1 pt-3 pb-3 ps-3 pe-3 col-12 col-sm-5 offset-md-1 col-xxl-5 col-lg-3 col-md-3" dmx-repeat:products="load_products.data.query_list_products.where(`product_name.lowercase()`, AddProductsToOrderOffCanvas.searchProductOrder.searchProduct.value.lowercase(), 'contains')">
                                        <h3 class="text-center text-warning">{{product_name}}</h3>
                                        <h4 class="text-center">{{product_price}}</h4>
                                        <form id="add_products_to_order_form" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_order_items/add_order_item_to_order.php" dmx-on:success="notifies1.success('Success:'+product_name+' Added to Order');list_order_items.load({order_id: session_variables.data.current_order});list_order_items_current.load({order_id: session_variables.data.current_order});AddProductsToOrderOffCanvas.add_products_to_order_form.reset()">
                                            <input id="inp_order_item_quantity1" name="order_item_quantity" type="number" class="form-control mb-sm-1 mb-2" placeholder="1" min="" data-rule-min="1" data-msg-min="Min. 1">
                                            <input id="inp_order_time_ordered1" name="order_time_ordered" class="form-control mb-sm-1 mb-2 visually-hidden" dmx-bind:value="var1.datetime">
                                            <input id="inp_order_time_ready1" name="order_time_ready" class="form-control mb-sm-1 mb-2 visually-hidden" dmx-bind:value="var1.datetime">
                                            <input id="inp_order_time_delivered1" name="order_time_delivered" class="form-control mb-sm-1 mb-2 visually-hidden" dmx-bind:value="var1.datetime">
                                            <input id="inp_order_item_status1" name="order_item_status" class="form-control mb-sm-1 mb-2 visually-hidden" value="Ordered">
                                            <input id="inp_order_id1" name="servo_orders_order_id" type="number" class="form-control mb-sm-1 mb-2 visually-hidden" dmx-bind:value="session_variables.data.current_order">
                                            <input id="inp_order_product_id1" name="servo_products_product_id" type="number" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="1" dmx-bind:value="product_id">
                                            <input id="inp_order_item_price1" name="order_item_price" type="number" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="1" dmx-bind:value="product_price">
                                            <input id="inp_user_ordered" name="servo_users_user_ordered" type="number" class="form-control mb-sm-1 mb-2 visually-hidden" dmx-bind:value="session_variables.data.user_id">
                                            <textarea id="inp_order_notes1" class="form-control" name="order_notes"></textarea>
                                            <button id="btn31" class="add-item-button btn btn-warning mt-2 align-self-end btn-lg" type="submit">
                                                <i class="fas fa-plus fa-lg"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
<div class="row">
<dmx-value id="varOrderTotal" dmx-bind:value="(list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`)).formatNumber('0', ',', ',')"></dmx-value>
<dmx-value id="varOrderPaid" dmx-bind:value="list_customer_transactions_order.data.query.sum(`transaction_amount`)"></dmx-value>
<dmx-value id="varCustomerTotal" dmx-bind:value="((list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))-((readCustomerOrder.data.query.coverage_percentage /100) * (list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))))"></dmx-value>
<dmx-value id="varCustomerOwing" dmx-bind:value="(((list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))-((readCustomerOrder.data.query.coverage_percentage /100) * (list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))))- ((list_customer_transactions_order.data.query.sum(`transaction_amount`))))"></dmx-value>
<div class="col" style=""><div class="row row-cols-12 justify-content-start"><div class="justify-content-xl-end col-xl-auto col-auto" id="total">
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
                    </div><div class="justify-content-xl-end col-xl-auto offset-xl-0 col-auto rounded-pill rounded-2 align-self-center align-self-xxl-center align-self-xl-center align-self-lg-center align-self-md-center pt-2 bg-danger" id="toPayAmount">
                        <h6 class="fw-bold text-white" dmx-text="((list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))-((readCustomerOrder.data.query.coverage_percentage /100) * (list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`)))).formatNumber('0', ',', ',')"></h6>
                    </div><div class="justify-content-xl-end col-xl-auto col-auto" id="coverageToPay">
                        <h6 class="ms-2 pt-2">{{trans.data.coverageTotal[lang.value]}}:</h6>
                    </div>
<div class="justify-content-xl-end col-xl-auto offset-xl-0 col-auto rounded-pill rounded-2 align-self-center align-self-xxl-center align-self-xl-center align-self-lg-center align-self-md-center pt-2 bg-warning" id="coverageToPayAmount">
                    <h6 dmx-text="((list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))-(((100 - readCustomerOrder.data.query.coverage_percentage) /100) * (list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`)))).formatNumber('0', ',', ',')" class="fw-bold">{{list_customer_transactions_order.data.query.sum(`transaction_amount`)}}</h6></div>
<div class="justify-content-xl-end col-xl-auto offset-0 col-auto" id="paid">
                        <h6 class="ms-2 pt-2">{{trans.data.Paid[lang.value]}}:</h6>
                    </div>
<div class="justify-content-xl-end col-xl-auto offset-xl-0 col-auto rounded-pill rounded-2 align-self-center align-self-xxl-center align-self-xl-center align-self-lg-center align-self-md-center pt-2 bg-success" id="paidAmount">
                    <h6 class="fw-bold" dmx-text="list_customer_transactions_order.data.query.sum(`transaction_amount`).formatNumber('0', ',', ',')"></h6></div>

<div class="justify-content-xl-end col-xl-auto offset-0 col-auto" id="owing">
                        <h6 class="ms-2 pt-2">{{trans.data.owing[lang.value]}}:</h6>
                    </div>
<div class="justify-content-xl-end col-xl-auto offset-xl-0 col-auto rounded-pill rounded-2 align-self-center align-self-xxl-center align-self-xl-center align-self-lg-center align-self-md-center pt-2 bg-danger" id="owingAmount">
                    <h6 class="fw-bold" dmx-text="(((list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))-((readCustomerOrder.data.query.coverage_percentage /100) * (list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))))- ((list_customer_transactions_order.data.query.sum(`transaction_amount`)))).formatNumber('0', ',', ',')">{{list_customer_transactions_order.data.query.sum(`transaction_amount`)}}</h6></div></div></div>
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
                                    <i class="fas fa-umbrella fa-lg"></i>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content" id="navTabs13_content">
                            <div class="tab-pane fade show active" id="navTabs1_13" role="tabpanel">

                                <div class="row">
                                    <div class="col">
        <div class="table-responsive" id="order_details_table">
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
                                                                    <div class="col d-flex"><input id="newPrice" name="order_item_price" type="number" class="form-control inline-edit" dmx-bind:value="order_item_price" dmx-bind:disabled="(read_item_order.data.query.order_status == 'Paid')" min="" data-rule-min="0" data-msg-min="Min. 0">
                                                                        <input id="editOrderItemPrice" name="order_item_id" type="number" class="form-control inline-edit visually-hidden" dmx-bind:value="order_item_id"><button id="btn23" class="btn text-success" data-bs-target="#productInfo" type="submit" dmx-hide="(read_item_order.data.query.order_status == 'Paid')"><i class="fas fa-check"><br></i></button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </td>
                                                        <td dmx-text="user_username">

                                                        </td>
                                                        <td>

                                                            <form id="form2" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_order_items/delete_order_item.php" dmx-on:success="notifies1.success('Success');list_order_items.load({order_id: session_variables.data.current_order})" dmx-class:hidethis="" onsubmit=" return confirm('CONFIRM DELETE?');"><input id="text22" name="order_item_id" type="text" class="form-control visually-hidden" dmx-bind:value="order_item_id"><button id="btn212" class="btn text-secondary" data-bs-target="#productInfo" type="submit"><i class="far fa-trash-alt fa-lg"><br></i></button></form>

                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                                <div class="row" id="orderUpdate">
    <form is="dmx-serverconnect-form" id="updateOrderCashierStandard" method="post" action="dmxConnect/api/servo_orders/update_order_discount_note.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="read_item_order.data.query" dmx-on:success="notifies1.success('Success');list_order_items.load({order_id: session_variables.data.current_order});readCustomerOrder.load({order_id: session_variables.data.current_order})">

<form is="dmx-serverconnect-form" id="updateOrderCashierStandard1" method="post" action="dmxConnect/api/servo_orders/update_order_standard.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="read_item_order.data.query" dmx-on:success="notifies1.success('Success');list_orders_all_shift.load({current_shift: 'session_variables.current_shift'});readItemModal.update()">
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
                                <form is="dmx-serverconnect-form" id="createOrderTransaction" method="post" action="dmxConnect/api/servo_customer_cash_transactions/create_transaction.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="read_item_order.data.query" dmx-on:success="createOrderTransaction.reset();list_customer_transactions.load({customer_id: session_variables.data.current_customer});list_customer_transactions_order.load({order_id: session_variables.data.current_order});notifies1.success('Success');updateOrderCashier.reset();readItemModal.hide()" dmx-on:error="notifies1.danger('Error!')">
                                    <input id="transactionOrderId" name="transaction_order" class="form-control visually-hidden" dmx-bind:value="session_variables.data.current_order">
<input id="transactionCustomer" name="customer_id" class="form-control visually-hidden" dmx-bind:value="session_variables.data.current_customer">
<input id="transactionDate" name="transaction_date" class="form-control visually-hidden" dmx-bind:value="dateTime.datetime">
<input id="transactionUserApproved" name="user_approved_id" class="form-control visually-hidden" dmx-bind:value="session_variables.data.user_id">
<input id="transactionType" name="transaction_type" class="form-control visually-hidden" dmx-bind:value="'Settlement'">
                                    <div class="mb-3 row">
                                        <label for="transactionAmount1" class="col-sm-2 col-form-label">{{trans.data.total[lang.value]}}</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" id="transactionAmount" name="transaction_amount" aria-describedby="inp_order_notes_help" required="" data-msg-required="!" min="" data-msg-min="Min 0" dmx-bind:min="1" data-rule-min="1" dmx-bind:value="varCustomerOwing.value">
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
<form id="deleteOrderTransaction" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_customer_cash_transactions/delete_transaction.php" dmx-on:success="list_customer_transactions_order.load({order_id: readCustomerOrder.data.query.order_id});list_customer_transactions.load({customer_id: session_variables.data.current_customer})" onsubmit=" return confirm('CONFIRM DELETE?');">
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
                                <form is="dmx-serverconnect-form" id="coveragePartner" method="post" action="dmxConnect/api/servo_orders/update_order_coverage_partner.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="read_item_order.data.query" dmx-on:success="notifies1.success('Success');readCustomerOrder.load({order_id: session_variables.data.current_order})" dmx-on:error="notifies1.danger('Error!')">
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
<select id="select4" class="form-select" dmx-bind:options="list_customers.data.query_list_customers.data" optiontext="customer_first_name+' '+customer_last_name+' '+customer_phone_number" optionvalue="customer_id" name="coverage_partner" dmx-bind:value="readCustomerOrder.data.query.coverage_partner">
<option value="%">{{trans.data.partner[lang.value]}}</option></select>
                                        </div>
                                    </div>


                                    <div class="mb-3 row">
                                        <div class="col-sm-10 d-flex justify-content-start">
                                            <button class="btn btn-success pt-md-2 pb-md-2 ps-md-2 pe-md-2" id="receive_payment2" dmx-on:click="updateOrderCashier.inp_order_order_status.setValue('Paid');updateOrderCashier.submit()" dmx-bind:disabled="(read_item_order.data.query.order_status == 'Paid')" type="submit"><i class="fas fa-check"></i></button>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div></div>
                </div>




            </div>
            <div class="modal-footer">
                <form id="form1" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_orders/delete_order_and_items.php" dmx-on:success="notifies1.success('Success');list_orders_all_shift.load();readItemModal.hide()" onsubmit=" return confirm('CONFIRM DELETE?');">
                    <input id="text12" name="order_id" type="number" class="form-control visually-hidden" dmx-bind:value="readCustomerOrder.data.query.order_id">

                    <button id="btn16" class="btn text-secondary" type="submit">
                        <i class="far fa-trash-alt fa-lg"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal readitem" id="readItemModal" is="dmx-bs5-modal" tabindex="-1">
  <div class="modal-dialog modal-xl" role="document" style="margin: 0px !important; width: 100% !important; height: 99% !important; max-width: 100% !important; max-height: 99% !important;">
    <div class="modal-content" style="max-height: 100% !important; height: 100% !important;">
      <div class="modal-header">

        <div class="d-block me-2" style="width: 40px; height: 40px;">
<img dmx-bind:src="'/servo/uploads/customer_pictures/'+read_customer.data.query_read_customer.customer_picture" class="rounded-circle shadow-none mt-2 me-2" width="100%" dmx-hide="(read_customer.data.query_read_customer.customer_picture == null)" loading="lazy" style="object-fit: cover;" height="100%">

<img class="rounded-circle img-fluid" width="100%" src="uploads/servo_no_image.jpg" dmx-show="(read_customer.data.query_read_customer.customer_picture == null)" height="100%">



            
        </div><h3 class="modal-title text-light">{{read_customer.data.query_read_customer.customer_first_name+' '+read_customer.data.query_read_customer.customer_last_name}}</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
<div class="row">
<div class="col">
<ul class="nav nav-tabs" id="navTabs1_tabs" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="navTabs1_1_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_1" role="tab" aria-controls="navTabs1_1" aria-selected="true">{{trans.data.orders[lang.value]}}
</a>
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
    <div class="row justify-content-sm-between justify-content-md-between justify-content-lg-between justify-content-xl-between justify-content-xxl-between mt-2 justify-content-between">
        <div class="col-lg-3 col-12 col-sm d-flex flex-sm-wrap col-sm-12"><input id="customerorderfilter" name="customerorderfilter" type="text" class="form-control mb-2 form-control-sm" dmx-bind:placeholder="trans.data.search[lang.value]+'  '" style="background: #242424 !important;"></div>
    
        <div class="d-flex flex-sm-wrap col-md-5 justify-content-lg-end col-xl-6 justify-content-xl-end justify-content-xxl-end flex-wrap col-sm col-lg flex-lg-wrap flex-xl-wrap flex-xxl-wrap col">
            <ul class="pagination" dmx-populate="list_customer_orders.data.query_list_customer_orders" dmx-state="listCustomerOrders" dmx-offset="offset" dmx-generator="bs5paging">
  <li class="page-item" dmx-class:disabled="list_customer_orders.data.query_list_customer_orders.page.current == 1" aria-label="First">
    <a href="javascript:void(0)" class="page-link" dmx-on:click="list_customers.set('offset',list_customer_orders.data.query_list_customer_orders.page.offset.first)"><span aria-hidden="true">&lsaquo;&lsaquo;</span></a>
  </li>
  <li class="page-item" dmx-class:disabled="list_customer_orders.data.query_list_customer_orders.page.current == 1" aria-label="Previous">
    <a href="javascript:void(0)" class="page-link" dmx-on:click="list_customers.set('offset',list_customer_orders.data.query_list_customer_orders.page.offset.prev)"><span aria-hidden="true">&lsaquo;</span></a>
  </li>
  <li class="page-item" dmx-class:active="title == list_customer_orders.data.query_list_customer_orders.page.current" dmx-class:disabled="!active" dmx-repeat="list_customer_orders.data.query_list_customer_orders.getServerConnectPagination(2,1,'...')">
    <a href="javascript:void(0)" class="page-link" dmx-on:click="list_customers.set('offset',(page-1)*list_customer_orders.data.query_list_customer_orders.limit)">{{title}}</a>
  </li>
  <li class="page-item" dmx-class:disabled="list_customer_orders.data.query_list_customer_orders.page.current ==  list_customer_orders.data.query_list_customer_orders.page.total" aria-label="Next">
    <a href="javascript:void(0)" class="page-link" dmx-on:click="list_customers.set('offset',list_customer_orders.data.query_list_customer_orders.page.offset.next)"><span aria-hidden="true">&rsaquo;</span></a>
  </li>
  <li class="page-item" dmx-class:disabled="list_customer_orders.data.query_list_customer_orders.page.current ==  list_customer_orders.data.query_list_customer_orders.page.total" aria-label="Last">
    <a href="javascript:void(0)" class="page-link" dmx-on:click="list_customers.set('offset',list_customer_orders.data.query_list_customer_orders.page.offset.last)"><span aria-hidden="true">&rsaquo;&rsaquo;</span></a>
  </li>
</ul>
        </div>
        <div class="col-lg-1 col-xl-1 col-md-2 col-sm-2 offset-lg-1 col-3"><select id="c_order_sort_limit" class="form-select" name="c_order_sort_limit">
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
      <th>{{trans.data.status[lang.value]}}</th>
      <th>{{trans.data.waiter[lang.value]}}</th>
      <th>{{trans.data.notes[lang.value]}}</th>
      <th>{{trans.data.service[lang.value]}}</th>
<th></th>
    </tr>
  </thead>
  <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_customer_orders.data.query_list_customer_orders.data" id="tableRepeat3">
    <tr>
      <td dmx-text="order_id"></td>
      <td dmx-text="order_time"></td>
      <td dmx-text="order_status"></td>
      <td dmx-text="user_username"></td>
      <td dmx-text="order_notes"></td>
      <td dmx-text="service_name"></td>
<td>
<button id="btn8" class="btn text-light" data-bs-toggle="modal" data-bs-target="#customerOrderModal" dmx-on:click="session_variables.set('current_order',order_id);list_order_items.load({order_id: order_id});readCustomerOrder.load({order_id: order_id});list_customer_transactions_order.load({order_id: order_id})" dmx-bind:value="order_id"><i class="fas fa-expand-alt fa-lg"></i>
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
<form id="createCustomerTransaction" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_customer_cash_transactions/create_transaction.php" dmx-on:success="notifies1.success('Sucess!');createCustomerTransaction.reset();list_customer_transactions.load({customer_id: read_customer.data.query_read_customer.customer_id})">
<div class="row">
<div class="col visually-hidden"><input id="customerId" name="customer_id" type="text" class="form-control visually-hidden" dmx-bind:value="read_customer.data.query_read_customer.customer_id"></div>
<div class="col visually-hidden"><input id="userApproved" name="user_approved_id" type="text" class="form-control visually-hidden" dmx-bind:value="session_variables.data.user_id"></div>
<div class="col-auto col-8 mb-2 col-sm-auto col-md-auto"><input id="transactionAmount1" name="transaction_amount" type="number" class="form-control ms-2" dmx-bind:placeholder="trans.data.amount[lang.value]"></div>
<div class="col-auto mb-2 col-sm-auto col-md-auto"><input id="transactionDate1" name="transaction_date" type="datetime-local" class="form-control ms-2" dmx-bind:value="dateTime.datetime"></div>
<div class="col-auto mb-2 col-sm-auto col-md-auto col-9"><select id="transactionType1" class="form-select ms-2" name="transaction_type">
<option value="Deposit">{{trans.data.deposit[lang.value]}}</option><option value="Payment">{{trans.data.payment[lang.value]}}</option><option value="Pending">{{trans.data.pending[lang.value]}}</option></select></div>
<div class="col-auto mb-2 col-sm-auto col-md-auto"><select id="transactionPaymentMethod1" class="form-select ms-2" name="transaction_payment_method" dmx-bind:options="payment_methods.data.query" optiontext="payment_method_name" optionvalue="payment_method_id">
<option value="">----</option></select></div>
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
      <td dmx-text="transaction_type"></td>
      <td dmx-text="transaction_order"></td>
<td dmx-text="user_username"></td>
      <td dmx-text="transaction_date"></td>
<td>
<form id="deleteTransaction" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_customer_cash_transactions/delete_transaction.php" dmx-on:success="list_customer_transactions.load({customer_id: session_variables.data.current_customer});notifies1.success('Success!')" onsubmit=" return confirm('CONFIRM DELETE?');">
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
<div class="pt-2 pb-2 col-xl-4 col-lg-6 col-12 text-sm-center text-center col-md-6 text-md-center"><img dmx-bind:src="'/servo/uploads/customer_pictures/'+read_customer.data.query_read_customer.customer_picture" class="img-fluid rounded-circle" width="45%" dmx-hide="(read_customer.data.query_read_customer.customer_picture == null)" loading="lazy" height="45%">
<img class="rounded-circle img-fluid" width="45%" src="uploads/servo_no_image.jpg" dmx-show="(read_customer.data.query_read_customer.customer_picture == null)" height="45%">
<div class="row">
<div class="col">
<form id="deleteCustomerPicture" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_customers/delete_customer_picture.php" dmx-on:success="notifies1.success('Success!');read_customer.load({customer_id: session_variables.data.current_customer})" dmx-hide="(read_customer.data.query_read_customer.customer_picture == null)">
<input id="customer_id_delete" name="customer_id" type="text" class="form-control visually-hidden" dmx-bind:value="read_customer.data.query_read_customer.customer_id"><input id="customer_picture_file_delete" name="customer_picture_file" type="text" class="form-control visually-hidden" dmx-bind:value="read_customer.data.query_read_customer.customer_picture">
<input id="customer_picture_ref_delete" name="customer_picture_ref" type="text" class="form-control visually-hidden" dmx-bind:value="NULL">
<input id="customer_picture_delete" name="customer_picture" type="text" class="form-control visually-hidden" dmx-bind:value="null">
<button id="btn5" class="btn mt-2 text-secondary" type="submit">
<i class="fas fa-times fa-2x"></i>
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
        <input id="text61" name="customer_age" type="number" class="form-control" dmx-bind:value="read_customer.data.query_read_customer.customer_age">
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
        <select id="select61" class="form-select" name="customer_class" dmx-bind:value="read_customer.data.query_read_customer.customer_class">
        <option value="standard">{{trans.data.standard[lang.value]}}</option><option value="special">{{trans.data.special[lang.value]}}</option></select>
    </div>
</div>
<div class="row">
    <label for="inp_customer_phone_number1" class="col-sm-2 col-form-label"><i class="fas fa-portrait fa-2x"></i></label>
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
<div class="col-auto" dmx-animate-enter="slideInLeft">
<i class="fas fa-users fa-2x" style="color: #afff18 !important;"></i>
</div>
<div class="col-auto page-heading">
<h4 class="servo-page-heading">{{trans.data.customers[lang.value]}}</h4>
</div>
<div class="col style13 page-button" id="pagebuttons">
<button id="btn1" class="btn style12 fw-light add-button" data-bs-toggle="modal" data-bs-target="#createItemModal" style="float: right;"><i class="fas fa-plus fa-2x style14"></i>
</button>
</div>
</div><div class="row">
<div class="col">

<div class="row justify-content-sm-between justify-content-md-between justify-content-lg-between justify-content-xl-between justify-content-xxl-between justify-content-between sorter mt-2 mb-2 ms-0 me-0">
    <div class="col-lg-3 col-12 col-sm-12"><input id="customerfilter" name="customerfilter" type="text" class="form-control mb-2 form-control-sm search" dmx-bind:placeholder="trans.data.search[lang.value]+'  '" style="background: #242424 !important;"></div>

    <div class="d-flex flex-sm-wrap col-md-5 col-lg-7 justify-content-lg-end col-xl-6 justify-content-xl-end justify-content-xxl-end col-auto flex-wrap col-sm-auto">
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
    <div class="col-lg-1 col-xl-1 col-md-2 col-sm-2 col-3 offset-lg-1 offset-sm-2"><select id="customer_sort_limit" class="form-select" name="customer_sort_limit">
        <option value="5">5</option><option selected="" value="25">25</option><option value="50">50</option><option value="100">100</option><option value="'250">250</option><option value="500">500</option></select></div>
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
    </tr>
  </thead>
  <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_customers.data.query_list_customers.data" id="tableRepeat1">
    <tr>
      <td dmx-text="customer_id"></td>
      <td dmx-text="customer_first_name"></td>
      <td dmx-text="customer_last_name"></td>
      <td dmx-text="customer_phone_number"></td>
<td class="text-center">

        <button id="btn2" class="btn open" data-bs-target="#readItemModal" dmx-bind:value="customer_id" dmx-on:click="session_variables.set('current_customer',customer_id); readItemModal.show();read_customer.load({customer_id: customer_id});list_customer_transactions.load({customer_id: customer_id});list_customer_orders.load({customer_id: customer_id, offset: listCustomerOrders.data.offset, limit: c_order_sort_limit.value})" data-bs-toggle="modal"><i class="fas fa-expand-alt fa-lg " style="color: #afff18 !important;"><br></i></button>

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
