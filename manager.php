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
    <script src="dmxAppConnect/dmxAppConnect.js"></script>
    <meta name="ac:base" content="/servo">
    <base href="/servo/">
    <meta charset="UTF-8">
    <title>SERVO&nbsp;</title>

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
    <script src="dmxAppConnect/dmxBackgroundVideo/dmxBackgroundVideo.js" defer=""></script>
    <link rel="stylesheet" href="fontawesome5/css/all.min.css" />
    <script src="dmxAppConnect/dmxBootstrap5PagingGenerator/dmxBootstrap5PagingGenerator.js" defer=""></script>
</head>

<body is="dmx-app" id="ServoProcurement">
    <dmx-serverconnect id="userInfo" url="dmxConnect/api/servo_user_shifts/list_user_shift_info_noshift.php" dmx-param:user_id="session_variables.data.user_id"></dmx-serverconnect>
    <dmx-serverconnect id="list_vendors" url="dmxConnect/api/servo_vendors/list_vendors.php"></dmx-serverconnect>
    <dmx-value id="TO" dmx-bind:value="O +AO"></dmx-value>
    <dmx-serverconnect id="list_ao_items" url="dmxConnect/api/servo_order_items/list_ao_items.php" dmx-param:order_id="session_variables.data.current_adjustment_order"></dmx-serverconnect>
    <dmx-serverconnect id="list_adjustment_orders" url="dmxConnect/api/servo_orders/list_adjustment_orders_department.php" dmx-param:department="session_variables.data.user_department_id"></dmx-serverconnect>
    <dmx-serverconnect id="read_adjustment_order" url="dmxConnect/api/servo_orders/read_order.php" dmx-param:order_id="session_variables.data.current_adjustment_order"></dmx-serverconnect>
    <dmx-serverconnect id="loadpaymentmethods" url="dmxConnect/api/servo_payment_methods/list_payment_methods.php"></dmx-serverconnect>
    <dmx-serverconnect id="productstockvalues" url="dmxConnect/api/servo_stock/get_stock_values_2_department.php" dmx-param:department="session_variables.data.user_department_id"></dmx-serverconnect>

    <dmx-value id="lang" dmx-bind:value="browser1.language"></dmx-value>
    <dmx-json-datasource id="trans" is="dmx-serverconnect" url="assets/translation/translation.JSON"></dmx-json-datasource>

    <dmx-serverconnect id="query_po_items" url="dmxConnect/api/servo_purchase_order_items/list_po_items.php" dmx-param:po_id="session_variables.data.current_purchase_order" noload></dmx-serverconnect>
    <dmx-scheduler id="scheduler1" dmx-on:tick="total_sales_all_waiters_in_per_shift.load({current_shift: session_variables.data.current_shift, order_status: 'Paid'});total_sales_all_waiters_out_per_shift.load({current_shift: session_variables.data.current_shift, order_status: 'Ordered'});list_orders_all_shift.load({current_shift: session_variables.data.current_shift})" delay="30"></dmx-scheduler>
    <dmx-datetime id="var1"></dmx-datetime>
    <dmx-serverconnect id="delete_purchase_order" url="dmxConnect/api/servo_purchase_orders/delete_purchase_order.php" dmx-param:po_id="tableRepeat5[0].po_id"></dmx-serverconnect>
    <dmx-serverconnect id="list_purchase_order_items_current" url="dmxConnect/api/servo_order_items/list_order_items_current.php" dmx-param:order_id="session_variables.data.current_order"></dmx-serverconnect>
    <dmx-serverconnect id="get_order_total" url="dmxConnect/api/servo_order_items/compute_order_total.php" dmx-param:order_id="session_variables.data.current_order"></dmx-serverconnect>
    <dmx-serverconnect id="list_purchase_order_items" url="dmxConnect/api/servo_purchase_order_items/list_po_items.php" dmx-param:order_id="read_item_order.data.query.order_id" dmx-param:po_id="read_purchase_order.data.query.po_id"></dmx-serverconnect>
    <dmx-serverconnect id="load_products" url="dmxConnect/api/servo_products/list_products.php" noload></dmx-serverconnect>
    <dmx-session-manager id="session_variables"></dmx-session-manager>
    <dmx-serverconnect id="load_tables" url="dmxConnect/api/servo_tables/list_tables.php"></dmx-serverconnect>

    <dmx-serverconnect id="load_product_categories" url="dmxConnect/api/servo_refered_fields_loading/load_product_categories.php"></dmx-serverconnect>
    <dmx-serverconnect id="read_purchase_order" url="dmxConnect/api/servo_purchase_orders/read_purchase_order.php" dmx-param:id="id" noload dmx-param:item_id="" dmx-param:branch_id="read_item_branch.data.queryReadBranch.branch_id" dmx-param:department_id="" dmx-param:order_id="tableRepeat2[0].order_id" dmx-param:po_id="list_purchase_orders.data.query[0].po_id"></dmx-serverconnect>
    <dmx-serverconnect id="delete_item_order" url="dmxConnect/api/servo_departments/delete_department.php"></dmx-serverconnect>
    <dmx-serverconnect id="list_purchase_orders" url="dmxConnect/api/servo_purchase_orders/list_purchase_orders_department.php" dmx-param:user_id="" dmx-param:current_shift="session_variables.data.current_shift" dmx-param:department="list_user_info.data.query_list_user_info.servo_user_departments_department_id"></dmx-serverconnect>
    <div is="dmx-browser" id="browser1"></div>
    <dmx-notifications id="notifies1" timeout="100" position="bottom" extended-timeout="200"></dmx-notifications>
    <?php include 'header.php'; ?>
    <main class="mt-0">

        <div class="modal" id="AddProductsModal" is="dmx-bs5-modal" tabindex="-1" dmx-on:hidden-bs-modal="upate_order_status.submit();total_sales_all_waiters_in_per_shift.load({});total_sales_all_waiters_out_per_shift.load();list_orders_all_shift.load();session_variables.remove('table_id');session_variables.remove('current_order')">
            <div class="modal-dialog modal-xl modal-fullscreen-lg-down" role="document">
                <div class="modal-content">
                    <form id="upate_order_status" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_orders/update_order_pending_ordered.php">
                        <input id="order_status_ordered" name="order_status" type="text" class="form-control visually-hidden" dmx-bind:value="'Ordered'">
                        <input id="order_status_order_id" name="order_id" type="number" class="form-control visually-hidden" dmx-bind:value="session_variables.data.current_order">
                    </form>
                    <div class="modal-header">

                        <h5 class="modal-title">{{trans.data.order[lang.value]}}: {{session_variables.data.current_order}}</h5>
                        <button id="btn9" class="btn text-warning" data-bs-toggle="offcanvas" data-bs-target="#orderdetailsoffcanvas">
                            <i class="far fa-eye"></i>
                        </button>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <header>
                                    <h1>{{trans.data.total[lang.value]}}:&nbsp;</h1>
                                </header>
                            </div>
                            <div class="row">
                                <div class="d-flex flex-wrap w-auto flex-xl-row flex-xxl-row flex-xxl-wrap flex-sm-row flex-sm-wrap flex-md-wrap flex-md-row col-md mb-md-0 col-sm ms-0 flex-row flex-lg-row justify-content-sm-around justify-content-around justify-content-md-around justify-content-lg-around">
                                    <div class="flex-md-wrap flex-md-row justify-content-md-center rounded align-content-center bg-secondary mt-2 mb-2 ms-1 me-1 pt-3 pb-3 ps-3 pe-3 col-sm-5 offset-md-1 col-md-5 col-lg-5 col-xxl-3 col-12" dmx-repeat:products="load_products.data.query_list_products">
                                        <h2 class="text-center text-warning">{{product_name}}</h2>
                                        <h3 class="text-center">{{product_price}}</h3>
                                        <form id="form3" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_order_items/create_order_item.php" dmx-on:success="form3.reset();list_order_items_current.load({order_id: session_variables.data.current_order});notifies1.success('Success:'+product_name+' Added to Order')">
                                            <input id="inp_order_item_quantity" name="order_item_quantity" type="number" class="form-control mb-sm-1 mb-2" placeholder="1">
                                            <input id="inp_order_time_ordered" name="order_time_ordered" class="form-control mb-sm-1 mb-2 visually-hidden" type="datetime-local" dmx-bind:value="var1.datetime">
                                            <input id="inp_order_time_ready" name="order_time_ready" class="form-control mb-sm-1 mb-2 visually-hidden" type="datetime-local" dmx-bind:value="var1.datetime">
                                            <input id="inp_order_time_delivered" name="order_time_delivered" class="form-control mb-sm-1 mb-2 visually-hidden" type="datetime-local" dmx-bind:value="var1.datetime">
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
                                                <th>{{trans.data.time[lang.value]}}</th>
                                                <th>{{trans.data.product[lang.value]}}</th>
                                                <th>{{trans.data.price[lang.value]}}</th>
                                                <th>{{trans.data.quantity[lang.value]}}</th>
                                                <th>{{trans.data.note[lang.value]}}</th>
                                                <th>{{trans.data.discount[lang.value]}}</th>
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
                                                <td dmx-text="order_item_discount"></td>
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
        <div class="modal" id="AddProductsModalToOrder" is="dmx-bs5-modal" tabindex="-1" dmx-on:hidden-bs-modal="session_variables.removeAll()">
            <div class="modal-dialog modal-xl modal-fullscreen-lg-down" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        <h5 class="modal-title">{{trans.data.order[lang.value]}}: {{session_variables.data.current_order}}</h5>
                        <button id="btn3" class="btn text-warning" data-bs-toggle="offcanvas" data-bs-target="#orderdetailsoffcanvas">
                            <i class="far fa-eye"></i>
                        </button>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">


                    </div>
                    <div class="offcanvas w-auto offcanvas-start" id="orderdetailsoffcanvas1" is="dmx-bs5-offcanvas" tabindex="-1">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title">{{trans.data.order[lang.value]}} #{{session_variables.data.current_order}}</h5>
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
                                                <th>{{trans.data.time[lang.value]}}</th>
                                                <th>{{trans.data.product[lang.value]}}</th>
                                                <th>{{trans.data.price[lang.value]}}</th>
                                                <th>{{trans.data.quantity[lang.value]}}</th>
                                                <th>{{trans.data.note[lang.value]}}</th>
                                                <th>{{trans.data.discount[lang.value]}}</th>
                                                <th>{{trans.data.total[lang.value]}}</th>
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
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col d-flex justify-content-center">
                                    <div class="row justify-content-center">
                                        <div class="col d-flex justify-content-center ms-1 me-1 flex-wrap text-center" id="createpo">
                                            <form is="dmx-serverconnect-form" id="create_purchase_order_form" method="post" action="dmxConnect/api/servo_purchase_orders/create_purchase_order.php" dmx-on:success="notifies1.success('PO #'+createPurchaseOrder.data.custom[0]['last_insert_id()']+' Created');session_variables.set('current_purchase_order',create_purchase_order_form.data.custom[0]['last_insert_id()']);list_purchase_orders.load();create_purchase_order_form.reset();CreateOrderModal.hide();readItemModal.AddProductsToOrderOffCanvas.show()">
                                                <input id="timeOrdered" name="time_ordered" class="form-control visually-hidden" type="datetime-local" dmx-bind:value="var1.datetime">
                                                <input id="userOrdered" name="servo_users_user_ordered_id" type="hidden" class="form-control visually-hidden" dmx-bind:value="session_variables.data.user_id">
                                                <input id="poStatus" name="po_status" type="hidden" class="form-control visually-hidden" dmx-bind:value="'Requested'">
                                                <input id="poDepartment" name="servo_departments_department_id" type="hidden" class="form-control" dmx-bind:value="session_variables.data.user_department_id">



                                                <div class="row row-cols-1 justify-content-center">
                                                    <div class="d-flex border-warning col justify-content-center"><button id="btn7" class="btn btn-lg btn-warning me-0 pt-5 pb-5 ps-5 pe-5" type="submit"><i class="fas fa-cart-plus fa-3x"></i></button>
                                                    </div>
                                                </div>
                                                <div class="row mt-2 mb-3 justify-content-center">
                                                    <div class="d-flex justify-content-center offset-1 col-sm-10">
                                                        <select id="select3" class="form-select" name="servo_vendors_vendor_id" dmx-bind:options="list_vendors.data.query_list_vendors" optiontext="vendor_name" optionvalue="vendor_id">
                                                            <option value="">{{trans.data.vendor[lang.value]}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                        <div class="col d-flex justify-content-center ms-1 me-1 flex-wrap" id="createao">
                                            <form is="dmx-serverconnect-form" id="create_adjustment_order" method="post" action="dmxConnect/api/servo_orders/create_adjustment_order.php" dmx-on:success="notifies1.success('Success!');list_adjustment_orders.load({});CreateOrderModal.hide();readAOModal.show()">
                                                <input id="order_time" name="order_time" class="form-control visually-hidden" type="datetime-local" dmx-bind:value="var1.datetime">
                                                <input id="order_status" name="order_status" type="hidden" class="form-control visually-hidden" dmx-bind:value="session_variables.data.user_id">
                                                <input id="user_ordered" name="servo_user_user_id" type="hidden" class="form-control visually-hidden" dmx-bind:value="session_variables.data.user_id">

                                                <input id="aoDepartment" name="servo_departments_department_id" type="hidden" class="form-control" dmx-bind:value="session_variables.data.user_department_id">
                                                <div class="row row-cols-1">
                                                    <div class="d-flex border-warning col"><button id="btn5" class="btn btn-lg me-0 pt-5 pb-5 ps-5 pe-5 btn-danger" type="submit"><i class="far fa-minus-square fa-3x"></i></button>
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
        <div class="modal readitem" id="readItemModal" is="dmx-bs5-modal" tabindex="-1" dmx-on:hidden-bs-modal="session_variables.remove('current_purchase_order')">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="d-block">
                            <h2 class="text-warning">{{trans.data.purchaseOrder[lang.value]}}</h2>
                        </div>







                        <button id="btn10" class="btn float-right text-white-50" data-bs-toggle="offcanvas" data-bs-target="#AddProductsToOrderOffCanvas" dmx-on:click="" dmx-hide="(read_purchase_order.data.query.po_status == 'Received'); ">
                            <i class="fas fa-cart-plus fa-2x"></i>
                        </button>
                        <div id="conditional1" is="dmx-if" dmx-bind:condition="(profile_privileges.data.profile_privileges[0].approve_po == 'Yes')">
                            <main>
                                <div class="row">
                                    <div class="col d-flex">
                                        <form id="approvePO" is="dmx-serverconnect-form" method="post" action="dmxConnect/api/servo_purchase_orders/approve_po.php" dmx-on:success="notifies1.success('Success!');list_purchase_orders.load();readItemModal.hide()" dmx-hide="(read_purchase_order.data.query.po_status == 'Approved');">
                                            <input id="poid" name="po_id" type="text" class="form-control visually-hidden" dmx-bind:value="read_purchase_order.data.query.po_id">
                                            <input id="timeapproved" name="time_approved" type="datetime-local" class="form-control visually-hidden" dmx-bind:value="var1.datetime">
                                            <input id="userApproved" name="servo_users_user_approved_id" class="form-control visually-hidden" dmx-bind:value="session_variables.data.user_id">
                                            <input id="poStatus" name="po_status" type="text" class="form-control visually-hidden" dmx-bind:value="'Approved'">
                                            <button id="btn11" class="btn float-right text-warning" data-bs-target="#AddProductsToOrderOffCanvas" dmx-on:click="" type="submit" dmx-hide="(read_purchase_order.data.query.po_status == 'Approved');(read_purchase_order.data.query.po_status == 'Received')">
                                                <i class="fas fa-check fa-2x"></i>
                                            </button>
                                        </form>
                                        <form id="receivePO" is="dmx-serverconnect-form" method="post" action="dmxConnect/api/servo_purchase_orders/receive_po.php" dmx-on:success="notifies1.success('Success!');list_purchase_orders.load();productstockvalues.load();readItemModal.hide()">
                                            <input id="poid1" name="po_id" type="text" class="form-control visually-hidden" dmx-bind:value="read_purchase_order.data.query.po_id">
                                            <input id="timereceived" name="time_received" type="datetime-local" class="form-control visually-hidden" dmx-bind:value="var1.datetime">
                                            <input id="userReceived" name="servo_users_user_received_id" class="form-control visually-hidden" dmx-bind:value="session_variables.data.user_id">
                                            <input id="poStatus2" name="po_status" type="text" class="form-control visually-hidden" dmx-bind:value="'Received'">
                                            <button id="btn12" class="btn text-success float-right" data-bs-target="#AddProductsToOrderOffCanvas" type="submit" dmx-show="(read_purchase_order.data.query.po_status == 'Approved')" dmx-on:click="">
                                                <i class="fas fa-cart-arrow-down fa-2x"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </main>

                        </div>



                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="offcanvas offcanvas-start w-100" id="AddProductsToOrderOffCanvas" is="dmx-bs5-offcanvas" tabindex="-1">
                            <div class="offcanvas-header">
                                <h2 class="offcanvas-title text-warning">{{trans.data.addProducts[lang.value]}}</h2>
                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body w-auto" style="">
                                <div class="row row-cols-7 justify-content-xxl-center">
                                    <div class="flex-md-wrap flex-md-row justify-content-md-center rounded align-content-center mt-2 mb-2 ms-1 me-1 pt-3 pb-3 ps-3 pe-3 offset-md-1 col-12 col-sm-5 col-xxl-1 bg-secondary col-md-5 col-lg-2" dmx-repeat:products="load_products.data.query_list_products" id="repeatProducts" style="margin-top: 0px !important; padding-top: 0px !important; /* position: relative */ /* height: auto */">

                                        <div class="row">
                                            <div class="col text-center" style="padding: 0px !important; height: 200px;" dmx-hide="product_picture==null">
                                                <img dmx-bind:src="'/servo/uploads/product_pictures/'+product_picture" width="100%" height="95%" loading="lazy" style="object-fit: cover;">
                                            </div>
                                        </div>
                                        <h3 class="text-center text-warning">{{product_name}}</h3>
                                        <h4 class="text-center">{{product_price}}</h4>
                                        <form id="add_products_to_purchase_order_form" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_purchase_order_items/add_item_to_po.php" dmx-on:success="add_products_to_purchase_order_form.reset();list_purchase_order_items.load();notifies1.success('Success:'+product_name+' Added to Order')">
                                            <input id="poItemQuantity" name="po_item_quantity" type="number" class="form-control mb-sm-1 mb-2" required="" data-msg-required="Required!" min="" data-rule-min="1" data-msg-min="Min 1" dmx-bind:placeholder="trans.data.quantity[lang.value]">
                                            <input id="poId" name="po_id" type="number" class="form-control mb-sm-1 mb-2 visually-hidden" dmx-bind:value="read_purchase_order.data.query.po_id">
                                            <input id="productId" name="po_product_id" type="number" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="1" dmx-bind:value="product_id">
                                            <input id="poItemPrice" name="po_item_price" type="number" class="form-control mb-sm-1 mb-2" dmx-bind:value="" required="" data-msg-required="Required!" min="" data-rule-min="1" data-msg-min="Minimum 1" dmx-bind:placeholder="trans.data.price[lang.value]">
                                            <textarea id="poItemNotes" class="form-control" name="po_item_notes" dmx-bind:placeholder="trans.data.note[lang.value]"></textarea>

                                            <div class="row align-items-sm-end">
                                                <div class="col mb-sm-2" style="/* position: absolute */ /* bottom: 0px */"><button id="btn3" class="add-item-button btn btn-warning mt-2 align-self-end btn-lg w-100" type="submit">
                                                        <i class="fas fa-cart-plus"></i>
                                                    </button></div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="d-flex col justify-content-start">
                                <div class="d-block">
                                    <h3>{{trans.data.purchaseOrder[lang.value]}}#:</h3>
                                </div>
                                <div class="d-block ms-2">
                                    <h3 class="text-info" dmx-text="read_purchase_order.data.query.po_id"></h3>
                                </div>
                                <div class="d-block ms-2">
                                    <h3 class="ms-2">{{trans.data.total[lang.value]}}:</h3>
                                </div>

                                <div class="d-block text-danger ms-2">
                                    <h3>{{list_purchase_order_items.data.query.sum(`(po_item_price * po_item_quantity)`).formatNumber(1, '.', ',')}}</h3>
                                </div>
                                <div class="d-block ms-2">
                                    <h3 class="ms-2" dmx-text="trans.data.getValueOrKey(read_purchase_order.data.query.po_status)[lang.value]
                                                                        "></h3>
                                </div>
                                <div class="text-danger float-right">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="table-responsive">
                                    <table class="table table-hover" id="po_items_table">
                                        <thead>
                                            <tr>
                                                <th>{{trans.data.product[lang.value]}}</th>
                                                <th>{{trans.data.quantity[lang.value]}}</th>
                                                <th>{{trans.data.unitPrice[lang.value]}}</th>
                                                <th>{{trans.data.note[lang.value]}}</th>
                                                <th>{{trans.data.total[lang.value]}}</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_purchase_order_items.data.query" id="tableRepeat2">
                                            <tr>
                                                <td dmx-text="product_name"></td>
                                                <td>

                                                    <form id="editQuantity" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_purchase_order_items/update_po_item_quantity.php" dmx-on:success="notifies1.success('Success');list_purchase_order_items.load({po_id: session_variables.data.current_purchase_order})">
                                                        <div class="row">
                                                            <div class="col d-flex"><input id="newQuantity" name="po_item_quantity" type="number" class="form-control inline-edit" dmx-bind:value="po_item_quantity" dmx-bind:disabled="read_purchase_order.data.query.po_status == 'Received'" min="" data-rule-min="1" data-msg-min="Min. 1">
                                                                <input id="editPOId" name="po_item_id" type="number" class="form-control inline-edit visually-hidden" dmx-bind:value="po_item_id"><button id="btn21" class="btn text-success" data-bs-target="#productInfo" type="submit" dmx-hide="read_purchase_order.data.query.po_status == 'Received'"><i class="fas fa-check"><br></i></button>
                                                            </div>
                                                        </div>
                                                    </form>


                                                </td>
                                                <td>
                                                    <form id="editPrice" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_purchase_order_items/update_po_item_price.php" dmx-on:success="notifies1.success('Success');list_purchase_order_items.load({po_id: session_variables.data.current_purchase_order})">
                                                        <div class="row">
                                                            <div class="col d-flex"><input id="newPrice" name="po_item_price" type="number" class="form-control inline-edit" dmx-bind:value="po_item_price" dmx-bind:disabled="read_purchase_order.data.query.po_status == 'Received'" min="" data-rule-min="1" data-msg-min="Min. 1">
                                                                <input id="editPOId1" name="po_item_id" type="number" class="form-control inline-edit visually-hidden" dmx-bind:value="po_item_id"><button id="btn4" class="btn text-success" data-bs-target="#productInfo" type="submit" dmx-hide="read_purchase_order.data.query.po_status == 'Received'"><i class="fas fa-check"><br></i></button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </td>
                                                <td dmx-text="po_item_notes"></td>
                                                <td dmx-text="(po_item_quantity * po_item_price).formatNumber(0, '.', ',')"></td>
                                                <td>
                                                    <form id="deletePOItem" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_purchase_order_items/delete_po_item.php" dmx-on:success="notifies1.success('Success!');list_purchase_order_items.load()">
                                                        <input id="poItemDelete" name="po_item_id" type="text" class="form-control visually-hidden" dmx-bind:value="po_item_id">
                                                        <button id="btn3" class="btn text-danger" type="submit" dmx-hide="read_purchase_order.data.query.po_status == 'Received'"><i class="far fa-trash-alt fa-lg"></i>
                                                        </button>
                                                    </form>

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <form is="dmx-serverconnect-form" id="updatePurchaseOrder" method="post" action="dmxConnect/api/servo_purchase_orders/update_purchase_order.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="read_purchase_order.data.query">
                                <div class="mb-3 row visually-hidden">
                                    <label for="inp_po_id" class="col-sm-2 col-form-label visually-hidden" wappler-command="editContent">PO</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control visually-hidden" id="inp_po_id" name="po_id" dmx-bind:value="read_purchase_order.data.query.po_id" aria-describedby="inp_po_id_help" readonly="true">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inp_po_need_by_date" class="col-sm-2 col-form-label" wappler-command="editContent">{{trans.data.dateNeeded[lang.value]}}</label>
                                    <div class="col-sm-10">
                                        <input type="datetime-local" class="form-control" id="inp_po_need_by_date" name="po_need_by_date" dmx-bind:value="read_purchase_order.data.query.po_need_by_date" aria-describedby="inp_po_id_help" dmx-bind:min="var1.datetime">
                                    </div>
                                </div>
                                <div class="mb-3 row ">
                                    <label for="inp_payment_method" class="col-sm-2 col-form-label" wappler-command="editContent">{{trans.data.paymentMethod[lang.value]}}</label>
                                    <div class="col-sm-10">
                                        <select id="select1" class="form-select" dmx-bind:options="loadpaymentmethods.data.query" optiontext="payment_method_name" optionvalue="payment_method_id" name="payment_method" dmx-bind:value="read_purchase_order.data.query.payment_method" required="" data-msg-required="!" dmx-bind:disabled="read_purchase_order.data.query.po_status == 'Received'">
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3 text-danger fw-bold">
                                    <label for="inp_payment_method" class="col-sm-2 col-form-label" wappler-command="editContent">{{trans.data.vendor[lang.value]}}</label>
                                    <div class="col-sm-10">
                                        <select id="select4" class="form-select" name="servo_vendors_vendor_id" dmx-bind:disabled="read_purchase_order.data.query.po_status == 'Received'" dmx-bind:options="list_vendors.data.query_list_vendors" optiontext="vendor_name" optionvalue="vendor_id" dmx-bind:value="read_purchase_order.data.query.servo_vendors_vendor_id" required="" data-msg-required="!">
                                            <option selected="" value="%">{{trans.data.vendor[lang.value]}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inp_po_notes" class="col-sm-2 col-form-label" wappler-command="editContent">{{trans.data.note[lang.value]}}</label>
                                    <div class="col-sm-7">
                                        <textarea type="text" class="form-control" id="inp_po_notes" name="po_notes" dmx-bind:value="read_purchase_order.data.query.po_notes" aria-describedby="inp_po_notes_help" dmx-bind:disabled="read_purchase_order.data.query.po_status == 'Received'"></textarea>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm-2" wappler-empty="Column" wappler-command="addElementInside">&nbsp;</div>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary" wappler-command="editContent" dmx-hide="read_purchase_order.data.query.po_status == 'Received'">{{trans.data.ok[lang.value]}}</button>
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
        <div class="modal readitem" id="readAOModal" is="dmx-bs5-modal" tabindex="-1" dmx-on:hidden-bs-modal="session_variables.remove('current_purchase_order')">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="d-block">
                            <h2 class="text-warning">{{trans.data.stockAdjustment[lang.value]}}</h2>
                        </div>







                        <button id="btn13" class="btn float-right text-white-50" data-bs-toggle="offcanvas" data-bs-target="#AddProductstoAO" dmx-on:click="" dmx-hide="(read_purchase_order.data.query.po_status == 'Received')">
                            <i class="fas fa-cart-plus fa-2x"></i>
                        </button>
                        <div id="conditional2" is="dmx-if" dmx-bind:condition="(session_variables.data.user_profile == 'Admin')">
                            <main>
                                <div class="row">
                                    <div class="col d-flex">
                                        <form id="approvePO1" is="dmx-serverconnect-form" method="post" action="dmxConnect/api/servo_purchase_orders/approve_po.php" dmx-on:success="notifies1.success('Success!');list_purchase_orders.load();readItemModal.hide()">
                                            <input id="poid2" name="po_id1" type="text" class="form-control visually-hidden" dmx-bind:value="read_purchase_order.data.query.po_id">
                                            <input id="timeapproved1" name="time_approved1" type="datetime-local" class="form-control visually-hidden" dmx-bind:value="var1.datetime">
                                            <input id="userApproved1" name="servo_users_user_approved_id1" class="form-control visually-hidden" dmx-bind:value="session_variables.data.user_id">
                                            <input id="poStatus1" name="po_status1" type="text" class="form-control visually-hidden" dmx-bind:value="'Approved'">
                                            <button id="btn13" class="btn float-right text-warning" data-bs-target="#AddProductsToOrderOffCanvas" dmx-on:click="" type="submit" dmx-hide="(read_purchase_order.data.query.po_status == 'Approved');(read_purchase_order.data.query.po_status == 'Received')">
                                                <i class="fas fa-check fa-2x"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </main>

                        </div>



                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="offcanvas offcanvas-start w-100" id="AddProductstoAO" is="dmx-bs5-offcanvas" tabindex="-1">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title">{{trans.data.addProducts[lang.value]}}</h5>
                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <div class="row row-cols-7">
                                    <div class="flex-md-wrap flex-md-row justify-content-md-center rounded align-content-center mt-2 mb-2 ms-1 me-1 pt-3 pb-3 ps-3 pe-3 col-12 offset-md-1 col-xxl-3 col-lg-2 col-xl-2 col-sm-4 col-md-3 bg-secondary" dmx-repeat:products="load_products.data.query_list_products" id="addItemToAO" style="padding-top: 0px !important; margin-top: 0px !important;">
                                        <div class="row" style="">
                                            <div class="col text-center" style="padding: 0px !important; height: 200px;" dmx-hide="product_picture==null">
                                                <img dmx-bind:src="'/servo/uploads/product_pictures/'+product_picture" width="100%" height="95%" loading="lazy" style="object-fit: cover;">
                                            </div>
                                        </div>
                                        <h3 class="text-center text-warning">{{product_name}}</h3>
                                        <h4 class="text-center">{{product_price}}</h4>
                                        <form id="add_products_to_ao" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_order_items/add_order_item_to_ao.php" dmx-on:success="AddProductstoAO.add_products_to_ao.reset();list_ao_items.load();notifies1.success('Success:'+product_name+' Added to Order')">
                                            <input id="ao_item_quantity" name="order_item_quantity" type="number" class="form-control mb-sm-1 mb-2" required="" data-msg-required="Required!" min="" data-rule-min="1" data-msg-min="Min 1" dmx-bind:placeholder="trans.data.quantity[lang.value]">
                                            <input id="aoTimeOrdered" name="order_time_ordered" type="datetime-local" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="Quantity" dmx-bind:value="dateTime.datetime">
                                            <input id="order_id" name="servo_orders_order_id" type="number" class="form-control mb-sm-1 mb-2 visually-hidden" dmx-bind:value="session_variables.data.current_adjustment_order">
                                            <input id="aoDepartment" name="servo_departments_department_id" type="number" class="form-control mb-sm-1 mb-2 visually-hidden" dmx-bind:value="session_variables.data.user_department_id">
                                            <input id="productId" name="servo_products_product_id" type="number" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="1" dmx-bind:value="product_id">
                                            <input id="ao_item_price" name="order_item_price" type="number" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="Cost Price" dmx-bind:value="0">
                                            <input id="aoUserOrdered" name="servo_users_user_ordered" type="number" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="Cost Price" dmx-bind:value="session_variables.data.user_id">
                                            <textarea id="ao_notes" class="form-control" name="order_item_notes" dmx-bind:placeholder="trans.data.note[lang.value]"></textarea>
                                            <button id="btn13" class="add-item-button btn btn-warning mt-2 align-self-end btn-lg w-100" type="submit">
                                                <i class="fas fa-plus fa-lg"></i>
                                            </button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="d-flex col justify-content-start">
                                <div class="d-block">
                                    <h3>#</h3>
                                </div>
                                <div class="d-block ms-2">
                                    <h3 class="text-info" dmx-text="read_adjustment_order.data.query.order_id"></h3>
                                </div>

                                <div class="d-block text-danger ms-2">
                                    <h3>{{list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`)}}</h3>
                                </div>
                                <div class="text-danger float-right">

                                </div>
                            </div>
                        </div>
                        <h1>{{read_item_department.data.query.department_name}}</h1>
                        <div class="row">
                            <div class="col">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Order item</th>
                                                <th>Order time ordered</th>
                                                <th>Order item notes</th>
                                                <th>Order item quantity</th>
                                                <th>Product name</th>
                                                <th>Order</th>
                                                <th>Order time</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_ao_items.data.query" id="tableRepeat7">
                                            <tr>
                                                <td dmx-text="order_item_id"></td>
                                                <td dmx-text="order_time_ordered"></td>
                                                <td dmx-text="order_item_notes"></td>
                                                <td dmx-text="order_item_quantity"></td>
                                                <td dmx-text="product_name"></td>
                                                <td dmx-text="order_id"></td>
                                                <td dmx-text="order_time"></td>
                                                <td>
                                                    <form id="deleteAOItem" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_order_items/delete_order_item.php" dmx-on:success="notifies1.success('Success!');list_ao_items.load({order_id: session_variables.data.current_adjustment_order})">
                                                        <input id="aoItem" name="order_item_id" type="text" class="form-control visually-hidden" dmx-bind:value="order_item_id">
                                                        <button id="btn14" class="btn text-danger" type="submit"><i class="far fa-trash-alt fa-lg"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <form is="dmx-serverconnect-form" id="updatePurchaseOrder1" method="post" action="dmxConnect/api/servo_purchase_orders/update_purchase_order.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="read_purchase_order.data.query">
                                <div class="mb-3 row visually-hidden">
                                    <label for="inp_po_id1" class="col-sm-2 col-form-label visually-hidden" wappler-command="editContent">PO</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control visually-hidden" id="inp_po_id1" name="po_id1" dmx-bind:value="read_purchase_order.data.query.po_id" aria-describedby="inp_po_id_help" disabled="true" readonly="true">
                                    </div>
                                </div>
                                <div class="mb-3 row visually-hidden">
                                    <label for="inp_servo_vendors_vendor_id1" class="col-sm-2 col-form-label visually-hidden" wappler-command="editContent">Vendor</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control visually-hidden" id="inp_servo_vendors_vendor_id1" name="servo_vendors_vendor_id1" dmx-bind:value="read_purchase_order.data.query.servo_vendors_vendor_id" aria-describedby="inp_servo_vendors_vendor_id_help">
                                    </div>
                                </div>
                                <div class="mb-3 row visually-hidden">
                                    <label for="inp_servo_users_user_ordered_id1" class="col-sm-2 col-form-label visually-hidden" wappler-command="editContent">Ordered By</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control visually-hidden" id="inp_servo_users_user_ordered_id1" name="servo_users_user_ordered_id1" dmx-bind:value="read_purchase_order.data.query.servo_users_user_ordered_id" aria-describedby="inp_servo_users_user_ordered_id_help">
                                    </div>
                                </div>
                                <div class="mb-3 row visually-hidden">
                                    <label for="inp_servo_users_user_approved_id1" class="col-sm-2 col-form-label visually-hidden" wappler-command="editContent">Approved By</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control visually-hidden" id="inp_servo_users_user_approved_id1" name="servo_users_user_approved_id1" dmx-bind:value="read_purchase_order.data.query.servo_users_user_approved_id" aria-describedby="inp_servo_users_user_approved_id_help">
                                    </div>
                                </div>
                                <div class="mb-3 row visually-hidden">
                                    <label for="inp_servo_users_user_received_id1" class="col-sm-2 col-form-label visually-hidden" wappler-command="editContent">Received By</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control visually-hidden" id="inp_servo_users_user_received_id1" name="servo_users_user_received_id1" dmx-bind:value="read_purchase_order.data.query.servo_users_user_received_id" aria-describedby="inp_servo_users_user_received_id_help">
                                    </div>
                                </div>
                                <div class="mb-3 row visually-hidden">
                                    <label for="inp_time_ordered1" class="col-sm-2 col-form-label visually-hidden" wappler-command="editContent">Time Ordered</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control visually-hidden" id="inp_time_ordered1" name="time_ordered1" dmx-bind:value="read_purchase_order.data.query.time_ordered" aria-describedby="inp_time_ordered_help" is="dmx-date-picker" timepicker="" use24hours="true">
                                    </div>
                                </div>
                                <div class="mb-3 row visually-hidden">
                                    <label for="inp_time_approved1" class="col-sm-2 col-form-label visually-hidden" wappler-command="editContent">Time approved</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control visually-hidden" id="inp_time_approved1" name="time_approved1" dmx-bind:value="read_purchase_order.data.query.time_approved" aria-describedby="inp_time_approved_help" is="dmx-date-picker" timepicker="" use24hours="true">
                                    </div>
                                </div>
                                <div class="mb-3 row visually-hidden">
                                    <label for="inp_time_received1" class="col-sm-2 col-form-label visually-hidden" wappler-command="editContent">Time Received</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control visually-hidden" id="inp_time_received1" name="time_received1" dmx-bind:value="read_purchase_order.data.query.time_received" aria-describedby="inp_time_received_help" is="dmx-date-picker" timepicker="" use24hours="true">
                                    </div>
                                </div>
                                <div class="mb-3 row visually-hidden">
                                    <label for="inp_po_status1" class="col-sm-2 col-form-label visually-hidden" wappler-command="editContent">Status</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control visually-hidden" id="inp_po_status1" name="po_status1" dmx-bind:value="read_purchase_order.data.query.po_status" aria-describedby="inp_po_status_help">
                                    </div>
                                </div>
                                <div class="mb-3 row ">
                                    <label for="inp_payment_method" class="col-sm-2 col-form-label" wappler-command="editContent">{{trans.data.paymentMethod[lang.value]}}</label>
                                    <div class="col-sm-10">
                                        <select id="select2" class="form-select" dmx-bind:options="loadpaymentmethods.data.query" optiontext="payment_method_name" optionvalue="payment_method_name" name="payment_method1" dmx-bind:value="'Cash'" required="" data-msg-required="!" dmx-bind:disabled="read_purchase_order.data.query.po_status == 'Received'">
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row visually-hidden">
                                    <label for="inp_payment_status1" class="col-sm-2 col-form-label visually-hidden" wappler-command="editContent">Payment Status</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control visually-hidden" id="inp_payment_status1" name="payment_status1" dmx-bind:value="read_purchase_order.data.query.payment_status" aria-describedby="inp_payment_status_help">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inp_po_notes1" class="col-sm-2 col-form-label" wappler-command="editContent">{{trans.data.note[lang.value]}}</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inp_po_notes1" name="po_notes1" dmx-bind:value="read_purchase_order.data.query.po_notes" aria-describedby="inp_po_notes_help" dmx-bind:disabled="read_purchase_order.data.query.po_status == 'Received'" required="" data-msg-required="!">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm-2" wappler-empty="Column" wappler-command="addElementInside">&nbsp;</div>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary" dmx-bind:value="read_purchase_order.data.query.Save" wappler-command="editContent" dmx-hide="read_purchase_order.data.query.po_status == 'Received'">{{trans.data.ok[lang.value]}}</button>
                                    </div>
                                </div>
                            </form>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <form id="form4" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_orders/delete_order_and_items.php" dmx-on:success="notifies1.success('Success');list_orders.load();readItemModal.hide()" onsubmit=" return confirm('CONFIRM DELETE?');">
                            <input id="text2" name="order_id1" type="hidden" class="form-control" dmx-bind:value="read_item_order.data.query.order_id">

                            <button id="btn13" class="btn text-danger" type="submit">
                                <i class="far fa-trash-alt fa-lg"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal readitem" id="printReceipt" is="dmx-bs5-modal" tabindex="-1" dmx-on:hidden-bs-modal="total_sales_per_waiter.load()">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="d-block">
                            <h2 class="text-warning"><b>SERVO</b></h2>
                        </div>






                        <button id="receiptBack" class="btn float-right btn-sm text-danger" data-bs-target="#readItemModal" dmx-on:click="printReceipt.hide()" data-bs-toggle="modal"><i class="fas fa-chevron-left fa-2x">&nbsp;</i></button>
                        <button id="receiptPrint" class="btn float-right btn-sm text-success" data-bs-target="#readItemModal" data-bs-toggle="modal" onclick="print()"><i class="fas fa-print fa-2x">&nbsp;</i></button><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body" id="receiptModal">
                        <main="receiptModal"="receiptModal.>
                            <div class="container mt-auto" id="receiptBody">




                                <div class="row justify-content-start">
                                    <div class="col">
                                        <div class="row justify-content-xxl-start">
                                            <div class="col me-2 d-flex col-xxl">
                                                <h6 class="me-1">{{trans.data.timeOrdered[lang.value]}}</h6>
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
                                                                <th>{{trans.data.time[lang.value]}}</th>
                                                                <th>{{trans.data.quantity[lang.value]}}</th>
                                                                <th>{{trans.data.price[lang.value]}}</th>
                                                                <th>{{trans.data.total[lang.value]}}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_order_items.data.query" id="tableRepeat4">
                                                            <tr>
                                                                <td dmx-text="product_name"></td>
                                                                <td dmx-text="order_time_ordered"></td>
                                                                <td dmx-text="order_item_quantity"></td>
                                                                <td dmx-text="order_item_price"></td>
                                                                <td dmx-text="(order_item_quantity * order_item_price)"></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col d-flex justify-content-end" id="receiptTotal">
                                                <div class="d-block ms-2">
                                                    <h3 class="ms-2">{{trans.data.total[lang.value]}}:</h3>
                                                </div>
                                                <div class="d-block ms-2">
                                                    <h2 class="fw-bold">{{list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`)}}</h2>
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
    <main class="container-fluid">
        <div class="container mt-auto">




            <div class="row servo-page-header">
                <div class="col text-light">
                    <h3>{{userInfo.data.query_list_user_shift_noshift[0].department_name}}</h3>
                </div>
                <div class="col style13 page-button d-flex justify-content-sm-end justify-content-end" id="pagebuttons">

                    <button id="btn1" class="btn style12 fw-light text-warning" data-bs-toggle="modal" data-bs-target="#CreateOrderModal" style="float: right;"><i class="fas fa-plus fa-2x"></i></button>
                </div>
            </div>
            <ul class="nav nav-tabs" id="navTabs1_tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="navTabs1_1_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_1" role="tab" aria-controls="navTabs1_1" aria-selected="true">{{trans.data.stock[lang.value]}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="navTabs1_2_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_2" role="tab" aria-controls="navTabs1_2" aria-selected="false">{{trans.data.purchaseOrders[lang.value]}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="navTabs1_2_tab1" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_3" role="tab" aria-controls="navTabs1_2" aria-selected="false">{{trans.data.stockAdjustment[lang.value]}}</a>
                </li>
            </ul>
            <div class="tab-content" id="navTabs1_content">
                <div class="tab-pane fade show active" id="navTabs1_1" role="tabpanel">
                    <div class="row mt-1">
                        <div class="col">
                            <div class="table-responsive servo-shadow">
                                <table class="table table-hover table-sm table-borderless">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>{{trans.data.product[lang.value]}}</th>
                                            <th>{{trans.data.purchased[lang.value]}}</th>
                                            <th>{{trans.data.adjusted[lang.value]}}</th>
                                            <th>{{trans.data.sold[lang.value]}}</th>
                                            <th>{{trans.data.inStock[lang.value]}}</th>
                                        </tr>
                                    </thead>
                                    <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="productstockvalues.data.getStockValues2_department" id="tableRepeat6">
                                        <tr>
                                            <td dmx-text="po_product_id"></td>
                                            <td dmx-text="product_name"></td>
                                            <td dmx-text="TotalPurchased"></td>
                                            <td dmx-text="TotalAdjusted"></td>
                                            <td dmx-text="TotalSold"></td>
                                            <td dmx-text="(TotalPurchased - TotalSold - TotalAdjusted)"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="navTabs1_2" role="tabpanel">
                    <div class="row mt-1" id="orders_table" style="height: 450px; overflow: scroll;">
                        <div class="col">


                            <div class="table-responsive">
                                <table class="table table-hover table-sm table-borderless">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{trans.data.attention[lang.value]}}</th>
                                            <th>{{trans.data.timeOrdered[lang.value]}}</th>
                                            <th>{{trans.data.status[lang.value]}}</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_purchase_orders.data.query" id="tableRepeat5">
                                        <tr>
                                            <td dmx-text="po_id"></td>
                                            <td dmx-text="user_username"></td>
                                            <td dmx-text="time_ordered"></td>
                                            <td dmx-text="trans.data.getValueOrKey(po_status)[lang.value]" dmx-class:greenlight="(po_status == 'Received')" dmx-class:redlight="(po_status == 'Requested')" dmx-class:yellowlight="(po_status == 'Approved')"></td>
                                            <td>
                                                <button id="btn2" class="btn text-warning" data-bs-target="#readItemModal" dmx-on:click="readItemModal.show();session_variables.set('current_purchase_order',po_id);read_purchase_order.load({po_id: po_id})" dmx-bind:value="list_purchase_orders.data.query[0].po_id" data-bs-toggle="modal"><i class="fas fa-expand-alt"><br></i></button>
                                            </td>
                                            <td>

                                                <form id="form2" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_purchase_orders/delete_purchase_order.php" dmx-on:success="notifies1.success('Success');list_purchase_orders.load();productstockvalues.load()"><input id="deleteProcurementID" name="po_id" type="text" class="form-control visually-hidden" dmx-bind:value="po_id"><button id="btn2" class="btn text-secondary" data-bs-target="#productInfo" type="submit"><i class="far fa-trash-alt fa-lg"><br></i></button></form>

                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="navTabs1_3" role="tabpanel" aria-labelledby="navTabs1_2_tab1">
                    <div class="table-responsive mt-1" id="stockadjustments">
                        <table class="table table-hover table-sm table-borderless" id="stockadjustmentsTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{trans.data.dateTime[lang.value]}}</th>
                                    <th>{{trans.data.attention[lang.value]}}</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_adjustment_orders.data.query_list_adjustment_orders_department" id="ao_table">
                                <tr>
                                    <td dmx-text="order_id"></td>
                                    <td dmx-text="order_time"></td>
                                    <td dmx-text="user_username"></td>
                                    <td>
                                        <button id="btn22" class="btn text-warning" data-bs-target="#readAOModal" dmx-on:click="session_variables.set('current_adjustment_order',order_id);read_adjustment_order.load({order_id: session_variables.data.current_adjustment_order});list_ao_items.load({order_id: read_adjustment_order.data.query.order_id})" dmx-bind:value="order_id" data-bs-toggle="modal"><i class="fas fa-expand-alt fa-lg"><br></i></button>
                                    </td>
                                    <td class="text-secondary">

                                        <form id="form2" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_orders/delete_order_and_items.php" dmx-on:success="notifies1.success('Success');list_purchase_orders.load();list_adjustment_orders.load();productstockvalues.load()"><input id="deleteAO" name="order_id" type="text" class="form-control visually-hidden" dmx-bind:value="order_id"><button id="btn2" class="btn text-secondary" data-bs-target="#productInfo" type="submit"><i class="far fa-trash-alt fa-lg"><br></i></button></form>

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