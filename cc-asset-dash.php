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
			"options": {"loginUrl":"Login.php","forbiddenUrl":"Login.php","provider":"servo_login"}
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
  <link rel="stylesheet" href="dmxAppConnect/dmxDatePicker/daterangepicker.min.css" />
  <script src="dmxAppConnect/dmxDatePicker/daterangepicker.min.js" defer=""></script>
  <link rel="stylesheet" href="dmxAppConnect/dmxDatePicker/dmxDatePicker.css" />
  <script src="dmxAppConnect/dmxDatePicker/dmxDatePicker.js" defer=""></script>


  <script src="dmxAppConnect/dmxFormatter/dmxFormatter.js" defer=""></script>
  <link rel="stylesheet" href="dmxAppConnect/dmxDatePicker/bgthemes/dark-calendar.css" />
  <link rel="stylesheet" href="fontawesome5/css/all.min.css" />
  <script src="dmxAppConnect/dmxBootstrap5PagingGenerator/dmxBootstrap5PagingGenerator.js" defer=""></script>
  <script src="https://maps.googleapis.com/maps/api/js?callback=Function.prototype"></script>
  <script src="dmxAppConnect/dmxGoogleMaps/dmxGoogleMaps.js" defer></script>
  <script src="dmxAppConnect/dmxBootstrap5Popovers/dmxBootstrap5Popovers.js" defer></script>
  <script src="dmxAppConnect/dmxGeolocation/dmxGeolocation.js" defer></script>
  <script src="dmxAppConnect/dmxBootstrap5Tooltips/dmxBootstrap5Tooltips.js" defer></script>
  <link rel="stylesheet" href="dmxAppConnect/dmxPreloader/dmxPreloader.css" />
  <script src="dmxAppConnect/dmxPreloader/dmxPreloader.js" defer></script>
  <script src="dmxAppConnect/dmxBootstrap5Collapse/dmxBootstrap5Collapse.js" defer></script>
  <link rel="stylesheet" href="dmxAppConnect/dmxValidator/dmxValidator.css" />
  <script src="dmxAppConnect/dmxValidator/dmxValidator.js" defer></script>
  <script src="dmxAppConnect/dmxDownload/dmxDownload.js" defer></script>
  <script src="dmxAppConnect/dmxBootbox5/bootstrap-modbox.min.js" defer></script>
  <script src="dmxAppConnect/dmxBootbox5/dmxBootbox5.js" defer></script>

  <link rel="stylesheet" href="bootstrap/5/css/bootstrap.min.css" />
</head>

