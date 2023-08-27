<!doctype html>
<html>
<head>
<script src="dmxAppConnect/dmxAppConnect.js"></script>
<meta name="ac:base" content="/servo">
<base href="/servo/">
<meta charset="UTF-8">
<title>Untitled Document</title>

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
<dmx-serverconnect id="read_item_product_price" url="dmxConnect/api/servo_product_prices/read_product_price.php" dmx-param:id="id" noload dmx-param:item_id="" dmx-param:branch_id="read_item_branch.data.queryReadBranch.branch_id"></dmx-serverconnect>
<dmx-serverconnect id="serverconnectLoadProducts" url="dmxConnect/api/servo_refered_fields_loading/load_products.php"></dmx-serverconnect>
<dmx-serverconnect id="delete_item_product_price" url="dmxConnect/api/servo_product_prices/delete_product_price.php"></dmx-serverconnect><dmx-serverconnect id="list_product_prices" url="dmxConnect/api/servo_product_prices/list_product_prices.php"></dmx-serverconnect><div is="dmx-browser" id="browser1"></div>
<dmx-notifications id="notifies1"></dmx-notifications>
<main class="mt-4">

<div class="modal create-modal" id="createItemModal" is="dmx-bs5-modal" tabindex="-1">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">New Product Price</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
<div class="row"><form is="dmx-serverconnect-form" id="serverconnectFormCreateProductPrice" method="post" action="dmxConnect/api/servo_product_prices/create_product_price.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-on:success="serverconnectFormCreateProductPrice.reset();notifies1.success('Success');createItemModal.hide();list_product_prices.load()">
<div class="mb-3 row">
  <label for="inp_product_price" class="col-sm-2 col-form-label">Price</label>
  <div class="col-sm-10">
    <input type="number" class="form-control" id="inp_product_price" name="product_price" aria-describedby="inp_product_price_help" placeholder="Enter Product price">
  </div>
</div>
<div class="mb-3 row">
  <label for="inp_product_price_date" class="col-sm-2 col-form-label">Date Set</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" id="inp_product_price_date" name="product_price_date" aria-describedby="inp_product_price_date_help" placeholder="Enter Product price date" is="dmx-date-picker" format="YYYY-MM-DDThh:mm" timepicker="" use24hours="true" utc="true">
  </div>
</div>
<div class="mb-3 row">
  <label for="inp_product_price_product_id" class="col-sm-2 col-form-label">Product</label>
  <div class="col-sm-10">
    <select id="inp_product_price_product_id" class="form-control" name="product_price_product_id" dmx-bind:options="serverconnectLoadProducts.data.query" optiontext="product_name" optionvalue="product_id">
    </select>
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


<?php include 'servo_header.php'; ?>

<div class="row servo-page-header">
<div class="col">
<h2 class="servo-page-heading fw-lighter">Product Prices</h2>
</div>
<div class="col style13 page-button" id="pagebuttons">
<button id="btn1" class="btn style12 fw-light" data-bs-toggle="modal" data-bs-target="#createItemModal" style="float: right;"><i class="fas fa-plus fa-2x style14"></i></button>
<button id="btn4" class="btn fw-lighter style12" data-bs-toggle="modal" data-bs-target="#createproductmodal" style="float: right;"><i class="fas fa-chart-area fa-2x style15"></i></button>
<button id="btn5" class="btn fw-lighter style12" data-bs-toggle="modal" data-bs-target="#createproductmodal" style="float: right;"><i class="fas fa-print fa-2x style17"></i></button>
</div>
</div><div class="row">
<div class="col">


<div class="table-responsive">
<table class="table table-hover table-sm">
  <thead>
    <tr>
      <th>Product Price ID</th>
      <th>Product</th>
      <th>Product Price</th>
      <th>Date Set</th>
      <th></th>
    </tr>
  </thead>
  <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_product_prices.data.query_list_product_prices" id="tableRepeat2">
    <tr>
      <td dmx-text="product_price_id"></td>
      <td dmx-text="product_name">{{product_price_product_id}}</td>
      <td dmx-text="product_price"></td>
      <td dmx-text="product_price_date"></td>
        <td>
            <button id="btn2" class="btn text-info" data-bs-target="#productInfo" dmx-on:click="readItemModal.show();read_item_branch.load({branch_id: branch_id})" dmx-bind:value="list_branches.data.query_list_branches[0].branch_id"><i class="far fa-eye fa-lg"><br></i></button>
        </td>
    </tr>
  </tbody>
</table>
</div>
</div>
</div>
</div>
<div class="container">
<form id="form2">
<div class="form-group mb-3" id="input1_group" is="dmx-checkbox-group">
  <legend class="col-sm-2 col-form-label">Some checkboxes</legend>
  <div class="form-check">
    <input class="form-check-input" type="checkbox" value="" id="input1_1" name="input1_1">
    <label class="form-check-label" for="input1_1">First checkbox</label>
  </div>
  <div class="form-check">
    <input class="form-check-input" type="checkbox" value="1" id="input1_2" name="input1_2" style="border: 1px solid red !important; padding: 10px;" dmx-on:click="input1_2.setValue(checked)">
    <label class="form-check-label" for="input1_2">Second checkbox</label>
  </div>
  <div class="form-check">
    <input class="form-check-input" type="checkbox" value="" id="input1_3" name="input1_3">
    <label class="form-check-label" for="input1_3">Third checkbox</label>
  </div>
</div>
<div class="form-group mb-3 row">
  <legend class="col-sm-2 col-form-label">One switch</legend>
  <div class="col-sm-10">
<dmx-toggle id="toggle1"></dmx-toggle>
  </div>
</div>
</form>
</div></main>
<div class="row">
<div class="col">
<div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" value="1" id="checkbox1" name="checkbox1">
  <label class="form-check-label" for="checkbox1">Default switch</label>
</div>
</div>
</div>
<script src="bootstrap/5/js/bootstrap.bundle.min.js"></script>
</body>
</html>
