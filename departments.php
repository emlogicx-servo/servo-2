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
  <link rel="stylesheet" href="fontawesome5/css/all.min.css" />
  <script src="https://js.stripe.com/v3/" defer></script>
  <script src="dmxAppConnect/dmxStripe/dmxStripe.js" defer=""></script>
  <script src="dmxAppConnect/dmxBootstrap5PagingGenerator/dmxBootstrap5PagingGenerator.js" defer=""></script>
</head>

<body is="dmx-app" id="departments">
  <dmx-query-manager id="listdepartments"></dmx-query-manager>
  <dmx-query-manager id="listservices"></dmx-query-manager>
  <dmx-serverconnect id="list_service_department_categories" url="dmxConnect/api/servo_service_department_category/list_service_department_categories.php" dmx-param:service_id="read_service.data.query_read_service.service_id"></dmx-serverconnect>
  <dmx-serverconnect id="list_services" url="dmxConnect/api/servo_services/list_services_paged.php" dmx-param:offset="listservices.data.offset" dmx-param:limit="service_sort_limit.value" dmx-param:servicefilter="servicefilter.value"></dmx-serverconnect>

  <dmx-value id="lang" dmx-bind:value="browser1.language"></dmx-value>
  <dmx-json-datasource id="trans" is="dmx-serverconnect" url="assets/translation/translation.JSON"></dmx-json-datasource>

  <dmx-serverconnect id="list_department_categories" url="dmxConnect/api/servo_department_categories/list_department_categories.php" dmx-param:department_id="read_item_department.data.query.department_id"></dmx-serverconnect>
  <dmx-serverconnect id="delete_department_category" url="dmxConnect/api/servo_department_categories/delete_department_category.php" dmx-param:department_id="read_item_department.data.query.department_id" dmx-param:id="list_department_categories.data.query_list_department_categories[0].id"></dmx-serverconnect>

  <dmx-serverconnect id="load_product_categories" url="dmxConnect/api/servo_refered_fields_loading/load_product_categories.php"></dmx-serverconnect>
  <dmx-serverconnect id="read_item_department" url="dmxConnect/api/servo_departments/read_department.php" dmx-param:id="id" noload dmx-param:item_id="" dmx-param:branch_id="read_item_branch.data.queryReadBranch.branch_id" dmx-param:department_id=""></dmx-serverconnect>
  <dmx-serverconnect id="read_service" url="dmxConnect/api/servo_services/read_service.php" dmx-param:id="id" noload="" dmx-param:item_id="" dmx-param:branch_id="read_item_branch.data.queryReadBranch.branch_id" dmx-param:department_id=""></dmx-serverconnect>
  <dmx-serverconnect id="delete_item_department" url="dmxConnect/api/servo_departments/delete_department.php"></dmx-serverconnect>
  <dmx-serverconnect id="list_departments" url="dmxConnect/api/servo_departments/list_departments_paged.php" dmx-param:offset="listdepartments.data.offset" dmx-param:limit="department_sort_limit.value" dmx-param:departmentfilter="departmentfilter.value"></dmx-serverconnect>
  <dmx-serverconnect id="load_departments" url="dmxConnect/api/servo_departments/list_departments.php" dmx-param:offset="listdepartments.data.offset" dmx-param:limit="department_sort_limit.value" dmx-param:departmentfilter="departmentfilter.value"></dmx-serverconnect>
  <dmx-serverconnect id="list_sales_points" url="dmxConnect/api/servo_sales_points/list_sales_points.php"></dmx-serverconnect>
  <div is="dmx-browser" id="browser1"></div>
  <dmx-notifications id="notifies1"></dmx-notifications>
  <?php include 'header.php'; ?><main class="mt-4">
    <div class="modal create-modal" id="createItemModal" is="dmx-bs5-modal" tabindex="-1">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-body">{{trans.data.createDepartment[lang.value]}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <form is="dmx-serverconnect-form" id="serverconnectFormCreateDepartment" method="post" action="dmxConnect/api/servo_departments/create_department.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-on:success="notifies1.success('Success');list_departments.load();createItemModal.hide()">
                <div class="mb-3 row">
                  <label for="inp_department_name" class="col-sm-2 col-form-label">{{trans.data.departmentName[lang.value]}}</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inp_department_name" name="department_name" aria-describedby="inp_department_name_help">
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
    <div class="modal readitem" id="readItemModal" is="dmx-bs5-modal" tabindex="-1">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title text-body">{{read_item_department.data.query.department_name}}</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">
            <div class="row">

              <form is="dmx-serverconnect-form" id="form_update_department" method="post" action="dmxConnect/api/servo_departments/update_department.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="read_item_department.data.query" dmx-on:success="notifies1.success('Success');list_departments.load({});readItemModal.hide()" class="d-flex">
                <div class="mb-3 row">
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="input1" name="department_name" aria-describedby="input1_help" dmx-bind:value="read_item_department.data.query.department_name">
                    <input type="text" class="form-control visually-hidden" id="input2" name="department_id" aria-describedby="input1_help" dmx-bind:value="read_item_department.data.query.department_id">
                  </div>
                </div>
                <div class="mb-3 row">
                  <div class="col-sm-10">
                    <button id="btn4" class="btn btn-success ms-2" type="submit">
                      <i class="fas fa-check"></i>
                    </button>
                  </div>

                </div>
              </form>
            </div>


          </div>
          <div class="modal-footer">
            <form id="form1" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_departments/delete_department.php" dmx-on:success="list_departments.load();notifies1.success('Success');readItemModal.hide()" onsubmit=" return confirm('CONFIRM DELETE?');">
              <input id="text1" name="department_id" type="hidden" class="form-control" dmx-bind:value="read_item_department.data.query.department_id">

              <button id="btn6" class="btn text-muted" type="submit">
                <i class="far fa-trash-alt fa-lg"></i>
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="modal readitem" id="serviceModal" is="dmx-bs5-modal" tabindex="-1">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title text-body" dmx-text="read_service.data.query_read_service.service_name"></h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">
            <div class="row">
              <form id="createServiceCategoryDepartment" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_service_department_category/create_service_department_category.php" class="d-flex" dmx-on:success="list_service_department_categories.load();notifies1.success('Success!')" dmx-on:error="notifies1.danger('Error!')">
                <input id="sdc_service_id" name="sdc_service_id" type="text" class="form-control visually-hidden" dmx-bind:value="read_service.data.query_read_service.service_id">
                <input id="sdcCode" name="sdc_code" type="text" class="form-control visually-hidden" dmx-bind:value="createServiceCategoryDepartment.sdc_service_id.value+'@'+createServiceCategoryDepartment.select5.value+'@'+createServiceCategoryDepartment.select6.value">
                <select id="select5" class="form-select" name="sdc_category_id" optiontext="product_category_name" optionvalue="product_categories_id" dmx-bind:options="load_product_categories.data.query">
                  <option selected="" value="">{{trans.data.category[lang.value]}}</option>
                </select>
                <select id="select6" class="form-select ms-2" name="sdc_department_id" dmx-bind:options="load_departments.data.query_list_departments" optiontext="department_name" optionvalue="department_id">
                  <option selected="" value="">{{trans.data.department[lang.value]}}</option>
                </select>


                <button id="btn12" class="btn btn-warning ms-2" type="submit">
                  <i class="fas fa-plus"></i>
                </button>
              </form>

            </div>
            <h4 class="mt-2">{{trans.data.serviceCategoryDepartements[lang.value]}}</h4>
            <div class="row mt-2">
              <div class="table-responsive">
                <table class="table table-hover table-sm">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>{{trans.data.category[lang.value]}}</th>
                      <th>{{trans.data.department[lang.value]}}</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_service_department_categories.data.query" id="tableRepeat3">
                    <tr>
                      <td dmx-text="service_department_category_id"></td>
                      <td>
                        <form id="updatesdcCategory" class="d-flex" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_service_department_category/update_service_department_category_category.php" dmx-on:success="list_service_department_categories.load({service_id: read_service.data.query_read_service.service_id});notifies1.success('Success!')">

                          <select id="select7" class="form-select ms-2" name="sdc_category_id" optiontext="product_category_name" optionvalue="product_categories_id" dmx-bind:options="load_product_categories.data.query" dmx-bind:value="sdc_category_id">
                            <option selected="" value="">{{trans.data.category[lang.value]}}</option>
                          </select>
                          <input id="text10" name="service_department_category_id" type="text" class="form-control visually-hidden" dmx-bind:value="service_department_category_id"><button id="btn13" class="btn text-success" type="submit">
                            <i class="fas fa-check"></i>
                          </button>
                        </form>

                      </td>
                      <td>
                        <form id="updatesdcDepartment" class="d-flex" is="dmx-serverconnect-form" method="post" action="dmxConnect/api/servo_service_department_category/update_service_department_category_department.php" dmx-on:success="list_service_department_categories.load({service_id: read_service.data.query_read_service.service_id});notifies1.success('Success!')">

                          <select id="select8" class="form-select ms-2" name="sdc_department_id" dmx-bind:options="load_departments.data.query_list_departments" optiontext="department_name" optionvalue="department_id" dmx-bind:value="sdc_department_id">
                            <option selected="" value="">{{trans.data.department[lang.value]}}</option>
                          </select><input id="text11" name="service_department_category_id" type="text" class="form-control visually-hidden" dmx-bind:value="service_department_category_id"><button id="btn14" class="btn text-success" type="submit">
                            <i class="fas fa-check"></i>
                          </button>
                        </form>
                      </td>
                      <td>
                        <form id="form5" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_service_department_category/delete_service_department_category.php" dmx-on:success="list_service_department_categories.load();notifies1.success('Success!')">

                          <input id="text12" name="service_department_category_id" type="text" class="form-control visually-hidden" dmx-bind:value="service_department_category_id">
                          <button id="btn15" class="btn text-danger" type="submit"><i class="far fa-trash-alt"></i>
                          </button>
                        </form>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>


          </div>
          <div class="modal-footer">
            <form id="form2" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_services/delete_service.php" dmx-on:success="list_services.load();notifies1.success('Success');serviceModal.hide()" onsubmit=" return confirm('CONFIRM DELETE?');">
              <input id="text9" name="service_id" class="form-control visually-hidden" dmx-bind:value="read_service.data.query_read_service.service_id">

              <button id="btn11" class="btn text-danger" type="submit">
                <i class="far fa-trash-alt fa-lg"></i>
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>

  </main>
  <main>
    <div class="mt-auto ms-2 me-2 ps-2 pe-2">




      <div class="row servo-page-header">
        <div class="col-auto" dmx-animate-enter="slideInLeft">
          <i class="fas fa-sitemap fa-2x" style="color: #18ff92 !important;"></i>
        </div>
        <div class="col-auto page-heading">
          <h4 class="servo-page-heading">{{trans.data.businessSetup[lang.value]}}</h4>
        </div>
        <div class="col style13 page-button" id="pagebuttons">
          <button id="btn1" class="btn style12 fw-light text-body" data-bs-toggle="modal" data-bs-target="#createItemModal" style="float: right;"><i class="fas fa-plus style14 fa-lg"></i></button>
        </div>
      </div>

      <ul class="nav nav-tabs" id="navTabs1_tabs" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="navTabs1_1_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_1" role="tab" aria-controls="navTabs1_1" aria-selected="true">{{trans.data.departments[lang.value]}}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="navTabs1_2_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_2" role="tab" aria-controls="navTabs1_2" aria-selected="false">{{trans.data.services[lang.value]}}</a>
        </li>
      </ul>
      <div class="tab-content" id="navTabs1_content">
        <div class="tab-pane fade show active " id="navTabs1_1" role="tabpanel">
          <div class="row scrollable">
            <div class="col">
              <div class="row justify-content-sm-between justify-content-md-between justify-content-lg-between justify-content-xl-between justify-content-xxl-between sorter justify-content-between bg-light mt-2 ms-2 me-2 rounded">
                <div class="col-lg-3 col-12 col-sm-12"><input id="departmentfilter" name="departmentfilter" type="text" class="form-control mb-2 form-control-sm" dmx-bind:placeholder="trans.data.search[lang.value]+'  '"></div>

                <div class="d-flex flex-sm-wrap col-sm-5 col-md-5 col-lg-7 justify-content-lg-end col-xl-6 justify-content-xl-end justify-content-xxl-end flex-wrap col">
                  <ul class="pagination flex-wrap flex-sm-wrap flex-md-wrap" dmx-populate="list_departments.data.query_list_departments" dmx-state="listdepartments" dmx-offset="offset" dmx-generator="bs5paging">
                    <li class="page-item" dmx-class:disabled="list_departments.data.query_list_departments.page.current == 1" aria-label="First">
                      <a href="javascript:void(0)" class="page-link" dmx-on:click="listdepartments.set('offset',list_departments.data.query_list_departments.page.offset.first)"><span aria-hidden="true">‹‹</span></a>
                    </li>
                    <li class="page-item" dmx-class:disabled="list_departments.data.query_list_departments.page.current == 1" aria-label="Previous">
                      <a href="javascript:void(0)" class="page-link" dmx-on:click="listdepartments.set('offset',list_departments.data.query_list_departments.page.offset.prev)"><span aria-hidden="true">‹</span></a>
                    </li>
                    <li class="page-item" dmx-class:active="title == list_departments.data.query_list_departments.page.current" dmx-class:disabled="!active" dmx-repeat="list_departments.data.query_list_departments.getServerConnectPagination(2,1,'...')">
                      <a href="javascript:void(0)" class="page-link" dmx-on:click="listdepartments.set('offset',(page-1)*list_departments.data.query_list_departments.limit)">{{title}}</a>
                    </li>
                    <li class="page-item" dmx-class:disabled="list_departments.data.query_list_departments.page.current ==  list_departments.data.query_list_departments.page.total" aria-label="Next">
                      <a href="javascript:void(0)" class="page-link" dmx-on:click="listdepartments.set('offset',list_departments.data.query_list_departments.page.offset.next)"><span aria-hidden="true">›</span></a>
                    </li>
                    <li class="page-item" dmx-class:disabled="list_departments.data.query_list_departments.page.current ==  list_departments.data.query_list_departments.page.total" aria-label="Last">
                      <a href="javascript:void(0)" class="page-link" dmx-on:click="listdepartments.set('offset',list_departments.data.query_list_departments.page.offset.last)"><span aria-hidden="true">››</span></a>
                    </li>
                  </ul>
                </div>
                <div class="col-lg-1 col-xl-1 col-md-2 col-sm-2 col-3 offset-lg-1 me-lg-0 offset-sm-1"><select id="department_sort_limit" class="form-select" name="department_sort_limit">
                    <option value="5">5</option>
                    <option selected="" value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="''">{{trans.data.all[lang.value]}}</option>
                  </select></div>
              </div>
              <div class="row mt-2 ms-2 me-2">
                <div class="col bg-light rounded">


                  <div class="table-responsive">
                    <table class="table table-hover table-sm table-borderless">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>{{trans.data.departmentName[lang.value]}}</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_departments.data.query_list_departments.data" id="tableRepeat1">
                        <tr>
                          <td dmx-text="department_id"></td>
                          <td dmx-text="department_name"></td>
                          <td class="text-center">
                            <button id="btn2" class="btn open" data-bs-target="#productInfo" dmx-on:click="readItemModal.show();read_item_department.load({department_id: department_id})" dmx-bind:value="list_departments.data.query_list_departments[0].department_id"><i class="far fa-edit fa-sm"><br></i></button>
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
        <div class="tab-pane fade scrollable" id="navTabs1_2" role="tabpanel">
          <div class="row justify-content-sm-between justify-content-md-between justify-content-lg-between justify-content-xl-between justify-content-xxl-between mt-2 justify-content-between sorter bg-light">
            <div class="col-lg-3 col-sm-12 col-12"><input id="servicefilter" name="servicefilter" type="text" class="form-control mb-2 form-control-sm" dmx-bind:placeholder="trans.data.search[lang.value]+'  '"></div>

            <div class="d-flex flex-sm-wrap justify-content-lg-end justify-content-xl-end justify-content-xxl-end align-self-center flex-wrap col-sm flex-lg-wrap flex-xl-wrap col-xl col-lg col-md col">
              <ul class="pagination" dmx-populate="list_services.data.query_list_services" dmx-state="listdepartments" dmx-offset="offset" dmx-generator="bs5paging">
                <li class="page-item" dmx-class:disabled="list_services.data.query_list_services.page.current == 1" aria-label="First">
                  <a href="javascript:void(0)" class="page-link" dmx-on:click="listdepartments.set('offset',list_services.data.query_list_services.page.offset.first)"><span aria-hidden="true">&lsaquo;&lsaquo;</span></a>
                </li>
                <li class="page-item" dmx-class:disabled="list_services.data.query_list_services.page.current == 1" aria-label="Previous">
                  <a href="javascript:void(0)" class="page-link" dmx-on:click="listdepartments.set('offset',list_services.data.query_list_services.page.offset.prev)"><span aria-hidden="true">&lsaquo;</span></a>
                </li>
                <li class="page-item" dmx-class:active="title == list_services.data.query_list_services.page.current" dmx-class:disabled="!active" dmx-repeat="list_services.data.query_list_services.getServerConnectPagination(2,1,'...')">
                  <a href="javascript:void(0)" class="page-link" dmx-on:click="listdepartments.set('offset',(page-1)*list_services.data.query_list_services.limit)">{{title}}</a>
                </li>
                <li class="page-item" dmx-class:disabled="list_services.data.query_list_services.page.current ==  list_services.data.query_list_services.page.total" aria-label="Next">
                  <a href="javascript:void(0)" class="page-link" dmx-on:click="listdepartments.set('offset',list_services.data.query_list_services.page.offset.next)"><span aria-hidden="true">&rsaquo;</span></a>
                </li>
                <li class="page-item" dmx-class:disabled="list_services.data.query_list_services.page.current ==  list_services.data.query_list_services.page.total" aria-label="Last">
                  <a href="javascript:void(0)" class="page-link" dmx-on:click="listdepartments.set('offset',list_services.data.query_list_services.page.offset.last)"><span aria-hidden="true">&rsaquo;&rsaquo;</span></a>
                </li>
              </ul>
            </div>
            <div class="col-lg-1 col-xl-1 col-md-2 col-sm-2 col-3 offset-lg-1"><select id="service_sort_limit" class="form-select" name="service_sort_limit">
                <option value="5">5</option>
                <option selected="" value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
                <option value="''">{{trans.data.all[lang.value]}}</option>
              </select></div>
          </div>
          <div class="row mt-2 row-cols-12">
            <div class="bg-light rounded mb-2 pt-2 pb-2 ps-2 pe-2 col">
              <form id="createService" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_services/create_service.php" dmx-on:success="createService.reset();list_services.load({});notifies1.success('Success!')" class="d-flex">
                <input id="text4" name="service_name" type="text" class="form-control" dmx-bind:placeholder="trans.data.name[lang.value]" dmx-bind:required="'!'">
                <select id="select4" class="form-select ms-2" name="servo_service_sales_point" dmx-bind:options="list_sales_points.data.query_list_sales_points" optiontext="sales_point_name" optionvalue="sales_point_id">
                  <option selected="" value="">---</option>
                </select><button id="btn5" class="btn btn-warning ms-1" type="submit"><i class="fas fa-plus"><br></i></button>
              </form>
            </div>
          </div>
          <div class="row mt-2">
            <div class="col rounded bg-light">
              <div class="table-responsive servo-shadow">
                <table class="table table-hover table-sm table-borderless">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>{{trans.data.service[lang.value]}}</th>
                      <th>{{trans.data.salesPoint[lang.value]}}</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_services.data.query_list_services.data" id="repeatListServices">
                    <tr>
                      <td dmx-text="service_id"></td>
                      <td>
                        <form id="upadateServiceName" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_services/update_service_name.php" class="d-flex" dmx-on:success="list_services.load({});notifies1.success('Success!')">

                          <input id="text5" name="service_name" type="text" class="form-control" dmx-bind:value="service_name">
                          <input id="text6" name="service_id" type="text" class="form-control visually-hidden" dmx-bind:value="service_id">
                          <button id="btn8" class="btn text-success" type="submit">
                            <i class="fas fa-check"></i>
                          </button>
                        </form>
                      </td>
                      <td>
                        <form id="upadateServiceSalesPoint" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_services/update_service_sales_point.php" class="d-flex" dmx-on:success="list_services.load({});notifies1.success('Success!')">

                          <select id="select3" class="form-select" name="servo_service_sales_point" dmx-bind:options="list_sales_points.data.query_list_sales_points" optiontext="sales_point_name" optionvalue="sales_point_id" dmx-bind:value="servo_service_sales_point">
                            <option selected="" value="">---</option>
                          </select>


                          <input id="text8" name="service_id" type="text" class="form-control visually-hidden" dmx-bind:value="service_id">
                          <button id="btn9" class="btn text-success" type="submit">
                            <i class="fas fa-check"></i>
                          </button>
                        </form>

                      </td>
                      <td>
                        <button id="btn10" class="btn open" dmx-bind:value="service_id" dmx-on:click="serviceModal.show();read_service.load({service_id: service_id})"><i class="fas fa-expand-alt fa-lg"></i></button>
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
  </main>
  <script src="bootstrap/5/js/bootstrap.bundle.min.js"></script>
</body>

</html>