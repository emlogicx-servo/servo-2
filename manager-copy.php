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
?>
<!doctype html>
<html>

<head>
    <style>
        @media print {

            #receiptheader {
                display: none !important;
            }

            * {
                color: black;
            }

            #orderUpdate {
                display: none !important;
            }

            body {
                visibility: hidden !important;
            }

            .modal-body {
                max-width: auto !important;
                padding: 0px !important;
            }

            .modal-dialog {
                visibility: visible !important;
                margin: 0px !important;
                max-width: 100% !important;
                margin: 0% !important;
                width: 100% !important;
                height: 100% !important;
                max-height: 100% !important;
            }

            .modal {
                position: absolute;
                overflow: visible !important;
                height: 100% !important;
            }

            .modal-backdrop {
                background: white !important;
            }

            #receiptModal {
                margin: 0px !important;
                padding: 0px !important;
                height: auto !important;
                max-height: auto !important;
            }

            #receiptBody * {
                align-items: center;
                margin: 0px !important;
                margin-right: 0px !important;
                color: black !important;
                ;
                font-size: 16px !important;
                font-weight: bold !important;
                width: 420px !important;
                background: transparent;
                font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
                padding: 2px !important;
                height: auto !important;
                max-height: auto !important;
            }

            #ordertotal {
                font-size: 30px !important;
                margin-right: 10px !important;
            }


            #receiptBack,
            #receiptPrint {
                display: none !important;
            }

            #receiptTotal * {
                margin-bottom: 20px !important;
                padding-bottom: 80px !important;
            }

            #receiptbottom {
                padding-bottom: 20px !important;
            }


            #paymentnumbers,
            #companymessage,
            #servosignature,
            #companyaddress,
            #companyname {
                display: block !important;

            }

            #receiptBody table td td.shrink {
                /* white-space: nowrap !important; */
            }
        }
    </style>

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
    <link rel="stylesheet" href="dmxAppConnect/dmxValidator/dmxValidator.css" />
    <script src="dmxAppConnect/dmxValidator/dmxValidator.js" defer=""></script>

<script src="dmxAppConnect/dmxCharts/Chart.min.js" defer=""></script>
<script src="dmxAppConnect/dmxCharts/dmxCharts.js" defer=""></script>
<link rel="stylesheet" href="fontawesome5/css/all.min.css" />
<script src="dmxAppConnect/dmxDataTraversal/dmxDataTraversal.js" defer=""></script>
</head>

