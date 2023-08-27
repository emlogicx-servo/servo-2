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
  <link rel="stylesheet" href="fontawesome5/css/all.min.css" />
  <script src="dmxAppConnect/dmxBootstrap5PagingGenerator/dmxBootstrap5PagingGenerator.js" defer=""></script>
</head>

<body id="brands" is="dmx-app">
  <dmx-query-manager id="listBrands"></dmx-query-manager>

  <dmx-value id="lang" dmx-bind:value="browser1.language"></dmx-value>
  <dmx-json-datasource id="trans" is="dmx-serverconnect" url="assets/translation/translation.JSON"></dmx-json-datasource>

  <dmx-serverconnect id="readbrand" url="dmxConnect/api/servo_brands/read_brand.php" dmx-param:id="id" noload></dmx-serverconnect>
  <dmx-serverconnect id="deletebrand" url="dmxConnect/api/servo_brands/delete_brand.php"></dmx-serverconnect>
  <dmx-serverconnect id="serverconnectListBrands" url="dmxConnect/api/servo_brands/list_brands_paged.php" dmx-param:offset="query.offset" dmx-param:brandfilter="brandfilter.value" dmx-param:limit="brand_sort_limit.value"></dmx-serverconnect>
  <div is="dmx-browser" id="browser1"></div>
  <dmx-notifications id="notifies1"></dmx-notifications>
  <?php include 'header.php'; ?><main class="mt-4">
    <div class="modal create-modal" id="createItemModal" is="dmx-bs5-modal" tabindex="-1">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{trans.data.createBrand[lang.value]}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <form is="dmx-serverconnect-form" id="serverconnectFormCreateBrand" method="post" action="dmxConnect/api/servo_brands/create_brand.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-on:success="notifies1.success('Success');serverconnectListBrands.load();createItemModal.hide()" dmx-on:error="notifies1.warning('Error')">
                <div class="mb-3 row">
                  <label for="inp_product_brand_name" class="col-sm-2 col-form-label">{{trans.data.brandName[lang.value]}}</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inp_product_brand_name" name="product_brand_name" aria-describedby="inp_product_brand_name_help" placeholder="Enter Product Brand Name ">
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
            <h5 class="modal-title">{{trans.data.brandInfo[lang.value]}}: {{readbrand.data.query_list_product_brands.product_brand_name}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form is="dmx-serverconnect-form" id="serverconnectfReadBrand" method="post" action="dmxConnect/api/servo_brands/update_brand.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="readbrand.data.query_list_product_brands" dmx-on:success="notifies1.success('Success');serverconnectListBrands.load();readItemModal.hide()">
              <input type="hidden" name="product_brand_id" id="inp_product_brand_id" dmx-bind:value="readbrand.data.query_list_product_brands.product_brand_id">
              <div class="mb-3 row">
                <label for="inp_product_brand_name" class="col-sm-2 col-form-label" style="font-family: 'josefin-sans';">{{trans.data.brandName[lang.value]}}</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inp_product_brand_name&" name="product_brand_name" dmx-bind:value="readbrand.data.query_list_product_brands.product_brand_name" aria-describedby="inp_product_brand_name_help" placeholder="Enter Brand Name" style="">
                </div>
              </div>
              <div class="mb-3 row">
                <div class="col-sm-2">&nbsp;</div>
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-primary" dmx-bind:value="readbrand.data.query_list_product_brands.Save">{{trans.data.update[lang.value]}}</button>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <form id="form1" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_brands/delete_brand.php" dmx-on:success="notifies1.success('Success');serverconnectListBrands.load();readItemModal.hide()" onsubmit=" return confirm('CONFIRM DELETE?');">
              <input id="text1" name="product_brand_id" type="hidden" class="form-control" dmx-bind:value="readbrand.data.query_list_product_brands.product_brand_id">

              <button id="btn6" class="btn text-danger" type="submit">
                <i class="far fa-trash-alt fa-lg"></i>
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="mt-auto ms-2 me-2">




      <div class="row servo-page-header">
        <div class="col-auto" dmx-animate-enter="slideInLeft">
          <i class="fas fa-tag fa-2x" style="color: #fffa18 !important;"></i>
        </div>
        <div class="col-auto page-heading">
          <h4 class="servo-page-heading">{{trans.data.brands[lang.value]}}</h4>
        </div>
        <div class="col style13 page-button" id="pagebuttons">
          <button id="btn1" class="btn style12 fw-light add-button text-body" data-bs-toggle="modal" data-bs-target="#createItemModal" style="float: right;"><i class="fas fa-plus fa-2x style14" style=""></i></button>
        </div>
      </div>

      <div class="row justify-content-between justify-content-sm-between justify-content-md-between justify-content-lg-between justify-content-xl-between justify-content-xxl-between sorter bg-light">
        <div class="col-12 col-sm-12 col-lg-4"><input id="brandfilter" name="brandfilter" type="text" class="form-control mb-2 form-control-sm" dmx-bind:placeholder="trans.data.search[lang.value]+'  '"></div>

        <div class="d-flex col-xl-5 col-lg-5 flex-wrap col-sm offset-sm-0 flex-sm-wrap flex-md-wrap col-md col">
          <ul class="pagination flex-wrap flex-sm-wrap flex-md-wrap flex-lg-wrap flex-xl-wrap flex-xxl-wrap" dmx-populate="serverconnectListBrands.data.query_list_product_brands" dmx-state="listBrands" dmx-offset="offset" dmx-generator="bs5paging">
            <li class="page-item" dmx-class:disabled="serverconnectListBrands.data.query_list_product_brands.page.current == 1" aria-label="First">
              <a href="javascript:void(0)" class="page-link" dmx-on:click="listBrands.set('offset',serverconnectListBrands.data.query_list_product_brands.page.offset.first)"><span aria-hidden="true">&lsaquo;&lsaquo;</span></a>
            </li>
            <li class="page-item" dmx-class:disabled="serverconnectListBrands.data.query_list_product_brands.page.current == 1" aria-label="Previous">
              <a href="javascript:void(0)" class="page-link" dmx-on:click="listBrands.set('offset',serverconnectListBrands.data.query_list_product_brands.page.offset.prev)"><span aria-hidden="true">&lsaquo;</span></a>
            </li>
            <li class="page-item" dmx-class:active="title == serverconnectListBrands.data.query_list_product_brands.page.current" dmx-class:disabled="!active" dmx-repeat="serverconnectListBrands.data.query_list_product_brands.getServerConnectPagination(2,1,'...')">
              <a href="javascript:void(0)" class="page-link" dmx-on:click="listBrands.set('offset',(page-1)*serverconnectListBrands.data.query_list_product_brands.limit)">{{title}}</a>
            </li>
            <li class="page-item" dmx-class:disabled="serverconnectListBrands.data.query_list_product_brands.page.current ==  serverconnectListBrands.data.query_list_product_brands.page.total" aria-label="Next">
              <a href="javascript:void(0)" class="page-link" dmx-on:click="listBrands.set('offset',serverconnectListBrands.data.query_list_product_brands.page.offset.next)"><span aria-hidden="true">&rsaquo;</span></a>
            </li>
            <li class="page-item" dmx-class:disabled="serverconnectListBrands.data.query_list_product_brands.page.current ==  serverconnectListBrands.data.query_list_product_brands.page.total" aria-label="Last">
              <a href="javascript:void(0)" class="page-link" dmx-on:click="listBrands.set('offset',serverconnectListBrands.data.query_list_product_brands.page.offset.last)"><span aria-hidden="true">&rsaquo;&rsaquo;</span></a>
            </li>
          </ul>
        </div>
        <div class="col-lg-1 col-xl-1 col-md-2 col-sm-2 col-3 offset-lg-1"><select id="brand_sort_limit" class="form-select" name="brand_sort_limit">
            <option value="5">5</option>
            <option selected="" value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
            <option value="''">{{trans.data.all[lang.value]}}</option>
          </select></div>
      </div>

      <div class="row">
        <div class="col">


          <div class="table-responsive servo-shadow bg-light">
            <table class="table table-hover table-sm table-borderless">
              <thead>
                <tr>
                  <th>#</th>
                  <th>{{trans.data.brandName[lang.value]}}</th>
                  <th></th>
                </tr>
              </thead>
              <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="serverconnectListBrands.data.query_list_product_brands.data" id="tableRepeat1">
                <tr>
                  <td dmx-text="product_brand_id"></td>
                  <td dmx-text="product_brand_name"></td>
                  <td>
                    <button id="btn2" class="btn open" data-bs-target="#productInfo" dmx-on:click="readItemModal.show();readbrand.load({brand_id: product_brand_id})" dmx-bind:value="serverconnectListBrands.data.query_list_product_brands[0].product_brand_id"><i class="fas fa-expand-alt"><br></i></button>
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