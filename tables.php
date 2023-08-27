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
  <link rel="stylesheet" href="fontawesome5/css/all.min.css" />
  <script src="dmxAppConnect/dmxBootstrap5PagingGenerator/dmxBootstrap5PagingGenerator.js" defer=""></script>

</head>

<body id="brands" is="dmx-app">
  <dmx-query-manager id="listTables"></dmx-query-manager>

  <dmx-value id="lang" dmx-bind:value="browser1.language"></dmx-value>
  <dmx-json-datasource id="trans" is="dmx-serverconnect" url="assets/translation/translation.JSON"></dmx-json-datasource>

  <dmx-serverconnect id="load_branches" url="dmxConnect/api/servo_refered_fields_loading/load_branches.php"></dmx-serverconnect>
  <dmx-serverconnect id="read_item_table" url="dmxConnect/api/servo_tables/read_table.php" dmx-param:id="id" noload dmx-param:item_id="" dmx-param:branch_id="read_item_branch.data.queryReadBranch.branch_id"></dmx-serverconnect>
  <dmx-serverconnect id="delete_item_table" url="dmxConnect/api/servo_tables/delete_table.php"></dmx-serverconnect>
  <dmx-serverconnect id="list_tables" url="dmxConnect/api/servo_tables/list_tables_paged.php" dmx-param:offset="listTables.data.offset" dmx-param:limit="table_sort_limit.value" dmx-param:tablefilter="tablefilter.value"></dmx-serverconnect>
  <div is="dmx-browser" id="browser1"></div>
  <dmx-notifications id="notifies1"></dmx-notifications>
  <?php include 'header.php'; ?><main class="mt-4">
    <div class="modal create-modal" id="createItemModal" is="dmx-bs5-modal" tabindex="-1">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{trans.data.newTable[lang.value]}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <form is="dmx-serverconnect-form" id="serverconnectFormCreateTable" method="post" action="dmxConnect/api/servo_tables/create_table.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-on:success="list_tables.load();notifies1.success('Success'); createItemModal.hide()">
                <div class="mb-3 row">
                  <label for="inp_table_name" class="col-sm-2 col-form-label">{{trans.data.name[lang.value]}}</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inp_table_name" name="table_name" aria-describedby="inp_table_name_help" placeholder="Enter Table Name">
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
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title fw-bold">{{trans.data.details[lang.value]}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <h1 class="detail-heading">{{read_item_table.data.query_read_table.table_name}}</h1>
          <div class="modal-body">
            <form is="dmx-serverconnect-form" id="readitem" method="post" action="dmxConnect/api/servo_tables/update_table.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="read_item_table.data.query_read_table" dmx-on:success="notifies1.success('Success');list_tables.load();readItemModal.hide()">
              <div class="mb-3 row">
                <label for="inp_table_id" class="col-sm-2 col-form-label">#</label>
                <div class="col-sm-10">
                  <input type="number" class="form-control" id="inp_table_id" name="table_id" dmx-bind:value="read_item_table.data.query_read_table.table_id" aria-describedby="inp_table_id_help" placeholder="Enter Table" readonly="true">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="inp_table_name" class="col-sm-2 col-form-label">{{trans.data.name[lang.value]}}</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inp_table_name" name="table_name" dmx-bind:value="read_item_table.data.query_read_table.table_name" aria-describedby="inp_table_name_help" placeholder="Enter Table Name">
                </div>
              </div>
              <div class="mb-3 row">
                <div class="col-sm-2">&nbsp;</div>
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-primary" dmx-bind:value="read_item_table.data.query_read_table.Save">{{trans.data.update[lang.value]}}</button>
                </div>
              </div>
            </form>
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
    <div class="mt-auto ms-3 me-3">




      <div class="row servo-page-header">
        <div class="col-auto" dmx-animate-enter="slideInLeft">
          <i class="fas fa-key fa-lg"></i>
        </div>
        <div class="col-auto page-heading">
          <h5 class="servo-page-heading">{{trans.data.assets[lang.value]}}</h5>
        </div>
        <div class="col style13 page-button" id="pagebuttons">
          <button id="btn1" class="btn style12 fw-light add-button" data-bs-toggle="modal" data-bs-target="#createItemModal" style="float: right;"><i class="fas fa-plus style14 fa-lg"></i></button>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="row justify-content-sm-between justify-content-md-between justify-content-lg-between justify-content-xl-between justify-content-xxl-between mt-2 justify-content-between sorter rounded bg-secondary">
            <div class="col-lg-3 col-12 col-sm-12"><input id="tablefilter" name="tablefilter" type="text" class="form-control mb-2 form-control-sm" dmx-bind:placeholder="trans.data.search[lang.value]+'  '"></div>

            <div class="col-9 d-flex col-lg-7 justify-content-lg-end flex-lg-wrap">
              <ul class="pagination flex-wrap flex-sm-wrap flex-md-wrap" dmx-populate="list_tables.data.query_list_tables" dmx-state="listTables" dmx-offset="offset" dmx-generator="bs5paging">
                <li class="page-item" dmx-class:disabled="list_tables.data.query_list_tables.page.current == 1" aria-label="First">
                  <a href="javascript:void(0)" class="page-link" dmx-on:click="listTables.set('offset',list_tables.data.query_list_tables.page.offset.first)"><span aria-hidden="true">&lsaquo;&lsaquo;</span></a>
                </li>
                <li class="page-item" dmx-class:disabled="list_tables.data.query_list_tables.page.current == 1" aria-label="Previous">
                  <a href="javascript:void(0)" class="page-link" dmx-on:click="listTables.set('offset',list_tables.data.query_list_tables.page.offset.prev)"><span aria-hidden="true">&lsaquo;</span></a>
                </li>
                <li class="page-item" dmx-class:active="title == list_tables.data.query_list_tables.page.current" dmx-class:disabled="!active" dmx-repeat="list_tables.data.query_list_tables.getServerConnectPagination(2,1,'...')">
                  <a href="javascript:void(0)" class="page-link" dmx-on:click="listTables.set('offset',(page-1)*list_tables.data.query_list_tables.limit)">{{title}}</a>
                </li>
                <li class="page-item" dmx-class:disabled="list_tables.data.query_list_tables.page.current ==  list_tables.data.query_list_tables.page.total" aria-label="Next">
                  <a href="javascript:void(0)" class="page-link" dmx-on:click="listTables.set('offset',list_tables.data.query_list_tables.page.offset.next)"><span aria-hidden="true">&rsaquo;</span></a>
                </li>
                <li class="page-item" dmx-class:disabled="list_tables.data.query_list_tables.page.current ==  list_tables.data.query_list_tables.page.total" aria-label="Last">
                  <a href="javascript:void(0)" class="page-link" dmx-on:click="listTables.set('offset',list_tables.data.query_list_tables.page.offset.last)"><span aria-hidden="true">&rsaquo;&rsaquo;</span></a>
                </li>
              </ul>
            </div>
            <div class="col-lg-1 col-xl-1 col-md-2 col-sm-2 col-3"><select id="table_sort_limit" class="form-select" name="table_sort_limit">
                <option value="5">5</option>
                <option selected="" value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
                <option value="''">{{trans.data.all[lang.value]}}</option>
              </select></div>
          </div>


          <div class="table-responsive servo-shadow">
            <table class="table table-hover table-sm table-borderless">
              <thead>
                <tr>
                  <th>#</th>
                  <th>{{trans.data.name[lang.value]}}</th>
                  <th></th>
                </tr>
              </thead>
              <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_tables.data.query_list_tables.data" id="tableRepeat2">
                <tr>
                  <td dmx-text="table_id"></td>
                  <td dmx-text="table_name" class="fw-bold"></td>
                  <td class="text-center">
                    <button id="btn2" class="btn open" data-bs-target="#productInfo" dmx-on:click="readItemModal.show();read_item_table.load({table_id: table_id})" dmx-bind:value="list_tables.data.query_list_tables[0].table_id"><i class="fas fa-expand-alt fa-lg"><br></i></button>
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