<body is="dmx-app" id="ServoCashier">
<dmx-value id="amountTendered" dmx-bind:value="updateOrderCashier.inp_order_amount_tendered.value"></dmx-value>
<dmx-serverconnect id="payentMethodsShift" url="dmxConnect/api/servo_reporting/payment_methods_report_shift.php" dmx-param:shift="session_variables.data.current_shift"></dmx-serverconnect>
<dmx-serverconnect id="SalesReportShift" url="dmxConnect/api/servo_reporting/product_report_shift.php" dmx-param:shift="session_variables.data.current_shift"></dmx-serverconnect>
<dmx-serverconnect id="SalesReportTimeSeries" url="dmxConnect/api/servo_reporting/product_report_shift_by_date.php" dmx-param:shift="session_variables.data.current_shift"></dmx-serverconnect>
<dmx-serverconnect id="SalesReportCategoriesShift" url="dmxConnect/api/servo_reporting/product_category_report_shift.php" dmx-param:shift="session_variables.data.current_shift"></dmx-serverconnect>
<dmx-serverconnect id="list_orders_credit" url="dmxConnect/api/servo_orders/list_orders_all_credit.php"></dmx-serverconnect>
<dmx-serverconnect id="update_order_credit" url="dmxConnect/api/servo_orders/update_order_credit.php"></dmx-serverconnect>
    <dmx-serverconnect id="loadCompanyInfo" url="dmxConnect/api/servo_company_information/read_company_information.php" dmx-param:company_info_id="1"></dmx-serverconnect>

    <dmx-serverconnect id="load_customers" url="dmxConnect/api/servo_customers/list_customers.php"></dmx-serverconnect>
    <dmx-serverconnect id="loadPaymentMethods" url="dmxConnect/api/servo_payment_methods/list_payment_methods.php"></dmx-serverconnect>
    <dmx-serverconnect id="update_order" url="dmxConnect/api/servo_orders/update_order_standard.php" noload></dmx-serverconnect>

    <dmx-value id="lang" dmx-bind:value="browser1.language"></dmx-value>
    <dmx-json-datasource id="trans" is="dmx-serverconnect" url="assets/translation/translation.JSON"></dmx-json-datasource>
    <dmx-scheduler id="scheduler1" dmx-on:tick="total_sales_all_waiters_in_per_shift.load({current_shift: session_variables.data.current_shift, order_status: 'Paid'});total_sales_all_waiters_out_per_shift.load({current_shift: session_variables.data.current_shift, order_status: 'Ordered'});list_orders_all_shift.load({current_shift: session_variables.data.current_shift});payentMethodsShift.load();SalesReportShift.load();SalesReportCategoriesShift.load();SalesReportTimeSeries.load()" delay="3"></dmx-scheduler>
    <dmx-datetime id="var1"></dmx-datetime>
    <dmx-serverconnect id="total_sales_all_waiters_in_per_shift_manager" url="dmxConnect/api/servo_data/total_sales_all_waiters_in_per_shift_manager.php" dmx-param:user_id="session_variables.data.user_id" dmx-param:order_status="'Paid'" dmx-param:current_shift="session_variables.data.current_shift"></dmx-serverconnect>
    <dmx-serverconnect id="total_sales_all_waiters_out_per_shift_manager" url="dmxConnect/api/servo_data/total_sales_all_waiters_out_per_shift_manager.php" dmx-param:user_id="session_variables.data.user_id" dmx-param:current_shift="session_variables.data.current_shift" dmx-param:order_status="'Ordered'"></dmx-serverconnect>
    <dmx-serverconnect id="delte_item_order_item" url="dmxConnect/api/servo_order_items/delete_order_item.php"></dmx-serverconnect>
    <dmx-serverconnect id="list_order_items_current" url="dmxConnect/api/servo_order_items/list_order_items_current.php" dmx-param:order_id="session_variables.data.current_order"></dmx-serverconnect>
    <dmx-serverconnect id="get_order_total" url="dmxConnect/api/servo_order_items/compute_order_total.php" dmx-param:order_id="session_variables.data.current_order"></dmx-serverconnect>
    <dmx-serverconnect id="list_order_items" url="dmxConnect/api/servo_order_items/list_order_items.php" dmx-param:order_id="read_item_order.data.query.order_id"></dmx-serverconnect>
    <dmx-serverconnect id="load_products" url="dmxConnect/api/servo_products/list_products.php" dmx-param:product_type="'Store'"></dmx-serverconnect>
    <dmx-session-manager id="session_variables"></dmx-session-manager>
    <dmx-serverconnect id="load_tables" url="dmxConnect/api/servo_tables/list_tables.php"></dmx-serverconnect>

    <dmx-serverconnect id="load_product_categories" url="dmxConnect/api/servo_refered_fields_loading/load_product_categories.php"></dmx-serverconnect>
    <dmx-serverconnect id="read_item_order" url="dmxConnect/api/servo_orders/read_order.php" dmx-param:id="id" noload dmx-param:item_id="" dmx-param:branch_id="read_item_branch.data.queryReadBranch.branch_id" dmx-param:department_id="" dmx-param:order_id="tableRepeat2[0].order_id"></dmx-serverconnect>
    <dmx-serverconnect id="delete_item_order" url="dmxConnect/api/servo_departments/delete_department.php"></dmx-serverconnect>
    <dmx-serverconnect id="list_orders_all_shift" url="dmxConnect/api/servo_orders/list_orders_all_shift.php" dmx-param:user_id="" dmx-param:current_shift="session_variables.data.current_shift"></dmx-serverconnect>
    <div is="dmx-browser" id="browser1"></div>
    <dmx-notifications id="notifies1" timeout="20" position="bottom" extended-timeout="20"></dmx-notifications>
    <?php include 'header.php'; ?>
    <main>

        <div class="modal" id="SelectTableModal" is="dmx-bs5-modal" tabindex="-1">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{trans.data.selectTable[lang.value]}}</h5>
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
        <div class="modal" id="AddProductsModal" is="dmx-bs5-modal" tabindex="-1" dmx-on:hidden-bs-modal="upate_order_status.submit();total_sales_all_waiters_in_per_shift.load({});total_sales_all_waiters_out_per_shift.load();list_orders_all_shift.load();session_variables.remove('table_id');session_variables.remove('current_order')">
            <div class="modal-dialog modal-xl modal-fullscreen-lg-down" role="document">
                <div class="modal-content">
                    <form id="upate_order_status" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_orders/update_order_pending_ordered.php">
                        <input id="order_status_ordered" name="order_status" type="text" class="form-control visually-hidden" dmx-bind:value="'Ordered'">
                        <input id="order_status_order_id" name="order_id" type="number" class="form-control visually-hidden" dmx-bind:value="session_variables.data.current_order">
                    </form>
                    <div class="modal-header">

                        <h5 class="modal-title">{{trans.data.order[lang.value]}}:{{session_variables.data.current_order}}</h5>
                        <button id="btn9" class="btn text-warning" data-bs-toggle="offcanvas" data-bs-target="#orderdetailsoffcanvas">
                            <i class="far fa-eye"></i>
                        </button>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-xxl-5 col-lg-5 col-sm-8 col-12 col-md-8 d-flex">
                                    <form id="searchProductsNewOrder2">
                                        <input id="searchProduct2" name="search" type="search" class="form-control mb-1 mb-xxl-2">
                                        <button id="btn12" class="btn btn-warning w-100">
                                            <i class="fas fa-backspace"></i>
                                        </button>
                                    </form>



                                </div>
                            </div>
                            <div class="row no-gutters">
                                <div class="d-flex flex-wrap flex-xl-row flex-xxl-row flex-xxl-wrap flex-sm-row flex-sm-wrap flex-md-wrap flex-md-row col-md mb-md-0 col-sm ms-0 flex-row flex-lg-row justify-content-sm-around justify-content-around justify-content-md-around justify-content-lg-around w-auto">
                                    <div class="flex-md-wrap flex-md-row justify-content-md-center rounded align-content-center bg-secondary col-12 col-sm-5 offset-md-1 col-xxl-3 mt-2 mb-2 pt-3 pb-3 ps-3 pe-3 col-lg-3 col-md-3" dmx-repeat:products="load_products.data.query_list_products.where(`product_name.lowercase()`, searchProductsNewOrder2.searchProduct2.value.lowercase(), 'contains')">
                                        <h2 class="text-center text-warning">{{product_name}}</h2>
                                        <h3 class="text-center">{{product_price}}</h3>
                                        <form id="form3" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_order_items/create_order_item.php" dmx-on:success="form3.reset();list_order_items_current.load({order_id: session_variables.data.current_order});notifies1.success('Success:'+product_name+' Added to Order')">
                                            <input id="inp_order_item_quantity" name="order_item_quantity" type="number" class="form-control mb-sm-1 mb-2" placeholder="1" min="" data-rule-min="1" data-msg-min="Min. 1">
                                            <input id="inp_order_time_ordered" name="order_time_ordered" class="form-control mb-sm-1 mb-2 visually-hidden" type="datetime-local" dmx-bind:value="var1.datetime">
                                            <input id="inp_order_time_ready" name="order_time_ready" class="form-control mb-sm-1 mb-2 visually-hidden" type="datetime-local" dmx-bind:value="var1.datetime">
                                            <input id="inp_order_time_delivered" name="order_time_delivered" class="form-control mb-sm-1 mb-2 visually-hidden" type="datetime-local" dmx-bind:value="var1.datetime">
                                            <input id="inp_order_item_status" name="order_item_status" class="form-control mb-sm-1 mb-2 visually-hidden" value="Ordered">
                                            <input id="inp_order_id" name="servo_orders_order_id" type="number" class="form-control mb-sm-1 mb-2 visually-hidden" dmx-bind:value="session_variables.data.current_order">
                                            <input id="inp_order_product_id" name="servo_products_product_id" type="number" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="1" dmx-bind:value="product_id">
                                            <input id="inp_order_item_price" name="order_item_price" type="number" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="1" dmx-bind:value="product_price">
                                            <textarea id="inp_order_notes" class="form-control" name="order_item_notes"></textarea>
                                            <button id="btn8" class="add-item-button btn btn-warning mt-2 align-self-end btn-lg" type="submit">
                                                <i class="fas fa-plus fa-lg"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="offcanvas w-auto offcanvas-start" id="orderdetailsoffcanvas" is="dmx-bs5-offcanvas" tabindex="-1">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title">{{trans.data.order[lang.value]}} #{{session_variables.data.current_order}}</h5>
                            <h5 class="offcanvas-title">{{trans.data.table[lang.value]}}:</h5>
                            <h5 class="offcanvas-title" dmx-text="list_order_items_current.data.query.sum(`(order_item_price * order_item_quantity)`)">{{tableRepeat2[0].order_time}}</h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <div class="row" dmx-on:click="">
                                <div class="col">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>{{trans.data.dateTime[lang.value]}}</th>
                                                <th>{{trans.data.product[lang.value]}}</th>
                                                <th>{{trans.data.price[lang.value]}}</th>
                                                <th>{{trans.data.quantity[lang.value]}}</th>
                                                <th>{{trans.data.note[lang.value]}}</th>
                                                <th>{{trans.data.total[lang.value]}}</th>
                                            </tr>
                                        </thead>
                                        <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_order_items_current.data.query" id="tableRepeat3">
                                            <tr>
                                                <td dmx-text="order_time_ordered"></td>
                                                <td dmx-text="product_name"></td>
                                                <td dmx-text="order_item_price.formatNumber(2, '.', ',')"></td>
                                                <td dmx-text="order_item_quantity"></td>
                                                <td dmx-text="order_item_notes"></td>
                                                <td dmx-text="(order_item_price * order_item_quantity).formatNumber(2, '.', ',')"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
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
                        <h5 class="modal-title">{{trans.data.createOrder[lang.value]}}: {{session_variables.data.table_id}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col d-flex justify-content-center">
                                    <div class="row">
                                        <div class="col d-flex justify-content-center ms-1 me-1 flex-wrap">
                                            <form is="dmx-serverconnect-form" id="create_order_form" method="post" action="dmxConnect/api/servo_orders/create_order.php" dmx-on:success="notifies1.success('Order #'+create_order_form.data.custom[0]['last_insert_id()']+' Created');session_variables.set('current_order',create_order_form.data.custom[0]['last_insert_id()']);CreateOrderModal.hide();list_orders.load();create_order_form.reset();AddProductsModal.show()">
                                                <input id="order_time" name="order_time" class="form-control visually-hidden">
                                                <input id="order_customer" name="order_customer" type="hidden" class="form-control visually-hidden">
                                                <input id="order_discount" name="order_discount" type="hidden" class="form-control visually-hidden" dmx-bind:value="0">
                                                <input id="order_status" name="order_status" type="hidden" class="form-control visually-hidden" dmx-bind:value="'Pending'">
                                                <input id="table" name="servo_customer_table_table_id" type="hidden" class="form-control visually-hidden" dmx-bind:value="session_variables.data.table_id">
                                                <input id="user_id" name="servo_user_user_id" type="hidden" class="form-control visually-hidden" dmx-bind:value="session_variables.data.user_id">

                                                <input id="shift_id" name="servo_shift_shift_id" type="hidden" class="form-control visually-hidden" dmx-bind:value="session1.data.current_shift">
                                                <div class="row row-cols-1">
                                                    <div class="d-flex border-warning col"><button id="btn7" class="btn btn-lg btn-warning me-0 pt-5 pb-5 ps-5 pe-5" type="submit">{{trans.data.create[lang.value]}}</button>
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

                    </div>
                </div>
            </div>
        </div>
        <div class="modal create-modal" id="createItemModal" is="dmx-bs5-modal" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">&nbsp;New Department</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <form is="dmx-serverconnect-form" id="serverconnectFormCreateDepartment" method="post" action="dmxConnect/api/servo_departments/create_department.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-on:success="notifies1.success('Success');list_department_categories.load({department_id: read_item_department.data.query.department_id});createItemModal.hide()">
                                <div class="mb-3 row">
                                    <label for="inp_department_name" class="col-sm-2 col-form-label">Department Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inp_department_name" name="department_name" aria-describedby="inp_department_name_help" placeholder="Enter Department Name">
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
        <div class="modal readitem" id="readItemModal" is="dmx-bs5-modal" tabindex="-1" dmx-on:hidden-bs-modal="total_sales_per_waiter.load();updateOrderCashier.reset()">
            <dmx-value id="orderTotal" dmx-bind:value="list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`)"></dmx-value>
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="d-block">
                            <h3 class="text-warning">{{trans.data.orderDetails[lang.value]}}</h3>
                        </div>






                        <button id="btn10" class="btn text-success float-right" data-bs-toggle="offcanvas" data-bs-target="#AddProductsToOrderOffCanvas" dmx-on:click="" dmx-hide="(read_item_order.data.query.order_status == 'Paid')">
                            <i class="fas fa-plus fa-lg"></i>
                        </button>
                        <button id="btn13" class="btn float-right text-warning ms-4" data-bs-toggle="modal" data-bs-target="#printReceipt" dmx-on:click="" dmx-animate-enter.duration:20000.delay:100="pulse" dmx-class:show-print-2="(read_item_order.data.query.order_status == 'Paid')">
                            <i class="fas fa-receipt fa-2x"></i>
                        </button><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
</button>
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
                                                <form id="add_products_to_order_form" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_order_items/add_order_item_to_order.php" dmx-on:success="AddProductsToOrderOffCanvas.add_products_to_order_form.reset();list_order_items.load({order_id: read_item_order.data.query.order_id});list_order_items_current.load();notifies1.success('Success:'+product_name+' Added to Order')">
                                                    <input id="inp_order_item_quantity1" name="order_item_quantity" type="number" class="form-control mb-sm-1 mb-2" placeholder="1" min="" data-rule-min="1" data-msg-min="Min. 1">
                                                    <input id="inp_order_time_ordered1" name="order_time_ordered" class="form-control mb-sm-1 mb-2 visually-hidden" dmx-bind:value="var1.datetime">
                                                    <input id="inp_order_time_ready1" name="order_time_ready" class="form-control mb-sm-1 mb-2 visually-hidden" dmx-bind:value="var1.datetime">
                                                    <input id="inp_order_time_delivered1" name="order_time_delivered" class="form-control mb-sm-1 mb-2 visually-hidden" dmx-bind:value="var1.datetime">
                                                    <input id="inp_order_item_status1" name="order_item_status" class="form-control mb-sm-1 mb-2 visually-hidden" value="Ordered">
                                                    <input id="inp_order_id1" name="servo_orders_order_id" type="number" class="form-control mb-sm-1 mb-2 visually-hidden" dmx-bind:value="session_variables.data.current_order">
                                                    <input id="inp_order_product_id1" name="servo_products_product_id" type="number" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="1" dmx-bind:value="product_id">
                                                    <input id="inp_order_item_price1" name="order_item_price" type="number" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="1" dmx-bind:value="product_price">
                                                    <textarea id="inp_order_notes1" class="form-control" name="order_item_notes"></textarea>
                                                    <button id="btn3" class="add-item-button btn btn-warning mt-2 align-self-end btn-lg" type="submit">
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
                            <div class="d-flex col justify-content-start flex-wrap">
                                <div class="d-block">
                                    <h3>{{trans.data.waiter[lang.value]}}:</h3>
                                </div>
                                <div class="d-block ms-2">
                                    <h3 class="text-info" dmx-text="read_item_order.data.query.user_username.titlecase()"></h3>
                                </div>
                                <div class="d-block ms-2">
                                    <h3 class="ms-1">{{trans.data.table[lang.value]}}:</h3>
                                </div>
                                <div class="d-block ms-2">
                                    <h3 class="text-success" dmx-text="list_order_items.data.query[0].table_name">&nbsp;</h3>
                                </div>
                                <div class="d-block ms-2">
                                    <h3 class="ms-2">{{trans.data.total[lang.value]}}:</h3>
                                </div>
                                <div class="d-block text-danger ms-2">
                                    <h3>{{(list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`)).formatNumber('0', ',', ',')}}</h3>
                                </div>
                                <div class="text-danger float-right">

                                </div>
                            </div>
                        </div>
                        <h1>{{read_item_department.data.query.department_name}}</h1>
                        <div class="row">
                            <div class="col">
                                <ul class="nav nav-tabs" id="navTabs1_tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="navTabs1_1_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_1" role="tab" aria-controls="navTabs1_1" aria-selected="true">
                                            <i class="fas fa-eye fa-2x"></i>
                                        </a>
                                    </li>
<li class="nav-item">
                                        <a class="nav-link " id="navTabs1_2_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_2" role="tab" aria-controls="navTabs1_1" aria-selected="true">
                                            <i class="fas fa-user-edit fa-2x"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="navTabs1_3_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_3" role="tab" aria-controls="navTabs1_2" aria-selected="false">
                                            <i class="fas fa-cash-register fa-2x"></i>
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="navTabs1_content">
                                    <div class="tab-pane fade show active" id="navTabs1_1" role="tabpanel" aria-labelledby="navTabs1_1_tab">

                                        <div class="row">
                                            <div class="col">
                                                <div class="table-responsive mt-1" id="order_details_table">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>{{trans.data.product[lang.value]}}</th>
                                                                <th>{{trans.data.dateTime[lang.value]}}</th>
                                                                <th>{{trans.data.status[lang.value]}}</th>
                                                                <th>{{trans.data.note[lang.value]}}</th>
                                                                <th>{{trans.data.quantity[lang.value]}}</th>
                                                                <th>{{trans.data.price[lang.value]}}</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_order_items.data.query" id="tableRepeat4">
                                                            <tr>
                                                                <td dmx-text="product_name"></td>
                                                                <td dmx-text="order_time_ordered"></td>
                                                                <td dmx-text="order_item_status"></td>
                                                                <td dmx-text="order_item_notes"></td>
                                                                <td>

                                                                    <form id="editQuantity" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_order_items/update_order_item_quantity.php" dmx-on:success="notifies1.success('Success');list_order_items.load()">
                                                                        <div class="row">
                                                                            <div class="col d-flex"><input id="newQuantity" name="order_item_quantity" type="number" class="form-control inline-edit" dmx-bind:value="order_item_quantity" dmx-bind:disabled="(read_item_order.data.query.order_status == 'Paid')" min="" data-rule-min="1" data-msg-min="Min. 1">
                                                                                <input id="editOrderId" name="order_item_id" type="number" class="form-control inline-edit visually-hidden" dmx-bind:value="order_item_id"><button id="btn21" class="btn text-success" data-bs-target="#productInfo" type="submit" dmx-hide="(read_item_order.data.query.order_status == 'Paid')"><i class="fas fa-check"><br></i></button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </td>
                                                                <td>

                                                                    <form id="editPrice" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_order_items/update_order_item_price.php" dmx-on:success="notifies1.success('Success');list_order_items.load()">
                                                                        <div class="row">
                                                                            <div class="col d-flex"><input id="newPrice" name="order_item_price" type="number" class="form-control inline-edit" dmx-bind:value="order_item_price" dmx-bind:disabled="(read_item_order.data.query.order_status == 'Paid')" min="" data-rule-min="0" data-msg-min="Min. 0">
                                                                                <input id="editOrderItemPrice" name="order_item_id" type="number" class="form-control inline-edit visually-hidden" dmx-bind:value="order_item_id"><button id="btn23" class="btn text-success" data-bs-target="#productInfo" type="submit" dmx-hide="(read_item_order.data.query.order_status == 'Paid')"><i class="fas fa-check"><br></i></button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </td>
                                                                <td>

                                                                    <form id="form2" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_order_items/delete_order_item.php" dmx-on:success="notifies1.success('Success');list_order_items.load()"><input id="text2" name="order_item_id" type="text" class="form-control visually-hidden" dmx-bind:value="order_item_id"><button id="btn212" class="btn text-danger" data-bs-target="#productInfo" type="submit"><i class="far fa-trash-alt fa-lg"><br></i></button></form>

                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                        </div>
            <div class="row" id="orderUpdate">
                <form is="dmx-serverconnect-form" id="updateOrderCashierStandard" method="post" action="dmxConnect/api/servo_orders/update_order_standard.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="read_item_order.data.query" dmx-on:success="notifies1.success('Success');list_orders_all_shift.load({current_shift: 'session_variables.current_shift'});readItemModal.update();list_orders_credit.load();readItemModal.hide()">
                    <div class="mb-3 row">
                        <label for="inp_order_notes2" class="col-sm-2 col-form-label">{{trans.data.note[lang.value]}}</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inp_order_notes2" name="order_notes1" dmx-bind:value="read_item_order.data.query.order_notes" dmx-bind:disabled="(read_item_order.data.query.order_status == 'Paid')">
                        </div>
                    </div><input id="order_id" name="order_id" type="hidden" class="form-control" dmx-bind:value="read_item_order.data.query.order_id">
                    <div class="mb-3 row">
                        <label for="inp_servo_customer_table_table_id" class="col-sm-2 col-form-label">{{trans.data.table[lang.value]}}</label>
                        <div class="col-sm-10">
                            <select id="customer_table" class="form-select" dmx-bind:options="load_tables.data.query_list_tables" optiontext="table_name" optionvalue="table_id" name="servo_customer_table_table_id" dmx-bind:value="read_item_order.data.query.servo_customer_table_table_id" dmx-bind:disabled="(read_item_order.data.query.order_status == 'Paid')">
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">

                        <div class="mb-3 row">
                            <div class="col-sm-2">
                                &nbsp;</div>
                            <div class="col-sm-10 d-flex justify-content-start">
                                <button class="btn btn-warning me-2 ms-md-2 me-md-1 pt-md-2 pb-md-2 ps-md-2 pe-md-2" dmx-bind:value="read_item_order.data.query.Save" type="submit" dmx-hide="(read_item_order.data.query.order_status == 'Paid')">
                                    <i class="fas fa-check fa-2x"></i>
                                </button>
                            </div>

                        </div>
                </form>
            </div>
        </div>

                                </div>
<div class="tab-pane fade" id="navTabs1_2" role="tabpanel" aria-labelledby="navTabs1_2_tab">

        <div class="row mt-1" id="orderUpdateCredit">
<h3>{{trans.data.approveCredit[lang.value]}}</h3>
            <form is="dmx-serverconnect-form" id="updateOrderCredit" method="post" action="dmxConnect/api/servo_orders/update_order_credit.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="read_item_order.data.query" dmx-on:success="list_orders_all_shift.load({current_shift: 'session_variables.current_shift'});notifies1.success('Success');list_orders_credit.load()">
<input id="orderStatusCredit" name="order_status" type="text" class="form-control visually-hidden" dmx-bind:value="'Credit'">
                <input id="order_id2" name="order_id" type="hidden" class="form-control" dmx-bind:value="read_item_order.data.query.order_id">
                <div class="mb-3 row">
                    <label for="inp_order_notes" class="col-sm-2 col-form-label">{{trans.data.customer[lang.value]}}</label>
                    <div class="col-sm-10">
                        <select id="customerSelect1" class="form-select" dmx-bind:options="load_customers.data.query_list_customers" optiontext="customer_first_name+' '+customer_last_name" optionvalue="customer_id" dmx-bind:value="read_item_order.data.query.order_customer" name="order_customer" dmx-bind:disabled="(read_item_order.data.query.order_status == 'Paid')">
                            <option selected="" value=""></option>
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">

                    <div class="mb-3 row">
                        <div class="col-sm-2">
                            &nbsp;</div>
                        <div class="col-sm-10 d-flex justify-content-start">
                            <button class="btn me-2 btn-danger w-100 ms-md-2 me-md-1 pt-md-2 pb-md-2 ps-md-2 pe-md-2" dmx-bind:value="read_item_order.data.query.Save" type="submit" dmx-hide="(read_item_order.data.query.order_status == 'Paid')">
                                <i class="fas fa-user-edit fa-2x"></i>
                            </button>
                        </div>

                    </div>
            
        </div></form>
    </div>

                                </div>

<div class="tab-pane fade" id="navTabs1_3" role="tabpanel" aria-labelledby="navTabs1_3_tab">
                                    <div class="row mt-1">
                                        <form is="dmx-serverconnect-form" id="updateOrderCashier" method="post" action="dmxConnect/api/servo_orders/update_order_ordered_paid.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="read_item_order.data.query" dmx-on:success="notifies1.success('Success');list_orders_all_shift.load({});updateOrderCashier.reset();list_orders_credit.load();readItemModal.hide()">
                                            <input id="order_id1" name="order_id" type="hidden" class="form-control" dmx-bind:value="read_item_order.data.query.order_id">
                                            <div class="mb-3 row">
                                                <label for="inp_order_amount_tendered" class="col-sm-2 col-form-label">{{trans.data.amountTendered[lang.value]}}</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" id="inp_order_amount_tendered" name="order_amount_tendered" aria-describedby="inp_order_notes_help" required="" data-msg-required="!" type="number" dmx-bind:disabled="(read_item_order.data.query.order_status == 'Paid')" dmx-on:updated="updateOrderCashier.inp_order_balance.setValue((updateOrderCashier.inp_order_amount_tendered.value - orderTotal.value))">
<input class="form-control mt-2" id="inp_order_amount_tendered1" name="order_amount_tendered1" aria-describedby="inp_order_notes_help" required="" data-msg-required="!" type="number" dmx-bind:value="read_item_order.data.query.order_amount_tendered" dmx-bind:disabled="(read_item_order.data.query.order_status == 'Paid')">
<button id="btn1" class="btn btn-warning w-100 mt-2" dmx-on:click="updateOrderCashier.inp_order_balance.setValue((updateOrderCashier.inp_order_amount_tendered.value - orderTotal.value));updateOrderCashier.inp_order_balance.focus()" dmx-bind:disabled="(read_item_order.data.query.order_status == 'Paid')">
<i class="fas fa-calculator fa-2x"></i>
</button>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="inp_order_balance" class="col-sm-2 col-form-label">{{trans.data.balance[lang.value]}}</label>
                                                <div class="col-sm-10">
                                                    <input type="number" class="form-control" id="inp_order_balance" name="order_balance" dmx-bind:disabled="(read_item_order.data.query.order_status == 'Paid')" dmx-bind:value="(updateOrderCashier.inp_order_amount_tendered.value - orderTotal.value)">
<input type="number" class="form-control mt-2" id="inp_order_balance1" name="order_balance1" dmx-bind:value="read_item_order.data.query.order_balance" dmx-bind:disabled="(read_item_order.data.query.order_status == 'Paid')">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <div class="col-sm-10 visually-hidden">
                                                    <input type="number" class="form-control" id="inp_order_cashier_id1" name="servo_users_cashier_id" aria-describedby="inp_order_notes_help" dmx-bind:value="session_variables.data.user_id">
                                                </div>
                                                <div class="col-sm-10 visually-hidden">
                                                    <input class="form-control" id="inp_order_order_status1" name="order_status" dmx-bind:value="'Paid'" aria-describedby="inp_order_notes_help">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="input1" class="col-sm-2 col-form-label">{{trans.data.paymentMethod[lang.value]}}</label>
                                                <div class="col-sm-10">




                                                    <select id="select3" class="form-select" dmx-bind:options="loadPaymentMethods.data.query" optiontext="payment_method_name" optionvalue="payment_method_id" dmx-bind:value="read_item_order.data.query.servo_payment_methods_payment_method" name="servo_payment_methods_payment_method" dmx-bind:disabled="(read_item_order.data.query.order_status == 'Paid')">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">

                                            </div>


                                            <div class="mb-3 row">
                                                <div class="col-sm-2">
                                                    &nbsp;</div>
                                                <div class="col-sm-10 d-flex justify-content-start">
                                                    <button class="btn btn-success pt-md-2 pb-md-2 ps-md-2 pe-md-2" id="receive_payment1" dmx-on:click="updateOrderCashier.inp_order_order_status.setValue('Paid');updateOrderCashier.submit()" dmx-bind:disabled="(read_item_order.data.query.order_status == 'Paid')" dmx-show="(updateOrderCashier.inp_order_balance.value == (updateOrderCashier.inp_order_amount_tendered.value - orderTotal.value))"><i class="fas fa-hand-holding-usd fa-2x"></i></button>
                                                </div>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>




                    </div>
                    <div class="modal-footer">
                        <form id="form1" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_orders/delete_order_and_items.php" dmx-on:success="notifies1.success('Success');list_orders_all_shift.load();readItemModal.hide()" onsubmit=" return confirm('CONFIRM DELETE?');">
                            <input id="text1" name="order_id" class="form-control visually-hidden" dmx-bind:value="session_variables.data.current_order">

                            <button id="btn6" class="btn text-danger" type="submit">
                                <i class="far fa-trash-alt fa-lg"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal readitem" id="printReceipt" is="dmx-bs5-modal" tabindex="-1" dmx-on:hidden-bs-modal="total_sales_per_waiter.load()">
            <div class="modal-dialog modal-fullscreen modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header" id="receiptheader">

                        <button id="receiptBack" class="btn float-right btn-sm text-danger" data-bs-target="#readItemModal" dmx-on:click="printReceipt.hide()" data-bs-toggle="modal"><i class="fas fa-chevron-left fa-2x">&nbsp;</i></button>
                        <button id="receiptPrint" class="btn float-right btn-sm text-success" data-bs-target="#readItemModal" onclick="print()"><i class="fas fa-print fa-2x">&nbsp;</i></button><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body" id="receiptModal">
                        <div class="row">
                            <div class="col" id="companyname">
                                <div class="d-block ms-2 text-center">
                                    <h2 dmx-text="loadCompanyInfo.data.query.company_name" class="text-center fw-bold"></h2>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col" id="companyaddress">
                                <div class="d-block ms-2 text-center">
                                    <h4 dmx-text="loadCompanyInfo.data.query.company_address" class="text-center fw-bold"></h4>
                                </div>
                            </div>
                        </div>
                        <main="receiptModal"="receiptModal.>
                            <div class="container mt-auto" id="receiptBody">




                                <div class="row">
                                    <div class="col d-flex justify-content-end" id="receiptTotal1"></div>
                                </div>
                                <div class="row justify-content-start">
                                    <div class="col">
                                        <div class="row justify-content-xxl-start">
                                            <div class="col me-2 d-flex col-xxl">
                                                <h6 class="me-1">{{trans.data.timeOrdered[lang.value]}}:</h6>
                                                <h6 class="me-1" dmx-text="read_item_order.data.query.order_time"></h6>
                                            </div>
                                        </div>
                                        <div class="row justify-content-xxl-start">
                                            <div class="col me-2 d-flex col-xxl">
                                                <h6 class="me-1">{{trans.data.timePrinted[lang.value]}}:</h6>
                                                <h6 class="me-1" dmx-text="var1.datetime"></h6>
                                            </div>
                                        </div>
                                        <div class="row justify-content-xxl-start">
                                            <div class="col me-2 d-flex col-xxl">
                                                <h6 class="me-1">{{trans.data.order[lang.value]}}:</h6>
                                                <h6 class="me-1" dmx-text="'#'+read_item_order.data.query.order_id"></h6>
                                            </div>
                                            <div class="col me-2 d-flex col-xxl">
                                                <h6 class="me-1">{{trans.data.table[lang.value]}}:</h6>
                                                <h6 class="me-1" dmx-text="list_order_items.data.query[0].table_name"></h6>
                                            </div>
                                        </div>
                                        <div class="row justify-content-xxl-start">
                                            <div class="col me-2 d-flex col-xxl">
                                                <h6 class="me-1">{{trans.data.cashier[lang.value]}}:</h6>
                                                <h6 class="me-1" dmx-text="session_variables.data.current_user"></h6>
                                            </div>
                                            <div class="col me-2 d-flex col-xxl">
                                                <h6 class="me-1">{{trans.data.waiter[lang.value]}}:</h6>
                                                <h6 class="me-1" dmx-text="read_item_order.data.query.user_username"></h6>
                                            </div>
                                        </div>

                                    </div>


                                </div>
                                <div class="row" id="receipt" style="height: 450px; overflow: scroll;">
                                    <div class="col">


                                        <div class="row">
                                            <div class="col">
                                                <div class="table-responsive" id="order_details_table">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>{{trans.data.product[lang.value]}}</th>
                                                                <th>{{trans.data.qty[lang.value]}}</th>
                                                                <th>{{trans.data.price[lang.value]}}</th>
                                                                <th>{{trans.data.total[lang.value]}}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_order_items.data.query" id="tableRepeat4">
                                                            <tr>
                                                                <td dmx-text="product_name"></td>
                                                                <td dmx-text="order_item_quantity"></td>
                                                                <td dmx-text="order_item_price"></td>
                                                                <td dmx-text="(order_item_quantity * order_item_price)"></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row mb-5 pb-5" id="receiptbottom">
                                            <div class="col d-flex justify-content-end" id="receiptTotal3">
                                                <h2 class="fw-bold text-end" id="ordertotal">{{trans.data.total[lang.value]}}:{{(list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`)).formatNumber('0', ',', ',')}}</h2>
                                            </div>
                                            <div class="col" id="paymentnumbers">
                                                <div class="d-block ms-2">
                                                    <h3 dmx-text="loadCompanyInfo.data.query.company_payment_numbers" class="text-center"></h3>
                                                </div>
                                            </div>
                                            <div class="col" id="companymessage">
                                                <div class="d-block ms-2">
                                                    <h3 dmx-text="loadCompanyInfo.data.query.company_message" class="text-center"></h3>
                                                </div>
                                            </div>
                                            <div class="col" id="servosignature">
                                                <div class="d-block ms-2">
                                                    <h3 class="text-center">Powered by SERVO www.emlogicx.com</h3>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="d-block ms-2">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
    </main>
    </div>

    </div>
    </div>
    </div>


    </main>
    <main>
        <div class="container general-body">




            <div class="row servo-page-header h-auto top-bar">

                <div class="col style13 page-button justify-content-sm-end top-bar text-light" id="pagebuttons">
                    <h3 class="text-start">{{trans.data.manager[lang.value]}}</h3>



                </div>

                <div class="style13 page-button d-flex justify-content-sm-end justify-content-end col h-25" id="pagebuttons1">

                    <button id="btn4" class="btn style12 fw-light text-warning" data-bs-toggle="modal" data-bs-target="#SelectTableModal" style="float: right;"><i class="fas fa-plus fa-2x "></i></button>
                </div>
            </div>
            <div class="row mt-3 justify-content-between h-auto w-auto numbers">
                <div class="col d-flex justify-content-start">
                    <h2 class="text-danger"><i class="fas fa-arrow-alt-circle-up"></i></h2>
                    <h3 class="ms-2 text-danger">{{(total_sales_all_waiters_out_per_shift_manager.data.query.sum(`(order_item_price * order_item_quantity)`)).formatNumber('0', ',', ',')}}</h3>

                </div>
                <div class="col d-flex justify-content-end">
                    <h2 class="text-success"><i class="fas fa-arrow-alt-circle-down"></i></h2>
                    <h3 class="ms-2 text-success">{{(total_sales_all_waiters_in_per_shift_manager.data.query.sum(`(order_item_price * order_item_quantity)`)).formatNumber('0', ',', ',')}}</h3>
                </div>
            </div>
            <div class="row tablestyle" id="orders_table" style="height: 450px; overflow: scroll;">
                <div class="col-12"><ul class="nav nav-tabs" id="navTabs1_tabs" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="navTabs1_1_tab_2" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_1_2" role="tab" aria-controls="navTabs1_1" aria-selected="true" wappler-command="editContent">{{trans.data.orders[lang.value]}}</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="navTabs1_2_tab_2" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_2_2" role="tab" aria-controls="navTabs1_2" aria-selected="false" wappler-command="editContent">{{trans.data.credit[lang.value]}}</a>
  </li>
