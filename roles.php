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
			"options": {"permissions":"finance","loginUrl":"login.php","forbiddenUrl":"login.php","provider":"servo_login"}
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
    <script src="js/moment.js/2/moment.min.js"></script>
    <script src="dmxAppConnect/dmxBootstrap5Navigation/dmxBootstrap5Navigation.js" defer=""></script>
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

    <script src="dmxAppConnect/dmxBootstrap5Collapse/dmxBootstrap5Collapse.js" defer=""></script>


    <script src="dmxAppConnect/dmxFormatter/dmxFormatter.js" defer=""></script>
    <link rel="stylesheet" href="dmxAppConnect/dmxDatePicker/bgthemes/dark-calendar.css" />
    <link rel="stylesheet" href="dmxAppConnect/dmxValidator/dmxValidator.css" />
    <script src="dmxAppConnect/dmxValidator/dmxValidator.js" defer=""></script>
    <link rel="stylesheet" href="fontawesome5/css/all.min.css" />
    <script src="dmxAppConnect/dmxCharts/Chart.min.js" defer=""></script>
    <script src="dmxAppConnect/dmxCharts/dmxCharts.js" defer=""></script>
    <script src="dmxAppConnect/dmxBootstrap5PagingGenerator/dmxBootstrap5PagingGenerator.js" defer=""></script>
    <link rel="stylesheet" href="dmxAppConnect/dmxAnimateCSS/animate.min.css" />
    <script src="dmxAppConnect/dmxAnimateCSS/dmxAnimateCSS.js" defer=""></script>
    <link rel="stylesheet" href="bootstrap/5/servolight/bootstrap.min.css" />
    <link rel="stylesheet" href="bootstrap/5/servodark/bootstrap.min.css" />

    <link rel="stylesheet" href="bootstrap/5/css/bootstrap.min.css" />
    <script src="dmxAppConnect/dmxBootbox5/bootstrap-modbox.min.js" defer></script>
    <script src="dmxAppConnect/dmxBootbox5/dmxBootbox5.js" defer></script>
    <script src="dmxAppConnect/dmxDataTraversal/dmxDataTraversal.js" defer></script>
</head>

