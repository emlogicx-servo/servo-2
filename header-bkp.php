<head>
    <script src="dmxAppConnect/dmxAppConnect.js"></script>
    <script src="js/jquery-3.5.1.slim.min.js"></script>


    <script src="dmxAppConnect/dmxBootstrap5Navigation/dmxBootstrap5Navigation.js" defer></script>

    <link rel="stylesheet" href="dmxAppConnect/dmxAnimateCSS/animate.min.css" />



    <script src="dmxAppConnect/dmxAnimateCSS/dmxAnimateCSS.js" defer></script>

    <link rel="stylesheet" href="dmxAppConnect/dmxBootstrap5TableGenerator/dmxBootstrap5TableGenerator.css" />

    <script src="dmxAppConnect/dmxBootbox5/bootstrap-modbox.min.js" defer></script>

    <script src="dmxAppConnect/dmxBootbox5/dmxBootbox5.js" defer></script>

    <link rel="stylesheet" href="dmxAppConnect/dmxPreloader/dmxPreloader.css" />

    <script src="dmxAppConnect/dmxPreloader/dmxPreloader.js" defer></script>

    <link rel="stylesheet" href="dmxAppConnect/dmxValidator/dmxValidator.css" />

    <script src="dmxAppConnect/dmxValidator/dmxValidator.js" defer></script>

    <script src="dmxAppConnect/dmxCharts/Chart.min.js" defer></script>

    <script src="dmxAppConnect/dmxCharts/dmxCharts.js" defer></script>

    <script src="dmxAppConnect/dmxBootstrap5Collapse/dmxBootstrap5Collapse.js" defer></script>






    <link rel="stylesheet" href="fontawesome5/css/all.min.css" />


    <script src="dmxAppConnect/dmxBrowser/dmxBrowser.js" defer></script>

    <link rel="stylesheet" href="dmxAppConnect/dmxNotifications/dmxNotifications.css" />

    <script src="dmxAppConnect/dmxNotifications/dmxNotifications.js" defer></script>

    <script src="dmxAppConnect/dmxScheduler/dmxScheduler.js" defer></script>

    <script src="dmxAppConnect/dmxStateManagement/dmxStateManagement.js" defer></script>

    <script src="dmxAppConnect/dmxBootstrap5Modal/dmxBootstrap5Modal.js" defer></script>

    <script src="dmxAppConnect/dmxBootstrap5Offcanvas/dmxBootstrap5Offcanvas.js" defer></script>


    <script src="dmxAppConnect/dmxFormatter/dmxFormatter.js" defer></script>

    <link rel="stylesheet" href="bootstrap/5/darkly/bootstrap.min.css" />



    <dmx-value id="currentUser" dmx-bind:value="list_user_info.data.query_list_user_info.user_id"></dmx-value>

    <dmx-datetime id="dateTime"></dmx-datetime>
    <div is="dmx-browser" id="browser1"></div>
    <dmx-serverconnect id="logout1" url="dmxConnect/api/servo_users/user_logout.php" noload dmx-on:success="browser1.goto('login.php')"></dmx-serverconnect>
    <meta name="ac:base" content="/servo">
    <base href="/servo/">

    <title></title>

    <dmx-notifications id="notifies1" position="bottom" timeout="100" extended-timeout="100"></dmx-notifications>
    <dmx-scheduler id="scheduler1" dmx-on:tick="" delay="2"></dmx-scheduler>
    <link rel="stylesheet" href="/servo/line-awesome-1.3.0/1.3.0/css/line-awesome.min.css">
    <main>
        <div class="modal" id="shiftSelectModal" is="dmx-bs5-modal" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{trans.data.shifts[lang.value]}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th>Shift</th>
                                        <th>Shift start</th>
                                        <th>Shift stop</th>
                                        <th>Shift status</th>
                                        <th>Shift status</th>
                                    </tr>
                                </thead>
                                <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_shifts.data.query_list_shifts" id="tableRepeat1">
                                    <tr>
                                        <td dmx-text="shift_id"></td>
                                        <td dmx-text="shift_start"></td>
                                        <td dmx-text="shift_stop"></td>
                                        <td dmx-text="shift_status"></td>
                                        <td>
                                            <button id="btn6" class="btn btn-outline-secondary" dmx-on:click="session_variables.set('current_shift', shift_id); shiftSelectModal.hide()">
                                                <i class="far fa-eye fa-lg fa-rotate-180"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
    </main>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css" />

    <link rel="apple-touch-icon" sizes="180x180" href="siteicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="siteicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="siteicons/favicon-16x16.png">
    <link rel="manifest" href="siteicons/site.webmanifest">
    <link rel="mask-icon" href="siteicons/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
