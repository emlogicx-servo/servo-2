<!doctype html>
<html>

<head>

    <style>
        @media print {

            #invoiceHead,
            .invoiceHead {
                display: none;
            }

            * {
                color: black !important;
            }

            .modal-footer {
                diaplay: none !important;
            }

        }
    </style>

    <link rel="stylesheet" href="css/bootstrap-icons.css" />

    <script src="dmxAppConnect/dmxAppConnect.js"></script>
    <script src="js/jquery-3.5.1.slim.min.js"></script>
    <script src="dmxAppConnect/dmxBootstrap5Navigation/dmxBootstrap5Navigation.js" defer=""></script>

    <script src="dmxAppConnect/dmxScheduler/dmxScheduler.js" defer=""></script>

    <script src="dmxAppConnect/dmxTyped/dmxTyped.js" defer=""></script>

    <script src="dmxAppConnect/dmxTyped/typed.min.js" defer=""></script>

    <link rel="stylesheet" href="dmxAppConnect/dmxNotifications/dmxNotifications.css" />

    <script src="dmxAppConnect/dmxNotifications/dmxNotifications.js" defer=""></script>

    <script src="dmxAppConnect/dmxBootstrap5Modal/dmxBootstrap5Modal.js" defer=""></script>

    <script src="dmxAppConnect/dmxStateManagement/dmxStateManagement.js" defer=""></script>

    <script src="dmxAppConnect/dmxBrowser/dmxBrowser.js" defer=""></script>

    <link rel="stylesheet" href="dmxAppConnect/dmxBootstrap5TableGenerator/dmxBootstrap5TableGenerator.css" />


    <meta name="ac:base" content="/servo">
    <base href="/servo/">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/style.css" />
    <title>SERVO</title>
    <link rel="stylesheet" href="fontawesome5/css/all.min.css" />
    <script src="dmxAppConnect/dmxFormatter/dmxFormatter.js" defer=""></script>
    <link rel="stylesheet" href="dmxAppConnect/dmxDropzone/dmxDropzone.css" />
    <script src="dmxAppConnect/dmxDropzone/dmxDropzone.js" defer=""></script>
    <link rel="stylesheet" href="dmxAppConnect/dmxValidator/dmxValidator.css" />
    <script src="dmxAppConnect/dmxValidator/dmxValidator.js" defer=""></script>
    <script src="dmxAppConnect/dmxBootstrap5PagingGenerator/dmxBootstrap5PagingGenerator.js" defer=""></script>
    <script src="dmxAppConnect/dmxBootstrap5Offcanvas/dmxBootstrap5Offcanvas.js" defer=""></script>
    <link rel="stylesheet" href="dmxAppConnect/dmxAnimateCSS/animate.min.css" />
    <script src="dmxAppConnect/dmxAnimateCSS/dmxAnimateCSS.js" defer=""></script>
    <link rel="stylesheet" href="dmxAppConnect/dmxDatePicker/daterangepicker.min.css" />
    <script src="dmxAppConnect/dmxDatePicker/daterangepicker.min.js" defer=""></script>
    <link rel="stylesheet" href="dmxAppConnect/dmxDatePicker/dmxDatePicker.css" />
    <script src="dmxAppConnect/dmxDatePicker/dmxDatePicker.js" defer=""></script>


    <script src="dmxAppConnect/dmxCharts/Chart.min.js" defer=""></script>
    <script src="dmxAppConnect/dmxCharts/dmxCharts.js" defer=""></script>
    <script src="dmxAppConnect/dmxBootbox/bootbox.all.min.js" defer></script>
    <script src="dmxAppConnect/dmxBootbox/dmxBootbox.js" defer></script>
    <script src="dmxAppConnect/dmxBootbox5/bootstrap-modbox.min.js" defer></script>
    <script src="dmxAppConnect/dmxBootbox5/dmxBootbox5.js" defer></script>
    <script src="https://maps.googleapis.com/maps/api/js?callback=Function.prototype"></script>
    <script src="dmxAppConnect/dmxGoogleMaps/dmxGoogleMaps.js" defer></script>
    <script src="dmxAppConnect/dmxGeolocation/dmxGeolocation.js" defer></script>
    <script src="dmxAppConnect/dmxBootstrap5Collapse/dmxBootstrap5Collapse.js" defer></script>

    <link rel="stylesheet" href="bootstrap/5/css/bootstrap.min.css" />

