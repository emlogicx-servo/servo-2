
<body is="dmx-app" id="header">
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
  <dmx-session-manager id="session1"></dmx-session-manager>
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
                    <button id="btn6" class="btn btn-outline-body" dmx-on:click="session_variables.set('current_shift', shift_id); shiftSelectModal.hide()">
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
  <div class="offcanvas offcanvas-start bg-dark opacity-100" id="offcanvas1" is="dmx-bs5-offcanvas" tabindex="-1" style="width: 180px !important; opacity: 0.85 !important;">
    <div class="offcanvas-body" style="oveflow-y: hidden;">
      <div class="row row-cols-1 h-auto">









        <div class="col" id="project">
          <div class="row">
            <div class="col w-auto h-auto mt-sm-1 mb-sm-2 ms-sm-1 me-sm-1 d-flex justify-content-sm-center justify-content-center mt-2 mb-2 ms-2 me-2 border-secondary rounded-2"><a href="gugr-projects.php" class="badge style25 w-auto h-auto" style="text-decoration: unset;"><i class="fas fa-folder fa-2x" style="color: #18ffef !important;"></i>
                <h5 class="mt-lg-3">{{trans.data.projects[lang.value]}}</h5>
              </a></div>
          </div>
        </div>
        <div class="col" id="users">
          <div class="row">
            <div class="col w-auto h-auto mt-sm-1 mb-sm-2 ms-sm-1 me-sm-1 d-flex justify-content-sm-center justify-content-center mt-2 mb-2 ms-2 me-2 border-secondary rounded-2">
              <a href="gugr-users.php" class="badge style25 w-auto h-auto" style="text-decoration: unset;"><i class="fas fa-users fa-2x" style="color: #ffcd74 !important;"></i>
                <h5 class="mt-lg-3">{{trans.data.users[lang.value]}}</h5>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <main>
    <div id="top-bar" class="row row-cols-6 justify-content-xl-between justify-content-between mt-2 mb-2 me-0 ps-0 pe-1" style="background: #004d71 !important;">

      <div class="justify-content-lg-start col d-flex justify-content-start" style="padding-left: 0px;">

        <div class="d-block"><button id="btn1" class="btn gy-0 btn-sm text-start text-primary" data-bs-toggle="offcanvas" data-bs-target="#offcanvas1" dmx-show="(list_user_info.data.query_list_user_info.user_profile == 'gugr-admin' || list_user_info.data.query_list_user_info.user_profile == 'Admin' )" style="color: #afff18 !important;"><i class="fas fa-th fa-2x" style="color:;"></i></button></div>
        <div class="d-block">

          <h3 class="d-none d-sm-block text-light ms-2" style="margin-left: 2px; /* font-size: 28px */">SERVO</h3>
        </div>
      </div>

      <div class="col-auto d-flex justify-content-end" id="headerbuttons" style="/* font-size: 16px !important */">
        <button id="btn2" class="btn  me-1" dmx-on:click="browser1.goto(session_variables.data.user_profile+'.php')" style="padding: 0px; font-size: 21px;">{{session_variables.data.current_user}}</button>
        <button id="btn3" class="btn btn-sm text-light" style="/* color: #afff18 !important */" dmx-on:click="browser1.goto(gugr-home.php')"><i class="fas fa-house-user fa-lg"></i></button>


        <button id="btn4" class="btn btn-sm me-2" dmx-on:click="logout1.load();notifies1.warning('&quot;Logging Out&quot;');session_variables.removeAll();session1.removeAll(); browser1.goto('gugr-login.php')">

          <i class="fa fa-power-off fa-lg"></i>
        </button>

      </div>
    </div>
  </main>
  <script src="bootstrap/4/js/bootstrap.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA5oFvvlozu_WJis78Bq6da8kqlfFGOcDI&libraries=places"></script>
  <script src="qr/qrcode.min.js" type="text/javascript"></script>
  <script src="bootstrap/5/js/bootstrap.bundle.min.js"></script>
</body>