<body id="brands" is="dmx-app" dmx-on:ready="preloader1.hide();session_variables.set('current_asset',query.asset)">
  <dmx-serverconnect id="download_asset_file" url="dmxConnect/api/servo_asset_files/download_asset_file.php"></dmx-serverconnect>
  <dmx-download id="downloadAssetfile" dmx-bind:url=""></dmx-download>


  <dmx-geolocation id="geolocation"></dmx-geolocation>
  <div class="row">
    <dmx-preloader id="preloader1" spinner="threeBounce" bgcolor="#000000" color="#DDDDDD"></dmx-preloader>
  </div>
  <dmx-session-manager id="session_variables"></dmx-session-manager>

  <dmx-value id="lang" dmx-bind:value="browser1.language"></dmx-value>
  <dmx-json-datasource id="trans" is="dmx-serverconnect" url="assets/translation/translation.JSON"></dmx-json-datasource>

  <dmx-serverconnect id="read_asset" url="dmxConnect/api/servo_assets/read_customer_asset.php" dmx-param:id="id" dmx-param:item_id="" dmx-param:branch_id="read_item_branch.data.queryReadBranch.branch_id" dmx-param:vendor_id="vendor_session_variables.data.current_vendor" dmx-param:asset_id="session_variables.data.current_asset"></dmx-serverconnect>
  <dmx-serverconnect id="list_asset_files" url="dmxConnect/api/servo_asset_files/list_asset_files.php" dmx-param:id="id" dmx-param:item_id="" dmx-param:branch_id="read_item_branch.data.queryReadBranch.branch_id" dmx-param:vendor_id="vendor_session_variables.data.current_vendor" dmx-param:asset_id="read_asset.data.query_read_customer_asset.asset_id"></dmx-serverconnect>
  <div is="dmx-browser" id="browser1"></div>
  <dmx-notifications id="assetNotification" align="full" timeout="500" closable="true"></dmx-notifications>
  <?php include 'cc-header.php'; ?>
  <main>
    <div class="mt-auto ms-3 me-3">
      <dmx-value id="assetId" dmx-bind:value="list_user_info.data.query_list_user_info.user_id"></dmx-value>

      <div class="row servo-page-header justify-content-start rounded rounded-3 text-body pt-1 pb-1 ps-1 pe-1">
        <div class="col-auto d-flex pt-2 pb-1 ps-3 pe-2 border-secondary rounded-pill" dmx-animate-enter="slideInLeft">
          <i class="far fa-building fa-lg" style="/* color: #fcff18 !important */"></i>
          <h6 class="servo-page-heading ms-2 text-body">{{trans.data.constructionProjectDashboard[lang.value]}}: {{read_asset.data.query_read_customer_asset.asset_id}}</h6>
        </div>
        <div class="col-auto d-flex rounded-pill ms-1 pt-2 ps-3 pe-3 bg-light" dmx-animate-enter="slideInLeft">
          <h6 class="servo-page-heading ms-1 text-body">{{read_asset.data.query_read_customer_asset.permit_number}}</h6>
        </div>
        <div class="col-auto d-flex rounded-pill ms-1 pt-2 ps-3 pe-3 bg-light" dmx-animate-enter="slideInLeft">
          <h6 class="servo-page-heading ms-1 text-body">{{read_asset.data.query_read_customer_asset.customer_first_name}} {{read_asset.data.query_read_customer_asset.customer_last_name}}</h6>
        </div>

      </div>
      <div class="row">
        <div class="col mt-2">
          <ul class="nav nav-tabs nav-justified" id="navTabs1_tabs" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="navTabs1_2_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_21" role="tab" aria-controls="navTabs1_2" aria-selected="false"><i class="fas fa-info" style="margin-right: 5px"></i>
                {{trans.data.info[lang.value]}}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="navTabs1_3_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_31" role="tab" aria-controls="navTabs1_3" aria-selected="false"><i class="far fa-file" style="margin-right:5px;"></i>
                {{trans.data.documents[lang.value]}}</a>
            </li>
          </ul>
          <div class="tab-content" id="navTabs1_content">
            <div class="tab-pane fade mb-2 ms-2 me-2 active show" id="navTabs1_21" role="tabpanel">
              <div class="row row-cols-12">

                <div class="rounded-2 rounded col-md-auto col-12 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xxl col-xxl-5 mt-3 me-2 pt-3 pb-2 ps-3 pe-3 bg-light">
                  <div class="row justify-content-between">
                    <div class="col d-flex justify-content-between">
                      <h5 wappler-command="editContent" class="text-body">
                        <i class="fas fa-map-marker-alt" style="margin-right: 10px;"></i>{{trans.data.assetGeolocation[lang.value]}}
                      </h5>

                      <a href="" dmx-bind:href="'https://maps.google.com/?q='+read_asset.data.query_read_customer_asset.asset_lat+','+read_asset.data.query_read_customer_asset.asset_long" target="_blank" id="goToMaps" dmx-bs-tooltip="'Google Maps (External)'" data-bs-trigger="hover focus" data-bs-placement="right"><button id="btn7" class="btn text-white bg-danger" wappler-command="editContent"><i class="fas fa-directions fa-lg" style="margin-right: 5px;"></i>{{trans.data.getDirections[lang.value]}}</button></a>
                    </div>
                  </div>
                  <form is="dmx-serverconnect-form" id="updateAssetGeo" method="post" action="dmxConnect/api/servo_assets/update_customer_asset_municipality_main.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="read_asset.data.query_read_customer_asset" dmx-on:success="assetNotification.success(trans.data.assetUpdated[lang.value]);read_asset.load({asset_id: read_asset.data.query_read_customer_asset.asset_id})">
                    <div class="form-group mb-3 row">
                      <label for="inp_asset_id" class="col-sm-2 col-form-label visually-hidden" wappler-command="editContent">Asset</label>
                      <div class="col-sm-10 visually-hidden">
                        <input type="number" class="form-control" id="inp_asset_id" name="asset_id" dmx-bind:value="read_asset.data.query_read_customer_asset.asset_id" aria-describedby="inp_asset_id_help" placeholder="Enter Asset">
                      </div>
                    </div>
                    <div class="form-group mb-3 row">
                      <label for="inp_asset_name" class="col-sm-2 col-form-label visually-hidden" wappler-command="editContent">Asset name</label>
                      <div class="col-sm-10 visually-hidden">
                        <input type="text" class="form-control" id="inp_asset_name" name="asset_name" dmx-bind:value="read_asset.data.query_read_customer_asset.asset_name" aria-describedby="inp_asset_name_help" placeholder="Enter Asset name">
                      </div>
                    </div>
                    <div class="form-group mb-3 row">
                      <label for="inp_asset_lat" class="col-sm-2 col-form-label" wappler-command="editContent">{{trans.data.latitude[lang.value]}}</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inp_asset_lat" name="asset_lat" dmx-bind:value="read_asset.data.query_read_customer_asset.asset_lat" aria-describedby="inp_asset_lat_help">
                      </div>
                    </div>
                    <div class="form-group mb-3 row">
                      <label for="inp_asset_long" class="col-sm-2 col-form-label" wappler-command="editContent">{{trans.data.longitude[lang.value]}}</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inp_asset_long" name="asset_long" dmx-bind:value="read_asset.data.query_read_customer_asset.asset_long" aria-describedby="inp_asset_long_help">
                      </div>
                    </div>
                    <div class="form-group mb-3 row">

                      <div class="col">
                        <button type="submit" class="btn text-white bg-info w-25" dmx-bind:value="read_asset.data.query_read_customer_asset.Save" wappler-command="editContent">
                          <i class="fas fa-check" style="margin-right: 5px;"></i> {{trans.data.update[lang.value]}}
                        </button>
                      </div>
                    </div>
                    <div class="row"><input type="number" class="form-control visually-hidden" id="inp_asset_owner" name="asset_owner" dmx-bind:value="read_asset.data.query_read_customer_asset.asset_owner" aria-describedby="inp_asset_owner_help" placeholder="Enter Asset owner"><input type="number" class="form-control visually-hidden" id="inp_user_created" name="user_created" dmx-bind:value="read_asset.data.query_read_customer_asset.user_created" aria-describedby="inp_user_created_help" placeholder="Enter User created"><input type="date" class="form-control visually-hidden" id="inp_date_created" name="date_created" dmx-bind:value="read_asset.data.query_read_customer_asset.date_created" aria-describedby="inp_date_created_help" placeholder="Enter Date created"></div>
                    <div class="row">
                      <div class="col bg-secondary ms-2 me-4 pt-2 pb-3 ps-2 pe-2 rounded rounded-2">

                        <div class="row">
                          <div class="col">
                            <div class="row">
                              <div class="col"><button id="btn3" class="btn text-end text-light mb-1" dmx-on:click="assetLocation.panTo(geolocation.coords.latitude,geolocation.coords.longitude);inp_asset_lat.setValue(geolocation.coords.latitude);inp_asset_long.setValue(geolocation.coords.longitude)" style="color: #707004 !important;" dmx-bs-tooltip="trans.data.currentLocation[lang.value]" data-bs-trigger="hover" data-bs-placement="right">
                                  <i class="fas fa-male fa-lg"></i>
                                </button></div>
                              <div class="col text-end"><button id="btn2" class="btn text-end mb-1 text-body" dmx-on:click="inp_asset_long.setValue(read_asset.data.query_read_customer_asset.asset_long);inp_asset_lat.setValue(read_asset.data.query_read_customer_asset.asset_lat);assetLocation.panTo(read_asset.data.query_read_customer_asset.asset_lat,read_asset.data.query_read_customer_asset.asset_long)" dmx-bs-tooltip="trans.data.reposition[lang.value]" data-bs-trigger="hover" data-bs-placement="right">
                                  <i class="fas fa-undo fa-lg"></i>
                                </button></div>

                            </div>


                            <dmx-google-maps id="assetLocation" fullscreen-control="true" zoom-control="true" maptype-control="true" scrollwheel="true" zoom="16" maptype="satellite" dmx-on:mapclick="inp_asset_lat.setValue($event.latitude);inp_asset_long.setValue($event.longitude);assetLocation.panTo($event.latitude,$event.longitude)" height="300" dmx-bind:latitude="read_asset.data.query_read_customer_asset.asset_lat" dmx-bind:longitude="read_asset.data.query_read_customer_asset.asset_long">
                              <dmx-google-maps-marker id="assetMarker" dmx-bind:latitude="inp_asset_lat.value" dmx-bind:longitude="inp_asset_long.value" draggable="true" animation="bounce"></dmx-google-maps-marker>
                            </dmx-google-maps>
                          </div>
                        </div>

                      </div>
                    </div>


                  </form>
                  <div class="row justify-content-sm-between justify-content-md-between justify-content-lg-between justify-content-xl-between justify-content-xxl-between mt-2 sorter shadow-none bg-transparent">
                    <div class="col-lg-3 col-12 col-sm-12 pb-2" id="qr">

                    </div>

                  </div>
                </div>
                <div class="col mt-3 rounded bg-light">
                  <div class="row mt-3 justify-content-end">
                    <div class="style13 page-button w-auto offset-9 col-12" id="pagebuttons">
                      <a href="" target="_blank" dmx-bind:href="'printplaque.php?asset='+read_asset.data.query_read_customer_asset.asset_id"><button id="printPlaqueButton" class="btn style12 fw-light add-button w-auto pt-2 pb-2 ps-3 pe-3 text-white bg-info" data-bs-target="#printPlaque" style="float: right;"><i class="fas fa-file-pdf fa-lg" style="margin-right: 5px;"></i>{{trans.data.generatePlaque[lang.value]}}</button></a>

                    </div>
                  </div>
                  <ul class="nav nav-tabs mt-3" id="navTabs1_tabs" role="tablist">
                    <li class="nav-item flex-shrink-1 w-50 text-start">
                      <a class="nav-link active ms-1 w-auto text-center" id="assetData1Tab" data-bs-toggle="tab" href="#" data-bs-target="#assatDataTab1Cotent" role="tab" aria-controls="navTabs1_1" aria-selected="true" wappler-command="editContent"><i class="fas fa-drafting-compass fa-lg" style="margin-right: 5px;"></i>
                        {{trans.data.technicalInformation[lang.value]}}</a>

                    </li>
                    <li class="nav-item flex-shrink-1 w-50">
                      <a class="nav-link w-auto text-center" id="assetData2Tab" data-bs-toggle="tab" href="#" data-bs-target="#assatDataTab2Cotent" role="tab" aria-controls="navTabs1_2" aria-selected="false" wappler-command="editContent"><i class="fas fa-qrcode fa-lg" style="margin-right:5px"></i>
                        {{trans.data.plaqueInformation[lang.value]}}</a>
                    </li>
                  </ul>
                  <div class="tab-content" id="navTabs1_content">
                    <div class="tab-pane fade show active" id="assatDataTab1Cotent" role="tabpanel">
                      <div class="row">
                        <div class="rounded-2 rounded mt-3 pt-3 pb-2 ps-3 pe-3 col-lg-auto col-sm-12 col-xxl col-xxl-7 col-md-12 col-lg-12">
                          <form id="updateAssetMuicipalityTechnicalData" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_assets/update_customer_asset_municipality_additional.php" dmx-on:success="assetNotification.success('Success!');read_asset.load({asset_id: read_asset.data.query_read_customer_asset.asset_id})" dmx-on:error="assetNotification.danger('Error')" dmx-on:start="preloader1.show()" dmx-on:done="preloader1.hide()">
                            <div class="form-group mb-3 row" id="paymentStatus">
                              <label for="paymentStatus1" class="col-form-label col-sm-4 col-xxl col-4 col-md-4 col-lg-4" wappler-command="editContent">{{trans.data.paymentStatus[lang.value]}}</label>
                              <div class="col-sm-6 offset-sm-1 col-md-7 col-lg-6 col-6 col-xxl">
                                <select id="paymentStatus1" class="form-select" name="payment_status" dmx-bind:value="read_asset.data.query_read_customer_asset.payment_status.default(null)">
                                  <option value="yes">{{trans.data.yes[lang.value]}}</option>
                                  <option value="no">{{trans.data.no[lang.value]}}</option>
                                  <option selected="" value="NULL">---</option>
                                </select>

                              </div>
                            </div>
                            <div class="form-group mb-3 row" id="paymentStatus"><label for="" class="col-form-label col-sm-4 col-lg-4 col-4 col-md-4" wappler-command="editContent">{{trans.data.projectStatus[lang.value]}}</label>
                              <div class="col-sm-6 offset-sm-1 col">
                                <select id="projectStatus2" class="form-select" name="project_status" dmx-bind:value="read_asset.data.query_read_customer_asset.project_status.default(null)">
                                  <option value="delivered">{{trans.data.delivered[lang.value]}}</option>
                                  <option value="notDelivered">{{trans.data.notDelivered[lang.value]}}</option>
                                  <option selected="" value="NULL">---</option>
                                </select>
                              </div>
                            </div>
                            <div class="form-group mb-3 row" id="projectAlertStatus"><label for="projectAlertStatus1" class="col-form-label col-sm-4 col-lg-4 col-4 col-md-4" wappler-command="editContent">{{trans.data.projectAlertStatus[lang.value]}}</label>
                              <div class="col-sm-6 offset-sm-1 col">
                                <select id="projectAlertStatus1" class="form-select" name="project_alert_status" dmx-bind:value="read_asset.data.query_read_customer_asset.project_alert_status.default(null)">
                                  <option value="yes">{{trans.data.yes[lang.value]}}</option>
                                  <option value="no">{{trans.data.no[lang.value]}}</option>
                                  <option selected="" value="NULL">---</option>
                                </select>
                              </div>
                            </div>
                            <div class="form-group mb-3 row" id="titleDeedNumber"><label for="titleDeedNumber" class="col-form-label col-sm-4 col-lg-4 col-4 col-md-4" wappler-command="editContent">{{trans.data.titleDeedNumber[lang.value]}}</label>
                              <div class="col-sm-6 offset-sm-1 col-auto">
                                <input type="text" class="form-control" id="titleDeedNumber1" name="title_deed_number" aria-describedby="input1_help" dmx-bind:value="read_asset.data.query_read_customer_asset.title_deed_number" style="width: auto !important;">
                              </div>
                            </div>
                            <div class="form-group mb-3 row" id="plotNumber"><label for="plotNumber" class="col-form-label col-sm-4 col-4 col-lg-4 col-md-4" wappler-command="editContent">{{trans.data.plotNumber[lang.value]}}</label>
                              <div class="col-sm-6 offset-sm-1 col-auto">
                                <input type="text" class="form-control" id="plotNumber" name="plot_number" aria-describedby="input1_help" dmx-bind:value="read_asset.data.query_read_customer_asset.plot_number">
                              </div>
                            </div>
                            <div class="form-group mb-3 row" id="neighborhood2">
                              <label for="neighborhood2" class="col-form-label col-sm-4 col-4 col-lg-4 col-md-4" wappler-command="editContent">{{trans.data.blockNumber[lang.value]}}</label>
                              <div class="col-sm-6 offset-sm-1 col-auto">
                                <input type="text" class="form-control" id="blockNumber1" name="block_number" aria-describedby="input1_help" dmx-bind:value="read_asset.data.query_read_customer_asset.block_number">
                              </div>
                            </div>
                            <div class="form-group mb-3 row" id="neighborhoodLocalName2">
                              <label for="neighborhoodLocalName2" class="col-form-label col-sm-4 col-4 col-lg-4 col-md-4" wappler-command="editContent">{{trans.data.surfaceArea[lang.value]}}</label>
                              <div class="col-sm-6 offset-sm-1 col-6">
                                <input type="number" class="form-control" id="surfaceArea1" name="surface_area" aria-describedby="input1_help" dmx-bind:value="read_asset.data.query_read_customer_asset.surface_area">
                              </div>
                            </div>
                            <div class="form-group mb-3 row" id="streetName2">
                              <label for="streetName2" class="col-form-label col-sm-4 col-4 col-lg-4 col-md-4" wappler-command="editContent">{{trans.data.commentaireSurD[lang.value]}}</label>
                              <div class="col-sm-6 offset-sm-1 col-6">
                                <textarea type="text" class="form-control" id="commentaireSurD" name="commentaire_sur_decallage" aria-describedby="input1_help" dmx-bind:value="read_asset.data.query_read_customer_asset.commentaire_sur_decallage" style="min-height: 200px !important;"></textarea>
                              </div>
                            </div>
                            <div class="form-group mb-3 row" id="secteurOperatioel"><label for="paymentStatus1" class="col-form-label col-sm-4 col-4 col-lg-4 col-md-4" wappler-command="editContent">{{trans.data.secteurOperationel[lang.value]}}</label>
                              <div class="col-sm-6 offset-sm-1 col-6">
                                <select id="secteurOperationnel1" class="form-select" name="secteur_operationel" dmx-bind:value="read_asset.data.query_read_customer_asset.secteur_operationel.default(null)">
                                  <option value="yes">{{trans.data.yes[lang.value]}}</option>
                                  <option value="no">{{trans.data.no[lang.value]}}</option>
                                  <option selected="" value="NULL">---</option>
                                </select>

                              </div>
                            </div>
                            <div class="form-group mb-3 row" id="servitudePublique">
                              <label for="projectId2" class="col-form-label col-sm-4 col-4 col-lg-4 col-md-4" wappler-command="editContent">{{trans.data.servitudePublique[lang.value]}}</label>
                              <div class="col-sm-6 offset-sm-1 col-6">
                                <select id="servitudePublique1" class="form-select" name="servitude_publique" dmx-bind:value="read_asset.data.query_read_customer_asset.servitude_publique.default(null)">
                                  <option value="yes">{{trans.data.yes[lang.value]}}</option>
                                  <option value="no">{{trans.data.no[lang.value]}}</option>
                                  <option selected="" value="NULL">---</option>
                                </select>

                              </div>
                            </div>
                            <div class="form-group mb-3 row" id="servitudePrivee">
                              <label for="projectId3" class="col-form-label col-sm-4 col-4 col-lg-4 col-md-4" wappler-command="editContent">{{trans.data.servitudePrivee[lang.value]}}</label>
                              <div class="col-sm-6 offset-sm-1 col-6">
                                <select id="servitudePrivee1" class="form-select" name="servitude_privee" dmx-bind:value="read_asset.data.query_read_customer_asset.servitude_privee.default(null)">
                                  <option value="yes">{{trans.data.yes[lang.value]}}</option>
                                  <option value="no">{{trans.data.no[lang.value]}}</option>
                                  <option selected="" value="NULL">---</option>
                                </select>
                              </div>
                            </div>
                            <div class="form-group mb-3 row" id="projectentitlement">
                              <label for="projectId4" class="col-form-label col-sm-4 col-4 col-lg-4 col-md-4" wappler-command="editContent">{{trans.data.projectType[lang.value]}}</label>
                              <div class="col-sm-6 offset-sm-1 col-6">
                                <input type="number" class="form-control" id="projectEntitlement" name="project_entitlement" aria-describedby="input1_help" dmx-bind:value="read_asset.data.query_read_customer_asset.project_entitlement">
                              </div>
                            </div>
                            <div class="form-group mb-3 row" id="projectId5">
                              <label for="projectId5" class="col-form-label col-sm-4 col-4 col-lg-4 col-md-4" wappler-command="editContent">{{trans.data.empriseDuSol[lang.value]}}</label>
                              <div class="col-sm-6 offset-sm-1 col-6">
                                <input type="number" class="form-control" id="empriseDuSol1" name="emprise_du_sol" aria-describedby="input1_help" dmx-bind:value="read_asset.data.query_read_customer_asset.emprise_du_sol">
                              </div>
                            </div>
                            <div class="form-group mb-3 row" id="projectId6">
                              <label for="projectId6" class="col-form-label col-sm-4 col-4 col-lg-4 col-md-4" wappler-command="editContent">{{trans.data.cumulDePlancees[lang.value]}}</label>
                              <div class="col-sm-6 offset-sm-1 col-6">
                                <input type="number" class="form-control visually-hidden" id="cumulDePlancees1" name="cumul_de_plancees" aria-describedby="input1_help" dmx-bind:value="read_asset.data.query_read_customer_asset.cumul_de_plancees">
                                <button id="btn1" class="btn text-white bg-info mt-2" data-bs-toggle="modal" data-bs-target="#createFloor"><i class="fas fa-building" style="margin-right: 5px;"></i>{{trans.data.editFloors[lang.value]}}</button>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col bg-secondary rounded mt-2 mb-2 ms-1 me-1">
                                <div class="table-responsive">
                                  <table class="table table-striped table-sm">
                                    <thead class="text-center">
                                      <tr>
                                        <th>{{trans.data.floor[lang.value]}}</th>
                                        <th>{{trans.data.surfaceArea[lang.value]}}</th>
                                      </tr>
                                    </thead>
                                    <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="read_asset.data.query_read_asset_floors" id="tableRepeat2">
                                      <tr>
                                        <td dmx-text="asset_floor_number" class="text-center"></td>
                                        <td dmx-text="asset_floor_surface_area" class="text-end"></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                                <h5 dmx-text="read_asset.data.TotalFloorArea[0].TotalFloorArea.toNumber().formatNumber('5', '.', ',')" class="text-end">Fancy display heading</h5>
                              </div>

                            </div>
                            <div class="form-group mb-3 row" id="observations"><label for="servitudePublique" class="col-form-label col-sm-4 col-4 col-lg-4 col-md-4" wappler-command="editContent">{{trans.data.observations[lang.value]}}</label>
                              <div class="col-sm-6 offset-sm-1 col-6">
                                <textarea type="text" class="form-control" id="observations1" name="observations" aria-describedby="input1_help" dmx-bind:value="read_asset.data.query_read_customer_asset.observations" style="min-height: 200px !important;"></textarea>
                              </div>
                            </div>
                            <div class="form-group mb-3 row" id="asset1">
                              <div class="col-sm-6 offset-sm-1 col-6 offset-1 visually-hidden">
                                <input type="text" class="form-control" id="asset11" name="asset" aria-describedby="input1_help" dmx-bind:value="read_asset.data.query_read_customer_asset.asset_id">
                              </div>
                            </div>

                            <div class="row">
                              <div class="col text-center"><button id="updateAssetTechnicalData" class="btn text-white bg-info w-25" type="submit" wappler-empty="Editable" wappler-command="editContent">
                                  <i class="fas fa-check" style="margin-right: 5px;"></i>{{trans.data.update[lang.value]}}
                                </button></div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="assatDataTab2Cotent" role="tabpanel">

                      <div class="row">
                        <div class="rounded-2 rounded col-lg-auto mt-3 ms-1 pt-3 pb-2 ps-3 pe-3 offset-lg-1 col-lg-12 col-md-12">
                          <form id="updateAssetInfoPlaque" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_assets/update_customer_asset_municipality_plaque.php" dmx-on:success="assetNotification.success('Success!');read_asset.load({asset_id: read_asset.data.query_read_customer_asset.asset_id})" dmx-on:error="assetNotification.danger('Error!')" dmx-on:start="preloader1.show()" dmx-on:done="preloader1.hide()">
                            <div class="form-group mb-3 row" id="numero_de_permis">
                              <label for="permitNumber" class="col-form-label col-sm-4 col-4" wappler-command="editContent">{{trans.data.permitNumber[lang.value]}}</label>
                              <div class="col-sm-6 offset-sm-1 col-auto col-md-7">
                                <input type="text" class="form-control" id="permitNumber" name="permit_number" aria-describedby="input1_help" dmx-bind:value="read_asset.data.query_read_customer_asset.permit_number" style="width: auto !important;">
                              </div>
                            </div>
                            <div class="form-group mb-3 row" id="maitreDoeuvre">
                              <label for="" class="col-form-label col-sm-4 col-4" wappler-command="editContent">{{trans.data.maitreDoeuvre[lang.value]}}</label>
                              <div class="col-sm-6 offset-sm-1 col-auto">
                                <input type="text" class="form-control" id="maitreDoeuvre1" name="maitre_doeuvre" aria-describedby="input1_help" dmx-bind:value="read_asset.data.query_read_customer_asset.maitre_doeuvre">
                              </div>
                            </div>
                            <div class="form-group mb-3 row" id="maitreDouvrage">
                              <label for="maitredouvrage1" class="col-form-label col-sm-4 col-4" wappler-command="editContent">{{trans.data.maitreDouvrage[lang.value]}}</label>
                              <div class="col-sm-6 offset-sm-1 col-auto">
                                <input type="text" class="form-control" id="maitredouvrage1" name="maitre_douvrage" aria-describedby="input1_help" dmx-bind:value="read_asset.data.query_read_customer_asset.maitre_douvrage">
                              </div>
                            </div>
                            <div class="form-group mb-3 row" id="constructionType">
                              <label for="constructionType1" class="col-form-label col-sm-4 col-4" wappler-command="editContent">{{trans.data.constructionType[lang.value]}}</label>
                              <div class="col-sm-6 offset-sm-1 col-auto">
                                <input type="text" class="form-control" id="constructionType1" name="construction_type" aria-describedby="input1_help" dmx-bind:value="read_asset.data.query_read_customer_asset.construction_type">
                              </div>
                            </div>
                            <div class="form-group mb-3 row" id="constructionType2">
                              <label for="constructionType2" class="col-form-label col-sm-4 col-4" wappler-command="editContent">{{trans.data.combinedSurfaceArea[lang.value]}}</label>
                              <div class="col-sm-6 offset-sm-1 col-auto">
                                <input type="text" class="form-control" id="combinedSurfaceArea" name="combined_surface_area" aria-describedby="input1_help" dmx-bind:value="read_asset.data.query_read_customer_asset.combined_surface_area">
                              </div>
                            </div>
                            <div class="form-group mb-3 row" id="district">
                              <label for="district1" class="col-form-label col-sm-4 col-4" wappler-command="editContent">{{trans.data.district[lang.value]}}</label>
                              <div class="col-sm-6 offset-sm-1 col-auto col-5">
                                <select id="select2" class="form-select" name="district" dmx-bind:required="'!'" dmx-bind:value="read_asset.data.query_read_customer_asset.district">
                                  <option selected="" value="">------</option>
                                  <option value="Douala I">Douala I</option>
                                  <option value="Douala II">Douala II</option>
                                  <option value="Douala III">Douala III</option>
                                  <option value="Douala IV">Douala IV</option>
                                  <option value="Douala V">Douala V</option>
                                  <option value="Douala VI">Douala VI</option>
                                </select>
                              </div>
                            </div>
                            <div class="form-group mb-3 row" id="neighborhood">
                              <label for="neighborhood1" class="col-form-label col-sm-4 col-4" wappler-command="editContent">{{trans.data.neighborhood[lang.value]}}</label>
                              <div class="col-sm-6 offset-sm-1 col-auto">
                                <input type="text" class="form-control" id="neighborhood1" name="neighborhood" aria-describedby="input1_help" dmx-bind:value="read_asset.data.query_read_customer_asset.neighborhood">
                              </div>
                            </div>
                            <div class="form-group mb-3 row" id="neighborhoodLocalName">
                              <label for="neighborhoodLocalName1" class="col-form-label col-sm-4 col-4" wappler-command="editContent">{{trans.data.neighborhoodLocalName[lang.value]}}</label>
                              <div class="col-sm-6 offset-sm-1 col-6">
                                <input type="text" class="form-control" id="neighborhoodLocalName1" name="neighborhood_local_name" aria-describedby="input1_help" dmx-bind:value="read_asset.data.query_read_customer_asset.neighborhood_local_name">
                              </div>
                            </div>
                            <div class="form-group mb-3 row" id="streetName">
                              <label for="streetName1" class="col-form-label col-sm-4 col-4" wappler-command="editContent">{{trans.data.streetName[lang.value]}}</label>
                              <div class="col-sm-6 offset-sm-1 col-6">
                                <input type="text" class="form-control" id="streetName1" name="street_name" aria-describedby="input1_help" dmx-bind:value="read_asset.data.query_read_customer_asset.street_name">
                              </div>
                            </div>
                            <div class="form-group mb-3 row" id="projectPurpose1"><label for="permitNumber8" class="col-form-label col-sm-4 col-4" wappler-command="editContent">{{trans.data.projectPurpose[lang.value]}}</label>
                              <div class="col-sm-6 offset-sm-1 col-6">
                                <input type="text" class="form-control" id="permitNumber8" name="project_purpose" aria-describedby="input1_help" dmx-bind:value="read_asset.data.query_read_customer_asset.project_purpose">
                              </div>
                            </div>
                            <div class="form-group mb-3 row" id="projectId">
                              <label for="projectId1" class="col-form-label col-sm-4 col-4" wappler-command="editContent">{{trans.data.projectId[lang.value]}}</label>
                              <div class="col-sm-6 offset-sm-1 col-6">
                                <input type="text" class="form-control" id="projectId1" name="project_id" aria-describedby="input1_help" dmx-bind:value="read_asset.data.query_read_customer_asset.project_id">
                              </div>
                            </div>
                            <div class="form-group mb-3 row" id="asset">
                              <div class="col-sm-6 offset-sm-1 col-6 offset-1">
                                <input type="text" class="form-control visually-hidden" id="asset" name="asset" aria-describedby="input1_help" dmx-bind:value="read_asset.data.query_read_customer_asset.asset_id">
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-xxl-5 offset-0 col">

                                <div class="row"><button id="updateAssetPlaqueData" class="btn text-white bg-info w-50" type="submit" wappler-empty="Editable" wappler-command="editContent">
                                    <i class="fas fa-check" style="margin-right: 5px;"></i> {{trans.data.update[lang.value]}}
                                  </button></div>

                              </div>
                            </div>
                          </form>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row" wappler-empty="Row" wappler-command="addElementInside">


              </div>
            </div>
            <div class="tab-pane fade" id="navTabs1_31" role="tabpanel">
              <div class="row justify-content-xxl-end row-cols-xxl-12 row-cols-12 mt-3 mb-2 justify-content-end">
                <div class="col text-end"><button id="btn4" class="btn btn-info w-auto" dmx-on:click="" data-bs-toggle="collapse" data-bs-target="#uploadFileCollapse"><i class="fas fa-file-upload"></i>
                  </button></div>
              </div>

              <div class="collapse" id="uploadFileCollapse" is="dmx-bs5-collapse">
                <div class="container">
                  <div class="row mt-xl-3 mt-3">
                    <div class="col mt-md-3 ms-lg-2 me-lg-2 ms-2 me-2 pt-2 pb-2 ps-5 pe-2 rounded rounded-2 bg-secondary">
                      <h3 class="mt-3">{{trans.data.uploadFile[lang.value]}}</h3>
                      <form id="uploadAssetfile" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_asset_files/create_asset_file.php" dmx-on:success="assetNotification.success('Success!');list_asset_files.load({asset_id: read_asset.data.query_read_customer_asset.asset_id}); uploadFileCollapse.hide();uploadAssetfile.reset()" dmx-on:error="assetNotification.danger('Error!')">
                        <input id="fileCreator" name="asset_file_creator" type="text" class="form-control visually-hidden" dmx-bind:value="list_user_info.data.query_list_user_info.user_id">
                        <input id="fileDateCreated" name="asset_file_date_created" type="datetime-local" class="form-control visually-hidden" dmx-bind:value="dateTime.datetime">
                        <input id="assetId" name="asset_file_asset_id" type="number" class="form-control visually-hidden" dmx-bind:value="read_asset.data.query_read_customer_asset.asset_id">

                        <div class="form-group mb-3 row" id="assetFileType">
                          <label for="fileType" class="col-sm-2 col-form-label col-md col-lg-2" wappler-command="editContent">{{trans.data.fileType[lang.value]}}</label>
                          <div class="col-sm-10 col-md-8 offset-lg-1">
                            <select id="select1" class="form-select" name="asset_file_type" required="" data-msg-required="!">
                              <option value="Certificate de Proprieté">{{trans.data.propertyCertificate[lang.value]}}</option>
                              <option value="Certificat d'Urbanisme">{{trans.data.urbanismCertificate[lang.value]}}</option>
                              <option value="Plan De Masse">{{trans.data.planDeMasse[lang.value]}}</option>
                              <option value="Demande De Permis">{{trans.data.permitApplication[lang.value]}}</option>
                              <option value="Déroation">{{trans.data.derogation[lang.value]}}</option>
                              <option selected="" value="Other">{{trans.data.other[lang.value]}}</option>
                            </select>
                          </div>
                        </div>

                        <div class="form-group mb-3 row">
                          <label for="fileUpload" class="col-sm-2 col-form-label col-lg-2" wappler-command="editContent">{{trans.data.uploadFileCollapse.lang.value]}}</label>
                          <div class="col-sm-10 offset-md-4 col-lg-5 offset-lg-1">
                            <input id="assetFile" name="asset_file" type="datetime-local" class="form-control visually-hidden"><input type="file" class="form-control" id="fileUpload" name="assetFile" aria-describedby="input1_help" data-rule-maxtotalsize="100MB" data-msg-maxtotalsize="Max 100MB!" required="" data-msg-required="!">
                          </div>
                        </div>
                        <div class="form-group mb-3 row">
                          <div class="col-2 col-xxl-6 offset-xxl-4 offset-sm-2 col-sm-2 offset-md-4 offset-lg-3">
                            <button id="submitAssetFile" class="btn btn-info text-white" type="submit" wappler-empty="Editable" wappler-command="editContent"><i class="fas fa-check fa-2x"></i></button>
                          </div>
                        </div>
                      </form>
                      <div class="progress" dmx-show="uploadAssetfile.state.executing">
                        <div class="progress-bar bg-info progress-bar-animated" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" dmx-style:width="uploadAssetfile.uploadProgress.percent+'%'">{{trans.data.uploading[lang.value]}}</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="table-responsive">
                    <table class="table table-sm">
                      <thead>
                        <tr>
                          <th wappler-command="editContent">#</th>
                          <th wappler-command="editContent">{{trans.data.file[lang.value]}}</th>
                          <th wappler-command="editContent">{{trans.data.type[lang.value]}}</th>
                          <th wappler-command="editContent">{{trans.data.user[lang.value]}}</th>
                          <th wappler-command="editContent">{{trans.data.dateTime[lang.value]}}</th>
                          <th wappler-command="editContent"></th>
                          <th wappler-command="editContent"></th>
                        </tr>
                      </thead>
                      <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_asset_files.data.query_list_asset_files" id="tableRepeat1">
                        <tr>
                          <td dmx-text="asset_file_id" wappler-command="editContent"></td>
                          <td dmx-text="asset_file" wappler-command="editContent"></td>
                          <td dmx-text="asset_file_type" wappler-command="editContent"></td>
                          <td dmx-text="user_username" wappler-command="editContent" dmx-on:click=""></td>
                          <td dmx-text="asset_file_date_created" wappler-command="editContent"></td>
                          <td wappler-command="editContent" dmx-on:click="">
                            <a href="" dmx-bind:href="'uploads/asset_files/'+asset_file" dmx-bind:download="asset_file"><button id="btn5" class="btn text-info" type="submit"><i class="fas fa-download fa-lg"></i>
                              </button></a>


                          </td>
                          <td onclick="window.alert('Confirm Delete!')">
                            <form id="deleteAssetFile" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_asset_files/delete_asset_file.php" dmx-on:success="list_asset_files.load({asset_id: read_asset.data.query_read_customer_asset.asset_id});assetNotification.warning('File Deleted!')">
                              <input id="assetFile1" name="asset_file" type="text" class="form-control visually-hidden" dmx-bind:value="asset_file">
                              <input id="assetFileId" name="asset_file_id" type="text" class="form-control visually-hidden" dmx-bind:value="asset_file_id">
                              <button id="deleteAssetFile1" class="btn text-body" type="submit"><i class="far fa-trash-alt fa-sm"></i>
                              </button>
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
  </main>
  <main class="mt-4" id="plaque">

    <div class="modal" id="createFloor" is="dmx-bs5-modal" tabindex="-1">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">
              <i class="fas fa-building" style="margin-right: 5px;"></i>{{trans.data.editFloors[lang.value]}}
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row pe-3">
              <div class="rounded bg-primary bg-opacity-10 col-12 ms-2 me-2 pt-3 pb-2 ps-2 pe-2">
                <h5>{{trans.data.addFloor[lang.value]}}</h5>
                <form is="dmx-serverconnect-form" id="createAssetFloor" method="post" action="dmxConnect/api/servo_assets/create_asset_floor.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-on:success="assetNotification.success('Success!');read_asset.load({asset_id: read_asset.data.query_read_customer_asset.asset_id});createAssetFloor.reset()" dmx-on:error="assetNotification.danger('Error!')"><input type="number" class="form-control visually-hidden" id="inp_asset_id1" name="asset_id" aria-describedby="inp_asset_id_help" placeholder="Enter Asset" dmx-bind:value="read_asset.data.query_read_customer_asset.asset_id">
                  <div class="form-group mb-3 row">
                    <label for="inp_asset_floor_number" class="col-sm-2 col-form-label">{{trans.data.floor[lang.value]}}</label>
                    <div class="col-sm-10">
                      <input type="number" class="form-control" id="inp_asset_floor_number" name="asset_floor_number" aria-describedby="inp_asset_floor_number_help">
                    </div>
                  </div>
                  <div class="form-group mb-3 row">
                    <label for="inp_asset_floor_surface_area" class="col-sm-2 col-form-label">{{trans.data.surfaceArea[lang.value]}}</label>
                    <div class="col-sm-10">
                      <input type="number" class="form-control" id="inp_asset_floor_surface_area" name="asset_floor_surface_area" aria-describedby="inp_asset_floor_surface_area_help">
                    </div>
                  </div>

                  <div class="form-group mb-3 row">
                    <div class="col-sm-2">&nbsp;</div>
                    <div class="col-sm-10">
                      <button type="submit" class="btn btn-primary" dmx-bind:disabled="state.executing">{{trans.data.create[lang.value]}} <span class="spinner-border spinner-border-sm" role="status" dmx-show="state.executing"></span></button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="row mt-1 pe-3">
              <div class="rounded bg-primary bg-opacity-10 ms-2 me-2 pt-3 pb-2 ps-2 pe-2 col-12">
                <h5>{{trans.data.floors[lang.value]}}</h5>

                <div class="table-responsive">
                  <table class="table table-sm">
                    <thead class="text-center">
                      <tr class="align-middle">
                        <th></th>
                        <th></th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="read_asset.data.query_read_asset_floors" id="tableRepeat23" class="align-top">
                      <tr class="align-top">
                        <td class="text-end">
                          <form id="updateAssetFloor" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_assets/update_asset_floor.php" class="d-flex" dmx-on:success="read_asset.load({asset_id: read_asset.data.query_read_customer_asset.asset_id});assetNotification.success('Success!')">
                            <input id="assetFloorAssetId" name="asset_floor_id" type="text" class="form-control visually-hidden" dmx-bind:value="asset_floor_id">

                            <div class="form-group mb-3 row">
                              <div class="col-sm-10">
                                <input id="assetFloorFloor" name="asset_floor_number" type="number" class="form-control me-1" dmx-bind:value="asset_floor_number"><small id="input1_help" class="form-text text-muted">{{trans.data.floor[lang.value]}}</small>
                              </div>
                            </div>
                            <div class="form-group mb-3 row">
                              <div class="col-sm-10">
                                <input id="assetFloorArea" name="asset_floor_surface_area" type="number" class="form-control me-1" dmx-bind:value="asset_floor_surface_area"><small id="input1_help1" class="form-text text-muted">{{trans.data.surfaceArea[lang.value]}}</small>
                              </div>
                            </div>

                            <button id="btn8" class="btn text-success" type="submit">
                              <i class="fas fa-check"></i></button>
                          </form>
                        </td>
                        <td class="text-end">
                          <form id="deleteAssetFloor" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_assets/delete_asset_floor.php" class="d-flex" dmx-on:success="read_asset.load({asset_id: read_asset.data.query_read_customer_asset.asset_id});assetNotification.success('Success!')">
                            <input id="assetFloorAssetId1" name="asset_floor_id" type="text" class="form-control visually-hidden" dmx-bind:value="asset_floor_id">
                            <button id="btn9" class="btn text-danger" type="submit">
                              <i class="far fa-trash-alt fa-sm"></i></button>
                          </form>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <div class="modal readitem" id="printPlaque" is="dmx-bs5-modal" tabindex="-1">
      <div class="modal-dialog modal-xl" role="document" style="margin: 0px !important; width: 100% !important; height: 99% !important; max-width: 100% !important; max-height: 99% !important;">
        <div class="modal-content" style="max-height: 100% !important; height: 100% !important;">
          <div class="modal-header text-sm-start">


            <div class="d-block">
              <h4 class="modal-title mt-2 text-white">{{read_customer.data.query_read_customer.customer_first_name+' '+read_customer.data.query_read_customer.customer_last_name}}</h4>
            </div>
            <div class="d-block visually-hidden">

            </div>
            <div class="d-block">

            </div>

            <div class="d-block">

            </div>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col">


              </div>
            </div>
          </div>
          <div class="modal-footer">
            <div id="conditional2" is="dmx-if" dmx-bind:condition="(profile_privileges.data.profile_privileges[0].delete_customer == 'Yes')">
              <form id="deleteCustomer" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_customers/delete_customer.php" dmx-on:success="notifies1.success('Success');list_customers.load({});readItemModal.hide()" onsubmit=" return confirm('CONFIRM DELETE?');" dmx-on:error="notifies1.warning('Error!')">

                <input id="text1" name="customer_id" type="hidden" class="form-control" dmx-bind:value="read_customer.data.query_read_customer.customer_id">

                <button id="btn6" class="btn text-secondary" type="submit">
                  <i class="far fa-trash-alt fa-lg"></i>
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>

  </main>


  <script src="bootstrap/5/js/bootstrap.bundle.min.js"></script>
  <script>
    $(document).ready(function($) 
    { 
    var assetvalue = sessionStorage.getItem('dmxState-current_asset');
    var assetv = dmx.parse('app.read_asset.data.query_read_customer_asset.asset_id');
    console.log('assetv=' + assetv);
    console.log(assetvalue);
    new QRCode(document.getElementById("qr"), "https://douala.buildingcontrolcm.com/asset-dash.php?asset=" + assetvalue);
    });
  </script>
  <script src="bootstrap/5/js/bootstrap.min.js"></script>
</body>

</html>