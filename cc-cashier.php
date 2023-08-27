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
			"options": {"permissions":"Cashier","loginUrl":"login.php","forbiddenUrl":"login.php","provider":"servo_login"}
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
    <script src="dmxAppConnect/dmxBootstrap5Navigation/dmxBootstrap5Navigation.js" defer=""></script>
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

    <link rel="stylesheet" href="fontawesome5/css/all.min.css" />
    <script src="dmxAppConnect/dmxBootstrap5PagingGenerator/dmxBootstrap5PagingGenerator.js" defer=""></script>
    <script src="dmxAppConnect/dmxBootbox5/bootstrap-modbox.min.js" defer></script>
    <script src="dmxAppConnect/dmxBootbox5/dmxBootbox5.js" defer></script>


    <script src="dmxAppConnect/dmxBootstrap5Popovers/dmxBootstrap5Popovers.js" defer></script>
    <link rel="stylesheet" href="bootstrap/5/servodark/bootstrap.min.css" />
    <link rel="stylesheet" href="css/bootstrap-icons.css" />
    <link rel="stylesheet" href="bootstrap/5/css/bootstrap.min.css" />
    <link rel="stylesheet" href="dmxAppConnect/dmxPreloader/dmxPreloader.css" />
    <script src="dmxAppConnect/dmxPreloader/dmxPreloader.js" defer></script>
</head>