<li class="nav-item">
    <a class="nav-link" id="navTabs1_2_tab_1" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_2_1" role="tab" aria-controls="navTabs1_2" aria-selected="false" wappler-command="editContent">{{trans.data.shiftReport[lang.value]}}</a>
  </li>
</ul>
<div class="tab-content" id="navTabs1_content">
  <div class="tab-pane fade show active" id="navTabs1_1_2" role="tabpanel" aria-labelledby="navTabs1_1_tab_2">
  <div class="table-responsive mt-1">
                        <table class="table table-hover table-sm table-borderless" id="cashierorders">
                            <thead>
                                <tr>
                                    <th class="t_orderid" wappler-command="editContent">{{trans.data.orderId[lang.value]}}</th>
                                    <th class="t_time" wappler-command="editContent">{{trans.data.dateTime[lang.value]}}</th>
                                    <th class="t_status" wappler-command="editContent">{{trans.data.status[lang.value]}}</th>
                                    <th class="t_table" wappler-command="editContent">{{trans.data.table[lang.value]}}</th>
                                    <th class="t_waiter" wappler-command="editContent">{{trans.data.waiter[lang.value]}}</th>
                                    <th wappler-empty="undefined" wappler-command="editContent"></th>
                                </tr>
                            </thead>
                            <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_orders_all_shift.data.query" id="tableRepeat5">
                                <tr class="text-light fw-bold">
                                    <td dmx-text="order_id" dmx-class:order-paid="(order_status == 'Paid')" dmx-class:order-ordered="(order_status == 'Ordered')" dmx-class:order-credit="(order_status)=='Credit'" wappler-command="editContent"></td>
                                    <td dmx-text="order_time" wappler-command="editContent"></td>
                                    <td dmx-text="order_status" class="t_order_status" dmx-class:order-paid="(order_status == 'Paid')" dmx-class:order-ordered="(order_status == 'Ordered')" dmx-class:order-credit="(order_status)=='Credit'" wappler-command="editContent"></td>
                                    <td dmx-text="table_name" wappler-command="editContent"></td>
                                    <td dmx-text="user_username" wappler-command="editContent"></td>
                                    <td wappler-empty="undefined" wappler-command="editContent">
                                        <button dmx-class:order-paid="(order_status == 'Paid')" dmx-class:order-ordered="(order_status == 'Ordered')" dmx-class:order-credit="(order_status)=='Credit'" id="btn22" class="btn" data-bs-target="#productInfo" dmx-on:click="session_variables.remove('current_order');session_variables.set('current_order',order_id);readItemModal.show();read_item_order.load({order_id: order_id})" dmx-bind:value="list_orders.data.query[0].order_id" wappler-empty="Editable" wappler-command="editContent"><i class="far fa-eye fa-lg"><br></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div></div>
  <div class="tab-pane fade" id="navTabs1_2_2" role="tabpanel" aria-labelledby="navTabs1_2_tab_2">
