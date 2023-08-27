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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js" integrity="sha256-CutOzxCRucUsn6C6TcEYsauvvYilEniTXldPa6/wu0k=" crossorigin="anonymous"></script>
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
<link rel="stylesheet" href="dmxAppConnect/dmxValidator/dmxValidator.css" />
<script src="dmxAppConnect/dmxValidator/dmxValidator.js" defer=""></script>
<link rel="stylesheet" href="fontawesome5/css/all.min.css" />
</head>

<body id="brands" is="dmx-app">

<dmx-value id="lang" dmx-bind:value="browser1.language"></dmx-value>
<dmx-json-datasource id="trans" is="dmx-serverconnect" url="assets/translation/translation.JSON"></dmx-json-datasource>

<dmx-serverconnect id="load_product_prices" url="dmxConnect/api/servo_refered_fields_loading/load_product_prices.php"></dmx-serverconnect>
<dmx-serverconnect id="load_product_categories" url="dmxConnect/api/servo_refered_fields_loading/load_product_categories.php"></dmx-serverconnect>
<dmx-serverconnect id="load_brands" url="dmxConnect/api/servo_refered_fields_loading/load_brands.php"></dmx-serverconnect>
    <dmx-serverconnect id="read_item_product" url="dmxConnect/api/servo_products/read_product.php" dmx-param:id="id" noload dmx-param:item_id="" dmx-param:branch_id="read_item_branch.data.queryReadBranch.branch_id" dmx-param:prduct_id="list_item_products.data.query_list_products[0].product_id"></dmx-serverconnect>
    <dmx-serverconnect id="delete_item_product" url="dmxConnect/api/servo_products/delete_product.php"></dmx-serverconnect>
    <dmx-serverconnect id="list_item_products" url="dmxConnect/api/servo_products/list_products.php"></dmx-serverconnect>
    <div is="dmx-browser" id="browser1"></div>
    <dmx-notifications id="notifies1"></dmx-notifications>
    <?php include 'header.php'; ?><main class="mt-4">
        <div class="modal create-modal" id="createItemModal" is="dmx-bs5-modal" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{trans.data.newProduct[lang.value]}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <form is="dmx-serverconnect-form" id="serverconnectFormCreateProduct" method="post" action="dmxConnect/api/servo_products/create_product.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-on:success="notifies1.success('Success');serverconnectFormCreateProduct.reset();list_item_products.load();createItemModal.hide()">
<div class="mb-3 row">
  <label for="inp_product_name" class="col-sm-2 col-form-label"><b>{{trans.data.name[lang.value]}}</b></label>
  <div class="col-sm-10">
    <input type="text" class="form-control" id="inp_product_name" name="product_name" aria-describedby="inp_product_name_help">
  </div>
</div>
<div class="mb-3 row">
  <label for="product_price" class="col-sm-2 col-form-label">{{trans.data.price[lang.value]}}</label>
  <div class="col-sm-10">
<input id="product_price" name="product_price" type="number" class="form-control">
  </div>
</div>
<div class="mb-3 row">
  <label for="inp_servo_product_brands_product_brand_id" class="col-sm-2 col-form-label">{{trans.data.brandName[lang.value]}}</label>
  <div class="col-sm-10">
    <select id="inp_servo_product_brands_product_brand_id" class="form-control" name="servo_product_brands_product_brand_id" dmx-bind:options="load_brands.data.query" optiontext="product_brand_name" optionvalue="product_brand_id">
    </select>
  </div>
</div>
<div class="mb-3 row">
  <label for="inp_servo_product_categories" class="col-sm-2 col-form-label">{{trans.data.category[lang.value]}}</label>
  <div class="col-sm-10">
    <select id="inp_servo_product_categories" class="form-control" name="servo_product_category_product_category_id" dmx-bind:options="load_product_categories.data.query" optiontext="product_category_name" optionvalue="product_categories_id">
    </select>
  </div>
</div>
<div class="mb-3 row">
  <label for="inp_product_description" class="col-sm-2 col-form-label">{{trans.data.description[lang.value]}}</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" id="inp_product_description" name="product_description" aria-describedby="inp_product_description_help">
  </div>
</div>
<div class="mb-3 row">
  <label for="inp_product_type" class="col-sm-2 col-form-label">{{trans.data.type[lang.value]}}</label>
  <div class="col-sm-10">
<select id="select3" class="form-select" name="product_type">
<option value="Store">Store</option><option value="Stock">Stock</option></select>
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
                        <h5 class="modal-title fw-bold">{{trans.data.product[lang.value]}}: {{read_item_product.data.query_list_product.product_name}}&nbsp;&nbsp;</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
<h1 class="text-warning">{{read_item_product.data.query_read_product.product_name}}</h1>
                        <form is="dmx-serverconnect-form" id="readitem" method="post" action="dmxConnect/api/servo_products/update_product.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="read_item_product.data.query_delete_product" dmx-on:success="notifies1.success('Success');list_item_products.load();readItemModal.hide()">
<div class="mb-3 row">
  <label for="inp_product_id" class="col-sm-2 col-form-label">&nbsp;#</label>
  <div class="col-sm-10">
    <input type="number" class="form-control" id="inp_product_id" name="product_id" dmx-bind:value="read_item_product.data.query_read_product.product_id" aria-describedby="inp_product_id_help" readonly="true">
  </div>
</div>
<div class="mb-3 row">
  <label for="inp_product_name" class="col-sm-2 col-form-label">{{trans.data.name[lang.value]}}</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" id="inp_product_name" name="product_name" dmx-bind:value="read_item_product.data.query_read_product.product_name" aria-describedby="inp_product_name_help">
  </div>
