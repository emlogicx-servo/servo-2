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
  <title>SERVO</title>

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/style.css" />
  <script src="js/jquery-3.5.1.min.js"></script>
  <script src="dmxAppConnect/dmxBootstrap5Navigation/dmxBootstrap5Navigation.js" defer=""></script>
  <link rel="stylesheet" href="bootstrap/5/servolight/bootstrap.min.css" />
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
  <script src="socket.io/socket.io.js" defer=""></script>
  <script src="dmxAppConnect/dmxSockets/dmxSockets.js" defer=""></script>
  <script src="dmxAppConnect/dmxCharts/Chart.min.js" defer=""></script>
  <script src="dmxAppConnect/dmxCharts/dmxCharts.js" defer=""></script>
  <script src="dmxAppConnect/dmxBootstrap5PagingGenerator/dmxBootstrap5PagingGenerator.js" defer=""></script>
  <link rel="stylesheet" href="fontawesome5/css/all.min.css" />
  <script src="dmxAppConnect/dmxRouting/dmxRouting.js" defer=""></script>
  <script src="dmxAppConnect/dmxDownload/dmxDownload.js" defer=""></script>
  <link rel="stylesheet" href="bootstrap/5/css/bootstrap.min.css" />
</head>

<body id="ServoReports" style="" is="dmx-app">

  <dmx-value id="pageName" dmx-bind:value="trans.data.reports[lang.value]"></dmx-value>
  <dmx-download id="download1" url="reports/servoSalesReport.csv" dmx-bind:filename="'ServoReport-'+listOrdersFilters.date1.value+listOrdersFilters.date2.value+'-'+listOrdersFilters.waiterFilter.selectedText+'-'+listOrdersFilters.serviceSelect.selectedText+'.csv'"></dmx-download>
  <dmx-download id="download2" url="reports/servoPurchaseReport.csv" dmx-bind:filename="'servoPurchaseReport-'+listOrdersFilters1.date3.value+'-'+listOrdersFilters1.date4.value+'-'+listOrdersFilters1.waiterFilter1.selectedText+'-'+listOrdersFilters1.departmentSelect1.selectedText"></dmx-download>
  <dmx-serverconnect id="load_services" url="dmxConnect/api/servo_services/list_services.php"></dmx-serverconnect>
  <dmx-serverconnect id="TotalSales" url="dmxConnect/api/servo_reporting/product_report_total_sales.php"></dmx-serverconnect>
  <dmx-serverconnect id="load_departments" url="dmxConnect/api/servo_departments/list_departments.php"></dmx-serverconnect>
  <dmx-serverconnect id="load_shifts" url="dmxConnect/api/servo_shifts/list_shifts.php"></dmx-serverconnect>
  <dmx-serverconnect id="load_users_for_report" url="dmxConnect/api/servo_users/list_users_for_report.php"></dmx-serverconnect>
  <dmx-serverconnect id="payment_methods_report" url="dmxConnect/api/servo_reporting/payment_methods_report.php" dmx-param:datefrom="listOrdersFilters.date1.value" dmx-param:dateto="listOrdersFilters.date2.value" dmx-param:user="listOrdersFilters.waiterFilter.value" dmx-param:service="listOrdersFilters.serviceSelect.value"></dmx-serverconnect>
  <dmx-serverconnect id="product_report_total_sales" url="dmxConnect/api/servo_reporting/product_report_total_sales.php" dmx-param:datefrom="listOrdersFilters.date1.value" dmx-param:dateto="listOrdersFilters.date2.value" dmx-param:user="listOrdersFilters.waiterFilter.value" dmx-param:service="listOrdersFilters.serviceSelect.value"></dmx-serverconnect>
  <dmx-query-manager id="list_orders_report"></dmx-query-manager>
  <dmx-scheduler id="scheduler1" dmx-on:tick="total_sales_all_waiters_in_per_shift.load({current_shift: session_variables.data.current_shift, order_status: 'Paid'});total_sales_all_waiters_out_per_shift.load({current_shift: session_variables.data.current_shift, order_status: 'Ordered'});list_order_items_report.load({order_id: report.orderReport[0].order_id})" delay="30"></dmx-scheduler>
  <dmx-datetime id="var1"></dmx-datetime>
  <dmx-serverconnect id="total_sales_all_waiters_in_per_shift" url="dmxConnect/api/servo_data/total_sales_all_waiters_in_per_shift.php" dmx-param:user_id="session_variables.data.user_id" dmx-param:order_status="'Paid'" dmx-param:current_shift="session_variables.data.current_shift"></dmx-serverconnect>
  <dmx-serverconnect id="total_sales_all_waiters_out_per_shift" url="dmxConnect/api/servo_data/total_sales_all_waiters_out_per_shift.php" dmx-param:user_id="session_variables.data.user_id" dmx-param:current_shift="session_variables.data.current_shift" dmx-param:order_status="'Ordered'"></dmx-serverconnect>
  <dmx-serverconnect id="list_order_items_current" url="dmxConnect/api/servo_order_items/list_order_items_current.php" dmx-param:order_id="session_variables.data.current_order"></dmx-serverconnect>
  <dmx-serverconnect id="get_order_total" url="dmxConnect/api/servo_order_items/compute_order_total.php" dmx-param:order_id="session_variables.data.current_order"></dmx-serverconnect>
  <dmx-serverconnect id="list_order_items_report" url="dmxConnect/api/servo_reporting/list_order_items_report.php" dmx-param:order_id="report.orderReport[0].order_id"></dmx-serverconnect>
  <dmx-serverconnect id="load_products" url="dmxConnect/api/servo_products/list_products.php"></dmx-serverconnect>
  <dmx-session-manager id="session_variables"></dmx-session-manager>
  <dmx-serverconnect id="load_tables" url="dmxConnect/api/servo_tables/list_tables.php"></dmx-serverconnect>

  <dmx-serverconnect id="load_product_categories" url="dmxConnect/api/servo_refered_fields_loading/load_product_categories.php"></dmx-serverconnect>
  <dmx-serverconnect id="read_item_order" url="dmxConnect/api/servo_orders/read_order.php" dmx-param:id="id" noload dmx-param:item_id="" dmx-param:branch_id="read_item_branch.data.queryReadBranch.branch_id" dmx-param:department_id="" dmx-param:order_id="tableRepeat2[0].order_id"></dmx-serverconnect>
  <dmx-serverconnect id="delete_item_order" url="dmxConnect/api/servo_departments/delete_department.php"></dmx-serverconnect>
  <dmx-serverconnect id="list_all_orders_report" url="dmxConnect/api/servo_reporting/list_all_orders_report.php" dmx-param:user_id="" dmx-param:current_shift="session_variables.data.current_shift" dmx-param:sort="list_orders_report.data.sort" dmx-param:dir="list_orders_report.data.dir" dmx-param:datefrom="listOrdersFilters.date1.value" dmx-param:dateto="listOrdersFilters.date2.value" dmx-param:waiter="listOrdersFilters.waiterFilter.value" dmx-param:order=""></dmx-serverconnect>
  <dmx-serverconnect id="list_all_order_items_report" url="dmxConnect/api/servo_reporting/list_all_order_items_report.php" dmx-param:user_id="" dmx-param:current_shift="session_variables.data.current_shift" dmx-param:sort="list_orders_report.data.sort" dmx-param:dir="list_orders_report.data.dir" dmx-param:datefrom="listOrdersFilters.date1.value" dmx-param:dateto="listOrdersFilters.date2.value" dmx-param:waiter="listOrdersFilters.waiterFilter.value" dmx-param:order=""></dmx-serverconnect>
  <dmx-serverconnect id="list_all_order_products_report" url="dmxConnect/api/servo_reporting/product_report.php" dmx-param:user_id="" dmx-param:current_shift="session_variables.data.current_shift" dmx-param:sort="" dmx-param:dir="" dmx-param:datefrom="" dmx-param:dateto="" dmx-param:waiter="" dmx-param:order=""></dmx-serverconnect>
  <dmx-serverconnect id="product_category_report" url="dmxConnect/api/servo_reporting/product_category_report.php" dmx-param:user_id="" dmx-param:current_shift="session_variables.data.current_shift" dmx-param:sort="" dmx-param:dir="" dmx-param:datefrom="listOrdersFilters.date1.value" dmx-param:dateto="listOrdersFilters.date2.value" dmx-param:waiter="" dmx-param:order="" dmx-param:user="listOrdersFilters.waiterFilter.value" dmx-param:service="listOrdersFilters.serviceSelect.value"></dmx-serverconnect>
  <dmx-serverconnect id="product_sales_accessories_total" url="dmxConnect/api/servo_reporting/product_report_accessories_total.php" dmx-param:user_id="" dmx-param:current_shift="session_variables.data.current_shift" dmx-param:sort="" dmx-param:dir="" dmx-param:datefrom="listOrdersFilters.date1.value" dmx-param:dateto="listOrdersFilters.date2.value" dmx-param:waiter="" dmx-param:order="" dmx-param:user="listOrdersFilters.waiterFilter.value" dmx-param:service="listOrdersFilters.serviceSelect.value"></dmx-serverconnect>
  <dmx-serverconnect id="product_report" url="dmxConnect/api/servo_reporting/product_report.php" dmx-param:user_id="" dmx-param:current_shift="session_variables.data.current_shift" dmx-param:sort="" dmx-param:dir="" dmx-param:datefrom="listOrdersFilters.date1.value" dmx-param:dateto="listOrdersFilters.date2.value" dmx-param:waiter="" dmx-param:order="" dmx-param:datestart="" dmx-param:datestop="" dmx-param:user="listOrdersFilters.waiterFilter.value" dmx-param:shift_id="listOrdersFilters.shiftSelect.value" dmx-param:service="listOrdersFilters.serviceSelect.value"></dmx-serverconnect>
  <dmx-serverconnect id="product_report_export" url="dmxConnect/api/servo_reporting/product_report_export.php" dmx-param:datefrom="listOrdersFilters.date1.value" dmx-param:dateto="listOrdersFilters.date2.value" dmx-param:user="listOrdersFilters.waiterFilter.value" dmx-param:service="listOrdersFilters.serviceSelect.value" noload dmx-on:success="download1.download()" dmx-on:error="notifies1.danger('Error!')"></dmx-serverconnect>
  <dmx-serverconnect id="product_sales_total" url="dmxConnect/api/servo_reporting/product_sales_total.php" dmx-param:user="listOrdersFilters.waiterFilter.selectedValue" dmx-param:service="listOrdersFilters.serviceSelect.selectedValue" dmx-param:datefrom="listOrdersFilters.date1.value" dmx-param:dateto="listOrdersFilters.date2.value"></dmx-serverconnect>
  <dmx-serverconnect id="product_sales_credit_total" url="dmxConnect/api/servo_reporting/product_sales_credit_total.php" dmx-param:user="listOrdersFilters.waiterFilter.selectedValue" dmx-param:service="listOrdersFilters.serviceSelect.selectedValue" dmx-param:datefrom="listOrdersFilters.date1.value" dmx-param:dateto="listOrdersFilters.date2.value"></dmx-serverconnect>
  <dmx-serverconnect id="product_sales_credit_total_all_time" url="dmxConnect/api/servo_reporting/product_sales_credit_total_all_time.php" dmx-param:user="listOrdersFilters.waiterFilter.selectedValue" dmx-param:service="listOrdersFilters.serviceSelect.selectedValue" dmx-param:datefrom="listOrdersFilters.date1.value" dmx-param:dateto="listOrdersFilters.date2.value"></dmx-serverconnect>
  <dmx-serverconnect id="product_purchases_report" url="dmxConnect/api/servo_reporting/product_purchases_report.php" dmx-param:user="purchaseReportFilter.userFilter_p.value" dmx-param:service="listOrdersFilters.serviceSelect.selectedValue" dmx-param:datefrom="purchaseReportFilter.date1_p.value" dmx-param:dateto="purchaseReportFilter.date2_p.value" dmx-param:department="purchaseReportFilter.departmentSelect_p.value"></dmx-serverconnect>
  <dmx-serverconnect id="product_purchases_received_all_categories_report" url="dmxConnect/api/servo_reporting/product_purchases_received_all_categories_report.php" dmx-param:user="listOrdersFilters1.waiterFilter1.value" dmx-param:service="listOrdersFilters.serviceSelect.selectedValue" dmx-param:datefrom="listOrdersFilters1.date3.value" dmx-param:dateto="listOrdersFilters1.date4.value" dmx-param:department="listOrdersFilters1.departmentSelect1.value"></dmx-serverconnect>
  <dmx-serverconnect id="product_purchases_export" url="dmxConnect/api/servo_reporting/product_purchases_export.php" dmx-param:user="listOrdersFilters1.waiterFilter1.value" dmx-param:service="listOrdersFilters.serviceSelect.selectedValue" dmx-param:datefrom="listOrdersFilters1.date3.value" dmx-param:dateto="listOrdersFilters1.date4.value" dmx-param:department="listOrdersFilters1.departmentSelect1.value" dmx-on:success="download2.download()" noload></dmx-serverconnect>
  <dmx-serverconnect id="product_purchases_received_all_products_report" url="dmxConnect/api/servo_reporting/product_purchases_received_all_products_report.php" dmx-param:user="listOrdersFilters1.waiterFilter1.value" dmx-param:service="listOrdersFilters.serviceSelect.selectedValue" dmx-param:datefrom="listOrdersFilters1.date3.value" dmx-param:dateto="listOrdersFilters1.date4.value" dmx-param:department="listOrdersFilters1.departmentSelect1.value"></dmx-serverconnect>
  <dmx-serverconnect id="product_purchases_received_all_payment_methods_report" url="dmxConnect/api/servo_reporting/product_purchases_received_all_payment_methods_report.php" dmx-param:user="listOrdersFilters1.waiterFilter1.value" dmx-param:service="listOrdersFilters.serviceSelect.selectedValue" dmx-param:datefrom="listOrdersFilters1.date3.value" dmx-param:dateto="listOrdersFilters1.date4.value" dmx-param:department="listOrdersFilters1.departmentSelect1.value"></dmx-serverconnect>
  <dmx-serverconnect id="product_purchases_ordered_all_products_report" url="dmxConnect/api/servo_reporting/product_purchases_ordered_all_products_report.php" dmx-param:user="listOrdersFilters1.waiterFilter1.value" dmx-param:service="listOrdersFilters.serviceSelect.selectedValue" dmx-param:datefrom="listOrdersFilters1.date3.value" dmx-param:dateto="listOrdersFilters1.date4.value" dmx-param:department="listOrdersFilters1.departmentSelect1.value"></dmx-serverconnect>
  <dmx-serverconnect id="product_purchases_requested_all_products_report" url="dmxConnect/api/servo_reporting/product_purchases_requested_all_products_report.php" dmx-param:user="listOrdersFilters1.waiterFilter1.value" dmx-param:service="listOrdersFilters.serviceSelect.selectedValue" dmx-param:datefrom="listOrdersFilters1.date3.value" dmx-param:dateto="listOrdersFilters1.date4.value" dmx-param:department="listOrdersFilters1.departmentSelect1.value"></dmx-serverconnect>
  <dmx-serverconnect id="product_purchases_requested_all_time_report" url="dmxConnect/api/servo_reporting/product_purchases_received_all_time_report.php" dmx-param:user="listOrdersFilters1.waiterFilter1.value" dmx-param:service="listOrdersFilters.serviceSelect.selectedValue" dmx-param:datefrom="listOrdersFilters1.date3.value" dmx-param:dateto="listOrdersFilters1.date4.value" dmx-param:department="listOrdersFilters1.departmentSelect1.value"></dmx-serverconnect>
  <dmx-serverconnect id="product_purchases__received_vendor_report" url="dmxConnect/api/servo_reporting/product_purchases_received_vendor_report.php" dmx-param:user="listOrdersFilters1.waiterFilter1.value" dmx-param:service="listOrdersFilters.serviceSelect.selectedValue" dmx-param:datefrom="listOrdersFilters1.date3.value" dmx-param:dateto="listOrdersFilters1.date4.value" dmx-param:department="listOrdersFilters1.departmentSelect1.value"></dmx-serverconnect>
  <div is="dmx-browser" id="browser1"></div>
  <dmx-notifications id="notifies1" timeout="100" position="bottom" extended-timeout="200"></dmx-notifications>
  <?php include 'header.php'; ?>

  <main>
    <div class="modal" is="dmx-bs5-modal" tabindex="-1" id="reportTableSales">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Sales</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row mt-2" id="salesReportGroup">
              <div class="col d-flex justify-content-xxl-end justify-content-xl-end justify-content-lg-end justify-content-md-end justify-content-sm-end justify-content-end">
                <button id="btn1" class="btn btn-secondary text-body shadow-none" dmx-on:click="product_report_export.load({user: listOrdersFilters.waiterFilter.value, datefrom: listOrdersFilters.date1.value, dateto: listOrdersFilters.date2.value, service: listOrdersFilters.serviceSelect.value})">{{trans.data.download[lang.value]}}<i class="fas fa-download fa-sm" style="margin-left: 4px;"></i>
                </button>
              </div>
              <div class="col-xxl mt-lg-2 col-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-1" style="">
                <div class="table-responsive">
                  <table class="table table-hover table-sm">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>{{trans.data.product[lang.value]}}</th>
                        <th>{{trans.data.category[lang.value]}}</th>
                        <th>{{trans.data.volume[lang.value]}}</th>
                        <th>{{trans.data.total[lang.value]}}</th>
                      </tr>
                    </thead>
                    <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="product_report.data.product_report" id="tableRepeat2">
                      <tr>
                        <td dmx-text="product_id"></td>
                        <td dmx-text="product_name"></td>
                        <td dmx-text="product_category_name"></td>
                        <td dmx-text="Volume.toNumber().formatNumber(0, '.', ',')"></td>
                        <td dmx-text="Total.toNumber().formatNumber(0, '.', ',') "></td>
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
  <main>
    <div class="mt-auto">




      <div class="row servo-page-header rounded bg-light mt-2 ms-2 me-2 pt-1 ps-2 pe-2">
        <ul class="nav nav-tabs nav-fill" id="navTabs1_tabs" role="tablist">
          <li class="nav-item text-truncate">
            <a class="nav-link active text-break fw-bold" id="navTabs1_1_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_1" role="tab" aria-controls="navTabs1_1" aria-selected="true"><i class="fas fa-cash-register" style="margin-right: 5px;"></i>{{trans.data.sales[lang.value]}}</a>
          </li>
          <li class="nav-item text-truncate">
            <a class="nav-link text-break fw-bold" id="navTabs1_2_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_2" role="tab" aria-controls="navTabs1_2" aria-selected="false"><i class="fas fa-cart-arrow-down" style="margin-right: 5px;"></i>{{trans.data.purchasing[lang.value]}}</a>
          </li>
          <li class="nav-item text-truncate">
            <a class="nav-link text-break fw-bold" id="navTabs1_3_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_3" role="tab" aria-controls="navTabs1_3" aria-selected="false"><i class="fas fa-coins" style="margin-right:5px;"></i>{{trans.data.finance[lang.value]}}</a>
          </li>
        </ul>
        <div class="tab-content" id="navTabs1_content">
          <div class="tab-pane fade show active " id="navTabs1_1" role="tabpanel">
            <div class="row rounded w-auto row-cols-sm-1 no-gutters text-body shadow-none mt-2 mb-2 pt-2 pb-2 border-primary row-cols-lg-6 row-cols-12 bg-light" id="row1">
              <div class="col-12 col-xxl-12 col-lg-12">

                <form id="listOrdersFilters">
                  <div class="row row-cols-12 row-cols-lg-12">

                    <div class="col-xxl col-md-12 col-12 col-sm-12 col-lg-12">
                      <button id="btn5" class="btn mt-1 me-1 w-auto btn-sm text-body bg-secondary" dmx-on:click="date2.setValue(dateTime.datetime.addDays(1).addDays(-1));
                      date1.setValue(dateTime.datetime.formatDate('yyyy-MM-ddT00:00'))">{{trans.data.today[lang.value]}}</button>
                      <button id="btn8" class="btn mt-1 me-1 w-auto btn-sm text-body bg-secondary" dmx-on:click="date2.setValue(dateTime.datetime.addDays(0).formatDate('yyyy-MM-ddT00:00'));
                      date1.setValue(dateTime.datetime.addDays(-1).formatDate('yyyy-MM-ddT00:00'))">{{trans.data.yesterday[lang.value]}}</button>
                      <button id="btn3" class="btn mt-1 me-1 w-auto btn-sm text-body bg-secondary" dmx-on:click="date1.setValue(dateTime.datetime); 
                      date2.setValue(getDay(dateTime.datetime))">{{trans.data.thisWeek[lang.value]}}</button>
                      <button id="btn9" class="btn mt-1 me-1 w-auto btn-sm text-body bg-secondary" dmx-on:click="date2.setValue(dateTime.datetime.addWeeks(-1).addDays(-1).formatDate('yyyy-MM-ddT00:00'));
                      date1.setValue(dateTime.datetime.addWeeks(-2).addDays(-1).formatDate('yyyy-MM-ddT00:00'))">{{trans.data.lastWeek[lang.value]}}</button>
                      <button id="btn4" class="btn mt-1 me-1 w-auto btn-sm text-body bg-secondary" dmx-on:click="date2.setValue(dateTime.datetime.addMonths(1).formatDate('yyyy-MM-01').addDays(-1));
                      date1.setValue(dateTime.datetime.formatDate('yyyy-MM-01T00:00'))">{{trans.data.thisMonth[lang.value]}}</button>
                      <button id="btn6" class="btn mt-1 me-1 w-auto btn-sm text-body bg-secondary" dmx-on:click="date2.setValue(dateTime.datetime.formatDate('yyyy-MM-01').addDays(-1));
                      date1.setValue(dateTime.datetime.addMonths(-1).formatDate('yyyy-MM-01T00:00'))">{{trans.data.lastMonth[lang.value]}}</button>
                      <button id="btn7" class="btn mt-1 me-1 w-auto btn-sm text-body bg-secondary shadow-none" dmx-on:click="date2.setValue(dateTime.datetime.formatDate('yyyy-MM-01').addDays(-1));
                      date1.setValue(dateTime.datetime.addMonths(-3).formatDate('yyyy-MM-01T00:00'))">{{trans.data.lastThreeMonths[lang.value]}}</button>
                      <button id="btn10" class="btn" dmx-on:click="showSalesFilter.setValue('show')" dmx-hide="(showSalesFilter.value == 'show')">
                        <i class="fas fa-chevron-up"></i></button>
                      <button id="btn11" class="btn" dmx-on:click="showSalesFilter.setValue('hide')" dmx-hide="(showSalesFilter.value == 'hide')">
                        <i class="fas fa-chevron-down"></i></button>
                      <dmx-value id="showSalesFilter" dmx-bind:value="'hide'"></dmx-value><button id="btn12" class="btn" data-bs-toggle="modal" target="" data-bs-target="#reportTableSales">
                        <i class="fas fa-table"></i>
                      </button>
                    </div>
                  </div>
                  <div class="row pb-md-1 mt-2 pb-3 row-cols-sm-2 row-cols-md-2 row-cols-lg-6 justify-content-xxl-start justify-content-xl-start justify-content-lg-start justify-content-md-start row-cols-6 row-cols-xl-8 justify-content-start" style="position: ;" id="salesFilter">
                    <div class="h-auto offset-0 col-sm-5 mb-1 d-flex align-items-center col-auto col-md-4 col-lg-3">
                      <i class="far fa-calendar-alt fa-sm" style="margin-right: 10px;"></i>
                      <input id="date1" name="datefrom" type="datetime-local" class="form-control form-control-sm" dmx-bind:max="date2.value">
                    </div>
                    <div class="ms-lg-2 offset-0 mb-1 d-flex justify-content-start align-items-center col-auto col-sm-7 col-lg-3 offset-md-0 col-md-4">
                      <i class="fas fa-calendar-alt fa-sm" style="margin-right: 10px;"></i>
                      <input id="date2" name="dateto" utc="true" type="datetime-local" class="form-control form-control-sm" dmx-bind:min="date1.value">
                    </div>
                    <div class="ms-lg-2 col-sm offset-0 mb-1 d-flex justify-content-start align-items-center col-auto col-sm-5 col-md-4 col-lg-3">
                      <i class="far fa-user fa-sm" style="margin-right: 10px;"></i>
                      <select id="waiterFilter" class="form-select form-select-sm" dmx-bind:options="load_users_for_report.data.query_list_users" dmx-bind:value="'Select'" name="waiter" optiontext="user_username" optionvalue="user_id">
                        <option selected="" value="%">----</option>
                      </select>
                    </div>
                    <div class="offset-0 mb-1 d-flex align-items-center justify-content-start col-auto col-md-4 col-lg-2">
                      <i class="fas fa-store fa-sm" style="margin-right: 
                      10px;"></i>
                      <select id="serviceSelect" class="form-select form-select-sm" dmx-bind:options="load_services.data.query_list_services" optiontext="service_name" optionvalue="service_id" name="service" dmx-bind:value="'Select'">
                        <option selected="" value="%">----</option>
                      </select>
                    </div>





                  </div>

                </form>

              </div>
            </div>

            <div class="row rounded shadow-none bg-light">
              <div class="scrollable col-12 rounded shadow-none">
                <div class="row justify-content-md-between justify-content-xxl-between g-0 row-cols-12 rounded shadow-none bg-opacity-10 bg-primary mt-0 pt-3 pb-3 ps-2 pe-2" id="row2">

                  <div class="col-12 col-lg-4 align-self-center shadow-none">
                    <div class="row justify-content-center shadow-none">
                      <div class="text-center rounded-2 col-sm col-md col-xxl mt-1 me-2 pt-2 col-md-3 col-auto shadow-none col-5 col-lg-5">
                        <h3 wappler-command="editContent" dmx-text="product_report_total_sales.data.query_product_report_total_sales[0].TotalSales.toNumber().formatNumber('0',',',',')" class="fw-bold text-success">0</h3>
                        <h5 wappler-command="editContent" class="text-body">{{trans.data.totalSales[lang.value]}}</h5>
                      </div>
                      <div class="rounded-2 text-center col-sm col-md col-lg col-xxl mt-1 me-2 pt-2 pb-2 ps-2 pe-2 col-auto col-md-4 col-5 col-lg-6">

                        <h3 dmx-text="product_report_total_sales.data.query_product_report_total_sales[0].Volume.toNumber().formatNumber('0',',',',')" class="fw-bold text-success"></h3>
                        <h5 class="text-body">{{trans.data.totalSalesVolume[lang.value]}}</h5>
                      </div>
                      <div class="text-center rounded rounded-2 mt-1 me-2 pt-2 pb-2 ps-2 pe-2 col-md-4 col-sm-4 shadow-none col-5 col-lg-5">

                        <h3 dmx-text="product_sales_credit_total.data.query_product_sale_credit_total[0].AMOUNT.toNumber().formatNumber(0, '.', ',').default(0)+' '" class="fw-bold text-danger"></h3>
                        <h4 dmx-text="product_sales_credit_total_all_time.data.query_product_sale_credit_total[0].AMOUNT.toNumber().formatNumber(0, '.', ',').default(0)" class="fw-bold text-danger"></h4>
                        <h5 class="text-danger">{{trans.data.totalCreditSales[lang.value]}}</h5>
                      </div>
                      <div class="text-center col-sm-12 col-xxl-5 rounded-2 col-auto mt-1 pt-2 pb-2 ps-2 pe-2 col-md-6 shadow-none col-5 col-lg-6">

                        <h3 dmx-text="product_sales_credit_total.data.query_product_sale_credit_total[0].QUANTITY.toNumber().formatNumber(0, '.', ',').default(0)" class="fw-bold text-warning"></h3>
                        <h4 dmx-text="product_sales_credit_total_all_time.data.query_product_sale_credit_total[0].QUANTITY.toNumber().formatNumber(0, '.', ',').default(0)" class="fw-bold text-warning"></h4>
                        <h5 class="text-warning">{{trans.data.totalCreditSalesVolume[lang.value]}}</h5>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-lg-8">
                    <div class="row mt-1 mt-md-2 gx-lg-0 gy-lg-0 bg-secondary rounded" id="orders_table" style="">
                      <div class="mw-100 col-lg-11 col-md-11 col-11" is="dmx-background-video" id="report">
                        <div class="row mb-2">
                          <div class="col-xxl col-12 col-md-12 col-xxl-8 col-lg-12 y-scroll rounded ms-2 pt-2 pb-2 ps-2 pe-2">

                            <dmx-chart id="chart1" point-size="" dmx-bind:data="product_report.data.product_report" smooth="true" dataset-1:value="Volume" dataset-1:tooltip="" legend="top" stacked="true" type="bar" multicolor="true" dataset-2:value="Total" dataset-1:label="Sales Volume Total" dataset-2:label="Sales Total" labels="product_name" dataset-1="" height="300" width="1000"></dmx-chart>
                            <h3 class="text-center">{{trans.data.products[lang.value]}}</h3>

                          </div>
                        </div>







                      </div>
                    </div>
                  </div>




                </div>

                <div class="row mt-xxl-2 row-cols-12 pt-2 ps-1 pe-1">

                  <div class="col-xxl offset-xxl-1 col-xxl-6 col-lg-6 rounded bg-secondary y-scroll mt-1 ms-1 col-md pt-lg-2 pb-lg-2 ps-lg-2 pe-lg-2">
                    <dmx-chart id="chart2" point-size="" smooth="true" dataset-1:value="Volume" dmx-bind:data="product_category_report.data.product_category_report" dataset-1:tooltip="" legend="top" multicolor="true" colors="colors3" labels="product_category_name" cutout="" type="bar" dataset-2:label="Sales Total" dataset-1:label="Sales Volume Total" dataset-2:value="Total" stacked="true" width="1000" height="300"></dmx-chart>
                    <h3 class="text-center">{{trans.data.categories[lang.value]}}</h3>
                  </div>
                  <div class="col-xxl y-scroll col-md-auto col-lg-5 col-xl-5 col-xxl-5">
                    <dmx-chart id="payment_methods" point-size="" smooth="true" dataset-1:value="TotalPayments" dmx-bind:data="payment_methods_report.data.payment_methods_report" dataset-1:tooltip="" legend="top" multicolor="true" colors="colors3" cutout="" type="pie" dataset-2:label="Sales Total" dataset-1:label="Payment Methods" dataset-2:value="" stacked="true" labels="Method" width="" height="" responsive="true"></dmx-chart>
                    <h3 class="text-center">{{trans.data.payments[lang.value]}}</h3>
                  </div>

                </div>
                <div class="row mt-xxl-2 row-cols-12 ms-2 me-2 pt-2">

                  <div class="col-lg-6 col-md-6">
                    <dmx-chart id="salesCurve2" dmx-bind:data="product_sales_total.data.query_product_sale_total" dataset-1:value="AMOUNT" labels="order_time" dataset-1:tooltip="trans.data.sales[lang.value]" responsive="true" smooth="true" points="true" stacked="true" nogrid="true" colors="colors2" point-size="2" thickness="1"></dmx-chart>
                    <h3 class="text-center">{{trans.data.performance[lang.value]}}</h3>
                  </div>
                  <div class="col-lg-6 col-md-6">
                    <dmx-chart id="accessorySales2" dmx-bind:data="product_sales_accessories_total.data.product_report_accessories_total" dataset-1:value="_['SUM(order_item_quantity)']" dataset-1:tooltip="trans.data.quantity[lang.value]" responsive="true" smooth="true" points="true" nogrid="true" colors="colors2" labels="product_name+' * '+_['SUM(order_item_quantity)']+' *'+_['sum(order_item_quantity * order_item_price)']" point-size="" type="bar" multicolor="true"></dmx-chart>
                    <h3 class="text-center">{{trans.data.accessories[lang.value]}}</h3>
                  </div>

                </div>
                <div class="row mt-2" id="salesReportGroup2">
                  <div class="col d-flex justify-content-xxl-end justify-content-xl-end justify-content-lg-end justify-content-md-end justify-content-sm-end justify-content-end">
                    <button id="btn13" class="btn btn-secondary text-body shadow-none" dmx-on:click="product_report_export.load({user: listOrdersFilters.waiterFilter.value, datefrom: listOrdersFilters.date1.value, dateto: listOrdersFilters.date2.value, service: listOrdersFilters.serviceSelect.value})">{{trans.data.download[lang.value]}}<i class="fas fa-download fa-sm" style="margin-left: 4px;"></i>
                    </button>
                  </div>
                  <div class="col-xxl mt-lg-2 col-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-1" style="">
                    <div class="table-responsive">
                      <table class="table table-hover table-sm">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>{{trans.data.product[lang.value]}}</th>
                            <th>{{trans.data.category[lang.value]}}</th>
                            <th>{{trans.data.volume[lang.value]}}</th>
                            <th>{{trans.data.total[lang.value]}}</th>
                          </tr>
                        </thead>
                        <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="product_report.data.product_report" id="tableRepeat1">
                          <tr>
                            <td dmx-text="product_id"></td>
                            <td dmx-text="product_name"></td>
                            <td dmx-text="product_category_name"></td>
                            <td dmx-text="Volume.toNumber().formatNumber(0, '.', ',')"></td>
                            <td dmx-text="Total.toNumber().formatNumber(0, '.', ',') "></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

              </div>
            </div>




          </div>
          <div class="tab-pane fade" id="navTabs1_2" role="tabpanel">
            <div class="row rounded w-auto row-cols-sm-1 no-gutters text-body shadow-none mt-2 mb-2 pt-2 pb-2 border-primary row-cols-lg-6 row-cols-12 bg-light" id="row3">
              <div class="col-12 col-xxl-12 col-lg-12">

                <form id="purchaseReportFilter">
                  <div class="row row-cols-12 row-cols-lg-12">

                    <div class="col-xxl col-md-12 col-12 col-sm-12 col-lg-12">
                      <button id="today_p" class="btn mt-1 me-1 w-auto btn-sm text-body bg-secondary" dmx-on:click="date2_p.setValue(dateTime.datetime.addDays(1).addDays(-1));
                      date1_p.setValue(dateTime.datetime.formatDate('yyyy-MM-ddT00:00'))">{{trans.data.today[lang.value]}}</button>
                      <button id="yesterday_p" class="btn mt-1 me-1 w-auto btn-sm text-body bg-secondary" dmx-on:click="date2_p.setValue(dateTime.datetime.addDays(0).formatDate('yyyy-MM-ddT00:00'));
                      date1_p.setValue(dateTime.datetime.addDays(-1).formatDate('yyyy-MM-ddT00:00'))">{{trans.data.yesterday[lang.value]}}</button>
                      <button id="thisweek_p" class="btn mt-1 me-1 w-auto btn-sm text-body bg-secondary" dmx-on:click="date2_p.setValue(dateTime.datetime.addWeeks(-1));
                      date1_p.setValue(dateTime.datetime.addWeeks(-1))">{{trans.data.thisWeek[lang.value]}}</button>
                      <button id="lastweek_p" class="btn mt-1 me-1 w-auto btn-sm text-body bg-secondary" dmx-on:click="date2_p.setValue(dateTime.datetime.addWeeks(-1).addDays(-1).formatDate('yyyy-MM-ddT00:00'));
                      date1_p.setValue(dateTime.datetime.addWeeks(-2).addDays(-1).formatDate('yyyy-MM-ddT00:00'))">{{trans.data.lastWeek[lang.value]}}</button>
                      <button id="thismonth_p" class="btn mt-1 me-1 w-auto btn-sm text-body bg-secondary" dmx-on:click="date2_p.setValue(dateTime.datetime.addMonths(1).formatDate('yyyy-MM-01').addDays(-1));
                      date1_p.setValue(dateTime.datetime.formatDate('yyyy-MM-01T00:00'))">{{trans.data.thisMonth[lang.value]}}</button>
                      <button id="lastmonth_p" class="btn mt-1 me-1 w-auto btn-sm text-body bg-secondary" dmx-on:click="date2_p.setValue(dateTime.datetime.formatDate('yyyy-MM-01').addDays(-1));
                      date1_p.setValue(dateTime.datetime.addMonths(-1).formatDate('yyyy-MM-01T00:00'))">{{trans.data.lastMonth[lang.value]}}</button>
                      <button id="last3Months_p" class="btn mt-1 me-1 w-auto btn-sm text-body bg-secondary shadow-none" dmx-on:click="date2_p.setValue(dateTime.datetime.formatDate('yyyy-MM-01').addDays(-1));
                      date1_p.setValue(dateTime.datetime.addMonths(-3).formatDate('yyyy-MM-01T00:00'))">{{trans.data.lastThreeMonths[lang.value]}}</button>
                      <button id="toggleDates1_p" class="btn" dmx-on:click="showSalesFilter.setValue('show')" dmx-hide="(showSalesFilter.value == 'show')">
                        <i class="fas fa-chevron-up"></i></button>
                      <button id="toggleDates2_p" class="btn" dmx-on:click="showSalesFilter.setValue('hide')" dmx-hide="(showSalesFilter.value == 'hide')">
                        <i class="fas fa-chevron-down"></i></button>
                      <dmx-value id="showSalesFilter1" dmx-bind:value="'hide'"></dmx-value><button id="dataTable_p" class="btn" data-bs-toggle="modal" target="" data-bs-target="#reportTableSales">
                        <i class="fas fa-table"></i>
                      </button>
                    </div>
                  </div>
                  <div class="row pb-md-1 mt-2 pb-3 row-cols-sm-2 row-cols-md-2 row-cols-lg-6 justify-content-xxl-start justify-content-xl-start justify-content-lg-start justify-content-md-start row-cols-6 row-cols-xl-8 justify-content-start" style="position: ;" id="salesFilter1">
                    <div class="h-auto offset-0 col-sm-5 mb-1 d-flex align-items-center col-auto col-md-4 col-lg-3">
                      <i class="far fa-calendar-alt fa-sm" style="margin-right: 10px;"></i>
                      <input id="date1_p" name="datefrom1" type="datetime-local" class="form-control form-control-sm" dmx-bind:max="date2.value">
                    </div>
                    <div class="ms-lg-2 offset-0 mb-1 d-flex justify-content-start align-items-center col-auto col-sm-7 col-lg-3 offset-md-0 col-md-4">
                      <i class="fas fa-calendar-alt fa-sm" style="margin-right: 10px;"></i>
                      <input id="date2_p" name="dateto1" utc="true" type="datetime-local" class="form-control form-control-sm" dmx-bind:min="date1.value">
                    </div>
                    <div class="ms-lg-2 col-sm offset-0 mb-1 d-flex justify-content-start align-items-center col-auto col-sm-5 col-md-4 col-lg-3">
                      <i class="far fa-user fa-sm" style="margin-right: 10px;"></i>
                      <select id="userFilter_p" class="form-select form-select-sm" dmx-bind:options="load_users_for_report.data.query_list_users" dmx-bind:value="'Select'" name="waiter1" optiontext="user_username" optionvalue="user_id">
                        <option selected="" value="%">----</option>
                      </select>
                    </div>
                    <div class="offset-0 mb-1 d-flex align-items-center justify-content-start col-auto col-md-4 col-lg-2">
                      <i class="fas fa-store fa-sm" style="margin-right: 
                      10px;"></i>
                      <select id="departmentSelect_p" class="form-select form-select-sm" dmx-bind:options="load_services.data.query_list_services" optiontext="service_name" optionvalue="service_id" name="service1" dmx-bind:value="'Select'">
                        <option selected="" value="%">----</option>
                      </select>
                    </div>





                  </div>

                </form>

              </div>
            </div>
            <div class="row rounded shadow-none bg-light">
              <div class="scrollable col-12 rounded shadow-none">
                <div class="row justify-content-md-between justify-content-xxl-between g-0 row-cols-12 rounded mt-0 pt-3 pb-3 shadow-none" id="row4">

                  <div class="col-12 col-lg-4 align-self-center shadow-none">
                    <div class="row justify-content-center shadow-none">
                      <div class="text-center rounded-2 col-sm col-md col-xxl mt-1 me-2 pt-2 col-md-3 col-auto shadow-none col-5 col-lg-5">
                        <h3 wappler-command="editContent" dmx-text="product_report_total_sales.data.query_product_report_total_sales[0].TotalSales.toNumber().formatNumber('0',',',',')" class="fw-bold text-success">0</h3>
                        <h5 wappler-command="editContent" class="text-body">{{trans.data.totalSales[lang.value]}}</h5>
                      </div>
                      <div class="rounded-2 text-center col-sm col-md col-lg col-xxl mt-1 me-2 pt-2 pb-2 ps-2 pe-2 col-auto col-md-4 col-5 col-lg-6">

                        <h3 dmx-text="product_report_total_sales.data.query_product_report_total_sales[0].Volume.toNumber().formatNumber('0',',',',')" class="fw-bold text-success"></h3>
                        <h5 class="text-body">{{trans.data.totalSalesVolume[lang.value]}}</h5>
                      </div>
                      <div class="text-center rounded rounded-2 mt-1 me-2 pt-2 pb-2 ps-2 pe-2 col-md-4 col-sm-4 shadow-none col-5 col-lg-5">

                        <h3 dmx-text="product_sales_credit_total.data.query_product_sale_credit_total[0].AMOUNT.toNumber().formatNumber(0, '.', ',').default(0)+' '" class="fw-bold text-danger"></h3>
                        <h4 dmx-text="product_sales_credit_total_all_time.data.query_product_sale_credit_total[0].AMOUNT.toNumber().formatNumber(0, '.', ',').default(0)" class="fw-bold text-danger"></h4>
                        <h5 class="text-danger">{{trans.data.totalCreditSales[lang.value]}}</h5>
                      </div>
                      <div class="text-center col-sm-12 col-xxl-5 rounded-2 col-auto mt-1 pt-2 pb-2 ps-2 pe-2 col-md-6 shadow-none col-5 col-lg-6">

                        <h3 dmx-text="product_sales_credit_total.data.query_product_sale_credit_total[0].QUANTITY.toNumber().formatNumber(0, '.', ',').default(0)" class="fw-bold text-warning"></h3>
                        <h4 dmx-text="product_sales_credit_total_all_time.data.query_product_sale_credit_total[0].QUANTITY.toNumber().formatNumber(0, '.', ',').default(0)" class="fw-bold text-warning"></h4>
                        <h5 class="text-warning">{{trans.data.totalCreditSalesVolume[lang.value]}}</h5>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-lg-8">
                    <div class="row mt-1 mt-md-2 gx-lg-0 gy-lg-0 bg-secondary rounded" id="orders_table1" style="">
                      <div class="mw-100 col-lg-11 col-md-11 col-11" is="dmx-background-video" id="report1">
                        <div class="row mb-2">
                          <div class="col-xxl col-12 col-md-12 col-xxl-8 col-lg-12 y-scroll rounded ms-2 pt-2 pb-2 ps-2 pe-2">

                            <dmx-chart id="chart3" point-size="" dmx-bind:data="product_report.data.product_report" smooth="true" dataset-1:value="Volume" dataset-1:tooltip="" legend="top" stacked="true" type="bar" multicolor="true" dataset-2:value="Total" dataset-1:label="Sales Volume Total" dataset-2:label="Sales Total" labels="product_name" dataset-1="" height="300" width="1000"></dmx-chart>
                            <h3 class="text-center">{{trans.data.products[lang.value]}}</h3>

                          </div>
                        </div>







                      </div>
                    </div>
                  </div>




                </div>

                <div class="row mt-xxl-2 row-cols-12 pt-2 ps-1 pe-1">

                  <div class="col-xxl offset-xxl-1 col-xxl-6 col-lg-6 rounded bg-secondary y-scroll mt-1 ms-1 col-md pt-lg-2 pb-lg-2 ps-lg-2 pe-lg-2">
                    <dmx-chart id="chart3" point-size="" smooth="true" dataset-1:value="Volume" dmx-bind:data="product_category_report.data.product_category_report" dataset-1:tooltip="" legend="top" multicolor="true" colors="colors3" labels="product_category_name" cutout="" type="bar" dataset-2:label="Sales Total" dataset-1:label="Sales Volume Total" dataset-2:value="Total" stacked="true" width="1000" height="300"></dmx-chart>
                    <h3 class="text-center">{{trans.data.categories[lang.value]}}</h3>
                  </div>
                  <div class="col-xxl y-scroll col-md-auto col-lg-5 col-xl-5 col-xxl-5">
                    <dmx-chart id="payment_methods1" point-size="" smooth="true" dataset-1:value="TotalPayments" dmx-bind:data="payment_methods_report.data.payment_methods_report" dataset-1:tooltip="" legend="top" multicolor="true" colors="colors3" cutout="" type="pie" dataset-2:label="Sales Total" dataset-1:label="Payment Methods" dataset-2:value="" stacked="true" labels="Method" width="" height="" responsive="true"></dmx-chart>
                    <h3 class="text-center">{{trans.data.payments[lang.value]}}</h3>
                  </div>

                </div>
                <div class="row mt-xxl-2 row-cols-12 ms-2 me-2 pt-2">

                  <div class="col-lg-6 col-md-6">
                    <dmx-chart id="salesCurve1" dmx-bind:data="product_sales_total.data.query_product_sale_total" dataset-1:value="AMOUNT" labels="order_time" dataset-1:tooltip="trans.data.sales[lang.value]" responsive="true" smooth="true" points="true" stacked="true" nogrid="true" colors="colors2" point-size="2" thickness="1"></dmx-chart>
                    <h3 class="text-center">{{trans.data.performance[lang.value]}}</h3>
                  </div>
                  <div class="col-lg-6 col-md-6">
                    <dmx-chart id="accessorySales1" dmx-bind:data="product_sales_accessories_total.data.product_report_accessories_total" dataset-1:value="_['SUM(order_item_quantity)']" dataset-1:tooltip="trans.data.quantity[lang.value]" responsive="true" smooth="true" points="true" nogrid="true" colors="colors2" labels="product_name+' * '+_['SUM(order_item_quantity)']+' *'+_['sum(order_item_quantity * order_item_price)']" point-size="" type="bar" multicolor="true"></dmx-chart>
                    <h3 class="text-center">{{trans.data.accessories[lang.value]}}</h3>
                  </div>

                </div>
                <div class="row mt-2" id="salesReportGroup3">
                  <div class="col d-flex justify-content-xxl-end justify-content-xl-end justify-content-lg-end justify-content-md-end justify-content-sm-end justify-content-end">
                    <button id="btn15" class="btn btn-secondary text-body shadow-none" dmx-on:click="product_report_export.load({user: listOrdersFilters.waiterFilter.value, datefrom: listOrdersFilters.date1.value, dateto: listOrdersFilters.date2.value, service: listOrdersFilters.serviceSelect.value})">{{trans.data.download[lang.value]}}<i class="fas fa-download fa-sm" style="margin-left: 4px;"></i>
                    </button>
                  </div>
                  <div class="col-xxl mt-lg-2 col-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-1" style="">
                    <div class="table-responsive">
                      <table class="table table-hover table-sm">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>{{trans.data.product[lang.value]}}</th>
                            <th>{{trans.data.category[lang.value]}}</th>
                            <th>{{trans.data.volume[lang.value]}}</th>
                            <th>{{trans.data.total[lang.value]}}</th>
                          </tr>
                        </thead>
                        <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="product_report.data.product_report" id="tableRepeat4">
                          <tr>
                            <td dmx-text="product_id"></td>
                            <td dmx-text="product_name"></td>
                            <td dmx-text="product_category_name"></td>
                            <td dmx-text="Volume.toNumber().formatNumber(0, '.', ',')"></td>
                            <td dmx-text="Total.toNumber().formatNumber(0, '.', ',') "></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

              </div>
            </div>
            <div class="row mt-2" id="salesReportGroup1">
              <div class="col d-flex justify-content-xxl-end justify-content-xl-end justify-content-lg-end justify-content-md-end justify-content-sm-end justify-content-end">
                <button id="btn2" class="btn btn-warning" dmx-on:click="product_purchases_export.load({user: listOrdersFilters1.waiterFilter1.value, datefrom: listOrdersFilters1.date3.value, dateto: listOrdersFilters1.date4.value, service: listOrdersFilters.serviceSelect.value, department: listOrdersFilters1.departmentSelect1.value})">{{trans.data.download[lang.value]}}<i class="fas fa-download fa-lg" style="margin-left: 4px;"></i>
                </button>
              </div>
              <div class="col-xxl mt-lg-2 col-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-1" style="">
                <div class="table-responsive">
                  <table class="table table-hover table-sm">
                    <thead>
                      <tr>
                        <th>{{trans.data.product[lang.value]}}</th>
                        <th>{{trans.data.category[lang.value]}}</th>
                        <th>{{trans.data.volume[lang.value]}}</th>
                        <th>{{trans.data.total[lang.value]}}</th>
                      </tr>
                    </thead>
                    <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="product_purchases_received_all_products_report.data.product_purchases_received_all_products_report" id="tableRepeat3">

                      <tr>
                        <td dmx-text="product_name"></td>
                        <td dmx-text="product_category_name"></td>
                        <td dmx-text="Volume"></td>
                        <td dmx-text="Total"></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="navTabs1_3" role="tabpanel">
          </div>
        </div>

      </div>
  </main>

  <script src="bootstrap/5/js/bootstrap.bundle.min.js"></script>
  <script src="bootstrap/5/js/bootstrap.min.js"></script>
</body>

</html>