<table class="table table-hover mt-1" id="creditTable">
  <thead>
    <tr>
      <th wappler-command="editContent">{{trans.data.orderId[lang.value]}}</th>
      <th wappler-command="editContent">{{trans.data.dateTime[lang.value]}}</th>
      <th wappler-command="editContent">{{trans.data.status[lang.value]}}</th>
      <th wappler-command="editContent">{{trans.data.notes[lang.value]}}</th>
      <th wappler-command="editContent">{{trans.data.shift[lang.value]}}</th>
      <th wappler-command="editContent">{{trans.data.table[lang.value]}}</th>
      <th wappler-command="editContent">{{trans.data.waiter[lang.value]}}</th>
      <th wappler-command="editContent">{{trans.data.customer[lang.value]}}</th>
      <th wappler-command="editContent">{{trans.data.contact[lang.value]}}</th>
<th wappler-empty="undefined" wappler-command="editContent"></th>
    </tr>
  </thead>
  <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_orders_credit.data.query" id="tableRepeat1">
    <tr>
      <td dmx-text="order_id" wappler-command="editContent"></td>
      <td dmx-text="order_time" wappler-command="editContent"></td>
      <td dmx-text="order_status" wappler-command="editContent"></td>
      <td dmx-text="order_notes" wappler-command="editContent"></td>
      <td dmx-text="servo_shift_shift_id" wappler-command="editContent"></td>
      <td dmx-text="table_name" wappler-command="editContent"></td>
      <td dmx-text="user_username" wappler-command="editContent"></td>
      <td dmx-text="customer_first_name+' '+customer_last_name" wappler-command="editContent"></td>
      <td dmx-text="customer_phone_number" wappler-command="editContent"></td>
        <td wappler-empty="undefined" wappler-command="editContent">
            <button dmx-class:order-paid="(order_status == 'Paid')" dmx-class:order-ordered="(order_status == 'Ordered')" dmx-class:order-credit="(order_status)=='Credit'" id="btn22" class="btn" data-bs-target="#readItemModal" dmx-on:click="session_variables.remove('current_order');session_variables.set('current_order',order_id);readItemModal.show();read_item_order.load({order_id: order_id})" dmx-bind:value="order_id" data-bs-toggle="modal" wappler-empty="Editable" wappler-command="editContent"><i class="far fa-eye fa-lg"><br></i></button>
        </td>
    </tr>
  </tbody>