</div>
<div class="mb-3 row">
  <label for="inp_product_picture" class="col-sm-2 col-form-label">{{trans.data.picture[lang.value]}}</label>
  <div class="col-sm-10">
    <input type="file" class="form-control" id="inp_product_picture" name="product_picture" dmx-bind:value="read_item_product.data.query_delete_product.product_picture" aria-describedby="inp_product_picture_help">
  </div>
</div>
<div class="mb-3 row">
  <label for="product_price" class="col-sm-2 col-form-label">{{trans.data.price[lang.value]}}</label>
  <div class="col-sm-10">
    <input type="number" class="form-control" id="product_price" name="product_price" dmx-bind:value="read_item_product.data.query_read_product.product_price" aria-describedby="inp_servo_product_price_product_price_id_help">
  </div>
</div>
<div class="mb-3 row">
  <label for="product_price" class="col-sm-2 col-form-label">{{trans.data.brandName[lang.value]}}</label>
  <div class="col-sm-10">
<select id="select1" class="form-select" name="servo_product_brands_product_brand_id" dmx-bind:options="load_brands.data.query" optiontext="product_brand_name" optionvalue="product_brand_id" dmx-bind:value="read_item_product.data.query_read_product.product_brand_id">
</select>
  </div>
</div>
<div class="mb-3 row">
  <label for="product_price" class="col-sm-2 col-form-label">{{trans.data.category[lang.value]}}</label>
  <div class="col-sm-10">
<select id="select2" class="form-select" name="servo_product_category_product_category_id" dmx-bind:value="read_item_product.data.query_read_product.product_categories_id" dmx-bind:options="load_product_categories.data.query" optiontext="product_category_name" optionvalue="product_categories_id">
</select>
  </div>
</div>
<div class="mb-3 row">
  <label for="product_discount" class="col-sm-2 col-form-label">{{trans.data.discount[lang.value]}}</label>
  <div class="col-sm-10">
    <input type="number" class="form-control" id="product_discount" name="product_discount" dmx-bind:value="read_item_product.data.query_read_product.product_discount" aria-describedby="inp_servo_product_discount_product_discount_id_help">
  </div>
</div>
<div class="mb-3 row">
  <label for="inp_product_description" class="col-sm-2 col-form-label">{{trans.data.description[lang.value]}}</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" id="inp_product_description" name="product_description" dmx-bind:value="read_item_product.data.query_read_product.product_description" aria-describedby="inp_product_description_help" placeholder="Enter Description" style="}: ;">
  </div>
</div>
<div class="mb-3 row">
  <label for="inp_product_description1" class="col-sm-2 col-form-label">{{trans.data.type[lang.value]}}</label>
  <div class="col-sm-10">
<select id="select4" class="form-select" name="product_type" dmx-bind:value="read_item_product.data.query_read_product.product_type" optiontext="read_item_product.data.query_read_product.product_type" optionvalue="read_item_product.data.query_read_product.product_type" dmx-bind:options="read_item_product.data.query_read_product.product_type">
<option value=""></option><option value="Store">Store</option><option value="2Stock">Stock</option></select>
  </div>
</div>
<div class="mb-3 row">
  <div class="col-sm-2">&nbsp;</div>
  <div class="col-sm-10">
    <button type="submit" class="btn btn-primary" dmx-bind:value="read_item_product.data.query_delete_product.Save">{{trans.data.update[lang.value]}}</button>
  </div>
</div>
</form>
                    </div>
                    <div class="modal-footer">
                        <form id="form1" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_products/delete_product.php" dmx-on:success="notifies1.success('Success');readItemModal.hide();list_item_products.load()" onsubmit=" return confirm('CONFIRM DELETE?');">
                            <input id="text1" name="product_id" type="hidden" class="form-control" dmx-bind:value="read_item_product.data.query_read_product.product_id">

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
                    <h2 class="servo-page-heading fw-lighter">{{trans.data.products[lang.value]}}</h2>
                </div>
                <div class="col style13 page-button" id="pagebuttons">
                    <button id="btn1" class="btn style12 fw-light" data-bs-toggle="modal" data-bs-target="#createItemModal" style="float: right;"><i class="fas fa-plus fa-2x style14"></i></button>
                </div>
            </div>
            <div class="row">
                <div class="col">


                    <div class="table-responsive">
<table class="table table-hover table-sm table-borderless">
  <thead>
    <tr>
      <th>#</th>
      <th>{{trans.data.productName[lang.value]}}</th>
      <th>{{trans.data.category[lang.value]}}</th>
      <th>{{trans.data.price[lang.value]}}</th>
      <th>{{trans.data.brandName[lang.value]}}</th>
      <th>{{trans.data.description[lang.value]}}</th>
      <th></th>
<th></th>
    </tr>
  </thead>
  <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_item_products.data.query_list_products" id="tableRepeat2">
    <tr>
      <td dmx-text="product_id"></td>
      <td dmx-text="product_name"></td>
      <td dmx-text="product_category_name"></td>
      <td dmx-text="product_price"></td>
      <td dmx-text="product_brand_name"></td>
      <td dmx-text="product_description"></td>
      <td>
        <button id="btn2" class="btn text-success" data-bs-target="#productInfo" dmx-on:click="readItemModal.show();read_item_product.load({prduct_id: product_id})" dmx-bind:value="list_item_products.data.query_list_products[0].product_id"><i class="far fa-eye fa-lg"><br></i></button>
    </td>
    <td>

        <form id="form2" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_products/delete_product.php" dmx-on:success="notifies1.success('Success');list_item_products.load()" dmx-on:error="notifies1.warning('Error')"><input id="text2" name="product_id" type="text" class="form-control visually-hidden" dmx-bind:value="product_id"><button id="btn2" class="btn text-danger" data-bs-target="#productInfo" type="submit"><i class="far fa-trash-alt fa-lg"><br></i></button></form>

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