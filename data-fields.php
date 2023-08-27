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

</head>

<body id="brands" is="dmx-app">

  <dmx-value id="lang" dmx-bind:value="browser1.language"></dmx-value>
  <dmx-json-datasource id="trans" is="dmx-serverconnect" url="assets/translation/translation.JSON"></dmx-json-datasource>

  <dmx-serverconnect id="delete_data_field" url="dmxConnect/api/servo_data_fields/delete_data_field.php"></dmx-serverconnect>
  <dmx-serverconnect id="list_data_fields" url="dmxConnect/api/servo_data_fields/list_data_fields.php"></dmx-serverconnect>
  <div is="dmx-browser" id="browser1"></div>
  <dmx-notifications id="notifies1"></dmx-notifications>
  <?php include 'header.php'; ?><main class="mt-4">
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
                <label for="inp_servo_branches_branch_id" class="col-sm-2 col-form-label">{{trans.data.branches[lang.value]}}</label>
                <div class="col-sm-10">
                  <select id="select2" class="form-select" name="servo_branches_branch_id" dmx-bind:options="load_branches.data.query" optiontext="branch_name" optionvalue="branch_id" dmx-bind:value="read_item_table.data.query_read_table.branch_id">
                  </select>
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
    <div class="mt-auto ms-2 me-2">




      <div class="row servo-page-header pt-2 pb-2 ps-2 pe-1">
        <div class="col-auto" dmx-animate-enter="slideInLeft">
          <i class="fas fa-database fa-2x" style="color: #ff18f2 !important;"></i>
        </div>
        <div class="col-auto page-heading">
          <h4 class="servo-page-heading">{{trans.data.dataFields[lang.value]}}</h4>
        </div>
      </div>
      <div class="row bg-light rounded mt-3 mb-3 ms-0 me-0 pt-3 pb-3 ps-2 pe-2">

        <div class="col-auto">
          <form is="dmx-serverconnect-form" id="createDataField" method="post" action="dmxConnect/api/servo_data_fields/create_data_field.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-on:success="list_data_fields.load();createDataField.reset()" class="d-flex">
            <div class="mb-3 row">
              <div class="col-auto col-xl-5 col-lg-5 col-md-5 col-sm-5">
                <input type="text" class="form-control" id="inpDataFieldName" name="data_field_name" aria-describedby="inp_payment_method_name_help" dmx-bind:placeholder="trans.data.newDataField[lang.value]">
              </div>
              <div class="col-auto col-xl-5 col-lg-5 col-md-5 col-sm-5">
                <input type="text" class="form-control" id="inputDataFieldUnit" name="data_field_unit" aria-describedby="inp_payment_method_name_help" dmx-bind:placeholder="trans.data.unit[lang.value]">
              </div>
              <div class="col-auto col-xxl-auto col-xxl-6 col-xl-1 col-lg-1 col-md-1 col-sm-1">
                <button type="submit" class="btn btn-primary ms-2">{{trans.data.ok[lang.value]}}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="row rounded bg-light ms-0 me-0">
        <div class="col">


          <div class="table-responsive servo-shadow">
            <table class="table table-hover table-sm table-borderless">
              <thead>
                <tr>
                  <th>#</th>
                  <th>{{trans.data.name[lang.value]}}</th>
                  <th>{{trans.data.unit[lang.value]}}</th>
                  <th></th>
                </tr>
              </thead>
              <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_data_fields.data.query_list_data_fields" id="dataFieldsTable">
                <tr>
                  <td dmx-text="data_field_id"></td>
                  <td>
                    <form id="updateDataField" method="post" is="dmx-serverconnect-form" class="d-flex" action="dmxConnect/api/servo_data_fields/update_data_field.php" dmx-on:success="notifies1.success('Sucess!');list_data_fields.load()">
                      <input id="dataFieldid" name="data_field_id" type="text" class="form-control visually-hidden" dmx-bind:value="data_field_id">
                      <input id="dataFieldName" name="data_field_name" type="text" class="form-control" dmx-bind:value="data_field_name">
                      <input id="dataFieldUnit" name="data_field_unit" type="text" class="form-control ms-2" dmx-bind:value="data_field_unit">
                      <button id="btn3" class="btn text-success" type="submit">
                        <i class="fas fa-check"></i>
                      </button>
                    </form>
                  </td>
                  <td>
                    <form id="deleteDataField" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_data_fields/delete_data_field.php" dmx-on:success="list_data_fields.load()">
                      <input id="text2" name="data_field_id" type="text" class="form-control visually-hidden" dmx-bind:value="data_field_id"><button id="btn2" class="btn text-body" type="submit">
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
  </main>
  <script src="bootstrap/5/js/bootstrap.bundle.min.js"></script>
</body>

</html>