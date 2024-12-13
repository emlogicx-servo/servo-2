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
  <link rel="stylesheet" href="dmxAppConnect/dmxPreloader/dmxPreloader.css" />
  <script src="dmxAppConnect/dmxPreloader/dmxPreloader.js" defer></script>
  <script src="dmxAppConnect/dmxPdfCreator/dmxPdfCreator.js" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/pdfmake@0.2.9/build/pdfmake.min.js" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/pdfmake@0.2.9/build/vfs_fonts.min.js" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/html-to-pdfmake@2.5.2/browser.min.js" defer></script>
  <script src="dmxAppConnect/dmxBootstrap5Theme/dmxBootstrap5Theme.js" defer></script>
</head>

<body id="ServoReports" style="" is="dmx-app">
  <dmx-pdf-creator id="SalesReport" content="#SalesReportPDF">
    <dmx-pdf-style id="salesReportSmallText" font-size="12" name="pdfsmalltext"></dmx-pdf-style>
    <dmx-pdf-watermark id="pdfwatermark1" dmx-bind:text="companyInfo.data.query.company_name" opacity="0.1"></dmx-pdf-watermark>
  </dmx-pdf-creator>
  <dmx-preloader id="preloader1" spinner="pulse" bgcolor="rgba(53, 206, 255, 0.3)" color="#fff"></dmx-preloader>

  <dmx-value id="pageName" dmx-bind:value="trans.data.reports[lang.value]"></dmx-value>
  <dmx-download id="salesReportDownload" dmx-bind:filename="'ServoReport-Sales-From-'+listOrdersFilters.date1.value+'-To-'+listOrdersFilters.date2.value+'-'+listOrdersFilters.waiterFilter.selectedText+'-'+listOrdersFilters.serviceSelect.selectedText+'.csv'" url="reports/servoSalesReporting.csv"></dmx-download>
  <dmx-download id="download2" url="reports/servoPurchaseReport.csv" dmx-bind:filename="'servoPurchaseReport-'+listOrdersFilters1.date3.value+'-'+listOrdersFilters1.date4.value+'-'+listOrdersFilters1.waiterFilter1.selectedText+'-'+listOrdersFilters1.departmentSelect1.selectedText"></dmx-download>
  <dmx-serverconnect id="load_services" url="dmxConnect/api/servo_services/list_services.php"></dmx-serverconnect>
  <dmx-serverconnect id="load_departments" url="dmxConnect/api/servo_departments/list_departments.php"></dmx-serverconnect>
  <dmx-serverconnect id="load_shifts" url="dmxConnect/api/servo_shifts/list_shifts.php"></dmx-serverconnect>
  <dmx-serverconnect id="load_users_for_report" url="dmxConnect/api/servo_users/list_users_for_report.php"></dmx-serverconnect>
  <dmx-query-manager id="list_orders_report"></dmx-query-manager>
  <dmx-scheduler id="scheduler1" dmx-on:tick="total_sales_all_waiters_in_per_shift.load({current_shift: session_variables.data.current_shift, order_status: 'Paid'});total_sales_all_waiters_out_per_shift.load({current_shift: session_variables.data.current_shift, order_status: 'Ordered'});list_order_items_report.load({order_id: report.orderReport[0].order_id})" delay="30"></dmx-scheduler>
  <dmx-datetime id="var1"></dmx-datetime>
  <dmx-serverconnect id="list_order_items_report" url="dmxConnect/api/servo_reporting/list_order_items_report.php" dmx-param:order_id="report.orderReport[0].order_id"></dmx-serverconnect>
  <dmx-session-manager id="session_variables"></dmx-session-manager>
  <dmx-serverconnect id="load_tables" url="dmxConnect/api/servo_tables/list_tables.php"></dmx-serverconnect>

  <dmx-serverconnect id="product_report" url="dmxConnect/api/servo_reporting/product_report.php" dmx-param:user_id="" dmx-param:current_shift="session_variables.data.current_shift" dmx-param:sort="" dmx-param:dir="" dmx-param:datefrom="listOrdersFilters.date1.value" dmx-param:dateto="listOrdersFilters.date2.value" dmx-param:waiter="" dmx-param:order="" dmx-param:datestart="" dmx-param:datestop="" dmx-param:user="listOrdersFilters.waiterFilter.value" dmx-param:shift_id="listOrdersFilters.shiftSelect.value" dmx-param:service="listOrdersFilters.serviceSelect.value"></dmx-serverconnect>
  <dmx-serverconnect id="sales_report_export" url="dmxConnect/api/servo_reporting/sales_report_export.php" dmx-param:datefrom="listOrdersFilters.date1.value" dmx-param:dateto="listOrdersFilters.date2.value" dmx-param:user="listOrdersFilters.waiterFilter.value" dmx-param:service="listOrdersFilters.serviceSelect.value" dmx-on:error="notifies1.danger('Error!')" dmx-on:success="salesReportDownload.download()" noload="true"></dmx-serverconnect>
  <dmx-serverconnect id="report_sales_data" url="dmxConnect/api/servo_reporting/report_sales_data.php" dmx-param:shift_id="reportFilterSales.ShiftSelect.value" dmx-param:service_id="reportFilterSales.serviceSelect.value" dmx-param:user_id="reportFilterSales.userFilter.value" dmx-param:datefrom="reportFilterSales.date1_sales.value" dmx-param:dateto="reportFilterSales.date2_sales.value"></dmx-serverconnect>
  <div is="dmx-browser" id="browser1"></div>
  <dmx-notifications id="notifies1" timeout="100" position="bottom" extended-timeout="200"></dmx-notifications>
  <?php include 'header.php'; ?>

  <main>
    <div class="modal" is="dmx-bs5-modal" tabindex="-1" id="reportTableSales">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <div class="d-flex align-items-center w-auto">
              <h5 class="modal-title me-2">Sales</h5><button id="btn1" class="btn btn-secondary text-body shadow-none me-2" dmx-on:click="sales_report_export.load({user: listOrdersFilters.waiterFilter.value, datefrom: listOrdersFilters.date1.value, dateto: listOrdersFilters.date2.value, service: listOrdersFilters.serviceSelect.value})"><i class="fas fa-download" style="margin-right: 4px;"></i>CSV<br></button><button id="btn14" class="btn btn-secondary text-body shadow-none" dmx-on:click="SalesReport.open()"><i class="fas fa-print" style="margin-right: 4px;"></i>PDF<br></button>
            </div>

            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row mt-2" id="salesReportGroup">
              <div class="col-xxl mt-lg-2 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-1 col-auto" style="" is="dmx-pdf-content" id="SalesReportPDF" remove-extra-blanks="true">
                <img dmx-bind:src="'uploads/'+companyInfo.data.query.company_logo" width="150" height="auto">
                <div class="row row-cols-12 align-items-center justify-content-start g-0 pdfsmalltext">

                  <div class="col-auto" style="display: flex !important;">
                    <p class="me-2 pdfsmalltext">{{trans.data.salesReport[lang.value]}}</p>
                  </div>
                  <div class="col-auto" style="display: flex !important;">
                    <p dmx-text="reportFilterSales.date1_sales.value+' '" class="me-2 pdfsmalltext"></p>
                  </div>
                  <div class="col-auto" style="display: flex !important;">
                    <p dmx-text="reportFilterSales.date2_sales.value+' '" class="pdfsmalltext me-2"></p>
                  </div>
                  <div class="col-auto" style="display: flex !important;">
                    <p dmx-text="reportFilterSales.serviceSelect.selectedText+' '" class="pdfsmalltext fw-bold"></p>
                  </div>


                </div>
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
                    <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="report_sales_data.data.report_sales_products" id="tableRepeat2">
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
    <div class="modal" is="dmx-bs5-modal" tabindex="-1" id="reportTablePurchases">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <div class="d-flex align-items-center w-auto">
              <h5 class="modal-title me-2">{{trans.data.purchases[lang.value]}}</h5><button id="btn15" class="btn btn-secondary text-body shadow-none me-2" dmx-on:click="sales_report_export.load({user: listOrdersFilters.waiterFilter.value, datefrom: listOrdersFilters.date1.value, dateto: listOrdersFilters.date2.value, service: listOrdersFilters.serviceSelect.value})"><i class="fas fa-download" style="margin-right: 4px;"></i>CSV<br></button><button id="btn15" class="btn btn-secondary text-body shadow-none" dmx-on:click="SalesReport.open()"><i class="fas fa-print" style="margin-right: 4px;"></i>PDF<br></button>
            </div>

            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row mt-2" id="salesReportGroup3">
              <div class="col-xxl mt-lg-2 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-1 col-auto" style="" is="dmx-pdf-content" id="SalesReportPDF1" remove-extra-blanks="true">
                <img dmx-bind:src="'uploads/'+companyInfo.data.query.company_logo" width="150" height="auto">
                <div class="row row-cols-12 align-items-center justify-content-start g-0 pdfsmalltext">

                  <div class="col-auto" style="display: flex !important;">
                    <p class="me-2 pdfsmalltext">{{trans.data.salesReport[lang.value]}}</p>
                  </div>
                  <div class="col-auto" style="display: flex !important;">
                    <p dmx-text="reportFilterSales.date1_sales.value+' '" class="me-2 pdfsmalltext"></p>
                  </div>
                  <div class="col-auto" style="display: flex !important;">
                    <p dmx-text="reportFilterSales.date2_sales.value+' '" class="pdfsmalltext me-2"></p>
                  </div>
                  <div class="col-auto" style="display: flex !important;">
                    <p dmx-text="reportFilterSales.serviceSelect.selectedText+' '" class="pdfsmalltext fw-bold"></p>
                  </div>


                </div>
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
                    <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="report_sales_data.data.report_sales_products" id="tableRepeat3">
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
    <div is="dmx-bs5-theme" id="bs5theme1"></div>
    <div class="mt-auto">




      <div class="row servo-page-header rounded mt-2 ms-2 me-2 pt-2">

        <ul class="nav nav-tabs nav-fill" id="navTabs1_tabs" role="tablist">
          <li class="nav-item text-truncate">
            <a class="nav-link active text-break" id="navTabs1_1_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_1" role="tab" aria-controls="navTabs1_1" aria-selected="true"><i class="fas fa-cash-register" style="margin-right: 5px;"></i>{{trans.data.sales[lang.value]}}</a>
          </li>
          <li class="nav-item text-truncate">
            <a class="nav-link text-break" id="navTabs1_2_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_2" role="tab" aria-controls="navTabs1_2" aria-selected="false"><i class="fas fa-cart-arrow-down" style="margin-right: 5px;"></i>{{trans.data.purchasing[lang.value]}}</a>
          </li>
          <li class="nav-item text-truncate">
            <a class="nav-link text-break" id="navTabs1_3_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_3" role="tab" aria-controls="navTabs1_3" aria-selected="false"><i class="fas fa-coins" style="margin-right:5px;"></i>{{trans.data.finance[lang.value]}}</a>
          </li>
        </ul>
        <div class="tab-content" id="navTabs1_content">
          <div class="tab-pane fade show active" id="navTabs1_1" role="tabpanel">
            <div class="row row-cols-12 row-cols-lg-12 mt-2 align-items-center">

              <div class="col-auto mb-2 align-self-center">
                <button id="btn5" class="btn mt-1 me-1 w-auto btn-sm bg-light text-body" dmx-on:click="reportFilterSales.date2_sales.setValue(dateTime.datetime.addDays(1).addDays(-1));
                      reportFilterSales.date1_sales.setValue(dateTime.datetime.formatDate('yyyy-MM-ddT00:00'))">{{trans.data.today[lang.value]}}</button>
                <button id="btn8" class="btn mt-1 me-1 w-auto btn-sm bg-light text-body" dmx-on:click="reportFilterSales.date2_sales.setValue(dateTime.datetime.addDays(0).formatDate('yyyy-MM-ddT00:00'));
                      reportFilterSales.date1_sales.setValue(dateTime.datetime.addDays(-1).formatDate('yyyy-MM-ddT00:00'))">{{trans.data.yesterday[lang.value]}}</button>
                <button id="btn3" class="btn mt-1 me-1 w-auto btn-sm bg-light text-body" dmx-on:click="reportFilterSales.date1_sales.setValue(dateTime.datetime); 
                      reportFilterSales.date2_sales.setValue(getDay(dateTime.datetime))">{{trans.data.thisWeek[lang.value]}}</button>
                <button id="btn9" class="btn mt-1 me-1 w-auto btn-sm bg-light text-body" dmx-on:click="reportFilterSales.date2_sales.setValue(dateTime.datetime.addWeeks(-1).addDays(-1).formatDate('yyyy-MM-ddT00:00'));
                      reportFilterSales.date1_sales.setValue(dateTime.datetime.addWeeks(-2).addDays(-1).formatDate('yyyy-MM-ddT00:00'))">{{trans.data.lastWeek[lang.value]}}</button>
                <button id="btn4" class="btn mt-1 me-1 w-auto btn-sm bg-light text-body" dmx-on:click="reportFilterSales.date2_sales.setValue(dateTime.datetime.addMonths(1).formatDate('yyyy-MM-01').addDays(-1));
                      reportFilterSales.date1_sales.setValue(dateTime.datetime.formatDate('yyyy-MM-01T00:00'))">{{trans.data.thisMonth[lang.value]}}</button>
                <button id="btn6" class="btn mt-1 me-1 w-auto btn-sm bg-light text-body" dmx-on:click="reportFilterSales.date2_sales.setValue(dateTime.datetime.formatDate('yyyy-MM-01').addDays(-1));
                      reportFilterSales.date1_sales.setValue(dateTime.datetime.addMonths(-1).formatDate('yyyy-MM-01T00:00'))">{{trans.data.lastMonth[lang.value]}}</button>
                <button id="btn7" class="btn mt-1 me-1 w-auto btn-sm bg-light w-100 text-body" dmx-on:click="reportFilterSales.date2_sales.setValue(dateTime.datetime.formatDate('yyyy-MM-01').addDays(-1));
                      reportFilterSales.date1_sales.setValue(dateTime.datetime.addMonths(-3).formatDate('yyyy-MM-01T00:00'))">{{trans.data.lastThreeMonths[lang.value]}}</button>
                <button id="btn10" class="btn btn-sm text-body bg-light mt-1 me-4 ps-3 pe-3" dmx-on:click="reportFilterSales.toggle()">
                  <i class="fas fa-ellipsis-h"></i></button>
                <button id="btn11" class="btn" dmx-on:click="showSalesFilter.setValue('hide')" dmx-hide="(showSalesFilter.value == 'hide')">
                  <i class="fas fa-chevron-down"></i></button>
                <dmx-value id="showSalesFilter" dmx-bind:value="'hide'"></dmx-value><button id="btn12" class="btn text-white bg-info mt-1 ps-4 pe-4" data-bs-toggle="modal" target="" data-bs-target="#reportTableSales">
                  <i class="fas fa-table" style="margin-right: 5px;"></i> {{trans.data.report[lang.value]}}
                </button>
                <div class="collapse mt-1 pt-2 pb-3 ps-2 pe-2" id="reportFilterSales" is="dmx-bs5-collapse">
                  <main>
                    <div class="row " style="position: ;" id="salesFilter">
                      <div class="d-flex align-items-center mt-2 col-auto">
                        <i class="far fa-calendar-alt fa-sm" style="margin-right: 10px;"></i>
                        <input id="date1_sales" name="datefrom" type="datetime-local" class="form-control form-control-sm" dmx-bind:max="date2_sales.value">
                      </div>
                      <div class="col-auto d-flex align-items-center mt-2">
                        <i class="fas fa-calendar-alt fa-sm" style="margin-right: 10px;"></i>
                        <input id="date2_sales" name="dateto" utc="true" type="datetime-local" class="form-control form-control-sm" dmx-bind:min="date1_sales.value">
                      </div>
                      <div class="col-auto d-flex align-items-center mt-2">
                        <i class="far fa-user fa-sm" style="margin-right: 10px;"></i>
                        <select id="userFilter" class="form-select form-select-sm" dmx-bind:options="load_users_for_report.data.query_list_users" dmx-bind:value="'Select'" name="user" optiontext="user_username" optionvalue="user_id">
                          <option selected="" value="%">----</option>
                        </select>
                      </div>
                      <div class="col-auto d-flex align-items-center mt-2">
                        <i class="fas fa-store fa-sm" style="margin-right: 
                      10px;"></i>
                        <select id="serviceSelect" class="form-select form-select-sm" dmx-bind:options="load_services.data.query_list_services" optiontext="service_name" optionvalue="service_id" name="service" dmx-bind:value="'Select'">
                          <option selected="" value="%">----</option>
                        </select>
                      </div>
                      <div class="col-auto d-flex align-items-center mt-2 visually-hidden">
                        <i class="fas fa-stopwatch" style="margin-right: 
                      10px;"></i>
                        <select id="ShiftSelect" class="form-select form-select-sm" dmx-bind:options="load_shifts.data.query_list_shifts" optiontext="shift_id" optionvalue="shift_id" name="shiftSelect" dmx-bind:value="'Select'">
                          <option selected="" value="%">----</option>
                        </select>
                      </div>





                    </div>
                  </main>
                </div>
              </div>
            </div>

            <div class="row rounded shadow-none">
              <div class="scrollable col-12 rounded shadow-none">
                <div class="row align-items-stretch">
                  <div class="text-center rounded col bg-opacity-10 text-primary bg-primary mt-2 me-2 pt-3 pb-3 ps-4 pe-4">
                    <h5 class="text-start">
                      <i class="fas fa-coins"></i>
                    </h5>
                    <h3 dmx-text="report_sales_data.data.report_sales_data[0].TotalSales.toNumber().formatNumber('3','.',',').default(0)">
                    </h3>
                    <h5>{{trans.data.totalSales[lang.value]}}</h5>
                  </div>
                  <div class="text-center rounded col bg-opacity-10 text-danger bg-danger mt-2 me-2 pt-3 pb-3 ps-4 pe-4">
                    <h5 class="text-start">
                      <i class="fas fa-arrow-alt-circle-up"></i>
                    </h5>
                    <h3 dmx-text="((report_sales_data.data.report_sales_data[0].TotalOpenUnpaid.toNumber())-(report_sales_data.data.report_sales_data[0].TotalOpenPaid.toNumber())).formatNumber('3','.',',').default(0)">
                    </h3>
                    <h5>{{trans.data.receivable[lang.value]}}</h5>
                  </div>
                  <div class="text-center rounded col bg-opacity-10 text-success bg-success mt-2 me-2 pt-3 pb-3 ps-4 pe-4">
                    <h5 class="text-start">
                      <i class="fas fa-arrow-alt-circle-down"></i>
                    </h5>
                    <h3 dmx-text="report_sales_data.data.report_sales_data[0].TotalPaid.toNumber().formatNumber('3','.',',').default(0)">
                    </h3>
                    <h5>{{trans.data.totalPayments[lang.value]}}</h5>
                  </div>
                  <div class="text-center rounded col bg-dark bg-opacity-25 text-body mt-2 me-2 pt-3 pb-3 ps-4 pe-4">
                    <h5 class="text-start">
                      <i class="fas fa-exchange-alt"></i>
                    </h5>
                    <h3 dmx-text="report_sales_data.data.report_sales_data[0].TotalAdjustments.toNumber().formatNumber('3','.',',').default(0)">
                    </h3>
                    <h5>{{trans.data.adjustments[lang.value]}}</h5>
                  </div>
                </div>
                <div class="row mt-2 mb-2">
                  <div class="rounded bg-light scrollable-y col-12 col-md mt-2 me-2 pt-2 pb-2 ps-3 pe-2">

                    <h4 class="text-start">
                      <i class="far fa-chart-bar" style="margin-right: 5px;"></i>{{trans.data.sales[lang.value]}} | {{trans.data.products[lang.value]}}
                    </h4>
                    <dmx-chart id="chart1" point-size="" smooth="true" dataset-1:value="Volume" dataset-1:tooltip="" legend="top" stacked="true" type="bar" multicolor="true" dataset-2:value="Total" dataset-1:label="Sales Volume Total" dataset-2:label="Sales Total" labels="product_name+' - '+Total+' / '+Volume" dataset-1="" height="300" width="1000" dmx-bind:data="report_sales_data.data.report_sales_products" nogrid="true"></dmx-chart>


                  </div>
                  <div class="rounded bg-light scrollable-y col-12 col-md mt-2 me-2 pt-2 pb-2 ps-3 pe-2">

                    <h4 class="text-start">
                      <i class="far fa-chart-bar" style="margin-right: 5px;"></i>{{trans.data.sales[lang.value]}} | {{trans.data.categories[lang.value]}}
                    </h4>

                    <dmx-chart id="chart4" point-size="" smooth="true" dataset-1:value="Volume" dataset-1:tooltip="" legend="top" stacked="true" type="bar" multicolor="true" dataset-2:value="Total" dataset-1:label="Sales Volume Total" dataset-2:label="Sales Total" labels="product_name+' - '+Total+' / '+Volume" dataset-1="" height="300" width="1000" dmx-bind:data="report_sales_data.data.report_sales_categories" nogrid="true"></dmx-chart>


                  </div>
                </div>
                <div class="row justify-content-md-between justify-content-xxl-between g-0 row-cols-12 rounded shadow-none bg-opacity-10 mt-3 pt-2 pb-2 ps-2 pe-2" id="row2">

                  <div class="col-lg-4 align-self-center shadow-none col-auto">

                  </div>
                  <div class="col-12 col-lg-8">
                    <div class="row mt-md-2 gx-lg-0 gy-lg-0 bg-secondary rounded mt-1 ms-0 me-0" id="orders_table" style="">
                      <div class="mw-100 col-lg-11 col-md-11 col-11" is="dmx-background-video" id="report">








                      </div>
                    </div>
                  </div>




                </div>

                <div class="row mt-xxl-2 row-cols-12 pt-2 ps-0 pe-3">

                  <div class="offset-xxl-1 rounded bg-secondary y-scroll pt-lg-2 pb-lg-2 ps-lg-2 pe-lg-2 col-auto mt-1 ms-2 me-2 col-12 col-sm-auto col-md-auto col-md-5 col-lg-auto col-xl-auto col-xxl-auto">
                    <dmx-chart id="chart2" point-size="" smooth="true" dataset-1:value="Volume" dataset-1:tooltip="" legend="top" multicolor="true" colors="colors3" labels="product_category_name" cutout="" type="bar" dataset-2:label="Sales Total" dataset-1:label="Sales Volume Total" dataset-2:value="Total" stacked="true" width="1000" height="300" dmx-bind:data="sales_report.data.sales_report_categories"></dmx-chart>
                    <h3 class="text-center">{{trans.data.categories[lang.value]}}</h3>
                  </div>
                  <div class="y-scroll col-md-auto col-auto bg-primary bg-opacity-10 mt-1 rounded col-sm-auto col-12 col-md-6 col-lg-4 align-self-lg-start col-xl-auto col-xxl-auto">
                    <dmx-chart id="payment_methods" point-size="" smooth="true" dataset-1:value="TotalPayments" dataset-1:tooltip="" legend="top" multicolor="true" colors="colors3" cutout="" type="pie" dataset-2:label="Sales Total" dataset-1:label="Payment Methods" dataset-2:value="" stacked="true" labels="Method" width="" height="" responsive="true" dmx-bind:data="sales_report.data.sales_report_payments"></dmx-chart>
                    <h3 class="text-center">{{trans.data.payments[lang.value]}}</h3>
                  </div>

                </div>
                <div class="row mt-2" id="salesReportGroup2">
                  <div class="col d-flex justify-content-xxl-end justify-content-xl-end justify-content-lg-end justify-content-md-end justify-content-sm-end justify-content-end">
                    <button id="btn13" class="btn btn-secondary text-body shadow-none" dmx-on:click="sales_report_export.load({user: listOrdersFilters.waiterFilter.value, datefrom: listOrdersFilters.date1.value, dateto: listOrdersFilters.date2.value, service: listOrdersFilters.serviceSelect.value})">{{trans.data.download[lang.value]}}<i class="fas fa-download fa-sm" style="margin-left: 4px;"></i>
                    </button>
                  </div>
                  <div class="col-xxl mt-lg-2 col-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-1" style="">
                    <div class="table-responsive">
                      <table class="table table-hover table-sm">
                        <thead>
                          <tr>
                            <th>{{trans.data.product[lang.value]}}</th>
                            <th>{{trans.data.customer[lang.value]}}</th>
                            <th>{{trans.data.category[lang.value]}}</th>
                            <th class="text-end">{{trans.data.volume[lang.value]}}</th>
                            <th class="text-end">{{trans.data.total[lang.value]}}</th>
                          </tr>
                        </thead>
                        <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="sales_report.data.sales_report_export_table" id="tableRepeat6">
                          <tr>
                            <td dmx-text="product_name"></td>
                            <td dmx-text="customer_first_name+' '+customer_last_name"></td>
                            <td dmx-text="product_category_name"></td>
                            <td dmx-text="Volume.toNumber().formatNumber('0',',',',')" class="text-end"></td>
                            <td dmx-text="Total.toNumber().formatNumber('0', ',', ',')" class="text-end"></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

              </div>
            </div>







          </div>
          <div class="tab-pane fade show active" id="navTabs1_2" role="tabpanel">
            <div class="row row-cols-12 row-cols-lg-12 mt-2 align-items-center">

              <div class="col-auto mb-2 align-self-center">
                <button id="btn2" class="btn mt-1 me-1 w-auto btn-sm bg-light text-body" dmx-on:click="reportFilterSales.date2_purchases.setValue(dateTime.datetime.addDays(1).addDays(-1));
                      reportFilterPurchases.date1_purchases.setValue(dateTime.datetime.formatDate('yyyy-MM-ddT00:00'))">{{trans.data.today[lang.value]}}</button>
                <button id="btn2" class="btn mt-1 me-1 w-auto btn-sm bg-light text-body" dmx-on:click="reportFilterPurchases.date2_purchases.setValue(dateTime.datetime.addDays(0).formatDate('yyyy-MM-ddT00:00'));
                      reportFilterSales.date1_sales.setValue(dateTime.datetime.addDays(-1).formatDate('yyyy-MM-ddT00:00'))">{{trans.data.yesterday[lang.value]}}</button>
                <button id="btn2" class="btn mt-1 me-1 w-auto btn-sm bg-light text-body" dmx-on:click="reportFilterPurchases.date1_sales.setValue(dateTime.datetime); 
                      reportFilterPurchases.date2_purchases.setValue(getDay(dateTime.datetime))">{{trans.data.thisWeek[lang.value]}}</button>
                <button id="btn2" class="btn mt-1 me-1 w-auto btn-sm bg-light text-body" dmx-on:click="reportFilterPurchases.date2_purchases.setValue(dateTime.datetime.addWeeks(-1).addDays(-1).formatDate('yyyy-MM-ddT00:00'));
                      reportFilterPurchases.date1_purchases.setValue(dateTime.datetime.addWeeks(-2).addDays(-1).formatDate('yyyy-MM-ddT00:00'))">{{trans.data.lastWeek[lang.value]}}</button>
                <button id="btn2" class="btn mt-1 me-1 w-auto btn-sm bg-light text-body" dmx-on:click="reportFilterPurchases.date2_purchases.setValue(dateTime.datetime.addMonths(1).formatDate('yyyy-MM-01').addDays(-1));
                      reportFilterPurchases.date1_purchases.setValue(dateTime.datetime.formatDate('yyyy-MM-01T00:00'))">{{trans.data.thisMonth[lang.value]}}</button>
                <button id="btn2" class="btn mt-1 me-1 w-auto btn-sm bg-light text-body" dmx-on:click="reportFilterPurchases.date2_purchases.setValue(dateTime.datetime.formatDate('yyyy-MM-01').addDays(-1));
                      reportFilterPurchases.date1_purchases.setValue(dateTime.datetime.addMonths(-1).formatDate('yyyy-MM-01T00:00'))">{{trans.data.lastMonth[lang.value]}}</button>
                <button id="btn2" class="btn mt-1 me-1 w-auto btn-sm bg-light w-100 text-body" dmx-on:click="reportFilterPurchases.date2_purchases.setValue(dateTime.datetime.formatDate('yyyy-MM-01').addDays(-1));
                      reportFilterPurchases.date1_purchases.setValue(dateTime.datetime.addMonths(-3).formatDate('yyyy-MM-01T00:00'))">{{trans.data.lastThreeMonths[lang.value]}}</button>
                <button id="btn21" class="btn btn-sm text-body bg-light mt-1 me-4 ps-3 pe-3" dmx-on:click="reportFilterPurchases.toggle()">
                  <i class="fas fa-ellipsis-h"></i></button>
                <button id="btn22" class="btn" dmx-on:click="showSalesFilter.setValue('hide')" dmx-hide="(showSalesFilter.value == 'hide')">
                  <i class="fas fa-chevron-down"></i></button>
                <dmx-value id="showPurchasesFilter" dmx-bind:value="'hide'"></dmx-value><button id="btn23" class="btn text-white bg-info mt-1 ps-4 pe-4" data-bs-toggle="modal" target="" data-bs-target="#reportTablePurchases">
                  <i class="fas fa-table" style="margin-right: 5px;"></i> {{trans.data.report[lang.value]}}
                </button>
                <div class="collapse mt-1 pt-2 pb-3 ps-2 pe-2" id="reportFilterPurchases" is="dmx-bs5-collapse">
                  <main>
                    <div class="row " style="position: ;" id="purchasesFilter">
                      <div class="d-flex align-items-center mt-2 col-auto">
                        <i class="far fa-calendar-alt fa-sm" style="margin-right: 10px;"></i>
                        <input id="date1_purchases" name="datefrom" type="datetime-local" class="form-control form-control-sm" dmx-bind:max="date2_purchases.value">
                      </div>
                      <div class="col-auto d-flex align-items-center mt-2">
                        <i class="fas fa-calendar-alt fa-sm" style="margin-right: 10px;"></i>
                        <input id="date2_purchases" name="dateto" utc="true" type="datetime-local" class="form-control form-control-sm" dmx-bind:min="date1_purchases.value">
                      </div>
                      <div class="col-auto d-flex align-items-center mt-2">
                        <i class="far fa-user fa-sm" style="margin-right: 10px;"></i>
                        <select id="userFilter1" class="form-select form-select-sm" dmx-bind:options="load_users_for_report.data.query_list_users" dmx-bind:value="'Select'" name="user1" optiontext="user_username" optionvalue="user_id">
                          <option selected="" value="%">----</option>
                        </select>
                      </div>
                      <div class="col-auto d-flex align-items-center mt-2">
                        <i class="fas fa-store fa-sm" style="margin-right: 
                      10px;"></i>
                        <select id="serviceSelect1" class="form-select form-select-sm" dmx-bind:options="load_services.data.query_list_services" optiontext="service_name" optionvalue="service_id" name="service1" dmx-bind:value="'Select'">
                          <option selected="" value="%">----</option>
                        </select>
                      </div>
                      <div class="col-auto d-flex align-items-center mt-2 visually-hidden">
                        <i class="fas fa-stopwatch" style="margin-right: 
                      10px;"></i>
                        <select id="ShiftSelect1" class="form-select form-select-sm" dmx-bind:options="load_shifts.data.query_list_shifts" optiontext="shift_id" optionvalue="shift_id" name="shiftSelect1" dmx-bind:value="'Select'">
                          <option selected="" value="%">----</option>
                        </select>
                      </div>





                    </div>
                  </main>
                </div>
              </div>
            </div>

            <div class="row rounded shadow-none">
              <div class="scrollable col-12 rounded shadow-none">
                <div class="row align-items-stretch">
                  <div class="text-center rounded col bg-opacity-10 text-primary bg-primary mt-2 me-2 pt-3 pb-3 ps-4 pe-4">
                    <h5 class="text-start">
                      <i class="fas fa-coins"></i>
                    </h5>
                    <h3 dmx-text="report_sales_data.data.report_sales_data[0].TotalSales.toNumber().formatNumber('3','.',',').default(0)">
                    </h3>
                    <h5>{{trans.data.totalSales[lang.value]}}</h5>
                  </div>
                  <div class="text-center rounded col bg-opacity-10 text-danger bg-danger mt-2 me-2 pt-3 pb-3 ps-4 pe-4">
                    <h5 class="text-start">
                      <i class="fas fa-arrow-alt-circle-up"></i>
                    </h5>
                    <h3 dmx-text="((report_sales_data.data.report_sales_data[0].TotalOpenUnpaid.toNumber())-(report_sales_data.data.report_sales_data[0].TotalOpenPaid.toNumber())).formatNumber('3','.',',').default(0)">
                    </h3>
                    <h5>{{trans.data.receivable[lang.value]}}</h5>
                  </div>
                  <div class="text-center rounded col bg-opacity-10 text-success bg-success mt-2 me-2 pt-3 pb-3 ps-4 pe-4">
                    <h5 class="text-start">
                      <i class="fas fa-arrow-alt-circle-down"></i>
                    </h5>
                    <h3 dmx-text="report_sales_data.data.report_sales_data[0].TotalPaid.toNumber().formatNumber('3','.',',').default(0)">
                    </h3>
                    <h5>{{trans.data.totalPayments[lang.value]}}</h5>
                  </div>
                  <div class="text-center rounded col bg-dark bg-opacity-25 text-body mt-2 me-2 pt-3 pb-3 ps-4 pe-4">
                    <h5 class="text-start">
                      <i class="fas fa-exchange-alt"></i>
                    </h5>
                    <h3 dmx-text="report_sales_data.data.report_sales_data[0].TotalAdjustments.toNumber().formatNumber('3','.',',').default(0)">
                    </h3>
                    <h5>{{trans.data.adjustments[lang.value]}}</h5>
                  </div>
                </div>
                <div class="row mt-2 mb-2">
                  <div class="rounded bg-light scrollable-y col-12 col-md mt-2 me-2 pt-2 pb-2 ps-3 pe-2">

                    <h4 class="text-start">
                      <i class="far fa-chart-bar" style="margin-right: 5px;"></i>{{trans.data.sales[lang.value]}} | {{trans.data.products[lang.value]}}
                    </h4>
                    <dmx-chart id="chart3" point-size="" smooth="true" dataset-1:value="Volume" dataset-1:tooltip="" legend="top" stacked="true" type="bar" multicolor="true" dataset-2:value="Total" dataset-1:label="Sales Volume Total" dataset-2:label="Sales Total" labels="product_name+' - '+Total+' / '+Volume" dataset-1="" height="300" width="1000" dmx-bind:data="report_sales_data.data.report_sales_products" nogrid="true"></dmx-chart>


                  </div>
                  <div class="rounded bg-light scrollable-y col-12 col-md mt-2 me-2 pt-2 pb-2 ps-3 pe-2">

                    <h4 class="text-start">
                      <i class="far fa-chart-bar" style="margin-right: 5px;"></i>{{trans.data.sales[lang.value]}} | {{trans.data.categories[lang.value]}}
                    </h4>

                    <dmx-chart id="chart3" point-size="" smooth="true" dataset-1:value="Volume" dataset-1:tooltip="" legend="top" stacked="true" type="bar" multicolor="true" dataset-2:value="Total" dataset-1:label="Sales Volume Total" dataset-2:label="Sales Total" labels="product_name+' - '+Total+' / '+Volume" dataset-1="" height="300" width="1000" dmx-bind:data="report_sales_data.data.report_sales_categories" nogrid="true"></dmx-chart>


                  </div>
                </div>
                <div class="row justify-content-md-between justify-content-xxl-between g-0 row-cols-12 rounded shadow-none bg-opacity-10 mt-3 pt-2 pb-2 ps-2 pe-2" id="row1">

                  <div class="col-lg-4 align-self-center shadow-none col-auto">

                  </div>
                  <div class="col-12 col-lg-8">
                    <div class="row mt-md-2 gx-lg-0 gy-lg-0 bg-secondary rounded mt-1 ms-0 me-0" id="orders_table1" style="">
                      <div class="mw-100 col-lg-11 col-md-11 col-11" is="dmx-background-video" id="report1">








                      </div>
                    </div>
                  </div>




                </div>

                <div class="row mt-xxl-2 row-cols-12 pt-2 ps-0 pe-3">

                  <div class="offset-xxl-1 rounded bg-secondary y-scroll pt-lg-2 pb-lg-2 ps-lg-2 pe-lg-2 col-auto mt-1 ms-2 me-2 col-12 col-sm-auto col-md-auto col-md-5 col-lg-auto col-xl-auto col-xxl-auto">
                    <dmx-chart id="chart3" point-size="" smooth="true" dataset-1:value="Volume" dataset-1:tooltip="" legend="top" multicolor="true" colors="colors3" labels="product_category_name" cutout="" type="bar" dataset-2:label="Sales Total" dataset-1:label="Sales Volume Total" dataset-2:value="Total" stacked="true" width="1000" height="300" dmx-bind:data="sales_report.data.sales_report_categories"></dmx-chart>
                    <h3 class="text-center">{{trans.data.categories[lang.value]}}</h3>
                  </div>
                  <div class="y-scroll col-md-auto col-auto bg-primary bg-opacity-10 mt-1 rounded col-sm-auto col-12 col-md-6 col-lg-4 align-self-lg-start col-xl-auto col-xxl-auto">
                    <dmx-chart id="payment_methods1" point-size="" smooth="true" dataset-1:value="TotalPayments" dataset-1:tooltip="" legend="top" multicolor="true" colors="colors3" cutout="" type="pie" dataset-2:label="Sales Total" dataset-1:label="Payment Methods" dataset-2:value="" stacked="true" labels="Method" width="" height="" responsive="true" dmx-bind:data="sales_report.data.sales_report_payments"></dmx-chart>
                    <h3 class="text-center">{{trans.data.payments[lang.value]}}</h3>
                  </div>

                </div>
                <div class="row mt-2" id="salesReportGroup1">
                  <div class="col d-flex justify-content-xxl-end justify-content-xl-end justify-content-lg-end justify-content-md-end justify-content-sm-end justify-content-end">
                    <button id="btn2" class="btn btn-secondary text-body shadow-none" dmx-on:click="sales_report_export.load({user: listOrdersFilters.waiterFilter.value, datefrom: listOrdersFilters.date1.value, dateto: listOrdersFilters.date2.value, service: listOrdersFilters.serviceSelect.value})">{{trans.data.download[lang.value]}}<i class="fas fa-download fa-sm" style="margin-left: 4px;"></i>
                    </button>
                  </div>
                  <div class="col-xxl mt-lg-2 col-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-1" style="">
                    <div class="table-responsive">
                      <table class="table table-hover table-sm">
                        <thead>
                          <tr>
                            <th>{{trans.data.product[lang.value]}}</th>
                            <th>{{trans.data.customer[lang.value]}}</th>
                            <th>{{trans.data.category[lang.value]}}</th>
                            <th class="text-end">{{trans.data.volume[lang.value]}}</th>
                            <th class="text-end">{{trans.data.total[lang.value]}}</th>
                          </tr>
                        </thead>
                        <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="sales_report.data.sales_report_export_table" id="tableRepeat1">
                          <tr>
                            <td dmx-text="product_name"></td>
                            <td dmx-text="customer_first_name+' '+customer_last_name"></td>
                            <td dmx-text="product_category_name"></td>
                            <td dmx-text="Volume.toNumber().formatNumber('0',',',',')" class="text-end"></td>
                            <td dmx-text="Total.toNumber().formatNumber('0', ',', ',')" class="text-end"></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
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