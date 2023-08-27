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
?><!doctype html>
<html>
<head>
<script src="dmxAppConnect/dmxAppConnect.js"></script>
<meta name="ac:base" content="/servo">
<base href="/servo/">
<meta charset="UTF-8">
<title>SERVO</title>

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="css/style.css" />
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js" integrity="sha256-CutOzxCRucUsn6C6TcEYsauvvYilEniTXldPa6/wu0k=" crossorigin="anonymous"></script><script src="dmxAppConnect/dmxBootstrap5Navigation/dmxBootstrap5Navigation.js" defer=""></script>
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
<link rel="stylesheet" href="fontawesome5/css/all.min.css" />
</head>
<body id="brands" is="dmx-app">
<dmx-serverconnect id="read_item_branch" url="dmxConnect/api/servo_branches/read_branch.php" dmx-param:id="id" noload dmx-param:item_id="" dmx-param:branch_id="read_item_branch.data.queryReadBranch.branch_id"></dmx-serverconnect>
<dmx-serverconnect id="delete_item_branch" url="dmxConnect/api/servo_branches/delete_branch.php"></dmx-serverconnect><dmx-serverconnect id="list_branches" url="dmxConnect/api/servo_branches/list_branches.php"></dmx-serverconnect><div is="dmx-browser" id="browser1"></div>
<dmx-notifications id="notifies1"></dmx-notifications>
<?php include 'header.php'; ?><main class="mt-4">
<div class="modal create-modal" id="createItemModal" is="dmx-bs5-modal" tabindex="-1">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">&nbsp;New Branch</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
<div class="row"><form is="dmx-serverconnect-form" id="serverconnectFormCreateBranch" method="post" action="dmxConnect/api/servo_branches/create_branch.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-on:success="notifies1.success('Success');serverconnectFormCreateBranch.reset();list_branches.load();createItemModal.hide()">
<div class="mb-3 row">
  <label for="inp_branch_name" class="col-sm-2 col-form-label">Branch name</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" id="inp_branch_name" name="branch_name" aria-describedby="inp_branch_name_help" placeholder="Enter Branch Name">
  </div>
</div>
<div class="mb-3 row">
  <label for="inp_branch_date_registered" class="col-sm-2 col-form-label">Branch date registered</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" id="inp_branch_date_registered" name="branch_date_registered" aria-describedby="inp_branch_date_registered_help" placeholder="Enter Date Registered" is="dmx-date-picker" timepicker="" use24hours="true" utc="true">
  </div>
</div>
<div class="mb-3 row">
  <div class="col-sm-2">&nbsp;</div>
  <div class="col-sm-10">
    <button type="submit" class="btn btn-primary">Save</button>
  </div>
</div>
</form></div>
        
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
        <h5 class="modal-title fw-bold">User Profile Details:{{read_item_branch.data.queryReadBranch.branch_date_registered}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
<form is="dmx-serverconnect-form" id="readitem" method="post" action="dmxConnect/api/servo_branches/update_branch.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="read_item_branch.data.queryReadBranch" dmx-on:success="notifies1.success('Success');list_branches.load();readItemModal.hide()">
<input type="hidden" name="branch_id" id="inp_branch_id" dmx-bind:value="read_item_branch.data.queryReadBranch.branch_id"><div class="mb-3 row">
  <label for="inp_branch_name" class="col-sm-2 col-form-label">Branch Name</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" id="inp_branch_name" name="branch_name" dmx-bind:value="read_item_branch.data.queryReadBranch.branch_name" aria-describedby="inp_branch_name_help" placeholder="Enter Branch Name">
  </div>
</div>

<div class="mb-3 row">
  <label for="inp_branch_date_registered" class="col-sm-2 col-form-label">Date Registered</label>
  <div class="col-sm-10">
    <input class="form-control" id="inp_branch_date_registered" name="branch_date_registered" dmx-bind:value="read_item_branch.data.queryReadBranch.branch_date_registered" aria-describedby="inp_branch_date_registered_help" placeholder="Enter Date Registered" utc="true" type="datetime-local" is="dmx-date-picker" format="YYYY-MM-DDThh:mm" timepicker="" use24hours="true">
  </div>
</div>
<div class="mb-3 row">
  <div class="col-sm-2">&nbsp;</div>
  <div class="col-sm-10">
    <button type="submit" class="btn btn-primary" dmx-bind:value="read_item_branch.data.queryReadBranch.Save">Save</button>
  </div>
</div>
</form>
      </div>
      <div class="modal-footer">
<form id="form1" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_branches/delete_branch.php" dmx-on:success="notifies1.success('Success');readItemModal.hide();list_branches.load({})" onsubmit=" return confirm('CONFIRM DELETE?');">
<input id="text1" name="branch_id" type="hidden" class="form-control" dmx-bind:value="read_item_branch.data.queryReadBranch.branch_id">

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
<h2 class="servo-page-heading fw-lighter">Branches</h2>
</div>
<div class="col style13 page-button" id="pagebuttons">
<button id="btn1" class="btn style12 fw-light text-warning" data-bs-toggle="modal" data-bs-target="#createItemModal" style="float: right;"><i class="fas fa-plus fa-2x style14"></i></button>
</div>
</div><div class="row">
<div class="col">


<div class="table-responsive servo-shadow">
<table class="table table-hover table-sm">
  <thead>
    <tr>
      <th>Branch</th>
      <th>Branch Name</th>
      <th>Date Registered</th>
      <th></th>
    </tr>
  </thead>
  <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_branches.data.query_list_branches" id="tableRepeat1">
    <tr>
      <td dmx-text="branch_id"></td>
      <td dmx-text="branch_name"></td>
      <td dmx-text="branch_date_registered"></td>
      <td>
        <button id="btn2" class="btn" data-bs-target="#productInfo" dmx-on:click="readItemModal.show();read_item_branch.load({branch_id: branch_id})" dmx-bind:value="list_branches.data.query_list_branches[0].branch_id"><i class="far fa-eye fa-lg"><br></i></button>
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
