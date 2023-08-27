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


</head>

<body id="brands" is="dmx-app">

  <dmx-value id="lang" dmx-bind:value="browser1.language"></dmx-value>
  <dmx-json-datasource id="trans" is="dmx-serverconnect" url="assets/translation/translation.JSON"></dmx-json-datasource>

  <dmx-serverconnect id="read_item_user_profile" url="dmxConnect/api/servo_user_profiles/read_user_profile.php" dmx-param:id="id" noload dmx-param:item_id=""></dmx-serverconnect>
  <dmx-serverconnect id="delete_item_user_profile" url="dmxConnect/api/servo_user_profiles/delete_user_profile.php"></dmx-serverconnect>
  <dmx-serverconnect id="serverconnectListUserProfiles" url="dmxConnect/api/servo_user_profiles/list_user_profiles.php"></dmx-serverconnect>
  <div is="dmx-browser" id="browser1"></div>
  <dmx-notifications id="notifies1"></dmx-notifications>
  <?php include 'header.php'; ?><main class="mt-4">
    <div class="modal create-modal" id="createItemModal" is="dmx-bs5-modal" tabindex="-1">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{trans.data.newUserProfile[lang.value]}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <form is="dmx-serverconnect-form" id="serverconnectFormCreateBrand" method="post" action="dmxConnect/api/servo_user_profiles/create_user_profile.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-on:success="notifies1.success('Success');serverconnectListUserProfiles.load();createItemModal.hide()" dmx-on:error="notifies1.warning('Error')">
                <div class="mb-3 row">
                  <label for="inp_user_profile_name" class="col-sm-2 col-form-label">{{trans.data.name[lang.value]}}</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inp_user_profile_name" name="user_profile_name" aria-describedby="inp_user_profile_name_help" placeholder="Enter User profile name">
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
            <h5 class="modal-title fw-bold">{{trans.data.profile[lang.value]}}:{{read_item_user_profile.data.readUserProfile.user_profile_name}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form is="dmx-serverconnect-form" id="readitem" method="post" action="dmxConnect/api/servo_user_profiles/update_user_profile.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="read_item_user_profile.data.readUserProfile">
              <input type="hidden" name="user_profile_id" id="inp_user_profile_id" dmx-bind:value="read_item_user_profile.data.readUserProfile.user_profile_id">
              <div class="mb-3 row">
                <label for="inp_user_profile_name" class="col-sm-2 col-form-label">{{trans.data.name[lang.value]}}</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inp_user_profile_name" name="user_profile_name" dmx-bind:value="read_item_user_profile.data.readUserProfile.user_profile_name" aria-describedby="inp_user_profile_name_help" placeholder="Enter User profile name">
                </div>
              </div>
              <div class="mb-3 row">
                <div class="col-sm-2">&nbsp;</div>
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-primary" dmx-bind:value="read_item_user_profile.data.readUserProfile.Save">{{trans.data.update[lang.value]}}</button>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <form id="form1" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_user_profiles/delete_user_profile.php" dmx-on:success="notifies1.success('Success');readItemModal.hide();serverconnectListUserProfiles.load({})" onsubmit=" return confirm('CONFIRM DELETE?');">
              <input id="text1" name="user_profile_id" type="hidden" class="form-control" dmx-bind:value="read_item_user_profile.data.readUserProfile.user_profile_id">

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
        <div class="col-auto" dmx-animate-enter="slideInLeft">
          <i class="fas fa-id-badge fa-2x" style="color: #189aff !important;"></i>
        </div>
        <div class="col-auto page-heading">
          <h4 class="servo-page-heading">{{trans.data.userProfiles[lang.value]}}</h4>
        </div>
        <div class="col style13 page-button" id="pagebuttons">
          <button id="btn1" class="btn style12 fw-light add-button" data-bs-toggle="modal" data-bs-target="#createItemModal" style="float: right;"><i class="fas fa-plus fa-2x style14"></i>
          </button>
        </div>
      </div>
      <div class="row">
        <div class="col">


          <div class="table-responsive">
            <table class="table table-hover table-sm table-borderless">
              <thead>
                <tr>
                  <th>#</th>
                  <th>{{trans.data.profileName[lang.value]}}</th>
                  <th></th>
                </tr>
              </thead>
              <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="serverconnectListUserProfiles.data.query_list_user_profiles" id="tableRepeat1">
                <tr>
                  <td dmx-text="user_profile_id"></td>
                  <td dmx-text="trans.data.getValueOrKey(user_profile_name)[lang.value]" class="text-body"></td>
                  <td class="text-center">
                    <button id="btn2" class="btn open" data-bs-target="#readItemModal" dmx-on:click="readItemModal.show();read_item_user_profile.load({user_profile_id: user_profile_id})" dmx-bind:value="serverconnectListUserProfiles.data.query_list_user_profiles[0].user_profile_id" data-bs-toggle="modal"><i class="fas fa-expand-alt"><br></i></button>
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