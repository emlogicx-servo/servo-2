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
<link rel="stylesheet" href="fontawesome5/css/all.min.css" />
<script src="dmxAppConnect/dmxBootstrap5PagingGenerator/dmxBootstrap5PagingGenerator.js" defer=""></script>
</head>
<body id="brands" is="dmx-app">
<dmx-query-manager id="product_categories"></dmx-query-manager>
<dmx-serverconnect id="list_product_category_options" url="dmxConnect/api/servo_product_category_options/list_product_category_options.php" dmx-param:category_id="read_item_product_category.data.queryReadProductCategory.product_categories_id"></dmx-serverconnect>
<dmx-serverconnect id="read_item_product_category" url="dmxConnect/api/servo_product_categories/read_product_category.php" dmx-param:id="id" noload dmx-param:item_id=""></dmx-serverconnect>
<dmx-serverconnect id="delete_item_product_category" url="dmxConnect/api/servo_product_categories/delete_product_category.php"></dmx-serverconnect><dmx-serverconnect id="list_product_categories" url="dmxConnect/api/servo_product_categories/list_product_categories_copy.php" dmx-param:offset="query.offset" dmx-param:limit="4"></dmx-serverconnect><div is="dmx-browser" id="browser1"></div>
<dmx-notifications id="notifies1"></dmx-notifications>
<?php include 'header.php'; ?>
<main class="mt-4">
<div class="modal create-modal" id="createItemModal" is="dmx-bs5-modal" tabindex="-1">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{trans.data.newCategory[lang.value]}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
<div class="row"><form is="dmx-serverconnect-form" id="serverconnectFormCreateProductCategory" method="post" action="dmxConnect/api/servo_product_categories/create_product_category.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-on:success="serverconnectFormCreateProductCategory.reset();list_product_categories.load({});notifies1.success('Success');createItemModal.hide()">
<div class="mb-3 row">
  <label for="inp_product_category_name" class="col-sm-2 col-form-label">{{trans.data.categoryName[lang.value]}}</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" id="inp_product_category_name" name="product_category_name" aria-describedby="inp_product_category_name_help">
  </div>
