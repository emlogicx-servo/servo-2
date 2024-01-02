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
  <script src="js/jquery-3.5.1.slim.min.js"></script>
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

  <script src="dmxAppConnect/dmxBootstrap5Collapse/dmxBootstrap5Collapse.js" defer=""></script>


  <script src="dmxAppConnect/dmxFormatter/dmxFormatter.js" defer=""></script>
  <link rel="stylesheet" href="dmxAppConnect/dmxDatePicker/bgthemes/dark-calendar.css" />
  <link rel="stylesheet" href="dmxAppConnect/dmxValidator/dmxValidator.css" />
  <script src="dmxAppConnect/dmxValidator/dmxValidator.js" defer=""></script>
  <link rel="stylesheet" href="fontawesome5/css/all.min.css" />
  <script src="dmxAppConnect/dmxCharts/Chart.min.js" defer=""></script>
  <script src="dmxAppConnect/dmxCharts/dmxCharts.js" defer=""></script>
  <script src="dmxAppConnect/dmxBootstrap5PagingGenerator/dmxBootstrap5PagingGenerator.js" defer=""></script>
  <link rel="stylesheet" href="dmxAppConnect/dmxAnimateCSS/animate.min.css" />
  <script src="dmxAppConnect/dmxAnimateCSS/dmxAnimateCSS.js" defer=""></script>
  <link rel="stylesheet" href="bootstrap/5/servolight/bootstrap.min.css" />
  <link rel="stylesheet" href="bootstrap/5/servodark/bootstrap.min.css" />

  <link rel="stylesheet" href="bootstrap/5/css/bootstrap.min.css" />
</head>