<body is="dmx-app" id="ServoCashier" dmx-on:ready="preloader.hide()">
    <dmx-preloader id="preloader" spinner="wave" bgcolor="#8A8686" ,255,255,0.99),255,255,0.97)=""></dmx-preloader>

    <dmx-query-manager id="c_search"></dmx-query-manager>

    <dmx-serverconnect id="load_product_categories" url="dmxConnect/api/servo_refered_fields_loading/load_product_categories.php"></dmx-serverconnect>

    <dmx-serverconnect id="loadCompanyInfo" url="dmxConnect/api/servo_company_information/read_company_information.php" dmx-param:company_info_id="1"></dmx-serverconnect>

    <dmx-serverconnect id="list_departments" url="dmxConnect/api/servo_departments/list_departments.php"></dmx-serverconnect>

    <dmx-serverconnect id="load_customers" url="dmxConnect/api/servo_customers/list_customers_paged.php" dmx-param:limit="5" dmx-param:offset="c_search.data.offset" dmx-param:customerfilter="updateOrderCashierStandard.customerSearch.value" noload></dmx-serverconnect>
    <dmx-serverconnect id="list_users" url="dmxConnect/api/servo_users/list_users.php" dmx-param:limit="5" dmx-param:offset="c_search.data.offset" dmx-param:customerfilter="updateOrderCashierStandard.customerSearch.value"></dmx-serverconnect>
    <dmx-serverconnect id="loadPaymentMethods" url="dmxConnect/api/servo_payment_methods/list_payment_methods.php"></dmx-serverconnect>
    <dmx-serverconnect id="update_order" url="dmxConnect/api/servo_orders/update_order_standard.php" noload></dmx-serverconnect>

    <dmx-serverconnect id="list_user_shift_info" url="dmxConnect/api/servo_user_shifts/list_user_shift_info.php" dmx-param:shift_id="session_variables.data.current_shift" dmx-param:user_id="session_variables.data.user_id"></dmx-serverconnect>
    <dmx-serverconnect id="list_customer_transactions_order" url="dmxConnect/api/servo_customer_cash_transactions/list_transactions_customer_order.php" dmx-param:order_id="session_variables.data.current_order"></dmx-serverconnect>

    <dmx-value id="lang" dmx-bind:value="browser1.language"></dmx-value>
    <dmx-json-datasource id="trans" is="dmx-serverconnect" url="assets/translation/translation.JSON"></dmx-json-datasource>
    <dmx-scheduler id="scheduler1" dmx-on:tick="total_sales_all_waiters_in_per_shift.load({current_shift: session_variables.data.current_shift, order_status: 'Paid'});total_sales_all_waiters_out_per_shift.load({current_shift: session_variables.data.current_shift, order_status: 'Ordered'});list_orders_all_shift_department.load({current_shift: session_variables.data.current_shift, sales_point_id: list_user_shift_info.data.query_list_user_shift[0].servo_sales_point_sales_point_id})" delay="10"></dmx-scheduler>
    <dmx-datetime id="dateTime"></dmx-datetime>
    <dmx-serverconnect id="total_sales_all_waiters_in_per_shift" url="dmxConnect/api/servo_data/total_sales_all_waiters_in_per_shift.php" dmx-param:user_id="session_variables.data.user_id" dmx-param:order_status="'Paid'" dmx-param:current_shift="session_variables.data.current_shift" dmx-param:department_id="list_user_shift_info.data.query_list_user_shift[0].user_shift_department_id" dmx-param:sales_point="list_user_shift_info.data.query_list_user_shift[0].servo_sales_point_sales_point_id"></dmx-serverconnect>
    <dmx-serverconnect id="total_sales_all_waiters_out_per_shift" url="dmxConnect/api/servo_data/total_sales_all_waiters_out_per_shift.php" dmx-param:user_id="session_variables.data.user_id" dmx-param:current_shift="session_variables.data.current_shift" dmx-param:order_status="'Ordered'" dmx-param:department_id="list_user_shift_info.data.query_list_user_shift[0].user_shift_department_id" dmx-param:sales_point="list_user_shift_info.data.query_list_user_shift[0].servo_sales_point_sales_point_id"></dmx-serverconnect>
    <dmx-serverconnect id="delte_item_order_item" url="dmxConnect/api/servo_order_items/delete_order_item.php"></dmx-serverconnect>
    <dmx-serverconnect id="list_order_items_current" url="dmxConnect/api/servo_order_items/list_order_items_current.php" dmx-param:order_id="session_variables.data.current_order"></dmx-serverconnect>
    <dmx-serverconnect id="get_order_total" url="dmxConnect/api/servo_order_items/compute_order_total.php" dmx-param:order_id="session_variables.data.current_order"></dmx-serverconnect>
    <dmx-serverconnect id="list_order_items" url="dmxConnect/api/servo_order_items/list_order_items.php" dmx-param:order_id="session_variables.data.current_order" dmx-on:start="readItemModal.preloader1.show()" dmx-on:done="readItemModal.preloader1.hide()"></dmx-serverconnect>
    <dmx-serverconnect id="load_products" url="dmxConnect/api/servo_products/list_products_per_service.php" dmx-param:category="" dmx-param:name="" dmx-param:search="AddProductsToOrderOffCanvas.searchProducts2.value" dmx-param:department_id="list_user_shift_info.data.query_list_user_shift[0].user_shift_department_id" dmx-param:service_id="list_user_shift_info.data.query_list_user_shift[0].servo_service_service_id" dmx-param:product_filter=""></dmx-serverconnect>
    <dmx-serverconnect id="load_product_groups" url="dmxConnect/api/servo_product_groups/list_product_groups.php" dmx-param:category="" dmx-param:name="" dmx-param:search="searchProduct.value" dmx-param:department_id="list_user_shift_info.data.query_list_user_shift[0].user_shift_department_id" dmx-param:product_group_id="load_product_groups.data.list_product_groups[0].product_group_id"></dmx-serverconnect>
    <dmx-session-manager id="session_variables"></dmx-session-manager>
    <dmx-serverconnect id="load_tables" url="dmxConnect/api/servo_tables/list_tables.php"></dmx-serverconnect>

    <dmx-serverconnect id="read_item_order" url="dmxConnect/api/servo_orders/read_order.php" dmx-param:id="id" noload dmx-param:item_id="" dmx-param:branch_id="read_item_branch.data.queryReadBranch.branch_id" dmx-param:department_id="" dmx-param:order_id=""></dmx-serverconnect>
    <dmx-serverconnect id="delete_item_order" url="dmxConnect/api/servo_departments/delete_department.php"></dmx-serverconnect>
    <dmx-serverconnect id="list_orders_all_shift_department" url="dmxConnect/api/servo_orders/list_orders_all_shift_department.php" dmx-param:user_id="" dmx-param:current_shift="session_variables.data.current_shift" dmx-param:department_id="list_user_shift_info.data.query_list_user_shift[0].user_shift_department_id" dmx-param:sales_point_id="list_user_shift_info.data.query_list_user_shift[0].servo_sales_point_sales_point_id"></dmx-serverconnect>
    <dmx-serverconnect id="paid_ordered" url="dmxConnect/api/servo_orders/update_order_paid_ordered.php" dmx-param:order_id="read_item_order.data.query.order_id"></dmx-serverconnect>
    <dmx-serverconnect id="paymentsShift" url="dmxConnect/api/servo_customer_cash_transactions/list_transactions_shift.php" dmx-param:shift="session_variables.data.current_shift" dmx-param:shift_id="list_user_shift_info.data.query_list_user_shift[0].servo_shifts_shift_id"></dmx-serverconnect>
    <div is="dmx-browser" id="browser1"></div>
    <dmx-notifications id="notifies1" timeout="20" position="bottom" extended-timeout="20"></dmx-notifications>
    <?php include 'header.php'; ?>
    <main>

        <div class="modal" id="SelectTableModal" is="dmx-bs5-modal" tabindex="-1">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{trans.data.select[lang.value]}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="d-flex flex-wrap flex-row justify-content-center flex-sm-wrap flex-md-row justify-content-md-center col">
                                    <div dmx-repeat:repeat2="load_tables.data.query_list_tables">
                                        <button id="btn2" class="btn btn-lg mt-0 mb-2 ms-0 me-2 pt-5 pb-5 ps-5 pe-5 bg-info text-white" dmx-text="table_name" dmx-on:click="session_variables.set('table_id',table_id);SelectTableModal.hide();CreateOrderModal.show()">Button</button>

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
                                            <input id="inp_order_time_ordered" name="order_time_ordered" class="form-control mb-sm-1 mb-2 visually-hidden" type="datetime-local" dmx-bind:value="dateTime.datetime">
                                            <input id="inp_order_time_ready" name="order_time_ready" class="form-control mb-sm-1 mb-2 visually-hidden" type="datetime-local" dmx-bind:value="dateTime.datetime">
                                            <input id="inp_order_time_delivered" name="order_time_delivered" class="form-control mb-sm-1 mb-2 visually-hidden" type="datetime-local" dmx-bind:value="dateTime.datetime">
                                            <input id="inp_order_item_status" name="order_item_status" class="form-control mb-sm-1 mb-2 visually-hidden" value="Ordered">
                                            <input id="inp_order_id" name="servo_orders_order_id" type="number" class="form-control mb-sm-1 mb-2 visually-hidden" dmx-bind:value="session_variables.data.current_order">
                                            <input id="inp_order_product_id" name="servo_products_product_id" type="number" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="1" dmx-bind:value="product_id">
                                            <input id="inp_order_item_price" name="order_item_price" type="number" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="1" dmx-bind:value="product_price">
                                            <input id="inp_order_item_user_ordered" name="servo_users_user_ordered" type="number" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="1" dmx-bind:value="product_price">
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
                            <h5 class="offcanvas-title">{{trans.asset.table[lang.value]}}:</h5>
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
                                            <form is="dmx-serverconnect-form" id="create_order_form" method="post" action="dmxConnect/api/servo_orders/create_order.php" dmx-on:success="notifies1.success('Order #'+create_order_form.data.custom[0]['last_insert_id()']+' Created');session_variables.set('current_order',create_order_form.data.custom[0]['last_insert_id()']);
        read_item_order.load({order_id: create_order_form.data.custom[0]['last_insert_id()']});CreateOrderModal.hide();list_orders.load();create_order_form.reset();readItemModal.show()">
                                                <input id="order_time" name="order_time" class="form-control visually-hidden" dmx-bind:value="dateTime.datetime">
                                                <input id="order_discount" name="order_discount" type="hidden" class="form-control visually-hidden" dmx-bind:value="0">
                                                <input id="order_discount1" name="servo_service_service_id" type="hidden" class="form-control visually-hidden" dmx-bind:value="list_user_shift_info.data.query_list_user_shift[0].servo_service_service_id">
                                                <input id="order_status" name="order_status" type="hidden" class="form-control visually-hidden" dmx-bind:value="'Ordered'">
                                                <input id="table" name="servo_customer_table_table_id" type="hidden" class="form-control visually-hidden" dmx-bind:value="session_variables.data.table_id">
                                                <input id="user_id" name="servo_user_user_id" type="hidden" class="form-control visually-hidden" dmx-bind:value="session_variables.data.user_id">

                                                <input id="shift_id" name="servo_shift_shift_id" type="hidden" class="form-control visually-hidden" dmx-bind:value="session1.data.current_shift">
                                                <div class="row row-cols-1">
                                                    <div class="d-flex border-warning col"><button id="btn7" class="btn btn-lg me-0 pt-5 pb-5 ps-5 pe-5 bg-info" type="submit">{{trans.data.create[lang.value]}}</button>
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
    </main>
    <main id="expenses">
        <div class="modal create-modal" id="expenseModal" is="dmx-bs5-modal" tabindex="-1">
            <dmx-serverconnect id="list_expenses" url="dmxConnect/api/servo_expenses/list_expenses_shift.php" dmx-param:id="id" dmx-param:item_id="" dmx-param:user_id="" dmx-param:customer_id="session_variables.data.current_customer" dmx-param:shift="list_user_shift_info.data.query_list_user_shift[0].servo_shifts_shift_id"></dmx-serverconnect>
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" wappler-command="editContent">{{trans.data.expenses[lang.value]}}</h5>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wappler-empty="undefined" wappler-command="editContent"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <div class="row" id="expensesTotal">
                                    <div class="col d-flex justify-content-end">
                                        <h4 class="text-light">{{trans.data.total[lang.value]}}:&nbsp;</h4>
                                        <h4 dmx-text="list_expenses.data.list_expenses_shift.sum(`expense_amount`).formatNumber('0',',',',')" class="fw-bold text-light"></h4>
                                    </div>
                                </div>
                                <ul class="nav nav-tabs" id="navTabs1_tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active fw-bold" id="navTabs1_1_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_111" role="tab" aria-controls="navTabs1_1" aria-selected="true" wappler-command="editContent">{{trans.data.newExpense[lang.value]}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link fw-bold" id="navTabs1_2_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_222" role="tab" aria-controls="navTabs1_2" aria-selected="false" wappler-command="editContent">{{trans.data.expenses[lang.value]}}</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="navTabs1_content">
                                    <div class="tab-pane fade show active" id="navTabs1_111" role="tabpanel">

                                        <div class="row mt-2">
                                            <div class="col-9 border rounded border-secondary mt-1 ms-3 pt-3 pb-3">
                                                <form id="createExpenseForm" is="dmx-serverconnect-form" method="post" action="dmxConnect/api/servo_expenses/create_expense.php" dmx-on:success="list_expenses.load({});createExpenseForm.reset()">
                                                    <input id="expenseDate" name="expense_date_paid" type="datetime-local" class="form-control visually-hidden" dmx-bind:value="dateTime.datetime">
                                                    <input id="expenseUserPaid" name="expense_user_paid" class="form-control visually-hidden" dmx-bind:value="list_user_info.data.query_list_user_info.user_id" type="number">
                                                    <input id="expenseStatus" name="expense_status" class="form-control visually-hidden" dmx-bind:value="'Paid'">
                                                    <input id="expenseShift" name="expense_shift" class="form-control visually-hidden" dmx-bind:value="list_user_shift_info.data.query_list_user_shift[0].servo_shifts_shift_id">
                                                    <div class="form-group mb-3 row" id="expenseAmount">
                                                        <label for="expenseAmount1" class="col-sm-2 col-form-label" wappler-command="editContent">{{trans.data.amount[lang.value]}}</label>
                                                        <div class="col-sm-10">
                                                            <input type="number" class="form-control" id="expenseAmount1" name="expense_amount" aria-describedby="input1_help" required="" data-msg-required="!" min="1" data-rule-min="1" data-msg-min="!">
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-3 row" id="expenseDepartment">
                                                        <label for="expenseDepartment" class="col-sm-2 col-form-label" wappler-command="editContent">{{trans.data.department[lang.value]}}</label>
                                                        <div class="col-sm-10">
                                                            <select id="expenseDepartment1" class="form-select" name="expense_department" dmx-bind:options="list_departments.data.query_list_departments" optiontext="department_name" optionvalue="department_id" dmx-bind:required="">
                                                                <option selected="" value="">----</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-3 row" id="expenseUserReceived">
                                                        <label for="expenseUserReceived" class="col-sm-2 col-form-label" wappler-command="editContent">{{trans.data.user[lang.value]}}</label>
                                                        <div class="col-sm-10">
                                                            <select id="expenseDepartment12" class="form-select" name="expense_user_received" dmx-bind:options="list_users.data.query_list_users" optiontext="user_username" optionvalue="user_id" dmx-bind:required="">
                                                                <option selected="" value="">----</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-3 row" id="expenseUserReceived1">
                                                        <label for="expenseUserReceived1" class="col-sm-2 col-form-label" wappler-command="editContent">{{trans.data.paymentMethod[lang.value]}}</label>
                                                        <div class="col-sm-10">
                                                            <select id="expensePaymentMethod" class="form-select" name="expense_payment_method" dmx-bind:options="loadPaymentMethods.data.query" dmx-bind:required="'!'" optiontext="payment_method_name" optionvalue="payment_method_id">
                                                                <option selected="" value="">----</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-3 row" id="expenseNote">
                                                        <label for="expenseDescription" class="col-sm-2 col-form-label" wappler-command="editContent">{{trans.data.note[lang.value]}}</label>
                                                        <div class="col-sm-10">
                                                            <textarea type="text" class="form-control" id="expenseDescription" name="expense_description" aria-describedby="input1_help"></textarea>
                                                        </div>
                                                    </div>
                                                    <button id="btn25" class="btn btn-info" type="submit" wappler-empty="Editable" wappler-command="editContent">
                                                        <i class="fas fa-check fa-2x"></i>
                                                    </button>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="navTabs1_222" role="tabpanel" wappler-empty="Tab Pane" wappler-command="addElementInside">
                                        <div class="row">
                                            <div class="table-responsive">
                                                <table class="table table-hover table-sm">
                                                    <thead>
                                                        <tr>

                                                            <th>{{trans.data.dateTime[lang.value]}}</th>
                                                            <th>{{trans.data.description[lang.value]}}</th>
                                                            <th>{{trans.data.username[lang.value]}}</th>
                                                            <th>{{trans.data.username[lang.value]}}</th>
                                                            <th>{{trans.data.department[lang.value]}}</th>
                                                            <th>{{trans.data.amount[lang.value]}}</th>
                                                            <th>{{trans.data.paymentMethod[lang.value]}}</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_expenses.data.list_expenses_shift" id="tableRepeat11">
                                                        <tr>

                                                            <td dmx-text="expense_date_paid"></td>
                                                            <td dmx-text="expense_description"></td>
                                                            <td dmx-text="user_paid_name"></td>
                                                            <td dmx-text="user_received_name"></td>
                                                            <td dmx-text="department_name"></td>
                                                            <td dmx-text="expense_amount.formatNumber('0',',',',')" class="text-end"></td>
                                                            <td dmx-text="payment_method_name" class="text-center"></td>
                                                            <td>
                                                                <div class="row">
                                                                    <form id="deleteExpense" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_expenses/delete_expense.php" dmx-on:success="notifies1.success('Success!');list_expenses.load()" dmx-on:error="notifies1.danger('Error!')">
                                                                        <input id="text14" name="expense_id" type="text" class="form-control visually-hidden" dmx-bind:value="expense_id">
                                                                        <button id="btn26" class="btn text-white-50" type="submit">
                                                                            <i class="far fa-trash-alt"></i>
                                                                        </button>
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

                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
    </main>
    <main>
        <div class="modal " id="printReceipt" is="dmx-bs5-modal" tabindex="-1" dmx-on:hidden-bs-modal="total_sales_per_waiter.load();readItemModal.toggle()" dmx-on:shown-bs-modal="readItemModal.toggle()">
            <div class="modal-dialog modal-fullscreen modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header" id="receiptheader">
                        <div class="d-block"><button id="receiptBack" class="btn float-right btn-sm text-body" data-bs-target="#readItemModal" dmx-on:click="printReceipt.hide()" data-bs-toggle="modal"><i class="fas fa-chevron-left fa-2x">&nbsp;</i></button>
                            <button id="receiptPrint" class="btn float-right btn-sm text-body bg-light rounded" data-bs-target="#readItemModal" onclick="print()"><i class="fas fa-print">&nbsp;</i></button>
                        </div>


                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body" id="receiptModal">
                        <div class="row">
                            <div class="col" id="companyname">
                                <div class="d-block text-center">
                                    <img dmx-bind:src="'uploads/'+loadCompanyInfo.data.query.company_logo" height="150">
                                </div>
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
                        <main>
                            <div class="container mt-auto" id="receiptBody">




                                <div class="row">
                                    <div class="col d-flex justify-content-end" id="receiptTotal1"></div>
                                </div>
                                <div class="row justify-content-start">
                                    <div class="col">
                                        <div class="row justify-content-xxl-start">
                                            <div class="col me-2 d-flex col-xxl">
                                                <h6 class="me-1 fw-bold">{{trans.data.timeOrdered[lang.value]}}:</h6>
                                                <h6 class="me-1 fw-bold" dmx-text="read_item_order.data.query.order_time"></h6>
                                            </div>
                                        </div>
                                        <div class="row justify-content-xxl-start">
                                            <div class="col me-2 d-flex col-xxl">
                                                <h6 class="me-1 fw-bold">{{trans.data.timePrinted[lang.value]}}:</h6>
                                                <h6 class="me-1 fw-bold" dmx-text="dateTime.datetime"></h6>
                                            </div>
                                        </div>
                                        <div class="row justify-content-xxl-start">
                                            <div class="col me-2 d-flex col-xxl">
                                                <h6 class="me-1 fw-bold">{{trans.data.order[lang.value]}}:</h6>
                                                <h6 class="me-1 fw-bold" dmx-text="'#'+read_item_order.data.query.order_id"></h6>
                                            </div>
                                            <div class="col me-2 d-flex col-xxl">
                                                <h6 class="me-1 fw-bold">{{trans.data.asset[lang.value]}}:</h6>
                                                <h6 class="me-1 fw-bold" dmx-text="list_order_items.data.query[0].table_name"></h6>
                                            </div>
                                            <div class="col me-2 d-flex col-xxl">
                                                <h6 class="me-1 fw-bold">{{trans.data.customer[lang.value]}}:</h6>
                                                <h6 class="me-1 fw-bold" dmx-text="read_item_order.data.query.customer_first_name+' '+read_item_order.data.query.customer_last_name"></h6>
                                            </div>
                                        </div>
                                        <div class="row justify-content-xxl-start">
                                            <div class="col me-2 d-flex col-xxl">
                                                <h6 class="me-1 fw-bold">{{trans.data.cashier[lang.value]}}:</h6>
                                                <h6 class="me-1 fw-bold" dmx-text="session_variables.data.current_user"></h6>
                                            </div>
                                            <div class="col me-2 d-flex col-xxl">
                                                <h6 class="me-1 fw-bold">{{trans.data.waiter[lang.value]}}:</h6>
                                                <h6 class="me-1 fw-bold" dmx-text="read_item_order.data.query.user_username"></h6>
                                            </div>
                                        </div>

                                    </div>


                                </div>
                                <div class="row" id="receipt" style="height: 450px; overflow: scroll;">
                                    <div class="col">


                                        <div class="row">
                                            <div class="col">
                                                <div class="table-responsive" id="order_details_table1">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>{{trans.data.product[lang.value]}}</th>
                                                                <th>{{trans.data.qty[lang.value]}}</th>
                                                                <th>{{trans.data.price[lang.value]}}</th>
                                                                <th>{{trans.data.total[lang.value]}}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_order_items.data.query" id="tableRepeat44">
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
        <div class="modal readitem shadow" id="readItemModal" is="dmx-bs5-modal" tabindex="-1" dmx-on:hidden-bs-modal="total_sales_per_waiter.load();updateOrderCashier.reset()">
            <dmx-preloader id="preloader1" spinner="wave" bgcolor="#8A8686" ,255,255,0.99),255,255,0.97)=""></dmx-preloader>
            <dmx-value id="orderTotal" dmx-bind:value="list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`)"></dmx-value>
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <div class="d-block d-flex">
                            <button id="btn13" class="btn float-left text-body" data-bs-target="#printReceipt" dmx-on:click="printReceipt.show(); print()" dmx-animate-enter.duration:20000.delay:100="pulse" dmx-bs-tooltip="trans.data.print[lang.value]" data-bs-placement="bottom" data-bs-trigger="hover">
                                <i class="fas fa-receipt fa-lg"></i>
                            </button>
                            <button id="btn10" class="btn float-left text-info" dmx-show="(profile_privileges.data.profile_privileges[0].create_order== &quot;Yes&quot;) &amp;&amp; (read_item_order.data.query.order_status !==&quot;Paid&quot;)" data-bs-target="#AddProductsToOrderOffCanvas" dmx-animate-enter.duration:20000.delay:100="pulse" data-bs-toggle="offcanvas" dmx-bs-tooltip="trans.data.addProducts[lang.value]" data-bs-trigger="hover focus" data-bs-placement="bottom">
                                <i class="fas fa-plus fa-lg"></i>
                            </button>
                            <form id="updateItemsToOrdered2" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_order_items/update_order_item_to_ordered.php">
                                <input id="orderId2" name="servo_orders_order_id" type="number" class="form-control visually-hidden" dmx-bind:value="session_variables.data.current_order">
                                <input id="orderItemStatus3" name="order_item_status" class="form-control visually-hidden" dmx-bind:value="'Ordered'">
                                <button id="sendOrderItems2" class="btn text-info" dmx-on:click="run({'bootbox.confirm':{message:'\n',buttons:{confirm:{label:'Confirm',className:'btn-primary'},cancel:{label:'Cancel',className:'btn-secondary'}},centerVertical:true,then:{steps:[{run:{action:`updateItemsToOrdered2.submit()`}},{run:{action:`list_order_items.load({order_id: read_item_order.data.query.order_id})`}}]},name:'confirmOrders'}})" dmx-bs-tooltip="trans.data.send[lang.value]" data-bs-placement="bottom" data-bs-trigger="hover focus" dmx-hide="(list_order_items.data.query.where(`order_item_status`, 'Pending', '=='))==0"><i class="fas fa-paper-plane fa-2x"></i></button>
                            </form>
                        </div>



                        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="offcanvas offcanvas-start" id="AddProductsToOrderOffCanvas" is="dmx-bs5-offcanvas" tabindex="-1" style="width: 99%;">
                            <div class="offcanvas-header bg-secondary">
                                <h5 class="offcanvas-title">{{trans.data.addProducts[lang.value]}}</h5>
                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body bg-secondary">
                                <div class="row scrollable row-cols-xxl-12 mt-2" id="productDisplay">
                                    <div class="col">
                                        <ul class="nav nav-tabs" id="navTabs1_tabs" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="navTabs1_1_1tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_1_1" role="tab" aria-controls="navTabs1_1" aria-selected="true">{{trans.data.products[lang.value]}}</a>
                                            </li>
                                            <li class="nav-item visually-hidden">
                                                <a class="nav-link" id="navTabs1_3_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_1_3" role="tab" aria-controls="navTabs1_3" aria-selected="false">{{trans.data.services[lang.value]}}</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="navTabs1_2_2tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_2_2" role="tab" aria-controls="navTabs1_2" aria-selected="false">{{trans.data.grouped[lang.value]}}</a>
                                            </li>

                                        </ul>
                                        <div class="tab-content" id="navTabs1_1content">
                                            <div class="tab-pane fade show active" id="navTabs1_1_1" role="tabpanel">
                                                <div class="row mt-2">
                                                    <div class="col d-flex"><input id="searchProducts1" name="text1" type="text" class="form-control mb-1" dmx-bind:value="searchProducts1.value" dmx-on:changed="load_products.load({service_id: list_user_shift_info.data.query_list_user_shift[0].servo_service_service_id, search: searchProducts1.value})" dmx-bind:placeholder="trans.data.search[lang.value]"><button id="btn17" class="btn ms-2 me-2 btn-info text-white" dmx-on:click="searchProducts1.setValue(null);load_products.load({service_id: list_user_shift_info.data.query_list_user_shift[0].servo_service_service_id})">
                                                            <i class="fas fa-backspace"></i>
                                                        </button>
                                                        <button id="btn181" class="btn ms-2 me-2 btn-info text-white" dmx-on:click="AddProductsToOrderOffCanvas.btn181.toggleCategorySelect2.toggle()"> Categories
                                                            <dmx-toggle id="toggleCategorySelect2"></dmx-toggle><i class="fas fa-chevron-down"></i>
                                                        </button>
                                                        <button id="toggleProductPic" class="btn ms-2 me-2 btn-info text-white" dmx-on:click="AddProductsToOrderOffCanvas.toggleProductPic.toggleProductPictures.toggle()">
                                                            <dmx-toggle id="toggleProductPictures" checked="true"></dmx-toggle><i class="far fa-images"></i>
                                                        </button>

                                                    </div>
                                                </div>
                                                <div class="row mt-2">
                                                    <div class="col" is="dmx-if" id="conditional33" dmx-bind:condition="btn181.toggleCategorySelect2.checked">
                                                        <div id="repeatProductCategories" is="dmx-repeat" dmx-bind:repeat="load_product_categories.data.query"><button id="btn11" class="btn mb-1 me-1 btn-info text-white" dmx-text="product_category_name" dmx-on:click="searchProductCategories.setValue(product_categories_id);load_products.load({product_category: product_categories_id})"></button></div>

                                                    </div>
                                                </div>
                                                <div class="row mt-md-1 ms-md-1 me-md-1 mt-sm-1 ms-sm-1 me-sm-1 mt-xxl-1 ms-xxl-1 me-xxl-1 mt-xl-1 ms-xl-1 me-xl-1 mt-lg-1 ms-lg-1 me-lg-1 mt-0 ms-1 me-1" style="margin: 2px !important;">
                                                    <div class="flex-md-wrap flex-md-row justify-content-md-center align-content-center mt-2 mb-2 ms-1 me-1 pt-3 pb-3 ps-3 pe-3 offset-md-1 col-sm-5 border-dark col-xxl-3 col-xl-3 col-lg-3 col-md-5 col-12 shadow-sm rounded-bottom bg-light" dmx-repeat:repeatproducts="load_products.data.repeat" style="padding-top: 0px !important; margin-top: .5rem !;" id="productRepeats">
                                                        <form id="form3" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_order_items/create_order_item.php" dmx-on:success="form3.reset();list_order_items.load({order_id: session_variables.data.current_order});notifies1.success('Success:'+product_name+' Added to Order');list_customer_transactions_order_totals.load({order_id: session_variables.data.current_order});list_customer_orders_totals.load({customer_id: session_variables.data.current_customer})" dmx-on:error="notifies1.danger('Error!')">
                                                            <div class="row mt-xxl-2 product-pic" id="productPic" dmx-hide="toggleProductPic.toggleProductPictures.checked">
                                                                <div class="col text-center mt-2" style="padding: 0px !important; height: 200px;" dmx-hide="product_picture==null">
                                                                    <img dmx-bind:src="'/servo/uploads/product_pictures/'+product_picture" width="100%" height="95%" loading="lazy" style="object-fit: cover;">
                                                                </div>
                                                                <div class="col text-center" style="padding: 0px !important; height: 200px;" dmx-hide="product_picture!==null">
                                                                    <img width="100%" height="95%" loading="lazy" style="object-fit: cover;" src="uploads/servo_no_image2.jpg">
                                                                </div>
                                                            </div>
                                                            <div class="row mt-2 pt-2 ps-2 pe-2">
                                                                <div class="col d-flex justify-content-start">
                                                                    <h5 class="text-center text-body">{{product_name}}</h5>
                                                                </div>
                                                                <div class="col d-flex justify-content-end">
                                                                    <h4 class="text-center text-body">{{product_price}}</h4>
                                                                </div>
                                                            </div>


                                                            <div class="row justify-content-between mb-2 text-center">
                                                                <div class="col-4">
                                                                    <button id="btn5" class="btn btn-lg text-muted shadow-none" dmx-on:click="form3.inp_order_item_quantity.setValue((inp_order_item_quantity.value.toNumber()-1) )"><i class="fas fa-minus"></i>
                                                                    </button>
                                                                </div>

                                                                <div class="col-4 text-center" style="padding: 0px !important;"><input id="inp_order_item_quantity" name="order_item_quantity" type="number" class="form-control mb-sm-1 mb-2 form-control-lg" placeholder="1" min="" data-rule-min="1" data-msg-min="Min. 1" style="width: 100% !important; border: 1px solid #696969 !important; border: none; background-color: transparent !important; color: #a1a1a1 !important;" dmx-bind:value="1"></div>
                                                                <div class="col-4">
                                                                    <button id="btn16" class="btn btn-lg text-muted shadow-none" dmx-on:click="form3.inp_order_item_quantity.setValue((inp_order_item_quantity.value.toNumber()+1) )"><i class="fas fa-plus"></i>
                                                                    </button>
                                                                </div>
                                                            </div><input id="inp_order_time_ordered" name="order_time_ordered" class="form-control mb-sm-1 mb-2 visually-hidden" type="datetime-local" dmx-bind:value="dateTime.datetime"><input id="inp_order_item_status" name="order_item_status" class="form-control mb-sm-1 mb-2 visually-hidden" value="Pending"><input id="inp_order_id" name="servo_orders_order_id" type="number" class="form-control mb-sm-1 mb-2 visually-hidden" dmx-bind:value="session_variables.data.current_order"><input id="inp_order_product_id" name="servo_products_product_id" type="number" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="1" dmx-bind:value="product_id"><input id="inp_order_item_price" name="order_item_price" type="number" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="1" dmx-bind:value="product_price">
                                                            <input id="inp_order_item_type" name="order_item_type" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="1" dmx-bind:value="'Simple'">
                                                            <input id="inp_order_item_user_ordered2" name="servo_users_user_ordered" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="1" dmx-bind:value="session_variables.data.user_id" type="number">

                                                            <input id="orderitemDepartment" name="servo_departments_department_id" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="1" dmx-bind:value="sdc_department_id" type="number">
                                                            <textarea id="inp_order_notes" class="form-control" name="order_item_notes"></textarea>
                                                            <div class="row row-cols-xxl-7 mt-2 mt-sm-2 mt-md-2 mt-lg-2 mt-xl-2 mt-xxl-2" id="optionsrow">
                                                                <div class="w-25 flex-xxl-wrap justify-content-xxl-start d-flex col">
                                                                    <div id="repeatOptions" is="dmx-repeat" dmx-bind:repeat="query_list_options">
                                                                        <button class="btn mb-xxl-2 me-xxl-2 button-repeat text-body bg-opacity-75 bg-secondary" dmx-text="category_option_option" dmx-bind:value="category_option_option" dmx-on:click="form3.inp_order_notes.setValue(form3.inp_order_notes.value+' '+optionsButton.value+' ')" id="optionsButton">Button</button>
                                                                    </div>



                                                                </div>



                                                            </div>
                                                            <div class="row row-cols-xxl-7 mt-2 mb-2 row-cols-12 justify-content-between" id="buttons">
                                                                <div class="col"><button id="btn8" class="add-item-button btn align-self-end btn-lg lh-1 text-info" dmx-on:click="form3.inp_order_notes.setValue(null)">
                                                                        <i class="fas fa-undo fa-lg"></i>
                                                                    </button></div>

                                                                <div class="col w-25 flex-xxl-wrap justify-content-xxl-start">
                                                                    <div id="repeatStock" is="dmx-repeat" dmx-bind:repeat="query_list_product_stock">
                                                                        <button id="btn33" class="btn fw-bold btn-sm btn-outline-link" dmx-text="trans.data.inStock[lang.value]+': '+TotalStock" dmx-class:redlight.redlight="TotalStock<=product_min_stock">
                                                                        </button>

                                                                    </div>



                                                                </div>
                                                                <div class="col w-25 flex-xxl-wrap justify-content-xxl-start">



                                                                    <button id="btn12" class="add-item-button btn align-self-end btn-lg text-success" type="submit">
                                                                        <i class="fas fa-cart-plus fa-lg"></i>
                                                                    </button>
                                                                </div>

                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="tab-pane fade" id="navTabs1_2_2" role="tabpanel">
                                                <div class="row mt-md-1 mt-2">
                                                    <div class="flex-xxl-wrap border border-secondary col-md-4 mb-sm-2 me-sm-2 col-lg-3 col-xl-3 col-xxl-3 mt-xxl-0 mb-xxl-3 me-xxl-3 pt-xxl-3 pb-xxl-1 ps-xxl-1 pe-xxl-1 mb-1 me-1" dmx-repeat:repeatproductgroups="load_product_groups.data.repeat_list_product_groups">
                                                        <form id="form4"></form>
                                                        <div class="row mt-2">
                                                            <div class="col">
                                                                <h3 class="text-center text-warning" dmx-text="product_group_name"></h3>
                                                            </div>
                                                        </div>
                                                        <form id="addGroupedItemsToOrder" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_product_groups/add_grouped_products_to_order.php" dmx-on:success="form3.reset();list_order_items.load({order_id: session_variables.data.current_order});notifies1.success('Success:'+product_name+' Added to Order')">
                                                            <input id="text6" name="servo_orders_order_id" type="text" class="form-control visually-hidden" dmx-bind:value="session_variables.data.current_order">
                                                            <input id="text7" name="servo_users_user_ordered" type="text" class="form-control visually-hidden" dmx-bind:value="session_variables.data.user_id">
                                                            <input id="text8" name="product_group_id" type="text" class="form-control visually-hidden" dmx-bind:value="product_group_id">
                                                            <input id="text9" name="order_time_ordered" type="text" class="form-control visually-hidden" dmx-bind:value="dateTime.datetime">


                                                            <div class="row row-cols-xxl-7 justify-content-between mt-2 mb-2" id="buttons1">
                                                                <div class="col w-25 flex-xxl-wrap justify-content-xxl-start d-flex justify-content-end">



                                                                    <button id="btn14" class="add-item-button btn btn-warning align-self-end btn-lg" type="submit">
                                                                        <i class="fas fa-plus"></i>
                                                                    </button>
                                                                </div>

                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-xxl-start justify-content-lg-start justify-content-md-start justify-content-sm-start justify-content-xl-start row-cols-xl-7 g-0 justify-content-between row-cols-12 rounded bg-secondary pt-2 pb-2 ps-2 pe-2">

                            <div class="d-flex col-xl-auto rounded rounded-3 ms-2 pt-2 justify-content-start col-auto">
                                <h6 class="fw-bolder text-body me-1" dmx-text="'#'+read_item_order.data.query.order_id+' |'"></h6>
                                <h6 class="fw-bold text-body ms-2 me-1" dmx-text="read_item_order.data.query.user_username.titlecase()+'    |'"></h6>
                                <h6 class="fw-bold text-body ms-2" dmx-text="list_order_items.data.query[0].table_name">&nbsp;</h6>
                            </div>
                            <div class="justify-content-xl-end offset-xl-5 offset-lg-5 offset-md-2 d-flex justify-content-end col-auto col-xl">
                                <h5 class="ms-2 pt-2 fw-bolder">{{trans.data.total[lang.value]}}:</h5>
                                <h5 class="fw-bold text-body ms-2 pt-2">{{(list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`)).formatNumber('0', ',', ',')}}</h5>
                            </div>
                            <div class="justify-content-xl-end col-xl-auto offset-xl-0 rounded-pill rounded-2 align-self-center align-self-xxl-center align-self-xl-center align-self-lg-center align-self-md-center d-flex justify-content-end col-auto ms-2 pt-2 text-center" dmx-class:bg-danger="read_item_order.data.query.order_status!=='Paid'" dmx-class:bg-success="read_item_order.data.query.order_status=='Paid'">

                                <h5 class="fw-bold ms-2 ps-2 pe-4 text-white" dmx-text="trans.data.getValueOrKey(read_item_order.data.query.order_status)[lang.value]"></h5>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <ul class="nav nav-tabs nav-fill" id="navTabs1_tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active text-body" id="navTabs1_1_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_1" role="tab" aria-controls="navTabs1_1" aria-selected="true" style="" dmx-bs-tooltip="trans.data.products[lang.value]" data-bs-trigger="hover" data-bs-placement="bottom">
                                            <i class="fas fa-eye fa-lg"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-body" id="navTabs1_2_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_2" role="tab" aria-controls="navTabs1_2" aria-selected="false" style="" dmx-bs-tooltip="trans.data.payment[lang.value]" dmx-bind:popover-title="trans.data.payment[lang.value]" data-bs-trigger="hover" data-bs-placement="bottom">
                                            <i class="fas fa-cash-register fa-lg"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-body" id="navTabs1_3" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_3_4" role="tab" aria-controls="navTabs1_2" aria-selected="false" style="" dmx-bs-tooltip="trans.data.transactions[lang.value]" data-bs-trigger="hover" data-bs-placement="bottom">
                                            <i class="fas fa-coins fa-lg"></i>
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="navTabs1_content">
                                    <div class="tab-pane fade show active" id="navTabs1_1" role="tabpanel">

                                        <div class="row">
                                            <div class="col rounded mt-2 mb-2 ms-2 me-2 bg-secondary">
                                                <div class="table-responsive" id="order_details_table">
                                                    <table class="table table-borderless table-hover">
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

                                                                    <form id="editQuantity" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_order_items/update_order_item_quantity.php" dmx-on:success="notifies1.success('Success');list_order_items.load()">
                                                                        <div class="row">
                                                                            <div class="col d-flex"><input id="newQuantity" name="order_item_quantity" type="number" class="form-control inline-edit" dmx-bind:value="order_item_quantity" dmx-bind:disabled="(read_item_order.data.query.order_status == 'Paid')||(profile_privileges.data.profile_privileges[0].edit_order_item_quantity == 'No')" min="" data-rule-min="1" data-msg-min="Min. 1">
                                                                                <input id="editOrderId" name="order_item_id" type="number" class="form-control inline-edit visually-hidden" dmx-bind:value="order_item_id"><button id="btn21" class="btn text-success" data-bs-target="#productInfo" type="submit" dmx-hide="(read_item_order.data.query.order_status == 'Paid')||(profile_privileges.data.profile_privileges[0].edit_order_item_quantity == 'No')"><i class="fas fa-check"><br></i></button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </td>
                                                                <td>

                                                                    <form id="editPrice" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_order_items/update_order_item_price.php" dmx-on:success="notifies1.success('Success');list_order_items.load()">
                                                                        <div class="row">
                                                                            <div class="col d-flex"><input id="newPrice" name="order_item_price" type="number" class="form-control inline-edit" dmx-bind:value="order_item_price" dmx-bind:disabled="(read_item_order.data.query.order_status == 'Paid')||(profile_privileges.data.profile_privileges[0].edit_order_item_price == 'No')" min="" data-rule-min="0" data-msg-min="Min. 0">
                                                                                <input id="editOrderItemPrice" name="order_item_id" type="number" class="form-control inline-edit visually-hidden" dmx-bind:value="order_item_id"><button id="btn23" class="btn text-success" data-bs-target="#productInfo" type="submit" dmx-hide="(read_item_order.data.query.order_status == 'Paid')||(profile_privileges.data.profile_privileges[0].edit_order_item_price == 'No')"><i class="fas fa-check"><br></i></button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </td>
                                                                <td dmx-text="user_username">

                                                                </td>
                                                                <td>

                                                                    <form id="form2" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_order_items/delete_order_item.php" dmx-on:success="notifies1.success('Success');list_order_items.load()" dmx-class:hidethis=""><input id="text2" name="order_item_id" type="text" class="form-control visually-hidden" dmx-bind:value="order_item_id">
                                                                        <input id="text101" name="order_id" type="text" class="form-control visually-hidden" dmx-bind:value="session_variables.data.current_order">
                                                                        <input id="text111" name="user_deleted" type="text" class="form-control visually-hidden" dmx-bind:value="list_user_shift_info.data.query_list_user_shift[0].servo_user_user_id">
                                                                        <input id="text121" name="deleted_product_id" type="text" class="form-control visually-hidden" dmx-bind:value="servo_products_product_id"> <button id="btn212" class="btn" data-bs-target="#productInfo" type="submit" dmx-hide="(read_item_order.data.query.order_status == 'Paid')||(profile_privileges.data.profile_privileges[0].delete_order_item == 'No')"><i class="far fa-trash-alt fa-sm"><br></i></button>
                                                                    </form>

                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row" id="orderUpdate">
                                            <form is="dmx-serverconnect-form" id="updateOrderCashierStandard" method="post" action="dmxConnect/api/servo_orders/update_order_standard.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="read_item_order.data.query" dmx-on:success="notifies1.success('Success');list_orders_all_shift.load({current_shift: 'session_variables.current_shift'});read_item_order.load({order_id: session_variables.data.current_order});readItemModal.update()">
                                                <div class="mb-3 row">
                                                    <label for="inp_order_notes2" class="col-sm-2 col-form-label">{{trans.data.note[lang.value]}}</label>
                                                    <div class="col-sm-10">
                                                        <textarea type="text" class="form-control" id="inp_order_notes2" name="order_notes" dmx-bind:value="read_item_order.data.query.order_notes" aria-describedby="inp_order_notes_help" dmx-bind:disabled="(read_item_order.data.query.order_status == 'Paid')||(profile_privileges.data.profile_privileges[0].edit_order_details !== 'Yes')"></textarea>
                                                    </div>
                                                </div><input id="order_id" name="order_id" class="form-control visually-hidden" dmx-bind:value="read_item_order.data.query.order_id">
                                                <input id="orderTimePaid" name="order_time_paid" class="form-control visually-hidden" dmx-bind:value="dateTime.datetime" type="datetime-local">
                                                <input id="order_discount" name="order_discount" class="form-control visually-hidden" dmx-bind:value="0">
                                                <div class="mb-3 row">
                                                    <label for="inp_servo_customer_table_table_id" class="col-sm-2 col-form-label">{{trans.data.asset[lang.value]}}</label>
                                                    <div class="col-sm-10">
                                                        <select id="customer_table" class="form-select" dmx-bind:options="load_tables.data.query_list_tables" optiontext="table_name" optionvalue="table_id" name="servo_customer_table_table_id" dmx-bind:value="read_item_order.data.query.servo_customer_table_table_id" dmx-bind:disabled="(read_item_order.data.query.order_status == 'Paid')||(profile_privileges.data.profile_privileges[0].edit_order_details !== 'Yes')">
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label for="inp_order_notes" class="col-sm-2 col-form-label">{{trans.data.customer[lang.value]}}</label>

                                                    <div class="mb-2 col-auto col-sm-5 col-lg-3 col-xxl-2 col-5 col-xl-auto">
                                                        <input id="selectedCustomer" name="text3" type="text" class="form-control" disabled="true" readonly="true" dmx-bind:value="read_item_order.data.query.customer_first_name+' '+read_item_order.data.query.customer_last_name" dmx-bind:disabled="(read_item_order.data.query.order_status == 'Paid')||(profile_privileges.data.profile_privileges[0].edit_order_details !== 'Yes')">
                                                    </div>
                                                    <div class="col-auto ms-2 col-xl-auto" is="dmx-if" id="conditional1" dmx-bind:condition="(read_item_order.data.query.order_customer !== null)">
                                                        <button id="btn141" class="btn btn-danger" dmx-on:click="updateOrderCredit.submit();notifies1.success('Updated to Credit'); readItemModal.hide()">{{trans.data.credit [lang.value]}}
                                                        </button>
                                                    </div>

                                                </div>
                                                <div class="mb-3 row">
                                                    <label for="inp_order_notes" class="col-sm-2 col-form-label"><i class="fas fa-search" style="color: #189aff !important;"></i></label>

                                                    <div class="mb-2 col-sm-auto col-auto col-7">
                                                        <div class="row">
                                                            <div class="col"><input id="customerSearch" name="text3" type="text" class="form-control form-control-sm" dmx-on:updated="updateOrderCashierStandard.customerSearch.setValue(updateOrderCashierStandard.customerSearch.value);load_customers.load({limit: 5, customerfilter: updateOrderCashierStandard.customerSearch.value, offset: 0})" style="background: transparent !important; border: 1px solid #189aff !important; " dmx-bind:disabled="(read_item_order.data.query.order_status == 'Paid')||(profile_privileges.data.profile_privileges[0].edit_order_details !== 'Yes')"></div>
                                                            <div class="col"><button id="btn51" class="btn btn-sm btn-outline-secondary" dmx-on:click="updateOrderCashierStandard.customerSearch.setValue(null)" style="border: 1px solid #189aff !important;"><i class="fas fa-backspace" style="color: #189aff !important;"></i></button></div>
                                                        </div>


                                                        <input id="customerId" name="order_customer" type="text" class="form-control form-control-sm visually-hidden" dmx-bind:value="read_item_order.data.query.order_customer">
                                                    </div>
                                                    <div class="col border ms-3 me-3 pt-2 pb-2 ps-2 pe-2 rounded border-secondary" dmx-show="(updateOrderCashierStandard.customerSearch.value !== '')">
                                                        <ul class="pagination" dmx-populate="load_customers.data.query_list_customers" dmx-state="c_search" dmx-offset="offset" dmx-generator="bs5paging">
                                                            <li class="page-item" dmx-class:disabled="load_customers.data.query_list_customers.page.current == 1" aria-label="First">
                                                                <a href="javascript:void(0)" class="page-link" dmx-on:click="c_search.set('offset',load_customers.data.query_list_customers.page.offset.first); updateOrderCashierStandard.customerSearch.setValue(updateOrderCashierStandard.customerSearch.value);load_customers.load({offset: c_search.data.offset, limit: 5, customerfilter: updateOrderCashierStandard.customerSearch.value})"><span aria-hidden="true">&lsaquo;&lsaquo;</span></a>
                                                            </li>
                                                            <li class="page-item" dmx-class:disabled="load_customers.data.query_list_customers.page.current == 1" aria-label="Previous">
                                                                <a href="javascript:void(0)" class="page-link" dmx-on:click="c_search.set('offset',load_customers.data.query_list_customers.page.offset.prev); updateOrderCashierStandard.customerSearch.setValue(updateOrderCashierStandard.customerSearch.value);load_customers.load({offset: c_search.data.offset, limit: 5, customerfilter: updateOrderCashierStandard.customerSearch.value})"><span aria-hidden="true">&lsaquo;</span></a>
                                                            </li>
                                                            <li class="page-item" dmx-class:active="title == load_customers.data.query_list_customers.page.current" dmx-class:disabled="!active" dmx-repeat="load_customers.data.query_list_customers.getServerConnectPagination(2,1,'...')">
                                                                <a href="javascript:void(0)" class="page-link" dmx-on:click="c_search.set('offset',(page-1)*load_customers.data.query_list_customers.limit);updateOrderCashierStandard.customerSearch.setValue(updateOrderCashierStandard.customerSearch.value);load_customers.load({offset: c_search.data.offset, limit: 5, customerfilter: updateOrderCashierStandard.customerSearch.value})">{{title}}</a>
                                                            </li>
                                                            <li class="page-item" dmx-class:disabled="load_customers.data.query_list_customers.page.current ==  load_customers.data.query_list_customers.page.total" aria-label="Next">
                                                                <a href="javascript:void(0)" class="page-link" dmx-on:click="c_search.set('offset',load_customers.data.query_list_customers.page.offset.next); updateOrderCashierStandard.customerSearch.setValue(updateOrderCashierStandard.customerSearch.value);load_customers.load({offset: c_search.data.offset, limit: 5, customerfilter: updateOrderCashierStandard.customerSearch.value})"><span aria-hidden="true">&rsaquo;</span></a>
                                                            </li>
                                                            <li class="page-item" dmx-class:disabled="load_customers.data.query_list_customers.page.current ==  load_customers.data.query_list_customers.page.total" aria-label="Last">
                                                                <a href="javascript:void(0)" class="page-link" dmx-on:click="c_search.set('offset',load_customers.data.query_list_customers.page.offset.last); updateOrderCashierStandard.customerSearch.setValue(updateOrderCashierStandard.customerSearch.value);load_customers.load({offset: c_search.data.offset, limit: 5, customerfilter: updateOrderCashierStandard.customerSearch.value})"><span aria-hidden="true">&rsaquo;&rsaquo;</span></a>
                                                            </li>
                                                        </ul>
                                                        <div class="table-responsive" id="customerList" dmx-show="(updateOrderCashierStandard.customerSearch.value !== '')">
                                                            <table class="table table-hover table-sm">
                                                                <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>{{trans.data.nama[lang.value]}}</th>
                                                                        <th>{{trans.data.surname[lang.value]}}</th>
                                                                        <th></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="load_customers.data.query_list_customers.data" id="tableRepeat1">
                                                                    <tr>
                                                                        <td dmx-text="customer_id"></td>
                                                                        <td dmx-text="customer_first_name"></td>
                                                                        <td dmx-text="customer_last_name"></td>
                                                                        <td>
                                                                            <button id="btn1" class="btn btn-outline-info" dmx-bind:value="customer_id" dmx-on:dblclick="updateOrderCashierStandard.customerId.setValue(customer_id);updateOrderCashierStandard.selectedCustomer.setValue(customer_first_name+'  '+customer_last_name);updateOrderCashierStandard.customerSearch.setValue(NULL)"><i class="fas fa-user-plus"></i>
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="mb-3 row">

                                                    <div class="mb-3 row">
                                                        <div class="col-sm-10 d-flex justify-content-start">
                                                            <button class="btn me-md-1 pt-md-2 pb-md-2 ps-md-2 pe-md-2 me-2 btn-primary text-white" dmx-bind:value="read_item_order.data.query.Save" type="submit" dmx-hide="(read_item_order.data.query.order_status == 'Paid' && profile_privileges.data.profile_privileges[0].edit_order_details !== 'Yes')">
                                                                <i class="fas fa-check fa-2x"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <form is="dmx-serverconnect-form" id="updateOrderCredit" method="post" action="dmxConnect/api/servo_orders/update_order_credit.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="read_item_order.data.query" dmx-on:success="notifies1.success('Credit');list_orders_all_shift.load({current_shift: 'session_variables.current_shift'});read_item_order.load({order_id: session_variables.data.current_order});readItemModal.update()">
                                                <input id="order_id2" name="order_id" class="form-control visually-hidden" dmx-bind:value="read_item_order.data.query.order_id">
                                                <input id="order_id3" name="order_status" class="form-control visually-hidden" dmx-bind:value="'Credit'">

                                            </form>
                                        </div>

                                    </div>
                                    <div class="tab-pane fade" id="navTabs1_2" role="tabpanel">
                                        <div class="row bg-secondary rounded mt-2 ms-2 me-2 pt-3 pb-2 ps-2 pe-2" id="transactionPayment">
                                            <form is="dmx-serverconnect-form" id="createOrderTransaction" method="post" action="dmxConnect/api/servo_customer_cash_transactions/create_transaction_update_order_to_paid.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="read_item_order.data.query" dmx-on:success="createOrderTransaction.reset();read_item_order.load({order_id: session_variables.data.current_order});notifies1.success('Success'). updateOrderCashier.inp_order_order_status.setValue('Paid');updateOrderCashier.submit();list_customer_transactions_order.load({order_id: read_item_order.data.query.order_id});list_orders_all_shift_department.load({current_shift: list_user_shift_info.data.query_list_user_shift[0].servo_shifts_shift_id, sales_point_id: list_user_shift_info.data.query_list_user_shift[0].servo_sales_point_sales_point_id})" dmx-on:error="notifies1.danger('Error!')">
                                                <input id="transactionOrderId" name="transaction_order" class="form-control visually-hidden" dmx-bind:value="session_variables.data.current_order">
                                                <input id="transactionDate" name="transaction_date" class="form-control visually-hidden" dmx-bind:value="dateTime.datetime">
                                                <input id="transactionUserApproved" name="user_approved_id" class="form-control visually-hidden" dmx-bind:value="session_variables.data.user_id">
                                                <input id="transactionType" name="transaction_type" class="form-control visually-hidden" dmx-bind:value="'Settlement'">
                                                <div class="mb-3 row">
                                                    <label for="transactionAmount1" class="col-sm-2 col-form-label">{{trans.data.total[lang.value]}}</label>
                                                    <div class="col-sm-10">
                                                        <input type="number" class="form-control" id="transactionAmount" name="transaction_amount" aria-describedby="inp_order_notes_help" required="" data-msg-required="!" min="" data-msg-min="Min 0" dmx-bind:min="1" data-rule-min="1" dmx-bind:value="orderTotal.value" readonly="true">
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label for="transactionAmountTendered" class="col-sm-2 col-form-label">{{trans.data.amountTendered[lang.value]}}</label>
                                                    <div class="col-sm-10">
                                                        <input type="number" class="form-control" id="transactionAmountTendered" name="transaction_amount_tendered" aria-describedby="inp_order_notes_help" required="" data-msg-required="!" min="" data-msg-min="Min 0" dmx-bind:min="createOrderTransaction.transactionAmount.value" data-rule-min="1" dmx-bind:value="read_item_order.data.query.order_amount_tendered" dmx-bind:disabled="(read_item_order.data.query.order_status == 'Paid')">
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




                                                        <select id="select1" class="form-select" dmx-bind:options="loadPaymentMethods.data.query" optiontext="payment_method_name" optionvalue="payment_method_id" name="transaction_payment_method" dmx-bind:disabled="(read_item_order.data.query.order_status == 'Paid')" required="" data-msg-required="!">
                                                            <option selected="" value="">-----</option>
                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="mb-3 row">
                                                    <div class="col-sm-2">
                                                        &nbsp;</div>
                                                    <div class="col-sm-10 d-flex justify-content-start">
                                                        <button class="btn pt-md-2 pb-md-2 ps-md-2 pe-md-2 bg-info text-white" id="receive_payment1" dmx-bind:disabled="(read_item_order.data.query.order_status == 'Paid')||state.executing" type="submit"><i class="fas fa-hand-holding-usd fa-2x"></i></button>
                                                    </div>

                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="navTabs1_3_4" role="tabpanel">
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
                                                                <th>{{trans.data.total[lang.value]}}</th>
                                                                <th>{{trans.data.amountTendered[lang.value]}}</th>
                                                                <th>{{trans.data.balance[lang.value]}}</th>
                                                                <th></th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_customer_transactions_order.data.query" id="tableRepeat5">
                                                            <tr>
                                                                <td dmx-text="customer_transaction_id"></td>
                                                                <td dmx-text="transaction_type"></td>
                                                                <td dmx-text="user_fname+user_lname"></td>
                                                                <td>
                                                                    <form id="cashierUpdatePaymentMethod" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_customer_cash_transactions/update_transaction_payment_method.php" class="d-flex">
                                                                        <input id="text5" name="customer_transaction_id" type="number" class="form-control visually-hidden" dmx-bind:value="customer_transaction_id">
                                                                        <select id="transactionPaymentMethod" class="form-select" dmx-bind:options="loadPaymentMethods.data.query" optiontext="payment_method_name" optionvalue="payment_method_id" dmx-bind:value="transaction_payment_method" name="transaction_payment_method">
                                                                        </select>
                                                                        <button id="btn161" class="btn text-success" type="submit">
                                                                            <i class="fas fa-check fa-lg"></i>
                                                                        </button>
                                                                    </form>
                                                                </td>
                                                                <td dmx-text="transaction_date"></td>
                                                                <td dmx-text="transaction_status"></td>
                                                                <td dmx-text="transaction_note"></td>

                                                                <td dmx-text="transaction_amount.formatNumber('0', ',', ',')"></td>
                                                                <td dmx-text="transaction_amount_tendered.formatNumber('0', ',', ',')"></td>
                                                                <td dmx-text="transaction_balance.formatNumber('0', ',', ',')"></td>
                                                                <td>
                                                                    <button id="btn15" class="btn" data-bs-toggle="modal" data-bs-target="#printTransactionReceiptModal" dmx-on:click="read_customer_transaction.load({customer_cash_transaction_id: customer_transaction_id})"><i class="fas fa-receipt fa-lg"></i>
                                                                    </button>
                                                                </td>
                                                                <td>
                                                                    <form id="deleteOrderTransaction" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_customer_cash_transactions/delete_transaction.php" dmx-on:success="updateOrderPaidOrdered.submit();list_customer_transactions_order.load({order_id: readCustomerOrder.data.query.order_id});list_customer_transactions_order_totals.load({order_id: session_variables.data.current_order});read_item_order.load({order_id: read_item_order.data.query.order_id})" onsubmit=" return confirm('CONFIRM DELETE?');">
                                                                        <input id="text3" name="customer_transaction_id" type="text" class="form-control visually-hidden" dmx-bind:value="customer_transaction_id">
                                                                        <button id="btn90" class="btn text-body" type="submit" dmx-show="(profile_privileges.data.profile_privileges[0].delete_order==&quot;Yes&quot;)">
                                                                            <i class="far fa-trash-alt fa-sm"></i>
                                                                        </button>
                                                                    </form>
                                                                    <form id="updateOrderPaidOrdered" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_orders/update_order_paid_ordered.php">
                                                                        <input id="text4" name="order_id" type="text" class="form-control visually-hidden" dmx-bind:value="read_item_order.data.query.order_id">
                                                                        <input id="text10" name="order_status" type="text" class="form-control visually-hidden" dmx-bind:value="'Ordered'">
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
                        </div>

                    </div>
                    <div class="modal-footer border-0">
                        <form id="form1" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_orders/delete_order_and_items.php" dmx-on:success="notifies1.success('Success');list_orders_all_shift.load();readItemModal.hide()" onsubmit=" return confirm('CONFIRM DELETE?');">
                            <input id="text1" name="order_id" type="hidden" class="form-control" dmx-bind:value="read_item_order.data.query.order_id">

                            <button id="btn6" class="btn text-body" type="submit" dmx-show="(profile_privileges.data.profile_privileges[0].delete_order== &quot;Yes&quot;)">
                                <i class="far fa-trash-alt fa-lg"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </main>
    <main class="ps-2 pe-2 bg-transparent">
        <div>




            <div class="row servo-page-header h-auto top-bar row-cols-12 justify-content-sm-between row-cols-sm-12 justify-content-xxl-between justify-content-between justify-content-xl-between row-cols-md-12 justify-content-md-between rounded bg-transparent mt-4 ms-1 me-1">
                <div class="style13 page-button justify-content-sm-end top-bar d-flex col-auto col-xl-auto col-md-auto col-sm-auto bg-transparent" id="pagebuttons" dmx-animate-enter="slideInLeft">
                    <i class="fas fa-cash-register fa-lg"></i>



                </div>
                <div class="style13 page-button top-bar text-light col-auto justify-content-xl-start col-xl justify-content-md-start col-md col-sm justify-content-sm-start justify-content-lg-start bg-transparent d-flex" id="pagebuttons2">
                    <h5 class="text-start text-body">{{trans.data.cashRegister[lang.value]}} | </h5>
                    <h5 class="text-start text-body"> {{list_user_shift_info.data.query_list_user_shift[0].sales_point_name}}</h5>



                </div>

                <div class="d-flex justify-content-sm-end col-sm-8 justify-content-end justify-content-xxl-end col-xxl-auto col">
                    <button id="btn171" class="btn me-2 bg-light" data-bs-toggle="modal" data-bs-target="#expenseModal" dmx-bs-tooltip="trans.data.expenses[lang.value]" data-bs-trigger="hover" data-bs-placement="bottom">
                        <i class="fas fa-coins"></i>
                    </button><button id="btn4" class="btn text-body bg-light" data-bs-toggle="modal" data-bs-target="#SelectTableModal" dmx-bs-tooltip="trans.data.createOrder[lang.value]" data-bs-trigger="hover" data-bs-placement="bottom" dmx-show="(profile_privileges.data.profile_privileges[0].create_order== &quot;Yes&quot;)">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="row justify-content-between h-auto w-auto numbers rounded mt-3 ms-1 me-2 pt-4 pb-4 bg-light">
                <div class="col d-flex justify-content-start">
                    <h2 class="text-danger"><i class="fas fa-arrow-alt-circle-up"></i></h2>
                    <h3 class="ms-2 text-danger" style="color:blue ">{{(total_sales_all_waiters_out_per_shift.data.query.sum(`(order_item_price * order_item_quantity)`)).formatNumber('0', ',', ',')}}</h3>

                </div>
                <div class="col d-flex justify-content-end">
                    <h3 class="text-success me-2" dmx-text="paymentsShift.data.TotalPaymentShift[0].TotalPaymentsShift.toNumber().formatNumber('O',',',',').default(0)"></h3>
                    <h2 class="text-success fw-bold"><i class="fas fa-arrow-alt-circle-down "></i></h2>

                </div>
            </div>
            <div class="row tablestyle bg-transparent mt-1 me-0" id="orders_table" style="height: 450px; overflow: scroll;">
                <div class="col-12 rounded bg-light ms-1 me-2 pt-2">
                    <ul class="nav nav-tabs nav-fill fw-bold" id="navTabs1_tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="navTabs1_1_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_11" role="tab" aria-controls="navTabs1_1" aria-selected="true"><i class="fas fa-list-ol" style="margin-right: 2px"></i>
                                {{trans.data.orders[lang.value]}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="navTabs1_2_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_23" role="tab" aria-controls="navTabs1_2" aria-selected="false"><i class="fas fa-hand-holding-usd" style="margin-right: 2px"></i>
                                {{trans.data.transactions[lang.value]}}</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="navTabs1_content">
                        <div class="tab-pane fade show active" id="navTabs1_11" role="tabpanel">
                            <div class="row">
                                <div class="col mt-2">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-sm table-borderless" id="cashierorders">
                                            <thead>
                                                <tr class="text-body">
                                                    <th class="t_orderid">#</th>
                                                    <th class="t_time">{{trans.data.dateTime[lang.value]}}</th>

                                                    <th class="t_table">{{trans.data.asset[lang.value]}}</th>
                                                    <th class="t_waiter">{{trans.data.waiter[lang.value]}}</th>
                                                    <th class="t_waiter">{{trans.data.service[lang.value]}}</th>
                                                    <th class="t_status text-center">{{trans.data.status[lang.value]}}</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_orders_all_shift_department.data.query" id="tableRepeat51" class="text-body">
                                                <tr class="text-body" dmx-on:dblclick="session_variables.set('current_order',order_id);readItemModal.show();read_item_order.load({order_id: order_id});session_variables.set();readCurrentOrder.load({current_order_id: order_id})" dmx-bind:value="list_orders_all_shift_department.data.query[0].order_id">
                                                    <td dmx-text="order_id"></td>
                                                    <td dmx-text="order_time"></td>




                                                    <td dmx-text="table_name"></td>
                                                    <td dmx-text="user_username"></td>
                                                    <td dmx-text="service_name"></td>
                                                    <td>
                                                        <h6 style="border-radius:10px;" dmx-text="trans.data.getValueOrKey(order_status)[lang.value]" class="text-center pt-1 pb-1 ps-2 pe-2 bg-opacity-50 fw-bold bg-light" dmx-class:text-danger="(order_status == 'Ordered')" dmx-class:text-light="(order_status == 'Pending')" dmx-class:text-success="(order_status == 'Paid')"></h6>
                                                    </td>

                                                    <td class="text-end">
                                                        <button class="btn text-muted" dmx-on:click="session_variables.set('current_order',order_id);readItemModal.show();read_item_order.load({order_id: order_id});session_variables.set();readCurrentOrder.load({current_order_id: order_id});list_order_items_current.load({order_id: order_id})" dmx-bind:value="list_orders_all_shift_department.data.query[0].order_id"><i class="far fa-edit fa-sm"><br></i></button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="navTabs1_23" role="tabpanel">
                            <div class="row mt-2">
                                <div class="col">
                                    <div class="table-responsive">
                                        <table class="table-responsive table-borderless table-hover table-sm">
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
                                                    <td dmx-text="customer_last_name"></td>
                                                    <td dmx-text="transaction_amount_tendered"></td>
                                                    <td dmx-text="transaction_balance"></td>
                                                    <td dmx-text="transaction_amount"></td>
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
    </main>



    <script src="bootstrap/5/js/bootstrap.bundle.min.js"></script>
    <script src="bootstrap/5/js/bootstrap.min.js"></script>
</body>


</html>