</head>

<body is="dmx-app" id="servoheader">

    <dmx-value id="lang" dmx-bind:value="browser1.language"></dmx-value>
    <dmx-json-datasource id="trans" is="dmx-serverconnect" url="assets/translation/translation.JSON"></dmx-json-datasource>

    <dmx-session-manager id="session_variables"></dmx-session-manager>
    <dmx-serverconnect id="list_user_shift_info" url="dmxConnect/api/servo_user_shifts/list_user_shift_info.php" dmx-param:shift_id="session_variables.data.current_shift" dmx-param:user_id="session_variables.data.user_id"></dmx-serverconnect>
    <dmx-serverconnect id="companyInfo" url="dmxConnect/api/servo_company_information/read_company_information.php" dmx-param:id="id" dmx-param:item_id="" dmx-param:user_id="" dmx-param:customer_id="session_variables.data.current_customer" dmx-param:offset="listCustomerOrders.data.offset" dmx-param:limit="c_order_sort_limit.value" dmx-param:company_info_id="1"></dmx-serverconnect>
    <dmx-serverconnect id="list_user_info" url="dmxConnect/api/servo_user_shifts/list_user_info.php" dmx-param:shift_id="session_variables.data.current_shift" dmx-param:user_id="session_variables.data.user_id"></dmx-serverconnect>
    <dmx-serverconnect id="list_shifts" url="dmxConnect/api/servo_shifts/list_shifts.php" dmx-param:shift_id="session_variables.data.current_shift" dmx-param:user_id="session_variables.data.user_id" noload></dmx-serverconnect>
    <dmx-serverconnect id="profile_privileges" url="dmxConnect/api/servo_profile_settings/profile_privileges.php" dmx-param:shift_id="session_variables.data.current_shift" dmx-param:user_id="session_variables.data.user_id" dmx-param:profile="list_user_info.data.query_list_user_info.user_profile"></dmx-serverconnect>
    <dmx-serverconnect id="load_users" url="dmxConnect/api/servo_users/list_users_for_filter.php"></dmx-serverconnect>
    <dmx-session-manager id="session1"></dmx-session-manager>
    <div class="offcanvas offcanvas-start bg-dark opacity-100" id="offcanvas1" is="dmx-bs5-offcanvas" tabindex="-1" style="width: 180px !important; opacity: 0.85 !important;">
        <div class="offcanvas-body" style="oveflow-y: hidden;">
            <div class="row row-cols-1 h-auto">
                <div class="col" id="shifts">
                    <div class="row">
                        <div class="col w-auto h-auto mt-sm-1 mb-sm-2 ms-sm-1 me-sm-1 d-flex justify-content-sm-center justify-content-center mt-2 mb-2 ms-2 me-2 border-secondary rounded-2"><a href="shifts.php" class="badge style25 w-auto h-auto" style="text-decoration: unset;"><i class="fas fa-user-clock fa-2x" style="color: #ff9518 !important;"></i>
                                <h5 class="mt-lg-3">{{trans.data.shifts[lang.value]}}</h5>
                            </a></div>
                    </div>
                </div>
                <div class="col" id="clients">
                    <div class="row">
                        <div class="col w-auto h-auto mt-sm-1 mb-sm-2 ms-sm-1 me-sm-1 d-flex justify-content-sm-center justify-content-center mt-2 mb-2 ms-2 me-2 border-secondary rounded-2"><a href="customers.php" class="badge style25 w-auto h-auto" style="text-decoration: unset;"><i class="fas fa-users fa-2x" style="color: #afff18 !important;"></i>
                                <h5 class="mt-lg-3">{{trans.data.customers[lang.value]}}</h5>
                            </a></div>
                    </div>
                </div>
                <div class="col" id="vendors">
                    <div class="row">
                        <div class="col w-auto h-auto mt-sm-1 mb-sm-2 ms-sm-1 me-sm-1 d-flex justify-content-sm-center justify-content-center mt-2 mb-2 ms-2 me-2 border-secondary rounded-2"><a href="vendors.php" class="badge style25 w-auto h-auto" style="text-decoration: unset;"><i class="fas fa-truck fa-2x" style="color: #18f7ff !important;"></i>
                                <h5 class="mt-lg-3">{{trans.data.vendors[lang.value]}}</h5>
                            </a></div>
                    </div>
                </div>
                <div class="col" id="procurement">
                    <div class="row">
                        <div class="col w-auto h-auto mt-sm-1 mb-sm-2 ms-sm-1 me-sm-1 d-flex justify-content-sm-center justify-content-center mt-2 mb-2 ms-2 me-2 border-secondary rounded-2"><a href="procurement.php" class="badge style25 w-auto h-auto" style="text-decoration: unset;"><i class="fas fa-cart-plus fa-2x" style="color: #ff18c3 !important;"></i>
                                <h5 class="mt-lg-3">{{trans.data.procurement[lang.value]}}</h5>
                            </a></div>
                    </div>
                </div>
                <div class="col" id="reports">
                    <div class="row">
                        <div class="col w-auto h-auto mt-sm-1 mb-sm-2 ms-sm-1 me-sm-1 d-flex justify-content-sm-center justify-content-center mt-2 mb-2 ms-2 me-2 border-secondary rounded-2"><a href="reports.php" class="badge style25 w-auto h-auto" style="text-decoration: unset;"><i class="fas fa-chart-line fa-2x" style="color: #18f7ff !important;"></i>
                                <h5 class="mt-lg-3">{{trans.data.reports[lang.value]}}</h5>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col" id="products">
                    <div class="row">
                        <div class="col w-auto h-auto mt-sm-1 mb-sm-2 ms-sm-1 me-sm-1 d-flex justify-content-sm-center justify-content-center mt-2 mb-2 ms-2 me-2 border-secondary rounded-2"><a href="products.php" class="badge style25 w-auto h-auto" style="text-decoration: unset;"><i class="fas fa-barcode fa-2x" style="color: #fffa18 !important;"></i>
                                <h5 class="mt-lg-3">{{trans.data.products[lang.value]}}</h5>
                            </a></div>
                    </div>
                </div>

                <div class="col" id="categories">
                    <div class="row">
                        <div class="col w-auto h-auto mt-sm-1 mb-sm-2 ms-sm-1 me-sm-1 d-flex justify-content-sm-center justify-content-center mt-2 mb-2 ms-2 me-2 border-secondary rounded-2"><a href="product-categories.php" class="badge style25 w-auto h-auto" style="text-decoration: unset;"><i class="fas fa-tags fa-2x" style="color: #ff9518 !important;"></i>
                                <h5 class="mt-lg-3">{{trans.data.categories[lang.value]}}</h5>
                            </a></div>
                    </div>
                </div>





                <div class="col" id="brands">
                    <div class="row">
                        <div class="col w-auto h-auto mt-sm-1 mb-sm-2 ms-sm-1 me-sm-1 d-flex justify-content-sm-center justify-content-center mt-2 mb-2 ms-2 me-2 border-secondary rounded-2"><a href="brands.php" class="badge style25 w-auto h-auto" style="text-decoration: unset;"><i class="fas fa-tag fa-2x" style="color: #fffa18 !important;"></i>
                                <h5 class="mt-lg-3">{{trans.data.brands[lang.value]}}</h5>
                            </a></div>
                    </div>
                </div>
                <div class="col" id="departments">
                    <div class="row">
                        <div class="col w-auto h-auto mt-sm-1 mb-sm-2 ms-sm-1 me-sm-1 d-flex justify-content-sm-center justify-content-center mt-2 mb-2 ms-2 me-2 border-secondary rounded-2"><a href="departments.php" class="badge style25 w-auto h-auto" style="text-decoration: unset;"><i class="fas fa-sitemap fa-2x" style="color: #18ff92 !important;"></i>
                                <h5 class="mt-lg-3">{{trans.data.businessSetup[lang.value]}}</h5>
                            </a></div>
                    </div>
                </div>

                <div class="col" id="paymentMethods">
                    <div class="row">
                        <div class="col w-auto h-auto mt-sm-1 mb-sm-2 ms-sm-1 me-sm-1 d-flex justify-content-sm-center justify-content-center mt-2 mb-2 ms-2 me-2 border-secondary rounded-2"><a href="payment-methods.php" class="badge style25 w-auto h-auto" style="text-decoration: unset;"><i class="fas fa-cash-register fa-2x" style="color: #ff1847 !important;"></i>
                                <h5 class="mt-lg-3">{{trans.data.payments[lang.value]}}</h5>
                            </a></div>
                    </div>
                </div>


                <div class="col" id="salesPoints">
                    <div class="row">
                        <div class="col w-auto h-auto mt-sm-1 mb-sm-2 ms-sm-1 me-sm-1 d-flex justify-content-sm-center justify-content-center mt-2 mb-2 ms-2 me-2 border-secondary rounded-2"><a href="sales-points.php" class="badge style25 w-auto h-auto" style="text-decoration: unset;"><i class="fas fa-store fa-2x" style="color: #fffa18 !important;"></i>
                                <h5 class="mt-lg-3">{{trans.data.salesPoints[lang.value]}}</h5>
                            </a></div>
                    </div>
                </div>
                <div class="col" id="assets">
                    <div class="row">
                        <div class="col w-auto h-auto mt-sm-1 mb-sm-2 ms-sm-1 me-sm-1 d-flex justify-content-sm-center justify-content-center mt-2 mb-2 ms-2 me-2 border-secondary rounded-2"><a href="tables.php" class="badge style25 w-auto h-auto" style="text-decoration: unset;"><i class="fas fa-key fa-2x" style="color: #afff18 !important;"></i>
                                <h5 class="mt-lg-3">{{trans.data.assets[lang.value]}}</h5>
                            </a></div>
                    </div>
                </div>
                <div class="col" id="users">
                    <div class="row">
                        <div class="col w-auto h-auto mt-sm-1 mb-sm-2 ms-sm-1 me-sm-1 d-flex justify-content-sm-center justify-content-center mt-2 mb-2 ms-2 me-2 border-secondary rounded-2">
                            <a href="users.php" class="badge style25 w-auto h-auto" style="text-decoration: unset;"><i class="fas fa-users fa-2x" style="color: #ffcd74 !important;"></i>
                                <h5 class="mt-lg-3">{{trans.data.users[lang.value]}}</h5>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col" id="profiles">
                    <div class="row">
                        <div class="col w-auto h-auto mt-sm-1 mb-sm-2 ms-sm-1 me-sm-1 d-flex justify-content-sm-center justify-content-center mt-2 mb-2 ms-2 me-2 border-secondary rounded-2"><a href="user-profiles.php" class="badge style25 w-auto h-auto" style="text-decoration: unset;"><i class="fas fa-id-badge fa-2x" style="color: #189aff !important;"></i>
                                <h5 class="mt-lg-3" style="">{{trans.data.profiles[lang.value]}}</h5>
                            </a></div>
                    </div>
                </div>
                <div class="col" id="dataFields">
                    <div class="row">
                        <div class="col w-auto h-auto mt-sm-1 mb-sm-2 ms-sm-1 me-sm-1 d-flex justify-content-sm-center justify-content-center mt-2 mb-2 ms-2 me-2 border-secondary rounded-2"><a href="data-fields.php" class="badge style25 w-auto h-auto" style="text-decoration: unset;"><i class="fas fa-database fa-2x" style="color: #ff18f2 !important;"></i>
                                <h5 class="mt-lg-3" style="">{{trans.data.dataFields[lang.value]}}</h5>
                            </a></div>
                    </div>
                </div>
                <div class="col" id="companyInformation">
                    <div class="row">
                        <div class="col w-auto h-auto mt-sm-1 mb-sm-2 ms-sm-1 me-sm-1 d-flex justify-content-sm-center justify-content-center mt-2 mb-2 ms-2 me-2 border-secondary rounded-2"><a href="company-info.php" class="badge style25 w-auto h-auto" style="text-decoration: unset;"><i class="fas fa-info-circle fa-2x" style="color: #ff1847 !important;"></i>
                                <h5 class="mt-lg-3">{{trans.data.companyInformation[lang.value]}}</h5>
                            </a></div>
                    </div>
                </div>
                <div class="col" id="permissions">
                    <div class="row">
                        <div class="col w-auto h-auto mt-sm-1 mb-sm-2 ms-sm-1 me-sm-1 d-flex justify-content-sm-center justify-content-center mt-2 mb-2 ms-2 me-2 border-secondary rounded-2"><a href="configuration.php" class="badge style25 w-auto h-auto" style="text-decoration: unset;"><i class="fas fa-user-cog fa-2x" style="color: #18ffef !important;"></i>
                                <h5 class="mt-lg-3">{{trans.data.userPrivileges[lang.value]}}</h5>
                            </a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <main>
        <div class="row row-cols-6 justify-content-xl-between justify-content-between mt-2 mb-2 me-0 ps-0 pe-1">

            <div class="justify-content-lg-start col d-flex justify-content-start">

                <div class="d-block"><button id="btn1" class="btn gy-0 btn-sm text-start text-primary" data-bs-toggle="offcanvas" data-bs-target="#offcanvas1" dmx-show="(list_user_info.data.query_list_user_info.user_profile == 'Admin')" style="color: #afff18 !important;"><i class="fas fa-th fa-2x" style="color: ;"></i></button></div>
                <div class="d-block">

                    <h3 class="ms-0 d-none d-sm-block text-light" style="/* font-size: 35px */">SERVO</h3>
                </div>
            </div>

            <div class="border-secondary col-auto d-flex justify-content-end rounded-3 rounded-pill bg-dark" id="headerbuttons" style="/* font-size: 16px !important */">

                <button id="btn3" class="btn btn-sm text-light" style="/* color: #afff18 !important */" dmx-on:click="browser1.goto(list_user_info.data.query_list_user_info.user_profile+'.php')"><i class="fas fa-house-user fa-lg"></i></button>
                <button id="btn2" class="btn text-white-50 me-1 btn-lg" dmx-on:click="browser1.goto(session_variables.data.user_profile+'.php')" style="/* color: #afff18 !important */">{{session_variables.data.current_user}}</button>
                <button id="btn7" class="btn btn-sm text-light" style="/* color: #afff18 !important */" data-bs-toggle="modal" data-bs-target="#shiftSelectModal" dmx-bind:disabled="(list_user_info.data.query_list_user_info.user_profile !== 'Admin')" dmx-on:click="list_shifts.load({})"><i class="fas fa-hourglass-half fa-lg"></i></button>
                <button id="btn4" class="btn btn-sm me-2" dmx-on:click="logout1.load();notifies1.warning('&quot;Logging Out&quot;');session_variables.removeAll();session1.removeAll()" style="color: #189aff !important;"><i class="fa fa-power-off fa-lg"></i></button><i href="{{session_variables.data.user_profile+'.php'}}"></i>

            </div>
        </div>
    </main>
    <script src="bootstrap/4/js/bootstrap.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA5oFvvlozu_WJis78Bq6da8kqlfFGOcDI&libraries=places"></script>
    <script src="qr/qrcode.min.js" type="text/javascript"></script>
</body>