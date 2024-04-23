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
			"options": {"permissions":"Manager","loginUrl":"Login.php","forbiddenUrl":"Login.php","provider":"servo_login"}
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
  <link rel="stylesheet" href="fontawesome5/css/all.min.css" />
  <script src="dmxAppConnect/dmxBootstrap5PagingGenerator/dmxBootstrap5PagingGenerator.js" defer=""></script>
  <link rel="stylesheet" href="bootstrap/5/servodark/bootstrap.min.css" />


  <link rel="stylesheet" href="css/bootstrap-icons.css" />

</head>

<body id="vendors" is="dmx-app">
  <dmx-query-manager id="vendorList"></dmx-query-manager>
  <dmx-session-manager id="vendor_session_variables"></dmx-session-manager>
  <dmx-session-manager id="session_variables"></dmx-session-manager>

  <dmx-value id="lang" dmx-bind:value="browser1.language"></dmx-value>
  <dmx-json-datasource id="trans" is="dmx-serverconnect" url="assets/translation/translation.JSON"></dmx-json-datasource>

  <dmx-serverconnect id="read_vendor" url="dmxConnect/api/servo_vendors/read_vendor.php" dmx-param:id="id" noload dmx-param:item_id="" dmx-param:branch_id="read_item_branch.data.queryReadBranch.branch_id" dmx-param:vendor_id="vendor_session_variables.data.current_vendor"></dmx-serverconnect>
  <dmx-serverconnect id="delete_item_table" url="dmxConnect/api/servo_tables/delete_table.php"></dmx-serverconnect>
  <dmx-serverconnect id="list_vendors" url="dmxConnect/api/servo_vendors/list_vendors_page.php" dmx-param:offset="vendorList.data.offset" dmx-param:limit="vendor_sort_limit.value" dmx-param:vendorfilter="vendorfilter.value"></dmx-serverconnect>
  <div is="dmx-browser" id="browser1"></div>
  <dmx-notifications id="notifies1"></dmx-notifications>
  <?php include 'header.php'; ?><main class="mt-4">
    <div class="modal create-modal" id="createItemModal" is="dmx-bs5-modal" tabindex="-1">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-body">{{trans.data.create[lang.value]}} {{trans.data.vendor[lang.value]}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <form is="dmx-serverconnect-form" id="Form_createVendor" method="post" action="dmxConnect/api/servo_vendors/create_vendor.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-on:success="list_vendors.load();notifies1.success('Success'); createItemModal.hide()">
                <div class="mb-3 row">
                  <label for="inp_vendor_name" class="col-sm-2 col-form-label">{{trans.data.name[lang.value]}}</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inp_vendor_name" name="vendor_name" aria-describedby="inp_table_name_help">
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="inp_vendor_address1" class="col-sm-2 col-form-label">{{trans.data.companyPhone[lang.value]}}</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inp_vendor_address1" name="vendor_phone_number" aria-describedby="inp_table_name_help">
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="inp_vendor_address" class="col-sm-2 col-form-label">{{trans.data.address[lang.value]}}</label>
                  <div class="col-sm-10">
                    <textarea type="text" class="form-control" id="inp_vendor_address" name="vendor_address" aria-describedby="inp_table_name_help"></textarea>
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

          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>
    <div class="modal readitem" id="readItemModal" is="dmx-bs5-modal" tabindex="-1" dmx-on:hide-bs-modal="list_vendors.load()">
      <div class="modal-dialog modal-xl modal-fullscreen-xxl-down" role="document" style="margin: 0px !important; width: 100% !important; height: 99% !important; max-width: 100% !important; max-height: 99% !important;">
        <div class="modal-content" style="max-height: 100% !important; height: 100% !important;">
          <div class="modal-header">
            <h4 class="modal-title text-body">{{trans.data.vendor[lang.value]}} | {{read_vendor.data.read_vendor.vendor_name}}</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <h1 class="detail-heading">{{read_item_table.data.query_read_table.table_name}}</h1>
          <div class="modal-body">
            <div class="row">
              <div class="col">
                <ul class="nav nav-tabs" id="navTabs1_tabs" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="navTabs1_1_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_1" role="tab" aria-controls="navTabs1_1" aria-selected="true">{{trans.data.info[lang.value]}}</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="navTabs1_2_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_2" role="tab" aria-controls="navTabs1_2" aria-selected="false">{{trans.data.orders[lang.value]}}</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="navTabs1_3_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_3" role="tab" aria-controls="navTabs1_3" aria-selected="false">{{trans.data.reports[lang.value]}}</a>
                  </li>
                </ul>
                <div class="tab-content" id="navTabs1_content">
                  <div class="tab-pane fade show active" id="navTabs1_1" role="tabpanel">
                    <div class="row mt-2">
                      <form is="dmx-serverconnect-form" id="readVendor" method="post" action="dmxConnect/api/servo_vendors/update_vendor.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="read_vendor.data.read_vendor" dmx-on:success="read_vendor.load({vendor_id: vendor_session_variables.data.current_vendor});notifies1.success('Success!')">
                        <div class="mb-3 row">
                          <label for="inp_vendor_id" class="col-sm-2 col-form-label">#</label>
                          <div class="col-sm-10">
                            <input type="number" class="form-control" id="inp_vendor_id" name="vendor_id" dmx-bind:value="read_vendor.data.read_vendor.vendor_id" aria-describedby="inp_vendor_id_help" readonly="true">
                          </div>
                        </div>
                        <div class="mb-3 row">
                          <label for="inp_vendor_name_edit" class="col-sm-2 col-form-label">{{trans.data.name[lang.value]}}</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="inp_vendor_name_edit" name="vendor_name" dmx-bind:value="read_vendor.data.read_vendor.vendor_name" aria-describedby="inp_vendor_name_help">
                          </div>
                        </div>
                        <div class="mb-3 row">
                          <label for="inp_vendor_address" class="col-sm-2 col-form-label">{{trans.data.companyPhone[lang.value]}}</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="inp_vendor_address_edit1" name="vendor_phone_number" dmx-bind:value="read_vendor.data.read_vendor.vendor_phone_number" aria-describedby="inp_vendor_address_help">
                          </div>
                        </div>
                        <div class="mb-3 row">
                          <label for="inp_vendor_address" class="col-sm-2 col-form-label">{{trans.data.address[lang.value]}}</label>
                          <div class="col-sm-6">
                            <textarea type="text" class="form-control" id="inp_vendor_address_edit" name="vendor_address" dmx-bind:value="read_vendor.data.read_vendor.vendor_address" aria-describedby="inp_vendor_address_help"></textarea>
                          </div>
                        </div>

                        <div class="mb-3 row">
                          <div class="col-sm-2">&nbsp;</div>
                          <div class="col-sm-10">
                            <button type="submit" class="btn btn-info" dmx-bind:value="read_vendor.data.read_vendor.Save"><i class="fas fa-check fa-lg"></i></button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="navTabs1_2" role="tabpanel">
                  </div>
                  <div class="tab-pane fade" id="navTabs1_3" role="tabpanel">
                  </div>
                </div>
              </div>
            </div>

          </div>
          <div class="modal-footer">
            <form id="form1" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_vendors/delete_vendor.php" dmx-on:success="notifies1.success('Success');list_vendors.load({});readItemModal.hide()" onsubmit=" return confirm('CONFIRM DELETE?');">
              <input id="text1" name="vendor_id" type="hidden" class="form-control" dmx-bind:value="read_vendor.data.read_vendor.vendor_id">

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
    <div class="mt-auto ms-2 me-2">

      <div class="row servo-page-header">
        <div class="col-auto" dmx-animate-enter.duration:6.delay:5="slideInLeft">
          <i class="bi-truck" style="font-size:30px;"></i>
        </div>
        <div class="col-auto page-heading">
          <h3 class="servo-page-heading fw-light">{{trans.data.vendors[lang.value]}}</h3>
        </div>
        <div class="col style13 page-button" id="pagebuttons">
          <button id="btn1" class="btn style12 fw-light add-button text-body bg-secondary ps-4 pe-4" data-bs-toggle="modal" data-bs-target="#createItemModal" style="float: right;"><i class="bi-plus" style="font-size:20px;"></i></button>

        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="row justify-content-sm-between justify-content-md-between justify-content-lg-between justify-content-xl-between justify-content-xxl-between mt-2 justify-content-between sorter shadow-none bg-light rounded">
            <div class="col-lg-3 col-12 col-sm-12"><input id="vendorfilter" name="vendorfilter" type="text" class="form-control mb-2 form-control-sm" dmx-bind:placeholder="trans.data.search[lang.value]+'  '"></div>

            <div class="d-flex flex-sm-wrap col-lg-7 justify-content-lg-end col-xl-6 justify-content-xl-end justify-content-xxl-end flex-wrap col-sm col-md col">
              <ul class="pagination" dmx-populate="list_vendors.data.query_list_vendors" dmx-state="vendorList" dmx-offset="offset" dmx-generator="bs5paging">
                <li class="page-item" dmx-class:disabled="list_vendors.data.query_list_vendors.page.current == 1" aria-label="First">
                  <a href="javascript:void(0)" class="page-link" dmx-on:click="vendorList.set('offset',list_vendors.data.query_list_vendors.page.offset.first)"><span aria-hidden="true">&lsaquo;&lsaquo;</span></a>
                </li>
                <li class="page-item" dmx-class:disabled="list_vendors.data.query_list_vendors.page.current == 1" aria-label="Previous">
                  <a href="javascript:void(0)" class="page-link" dmx-on:click="vendorList.set('offset',list_vendors.data.query_list_vendors.page.offset.prev)"><span aria-hidden="true">&lsaquo;</span></a>
                </li>
                <li class="page-item" dmx-class:active="title == list_vendors.data.query_list_vendors.page.current" dmx-class:disabled="!active" dmx-repeat="list_vendors.data.query_list_vendors.getServerConnectPagination(2,1,'...')">
                  <a href="javascript:void(0)" class="page-link" dmx-on:click="vendorList.set('offset',(page-1)*list_vendors.data.query_list_vendors.limit)">{{title}}</a>
                </li>
                <li class="page-item" dmx-class:disabled="list_vendors.data.query_list_vendors.page.current ==  list_vendors.data.query_list_vendors.page.total" aria-label="Next">
                  <a href="javascript:void(0)" class="page-link" dmx-on:click="vendorList.set('offset',list_vendors.data.query_list_vendors.page.offset.next)"><span aria-hidden="true">&rsaquo;</span></a>
                </li>
                <li class="page-item" dmx-class:disabled="list_vendors.data.query_list_vendors.page.current ==  list_vendors.data.query_list_vendors.page.total" aria-label="Last">
                  <a href="javascript:void(0)" class="page-link" dmx-on:click="vendorList.set('offset',list_vendors.data.query_list_vendors.page.offset.last)"><span aria-hidden="true">&rsaquo;&rsaquo;</span></a>
                </li>
              </ul>
            </div>
            <div class="col-lg-1 col-xl-1 col-md-2 col-sm-2 col-3 offset-lg-1"><select id="vendor_sort_limit" class="form-select" name="vendor_sort_limit">
                <option value="5">5</option>
                <option selected="" value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
                <option value="''">{{trans.data.all[lang.value]}}</option>
              </select></div>
          </div>


          <div class="table-responsive servo-shadow">
            <table class="table table-hover table-sm table-borderless shadow-none">
              <thead>
                <tr>
                  <th>#</th>
                  <th>{{trans.data.vendor[lang.value]}}</th>
                  <th>{{trans.data.address[lang.value]}}</th>
                  <th>{{trans.data.companyPhone[lang.value]}}</th>
                  <th></th>
                </tr>
              </thead>
              <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_vendors.data.query_list_vendors.data" id="tableRepeat1">
                <tr>
                  <td dmx-text="vendor_id"></td>
                  <td dmx-text="vendor_name"></td>
                  <td dmx-text="vendor_address"></td>
                  <td dmx-text="vendor_phone_number"></td>
                  <td>
                    <button id="btn2" class="btn open" dmx-on:click="vendor_session_variables.set('current_vendor',vendor_id); readItemModal.show();read_vendor.load({vendor_id: vendor_id})" data-bs-target="#readItemModal"><i class="far fa-edit"></i>
                    </button>
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