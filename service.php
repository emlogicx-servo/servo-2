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
			"options": {"permissions":"Service","loginUrl":"index.php","forbiddenUrl":"index.php","provider":"servo_login"}
		}
	]
}
JSON
, TRUE);
?>
<!doctype html>
<html is="dmx-app">

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
  <link rel="stylesheet" href="fontawesome5/css/all.min.css" />
  <script src="dmxAppConnect/dmxBootbox5/bootstrap-modbox.min.js" defer></script>
  <script src="dmxAppConnect/dmxBootbox5/dmxBootbox5.js" defer></script>
  <link rel="stylesheet" href="bootstrap/5/css/bootstrap.min.css" />
</head>

<body id="service">
  <dmx-serverconnect id="list_order_items_shift_all" url="dmxConnect/api/servo_order_items/list_order_items_shift_all.php" dmx-param:department_id="session_variables.data.user_department_id" dmx-param:sort="" dmx-param:dir="'DESC'" dmx-param:shift_id="session_variables.data.current_shift"></dmx-serverconnect>
  <dmx-serverconnect id="product_report_shift_department" url="dmxConnect/api/servo_reporting/product_report_shift_department.php" dmx-param:department_id="session_variables.data.user_department_id" dmx-param:sort="" dmx-param:dir="'DESC'" dmx-param:shift_id="session_variables.data.current_shift" dmx-param:shift="list_user_shift_info.data.query_list_user_shift[0].servo_shifts_shift_id" dmx-param:department_user="list_user_shift_info.data.query_list_user_shift[0].servo_user_user_id"></dmx-serverconnect>
  <dmx-serverconnect id="product_report_shift_department_accessories" url="dmxConnect/api/servo_reporting/product_report_shift_department_accessories.php" dmx-param:department_id="session_variables.data.user_department_id" dmx-param:sort="" dmx-param:dir="'DESC'" dmx-param:shift_id="session_variables.data.current_shift" dmx-param:shift="list_user_shift_info.data.query_list_user_shift[0].servo_shifts_shift_id" dmx-param:department_user="list_user_shift_info.data.query_list_user_shift[0].servo_user_user_id" dmx-param:department="list_user_info.data.query_list_user_info.servo_user_departments_department_id"></dmx-serverconnect>
  <dmx-serverconnect id="product_report_shift_department_grouped" url="dmxConnect/api/servo_reporting/product_report_shift_department_grouped.php" dmx-param:department_id="session_variables.data.user_department_id" dmx-param:sort="" dmx-param:dir="'DESC'" dmx-param:shift_id="session_variables.data.current_shift" dmx-param:shift="list_user_shift_info.data.query_list_user_shift[0].servo_shifts_shift_id" dmx-param:department_user="list_user_shift_info.data.query_list_user_shift[0].servo_user_user_id" dmx-param:department="list_user_info.data.query_list_user_info.servo_user_departments_department_id"></dmx-serverconnect>
  <dmx-serverconnect id="list_sdc_profile" url="dmxConnect/api/servo_service_department_category/load_sdc_profile.php" dmx-param:department_id="session_variables.data.user_department_id"></dmx-serverconnect>
  <dmx-serverconnect id="list_order_items_shift_all_processing" url="dmxConnect/api/servo_order_items/list_order_items_shift_all_processing.php" dmx-param:current_shift="session_variables.data.current_shift" dmx-param:department_id="session_variables.data.user_department_id" dmx-param:user_department_id="session_variables.data.user_department_id" dmx-param:sort="list_order_items_shift_all.data.query[0].order_time_ordered" dmx-param:dir="" dmx-param:shift_id="session_variables.data.current_shift"></dmx-serverconnect>
  <dmx-serverconnect id="list_order_items_shift_all_ready" url="dmxConnect/api/servo_order_items/list_order_items_shift_all_ready.php" dmx-param:current_shift="session_variables.data.current_shift" dmx-param:department_id="session_variables.data.user_department_id" dmx-param:user_department_id="session_variables.data.user_department_id" dmx-param:sort="list_order_items_shift_all.data.query[0].order_time_ordered" dmx-param:dir="" dmx-param:shift_id="session_variables.data.current_shift"></dmx-serverconnect>
  <dmx-scheduler id="scheduler1" dmx-on:tick="list_order_items_shift_all.load()" delay="10"></dmx-scheduler>
  <dmx-datetime id="var1"></dmx-datetime>
  <dmx-serverconnect id="total_sales_per_waiter_in_per_shift" url="dmxConnect/api/servo_data/total_sales_per_waiter_in_per_shift.php" dmx-param:user_id="session_variables.data.user_id" dmx-param:current_shift="session_variables.data.current_shift" dmx-param:order_status="'Paid'"></dmx-serverconnect>
  <dmx-serverconnect id="total_sales_per_waiter_out_per_shift" url="dmxConnect/api/servo_data/total_sales_per_waiter_out_per_shift.php" dmx-param:user_id="session_variables.data.user_id" dmx-param:current_shift="session_variables.data.current_shift" dmx-param:order_status="'Ordered'"></dmx-serverconnect>
  <dmx-serverconnect id="get_order_total" url="dmxConnect/api/servo_order_items/compute_order_total.php" dmx-param:order_id="session_variables.data.current_order"></dmx-serverconnect>
  <dmx-serverconnect id="list_order_items" url="dmxConnect/api/servo_order_items/list_order_items.php" dmx-param:order_id="read_item_order.data.query.order_id"></dmx-serverconnect>
  <dmx-session-manager id="session_variables"></dmx-session-manager>

  <div is="dmx-browser" id="browser1"></div>
  <dmx-notifications id="notifies1" timeout="100" position="bottom" extended-timeout="200"></dmx-notifications>
  <?php include 'header.php'; ?>
  <main>
    <div class="modal" id="productSalesShiftDepartment" is="dmx-bs5-modal" tabindex="-1">
      <div class="modal-dialog modal-lg modal-fullscreen-xl-down" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{trans.data.deliveryReport[lang.value]}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col">
                <ul class="nav nav-tabs nav-fill" id="navTabs1_tabs" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="navTabs1_1_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_1" role="tab" aria-controls="navTabs1_1" aria-selected="true" wappler-command="editContent">{{trans.data.Delivered[lang.value]}}</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="navTabs1_2_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_2" role="tab" aria-controls="navTabs1_2" aria-selected="false" wappler-command="editContent">{{trans.data.report[lang.value]}}</a>
                  </li>
                </ul>
                <div class="tab-content" id="navTabs1_content">
                  <div class="tab-pane fade show active" id="navTabs1_1" role="tabpanel">
                    <div class="row">
                      <h1></h1>
                    </div>
                    <div class="table-responsive">
                      <table class="table table-hover table-sm">
                        <thead>
                          <tr>
                            <th wappler-command="editContent">{{trans.data.Ordered[lang.value]}}</th>
                            <th wappler-command="editContent">{{trans.data.Ready[lang.value]}}</th>
                            <th wappler-command="editContent">{{trans.data.Delivered[lang.value]}}</th>
                            <th wappler-command="editContent">{{trans.data.product[lang.value]}}</th>
                            <th wappler-command="editContent">{{trans.data.quantity[lang.value]}}</th>
                            <th wappler-command="editContent">{{trans.data.order[lang.value]}}</th>
                            <th wappler-command="editContent">{{trans.data.customer[lang.value]}}</th>
                            <th wappler-command="editContent">{{trans.data.status[lang.value]}}</th>
                            <th wappler-command="editContent">{{trans.data.attention[lang.value]}}</th>
                            <th wappler-command="editContent">{{trans.data.table[lang.value]}}</th>
                          </tr>
                        </thead>
                        <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="product_report_shift_department.data.product_report" id="tableRepeat1">
                          <tr>
                            <td dmx-text="order_time_ordered" wappler-command="editContent"></td>
                            <td dmx-text="order_time_ready" wappler-command="editContent"></td>
                            <td dmx-text="order_time_delivered" wappler-command="editContent"></td>
                            <td dmx-text="product_name" wappler-command="editContent"></td>
                            <td dmx-text="order_item_quantity" wappler-command="editContent"></td>
                            <td dmx-text="order_id" wappler-command="editContent"></td>
                            <td dmx-text="customer_first_name+' '+customer_last_name" wappler-command="editContent"></td>
                            <td dmx-text="order_status" wappler-command="editContent"></td>
                            <td dmx-text="user_username" wappler-command="editContent"></td>
                            <td dmx-text="table_name" wappler-command="editContent"></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="navTabs1_2" role="tabpanel" wappler-empty="Tab Pane" wappler-command="addElementInside">

                    <div class="row mt-2">
                      <h4 dmx-text="trans.data.total[lang.value]+': '+(product_report_shift_department.data.product_report.count)">{{trans.data.products[lang.value]}}</h4>
                      <div class="col">
                        <div class="table-responsive">
                          <table class="table table-hover table-sm">
                            <thead>
                              <tr>
                                <th>{{trans.data.product[lang.value]}}</th>
                                <th>{{trans.data.category[lang.value]}}</th>
                                <th>{{trans.data.quantity[lang.value]}}</th>
                              </tr>
                            </thead>
                            <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="product_report_shift_department_grouped.data.product_report_grouped" id="tableRepeat3">
                              <tr>
                                <td dmx-text="product_name"></td>
                                <td dmx-text="product_category_name"></td>
                                <td dmx-text="quantity"></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <h4>{{trans.data.accessories[lang.value]}}</h4>
                      <div class="col">
                        <div class="table-responsive">
                          <table class="table table-hover table-sm">
                            <thead>
                              <tr>
                                <th>{{trans.data.product[lang.value]}}</th>
                                <th>{{trans.data.category[lang.value]}}</th>
                                <th>{{trans.data.quantity[lang.value]}}</th>
                              </tr>
                            </thead>
                            <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="product_report_shift_department_accessories.data.product_report" id="tableRepeat2">
                              <tr>
                                <td dmx-text="product_name"></td>
                                <td dmx-text="product_category_name"></td>
                                <td dmx-text="Volume"></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="navTabs1_3" role="tabpanel" wappler-empty="Tab Pane" wappler-command="addElementInside">
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
  <main style="">
    <div class="container mt-auto" style="max-width: 98% !important; width: 98% !important; overflow-x: overflow;">




      <div class="row servo-page-header mt-2">
        <div class="d-flex  justify-content-start align-self-center align-items-center">
          <h5 class="me-2 pt-2 pb-2 ps-3 pe-3 rounded" dmx-text="session_variables.data.user_department">&nbsp;{{session_variables.data.current_shift}}</h5>
          <button id="btn4" class="btn w-auto text-info bg-info bg-opacity-10" data-bs-toggle="modal" data-bs-target="#productSalesShiftDepartment" dmx-on:click="product_report_shift_department.load({shift: list_user_shift_info.data.query_list_user_shift[0].servo_shifts_shift_id, department_user: list_user_shift_info.data.query_list_user_shift[0].servo_user_user_id}); product_report_shift_department_grouped.load({shift: list_user_shift_info.data.query_list_user_shift[0].servo_shifts_shift_id, department_user: list_user_shift_info.data.query_list_user_shift[0].servo_user_user_id});product_report_shift_department_accessories.load({shift: list_user_shift_info.data.query_list_user_shift[0].servo_shifts_shift_id, department: list_user_info.data.query_list_user_info.servo_user_departments_department_id})">
            <i class="fas fa-chart-line fa-sm"></i>
          </button>

        </div>
      </div>
      <div class="row justify-content-start y-scroll flex-nowrap scrollable" style="height: auto; overflow: scroll;">
        <div class="col border-danger ">
          <div class="row rounded text-danger pt-2 pb-1">
            <h5 dmx-text="trans.data.Ordered[lang.value]+': '+(list_order_items_shift_all.data.query.where(`order_item_group_type`, 'Ingredient', '!==')).count()" class="text-center fw-bold"></h5>
          </div>
          <div class="row scrollable">
            <div dmx-repeat:repeat1="list_order_items_shift_all.data.query.where(`order_item_group_type`, 'Ingredient', '!==')">
              <main>
                <div class="row justify-content-start" style="">
                  <div class="col rounded-2 border-secondary execution-card mt-1 mb-1 me-2 pt-2 pb-3 ps-3 pe-3 shadow-none bg-opacity-75 bg-light" dmx-animate-enter.delay:500.duration:500="pulse" dmx-class:main-group-product="order_item_group_type=='Main'" dmx-class:accessory-product="order_item_group_type=='Accessory'">


                    <div class="row">

                      <div class="col">



                        <div class="row">
                          <div class="col">
                            <h6 class="fw-bold me-3 pt-1 pb-1 ps-1 pe-1 text-body"><i class="far fa-user fa-sm" style="margin-right: 5px;"></i>{{user_username}}

                            </h6>

                            <h6 class="fw-bold text-info"><i class="fas fa-user-alt fa-sm" style="margin-right: 5px;"></i>{{customer_first_name}} {{customer_last_name}}

                            </h6>


                          </div>

                        </div>
                        <div class="row">
                          <div class="col">
                            <h6 dmx-text="'#'+order_id+' | '+table_name" class="fw-bold text-body"><i class="fas fa-clipboard-list fa-lg"></i>

                            </h6>
                            <h6 dmx-text="order_time_ordered" class="fw-bold text-body"></h6>
                          </div>
                        </div>


                      </div>
                      <div class="col rounded mt-1 me-1 pt-1 bg-light">
                        <h4 dmx-text="order_item_quantity+' x'" class="fw-bolder text-center text-success"></h4>
                        <h5 dmx-text="product_name" class="text-center fw-bolder"></h5>
                        <h6 dmx-text="order_item_notes" class="fw-bold text-center bg-opacity-10 rounded ms-1 me-1 pt-1 pb-1 ps-1 pe-1 text-danger">

                        </h6>
                        <form id="update_order_item_to_processing" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_order_items/update_order_item_to_processing.php" dmx-on:success="notifies1.success('Success');list_order_items_shift_all.load();list_order_items_shift_all_processing.load({})">

                          <input id="UserPrepared" name="servo_user_user_prepared_id" type="text" class="form-control visually-hidden" dmx-bind:value="session_variables.data.user_id">
                          <input id="OrderItemStatus" name="order_item_status" type="text" class="form-control visually-hidden" dmx-bind:value="'Processing'">
                          <input id="OrderTimeProcessing" name="order_time_processing" type="text" class="form-control visually-hidden" dmx-bind:value="var1.datetime">
                          <input id="OrderItemId" name="order_item_id" type="text" class="form-control visually-hidden" dmx-bind:value="order_item_id">
                          <input id="OrderItemId3" name="order_item_id1" type="text" class="form-control visually-hidden" dmx-bind:value="order_item_id">
                          <div class="row justify-content-end mb-2 ms-3 me-3"><button id="btn1" class="btn align-self-baseline bg-danger text-danger bg-opacity-10" type="submit"><i class="far fa-eye fa-sm"></i>
                            </button>
                          </div>
                        </form>

                      </div>

                      <div>
                        <div>

                        </div>
                      </div>

                    </div>



                  </div>

                </div>

              </main>
            </div>
          </div>




        </div>
        <div class="col border-warning">
          <div class="row rounded text-info pt-2 pb-1">
            <h5 dmx-text="trans.data.Processing[lang.value]+': '+list_order_items_shift_all_processing.data.query.count()" class="text-center fw-bold"></h5>
          </div>
          <div class="row scrollable">
            <div dmx-repeat:repeat1="list_order_items_shift_all_processing.data.query">
              <main>
                <div class="row justify-content-start">
                  <div class="col rounded rounded-3 execution-card bg-light bg-opacity-75 mt-1 mb-1 ms-2 me-2 pt-1 pb-1 ps-2 pe-2" dmx-animate-leave="slideOutRight" dmx-animate-enter.duration:100.delay:50="slideInLeft" dmx-class:main-group-product="order_item_group_type=='Main'" dmx-class:accessory-product="order_item_group_type=='Accessory'">
                    <div class="row justify-content-center">
                      <div class="col mt-1 ms-1">
                        <div class="row">
                          <div class="col">
                            <h6 class="fw-bold me-3 pt-1 pb-1 ps-1 pe-1 text-body"><i class="far fa-user fa-sm" style="margin-right: 5px;"></i>{{user_username}}

                            </h6>

                            <h6 class="fw-bold text-info"><i class="fas fa-user-alt fa-sm" style="margin-right: 5px;"></i>{{customer_first_name}} {{customer_last_name}}

                            </h6>


                          </div>

                        </div>
                        <div class="row">
                          <div class="col">
                            <h6 dmx-text="'#'+order_id+' | '+table_name" class="fw-bold text-body"><i class="fas fa-clipboard-list fa-lg"></i>

                            </h6>
                            <h6 dmx-text="order_time_processing" class="text-body fw-bold"></h6>
                          </div>
                        </div>
                        <form id="update_order_item_to_ordered" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_order_items/update_order_item_to_ready.php" dmx-on:success="list_order_items_shift_all_processing.load({});list_order_items_shift_all.load({});notifies1.success('Success')">

                          <input id="OrderItemStatus4" name="order_item_status" type="text" class="form-control visually-hidden" dmx-bind:value="'Ordered'">
                          <input id="OrderItemId5" name="order_item_id" type="text" class="form-control visually-hidden" dmx-bind:value="order_item_id">
                          <div class="row justify-content-end mb-1 ms-3 me-3"><button id="btn6" class="btn align-self-baseline bg-opacity-10 text-danger bg-danger" type="submit"><i class="fas fa-ban"></i>
                            </button>
                          </div>
                        </form>


                      </div>
                      <div class="col bg-light rounded mt-2 mb-2 ms-2 me-3 pt-1 pb-1 ps-1 pe-1">
                        <h4 dmx-text="order_item_quantity+' x '" class="text-center fw-bolder text-success"></h4>
                        <h5 dmx-text="product_name" class="text-center fw-bolder"></h5>
                        <h6 dmx-text="order_item_notes" class="fw-bold text-center rounded bg-opacity-10 ms-1 me-1 pt-1 pb-1 ps-1 pe-1 text-danger">
                        </h6>
                        <form id="update_order_item_to_ready" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_order_items/update_order_item_to_ready.php" dmx-on:success="list_order_items_shift_all_processing.load();list_order_items_shift_all_ready.load();notifies1.success('Success')">

                          <input id="OrderItemStatus1" name="order_item_status" type="text" class="form-control visually-hidden" dmx-bind:value="'Ready'">
                          <input id="OrderTimeReady" name="order_time_ready" type="text" class="form-control visually-hidden" dmx-bind:value="var1.datetime">
                          <input id="OrderItemId1" name="order_item_id" type="text" class="form-control visually-hidden" dmx-bind:value="order_item_id">
                          <div class="row justify-content-end mb-1 ms-3 me-3"><button id="btn2" class="btn align-self-baseline bg-opacity-10 bg-primary text-primary" type="submit"><i class="far fa-bell fa-sm"></i>
                            </button>
                          </div>
                        </form>

                      </div>

                      <div>
                        <div>

                        </div>
                      </div>
                    </div>



                  </div>

                </div>
              </main>
            </div>
          </div>



        </div>
        <div class="col border-success">
          <div class="row rounded text-success pt-2 pb-1">
            <h5 dmx-text="trans.data.Ready[lang.value]+': '+list_order_items_shift_all_ready.data.query.count()" class="text-center fw-bold"></h5>
          </div>
          <div class="row scrollable">
            <div dmx-repeat:repeat1="list_order_items_shift_all_ready.data.query">
              <main>
                <div class="row justify-content-start">
                  <div class="col mt-1 mb-1 me-2 pt-1 pb-1 ps-2 pe-2 rounded-3 rounded execution-card bg-light text-light bg-opacity-75" dmx-animate-enter.delay:100.duration:100="slideInLeft" dmx-class:main-group-product="order_item_group_type=='Main'" dmx-class:accessory-product="order_item_group_type=='Accessory'">
                    <div class="row justify-content-center">
                      <div class="col">
                        <div class="row">
                          <div class="col">
                            <h6 class="fw-bold me-3 pt-1 pb-1 ps-1 pe-1 text-body"><i class="far fa-user fa-sm" style="margin-right: 5px;"></i>{{user_username}}

                            </h6>

                            <h6 class="fw-bold text-info"><i class="fas fa-user-alt fa-sm" style="margin-right: 5px;"></i>{{customer_first_name}} {{customer_last_name}}

                            </h6>


                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <h6 dmx-text="'#'+order_id+' | '+table_name" class="fw-bold text-body"><i class="fas fa-clipboard-list fa-lg"></i>

                            </h6>
                            <h6 dmx-text="order_time_ready" class="text-body fw-bold"></h6>
                          </div>
                        </div>
                        <form id="update_order_item_to_processing1" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_order_items/update_order_item_to_processing.php" dmx-on:success="notifies1.success('Success');list_order_items_shift_all.load();list_order_items_shift_all_processing.load({});list_order_items_shift_all_ready.load()">

                          <input id="UserPrepared1" name="servo_user_user_prepared_id" type="text" class="form-control visually-hidden" dmx-bind:value="session_variables.data.user_id">
                          <input id="OrderItemStatus3" name="order_item_status" type="text" class="form-control visually-hidden" dmx-bind:value="'Processing'">
                          <input id="OrderTimeProcessing1" name="order_time_processing" type="text" class="form-control visually-hidden" dmx-bind:value="var1.datetime">
                          <input id="OrderItemId4" name="order_item_id" type="text" class="form-control visually-hidden" dmx-bind:value="order_item_id">
                          <input id="OrderItemId41" name="order_item_id" type="text" class="form-control visually-hidden" dmx-bind:value="order_item_id">
                          <div class="row justify-content-end mb-2 ms-3 me-3"><button id="btn5" class="btn align-self-baseline bg-danger text-danger bg-opacity-10" type="submit"><i class="fas fa-times-circle"></i>
                            </button>
                          </div>
                        </form>


                      </div>
                      <div class="col bg-light rounded mt-2 mb-2 ms-2 me-3">
                        <h4 dmx-text="order_item_quantity+' x '" class="fw-bolder text-center text-success"></h4>
                        <h5 dmx-text="product_name" class="text-center fw-bolder text-body"></h5>
                        <h6 dmx-text="order_item_notes" class="fw-bold text-center text-danger"></h6>



                        <form id="update_order_item_to_delivered" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_order_items/update_order_item_to_delivered.php" dmx-on:success="notifies1.success('Success!');list_order_items_shift_all_ready.load();">

                          <input id="OrderItemStatus2" name="order_item_status" type="text" class="form-control visually-hidden" dmx-bind:value="'Processing'">
                          <input id="OrderTimeDelivered" name="order_time_delivered" type="text" class="form-control visually-hidden" dmx-bind:value="var1.datetime">
                          <input id="OrderItemId2" name="order_item_id" type="text" class="form-control visually-hidden" dmx-bind:value="order_item_id">
                          <div class="row justify-content-center mb-2 ms-3 me-3"><button id="btn3" class="btn align-self-baseline text-success bg-success bg-opacity-10" type="submit"><i class="far fa-thumbs-up fa-sm"></i>
                            </button>
                          </div>
                        </form>
                      </div>
                      <div>
                        <div>

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
    </div>
  </main>
  <script src="bootstrap/5/js/bootstrap.min.js"></script>
</body>

</html>