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
			"options": {"permissions":"Admin","loginUrl":"login.php","forbiddenUrl":"login.php","provider":"servo_login"}
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
      <script src="dmxAppConnect/dmxBootbox5/bootstrap-modbox.min.js" defer=""></script>
      <script src="dmxAppConnect/dmxBootbox5/dmxBootbox5.js" defer=""></script>

      <link rel="stylesheet" href="css/bootstrap-icons.css" />
      <link rel="stylesheet" href="bootstrap/5/servolight/bootstrap.min.css" />

      <link rel="stylesheet" href="bootstrap/5/css/bootstrap.min.css" />
</head>

<body id="brands" is="dmx-app">
      <dmx-serverconnect id="reset_profiles_privileges" url="dmxConnect/api/servo_profile_settings/reset_profile_settings.php" dmx-param:id="id" noload dmx-param:item_id="" dmx-param:branch_id="read_item_branch.data.queryReadBranch.branch_id"></dmx-serverconnect>
      <dmx-serverconnect id="set_default_profiles_privileges" url="dmxConnect/api/servo_profile_settings/set_default_profile_settings.php" dmx-param:id="id" noload="" dmx-param:item_id="" dmx-param:branch_id="read_item_branch.data.queryReadBranch.branch_id" dmx-on:success="notifies1.success('Success!');list_profile_settings.load()"></dmx-serverconnect>
      <dmx-serverconnect id="list_profile_settings" url="dmxConnect/api/servo_profile_settings/list_profile_settings.php"></dmx-serverconnect>
      <dmx-serverconnect id="list_branches" url="dmxConnect/api/servo_branches/list_branches.php"></dmx-serverconnect>
      <div is="dmx-browser" id="browser1"></div>
      <dmx-notifications id="notifies1"></dmx-notifications>
      <?php require 'header.php'; ?><main class="mt-4">
            <div class="mt-auto ms-3 me-3">




                  <div class="row servo-page-header">
                        <div class="col-auto" dmx-animate-enter="slideInLeft">
                              <i class="fas fa-user-cog fa-lg"></i>
                        </div>
                        <div class="col">
                              <h5 class="servo-page-heading fw-lighter text-body">{{trans.data.userPrivileges[lang.value]}}</h5>
                        </div>
                        <div class="col-2">
                              <button id="btn2" class="btn w-100 text-white bg-info" dmx-on:click="reset_profiles_privileges.load()"><i class="far fa-user"></i></button>


                        </div>
                        <div class="col-2">
                              <button id="btn41" class="btn w-100 bg-info text-white" dmx-on:click="run({'bootbox.confirm':{message:'Confirm Reset to Default',title:'Confirm Privlege Settings Reset',buttons:{confirm:{label:'OK',className:'btn-dark'},cancel:{label:'Cancel',className:'btn-dark'}},then:{steps:[{run:{action:`set_default_profiles_privileges.load()`}},{run:{action:`list_profile_settings.load({})`}}]},name:'confirm_reset'}})"><i class="fas fa-redo"></i></button>


                        </div>
                  </div>
                  <div class="row">
                        <div class="col mt-2 pt-2 pb-2 ps-2 pe-2 rounded bg-opacity-50" style="overflow-y: scroll;">
                              <div class="table-responsive">
                                    <table class="table table-hover table-sm">
                                          <thead style="" class="small-table-header">
                                                <tr style="" class="text-center">
                                                      <th>{{trans.data.profile[lang.value]}}</th>
                                                      <th class="text-info" style="color: #448e9d !important;">{{trans.data.createOrder[lang.value]}}</th>
                                                      <th class="text-info" style="color: #448e9d !important;">{{trans.data.deleteOrder[lang.value]}}</th>
                                                      <th class="text-info" style="color: #448e9d !important;">{{trans.data.editOrderItemQuantity[lang.value]}}</th>
                                                      <th class="text-info" style="color: #448e9d !important;">{{trans.data.editOrderItemPrice[lang.value]}}</th>
                                                      <th class="text-info" style="color: #448e9d !important;">{{trans.data.deleteOrderItem[lang.value]}}</th>
                                                      <th class="text-info" style="color: #448e9d !important;">{{trans.data.editOrderDetails[lang.value]}}</th>
                                                      <th style="color: #ef7765 !important;">{{trans.data.createPO[lang.value]}}</th>
                                                      <th style="color: #ef7765 !important;">{{trans.data.deletePO[lang.value]}}</th>
                                                      <th style="color: #ef7765 !important;">{{trans.data.deletePOItem[lang.value]}}</th>
                                                      <th style="color: #ef7765 !important;">{{trans.data.editPOItemQuantity[lang.value]}}</th>
                                                      <th style="color: #ef7765 !important;">{{trans.data.editPOItemPrice[lang.value]}}</th>
                                                      <th style="color: #ef7765 !important;">{{trans.data.approvePO[lang.value]}}</th>
                                                      <th style="color: #79ad88 !important;">{{trans.data.createCustomer[lang.value]}}</th>
                                                      <th style="color: #79ad88 !important;">{{trans.data.deleteCustomer[lang.value]}}</th>
                                                      <th style="color: #79ad88 !important;">{{trans.data.editCustomer[lang.value]}}</th>
                                                      <th style="color: #99a732 !important;">{{trans.data.createAO[lang.value]}}</th>
                                                      <th style="color: #99a732 !important;">{{trans.data.deleteAO[lang.value]}}</th>
                                                      <th style="color: #99a732 !important;">{{trans.data.editAOItemQ[lang.value]}}</th>
                                                      <th style="color: #99a732 !important;">{{trans.data.deleteAOItem[lang.value]}}</th>
                                                      <th style="color: #c47ce6 !important;">{{trans.data.createUser[lang.value]}}</th>
                                                      <th style="color: #c47ce6 !important;">{{trans.data.deleteUser[lang.value]}}</th>
                                                      <th style="color: #c47ce6 !important;">{{trans.data.editUser[lang.value]}}</th>
                                                </tr>
                                          </thead>
                                          <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_profile_settings.data.list_profile_settings" id="tableRepeat1">
                                                <tr>
                                                      <td dmx-text="trans.data.getValueOrKey(profile)[lang.value]" style="" class="fw-bold"></td>
                                                      <td>
                                                            <form id="form5" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_profile_settings/update_create_order.php">
                                                                  <input id="createOrder" name="create_order" type="text" class="form-control visually-hidden" dmx-bind:value="create_order">
                                                                  <input id="settingsProfileId4" name="profile_settings_id" type="text" class="form-control visually-hidden" dmx-bind:value="profile_settings_id">

                                                                  <button id="btn10" class="btn text-body" dmx-on:click="createOrder.setValue('Yes');form5.submit();list_profile_settings.load()" dmx-hide="(create_order=='Yes')"><i class="fas fa-toggle-off fa-2x"></i></button>

                                                                  <button id="btn11" class="btn" dmx-on:click="createOrder.setValue('No');form5.submit();list_profile_settings.load()" dmx-show="(create_order=='Yes')" style="color: #448e9d !important;"><i class="fas fa-toggle-on fa-2x"></i></button>

                                                            </form>
                                                      </td>
                                                      <td>
                                                            <form id="form6" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_profile_settings/update_delete_order.php">
                                                                  <input id="deleteOrder" name="delete_order" type="text" class="form-control visually-hidden" dmx-bind:value="delete_order">
                                                                  <input id="settingsProfileId5" name="profile_settings_id" type="text" class="form-control visually-hidden" dmx-bind:value="profile_settings_id">

                                                                  <button id="btn12" class="btn text-body" dmx-on:click="deleteOrder.setValue('Yes');form6.submit();list_profile_settings.load()" dmx-hide="(delete_order=='Yes')"><i class="fas fa-toggle-off fa-2x"></i></button>

                                                                  <button id="btn13" class="btn" dmx-on:click="deleteOrder.setValue('No');form6.submit();list_profile_settings.load()" dmx-show="(delete_order=='Yes')" style="color: #448e9d !important;"><i class="fas fa-toggle-on fa-2x"></i></button>

                                                            </form>
                                                      </td>
                                                      <td>
                                                            <form id="form7" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_profile_settings/update_edit_order_item_quantity.php">
                                                                  <input id="updateEditOrderItemQ" name="edit_order_item_quantity" type="text" class="form-control visually-hidden" dmx-bind:value="edit_order_item_quantity">
                                                                  <input id="settingsProfileId6" name="profile_settings_id" type="text" class="form-control visually-hidden" dmx-bind:value="profile_settings_id">

                                                                  <button id="btn14" class="btn text-body" dmx-on:click="updateEditOrderItemQ.setValue('Yes');form7.submit();list_profile_settings.load()" dmx-hide="(edit_order_item_quantity=='Yes')"><i class="fas fa-toggle-off fa-2x"></i></button>

                                                                  <button id="btn15" class="btn" dmx-on:click="updateEditOrderItemQ.setValue('No');form7.submit();list_profile_settings.load()" dmx-show="(edit_order_item_quantity=='Yes')" style="color: #448e9d !important;"><i class="fas fa-toggle-on fa-2x"></i></button>

                                                            </form>
                                                      </td>
                                                      <td>
                                                            <form id="form8" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_profile_settings/update_edit_order_item_price.php">
                                                                  <input id="updateEditOrderItemPrice" name="edit_order_item_price" type="text" class="form-control visually-hidden" dmx-bind:value="edit_order_item_price">
                                                                  <input id="settingsProfileId7" name="profile_settings_id" type="text" class="form-control visually-hidden" dmx-bind:value="profile_settings_id">

                                                                  <button id="btn16" class="btn text-body" dmx-on:click="updateEditOrderItemPrice.setValue('Yes');form8.submit();list_profile_settings.load()" dmx-hide="(edit_order_item_price=='Yes')"><i class="fas fa-toggle-off fa-2x"></i></button>

                                                                  <button id="btn17" class="btn" dmx-on:click="updateEditOrderItemPrice.setValue('No');form8.submit();list_profile_settings.load()" dmx-show="(edit_order_item_price=='Yes')" style="color: #448e9d !important;"><i class="fas fa-toggle-on fa-2x"></i></button>

                                                            </form>
                                                      </td>
                                                      <td class="text-body">
                                                            <form id="form14" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_profile_settings/update_delete_order_item.php">
                                                                  <input id="updateDeleteOrderItem" name="delete_order_item" type="text" class="form-control visually-hidden" dmx-bind:value="delete_order_item">
                                                                  <input id="settingsProfileId13" name="profile_settings_id" type="text" class="form-control visually-hidden" dmx-bind:value="profile_settings_id">

                                                                  <button id="btn28" class="btn text-body" dmx-on:click="updateDeleteOrderItem.setValue('Yes');form14.submit();list_profile_settings.load()" dmx-hide="(delete_order_item=='Yes')"><i class="fas fa-toggle-off fa-2x"></i></button>

                                                                  <button id="btn29" class="btn" dmx-on:click="updateDeleteOrderItem.setValue('No');form14.submit();list_profile_settings.load()" dmx-show="(delete_order_item=='Yes')" style="color: #448e9d !important;"><i class="fas fa-toggle-on fa-2x"></i></button>

                                                            </form>
                                                      </td>
                                                      <td style="color: #448e9d !important;">
                                                            <form id="form12" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_profile_settings/update_edit_order_details.php">
                                                                  <input id="updateEditOrderDetails" name="edit_order_details" type="text" class="form-control visually-hidden" dmx-bind:value="edit_order_details">
                                                                  <input id="settingsProfileId11" name="profile_settings_id" type="text" class="form-control visually-hidden" dmx-bind:value="profile_settings_id">

                                                                  <button id="btn24" class="btn text-body" dmx-on:click="updateEditOrderDetails.setValue('Yes');form12.submit();list_profile_settings.load()" dmx-hide="(edit_order_details=='Yes')"><i class="fas fa-toggle-off fa-2x"></i></button>

                                                                  <button id="btn25" class="btn" dmx-on:click="updateEditOrderDetails.setValue('No');form12.submit();list_profile_settings.load()" dmx-show="(edit_order_details=='Yes')" style="color: #448e9d !important;"><i class="fas fa-toggle-on fa-2x"></i></button>

                                                            </form>
                                                      </td>
                                                      <td>
                                                            <form id="form1" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_profile_settings/update_create_po.php">
                                                                  <input id="createPO" name="create_po" type="text" class="form-control visually-hidden" dmx-bind:value="create_po">
                                                                  <input id="settingsProfileId" name="profile_settings_id" type="text" class="form-control visually-hidden" dmx-bind:value="profile_settings_id">

                                                                  <button id="btn3" class="btn text-body" dmx-on:click="createPO.setValue('Yes');form1.submit();list_profile_settings.load()" dmx-hide="(create_po=='Yes')"><i class="fas fa-toggle-off fa-2x"></i></button>

                                                                  <button id="btn4" class="btn text-white" dmx-on:click="createPO.setValue('No');form1.submit();list_profile_settings.load()" dmx-show="(create_po=='Yes')" style="color: #ef7765 !important;"><i class="fas fa-toggle-on fa-2x"></i></button>

                                                            </form>

                                                      </td>
                                                      <td class="text-body">
                                                            <form id="form2" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_profile_settings/update_delete_po.php">
                                                                  <input id="deletePO" name="delete_po" type="text" class="form-control visually-hidden" dmx-bind:value="delete_po">
                                                                  <input id="settingsProfileId1" name="profile_settings_id" type="text" class="form-control visually-hidden" dmx-bind:value="profile_settings_id">

                                                                  <button id="btn6" class="btn text-body" dmx-on:click="deletePO.setValue('Yes');form2.submit();list_profile_settings.load()" dmx-hide="(delete_po=='Yes')"><i class="fas fa-toggle-off fa-2x"></i></button>

                                                                  <button id="btn7" class="btn" dmx-on:click="deletePO.setValue('No');form2.submit();list_profile_settings.load()" dmx-show="(delete_po=='Yes')" style="color: #ef7765 !important;"><i class="fas fa-toggle-on fa-2x"></i></button>

                                                            </form>
                                                      </td>
                                                      <td style="color: #ef7765 !important;" class="text-body">
                                                            <form id="form13" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_profile_settings/update_delete_po_item.php">
                                                                  <input id="updateDeletePOItem" name="delete_po_item" type="text" class="form-control visually-hidden" dmx-bind:value="delete_po_item">
                                                                  <input id="settingsProfileId12" name="profile_settings_id" type="text" class="form-control visually-hidden" dmx-bind:value="profile_settings_id">

                                                                  <button id="btn26" class="btn text-body" dmx-on:click="updateDeletePOItem.setValue('Yes');form13.submit();list_profile_settings.load()" dmx-hide="(delete_po_item=='Yes')"><i class="fas fa-toggle-off fa-2x"></i></button>

                                                                  <button id="btn27" class="btn" dmx-on:click="updateDeletePOItem.setValue('No');form13.submit();list_profile_settings.load()" dmx-show="(delete_po_item=='Yes')"><i class="fas fa-toggle-on fa-2x" style="color: #ef7765 !important;"></i></button>

                                                            </form>
                                                      </td>
                                                      <td class="text-body">
                                                            <form id="form3" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_profile_settings/update_edit_po_item_quantity.php">
                                                                  <input id="editPOItemQuantity" name="edit_po_item_quantity" type="text" class="form-control visually-hidden" dmx-bind:value="edit_po_item_quantity">
                                                                  <input id="settingsProfileId2" name="profile_settings_id" type="text" class="form-control visually-hidden" dmx-bind:value="profile_settings_id">

                                                                  <button id="btn5" class="btn text-body" dmx-on:click="editPOItemQuantity.setValue('Yes');form3.submit();list_profile_settings.load()" dmx-hide="(edit_po_item_quantity=='Yes')"><i class="fas fa-toggle-off fa-2x"></i></button>

                                                                  <button id="btn5" class="btn" dmx-on:click="editPOItemQuantity.setValue('No');form3.submit();list_profile_settings.load()" dmx-show="(edit_po_item_quantity=='Yes')" style="color: #ef7765 !important;"><i class="fas fa-toggle-on fa-2x"></i></button>

                                                            </form>
                                                      </td>
                                                      <td style="color: #ef7765 !important;" class="text-body">
                                                            <form id="form4" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_profile_settings/update_edit_po_item_price.php">
                                                                  <input id="editPOItemPrice" name="edit_po_item_price" type="text" class="form-control visually-hidden" dmx-bind:value="edit_po_item_price">
                                                                  <input id="settingsProfileId3" name="profile_settings_id" type="text" class="form-control visually-hidden" dmx-bind:value="profile_settings_id">

                                                                  <button id="btn8" class="btn text-body" dmx-on:click="editPOItemPrice.setValue('Yes');form4.submit();list_profile_settings.load()" dmx-hide="(edit_po_item_price=='Yes')"><i class="fas fa-toggle-off fa-2x"></i></button>

                                                                  <button id="btn9" class="btn" dmx-on:click="editPOItemPrice.setValue('No');form4.submit();list_profile_settings.load()" dmx-show="(edit_po_item_price=='Yes')" style="color: #ef7765 !important;"><i class="fas fa-toggle-on fa-2x"></i></button>

                                                            </form>
                                                      </td>
                                                      <td class="text-body">
                                                            <form id="form22" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_profile_settings/update_approve_po.php">
                                                                  <input id="updateApprovePO" name="approve_po" type="text" class="form-control visually-hidden" dmx-bind:value="approve_po">
                                                                  <input id="settingsProfileId21" name="profile_settings_id" type="text" class="form-control visually-hidden" dmx-bind:value="profile_settings_id">

                                                                  <button id="btn40" class="btn text-body" dmx-on:click="updateApprovePO.setValue('Yes');form22.submit();list_profile_settings.load()" dmx-hide="(approve_po=='Yes')"><i class="fas fa-toggle-off fa-2x"></i></button>

                                                                  <button id="btn40" class="btn" dmx-on:click="updateApprovePO.setValue('No');form22.submit();list_profile_settings.load()" dmx-show="(approve_po=='Yes')"><i class="fas fa-toggle-on fa-2x" style="color: #ef7765 !important;"></i></button>

                                                            </form>
                                                      </td>
                                                      <td class="text-body">
                                                            <form id="form10" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_profile_settings/update_create_customer.php">
                                                                  <input id="updateCreateCustomer" name="create_customer" type="text" class="form-control visually-hidden" dmx-bind:value="create_customer">
                                                                  <input id="settingsProfileId9" name="profile_settings_id" type="text" class="form-control visually-hidden" dmx-bind:value="profile_settings_id">

                                                                  <button id="btn20" class="btn text-body" dmx-on:click="updateCreateCustomer.setValue('Yes');form10.submit();list_profile_settings.load()" dmx-hide="(create_customer=='Yes')"><i class="fas fa-toggle-off fa-2x"></i></button>

                                                                  <button id="btn21" class="btn" dmx-on:click="updateCreateCustomer.setValue('No');form10.submit();list_profile_settings.load()" dmx-show="(create_customer=='Yes')" style="color: #79ad88 !important;"><i class="fas fa-toggle-on fa-2x"></i></button>

                                                            </form>
                                                      </td>
                                                      <td>
                                                            <form id="form9" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_profile_settings/update_delete_customer.php">
                                                                  <input id="updateDeleteCustomer" name="delete_customer" type="text" class="form-control visually-hidden" dmx-bind:value="delete_customer">
                                                                  <input id="settingsProfileId8" name="profile_settings_id" type="text" class="form-control visually-hidden" dmx-bind:value="profile_settings_id">

                                                                  <button id="btn18" class="btn text-body" dmx-on:click="updateDeleteCustomer.setValue('Yes');form9.submit();list_profile_settings.load()" dmx-hide="(delete_customer=='Yes')"><i class="fas fa-toggle-off fa-2x"></i></button>

                                                                  <button id="btn19" class="btn" dmx-on:click="updateDeleteCustomer.setValue('No');form9.submit();list_profile_settings.load()" dmx-show="(delete_customer=='Yes')" style="color: #79ad88 !important;"><i class="fas fa-toggle-on fa-2x"></i></button>

                                                            </form>
                                                      </td>
                                                      <td>
                                                            <form id="form11" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_profile_settings/update_edit_customer.php">
                                                                  <input id="updateEditCustomer" name="edit_customer" type="text" class="form-control visually-hidden" dmx-bind:value="edit_customer">
                                                                  <input id="settingsProfileId10" name="profile_settings_id" type="text" class="form-control visually-hidden" dmx-bind:value="profile_settings_id">

                                                                  <button id="btn22" class="btn text-body" dmx-on:click="updateEditCustomer.setValue('Yes');form11.submit();list_profile_settings.load()" dmx-hide="(edit_customer=='Yes')"><i class="fas fa-toggle-off fa-2x"></i></button>

                                                                  <button id="btn23" class="btn" dmx-on:click="updateEditCustomer.setValue('No');form11.submit();list_profile_settings.load()" dmx-show="(edit_customer=='Yes')" style="color: #79ad88 !important;"><i class="fas fa-toggle-on fa-2x"></i></button>

                                                            </form>
                                                      </td>
                                                      <td class="text-body">
                                                            <form id="form15" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_profile_settings/update_create_ao.php">
                                                                  <input id="updateCreateAO" name="create_ao" type="text" class="form-control visually-hidden" dmx-bind:value="create_ao">
                                                                  <input id="settingsProfileId14" name="profile_settings_id" type="text" class="form-control visually-hidden" dmx-bind:value="profile_settings_id">

                                                                  <button id="btn30" class="btn text-body" dmx-on:click="updateCreateAO.setValue('Yes');form15.submit();list_profile_settings.load()" dmx-hide="(create_ao=='Yes')"><i class="fas fa-toggle-off fa-2x"></i></button>

                                                                  <button id="btn31" class="btn" dmx-on:click="updateCreateAO.setValue('No');form15.submit();list_profile_settings.load()" dmx-show="(create_ao=='Yes')" style="color: #99a732 !important;"><i class="fas fa-toggle-on fa-2x"></i></button>

                                                            </form>
                                                      </td>
                                                      <td class="text-body">
                                                            <form id="form16" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_profile_settings/update_delete_ao.php">
                                                                  <input id="updateDeleteAO" name="delete_ao" type="text" class="form-control visually-hidden" dmx-bind:value="delete_ao">
                                                                  <input id="settingsProfileId15" name="profile_settings_id" type="text" class="form-control visually-hidden" dmx-bind:value="profile_settings_id">

                                                                  <button id="btn32" class="btn text-body" dmx-on:click="updateDeleteAO.setValue('Yes');form16.submit();list_profile_settings.load()" dmx-hide="(delete_ao=='Yes')"><i class="fas fa-toggle-off fa-2x"></i></button>

                                                                  <button id="btn33" class="btn" dmx-on:click="updateDeleteAO.setValue('No');form16.submit();list_profile_settings.load()" dmx-show="(delete_ao=='Yes')" style="color: #99a732 !important;"><i class="fas fa-toggle-on fa-2x"></i></button>

                                                            </form>
                                                      </td>
                                                      <td>
                                                            <form id="form17" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_profile_settings/update_edit_ao_item_quantity.php">
                                                                  <input id="updateEditAOItemQ" name="edit_ao_item_quantity" type="text" class="form-control visually-hidden" dmx-bind:value="edit_ao_item_quantity">
                                                                  <input id="settingsProfileId16" name="profile_settings_id" type="text" class="form-control visually-hidden" dmx-bind:value="profile_settings_id">

                                                                  <button id="btn34" class="btn text-body" dmx-on:click="updateEditAOItemQ.setValue('Yes');form17.submit();list_profile_settings.load()" dmx-hide="(edit_ao_item_quantity=='Yes')"><i class="fas fa-toggle-off fa-2x"></i></button>

                                                                  <button id="btn344" class="btn" dmx-on:click="updateEditAOItemQ.setValue('No');form17.submit();list_profile_settings.load()" dmx-show="(edit_ao_item_quantity=='Yes')" style="color: #99a732 !important;"><i class="fas fa-toggle-on fa-2x"></i></button>

                                                            </form>
                                                      </td>
                                                      <td class="text-body">
                                                            <form id="form18" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_profile_settings/update_delete_ao_item.php">
                                                                  <input id="updateDeleteAOItem" name="delete_ao_item" type="text" class="form-control visually-hidden" dmx-bind:value="delete_ao_item">
                                                                  <input id="settingsProfileId17" name="profile_settings_id" type="text" class="form-control visually-hidden" dmx-bind:value="profile_settings_id">

                                                                  <button id="btn36" class="btn text-body" dmx-on:click="updateDeleteAOItem.setValue('Yes');form18.submit();list_profile_settings.load()" dmx-hide="(delete_ao_item=='Yes')"><i class="fas fa-toggle-off fa-2x"></i></button>

                                                                  <button id="btn366" class="btn" dmx-on:click="updateDeleteAOItem.setValue('No');form18.submit();list_profile_settings.load()" dmx-show="(delete_ao_item=='Yes')" style="color: #99a732 !important;"><i class="fas fa-toggle-on fa-2x"></i></button>

                                                            </form>
                                                      </td>
                                                      <td class="text-body">
                                                            <form id="form19" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_profile_settings/update_create_user.php">
                                                                  <input id="updateCreateUser" name="create_user" type="text" class="form-control visually-hidden" dmx-bind:value="create_user">
                                                                  <input id="settingsProfileId18" name="profile_settings_id" type="text" class="form-control visually-hidden" dmx-bind:value="profile_settings_id">

                                                                  <button id="btn37" class="btn text-body" dmx-on:click="updateCreateUser.setValue('Yes');form19.submit();list_profile_settings.load()" dmx-hide="(create_user=='Yes')"><i class="fas fa-toggle-off fa-2x"></i></button>

                                                                  <button id="btn377" class="btn" dmx-on:click="updateCreateUser.setValue('No');form19.submit();list_profile_settings.load()" dmx-show="(create_user=='Yes')" style="color: #c47ce6 !important;"><i class="fas fa-toggle-on fa-2x"></i></button>

                                                            </form>
                                                      </td>
                                                      <td>
                                                            <form id="form20" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_profile_settings/update_delete_user.php">
                                                                  <input id="updateDeleteUser" name="delete_user" type="text" class="form-control visually-hidden" dmx-bind:value="delete_user">
                                                                  <input id="settingsProfileId19" name="profile_settings_id" type="text" class="form-control visually-hidden" dmx-bind:value="profile_settings_id">

                                                                  <button id="btn38" class="btn text-body" dmx-on:click="updateDeleteUser.setValue('Yes');form20.submit();list_profile_settings.load()" dmx-hide="(delete_user=='Yes')"><i class="fas fa-toggle-off fa-2x"></i></button>

                                                                  <button id="btn388" class="btn" dmx-on:click="updateDeleteUser.setValue('No');form20.submit();list_profile_settings.load()" dmx-show="(delete_user=='Yes')" style="color: #c47ce6 !important;"><i class="fas fa-toggle-on fa-2x"></i></button>

                                                            </form>
                                                      </td>
                                                      <td>
                                                            <form id="form21" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_profile_settings/update_edit_user.php">
                                                                  <input id="updateEditUser" name="edit_user" type="text" class="form-control visually-hidden" dmx-bind:value="edit_user">
                                                                  <input id="settingsProfileId20" name="profile_settings_id" type="text" class="form-control visually-hidden" dmx-bind:value="profile_settings_id">

                                                                  <button id="btn39" class="btn text-body" dmx-on:click="updateEditUser.setValue('Yes');form21.submit();list_profile_settings.load()" dmx-hide="(edit_user=='Yes')"><i class="fas fa-toggle-off fa-2x"></i></button>

                                                                  <button id="btn399" class="btn" dmx-on:click="updateEditUser.setValue('No');form21.submit();list_profile_settings.load()" dmx-show="(edit_user=='Yes')" style="color: #c47ce6 !important;"><i class="fas fa-toggle-on fa-2x"></i></button>

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
      <script src="bootstrap/5/js/bootstrap.min.js"></script>
</body>

</html>