<body id="products" is="dmx-app">
  <dmx-value id="pageName" dmx-bind:value="trans.data.products[lang.value]"></dmx-value>
  <dmx-query-manager id="list_products"></dmx-query-manager>
  <dmx-query-manager id="list_products_for_group"></dmx-query-manager>
  <dmx-query-manager id="list_groups"></dmx-query-manager>
  <dmx-value id="date" dmx-bind:value="getDate()"></dmx-value>
  <dmx-value id="salesTotal" dmx-bind:value="product_sales_single.data.query_product_sale_single.sum(`(order_item_quantity * order_item_price)`)"></dmx-value>
  <dmx-value id="salesVolume" dmx-bind:value="product_sales_single.data.query_product_sale_single.sum(`(order_item_quantity)`)"></dmx-value>
  <dmx-value id="salesPriceAverage" dmx-bind:value="(salesTotal.value / salesVolume.value)"></dmx-value>
  <dmx-value id="purchasesTotal" dmx-bind:value="product_purchases_received_single.data.product_purchases_received_single.sum(`(po_item_quantity * po_item_price)`)"></dmx-value>
  <dmx-value id="purchasesVolume" dmx-bind:value="product_purchases_received_single.data.product_purchases_received_single.sum(`po_item_quantity`)"></dmx-value>
  <dmx-value id="purchasePriceAverage" dmx-bind:value="(purchasesTotal.value / purchasesVolume.value)"></dmx-value>
  <dmx-value id="unitMargin" dmx-bind:value="(salesPriceAverage.value - purchasePriceAverage.value)"></dmx-value>
  <dmx-serverconnect id="list_product_groups" url="dmxConnect/api/servo_product_groups/list_product_groups_paged.php" dmx-param:offset="list_groups.data.offset_groups" dmx-param:limit="group_sort_limit.value" dmx-param:groupfilter="groupFilter.value"></dmx-serverconnect>

  <dmx-serverconnect id="list_departments" url="dmxConnect/api/servo_departments/list_departments.php"></dmx-serverconnect>
  <dmx-serverconnect id="list_product_group_items" url="dmxConnect/api/servo_product_group_items/list_product_group_items.php" dmx-param:product_group_id="read_item_product_group.data.read_product_group.product_group_id"></dmx-serverconnect>
  <dmx-serverconnect id="readProductPrice" url="dmxConnect/api/servo_product_prices/read_product_price.php" dmx-param:product_price_id="load_product_prices.data.query[0].product_price_id"></dmx-serverconnect>
  <dmx-serverconnect id="load_services" url="dmxConnect/api/servo_services/list_services.php"></dmx-serverconnect>
  <dmx-serverconnect id="getStockValuesProduct" url="dmxConnect/api/servo_stock/get_stock_values_product.php" dmx-param:product_id="read_item_product.data.query_read_product.product_id"></dmx-serverconnect>

  <dmx-value id="lang" dmx-bind:value="browser1.language"></dmx-value>
  <dmx-json-datasource id="trans" is="dmx-serverconnect" url="assets/translation/translation.JSON"></dmx-json-datasource>

  <dmx-serverconnect id="load_product_prices" url="dmxConnect/api/servo_product_prices/list_product_prices.php" dmx-param:product_id="read_item_product.data.query_read_product.product_id"></dmx-serverconnect>
  <dmx-serverconnect id="load_product_prices_departments" url="dmxConnect/api/servo_product_prices/list_product_prices_departments.php" dmx-param:product_id="read_item_product.data.query_read_product.product_id" dmx-param:department_id="load_departments.data.query_list_departments[0].department_id"></dmx-serverconnect>
  <dmx-serverconnect id="load_product_categories" url="dmxConnect/api/servo_refered_fields_loading/load_product_categories.php"></dmx-serverconnect>
  <dmx-serverconnect id="loadProductSubCategoriesPerCategory" url="dmxConnect/api/servo_product_categories/list_product_sub_categories_per_category.php" dmx-param:product_category_id="serverconnectFormCreateProduct.select3.selectedValue"></dmx-serverconnect>
  <dmx-serverconnect id="load_product_category_options" url="dmxConnect/api/servo_product_category_options/list_product_category_options.php"></dmx-serverconnect>
  <dmx-serverconnect id="load_brands" url="dmxConnect/api/servo_refered_fields_loading/load_brands.php"></dmx-serverconnect>
  <dmx-serverconnect id="read_item_product" url="dmxConnect/api/servo_products/read_product.php" dmx-param:id="id" noload dmx-param:item_id="" dmx-param:branch_id="read_item_branch.data.queryReadBranch.branch_id"></dmx-serverconnect>
  <dmx-serverconnect id="read_item_product_group" url="dmxConnect/api/servo_product_groups/read_product_group.php" dmx-param:id="id" dmx-param:item_id="" dmx-param:branch_id="read_item_branch.data.queryReadBranch.branch_id" dmx-param:prduct_id="list_item_products.data.query_list_products[0].product_id" noload></dmx-serverconnect>
  <dmx-serverconnect id="delete_item_product" url="dmxConnect/api/servo_products/delete_product.php"></dmx-serverconnect>
  <dmx-serverconnect id="list_item_products" url="dmxConnect/api/servo_products/list_products_paged.php" dmx-param:productfilter="productSearch.value" dmx-param:offset="query.offset" dmx-param:limit="product_sort_limit.value"></dmx-serverconnect>
  <dmx-serverconnect id="list_item_products_for_group" url="dmxConnect/api/servo_products/list_products_paged.php" dmx-param:productfilter="createproductGroupItem.groupProductSearch.value" dmx-param:offset="list_products_for_group.data.offset_group_product" dmx-param:limit="5"></dmx-serverconnect>
  <dmx-serverconnect id="list_products_simple" url="dmxConnect/api/servo_products/list_products.php" dmx-param:productfilter="productSearch.value" dmx-param:offset="query.offset" dmx-param:limit="product_sort_limit.value" noload></dmx-serverconnect>

  <dmx-serverconnect id="product_sales_single1" url="dmxConnect/api/servo_reporting/product_sales_single.php" dmx-param:product_id="" dmx-param:datefrom="form5.date1.value" dmx-param:dateto="form5.date2.value" dmx-param:date_start="" dmx-param:date_end=""></dmx-serverconnect>
  <dmx-serverconnect id="product_sales_single" url="dmxConnect/api/servo_reporting/product_sales_single.php" dmx-param:product_id="" dmx-param:date_start="formfilter.date_start.value" dmx-param:date_end=""></dmx-serverconnect>
  <dmx-serverconnect id="product_sales_price_variation" url="dmxConnect/api/servo_reporting/product_sales_price_variation.php" dmx-param:product_id="" dmx-param:date_start="formfilter.date_start.value" dmx-param:date_end=""></dmx-serverconnect>
  <dmx-serverconnect id="product_adjustment_single" url="dmxConnect/api/servo_reporting/product_adjustment_single.php" dmx-param:product_id="read_item_product.data.query_read_product.product_id" dmx-param:date_start="formfilter.date_start.value" dmx-param:date_end="formfilter.date_end.value"></dmx-serverconnect>
  <dmx-serverconnect id="product_purchases_received_single" url="dmxConnect/api/servo_reporting/product_purchases_received_single.php" dmx-param:product_id="" dmx-param:date_start="formfilter.date_start.value" dmx-param:date_end=""></dmx-serverconnect>
  <div is="dmx-browser" id="browser1"></div>
  <dmx-notifications id="notifies1" position="bottom" timeout="50" extended-timeout="10"></dmx-notifications>
  <?php require 'header.php'; ?><main class="bg-light rounded mt-2 ms-2 me-2 pt-3 pb-3 ps-2 pe-2" id="MainBody">
    <div class="mt-auto ms-3 me-3">




      <div class="row servo-page-header">

        <div class="col style13 page-button" id="pagebuttons">
          <button id="btn1" class="btn style12 fw-light bg-info rounded text-info bg-opacity-10" data-bs-toggle="modal" data-bs-target="#createItemModal" style="float: right;"><i class="fas fa-plus style14"></i></button>
        </div>
      </div>
      <ul class="nav nav-tabs nav-justified" id="navTabs1_tabs" role="tablist">
        <li class="nav-item">
          <a class="nav-link active fw-bold" id="navTabs1_1_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_11" role="tab" aria-controls="navTabs1_1" aria-selected="true">{{trans.data.products[lang.value]}}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fw-bold" id="navTabs1_2_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_21" role="tab" aria-controls="navTabs1_2" aria-selected="false">{{trans.data.groups[lang.value]}}</a>
        </li>
      </ul>
      <div class="tab-content" id="navTabs1_content">

        <div class="tab-pane fade show active mt-3 ms-1 me-1 scrollable" id="navTabs1_11" role="tabpanel">

          <div class="row justify-content-between justify-content-sm-between justify-content-md-between justify-content-lg-between justify-content-xl-between justify-content-xxl-between sorter shadow-none rounded bg-light row-cols-12">
            <div class="col-lg-3 col-12 col-sm-12"><input id="productSearch" name="text13" type="text" class="form-control mb-2 form-control-sm" dmx-bind:placeholder="trans.data.search[lang.value]+'  '"></div>

            <div class="d-flex flex-wrap flex-sm-wrap flex-md-wrap col-lg-6 flex-lg-wrap col-xl-7 justify-content-lg-end justify-content-xl-end justify-content-xxl-end col-sm-auto col-md-auto col">
              <ul class="pagination flex-wrap" dmx-populate="list_item_products.data.query_list_products" dmx-state="list_products" dmx-offset="offset" dmx-generator="bs5paging">
                <li class="page-item" dmx-class:disabled="list_item_products.data.query_list_products.page.current == 1" aria-label="First">
                  <a href="javascript:void(0)" class="page-link" dmx-on:click="list_products.set('offset',list_item_products.data.query_list_products.page.offset.first)" wappler-command="editContent"><span aria-hidden="true">‹‹</span></a>
                </li>
                <li class="page-item" dmx-class:disabled="list_item_products.data.query_list_products.page.current == 1" aria-label="Previous">
                  <a href="javascript:void(0)" class="page-link" dmx-on:click="list_products.set('offset',list_item_products.data.query_list_products.page.offset.prev)" wappler-command="editContent"><span aria-hidden="true">‹</span></a>
                </li>
                <li class="page-item" dmx-class:active="title == list_item_products.data.query_list_products.page.current" dmx-class:disabled="!active" dmx-repeat="list_item_products.data.query_list_products.getServerConnectPagination(2,1,'...')">
                  <a href="javascript:void(0)" class="page-link" dmx-on:click="list_products.set('offset',(page-1)*list_item_products.data.query_list_products.limit)" wappler-command="editContent">{{title}}</a>
                </li>
                <li class="page-item" dmx-class:disabled="list_item_products.data.query_list_products.page.current ==  list_item_products.data.query_list_products.page.total" aria-label="Next">
                  <a href="javascript:void(0)" class="page-link" dmx-on:click="list_products.set('offset',list_item_products.data.query_list_products.page.offset.next)" wappler-command="editContent"><span aria-hidden="true">›</span></a>
                </li>
                <li class="page-item" dmx-class:disabled="list_item_products.data.query_list_products.page.current ==  list_item_products.data.query_list_products.page.total" aria-label="Last">
                  <a href="javascript:void(0)" class="page-link" dmx-on:click="list_products.set('offset',list_item_products.data.query_list_products.page.offset.last)" wappler-command="editContent"><span aria-hidden="true">››</span></a>
                </li>
              </ul>
            </div>
            <div class="col-lg-1 col-xl-1 col-md-2 col-sm-2 col-3 offset-lg-1 offset-xl-1 offset-md-2"><select id="product_sort_limit" class="form-select" name="product_category_sort_limit">
                <option value="5">5</option>
                <option selected="" value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
              </select></div>
          </div>
          <div class="row">

            <div class="col">

              <h5>{{trans.data.total[lang.value]}} : {{list_item_products.data.query_list_products.total}}&nbsp;</h5>
            </div>
          </div>

          <div class="row ms-0">
            <div class="col bg-light rounded mt-2 ms-0 me-2">


              <div class="table-responsive servo-shadow shadow-none">
                <table class="table table-hover table-sm table-borderless">
                  <thead>
                    <tr>
                      <th class="text-start">#</th>
                      <th class="text-center">{{trans.data.name[lang.value]}}</th>
                      <th class="text-center">{{trans.data.category[lang.value]}}</th>
                      <th class="text-center">{{trans.data.subCategory[lang.value]}}</th>

                      <th class="text-center">{{trans.data.brandName[lang.value]}}</th>
                      <th class="text-end"></th>
                    </tr>
                  </thead>
                  <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_item_products.data.query_list_products.data" id="tableRepeat2">
                    <tr>
                      <td dmx-text="product_id" class="text-start"></td>
                      <td dmx-text="product_name" class="text-center"></td>
                      <td dmx-text="product_category_name" class="text-center"></td>
                      <td dmx-text="product_sub_category_name" class="text-center"></td>
                      <td dmx-text="product_brand_name" class="text-center"></td>
                      <td class="text-end"><button id="btn2" class="btn  open" data-bs-target="#readItemModal" dmx-on:click="readItemModal.show();read_item_product.load({product_id: product_id});product_sales_single.load({product_id: product_id});getStockValuesProduct.load({product_id: read_item_product.data.query_read_product.product_id})" dmx-bind:value="product_id" wappler-empty="Editable" wappler-command="editContent"><i class="far fa-edit fa-sm"><br></i></button></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade mt-3 scrollable" id="navTabs1_21" role="tabpanel">
          <div class="row justify-content-between justify-content-sm-between justify-content-md-between justify-content-lg-between justify-content-xl-between justify-content-xxl-between mb-xl-2 mb-2 sorter bg-light rounded">
            <div class="col-xxl-3 col-12 col-sm-12 col-lg-3"><input id="groupFilter" name="text13" type="text" class="form-control mb-2 form-control-sm" dmx-bind:placeholder="trans.data.search[lang.value]+'  '"></div>

            <div class="col-xl-4 col-xxl-4 col-sm d-flex flex-sm-wrap col-md flex-md-wrap flex-lg-wrap col-lg col-lg-3 flex-wrap col" style="">
              <ul class="pagination" dmx-populate="list_product_groups.data.list_product_groups" dmx-state="list_groups" dmx-offset="offset_groups" dmx-generator="bs5paging">
                <li class="page-item" dmx-class:disabled="list_product_groups.data.list_product_groups.page.current == 1" aria-label="First">
                  <a href="javascript:void(0)" class="page-link" dmx-on:click="list_groups.set('offset_groups',list_product_groups.data.list_product_groups.page.offset.first)"><span aria-hidden="true">&lsaquo;&lsaquo;</span></a>
                </li>
                <li class="page-item" dmx-class:disabled="list_product_groups.data.list_product_groups.page.current == 1" aria-label="Previous">
                  <a href="javascript:void(0)" class="page-link" dmx-on:click="list_groups.set('offset_groups',list_product_groups.data.list_product_groups.page.offset.prev)"><span aria-hidden="true">&lsaquo;</span></a>
                </li>
                <li class="page-item" dmx-class:active="title == list_product_groups.data.list_product_groups.page.current" dmx-class:disabled="!active" dmx-repeat="list_product_groups.data.list_product_groups.getServerConnectPagination(2,1,'...')">
                  <a href="javascript:void(0)" class="page-link" dmx-on:click="list_groups.set('offset_groups',(page-1)*list_product_groups.data.list_product_groups.limit)">{{title}}</a>
                </li>
                <li class="page-item" dmx-class:disabled="list_product_groups.data.list_product_groups.page.current ==  list_product_groups.data.list_product_groups.page.total" aria-label="Next">
                  <a href="javascript:void(0)" class="page-link" dmx-on:click="list_groups.set('offset_groups',list_product_groups.data.list_product_groups.page.offset.next)"><span aria-hidden="true">&rsaquo;</span></a>
                </li>
                <li class="page-item" dmx-class:disabled="list_product_groups.data.list_product_groups.page.current ==  list_product_groups.data.list_product_groups.page.total" aria-label="Last">
                  <a href="javascript:void(0)" class="page-link" dmx-on:click="list_groups.set('offset_groups',list_product_groups.data.list_product_groups.page.offset.last)"><span aria-hidden="true">&rsaquo;&rsaquo;</span></a>
                </li>
              </ul>
            </div>
            <div class="col-lg-1 col-xl-1 col-md-2 col-sm-2 col-3 offset-sm-5 offset-md-6 offset-lg-1"><select id="group_sort_limit" class="form-select" name="product_category_sort_limit">
                <option value="5">5</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
                <option value="''">{{trans.data.all[lang.value]}}</option>
              </select></div>
          </div>
          <div class="row">
            <div class="col">
              <div class="table-responsive">
                <table class="table table-hover table-sm table-borderless">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>{{trans.data.name[lang.value]}} | {{trans.data.department[lang.value]}}</th>
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_product_groups.data.list_product_groups.data" id="tableRepeat4">
                    <tr>
                      <td dmx-text="product_group_id"></td>
                      <td>
                        <form id="form3" is="dmx-serverconnect-form" method="post" action="dmxConnect/api/servo_product_groups/update_product_group.php" class="d-flex" dmx-on:success="list_product_groups.load({groupfilter: groupFilter.value, offset: list_groups.data.offset, limit: group_sort_limit.value})">
                          <input id="text3" name="product_group_name" type="text" class="form-control" dmx-bind:value="product_group_name">
                          <select id="select8" class="form-select ms-2" dmx-bind:options="list_departments.data.query_list_departments" optiontext="department_name" optionvalue="department_id" name="group_product_department" dmx-bind:value="group_product_department">
                            <option value="">---</option>
                          </select>
                          <input id="text4" name="product_group_id" type="text" class="form-control visually-hidden" dmx-bind:value="product_group_id">
                          <button id="btn3" class="btn text-success" type="submit">
                            <i class="fas fa-check"></i>
                          </button>
                        </form>
                      </td>
                      <td>
                        <button class="btn open" data-bs-target="#readProductGroupModal" dmx-on:click="readProductGroupModal.show();read_item_product_group.load({product_group_id: product_group_id})" dmx-bind:value="list_product_groups.data.list_product_groups[0].product_group_id" data-bs-toggle="modal"><i class="far fa-edit fa-sm"><br></i></button>
                      </td>
                      <td>

                        <form id="deleteProductGroup" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_product_groups/delete_product_group.php" dmx-on:success="notifies1.success('Success');list_product_groups.load({groupfilter: groupFilter.value, offset: list_groups.data.offset, limit: group_sort_limit.value})" dmx-on:error="notifies1.warning('Error')"><input id="productGroupId" name="product_group_id" type="text" class="form-control visually-hidden" dmx-bind:value="product_group_id"><button class="btn text-body" data-bs-target="#productInfo" type="submit"><i class="far fa-trash-alt fa-sm"><br></i></button></form>

                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane" id="tabPane1" role="tabpanel">
          <div class="row">
            <div class="col"></div>
          </div>
        </div>
      </div>

    </div>
  </main>
  <main class="mt-4">
    <div class="modal readitem" id="readProductGroupModal" is="dmx-bs5-modal" tabindex="-1">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="text-body">{{read_item_product_group.data.read_product_group.product_group_name}}</h3>

            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">


            <div class="row">
              <div class="col">
                <ul class="nav nav-tabs" id="navTabs3_tabs1" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="navTabs3_1_tab1" data-bs-toggle="tab" href="#" data-bs-target="#navTabs3_1" role="tab" aria-controls="navTabs1_1" aria-selected="true">{{trans.data.info[lang.value]}}</a>
                  </li>
                  <li class="nav-item">
                  </li>
                </ul>
                <div class="tab-content" id="navTabs3_content1">
                  <div class="tab-pane fade show active mt-2" id="navTabs3_1" role="tabpanel">
                    <div class="row justify-content-start border border-secondary ms-xxl-2 me-xxl-2 pt-xxl-2 pb-xxl-2 ps-xxl-2 pe-xxl-2 mt-3 ms-2 me-2 pt-1 pb-3 ps-1 pe-1">
                      <h4 class="mt-xxl-2 pt-2">{{trans.data.addProducts[lang.value]}}</h4>
                      <form id="createproductGroupItem" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_product_group_items/create_product_group_item.php" dmx-on:success="notifies1.success('Success');createproductGroupItem.reset();list_product_group_items.load({product_group_id: read_item_product_group.data.read_product_group.product_group_id})" dmx-on:error="notifies1.danger('Error!')" class="d-flex">
                        <div class="row row-cols-xl-9 justify-content-xl-start justify-content-start pt-3 row-cols-6">
                          <div class="d-flex flex-wrap col-9 col-sm-9 col-xxl-12 col-lg-12 col-xl-12">
                            <input id="groupProductId" name="product_group_product_id" type="text" class="form-control visually-hidden">
                            <input id="groupProductSearch" name="product_group_product" type="text" class="form-control mb-1 me-1" dmx-on:updated="list_item_products_for_group.load({productfilter: createproductGroupItem.groupProductSearch.value, offset: list_products_for_group.data.offset_group_product, limit: 5})" style="width: 120px !important;"><button id="btn15" class="btn mb-1 me-1 text-white bg-light" dmx-on:click="createproductGroupItem.groupProductSearch.setValue((''))">
                              <i class="fas fa-backspace"></i>
                            </button><input id="text6" name="product_group_product_quantity" type="number" class="form-control mb-1 me-1" dmx-bind:placeholder="trans.data.quantity[lang.value]" style="width: 80px !important;" min="" data-rule-min="1" data-msg-min="!"><input id="text7" name="product_group_product_unit_price" type="number" class="form-control mb-1 me-1" dmx-bind:placeholder="trans.data.price[lang.value]" style="width: 100% !important;"><input id="text8" name="product_group_product_group_id" type="number" class="form-control visually-hidden" dmx-bind:placeholder="trans.data.price[lang.value]" dmx-bind:value="read_item_product_group.data.read_product_group.product_group_id"><select id="select7" class="form-select mb-1 me-1" name="product_group_item_type" required="" data-msg-required="!">
                              <option value="Main">{{trans.data.Main[lang.value]}}</option>
                              <option value="Accessory">{{trans.data.Accessory[lang.value]}}</option>
                              <option value="Ingredient">{{trans.data.ingredient[lang.value]}}</option>
                            </select><button id="btn9" class="btn mb-1 bg-info text-white" type="submit">
                              <i class="fas fa-plus-circle"></i>
                            </button>

                          </div>
                        </div>


                      </form>
                    </div>
                    <div class="row mt-2" id="groupProductSelectList">
                      <div class="col border-secondary" dmx-hide="(createproductGroupItem.groupProductSearch.value == '')">
                        <ul class="pagination" dmx-populate="list_item_products_for_group.data.query_list_products" dmx-state="list_products_for_group" dmx-offset="offset_group_product" dmx-generator="bs5paging">
                          <li class="page-item" dmx-class:disabled="list_item_products_for_group.data.query_list_products.page.current == 1" aria-label="First">
                            <a href="javascript:void(0)" class="page-link" dmx-on:click="list_products_for_group.set('offset_group_product',list_item_products_for_group.data.query_list_products.page.offset.first)"><span aria-hidden="true">&lsaquo;&lsaquo;</span></a>
                          </li>
                          <li class="page-item" dmx-class:disabled="list_item_products_for_group.data.query_list_products.page.current == 1" aria-label="Previous">
                            <a href="javascript:void(0)" class="page-link" dmx-on:click="list_products_for_group.set('offset_group_product',list_item_products_for_group.data.query_list_products.page.offset.prev)"><span aria-hidden="true">&lsaquo;</span></a>
                          </li>
                          <li class="page-item" dmx-class:active="title == list_item_products_for_group.data.query_list_products.page.current" dmx-class:disabled="!active" dmx-repeat="list_item_products_for_group.data.query_list_products.getServerConnectPagination(2,1,'...')">
                            <a href="javascript:void(0)" class="page-link" dmx-on:click="list_products_for_group.set('offset_group_product',(page-1)*list_item_products_for_group.data.query_list_products.limit)">{{title}}</a>
                          </li>
                          <li class="page-item" dmx-class:disabled="list_item_products_for_group.data.query_list_products.page.current ==  list_item_products_for_group.data.query_list_products.page.total" aria-label="Next">
                            <a href="javascript:void(0)" class="page-link" dmx-on:click="list_products_for_group.set('offset_group_product',list_item_products_for_group.data.query_list_products.page.offset.next)"><span aria-hidden="true">&rsaquo;</span></a>
                          </li>
                          <li class="page-item" dmx-class:disabled="list_item_products_for_group.data.query_list_products.page.current ==  list_item_products_for_group.data.query_list_products.page.total" aria-label="Last">
                            <a href="javascript:void(0)" class="page-link" dmx-on:click="list_products_for_group.set('offset_group_product',list_item_products_for_group.data.query_list_products.page.offset.last)"><span aria-hidden="true">&rsaquo;&rsaquo;</span></a>
                          </li>
                        </ul>
                        <div class="table-responsive" id="groupProductList">
                          <table class="table table-hover table-sm">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>{{trans.data.product[lang.value]}}</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_item_products_for_group.data.query_list_products.data" id="tableRepeat1">
                              <tr>
                                <td dmx-text="product_id"></td>
                                <td dmx-text="product_name"></td>
                                <td>
                                  <button id="btn16" class="btn btn-outline-info" dmx-on:click="createproductGroupItem.groupProductId.setValue(product_id);createproductGroupItem.groupProductSearch.setValue(product_name)"><i class="fas fa-plus fa-lg"></i>
                                  </button>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col mt-xl-2">
                        <div class="table-responsive">
                          <table class="table table-hover table-sm">
                            <thead>
                              <tr>
                                <th>{{trans.data.product[lang.value]}}</th>
                                <th>{{trans.data.quantity[lang.value]}}</th>
                                <th>{{trans.data.price[lang.value]}}</th>
                                <th></th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_product_group_items.data.list_product_groups_items" id="tableRepeat3">
                              <tr>
                                <td dmx-text="product_name"></td>
                                <td>
                                  <form id="updateProductGroupItemQuantity" method="post" is="dmx-serverconnect-form" class="d-flex" action="dmxConnect/api/servo_product_group_items/update_product_group_item_quantity.php" dmx-on:success="list_product_group_items.load();notifies1.success('Success!')">

                                    <input id="text11" name="product_group_product_quantity" type="number" class="form-control" dmx-bind:value="product_group_product_quantity" min="" data-rule-min="1" data-msg-min="!">
                                    <input id="text111" name="product_group_item_id" type="text" class="form-control visually-hidden" dmx-bind:value="product_group_item_id">
                                    <button id="btn11" class="btn text-success" type="submit"><i class="fas fa-check"></i>
                                    </button>
                                  </form>
                                </td>
                                <td>
                                  <form id="updateProductGroupItemPrice" method="post" is="dmx-serverconnect-form" class="d-flex" action="dmxConnect/api/servo_product_group_items/update_product_group_item_price.php" dmx-on:success="list_product_group_items.load();notifies1.success('Success!')">

                                    <input id="text9" name="product_group_product_unit_price" type="number" class="form-control" dmx-bind:value="product_group_product_unit_price">
                                    <input id="text10" name="product_group_item_id" type="text" class="form-control visually-hidden" dmx-bind:value="product_group_item_id">
                                    <button id="btn10" class="btn text-success" type="submit"><i class="fas fa-check"></i>
                                    </button>
                                  </form>

                                </td>
                                <td>
                                  <form id="updateProductGroupItemType" method="post" is="dmx-serverconnect-form" class="d-flex" action="dmxConnect/api/servo_product_group_items/update_product_group_item_type.php" dmx-on:success="list_product_group_items.load();notifies1.success('Success!')">

                                    <select id="select9" class="form-select" name="product_group_item_type" dmx-bind:value="product_group_item_type">
                                      <option value="Main">{{trans.data.Main[lang.value]}}</option>
                                      <option value="Accessory">{{trans.data.Accessory[lang.value]}}</option>
                                      <option value="Ingredient">{{trans.data.ingredient[lang.value]}}</option>
                                    </select>

                                    <input id="text14" name="product_group_item_id" type="text" class="form-control visually-hidden" dmx-bind:value="product_group_item_id">
                                    <button id="btn13" class="btn text-success" type="submit"><i class="fas fa-check"></i>
                                    </button>
                                  </form>

                                </td>
                                <td>
                                  <form id="deleteProductGroupItem" method="post" is="dmx-serverconnect-form" class="d-flex" action="dmxConnect/api/servo_product_group_items/delete_product_group_item.php" dmx-on:success="list_product_group_items.load();notifies1.success('Success!')">

                                    <input id="text12" name="product_group_item_id" type="text" class="form-control visually-hidden" dmx-bind:value="product_group_item_id">
                                    <button id="btn12" class="btn text-muted" type="submit"><i class="far fa-trash-alt"></i>
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
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <form id="form4" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_products/delete_product.php" dmx-on:success="notifies1.success('Success');readItemModal.hide();list_item_products.load()" onsubmit=" return confirm('CONFIRM DELETE?');">
              <input id="text5" name="product_id1" type="hidden" class="form-control" dmx-bind:value="read_item_product.data.query_read_product.product_id">

              <button id="btn5" class="btn text-muted" type="submit">
                <i class="far fa-trash-alt fa-sm"></i>
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="modal readitem" id="readItemModal" is="dmx-bs5-modal" tabindex="-1" style="" nocloseonclick="true">
      <div class="modal-dialog modal-xl modal-fullscreen-xxl-down modal-dialog-scrollable" role="document" style="margin: 0px !important; width: 100% !important; height: 99% !important; max-width: 100% !important; max-height: 99% !important;">
        <div class="modal-content" style="max-height: 100% !important; height: 100% !important;">
          <div class="modal-header ">
            <div class="d-block d-flex float-start">

              <h5 class="text-body float-start rounded mt-2 me-2 pt-2 pb-2 ps-3 pe-3 bg-light">{{read_item_product.data.query_read_product.product_name}}</h5>
              <div class="d-block d-flex float-start">
                <h5 class="mt-2 me-0 pt-2 pb-2 ps-3 pe-3">{{trans.data.currentStock[lang.value]}}</h5>
                <h5 class="bg-secondary rounded float-start mt-2 pt-2 pb-2 ps-3 pe-3 text-white" dmx-text="(getStockValuesProduct.data.getStockValuesProduct[0].TotalPurchased)-(getStockValuesProduct.data.getStockValuesProduct[0].TotalSold)-(getStockValuesProduct.data.getStockValuesProduct[0].TotalAdjusted)" dmx-class:bg-danger="((getStockValuesProduct.data.getStockValuesProduct[0].TotalPurchased)-(getStockValuesProduct.data.getStockValuesProduct[0].TotalSold)-(getStockValuesProduct.data.getStockValuesProduct[0].TotalAdjusted))&lt;=read_item_product.data.query_read_product.product_min_stock" dmx-class:bg-success="((getStockValuesProduct.data.getStockValuesProduct[0].TotalPurchased)-(getStockValuesProduct.data.getStockValuesProduct[0].TotalSold)-(getStockValuesProduct.data.getStockValuesProduct[0].TotalAdjusted))&gt;read_item_product.data.query_read_product.product_min_stock" id="currentProductStock">{{read_item_product.data.query_read_product.product_name}}</h5>
              </div>

            </div>


            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">


            <div class="row">
              <div class="col">
                <ul class="nav nav-tabs nav-justified fw-bold text-body" id="navTabs2_tabs" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="navTabs2_1_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs2_1" role="tab" aria-controls="navTabs1_1" aria-selected="true"><i class="fas fa-info" style="margin-right: 2px"></i>
                      {{trans.data.info[lang.value]}}</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="navTabs2_2_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs2_2" role="tab" aria-controls="navTabs1_2" aria-selected="false"><i class="far fa-money-bill-alt" style="margin-right: 2px"></i>
                      {{trans.data.prices[lang.value]}}</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="navTabs2_3_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs2_3" role="tab" aria-controls="navTabs1_3" aria-selected="false"><i class="fas fa-chart-line"></i></a>
                  </li>
                </ul>
                <div class="tab-content" id="navTabs2_content">
                  <div class="tab-pane fade show active mt-2" id="navTabs2_1" role="tabpanel">
                    <div class="row mt-2 mt-sm-2 mt-md-2 mt-lg-2 mt-xl-2 mt-xxl-2">
                      <div class="col-xl-4 col-12 text-sm-center text-center text-md-center rounded rounded-1 border-light pt-2 pb-2 col-lg-5 col-md-4"><img dmx-bind:src="'/servo/uploads/product_pictures/'+read_item_product.data.query_read_product.product_picture" class="img-fluid rounded-0" width="300" dmx-hide="(read_item_product.data.query_read_product.product_picture == null)" loading="lazy">
                        <img class="rounded-circle img-fluid" width="300" src="uploads/servo_no_image.jpg" dmx-show="(read_item_product.data.query_read_product.product_picture == null)">
                        <div class="row">
                          <div class="col">
                            <form id="deleteProductPicture" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_products/delete_product_picture.php" dmx-on:success="notifies1.success('Success!');read_item_product.load({product_id: read_item_product.data.query_read_product.product_id})" dmx-hide="(read_item_product.data.query_read_product.product_picture == null)">
                              <input id="product_id_delete" name="product_id" type="text" class="form-control visually-hidden" dmx-bind:value="read_item_product.data.query_read_product.product_id"><input id="product_picture_file_delete" name="product_picture_file" type="text" class="form-control visually-hidden" dmx-bind:value="read_item_product.data.query_read_product.product_picture">
                              <input id="product_picture_ref_delete" name="product_picture_ref" type="text" class="form-control visually-hidden" dmx-bind:value="NULL">
                              <input id="product_picture_delete" name="product_picture" type="text" class="form-control visually-hidden" dmx-bind:value="null">
                              <button id="btn5" class="btn mt-2 text-danger" type="submit">
                                <i class="far fa-trash-alt fa-lg"></i>
                              </button>
                            </form>

                          </div>
                        </div>
                        <div class="row" id="replacePicture" dmx-show="(read_item_product.data.query_read_product.product_picture == null)">

                          <div class="col text-xxl-center text-center">
                            <div class="row mt-2">
                              <form id="replaceProductPicture" class="d-flex" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_products/replace_product_picture.php" dmx-on:success="notifies1.success('Success!');read_item_product.load({product_id: read_item_product.data.query_read_product.product_id});replaceProductPicture.reset()"><input id="text4" name="product_picture" type="text" class="form-control visually-hidden">
                                <input id="text5" name="product_id" type="text" class="form-control visually-hidden" dmx-bind:value="read_item_product.data.query_read_product.product_id"><input name="product_picture_file" type="file" class="form-control" required="" data-rule-maxfiles="1" accept=".jpg, .png">
                                <button id="btn7" class="btn ms-xxl-2 ms-xl-2 ms-lg-2 ms-md-2 ms-sm-2 ms-2 text-white bg-info" type="submit" dmx-show="replaceProductPicture.product_picture_file.value+'!='+null">
                                  <i class="fas fa-upload"></i>
                                </button>
                              </form>
                            </div>
                          </div>


                        </div>
                      </div>
                      <div class="bg-secondary rounded mt-2 ms-2 me-2 pt-3 pb-3 ps-3 pe-3 col-12 col-lg-6 col-md-7">
                        <form is="dmx-serverconnect-form" id="readitem" method="post" action="dmxConnect/api/servo_products/update_product.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="read_item_product.data.query_delete_product" dmx-on:success="notifies1.success('Success');list_item_products.load();read_item_product.load({product_id: read_item_product.data.query_read_product.product_id})">
                          <div class="mb-3 row">
                            <label for="inp_product_id" class="col-sm-2 col-form-label">&nbsp;#</label>
                            <div class="col-sm-10">
                              <input type="number" class="form-control" id="inp_product_id" name="product_id" dmx-bind:value="read_item_product.data.query_read_product.product_id" aria-describedby="inp_product_id_help" readonly="true">
                            </div>
                          </div>
                          <div class="mb-3 row">
                            <label for="inp_product_name" class="col-sm-2 col-form-label">{{trans.data.name[lang.value]}}</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="inp_product_name" name="product_name" dmx-bind:value="read_item_product.data.query_read_product.product_name" aria-describedby="inp_product_name_help" style="width: 300px !important">
                            </div>
                          </div>
                          <div class="mb-3 row">
                            <label for="product_price" class="col-sm-2 col-form-label">{{trans.data.brandName[lang.value]}}</label>
                            <div class="col-sm-10">
                              <select id="select1" class="form-select" name="servo_product_brands_product_brand_id" dmx-bind:options="load_brands.data.query" optiontext="product_brand_name" optionvalue="product_brand_id" dmx-bind:value="read_item_product.data.query_read_product.product_brand_id">
                                <option value="{{null}}">----</option>
                              </select>
                            </div>
                          </div>
                          <div class="mb-3 row">
                            <label for="product_price" class="col-sm-2 col-form-label">{{trans.data.category[lang.value]}}</label>
                            <div class="col-sm-10">
                              <select id="select2" class="form-select" name="servo_product_category_product_category_id" dmx-bind:value="read_item_product.data.query_read_product.product_categories_id" dmx-bind:options="load_product_categories.data.query" optiontext="product_category_name" optionvalue="product_categories_id" dmx-on:changed="loadProductSubCategoriesPerCategory.load({product_category_id: readitem.select2.selectedValue})">
                                <option value="{{null}}">----</option>
                              </select>
                            </div>
                          </div>
                          <div class="mb-3 row">
                            <label for="produtSubCat1" class="col-sm-2 col-form-label">{{trans.data.category[lang.value]}}</label>
                            <div class="col-sm-10">
                              <select id="produtSubCat1" class="form-control" name="product_sub_category_sub_category_id" dmx-bind:options="loadProductSubCategoriesPerCategory.data.query_list_product_sub_categories" optionvalue="product_sub_category_id" dmx-bind:value="read_item_product.data.query_read_product.product_sub_category_sub_category_id" optiontext="product_sub_category_name">
                                <option selected="" value="{{null}}">----</option>
                              </select>
                            </div>
                          </div>
                          <div class="mb-3 row">
                            <label for="inp_product_description" class="col-sm-2 col-form-label">{{trans.data.description[lang.value]}}</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="inp_product_description" name="product_description" dmx-bind:value="read_item_product.data.query_read_product.product_description" aria-describedby="inp_product_description_help" placeholder="Enter Description" style="}: ;">
                            </div>
                          </div>
                          <div class="mb-3 row">
                            <label for="inp_product_minstock" class="col-sm-2 col-form-label">{{trans.data.minStock[lang.value]}}</label>
                            <div class="col-sm-10">
                              <input type="number" class="form-control" id="inp_product_minstock" name="product_min_stock" dmx-bind:value="read_item_product.data.query_read_product.product_min_stock" aria-describedby="inp_product_description_help" style="}: ;">
                            </div>
                          </div>
                          <div class="mb-3 row">
                            <label for="inpMinStock" class="col-sm-2 col-form-label">{{trans.data.type[lang.value]}}</label>
                            <div class="col-sm-10">
                              <select id="select4" class="form-select" name="product_type" dmx-bind:value="read_item_product.data.query_read_product.product_type" optiontext="read_item_product.data.query_read_product.product_type" optionvalue="read_item_product.data.query_read_product.product_type" dmx-bind:options="read_item_product.data.query_read_product.product_type">
                                <option value=""></option>
                                <option value="Store">{{trans.data.Store[lang.value]}}</option>
                                <option value="Stock">{{trans.data.Stock[lang.value]}}</option>
                                <option value="Service">{{trans.data.service[lang.value]}}</option>
                              </select>
                            </div>
                          </div>

                          <div class="mb-3 row">

                            <div class="col-sm-10">
                              <button type="submit" class="btn text-white bg-info" dmx-bind:value="read_item_product.data.query_delete_product.Save">{{trans.data.update[lang.value]}}</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade mt-2" id="navTabs2_2" role="tabpanel">
                    <h5 class="mt-2 mt-xxl-2 mt-xl-2 mt-lg-2 mt-md-2 mt-sm-2">{{trans.data.setPrice[lang.value]}}</h5>
                    <div class="row mt-3 justify-content-center">
                      <form id="createServicePrice" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_product_prices/create_product_price.php" dmx-on:success="createServicePrice.reset();load_product_prices.load({});notifies1.success('Success')" dmx-on:error="notifies1.danger('Error!')" class="d-flex">
                        <div class="row justify-content-end">

                          <div class="col">
                            <div class="mb-3 row">
                              <div class="col-sm-10">
                                <select id="select5" class="form-select" dmx-bind:options="load_services.data.query_list_services" optiontext="service_name" optionvalue="service_id" name="servo_service_service_id" required="" data-msg-required="!">
                                  <option selected="" value="">---</option>
                                </select>
                                <small id="select5Help" class="form-text text-muted">{{trans.data.service[lang.value]}}</small>
                              </div>
                            </div>
                          </div>
                          <div class="col">
                            <div class="mb-3 row">
                              <div class="col-sm-10">
                                <input type="number" class="form-control" id="input1" name="product_price" aria-describedby="input1_help" required="" data-msg-required="!" min="" data-rule-min="0">
                                <small id="input1_help" class="form-text text-muted">{{trans.data.price[lang.value]}}</small>
                              </div>
                            </div>
                          </div>
                          <input id="productPriceProductId" name="product_price_product_id" type="text" class="form-control visually-hidden" dmx-bind:value="read_item_product.data.query_read_product.product_id">
                          <input id="productPriceDate" name="product_price_date" type="datetime-local" class="form-control visually-hidden" dmx-bind:value="dateTime.datetime">
                          <input id="productPriceCode" name="product_price_code" class="form-control visually-hidden" dmx-bind:value="read_item_product.data.query_read_product.product_id+'@'+createServicePrice.select5.value">
                          <div class="col">
                            <button id="btn4" class="btn text-white bg-info" type="submit">
                              <i class="fas fa-plus-circle"></i>
                            </button>
                          </div>
                        </div>
                      </form>
                    </div>

                    <div class="row">
                      <div class="col">
                        <div class="table-responsive">
                          <table class="table table-hover table-sm">
                            <thead>
                              <tr>

                                <th>{{trans.data.dateTime[lang.value]}}</th>
                                <th>{{trans.data.service[lang.value]}}</th>
                                <th>{{trans.data.price[lang.value]}}</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="load_product_prices.data.query_list_product_prices" id="productPricesTable">
                              <tr>
                                <td dmx-text="product_price_date"></td>
                                <td dmx-text="service_name"></td>
                                <td>
                                  <form id="productPriceSet1" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_product_prices/update_product_price.php" dmx-on:success="productPriceSet.reset();notifies1.success('Success!');load_product_prices.load({});load_departments.load({})" class="d-flex">
                                    <div class="row">
                                      <div class="col d-flex">
                                        <input id="productPriceUpdate" name="product_price" type="number" class="form-control" dmx-bind:value="product_price">
                                        <input id="productPriceDate2" name="product_price_date" type="datetime-local" class="form-control visually-hidden" dmx-bind:value="dateTime.datetime">
                                        <input id="productPriceId" name="product_price_id" type="text" class="form-control visually-hidden" dmx-bind:value="product_price_id"><button id="btn7" class="btn text-success ms-2" type="submit">
                                          <i class="fas fa-check"></i>
                                        </button>
                                      </div>
                                    </div>
                                  </form>
                                </td>
                                <td class="text-center">
                                  <form id="deletePrice" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_product_prices/delete_product_price.php" dmx-on:success="productPriceSet.reset();notifies1.success('Success!');load_product_prices.load({});load_departments.load({})">
                                    <div class="row">
                                      <div class="col">
                                        <input id="productPriceId1" name="product_price_id" type="text" class="form-control visually-hidden" dmx-bind:value="product_price_id"><button id="btn8" class="btn text-muted ms-2" type="submit">
                                          <i class="far fa-trash-alt fa-sm"></i>
                                        </button>
                                      </div>
                                    </div>
                                  </form>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>

                  </div>
                  <div class="tab-pane fade mt-2" id="navTabs2_3" role="tabpanel">
                    <div class="row justify-content-center mt-2 mt-sm-2 mt-md-2 mt-lg-2 mt-xl-2 mt-xxl-2">
                      <form autosubmit="true" id="formfilter" class="d-flex">
                        <div class="row justify-content-center">

                          <div class="col"><input id="date_start" name="date_start" type="datetime-local" class="form-control mb-2 me-xl-2" dmx-bind:max="formfilter.date_end.value" dmx-bind:value="getDate()"></div>
                          <div class="col"><input id="date_end" name="date_end" type="datetime-local" class="form-control mb-2 me-xl-2" dmx-bind:min="formfilter.date_start.value" dmx-bind:value=""></div>
                          <div class="col"><button id="btn14" class="btn text-white bg-info" dmx-on:click="product_sales_single.load({date_start: formfilter.date_start.value, date_end: formfilter.date_end.value, product_id: read_item_product.data.query_read_product.product_id});product_purchases_received_single.load({date_start: formfilter.date_start.value, date_end: formfilter.date_end.value, product_id: read_item_product.data.query_read_product.product_id});product_adjustment_single.load({date_start: formfilter.date_start.value, date_end: formfilter.date_end.value, product_id: read_item_product.data.query_read_product.product_id});product_sales_price_variation.load({date_start: formfilter.date_start.value, date_end: formfilter.date_end.value, product_id: read_item_product.data.query_read_product.product_id})">
                              <i class="fas fa-chart-line fa-lg"></i>
                            </button></div>
                        </div>

                      </form>

                    </div>

                    <div class="row mt-3" id="productReportSales">
                      <h3>{{trans.data.sales[lang.value]}}</h3>

                      <div class="col-xxl col-xxl-3 col-12 col-sm-8 col-lg-2 mb-2">
                        <div class="row">
                          <div class="text-center ms-2 me-3 pt-2 col-12 border-start border-warning border-3">
                            <h4 class="fw-bold">{{product_sales_single.data.query_product_sale_single.sum(`order_item_quantity`).formatNumber('0', ',', ',')}}</h4>
                            <h5>{{trans.data.volume[lang.value]}}</h5>
                          </div>
                        </div>
                        <div class="row mt-2">
                          <div class="bg-secondary ms-2 pt-2 col-12 border-start border-3 border-info">
                            <h4 class="text-center text-info fw-bold">{{product_sales_single.data.query_product_sale_single.sum(`(order_item_quantity * order_item_price)`).formatNumber('0', ',', ',')}}</h4>
                            <h5 class="text-center text-info">{{trans.data.total[lang.value]}}</h5>
                          </div>
                        </div>
                        <div class="row mt-2">
                          <div class="bg-secondary ms-2 pt-2 col-12 border-start border-3 border-light">
                            <h4 class="text-center fw-bold text-success">{{(salesTotal.value / salesVolume.value).formatNumber('0', ',', ',')}}</h4>
                            <h5 class="text-center text-body">{{trans.data.averageSalesPrice[lang.value]}}</h5>
                          </div>
                        </div>

                      </div>
                      <div class="ps-2 pe-2 col-lg-4">
                        <dmx-chart id="chart1" dmx-bind:data="product_sales_single.data.query_product_sale_single" dataset-1:value="AMOUNT" dataset-1:tooltip="trans.data.sales[lang.value]" dataset-1:label="" responsive="true" points="true" labels="order_time_ordered" dataset-2:value="" smooth="true" thickness="1"></dmx-chart>
                        <h3 class="text-center text-warning">{{trans.data.performance[lang.value]}}</h3>
                      </div>
                      <div class="ps-2 pe-2 col-lg-4">
                        <dmx-chart id="chart2" dataset-1:value="order_item_quantity" dataset-1:tooltip="'Volume'" dataset-1:label="" responsive="true" points="true" dmx-bind:data="product_sales_single.data.query_product_sale_single" dataset-2:value="order_item_quantity" labels="order_time_ordered" type="area" dataset-1=""></dmx-chart>
                        <h3 class="text-warning text-center">{{trans.data.volume[lang.value]}}</h3>
                      </div>


                    </div>
                    <div class="row">
                      <div class="col-lg-2"></div>
                      <div class="ps-2 pe-2 col-lg-4">
                        <dmx-chart id="chart6" dataset-1:value="order_item_price" dataset-1:tooltip="" dataset-1:label="Price" responsive="true" points="true" dmx-bind:data="product_sales_price_variation.data.query_product_sale_single" dataset-2:value="order_item_quantity" type="pie" dataset-1="" point-size="" cutout="" legend="top" labels="order_item_price"></dmx-chart>
                        <h3 class="text-warning text-center">{{trans.data.prices[lang.value]}}</h3>
                      </div>
                      <div class="ps-2 pe-2 col-lg-4">
                        <dmx-chart id="chart7" dataset-1:value="order_item_price" dataset-1:tooltip="" dataset-1:label="Price" responsive="true" points="true" dataset-2:value="order_item_quantity" type="bar" dataset-1="" point-size="" dmx-bind:data="product_sales_price_variation.data.query_product_sale_single" cutout="" labels="'Price'" dataset-2="" multicolor="true" nogrid="true"></dmx-chart>
                      </div>
                    </div>
                    <div class="row" id="productSalesTable">
                      <div class="col bg-secondary rounded ms-0 me-0">
                        <div class="table-responsive">
                          <table class="table table-hover table-sm">
                            <thead class="fw-bold">
                              <tr>
                                <th>#</th>
                                <th>{{trans.data.Ordered[lang.value]}}</th>
                                <th>{{trans.data.Processing[lang.value]}}</th>
                                <th>{{trans.data.Ready[lang.value]}}</th>
                                <th>{{trans.data.delivered[lang.value]}}</th>
                                <th>{{trans.data.status[lang.value]}}</th>
                                <th>{{trans.data.order[lang.value]}}</th>


                                <th>{{trans.data.discount[lang.value]}}</th>

                                <th>{{trans.data.dateTime[lang.value]}}</th>
                                <th>{{trans.data.shift[lang.value]}}</th>
                                <th>{{trans.data.quantity[lang.value]}}</th>
                                <th>{{trans.data.price[lang.value]}}</th>
                                <th>{{trans.data.customer[lang.value]}}</th>
                              </tr>
                            </thead>
                            <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="product_sales_single.data.query_product_sale_single" id="tableRepeat6">
                              <tr>
                                <td dmx-text="order_item_id"></td>
                                <td dmx-text="order_time_ordered"></td>
                                <td dmx-text="order_time_processing"></td>
                                <td dmx-text="order_time_ready"></td>
                                <td dmx-text="order_time_delivered"></td>
                                <td dmx-text="order_item_status"></td>
                                <td dmx-text="servo_orders_order_id"></td>


                                <td dmx-text="order_item_discount"></td>

                                <td dmx-text="order_time"></td>
                                <td dmx-text="servo_shift_shift_id"></td>

                                <td dmx-text="order_item_quantity"></td>
                                <td dmx-text="order_item_price"></td>
                                <td dmx-text="customer_first_name"></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                    <div class="row mt-2 justify-content-md-center bg-secondary justify-content-xl-center justify-content-xxl-center rounded">
                      <div class="border-3 border-success justify-content-xxl-center mb-xxl-2 me-xxl-1 mb-1 ms-2 pt-2 mb-sm-1 col-xxl-6 col-5 col-lg-3">
                        <h2 class="text-center fw-bold text-md-center text-warning" dmx-text="(salesPriceAverage.value - purchasePriceAverage.value).round(2).formatNumber('0',',',',')"></h2>
                        <h5 class="text-center text-body">{{trans.data.unitMargin[lang.value]}}</h5>
                      </div>
                      <div class="border-3 mb-1 ms-2 pt-2 mb-xxl-1 me-xxl-1 col-xxl-6 col-5 border-success col-lg-3">
                        <h2 class="text-center fw-bold text-md-center text-warning" dmx-text="(unitMargin.value * salesVolume.value).formatNumber('0', ',', ',')"></h2>
                        <h5 class="text-center text-body">{{trans.data.profit[lang.value]}}</h5>
                      </div>
                    </div>

                    <div class="row mt-3" id="productReportPurchases">
                      <h3>{{trans.data.purchases[lang.value]}}</h3>

                      <div class="col-xxl col-12 col-sm-8 mb-2 col-xxl-2 col-lg-2">
                        <div class="row">
                          <div class="text-center ms-2 me-3 pt-2 col-12 border-start border-warning border-3">
                            <h4 class="fw-bold">{{product_purchases_received_single.data.product_purchases_received_single.sum(`po_item_quantity`).formatNumber('0', ',', ',')}}</h4>
                            <h5>{{trans.data.volume[lang.value]}}</h5>
                          </div>
                        </div>
                        <div class="row mt-2">
                          <div class="bg-secondary ms-2 pt-2 col-12 border-start border-3 border-success">
                            <h4 class="text-center text-success fw-bold">{{product_purchases_received_single.data.product_purchases_received_single.sum(`(po_item_quantity * po_item_price)`).formatNumber('0', ',', ',')}}</h4>
                            <h5 class="text-center text-success">{{trans.data.total[lang.value]}}</h5>
                          </div>
                        </div>
                        <div class="row mt-2">
                          <div class="ms-2 pt-2 col-12 border-start border-3 border-light">
                            <h4 class="text-center fw-bold text-success">{{(purchasesTotal.value / purchasesVolume.value).formatNumber('0',',',',')round(2).default(0)}}</h4>
                            <h5 class="text-center text-body">{{trans.data.averagePurchasePrice[lang.value]}}</h5>
                          </div>
                        </div>
                      </div>
                      <div class="ps-2 pe-2 col-lg-4">
                        <dmx-chart id="chart3" dmx-bind:data="product_purchases_received_single.data.product_purchases_received_single" dataset-1:value="AMOUNT" dataset-1:tooltip="" dataset-1:label="" responsive="true" points="true" dataset-2:value="" smooth="true" thickness="1" labels="time_received"></dmx-chart>
                        <h3 class="text-center text-warning">{{trans.data.history[lang.value]}}</h3>
                      </div>
                      <div class="ps-2 pe-2 col-lg-4">
                        <dmx-chart id="chart4" dataset-1:value="po_item_quantity" dataset-1:tooltip="" dataset-1:label="" responsive="true" points="true" dmx-bind:data="product_purchases_received_single.data.product_purchases_received_single" dataset-2:value="order_item_quantity" type="area" labels="time_received"></dmx-chart>
                        <h3 class="text-center text-warning">{{trans.data.volume[lang.value]}}</h3>
                      </div>
                      <div class="col"></div>
                    </div>
                    <div class="row bg-secondary rounded ms-0 me-0" id="productPurchasesTable">
                      <div class="col">
                        <div class="table-responsive">
                          <table class="table table-hover table-sm">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>{{trans.data.quantity[lang.value]}}</th>
                                <th>{{trans.data.price[lang.value]}}</th>
                                <th>{{trans.data.note[lang.value]}}</th>

                                <th>#</th>
                                <th>{{trans.data.dateTime[lang.value]}}</th>
                                <th>{{trans.data.status[lang.value]}}</th>
                              </tr>
                            </thead>
                            <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="product_purchases_received_single.data.product_purchases_received_single" id="tableRepeat5">
                              <tr>
                                <td dmx-text="po_id"></td>
                                <td dmx-text="po_item_quantity"></td>
                                <td dmx-text="po_item_price"></td>
                                <td dmx-text="po_item_notes"></td>
                                <td dmx-text="po_item_id"></td>

                                <td dmx-text="time_ordered"></td>
                                <td dmx-text="po_status"></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>

                    <div class="row mt-3" id="productReportAdjustment">
                      <h3 class="text-warning">{{trans.data.adjustments[lang.value]}}</h3>


                      <div class="col-xxl col-xxl-3 col-12 col-sm-8 col-lg-2 mb-2">
                        <div class="row">
                          <div class="text-center ms-2 me-3 pt-2 col-12 border-start border-3 border-danger">
                            <h4 class="text-danger fw-bold">{{product_adjustment_single.data.query_product_adjustment_single.sum(`order_item_quantity`).formatNumber('0', ',', ',')}}</h4>
                            <h4>{{trans.data.volume[lang.value]}}</h4>
                          </div>
                        </div>
                        <div class="row mt-2">
                          <div class="bg-secondary ms-2 pt-2 col-12 border-start border-3 border-danger">
                            <h4 class="text-center text-danger fw-bold">{{(product_adjustment_single.data.query_product_adjustment_single.sum(`order_item_quantity`) * purchasePriceAverage.value).formatNumber('0', ',', ',')}}</h4>
                            <h4 class="text-center text-body">{{trans.data.total[lang.value]}}</h4>
                          </div>
                        </div>
                      </div>
                      <div class="ps-2 pe-2 col-lg-4">
                        <dmx-chart id="chart5" dmx-bind:data="product_adjustment_single.data.query_product_adjustment_single" dataset-1:value="(order_item_quantity * purchasePriceAverage.value)" dataset-1:tooltip="'Volume'" dataset-1:label="" responsive="true" points="true" labels="order_time_ordered" dataset-2:value="" smooth="true" thickness="1"></dmx-chart>
                        <h3 class="text-warning text-center">{{trans.data.total[lang.value]}}</h3>
                      </div>
                      <div class="ps-2 pe-2 col-lg-4"></div>
                      <div class="col"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer bg-body">
        <form id="form1" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_products/delete_product.php" dmx-on:success="notifies1.success('Success');readItemModal.hide();list_item_products.load()" onsubmit=" return confirm('CONFIRM DELETE?');">
          <input id="text1" name="product_id" type="hidden" class="form-control" dmx-bind:value="read_item_product.data.query_read_product.product_id">

          <button id="btn6" class="btn text-body" type="submit">
            <i class="far fa-trash-alt fa-lg"></i>
          </button>
        </form>
      </div>
    </div>
    <div class="modal create-modal" id="createItemModal" is="dmx-bs5-modal" tabindex="-1">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{trans.data.newProduct[lang.value]}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col">
                <ul class="nav nav-tabs" id="navTabs1_tabs" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="navTabs1_1_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_1" role="tab" aria-controls="navTabs1_1" aria-selected="true">{{trans.data.product[lang.value]}}</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="navTabs1_2_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_2" role="tab" aria-controls="navTabs1_2" aria-selected="false">{{trans.data.group[lang.value]}}</a>
                  </li>
                </ul>
                <div class="tab-content" id="navTabs1_content">
                  <div class="tab-pane fade show active mt-2" id="navTabs1_1" role="tabpanel">
                    <form is="dmx-serverconnect-form" id="serverconnectFormCreateProduct" method="post" action="dmxConnect/api/servo_products/create_product.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-on:success="notifies1.success('Success');serverconnectFormCreateProduct.reset();list_item_products.load({productfilter: productSearch.value, offset: list_products.data.offset, limit: product_sort_limit.value});createItemModal.hide()" dmx-on:error="notifies1.danger('Error!')">
                      <div class="mb-3 row">
                        <label for="inp_product_name" class="col-sm-2 col-form-label"><b>{{trans.data.name[lang.value]}}</b></label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inp_product_name1" name="product_name" aria-describedby="inp_product_name_help">
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <label for="inp_servo_product_brands_product_brand_id" class="col-sm-2 col-form-label">{{trans.data.brandName[lang.value]}}</label>
                        <div class="col-sm-10">
                          <select id="inp_servo_product_brands_product_brand_id" class="form-control" name="servo_product_brands_product_brand_id" dmx-bind:options="load_brands.data.query" optiontext="product_brand_name" optionvalue="product_brand_id">
                            <option selected="" value="{{null}}">----</option>
                          </select>
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <label for="inp_servo_product_categories" class="col-sm-2 col-form-label">{{trans.data.category[lang.value]}}</label>
                        <div class="col-sm-10">
                          <select id="inp_servo_product_categories" class="form-control" name="servo_product_category_product_category_id" dmx-bind:options="load_product_categories.data.query" optiontext="product_category_name" optionvalue="product_categories_id" dmx-on:updated="loadProductSubCategoriesPerCategory.load({product_category_id: serverconnectFormCreateProduct.inp_servo_product_categories.selectedValue})">
                            <option selected="" value="{{null}}">----</option>
                          </select>
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <label for="productSubCat2" class="col-sm-2 col-form-label">{{trans.data.category[lang.value]}}</label>
                        <div class="col-sm-10">
                          <select id="productSubCat2" class="form-control" name="product_sub_category_sub_category_id" dmx-bind:options="loadProductSubCategoriesPerCategory.data.query_list_product_sub_categories" optiontext="product_sub_category_name" optionvalue="product_sub_category_id">
                            <option selected="" value="{{null}}">----</option>
                          </select>
                        </div>
                      </div>

                      <div class="mb-3 row">
                        <label for="inp_product_description" class="col-sm-2 col-form-label">{{trans.data.description[lang.value]}}</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inp_product_description2" name="product_description" aria-describedby="inp_product_description_help">
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <label for="inpMinStock" class="col-sm-2 col-form-label">{{trans.data.minStock[lang.value]}}</label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control" id="inpMinStock" name="product_min_stock">
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <label for="inpMinStock1" class="col-sm-2 col-form-label">{{trans.data.picture[lang.value]}}</label>
                        <div class="col-sm-10">
                          <input id="file1" name="product_picture_file" type="file" class="form-control">
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <label for="inp_product_type" class="col-sm-2 col-form-label">{{trans.data.type[lang.value]}}</label>
                        <div class="col-sm-10">
                          <select id="select3" class="form-select" name="product_type">
                            <option value="Store">{{trans.data.Store[lang.value]}}</option>
                            <option value="Stock">{{trans.data.Stock[lang.value]}}</option>
                            <option value="Service">{{trans.data.service[lang.value]}}</option>
                          </select>
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <div class="col-sm-2">&nbsp;</div>
                        <div class="col-sm-10">
                          <button type="submit" class="btn btn-primary">{{trans.data.ok[lang.value]}}</button>
                        </div>
                      </div>
                    </form>
                  </div>

                  <div class="tab-pane fade mt-2" id="navTabs1_2" role="tabpanel">
                    <form is="dmx-serverconnect-form" id="createProductGroup" method="post" action="dmxConnect/api/servo_product_groups/create_product_group.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-on:success="list_product_groups.load({groupfilter: groupFilter.value, offset: list_groups.data.offset, limit: group_sort_limit.value}); createItemModal.hide()">
                      <div class="mb-3 row">
                        <label for="inp_product_group_name" class="col-sm-2 col-form-label">{{trans.data.name[lang.value]}}</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inp_product_group_name" name="product_group_name" aria-describedby="inp_product_group_name_help">
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <label for="inp_product_group_name1" class="col-sm-2 col-form-label">{{trans.data.department[lang.value]}}</label>
                        <div class="col-sm-10">
                          <select id="groupproductDepartment" class="form-select" name="group_product_department" dmx-bind:options="list_departments.data.query_list_departments" optiontext="department_name" optionvalue="department_id">
                            <option selected="" value="#">---</option>
                          </select>
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <div class="col-sm-10">
                          <button type="submit" class="btn btn-primary">{{trans.data.ok[lang.value]}}</button>
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



  </main>

  <script src="bootstrap/5/js/bootstrap.min.js"></script>
</body>

</html>