<!doctype html>
<html>

<head>
    <script src="dmxAppConnect/dmxAppConnect.js"></script>
    <meta name="ac:base" content="/servo">
    <base href="/servo/">
    <meta charset="UTF-8">
    <title>Untitled Document</title>

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
<link rel="stylesheet" href="fontawesome5/css/all.min.css" />
</head>

<body is="dmx-app" id="departments">
<dmx-scheduler id="scheduler1" dmx-on:tick="total_sales_all_waiters_in_per_shift.load({current_shift: session_variables.data.current_shift, order_status: 'Paid'});total_sales_all_waiters_out_per_shift.load({current_shift: session_variables.data.current_shift, order_status: 'Ordered'});list_orders_all_shift.load({current_shift: session_variables.data.current_shift})" delay="30"></dmx-scheduler>
    <dmx-datetime id="var1"></dmx-datetime>
    <dmx-serverconnect id="total_sales_all_waiters_in_per_shift" url="dmxConnect/api/servo_data/total_sales_all_waiters_in_per_shift.php" dmx-param:user_id="session_variables.data.user_id" dmx-param:order_status="'Paid'" dmx-param:current_shift="session_variables.data.current_shift"></dmx-serverconnect>
<dmx-serverconnect id="total_sales_all_waiters_out_per_shift" url="dmxConnect/api/servo_data/total_sales_all_waiters_out_per_shift.php" dmx-param:user_id="session_variables.data.user_id" dmx-param:current_shift="session_variables.data.current_shift" dmx-param:order_status="'Ordered'"></dmx-serverconnect>
    <dmx-serverconnect id="delte_item_order_item" url="dmxConnect/api/servo_order_items/delete_order_item.php"></dmx-serverconnect>
    <dmx-serverconnect id="list_order_items_current" url="dmxConnect/api/servo_order_items/list_order_items_current.php" dmx-param:order_id="session_variables.data.current_order"></dmx-serverconnect>
    <dmx-serverconnect id="get_order_total" url="dmxConnect/api/servo_order_items/compute_order_total.php" dmx-param:order_id="session_variables.data.current_order"></dmx-serverconnect>
    <dmx-serverconnect id="list_order_items" url="dmxConnect/api/servo_order_items/list_order_items.php" dmx-param:order_id="read_item_order.data.query.order_id"></dmx-serverconnect>
    <dmx-serverconnect id="load_products" url="dmxConnect/api/servo_products/list_products.php"></dmx-serverconnect>
    <dmx-session-manager id="session_variables"></dmx-session-manager>
    <dmx-serverconnect id="load_tables" url="dmxConnect/api/servo_tables/list_tables.php"></dmx-serverconnect>

    <dmx-serverconnect id="load_product_categories" url="dmxConnect/api/servo_refered_fields_loading/load_product_categories.php"></dmx-serverconnect>
    <dmx-serverconnect id="read_item_order" url="dmxConnect/api/servo_orders/read_order.php" dmx-param:id="id" noload dmx-param:item_id="" dmx-param:branch_id="read_item_branch.data.queryReadBranch.branch_id" dmx-param:department_id="" dmx-param:order_id="tableRepeat2[0].order_id"></dmx-serverconnect>
    <dmx-serverconnect id="delete_item_order" url="dmxConnect/api/servo_departments/delete_department.php"></dmx-serverconnect>
    <dmx-serverconnect id="list_orders_all_shift" url="dmxConnect/api/servo_orders/list_orders_all_shift.php" dmx-param:user_id="" dmx-param:current_shift="session_variables.data.current_shift"></dmx-serverconnect>
    <div is="dmx-browser" id="browser1"></div>
    <dmx-notifications id="notifies1" timeout="100" position="bottom" extended-timeout="200"></dmx-notifications>
    <?php include 'header.php'; ?>
    <main>
        <div class="container mt-auto">




            <div class="row" id="receipt" style="height: 450px; overflow: scroll;">
<div class="col"><div class="row">
                            <div class="d-flex col justify-content-start">
                                <div class="d-block">
                                    <h3>Waiter:</h3>
                                </div>
                                <div class="d-block ms-2">
                                    <h3 class="text-info" dmx-text="read_item_order.data.query.user_username"></h3>
                                </div>
                                <div class="d-block ms-2">
                                    <h3 class="ms-1">Table:</h3>
                                </div>
                                <div class="d-block ms-2">
                                    <h3 class="text-success">{{list_order_items.data.query[0].table_name}}&nbsp;</h3>
                                </div>
                                <div class="d-block ms-2">
                                    <h3 class="ms-2">Total:</h3>
                                </div>
                                <div class="d-block text-danger ms-2">
                                    <h3>{{list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`)}}</h3>
                                </div>
                                <div class="text-danger float-right">

                                </div>
                            </div>
                        </div><div class="row">
                            <div class="col">
                                <div class="table-responsive" id="order_details_table">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Time</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                            </tr>
                                        </thead>
                                        <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_order_items.data.query" id="tableRepeat4">
                                            <tr>
                                                <td dmx-text="product_name"></td>
                                                <td dmx-text="order_time_ordered"></td>
                                                <td dmx-text="order_item_quantity"></td>
                                                <td dmx-text="order_item_price"></td>
                                                <td dmx-text="order_item_discount"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div><div class="row">
                        </div></div>
            </div>
        </div>
    </main>
    <script src="bootstrap/5/js/bootstrap.bundle.min.js"></script>
</body>

</html>