</table>
  </div>
<div class="tab-pane fade" id="navTabs1_2_1" role="tabpanel" aria-labelledby="navTabs1_2_tab_1">
<div class="row mt-3">
<div class="col">
<h4 class="text-center" wappler-command="editContent">{{trans.data.sales[lang.value]}}</h4><dmx-chart id="chart1" dmx-bind:data="SalesReportShift.data.product_report" dataset-1:label="Total" point-size="" type="horizontalBar" dataset-1:value="_['sum(order_item_quantity * order_item_price)']" labels="product_name" multicolor="true" thickness="1" dataset-1:tooltip="" dataset-2:label="Volume" legend="top" dataset-2:value="_['SUM(order_item_quantity)']" width="450" height="400"></dmx-chart>

</div>

</div>
<div class="row mt-3">
<div class="col">
<h4 class="text-center" wappler-command="editContent">{{trans.data.categories[lang.value]}}</h4><dmx-chart id="chart5" dmx-bind:data="SalesReportCategoriesShift.data.product_category_report_shift" labels="product_category_name" point-size="" type="bar" dataset-1:label="Total" dataset-1:value="TotalSales" multicolor="true" dataset-2:label="Volume" dataset-2:value="_['SUM(order_item_quantity)']" legend="top" thickness="1" width="450" height="400"></dmx-chart>

</div>

</div>
<div class="row"><div class="col col-md d-flex">
<h4 wappler-command="editContent">{{trans.data.payments[lang.value]}}</h4>
<dmx-chart id="chart3" dmx-bind:data="payentMethodsShift.data.product_methods_report_shift" point-size="" type="pie" dataset-1:label="Total" dataset-1:value="_['sum(order_item_quantity * order_item_price)']" labels="payment_method_name+' '+_['sum(order_item_quantity * order_item_price)']" legend="bottom" width="500" height="350"></dmx-chart>

</div>
</div>
<div class="row"><div class="col col-md">
<h4 class="text-center" wappler-command="editContent">{{trans.data.salesMonitor[lang.value]}}</h4>
<dmx-chart id="chart4" dmx-bind:data="SalesReportTimeSeries.data.product_report_by_date" dataset-1:label="Total" dataset-1:value="_['sum(order_item_quantity * order_item_price)']" legend="bottom" points="true" smooth="true" labels="order_time_ordered" height="400" width="600" point-size="2"></dmx-chart>

</div>
</div>
  </div>
</div></div>



            </div>
        </div>
        </div>
    </main>
    <script src="bootstrap/5/js/bootstrap.bundle.min.js"></script>


</body>


</html>