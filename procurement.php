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
  <script src="js/moment.js/2/moment.min.js"></script>
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
  <script src="dmxAppConnect/dmxBackgroundVideo/dmxBackgroundVideo.js" defer=""></script>
  <link rel="stylesheet" href="fontawesome5/css/all.min.css" />
  <script src="dmxAppConnect/dmxBootstrap5PagingGenerator/dmxBootstrap5PagingGenerator.js" defer=""></script>
  <script src="dmxAppConnect/dmxCharts/Chart.min.js" defer=""></script>
  <script src="dmxAppConnect/dmxCharts/dmxCharts.js" defer=""></script>
  <script src="dmxAppConnect/dmxDataTraversal/dmxDataTraversal.js" defer=""></script>
  <link rel="stylesheet" href="bootstrap/5/servolight/bootstrap.min.css" />
  <link rel="stylesheet" href="bootstrap/5/servodark/bootstrap.min.css" />

  <link rel="stylesheet" href="bootstrap/5/css/bootstrap.min.css" />

  <link rel="stylesheet" href="dmxAppConnect/dmxPreloader/dmxPreloader.css" />
  <script src="dmxAppConnect/dmxPreloader/dmxPreloader.js" defer></script>
</head>

<body id="procurement" is="dmx-app" dmx-on:ready="preloader.hide();readItemModal.preloader1.hide()">
  <div style="z-index: 1000000000 !important;">
  </div>

  <dmx-value id="pageName" dmx-bind:value="trans.data.procurement[lang.value]"></dmx-value>
  <dmx-data-iterator id="iterator1"></dmx-data-iterator>

  <dmx-query-manager id="listPurchaseOrders"></dmx-query-manager>
  <dmx-query-manager id="listTransferOrdersIn"></dmx-query-manager>
  <dmx-query-manager id="listTransferOrdersOut"></dmx-query-manager>
  <dmx-query-manager id="productStockValuesState"></dmx-query-manager>
  <dmx-local-manager id="productCache"></dmx-local-manager>
  <dmx-serverconnect id="stock_data_per_department" url="dmxConnect/api/servo_stock/get_stock_values_2_sort_department.php" noload></dmx-serverconnect>
  <dmx-serverconnect id="list_value_updates_per_po" url="dmxConnect/api/servo_value_updates/list_value_updates_per_purchase_order.php" dmx-param:po_id="read_purchase_order.data.query.po_id"></dmx-serverconnect>
  <dmx-serverconnect id="procurement_information" url="dmxConnect/api/servo_reporting/purchasing_report_vendors.php"></dmx-serverconnect>
  <dmx-serverconnect id="procurement_information_products" url="dmxConnect/api/servo_reporting/purchasing_report_products.php"></dmx-serverconnect>
  <dmx-serverconnect id="productstockvalues" url="dmxConnect/api/servo_stock/get_stock_values_2.php" dmx-param:limit="productStockSortLimit.value" dmx-param:offset="query.stock_value_offset"></dmx-serverconnect>
  <dmx-serverconnect id="list_vendors" url="dmxConnect/api/servo_vendors/list_vendors.php"></dmx-serverconnect>
  <dmx-value id="TO" dmx-bind:value="O +AO"></dmx-value>
  <dmx-serverconnect id="list_ao_items" url="dmxConnect/api/servo_order_items/list_ao_items.php" dmx-param:order_id="session_variables.data.current_adjustment_order" dmx-on:start="readAOModal.preloader_ao.show()" dmx-on:done="readAOModal.preloader_ao.hide()"></dmx-serverconnect>
  <dmx-serverconnect id="list_adjustment_orders" url="dmxConnect/api/servo_orders/list_adjustment_orders.php"></dmx-serverconnect>
  <dmx-serverconnect id="read_adjustment_order" url="dmxConnect/api/servo_orders/read_order.php" dmx-param:order_id="session_variables.data.current_adjustment_order"></dmx-serverconnect>
  <dmx-serverconnect id="loadpaymentmethods" url="dmxConnect/api/servo_payment_methods/list_payment_methods.php"></dmx-serverconnect>


  <dmx-value id="lang" dmx-bind:value="browser1.language"></dmx-value>
  <dmx-json-datasource id="trans" is="dmx-serverconnect" url="assets/translation/translation.JSON"></dmx-json-datasource>

  <dmx-serverconnect id="query_po_items" url="dmxConnect/api/servo_purchase_order_items/list_po_items.php" dmx-param:po_id="session_variables.data.current_purchase_order" noload="" dmx-on:start="readItemModal.preloader1.show()" dmx-on:done="readItemModal.preloader1.hide()"></dmx-serverconnect>
  <dmx-scheduler id="scheduler1" dmx-on:tick="list_purchase_order_items_current.load({order_id: read_purchase_order.data.query.po_id});read_purchase_order.load({po_id: read_purchase_order.data.query.po_id})" delay="5"></dmx-scheduler>
  <dmx-datetime id="var1"></dmx-datetime>
  <dmx-serverconnect id="delete_purchase_order" url="dmxConnect/api/servo_purchase_orders/delete_purchase_order.php" dmx-param:po_id="tableRepeat5[0].po_id"></dmx-serverconnect>
  <dmx-serverconnect id="list_purchase_order_items_current" url="dmxConnect/api/servo_purchase_order_items/list_po_items.php" dmx-param:order_id="session_variables.data.current_order" noload=""></dmx-serverconnect>
  <dmx-serverconnect id="get_order_total" url="dmxConnect/api/servo_order_items/compute_order_total.php" dmx-param:order_id="session_variables.data.current_order"></dmx-serverconnect>
  <dmx-serverconnect id="list_purchase_order_items" url="dmxConnect/api/servo_purchase_order_items/list_po_items.php" dmx-param:order_id="read_item_order.data.query.order_id" dmx-param:po_id="read_purchase_order.data.query.po_id" dmx-on:start="preloader1.show();" dmx-on:done="preloader1.hide()"></dmx-serverconnect>
  <dmx-serverconnect id="load_products_old" url="dmxConnect/api/servo_products/list_products_paged.php" dmx-param:productfilter="AddProductsToOrderOffCanvas.searchProducts1.value" cache="productCache" ttl="3600" dmx-param:limit=""></dmx-serverconnect>
  <dmx-serverconnect id="load_products" url="dmxConnect/api/servo_products/list_products_all.php" dmx-param:category="" dmx-param:name="" dmx-param:search="readItemModal.AddProductsToOrderOffCanvas.searchProducts1.value" dmx-param:department_id="list_user_shift_info.data.query_list_user_shift[0].user_shift_department_id" dmx-param:service_id="list_user_shift_info.data.query_list_user_shift[0].servo_service_service_id" dmx-param:product_filter=""></dmx-serverconnect>
  <dmx-session-manager id="session_variables"></dmx-session-manager>
  <dmx-serverconnect id="load_tables" url="dmxConnect/api/servo_tables/list_tables.php"></dmx-serverconnect>
  <dmx-serverconnect id="load_departments" url="dmxConnect/api/servo_departments/list_departments.php"></dmx-serverconnect>

  <dmx-serverconnect id="load_product_categories" url="dmxConnect/api/servo_refered_fields_loading/load_product_categories.php" noload></dmx-serverconnect>
  <dmx-serverconnect id="read_purchase_order" url="dmxConnect/api/servo_purchase_orders/read_purchase_order.php" dmx-param:id="id" noload="" dmx-param:item_id="" dmx-param:branch_id="read_item_branch.data.queryReadBranch.branch_id" dmx-param:department_id="" dmx-param:order_id="tableRepeat2[0].order_id" dmx-param:po_id=""></dmx-serverconnect>
  <dmx-serverconnect id="delete_item_order" url="dmxConnect/api/servo_departments/delete_department.php"></dmx-serverconnect>
  <dmx-serverconnect id="list_purchase_orders" url="dmxConnect/api/servo_purchase_orders/list_purchase_orders_paged.php" dmx-param:user_id="" dmx-param:current_shift="session_variables.data.current_shift" dmx-param:offset="listPurchaseOrders.data.offset_po" dmx-param:limit="poSortLimit.value" dmx-param:po_filter="poFilter.value" dmx-param:sort="query.sort_po" dmx-param:dir="query.dir_po"></dmx-serverconnect>
  <dmx-serverconnect id="list_transfer_orders_in" url="dmxConnect/api/servo_purchase_orders/list_transfer_orders_in_paged.php" dmx-param:offset="listTransferOrders.data.offset_to" dmx-param:limit="toSortLimitIn.value" dmx-param:sort="list_transfer_orders.data.list_purchase_orders_paged.data[0].servo_departments_department_id" dmx-param:dir="" dmx-param:to_filter="toFilterIn.value" dmx-on:success="" dmx-param:department_source="list_user_info.data.query_list_user_info.servo_user_departments_department_id"></dmx-serverconnect>
  <dmx-serverconnect id="list_transfer_orders_out" url="dmxConnect/api/servo_purchase_orders/list_transfer_orders_out_paged.php" dmx-param:offset="listTransferOrders.data.offset_to_out" dmx-param:limit="toSortLimitOut.value" dmx-param:sort="list_transfer_orders.data.list_purchase_orders_paged.data[0].servo_departments_department_id" dmx-param:dir="" dmx-param:to_filter="toFilterOut.value" dmx-on:success="" dmx-param:department_source="list_user_info.data.query_list_user_info.servo_user_departments_department_id"></dmx-serverconnect>
  <dmx-serverconnect id="read_product_data" url="dmxConnect/api/servo_products/list_product_purchases.php" dmx-on:start="preloader.show()" dmx-on:done="preloader.hide()"></dmx-serverconnect>
  <div is="dmx-browser" id="browser1"></div>
  <dmx-notifications id="notifies1" timeout="100" position="bottom" extended-timeout="200"></dmx-notifications>
  <?php require 'header.php'; ?>
  <main class="bg-light rounded mt-2 ms-2 me-2 pt-2 pb-2 ps-2 pe-2" id="MainBody">
    <div>


      <div class="row">
        <div class="col style13 page-button d-flex justify-content-sm-end justify-content-end" id="pagebuttons">

          <button id="btn1" class="btn style12 fw-light add-button pill text-info bg-info bg-opacity-10" data-bs-toggle="modal" data-bs-target="#CreateOrderModal" style="float: right;"><i class="fas fa-plus"></i></button>
        </div>
      </div>
    </div>
    <ul class="nav nav-tabs nav-fill scrollable flex-nowrap align-items-end fw-bold" id="navTabs1_tabs" role="tablist">

      <li class="nav-item">
        <a class="nav-link active" id="navTabs1_2_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_2" role="tab" aria-controls="navTabs1_2" aria-selected="false" dmx-on:click="procurement_information.load();procurement_information_products.load()">

          {{trans.data.overview[lang.value]}}<i class="far fa-eye" style="margin-left: 5px;"></i></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="navTabs1_2_tab2" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_4" role="tab" aria-controls="navTabs1_2" aria-selected="false">
          {{trans.data.purchaseOrders[lang.value]}}<i class="fas fa-cart-arrow-down" style="margin-left: 5px;"></i></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="navTabs1_2_tab3" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_5" role="tab" aria-controls="navTabs1_2" aria-selected="false">
          {{trans.data.transferOrders[lang.value]}}<i class="fas fa-exchange-alt" style="margin-left: 5px;"></i></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="navTabs1_2_tab1" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_3" role="tab" aria-controls="navTabs1_2" aria-selected="false">
          {{trans.data.stockAdjustment[lang.value]}}<i class="far fa-minus-square" style="margin-left: 5px;"></i></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="navTabs1_1_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_1" role="tab" aria-controls="navTabs1_1" aria-selected="true" dmx-on:click="productstockvalues.load({})">{{trans.data.stock[lang.value]}}<i class="fas fa-boxes" style="margin-left: 5px;"></i></a>
      </li>
    </ul>
    <div class="tab-content" id="navTabs1_content">

      <div class="tab-pane fade active show" id="navTabs1_2" role="tabpanel">
        <div class="row mt-xxl-2 rounded rounded-2 border-secondary bg-light mt-2 mb-2 ms-0 me-0 pt-4" id="procurement_reports_" style="height: 450px; overflow: scroll;">
          <h3 class="text-body">{{trans.data.products[lang.value]}}</h3>
          <div class="col-sm col-md-6">

            <div class="row">
              <dmx-chart id="chart1" responsive="true" height="400" dmx-bind:data="procurement_information_products.data.purchasing_report_products_requested" labels="product_name" dataset-1:value="_['Total Requested']" point-size="" type="bar" multicolor="true" colors="colors1" dataset-1:label="Total" dataset-2:label="Volume" dataset-2:value="quantity" legend="top"></dmx-chart>
            </div>



            <div class="row justify-content-center">
              <div class="col">
                <h3 class="text-end" dmx-text="trans.data.Requested[lang.value]+' :'"></h3>
              </div>
              <div class="col">
                <h3 class="text-start" dmx-text="procurement_information.data.purchasing_report_vendors_requested.sum(`_['Total Requested']`).formatNumber('0',',',',')">{{trans.data.Requested[lang.value]}}</h3>
              </div>

            </div>
          </div>
          <div class="col-sm col-md-6">

            <div class="row">
              <dmx-chart id="chart3" responsive="true" height="400" dmx-bind:data="procurement_information_products.data.purchasing_report_products_approved" labels="product_name" dataset-1:value="_['Total Approved']" point-size="" type="bar" multicolor="true" colors="colors1" dataset-1:label="Total" dataset-2:label="Volume" dataset-2:value="quantity" legend="top"></dmx-chart>
            </div>



            <div class="row justify-content-center">
              <div class="col">
                <h3 dmx-text="trans.data.Approved[lang.value]+' :'" class="text-end"></h3>
              </div>
              <div class="col">
                <h3 class="text-start" dmx-text="procurement_information.data.purchasing_report_vendors_approved.sum(`_['Total Approved']`).formatNumber('0',',',',')">{{trans.data.Requested[lang.value]}}</h3>
              </div>

            </div>
          </div>
          <div class="col-sm col-md-6">





            <div class="row justify-content-center">
              <div class="col">
                <h3 dmx-text="trans.data.inStock[lang.value]+' :'" class="text-end"></h3>
              </div>
              <div class="col">
                <h3 class="text-start"></h3>
              </div>

            </div>
          </div>
        </div>
        <div class="row rounded ms-0 me-0 pt-3 bg-light ">
          <div class="col y-scroll">
            <dmx-chart id="chart5" height="400" dmx-bind:data="productstockvalues.data.getStockValues2" dataset-1:value="(TotalPurchased - TotalSold - TotalAdjusted)" point-size="" type="bar" multicolor="true" colors="colors1" dataset-1:label="Quantities" labels="product_name" dataset-1:tooltip="" width="1300"></dmx-chart>
          </div>

        </div>
        <div class="row mt-xxl-2 mt-2 ms-0 me-0 pt-4 rounded rounded-2 border-secondary" id="procurement_reports1" style="height: 450px; overflow: scroll;">
          <h3 class="text-light">{{trans.data.vendors[lang.value]}}</h3>
          <div class="col-sm col-md-6">

            <div class="row">
              <dmx-chart id="chart4" responsive="true" height="400" dmx-bind:data="procurement_information.data.purchasing_report_vendors_requested" labels="vendor_name" dataset-1:value="_['Total Requested']" point-size="" type="bar" multicolor="true" colors="colors1" dataset-1:label="Total"></dmx-chart>
            </div>



            <div class="row justify-content-center">
              <div class="col">
                <h3 class="text-end" dmx-text="trans.data.Requested[lang.value]+' :'"></h3>
              </div>
              <div class="col">
                <h3 class="text-start" dmx-text="procurement_information.data.purchasing_report_vendors_requested.sum(`_['Total Requested']`).formatNumber('0',',',',')">{{trans.data.Requested[lang.value]}}</h3>
              </div>

            </div>
          </div>
          <div class="col-sm col-md-6">

            <div class="row">
              <dmx-chart id="chart4a" responsive="true" height="400" dmx-bind:data="procurement_information.data.purchasing_report_vendors_approved" labels="vendor_name" dataset-1:value="_['Total Approved']" point-size="" type="bar" multicolor="true" colors="colors1" dataset-1:label="Total"></dmx-chart>
            </div>



            <div class="row justify-content-center">
              <div class="col">
                <h3 dmx-text="trans.data.Approved[lang.value]+' :'" class="text-end"></h3>
              </div>
              <div class="col">
                <h3 class="text-start" dmx-text="procurement_information.data.purchasing_report_vendors_approved.sum(`_['Total Approved']`).formatNumber('0',',',',')">{{trans.data.Requested[lang.value]}}</h3>
              </div>

            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="navTabs1_4" role="tabpanel">
        <div class="row justify-content-sm-between justify-content-md-between justify-content-lg-between justify-content-xl-between justify-content-xxl-between justify-content-between sorter bg-secondary rounded mt-2 mb-2 ms-auto me-auto">
          <div class="d-flex col-auto flex-wrap col-sm-auto col-md-auto col-lg-auto col-xxl-auto col-xl-auto align-items-baseline"><input id="poFilter" name="poFilter" type="text" class="form-control search mb-2 me-2" placeholder="ID"><button id="btn299" class="btn align-self-lg-start btn-outline-secondary text-primary bg-opacity-10 me-2 align-self-baseline bg-primary" dmx-on:click="poFilter.setValue(NULL)">
              <i class="fas fa-backspace fa-sm"></i>
            </button>
            <ul class="pagination me-2 bg-opacity-10 rounded d-flex flex-wrap bg-primary" dmx-populate="list_purchase_orders.data.list_purchase_orders_paged" dmx-state="listPurchaseOrders" dmx-offset="offset_po" dmx-generator="bs5paging">
              <li class="page-item" dmx-class:disabled="list_purchase_orders.data.list_purchase_orders_paged.page.current == 1" aria-label="First">
                <a href="javascript:void(0)" class="page-link" dmx-on:click="listPurchaseOrders.set('offset_po',list_purchase_orders.data.list_purchase_orders_paged.page.offset.first)"><span aria-hidden="true">&lsaquo;&lsaquo;</span></a>
              </li>
              <li class="page-item" dmx-class:disabled="list_purchase_orders.data.list_purchase_orders_paged.page.current == 1" aria-label="Previous">
                <a href="javascript:void(0)" class="page-link" dmx-on:click="listPurchaseOrders.set('offset_po',list_purchase_orders.data.list_purchase_orders_paged.page.offset.prev)"><span aria-hidden="true">&lsaquo;</span></a>
              </li>
              <li class="page-item" dmx-class:active="title == list_purchase_orders.data.list_purchase_orders_paged.page.current" dmx-class:disabled="!active" dmx-repeat="list_purchase_orders.data.list_purchase_orders_paged.getServerConnectPagination(2,1,'...')">
                <a href="javascript:void(0)" class="page-link text-body" dmx-on:click="listPurchaseOrders.set('offset_po',(page-1)*list_purchase_orders.data.list_purchase_orders_paged.limit)">{{title}}</a>
              </li>
              <li class="page-item" dmx-class:disabled="list_purchase_orders.data.list_purchase_orders_paged.page.current ==  list_purchase_orders.data.list_purchase_orders_paged.page.total" aria-label="Next">
                <a href="javascript:void(0)" class="page-link" dmx-on:click="listPurchaseOrders.set('offset_po',list_purchase_orders.data.list_purchase_orders_paged.page.offset.next)"><span aria-hidden="true">&rsaquo;</span></a>
              </li>
              <li class="page-item" dmx-class:disabled="list_purchase_orders.data.list_purchase_orders_paged.page.current ==  list_purchase_orders.data.list_purchase_orders_paged.page.total" aria-label="Last">
                <a href="javascript:void(0)" class="page-link" dmx-on:click="listPurchaseOrders.set('offset_po',list_purchase_orders.data.list_purchase_orders_paged.page.offset.last)"><span aria-hidden="true">&rsaquo;&rsaquo;</span></a>
              </li>
            </ul><select id="poSortLimit" class="form-select" name="po_sort_limit" style="width: 150px !important">
              <option value="5">5</option>
              <option selected="" value="25">25</option>
              <option value="50">50</option>
              <option value="100">100</option>
              <option value="'250">250</option>
              <option value="500">500</option>
            </select>
          </div>


        </div>
        <div class="row mt-1" id="orders_table1" style="height: 450px; overflow: scroll;">
          <div class="col bg-secondary rounded ms-3 me-3">


            <div class="table-responsive">
              <table class="table table-hover table-sm table-borderless">
                <thead>
                  <tr>
                    <th class="sorting" dmx-on:click="listPurchaseOrders.set('sort_po','po_id');listPurchaseOrders.set('dir_po',listPurchaseOrders.data.dir_po == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="listPurchaseOrders.data.sort_po=='po_id' && listPurchaseOrders.data.dir_po == 'asc'" dmx-class:sorting_desc="listPurchaseOrders.data.sort_po=='po_id' && listPurchaseOrders.data.dir_po == 'desc'">#</th>
                    <th class="sorting" dmx-on:click="listPurchaseOrders.set('sort_po','user_username');listPurchaseOrders.set('dir_po',listPurchaseOrders.data.dir_po == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="listPurchaseOrders.data.sort_po=='user_username' && listPurchaseOrders.data.dir_po == 'asc'" dmx-class:sorting_desc="listPurchaseOrders.data.sort_po=='user_username' && listPurchaseOrders.data.dir_po == 'desc'">{{trans.data.attention[lang.value]}}</th>
                    <th class="sorting" dmx-on:click="listPurchaseOrders.set('sort_po','time_ordered');listPurchaseOrders.set('dir_po',listPurchaseOrders.data.dir_po == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="listPurchaseOrders.data.sort_po=='time_ordered' && listPurchaseOrders.data.dir_po == 'asc'" dmx-class:sorting_desc="listPurchaseOrders.data.sort_po=='time_ordered' && listPurchaseOrders.data.dir_po == 'desc'">{{trans.data.timeOrdered[lang.value]}}</th>
                    <th class="sorting" dmx-on:click="listPurchaseOrders.set('sort_po','department_name');listPurchaseOrders.set('dir_po',listPurchaseOrders.data.dir_po == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="listPurchaseOrders.data.sort_po=='department_name' && listPurchaseOrders.data.dir_po == 'asc'" dmx-class:sorting_desc="listPurchaseOrders.data.sort_po=='department_name' && listPurchaseOrders.data.dir_po == 'desc'">{{trans.data.department[lang.value]}}</th>
                    <th class="sorting" dmx-on:click="listPurchaseOrders.set('sort_po','vendor_name');listPurchaseOrders.set('dir_po',listPurchaseOrders.data.dir_po == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="listPurchaseOrders.data.sort_po=='vendor_name' && listPurchaseOrders.data.dir_po == 'asc'" dmx-class:sorting_desc="listPurchaseOrders.data.sort_po=='vendor_name' && listPurchaseOrders.data.dir_po == 'desc'">{{trans.data.vendor[lang.value]}}</th>
                    <th class="sorting text-center" dmx-on:click="listPurchaseOrders.set('sort_po','po_status');listPurchaseOrders.set('dir_po',listPurchaseOrders.data.dir_po == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="listPurchaseOrders.data.sort_po=='po_status' && listPurchaseOrders.data.dir_po == 'asc'" dmx-class:sorting_desc="listPurchaseOrders.data.sort_po=='po_status' && listPurchaseOrders.data.dir_po == 'desc'">{{trans.data.status[lang.value]}}</th>
                    <th class="sorting" dmx-on:click="listPurchaseOrders.set('sort_po','null');listPurchaseOrders.set('dir_po',listPurchaseOrders.data.dir_po == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="listPurchaseOrders.data.sort_po=='null' && listPurchaseOrders.data.dir_po == 'asc'" dmx-class:sorting_desc="listPurchaseOrders.data.sort_po=='null' && listPurchaseOrders.data.dir_po == 'desc'"></th>
                  </tr>
                </thead>
                <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_purchase_orders.data.list_purchase_orders_paged.data" id="tableRepeat5" dmx-state="listPurchaseOrders" dmx-sort="sort_po" dmx-order="dir_po" class="scrollable">
                  <tr>
                    <td dmx-text="po_id"></td>
                    <td dmx-text="user_username"></td>
                    <td dmx-text="time_ordered"></td>
                    <td dmx-text="department_name"></td>
                    <td dmx-text="vendor_name"></td>
                    <td>
                      <h6 dmx-text="trans.data.getValueOrKey(po_status)[lang.value]" class="text-center pt-1 pb-1 ps-2 pe-2 rounded bg-light fw-bold" dmx-class:text-success="(po_status=='Received')" dmx-class:text-danger="(po_status=='Requested')" dmx-class:text-warning="(po_status=='Approved')">Fancy display heading</h6>
                    </td>
                    <td class="text-center"><button id="btn16" class="btn open" data-bs-target="#readItemModal" dmx-on:click="readItemModal.show();session_variables.set('current_purchase_order',po_id);read_purchase_order.load({po_id: po_id});query_po_items.load({po_id: po_id})" dmx-bind:value="list_purchase_orders.data.query[0].po_id" data-bs-toggle="modal"><i class="far fa-edit"><br></i></button></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="navTabs1_5" role="tabpanel">
        <div class="row mt-2">
          <div class="col d-flex"><button id="transfer_in" class="btn align-self-lg-start btn-sm ms-xxl-1 ms-1 btn-success text-white" dmx-on:click="transferOrderDirection.setValue('In')">
              <i class="fas fa-arrow-down fa-lg"></i>
            </button>
            <button id="transfer_in1" class="btn align-self-lg-start btn-sm ms-xxl-1 ms-1 btn-danger text-white" dmx-on:click="transferOrderDirection.setValue('Out')">
              <i class="fas fa-arrow-up fa-lg"></i>
            </button><input id="transferOrderDirection" name="transfer_direction" type="text" class="form-control visually-hidden" dmx-bind:value="'In'">
            <h3 dmx-show="(transferOrderDirection.value == 'In')" class="ms-2">{{trans.data.incoming[lang.value]}}</h3>
            <h3 dmx-show="(transferOrderDirection.value == 'Out')" class="ms-2">{{trans.data.outgoing[lang.value]}}</h3>
          </div>
        </div>
        <div class="row" id="transferOrdersIn" dmx-show="(transferOrderDirection.value == 'In')">
          <div class="col">
            <div class="row justify-content-sm-between justify-content-md-between justify-content-lg-between justify-content-xl-between justify-content-xxl-between justify-content-between sorter mt-2 mb-2 ms-0 me-0 bg-secondary rounded">
              <div class="col-auto col-9 col-sm-9 col-lg-3 d-flex col-xxl align-items-baseline">

                <input id="toFilterIn" name="toFilterIn" type="text" class="form-control search form-control-sm mb-2 me-2" placeholder="ID"><button id="btn26" class="btn align-self-lg-start btn-outline-secondary btn-sm ms-xxl-1 bg-info text-white me-2" dmx-on:click="poFilter.setValue(NULL)">
                  <i class="fas fa-backspace"></i>





                </button>
                <ul class="pagination me-2 rounded bg-dark bg-opacity-10 flex-wrap" dmx-populate="list_transfer_orders_in.data.list_purchase_orders_paged" dmx-generator="bs5paging">
                  <li class="page-item" dmx-class:disabled="list_transfer_orders_in.data.list_purchase_orders_paged.page.current == 1" aria-label="First">
                    <a href="javascript:void(0)" class="page-link" dmx-on:click="list_transfer_orders_in.load({offset: list_transfer_orders_in.data.list_purchase_orders_paged.page.offset.first})"><span aria-hidden="true">&lsaquo;&lsaquo;</span></a>
                  </li>
                  <li class="page-item" dmx-class:disabled="list_transfer_orders_in.data.list_purchase_orders_paged.page.current == 1" aria-label="Previous">
                    <a href="javascript:void(0)" class="page-link" dmx-on:click="list_transfer_orders_in.load({offset: list_transfer_orders_in.data.list_purchase_orders_paged.page.offset.prev})"><span aria-hidden="true">&lsaquo;</span></a>
                  </li>
                  <li class="page-item" dmx-class:active="title == list_transfer_orders_in.data.list_purchase_orders_paged.page.current" dmx-class:disabled="!active" dmx-repeat="list_transfer_orders_in.data.list_purchase_orders_paged.getServerConnectPagination(2,1,'...')">
                    <a href="javascript:void(0)" class="page-link" dmx-on:click="list_transfer_orders_in.load({offset: (page-1)*list_transfer_orders_in.data.list_purchase_orders_paged.limit})">{{title}}</a>
                  </li>
                  <li class="page-item" dmx-class:disabled="list_transfer_orders_in.data.list_purchase_orders_paged.page.current ==  list_transfer_orders_in.data.list_purchase_orders_paged.page.total" aria-label="Next">
                    <a href="javascript:void(0)" class="page-link" dmx-on:click="list_transfer_orders_in.load({offset: list_transfer_orders_in.data.list_purchase_orders_paged.page.offset.next})"><span aria-hidden="true">&rsaquo;</span></a>
                  </li>
                  <li class="page-item" dmx-class:disabled="list_transfer_orders_in.data.list_purchase_orders_paged.page.current ==  list_transfer_orders_in.data.list_purchase_orders_paged.page.total" aria-label="Last">
                    <a href="javascript:void(0)" class="page-link" dmx-on:click="list_transfer_orders_in.load({offset: list_transfer_orders_in.data.list_purchase_orders_paged.page.offset.last})"><span aria-hidden="true">&rsaquo;&rsaquo;</span></a>
                  </li>
                </ul><select id="toSortLimitIn" class="form-select" name="to_sort_limit_in" style="width: 150px !important" dmx-on:updated="list_transfer_orders.load({limit: value, to_filter: toFilter.value, to_destination: transferDirection.value});listTransferOrders.set('offset_to',0)">
                  <option value="5">5</option>
                  <option selected="" value="25">25</option>
                  <option value="50">50</option>
                  <option value="100">100</option>
                  <option value="'250">250</option>
                  <option value="500">500</option>
                </select>
              </div>


            </div>
            <div class="row mt-1" id="transfer_orders_table2" style="height: 450px; overflow: scroll;">
              <div class="col">


                <div class="table-responsive bg-secondary">
                  <table class="table table-hover table-sm table-borderless">
                    <thead>
                      <tr>
                        <th class="sorting" dmx-on:click="listPurchaseOrders.set('sort_po','po_id');listPurchaseOrders.set('dir_po',listPurchaseOrders.data.dir_po == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="listPurchaseOrders.data.sort_po=='po_id' &amp;&amp; listPurchaseOrders.data.dir_po == 'asc'" dmx-class:sorting_desc="listPurchaseOrders.data.sort_po=='po_id' &amp;&amp; listPurchaseOrders.data.dir_po == 'desc'">#</th>
                        <th class="sorting" dmx-on:click="listPurchaseOrders.set('sort_po','user_username');listPurchaseOrders.set('dir_po',listPurchaseOrders.data.dir_po == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="listPurchaseOrders.data.sort_po=='user_username' &amp;&amp; listPurchaseOrders.data.dir_po == 'asc'" dmx-class:sorting_desc="listPurchaseOrders.data.sort_po=='user_username' &amp;&amp; listPurchaseOrders.data.dir_po == 'desc'">{{trans.data.attention[lang.value]}}</th>
                        <th class="sorting" dmx-on:click="listPurchaseOrders.set('sort_po','time_ordered');listPurchaseOrders.set('dir_po',listPurchaseOrders.data.dir_po == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="listPurchaseOrders.data.sort_po=='time_ordered' &amp;&amp; listPurchaseOrders.data.dir_po == 'asc'" dmx-class:sorting_desc="listPurchaseOrders.data.sort_po=='time_ordered' &amp;&amp; listPurchaseOrders.data.dir_po == 'desc'">{{trans.data.timeOrdered[lang.value]}}</th>
                        <th class="sorting" dmx-on:click="listPurchaseOrders.set('sort_po','department_name');listPurchaseOrders.set('dir_po',listPurchaseOrders.data.dir_po == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="listPurchaseOrders.data.sort_po=='department_name' &amp;&amp; listPurchaseOrders.data.dir_po == 'asc'" dmx-class:sorting_desc="listPurchaseOrders.data.sort_po=='department_name' &amp;&amp; listPurchaseOrders.data.dir_po == 'desc'">{{trans.data.destination[lang.value]}}</th>
                        <th class="sorting" dmx-on:click="listPurchaseOrders.set('sort_po','vendor_name');listPurchaseOrders.set('dir_po',listPurchaseOrders.data.dir_po == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="listPurchaseOrders.data.sort_po=='vendor_name' &amp;&amp; listPurchaseOrders.data.dir_po == 'asc'" dmx-class:sorting_desc="listPurchaseOrders.data.sort_po=='vendor_name' &amp;&amp; listPurchaseOrders.data.dir_po == 'desc'">{{trans.data.Source[lang.value]}}</th>
                        <th class="sorting text-center" dmx-on:click="listPurchaseOrders.set('sort_po','po_status');listPurchaseOrders.set('dir_po',listPurchaseOrders.data.dir_po == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="listPurchaseOrders.data.sort_po=='po_status' &amp;&amp; listPurchaseOrders.data.dir_po == 'asc'" dmx-class:sorting_desc="listPurchaseOrders.data.sort_po=='po_status' &amp;&amp; listPurchaseOrders.data.dir_po == 'desc'">{{trans.data.status[lang.value]}}</th>
                        <th class="sorting" dmx-on:click="listPurchaseOrders.set('sort_po','null');listPurchaseOrders.set('dir_po',listPurchaseOrders.data.dir_po == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="listPurchaseOrders.data.sort_po=='null' &amp;&amp; listPurchaseOrders.data.dir_po == 'asc'" dmx-class:sorting_desc="listPurchaseOrders.data.sort_po=='null' &amp;&amp; listPurchaseOrders.data.dir_po == 'desc'"></th>
                      </tr>
                    </thead>
                    <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_transfer_orders_in.data.list_purchase_orders_paged.data" id="list_tos_in" dmx-state="listPurchaseOrders" dmx-sort="sort_po" dmx-order="dir_po">
                      <tr>
                        <td dmx-text="po_id"></td>
                        <td dmx-text="user_username"></td>
                        <td dmx-text="time_ordered"></td>
                        <td dmx-text="department_name"></td>
                        <td dmx-text="source_department_name"></td>
                        <td>
                          <h6 dmx-text="trans.data.getValueOrKey(po_status)[lang.value]" class="text-center pt-1 pb-1 ps-2 pe-2" dmx-class:red-state="(po_status=='Requested')" dmx-class:green-state="(po_status=='Received')" dmx-class:yellow-state="(po_status=='Approved')">Fancy display heading</h6>
                        </td>
                        <td>
                          <button id="btn22" class="btn open" data-bs-target="#readItemModal" dmx-on:click="readItemModal.show();session_variables.set('current_purchase_order',po_id);read_purchase_order.load({po_id: po_id});list_purchase_order_items_current.load({po_id: po_id})" dmx-bind:value="list_purchase_orders.data.query[0].po_id" data-bs-toggle="modal"><i class="far fa-edit"><br></i></button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row" id="transferOrdersOut" dmx-show="(transferOrderDirection.value == 'Out')">
          <div class="col">
            <div class="row justify-content-sm-between justify-content-md-between justify-content-lg-between justify-content-xl-between justify-content-xxl-between justify-content-between sorter mt-2 mb-2 ms-0 me-0 bg-secondary rounded">
              <div class="d-flex align-items-baseline col-auto col-sm-auto col-md-auto col-lg-auto col-xl-auto col-xxl-auto">

                <input id="toFilterOut" name="toFilterOut" type="text" class="form-control search form-control-sm mb-2 me-2" placeholder="ID"><button id="btn23" class="btn align-self-lg-start btn-sm ms-xxl-1 bg-info text-white me-2" dmx-on:click="poFilter.setValue(NULL)">
                  <i class="fas fa-backspace"></i>





                </button>
                <ul class="pagination me-2 rounded bg-dark bg-opacity-10 flex-wrap" dmx-populate="list_transfer_orders_out.data.list_purchase_orders_paged" dmx-generator="bs5paging">
                  <li class="page-item" dmx-class:disabled="list_transfer_orders_out.data.list_purchase_orders_paged.page.current == 1" aria-label="First">
                    <a href="javascript:void(0)" class="page-link" dmx-on:click="list_transfer_orders_out.load({offset: list_transfer_orders_out.data.list_purchase_orders_paged.page.offset.first})"><span aria-hidden="true">&lsaquo;&lsaquo;</span></a>
                  </li>
                  <li class="page-item" dmx-class:disabled="list_transfer_orders_out.data.list_purchase_orders_paged.page.current == 1" aria-label="Previous">
                    <a href="javascript:void(0)" class="page-link" dmx-on:click="list_transfer_orders_out.load({offset: list_transfer_orders_out.data.list_purchase_orders_paged.page.offset.prev})"><span aria-hidden="true">&lsaquo;</span></a>
                  </li>
                  <li class="page-item" dmx-class:active="title == list_transfer_orders_out.data.list_purchase_orders_paged.page.current" dmx-class:disabled="!active" dmx-repeat="list_transfer_orders_out.data.list_purchase_orders_paged.getServerConnectPagination(2,1,'...')">
                    <a href="javascript:void(0)" class="page-link" dmx-on:click="list_transfer_orders_out.load({offset: (page-1)*list_transfer_orders_out.data.list_purchase_orders_paged.limit})">{{title}}</a>
                  </li>
                  <li class="page-item" dmx-class:disabled="list_transfer_orders_out.data.list_purchase_orders_paged.page.current ==  list_transfer_orders_out.data.list_purchase_orders_paged.page.total" aria-label="Next">
                    <a href="javascript:void(0)" class="page-link" dmx-on:click="list_transfer_orders_out.load({offset: list_transfer_orders_out.data.list_purchase_orders_paged.page.offset.next})"><span aria-hidden="true">&rsaquo;</span></a>
                  </li>
                  <li class="page-item" dmx-class:disabled="list_transfer_orders_out.data.list_purchase_orders_paged.page.current ==  list_transfer_orders_out.data.list_purchase_orders_paged.page.total" aria-label="Last">
                    <a href="javascript:void(0)" class="page-link" dmx-on:click="list_transfer_orders_out.load({offset: list_transfer_orders_out.data.list_purchase_orders_paged.page.offset.last})"><span aria-hidden="true">&rsaquo;&rsaquo;</span></a>
                  </li>
                </ul><select id="toSortLimitOut" class="form-select" name="to_sort_limit1_out" style="width: 150px !important" dmx-on:updated="list_transfer_orders.load({limit: value, to_filter: toFilter.value, to_destination: transferDirection.value});listTransferOrders.set('offset_to',0)">
                  <option value="5">5</option>
                  <option selected="" value="25">25</option>
                  <option value="50">50</option>
                  <option value="100">100</option>
                  <option value="'250">250</option>
                  <option value="500">500</option>
                </select>
              </div>


            </div>
            <div class="row mt-1" id="transfer_orders_table1" style="height: 450px; overflow: scroll;">
              <div class="col bg-secondary rounded">


                <div class="table-responsive">
                  <table class="table table-hover table-sm table-borderless">
                    <thead>
                      <tr>
                        <th class="sorting" dmx-on:click="listPurchaseOrders.set('sort_po','po_id');listPurchaseOrders.set('dir_po',listPurchaseOrders.data.dir_po == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="listPurchaseOrders.data.sort_po=='po_id' &amp;&amp; listPurchaseOrders.data.dir_po == 'asc'" dmx-class:sorting_desc="listPurchaseOrders.data.sort_po=='po_id' &amp;&amp; listPurchaseOrders.data.dir_po == 'desc'">#</th>
                        <th class="sorting" dmx-on:click="listPurchaseOrders.set('sort_po','user_username');listPurchaseOrders.set('dir_po',listPurchaseOrders.data.dir_po == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="listPurchaseOrders.data.sort_po=='user_username' &amp;&amp; listPurchaseOrders.data.dir_po == 'asc'" dmx-class:sorting_desc="listPurchaseOrders.data.sort_po=='user_username' &amp;&amp; listPurchaseOrders.data.dir_po == 'desc'">{{trans.data.attention[lang.value]}}</th>
                        <th class="sorting" dmx-on:click="listPurchaseOrders.set('sort_po','time_ordered');listPurchaseOrders.set('dir_po',listPurchaseOrders.data.dir_po == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="listPurchaseOrders.data.sort_po=='time_ordered' &amp;&amp; listPurchaseOrders.data.dir_po == 'asc'" dmx-class:sorting_desc="listPurchaseOrders.data.sort_po=='time_ordered' &amp;&amp; listPurchaseOrders.data.dir_po == 'desc'">{{trans.data.timeOrdered[lang.value]}}</th>
                        <th class="sorting" dmx-on:click="listPurchaseOrders.set('sort_po','department_name');listPurchaseOrders.set('dir_po',listPurchaseOrders.data.dir_po == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="listPurchaseOrders.data.sort_po=='department_name' &amp;&amp; listPurchaseOrders.data.dir_po == 'asc'" dmx-class:sorting_desc="listPurchaseOrders.data.sort_po=='department_name' &amp;&amp; listPurchaseOrders.data.dir_po == 'desc'">{{trans.data.destination[lang.value]}}</th>
                        <th class="sorting" dmx-on:click="listPurchaseOrders.set('sort_po','vendor_name');listPurchaseOrders.set('dir_po',listPurchaseOrders.data.dir_po == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="listPurchaseOrders.data.sort_po=='vendor_name' &amp;&amp; listPurchaseOrders.data.dir_po == 'asc'" dmx-class:sorting_desc="listPurchaseOrders.data.sort_po=='vendor_name' &amp;&amp; listPurchaseOrders.data.dir_po == 'desc'">{{trans.data.Source[lang.value]}}</th>
                        <th class="sorting text-center" dmx-on:click="listPurchaseOrders.set('sort_po','po_status');listPurchaseOrders.set('dir_po',listPurchaseOrders.data.dir_po == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="listPurchaseOrders.data.sort_po=='po_status' &amp;&amp; listPurchaseOrders.data.dir_po == 'asc'" dmx-class:sorting_desc="listPurchaseOrders.data.sort_po=='po_status' &amp;&amp; listPurchaseOrders.data.dir_po == 'desc'">{{trans.data.status[lang.value]}}</th>
                        <th class="sorting" dmx-on:click="listPurchaseOrders.set('sort_po','null');listPurchaseOrders.set('dir_po',listPurchaseOrders.data.dir_po == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="listPurchaseOrders.data.sort_po=='null' &amp;&amp; listPurchaseOrders.data.dir_po == 'asc'" dmx-class:sorting_desc="listPurchaseOrders.data.sort_po=='null' &amp;&amp; listPurchaseOrders.data.dir_po == 'desc'"></th>
                      </tr>
                    </thead>
                    <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_transfer_orders_out.data.list_purchase_orders_paged.data" id="list_tos_out" dmx-state="listPurchaseOrders" dmx-sort="sort_po" dmx-order="dir_po">
                      <tr>
                        <td dmx-text="po_id"></td>
                        <td dmx-text="user_username"></td>
                        <td dmx-text="time_ordered"></td>
                        <td dmx-text="department_name"></td>
                        <td dmx-text="source_department_name"></td>
                        <td>
                          <h6 dmx-text="trans.data.getValueOrKey(po_status)[lang.value]" class="text-center pt-1 pb-1 ps-2 pe-2" dmx-class:red-state="(po_status=='Requested')" dmx-class:green-state="(po_status=='Received')" dmx-class:yellow-state="(po_status=='Approved')">Fancy display heading</h6>
                        </td>
                        <td>
                          <button id="btn231" class="btn open" data-bs-target="#readItemModal" dmx-on:click="readItemModal.show();session_variables.set('current_purchase_order',po_id);read_purchase_order.load({po_id: po_id});list_purchase_order_items.load({po_id: po_id})" dmx-bind:value="list_purchase_orders.data.query[0].po_id" data-bs-toggle="modal"><i class="fas fa-expand-alt fa-lg"><br></i></button>
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
      <div class="tab-pane fade" id="navTabs1_3" role="tabpanel" aria-labelledby="navTabs1_2_tab1">
        <div class="row">
          <div class="col rounded mt-2 ms-3 me-3 bg-secondary">
            <div class="table-responsive mt-1" id="stockadjustments">
              <table class="table table-hover table-sm table-borderless" id="stockadjustmentsTable">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>{{trans.data.dateTime[lang.value]}}</th>
                    <th>{{trans.data.attention[lang.value]}}</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_adjustment_orders.data.query_list_adjustment_orders" id="ao_table">
                  <tr>
                    <td dmx-text="order_id"></td>
                    <td dmx-text="order_time"></td>
                    <td dmx-text="user_username"></td>
                    <td>
                      <button id="btn2" class="btn open" data-bs-target="#readAOModal" dmx-on:click="session_variables.set('current_adjustment_order',order_id);read_adjustment_order.load({order_id: session_variables.data.current_adjustment_order});list_ao_items.load({order_id: read_adjustment_order.data.query.order_id})" dmx-bind:value="order_id" data-bs-toggle="modal"><i class="far fa-edit"><br></i></button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>
      <div class="tab-pane fade" id="navTabs1_1" role="tabpanel">
        <div class="row mt-1">

          <div class="col">
            <div class="row">
              <div class="col-6 col-md-3 col-xxl-4 visually-hidden">
                <form id="stockProductSearch" class="d-flex">
                  <input id="searchProductsStock" name="text1" type="text" class="form-control mb-1" dmx-bind:value="searchProducts2.value" dmx-on:changed="load_products.load({service_id: list_user_shift_info.data.query_list_user_shift[0].servo_service_service_id, search: searchProducts2.value, productfilter: AddProductstoAO.searchProducts2.value})" dmx-bind:placeholder="trans.data.search[lang.value]"><button id="btn17b" class="btn mt-xxl-0 mb-xxl-0 ms-xxl-0 me-xxl-0 btn-sm btn-secondary mb-1 ms-2 me-2" dmx-on:click="searchProducts2.setValue(null);load_products.load({service_id: list_user_shift_info.data.query_list_user_shift[0].servo_service_service_id})">
                    <i class="fas fa-backspace"></i>
                  </button>
                </form>
              </div>
              <div class="flex-sm-wrap justify-content-lg-end justify-content-xl-end justify-content-xxl-end col-sm-auto offset-xxl-3 col-xxl-3 offset-sm-1 col-md-2 offset-md-5 offset-lg-6 col-lg-2 col-xl-2 offset-xl-6 col-auto offset-2">
                <button id="btn15" class="btn btn-secondary" dmx-on:click="productStockValuesState.set('stock_value_offset',(productStockValuesState.data.offset).toNumber()-(productStockSortLimit.value).toNumber()); productstockvalues.load({offset: productStockValuesState.data.offset, limit: productStockSortLimit.value})"><i class="fas fa-chevron-left"></i></button>
                <button id="btn18" class="btn btn-secondary" dmx-on:click="productStockValuesState.set('stock_value_offset',(productStockValuesState.data.offset).toNumber()+(productStockSortLimit.value).toNumber());productstockvalues.load({offset: productStockValuesState.data.offset, limit: productStockSortLimit.value})"><i class="fas fa-chevron-right"></i></button>
              </div>
              <div class="col-xl-1 col-md-2 col-lg col-lg-1 col-sm-2 col-auto"><select id="productStockSortLimit" class="form-select" name="customer_sort_limit" dmx-on:updated="productstockvalues.load({offset: 1, limit: selectedValue});productStockValuesState.set('offset',value)">
                  <option value="5">5</option>
                  <option selected="" value="25">25</option>
                  <option value="50">50</option>
                  <option value="100">100</option>
                  <option value="'250">250</option>
                  <option value="500">500</option>
                </select></div>
            </div>


          </div>
        </div>
        <div class="row rounded mt-2 ms-2 me-2 bg-secondary">
          <div class="col">
            <div class="table-responsive">
              <table class="table table-hover table-sm">
                <thead>
                  <tr>
                    <th></th>
                    <th>{{trans.data.product[lang.value]}}</th>
                    <th class="visually-hidden">{{trans.data.purchased[lang.value]}}</th>
                    <th class="visually-hidden">{{trans.data.adjusted[lang.value]}}</th>
                    <th class="visually-hidden">{{trans.data.sold[lang.value]}}</th>
                    <th class="visually-hidden">{{trans.data.transferred[lang.value]}}</th>
                    <th>{{trans.data.reserved[lang.value]}}</th>
                    <th>{{trans.data.inStock[lang.value]}}</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="productstockvalues.data.getStockValues2" id="tableRepeat6">
                  <tr>
                    <td dmx-text="po_product_id"></td>
                    <td dmx-text="product_name"></td>
                    <td dmx-text="TotalPurchased" class="visually-hidden"></td>
                    <td dmx-text="TotalAdjusted" class="visually-hidden"></td>
                    <td dmx-text="TotalSold" class="visually-hidden"></td>
                    <td dmx-text="TotalTransfered" class="visually-hidden"></td>
                    <td dmx-text="ReservedStock"></td>
                    <td dmx-text="(TotalPurchased - TotalSold - TotalAdjusted)"></td>
                    <td>
                      <button id="btn24" class="btn" data-bs-toggle="modal" data-bs-target="#readItemProduct" dmx-on:click="read_product_data.load({product_id: po_product_id})">
                        <i class="far fa-edit"></i></button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="row">

          <div class="col-xxl-5 col-xl-5 col-lg-5">
            <dmx-chart id="chart2" point-size="" type="pie" dmx-bind:data="stock_data_per_department.data.getStockValues2" dataset-1:value="(TotalPurchased - TotalSold - TotalAdjusted)" labels="department_name" responsive="true" legend="top" label-x="stock_data_per_department.data.getStockValues2[0].TotalSold"></dmx-chart>
          </div>
          <div class="col-xxl-5 col-xl-4 col-lg-4"></div>
          <div class="col-xxl-2 col-xl-3 col-lg-3"></div>

        </div>
      </div>
    </div>

    </div>
  </main>
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
          <div class="modal-header bg-light">

            <h5 class="modal-title">{{trans.data.order[lang.value]}}: {{session_variables.data.current_order}}</h5>
            <button id="btn3" class="btn text-warning" data-bs-toggle="offcanvas" data-bs-target="#orderdetailsoffcanvas">
              <i class="far fa-eye"></i>
            </button>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body bg-light">


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
          <div class="modal-footer bg-light">


          </div>
        </div>
      </div>
    </div>
    <div class="modal" id="CreateOrderModal" is="dmx-bs5-modal" tabindex="-1">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header border-0">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="container ps-3 pe-3">
              <div class="row row-cols-12">
                <div class="text-center ms-1 me-1 pt-3 pb-3 ps-2 pe-2 rounded rounded-3 border-secondary bg-secondary col" id="createpo">
                  <div class="row row-cols-12 justify-content-center">
                    <div class="col fw-bold">
                      <h4 class="fw-bold">{{trans.data.purchaseOrder[lang.value]}}</h4>
                    </div>
                  </div>
                  <div class="row row-cols-12">
                    <form is="dmx-serverconnect-form" id="create_purchase_order_form" method="post" action="dmxConnect/api/servo_purchase_orders/create_purchase_order.php" dmx-on:success="notifies1.success('PO #'+createPurchaseOrder.data.custom[0]['last_insert_id()']+' Created');session_variables.set('current_purchase_order',create_purchase_order_form.data.custom[0]['last_insert_id()']);create_purchase_order_form.reset();list_purchase_orders.load();CreateOrderModal.hide();read_purchase_order.load({po_id: create_purchase_order_form.data.custom[0]['last_insert_id()']});readItemModal.show()">
                      <input id="timeOrdered" name="time_ordered" class="form-control visually-hidden" type="datetime-local" dmx-bind:value="var1.datetime">
                      <input id="userOrdered" name="servo_users_user_ordered_id" type="hidden" class="form-control visually-hidden" dmx-bind:value="session_variables.data.user_id">
                      <input id="poStatus" name="po_status" type="hidden" class="form-control visually-hidden" dmx-bind:value="'Requested'">
                      <input id="poType" name="po_type" type="hidden" class="form-control visually-hidden" dmx-bind:value="'Purchase'">




                      <div class="row mt-2 mb-3 row-cols-12">
                        <div class="col-sm-10 opacity-50 offset-0 col">
                          <select id="select3" class="form-select" name="servo_vendors_vendor_id" dmx-bind:options="list_vendors.data.query_list_vendors" optiontext="vendor_name" optionvalue="vendor_id" required="" data-msg-required="!">
                            <option value="">{{trans.data.vendor[lang.value]}}</option>
                          </select>
                        </div>
                      </div>
                      <div class="row mt-2 mb-3 row-cols-12">
                        <div class="col-sm-10 offset-0">
                          <select id="select5" class="form-select" name="servo_departments_department_id" optionvalue="department_id" dmx-bind:options="load_departments.data.query_list_departments" optiontext="department_name" dmx-bind:value="session_variables.data.user_department_id">
                            <option value="">{{trans.data.department[lang.value]}}</option>
                          </select>
                        </div>
                      </div>
                      <div class="row row-cols-12 me-3">
                        <div class="col"><button id="btn7" class="btn text-white bg-info ps-5 pe-5" type="submit"><i class="fas fa-cart-plus fa-lg"></i></button></div>

                      </div>
                    </form>
                  </div>


                </div>


              </div>
              <div class="row">
                <div class="col text-center mt-4 ms-1 me-1 pt-3 pb-3 ps-2 pe-2 rounded rounded-3 border-secondary bg-secondary" id="createTO">
                  <div class="row">
                    <div class="col">
                      <h4 class="fw-bold">{{trans.data.transferOrder[lang.value]}}</h4>
                    </div>
                  </div>
                  <div class="row">
                    <form is="dmx-serverconnect-form" id="create_transfer_order_form" method="post" action="dmxConnect/api/servo_purchase_orders/create_transfer_order.php" dmx-on:success="notifies1.success('TO # '+create_transfer_order_form.data.last_insert_to[0]['last_insert_id()']+'Created');session_variables.set('current_purchase_order',create_transfer_order_form.data.last_insert_to[0]['last_insert_id()']);create_transfer_order_form.reset();list_transfer_orders.load({});CreateOrderModal.hide();read_purchase_order.load({po_id: create_transfer_order_form.data.last_insert_to[0]['last_insert_id()']});readItemModal.show();list_transfer_orders_in.load({sort: query.sort_to_in, offset: query.offset_to_in, limit: toSortLimitIn.value, to_filter: toFilterIn.value});list_transfer_orders_out.load({sort: query.offset_to_out, offset: query.offset_to_out, limit: toSortLimitOut.value, to_filter: toFilterOut.value, department_source: list_user_info.data.query_list_user_info.servo_user_departments_department_id})" dmx-on:error="notifies1.warning('Error')">
                      <input id="timeOrdered1" name="time_ordered" class="form-control visually-hidden" type="datetime-local" dmx-bind:value="var1.datetime">
                      <input id="userOrdered1" name="servo_users_user_ordered_id" type="hidden" class="form-control visually-hidden" dmx-bind:value="session_variables.data.user_id">
                      <input id="poStatus3" name="po_status" type="hidden" class="form-control visually-hidden" dmx-bind:value="'Requested'">
                      <input id="poType" name="po_type" type="hidden" class="form-control visually-hidden" dmx-bind:value="'Transfer'">




                      <div class="row mt-2 mb-3 row-cols-12">
                        <div class="d-flex col-sm-10 offset-0 col">
                          <h5 class="me-2">{{trans.data.source[lang.value]}}</h5>
                          <select id="select6" class="form-select" name="transfer_source_department_id" optionvalue="department_id" dmx-bind:options="load_departments.data.query_list_departments" optiontext="department_name" dmx-bind:value="session_variables.data.user_department_id">
                            <option value="">{{trans.data.department[lang.value]}}</option>
                          </select>
                        </div>
                      </div>
                      <div class="row mt-2 mb-3">
                        <div class="d-flex col-sm-10 offset-0">
                          <h5 class="me-2">{{trans.data.destination[lang.value]}}</h5>
                          <select id="select7" class="form-select" name="servo_departments_department_id" optionvalue="department_id" dmx-bind:options="load_departments.data.query_list_departments" optiontext="department_name" dmx-bind:value="session_variables.data.user_department_id">
                            <option value="">{{trans.data.department[lang.value]}}</option>
                          </select>
                        </div>
                      </div>
                      <div class="row row-cols-1">
                        <div class="border-warning offset-0 col"><button id="btn20" class="btn btn-lg bg-warning text-white me-1 ps-5 pe-5" type="submit"><i class="fas fa-exchange-alt fa-lg"></i></button>
                        </div>
                      </div>
                    </form>
                  </div>


                </div>
              </div>
              <div class="row row-cols-12">
                <div class="col mt-4 ms-1 me-1 pt-3 pb-3 ps-2 pe-2 border-secondary bg-secondary rounded" id="createao">
                  <div class="row justify-content-center row-cols-12">
                    <div class="col text-center">
                      <h4 class="fw-bold">{{trans.data.stockAdjustment[lang.value]}}</h4>
                    </div>
                  </div>
                  <div class="row">
                    <form is="dmx-serverconnect-form" id="create_adjustment_order" method="post" action="dmxConnect/api/servo_orders/create_adjustment_order.php" dmx-on:success="notifies1.success('Success!');session_variables.set('current_adjustment_order',create_adjustment_order.data.custom[0]['last_insert_id()']);list_adjustment_orders.load({});CreateOrderModal.hide();read_adjustment_order.load({order_id: create_adjustment_order.data.custom[0]['last_insert_id()']});readAOModal.show()">
                      <input id="order_time" name="order_time" class="form-control visually-hidden" type="datetime-local" dmx-bind:value="var1.datetime">
                      <input id="order_status" name="order_status" type="hidden" class="form-control visually-hidden" dmx-bind:value="session_variables.data.user_id">
                      <input id="user_ordered" name="servo_user_user_id" type="hidden" class="form-control visually-hidden" dmx-bind:value="session_variables.data.user_id">

                      <input id="aoDepartment" name="servo_departments_department_id" type="hidden" class="form-control" dmx-bind:value="session_variables.data.user_department_id">
                      <div class="row row-cols-1">
                        <div class="d-flex border-warning col offset-0 justify-content-center"><button id="btn5" class="btn btn-lg text-white bg-danger pt-1 pb-1 ps-5 pe-5" type="submit"><i class="far fa-minus-square fa-lg"></i></button>
                        </div>
                      </div>
                    </form>
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
      <div class="modal-dialog modal-xl" role="document" style="margin: 3px !important; width: 99.5% !important; height: 99% !important; max-width: 99.5% !important; max-height: 99% !important;">
        <div class="modal-content">


          <dmx-preloader id="preloader1" spinner="pulse" bgcolor="#8A8686" ,255,255,0.99),255,255,0.97)=""></dmx-preloader>

          <div class="modal-header border-0">
            <div class="d-block d-flex"><button id="btn10" class="btn float-right bg-opacity-10 me-3 text-info bg-info" data-bs-toggle="offcanvas" data-bs-target="#AddProductsToOrderOffCanvas" dmx-on:click="" dmx-hide="(read_purchase_order.data.query.po_status == 'Received')||(profile_privileges.data.profile_privileges[0].delete_po=='No')"><i class="fas fa-cart-plus fa-sm"></i></button>
              <div id="conditional1" is="dmx-if" dmx-bind:condition="(profile_privileges.data.profile_privileges[0].approve_po == 'Yes')">
                <main>
                  <div class="row">
                    <div class="col d-flex">
                      <form id="approvePO" is="dmx-serverconnect-form" method="post" action="dmxConnect/api/servo_purchase_orders/approve_po.php" dmx-on:success="notifies1.success('Success!');list_purchase_orders.load({});list_transfer_orders.load({});read_purchase_order.load({po_id: read_purchase_order.data.query.po_id})" dmx-hide="(read_purchase_order.data.query.po_status == 'Approved');">
                        <input id="poid" name="po_id" type="text" class="form-control visually-hidden" dmx-bind:value="read_purchase_order.data.query.po_id">
                        <input id="timeapproved" name="time_approved" type="datetime-local" class="form-control visually-hidden" dmx-bind:value="var1.datetime">
                        <input id="userApproved" name="servo_users_user_approved_id" class="form-control visually-hidden" dmx-bind:value="session_variables.data.user_id">
                        <input id="poStatus" name="po_status" type="text" class="form-control visually-hidden" dmx-bind:value="'Approved'">
                        <button id="btn11" class="btn float-right text-warning me-3 bg-opacity-10 bg-warning" data-bs-target="#AddProductsToOrderOffCanvas" type="submit" dmx-hide="(read_purchase_order.data.query.po_status == 'Approved');(read_purchase_order.data.query.po_status == 'Received')">
                          <i class="fas fa-check fa-sm"></i>
                        </button>
                      </form>
                      <form id="receivePO" is="dmx-serverconnect-form" method="post" action="dmxConnect/api/servo_purchase_orders/receive_po.php" dmx-on:success="notifies1.success('Success!');list_purchase_orders.load({});productstockvalues.load();list_transfer_orders.load({});read_purchase_order.load({po_id: read_purchase_order.data.query.po_id})">
                        <input id="poid1" name="po_id" type="text" class="form-control visually-hidden" dmx-bind:value="read_purchase_order.data.query.po_id">
                        <input id="timereceived" name="time_received" type="datetime-local" class="form-control visually-hidden" dmx-bind:value="var1.datetime">
                        <input id="userReceived" name="servo_users_user_received_id" class="form-control visually-hidden" dmx-bind:value="session_variables.data.user_id">
                        <input id="poStatus2" name="po_status" type="text" class="form-control visually-hidden" dmx-bind:value="'Received'">
                        <button id="btn12" class="btn text-success float-right me-3 bg-success bg-opacity-10" data-bs-target="#AddProductsToOrderOffCanvas" type="submit" dmx-show="(read_purchase_order.data.query.po_status == 'Approved')" dmx-on:click="">
                          <i class="fas fa-arrow-down fa-sm"></i>
                        </button>
                      </form>
                    </div>
                  </div>
                </main>

              </div>
              <div id="conditional5" is="dmx-if" dmx-bind:condition="(profile_privileges.data.profile_privileges[0].approve_po == 'Yes')">
                <main>
                  <div class="row">
                    <div class="col d-flex">
                      <form id="closePO" is="dmx-serverconnect-form" method="post" action="dmxConnect/api/servo_purchase_orders/close_purchase_order.php" dmx-on:success="notifies1.success('Success!');read_purchase_order.load({po_id: read_purchase_order.data.query.po_id})" dmx-hide="(read_purchase_order.data.query.po_status == 'Approved');">
                        <input id="poidClosed" name="po_id" type="text" class="form-control visually-hidden" dmx-bind:value="read_purchase_order.data.query.po_id">
                        <input id="timeClosed" name="time_closed" type="datetime-local" class="form-control visually-hidden" dmx-bind:value="var1.datetime">
                        <input id="userClosed" name="servo_users_user_closed_id" class="form-control visually-hidden" dmx-bind:value="session_variables.data.user_id">
                        <input id="poStatus5" name="po_payment_status" type="text" class="form-control visually-hidden" dmx-bind:value="'Paid'"><button id="btn25" class="btn float-right me-3 bg-opacity-10 text-success bg-success" data-bs-target="#AddProductsToOrderOffCanvas" type="submit" dmx-show="(poTotalOwing.value &gt;= '0' &amp;&amp; read_purchase_order.data.query.po_payment_status== 'Ordered')">
                          <i class="fas fa-lock fa-sm"></i>
                        </button>
                      </form>
                      <form id="reopenPO" is="dmx-serverconnect-form" method="post" action="dmxConnect/api/servo_purchase_orders/reopen_purchse_order.php" dmx-on:success="notifies1.success('Success!');read_purchase_order.load({po_id: read_purchase_order.data.query.po_id})">
                        <input id="poreopen" name="po_id" type="text" class="form-control visually-hidden" dmx-bind:value="read_purchase_order.data.query.po_id">
                        <input id="timereceived1" name="time_reopened" type="datetime-local" class="form-control visually-hidden" dmx-bind:value="var1.datetime">
                        <input id="userReceived1" name="servo_users_user_reopened" class="form-control visually-hidden" dmx-bind:value="session_variables.data.user_id">
                        <input id="poStatus4" name="po_payment_status" type="text" class="form-control visually-hidden" dmx-bind:value="'Ordered'">

                        <button id="btn251" class="btn float-right me-3 bg-opacity-10 text-danger bg-danger" data-bs-target="#AddProductsToOrderOffCanvas" type="submit" dmx-show="(read_purchase_order.data.query.po_payment_status == 'Paid')">
                          <i class="fas fa-lock-open fa-sm"></i>
                        </button>
                      </form>
                    </div>
                  </div>
                </main>

              </div><button id="btn19" class="btn float-right bg-opacity-10 bg-primary text-primary" data-bs-toggle="modal" data-bs-target="#printInvoiceModal">
                <i class="fas fa-file-invoice fa-sm"></i>
              </button>
            </div>












            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">


            <div class="offcanvas offcanvas-start w-100" id="AddProductsToOrderOffCanvas" is="dmx-bs5-offcanvas" tabindex="-1">
              <div class="offcanvas-header border-0 bg-secondary">
                <h4 class="offcanvas-title text-body">{{trans.data.addProducts[lang.value]}}</h4>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
              </div>
              <div class="offcanvas-body w-auto bg-secondary" style="">
                <div class="row mb-2">
                  <div class="col d-flex"><input id="searchProducts1" name="text1" type="text" class="form-control mb-1 me-2" dmx-bind:value="searchProducts1.value" dmx-on:changed="load_products.load({search: searchProducts1.value})" dmx-bind:placeholder="trans.data.search[lang.value]"><button id="btn17" class="btn ms-2 me-2 btn-outline-light text-white bg-info" dmx-on:click="searchProducts1.setValue(searchProducts1.value);load_products.load({service_id: list_user_shift_info.data.query_list_user_shift[0].servo_service_service_id, search: searchProducts1.value});searchProducts1.setValue()">
                      <i class="fas fa-backspace"></i>
                    </button></div>
                </div>
                <div class="row justify-content-xxl-center me-2 row-cols-12 row-cols-xl-10">
                  <div class="flex-md-wrap flex-md-row justify-content-md-center align-content-center offset-md-1 col-12 col-sm-5 col-xxl-1 col-md-5 col-lg-2 bg-light rounded-bottom mt-2 mb-2 ms-1 me-0 pt-3 pb-3 ps-3 pe-3" id="repeatProducts" style="margin-top: 0px !important; padding-top: 0px !important; /* position: relative */ /* height: auto */" dmx-repeat:repeatproducts="load_products.data.repeat">

                    <div class="row mt-2">
                      <div class="col text-center" style="padding: 0px !important; height: 200px;" dmx-hide="product_picture==null">
                        <img dmx-bind:src="'/servo/uploads/product_pictures/'+product_picture" width="100%" height="95%" loading="lazy" style="object-fit: cover;">
                      </div>
                    </div>

                    <h6 class="text-center text-body">{{product_name}}</h6>
                    <h6 class="text-center bg-secondary">{{product_price}}</h6>
                    <div class="row">
                      <div class="col align-self-lg-stretch">
                        <form id="add_products_to_purchase_order_form" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_purchase_order_items/add_item_to_po.php" dmx-on:success="add_products_to_purchase_order_form.reset();list_purchase_order_items.load();notifies1.success('Success:'+product_name+' Added to Order')">
                          <input id="poItemQuantity" name="po_item_quantity" type="number" class="form-control mb-sm-1 mb-2" style="width:100% !important;" required="" data-msg-required="Required!" min="" data-rule-min="1" data-msg-min="Min 1" dmx-bind:placeholder="trans.data.quantity[lang.value]">
                          <input id="poId" name="po_id" type="number" class="form-control mb-sm-1 mb-2 visually-hidden" dmx-bind:value="read_purchase_order.data.query.po_id">
                          <input id="productId" name="po_product_id" type="number" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="1" dmx-bind:value="product_id">
                          <input id="poItemPrice" name="po_item_price" type="number" class="form-control mb-sm-1 mb-2" style="width:100% !important;" dmx-bind:value="0" required="" data-msg-required="Required!" min="" data-rule-min="0" data-msg-min="Minimum 0" dmx-bind:placeholder="trans.data.price[lang.value]" dmx-bind:hidden="(read_purchase_order.data.query.po_type == 'Transfer')">
                          <textarea id="poItemNotes" class="form-control" name="po_item_notes" dmx-bind:placeholder="trans.data.note[lang.value]"></textarea>

                          <div class="row align-items-sm-end">
                            <div class="col mb-sm-2" style="/* position: absolute */ /* bottom: 0px */"><button id="btn31" class="add-item-button btn mt-2 align-self-end btn-lg w-100 text-white bg-success" type="submit">

                                <i class="fas fa-cart-plus"></i>: {{query_list_product_stock[0].TotalStock}}
                              </button></div>
                          </div>
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
                  <h6 dmx-show="(read_purchase_order.data.query.po_type == 'Purchase')" class="rounded bg-primary pt-2 pb-2 ps-3 pe-3 bg-opacity-10">{{trans.data.purchaseOrder[lang.value]}}: {{read_purchase_order.data.query.po_id}}</h6>
                  <h6 dmx-show="(read_purchase_order.data.query.po_type == 'Transfer')" class="rounded bg-primary bg-opacity-10 pt-2 pb-2 ps-3 pe-3">{{trans.data.transferOrder[lang.value]}}: {{read_purchase_order.data.query.po_id}}</h6>
                </div>

                <div class="d-block ms-2">
                  <h6 class="text-white ms-2 pt-2 pb-2 ps-3 pe-3 rounded fw-bold" dmx-text="trans.data.getValueOrKey(read_purchase_order.data.query.po_status)[lang.value]
                                    " dmx-class:bg-success="read_purchase_order.data.query.po_status=='Received'" dmx-class:bg-danger="read_purchase_order.data.query.po_status=='Requested'" dmx-class:bg-warning="read_purchase_order.data.query.po_status=='Approved'"><i class="fas fa-check fa-sm" style="margin-right: 10px"></i>

                  </h6>
                </div>
                <div class="d-block text-danger ms-2 d-flex flex-wrap">
                  <dmx-value id="poTotal" dmx-bind:value="(read_purchase_order.data.read_po_totals[0].POTotal).toNumber().formatNumber('O',',',',').default(0)"></dmx-value>
                  <dmx-value id="poTotalPaid" dmx-bind:value="(read_purchase_order.data.read_po_totals[0].POTotalPaid).toNumber().formatNumber('O',',',',').default(0)"></dmx-value>
                  <dmx-value id="poTotalOwing" dmx-bind:value="((read_purchase_order.data.read_po_totals[0].POTotalPaid).toNumber() - read_purchase_order.data.read_po_totals[0].POTotal).toNumber().formatNumber('0',',',',')"></dmx-value>
                  <dmx-value id="poTotalOwing2" dmx-bind:value="((read_purchase_order.data.read_po_totals[0].POTotalPaid).toNumber() - read_purchase_order.data.read_po_totals[0].POTotal).toNumber()"></dmx-value>

                  <h6 class="fw-bold ms-2 pt-2 pb-2 ps-3 pe-3 rounded bg-opacity-10 text-info bg-info"><i class="fas fa-cash-register fa-sm" style="margin-right:10px"></i>
                    {{poTotal.value}}
                  </h6>
                  <h6 class="fw-bold ms-2 pt-2 pb-2 ps-3 pe-3 rounded bg-opacity-10 text-success bg-success"><i class="fas fa-arrow-circle-up fa-sm" style="margin-right:10px"></i>{{poTotalPaid.value}}

                  </h6>
                  <h6 class="fw-bold text-danger ms-2 pt-2 pb-2 ps-3 pe-3 rounded bg-danger bg-opacity-10"><i class="fas fa-arrow-circle-down fa-sm" style="margin-right:10px"></i>
                    {{poTotalOwing.value}}
                  </h6>
                </div>

                <div class="text-danger float-right">

                </div>
              </div>
            </div>
            <div class="row me-2" id="poModal">
              <div class="col">
                <ul class="nav nav-tabs flex-nowrap scrollable nav-fill align-items-end" id="navTabs1_tabs_1" role="tablist">
                  <li class="nav-item" id="poOverview"><a class="nav-link active" id="navTabs1_1_tab" data-bs-toggle="tab" href="#" data-bs-target="#poOverview_1" role="tab" aria-controls="navTabs1_1" aria-selected="true"><i class="far fa-eye" style="margin-right: 3px;"></i>{{trans.data.overview[lang.value]}}

                    </a></li>
                  <li class="nav-item" id="poCash">
                    <a class="nav-link" id="navTabs1_2_tab" data-bs-toggle="tab" href="#" data-bs-target="#poCash_1" role="tab" aria-controls="navTabs1_2" aria-selected="false"><i class="fas fa-cash-register" style="margin-right: 3px;"></i>{{trans.data.payment[lang.value]}}

                    </a>
                  </li>
                  <li class="nav-item" id="poTransactions">
                    <a class="nav-link" id="navTabs1_3_tab2" data-bs-toggle="tab" href="#" data-bs-target="#poTransactions_1" role="tab" aria-controls="navTabs1_3" aria-selected="false"><i class="fas fa-coins"></i>
                    </a>
                  </li>
                  <li class="nav-item" id="poHistory">
                    <a class="nav-link" id="navTabs1_3_tab" data-bs-toggle="tab" href="#" data-bs-target="#poHistory_1" role="tab" aria-controls="navTabs1_3" aria-selected="false"><i class="fas fa-history fa-sm"></i>
                      <sup id="btn30" class="badge text-white fw-bold mb-n1 bg-danger" dmx-text="list_purchase_order_items.data.list_purchase_order_value_updates.count()">
                      </sup>
                    </a>
                  </li>

                  <li class="nav-item" id="poDeletes">
                    <a class="nav-link" id="navTabs1_3_tab1" data-bs-toggle="tab" href="#" data-bs-target="#poDeletes_1" role="tab" aria-controls="navTabs1_3" aria-selected="false">{{trans.data.delete[lang.value]}}
                      <i class="far fa-trash-alt fa-sm"></i>
                      <sup id="btn301" class="badge text-white fw-bold mb-n1 bg-danger" dmx-text="list_purchase_order_items.data.list_po_item_deletes.count()">
                      </sup>
                    </a>
                  </li>
                </ul>
                <div class="tab-content" id="navTabs1_2content">
                  <div class="tab-pane fade show active" id="poOverview_1" role="tabpanel">
                    <div class="row mt-2 ms-0 me-0">
                      <div class="col rounded bg-primary bg-opacity-10 mt-1 mb-2 pt-2 pb-2 ps-2 pe-2">
                        <div class="table-responsive">
                          <table class="table table-hover" id="po_items_table">
                            <thead>
                              <tr>
                                <th>{{trans.data.product[lang.value]}}</th>
                                <th>{{trans.data.quantity[lang.value]}}</th>
                                <th>{{trans.data.unitPrice[lang.value]}}</th>
                                <th class="text-center">{{trans.data.total[lang.value]}}</th>
                                <th>{{trans.data.note[lang.value]}}</th>

                                <th></th>
                              </tr>
                            </thead>
                            <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_purchase_order_items.data.query" id="tableRepeat2">
                              <tr>
                                <td dmx-text="product_name"></td>
                                <td class="text-end">
                                  <form id="editQuantity" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_purchase_order_items/update_po_item_quantity.php" dmx-on:success="notifies1.success('Success');list_purchase_order_items.load({po_id: session_variables.data.current_purchase_order});create_value_update_po_item_quantity.submit()">
                                    <div class="row">
                                      <div class="col d-flex"><input id="newQuantity" name="po_item_quantity" type="number" class="form-control inline-edit" dmx-bind:value="po_item_quantity" dmx-bind:disabled="(profile_privileges.data.profile_privileges[0].edit_po_item_quantity == 'No')||read_purchase_order.data.query.po_status=='Received'" min="" data-rule-min="1" data-msg-min="Min. 1" dmx-on:updated="create_value_update_po_item_quantity.quantityUpdateNew.setValue(editQuantity.newQuantity.value)" dmx-disabled="(profile_privileges.data.profile_privileges[0].edit_po_item_quantity == 'No')">
                                        <input id="editPOId" name="po_item_id" type="number" class="form-control inline-edit visually-hidden" dmx-bind:value="po_item_id">
                                        <button id="btn21" class="btn text-success ms-3" data-bs-target="#productInfo" type="submit" dmx-bind:disabled="(profile_privileges.data.profile_privileges[0].edit_po_item_quantity == 'No')||read_purchase_order.data.query.po_status=='Received'|| editQuantity.newQuantity.value == po_item_quantity"><i class="fas fa-check"><br></i></button>
                                      </div>
                                    </div>
                                  </form>
                                  <form id="create_value_update_po_item_quantity" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_value_updates/create_value_update_po_item_quantity.php" dmx-on:success="notifies1.success('Success');list_order_items.load({order_id: session_variables.data.current_order})">
                                    <div class="row">
                                      <div class="col d-flex"><input id="quantityUpdateOld" name="old_value" type="number" class="form-control inline-edit visually-hidden" dmx-bind:value="po_item_quantity">
                                        <input id="quantityUpdateNew" name="new_value" type="number" class="form-control inline-edit visually-hidden" dmx-bind:value="po_item_quantity">
                                        <input id="orderItemUpdatedID" name="updated_po_item_id" type="number" class="form-control inline-edit visually-hidden" dmx-bind:value="po_item_id">
                                        <input id="orderUpdatedID" name="updated_po_id" type="number" class="form-control inline-edit visually-hidden" dmx-bind:value="read_purchase_order.data.query.po_id">
                                        <input id="productUpdatedID" name="updated_product_id" type="number" class="form-control inline-edit visually-hidden" dmx-bind:value="po_product_id">
                                        <input id="userUpdatedQuantity" name="user_updated" type="number" class="form-control inline-edit visually-hidden" dmx-bind:value="list_user_info.data.query_list_user_info.user_id">
                                        <input id="userUpdatedValue" name="updated_value" class="form-control inline-edit visually-hidden" dmx-bind:value="'Quantity'">
                                        <input id="updatedTime" name="updated_time" class="form-control inline-edit visually-hidden" dmx-bind:value="dateTime.datetime" type="datetime-local">
                                      </div>
                                    </div>
                                  </form>





                                </td>
                                <td class="text-end">
                                  <form id="editPrice" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_purchase_order_items/update_po_item_price.php" dmx-on:success="notifies1.success('Success');list_purchase_order_items.load({po_id: session_variables.data.current_purchase_order});create_value_update_po_item_price.submit()">
                                    <div class="row">
                                      <div class="col d-flex">
                                        <input id="newPrice" name="po_item_price" type="number" class="form-control inline-edit" dmx-bind:value="po_item_price" dmx-bind:disabled="(profile_privileges.data.profile_privileges[0].edit_po_item_price == 'No') || read_purchase_order.data.query.po_status=='Received'" min="" data-rule-min="1" data-msg-min="Min. 1" dmx-on:updated="create_value_update_po_item_price.priceUpdateNew.setValue(editPrice.newPrice.value)">
                                        <input id="editPOId1" name="po_item_id" type="number" class="form-control inline-edit visually-hidden" dmx-bind:value="po_item_id"><button id="btn4" class="btn text-success ms-3" data-bs-target="#productInfo" type="submit" dmx-bind:disabled="(profile_privileges.data.profile_privileges[0].edit_po_item_price == 'No') || read_purchase_order.data.query.po_status=='Received'|| editPrice.newPrice.value == po_item_price"><i class="fas fa-check"><br></i></button>
                                      </div>
                                    </div>
                                  </form>
                                  <form id="create_value_update_po_item_price" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_value_updates/create_value_update_po_item_price.php" dmx-on:success="notifies1.success('Success');list_order_items.load({order_id: session_variables.data.current_order})">
                                    <div class="row">
                                      <div class="col d-flex"><input id="priceUpdateOld" name="old_value" type="number" class="form-control inline-edit visually-hidden" dmx-bind:value="po_item_price">
                                        <input id="priceUpdateNew" name="new_value" type="number" class="form-control inline-edit visually-hidden" dmx-bind:value="po_item_price">
                                        <input id="orderItemUpdatedID1" name="updated_po_item_id" type="number" class="form-control inline-edit visually-hidden" dmx-bind:value="po_item_id">
                                        <input id="orderUpdatedID1" name="updated_po_id" type="number" class="form-control inline-edit visually-hidden" dmx-bind:value="read_purchase_order.data.query.po_id">
                                        <input id="productUpdatedID1" name="updated_product_id" type="number" class="form-control inline-edit visually-hidden" dmx-bind:value="po_product_id">
                                        <input id="userUpdatedQuantity1" name="user_updated" type="number" class="form-control inline-edit visually-hidden" dmx-bind:value="list_user_info.data.query_list_user_info.user_id">
                                        <input id="userUpdatedValue1" name="updated_value" class="form-control inline-edit visually-hidden" dmx-bind:value="'Price'">
                                        <input id="updatedTime1" name="updated_time" class="form-control inline-edit visually-hidden" dmx-bind:value="dateTime.datetime" type="datetime-local">
                                      </div>
                                    </div>
                                  </form>
                                </td>
                                <td dmx-text="(po_item_quantity * po_item_price).formatNumber(0, '.', ',')" class="text-end"></td>
                                <td dmx-text="po_item_notes"></td>


                                <td>
                                  <div class="row" is="dmx-if" id="conditional3" dmx-bind:condition="(profile_privileges.data.profile_privileges[0].delete_po_item == 'Yes')">
                                    <form id="deletePOItem" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_purchase_order_items/delete_po_item.php" dmx-on:success="notifies1.success('Success!');list_purchase_order_items.load({po_id: read_purchase_order.data.query.po_id});createPOItemDelete.submit()">
                                      <input id="poItemDelete" name="po_item_id" type="text" class="form-control visually-hidden" dmx-bind:value="po_item_id">
                                      <button id="btn3" class="btn text-body" type="submit"><i class="far fa-trash-alt fa-sm"></i>
                                      </button>
                                    </form>
                                    <form id="createPOItemDelete" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_purchase_order_items/create_po_item_delete.php" dmx-on:success="notifies1.success('Success!');list_purchase_order_items.load()">

                                      <input id="poItemDeletePOID" name="po_id" type="text" class="form-control visually-hidden" dmx-bind:value="po_id">
                                      <input id="poItemDeleteItemID" name="po_item_id" type="text" class="form-control visually-hidden" dmx-bind:value="po_item_id">
                                      <input id="poItemDeletedProduct" name="po_item_deleted_product_id" type="text" class="form-control visually-hidden" dmx-bind:value="po_product_id"><input id="poItemDeleteQuantity" name="po_item_quantity" type="text" class="form-control visually-hidden" dmx-bind:value="po_item_quantity">
                                      <input id="poItemDeletedPrice" name="po_item_price" type="text" class="form-control visually-hidden" dmx-bind:value="po_item_price">
                                      <input id="poItemDeleteUserDeleted" name="po_user_deleted" type="text" class="form-control visually-hidden" dmx-bind:value="list_user_info.data.query_list_user_info.user_id"><input id="poItemTimeDeleted" name="po_item_time_deleted" type="text" class="form-control visually-hidden" dmx-bind:value="dateTime.datetime">

                                    </form>
                                  </div>



                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                    <div class="row bg-secondary rounded mt-2 ms-0 me-0 pt-2 pb-2 ps-2 pe-2">
                      <form is="dmx-serverconnect-form" id="updatePurchaseOrder" method="post" action="dmxConnect/api/servo_purchase_orders/update_purchase_order.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="read_purchase_order.data.query">
                        <div class="mb-3 row visually-hidden">
                          <label for="inp_po_id" class="col-sm-2 col-form-label visually-hidden" wappler-command="editContent">PO</label>
                          <div class="col-sm-10">
                            <input type="number" class="form-control visually-hidden" id="inp_po_id" name="po_id" dmx-bind:value="read_purchase_order.data.query.po_id" aria-describedby="inp_po_id_help" readonly="true">
                          </div>
                        </div>
                        <div class="mb-3 row ">
                          <label for="inp_po_need_by_date" class="col-sm-2 col-form-label" wappler-command="editContent">{{trans.data.dateNeeded[lang.value]}}</label>
                          <div class="col-sm-10">
                            <input type="datetime-local" class="form-control" id="inp_po_need_by_date" name="po_need_by_date" dmx-bind:value="read_purchase_order.data.query.po_need_by_date" aria-describedby="inp_po_id_help" dmx-bind:disabled="read_purchase_order.data.query.po_status=='Received'&amp;&amp;profile_privileges.data.profile_privileges[0].create_po=='No'">
                          </div>
                        </div>
                        <div class="mb-3 row ">
                          <label for="inp_payment_method" class="col-sm-2 col-form-label" wappler-command="editContent">{{trans.data.discount[lang.value]}} %</label>
                          <div class="col-sm-10">
                            <input id="poDiscount" name="po_discount" type="number" class="form-control" dmx-bind:disabled="read_purchase_order.data.query.po_status=='Received'&amp;&amp;profile_privileges.data.profile_privileges[0].create_po=='No'">
                          </div>
                        </div>
                        <div class="row mb-3 text-danger fw-bold">
                          <label for="inp_payment_method" class="col-sm-2 col-form-label" wappler-command="editContent">{{trans.data.vendor[lang.value]}}</label>
                          <div class="col-sm-10">
                            <select id="select4" class="form-select" name="servo_vendors_vendor_id" dmx-bind:disabled="read_purchase_order.data.query.po_status=='Received'&amp;&amp;profile_privileges.data.profile_privileges[0].create_po=='No'" dmx-bind:options="list_vendors.data.query_list_vendors" optiontext="vendor_name" optionvalue="vendor_id" dmx-bind:value="read_purchase_order.data.query.servo_vendors_vendor_id" required="" data-msg-required="!">
                              <option selected="" value="%">{{trans.data.vendor[lang.value]}}</option>
                            </select>
                          </div>
                        </div>
                        <div class="mb-3 row">
                          <label for="inp_po_notes" class="col-sm-2 col-form-label" wappler-command="editContent">{{trans.data.note[lang.value]}}</label>
                          <div class="col-sm-7">
                            <textarea type="text" class="form-control" id="inp_po_notes" name="po_notes" dmx-bind:value="read_purchase_order.data.query.po_notes" aria-describedby="inp_po_notes_help" dmx-bind:disabled="read_purchase_order.data.query.po_status=='Received'&amp;&amp;profile_privileges.data.profile_privileges[0].create_po=='No'"></textarea>
                          </div>
                        </div>
                        <div class="mb-3 row">
                          <div class="col-sm-2" wappler-empty="Column" wappler-command="addElementInside">&nbsp;</div>
                          <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary" wappler-command="editContent" dmx-hide="read_purchase_order.data.query.po_status=='Received'&amp;&amp;profile_privileges.data.profile_privileges[0].create_po=='No'">{{trans.data.ok[lang.value]}}</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="poCash_1" role="tabpanel">



                    <div class="row bg-secondary mt-2 ms-1 pt-3 pb-3 ps-4 pe-4 rounded">
                      <form is="dmx-serverconnect-form" id="createOrderTransaction" method="post" action="dmxConnect/api/servo_vendor_cash_transactions/create_vendor_cash_settlement.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-on:success="createOrderTransaction.reset();notifies1.success('Success');read_purchase_order.load({po_id: read_purchase_order.data.query.po_id})" dmx-on:error="notifies1.danger('Error!')">
                        <input id="transactionOrderId" name="transaction_order" class="form-control visually-hidden" dmx-bind:value="read_purchase_order.data.query.po_id">
                        <input id="transactionVendor" name="transaction_vendor_id" class="form-control visually-hidden" dmx-bind:value="read_purchase_order.data.query.servo_vendors_vendor_id">
                        <input id="transactionDate" name="transaction_date" class="form-control visually-hidden" dmx-bind:value="dateTime.datetime">
                        <input id="transactionUserApproved" name="user_approved_id" class="form-control visually-hidden" dmx-bind:value="list_user_info.data.query_list_user_info.user_id">
                        <input id="transactionType" name="transaction_type" class="form-control visually-hidden" dmx-bind:value="'Settlement'">
                        <div class="mb-3 row">
                          <label for="transactionAmount1" class="col-sm-2 col-form-label">{{trans.data.total[lang.value]}}</label>
                          <div class="col-sm-10">
                            <input class="form-control" id="transactionAmount" name="transaction_amount" required="" data-msg-required="!" min="" data-msg-min="Min 1" dmx-bind:min="1" data-rule-min="1" dmx-bind:value="-((read_purchase_order.data.read_po_totals[0].POTotalPaid).toNumber() - read_purchase_order.data.read_po_totals[0].POTotal).toNumber()" type="number" dmx-bind:max="-poTotalOwing2.value" max="" data-msg-max="&gt;Max!">
                          </div>
                        </div>
                        <div class="mb-3 row">
                          <label for="transactionAmountTendered" class="col-sm-2 col-form-label">{{trans.data.amountTendered[lang.value]}}</label>
                          <div class="col-sm-10">
                            <input type="number" class="form-control" id="transactionAmountTendered" name="transaction_amount_tendered" aria-describedby="inp_order_notes_help" required="" data-msg-required="!" min="" data-msg-min="Min 0" dmx-bind:min="createOrderTransaction.transactionAmount.value" data-rule-min="1" dmx-bind:disabled="(readCustomerOrder.data.query.order_status=='Paid')" placeholder="0">
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
                          <div class="col-sm-10 d-flex">




                            <select id="orderTransactionPaymentMethod" class="form-select" dmx-bind:options="loadpaymentmethods.data.query" optiontext="payment_method_name" optionvalue="payment_method_id" name="transaction_payment_method" dmx-bind:disabled="((readCustomerOrder.data.query.order_status == 'Paid')||(createCustomerTransaction.transactionPaymentMethod1.value == '1'))" required="" data-msg-required="!">
                              <option selected="" value="">----</option>
                            </select>
                            <button id="payFromDeposit" class="btn ms-2 fw-bold btn-success" dmx-text="trans.data.payFromDeposit[lang.value]+' : '+netDeposits.value" dmx-on:click="createOrderTransaction.transactionType.disable();createOrderTransaction.orderTransactionPaymentMethod.setValue(1)" dmx-show="createOrderTransaction.transactionAmount.value<=netDeposits.value&amp;&amp;createOrderTransaction.transactionAmount.value>0"></button>
                          </div>
                        </div>


                        <div class="mb-3 row">
                          <div class="col-sm-2">
                            &nbsp;</div>
                          <div class="col-sm-10 d-flex justify-content-start">
                            <button class="btn btn-success pt-md-2 pb-md-2 ps-md-2 pe-md-2" id="receive_payment1" dmx-bind:disabled="(readCustomerOrder.data.query.order_status == 'Paid')" type="submit" dmx-show="createOrderTransaction.transactionAmount.value>0"><i class="fas fa-hand-holding-usd fa-2x"></i></button>
                          </div>

                        </div>
                      </form>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="poTransactions_1" role="tabpanel">
                    <div class="row mt-2 ms-0 me-0">
                      <div class="col bg-secondary rounded">
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
                            <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="read_purchase_order.data.list_po_transactions" id="tableRepeat5">
                              <tr>
                                <td dmx-text="customer_transaction_id"></td>

                                <td dmx-text="transaction_type"></td>
                                <td dmx-text="user_fname+' '+user_lname+' | '+user_username"></td>
                                <td dmx-text="payment_method_name"></td>
                                <td dmx-text="transaction_date"></td>
                                <td dmx-text="transaction_status"></td>
                                <td dmx-text="transaction_note"></td>

                                <td dmx-text="transaction_amount.formatNumber('0', ',', ',')"></td>
                                <td dmx-text="transaction_amount_tendered.formatNumber('0', ',', ',')"></td>
                                <td dmx-text="transaction_balance.formatNumber('0', ',', ',')"></td>
                                <td>
                                  <button id="btn15" class="btn" data-bs-toggle="modal" data-bs-target="#printTransactionReceiptModalGeneral" dmx-on:click="read_customer_transaction.load({customer_cash_transaction_id: customer_transaction_id})" dmx-bind:disabled="(readCustomerOrder.data.query.order_status == 'Paid')"><i class="fas fa-receipt fa-lg"></i>
                                  </button>
                                </td>
                                <td>
                                  <form id="deleteOrderTransaction" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_vendor_cash_transactions/delete_vendor_cash_transaction.php" dmx-on:success="run([{run:{action:`read_purchase_order.load({po_id: read_purchase_order.data.query.po_id})`,outputType:'text'}},{condition:{if:`poTotalOwing.value!==0`,then:{steps:{run:{action:`update_order_paid_ordered.load({order_id: readCustomerOrder.data.query.order_id})`,name:'paid_ordered',outputType:'text'}}},outputType:'boolean'}}])" onsubmit=" return confirm('CONFIRM DELETE?');">
                                    <input id="text3" name="vendor_transaction_id" type="text" class="form-control visually-hidden" dmx-bind:value="vendor_transaction_id">
                                    <button id="btn9" class="btn text-body" type="submit" dmx-hide="(readCustomerOrder.data.query.order_status == 'Paid')">
                                      <i class="far fa-trash-alt fa-sm"></i>
                                    </button>
                                  </form>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="poHistory_1" role="tabpanel">
                    <div class="row mt-2 ms-0 me-0">
                      <div class="col rounded bg-secondary">
                        <div class="table-responsive">
                          <table class="table table-hover table-sm">
                            <thead>
                              <tr>
                                <th>{{trans.data.dateTime[lang.value]}}</th>
                                <th>{{trans.data.item[lang.value]}}</th>
                                <th>{{trans.data.product[lang.value]}}</th>
                                <th>{{trans.data.value[lang.value]}}</th>
                                <th>{{trans.data.old[lang.value]}}</th>
                                <th>{{trans.data.new[lang.value]}}</th>
                                <th>{{trans.data.user[lang.value]}}</th>
                              </tr>
                            </thead>
                            <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_purchase_order_items.data.list_purchase_order_value_updates" id="tableRepeat12">
                              <tr>
                                <td dmx-text="updated_time"></td>
                                <td dmx-text="updated_po_item_id"></td>
                                <td dmx-text="product_name"></td>
                                <td dmx-text="updated_value"></td>
                                <td dmx-text="old_value"></td>
                                <td dmx-text="new_value"></td>
                                <td dmx-text="user_username"></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>

                    </div>
                  </div>
                  <div class="tab-pane fade" id="poDeletes_1" role="tabpanel">
                    <div class="row">
                      <div class="col">
                        <div class="table-responsive">
                          <table class="table table-hover table-sm">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>{{trans.data.purchaseOrder[lang.value]}}</th>
                                <th>{{trans.data.quantity[lang.value]}}</th>
                                <th>{{trans.data.price[lang.value]}}</th>
                                <th>{{trans.data.dateTime[lang.value]}}</th>
                                <th>{{trans.data.product[lang.value]}}</th>
                                <th>{{trans.data.user[lang.value]}}</th>
                              </tr>
                            </thead>
                            <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_purchase_order_items.data.list_po_item_deletes" id="tableRepeat9">
                              <tr>
                                <td dmx-text="po_item_id"></td>
                                <td dmx-text="po_id"></td>
                                <td dmx-text="po_item_quantity"></td>
                                <td dmx-text="po_item_price"></td>
                                <td dmx-text="po_item_time_deleted"></td>
                                <td dmx-text="product_name"></td>
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


            </div>



          </div>

          <div class="modal-footer border-0">
            <form id="form1" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_purchase_orders/delete_purchase_order.php" dmx-on:success="notifies1.success('Success');readItemModal.hide();list_purchase_orders.load({})" onsubmit=" return confirm('CONFIRM DELETE?');" dmx-show="(profile_privileges.data.profile_privileges[0].delete_po == 'Yes')">
              <input id="text1" name="po_id" class="form-control visually-hidden" dmx-bind:value="read_purchase_order.data.query.po_id">

              <button id="btn6" class="btn text-body" type="submit">
                <i class="far fa-trash-alt fa-lg"></i>
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="modal readitem" id="readItemProduct" is="dmx-bs5-modal" tabindex="-1" dmx-on:hidden-bs-modal="session_variables.remove('current_purchase_order')">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header border-0">
            <div class="d-block d-flex">
              <h5 dmx-text="read_product_data.data.query_list_product_purchases.data[0].product_name"></h5>
            </div>












            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">
            <div class="row">
              <div class="col scrollable">
                <div class="table-responsive">
                  <table class="table table-hover table-sm table-striped">
                    <thead>
                      <tr class="text-center">
                        <th>#</th>

                        <th>{{trans.data.price[lang.value]}}</th>
                        <th>{{trans.data.note[lang.value]}}</th>

                        <th>{{trans.data.vendor[lang.value]}}</th>
                        <th>{{trans.data.status[lang.value]}}</th>
                        <th>{{trans.data.dateTime[lang.value]}}</th>
                        <th>{{trans.data.quantity[lang.value]}}</th>
                        <th>{{trans.data.purchaseOrder[lang.value]}}</th>
                      </tr>
                    </thead>
                    <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="read_product_data.data.query_list_product_purchases.data" id="tableRepeat8" class="text-center">
                      <tr>
                        <td dmx-text="po_item_id"></td>

                        <td dmx-text="po_item_price" class="text-end"></td>
                        <td dmx-text="po_item_notes"></td>

                        <td dmx-text="vendor_name"></td>
                        <td dmx-text="po_status"></td>
                        <td dmx-text="time_received"></td>
                        <td dmx-text="po_item_quantity" class="fw-bold text-end"></td>
                        <td dmx-text="po_id" class="text-center"></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>


          </div>
          <div class="modal-footer border-0">
          </div>
        </div>
      </div>
    </div>
    <div class="modal readitem" id="readAOModal" is="dmx-bs5-modal" tabindex="-1" dmx-on:hidden-bs-modal="session_variables.remove('current_purchase_order')">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <dmx-preloader id="preloader_ao" spinner="wave" bgcolor="#8A8686" ,255,255,0.99),255,255,0.97)="" preview="true"></dmx-preloader>
          <div class="modal-header bg-light border-0">
            <div class="d-block d-flex"><button id="btn13" class="btn float-right text-body" data-bs-toggle="offcanvas" data-bs-target="#AddProductstoAO" dmx-on:click="" dmx-hide="(read_purchase_order.data.query.po_status == 'Received')">
                <i class="fas fa-cart-plus"></i>
              </button>
              <div id="conditional2" is="dmx-if" dmx-bind:condition="(profile_privileges.data.profile_privileges[0].delete_ao == 'Yes')">
                <form id="approveAO" is="dmx-serverconnect-form" method="post" action="dmxConnect/api/servo_purchase_orders/approve_po.php" dmx-on:success="notifies1.success('Success!');list_adjustment_orders.load({})">
                  <input id="aoID" name="order_id" type="text" class="form-control visually-hidden" dmx-bind:value="read_purchase_order.data.query.po_id">
                  <input id="timeapproved1" name="order_time" type="datetime-local" class="form-control visually-hidden" dmx-bind:value="var1.datetime">
                  <input id="userApproved1" name="servo_users_user_approved_id1" class="form-control visually-hidden" dmx-bind:value="session_variables.data.user_id">
                  <input id="poStatus1" name="po_status1" type="text" class="form-control visually-hidden" dmx-bind:value="'Approved'">
                  <button id="btn13" class="btn float-right text-warning" data-bs-target="#AddProductsToOrderOffCanvas" dmx-on:click="" type="submit" dmx-hide="(read_purchase_order.data.query.po_status == 'Approved');(read_purchase_order.data.query.po_status == 'Received')">
                    <i class="fas fa-check"></i>
                  </button>
                </form>

              </div>
            </div>













            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body bg-light">
            <div class="offcanvas offcanvas-start w-100" id="AddProductstoAO" is="dmx-bs5-offcanvas" tabindex="-1">
              <div class="offcanvas-header">
                <h5 class="offcanvas-title">{{trans.data.addProducts[lang.value]}}</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
              </div>
              <div class="offcanvas-body">
                <div class="row mb-2">
                  <div class="col d-flex"><input id="searchProducts2" name="text1" type="text" class="form-control mb-1" dmx-bind:value="searchProducts2.value" dmx-on:changed="load_products.load({service_id: list_user_shift_info.data.query_list_user_shift[0].servo_service_service_id, search: searchProducts2.value, productfilter: AddProductstoAO.searchProducts2.value})" dmx-bind:placeholder="trans.data.search[lang.value]"><button id="btn17a" class="btn ms-2 me-2 btn-outline-light text-white bg-info" dmx-on:click="searchProducts2.setValue(null);load_products.load({service_id: list_user_shift_info.data.query_list_user_shift[0].servo_service_service_id})">
                      <i class="fas fa-backspace"></i>
                    </button></div>
                </div>
                <div class="row row-cols-7">
                  <div class="flex-md-wrap flex-md-row justify-content-md-center align-content-center col-12 offset-md-1 col-xxl-3 col-lg-2 col-xl-2 col-sm-4 col-md-3 bg-secondary rounded-bottom mt-2 mb-2 ms-1 pt-3 pb-3 ps-3 pe-3" dmx-repeat:products="load_products.data.repeat" id="addItemToAO" style="padding-top: 0px !important; margin-top: 0px !important;">
                    <div class="row mt-2" style="">
                      <div class="col text-center" style="padding: 0px !important; height: 200px;" dmx-hide="product_picture==null">
                        <img dmx-bind:src="'/servo/uploads/product_pictures/'+product_picture" width="100%" height="95%" loading="lazy" style="object-fit: cover;">
                      </div>
                    </div>
                    <h4 class="text-center text-body">{{product_name}}</h4>
                    <h4 class="text-center">{{product_price}}</h4>
                    <form id="add_products_to_ao" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_order_items/add_order_item_to_ao.php" dmx-on:success="add_products_to_ao.reset();list_ao_items.load();notifies1.success('Success:'+product_name+' Added to Order')">
                      <input id="ao_item_quantity" name="order_item_quantity" type="number" class="form-control mb-sm-1 mb-2" required="" data-msg-required="Required!" min="" data-rule-min="1" data-msg-min="Min 1" dmx-bind:placeholder="trans.data.quantity[lang.value]">
                      <input id="aoTimeOrdered" name="order_time_ordered" type="datetime-local" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="Quantity" dmx-bind:value="dateTime.datetime">
                      <input id="order_id" name="servo_orders_order_id" type="number" class="form-control mb-sm-1 mb-2 visually-hidden" dmx-bind:value="session_variables.data.current_adjustment_order">
                      <input id="aoDepartment1" name="servo_departments_department_id" type="number" class="form-control mb-sm-1 mb-2 visually-hidden" dmx-bind:value="session_variables.data.user_department_id">
                      <input id="productId1" name="servo_products_product_id" type="number" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="1" dmx-bind:value="product_id">
                      <input id="ao_item_price" name="order_item_price" type="number" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="Cost Price" dmx-bind:value="0">
                      <input id="aoUserOrdered" name="servo_users_user_ordered" type="number" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="Cost Price" dmx-bind:value="session_variables.data.user_id">
                      <textarea id="ao_notes" class="form-control" name="order_item_notes" dmx-bind:placeholder="trans.data.note[lang.value]"></textarea>
                      <button id="btn131" class="add-item-button btn mt-2 align-self-end w-100 btn-outline-light text-white bg-danger btn-sm" type="submit">
                        {{trans.data.inStock[lang.value]}}:{{query_list_product_stock[0].TotalStock}}
                        <i class="fas fa-plus fa-lg"></i></button>
                    </form>
                  </div>

                </div>
              </div>
            </div>
            <div class="row">
              <div class="d-flex col justify-content-start">
                <div class="d-block">
                  <h5>{{trans.data.stockAdjustment[lang.value]}}</h5>
                </div>
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
            <h4>{{read_item_department.data.query.department_name}}</h4>
            <div class="row me-0">
              <div class="rounded bg-secondary col-12 mb-2 ms-2 ps-2 pe-2">
                <div class="table-responsive">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>{{trans.data.product[lang.value]}}</th>
                        <th>{{trans.data.quantity[lang.value]}}</th>
                        <th>{{trans.data.dateTime[lang.value]}}</th>
                        <th>{{trans.data.notes[lang.value]}}</th>


                        <th></th>
                      </tr>
                    </thead>
                    <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_ao_items.data.query" id="tableRepeat7">
                      <tr>
                        <td dmx-text="order_item_id"></td>
                        <td dmx-text="product_name"></td>
                        <td dmx-text="order_item_quantity"></td>
                        <td dmx-text="order_time_ordered"></td>
                        <td dmx-text="order_item_notes"></td>


                        <td>
                          <div class="row" is="dmx-if" id="conditional4" dmx-bind:condition="(profile_privileges.data.profile_privileges[0].delete_ao_item=='Yes')">
                            <form id="deleteAOItem" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_order_items/delete_order_item_simple.php" dmx-on:success="notifies1.success('Success!');list_ao_items.load({order_id: session_variables.data.current_adjustment_order})">
                              <input id="aoItem" name="order_item_id" type="text" class="form-control visually-hidden" dmx-bind:value="order_item_id">
                              <button id="btn14" class="btn text-body" type="submit"><i class="far fa-trash-alt fa-sm"></i>
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
            <div class="row">
              <form is="dmx-serverconnect-form" id="updateAO" method="post" action="dmxConnect/api/servo_orders/update_order_adjustment.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="read_purchase_order.data.query">
                <div class="mb-3 row visually-hidden">
                  <label for="inp_po_id1" class="col-sm-2 col-form-label visually-hidden" wappler-command="editContent"></label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control visually-hidden" id="inp_po_id1" name="order_id" dmx-bind:value="read_purchase_order.data.query.po_id" aria-describedby="inp_po_id_help" disabled="true" readonly="true">
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
                <div class="mb-3 row visually-hidden">
                  <label for="inp_payment_status1" class="col-sm-2 col-form-label visually-hidden" wappler-command="editContent">Payment Status</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control visually-hidden" id="inp_payment_status1" name="payment_status1" dmx-bind:value="read_purchase_order.data.query.payment_status" aria-describedby="inp_payment_status_help">
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="inp_po_notes1" class="col-sm-2 col-form-label" wappler-command="editContent">{{trans.data.note[lang.value]}}</label>
                  <div class="col-sm-10">
                    <textarea type="text" class="form-control" id="inp_po_notes1" name="order_notes" dmx-bind:value="read_purchase_order.data.query.po_notes" aria-describedby="inp_po_notes_help" dmx-bind:disabled="read_purchase_order.data.query.po_status == 'Received'" required="" data-msg-required="!"></textarea>
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
          <div class="modal-footer border-0 bg-light">
            <form id="form22" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_orders/delete_order_and_items.php" dmx-on:success="notifies1.success('Success');list_purchase_orders.load();list_adjustment_orders.load();productstockvalues.load();readAOModal.hide()" credentials dmx-show="(profile_privileges.data.profile_privileges[0].delete_ao == 'Yes')"><input id="deleteAO" name="order_id" type="text" class="form-control visually-hidden" dmx-bind:value="read_adjustment_order.data.query.order_id"><button id="btn2b" class="btn text-secondary" data-bs-target="#productInfo" type="submit"><i class="far fa-trash-alt fa-lg"><br></i></button></form>
          </div>
        </div>
      </div>
    </div>
    <div class="modal readitem" id="printReceipt" is="dmx-bs5-modal" tabindex="-1" dmx-on:hidden-bs-modal="total_sales_per_waiter.load();readItemModal.show()">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header bg-light border-0">
            <div class="d-block">
              <h2 class="text-body"><b>SERVO</b></h2>
            </div>






            <button id="receiptBack" class="btn float-right btn-sm text-danger" data-bs-target="#readItemModal" dmx-on:click="printReceipt.hide()" data-bs-toggle="modal"><i class="fas fa-chevron-left fa-2x">&nbsp;</i></button>
            <button id="receiptPrint" class="btn float-right btn-sm text-success" data-bs-target="#readItemModal" data-bs-toggle="modal" onclick="print()"><i class="fas fa-print fa-2x">&nbsp;</i></button><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body bg-light" id="receiptModal">
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
          </div>

        </div>
      </div>
    </div>
  </main>
  <main class="mt-4" id="printPO">

    <div class="modal readitem" id="printInvoiceModal" is="dmx-bs5-modal" tabindex="-1" dmx-on:hidden-bs-modal="readItemModal.show()" style="z-index: 9000000000000; background: white !important; border: none !important;">
      <div class="modal-dialog modal-xl" role="document" style="margin: 0px !important; width: 100% !important; height: 99% !important; max-width: 100% !important; max-height: 99% !important; boder: none !important;">
        <div class="modal-content" style="max-height: 100% !important; height: 100% !important; border: none !important;">
          <dmx-value id="InvoiceTitleContent" dmx-bind:value="trans.data.receipt[lang.value]"></dmx-value>
          <div class="modal-header bg-light" id="invoiceHead">
            <div class="d-block "><button id="proFormaButton" class="btn me-2 text-body bg-secondary" dmx-on:click="InvoiceTitleContent.setValue(trans.data.proFormaInvoice[lang.value])">{{trans.data.proFormaInvoice[lang.value]}}
              </button><button id="invoiceButton" class="btn me-2 text-body bg-secondary" dmx-on:click="InvoiceTitleContent.setValue(trans.data.invoice[lang.value])">{{trans.data.invoice[lang.value]}}
              </button><button id="printInvoiceButton3" class="btn me-2 text-body bg-secondary" dmx-on:click="InvoiceTitleContent.setValue(trans.data.receipt[lang.value])">{{trans.data.receipt[lang.value]}}
              </button><button id="printInvoiceButton2" class="btn text-body bg-secondary" onclick="window.print()"><i class="fas fa-print fa-sm"></i>
              </button></div>





            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="invoice" style="background: white;">
            <div class="container" id="customerInvoiceContent">
              <div class="row justify-content-between" id="invoiceHeader">
                <div class="col">
                  <img dmx-bind:src="'uploads/'+companyInfo.data.query.company_logo" width="100">
                </div>
                <div class="col">
                </div>
                <div class="col">
                  <h5 class="text-info fw-bolder" dmx-text="companyInfo.data.query.company_address"></h5>
                </div>
              </div>
              <div class="row justify-content-center row-cols-1" id="receiptNumber">

                <div class="col">
                  <h4 class="text-info fw-bolder text-center" dmx-text="trans.data.purchaseOrder[lang.value]+' : '+read_purchase_order.data.query.po_id" id="poTitle" dmx-show="read_purchase_order.data.query.po_type=='Purchase'"></h4>
                  <h4 class="text-info fw-bolder text-center" dmx-text="trans.data.transferOrder[lang.value]+' : '+read_purchase_order.data.query.po_id" id="toTitle" dmx-show="read_purchase_order.data.query.po_type=='Transfer'"></h4>
                </div>
              </div>
              <div class="row justify-content-center row-cols-1" id="receiptInformation">

                <div class="col" dmx-hide="read_purchase_order.data.query.po_type=='Transfer'">
                  <h6 class="text-info fw-bolder text-start" dmx-text="trans.data.vendor[lang.value]+' : '"></h6>
                  <p dmx-html="read_purchase_order.data.query.vendor_name+' &lt;br&gt;'+read_purchase_order.data.query.vendor_address+'&lt;br&gt;'+read_purchase_order.data.query.vendor_phone_number" dmx-hide="read_purchase_order.data.query.po_type=='Transfer'"></p>
                  <h5 class="text-info fw-bolder text-start" dmx-text="trans.data.name[lang.value]+' : '+read_customer.data.query_read_customer.customer_first_name+' '+read_customer.data.query_read_customer.customer_last_name"></h5>
                </div>
              </div>
              <div class="row justify-content-center row-cols-1" id="transferInformation" dmx-show="read_purchase_order.data.query.po_type=='Transfer'">

                <div class="col d-flex">
                  <p dmx-html="trans.data.source[lang.value]+' : '+read_purchase_order.data.query.department_source"></p>
                </div>
                <div class="col d-flex">
                  <p dmx-html="trans.data.destination[lang.value]+' : '+read_purchase_order.data.query.department_destination"></p>
                </div>
              </div>
              <div class="row justify-content-center row-cols-1" id="receiptTable">

                <div class="col">
                  <div class="table-responsive bg-white" id="ReceiptOrderDetails" style="/* background: white */ /* border-color: white */ color: black !important;">
                    <table class="table" style="background: white;">
                      <thead style="background: #b0b0b0 !important;">
                        <tr style="color: black !important;">
                          <th>{{trans.data.product[lang.value]}}</th>
                          <th>{{trans.data.note[lang.value]}}</th>
                          <th class="text-end">{{trans.data.quantity[lang.value]}}</th>
                          <th dmx-hide="read_purchase_order.data.query.po_type=='Transfer'" class="text-end">{{trans.data.price[lang.value]}}</th>
                          <th dmx-hide="read_purchase_order.data.query.po_type=='Transfer'" class="text-end">{{trans.data.total[lang.value]}}</th>
                        </tr>
                      </thead>
                      <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_purchase_order_items.data.query" id="receiptDetails">
                        <tr style="color: black !important;" class="fw-bold">
                          <td dmx-text="product_name"></td>
                          <td dmx-text="po_item_notes"></td>
                          <td dmx-text="po_item_quantity" class="text-end">

                          </td>
                          <td dmx-text="po_item_price" dmx-hide="read_purchase_order.data.query.po_type=='Transfer'" class="text-end">

                          </td>
                          <td dmx-text="(po_item_quantity * po_item_price).formatNumber('O', ',', ',')" dmx-hide="read_purchase_order.data.query.po_type=='Transfer'" class="text-end">

                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="row justify-content-end">
                <div class="col">
                  <h5 dmx-text="trans.data.total[lang.value]">Fancy display heading</h5>
                </div>
                <div class="col">
                  <h5 dmx-text="">Fancy display heading</h5>
                </div>
              </div>
            </div>
            <div class="modal-footer">
            </div>
          </div>
        </div>
      </div>


    </div>
  </main>






  <script src="bootstrap/5/js/bootstrap.min.js"></script>
</body>

</html>