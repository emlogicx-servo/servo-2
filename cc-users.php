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
			"options": {"permissions":"cc-admin","loginUrl":"login.php","forbiddenUrl":"login.php","provider":"servo_login"}
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
  <link rel="stylesheet" href="css/bootstrap-icons.css" />
  <link rel="stylesheet" href="fontawesome5/css/all.min.css" />
  <script src="dmxAppConnect/dmxBootstrap5PagingGenerator/dmxBootstrap5PagingGenerator.js" defer=""></script>
  <link rel="stylesheet" href="dmxAppConnect/dmxValidator/dmxValidator.css" />
  <script src="dmxAppConnect/dmxValidator/dmxValidator.js" defer=""></script>

  <link rel="stylesheet" href="bootstrap/5/css/bootstrap.min.css" />
</head>

<body id="brands" is="dmx-app">
  <dmx-query-manager id="list_users"></dmx-query-manager>

  <dmx-value id="lang" dmx-bind:value="browser1.language"></dmx-value>
  <dmx-json-datasource id="trans" is="dmx-serverconnect" url="assets/translation/translation.JSON" noload></dmx-json-datasource>

  <dmx-serverconnect id="load_user_departments" url="dmxConnect/api/servo_refered_fields_loading/load_departments.php"></dmx-serverconnect>
  <dmx-serverconnect id="load_user_profiles" url="dmxConnect/api/servo_refered_fields_loading/load_user_profiles.php"></dmx-serverconnect>
  <dmx-serverconnect id="read_item_user" url="dmxConnect/api/servo_users/read_user.php" dmx-param:id="id" noload dmx-param:item_id="" dmx-param:user_id=""></dmx-serverconnect>
  <dmx-serverconnect id="delete_item_user_profile" url="dmxConnect/api/servo_user_profiles/delete_user_profile.php"></dmx-serverconnect>
  <dmx-serverconnect id="serverconnectListUsers" url="dmxConnect/api/servo_users/list_users_paged.php" dmx-param:offset="list_users.data.offset" dmx-param:limit="user_sort_limit.value" dmx-param:userfilter="userfilter.value"></dmx-serverconnect>
  <div is="dmx-browser" id="browser1"></div>
  <dmx-notifications id="notifies1"></dmx-notifications>
  <?php include 'cc-header.php'; ?><main class="mt-4">
    <div class="modal create-modal" id="createItemModal" is="dmx-bs5-modal" tabindex="-1">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{trans.data.newUser[lang.value]}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <form is="dmx-serverconnect-form" id="serverconnectFormCreateUser" method="post" action="dmxConnect/api/servo_users/create_user.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-on:success="notifies1.success('Success');serverconnectListUsers.load();serverconnectFormCreateUser.reset();createItemModal.hide()" dmx-on:submit="">
                <div class="mb-3 row">
                  <label for="inp_user_fname" class="col-sm-2 col-form-label">{{trans.data.name[lang.value]}}</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inp_user_fname" name="user_fname" aria-describedby="inp_user_fname_help">
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="inp_user_lname" class="col-sm-2 col-form-label">{{trans.data.surname[lang.value]}}</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inp_user_lname" name="user_lname" aria-describedby="inp_user_lname_help">
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="inp_user_username" class="col-sm-2 col-form-label">{{trans.data.username[lang.value]}}</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inp_user_username" name="user_username" aria-describedby="inp_user_username_help" data-rule-nowhitespace="" data-msg-nowhitespace="Error!">
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="inp_pasword" class="col-sm-2 col-form-label">{{trans.data.password[lang.value]}}</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control" id="inp_pasword" name="password" aria-describedby="inp_pasword_help">
                  </div>
                </div>

                <div class="mb-3 row">
                  <label for="inp_servo_user_profile_user_profile_id" class="col-sm-2 col-form-label">{{trans.data.profile[lang.value]}}</label>
                  <div class="col-sm-10">
                    <select id="select5" class="form-select" name="user_profile">
                      <option value="cc-admin">{{trans.data.Admin[lang.value]}}</option>
                      <option value="cc-gu">{{trans.data.guichetUnique[lang.value]}}</option>
                      <option selected="" value="cc-pm">{{trans.data.policeMunicipale[lang.value]}}</option>
                      <option value="cc-rm">{{trans.data.recettesMunicipales[lang.value]}}</option>
                    </select>
                  </div>
                </div>
                <div class="mb-3 row">
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary mt-1">{{trans.data.ok[lang.value]}}</button>
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
            <h2 class="text-muted">{{read_item_user.data.query.user_username}}</h2><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            <form is="dmx-serverconnect-form" id="readitem" method="post" action="dmxConnect/api/servo_users/update_user.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="read_item_user.data.query" dmx-on:success="notifies1.success('Success');serverconnectListUsers.load();readItemModal.hide()">
              <div class="mb-3 row">
                <label for="inp_user_id" class="col-sm-2 col-form-label">#</label>
                <div class="col-sm-10">
                  <input type="number" class="form-control form-control-plaintext" id="inp_user_id" name="user_id" dmx-bind:value="read_item_user.data.query.user_id" aria-describedby="inp_user_id_help" readonly="true">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="inp_user_fname" class="col-sm-2 col-form-label">{{trans.data.name[lang.value]}}</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inp_user_fname" name="user_fname" dmx-bind:value="read_item_user.data.query.user_fname" aria-describedby="inp_user_fname_help">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="inp_user_lname" class="col-sm-2 col-form-label">{{trans.data.surname[lang.value]}}</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inp_user_lname" name="user_lname" dmx-bind:value="read_item_user.data.query.user_lname" aria-describedby="inp_user_lname_help">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="inp_user_username" class="col-sm-2 col-form-label">{{trans.data.username[lang.value]}}</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inp_user_username" name="user_username" dmx-bind:value="read_item_user.data.query.user_username" aria-describedby="inp_user_username_help">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="inp_password" class="col-sm-2 col-form-label">{{trans.data.password[lang.value]}}</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="inp_password" name="password" dmx-bind:value="read_item_user.data.query.password" aria-describedby="inp_password_help">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="inp_servo_user_profile_user_profile_id" class="col-sm-2 col-form-label">{{trans.data.profile[lang.value]}}</label>
                <div class="col-sm-10">
                  <select id="select3" class="form-select" dmx-bind:value="read_item_user.data.query.user_profile" name="user_profile">
                    <option value="cc-admin">{{trans.data.Admin[lang.value]}}</option>
                    <option value="cc-gu">{{trans.data.guichetUnique[lang.value]}}</option>
                    <option value="cc-pm">{{trans.data.policeMunicipale[lang.value]}}</option>
                    <option value="cc-rm">{{trans.data.recettesMunicipales[lang.value]}}</option>
                  </select>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="inp_servo_user_departments_department_id" class="col-sm-2 col-form-label">{{trans.data.department[lang.value]}}</label>
              </div>
              <div class="mb-3 row">
                <div class="col-sm-2">&nbsp;</div>
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-primary">{{trans.data.update[lang.value]}}</button>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <form id="form1" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_users/delete_user.php" dmx-on:success="notifies1.success('Success');serverconnectListUsers.load();readItemModal.hide()" onsubmit=" return confirm('CONFIRM DELETE?');">
              <input id="text1" name="user_id" type="hidden" class="form-control" dmx-bind:value="read_item_user.data.query.user_id">

              <button id="btn6" class="btn text-danger" type="submit">
                <i class="far fa-trash-alt fa-lg"></i>
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="ms-3 me-3">




      <div class="row servo-page-header">
        <div class="col-auto" dmx-animate-enter="slideInLeft">
          <i class="fas fa-user-check fa-2x"></i>
        </div>
        <div class="col-auto page-heading">
          <h4 class="servo-page-heading text-body">{{trans.data.users[lang.value]}}</h4>
        </div>
        <div class="col style13 page-button" id="pagebuttons">
          <button id="btn1" class="btn style12 fw-light add-button text-body ps-3 pe-3 bg-light" data-bs-toggle="modal" data-bs-target="#createItemModal" style="float: right;"><i class="fas fa-plus fa-lg"></i>
          </button>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="row justify-content-sm-between justify-content-md-between justify-content-lg-between justify-content-xl-between justify-content-xxl-between justify-content-between mt-2 mb-2 sorter h-auto shadow-none bg-light">
            <div class="col-lg-3 h-auto col-12 col-sm-12"><input id="userfilter" name="userfilter" type="text" class="form-control mb-2 form-control-sm" dmx-bind:placeholder="trans.data.search[lang.value]+'  '"></div>

            <div class="d-flex flex-sm-wrap col-md-5 col-lg-7 justify-content-lg-end col-xl-6 justify-content-xl-end justify-content-xxl-end flex-wrap col-sm">
              <ul class="pagination flex-wrap" dmx-populate="serverconnectListUsers.data.query_list_users" dmx-state="list_users" dmx-offset="offset" dmx-generator="bs5paging">
                <li class="page-item" dmx-class:disabled="serverconnectListUsers.data.query_list_users.page.current == 1" aria-label="First">
                  <a href="javascript:void(0)" class="page-link" dmx-on:click="list_users.set('offset',serverconnectListUsers.data.query_list_users.page.offset.first)"><span aria-hidden="true">&lsaquo;&lsaquo;</span></a>
                </li>
                <li class="page-item" dmx-class:disabled="serverconnectListUsers.data.query_list_users.page.current == 1" aria-label="Previous">
                  <a href="javascript:void(0)" class="page-link" dmx-on:click="list_users.set('offset',serverconnectListUsers.data.query_list_users.page.offset.prev)"><span aria-hidden="true">&lsaquo;</span></a>
                </li>
                <li class="page-item" dmx-class:active="title == serverconnectListUsers.data.query_list_users.page.current" dmx-class:disabled="!active" dmx-repeat="serverconnectListUsers.data.query_list_users.getServerConnectPagination(2,1,'...')">
                  <a href="javascript:void(0)" class="page-link" dmx-on:click="list_users.set('offset',(page-1)*serverconnectListUsers.data.query_list_users.limit)">{{title}}</a>
                </li>
                <li class="page-item" dmx-class:disabled="serverconnectListUsers.data.query_list_users.page.current ==  serverconnectListUsers.data.query_list_users.page.total" aria-label="Next">
                  <a href="javascript:void(0)" class="page-link" dmx-on:click="list_users.set('offset',serverconnectListUsers.data.query_list_users.page.offset.next)"><span aria-hidden="true">&rsaquo;</span></a>
                </li>
                <li class="page-item" dmx-class:disabled="serverconnectListUsers.data.query_list_users.page.current ==  serverconnectListUsers.data.query_list_users.page.total" aria-label="Last">
                  <a href="javascript:void(0)" class="page-link" dmx-on:click="list_users.set('offset',serverconnectListUsers.data.query_list_users.page.offset.last)"><span aria-hidden="true">&rsaquo;&rsaquo;</span></a>
                </li>
              </ul>
            </div>
            <div class="col-lg-1 col-xl-1 col-md-2 col-sm-2 col-3 offset-lg-1"><select id="user_sort_limit" class="form-select" name="user_sort_limit">
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
                  <th>{{trans.data.surname[lang.value]}}</th>
                  <th>{{trans.data.username[lang.value]}}</th>
                  <th>{{trans.data.profile[lang.value]}}</th>
                  <th></th>
                </tr>
              </thead>
              <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="serverconnectListUsers.data.query_list_users.data" id="tableRepeat2">
                <tr>
                  <td dmx-text="user_id"></td>
                  <td dmx-text="user_fname"></td>
                  <td dmx-text="user_lname"></td>
                  <td dmx-text="user_username"></td>
                  <td dmx-text="trans.data.getValueOrKey(user_profile)[lang.value]" class="fw-normal"></td>
                  <td>
                    <button id="btn2" class="btn open" data-bs-target="#productInfo" dmx-on:click="readItemModal.show();read_item_user.load({user_id: user_id})" dmx-bind:value="serverconnectListUsers.data.query_list_users[0].user_id"><i class="fas fa-expand-alt fa-lg"><br></i></button>
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
  <script src="bootstrap/5/js/bootstrap.min.js"></script>
</body>

</html>