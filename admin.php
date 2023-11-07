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
    <script src="js/jquery-3.5.1.slim.min.js"></script>
    <script src="dmxAppConnect/dmxBootstrap5Navigation/dmxBootstrap5Navigation.js" defer=""></script>
    <link rel="stylesheet" href="dmxAppConnect/dmxBootstrap5TableGenerator/dmxBootstrap5TableGenerator.css" />
    <script src="dmxAppConnect/dmxScheduler/dmxScheduler.js" defer=""></script>
    <script src="dmxAppConnect/dmxTyped/dmxTyped.js" defer=""></script>
    <script src="dmxAppConnect/dmxTyped/typed.min.js" defer=""></script>
    <link rel="stylesheet" href="dmxAppConnect/dmxNotifications/dmxNotifications.css" />
    <script src="dmxAppConnect/dmxBootstrap5Modal/dmxBootstrap5Modal.js" defer=""></script>
    <script src="dmxAppConnect/dmxNotifications/dmxNotifications.js" defer=""></script>
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

    <link rel="stylesheet" href="dmxAppConnect/dmxPreloader/dmxPreloader.css" />
    <script src="dmxAppConnect/dmxPreloader/dmxPreloader.js" defer></script>

    <link rel="stylesheet" href="css/bootstrap-icons.css" />
    <link rel="stylesheet" href="bootstrap/5/css/bootstrap.min.css" />
</head>