</head>

<body is="dmx-app" id="operators">
    <dmx-query-manager id="listAssets"></dmx-query-manager>

    <dmx-session-manager id="session_variables"></dmx-session-manager>

    <dmx-value id="lang" dmx-bind:value="browser1.language"></dmx-value>
    <dmx-json-datasource id="trans" is="dmx-serverconnect" url="assets/translation/translation.JSON"></dmx-json-datasource>

    <dmx-serverconnect id="list_assets" url="dmxConnect/api/servo_assets/list_assets_paged.php" dmx-param:offset="listAssets.data.asset_id" dmx-param:sort="listAssets.data.sort_assets" dmx-param:dir="listAssets.data.dir_assets" dmx-param:limit="asset_sort_limit.value" dmx-param:customerfname="assetownerfname.value" dmx-param:customerlname="assetownerlname.value" dmx-param:assetpermitnumber="assetownerpermitnumber.value"></dmx-serverconnect>
    <dmx-serverconnect id="list_assets_regular" url="dmxConnect/api/servo_assets/list_assets_regular.php" dmx-param:assetpermitnumber="assetownerpermitnumber.value"></dmx-serverconnect>
    <dmx-serverconnect id="companyInfo" url="dmxConnect/api/servo_company_information/read_company_information.php" dmx-param:company_info_id="1"></dmx-serverconnect>

    <div is="dmx-browser" id="browser1"></div>
    <dmx-notifications id="notifies1"></dmx-notifications>
    <?php include 'cc-header.php'; ?>
    <main id="createAsset">
        <div class="modal create-modal" id="createAssetModal" is="dmx-bs5-modal" tabindex="-1">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-body">{{trans.data.createProject[lang.value]}}</h5>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row ms-3 me-3">
                            <dmx-geolocation id="createAssetGeolocation"></dmx-geolocation>
                            <form id="createAssetForm" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_assets/create_asset.php" dmx-on:success="list_customer_assets.load({customer: read_customer.data.query_read_customer.customer_id}); createAssetModal.hide(); readItemModal.show()">
                                <div class="form-group mb-3 row">
                                    <label for="assetLat" class="col-sm-2 col-form-label">{{trans.data.latitude[lang.value]}}</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="assetLat" name="asset_lat" aria-describedby="input1_help" placeholder="Enter some text" readonly="true">

                                    </div>
                                    <label for="assetLat" class="col-sm-2 col-form-label">{{trans.data.longitude[lang.value]}}</label>
                                    <div class="col">

                                        <input type="text" class="form-control mt-2" id="assetLon" name="asset_long" aria-describedby="input1_help" placeholder="Enter some text" readonly="true">
                                    </div>
                                </div>
                                <input id="assetOwner" name="asset_owner" type="text" class="form-control visually-hidden" dmx-bind:value="read_customer.data.query_read_customer.customer_id">
                                <input id="userCreated" name="user_created" type="text" class="form-control visually-hidden" dmx-bind:value="list_user_info.data.query_list_user_info.user_id"><button id="geoLocateAsset" class="btn btn-info mb-2 ps-3 pe-3 w-25 text-white" dmx-on:click="createAssetGeolocation.getCurrentPosition();createAssetForm.assetLat.setValue(createAssetGeolocation.coords.latitude);createAssetForm.assetLon.setValue(createAssetGeolocation.coords.longitude);createAssetForm.createAssetMap.panTo(createAssetGeolocation.coords.latitude,createAssetGeolocation.coords.longitude);createAssetForm.createAssetMap.setZoom(18)"><i class="fas fa-map-marked-alt fa-2x"></i>
                                </button>
                                <button id="btn26" class="btn btn-success mb-2 ps-2 pe-2 w-25 text-white" type="submit">
                                    <i class="fas fa-check fa-2x"></i>
                                </button>
                                <div class="row">
                                    <div class="col mt-2">
                                        <dmx-google-maps id="createAssetMap" maptype="satellite" scale-control="true" fullscreen-control="true" zoom-control="true" streetview-control="true" maptype-control="true" scrollwheel="true" tilt="true" rotate-control="true" dmx-on:mapclick="createAssetForm.assetLat.setValue($event.latitude);createAssetForm.assetLon.setValue($event.longitude);createAssetForm.createAssetMap.panTo($event.latitude,$event.longitude)">
                                            <dmx-google-maps-marker id="createAssetMarker" dmx-bind:longitude="createAssetForm.assetLon.value" dmx-bind:latitude="createAssetForm.assetLat.value"></dmx-google-maps-marker>


                                        </dmx-google-maps>
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
    </main>
    <main class="mt-4">
        <div class="ms-3 me-3">




            <div class="row servo-page-header">
                <div class="col-auto" dmx-animate-enter="slideInLeft">
                    <i class="fas fa-map-marked-alt fa-2x" style=""></i>
                </div>
                <div class="col-auto page-heading">
                    <h4 class="servo-page-heading">{{trans.data.projects[lang.value]}}</h4>
                </div>
                <div class="col style13 page-button" id="pagebuttons">
                    <button id="btn1" class="btn style12 fw-light add-button btn-info text-white" data-bs-toggle="modal" data-bs-target="#createItemModal" style="float: right;"><i class="fas fa-plus style14 fa-lg"></i>
                    </button>

                </div>
            </div>
            <div class="row">
                <div class="col">
                    <ul class="nav nav-tabs" id="navTabs1_tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="navTabs1_1_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_1" role="tab" aria-controls="navTabs1_1" aria-selected="true">{{trans.data.projects[lang.value]}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="navTabs1_2_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_2" role="tab" aria-controls="navTabs1_2" aria-selected="false">GeoView</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="navTabs1_3_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_3" role="tab" aria-controls="navTabs1_3" aria-selected="false">#</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="navTabs1_content">
                        <div class="tab-pane fade show active" id="navTabs1_1" role="tabpanel">
                            <div class="row justify-content-sm-between justify-content-md-between justify-content-lg-between justify-content-xl-between justify-content-xxl-between justify-content-between sorter mt-2 mb-2 ms-0 me-0 shadow-none bg-secondary">
                                <div class="col-xxl col-auto d-flex flex-wrap col-xl-7 col-sm-12 col-md-11 col-lg-8 col-xxl-7 col-12"><input id="assetownerfname" name="assetownerfname" type="text" class="form-control search form-control-sm mb-2 me-2" dmx-bind:placeholder="trans.data.name[lang.value]+'  '" style="">
                                    <input id="assetownerlname" name="assetownerlname" type="text" class="form-control search form-control-sm ms-lg-2 mb-2 me-2" dmx-bind:placeholder="trans.data.surname[lang.value]+'  '">
                                    <input id="assetownerpermitnumber" name="assetownerpermitnumber" type="text" class="form-control search form-control-sm ms-lg-2 mb-2 me-2" dmx-bind:placeholder="trans.data.permitNumber[lang.value]+'  '"><button id="btn29" class="btn align-self-lg-start btn-outline-secondary btn-sm text-body bg-light" dmx-on:click="customerfilter.setValue(NULL); customerfilter2.setValue(NULL)">
                                        <i class="fas fa-backspace"></i>
                                    </button>
                                </div>

                                <div class="d-flex flex-sm-wrap col-md-5 justify-content-lg-end justify-content-xl-end justify-content-xxl-end col-auto flex-wrap col-sm-auto col-lg-auto col-xl-auto">
                                    <ul class="pagination" dmx-populate="list_assets.data.list_assets_paged" dmx-state="listAssets" dmx-offset="asset_id" dmx-generator="bs5paging">
                                        <li class="page-item" dmx-class:disabled="list_assets.data.list_assets_paged.page.current == 1" aria-label="First">
                                            <a href="javascript:void(0)" class="page-link" dmx-on:click="listAssets.set('asset_id',list_assets.data.list_assets_paged.page.offset.first)"><span aria-hidden="true">&lsaquo;&lsaquo;</span></a>
                                        </li>
                                        <li class="page-item" dmx-class:disabled="list_assets.data.list_assets_paged.page.current == 1" aria-label="Previous">
                                            <a href="javascript:void(0)" class="page-link" dmx-on:click="listAssets.set('asset_id',list_assets.data.list_assets_paged.page.offset.prev)"><span aria-hidden="true">&lsaquo;</span></a>
                                        </li>
                                        <li class="page-item" dmx-class:active="title == list_assets.data.list_assets_paged.page.current" dmx-class:disabled="!active" dmx-repeat="list_assets.data.list_assets_paged.getServerConnectPagination(2,1,'...')">
                                            <a href="javascript:void(0)" class="page-link" dmx-on:click="listAssets.set('asset_id',(page-1)*list_assets.data.list_assets_paged.limit)">{{title}}</a>
                                        </li>
                                        <li class="page-item" dmx-class:disabled="list_assets.data.list_assets_paged.page.current ==  list_assets.data.list_assets_paged.page.total" aria-label="Next">
                                            <a href="javascript:void(0)" class="page-link" dmx-on:click="listAssets.set('asset_id',list_assets.data.list_assets_paged.page.offset.next)"><span aria-hidden="true">&rsaquo;</span></a>
                                        </li>
                                        <li class="page-item" dmx-class:disabled="list_assets.data.list_assets_paged.page.current ==  list_assets.data.list_assets_paged.page.total" aria-label="Last">
                                            <a href="javascript:void(0)" class="page-link" dmx-on:click="listAssets.set('asset_id',list_assets.data.list_assets_paged.page.offset.last)"><span aria-hidden="true">&rsaquo;&rsaquo;</span></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-xl-1 col-md-2 col-sm-2 col-3 col-lg col-lg-1"><select id="asset_sort_limit" class="form-select" name="asset_sort_limit">
                                        <option value="5">5</option>
                                        <option selected="" value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                        <option value="'250">250</option>
                                        <option value="500">500</option>
                                    </select></div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-sm">
                                            <thead>
                                                <tr>
                                                    <th class="sorting" dmx-on:click="listAssets.set('sort_assets','asset_id');listAssets.set('dir_assets',listAssets.data.dir_assets == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="listAssets.data.sort_assets=='asset_id' && listAssets.data.dir_assets == 'asc'" dmx-class:sorting_desc="listAssets.data.sort_assets=='asset_id' && listAssets.data.dir_assets == 'desc'">#</th>
                                                    <th class="sorting" dmx-on:click="listAssets.set('sort_assets','customer_first_name');listAssets.set('dir_assets',listAssets.data.dir_assets == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="listAssets.data.sort_assets=='customer_first_name' && listAssets.data.dir_assets == 'asc'" dmx-class:sorting_desc="listAssets.data.sort_assets=='customer_first_name' && listAssets.data.dir_assets == 'desc'">{{trans.data.name[lang.value]}}</th>
                                                    <th class="sorting" dmx-on:click="listAssets.set('sort_assets','customer_last_name');listAssets.set('dir_assets',listAssets.data.dir_assets == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="listAssets.data.sort_assets=='customer_last_name' && listAssets.data.dir_assets == 'asc'" dmx-class:sorting_desc="listAssets.data.sort_assets=='customer_last_name' && listAssets.data.dir_assets == 'desc'">{{trans.data.surname[lang.value]}}</th>
                                                    <th class="sorting" dmx-on:click="listAssets.set('sort_assets','date_created');listAssets.set('dir_assets',listAssets.data.dir_assets == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="listAssets.data.sort_assets=='date_created' && listAssets.data.dir_assets == 'asc'" dmx-class:sorting_desc="listAssets.data.sort_assets=='date_created' && listAssets.data.dir_assets == 'desc'">{{trans.data.dateTime[lang.value]}}</th>
                                                    <th class="sorting" dmx-on:click="listAssets.set('sort_assets','title_deed_number');listAssets.set('dir_assets',listAssets.data.dir_assets == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="listAssets.data.sort_assets=='title_deed_number' && listAssets.data.dir_assets == 'asc'" dmx-class:sorting_desc="listAssets.data.sort_assets=='title_deed_number' && listAssets.data.dir_assets == 'desc'">{{trans.data.titleDeedNumber[lang.value]}}</th>
                                                    <th class="sorting" dmx-on:click="listAssets.set('sort_assets','permit_number');listAssets.set('dir_assets',listAssets.data.dir_assets == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="listAssets.data.sort_assets=='permit_number' && listAssets.data.dir_assets == 'asc'" dmx-class:sorting_desc="listAssets.data.sort_assets=='permit_number' && listAssets.data.dir_assets == 'desc'">{{trans.data.permitNumber[lang.value]}}</th>
                                                    <th class="sorting" dmx-on:click="listAssets.set('sort_assets','user_username');listAssets.set('dir_assets',listAssets.data.dir_assets == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="listAssets.data.sort_assets=='user_username' && listAssets.data.dir_assets == 'asc'" dmx-class:sorting_desc="listAssets.data.sort_assets=='user_username' && listAssets.data.dir_assets == 'desc'">{{trans.data.user[lang.value]}}</th>
                                                    <th class="sorting" dmx-on:click="listAssets.set('sort_assets','project_alert_status');listAssets.set('dir_assets',listAssets.data.dir_assets == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="listAssets.data.sort_assets=='project_alert_status' && listAssets.data.dir_assets == 'asc'" dmx-class:sorting_desc="listAssets.data.sort_assets=='project_alert_status' && listAssets.data.dir_assets == 'desc'">{{trans.data.projectAlertStatus[lang.value]}}</th>
                                                    <th class="sorting" dmx-on:click="listAssets.set('sort_assets','construction_type');listAssets.set('dir_assets',listAssets.data.dir_assets == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="listAssets.data.sort_assets=='construction_type' && listAssets.data.dir_assets == 'asc'" dmx-class:sorting_desc="listAssets.data.sort_assets=='construction_type' && listAssets.data.dir_assets == 'desc'">{{trans.data.constructionType[lang.value]}}</th>
                                                    <th class="sorting" dmx-on:click="listAssets.set('sort_assets','district');listAssets.set('dir_assets',listAssets.data.dir_assets == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="listAssets.data.sort_assets=='district' && listAssets.data.dir_assets == 'asc'" dmx-class:sorting_desc="listAssets.data.sort_assets=='district' && listAssets.data.dir_assets == 'desc'">{{trans.data.district[lang.value]}}</th>
                                                    <th class="sorting" dmx-on:click="listAssets.set('sort_assets','neighborhood');listAssets.set('dir_assets',listAssets.data.dir_assets == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="listAssets.data.sort_assets=='neighborhood' && listAssets.data.dir_assets == 'asc'" dmx-class:sorting_desc="listAssets.data.sort_assets=='neighborhood' && listAssets.data.dir_assets == 'desc'">{{trans.data.neighborhood[lang.value]}}</th>
                                                    <th class="sorting" dmx-on:click="listAssets.set('sort_assets','project_purpose');listAssets.set('dir_assets',listAssets.data.dir_assets == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="listAssets.data.sort_assets=='project_purpose' && listAssets.data.dir_assets == 'asc'" dmx-class:sorting_desc="listAssets.data.sort_assets=='project_purpose' && listAssets.data.dir_assets == 'desc'">{{trans.data.projectPurpose[lang.value]}}</th>
                                                    <th class="sorting" dmx-on:click="listAssets.set('sort_assets','payment_status');listAssets.set('dir_assets',listAssets.data.dir_assets == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="listAssets.data.sort_assets=='payment_status' && listAssets.data.dir_assets == 'asc'" dmx-class:sorting_desc="listAssets.data.sort_assets=='payment_status' && listAssets.data.dir_assets == 'desc'">{{trans.data.paymentStatus[lang.value]}}</th>
                                                    <th class="sorting" dmx-on:click="listAssets.set('sort_assets','id_card_number');listAssets.set('dir_assets',listAssets.data.dir_assets == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="listAssets.data.sort_assets=='id_card_number' && listAssets.data.dir_assets == 'asc'" dmx-class:sorting_desc="listAssets.data.sort_assets=='id_card_number' && listAssets.data.dir_assets == 'desc'">{{trans.data.idCardNumber[lang.value]}}</th>
                                                    <th dmx-on:click="listAssets.set('sort_assets','id_card_number');listAssets.set('dir_assets',listAssets.data.dir_assets == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="listAssets.data.sort_assets=='id_card_number' &amp;&amp; listAssets.data.dir_assets == 'asc'" dmx-class:sorting_desc="listAssets.data.sort_assets=='id_card_number' &amp;&amp; listAssets.data.dir_assets == 'desc'"></th>
                                                </tr>
                                            </thead>
                                            <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_assets.data.list_assets_paged.data" id="tableRepeat2" dmx-state="listAssets" dmx-sort="sort_assets" dmx-order="dir_assets">
                                                <tr>
                                                    <td dmx-text="asset_id"></td>
                                                    <td dmx-text="customer_first_name"></td>
                                                    <td dmx-text="customer_last_name"></td>
                                                    <td dmx-text="date_created"></td>
                                                    <td dmx-text="title_deed_number"></td>
                                                    <td dmx-text="permit_number"></td>
                                                    <td dmx-text="user_username"></td>
                                                    <td dmx-text="project_alert_status"></td>
                                                    <td dmx-text="construction_type"></td>
                                                    <td dmx-text="district"></td>
                                                    <td dmx-text="neighborhood"></td>
                                                    <td dmx-text="project_purpose"></td>
                                                    <td dmx-text="payment_status"></td>
                                                    <td dmx-text="id_card_number"></td>
                                                    <td class="text-center">
                                                        <a href="" dmx-bind:href="'cc-asset-dash.php?asset='+asset_id"><button id="btn2" class="btn text-body" dmx-bind:value="asset_id" dmx-on:click=""><i class="far fa-edit"></i>
                                                            </button></a>

                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="navTabs1_2" role="tabpanel">
                            <div class="row">
                                <div class="col mt-2">
                                    <dmx-google-maps id="ccProjects" zoom="12" dmx-bind:markers="list_assets_regular.data.list_assets_regular" marker-id="asset_id" marker-latitude="asset_lat" marker-longitude="asset_long" marker-type="construction_type" scrollwheel="true" rotate-control="true" tilt="true" scale-control="true" fullscreen-control="true" zoom-control="true" maptype-control="true" maptype="satellite" dmx-bind:latitude="4.061536" dmx-bind:longitude="9.786072" height="600" dmx-on:markerclick="ccProjects.showInfo($event.id);ccProjects.panToMarker($event.id)" marker-title="permit_number" marker-info="permit_number+construction_type+customer_first_name+asset_lat+asset_long+asset_id" marker-image="'uploads/map-markers/'+project_alert_status+'.png'">
                                    </dmx-google-maps>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="navTabs1_3" role="tabpanel">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
    <script src="bootstrap/5/js/bootstrap.min.js"></script>
</body>

</html>