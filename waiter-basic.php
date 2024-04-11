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
			"options": {"permissions":"Waiter","loginUrl":"login.php","forbiddenUrl":"login.php","provider":"servo_login"}
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js" integrity="sha256-CutOzxCRucUsn6C6TcEYsauvvYilEniTXldPa6/wu0k=" crossorigin="anonymous"></script>
  <script src="dmxAppConnect/dmxBootstrap5Navigation/dmxBootstrap5Navigation.js" defer=""></script>
  <link rel="stylesheet" href="bootstrap/5/servodark/bootstrap.min.css" />
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
  <script src="dmxAppConnect/dmxRouting/dmxRouting.js" defer=""></script>
  <script src="dmxAppConnect/dmxFormRepeat/dmxFormRepeat.js" defer=""></script>
  <script src="dmxAppConnect/dmxDataTraversal/dmxDataTraversal.js" defer></script>
  <script src="dmxAppConnect/dmxBootbox5/bootstrap-modbox.min.js" defer></script>
  <script src="dmxAppConnect/dmxBootbox5/dmxBootbox5.js" defer></script>
  <link rel="stylesheet" href="bootstrap/5/css/bootstrap.min.css" />
</head>

<body is="dmx-app" id="departments">
  <dmx-value id="var2"></dmx-value>
  <dmx-serverconnect id="list_ready_items_count" url="dmxConnect/api/servo_order_items/list_order_items_shift_all_ready_waiter.php" dmx-param:user_id="session_variables.data.user_id" dmx-param:shift_id="session_variables.data.current_shift" dmx-param:order_item_status="'Ready'"></dmx-serverconnect>
  <dmx-serverconnect id="load_product_prices_for_service" url="dmxConnect/api/servo_product_prices/list_product_prices_for_service.php" dmx-param:department_id="list_user_shift_info.data.query_list_user_shift[0].user_shift_department_id" noload></dmx-serverconnect>
  <dmx-scheduler id="scheduler1" dmx-on:tick="total_sales_per_waiter_in_per_shift.load({user_id: session_variables.data.user_id, current_shift: session_variables.data.current_shift, order_status: 'Paid'});total_sales_per_waiter_out_per_shift.load({user_id: session_variables.data.user_id, current_shift: session_variables.data.current_shift, order_status: 'Ordered'});list_ready_items_count.load();list_orders.load({user_id: session_variables.data.user_id, current_shift: session_variables.data.current_shift});list_order_items_overview.load()" delay="30"></dmx-scheduler>
  <dmx-datetime id="var1"></dmx-datetime>
  <dmx-serverconnect id="total_sales_per_waiter" url="dmxConnect/api/servo_data/total_sales_per_waiter.php" dmx-param:user_id="session_variables.data.user_id" dmx-param:current_shift="session_variables.data.current_shift"></dmx-serverconnect>
  <dmx-serverconnect id="get_last_insert" url="dmxConnect/api/servo_product_groups/get_last_insert.php"></dmx-serverconnect>
  <dmx-serverconnect id="addGroupedProductMain" url="dmxConnect/api/servo_product_groups/add_grouped_products_to_order.php"></dmx-serverconnect>
  <dmx-serverconnect id="addGroupedProductAccessories" url="dmxConnect/api/servo_product_groups/add_grouped_products_to_order.php"></dmx-serverconnect>
  <dmx-serverconnect id="list_user_shift_info" url="dmxConnect/api/servo_user_shifts/list_user_shift_info.php" dmx-param:shift_id="session_variables.data.current_shift" dmx-param:user_id="session_variables.data.user_id"></dmx-serverconnect>
  <dmx-serverconnect id="total_sales_per_waiter_in_per_shift" url="dmxConnect/api/servo_data/total_sales_per_waiter_in_per_shift.php" dmx-param:user_id="session_variables.data.user_id" dmx-param:current_shift="session_variables.data.current_shift" dmx-param:order_status="'Paid'"></dmx-serverconnect>
  <dmx-serverconnect id="total_sales_per_waiter_out_per_shift" url="dmxConnect/api/servo_data/total_sales_per_waiter_out_per_shift.php" dmx-param:user_id="session_variables.data.user_id" dmx-param:current_shift="session_variables.data.current_shift" dmx-param:order_status="'Ordered'"></dmx-serverconnect>
  <dmx-serverconnect id="delete_item_order_item" url="dmxConnect/api/servo_order_items/delete_order_item.php"></dmx-serverconnect>
  <dmx-serverconnect id="list_order_items_current" url="dmxConnect/api/servo_order_items/list_order_items_current.php" dmx-param:order_id="read_item_order.data.query.order_id" noload="true"></dmx-serverconnect>
  <dmx-serverconnect id="get_order_total" url="dmxConnect/api/servo_order_items/compute_order_total.php" dmx-param:order_id="session_variables.data.current_order" noload></dmx-serverconnect>
  <dmx-serverconnect id="list_order_items" url="dmxConnect/api/servo_order_items/list_order_items.php" dmx-param:order_id="read_item_order.data.query.order_id" noload="true"></dmx-serverconnect>
  <dmx-serverconnect id="list_order_items_overview" url="dmxConnect/api/servo_order_items/list_order_items_overview.php" dmx-param:order_id="tableRepeat2[0].order_id" noload></dmx-serverconnect>
  <dmx-serverconnect id="load_products" url="dmxConnect/api/servo_products/list_products_per_service.php" dmx-param:category="" dmx-param:name="" dmx-param:search="AddProductsToOrderOffCanvas.searchProducts2.value" dmx-param:department_id="list_user_shift_info.data.query_list_user_shift[0].user_shift_department_id" dmx-param:service_id="list_user_shift_info.data.query_list_user_shift[0].servo_service_service_id" dmx-param:product_filter="" dmx-param:product_category="searchProductCategories.value"></dmx-serverconnect>
  <dmx-serverconnect id="load_product_groups" url="dmxConnect/api/servo_product_groups/list_product_groups.php" dmx-param:category="" dmx-param:name="" dmx-param:search="searchProduct.value" dmx-param:department_id="list_user_shift_info.data.query_list_user_shift[0].user_shift_department_id" dmx-param:product_group_id="load_product_groups.data.list_product_groups[0].product_group_id"></dmx-serverconnect>
  <dmx-session-manager id="session_variables"></dmx-session-manager>
  <dmx-serverconnect id="load_tables" url="dmxConnect/api/servo_tables/list_tables.php"></dmx-serverconnect>

  <dmx-serverconnect id="load_product_categories" url="dmxConnect/api/servo_refered_fields_loading/load_product_categories.php"></dmx-serverconnect>

  <dmx-serverconnect id="read_item_order" url="dmxConnect/api/servo_orders/read_order.php" dmx-param:id="id" noload="" dmx-param:item_id="" dmx-param:branch_id="read_item_branch.data.queryReadBranch.branch_id" dmx-param:department_id="" dmx-param:order_id=""></dmx-serverconnect>
  <dmx-serverconnect id="delete_item_order" url="dmxConnect/api/servo_departments/delete_department.php"></dmx-serverconnect>
  <dmx-serverconnect id="list_orders" url="dmxConnect/api/servo_orders/list_orders.php" dmx-param:user_id="session_variables.data.user_id" dmx-param:current_shift="session_variables.data.current_shift" dmx-param:order_status=""></dmx-serverconnect>
  <div is="dmx-browser" id="browser1"></div>
  <dmx-notifications id="notifies1" timeout="100" position="bottom" extended-timeout="200"></dmx-notifications>
  <?php include 'header.php'; ?>
  <main>

    <div class="modal" id="SelectTableModal" is="dmx-bs5-modal" tabindex="-1">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title fw-bolder text-primary">{{trans.data.selectTable[lang.value]}}</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="container">
              <div class="row">
                <div class="d-flex flex-wrap flex-row justify-content-center flex-sm-wrap flex-md-row justify-content-md-center col">
                  <div dmx-repeat:repeat2="load_tables.data.query_list_tables">
                    <button id="btn2" class="btn btn-lg mt-0 mb-2 ms-0 me-2 pt-5 pb-5 ps-5 pe-5 text-white bg-info" dmx-text="table_name" dmx-on:click="session_variables.set('table_id',table_id);SelectTableModal.hide();CreateOrderModal.show()">Button</button>

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
    <div class="modal" id="AddProductsModal" is="dmx-bs5-modal" tabindex="-1" dmx-on:show-bs-modal="load_product_categories_options.load()" style="" dmx-on:hide-bs-modal="total_sales_per_waiter.load({});upate_order_status.submit();list_orders.load();session_variables.remove('table_id');session_variables.remove('current_order')">
      <div class="modal-dialog modal-xl modal-fullscreen-xxl-down" role="document" style="max-width: 99% !important; width: 99% !important;">
        <div class="modal-content">
          <form id="upate_order_status" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_orders/update_order_pending_ordered.php">
            <input id="order_status_ordered" name="order_status" type="text" class="form-control visually-hidden" dmx-bind:value="'Ordered'">
            <input id="order_status_order_id" name="order_id" type="number" class="form-control visually-hidden" dmx-bind:value="session_variables.data.current_order">
          </form>
          <div class="modal-header">
            <div class="d-block d-flex">
              <h5 class="modal-title fw-bolder text-primary">{{trans.data.order[lang.value]}}: {{session_variables.data.current_order}}</h5><button id="btn9" class="btn ms-3 text-info bg-info bg-opacity-10" data-bs-toggle="offcanvas" data-bs-target="#orderdetailsoffcanvas">
                <i class="fas fa-tasks fa-sm"></i>
              </button>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>





          </div>
          <div class="modal-body">
            <div class="row">


            </div>
            <div class="row scrollable row-cols-xxl-12 mt-2" id="productDisplay">
              <div class="col">
                <ul class="nav nav-tabs" id="navTabs1_tabs" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="navTabs1_1_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_1" role="tab" aria-controls="navTabs1_1" aria-selected="true">{{trans.data.simple[lang.value]}}</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="navTabs1_2_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_2" role="tab" aria-controls="navTabs1_2" aria-selected="false">{{trans.data.grouped[lang.value]}}</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="navTabs1_3_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_3" role="tab" aria-controls="navTabs1_3" aria-selected="false"></a>
                  </li>
                </ul>
                <div class="tab-content" id="navTabs1_content">
                  <div class="tab-pane show active" id="navTabs1_1" role="tabpanel">
                    <div class="row mt-2 justify-content-start">
                      <div class="col-auto"><input id="searchProducts1" name="text1" type="text" class="form-control mb-1" dmx-bind:value="searchProducts1.value" dmx-on:changed="load_products.load({service_id: list_user_shift_info.data.query_list_user_shift[0].servo_service_service_id, search: searchProducts1.value, product_category: searchProductCategories.value})">
                        <input id="searchProductCategories" name="text2" type="text" class="form-control mb-1 form-control-lg visually-hidden" dmx-bind:value="searchProductCategories.value" dmx-on:changed="load_products.load({service_id: list_user_shift_info.data.query_list_user_shift[0].servo_service_service_id, search: searchProducts1.value, product_category: searchProductCategories.value})">
                      </div>
                      <div class="col d-flex justify-content-start"><button id="btn17" class="btn ms-2 me-2 text-white btn-info" dmx-on:click="searchProducts1.setValue(null);searchProductCategories.setValue(null);load_products.load({service_id: list_user_shift_info.data.query_list_user_shift[0].servo_service_service_id})">

                          <i class="fas fa-backspace fa-sm"></i>
                        </button>

                        <button id="btn181" class="btn ms-2 me-2 btn-info text-white" dmx-on:click="AddProductsModal.btn181.toggleCategorySelect2.toggle()">
                          <dmx-toggle id="toggleCategorySelect2"></dmx-toggle><i class="fas fa-chevron-down fa-sm"></i>
                        </button>
                        <button id="toggleProductPic" class="btn ms-2 me-2 text-white btn-info" dmx-on:click="AddProductsModal.toggleProductPic.toggleProductPictures.toggle()">
                          <dmx-toggle id="toggleProductPictures" checked="true"></dmx-toggle><i class="far fa-images fa-sm"></i>
                        </button>


                      </div>
                    </div>
                    <div class="row mt-2">
                      <div class="col" is="dmx-if" id="conditional3" dmx-bind:condition="btn181.toggleCategorySelect2.checked">
                        <div id="repeatProductCategories" is="dmx-repeat" dmx-bind:repeat="load_product_categories.data.query"><button id="btn11" class="btn mb-1 me-1 bg-info text-body" dmx-text="product_category_name" dmx-on:click="searchProductCategories.setValue(product_categories_id);load_products.load({product_category: product_categories_id})"></button></div>

                      </div>
                    </div>
                    <div class="row mt-md-1 ms-md-1 me-md-1 mt-sm-1 ms-sm-1 me-sm-1 mt-xxl-1 ms-xxl-1 me-xxl-1 mt-xl-1 ms-xl-1 me-xl-1 mt-lg-1 ms-lg-1 me-lg-1 mt-2 ms-1 me-1" style="margin: 2px !important;">
                      <div class="flex-md-wrap flex-md-row justify-content-md-center rounded align-content-center mt-2 mb-2 ms-1 me-1 pt-3 pb-3 ps-3 pe-3 offset-md-1 col-sm-5 border-dark bg-secondary col-xxl-3 col-xl-3 col-lg-3 col-md-5 col-12" dmx-repeat:repeatproducts="load_products.data.repeat" style="padding-top: 0px !important; margin-top: .5rem !;" id="productRepeats">
                        <form id="form3" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_order_items/create_order_item.php" dmx-on:success="form3.reset();list_order_items_current.load({order_id: session_variables.data.current_order});notifies1.success('Success:'+product_name+' Added to Order')" dmx-on:error="notifies1.danger('Error!')">
                          <div class="row mt-xxl-2 product-pic" id="productPic" dmx-hide="toggleProductPic.toggleProductPictures.checked">
                            <div class="col text-center product-pic" style="padding: 0px !important; height: 200px;" dmx-hide="product_picture==null">
                              <img dmx-bind:src="'/servo/uploads/product_pictures/'+product_picture" width="100%" height="95%" loading="lazy" style="object-fit: cover;">
                            </div>
                            <div class="col text-center" style="padding: 0px !important; height: 200px;" dmx-hide="product_picture!==null">
                              <img width="100%" height="95%" loading="lazy" style="object-fit: cover;" src="uploads/servo_no_image2.jpg">
                            </div>
                          </div>
                          <div class="row mt-2">
                            <div class="col d-flex justify-content-start">
                              <h5 class="text-center fw-bold text-body">{{product_name}}</h5>
                            </div>
                            <div class="col d-flex justify-content-end">
                              <h5 class="text-center text-body">{{product_price}}</h5>
                            </div>
                          </div>


                          <div class="row justify-content-between mb-2 text-center">
                            <div class="col-4">
                              <button id="btn5" class="btn btn-lg text-body bg-info" dmx-on:click="form3.inp_order_item_quantity.setValue((inp_order_item_quantity.value.toNumber()-1) )"><i class="fas fa-minus"></i>
                              </button>
                            </div>

                            <div class="col-4 text-center" style="padding: 0px !important;"><input id="inp_order_item_quantity" name="order_item_quantity" type="number" class="form-control mb-sm-1 mb-2 form-control-lg" placeholder="1" min="" data-rule-min="1" data-msg-min="Min. 1" style="width: 100% !important; border: 1px solid #696969 !important; border: none; background-color: transparent !important; color: #a1a1a1 !important;" dmx-bind:value="1"></div>
                            <div class="col-4">
                              <button id="btn16" class="btn btn-lg bg-info text-body" dmx-on:click="form3.inp_order_item_quantity.setValue((inp_order_item_quantity.value.toNumber()+1) )"><i class="fas fa-plus"></i>
                              </button>
                            </div>
                          </div><input id="inp_order_time_ordered" name="order_time_ordered" class="form-control mb-sm-1 mb-2 visually-hidden" type="datetime-local" dmx-bind:value="var1.datetime"><input id="inp_order_item_status" name="order_item_status" class="form-control mb-sm-1 mb-2 visually-hidden" value="Pending"><input id="inp_order_id" name="servo_orders_order_id" type="number" class="form-control mb-sm-1 mb-2 visually-hidden" dmx-bind:value="session_variables.data.current_order"><input id="inp_order_product_id" name="servo_products_product_id" type="number" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="1" dmx-bind:value="product_id"><input id="inp_order_item_price" name="order_item_price" type="number" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="1" dmx-bind:value="product_price">
                          <input id="inp_order_item_type" name="order_item_type" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="1" dmx-bind:value="'Simple'">
                          <input id="inp_order_item_user_ordered2" name="servo_users_user_ordered" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="1" dmx-bind:value="session_variables.data.user_id" type="number">

                          <input id="orderitemDepartment" name="servo_departments_department_id" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="1" dmx-bind:value="sdc_department_id" type="number">
                          <textarea id="inp_order_notes" class="form-control" name="order_item_notes"></textarea>
                          <div class="row row-cols-xxl-7 mt-2 mt-sm-2 mt-md-2 mt-lg-2 mt-xl-2 mt-xxl-2" id="optionsrow">
                            <div class="col w-25 flex-xxl-wrap justify-content-xxl-start">
                              <div id="repeatOptions" is="dmx-repeat" dmx-bind:repeat="query_list_options">
                                <button class="btn mb-xxl-2 me-xxl-2 button-repeat btn-info" dmx-text="category_option_option" dmx-bind:value="category_option_option" dmx-on:click="form3.inp_order_notes.setValue(form3.inp_order_notes.value+' '+optionsButton.value+' ')" id="optionsButton">Button</button>
                              </div>



                            </div>

                          </div>
                          <div class="row row-cols-xxl-7 justify-content-between mt-2 mb-2" id="buttons">
                            <div class="col w-25 flex-xxl-wrap justify-content-xxl-start d-flex justify-content-start">



                              <button id="btn8" class="add-item-button btn align-self-end btn-lg lh-1 text-muted" dmx-on:click="form3.inp_order_notes.setValue(null)">
                                <i class="fas fa-undo fa-lg"></i>
                              </button>
                            </div>
                            <div class="col w-25 flex-xxl-wrap justify-content-xxl-start d-flex justify-content-end">



                              <button id="btn12" class="add-item-button btn align-self-end btn-lg text-white bg-success" type="submit">
                                <i class="fas fa-plus"></i>
                              </button>
                            </div>

                          </div>
                        </form>
                      </div>
                    </div>

                  </div>
                  <div class="tab-pane" id="navTabs1_2" role="tabpanel">
                    <div class="row mt-md-1 mt-2">
                      <div class="flex-xxl-wrap border border-secondary col-md-4 mb-sm-2 me-sm-2 col-lg-3 col-xl-3 col-xxl-3 mt-xxl-0 mb-xxl-3 me-xxl-3 pt-xxl-3 pb-xxl-1 ps-xxl-1 pe-xxl-1 mb-1 me-1 bg-secondary" dmx-repeat:repeatproductgroups="load_product_groups.data.repeat_list_product_groups">

                        <div class="row mt-2">
                          <div class="col">
                            <h3 class="text-center text-body" dmx-text="product_group_name"></h3>
                          </div>
                        </div>
                        <form id="addGroupedItemsToOrder" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_product_groups/add_grouped_products_to_order.php" dmx-on:success="form3.reset();list_order_items_current.load({order_id: session_variables.data.current_order});notifies1.success('Success:'+product_name+' Added to Order')">
                          <input id="text6" name="servo_orders_order_id" type="text" class="form-control visually-hidden" dmx-bind:value="session_variables.data.current_order">
                          <input id="text7" name="servo_users_user_ordered" type="text" class="form-control visually-hidden" dmx-bind:value="session_variables.data.user_id">
                          <input id="text8" name="product_group_id" type="text" class="form-control visually-hidden" dmx-bind:value="product_group_id">
                          <input id="text9" name="order_time_ordered" type="text" class="form-control visually-hidden" dmx-bind:value="dateTime.datetime">
                          <input id="text13" name="order_item_group_reference" type="text" class="form-control visually-hidden" dmx-bind:value="list_user_info.data.query_list_user_info.user_id+session_variables.data.current_order+dateTime.datetime">


                          <div class="row row-cols-xxl-7 justify-content-between mt-2 mb-2" id="buttons1">
                            <div class="col w-25 flex-xxl-wrap justify-content-xxl-start d-flex justify-content-center">



                              <button id="AddGroupProductsButton" class="add-item-button btn align-self-end btn-lg btn-info" type="submit">
                                <i class="fas fa-plus"></i>
                              </button>
                            </div>

                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane" id="navTabs1_3" role="tabpanel">
                  </div>
                </div>
              </div>


            </div>





          </div>
        </div>

      </div>
      <div class="offcanvas w-auto offcanvas-start" id="orderdetailsoffcanvas" is="dmx-bs5-offcanvas" tabindex="-1">
        <div class="offcanvas-header">
          <div class="d-block d-flex flex-wrap">
            <h6 class="offcanvas-title fw-bold bg-info bg-opacity-10 text-info rounded me-2 pt-2 pb-1 ps-3 pe-3">{{trans.data.order[lang.value]}}: #{{session_variables.data.current_order}}</h6>
            <h6 class="offcanvas-title fw-bold bg-info bg-opacity-10 text-info rounded me-2 pt-2 pb-1 ps-3 pe-3">{{trans.data.table[lang.value]}}: {{session_variables.data.table_id}}</h6>
            <h6 class="offcanvas-title fw-bold bg-info bg-opacity-10 text-info rounded me-2 pt-2 pb-1 ps-3 pe-3" dmx-text="trans.data.total[lang.value]+': '+list_order_items_current.data.query.sum(`(order_item_price * order_item_quantity)`)">{{tableRepeat2[0].order_time}}</h6>
            <form id="updateItemsToOrdered" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_order_items/update_order_item_to_ordered.php">
              <input id="orderId" name="servo_orders_order_id" type="number" class="form-control visually-hidden" dmx-bind:value="session_variables.data.current_order">
              <input id="orderItemStatus2" name="order_item_status" class="form-control visually-hidden" dmx-bind:value="'Ordered'">
              <button id="sendOrderItems" class="btn text-info" dmx-on:click="run({'bootbox.confirm':{message:'\n',buttons:{confirm:{label:'Confirm',className:'btn-primary'},cancel:{label:'Cancel',className:'btn-secondary'}},centerVertical:true,then:{steps:{run:{action:`orderdetailsoffcanvas.updateItemsToOrdered.submit()`}}},name:'confirmOrders'}})"><i class="fas fa-paper-plane fa-2x"></i></button>
            </form>
          </div>





          <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <div class="row" dmx-on:click="">
            <div class="col">
              <table class="table">
                <thead>
                  <tr>
                    <th>{{trans.data.product[lang.value]}}</th>
                    <th>{{trans.data.price[lang.value]}}</th>
                    <th>{{trans.data.quantity[lang.value]}}</th>
                    <th>{{trans.data.type[lang.value]}}</th>
                    <th>{{trans.data.note[lang.value]}}</th>
                    <th>{{trans.data.total[lang.value]}}</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_order_items_current.data.query" id="tableRepeat3">
                  <tr dmx-hide="order_item_group_type=='Ingredient'">
                    <td dmx-text="product_name"></td>
                    <td dmx-text="order_item_price"></td>
                    <td>
                      <form id="form5" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_order_items/update_order_item_quantity.php" class="d-flex" dmx-on:success="notifies1.success('Sucess!!');list_order_items.load();list_order_items_current.load()">

                        <input id="text4" name="order_item_quantity" type="number" class="form-control" dmx-bind:value="order_item_quantity" min="1" data-rule-min="1" data-msg-min="!">
                        <input id="text5" name="order_item_id" type="number" class="form-control visually-hidden" dmx-bind:value="order_item_id">
                        <button id="btn13" class="btn text-success" type="submit"><i class="fas fa-check"></i>
                        </button>
                      </form>
                    </td>

                    <td dmx-text="trans.data.getValueOrKey(order_item_type)[lang.value]"></td>
                    <td dmx-text="order_item_notes"></td>

                    <td dmx-text="(order_item_price * order_item_quantity).formatNumber(2, '.', ',')"></td>
                    <td>
                      <form id="formDeleteItem2" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_order_items/delete_order_item_simple.php" dmx-on:success="notifies1.success('Success!');list_order_items_current.load({});list_order_items.load()">

                        <input id="text3" name="order_item_id" type="text" class="form-control visually-hidden" dmx-bind:value="order_item_id">
                        <button id="btn1" class="btn btn-sm text-danger" type="submit"><i class="far fa-trash-alt fa-sm"></i>
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
      <div class="modal-footer">


      </div>
    </div>
    </div>
    </div>
    <div class="modal" id="CreateOrderModal" is="dmx-bs5-modal" tabindex="-1">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{trans.data.createOrder[lang.value]}}:{{trans.data.table[lang.value]}} {{session_variables.data.table_id}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="container">
              <div class="row">
                <div class="col d-flex justify-content-center">
                  <div class="row">
                    <div class="col d-flex justify-content-center ms-1 me-1 flex-wrap">
                      <form is="dmx-serverconnect-form" id="create_order_form" method="post" action="dmxConnect/api/servo_orders/create_order.php" dmx-on:success="notifies1.success('Order #'+create_order_form.data.custom[0]['last_insert_id()']+' Created');session_variables.set('current_order',create_order_form.data.custom[0]['last_insert_id()']);CreateOrderModal.hide();list_orders.load();create_order_form.reset();read_item_order.load({order_id: create_order_form.data.query_insert_order.identity});readItemModal.show();list_order_items.load({order_id: create_order_form.data.query_insert_order.identity})">
                        <input id="order_time" name="order_time" type="text" class="form-control visually-hidden" dmx-bind:value="dateTime.datetime">
                        <input id="order_discount" name="order_discount" type="hidden" class="form-control visually-hidden" dmx-bind:value="0">
                        <input id="order_status" name="order_status" type="hidden" class="form-control visually-hidden" dmx-bind:value="'Ordered'">
                        <input id="table" name="servo_customer_table_table_id" type="hidden" class="form-control visually-hidden" dmx-bind:value="session_variables.data.table_id">
                        <input id="user_id" name="servo_user_user_id" type="hidden" class="form-control visually-hidden" dmx-bind:value="session_variables.data.user_id">
                        <input id="shift_id" name="servo_shift_shift_id" type="hidden" class="form-control visually-hidden" dmx-bind:value="session1.data.current_shift">
                        <input id="serviceId" name="servo_service_service_id" type="hidden" class="form-control visually-hidden" dmx-bind:value="list_user_shift_info.data.query_list_user_shift[0].servo_service_service_id">
                        <input id="orderpos" name="order_pos" type="hidden" class="form-control visually-hidden" dmx-bind:value="list_user_shift_info.data.query_list_user_shift[0].servo_service_service_id">
                        <input id="orderCustomer" name="order_customer" type="hidden" class="form-control visually-hidden" dmx-bind:value="list_user_shift_info.data.pos_info[0].customer_id">

                        <div class="row row-cols-1">
                          <div class="d-flex border-warning col"><button id="btn7" class="btn btn-lg me-0 pt-5 pb-5 ps-5 pe-5 fw-bolder text-success bg-success bg-opacity-10" type="submit">{{trans.data.createOrder[lang.value]}}</button>
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
    <div class="modal create-modal" id="OrderItemsReady" is="dmx-bs5-modal" tabindex="-1">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-danger">
              <i class="fas fa-bell fa-2x"></i>
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col">
                <div class="table-responsive">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>{{trans.data.item[lang.value]}}</th>
                        <th>{{trans.data.table[lang.value]}}</th>
                        <th>
                          <font face="Font Awesome 5 Free">{{trans.data.quantity[lang.value]}}</font>
                        </th>
                        <th>
                          <font face="Font Awesome 5 Free">{{trans.data.notes[lang.value]}}</font>
                        </th>
                        <th>#</th>
                        <th><i class="fas fa-bars"></i></th>
                        <th><i class="far fa-clock"></i></th>
                        <th>{{trans.data.department[lang.value]}}</th>
                        <th></th>

                      </tr>
                    </thead>
                    <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_ready_items_count.data.query" id="tableRepeat6">
                      <tr dmx-class:group-main="(order_item_group_type)=='Main'" dmx-class:group-accessory="(order_item_group_type)=='Accessory'">
                        <td dmx-text="product_name"></td>
                        <td dmx-text="table_name"></td>
                        <td dmx-text="order_item_quantity"></td>
                        <td dmx-text="order_item_notes"></td>
                        <td dmx-text="order_id"></td>
                        <td dmx-text="order_notes"></td>
                        <td dmx-text="order_time_ready.toISOTime()"></td>
                        <td dmx-text="department_name"></td>
                        <td dmx-text="order_time_ready.toISOTime()"></td>
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

    <div class="modal readitem" id="readItemModal" is="dmx-bs5-modal" tabindex="-1" dmx-on:hidden-bs-modal="total_sales_per_waiter.load()">
      <div class="modal-dialog modal-xl modal-fullscreen-xxl-down" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <div class="d-block d-flex"><button id="btn10" class="btn float-right bg-success me-3 btn-lg bg-opacity-10 text-success" data-bs-toggle="offcanvas" data-bs-target="#AddProductsToOrderOffCanvas" dmx-class:hidethis.hidethis="(read_item_order.data.query.order_status == 'Paid')">
                <i class="fas fa-cart-plus fa-sm"></i>
              </button>
              <form id="updateItemsToOrdered2" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_order_items/update_order_item_to_ordered.php">
                <input id="orderId2" name="servo_orders_order_id" type="number" class="form-control visually-hidden" dmx-bind:value="session_variables.data.current_order">
                <input id="orderItemStatus3" name="order_item_status" class="form-control visually-hidden" dmx-bind:value="'Ordered'">
                <button id="sendOrderItems2" class="btn text-info" dmx-on:click="run({'bootbox.confirm':{message:'\n',buttons:{confirm:{label:'Confirm',className:'btn-primary'},cancel:{label:'Cancel',className:'btn-secondary'}},centerVertical:true,then:{steps:[{run:{action:`updateItemsToOrdered2.submit()`}},{run:{action:`list_order_items.load({order_id: read_item_order.data.query.order_id})`}}]},name:'confirmOrders'}})" dmx-bs-tooltip="trans.data.send[lang.value]" data-bs-placement="bottom" data-bs-trigger="hover focus" dmx-hide="(list_order_items.data.query.where(`order_item_status`, 'Pending', '=='))==0"><i class="fas fa-paper-plane fa-2x"></i></button>
              </form>
            </div>









            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body ms-1 me-1">
            <div class="offcanvas offcanvas-start" id="AddProductsToOrderOffCanvas" is="dmx-bs5-offcanvas" tabindex="-1" style="width: 99%;">
              <div class="offcanvas-header">
                <div class="d-block">
                  <h4 class="offcanvas-title fw-bolder text-body">{{trans.data.products[lang.value]}}</h4>
                </div>






                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
              </div>
              <div class="offcanvas-body">

                <div class="row scrollable row-cols-xxl-12" id="productDisplay1">
                  <div class="col" style="">
                    <ul class="nav nav-tabs nav-fill" id="navTabs1_tabs1" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="navTabs1_1_tab1" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_41" role="tab" aria-controls="navTabs1_1" aria-selected="true">{{trans.data.simple[lang.value]}}</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="navTabs1_2_tab1" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_42" role="tab" aria-controls="navTabs1_2" aria-selected="false">{{trans.data.grouped[lang.value]}}</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="navTabs1_3_tab1" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_43" role="tab" aria-controls="navTabs1_3" aria-selected="false">{{trans.data.option[lang.value]}}</a>
                      </li>
                    </ul>
                    <div class="tab-content" id="navTabs1_content1">
                      <div class="tab-pane show active" id="navTabs1_41" role="tabpanel">
                        <div class="row mt-2 justify-content-start row-cols-12">
                          <div class="col-auto"><input id="searchProducts2" name="text14" type="text" class="form-control mb-1" dmx-bind:value="AddProductsToOrderOffCanvas.searchProducts2.value" dmx-on:changed="load_products.load({service_id: list_user_shift_info.data.query_list_user_shift[0].servo_service_service_id, search: AddProductsToOrderOffCanvas.searchProducts2.value, product_category: AddProductsToOrderOffCanvas.searchProductCategories2.value})">

                            <input id="searchProductCategories2" name="text2" type="text" class="form-control mb-1 form-control-lg visually-hidden" dmx-bind:value="searchProductCategories.value" dmx-on:changed="load_products.load({service_id: list_user_shift_info.data.query_list_user_shift[0].servo_service_service_id, search: searchProducts1.value, product_category: searchProductCategories.value})">

                          </div>
                          <div class="d-flex justify-content-start col-auto"><button id="btn4" class="btn ms-1 me-2 text-primary lh-1 bg-primary bg-opacity-10" dmx-on:click="AddProductsToOrderOffCanvas.searchProducts2.setValue(null);AddProductsToOrderOffCanvas.searchProductCategories2.setValue(null);load_products.load({service_id: list_user_shift_info.data.query_list_user_shift[0].servo_service_service_id})">
                              <i class="fas fa-backspace fa-sm"></i>
                            </button>
                            <button id="btn18" class="btn ms-2 me-2 bg-primary bg-opacity-10 text-primary" dmx-on:click="AddProductsToOrderOffCanvas.btn18.toggleCategorySelect.toggle()">
                              <dmx-toggle id="toggleCategorySelect"></dmx-toggle><i class="fas fa-chevron-down fa-sm"></i>
                            </button>
                            <button id="toggleProductPic2" class="btn ms-2 me-2 text-primary bg-primary bg-opacity-10" dmx-on:click="AddProductsToOrderOffCanvas.toggleProductPic2.toggleProductPictures2.toggle()">
                              <dmx-toggle id="toggleProductPictures2" checked="true"></dmx-toggle><i class="far fa-images fa-sm"></i>
                            </button>
                          </div>
                        </div>
                        <div class="row mt-2">
                          <div class="col" is="dmx-if" id="conditional2" dmx-bind:condition="AddProductsToOrderOffCanvas.btn18.toggleCategorySelect.checked">
                            <div id="repeatProductCategories2" is="dmx-repeat" dmx-bind:repeat="load_product_categories.data.query"><button id="btn111" class="btn mb-1 me-1 text-body bg-secondary" dmx-text="product_category_name" dmx-on:click="searchProductCategories2.setValue(product_categories_id);load_products.load({product_category: product_categories_id})"></button></div>

                          </div>
                        </div>
                        <div class="row mt-2 ms-1 me-1 mt-sm-1 ms-sm-1 me-sm-1 mt-md-1 ms-md-1 me-md-1 mt-lg-1 ms-lg-1 me-lg-1 mt-xxl-1 ms-xxl-1 me-xxl-1 mt-xl-1 me-xl-1 row-cols-xxl-12 row-cols-lg-10 row-cols-xl-12 row-cols-md-3 row-cols-12 align-items-center">

                          <div class="offset-md-0 col-xxl-6 col-xl-6 col-12 col-sm-6 col-md-12 rounded col-lg-6 align-self-center bg-info bg-opacity-10 mb-1 pt-1 pb-1 ps-1 pe-1 gx-4" dmx-repeat:repeatproducts="load_products.data.repeat" style="padding-top: 0px !important;" id="SelectProductsRepeat">
                            <form id="addItem2" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_order_items/create_order_item.php" dmx-on:success="addItem2.reset();list_order_items.load({order_id: session_variables.data.current_order});notifies1.success('Success:'+product_name+' Added to Order')">
                              <div class="row row-cols-md-12 row-cols-sm-12 row-cols-12 row-cols-lg-12 row-cols-xl-12 row-cols-xxl-12 pt-2 pb-2 ps-2 pe-2 align-items-center">
                                <div class="col-auto">
                                  <div class="row" style="padding: 0px !important;" id="productPic2" dmx-hide="toggleProductPic2.toggleProductPictures2.checked">
                                    <div class="text-center col-auto" style="padding: 0px !important; height: 200px;" dmx-hide="product_picture==null">
                                      <img dmx-bind:src="'/servo/uploads/product_pictures/'+product_picture" width="100%" height="95%" loading="lazy" style="object-fit: cover;">
                                    </div>
                                    <div class="text-center col-auto" style="padding: 0px !important; height: 200px;" dmx-hide="product_picture!==null">
                                      <img width="100%" height="95%" loading="lazy" style="object-fit: cover;" src="uploads/servo_no_image2.jpg">
                                    </div>

                                  </div>
                                </div>
                                <div class="justify-content-start  col-3">
                                  <h6 class="text-body">{{product_name}}</h6>

                                </div>
                                <div class="justify-content-start text-lg-center col-sm-auto col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-2">
                                  <h6 class="rounded pt-1 pb-1 ps-2 pe-2 fw-bold bg-danger bg-opacity-10 text-danger text-center">{{product_price.formatNumber('O',',',',')}}</h6>

                                </div>
                                <div class="col-auto d-flex align-items-center">
                                  <button id="btn161" class="btn me-1 bg-opacity-10 text-body bg-info" dmx-on:click="addItem2.inp_order_item_quantity2.setValue((addItem2.inp_order_item_quantity2.value.toNumber()-1))"><i class="fas fa-minus fa-sm"></i>
                                  </button><input id="inp_order_item_quantity2" name="order_item_quantity" type="number" class="form-control mb-sm-1 mb-2" min="" data-rule-min="1" data-msg-min="Min. 1" style="width: 70px !important; border: none !important; font-family: 'Josefin-Sans'; font-size: 20px !important; text-align: center;" dmx-bind:value="1" dmx-bind:min="1" required="" data-msg-required="!"><button id="btn162" class="btn ms-1 me-4 bg-opacity-10 bg-info text-body" dmx-on:click="addItem2.inp_order_item_quantity2.setValue((addItem2.inp_order_item_quantity2.value.toNumber()+1))"><i class="fas fa-plus fa-sm"></i>
                                  </button>
                                  <dmx-toggle id="showItemDetails"></dmx-toggle><button id="btn14" class="btn text-danger bg-danger bg-opacity-10 me-4 btn-lg" dmx-on:click="showItemDetails.toggle()"><i class="fas fa-info fa-sm"></i>
                                  </button>
                                </div>
                                <div class="col-auto visually-hidden d-flex"><input id="orderitemDepartment1" name="servo_departments_department_id" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="1" dmx-bind:value="sdc_department_id" type="number"><input id="inp_order_item_user_ordered1" name="servo_users_user_ordered" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="1" dmx-bind:value="session_variables.data.user_id" type="number"><input id="inp_order_item_price2" name="order_item_price" type="number" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="1" dmx-bind:value="product_price"><input id="inp_order_product_id2" name="servo_products_product_id" type="number" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="1" dmx-bind:value="product_id"><input id="inp_order_time_ordered2" name="order_time_ordered" class="form-control mb-sm-1 mb-2 visually-hidden" type="datetime-local" dmx-bind:value="var1.datetime"><input id="inp_order_item_status2" name="order_item_status" class="form-control mb-sm-1 mb-2 visually-hidden" value="Pending"><input id="inp_order_id2" name="servo_orders_order_id" type="number" class="form-control mb-sm-1 mb-2 visually-hidden" dmx-bind:value="session_variables.data.current_order"><input id="inp_order_item_type1" name="order_item_type" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="1" dmx-bind:value="'Simple'"></div>
                                <div class="col-auto col-sm-auto" id="orderItemDetails" dmx-show="showItemDetails.checked">
                                  <div class="row">
                                    <div class="col-auto"><textarea id="inp_order_notes2" class="form-control" name="order_item_notes" style="width: 200px;"></textarea></div>
                                    <div class="d-flex flex-wrap">



                                      <button id="btn45" class="add-item-button btn align-self-end btn-lg text-muted" dmx-on:click="addItem2.inp_order_notes2.setValue(null)">
                                        <i class="fas fa-undo"></i>
                                      </button>
                                    </div>
                                    <div class="w-25  d-flex flex-md-nowrap flex-md-row justify-content-md-start col-md flex-xxl-nowrap justify-content-xxl-start flex-xxl-row flex-xl-nowrap justify-content-xl-start flex-xl-row flex-lg-nowrap justify-content-lg-start flex-lg-row flex-sm-nowrap justify-content-sm-start flex-sm-row flex-nowrap justify-content-start flex-row col-xxl col-xl col-lg col-auto" style="">
                                      <div id="repeatOptions1" is="dmx-repeat" dmx-bind:repeat="query_list_options">
                                        <button class="btn mb-xxl-2 me-xxl-2 button-repeat bg-opacity-10 fw-bold text-primary bg-primary" dmx-text="category_option_option" dmx-bind:value="category_option_option" dmx-on:click="addItem2.inp_order_notes2.setValue(addItem2.inp_order_notes2.value+' '+optionsButton2.value+' ')" id="optionsButton2"></button>
                                      </div>

                                    </div>

                                  </div>
                                </div>



                                <div class=" col-md-1">
                                  <button id="btn44" class="add-item-button btn align-self-end btn-lg bg-opacity-10 bg-success text-success" type="submit">
                                    <i class="fas fa-check"></i>
                                  </button>
                                </div>
                              </div>







                            </form>

                          </div>
                        </div>


                      </div>
                      <div class="tab-pane" id="navTabs1_42" role="tabpanel">
                        <div class="row mt-md-1 mt-2">
                          <div class="flex-xxl-wrap border border-secondary col-md-4 mb-sm-2 me-sm-2 col-lg-3 col-xl-3 col-xxl-3 mt-xxl-0 mb-xxl-3 me-xxl-3 pt-xxl-3 pb-xxl-1 ps-xxl-1 pe-xxl-1 mb-1 me-1 bg-secondary" dmx-repeat:repeatproductgroups="load_product_groups.data.repeat_list_product_groups">

                            <div class="row mt-2">
                              <div class="col">
                                <h3 class="text-center text-body" dmx-text="product_group_name"></h3>
                              </div>
                            </div>
                            <form id="addGroupedItemsToOrder1" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_product_groups/add_grouped_products_to_order.php" dmx-on:success="AddProductsToOrderOffCanvas.form4.reset();list_order_items.load({order_id: session_variables.data.current_order});notifies1.success('Success:'+product_name+' Added to Order')">
                              <input id="inpOrderId2" name="servo_orders_order_id" type="text" class="form-control visually-hidden" dmx-bind:value="session_variables.data.current_order">
                              <input id="inpUser2" name="servo_users_user_ordered" type="text" class="form-control visually-hidden" dmx-bind:value="session_variables.data.user_id">
                              <input id="inpGroupid2" name="product_group_id" type="text" class="form-control visually-hidden" dmx-bind:value="product_group_id">
                              <input id="inptime2" name="order_time_ordered" type="text" class="form-control visually-hidden" dmx-bind:value="dateTime.datetime">
                              <input id="inpGroupReference" name="order_item_group_reference" type="text" class="form-control visually-hidden" dmx-bind:value="list_user_info.data.query_list_user_info.user_id+read_item_order.data.query.order_id+dateTime.datetime+product_group_id">


                              <div class="row row-cols-xxl-7 justify-content-between mt-2 mb-2" id="buttons22">
                                <div class="col w-25 flex-xxl-wrap justify-content-xxl-start d-flex justify-content-center">



                                  <button id="btn41" class="add-item-button btn align-self-end btn-lg text-success bg-success bg-opacity-10" type="submit">
                                    <i class="fas fa-plus"></i>
                                  </button>
                                </div>

                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                      <div class="tab-pane" id="navTabs1_43" role="tabpanel">
                        <div class="row mt-md-1 mt-2">
                          <div class="flex-xxl-wrap border border-secondary col-md-4 mb-sm-2 me-sm-2 col-lg-3 col-xl-3 col-xxl-3 mt-xxl-0 mb-xxl-3 me-xxl-3 pt-xxl-3 pb-xxl-1 ps-xxl-1 pe-xxl-1" dmx-repeat:repeatproducts="load_products.data.query_list_products">
                            <form id="addItem1" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_order_items/create_order_item.php" dmx-on:success="addItem2.reset();list_order_items.load({order_id: session_variables.data.current_order});notifies1.success('Success:'+product_name+' Added to Order')">
                              <div class="row mt-2">
                                <div class="col">
                                  <h3 class="text-center text-warning">{{product_name}}</h3>
                                </div>
                              </div>
                              <div class="row mt-2">
                                <div class="col">
                                  <h4 class="text-center text-white">{{product_price}}</h4>
                                </div>
                              </div>

                              <input id="inp_order_item_quantity3" name="order_item_quantity" type="number" class="form-control mb-sm-1 mb-2" placeholder="1" min="" data-rule-min="1" data-msg-min="Min. 1"><input id="inp_order_time_ordered3" name="order_time_ordered" class="form-control mb-sm-1 mb-2 visually-hidden" type="datetime-local" dmx-bind:value="var1.datetime"><input id="inp_order_item_status3" name="order_item_status" class="form-control mb-sm-1 mb-2 visually-hidden" value="Ordered"><input id="inp_order_id3" name="servo_orders_order_id" type="number" class="form-control mb-sm-1 mb-2 visually-hidden" dmx-bind:value="session_variables.data.current_order"><input id="inp_order_product_id3" name="servo_products_product_id" type="number" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="1" dmx-bind:value="product_id"><input id="inp_order_item_price3" name="order_item_price" type="number" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="1" dmx-bind:value="product_price">
                              <input id="inp_order_item_type3" name="order_item_type" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="1" dmx-bind:value="'Simple'">
                              <input id="inp_order_item_user_ordered3" name="servo_users_user_ordered" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="1" dmx-bind:value="session_variables.data.user_id" type="number"><textarea id="inp_order_notes3" class="form-control" name="order_item_notes"></textarea>
                              <div class="row row-cols-xxl-7 justify-content-between mt-2 mb-2" id="buttons3">
                                <div class="col w-25 flex-xxl-wrap justify-content-xxl-start d-flex justify-content-start visually-hidden">



                                  <button id="btn15" class="add-item-button btn align-self-end btn-lg btn-success">
                                    <i class="fas fa-plus"></i>
                                  </button>
                                </div>
                                <div class="col w-25 flex-xxl-wrap justify-content-xxl-start d-flex justify-content-end">



                                  <button id="btn15" class="add-item-button btn btn-warning align-self-end btn-lg" type="submit">
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
            <div class="row row-cols-2 justify-content-between">

              <div class="d-flex col-auto">
                <h6 class="rounded me-2 pt-2 pb-2 ps-3 pe-3 text-body bg-secondary"><i class="fas fa-receipt fa-sm" style="margin-right: 3px"></i>
                  {{read_item_order.data.query.order_id}}</h6>
                <h6 class="rounded me-2 pt-2 pb-2 ps-3 pe-3 text-body bg-secondary"><i class="fas fa-map-marker-alt" style="margin-right: 3px"></i>{{read_item_order.data.query.table_name}}&nbsp;</h6>




                <h6 class="fw-bold bg-secondary rounded ms-1 me-2 pt-2 pb-2 ps-3 pe-3 text-white" dmx-text="trans.data.getValueOrKey(read_item_order.data.query.order_status)[lang.value]" dmx-class:bg-success="read_item_order.data.query.order_status=='Paid'" dmx-class:bg-danger="read_item_order.data.query.order_status=='Ordered'"></h6>

                <div class="text-danger float-right">

                </div>
              </div>
              <div class="d-flex col-auto">

                <h5 class="rounded fw-bolder pt-2 pb-2 ps-4 pe-4 text-white" dmx-class:bg-success="read_item_order.data.query.order_status=='Paid'" dmx-class:bg-danger="read_item_order.data.query.order_status=='Ordered'"><i class="fas fa-cash-register fa-sm" style="margin-right: 3px"></i>
                  {{(list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`)).formatNumber('0', ',', ',').default(0)}}
                </h5>
              </div>
            </div>

            <div class="row row-cols-1 ms-0 me-0">
              <div class="col bg-secondary rounded">
                <div class="table-responsive" id="order_details_table">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>{{trans.data.group[lang.value]}}</th>
                        <th>{{trans.data.product[lang.value]}}</th>
                        <th>{{trans.data.dateTime[lang.value]}}</th>
                        <th>{{trans.data.status[lang.value]}}</th>
                        <th>{{trans.data.note[lang.value]}}</th>
                        <th>{{trans.data.quantity[lang.value]}}</th>
                        <th>{{trans.data.price[lang.value]}}</th>
                        <th>{{trans.data.type[lang.value]}}</th>
                        <th></th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_order_items.data.query" id="tableRepeat4">
                      <tr dmx-hide="order_item_group_type=='Ingredient'">
                        <td dmx-text="product_group_name+' '"></td>
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
                        <td dmx-text="trans.data.getValueOrKey(order_item_type)[lang.value]">


                        </td>
                        <td dmx-text="trans.data.getValueOrKey(order_item_group_type)[lang.value]">


                        </td>
                        <td>

                          <div class="row" is="dmx-if" id="conditional1" dmx-bind:condition="(profile_privileges.data.profile_privileges[0].delete_order_item == 'Yes')">
                            <form id="form2" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_order_items/delete_order_item.php" dmx-on:success="notifies1.success('Success');list_order_items.load()" dmx-class:hidethis="(read_item_order.data.query.order_status == 'Paid')">

                              <input id="text2" name="order_item_id" type="text" class="form-control visually-hidden" dmx-bind:value="order_item_id">
                              <input id="text10" name="order_id" type="text" class="form-control visually-hidden" dmx-bind:value="session_variables.data.current_order">
                              <input id="text11" name="user_deleted" type="text" class="form-control visually-hidden" dmx-bind:value="list_user_shift_info.data.query_list_user_shift[0].servo_user_user_id">
                              <input id="text12" name="deleted_product_id" type="text" class="form-control visually-hidden" dmx-bind:value="servo_products_product_id">
                              <button class="btn text-danger" data-bs-target="#productInfo" type="submit"><i class="far fa-trash-alt fa-sm"><br></i></button>
                            </form>
                          </div>

                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>

            </div>
            <div class="row mt-2 ms-0 me-0 pt-2 pb-2 ps-0 pe-0 bg-secondary rounded">
              <form is="dmx-serverconnect-form" id="updateOrder" method="post" action="dmxConnect/api/servo_orders/update_order.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="read_item_order.data.query" dmx-on:success="notifies1.success('Success');list_orders.load();readItemModal.hide()">
                <input id="order_id" name="order_id" type="hidden" class="form-control" dmx-bind:value="read_item_order.data.query.order_id">
                <div class="mb-3 row">
                  <div class="col-sm-10 visually-hidden">
                    <input type="number" class="form-control" id="inp_order_discount" name="order_discount" dmx-bind:value="read_item_order.data.query.order_discount" aria-describedby="inp_order_discount_help" placeholder="Enter Order discount">
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="inp_servo_customer_table_table_id" class="col-sm-2 col-form-label">{{trans.data.table[lang.value]}}</label>
                  <div class="col-sm-10">
                    <select id="customer_table" class="form-select" dmx-bind:options="load_tables.data.query_list_tables" optiontext="table_name" optionvalue="table_id" name="servo_customer_table_table_id" dmx-bind:value="read_item_order.data.query.servo_customer_table_table_id" dmx-bind:disabled="read_item_order.data.query.order_status=='Paid'">
                    </select>
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="order_notes1" class="col-sm-2 col-form-label">{{trans.data.note[lang.value]}}</label>
                  <div class="col-sm-10">
                    <textarea type="text" class="form-control" id="order_notes1" name="order_notes" dmx-bind:value="read_item_order.data.query.order_notes" aria-describedby="inp_order_notes_help" dmx-bind:disabled="read_item_order.data.query.order_status=='Paid'">
                    </textarea>
                  </div>
                </div>
                <div class="mb-3 row">
                  <div class="col-sm-2">&nbsp;</div>
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary" dmx-bind:value="read_item_order.data.query.Save" dmx-bind:hidden="read_item_order.data.query.order_status=='Paid'">{{trans.data.update[lang.value]}}</button>
                  </div>
                </div>
              </form>
            </div>


          </div>
          <div class="modal-footer">
            <form id="form1" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_orders/delete_order_and_items.php" dmx-on:success="notifies1.success('Success');list_orders.load();readItemModal.hide()" onsubmit=" return confirm('CONFIRM DELETE?');" dmx-show="(profile_privileges.data.profile_privileges[0].delete_order == 'Yes')">
              <input id="text1" name="order_id" type="number" class="form-control visually-hidden" dmx-bind:value="session_variables.data.current_order">

              <button id="btn6" class="btn text-danger" type="submit">
                <i class="far fa-trash-alt fa-lg"></i>
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>


  </main>
  <main>
    <div class="ms-2 me-2">




      <div class="row servo-page-header rounded mt-2 pt-2 pb-2">
        <div class="style13 page-button justify-content-sm-end top-bar text-light col-auto" id="pagebuttons">
          <h5 class="text-start pt-2 pb-2 ps-3 pe-3 rounded text-body bg-light">
            <i class="fas fa-store fa-sm"></i>: {{list_user_shift_info.data.query_list_user_shift[0].service_name}}
          </h5>



        </div>
        <div class="col style13 page-button d-flex justify-content-sm-end justify-content-end top-bar" id="pagebuttons1">
          <button id="btn3" class="btn text-danger btn-sm" data-bs-toggle="modal" data-bs-target="#OrderItemsReady"><i class="far fa-bell fa-2x"></i><sup id="readyItems" dmx-text="list_ready_items_count.data.query.count()" class="sup-text text-danger"></sup>
          </button>



          <button id="btn31" class="btn style12 fw-light rounded ms-2 text-white bg-info" data-bs-toggle="modal" data-bs-target="#SelectTableModal" style="float: right;"><i class="fas fa-plus style14 fa-lg"></i></button>
        </div>
      </div>
      <div class="row numbers rounded mt-2 ms-0 me-0 pt-3 pb-2 ps-2 pe-2 bg-light">
        <div class="col d-flex justify-content-start">
          <h2 class="text-danger"><i class="fas fa-arrow-alt-circle-up"></i></h2>
          <h3 class="ms-2 text-danger fw-bolder">{{(total_sales_per_waiter_out_per_shift.data.query.sum(`(order_item_price * order_item_quantity)`)).formatNumber('0', ',', ',')}}</h3>
        </div>
        <div class="col d-flex justify-content-end">
          <h2 class="text-success"><i class="fas fa-arrow-alt-circle-down"></i></h2>
          <h3 class="ms-2 text-success fw-bolder">{{(total_sales_per_waiter_in_per_shift.data.query.sum(`(order_item_price * order_item_quantity)`)).formatNumber('0', ',', ',')}}</h3>
        </div>
      </div>
      <div class="row ms-0 me-0" style="height: 450px; overflow: scroll;">
        <div class="col-12 bg-light rounded mt-2 pt-2 order-md-3">


          <div class="table-responsive">
            <table class="table table-hover table-sm table-borderless border-success">
              <thead>
                <tr>
                  <th>{{trans.data.order[lang.value]}}</th>
                  <th>{{trans.data.dateTime[lang.value]}}</th>

                  <th>{{trans.data.table[lang.value]}}</th>
                  <th class="text-center">{{trans.data.status[lang.value]}}</th>
                  <th></th>

                </tr>
              </thead>
              <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_orders.data.query" id="tableRepeat2">
                <tr>
                  <td dmx-text="order_id"></td>
                  <td dmx-text="order_time"></td>

                  <td dmx-text="table_name"></td>
                  <td wappler-command="editContent">
                    <h6 dmx-text="trans.data.getValueOrKey(order_status)[lang.value]" dmx-class:yellow-state="(order_status == 'Ordered')" dmx-class:green-state="(order_status == 'Paid')" dmx-class:grey-state="(order_status == 'Pending')" dmx-class:red-state="(order_status == 'Credit')" class="text-center pt-1 pb-1 ps-2 pe-2 fw-bold"></h6>
                  </td>
                  <td class="text-center">
                    <button class="btn btn-outline-link text-body bg-secondary" data-bs-target="#productInfo" dmx-on:click="session_variables.remove('current_order');session_variables.set('current_order',order_id);readItemModal.show();read_item_order.load({order_id: order_id});list_order_items_current.load({order_id: order_id});list_order_items.load({order_id: order_id})" dmx-bind:value="list_orders.data.query[0].order_id"><i class="fas fa-pencil-alt fa-sm"><br></i></button>
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
  <script>
    /* vibrate and sound notification */
            $(document).ready(function()
            {
               setInterval(function(){
                var readyItems = $('#readyItems').html();
                console.log(readyItems);
                if(readyItems > 0) { 
                    window.navigator.vibrate([3000]);
                    const audio = new Audio("/servo/audio/state-change_confirm-down.wav" );
                    audio.play();
                };
            }, 10000);
        }
        );
  </script>
  <script src="bootstrap/5/js/bootstrap.min.js"></script>
</body>

</html>