<!doctype html>
<html>

<head>
    <script src="dmxAppConnect/dmxAppConnect.js"></script>
    <meta name="ac:base" content="/servo">
    <base href="/servo/">
    <meta charset="UTF-8">
    <title>EmlogicX - SERVO</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/style.css" />
    <script src="js/jquery-3.5.1.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js" integrity="sha256-CutOzxCRucUsn6C6TcEYsauvvYilEniTXldPa6/wu0k=" crossorigin="anonymous"></script>
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
</head>

<body is="dmx-app" id="departments">
<dmx-query-manager id="listDepartments"></dmx-query-manager>
<dmx-query-manager id="listServices"></dmx-query-manager>

<dmx-value id="lang" dmx-bind:value="browser1.language"></dmx-value>
<dmx-json-datasource id="trans" is="dmx-serverconnect" url="assets/translation/translation.JSON"></dmx-json-datasource>

<dmx-serverconnect id="list_department_categories" url="dmxConnect/api/servo_department_categories/list_department_categories.php" dmx-param:department_id="read_item_department.data.query.department_id"></dmx-serverconnect>
<dmx-serverconnect id="delete_department_category" url="dmxConnect/api/servo_department_categories/delete_department_category.php" dmx-param:department_id="read_item_department.data.query.department_id" dmx-param:id="list_department_categories.data.query_list_department_categories[0].id"></dmx-serverconnect>

    <dmx-serverconnect id="load_product_categories" url="dmxConnect/api/servo_refered_fields_loading/load_product_categories.php"></dmx-serverconnect>
    <dmx-serverconnect id="read_item_department" url="dmxConnect/api/servo_departments/read_department.php" dmx-param:id="id" noload dmx-param:item_id="" dmx-param:branch_id="read_item_branch.data.queryReadBranch.branch_id" dmx-param:department_id=""></dmx-serverconnect>
    <dmx-serverconnect id="delete_item_department" url="dmxConnect/api/servo_departments/delete_department.php"></dmx-serverconnect>
    <dmx-serverconnect id="list_departments" url="dmxConnect/api/servo_departments/list_departments.php"></dmx-serverconnect>
    <div is="dmx-browser" id="browser1"></div>
    <dmx-notifications id="notifies1"></dmx-notifications>
    <?php include 'header.php'; ?><main class="mt-4">
        <div class="modal create-modal" id="createItemModal" is="dmx-bs5-modal" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{trans.data.createDepartment[lang.value]}}</h5>
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
                        <h5 class="modal-title fw-bold">{{trans.data.departmentDetails[lang.value]}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    
                    <div class="modal-body">
<h1>{{read_item_department.data.query.department_name}}</h1><div class="row">

<form is="dmx-serverconnect-form" id="form_update_department" method="post" action="dmxConnect/api/servo_departments/update_department.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="read_item_department.data.query" dmx-on:success="notifies1.success('Success');list_departments.load({});readItemModal.hide()">
<div class="mb-3 row">
  <label for="inp_department_name" class="col-sm-2 col-form-label">{{trans.data.departmentName[lang.value]}}</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" id="inp_department_name" name="department_name" dmx-bind:value="read_item_department.data.query.department_name" aria-describedby="inp_department_name_help" placeholder="Enter Department Name">
  </div>
</div>
<input type="hidden" name="department_id" id="inp_department_id" dmx-bind:value="read_item_department.data.query.department_id"><div class="mb-3 row">
  <div class="col-sm-2">&nbsp;</div>
  <div class="col-sm-10">
    <button type="submit" class="btn btn-primary" dmx-bind:value="read_item_department.data.query.Save">{{trans.data.update[lang.value]}}</button>
  </div>
</div>
</form></div>
<div class="row">
<div class="col d-flex flex-wrap justify-content-start flex-row align-content-end"><div dmx-repeat:repeat1="list_department_categories.data.query_list_department_categories">
<form id="deleteDepartmentCategory" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_department_categories/delete_department_category.php" dmx-on:success="notifies1.success('Success');list_department_categories.load({department_id: read_item_department.data.query.department_id})" dmx-on:error="notifies1.warning('Error')">
<input id="departmentCategoryId" name="id" type="text" class="form-control visually-hidden" dmx-bind:value="id">
<button id="btn3" class="btn me-2 bg-danger" dmx-text="product_category_name" dmx-bs-tooltip="'x'" data-bs-trigger="hover" data-bs-placement="bottom" type="submit">Button
<i class="fas fa-flag fa-lg fa-fw fa-li"></i>
</button>
</form>

</div></div>





</div>
<div class="row">
<p>{{trans.data.categories[lang.value]}}</p>
<div class="col"><div class="table-responsive visually-hidden">
<table class="table">
  <thead>
    <tr>
      <th>Id</th>
      <th>Department</th>
      <th>Category</th>
      <th>Department name</th>
      <th>Product categories</th>
      <th>Product category name</th>
    </tr>
  </thead>
  <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_department_categories.data.query_list_department_categories" id="tableRepeat3">
    <tr>
      <td dmx-text="id"></td>
      <td dmx-text="department_id"></td>
      <td dmx-text="category_id"></td>
      <td dmx-text="department_name"></td>
      <td dmx-text="product_categories_id"></td>
      <td dmx-text="product_category_name"></td>
    </tr>
  </tbody>
</table>
</div></div>

</div><p>{{trans.data.link[lang.value]}}</p><div class="row"><form is="dmx-serverconnect-form" id="createDepartmentCategory" method="post" action="dmxConnect/api/servo_department_categories/create_department_category.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="read_item_department.data.query" dmx-on:success="notifies1.success('Department Category Success');list_department_categories.load({department_id: read_item_department.data.query.department_id})" dmx-on:error="notifies1.warning('Error!')">
<div class="mb-3 row">
  <div class="col-sm-10">
<input id="text3" name="department_category_code" type="text" class="form-control visually-hidden" dmx-bind:value="read_item_department.data.query.department_id+'@'+select2.value">
  </div><div class="col-sm-10">
<input id="text2" name="department_id" type="text" class="form-control visually-hidden" dmx-bind:value="read_item_department.data.query.department_id">
  </div>
</div>
<div class="mb-3 row">
  <div class="col-sm-10">
<select id="select2" class="form-select" dmx-bind:options="load_product_categories.data.query" optiontext="product_category_name" optionvalue="product_categories_id" name="category_id">
</select>
  </div><label for="inp_category_id" class="col-sm-2 col-form-label">{{trans.data.category[lang.value]}}</label>
  

</div>
<div class="mb-3 row">
  <div class="col-sm-10">
    <button type="submit" class="btn btn-primary" dmx-bind:value="read_item_department.data.query.Save">{{trans.data.update[lang.value]}}</button>
  </div>
</div>
</form></div>

                        
                    </div>
                    <div class="modal-footer">
                        <form id="form1" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_tables/delete_table.php" dmx-on:success="notifies1.success('Success');list_tables.load();readItemModal.hide()" onsubmit=" return confirm('CONFIRM DELETE?');">
                            <input id="text1" name="table_id" type="hidden" class="form-control" dmx-bind:value="read_item_table.data.query_read_table.table_id">

                            <button id="btn6" class="btn text-danger" type="submit">
                                <i class="far fa-trash-alt fa-lg"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-auto">


            

            <div class="row servo-page-header">
                <div class="col">
                    <h2 class="servo-page-heading fw-lighter">{{trans.data.departmentPage[lang.value]}}</h2>
                </div>
                <div class="col style13 page-button" id="pagebuttons">
                    <button id="btn1" class="btn style12 fw-light" data-bs-toggle="modal" data-bs-target="#createItemModal" style="float: right;"><i class="fas fa-plus fa-2x style14"></i></button>
                    <button id="btn4" class="btn fw-lighter style12" data-bs-toggle="modal" data-bs-target="#createproductmodal" style="float: right;"><i class="fas fa-chart-area fa-2x style15"></i></button>
                    <button id="btn5" class="btn fw-lighter style12" data-bs-toggle="modal" data-bs-target="#createproductmodal" style="float: right;"><i class="fas fa-print fa-2x style17"></i></button>
                </div>
            </div>
            <div class="row">
                <div class="col">


                    <div class="table-responsive">
<table class="table table-hover table-sm">
  <thead>
    <tr>
      <th>#</th>
      <th>{{trans.data.departmentName[lang.value]}}</th>
      <th></th>
    </tr>
  </thead>
  <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_departments.data.query_list_departments" id="tableRepeat1">
    <tr>
      <td dmx-text="department_id"></td>
      <td dmx-text="department_name"></td>
        <td>
            <button id="btn2" class="btn" data-bs-target="#productInfo" dmx-on:click="readItemModal.show();read_item_department.load({department_id: department_id})" dmx-bind:value="list_departments.data.query_list_departments[0].department_id"><i class="far fa-eye fa-lg"><br></i></button>
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