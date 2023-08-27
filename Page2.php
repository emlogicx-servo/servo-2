<!doctype html>
<html>
<head>
<meta name="ac:base" content="/servo">
<base href="/servo/">
<script src="dmxAppConnect/dmxAppConnect.js"></script>
<meta charset="UTF-8">
<title>Untitled Document</title>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="css/style.css" />
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
</head>
<body is="dmx-app" id="Page2">
<div is="dmx-browser" id="browser1"></div>
<dmx-session-manager id="session1"></dmx-session-manager>
<dmx-notifications id="notifies1"></dmx-notifications>
<dmx-serverconnect id="serverconnectShowProduct" url="dmxConnect/api/showcustomers.php"></dmx-serverconnect>
<main class="mt-4">
<div class="modal create-modal" id="createproductmodal" is="dmx-bs5-modal" tabindex="-1">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">&nbsp;New Product&nbsp;</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
<div class="row"><form is="dmx-serverconnect-form" id="serverconnectFormAddProduct" method="post" action="dmxConnect/api/Products/newproduct.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-on:success="notifies1.success('Product Succesfully Added');serverconnectFormAddProduct.reset();serverconnect1.load();session1.set('thisproduct',serverconnectFormAddProduct.data.currentorder);browser1.goto('productdetails.php')">
<div class="mb-3 row">
  <label for="inp_name" class="col-sm-2 col-form-label">Name</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" id="inp_name" name="name" aria-describedby="inp_name_help" placeholder="Enter Name">
  </div>
</div>
<div class="mb-3 row">
  <label for="inp_description" class="col-sm-2 col-form-label">Description</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" id="inp_description" name="description" aria-describedby="inp_description_help" placeholder="Enter Description">
  </div>
</div>
<div class="mb-3 row">
  <label for="inp_current_price" class="col-sm-2 col-form-label">Current price</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" id="inp_current_price" name="current_price" aria-describedby="inp_current_price_help" placeholder="Enter Current price">
  </div>
</div>
<div class="mb-3 row">
  <label for="inp_picture" class="col-sm-2 col-form-label">Picture</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" id="inp_picture" name="picture" aria-describedby="inp_picture_help" placeholder="Enter Picture">
  </div>
</div>
<div class="mb-3 row">
  <div class="col-sm-2">&nbsp;</div>
  <div class="col-sm-10">
    <button type="submit" class="btn btn-primary">Add</button>
  </div>
</div>
</form></div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<div class="modal readitem" id="readProductModal" is="dmx-bs5-modal" tabindex="-1">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
<dmx-serverconnect id="readproduct" url="dmxConnect/api/Products/readproduct.php"></dmx-serverconnect>
      <div class="modal-header">
        <h5 class="modal-title">Product Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
<form is="dmx-serverconnect-form" id="serverconnectform1" method="post" action="dmxConnect/api/Products/updateproduct.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="readproduct.data.query">
<div class="mb-3 row">
  <label for="inp_id" class="col-sm-2 col-form-label">Id</label>
  <div class="col-sm-10">
    <input type="number" class="form-control" id="inp_id" name="id" dmx-bind:value="readproduct.data.query.id" aria-describedby="inp_id_help" placeholder="Enter Id">
  </div>
</div>
<div class="mb-3 row">
  <label for="inp_name" class="col-sm-2 col-form-label">Name</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" id="inp_name" name="name" dmx-bind:value="readproduct.data.query.name" aria-describedby="inp_name_help" placeholder="Enter Name">
  </div>
</div>
<div class="mb-3 row">
  <label for="inp_description" class="col-sm-2 col-form-label">Description</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" id="inp_description" name="description" dmx-bind:value="readproduct.data.query.description" aria-describedby="inp_description_help" placeholder="Enter Description">
  </div>
</div>
<div class="mb-3 row">
  <label for="inp_current_price" class="col-sm-2 col-form-label">Current price</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" id="inp_current_price" name="current_price" dmx-bind:value="readproduct.data.query.current_price" aria-describedby="inp_current_price_help" placeholder="Enter Current price">
  </div>
</div>
<div class="mb-3 row">
  <label for="inp_picture" class="col-sm-2 col-form-label">Picture</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" id="inp_picture" name="picture" dmx-bind:value="readproduct.data.query.picture" aria-describedby="inp_picture_help" placeholder="Enter Picture">
  </div>
</div>
<div class="mb-3 row">
  <div class="col-sm-2">&nbsp;</div>
  <div class="col-sm-10">
    <button type="submit" class="btn btn-primary" dmx-bind:value="readproduct.data.query.Save">Save</button>
  </div>
</div>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<div class="container mt-auto">


<?php include 'header.php'; ?>

<div class="row servo-page-header">
<div class="col">
<h2 class="servo-page-heading fw-lighter">Products</h2>
</div>
<div class="col style13 page-button" id="pagebuttons">
<button id="btn3" class="btn style12 fw-light" data-bs-toggle="modal" data-bs-target="#createproductmodal" style="float: right;"><i class="fas fa-plus fa-2x style14"></i></button>
<button id="btn4" class="btn fw-lighter style12" data-bs-toggle="modal" data-bs-target="#createproductmodal" style="float: right;"><i class="fas fa-chart-area fa-2x style15"></i></button>
<button id="btn5" class="btn fw-lighter style12" data-bs-toggle="modal" data-bs-target="#createproductmodal" style="float: right;"><i class="fas fa-print fa-2x style17"></i></button>
</div>
</div><div class="row">
<div class="col">
<dmx-serverconnect id="serverconnect1" url="dmxConnect/api/Products/showproducts.php"></dmx-serverconnect>

<div class="table-responsive">
<table class="table table-hover table-sm">
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Description</th>
      <th>Current price</th>
      <th>Picture</th>
      <th>View</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="serverconnect1.data.query" id="tableRepeat1">
    <tr>
      <td dmx-text="id"></td>
      <td dmx-text="name"></td>
      <td dmx-text="description"></td>
      <td dmx-text="current_price"></td>
      <td dmx-text="picture"></td>
      <td><dmx-serverconnect id="readproduct" url="dmxConnect/api/Products/readproduct.php" dmx-param:id="id" noload></dmx-serverconnect><button id="btn2" class="btn text-info" data-bs-target="#productInfo" dmx-on:click="modal1.show();readproduct.load({id: id},true)" dmx-bind:value="id"><i class="far fa-eye"><br></i></button>
</td>
      <td>
<form id="form1deleteproduct" method="post" action="dmxConnect/api/Products/removeproduct.php" is="dmx-serverconnect-form" dmx-on:submit="notifies1.success('Deleted From Database');serverconnect1.load({})">
<input id="productid" name="productid" type="text" class="form-control visually-hidden" dmx-bind:value="id">
<button id="btn1" class="btn text-danger text-center" type="submit"><i class="far fa-trash-alt"></i></button>
</form></td>
    </tr>
  </tbody>
</table>
</div>
</div>
</div><ul class="nav nav-tabs" id="navTabs1_tabs" role="tablist">
  <li class="nav-item">
    <a class="nav-link" id="navTabs1_3_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_3" role="tab" aria-controls="navTabs1_3" aria-selected="false">Products</a>
  </li>
</ul>
<div class="tab-content" id="navTabs1_content">
  <div class="tab-pane fade" id="navTabs1_3" role="tabpanel">



  </div>
</div>
<div class="row"></div>
</div>
</main>
<script src="bootstrap/5/js/bootstrap.bundle.min.js"></script>
</body>
</html>