</div>
<div class="mb-3 row">
  <div class="col-sm-2">&nbsp;</div>
  <div class="col-sm-10">
    <button type="submit" class="btn btn-primary">{{trans.data.ok[lang.value]}}</button>
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
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{trans.data.category[lang.value]}}: {{readitem.data.query.user_profile_name}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
<div class="row">
<div class="col">
<ul class="nav nav-tabs" id="navTabs1_tabs" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="navTabs1_1_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_1" role="tab" aria-controls="navTabs1_1" aria-selected="true">{{trans.data.info[lang.value]}}</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="navTabs1_2_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_2" role="tab" aria-controls="navTabs1_2" aria-selected="false">{{trans.data.options[lang.value]}}</a>
  </li>
</ul>
<div class="tab-content" id="navTabs1_content">
  <div class="tab-pane fade show active mt-3" id="navTabs1_1" role="tabpanel">
<div class="row">
<div class="col"><form is="dmx-serverconnect-form" id="readItem" method="post" action="dmxConnect/api/servo_product_categories/update_product_category.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="read_item_product_category.data.queryReadProductCategory" dmx-on:success="list_product_categories.load();notifies1.success('Success');readItemModal.hide()">
<div class="mb-3 row">
  <label for="inp_product_categories_id" class="col-sm-2 col-form-label">ID</label>
  <div class="col-sm-10">
    <input type="number" class="form-control" id="inp_product_categories_id" name="product_categories_id" dmx-bind:value="read_item_product_category.data.queryReadProductCategory.product_categories_id" aria-describedby="inp_product_categories_id_help" placeholder="Enter ID" readonly="true">
  </div>
</div>
<div class="mb-3 row">
  <label for="inp_product_category_name" class="col-sm-2 col-form-label">{{trans.data.categoryName[lang.value]}}</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" id="inp_product_category_name" name="product_category_name" dmx-bind:value="read_item_product_category.data.queryReadProductCategory.product_category_name" aria-describedby="inp_product_category_name_help" placeholder="Enter Product Category Name">
  </div>
</div>
<div class="mb-3 row">
  <div class="col-sm-2">&nbsp;</div>
  <div class="col-sm-10">
    <button type="submit" class="btn btn-primary" dmx-bind:value="read_item_product_category.data.queryReadProductCategory.Save">{{trans.data.update[lang.value]}}</button>
  </div>
</div>
</form></div>
</div>
  </div>
  <div class="tab-pane fade mt-3" id="navTabs1_2" role="tabpanel">
<div class="row">
<div class="col">
<form id="createProductCategory" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_product_category_options/create_product_category_option.php" dmx-on:success="notifies1.success('Success!');list_product_category_options.load({});createProductCategory.reset()" class="d-flex">
<div class="row">
<div class="col">
<input id="categyOptionCategory" name="category_option_category_id" type="text" class="form-control visually-hidden" dmx-bind:value="read_item_product_category.data.queryReadProductCategory.product_categories_id"><input id="categoryOptionOption" name="category_option_option" type="text" class="form-control">

<small id="bs5-form-group-help1" class="form-text text-muted">{{trans.data.newOption[lang.value]}}</small>
</div><div class="col">
<button id="btn3" class="btn btn-warning" type="submit">
<i class="fas fa-plus"></i>
</button>
</div>

</div>
</form>
</div>
</div>
<div class="row mt-3">
<div class="col">
<div class="table-responsive">
<table class="table table-hover table-sm">
  <thead>
    <tr>
      <th>#</th>
      <th>{{trans.data.option[lang.value]}}</th>
<th></th>
    </tr>
  </thead>
  <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_product_category_options.data.query_product_category_options" id="tableRepeat1">
    <tr>
      <td dmx-text="category_option_id"></td>
      <td>
<form id="updateCategoryOption" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_product_category_options/update_product_category_option.php" dmx-on:success="notifies1.success('Sucess!');list_product_category_options.load({})" class="d-flex">
<div class="row">
<div class="col">
<input id="categoryOption" name="category_option_option" type="text" class="form-control" dmx-bind:value="category_option_option">
<input id="categpryOptionIdUdate" name="category_option_id" type="text" class="form-control visually-hidden" dmx-bind:value="category_option_id">
</div>
<div class="col">
<button id="btn4" class="btn text-warning" type="submit"><i class="fas fa-sync"></i>
</button>
</div>
</div>
</form>
</td>
<td>
<form id="deleteCategoryOption" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_product_category_options/delete_product_category_option.php" dmx-on:success="notifies1.success('Sucess!');list_product_category_options.load({})" class="d-flex">
<div class="row">
<div class="col visually-hidden">
<input id="categoryOption1" name="category_option_id" type="text" class="form-control" dmx-bind:value="category_option_id">
</div>
<div class="col">
<button id="btn5" class="btn text-secondary" type="submit"><i class="fas fa-trash-alt fa-lg"></i>
</button>
</div>
</div>
</form>
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
</div>

      </div>
      <div class="modal-footer">
<form id="form1" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_product_categories/delete_product_category.php" dmx-on:success="notifies1.success('Success');list_product_categories.load();readItemModal.hide()" onsubmit=" return confirm('CONFIRM DELETE?');">
<input id="text1" name="product_categories_id" type="hidden" class="form-control" dmx-bind:value="read_item_product_category.data.queryReadProductCategory.product_categories_id">

<button id="btn6" class="btn text-danger" type="submit">
<i class="far fa-trash-alt fa-lg"></i>
</button>
</form>
      </div>
    </div>
  </div>
</div>

</main>
<main><div class="container mt-auto">




<div class="row servo-page-header">
<div class="col">
<h4 class="servo-page-heading fw-lighter text-light">{{trans.data.categories[lang.value]}}</h4>
</div>
<div class="col style13 page-button" id="pagebuttons">
<button id="btn1" class="btn style12 fw-light text-warning" data-bs-toggle="modal" data-bs-target="#createItemModal" style="float: right;"><i class="fas fa-plus fa-2x style14"></i></button>
</div>
</div><div class="row">
<table class="table">
  <thead>
    <tr>
      <th>Product categories</th>
      <th>Product category name</th>
    </tr>
  </thead>
  <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_product_categories.data.query_list_product_categories_copy.data" id="tableRepeat2">
    <tr>
      <td dmx-text="product_categories_id"></td>
      <td dmx-text="product_category_name"></td>
    </tr>
  </tbody>
</table>
<ul class="pagination" dmx-populate="list_product_categories.data.query_list_product_categories_copy" dmx-state="product_categories" dmx-offset="offset" dmx-generator="bs5paging">
  <li class="page-item" dmx-class:disabled="list_product_categories.data.query_list_product_categories_copy.page.current == 1" aria-label="First">
    <a href="javascript:void(0)" class="page-link bg-secondary" dmx-on:click="product_categories.set('offset',list_product_categories.data.query_list_product_categories_copy.page.offset.first)"><span aria-hidden="true">&lsaquo;&lsaquo;</span></a>
  </li>
  <li class="page-item bg-secondary" dmx-class:disabled="list_product_categories.data.query_list_product_categories_copy.page.current == 1" aria-label="Previous">
    <a href="javascript:void(0)" class="page-link bg-secondary" dmx-on:click="product_categories.set('offset',list_product_categories.data.query_list_product_categories_copy.page.offset.prev)"><span aria-hidden="true">&lsaquo;</span></a>
  </li>
  <li class="page-item" dmx-class:active="title == list_product_categories.data.query_list_product_categories_copy.page.current" dmx-class:disabled="!active" dmx-repeat="list_product_categories.data.query_list_product_categories_copy.getServerConnectPagination(2,1,'...')">
    <a href="javascript:void(0)" class="page-link bg-warning" dmx-on:click="product_categories.set('offset',(page-1)*list_product_categories.data.query_list_product_categories_copy.limit)">{{title}}</a>
  </li>
  <li class="page-item bg-secondary" dmx-class:disabled="list_product_categories.data.query_list_product_categories_copy.page.current ==  list_product_categories.data.query_list_product_categories_copy.page.total" aria-label="Next">
    <a href="javascript:void(0)" class="page-link bg-secondary" dmx-on:click="product_categories.set('offset',list_product_categories.data.query_list_product_categories_copy.page.offset.next)"><span aria-hidden="true">&rsaquo;</span></a>
  </li>
  <li class="page-item bg-secondary" dmx-class:disabled="list_product_categories.data.query_list_product_categories_copy.page.current ==  list_product_categories.data.query_list_product_categories_copy.page.total" aria-label="Last">
    <a href="javascript:void(0)" class="page-link bg-secondary" dmx-on:click="product_categories.set('offset',list_product_categories.data.query_list_product_categories_copy.page.offset.last)"><span aria-hidden="true">&rsaquo;&rsaquo;</span></a>
  </li>
</ul>
</div>
</div></main><script src="bootstrap/5/js/bootstrap.bundle.min.js"></script>
</body>
</html>