<body id="products" is="dmx-app">

    <dmx-session-manager id="session1"></dmx-session-manager>
    <dmx-data-iterator id="iterator1" dmx-bind:data="user_has_not_role.data.pagination" dmx-bind:index="0" loop="true"></dmx-data-iterator>
    <dmx-serverconnect id="role_has_user" url="dmxConnect/api/roles/users_with_role.php" dmx-param:role_id="role_id.value" noload="true" dmx-param:current_page="1" dmx-param:limit="revokeRoleModal.limit.selectedValue" dmx-param:offset="0"></dmx-serverconnect>
    <dmx-value id="role_name"></dmx-value>
    <dmx-value id="role_id"></dmx-value>
    <dmx-serverconnect id="user_has_not_role" url="dmxConnect/api/roles/user_not_have_role.php" dmx-param:limit="grantRoleModal.limit.selectedValue" noload="true"></dmx-serverconnect>
    <dmx-serverconnect id="read_role" url="dmxConnect/api/roles/read.php" dmx-param:dir="'desc:id'"></dmx-serverconnect>
    <dmx-serverconnect id="role_delete" url="dmxConnect/api/roles/delete.php" dmx-param:dir="'desc:id'"></dmx-serverconnect>
    <dmx-serverconnect id="role_list" url="dmxConnect/api/roles/list.php" dmx-param:offset="" dmx-param:limit="role_list_limit.selectedValue" dmx-param:groupfilter="groupFilter.value" dmx-param:sort="'asc'"></dmx-serverconnect>
    <dmx-serverconnect id="permission_list" url="dmxConnect/api/permission/list.php" dmx-param:offset="" dmx-param:limit="role_list_limit.selectedValue" dmx-param:groupfilter="groupFilter.value" dmx-param:sort="'asc'"></dmx-serverconnect>


    <dmx-value id="lang" dmx-bind:value="browser1.language"></dmx-value>
    <dmx-json-datasource id="trans" is="dmx-serverconnect" url="assets/translation/translation.JSON"></dmx-json-datasource>


    <div is="dmx-browser" id="browser1"></div>
    <dmx-notifications id="notifies1" position="bottom" timeout="50" extended-timeout="10"></dmx-notifications>
    <?php require 'header.php'; ?><main class="rounded" id="MainBody">
        <div class="mt-auto ms-3 me-3">




            <div class="row mt-2 ms-0 me-0">
                <div class="bg-light rounded offset-lg-1 col-lg-10">



                    <div class="row   mt-3">
                        <div class="d-flex flex-wrap align-items-baseline col">

                            <input id="productSearch" name="text13" type="search" class="form-control mb-2 me-2" dmx-bind:placeholder="trans.data.search[lang.value]+'  '">
                            <input id="productCategorySearch" name="text1" type="text" class="form-control mb-2 me-2 visually-hidden" dmx-bind:placeholder="trans.data.search[lang.value]+'  '" dmx-bind:value="null">
                            <ul class="pagination" dmx-populate="role_list.data.query" dmx-generator="bs5paging">
                                <li class="page-item" dmx-class:disabled="role_list.data.query.page.current == 1" aria-label="First">
                                    <a href="javascript:void(0)" class="page-link" dmx-on:click="role_list.load({offset: role_list.data.query.page.offset.first})"><span aria-hidden="true">&lsaquo;&lsaquo;</span></a>
                                </li>
                                <li class="page-item" dmx-class:disabled="role_list.data.query.page.current == 1" aria-label="Previous">
                                    <a href="javascript:void(0)" class="page-link" dmx-on:click="role_list.load({offset: role_list.data.query.page.offset.prev})"><span aria-hidden="true">&lsaquo;</span></a>
                                </li>
                                <li class="page-item" dmx-class:active="title == role_list.data.query.page.current" dmx-class:disabled="!active" dmx-repeat="role_list.data.query.getServerConnectPagination(2,1,'...')">
                                    <a href="javascript:void(0)" class="page-link" dmx-on:click="role_list.load({offset: (page-1)*role_list.data.query.limit})">{{title}}</a>
                                </li>
                                <li class="page-item" dmx-class:disabled="role_list.data.query.page.current ==  role_list.data.query.page.total" aria-label="Next">
                                    <a href="javascript:void(0)" class="page-link" dmx-on:click="role_list.load({offset: role_list.data.query.page.offset.next})"><span aria-hidden="true">&rsaquo;</span></a>
                                </li>
                                <li class="page-item" dmx-class:disabled="role_list.data.query.page.current ==  role_list.data.query.page.total" aria-label="Last">
                                    <a href="javascript:void(0)" class="page-link" dmx-on:click="role_list.load({offset: role_list.data.query.page.offset.last})"><span aria-hidden="true">&rsaquo;&rsaquo;</span></a>
                                </li>
                            </ul><select id="role_list_limit" class="form-select" name="product_category_sort_limit" style="max-width: 100px;" dmx-on:changed="role_list.load({})">
                                <option value="1">1</option>
                                <option selected="" value="5">5</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>

                    </div>
                    <div class="collapse" id="productCategoryList" is="dmx-bs5-collapse">
                        <section>
                            <div class="row mt-2">
                                <div class="col">
                                    <div id="repeatProductCategories" is="dmx-repeat" dmx-bind:repeat="list_item_products.data.list_product_categories"><button id="btn11" class="btn mb-1 me-1 bg-info text-white" dmx-text="product_category_name" dmx-on:click="productCategorySearch.setValue(product_categories_id);productCategoryList.toggle();selectedCategory.setValue(product_category_name)"></button></div>

                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="table-responsive servo-shadow shadow-none">
                        <table class="table table-hover table-sm">
                            <thead>
                                <tr>
                                    <th class="text-lg-center">Id</th>
                                    <th class="text-lg-center">Name</th>
                                    <th scope="row" class="text-lg-center">Action</th>
                                </tr>
                            </thead>
                            <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="role_list.data.query.data" id="tableRepeat7">
                                <tr>

                                    <td dmx-text="id" class="text-lg-center"></td>
                                    <td dmx-text="name" class="text-lg-center"></td>
                                    <td class="text-lg-center">
                                        <div class="btn-group" role="group" aria-label="Button Group">
                                            <button id="btn18" class="btn btn-secondary" dmx-on:click="read_role.load({role_id: id});editRoleModal.role_create_form1.role_name1.setValue(read_role.data.role_query.name);editRoleModal.show()"><i class="far fa-edit"></i></button>
                                            <button id="btn3" class="btn btn-primary"><i class="fas fa-eye"></i></button>
                                            <button id="btn2" class="btn btn-danger" dmx-on:click="run([{run:{outputType:'text',action:`role_name.setValue(name)`}},{'bootbox.alert':{message:`\'You are about to delete the role \'+role_name.value.uppercase()+\' \'`,title:'Delete Role Confirmation',buttons:{ok:{label:'Delete',className:'btn-danger'}}}}])"><i class="fas fa-trash"></i></button>
                                        </div>
                                    </td>
                                    <td>
                                        <button id="btn19" class="btn btn-outline-primary" data-bs-target="#grantRoleModal" dmx-on:click="role_id.setValue(id);role_name.setValue(name);user_has_not_role.load({role_id: id, offset: 0, limit: grantRoleModal.limit.selectedValue, current_page: 1});grantRoleModal.show()">
                                            <font face="Font Awesome 5 Free"><b>Grant&nbsp;</b></font><i class="fas fa-user-plus"></i>
                                        </button>
                                        <button id="btn4" class="btn btn-outline-primary" dmx-on:click="role_id.setValue(id);role_name.setValue(name);role_has_user.load({role_id: id});revokeRoleModal.show()">
                                            <font face="Font Awesome 5 Free"><b>Revoke&nbsp;</b></font><i class="fas fa-user-minus"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    </table>
                </div>
            </div>
            <div id="conditional1" is="dmx-if" dmx-bind:condition="list_user_info.data.user_permissions.contains('role:read')">
                <input id="text2" name="text2" type="text" class="form-control">
            </div>
        </div>

        </div>
    </main>
    <main class="mt-4">
        <div class="modal readitem" id="readItemModal" is="dmx-bs5-modal" tabindex="-1" style="" nocloseonclick="true">
            <div class="modal-dialog modal-xl modal-fullscreen-xxl-down modal-dialog-scrollable" role="document" style="margin: 0px !important; width: 100% !important; height: 99% !important; max-width: 100% !important; max-height: 99% !important;">
                <div class="modal-content" style="max-height: 100% !important; height: 100% !important;">
                    <div class="modal-header ">
                        <div class="d-block d-flex float-start align-items-center">
                            <h5 class="text-body float-start rounded mt-2 me-2 pt-2 pb-2 ps-3 pe-3 bg-light">{{read_item_product.data.query_read_product.product_name}}</h5>



                        </div>


                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">


                        <div class="row">
                            <div class="col">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <form id="form1" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_products/delete_product.php" dmx-on:success="notifies1.success('Success');readItemModal.hide();list_item_products.load()" onsubmit=" return confirm('CONFIRM DELETE?');">
                    <input id="text1" name="product_id" type="hidden" class="form-control" dmx-bind:value="read_item_product.data.query_read_product.product_id">

                    <button id="btn6" class="btn text-body" type="submit">
                        <i class="far fa-trash-alt fa-lg"></i>
                    </button>
                </form>
            </div>
        </div>
        <div class="modal create-modal" id="createRoleModal" is="dmx-bs5-modal" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{trans.data.newRole[lang.value]}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <form is="dmx-serverconnect-form" id="role_create_form" method="post" action="dmxConnect/api/roles/insert.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-on:success="notifies1.success('Success');createRoleModal.hide();role_list.load({})" dmx-on:error="notifies1.danger('Error!')" dmx-on:submit="">
                                <div class="mb-3 row">
                                    <label for="inp_product_name" class="col-sm-2 col-form-label"><b>{{trans.data.name[lang.value]}}</b></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="role_name" name="role_name" aria-describedby="inp_product_name_help">
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col">
                                        <form id="role_permissions">
                                            <div class="row row-cols-3" is="dmx-repeat" id="repeat1" dmx-bind:repeat="permission_list.data.query">
                                                <div class="col">
                                                    <div class="row">
                                                        <div class="offset-1 col-1"><input id="checkbox2" name="checkbox2" type="checkbox" dmx-bind:value="id" dmx-bind:name="name">

                                                        </div>

                                                        <div class="col">
                                                            <p dmx-text="name">Nice</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm-10">
                                        <button class="btn btn-primary" dmx-on:click="role_create_form.submit()">{{trans.data.create[lang.value]}}</button>
                                    </div>
                                </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
        <div class="modal create-modal" id="editRoleModal" is="dmx-bs5-modal" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{trans.data.editRole[lang.value]}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <form is="dmx-serverconnect-form" id="role_update_form" method="post" action="dmxConnect/api/roles/update.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-on:success="notifies1.success('Success');editRoleModal.hide();role_list.load({})" dmx-on:error="notifies1.danger('Error!')" dmx-on:submit="">
                                <div class="mb-3 row">
                                    <label for="inp_product_name" class="col-sm-2 col-form-label"><b>{{trans.data.name[lang.value]}}</b></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="role_name" name="role_name" aria-describedby="inp_product_name_help" dmx-bind:value="read_role.data.role_query.name" dmx-text="read_role.data.role_query.name">
                                        <input type="text" class="form-control visually-hidden" id="role_id" name="role_id" aria-describedby="inp_product_name_help" dmx-bind:value="read_role.data.role_query.id">

                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col">

                                        <div class="row row-cols-3" is="dmx-repeat" id="repeart_checked_permissions" dmx-bind:repeat="read_role.data.role_permission_query">
                                            <div class="col">
                                                <div class="row">
                                                    <div class="offset-1 col-1"><input id="checkbox1" name="checkbox1" type="checkbox" dmx-bind:value="id" dmx-bind:name="name" dmx-bind:checked="true">

                                                    </div>

                                                    <div class="col">
                                                        <p dmx-text="name">Nice</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row row-cols-3" is="dmx-repeat" id="repeat3" dmx-bind:repeat="read_role.data.role_permission_query_copy">
                                            <div class="col">
                                                <div class="row">
                                                    <div class="offset-1 col-1"><input id="checkbox3" name="checkbox3" type="checkbox" dmx-bind:value="id" dmx-bind:name="name">

                                                    </div>

                                                    <div class="col">
                                                        <p dmx-text="name">Nice</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </form>
                            <div class="mb-3 row">
                                <div class="col-sm-10">
                                    <button class="btn btn-primary" dmx-on:click="role_update_form.submit()">{{trans.data.update[lang.value]}}</button>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
        <div class="modal create-modal" id="grantRoleModal" is="dmx-bs5-modal" tabindex="-1">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{trans.data.grantRole[lang.value]}}</h5>
                        <h2 dmx-text="role_name.value">Fancy display heading</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">

                                <div class="row">

                                    <div class="col-5">
                                        <input id="search_text" name="search_text" class="form-control" placeholder="Search" dmx-on:keyup="user_has_not_role.load({role_id: role_id.value, search_text: value, offset: 1, limit: limit.selectedValue, current_page: 1})">
                                    </div>


                                </div>

                                <div class="row align-items-lg-center" style="margin-top: 50px;">
                                    <div class="col-5">
                                        <div class="row align-items-lg-center">
                                            <div class="col-lg align-self-lg-center col-lg-3">
                                                <p>Pages</p>
                                            </div>
                                            <div class="col col-lg">
                                                <ul class="pagination" is="dmx-repeat" id="repeat4" dmx-bind:repeat="user_has_not_role.data.pagination">
                                                    <li class="page-item">
                                                        <button id="btn8" class="btn" dmx-text="$value" dmx-on:click="user_has_not_role.load({role_id: role_id.value, offset: $value*limit.selectedValue, limit: limit.selectedValue, current_page: value})" dmx-bind:value="$value">Button</button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="col-3 offset-3 align-self-lg-center">
                                        <div class="row align-items-lg-center">
                                            <div class="col col-lg align-self-lg-center">
                                                <p class="text-lg-center">Per Page</p>
                                            </div>
                                            <div class="col col-lg align-self-lg-center"><select id="limit" class="form-select" name="limit" dmx-on:changed="user_has_not_role.load({role_id: role_id.value, offset: 0, limit: selectedValue, current_page: 1})">
                                                    <option value="1">1</option>
                                                    <option value="5">5</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                </select></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>User</th>
                                                <th>User fname</th>
                                                <th>User lname</th>
                                            </tr>
                                        </thead>
                                        <tbody is="dmx-repeat" dmx-generator="bs5table" id="tableRepeat3" dmx-bind:repeat="user_has_not_role.data.paginated_query">
                                            <tr>
                                                <td dmx-text="user_id"></td>
                                                <td dmx-text="user_fname"></td>
                                                <td dmx-text="user_lname"></td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col">
                                                            <form id="role_grant_form" is="dmx-serverconnect-form" method="post" action="dmxConnect/api/roles/grant_role.php" dmx-on:success="notifies1.success('Create Successfully');user_has_not_role.load({role_id: role_id.value, offset: 0, limit: limit.selectedValue, current_page: 1})">
                                                                <input type="text" class="form-control visually-hidden" id="role_id" name="role_id" aria-describedby="input1_help" placeholder="Enter some text">
                                                                <input type="text" class="form-control visually-hidden" id="user_id" name="user_id" aria-describedby="input1_help" placeholder="Enter some text">
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <button id="btn5" class="btn btn-primary" dmx-on:click="role_grant_form.user_id.setValue(user_id);role_grant_form.role_id.setValue(role_id.value);role_grant_form.submit()">Grant</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                </table>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>
        <div class="modal create-modal" id="revokeRoleModal" is="dmx-bs5-modal" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{trans.data.revokeRole[lang.value]}}</h5>
                        <h2 dmx-text="role_name.value">Fancy display heading</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <div class="row">

                                    <div class="col-5">
                                        <input id="search_text" name="search_text" class="form-control" placeholder="Search" dmx-on:keyup="role_has_user.load({role_id: role_id.value, search_text: value, offset: 0, limit: limit.selectedValue, current_page: 1})">
                                    </div>


                                </div>
                                <div class="row align-items-lg-center" style="margin-top: 50px;">
                                    <div class="col-5">
                                        <div class="row align-items-lg-center">
                                            <div class="col-lg align-self-lg-center col-lg-3">
                                                <p>Pages</p>
                                            </div>
                                            <div class="col col-lg">
                                                <ul class="pagination" is="dmx-repeat" id="repeat2" dmx-bind:repeat="role_has_user.data.pagination">
                                                    <li class="page-item">
                                                        <button id="btn9" class="btn" dmx-text="$value" dmx-on:click="user_has_not_role.load({role_id: role_id.value, offset: $value*limit.selectedValue, limit: limit.selectedValue, current_page: value})" dmx-bind:value="$value">Button</button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="col-3 offset-3 align-self-lg-center">
                                        <div class="row align-items-lg-center">
                                            <div class="col col-lg align-self-lg-center">
                                                <p class="text-lg-center">Per Page</p>
                                            </div>
                                            <div class="col col-lg align-self-lg-center"><select id="limit" class="form-select" name="limit1" dmx-on:changed="role_has_user.load({role_id: role_id.value, search_text: search_text.value, offset: 0, limit: selectedValue, current_page: 1})">
                                                    <option value="1">1</option>
                                                    <option value="5">5</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                </select></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>User</th>
                                                <th>User fname</th>
                                                <th>User lname</th>
                                            </tr>
                                        </thead>
                                        <tbody is="dmx-repeat" dmx-generator="bs5table" id="tableRepeat1" dmx-bind:repeat="role_has_user.data.paginated_query">
                                            <tr>
                                                <td dmx-text="user_id"></td>
                                                <td dmx-text="user_fname"></td>
                                                <td dmx-text="user_lname"></td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col">
                                                            <form id="role_revoke_form" is="dmx-serverconnect-form" method="post" action="dmxConnect/api/roles/revoke.php" dmx-on:success="notifies1.success('Create Successfully');role_has_user.load({role_id: role_id.value})">
                                                                <input type="text" class="form-control visually-hidden" id="role_id" name="role_id" aria-describedby="input1_help" placeholder="Enter some text">
                                                                <input type="text" class="form-control visually-hidden" id="user_id" name="user_id" aria-describedby="input1_help" placeholder="Enter some text">
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <button id="btn7" class="btn btn-primary" dmx-on:click="role_revoke_form.role_id.setValue(role_id.value);role_revoke_form.user_id.setValue(user_id);role_revoke_form.submit()">Revoke</button>
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



    </main>

    <script src="bootstrap/5/js/bootstrap.min.js"></script>
    <script src="bootstrap/5/js/bootstrap.bundle.min.js"></script>
</body>

</html>