<body is="dmx-app" id="ServoCashier" dmx-on:ready="preloader.hide();readItemModal.hide()">
    <dmx-preloader id="preloader" spinner="pulse" bgcolor="rgba(255,255,255,0.23)" ,255,255,0.99),255,255,0.97)></dmx-preloader>
    <dmx-query-manager id="sales_report"></dmx-query-manager>
    <dmx-serverconnect id="list_expenses" url="dmxConnect/api/servo_expenses/list_expenses_shift.php" dmx-param:shift="list_user_shift_info.data.query_list_user_shift[0].servo_shifts_shift_id"></dmx-serverconnect>
    <dmx-serverconnect id="list_low_stock" url="dmxConnect/api/servo_stock/get_stock_alerts.php" dmx-param:low_stock_value="list_low_stock.data.custom_get_stock_alerts[0].product_min_stock" dmx-param:product_id="list_low_stock.data.custom_get_stock_alerts[0].product_id" dmx-param:totalstock="list_low_stock.data.custom_get_stock_alerts[0].TotalStock"></dmx-serverconnect>
    <dmx-value id="amountTendered" dmx-bind:value="updateOrderCashier.inp_order_amount_tendered.value"></dmx-value>
    <dmx-serverconnect id="payentMethodsShift" url="dmxConnect/api/servo_reporting/payment_methods_report_shift.php" dmx-param:shift="session_variables.data.current_shift"></dmx-serverconnect>
    <dmx-serverconnect id="paymentsShift" url="dmxConnect/api/servo_customer_cash_transactions/list_transactions_shift.php" dmx-param:shift="session_variables.data.current_shift" dmx-param:shift_id="session_variables.data.current_shift"></dmx-serverconnect>
    <dmx-serverconnect id="product_report_shift_department_admin" url="dmxConnect/api/servo_reporting/product_report_shift_department_admin.php" dmx-param:shift="session_variables.data.current_shift" dmx-param:department="departentReportSelect.selectDepartment.selectedValue" dmx-param:status="departentReportSelect.selectOrderItemStatus.value"></dmx-serverconnect>
    <dmx-serverconnect id="SalesReportShift" url="dmxConnect/api/servo_reporting/product_report_shift.php" dmx-param:shift="session_variables.data.current_shift" dmx-param:department="departentReportSelect1.selectDepartment1.selectedValue"></dmx-serverconnect>
    <dmx-serverconnect id="SalesReportShiftCustomers"></dmx-serverconnect>
    <dmx-serverconnect id="SalesReportShiftAccessories" url="dmxConnect/api/servo_reporting/product_report_shift_accessories.php" dmx-param:shift="session_variables.data.current_shift" dmx-param:department="departentReportSelect1.selectDepartment1.selectedValue"></dmx-serverconnect>
    <dmx-serverconnect id="SalesReportTimeSeries" url="dmxConnect/api/servo_reporting/product_report_shift_by_date.php" dmx-param:shift="session_variables.data.current_shift"></dmx-serverconnect>
    <dmx-serverconnect id="SalesReportCategoriesShift" url="dmxConnect/api/servo_reporting/product_category_report_shift.php" dmx-param:shift="session_variables.data.current_shift" dmx-param:departmet="departentReportSelect1.selectDepartment1.selectedValue" dmx-param:department="departentReportSelect1.selectDepartment1.selectedValue"></dmx-serverconnect>
    <dmx-serverconnect id="list_orders_credit" url="dmxConnect/api/servo_orders/list_orders_all_credit.php"></dmx-serverconnect>
    <dmx-serverconnect id="update_order_credit" url="dmxConnect/api/servo_orders/update_order_credit.php"></dmx-serverconnect>
    <dmx-serverconnect id="list_departments" url="dmxConnect/api/servo_departments/list_departments.php"></dmx-serverconnect>
    <dmx-serverconnect id="loadCompanyInfo" url="dmxConnect/api/servo_company_information/read_company_information.php" dmx-param:company_info_id="1"></dmx-serverconnect>

    <dmx-serverconnect id="load_customers" url="dmxConnect/api/servo_customers/list_customers.php" noload></dmx-serverconnect>
    <dmx-serverconnect id="loadPaymentMethods" url="dmxConnect/api/servo_payment_methods/list_payment_methods.php"></dmx-serverconnect>
    <dmx-serverconnect id="update_order" url="dmxConnect/api/servo_orders/update_order_standard.php" noload></dmx-serverconnect>
    <dmx-serverconnect id="list_customer_debt" url="dmxConnect/api/servo_customers/list_customer_debt_totals.php"></dmx-serverconnect>

    <dmx-value id="lang" dmx-bind:value="browser1.language"></dmx-value>
    <dmx-json-datasource id="trans" is="dmx-serverconnect" url="assets/translation/translation.JSON"></dmx-json-datasource>
    <dmx-scheduler id="scheduler1" dmx-on:tick="total_sales_all_waiters_in_per_shift.load({current_shift: session_variables.data.current_shift, order_status: 'Paid'});total_sales_all_waiters_out_per_shift.load({current_shift: session_variables.data.current_shift, order_status: 'Ordered'});list_orders_all_shift.load({current_shift: session_variables.data.current_shift});payentMethodsShift.load();SalesReportShift.load();SalesReportCategoriesShift.load();SalesReportTimeSeries.load();list_low_stock.load({});product_report_shift_department_admin.load({department: departentReportSelect.selectDepartment.value, status: departentReportSelect.selectOrderItemStatus.value});paymentsShift.load({shift_id: session_variables.data.current_shift})" delay="10"></dmx-scheduler>
    <dmx-datetime id="var1"></dmx-datetime>
    <dmx-serverconnect id="total_sales_all_waiters_in_per_shift" url="dmxConnect/api/servo_data/total_sales_all_waiters_in_per_shift_manager.php" dmx-param:user_id="session_variables.data.user_id" dmx-param:order_status="'Paid'" dmx-param:current_shift="session_variables.data.current_shift"></dmx-serverconnect>
    <dmx-serverconnect id="total_sales_all_waiters_out_per_shift" url="dmxConnect/api/servo_data/total_sales_all_waiters_out_per_shift_manager.php" dmx-param:user_id="session_variables.data.user_id" dmx-param:current_shift="session_variables.data.current_shift" dmx-param:order_status="'Ordered'"></dmx-serverconnect>
    <dmx-serverconnect id="delte_item_order_item" url="dmxConnect/api/servo_order_items/delete_order_item.php"></dmx-serverconnect>
    <dmx-serverconnect id="list_order_items_current" url="dmxConnect/api/servo_order_items/list_order_items_current.php" dmx-param:order_id="session_variables.data.current_order"></dmx-serverconnect>
    <dmx-serverconnect id="get_order_total" url="dmxConnect/api/servo_order_items/compute_order_total.php" dmx-param:order_id="session_variables.data.current_order"></dmx-serverconnect>
    <dmx-serverconnect id="list_order_items" url="dmxConnect/api/servo_order_items/list_order_items.php" dmx-param:order_id="read_item_order.data.query.order_id" dmx-on:start="preloader.show();readItemModal.hide()" dmx-on:done="preloader.hide();readItemModal.show()" noload></dmx-serverconnect>
    <dmx-serverconnect id="load_products" url="dmxConnect/api/servo_products/list_products.php" dmx-param:product_type="'Store'" noload></dmx-serverconnect>
    <dmx-session-manager id="session_variables"></dmx-session-manager>
    <dmx-serverconnect id="load_tables" url="dmxConnect/api/servo_tables/list_tables.php"></dmx-serverconnect>

    <dmx-serverconnect id="load_product_categories" url="dmxConnect/api/servo_refered_fields_loading/load_product_categories.php" noload></dmx-serverconnect>
    <dmx-serverconnect id="read_item_order" url="dmxConnect/api/servo_orders/read_order.php" dmx-param:id="id" noload dmx-param:item_id="" dmx-param:branch_id="read_item_branch.data.queryReadBranch.branch_id" dmx-param:department_id="" dmx-param:order_id="tableRepeat2[0].order_id"></dmx-serverconnect>
    <dmx-serverconnect id="delete_item_order" url="dmxConnect/api/servo_departments/delete_department.php"></dmx-serverconnect>
    <dmx-serverconnect id="list_orders_all_shift" url="dmxConnect/api/servo_orders/list_orders_all_shift.php" dmx-param:user_id="" dmx-param:current_shift="session_variables.data.current_shift"></dmx-serverconnect>
    <div is="dmx-browser" id="browser1"></div>
    <dmx-notifications id="notifies1" timeout="20" position="bottom" extended-timeout="20"></dmx-notifications>
    <?php include 'header.php'; ?>

    <main class="bg-body">

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
                            <div class="row g-0">
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
                    <div class="modal-body bg-transparent">
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
                    <div class="modal-header border-0 bg-light">






                        <div class="d-block">
                            <h5>{{trans.data.orderDetails[lang.value]}}</h5>
                        </div><button id="btn13" class="btn float-end text-warning ms-4 visually-hidden" data-bs-toggle="modal" data-bs-target="#printReceipt" dmx-on:click="" dmx-animate-enter.duration:20000.delay:100="pulse" dmx-class:show-print-2="(read_item_order.data.query.order_status == 'Paid')">
                            <i class="fas fa-receipt fa-2x"></i>
                        </button>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>

                    <div class="modal-body bg-light">
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
                            <div class="d-flex col justify-content-start flex-wrap fw-bold ">

                                <div class="d-block">
                                    <h6 class="fw-bold  ms-2"><i class="far fa-user" style="margin-right: 5px;"></i>{{read_item_order.data.query.user_username.titlecase()}}


                                    </h6>
                                </div>
                                <div class="d-block ms-2">
                                    <h6 class="ms-2 fw-bold"><i class="far fa-hand-point-right" style="margin-right: 5px;"></i>{{list_order_items.data.query[0].table_name}}
                                    </h6>
                                </div>
                                <div class="d-block ms-2 text-body">
                                    <h6 class="ms-2 fw-bold">{{trans.data.total[lang.value]}}:</h6>
                                </div>
                                <div class="d-block text-danger ms-2">
                                    <h4>{{(list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`)).formatNumber('0', ',', ',')}}</h4>
                                </div>
                                <div class="text-danger float-end">

                                </div>
                            </div>
                        </div>
                        <h1>{{read_item_department.data.query.department_name}}</h1>
                        <div class="row">
                            <div class="col">
                                <ul class="nav nav-tabs" id="navTabs1_tabs1" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active text-primary" id="navTabs1_1_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_1" role="tab" aria-controls="navTabs1_1" aria-selected="true">
                                            <i class="fas fa-eye fa-lg"></i>
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="navTabs1_content1">
                                    <div class="tab-pane fade show active mt-3" id="navTabs1_1" role="tabpanel" aria-labelledby="navTabs1_1_tab">

                                        <div class="row me-0">
                                            <div class="rounded col mb-2 ms-2 me-0 pt-2 ps-2 pe-2 bg-secondary">
                                                <div class="table-responsive" id="order_details_table2">
                                                    <table class="table table-borderless table-hover table-sm">
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
                                                        <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_order_items.data.query" id="tableRepeat41">
                                                            <tr>
                                                                <td dmx-text="product_name"></td>
                                                                <td dmx-text="order_time_ordered"></td>
                                                                <td dmx-text="trans.data.getValueOrKey(order_item_status)[lang.value]"></td>
                                                                <td dmx-text="order_item_notes"></td>
                                                                <td>

                                                                    <form id="editQuantity" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_order_items/update_order_item_quantity.php" dmx-on:success="notifies1.success('Success');list_order_items.load()">
                                                                        <div class="row">
                                                                            <div class="col d-flex"><input id="newQuantity" name="order_item_quantity" type="number" class="form-control inline-edit" dmx-bind:value="order_item_quantity" dmx-bind:disabled="(profile_privileges.data.profile_privileges[0].edit_order_item_quantity == 'No')" min="" data-rule-min="1" data-msg-min="Min. 1">
                                                                                <input id="editOrderId" name="order_item_id" type="number" class="form-control inline-edit visually-hidden" dmx-bind:value="order_item_id"><button id="btn21" class="btn text-success" data-bs-target="#productInfo" type="submit" dmx-hide="(profile_privileges.data.profile_privileges[0].edit_order_item_quantity == 'No')"><i class="fas fa-check"><br></i></button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </td>
                                                                <td>

                                                                    <form id="editPrice" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_order_items/update_order_item_price.php" dmx-on:success="notifies1.success('Success');list_order_items.load()">
                                                                        <div class="row">
                                                                            <div class="col d-flex"><input id="newPrice" name="order_item_price" type="number" class="form-control inline-edit" dmx-bind:value="order_item_price" dmx-bind:disabled="(profile_privileges.data.profile_privileges[0].edit_order_item_price == 'No')" min="" data-rule-min="0" data-msg-min="Min. 0">
                                                                                <input id="editOrderItemPrice" name="order_item_id" type="number" class="form-control inline-edit visually-hidden" dmx-bind:value="order_item_id"><button id="btn23" class="btn text-success" data-bs-target="#productInfo" type="submit" dmx-hide="(profile_privileges.data.profile_privileges[0].edit_order_item_price == 'No')"><i class="fas fa-check"><br></i></button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </td>
                                                                <td>

                                                                    <div class="row" is="dmx-if" id="conditional8" dmx-bind:condition="(profile_privileges.data.profile_privileges[0].delete_order_item == 'Yes')">
                                                                        <form id="form2" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_order_items/delete_order_item.php" dmx-on:success="notifies1.success('Success');list_order_items.load({order_id: session_variables.data.current_order})" onsubmit=" return confirm('CONFIRM DELETE?');">
                                                                            <input id="text22" name="order_item_id" type="text" class="form-control visually-hidden" dmx-bind:value="order_item_id">
                                                                            <input id="text101" name="order_id" type="text" class="form-control visually-hidden" dmx-bind:value="read_item_order.data.query.order_id">
                                                                            <input id="text111" name="user_deleted" type="text" class="form-control visually-hidden" dmx-bind:value="list_user_shift_info.data.query_list_user_shift[0].servo_user_user_id">
                                                                            <input id="text121" name="deleted_product_id" type="text" class="form-control visually-hidden" dmx-bind:value="servo_products_product_id">
                                                                            <button id="btn212" class="btn" data-bs-target="#productInfo" type="submit"><i class="far fa-trash-alt fa-sm"><br></i></button>
                                                                        </form>
                                                                    </div>

                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row" id="orderUpdate">
                                        <form is="dmx-serverconnect-form" id="updateOrderCashierStandard" method="post" action="dmxConnect/api/servo_orders/update_order_standard.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="read_item_order.data.query" dmx-on:success="notifies1.success('Success');list_orders_all_shift.load({current_shift: 'session_variables.current_shift'});readItemModal.update();list_orders_credit.load();readItemModal.hide()">
                                            <div class="mb-3 row">
                                                <label for="inp_order_notes2" class="col-sm-2 col-form-label">{{trans.data.note[lang.value]}}</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="inp_order_notes2" name="order_notes1" dmx-bind:value="read_item_order.data.query.order_notes" dmx-bind:disabled="(profile_privileges.data.profile_privileges[0].edit_order_details == 'No')">
                                                </div>
                                            </div><input id="order_id" name="order_id" type="hidden" class="form-control" dmx-bind:value="read_item_order.data.query.order_id">
                                            <input id="orderDiscount" name="order_discount" type="hidden" class="form-control" dmx-bind:value="0">
                                            <div class="mb-3 row">
                                                <label for="inp_servo_customer_table_table_id" class="col-sm-2 col-form-label">{{trans.data.asset[lang.value]}}</label>
                                                <div class="col-sm-10">
                                                    <select id="customer_table" class="form-select" dmx-bind:options="load_tables.data.query_list_tables" optiontext="table_name" optionvalue="table_id" name="servo_customer_table_table_id" dmx-bind:value="read_item_order.data.query.servo_customer_table_table_id" dmx-bind:disabled="(profile_privileges.data.profile_privileges[0].edit_order_details == 'No')">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="inp_servo_customer_table_table_id" class="col-sm-2 col-form-label">{{trans.data.paymentMethod[lang.value]}}</label>
                                                <div class="col-sm-10">
                                                    <h4 dmx-text="">Fancy display heading</h4>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <div class="col-sm-2">
                                                    &nbsp;</div>
                                                <div class="col-sm-10 d-flex justify-content-start">
                                                    <button class="btn me-2 ms-md-2 me-md-1 pt-md-2 pb-md-2 ps-md-2 pe-md-2 bg-info btn-info text-white" dmx-bind:value="read_item_order.data.query.Save" type="submit" dmx-hide="(profile_privileges.data.profile_privileges[0].edit_order_details == 'No')">
                                                        <i class="fas fa-check fa-2x"></i>
                                                    </button>
                                                </div>

                                            </div>
                                        </form>
                                    </div>


                                </div>

                            </div>
                        </div>




                    </div>
                    <div class="modal-footer bg-light border-0">
                        <form id="form1" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_orders/delete_order_and_items.php" dmx-on:success="notifies1.success('Success');list_orders_all_shift.load();readItemModal.hide()" onsubmit=" return confirm('CONFIRM DELETE?');">
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


    <main class="bg-body">
        <div class="ms-4 me-4">




            <div class="row  h-auto mt-4 visually-hidden">

                <div class="col style13 page-button justify-content-sm-end text-light" id="pagebuttons">
                    <h4 class="text-start text-body">{{trans.data.manager[lang.value]}} | {{trans.data.shift[lang.value]}} : {{session_variables.data.current_shift}}</h4>



                </div>

                <div class="style13 page-button d-flex justify-content-sm-end justify-content-end col h-25" id="pagebuttons1">

                    <button id="btn4" class="btn style12 fw-light text-warning" data-bs-toggle="modal" data-bs-target="#SelectTableModal" style="display: none !important; float: right;"><i class="fas fa-plus fa-2x "></i></button>
                </div>
            </div>
            <div class="row justify-content-between h-auto w-auto numbers mt-3 pt-3 pb-2 ps-1 pe-1 rounded shadow-sm bg-light">
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <h6 dmx-text="shiftInfoVar.value" id="shiftInfo" class="text-body"></h6>
                            <dmx-value id="shiftInfoVar"></dmx-value>
                        </div>
                    </div>
                    <div class="row">
                        <div class="d-flex justify-content-center justify-content-sm-start col-sm-6">
                            <h4 class="text-danger"><i class="fas fa-arrow-alt-circle-up fa-2x" style="/* color: #F3426C !important */"></i></h4>
                            <h3 class="ms-2 text-danger fw-bolder" style="/* color: #F3426C !important */">{{(total_sales_all_waiters_out_per_shift.data.query.sum(`(order_item_price * order_item_quantity)`)).formatNumber('0', ',', ',')}}</h3>

                        </div>
                        <div class="d-flex col-12 justify-content-center justify-content-sm-end col-sm-6">
                            <h4 class="text-success"><i class="fas fa-arrow-alt-circle-down fa-2x" style="/* color: #89F387 !important */"></i></h4>
                            <h3 class="ms-2 text-success fw-bolder" dmx-text="paymentsShift.data.TotalPaymentShift[0].TotalPaymentsShift.toNumber().formatNumber('0', ',', ',').default('0')" style="/* color: #89F387 !important */"></h3>
                        </div>
                    </div>

                </div>


            </div>
            <div class="row mt-2 rounded row-cols-12 bg-opacity-50" id="orders_table">
                <div class="rounded col-12 col-md mt-1 me-2 pt-3 shadow-sm bg-light">
                    <ul class="nav nav-tabs nav-fill" id="navTabs1_tabs" role="tablist">
                        <li class="nav-item flex-shrink-1 fw-bold">

                            <a class="nav-link active flex-shrink-1" id="navTabs1_1_tab_2" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_1_2" role="tab" aria-controls="navTabs1_1" aria-selected="true"><i class="fas fa-list-ol" style="margin-right: 3px;"></i>

                                {{trans.data.orders[lang.value]}}
                            </a>
                        </li>
                        <li class="nav-item flex-shrink-1 fw-bold">
                            <a class="nav-link text-danger" id="navTabs1_2_tab_2" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_2_2" role="tab" aria-controls="navTabs1_2" aria-selected="false"><i class="fas fa-hand-holding-usd" style="margin-right: 3px;"></i>
                                {{trans.data.credit[lang.value]}}</a>
                        </li>
                        <li class="nav-item flex-shrink-1 fw-bold">
                            <a class="nav-link" id="navTabs1_2_tab_1" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_2_1" role="tab" aria-controls="navTabs1_2" aria-selected="false"><i class="far fa-chart-bar" style="margin-right: 3px;"></i>{{trans.data.shiftReport[lang.value]}}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link flex-shrink-1" id="navTabs1_2_tab_3" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_2_3" role="tab" aria-controls="navTabs1_2" aria-selected="false"><i class="fas fa-exclamation-triangle" style="margin-right: 5px;"></i>{{trans.data.lowStock[lang.value]}} <sup id="readyItems" dmx-text="list_low_stock.data.custom_get_stock_alerts.count()" class="sup-text text-danger" style="font-size:15px;"></sup></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link flex-shrink-1" id="navTabs1_2_tab_4" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_2_4" role="tab" aria-controls="navTabs1_2" aria-selected="false"><i class="fas fa-coins" style="margin-right: 5px;"></i>{{trans.data.transactions[lang.value]}}</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="navTabs1_content">
                        <div class="tab-pane fade show active" id="navTabs1_1_2" role="tabpanel" aria-labelledby="navTabs1_1_tab_2">
                            <div class="row mt-2">
                                <div class="col rounded rounded-3 scrollable">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-sm table-borderless" id="cashierorders">
                                            <thead>
                                                <tr>
                                                    <th class="t_orderid">#</th>
                                                    <th class="t_time">{{trans.data.dateTime[lang.value]}}</th>

                                                    <th class="t_table">{{trans.data.asset[lang.value]}}</th>
                                                    <th class="t_table">{{trans.data.customer[lang.value]}}</th>
                                                    <th class="t_table">{{trans.data.info[lang.value]}}</th>
                                                    <th class="t_waiter">{{trans.data.waiter[lang.value]}}</th>
                                                    <th class="t_status text-center">{{trans.data.status[lang.value]}}</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_orders_all_shift.data.query" id="tableRepeat5">
                                                <tr>
                                                    <td dmx-text="order_id"></td>
                                                    <td dmx-text="order_time"></td>


                                                    <td dmx-text="table_name"></td>
                                                    <td dmx-text="customer_first_name+' '+customer_last_name"></td>
                                                    <td dmx-text="order_extra_info"></td>
                                                    <td dmx-text="user_username"></td>
                                                    <td>
                                                        <h6 dmx-text="trans.data.getValueOrKey(order_status)[lang.value]" dmx-class:grey-state="(order_status == 'Pending')" dmx-class:red-state="(order_status == 'Credit')" class="text-center pt-1 pb-1 ps-2 pe-2 bg-light rounded" dmx-class:text-warning="(order_status == 'Ordered')" dmx-class:text-success="(order_status == 'Paid')">Fancy display heading</h6>
                                                    </td>
                                                    <td class="text-center">
                                                        <button id="btn22" class="btn text-primary bg-primary bg-opacity-10" data-bs-target="#productInfo" dmx-on:click="session_variables.remove('current_order');session_variables.set('current_order',order_id);read_item_order.load({order_id: order_id});list_order_items.load({order_id: order_id})" dmx-bind:value="list_orders.data.query[0].order_id" style="/* color: #ff84ff !important */"><i class="fas fa-pencil-alt fa-sm"><br></i></button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="navTabs1_2_2" role="tabpanel" aria-labelledby="navTabs1_2_tab_2">
                            <div class="row">
                                <div class="col scrollable">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-sm">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>{{trans.data.customer[lang.value]}}</th>
                                                    <th class="text-end">{{trans.data.total[lang.value]}}</th>
                                                </tr>
                                            </thead>
                                            <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_customer_debt.data.query_list_customer_debt_totals" id="tableRepeat9">
                                                <tr>
                                                    <td dmx-text="customer_id"></td>
                                                    <td dmx-text="customer_first_name+' '+customer_last_name"></td>
                                                    <td dmx-text="TotalDebt.toNumber().formatNumber('0',',',',')" class="text-end"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-hover table-borderless mt-2" id="creditTable">
                                <thead>
                                    <tr>
                                        <th>{{trans.data.orderId[lang.value]}}</th>
                                        <th>{{trans.data.dateTime[lang.value]}}</th>
                                        <th>{{trans.data.status[lang.value]}}</th>
                                        <th>{{trans.data.notes[lang.value]}}</th>
                                        <th>{{trans.data.shift[lang.value]}}</th>
                                        <th>{{trans.data.table[lang.value]}}</th>
                                        <th>{{trans.data.waiter[lang.value]}}</th>
                                        <th>{{trans.data.customer[lang.value]}}</th>
                                        <th>{{trans.data.contact[lang.value]}}</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_orders_credit.data.query" id="tableRepeat1">
                                    <tr>
                                        <td dmx-text="order_id"></td>
                                        <td dmx-text="order_time"></td>
                                        <td dmx-text="order_status"></td>
                                        <td dmx-text="order_notes"></td>
                                        <td dmx-text="servo_shift_shift_id"></td>
                                        <td dmx-text="table_name"></td>
                                        <td dmx-text="user_username"></td>
                                        <td dmx-text="customer_first_name+' '+customer_last_name"></td>
                                        <td dmx-text="customer_phone_number"></td>
                                        <td>
                                            <button dmx-class:order-paid="(order_status == 'Paid')" dmx-class:order-ordered="(order_status == 'Ordered')" dmx-class:order-credit="(order_status)=='Credit'" id="btn221" class="btn" data-bs-target="#readItemModal" dmx-on:click="session_variables.remove('current_order');session_variables.set('current_order',order_id);readItemModal.show();read_item_order.load({order_id: order_id})" dmx-bind:value="order_id" data-bs-toggle="modal"><i class="far fa-eye fa-lg"><br></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade scrollable" id="navTabs1_2_1" role="tabpanel" aria-labelledby="navTabs1_2_tab_1">
                            <div class="row justify-content-xxl-center mt-2 pt-3 pb-2 ps-2 pe-2 rounded-2 rounded border-primary">
                                <div class="col rounded pt-3 pb-2 ps-3 pe-2 bg-secondary">
                                    <div class="row">
                                        <div class="col-xxl-auto col-xxl-5 col-auto">
                                            <form id="departentReportSelect1">
                                                <select id="selectDepartment1" class="form-select" dmx-bind:options="list_departments.data.query_list_departments" optiontext="department_name" optionvalue="department_id">
                                                    <option selected="" value="%">----</option>
                                                </select>
                                            </form>
                                        </div>
                                        <div class="mt-2 col-xxl-auto col-auto text-body">
                                            <div class="d-flex">
                                                <h4 dmx-text="trans.data.total[lang.value]+': '+SalesReportShift.data.product_report.sum(`Total`).formatNumber('0',',',',')" class="me-3 fw-bold"></h4>
                                                <h4 dmx-text="trans.data.volume[lang.value]+': '+SalesReportShift.data.product_report.sum(`Volume`).formatNumber('0',',',',')" class="fw-bold">{{trans.data.volume[lang.value]}}:</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="text-xxl-center col-lg-auto col-auto rounded rounded-3 mt-2 pt-2 col-lg-6 col-md col">
                                            <div class="row">
                                                <div class="col">
                                                    <h4>{{trans.data.products[lang.value]}}</h4>
                                                    <div class="table-responsive">
                                                        <table class="table table-sm text-body">
                                                            <thead>
                                                                <tr>
                                                                    <th>{{trans.data.product[lang.value]}}</th>
                                                                    <th>{{trans.data.category[lang.value]}}</th>
                                                                    <th>{{trans.data.volume[lang.value]}}</th>
                                                                    <th>{{trans.data.total[lang.value]}}</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="SalesReportShift.data.product_report" id="tableRepeat2">
                                                                <tr>
                                                                    <td dmx-text="product_name"></td>
                                                                    <td dmx-text="product_category_name"></td>
                                                                    <td dmx-text="Volume"></td>
                                                                    <td dmx-text="(Total).toNumber().formatNumber('0',',',',')"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>





                                        </div>
                                        <div class="text-xxl-center col-auto rounded rounded-3 mt-2 pt-2 pb-1 ps-1 pe-1 col-lg col-md col">
                                            <h4>{{trans.data.categories[lang.value]}}</h4>
                                            <div class="table-responsive">
                                                <table class="table table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>{{trans.data.category[lang.value]}}</th>
                                                            <th>{{trans.data.volume[lang.value]}}</th>
                                                            <th>{{trans.data.total[lang.value]}}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="SalesReportCategoriesShift.data.product_category_report_shift" id="tableRepeat7">
                                                        <tr>
                                                            <td dmx-text="product_category_name"></td>
                                                            <td dmx-text="Volume"></td>
                                                            <td dmx-text="(Total).toNumber().formatNumber('0',',',',')"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="row">

                                                <h4>{{trans.data.accessories[lang.value]}}</h4>

                                                <div class="col">
                                                    <div class="table-responsive">
                                                        <table class="table table-sm">
                                                            <thead>
                                                                <tr>
                                                                    <th>{{trans.data.product[lang.value]}}</th>
                                                                    <th>{{trans.data.category[lang.value]}}</th>
                                                                    <th>{{trans.data.volume[lang.value]}}</th>
                                                                    <th>{{trans.data.total[lang.value]}}</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="SalesReportShiftAccessories.data.product_report" id="tableRepeat4">
                                                                <tr>
                                                                    <td dmx-text="product_name"></td>
                                                                    <td dmx-text="product_category_name"></td>
                                                                    <td dmx-text="Volume"></td>
                                                                    <td dmx-text="(Total).toNumber().formatNumber('0',',',',')"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>




                            </div>
                            <div class="row mt-3 justify-content-xxl-center rounded rounded-3 scrollable-y pt-md-2 bg-light">
                                <div class="col-md-6 text-xxl-center col-lg-auto col-auto scrollable rounded rounded-3 ms-2 pt-1 pb-1 ps-1 pe-1">

                                    <h4 class="text-center">{{trans.data.sales[lang.value]}}</h4>
                                    <dmx-chart id="chart1" dmx-bind:data="SalesReportShift.data.product_report" dataset-1:label="Total" point-size="" type="bar" dataset-1:value="Total" labels="product_name" thickness="1" dataset-1:tooltip="" dataset-2:label="Volume" legend="top" dataset-2:value="Volume" width="1000" height="400" dataset-2:tooltip=""></dmx-chart>

                                </div>

                            </div>

                            <div class="row mt-3 row-cols-12 justify-content-between bg-light">

                                <div class="text-xxl-center rounded rounded-3 col-xxl col-md-12 ms-2 pt-1 pb-1 ps-1 pe-1">

                                    <h4 class="text-center">{{trans.data.categories[lang.value]}}</h4>
                                    <dmx-chart id="chart2" dmx-bind:data="SalesReportCategoriesShift.data.product_category_report_shift" labels="product_category_name" point-size="" type="bar" dataset-1:label="Total" dataset-1:value="Total" multicolor="true" dataset-2:label="Volume" dataset-2:value="Volume" legend="top" thickness="1" width="1000" height="400"></dmx-chart>

                                </div>
                            </div>
                            <div class="row mt-xxl-2 mt-2 bg-light">
                                <div class="col-md-6 text-xxl-center rounded rounded-3 col ms-2 pt-2">
                                    <h4 class="text-xxl-center">{{trans.data.payments[lang.value]}}</h4>
                                    <dmx-chart id="chart3" dmx-bind:data="payentMethodsShift.data.payment_methods_report_shift" point-size="" type="pie" dataset-1:label="Total" dataset-1:value="TotalPayments" labels="Method+' '+TotalPayments" legend="top" width="500" height="350"></dmx-chart>
                                </div>

                            </div>
                            <div class="row mt-xxl-2 mt-2 row-cols-12 bg-dark rounded rounded-3 scrollable-y row-cols-md-12">
                                <div class="col-md col-md-4 text-xxl-center rounded rounded-3 col-xl-5 col-12 d-flex col-xxl-7 ms-2 pt-2 pb-2 ps-2 pe-2 bg-secondary">

                                    <h4 class="text-center text-xxl-center">{{trans.data.salesMonitor[lang.value]}}</h4>
                                    <dmx-chart id="chart5" dmx-bind:data="SalesReportTimeSeries.data.product_report_by_date" dataset-1:label="Total" dataset-1:value="_['sum(order_item_quantity * order_item_price)']" legend="bottom" points="true" smooth="true" labels="order_time_ordered.toISOTime()" height="300" width="1000" point-size="2" dataset-2:value="_['SUM(order_item_quantity)']" dataset-2:label="Volume"></dmx-chart>

                                </div>
                            </div>


                            <div class="row row-cols-xxl-12 row-cols-12 row-cols-lg-12 justify-content-lg-between justify-content-between mt-3 mb-4">

                                <div class="text-xxl-center col-lg-auto rounded rounded-3 col-md col-xxl-auto col-lg-12 mt-2 ms-2 pt-2 bg-secondary">
                                    <form id="departentReportSelect">
                                        <div class="row">
                                            <div class="col d-flex"><select id="selectDepartment" class="form-select me-2" dmx-bind:options="list_departments.data.query_list_departments" optiontext="department_name" optionvalue="department_id">
                                                    <option selected="" value="%">----</option>
                                                </select><select id="selectOrderItemStatus" class="form-select">
                                                    <option selected="" value="%">----</option>
                                                    <option value="Pending">Pending</option>
                                                    <option value="Ordered">Ordered</option>
                                                    <option value="Ready">Ready</option>
                                                    <option value="Delivered">Delivered</option>
                                                </select></div>
                                        </div>


                                    </form>
                                    <div class="row mt-2">
                                        <div class="col">
                                            <div class="table-responsive">
                                                <table class="table table-hover table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>{{trans.data.product[lang.value]}}</th>
                                                            <th>{{trans.data.quantity[lang.value]}}</th>
                                                            <th>{{trans.data.status[lang.value]}}</th>
                                                            <th>{{trans.data.order[lang.value]}}</th>
                                                            <th>{{trans.data.department[lang.value]}}</th>
                                                            <th>{{trans.data.Ordered[lang.value]}}</th>
                                                            <th>{{trans.data.Processing[lang.value]}}</th>
                                                            <th>{{trans.data.Ready[lang.value]}}</th>
                                                            <th>{{trans.data.Delivered[lang.value]}}</th>
                                                            <th>{{trans.data.note[lang.value]}}</th>
                                                            <th>{{trans.data.execution[lang.value]}}</th>
                                                            <th>{{trans.data.dateTime[lang.value]}}</th>
                                                            <th>{{trans.data.customer[lang.value]}}</th>
                                                            <th>{{trans.data.info[lang.value]}}</th>
                                                            <th>{{trans.data.status[lang.value]}}</th>
                                                            <th>{{trans.data.asset[lang.value]}}</th>
                                                            <th>{{trans.data.service[lang.value]}}</th>
                                                            <th>{{trans.data.category[lang.value]}}</th>
                                                            <th>{{trans.data.attention[lang.value]}}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="product_report_shift_department_admin.data.product_report" id="tableRepeat8">
                                                        <tr dmx-class:group-main="(order_item_group_type)=='Main'" dmx-class:group-accessory="(order_item_group_type)=='Accessory'">
                                                            <td dmx-text="product_name"></td>
                                                            <td dmx-text="order_item_quantity"></td>
                                                            <td dmx-text="trans.data.getValueOrKey(order_item_status)[lang.value]" dmx-class:order-paid="(order_item_status == 'Delivered')" dmx-class:order-ordered="(order_item_status == 'Processing')" dmx-class:order-credit="(order_item_status)=='Ordered'"></td>
                                                            <td dmx-text="order_id"></td>
                                                            <td dmx-text="department_name"></td>
                                                            <td dmx-text="order_time_ordered"></td>
                                                            <td dmx-text="order_time_processing"></td>
                                                            <td dmx-text="order_time_ready"></td>
                                                            <td dmx-text="order_time_delivered"></td>
                                                            <td dmx-text="order_item_notes"></td>
                                                            <td dmx-text="user_prepared"></td>
                                                            <td dmx-text="order_time"></td>
                                                            <td dmx-text="customer_first_name+' '+customer_last_name"></td>
                                                            <td dmx-text="order_extra_info"></td>
                                                            <td dmx-text="order_status"></td>
                                                            <td dmx-text="table_name"></td>
                                                            <td dmx-text="service_name"></td>
                                                            <td dmx-text="product_category_name"></td>
                                                            <td dmx-text="user_username"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane fade scrollable" id="navTabs1_2_3" role="tabpanel" aria-labelledby="navTabs1_2_tab_1">
                            <div class="row mt-3 justify-content-xxl-center">
                                <div class="col-md-6 text-xxl-center">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-sm">
                                            <thead>
                                                <tr>
                                                    <th>{{trans.data.product[lang.value]}}</th>
                                                    <th>{{trans.data.minStock[lang.value]}}</th>
                                                    <th>{{trans.data.inStock[lang.value]}}</th>
                                                </tr>
                                            </thead>
                                            <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_low_stock.data.custom_get_stock_alerts" id="tableRepeat6">
                                                <tr>
                                                    <td dmx-text="product_name"></td>
                                                    <td dmx-text="product_min_stock"></td>
                                                    <td dmx-text="TotalStock"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade scrollable" id="navTabs1_2_4" role="tabpanel" aria-labelledby="navTabs1_2_tab_1">
                            <div class="row mt-2">
                                <div class="col">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>{{trans.data.transaction[lang.value]}}</th>
                                                <th>{{trans.data.type[lang.value]}}</th>
                                                <th>{{trans.data.paymentMethod[lang.value]}}</th>
                                                <th>{{trans.data.note[lang.value]}}</th>
                                                <th>{{trans.data.order[lang.value]}}</th>
                                                <th>{{trans.data.dateTime[lang.value]}}</th>
                                                <th>{{trans.data.user[lang.value]}}</th>
                                                <th>{{trans.data.customer[lang.value]}}</th>
                                                <th>{{trans.data.amountTendered[lang.value]}}</th>
                                                <th>{{trans.data.balance[lang.value]}}</th>
                                                <th>{{trans.data.total[lang.value]}}</th>
                                            </tr>
                                        </thead>
                                        <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="paymentsShift.data.query_list_customer_cash_transactions" id="tableRepeat2">
                                            <tr>
                                                <td dmx-text="customer_transaction_id"></td>
                                                <td dmx-text="transaction_type"></td>
                                                <td dmx-text="payment_method_name"></td>
                                                <td dmx-text="transaction_note"></td>
                                                <td dmx-text="transaction_order"></td>
                                                <td dmx-text="transaction_date"></td>
                                                <td dmx-text="user_username"></td>
                                                <td dmx-text="customer_first_name+' '+customer_last_name"></td>
                                                <td dmx-text="transaction_amount_tendered.formatNumber('0',',',',')"></td>
                                                <td dmx-text="transaction_balance"></td>
                                                <td dmx-text="transaction_amount.formatNumber('0',',',',')"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="rounded col-12 col-md col-md-4 mt-1 shadow-sm bg-light">
                    <dmx-chart id="chart4" dmx-bind:data="payentMethodsShift.data.payment_methods_report_shift" point-size="" type="pie" dataset-1:label="Total" dataset-1:value="TotalPayments" labels="Method+' '+TotalPayments" legend="bottom" width="500" height="350" responsive="true" colors="colors9"></dmx-chart>
                </div>
            </div>
        </div>
    </main>

    <script src="bootstrap/5/js/bootstrap.min.js"></script>
</body>


</html>