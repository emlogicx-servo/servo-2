<body is="dmx-app" id="header">
<link rel="stylesheet" href="css/bootstrap-icons.css" />  


<dmx-cookie-manager id="cookies"></dmx-cookie-manager>
<dmx-value id="theme" dmx-bind:value="cookies.servotheme"></dmx-value>
  <div is="dmx-browser" id="browser1"></div>
  <dmx-value id="lang" dmx-bind:value="browser1.language"></dmx-value>
  <dmx-json-datasource id="trans" is="dmx-serverconnect" url="assets/translation/translation.JSON"></dmx-json-datasource>

  <dmx-datetime id="dateTime"></dmx-datetime>

  <dmx-session-manager id="session_variables"></dmx-session-manager>
  <dmx-serverconnect id="list_user_shift_info" url="dmxConnect/api/servo_user_shifts/list_user_shift_info.php" dmx-param:shift_id="session_variables.data.current_shift" dmx-param:user_id="session_variables.data.user_id"></dmx-serverconnect>
  <dmx-serverconnect id="companyInfo" url="dmxConnect/api/servo_company_information/read_company_information.php" dmx-param:id="id" dmx-param:item_id="" dmx-param:user_id="" dmx-param:customer_id="session_variables.data.current_customer" dmx-param:offset="listCustomerOrders.data.offset" dmx-param:limit="c_order_sort_limit.value" dmx-param:company_info_id="1"></dmx-serverconnect>
  <dmx-serverconnect id="list_user_info" url="dmxConnect/api/servo_user_shifts/list_user_info.php" dmx-param:shift_id="session_variables.data.current_shift" dmx-param:user_id="session_variables.data.user_id"></dmx-serverconnect>
  <dmx-serverconnect id="list_shifts" url="dmxConnect/api/servo_shifts/list_shifts.php" dmx-param:shift_id="session_variables.data.current_shift" dmx-param:user_id="session_variables.data.user_id" noload></dmx-serverconnect>
  <dmx-serverconnect id="profile_privileges" url="dmxConnect/api/servo_profile_settings/profile_privileges.php" dmx-param:shift_id="session_variables.data.current_shift" dmx-param:user_id="session_variables.data.user_id" dmx-param:profile="list_user_info.data.query_list_user_info.user_profile"></dmx-serverconnect>
  <dmx-serverconnect id="load_users" url="dmxConnect/api/servo_users/list_users_for_filter.php"></dmx-serverconnect>
  <dmx-serverconnect id="load_currencies" url="dmxConnect/api/servo_currencies/load_currencies.php"></dmx-serverconnect>
  <dmx-serverconnect id="load_payment_methods" url="dmxConnect/api/servo_payment_methods/list_payment_methods.php"></dmx-serverconnect>
  <dmx-serverconnect id="logout1" url="dmxConnect/api/servo_users/user_logout.php"></dmx-serverconnect>


  <dmx-session-manager id="session1"></dmx-session-manager>
  <div class="modal" id="shiftSelectModal" is="dmx-bs5-modal" tabindex="-1">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-light">
          <h5 class="modal-title">{{trans.data.shifts[lang.value]}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body bg-light">
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
                    <button id="btn6" class="btn btn-outline-body" dmx-on:click="session_variables.set('current_shift', shift_id);read_shift({shift_id:shift_id}); shiftSelectModal.hide()">
                      <i class="far fa-eye fa-lg fa-rotate-180"></i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer bg-light">
        </div>
      </div>
    </div>
  </div>

  <main>
    <div id="top-bar" class="row row-cols-12 justify-content-xl-between justify-content-between mt-2 me-0 ps-0 pe-1 bg-light rounded shadow-sm">

      <div class="justify-content-lg-start col-8 justify-content-start my-auto" style="padding-left: 10px;">

        <button id="btn1" class="btn gy-0 btn-sm text-start" dmx-on:click="offcanvas1.toggle()" dmx-show="(list_user_info.data.query_list_user_info.user_profile == 'Admin')" style="margin-left: 2px !important; font-size:17px; "><i class="fas fa-th fa-1.5x" style="" dmx-animate-enter="pulse"></i></button>
        <span class="" style="font-family:'Josefin-Sans'; margin-left: 5px; font-size:15px;">SERVO</span>
           <span class="fw-bold text-success" style="font-family:'Josefin-Sans'; margin-left: 5px; font-size:18x;">{{pageName.value}}</span>
      </div>

      <div class="col-auto justify-content-end" id="headerbuttons" style="/* font-size: 16px !important */">

        <button id="toggleSubMenu" class="btn bg-secondary text-body" dmx-on:click="offcanvas2.toggle()"><i class="fas fa-user fa-lg fa-1x" style="margin-right:5px;"></i>{{session_variables.data.current_user}}</button>
    </div>
      <div class="row" style="margin:3px;">
        <div id="submenuoptions" class="collapse bg-secondary rounded" is="dmx-bs5-collapse" style="padding:5px; margin-bottom:3px; margin-top:3px;">

     
      </div>
      </div>

      </div>
  <div class="offcanvas offcanvas-top bg-dark opacity-100" id="offcanvas2" is="dmx-bs5-offcanvas" tabindex="-1" style="width: auto !important; opacity: 0.85 !important;">

    <div class="offcanvas-body" style="oveflow-y: hidden;">
 <div class="col d-flex justify-content-end">
       <div style="padding: 3px; margin-top: 15px">
        <button id="btn7" class="btn btn-sm text-white" data-bs-toggle="modal" data-bs-target="#shiftSelectModal" dmx-bind:disabled="(list_user_info.data.query_list_user_info.user_profile !== 'Admin')" dmx-on:click="list_shifts.load({})"><i class="fas fa-hourglass-half fa-lg"></i> {{list_user_shift_info.data.query_list_user_shift[0].servo_shifts_shift_id}}</button>
      </div>
      <div style="padding: 3px; margin-top: 15px">
        <button id="btn3" class="btn btn-sm text-white" dmx-on:click="browser1.goto(list_user_info.data.query_list_user_info.user_profile+'.php')"><i class="fas fa-home fa-lg"></i></button>
      </div>

      <div style="padding: 3px; margin-top: 15px">
        <button id="themelight" class="btn btn-sm me-2 text-white"  dmx-on:click="themedark.hide();cookies.set('servotheme','bootstrap/5/servolight/bootstrap.min.css',{expires: 30})" dmx-hide="(cookies.data.servotheme =='bootstrap/5/servolight/bootstrap.min.css')">
            <i class="fas fa-lightbulb fa-lg"></i>
          </button>
          <button id="themedark" class="btn btn-sm me-2 text-white"  dmx-on:click="themedark.hide();cookies.set('servotheme','bootstrap/5/servodark/bootstrap.min.css',{expires: 30})" dmx-hide="(cookies.data.servotheme =='bootstrap/5/servodark/bootstrap.min.css')">
            <i class="far fa-lightbulb fa-lg"></i>
          </button>        
      </div>
      <div style="padding: 3px; margin-top: 15px">    
          <button id="btn4" class="btn btn-sm me-2 text-white" dmx-on:click="logout1.load();notifies1.warning('&quot;Logging Out&quot;');session_variables.removeAll();session1.removeAll(); browser1.goto('login.php')">

            <i class="fa fa-power-off fa-lg"></i>
          </button>
      </div>
          </div>
      <div class="row">
        <h6 class="text-white">
            Session Login Information:
            Shift ID: {{list_user_shift_info.data.query_list_user_shift[0].servo_shifts_shift_id}}
        </h6>
        <h6 class="text-white">
            Shift Start: {{list_user_shift_info.data.query_list_user_shift[0].shift_start}}
        </h6>
        <h6 class="text-white">
           Shift End: {{list_user_shift_info.data.query_list_user_shift[0].shift_stop}}
        </h6>
      </div>

    </div>
  </div>
  <div class="offcanvas offcanvas-start bg-dark opacity-100" id="offcanvas1" is="dmx-bs5-offcanvas" tabindex="-1" style="width: 180px !important; opacity: 0.85 !important;">

    <div class="offcanvas-body" style="oveflow-y: hidden;">
      <div class="row row-cols-1 h-auto">
        <div class="col" id="shifts">
          <div class="row">
            <div class="col w-auto h-auto mt-sm-1 mb-sm-2 ms-sm-1 me-sm-1 d-flex justify-content-sm-center justify-content-center mt-2 mb-2 ms-2 me-2 border-secondary rounded-2"><a href="shifts.php" class="badge style25 w-auto h-auto" style="text-decoration: unset;"><i class="fas fa-user-clock fa-2x" style="color: #ff9518 !important;"></i>
                <h5 class="mt-lg-3">
                  {{trans.data.shifts[lang.value]}}
                </h5>
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

        <div class="col" id="finance">
          <div class="row">
            <div class="col w-auto h-auto mt-sm-1 mb-sm-2 ms-sm-1 me-sm-1 d-flex justify-content-sm-center justify-content-center mt-2 mb-2 ms-2 me-2 border-secondary rounded-2"><a href="finance.php" class="badge style25 w-auto h-auto" style="text-decoration: unset;"><i class="fas fa-coins fa-2x" style="color: #ff1847 !important;"></i>
                <h5 class="mt-lg-3">{{trans.data.finance[lang.value]}}</h5>
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
  </main>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA5oFvvlozu_WJis78Bq6da8kqlfFGOcDI&libraries=places"></script>
  <script src="qr/qrcode.min.js" type="text/javascript"></script>
  <script>
  $(document).ready(
    function()
    {
    // change modal close button

        $("<i class='bi bi-x text-body btn-close' style='font-size: 30px; float: right;'></i>").appendTo(".btn-close");
        $('.btn-close').addClass('close-button rounded');
        $('.btn-close').removeClass('btn-close');

    // handle light/dark theme switching
      var light = 'bootstrap/5/servolight/bootstrap.min.css';
      var dark = 'bootstrap/5/servodark/bootstrap.min.css';
       
      /*$('link[href="bootstrap/5/servodark/bootstrap.min.css"]').attr('href', light);*/


      $('#themelight').click(
          function()
            {
              $('#themelight').hide();
              $('#themedark').show();
              $('link[href="bootstrap/5/servodark/bootstrap.min.css"]').attr('href', light);
            }
      );

      $('#themedark').click(
          function()
            {
              $('#themedark').hide();
              $('#themelight').show();
              $('link[href="bootstrap/5/servolight/bootstrap.min.css"]').attr('href', dark);
            }
      );

    }
  );
  </script>
    <script src="dmxAppConnect/dmxBootstrap5Offcanvas/dmxBootstrap5Offcanvas.js" defer=""></script>
    <script src="dmxAppConnect/dmxBootstrap5Collapse/dmxBootstrap5Collapse.js" defer=""></script>
      <link rel="stylesheet" dmx-bind:href="cookies.data.servotheme" />


</body>