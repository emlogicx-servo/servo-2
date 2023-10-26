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
  <script src="js/moment.js/2/moment.min.js"></script>
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
  <link rel="stylesheet" href="bootstrap/5/servodark/bootstrap.min.css" />
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
  <script src="dmxAppConnect/dmxBootstrap5Popovers/dmxBootstrap5Popovers.js" defer></script>
  <script src="dmxAppConnect/dmxBootstrap5Tooltips/dmxBootstrap5Tooltips.js" defer></script>


  <link rel="stylesheet" href="bootstrap/5/css/bootstrap.min.css" />
  <link rel="stylesheet" href="dmxAppConnect/dmxPreloader/dmxPreloader.css" />
  <script src="dmxAppConnect/dmxPreloader/dmxPreloader.js" defer></script>
</head>

<body is="dmx-app" id="brands" dmx-on:ready="preloader1.hide()">

  <dmx-scheduler id="scheduler1" dmx-on:tick="load_products.load({service_id: list_user_shift_info.data.query_list_user_shift[0].servo_service_service_id});list_value_updates_per_order.load({order_id: readCustomerOrder.data.query.order_id});list_order_items_deleted.load({order_id: readCustomerOrder.data.query.order_id});list_order_items.load({order_id: readCustomerOrder.data.query.order_id});wallet_report_per_wallet.load({wallet_id: read_wallet.data.read_wallet.wallet_id})" delay="15"></dmx-scheduler>

  <dmx-value id="currentCustomer"></dmx-value>
  <dmx-session-manager id="session_variables"></dmx-session-manager>

  <dmx-value id="lang" dmx-bind:value="browser1.language"></dmx-value>
  <dmx-json-datasource id="trans" is="dmx-serverconnect" url="assets/translation/translation.JSON"></dmx-json-datasource>

  <dmx-serverconnect id="companyInfo" url="dmxConnect/api/servo_company_information/read_company_information.php" dmx-param:id="id" dmx-param:item_id="" dmx-param:user_id="" dmx-param:customer_id="session_variables.data.current_customer" dmx-param:offset="listCustomerOrders.data.offset" dmx-param:limit="c_order_sort_limit.value" dmx-param:company_info_id="1"></dmx-serverconnect>

  <dmx-serverconnect id="list_wallet_transactions" url="dmxConnect/api/servo_wallet_transactions/list_wallet_transactions.php" dmx-param:sort="" dmx-param:dir="" dmx-param:limit="200" dmx-param:offset="" dmx-param:customerfilter="customerfilter.value" dmx-param:customerfilter2="customerfilter2.value" dmx-param:wallet_id="read_wallet.data.read_wallet.wallet_id" dmx-on:start="readItemModal.preloader2.show()" dmx-on:done="readItemModal.preloader2.hide()"></dmx-serverconnect>
  <dmx-serverconnect id="list_wallet_transactions_deletes" url="dmxConnect/api/servo_wallet_transactions/list_wallet_transactions_deletes.php" dmx-param:sort="" dmx-param:dir="" dmx-param:limit="" dmx-param:offset="" dmx-param:customerfilter="customerfilter.value" dmx-param:customerfilter2="customerfilter2.value" dmx-param:wallet_id="read_wallet.data.read_wallet.wallet_id"></dmx-serverconnect>
  <dmx-serverconnect id="list_wallets" url="dmxConnect/api/servo_wallets/list_wallets_paged.php" dmx-param:sort="" dmx-param:dir="" dmx-param:limit="customer_sort_limit.value" dmx-param:offset="listcustomers.data.offset" dmx-param:customerfilter="customerfilter.value" dmx-param:customerfilter2="customerfilter2.value"></dmx-serverconnect>

  <dmx-serverconnect id="read_wallet" url="dmxConnect/api/servo_wallets/read_wallet.php" dmx-param:sort="" dmx-param:dir="" dmx-param:limit="customer_sort_limit.value" dmx-param:offset="listcustomers.data.offset" dmx-param:customerfilter="customerfilter.value" dmx-param:customerfilter2="customerfilter2.value" dmx-param:user_id="list_user_info.data.query_list_user_info.user_id"></dmx-serverconnect>
  <dmx-serverconnect id="wallet_report_per_wallet" url="dmxConnect/api/servo_wallets/wallet_report_per_wallet.php" dmx-param:sort="" dmx-param:dir="" dmx-param:limit="customer_sort_limit.value" dmx-param:offset="listcustomers.data.offset" dmx-param:customerfilter="customerfilter.value" dmx-param:customerfilter2="customerfilter2.value" dmx-param:wallet_id="read_wallet.data.read_wallet.wallet_id" noload></dmx-serverconnect>
  <dmx-serverconnect id="list_users_not_in_wallet" url="dmxConnect/api/servo_wallets/list_users_not_in_wallet.php" dmx-param:wallet_id="read_wallet.data.read_wallet.wallet_id"></dmx-serverconnect>



  <div is="dmx-browser" id="browser1"></div>
  <dmx-notifications id="notifies1" position="bottom" closable="true" newest-on-top="true" timeout="500" extended-timeout="500"></dmx-notifications>
  <?php include 'header.php'; ?>
  <main id="createItem">
    <div class="modal create-modal" id="createItemModal" is="dmx-bs5-modal" tabindex="-1">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title"><i class="fas fa-wallet" style="margin-right: 5px;"></i>{{trans.data.newWallet[lang.value]}}</h5>


            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <form is="dmx-serverconnect-form" id="createWalletForm" method="post" action="dmxConnect/api/servo_wallets/create_wallet.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-on:success="notifies1.success('Success!'); readItemModal.show();createWalletForm.reset();createItemModal.hide();list_wallets.load({})">
                <input id="walletUserCreated" name="wallet_user_created" type="text" class="form-control visually-hidden" dmx-bind:value="list_user_info.data.query_list_user_info.user_id">
                <input id="walletCreationDate" name="wallet_creation_date" type="datetime-local" class="form-control visually-hidden" dmx-bind:value="dateTime.datetime">
                <div class="mb-3 row">
                  <label for="walletname" class="col-sm-2 col-form-label">{{trans.data.name[lang.value]}}</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="walletName" name="wallet_name" aria-describedby="inp_customer_first_name_help">
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="inp_customer_last_name1" class="col-sm-2 col-form-label">{{trans.data.type[lang.value]}}</label>
                  <div class="col-sm-10" id="walletType">
                    <select id="select6" class="form-select" name="wallet_type">
                      <option value="internal">{{trans.data.internal[lang.value]}}</option>
                      <option value="external">{{trans.data.external[lang.value]}}</option>
                    </select>
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="inp_customer_last_name1" class="col-sm-2 col-form-label">{{trans.data.currency[lang.value]}}</label>
                  <div class="col-sm-10" id="walletCurrency">
                    <select id="select1" class="form-select" name="wallet_currency" dmx-bind:options="load_currencies.data.query_load_currencies" optiontext="currency_name" optionvalue="currency_id">
                    </select>
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="inp_customer_last_name1" class="col-sm-2 col-form-label">{{trans.data.format[lang.value]}}</label>
                  <div class="col-sm-10" id="walletFormat">
                    <select id="select5" class="form-select" name="wallet_format" dmx-bind:options="load_payment_methods.data.query" optiontext="payment_method_name" optionvalue="payment_method_id" dmx-bind:value="2">
                    </select>
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="inp_customer_last_name1" class="col-sm-2 col-form-label">{{trans.data.description[lang.value]}}</label>
                  <div class="col-sm-10">
                    <textarea type="text" class="form-control" id="walletDescription1" name="wallet_description" aria-describedby="inp_customer_last_name_help"></textarea>
                  </div>
                </div>


                <div class="mb-3 row">
                  <div class="col-sm-2">&nbsp;</div>
                  <div class="col-sm-10 mt-2">
                    <button type="submit" class="btn btn-primary bg-info">Save</button>
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
  <main id="expenses">
    <div class="modal create-modal" id="expenseModal" is="dmx-bs5-modal" tabindex="-1">
      <dmx-serverconnect id="list_expenses" url="dmxConnect/api/servo_expenses/list_expenses_shift.php" dmx-param:id="id" dmx-param:item_id="" dmx-param:user_id="" dmx-param:customer_id="session_variables.data.current_customer" dmx-param:shift="list_user_shift_info.data.query_list_user_shift[0].servo_shifts_shift_id"></dmx-serverconnect>
      <dmx-serverconnect id="list_expenses_deleted" url="dmxConnect/api/servo_expenses/list_expenses_shift_deleted.php" dmx-param:id="id" dmx-param:item_id="" dmx-param:user_id="" dmx-param:customer_id="session_variables.data.current_customer" dmx-param:shift="list_user_shift_info.data.query_list_user_shift[0].servo_shifts_shift_id"></dmx-serverconnect>
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{trans.data.expenses[lang.value]}}</h5>

            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col">
                <div class="row mb-2" id="expensesTotal">
                  <div class="col d-flex offset-0 justify-content-center bg-info rounded-pill pt-2">
                    <h3 class="text-white">{{trans.data.total[lang.value]}}:&nbsp;</h3>
                    <h3 dmx-text="list_expenses.data.list_expenses_shift.sum(`expense_amount`).formatNumber('0',',',',')" class="text-white fw-bolder"></h3>
                  </div>
                </div>
                <ul class="nav nav-tabs" id="navTabs1_tabs" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active fw-bold" id="navTabs1_1_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_111" role="tab" aria-controls="navTabs1_1" aria-selected="true">{{trans.data.newExpense[lang.value]}}</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link fw-bold" id="navTabs1_2_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_222" role="tab" aria-controls="navTabs1_2" aria-selected="false">{{trans.data.expenses[lang.value]}}</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link fw-bold" id="navTabs1_2_tab2" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_12" role="tab" aria-controls="navTabs1_2" aria-selected="false">
                      <i class="fas fa-history"></i>
                    </a>
                  </li>
                </ul>
                <div class="tab-content" id="navTabs1_content">
                  <div class="tab-pane fade show active" id="navTabs1_111" role="tabpanel">

                    <div class="row mt-2">
                      <div class="col-9 border rounded border-secondary mt-1 ms-3 pt-3 pb-3">
                        <form id="createExpenseForm" is="dmx-serverconnect-form" method="post" action="dmxConnect/api/servo_expenses/create_expense.php" dmx-on:success="list_expenses.load({});createExpenseForm.reset()" dmx-on:error="notifies1.danger('Error!')">
                          <input id="expenseDate" name="expense_date_paid" type="datetime-local" class="form-control visually-hidden" dmx-bind:value="dateTime.datetime">
                          <input id="expenseUserPaid" name="expense_user_paid" class="form-control visually-hidden" dmx-bind:value="list_user_info.data.query_list_user_info.user_id" type="number">
                          <input id="expenseStatus" name="expense_status" class="form-control visually-hidden" dmx-bind:value="'Paid'">
                          <input id="expenseShift" name="expense_shift" class="form-control visually-hidden" dmx-bind:value="list_user_shift_info.data.query_list_user_shift[0].servo_shifts_shift_id">
                          <div class="form-group mb-3 row" id="expenseAmount">
                            <label for="expenseAmount1" class="col-sm-2 col-form-label">{{trans.data.amount[lang.value]}}</label>
                            <div class="col-sm-10">
                              <input type="number" class="form-control" id="expenseAmount1" name="expense_amount" aria-describedby="input1_help" required="" data-msg-required="!" min="1" data-rule-min="1" data-msg-min="!">
                            </div>
                          </div>
                          <div class="form-group mb-3 row" id="expenseDepartment">
                            <label for="expenseDepartment" class="col-sm-2 col-form-label">{{trans.data.department[lang.value]}}</label>
                            <div class="col-sm-10">
                              <select id="expenseDepartment" class="form-select" name="expense_department" dmx-bind:options="list_departments.data.query_list_departments" optiontext="department_name" optionvalue="department_id" dmx-bind:required="">
                                <option selected="" value="">----</option>
                              </select>
                            </div>
                          </div>
                          <div class="form-group mb-3 row" id="expenseUserReceived">
                            <label for="expenseUserReceived" class="col-sm-2 col-form-label">{{trans.data.user[lang.value]}}</label>
                            <div class="col-sm-10">
                              <select id="expenseDepartment1" class="form-select" name="expense_user_received" dmx-bind:options="list_users.data.query_list_users" optiontext="user_username" optionvalue="user_id" dmx-bind:required="">
                                <option selected="" value="">----</option>
                              </select>
                            </div>
                          </div>
                          <div class="form-group mb-3 row" id="expenseUserReceived1">
                            <label for="expenseUserReceived1" class="col-sm-2 col-form-label">{{trans.data.paymentMethod[lang.value]}}</label>
                            <div class="col-sm-10">
                              <select id="expensePaymentMethod" class="form-select" name="expense_payment_method" dmx-bind:options="payment_methods.data.query" dmx-bind:required="'!'" optiontext="payment_method_name" optionvalue="payment_method_id">
                                <option selected="" value="">----</option>
                              </select>
                            </div>
                          </div>
                          <div class="form-group mb-3 row" id="expenseNote">
                            <label for="expenseDescription" class="col-sm-2 col-form-label">{{trans.data.note[lang.value]}}</label>
                            <div class="col-sm-10">
                              <textarea type="text" class="form-control" id="expenseDescription" name="expense_description" aria-describedby="input1_help"></textarea>
                            </div>
                          </div>
                          <button id="btn25" class="btn btn-info" type="submit">
                            <i class="fas fa-check fa-2x"></i>
                          </button>
                        </form>
                      </div>

                    </div>
                  </div>
                  <div class="tab-pane fade" id="navTabs1_222" role="tabpanel">
                    <div class="row">
                      <div class="table-responsive">
                        <table class="table table-hover table-sm">
                          <thead>
                            <tr>

                              <th>{{trans.data.dateTime[lang.value]}}</th>
                              <th>{{trans.data.description[lang.value]}}</th>
                              <th>{{trans.data.username[lang.value]}}</th>
                              <th>{{trans.data.username[lang.value]}}</th>
                              <th>{{trans.data.department[lang.value]}}</th>
                              <th>{{trans.data.amount[lang.value]}}</th>
                              <th>{{trans.data.paymentMethod[lang.value]}}</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_expenses.data.list_expenses_shift" id="tableRepeat11">
                            <tr>

                              <td dmx-text="expense_date_paid"></td>
                              <td dmx-text="expense_description"></td>
                              <td dmx-text="user_paid_name"></td>
                              <td dmx-text="user_received_name"></td>
                              <td dmx-text="department_name"></td>
                              <td dmx-text="expense_amount.formatNumber('0',',',',')" class="text-end"></td>
                              <td dmx-text="payment_method_name" class="text-center"></td>
                              <td>
                                <div class="row">
                                  <form id="deleteExpense" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_expenses/delete_expense.php" dmx-on:success="notifies1.success('Success!');list_expenses.load(); list_expenses_deleted.load()" dmx-on:error="notifies1.danger('Error!')" onsubmit="return confirm ('CONFIRM!')">
                                    <input id="text14" name="expense_id" type="text" class="form-control visually-hidden" dmx-bind:value="expense_id">
                                    <input id="text18" name="expenses_deleted_status" type="text" class="form-control visually-hidden" dmx-bind:value="'y'">
                                    <button id="btn26" class="btn text-white-50" type="submit">
                                      <i class="far fa-trash-alt"></i>
                                    </button>
                                  </form>
                                  <form id="createDeleteExpense" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_expenses/delete_expense.php" dmx-on:success="notifies1.success('Success!');list_expenses.load()" dmx-on:error="notifies1.danger('Error!')" onsubmit="return confirm ('CONFIRM!')">
                                    <input id="text17" name="expense_id1" type="text" class="form-control visually-hidden" dmx-bind:value="expense_id">
                                    <button id="btn35" class="btn text-white-50 visually-hidden" type="submit">
                                      <i class="far fa-trash-alt"></i>
                                    </button>
                                  </form>
                                </div>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="navTabs1_12" role="tabpanel">
                    <div class="row">
                      <div class="table-responsive">
                        <table class="table table-hover table-sm">
                          <thead>
                            <tr>

                              <th>{{trans.data.dateTime[lang.value]}}</th>
                              <th>{{trans.data.description[lang.value]}}</th>
                              <th>{{trans.data.username[lang.value]}}</th>
                              <th>{{trans.data.username[lang.value]}}</th>
                              <th>{{trans.data.department[lang.value]}}</th>
                              <th>{{trans.data.amount[lang.value]}}</th>
                              <th>{{trans.data.paymentMethod[lang.value]}}</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_expenses_deleted.data.list_expenses_shift_deleted" id="tableRepeat8">
                            <tr>

                              <td dmx-text="expense_date_paid"></td>
                              <td dmx-text="expense_description"></td>
                              <td dmx-text="user_paid_name"></td>
                              <td dmx-text="user_received_name"></td>
                              <td dmx-text="department_name"></td>
                              <td dmx-text="expense_amount.formatNumber('0',',',',')" class="text-end"></td>
                              <td dmx-text="payment_method_name" class="text-center"></td>
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
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>
  </main>
  <main class="mt-4" id="readItem">

    <div class="modal readitem" id="readItemModal" is="dmx-bs5-modal" tabindex="-1" dmx-on:show-bs-modal="list_customer_transactions.load({customer_id: customer_id});list_customer_orders.load({customer_id: customer_id, offset: listCustomerOrders.data.customerOrdersOffset, limit: c_order_sort_limit.value});list_customer_data_reading_sessions.load({customer_id: customer_id});list_customer_transactions_amounts.load({customer_id: customer_id});list_customer_orders_totals.load({customer_id: customer_id});list_customer_covered_orders.load({customer_id: customer_id, offset: listCustomerCoveredOrders.data.offset, limit: c_order_sort_limit2.value})">
      <div class="modal-dialog modal-xl" role="document" style="margin: 0px !important; width: 100% !important; height: 99% !important; max-width: 100% !important; max-height: 99% !important;">
        <div class="modal-content" style="max-height: 100% !important; height: 100% !important;">
          <dmx-preloader id="preloader2" spinner="wave" bgcolor="#888888"></dmx-preloader>
          <div class="modal-header text-sm-start">
            <div class="d-flex">
              <h6 class="fw-bold text-body"><i class="fas fa-wallet fa-lg"></i>&nbsp;{{trans.data.wallet[lang.value]}}:&nbsp;{{read_wallet.data.read_wallet.wallet_name}}</h6>
            </div>


            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col">
                <ul class="nav nav-tabs nav-fill align-items-end flex-nowrap y-scroll" id="navTabs1_tabs" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active flex-grow-1 fw-bold text-body" id="navTabs1_1_tab1" data-bs-toggle="tab" href="#" data-bs-target="#tabPane1" role="tab" aria-controls="navTabs1_1" aria-selected="true" dmx-on:click="list_customer_transactions_amounts.load({customer_id: session_variables.data.current_customer});list_customer_orders_totals.load({customer_id: session_variables.data.current_customer})"><i class="far fa-eye fa-sm" style="margin-right: 5px;"></i>

                      {{trans.data.overview[lang.value]}}</a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link fw-bold text-body" id="navTabs1_2_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_2" role="tab" aria-controls="navTabs1_2" aria-selected="false"><i class="fas fa-coins fa-sm" style="margin-right: 5px;"></i>
                      {{trans.data.transactions[lang.value]}}</a>
                  </li>
                  <li class="nav-item fw-bold">
                    <a class="nav-link text-body" id="navTabs1_3_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_3" role="tab" aria-controls="navTabs1_3" aria-selected="false"><i class="fas fa-info" style="margin-right: 5px;"></i>{{trans.data.info[lang.value]}}</a>
                  </li>
                  <li class="nav-item fw-bold" dmx-show="list_user_info.data.query_list_user_info.user_profile=='Admin'">
                    <a class="nav-link text-body" id="navTabs1_3_tab1" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_1" role="tab" aria-controls="navTabs1_3" aria-selected="false"><i class="far fa-trash-alt" style="margin-right: 5px;"></i>{{trans.data.bin[lang.value]}}</a>
                  </li>
                  <li class="nav-item fw-bold" dmx-show="list_user_info.data.query_list_user_info.user_profile=='Admin'">
                    <a class="nav-link text-body" id="navTabs1_3_tab2" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_6" role="tab" aria-controls="navTabs1_3" aria-selected="false" dmx-bs-tooltip="trans.data.settings[lang.value]" data-bs-trigger="hover" data-bs-placement="bottom"><i class="fas fa-cog" style="margin-right: 5px;"></i>{{trans.data.settings[lang.value]}}</a>
                  </li>
                </ul>
                <div class="tab-content" id="navTabs1_content">
                  <div class="tab-pane fade show active" id="tabPane1" role="tabpanel">
                    <dmx-value id="totalDeposits" dmx-bind:value="(wallet_report_per_wallet.data.custom_wallet_report_per_wallet[0].TotalDeposits + wallet_report_per_wallet.data.custom_wallet_report_per_wallet[0].TotalTransfersIn)"></dmx-value>
                    <dmx-value id="totalTransfersInPerWallet" dmx-bind:value="wallet_report_per_wallet.data.custom_wallet_report_per_wallet[0].TotalTransfersIn.toNumber()"></dmx-value>
                    <dmx-value id="totalTransfersOutPerWallet" dmx-bind:value="wallet_report_per_wallet.data.custom_wallet_report_per_wallet[0].TotalTransfersOut.toNumber()"></dmx-value>
                    <dmx-value id="totalPaymentsPerWallet" dmx-bind:value="wallet_report_per_wallet.data.custom_wallet_report_per_wallet[0].TotalPayments.toNumber()"></dmx-value>
                    <dmx-value id="totalDepositsPerWallet" dmx-bind:value="wallet_report_per_wallet.data.custom_wallet_report_per_wallet[0].TotalDeposits.toNumber()"></dmx-value>
                    <dmx-value id="total" dmx-bind:value="(wallet_report_per_wallet.data.custom_wallet_report_per_wallet[0].TotalDeposits + wallet_report_per_wallet.data.custom_wallet_report_per_wallet[0].TotalTransfersIn)"></dmx-value>

                    <div class="row">

                      <div class="col-12 col-lg-6">
                        <div class="row mt-2 ms-0">
                          <div id="totalDebt" class="bg-info text-center mt-2 me-2 pt-4 pb-4 ps-4 pe-4 col rounded" style="background: #ff2a5c !important;">
                            <div class="row">
                              <div class="col text-white">
                                <i class="far fa-question-circle fa-lg"></i>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col">
                                <h2 dmx-text="wallet_report_per_wallet.data.custom_wallet_report_per_wallet[0].Pending.toNumber().formatNumber('0',',',',').default(0)" class="text-white"></h2>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col">
                                <h4 dmx-text="trans.data.pending[lang.value]">{{trans.data.pending[lang.value]}}</h4>
                              </div>
                            </div>
                          </div>
                          <div class="bg-info text-center mt-2 me-2 pt-4 pb-4 ps-4 pe-4 col rounded" id="totalDeposits" style="background: #ff2afa !important;">

                            <div class="row">
                              <div class="col text-white">
                                <i class="far fa-thumbs-up"></i>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col">
                                <h2 dmx-text="wallet_report_per_wallet.data.custom_wallet_report_per_wallet[0].Approved.toNumber().formatNumber('0',',',',').default(0)" class="text-white"></h2>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col">

                                <h4 dmx-text="trans.data.Approved[lang.value]"></h4>
                              </div>
                            </div>
                          </div>

                          <div id="totalSettlements" class="bg-info text-center mt-2 me-2 pt-4 pb-4 ps-4 pe-4 col rounded" style="background: #07b853 !important;">
                            <div class="row">
                              <div class="col text-white">
                                <i class="fas fa-check"></i>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col">
                                <h2 dmx-text="((totalDepositsPerWallet.value + totalTransfersInPerWallet.value)-(totalTransfersOutPerWallet.value + totalPaymentsPerWallet.value)).formatNumber('0',',',',')" class="text-white"></h2>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col">
                                <h4>{{trans.data.totalDeposits[lang.value]}}</h4>
                              </div>
                            </div>
                          </div>
                          <div id="totalPayout" class="text-center mt-2 me-2 pt-4 pb-4 ps-4 pe-4 col rounded visually-hidden" style="background: #b81f07 !important;">
                            <div class="row">
                              <div class="col">
                                <i class="fas fa-angle-up fa-lg"></i>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col">
                                <h2 dmx-text="(list_customer_transactions.data.query.where(`transaction_type`, 'Payment', '==')).sum('transaction_amount').formatNumber('0',',',',').default('0')"></h2>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col">
                                <h4>{{trans.data.totalPayout[lang.value]}}</h4>
                              </div>
                            </div>
                          </div>
                          <div id="totalOrders4" class="bg-info text-center mt-2 me-2 pt-4 pb-4 ps-4 pe-4 col rounded visually-hidden" style="background: #606370 !important;">
                            <div class="row">
                              <div class="col">
                                <i class="fas fa-clipboard-list fa-lg"></i>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col">
                                <h1 dmx-text="list_customer_orders.data.query_list_customer_orders.data.count().formatNumber('0',',',',').default(0)">{{trans.data.totalOrders[lang.value]}}</h1>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col">

                                <h4 dmx-text="trans.data.orders[lang.value]"></h4>
                              </div>
                            </div>
                          </div>
                          <div id="totalCoverageDebt" class="bg-info text-center mt-2 me-2 pt-4 pb-4 ps-4 pe-4 col rounded visually-hidden" style="background: #ff8f2b !important;">
                            <div class="row">
                              <div class="col">
                                <i class="fas fa-people-arrows fa-lg"></i>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col">
                                <h1 dmx-text="variableTotalCoverageDebt.value.default(0)">{{trans.data.totalOrders[lang.value]}}</h1>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col">

                                <h4 dmx-text="trans.data.totalCoverage[lang.value]"></h4>
                              </div>
                            </div>
                          </div>
                          <div id="totalCovered" class="text-center mt-2 me-2 pt-4 pb-4 ps-4 pe-4 col rounded visually-hidden" style="background: #176de0 !important;" dmx-hide="(read_customer.data.query_read_customer.customer_class == 'standard')">
                            <div class="row">
                              <div class="col">
                                <i class="fas fa-arrow-circle-up fa-lg"></i>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col">
                                <h1 dmx-text="variableTotalCovered.value.default(0)">{{trans.data.totalOrders[lang.value]}}</h1>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col">

                                <h4 dmx-text="trans.data.totalCovered[lang.value]"></h4>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="mt-3 col-lg-6">
                        <div class="row">
                          <div class="col bg-secondary rounded pt-5 pb-2 ps-2 pe-2 visually-hidden">
                            <dmx-chart id="chart1" responsive="true" dmx-bind:data="list_customer_transactions.data.query" label-x="list_customer_transactions.data.query[0].transaction_date" dataset-1:value="transaction_amount" smooth="true" thickness="3" height="350" colors="colors9"></dmx-chart>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>


                  <div class="tab-pane fade scrollable" id="navTabs1_2" role="tabpanel">
                    <div class="row mt-3">
                      <div class="col d-flex rounded ms-1 me-1">
                        <h5 class="fw-bold me-2 pt-2 text-body">{{trans.data.newTransaction[lang.value]}}</h5>
                        <div id="allowDeposit" is="dmx-if" dmx-bind:condition="read_wallet.data.query_wallet_privileges_user[0].wallet_privilege_deposit=='Yes'"><button id="ButtonDeposit" class="btn me-2 bg-success text-success fw-bold bg-opacity-10" dmx-on:click="transactionType.setValue('deposit')"><i class="fas fa-arrow-down"></i>
                            {{trans.data.Deposit[lang.value]}}
                          </button></div>

                        <div id="allowPayment" is="dmx-if" dmx-bind:condition="read_wallet.data.query_wallet_privileges_user[0].wallet_privilege_payout=='Yes'"><button id="ButtonPayment" class="btn me-2 bg-danger text-danger bg-opacity-10 fw-bold" dmx-on:click="transactionType.setValue('payment')"><i class="fas fa-arrow-up"></i>
                            {{trans.data.Payment[lang.value]}}
                          </button></div>
                        <div id="allowTransfer" is="dmx-if" dmx-bind:condition="read_wallet.data.query_wallet_privileges_user[0].wallet_privilege_transfer=='Yes'"><button id="ButtonTransfer" class="btn me-2 bg-info bg-opacity-10 text-info fw-bold" dmx-on:click="transactionType.setValue('transfer')"><i class="fas fa-exchange-alt"></i>
                            {{trans.data.wireTransfer[lang.value]}}
                          </button></div>




                        <dmx-value id="transactionType"></dmx-value>
                      </div>


                    </div>
                    <div class="row border rounded-2 border-secondary bg-success bg-opacity-10 mt-2 ms-1 me-1 pt-3 pb-2" dmx-hide="transactionType.value!=='deposit'">
                      <div id="conditional6" is="dmx-if"></div>
                      <div class="col">
                        <h4 class="text-success">{{trans.data.Deposit[lang.value]}}</h4>
                        <form id="createWalletTransaction" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_wallet_transactions/create_wallet_transaction.php" dmx-on:success="notifies1.success('Sucess!');list_wallet_transactions.load({wallet_id: read_wallet.data.read_wallet.wallet_id});createWalletTransaction.reset()" dmx-on:error="notifies1.danger('Error!')">
                          <div class="row">
                            <div class="col visually-hidden"><input id="walletId" name="transaction_originating_wallet" type="text" class="form-control" dmx-bind:value="read_wallet.data.read_wallet.wallet_id"><input id="userinitiated" name="transaction_user_initiated_id" type="text" class="form-control" dmx-bind:value="list_user_info.data.query_list_user_info.user_id">
                              <input id="transactionStatus" name="transaction_status" type="text" class="form-control" dmx-bind:value="'Pending'">
                            </div>
                            <div class="col-auto col-8 mb-2 col-sm-auto col-md-auto"><input id="transactionAmount1" name="transaction_amount" type="number" class="form-control" dmx-bind:placeholder="trans.data.amount[lang.value]" data-rule-number="" required="" data-msg-required="!" data-msg-number="!"></div>
                            <div class="col-auto mb-2 col-sm-auto col-md-auto visually-hidden"><input id="transactionDate1" name="transaction_date" type="datetime-local" class="form-control" dmx-bind:value="dateTime.datetime"></div>
                            <div class="col-auto mb-2 col-sm-auto col-md-auto col-2 visually-hidden"><select id="transactionType1" class="form-select" name="transaction_type" required="" data-msg-required="!" dmx-bind:value="'Deposit'">
                                <option selected="" value="Deposit">{{trans.data.Deposit[lang.value]}}</option>
                                <option value="Transfer">{{trans.data.wireTransfer[lang.value]}}</option>
                                <option value="Payment">{{trans.data.payment[lang.value]}}</option>
                              </select></div>
                            <div class="col-auto mb-2 col-sm-auto col-md-auto visually-hidden"><select id="transactionDestination" class="form-select" name="transaction_destination_wallet" dmx-bind:options="list_wallets.data.query_list_wallets_paged.data" optiontext="wallet_name" optionvalue="wallet_id">
                                <option value="">----</option>
                              </select></div>
                            <div class="col-auto mb-2 col-sm-auto col-md-auto visually-hidden"><select id="transactionPaymentMethod1" class="form-select" name="transaction_payment_method" optiontext="payment_method_name" optionvalue="payment_method_id" required="" data-msg-required="!" dmx-bind:options="load_payment_methods.data.query" dmx-bind:value="read_wallet.data.read_wallet.wallet_format">
                                <option value="">----</option>
                              </select></div>

                            <div class="col-auto col-sm-auto col-md-auto mb-2 pb-5">
                              <textarea id="transactionNote" class="form-control" name="transaction_note" dmx-bind:placeholder="trans.data.note[lang.value]"></textarea>
                            </div>
                            <div class="mb-2 col-sm-auto col-md-auto col-auto offset-0"><button id="btn3" class="btn ms-2 btn-success" type="submit">
                                <i class="fas fa-check"></i>
                              </button></div>
                          </div>







                        </form>
                      </div>


                    </div>
                    <div class="row border rounded-2 border-secondary text-danger bg-danger bg-opacity-10 mt-2 ms-1 me-1 pt-3 pb-2" dmx-hide="transactionType.value!=='payment'">
                      <div class="col" is="dmx-if" id="paymentTransaction" dmx-bind:condition="read_wallet.data.query_wallet_privileges_user[0].wallet_privilege_payout=='Yes'">
                        <h4>{{trans.data.payment[lang.value]}}</h4>
                        <form id="createWalletTransactionPayment" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_wallet_transactions/create_wallet_transaction.php" dmx-on:success="notifies1.success('Sucess!');list_wallet_transactions.load({wallet_id: read_wallet.data.read_wallet.wallet_id});createWalletTransactionPayment.reset()" dmx-on:error="notifies1.danger('Error!')">
                          <div class="row">
                            <div class="col visually-hidden"><input id="walletId1" name="transaction_originating_wallet" type="text" class="form-control" dmx-bind:value="read_wallet.data.read_wallet.wallet_id"><input id="userinitiated1" name="transaction_user_initiated_id" type="text" class="form-control" dmx-bind:value="list_user_info.data.query_list_user_info.user_id">
                              <input id="transactionStatus1" name="transaction_status" type="text" class="form-control" dmx-bind:value="'Pending'">
                            </div>
                            <div class="col-auto col-8 mb-2 col-sm-auto col-md-auto"><input id="transactionAmount2" name="transaction_amount" type="number" class="form-control" dmx-bind:placeholder="trans.data.amount[lang.value]" data-rule-number="" required="" data-msg-required="!" data-msg-number="!" dmx-bind:max="totalDeposits.value" dmx-bind:min="1"></div>
                            <div class="col-auto mb-2 col-sm-auto col-md-auto visually-hidden"><input id="transactionDate2" name="transaction_date" type="datetime-local" class="form-control" dmx-bind:value="dateTime.datetime"></div>
                            <div class="col-auto mb-2 col-sm-auto col-md-auto col-2 visually-hidden"><select id="transactionType2" class="form-select" name="transaction_type" required="" data-msg-required="!">
                                <option value="Deposit">{{trans.data.Deposit[lang.value]}}</option>
                                <option value="Transfer">{{trans.data.wireTransfer[lang.value]}}</option>
                                <option selected="" value="Payment">{{trans.data.payment[lang.value]}}</option>
                              </select></div>
                            <div class="col-auto mb-2 col-sm-auto col-md-auto visually-hidden"><select id="transactionDestination1" class="form-select" name="transaction_destination_wallet" dmx-bind:options="list_wallets.data.query_list_wallets_paged.data" optiontext="wallet_name" optionvalue="wallet_id">
                                <option value="">----</option>
                              </select></div>
                            <div class="col-auto mb-2 col-sm-auto col-md-auto visually-hidden"><select id="transactionPaymentMethod2" class="form-select" name="transaction_payment_method" optiontext="payment_method_name" optionvalue="payment_method_id" required="" data-msg-required="!" dmx-bind:options="load_payment_methods.data.query" dmx-bind:value="read_wallet.data.read_wallet.wallet_format">
                                <option value="">----</option>
                              </select></div>

                            <div class="col-auto col-sm-auto col-md-auto mb-2 pb-5">
                              <textarea id="transactionNote1" class="form-control" name="transaction_note" dmx-bind:placeholder="trans.data.note[lang.value]"></textarea>
                            </div>
                            <div class="mb-2 col-sm-auto col-md-auto col-auto offset-0"><button id="btn20" class="btn ms-2 btn-success" type="submit">
                                <i class="fas fa-check"></i>
                              </button></div>
                          </div>







                        </form>
                      </div>


                    </div>
                    <div class="row border rounded-2 border-secondary bg-opacity-10 bg-primary mt-2 ms-1 me-1 pt-3 pb-2" dmx-hide="transactionType.value!=='transfer'">
                      <div class="col" is="dmx-if" id="transferTransaction" dmx-bind:condition="read_wallet.data.query_wallet_privileges[0].wallet_privilege_transfer=='Yes'">
                        <h4 class="text-info">{{trans.data.wireTransfer[lang.value]}}</h4>
                        <form id="createWalletTransactionTransfer" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_wallet_transactions/create_wallet_transaction.php" dmx-on:success="notifies1.success('Sucess!');list_wallet_transactions.load({wallet_id: read_wallet.data.read_wallet.wallet_id});createWalletTransactionTransfer.reset()" dmx-on:error="notifies1.danger('Error!')">
                          <div class="row">
                            <div class="col visually-hidden"><input id="walletId2" name="transaction_originating_wallet" type="text" class="form-control" dmx-bind:value="read_wallet.data.read_wallet.wallet_id"><input id="userinitiated2" name="transaction_user_initiated_id" type="text" class="form-control" dmx-bind:value="list_user_info.data.query_list_user_info.user_id">
                              <input id="transactionStatus2" name="transaction_status" type="text" class="form-control" dmx-bind:value="'Pending'">
                            </div>
                            <div class="col-auto col-8 mb-2 col-sm-auto col-md-auto"><input id="transactionAmount3" name="transaction_amount" type="number" class="form-control" dmx-bind:placeholder="trans.data.amount[lang.value]" data-rule-number="" required="" data-msg-required="!" data-msg-number="!" dmx-bind:max="totalDeposits.value" dmx-bind:min="1"></div>
                            <div class="col-auto mb-2 col-sm-auto col-md-auto visually-hidden"><input id="transactionDate3" name="transaction_date" type="datetime-local" class="form-control" dmx-bind:value="dateTime.datetime"></div>
                            <div class="col-auto mb-2 col-sm-auto col-md-auto col-2 visually-hidden"><select id="transactionType3" class="form-select" name="transaction_type" required="" data-msg-required="!" dmx-bind:value="'Transfer'">
                                <option value="Deposit">{{trans.data.Deposit[lang.value]}}</option>
                                <option selected="" value="Transfer">{{trans.data.wireTransfer[lang.value]}}</option>
                                <option value="Payment">{{trans.data.payment[lang.value]}}</option>
                              </select></div>
                            <div class="col-auto mb-2 col-sm-auto col-md-auto"><select id="transactionDestination2" class="form-select" name="transaction_destination_wallet" required="" data-msg-required="!" dmx-bind:options="list_wallets.data.query_list_wallets_paged.data.where(`wallet_currency`, read_wallet.data.read_wallet.wallet_currency, '==')" optiontext="wallet_name" optionvalue="wallet_id">
                                <option value="">----</option>
                              </select></div>
                            <div class="col-auto mb-2 col-sm-auto col-md-auto visually-hidden"><select id="transactionPaymentMethod3" class="form-select" name="transaction_payment_method" optiontext="payment_method_name" optionvalue="payment_method_id" required="" data-msg-required="!" dmx-bind:options="load_payment_methods.data.query" dmx-bind:value="read_wallet.data.read_wallet.wallet_format">
                                <option value="">----</option>
                              </select></div>

                            <div class="col-auto col-sm-auto col-md-auto mb-2 pb-5">
                              <textarea id="transactionNote2" class="form-control" name="transaction_note" dmx-bind:placeholder="trans.data.note[lang.value]"></textarea>
                            </div>
                            <div class="mb-2 col-sm-auto col-md-auto col-auto offset-0"><button id="btn22" class="btn ms-2 btn-success" type="submit">
                                <i class="fas fa-check"></i>
                              </button></div>
                          </div>







                        </form>
                      </div>


                    </div>
                    <div class="row mt-lg-2 mt-2 scrollable">
                      <div class="col bg-light rounded mt-2 ms-2 me-2">
                        <div class="table-responsive">
                          <table class="table table-hover table-sm">
                            <thead>
                              <tr class="text-center">
                                <th>#</th>
                                <th>{{trans.data.amount[lang.value]}}</th>

                                <th>{{trans.data.type[lang.value]}}</th>

                                <th>{{trans.data.dateTime[lang.value]}}</th>

                                <th>{{trans.data.paymentMethod[lang.value]}}</th>

                                <th>{{trans.data.status[lang.value]}}</th>

                                <th>{{trans.data.note[lang.value]}}</th>

                                <th>{{trans.data.origin[lang.value]}}</th>

                                <th>{{trans.data.destination[lang.value]}}</th>




                                <th></th>
                                <th></th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_wallet_transactions.data.list_wallet_transactions_paged.data" id="tableRepeat2">
                              <tr class="text-center">
                                <td dmx-text="transaction_id"></td>
                                <td dmx-text="transaction_amount.toNumber().formatNumber('0',',',',')" class="text-end"></td>
                                <td dmx-text="transaction_type"></td>
                                <td dmx-text="transaction_date"></td>
                                <td dmx-text="payment_method_name"></td>
                                <td>
                                  <h6 dmx-text="transaction_status" dmx-class:green-state="transaction_status=='Received'" dmx-class:yellow-state="transaction_status=='Approved'" dmx-class:grey-state="transaction_status=='Pending'" class="fw-bold pt-1 pb-1 ps-1 pe-1"></h6>
                                </td>
                                <td>
                                  <form id="updateWalletTransactionNote" method="post" dmx-on:success="list_wallet_transactions.load({wallet_id: read_wallet.data.read_wallet.wallet_id});wallet_report_per_wallet.load({wallet_id: read_wallet.data.read_wallet.wallet_id});updateWalletTransactionNote.reset()" is="dmx-serverconnect-form" action="dmxConnect/api/servo_wallet_transactions/update_wallet_transaction_note.php" class="d-flex">
                                    <input id="transactionNoteId" name="transaction_id" type="number" class="form-control visually-hidden" dmx-bind:value="transaction_id">
                                    <textarea id="transactionNoteNote" name="transaction_note" type="text" class="form-control" dmx-bind:value="transaction_note" style="width: auto"></textarea>
                                    <button id="btn24" class="btn text-success" type="submit">
                                      <i class="fas fa-check"></i>
                                    </button>
                                  </form>
                                </td>

                                <td dmx-text="originating_wallet_name"></td>
                                <td dmx-text="destination_wallet_name"></td>




                                <td class="text-warning">
                                  <form id="updateTransactionApproved" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_wallet_transactions/update_wallet_transaction_approved.php" dmx-on:success="list_wallet_transactions.load({wallet_id: read_wallet.data.read_wallet.wallet_id});wallet_report_per_wallet.load({wallet_id: read_wallet.data.read_wallet.wallet_id})">
                                    <input id="transactionID" name="transaction_id" type="number" class="form-control visually-hidden" dmx-bind:value="transaction_id">
                                    <input id="transactionUserApproved" name="transaction_user_approved" type="number" class="form-control visually-hidden" dmx-bind:value="list_user_info.data.query_list_user_info.user_id">
                                    <button id="btn7" class="btn text-warning" type="submit" dmx-bind:disabled="(transaction_status=='Approved' || transaction_status == 'Received' || read_wallet.data.query_wallet_privileges_user[0].wallet_privilege_approve=='No')">
                                      <i class="far fa-thumbs-up"></i></button>
                                  </form><small class="text-muted" dmx-text="user_approved_username">With faded secondary text</small>



                                </td>
                                <td class="text-success">
                                  <form id="updateTransactionReceived" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_wallet_transactions/update_wallet_transaction_received.php" dmx-on:success="list_wallet_transactions.load({wallet_id: read_wallet.data.read_wallet.wallet_id});wallet_report_per_wallet.load({wallet_id: read_wallet.data.read_wallet.wallet_id})">
                                    <input id="transactionID1" name="transaction_id" type="number" class="form-control visually-hidden" dmx-bind:value="transaction_id">
                                    <input id="transactionUserReceived1" name="transaction_user_received" type="number" class="form-control visually-hidden" dmx-bind:value="list_user_info.data.query_list_user_info.user_id" dmx-bind:readonly="read_wallet.data.query_wallet_privileges_user[0].wallet_privilege_approve=='No'">
                                    <button id="btn4" class="btn text-success" type="submit" dmx-bind:disabled="(transaction_status=='Pending' || transaction_status == 'Received' || read_wallet.data.query_wallet_privileges_user[0].wallet_privilege_receive=='No')||(destination_wallet_id !== read_wallet.data.read_wallet.wallet_id &amp;&amp; destination_wallet_id !== null) ">
                                      <i class="far fa-thumbs-up"></i></button>
                                  </form><small class="text-muted" dmx-text="user_received_username">With faded secondary text</small>

                                </td>
                                <td class="text-success">
                                  <form id="deleteTransaction" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_wallet_transactions/delete_wallet_transaction.php" dmx-on:success="list_wallet_transactions.load({wallet_id: read_wallet.data.read_wallet.wallet_id});wallet_report_per_wallet.load({wallet_id: read_wallet.data.read_wallet.wallet_id})">
                                    <input id="transactionID2" name="transaction_id" type="number" class="form-control visually-hidden" dmx-bind:value="transaction_id">
                                    <input id="userDeleted" name="user_deleted" type="number" class="form-control visually-hidden" dmx-bind:value="list_user_info.data.query_list_user_info.user_id">
                                    <input id="deleteStatus" name="delete_status" class="form-control visually-hidden" dmx-bind:value="'deleted'">
                                    <button id="btn19" class="btn text-body" type="submit">
                                      <i class="far fa-trash-alt"></i></button>
                                  </form>

                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="tab-pane fade scrollable" id="navTabs1_3" role="tabpanel">
                    <div class="row mt-2">
                      <div class="col d-flex flex-row-reverse"></div>
                    </div>
                    <div class="row">
                      <div class="col">
                        <h1 class="text-warning">{{read_item_user.data.query.user_username}}</h1>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col bg-secondary ms-2 pt-4 pb-4 ps-4 pe-4 rounded">
                        <form is="dmx-serverconnect-form" id="updateWallet" method="post" action="dmxConnect/api/servo_wallets/update_wallet.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="read_customer.data.query_read_customer" dmx-on:success="read_wallet.load({wallet_id: read_wallet.data.read_wallet.wallet_id});notifies1.success('Success!');list_wallets.load({})" dmx-on:error="notifies1.warning('Error!')" dmx-on:submit="">
                          <div class="mb-3 row visually-hidden">
                            <label for="walletId" class="col-sm-2 col-form-label">{{trans.data.id[lang.value]}}</label>
                            <div class="col-sm-10">
                              <input type="number" class="form-control" id="walletId" name="wallet_id" dmx-bind:value="read_wallet.data.read_wallet.wallet_id" aria-describedby="inp_customer_id_help" readonly="true">
                            </div>
                          </div>
                          <div class="mb-3 row">
                            <label for="walletname" class="col-sm-2 col-form-label">{{trans.data.name[lang.value]}}</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="walletname" name="wallet_name" dmx-bind:value="read_wallet.data.read_wallet.wallet_name" aria-describedby="inp_customer_first_name_help">
                            </div>
                          </div>
                          <div class="mb-3 row">
                            <label for="inp_customer_last_name1" class="col-sm-2 col-form-label">{{trans.data.type[lang.value]}}</label>
                            <div class="col-sm-10">
                              <select id="walletType" class="form-select" name="wallet_type" dmx-bind:value="read_wallet.data.read_wallet.wallet_type">
                                <option value="internal">{{trans.data.getValueOrKey('internal')[lang.value]}}</option>
                                <option value="external">{{trans.data.getValueOrKey('external')[lang.value]}}</option>
                              </select>
                            </div>
                          </div>
                          <div class="mb-3 row">
                            <label for="inp_customer_last_name1" class="col-sm-2 col-form-label">{{trans.data.currency[lang.value]}}</label>
                            <div class="col-sm-10">
                              <select id="walletCurrency" class="form-select" name="wallet_currency" dmx-bind:options="load_currencies.data.query_load_currencies" optiontext="currency_name" optionvalue="currency_id" dmx-bind:value="read_wallet.data.read_wallet.wallet_currency">
                              </select>
                            </div>
                          </div>
                          <div class="mb-3 row">
                            <label for="inp_customer_last_name1" class="col-sm-2 col-form-label">{{trans.data.format[lang.value]}}</label>
                            <div class="col-sm-10">
                              <select id="walletFormat" class="form-select" name="wallet_format" dmx-bind:options="load_payment_methods.data.query" optiontext="payment_method_name" optionvalue="payment_method_id" dmx-bind:value="read_wallet.data.read_wallet.wallet_format">
                              </select>
                            </div>
                          </div>
                          <div class="mb-3 row">
                            <label for="inp_customer_last_name1" class="col-sm-2 col-form-label">{{trans.data.description[lang.value]}}</label>
                            <div class="col-sm-10">
                              <textarea type="text" class="form-control" id="walletDescription" name="wallet_description" aria-describedby="inp_customer_last_name_help" dmx-bind:value="read_wallet.data.read_wallet.wallet_description"></textarea>
                            </div>
                          </div>
                          <div class="row">

                            <div class="mb-3 row">

                              <div class="col-sm-2">&nbsp;</div>

                              <div class="col-sm-10" dmx-bind:condition="(profile_privileges.data.profile_privileges[0].edit_customer == 'Yes')">

                                <div id="conditional4" is="dmx-if" dmx-bind:condition="(profile_privileges.data.profile_privileges[0].edit_customer == 'Yes')"><button type="submit" class="btn btn-primary" dmx-bind:value="read_customer.data.query_read_customer.Save">Save</button></div>
                              </div>
                            </div>


                          </div>
                        </form>
                      </div>
                      <div class="col"></div>
                    </div>
                  </div>
                  <div class="tab-pane fade scrollable" id="navTabs1_1" role="tabpanel">
                    <div class="row mt-lg-2 mt-2" is="dmx-if" id="conditional5" dmx-bind:condition="list_user_info.data.query_list_user_info.user_profile=='Admin'">
                      <div class="col bg-light rounded ms-3 me-3 pt-2 pb-2 ps-3 pe-3">
                        <div class="table-responsive">
                          <table class="table table-hover table-sm">
                            <thead>
                              <tr class="text-center">
                                <th>#</th>
                                <th>{{trans.data.amount[lang.value]}}</th>

                                <th>{{trans.data.type[lang.value]}}</th>

                                <th>{{trans.data.dateTime[lang.value]}}</th>

                                <th>{{trans.data.paymentMethod[lang.value]}}</th>

                                <th>{{trans.data.status[lang.value]}}</th>

                                <th>{{trans.data.note[lang.value]}}</th>

                                <th>{{trans.data.origin[lang.value]}}</th>

                                <th>{{trans.data.destination[lang.value]}}</th>




                                <th></th>
                                <th></th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_wallet_transactions_deletes.data.list_wallet_transactions_paged_deletes.data" id="tableRepeat1">
                              <tr class="text-center">
                                <td dmx-text="transaction_id"></td>
                                <td dmx-text="transaction_amount" class="text-end"></td>
                                <td dmx-text="transaction_type"></td>
                                <td dmx-text="transaction_date"></td>
                                <td dmx-text="payment_method_name"></td>
                                <td>
                                  <h6 dmx-text="transaction_status" dmx-class:green-state="transaction_status=='Received'" dmx-class:yellow-state="transaction_status=='Approved'" dmx-class:grey-state="transaction_status=='Pending'" class="fw-bold pt-1 pb-1 ps-1 pe-1"></h6>
                                </td>
                                <td dmx-text="transaction_note">
                                </td>

                                <td dmx-text="originating_wallet_name"></td>
                                <td dmx-text="destination_wallet_name"></td>




                                <td class="text-warning">
                                  <button id="btn27" class="btn text-warning disabled" type="submit">
                                    <i class="far fa-thumbs-up"></i></button><small class="text-muted" dmx-text="user_approved_username">With faded secondary text</small>



                                </td>
                                <td class="text-success">
                                  <button id="btn27" class="btn text-success disabled" type="submit">
                                    <i class="far fa-thumbs-up"></i></button><small class="text-muted" dmx-text="user_received_username">With faded secondary text</small>

                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade scrollable" id="navTabs1_6" role="tabpanel">
                    <div class="row mt-2 ms-2 me-2" is="dmx-if" id="conditional3" dmx-bind:condition="list_user_info.data.query_list_user_info.user_profile=='Admin'">
                      <div class="col-lg-12 bg-light rounded pt-3 pb-3 ps-3 pe-3 mt-lg-2 pt-lg-3 pb-lg-1 ps-lg-3 pe-lg-3 col-auto">
                        <form is="dmx-serverconnect-form" id="createWalletPrivilege" method="post" action="dmxConnect/api/servo_wallets/create_wallet_privileges.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-on:success="notifies1.success('Success!');read_wallet.load({wallet_id: read_wallet.data.read_wallet.wallet_id, user_id: list_user_info.data.query_list_user_info.user_id});list_users_not_in_wallet.load({wallet_id: read_wallet.data.read_wallet.wallet_id})" dmx-on:error="notifies1.danger('Error!')" class="d-flex">
                          <div class="form-group mb-3 row">

                            <label for="inp_wallet_privilege_user_id" class="col-sm-2 col-form-label col-auto col-lg-auto">{{trans.data.user[lang.value]}}</label>
                            <div class="col-sm-10 me-lg-2 d-flex col-auto flex-wrap">
                              <input id="walletId" name="wallet_privilege_wallet_id" type="text" class="form-control visually-hidden" dmx-bind:value="read_wallet.data.read_wallet.wallet_id">
                              <select id="select7" class="form-select mb-1 me-2" dmx-bind:options="list_users_not_in_wallet.data.query_list_users_not_in_wallet" optiontext="user_fname+' '+user_lname+' '+user_username" optionvalue="user_id" name="wallet_privilege_user_id" required="" data-msg-required="!">
                                <option value="">-----</option>
                              </select>
                              <button type="submit" class="btn btn-primary text-white" dmx-bind:disabled="state.executing"><i class="fas fa-user-plus" style="margin-right: 2px;"></i>
                                {{trans.data.addToWallet[lang.value]}} <span class="spinner-border spinner-border-sm" role="status" dmx-show="state.executing"></span></button>
                            </div>
                          </div>
                        </form>
                      </div>
                      <div class="col bg-light mt-2 pt-2 pb-2 ps-2 pe-2 rounded">
                        <div class="table-responsive">
                          <table class="table table-hover table-sm">
                            <thead class="text-center">
                              <tr>
                                <th>{{trans.data.user[lang.value]}}</th>
                                <th></th>
                                <th class="text-start">{{trans.data.userPrivileges[lang.value]}}</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="read_wallet.data.query_wallet_privileges" id="tableRepeat3">
                              <tr>
                                <td dmx-text="user_fname"></td>
                                <td dmx-text="user_username"></td>
                                <td>
                                  <div class="row row-cols-12">
                                    <form id="update_wallet_privileges_user" class="d-flex" is="dmx-serverconnect-form" method="post" action="dmxConnect/api/servo_wallets/update_wallet_privileges.php" dmx-on:success="notifies1.success('Success!');read_wallet.load({wallet_id: read_wallet.data.read_wallet.wallet_id, user_id: list_user_info.data.query_list_user_info.user_id})">
                                      <div class="row row-cols-12">
                                        <div class="d-flex flex-wrap col-auto">
                                          <div class="row" id="depositOptionRow">
                                            <div class="col">

                                              <div class="btn-group" role="group" id="depositOptionButton">
                                                <button id="depositYes" class="btn bg-secondary" dmx-on:click="depositSelect.setValue('Yes');update_wallet_privileges_user.submit()" dmx-class:text-success="wallet_privilege_deposit=='Yes'">
                                                  <i class="far fa-thumbs-up"></i>
                                                </button>

                                                <button id="depositNo" class="btn bg-secondary" dmx-on:click="depositSelect.setValue('No');update_wallet_privileges_user.submit()" dmx-class:text-danger="wallet_privilege_deposit=='No'">
                                                  <i class="far fa-thumbs-down"></i>
                                                </button>

                                              </div>
                                              <p class="text-muted text-center">{{trans.data.Deposit[lang.value]}}</p>
                                              <select id="depositSelect" class="form-select form-select-sm visually-hidden" name="wallet_privilege_deposit" dmx-bind:value="wallet_privilege_deposit">
                                                <option value="">-----</option>
                                                <option value="Yes">{{trans.data.yes[lang.value]}}</option>
                                                <option value="No">{{trans.data.no[lang.value]}}</option>
                                              </select>
                                            </div>
                                          </div>
                                          <div class="row" id="transferoOptionRow">
                                            <div class="col">
                                              <div class="btn-group" role="group" id="depositOptionButton1">
                                                <button id="transferYes" class="btn bg-secondary" dmx-on:click="transferSelect.setValue('Yes');update_wallet_privileges_user.submit()" dmx-class:text-success="wallet_privilege_transfer=='Yes'">
                                                  <i class="far fa-thumbs-up"></i>
                                                </button>
                                                <button id="transferNo" class="btn bg-secondary" dmx-on:click="transferSelect.setValue('No');update_wallet_privileges_user.submit()" dmx-class:text-danger="wallet_privilege_transfer=='No'">
                                                  <i class="far fa-thumbs-down"></i>
                                                </button>
                                              </div>
                                              <p class="text-center">{{trans.data.wireTransfer[lang.value]}}</p><select id="transferSelect" class="form-select form-select-sm visually-hidden" name="wallet_privilege_transfer" dmx-bind:value="wallet_privilege_transfer">
                                                <option value="">-----</option>
                                                <option value="Yes">{{trans.data.yes[lang.value]}}</option>
                                                <option value="No">{{trans.data.no[lang.value]}}</option>
                                              </select>
                                            </div>
                                          </div>
                                          <div class="row" id="payoutOptionRow">
                                            <div class="col">
                                              <div class="btn-group" role="group" id="payoutOptionButton">
                                                <button id="payoutYes" class="btn bg-secondary" dmx-on:click="payoutSelect.setValue('Yes');update_wallet_privileges_user.submit()" dmx-class:text-success="wallet_privilege_payout=='Yes'">
                                                  <i class="far fa-thumbs-up"></i>
                                                </button>
                                                <button id="payoutNo" class="btn bg-secondary" dmx-on:click="payoutSelect.setValue('No');update_wallet_privileges_user.submit()" dmx-class:text-danger="wallet_privilege_payout=='No'">
                                                  <i class="far fa-thumbs-down"></i>
                                                </button>
                                              </div>
                                              <p class="text-center">{{trans.data.payment[lang.value]}}</p><select id="payoutSelect" class="form-select form-select-sm visually-hidden" name="wallet_privilege_payout" dmx-bind:value="wallet_privilege_payout">
                                                <option value="">-----</option>
                                                <option value="Yes">{{trans.data.yes[lang.value]}}</option>
                                                <option value="No">{{trans.data.no[lang.value]}}</option>
                                              </select>
                                            </div>
                                          </div>
                                          <div class="row" id="transferToOptionRow">
                                            <div class="col">
                                              <div class="btn-group" role="group" id="transfertoOptionButton">
                                                <button id="transfertoYes" class="btn bg-secondary" dmx-on:click="transfertoSelect.setValue('Yes');update_wallet_privileges_user.submit()" dmx-class:text-success="wallet_privilege_transfer_to=='Yes'">
                                                  <i class="far fa-thumbs-up"></i>
                                                </button>
                                                <button id="transfertoNo" class="btn bg-secondary" dmx-on:click="transfertoSelect.setValue('No');update_wallet_privileges_user.submit()" dmx-class:text-danger="wallet_privilege_transfer_to=='No'">
                                                  <i class="far fa-thumbs-down"></i>
                                                </button>
                                              </div>
                                              <p class="text-center">{{trans.data.transferto[lang.value]}}</p><select id="transfertoSelect" class="form-select form-select-sm visually-hidden d-sm-none d-md-block" name="wallet_privilege_transfer_to" dmx-bind:value="wallet_privilege_transfer_to">
                                                <option value="">-----</option>
                                                <option value="Yes">{{trans.data.yes[lang.value]}}</option>
                                                <option value="No">{{trans.data.no[lang.value]}}</option>
                                              </select>
                                            </div>
                                          </div>
                                          <div class="row" id="approveOptionRow">
                                            <div class="col">
                                              <div class="btn-group" role="group" id="approveOptionButton">
                                                <button id="approveYes" class="btn bg-secondary" dmx-on:click="approveSelect.setValue('Yes');update_wallet_privileges_user.submit()" dmx-class:text-success="wallet_privilege_approve=='Yes'">
                                                  <i class="far fa-thumbs-up"></i>
                                                </button>
                                                <button id="approveNo" class="btn bg-secondary" dmx-on:click="approveSelect.setValue('No');update_wallet_privileges_user.submit()" dmx-class:text-danger="wallet_privilege_approve=='No'">
                                                  <i class="far fa-thumbs-down"></i>
                                                </button>
                                              </div>
                                              <p class="text-center">{{trans.data.approve[lang.value]}}</p><select id="approveSelect" class="form-select form-select-sm visually-hidden d-sm-none d-md-block" name="wallet_privilege_approve" dmx-bind:value="wallet_privilege_approve">
                                                <option value="">-----</option>
                                                <option value="Yes">{{trans.data.yes[lang.value]}}</option>
                                                <option value="No">{{trans.data.no[lang.value]}}</option>
                                              </select>
                                            </div>
                                          </div>
                                          <div class="row" id="receiveOptionRow">
                                            <div class="col">
                                              <div class="btn-group" role="group" id="receiveOptionButton1">
                                                <button id="receiveYes" class="btn bg-secondary" dmx-on:click="receiveSelect.setValue('Yes');update_wallet_privileges_user.submit()" dmx-class:text-success="wallet_privilege_receive=='Yes'">
                                                  <i class="far fa-thumbs-up"></i>
                                                </button>
                                                <button id="receiveNo" class="btn bg-secondary" dmx-on:click="receiveSelect.setValue('No');update_wallet_privileges_user.submit()" dmx-class:text-danger="wallet_privilege_receive=='No'">
                                                  <i class="far fa-thumbs-down"></i>
                                                </button>
                                              </div>
                                              <p class="text-center">{{trans.data.receive[lang.value]}}</p><select id="receiveSelect" class="form-select form-select-sm visually-hidden d-sm-none d-md-block" name="wallet_privilege_receive" dmx-bind:value="wallet_privilege_receive">
                                                <option value="">-----</option>
                                                <option value="Yes">{{trans.data.yes[lang.value]}}</option>
                                                <option value="No">{{trans.data.no[lang.value]}}</option>
                                              </select>
                                            </div>
                                          </div>







                                        </div>
                                      </div>



                                      <input id="walletPrivilegeID2" name="wallet_privilege_id" type="text" class="form-control visually-hidden form-control-sm" dmx-bind:value="wallet_privilege_id">




                                    </form>
                                  </div>

                                </td>
                                <td class="text-center">
                                  <form id="delete_user_privilege_user" is="dmx-serverconnect-form" method="post" action="dmxConnect/api/servo_wallets/delete_wallet_privilege.php" dmx-on:success="notifies1.success('Success!');read_wallet.load({wallet_id: read_wallet.data.read_wallet.wallet_id, user_id: list_user_info.data.query_list_user_info.user_id});list_users_not_in_wallet.load({wallet_id: read_wallet.data.read_wallet.wallet_id})" dmx-on:error="notifies1.danger('Error!')">
                                    <input id="walletPrivilegeforDelete" name="wallet_privilege_id" type="text" class="form-control visually-hidden" dmx-bind:value="wallet_privilege_id">
                                    <button id="btn28" class="btn text-body" type="submit">
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
                </div>


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
    </div>
  </main>
  <main class="mt-4" id="printInvoice">

    <div class="modal readitem" id="printInvoiceModal" is="dmx-bs5-modal" tabindex="-1" dmx-on:hidden-bs-modal="customerOrderModal.show()" style="z-index: 9000000000000; background: white !important; border: none !important;">
      <div class="modal-dialog modal-xl" role="document" style="margin: 0px !important; width: 100% !important; height: 99% !important; max-width: 100% !important; max-height: 99% !important; boder: none !important;">
        <div class="modal-content" style="max-height: 100% !important; height: 100% !important; border: none !important;">
          <dmx-value id="InvoiceTitleContent" dmx-bind:value="trans.data.receipt[lang.value]"></dmx-value>
          <div class="modal-header justify-content-between" id="invoiceHead">
            <div class="d-block"><button id="proFormaButton" class="btn text-light btn-outline-light me-2" dmx-on:click="InvoiceTitleContent.setValue(trans.data.proFormaInvoice[lang.value])">{{trans.data.proFormaInvoice[lang.value]}}
              </button><button id="invoiceButton" class="btn text-light btn-outline-light me-2" dmx-on:click="InvoiceTitleContent.setValue(trans.data.invoice[lang.value])">{{trans.data.invoice[lang.value]}}
              </button><button id="receiptButton" class="btn text-light btn-outline-light me-2" dmx-on:click="InvoiceTitleContent.setValue(trans.data.receipt[lang.value])">{{trans.data.receipt[lang.value]}}
              </button><button id="loadingButton" class="btn text-light btn-outline-light me-2" dmx-on:click="InvoiceTitleContent.setValue(trans.data.deliveryNote[lang.value])">{{trans.data.deliveryNote[lang.value]}}
              </button><button id="printInvoiceButton2" class="btn text-light" onclick="window.print()"><i class="fas fa-print fa-lg"></i>
              </button><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>







          </div>
          <div class="modal-body" id="invoice" style="background: white;">
            <div class="container shadow-none" id="customerInvoiceContent">
              <div class="row justify-content-between justify-content-xxl-between" id="invoiceHeader">
                <div class="col">
                  <img dmx-bind:src="'uploads/'+companyInfo.data.query.company_logo" width="200">
                </div>
                <div class="col">
                </div>
                <div class="col">
                  <h6 class="text-info fw-bolder" dmx-text="companyInfo.data.query.company_address"></h6>
                </div>
              </div>
              <div class="row justify-content-center row-cols-1" id="receiptNumber">

                <div class="col">
                  <h3 class="text-info fw-bolder text-center" dmx-text="InvoiceTitleContent.value+' : '+readCustomerOrder.data.query.order_id" id="invoiceTitle"></h3>
                </div>
              </div>
              <div class="row row-cols-12" id="receiptInformation">

                <div class="col">
                  <h5 class="text-info fw-bolder text-start" dmx-text="trans.data.name[lang.value]+' : '+read_customer.data.query_read_customer.customer_first_name+' '+read_customer.data.query_read_customer.customer_last_name"></h5>
                </div>
                <div class="col">
                  <h5 class="text-info fw-bolder text-start" dmx-text="trans.data.info[lang.value]+' :  '+readCustomerOrder.data.query.order_extra_info"></h5>
                </div>
                <div class="col">
                  <h5 class="text-info fw-bolder text-start" dmx-text="trans.data.dateTime[lang.value]+' : '+dateTime.datetime"></h5>
                </div>
                <div class="col">
                  <h5 class="text-info fw-bolder text-start" dmx-text="trans.data.user[lang.value]+' : '+list_customer_orders.data.query_list_customer_orders.data[0].user_username"></h5>
                </div>
                <div class="col">
                  <h5 class="text-info fw-bolder text-start" dmx-text="trans.data.coverage[lang.value]+' :  '+readCustomerOrder.data.order_coverage_partner.customer_first_name+' '+readCustomerOrder.data.order_coverage_partner.customer_last_name+' '+readCustomerOrder.data.order_coverage_partner.customer_phone_number" id="orderInsurer3"></h5>
                </div>
              </div>
              <div class="row justify-content-center row-cols-1" id="receiptTable">

                <div class="col">
                  <div class="table-responsive bg-white" id="ReceiptOrderDetails" style="/* background: white */ /* border-color: white */ color: black !important;">
                    <table class="table" style="background: white;">
                      <thead style="background: #b0b0b0 !important;">
                        <tr style="color: black !important;">
                          <th>{{trans.data.product[lang.value]}}</th>
                          <th>{{trans.data.note[lang.value]}}</th>
                          <th>{{trans.data.quantity[lang.value]}}</th>
                          <th dmx-hide="InvoiceTitleContent.value==('Delivery Note')||InvoiceTitleContent.value==('Bordereaux de Livraison')">{{trans.data.price[lang.value]}}</th>
                          <th dmx-hide="InvoiceTitleContent.value==('Delivery Note')||InvoiceTitleContent.value==('Bordereaux de Livraison')">{{trans.data.total[lang.value]}}</th>
                        </tr>
                      </thead>
                      <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_order_items.data.query" id="receiptDetails">
                        <tr style="color: black !important;" class="fw-bold">
                          <td dmx-text="product_name"></td>
                          <td dmx-text="order_item_notes"></td>
                          <td dmx-text="order_item_quantity">

                          </td>
                          <td dmx-text="order_item_price.toNumber().formatNumber('0',',',',')" dmx-hide="InvoiceTitleContent.value==('Delivery Note')||InvoiceTitleContent.value==('Bordereaux de Livraison')">

                          </td>
                          <td dmx-text="(order_item_quantity * order_item_price).formatNumber('O', ',', ',')" dmx-hide="InvoiceTitleContent.value==('Delivery Note')||InvoiceTitleContent.value==('Bordereaux de Livraison')">

                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="row" style="color: black !important;" dmx-hide="InvoiceTitleContent.value==('Delivery Note'||'Bon De Livraison') ">
                <dmx-value id="varOrderTotal" dmx-bind:value="(list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`)).formatNumber('0', ',', ',')"></dmx-value>
                <dmx-value id="varOrderPaid" dmx-bind:value="list_customer_transactions_order.data.query.sum(`transaction_amount`)"></dmx-value>
                <dmx-value id="varCustomerTotal" dmx-bind:value="((list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))-((readCustomerOrder.data.query.coverage_percentage /100) * (list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))))"></dmx-value>
                <dmx-value id="varCustomerOwing" dmx-bind:value="(varOrderDiscounted.value - varOrderPaid.value).formatNumber('0',',',',')"></dmx-value>
                <dmx-value id="varOrderDiscounted" dmx-bind:value="((list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))-((readCustomerOrder.data.query.order_discount / 100) * (list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))))"></dmx-value>

                <dmx-value id="variableOrderTotal" dmx-bind:value="(list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))"></dmx-value>
                <dmx-value id="variableOrderPaid" dmx-bind:value="list_customer_transactions_order_totals.data.custom_list_customer_transactions_order_totals[0].Settlements"></dmx-value>
                <dmx-value id="variableOrderDiscount" dmx-bind:value="list_order_items.data.query[0].order_discount"></dmx-value>
                <dmx-value id="variableOrderCoverage" dmx-bind:value="list_order_items.data.query[0].coverage_percentage"></dmx-value>
                <dmx-value id="variableOrderCoverageTotal" dmx-bind:value="((list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))-(((100 - readCustomerOrder.data.query.coverage_percentage) /100) * (list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))))"></dmx-value>
                <dmx-value id="variableOrderCoveragePaid" dmx-bind:value="list_customer_transactions_order_totals.data.custom_list_customer_transactions_order_totals[0]['Coverage Settlements']"></dmx-value>
                <dmx-value id="variableCustomerTotal" dmx-bind:value="{{(variableOrderTotal.value * ((100 - variableOrderDiscount.value)/100) * ((100 - variableOrderCoverage.value)/100))}}"></dmx-value>
                <dmx-value id="variableCustomerTotalToPay" dmx-bind:value="(variableOrderPaid.value - variableCustomerTotal.value)"></dmx-value>
                <dmx-value id="variableCustomerOwing" dmx-bind:value="-(((list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))-((readCustomerOrder.data.query.coverage_percentage /100) * (list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))))- ((list_customer_transactions_order.data.query.sum(`transaction_amount`))))"></dmx-value>

                <div class="col d-flex justify-content-between" style="color: black !important;">
                  <div class="row row-cols-12 justify-content-center" id="total">
                    <div class="justify-content-xl-end col-xl-auto col-auto" id="total2">
                      <h6 class="ms-2 pt-2">{{trans.data.total[lang.value]}}:</h6>
                      <h6 class="fw-bold text-white" id="totalAmount">{{(list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`)).formatNumber('0', ',', ',')}}</h6>
                    </div>


















                  </div>
                  <div class="row row-cols-12 justify-content-center" id="invoiceDiscount">
                    <div class="justify-content-xl-end col-xl-auto col-auto text-center" id="discount">
                      <h6 class="ms-2 pt-2">{{trans.data.discount[lang.value]}}:</h6>
                      <h6 class="fw-bold text-white" dmx-text="readCustomerOrder.data.query.order_discount+'%'" id="invoiceDiscountAmount"></h6>
                    </div>


                  </div>
                  <div class="row justify-content-center" id="orderCoverage">
                    <div class="justify-content-xl-end col-xl-auto col-auto text-center" id="coverage1">
                      <h6 class="ms-2 pt-2">{{trans.data.coverage[lang.value]}}:</h6>
                      <h6 class="fw-bold text-white" id="CoverageAmount1">{{readCustomerOrder.data.query.coverage_percentage}}%</h6>
                    </div>
                  </div>
                  <div class="row justify-content-center" id="discountTotal">
                    <div class="justify-content-xl-end col-xl-auto col-auto text-center" id="discount1">
                      <h6 class="ms-2 pt-2 text-white">{{trans.data.discount[lang.value]}}:</h6>
                      <h6 class="fw-bold text-white" dmx-text="((list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))-((readCustomerOrder.data.query.order_discount / 100) * (list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`)))).formatNumber('0', ',', ',')" id="discountAmount1"></h6>
                    </div>
                  </div>
                  <div class="row justify-content-center" id="paid1">
                    <div class="justify-content-xl-end col-xl-auto offset-0 col-auto" id="paid">
                      <h6 class="ms-2 pt-2">{{trans.data.Paid[lang.value]}}:</h6>
                      <h6 class="fw-bold" dmx-text="list_customer_transactions_order.data.query.sum(`transaction_amount`).formatNumber('0', ',', ',')" id="paidAmount"></h6>
                    </div>
                  </div>
                  <div class="row justify-content-center" id="owing">
                    <div class="justify-content-xl-end col-xl-auto offset-0 col-auto text-center" id="owing1">
                      <h6 class="ms-2 pt-2">{{trans.data.owing[lang.value]}}:</h6>
                      <h5 class="fw-bolder" dmx-text="(-variableCustomerTotalToPay.value).formatNumber('0',',',',')" id="owingAmount"></h5>
                    </div>
                  </div>

                </div>
              </div>
              <div class="row justify-content-between row-cols-6 mt-4 mb-5">
                <div class="col">
                  <h5 dmx-text="trans.data.signatureClient[lang.value]" class="fw-bolder" style="color: black !important;"></h5>

                </div>
                <div class="col">
                  <h5 dmx-text="trans.data.signatureCashier[lang.value]" class="fw-bolder" style="color: black !important;"></h5>
                </div>
              </div>
              <div class="row align-items-end receipt-footer">
                <div class="col">
                  <h5 dmx-text="companyInfo.data.query.company_receipt_footer"></h5>
                </div>
              </div>
            </div>
            <div class="modal-footer">
            </div>
          </div>
        </div>
      </div>


    </div>
  </main>
  <?php include 'printTransactionReceipt.php'; ?>
  <main id="customerOrder">
    <div class="modal readitem shadow" id="customerOrderModal" is="dmx-bs5-modal" tabindex="-1" dmx-on:hidden-bs-modal="total_sales_per_waiter.load();updateOrderCashier.reset();readCustomerOrder.load({order_id: session_variables.data.current_order});list_customer_orders.load({}); readItemModal.show();list_customer_transactions_amounts.load({customer_id: session_variables.data.current_customer});list_customer_orders_totals.load({customer_id: readCustomerOrder.data.query.order_customer});session_variables.remove('current_order')">
      <dmx-value id="orderTotal" dmx-bind:value="list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`)"></dmx-value>
      <dmx-value id="netDeposit" dmx-bind:value="list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`)"></dmx-value>
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header">








            <button id="btn13" class="btn float-right text-white" data-bs-target="#printInvoiceModal" dmx-on:click="printReceipt.show()" dmx-animate-enter.duration:20000.delay:100="pulse" dmx-class:show-print-2="(read_item_order.data.query.order_status == 'Paid')" data-bs-toggle="modal" dmx-bs-popover="" dmx-bind:popover-title="trans.data.print[lang.value]" data-bs-trigger="hover focus">
              <i class="fas fa-print fa-lg"></i>
            </button><button id="btn10" class="btn float-right ms-2 text-info" data-bs-toggle="offcanvas" data-bs-target="#AddProductsToOrderOffCanvas" dmx-on:click="" dmx-hide="(read_item_order.data.query.order_status == 'Paid')" style="/*color: #ffec66 !important;*/" dmx-bs-popover="" dmx-bind:popover-title="trans.data.addProducts[lang.value]" data-bs-trigger="hover focus">
              <i class="fas fa-cart-plus fa-lg"></i>
            </button>
            <form id="close_order" is="dmx-serverconnect-form" method="post" action="dmxConnect/api/servo_orders/close_customer_order.php" dmx-on:success="notifies1.success('Success!');list_customer_orders.load({customer_id: session_variables.data.current_customer, offset: listCustomerOrders.data.offset, limit: c_order_sort_limit.value});list_order_items.load({order_id: session_variables.data.current_order});readCustomerOrder.load({order_id: session_variables.data.current_order})">
              <input id="update_order_order_id" name="order_id" type="text" class="form-control visually-hidden" dmx-bind:value="session_variables.data.current_order">
              <input id="update_order_user_id" name="servo_users_cashier_id" type="text" class="form-control visually-hidden" dmx-bind:value="session_variables.data.user_id">
              <input id="update_order_status" name="order_status" type="text" class="form-control visually-hidden" dmx-bind:value="'Paid'">
              <input id="update_order_time_paid" name="order_time_paid" type="datetime-local" class="form-control visually-hidden" dmx-bind:value="dateTime.datetime">
              <button id="btn18" class="btn float-right text-danger" data-bs-target="#AddProductsToOrderOffCanvas" dmx-show="(variableCustomerTotalToPay.value =='0')&amp;&amp;(OrderTotal.value !== '0')" style="color: #9bff66 !important;" type="submit" dmx-bind:disabled="(readCustomerOrder.data.query.order_status == 'Paid')" dmx-bs-popover="" dmx-bind:popover-title="trans.data.closeOrder[lang.value]" data-bs-trigger="hover focus">
                <i class="fas fa-lock fa-lg"></i>
              </button>
            </form>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

          </div>

          <div class="modal-body">
            <div class="offcanvas offcanvas-start" id="AddProductsToOrderOffCanvas" is="dmx-bs5-offcanvas" tabindex="-1" style="width: 99%;">
              <div class="offcanvas-header">
                <h3 class="offcanvas-title">{{trans.data.addProducts[lang.value]}}</h3>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
              </div>
              <div class="offcanvas-body">
                <div class="row scrollable row-cols-xxl-12 mt-2" id="productDisplay">
                  <div class="col">
                    <ul class="nav nav-tabs" id="navTabs1_tabs" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="navTabs1_1_1tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_1_1" role="tab" aria-controls="navTabs1_1" aria-selected="true">{{trans.data.products[lang.value]}}</a>
                      </li>
                      <li class="nav-item visually-hidden">
                        <a class="nav-link" id="navTabs1_3_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_1_3" role="tab" aria-controls="navTabs1_3" aria-selected="false">{{trans.data.services[lang.value]}}</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="navTabs1_2_2tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_2_2" role="tab" aria-controls="navTabs1_2" aria-selected="false">{{trans.data.grouped[lang.value]}}</a>
                      </li>

                    </ul>
                    <div class="tab-content" id="navTabs1_1content">
                      <div class="tab-pane fade show active" id="navTabs1_1_1" role="tabpanel">
                        <div class="row mt-2">
                          <div class="col"><input id="searchProducts1" name="text1" type="text" class="form-control mb-1" dmx-bind:value="searchProducts1.value" dmx-on:changed="load_products.load({service_id: list_user_shift_info.data.query_list_user_shift[0].servo_service_service_id, search: searchProducts1.value})" dmx-bind:placeholder="trans.data.search[lang.value]"></div>
                          <div class="col"><button id="btn17" class="btn ms-2 me-2 btn-info" dmx-on:click="searchProducts1.setValue(null);load_products.load({service_id: list_user_shift_info.data.query_list_user_shift[0].servo_service_service_id})">
                              <i class="fas fa-backspace"></i>
                            </button>
                            <button id="btn181" class="btn ms-2 me-2 btn-info text-body" dmx-on:click="AddProductsToOrderOffCanvas.btn181.toggleCategorySelect2.toggle()"> Categories
                              <dmx-toggle id="toggleCategorySelect2"></dmx-toggle><i class="fas fa-chevron-down"></i>
                            </button>
                            <button id="toggleProductPic" class="btn ms-2 me-2 btn-info text-body" dmx-on:click="AddProductsToOrderOffCanvas.toggleProductPic.toggleProductPictures.toggle()">
                              <dmx-toggle id="toggleProductPictures" checked="true"></dmx-toggle><i class="far fa-images"></i>
                            </button>

                          </div>
                        </div>
                        <div class="row mt-2">
                          <div class="col" is="dmx-if" id="conditional33" dmx-bind:condition="btn181.toggleCategorySelect2.checked">
                            <div id="repeatProductCategories" is="dmx-repeat" dmx-bind:repeat="load_product_categories.data.query"><button id="btn11" class="btn mb-1 me-1 btn-lg btn-info" dmx-text="product_category_name" dmx-on:click="searchProductCategories.setValue(product_categories_id);load_products.load({product_category: product_categories_id})"></button></div>

                          </div>
                        </div>
                        <div class="row mt-md-1 ms-md-1 me-md-1 mt-sm-1 ms-sm-1 me-sm-1 mt-xxl-1 ms-xxl-1 me-xxl-1 mt-xl-1 ms-xl-1 me-xl-1 mt-lg-1 ms-lg-1 me-lg-1 mt-0 ms-1 me-1" style="margin: 2px !important;">
                          <div class="flex-md-wrap flex-md-row justify-content-md-center rounded align-content-center mt-2 mb-2 ms-1 me-1 pt-3 pb-3 ps-3 pe-3 offset-md-1 col-sm-5 shadow-lg border-dark bg-secondary col-xxl-3 col-xl-3 col-lg-3 col-md-5 col-12" dmx-repeat:repeatproducts="load_products.data.repeat" style="padding-top: 0px !important; margin-top: .5rem !;" id="productRepeats">
                            <form id="form3" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_order_items/create_order_item.php" dmx-on:success="form3.reset();list_order_items.load({order_id: session_variables.data.current_order});notifies1.success('Success:'+product_name+' Added to Order');list_customer_transactions_order_totals.load({order_id: session_variables.data.current_order});list_customer_orders_totals.load({customer_id: session_variables.data.current_customer})" dmx-on:error="notifies1.danger('Error!')">
                              <div class="row mt-xxl-2 product-pic" id="productPic" dmx-hide="toggleProductPic.toggleProductPictures.checked">
                                <div class="col text-center" style="padding: 0px !important; height: 200px;" dmx-hide="product_picture==null">
                                  <img dmx-bind:src="'/servo/uploads/product_pictures/'+product_picture" width="100%" height="95%" loading="lazy" style="object-fit: cover;">
                                </div>
                                <div class="col text-center" style="padding: 0px !important; height: 200px;" dmx-hide="product_picture!==null">
                                  <img width="100%" height="95%" loading="lazy" style="object-fit: cover;" src="uploads/servo_no_image2.jpg">
                                </div>
                              </div>
                              <div class="row mt-2">
                                <div class="col d-flex justify-content-start">
                                  <h4 class="text-center fw-bold text-body">{{product_name}}</h4>
                                </div>
                                <div class="col d-flex justify-content-end">
                                  <h4 class="text-center text-body">{{product_price}}</h4>
                                </div>
                              </div>


                              <div class="row justify-content-between mb-2 text-center">
                                <div class="col-4">
                                  <button id="btn5" class="btn btn-lg btn-secondary text-light shadow" dmx-on:click="form3.inp_order_item_quantity.setValue((inp_order_item_quantity.value.toNumber()-1) )"><i class="fas fa-minus"></i>
                                  </button>
                                </div>

                                <div class="col-4 text-center" style="padding: 0px !important;"><input id="inp_order_item_quantity" name="order_item_quantity" type="number" class="form-control mb-sm-1 mb-2 form-control-lg" placeholder="1" min="" data-rule-min="1" data-msg-min="Min. 1" style="width: 100% !important; border: 1px solid #696969 !important; border: none; background-color: transparent !important; color: #a1a1a1 !important;" dmx-bind:value="1"></div>
                                <div class="col-4">
                                  <button id="btn16" class="btn btn-lg shadow btn-secondary text-light" dmx-on:click="form3.inp_order_item_quantity.setValue((inp_order_item_quantity.value.toNumber()+1) )"><i class="fas fa-plus"></i>
                                  </button>
                                </div>
                              </div><input id="inp_order_time_ordered" name="order_time_ordered" class="form-control mb-sm-1 mb-2 visually-hidden" type="datetime-local" dmx-bind:value="dateTime.datetime"><input id="inp_order_item_status" name="order_item_status" class="form-control mb-sm-1 mb-2 visually-hidden" value="Ordered"><input id="inp_order_id" name="servo_orders_order_id" type="number" class="form-control mb-sm-1 mb-2 visually-hidden" dmx-bind:value="session_variables.data.current_order"><input id="inp_order_product_id" name="servo_products_product_id" type="number" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="1" dmx-bind:value="product_id"><input id="inp_order_item_price" name="order_item_price" type="number" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="1" dmx-bind:value="product_price">
                              <input id="inp_order_item_type" name="order_item_type" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="1" dmx-bind:value="'Simple'">
                              <input id="inp_order_item_user_ordered2" name="servo_users_user_ordered" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="1" dmx-bind:value="session_variables.data.user_id" type="number">

                              <input id="orderitemDepartment" name="servo_departments_department_id" class="form-control mb-sm-1 mb-2 visually-hidden" placeholder="1" dmx-bind:value="sdc_department_id" type="number">
                              <textarea id="inp_order_notes" class="form-control" name="order_item_notes"></textarea>
                              <div class="row row-cols-xxl-7 mt-2 mt-sm-2 mt-md-2 mt-lg-2 mt-xl-2 mt-xxl-2" id="optionsrow">
                                <div class="w-25 flex-xxl-wrap justify-content-xxl-start d-flex col">
                                  <div id="repeatOptions" is="dmx-repeat" dmx-bind:repeat="query_list_options">
                                    <button class="btn mb-xxl-2 me-xxl-2 button-repeat btn-info" dmx-text="category_option_option" dmx-bind:value="category_option_option" dmx-on:click="form3.inp_order_notes.setValue(form3.inp_order_notes.value+' '+optionsButton.value+' ')" id="optionsButton">Button</button>
                                  </div>



                                </div>



                              </div>
                              <div class="row row-cols-xxl-7 mt-2 mb-2 row-cols-12 justify-content-between" id="buttons">
                                <div class="col"><button id="btn8" class="add-item-button btn align-self-end btn-lg lh-1 text-muted" dmx-on:click="form3.inp_order_notes.setValue(null)">
                                    <i class="fas fa-undo fa-lg"></i>
                                  </button></div>

                                <div class="col w-25 flex-xxl-wrap justify-content-xxl-start">
                                  <div id="repeatStock" is="dmx-repeat" dmx-bind:repeat="query_list_product_stock">
                                    <button id="btn33" class="btn fw-bold btn-secondary btn-sm" dmx-text="trans.data.inStock[lang.value]+': '+TotalStock" dmx-class:redlight.redlight="TotalStock<=product_min_stock">
                                    </button>

                                  </div>



                                </div>
                                <div class="col w-25 flex-xxl-wrap justify-content-xxl-start">



                                  <button id="btn12" class="add-item-button btn btn-warning align-self-end btn-lg" type="submit">
                                    <i class="fas fa-cart-plus fa-lg"></i>
                                  </button>
                                </div>

                              </div>
                            </form>
                          </div>
                        </div>

                      </div>

                      <div class="tab-pane fade" id="navTabs1_2_2" role="tabpanel">
                        <div class="row mt-md-1 mt-2">
                          <div class="flex-xxl-wrap border border-secondary col-md-4 mb-sm-2 me-sm-2 col-lg-3 col-xl-3 col-xxl-3 mt-xxl-0 mb-xxl-3 me-xxl-3 pt-xxl-3 pb-xxl-1 ps-xxl-1 pe-xxl-1 mb-1 me-1" dmx-repeat:repeatproductgroups="load_product_groups.data.repeat_list_product_groups">
                            <form id="form4"></form>
                            <div class="row mt-2">
                              <div class="col">
                                <h3 class="text-center text-warning" dmx-text="product_group_name"></h3>
                              </div>
                            </div>
                            <form id="addGroupedItemsToOrder" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_product_groups/add_grouped_products_to_order.php" dmx-on:success="form3.reset();list_order_items.load({order_id: session_variables.data.current_order});notifies1.success('Success:'+product_name+' Added to Order')">
                              <input id="text6" name="servo_orders_order_id" type="text" class="form-control visually-hidden" dmx-bind:value="session_variables.data.current_order">
                              <input id="text7" name="servo_users_user_ordered" type="text" class="form-control visually-hidden" dmx-bind:value="session_variables.data.user_id">
                              <input id="text8" name="product_group_id" type="text" class="form-control visually-hidden" dmx-bind:value="product_group_id">
                              <input id="text9" name="order_time_ordered" type="text" class="form-control visually-hidden" dmx-bind:value="dateTime.datetime">


                              <div class="row row-cols-xxl-7 justify-content-between mt-2 mb-2" id="buttons1">
                                <div class="col w-25 flex-xxl-wrap justify-content-xxl-start d-flex justify-content-end">



                                  <button id="btn14" class="add-item-button btn btn-warning align-self-end btn-lg" type="submit">
                                    <i class="fas fa-plus"></i>
                                  </button>
                                </div>

                              </div>
                            </form>
                          </div>
                        </div>
                      </div>

                    </div>
                  </div>


                </div>
              </div>
            </div>
            <div class="row" id="customerOrderHeader">
              <dmx-value id="variableOrderTotal" dmx-bind:value="(list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))"></dmx-value>
              <dmx-value id="variableOrderPaid" dmx-bind:value="list_customer_transactions_order_totals.data.custom_list_customer_transactions_order_totals[0].Settlements"></dmx-value>
              <dmx-value id="variableOrderDiscount" dmx-bind:value="list_order_items.data.query[0].order_discount"></dmx-value>
              <dmx-value id="variableOrderCoverage" dmx-bind:value="list_order_items.data.query[0].coverage_percentage"></dmx-value>
              <dmx-value id="variableOrderCoverageTotal" dmx-bind:value="((list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))-(((100 - readCustomerOrder.data.query.coverage_percentage) /100) * (list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))))"></dmx-value>
              <dmx-value id="variableOrderCoveragePaid" dmx-bind:value="list_customer_transactions_order_totals.data.custom_list_customer_transactions_order_totals[0]['Coverage Settlements']"></dmx-value>
              <dmx-value id="variableCustomerTotal" dmx-bind:value="{{(variableOrderTotal.value * ((100 - variableOrderDiscount.value)/100) * ((100 - variableOrderCoverage.value)/100))}}"></dmx-value>
              <dmx-value id="variableCustomerTotalToPay" dmx-bind:value="(variableOrderPaid.value - variableCustomerTotal.value)"></dmx-value>
              <dmx-value id="variableCustomerOwing" dmx-bind:value="(((list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))-((readCustomerOrder.data.query.coverage_percentage /100) * (list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))))- ((list_customer_transactions_order.data.query.sum(`transaction_amount`))))"></dmx-value>
              <div class="col" style="">
                <div class="d-block"></div>
                <div class="row row-cols-12 justify-content-start" id="orderInfo">
                  <div class="d-flex col-xl-auto rounded col-auto bg-info rounded-2 mb-2 ms-2 pt-1 ps-2 pe-2" id="orderIdHeader">
                    <h5 class="text-body fw-bold">{{trans.data.order[lang.value]}} : {{readCustomerOrder.data.query.order_id}}</h5>
                  </div>
                  <div class="justify-content-xl-end col-xl-auto col-auto" id="total01">
                    <h6 class="ms-2 pt-2">{{trans.data.total[lang.value]}}:</h6>
                  </div>


                  <div class="justify-content-xl-end col-xl-auto offset-xl-0 col-auto bg-secondary rounded-pill rounded-2 align-self-center align-self-xxl-center align-self-xl-center align-self-lg-center align-self-md-center pt-2" id="totalAmount">
                    <h6 class="text-success fw-bold">{{(list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`)).formatNumber('0', ',', ',')}}</h6>
                  </div>
                  <div class="justify-content-xl-end col-xl-auto col-auto" id="discount">
                    <h6 class="ms-2 pt-2">{{trans.data.discount[lang.value]}}:</h6>
                  </div>
                  <div class="justify-content-xl-end col-xl-auto offset-xl-0 col-auto bg-secondary rounded-pill rounded-2 align-self-center align-self-xxl-center align-self-xl-center align-self-lg-center align-self-md-center pt-2" id="disocuntAmount">
                    <h6 class="text-success fw-bold" dmx-text="((list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`))-((readCustomerOrder.data.query.order_discount / 100) * (list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`)))).formatNumber('0', ',', ',')"></h6>
                  </div>



                  <div class="justify-content-xl-end col-xl-auto col-auto" id="coverge">
                    <h6 class="ms-2 pt-2">{{trans.data.coverage[lang.value]}}:</h6>
                  </div>
                  <div class="justify-content-xl-end col-xl-auto offset-xl-0 col-auto bg-secondary rounded-pill rounded-2 align-self-center align-self-xxl-center align-self-xl-center align-self-lg-center align-self-md-center pt-2" id="coverageAmount">
                    <h6 class="text-success fw-bold">{{readCustomerOrder.data.query.coverage_percentage}}%</h6>
                  </div>
                  <div class="justify-content-xl-end col-xl-auto col-auto" id="toPay">
                    <h6 class="ms-2 pt-2">{{trans.data.customerTotal[lang.value]}}:</h6>
                  </div>
                  <div class="justify-content-xl-end col-xl-auto offset-xl-0 col-auto rounded-pill rounded-2 align-self-center align-self-xxl-center align-self-xl-center align-self-lg-center align-self-md-center pt-2 bg-secondary" id="toPayAmount">
                    <h6 class="fw-bold text-white">{{(variableOrderTotal.value * ((100 - variableOrderDiscount.value)/100) * ((100 - variableOrderCoverage.value)/100)).formatNumber('0',',',',')}}</h6>
                  </div>
                  <div class="justify-content-xl-end col-xl-auto offset-0 col-auto" id="paid">
                    <h6 class="ms-2 pt-2">{{trans.data.Paid[lang.value]}}:</h6>
                  </div>
                  <div class="justify-content-xl-end col-xl-auto offset-xl-0 col-auto rounded-pill rounded-2 align-self-center align-self-xxl-center align-self-xl-center align-self-lg-center align-self-md-center pt-2 bg-success" id="paidAmount">
                    <h6 class="fw-bold" dmx-text="list_customer_transactions_order_totals.data.custom_list_customer_transactions_order_totals[0].Settlements.toNumber().formatNumber('0', ',', ',').default(0)"></h6>
                  </div>
                  <div class="justify-content-xl-end col-xl-auto offset-0 col-auto" id="owing">
                    <h6 class="ms-2 pt-2">{{trans.data.owing[lang.value]}}:</h6>
                  </div>
                  <div class="justify-content-xl-end col-xl-auto offset-xl-0 col-auto rounded-pill rounded-2 align-self-center align-self-xxl-center align-self-xl-center align-self-lg-center align-self-md-center pt-2 bg-danger" id="owingAmount">
                    <h6 class="fw-bold">{{(variableCustomerTotalToPay.value).formatNumber('0',',',',')}}</h6>
                  </div>
                  <div class="justify-content-xl-end col-xl-auto col-auto fw-bold" id="coverageToPay6">
                    <h6 class="ms-2 pt-2 text-warning fw-bold">{{trans.data.coverageTotal[lang.value]}}:</h6>
                  </div>

                  <div class="justify-content-xl-end col-xl-auto offset-xl-0 col-auto rounded-pill rounded-2 align-self-center align-self-xxl-center align-self-xl-center align-self-lg-center align-self-md-center pt-2 border-warning bg-transparent text-warning border" id="coverageToPayAmount">
                    <h6 dmx-text="variableOrderCoverageTotal.value.formatNumber('0',',',',').default(0)" class="fw-bold">{{list_customer_transactions_order.data.query.sum(`transaction_amount`)}}</h6>
                  </div>
                  <div class="justify-content-xl-end col-xl-auto col-auto" id="coveragePaid">
                    <h6 class="ms-2 pt-2 text-warning fw-bold">{{trans.data.coveragePaid[lang.value]}}:</h6>
                  </div>
                  <div class="justify-content-xl-end col-xl-auto offset-xl-0 col-auto rounded-pill rounded-2 align-self-center align-self-xxl-center align-self-xl-center align-self-lg-center align-self-md-center pt-2 text-warning bg-transparent border-warning border" id="coveragePaidAmount">
                    <h6 dmx-text="variableOrderCoveragePaid.value.toNumber().formatNumber('0',',',',').default(0)" class="fw-bold">{{list_customer_transactions_order.data.query.sum(`transaction_amount`)}}</h6>
                  </div>
                  <div class="justify-content-xl-end col-xl-auto col-auto fw-bold" id="coverageOwing">
                    <h6 class="ms-2 pt-2 text-warning fw-bold">{{trans.data.coverageOwing[lang.value]}}:</h6>
                  </div>
                  <div class="justify-content-xl-end col-xl-auto offset-xl-0 col-auto rounded-pill rounded-2 align-self-center align-self-xxl-center align-self-xl-center align-self-lg-center align-self-md-center pt-2 bg-warning" id="coverageOwingAmount">
                    <h6 dmx-text="(variableOrderCoveragePaid.value  -variableOrderCoverageTotal.value).formatNumber('0',',',',').default(0)" class="fw-bold">{{list_customer_transactions_order.data.query.sum(`transaction_amount`)}}</h6>
                  </div>





                </div>

              </div>
            </div>



            <div class="row mt-4">
              <div class="col">
                <ul class="nav nav-tabs" id="navTabs1_tabs" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active text-light" id="navTabs1_13_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_13" role="tab" aria-controls="navTabs1_1" aria-selected="true" dmx-bs-tooltip="trans.data.overview[lang.value]" data-bs-trigger="hover" data-bs-placement="bottom">
                      <i class="fas fa-eye fa-lg"></i>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-light" id="navTabs1_23_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_23" role="tab" aria-controls="navTabs1_2" aria-selected="false" dmx-bs-tooltip="trans.data.orders[lang.value]" data-bs-trigger="hover" data-bs-placement="bottom"><i class="fas fa-cash-register fa-lg"></i>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-light" id="navTabs1_23_tab1" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_4" role="tab" aria-controls="navTabs1_2" aria-selected="false" dmx-bs-tooltip="trans.data.transactions[lang.value]" data-bs-trigger="hover" internal="" data-bs-placement="bottom">
                      <i class="fas fa-coins fa-lg"></i>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-warning" id="navTabs1_23_tab2" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_5" role="tab" aria-controls="navTabs1_2" aria-selected="false" dmx-bs-tooltip="trans.data.coverage[lang.value]" data-bs-trigger="hover" data-bs-placement="bottom">
                      <i class="fas fa-people-arrows fa-lg"></i>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-light" id="navTabs1_23_tab5" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_10" role="tab" aria-controls="navTabs1_2" aria-selected="false" dmx-on:click="list_order_items_deleted.load({order_id: session_variables.data.current_order})" dmx-bs-tooltip="trans.data.deleted[lang.value]" data-bs-trigger="hover" data-bs-placement="bottom">
                      <i class="fas fa-trash-alt fa-sm"></i>
                      <button id="btn30" class="btn text-danger fw-bold btn-sm mb-n1" dmx-text="list_order_items_deleted.data.list_order_items_deleted.count()"><span class="badge bg-secondary"></span>
                      </button></a>

                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-light" id="navTabs1_23_tab6" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_11" role="tab" aria-controls="navTabs1_2" aria-selected="false" dmx-on:click="list_order_items_deleted.load({order_id: session_variables.data.current_order})" dmx-bs-tooltip="trans.data.history[lang.value]" data-bs-trigger="hover focus" data-bs-placement="bottom">
                      <i class="fas fa-history fa-sm"></i>
                      <button id="btn34" class="btn text-danger fw-bold btn-sm mb-n1" dmx-text="list_value_updates_per_order.data.query_list_updates_per_order.count()"><span class="badge bg-secondary"></span>
                      </button></a>

                  </li>
                </ul>
                <div class="tab-content" id="navTabs13_content">
                  <div class="tab-pane fade show active" id="navTabs1_13" role="tabpanel">

                    <div class="row">
                      <div class="col">
                        <div class="table-responsive" id="order_details_table" style="">
                          <table class="table">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>{{trans.data.product[lang.value]}}</th>
                                <th>{{trans.data.dateTime[lang.value]}}</th>
                                <th>{{trans.data.status[lang.value]}}</th>
                                <th>{{trans.data.note[lang.value]}}</th>
                                <th>{{trans.data.quantity[lang.value]}}</th>
                                <th>{{trans.data.price[lang.value]}}</th>
                                <th>{{trans.data.attention[lang.value]}}</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_order_items.data.query" id="tableRepeat4">
                              <tr>
                                <td dmx-text="order_item_id"></td>
                                <td dmx-text="product_name"></td>
                                <td dmx-text="order_time_ordered"></td>
                                <td dmx-text="trans.data.getValueOrKey(order_item_status)[lang.value]"></td>
                                <td dmx-text="order_item_notes"></td>
                                <td>

                                  <form id="editQuantity" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_order_items/update_order_item_quantity.php" dmx-on:success="create_value_update_order_item_quantity.submit();notifies1.success('Success');list_order_items.load({order_id: session_variables.data.current_order});list_value_updates_per_order.load({order_id: readCustomerOrder.data.query.order_id})">
                                    <div class="row">
                                      <div class="col d-flex"><input id="newQuantity" name="order_item_quantity" type="number" class="form-control inline-edit" dmx-bind:value="order_item_quantity" dmx-bind:disabled="(read_item_order.data.query.order_status == 'Paid')" min="" data-rule-min="1" data-msg-min="Min. 1" dmx-on:updated="create_value_update_order_item_quantity.quantityUpdateNew.setValue(editQuantity.newQuantity.value)">
                                        <input id="editOrderId" name="order_item_id" type="number" class="form-control inline-edit visually-hidden" dmx-bind:value="order_item_id"><button id="btn21" class="btn text-success ms-3" data-bs-target="#productInfo" type="submit" dmx-hide="(read_item_order.data.query.order_status == 'Paid' ||editQuantity.newQuantity.value == order_item_quantity )"><i class="fas fa-check"><br></i></button>
                                      </div>
                                    </div>
                                  </form>
                                  <form id="create_value_update_order_item_quantity" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_value_updates/create_value_update_order_item_quantity.php" dmx-on:success="notifies1.success('Success');list_order_items.load({order_id: session_variables.data.current_order})">
                                    <div class="row">
                                      <div class="col d-flex"><input id="quantityUpdateOld" name="old_value" type="number" class="form-control inline-edit visually-hidden" dmx-bind:value="order_item_quantity">
                                        <input id="quantityUpdateNew" name="new_value" type="number" class="form-control inline-edit visually-hidden" dmx-bind:value="order_item_quantity">
                                        <input id="orderItemUpdatedID" name="updated_order_item_id" type="number" class="form-control inline-edit visually-hidden" dmx-bind:value="order_item_id">
                                        <input id="orderUpdatedID" name="updated_order_id" type="number" class="form-control inline-edit visually-hidden" dmx-bind:value="readCustomerOrder.data.query.order_id">
                                        <input id="productUpdatedID" name="updated_product_id" type="number" class="form-control inline-edit visually-hidden" dmx-bind:value="servo_products_product_id">
                                        <input id="userUpdatedQuantity" name="user_updated" type="number" class="form-control inline-edit visually-hidden" dmx-bind:value="list_user_shift_info.data.query_list_user_shift[0].servo_user_user_id">
                                        <input id="userUpdatedValue" name="updated_value" class="form-control inline-edit visually-hidden" dmx-bind:value="'Quantity'">
                                        <input id="updatedTime" name="updated_time" class="form-control inline-edit visually-hidden" dmx-bind:value="dateTime.datetime" type="datetime-local">
                                      </div>
                                    </div>
                                  </form>
                                </td>
                                <td>
                                  <form id="editPrice" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_order_items/update_order_item_price.php" dmx-on:success="notifies1.success('Success');list_order_items.load({order_id: session_variables.data.current_order})">
                                    <div class="row">
                                      <div class="col d-flex"><input id="newPrice" name="order_item_price" type="number" class="form-control inline-edit" dmx-bind:value="order_item_price" dmx-bind:disabled="(readCustomerOrder.data.query.order_status == 'Paid')&amp;&amp;(profile_privileges.data.profile_privileges[0].edit_order_item_price == 'No')" min="" data-rule-min="0" data-msg-min="Min. 0">
                                        <input id="editOrderItemPrice" name="order_item_id" type="number" class="form-control inline-edit visually-hidden" dmx-bind:value="order_item_id">
                                        <button id="btn23" class="btn text-success" data-bs-target="#productInfo" type="submit" dmx-hide="(read_item_order.data.query.order_status == 'Paid')&amp;&amp;(profile_privileges.data.profile_privileges[0].edit_order_item_price == 'No')"><i class="fas fa-check"><br></i>
                                        </button>
                                      </div>
                                    </div>
                                  </form>

                                </td>
                                <td dmx-text="user_username">

                                </td>
                                <td>
                                  <div class="row" is="dmx-if" id="conditional8" dmx-bind:condition="(profile_privileges.data.profile_privileges[0].delete_order_item == 'Yes')">
                                    <form id="form2" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_order_items/delete_order_item.php" dmx-on:success="notifies1.success('Success');list_order_items.load({order_id: session_variables.data.current_order});list_value_updates_per_order.load({order_id: readCustomerOrder.data.query.order_id});list_order_items_deleted.load({order_id: readCustomerOrder.data.query.order_id})" dmx-class:hidethis="" onsubmit=" return confirm('CONFIRM DELETE?');">
                                      <input id="text22" name="order_item_id" type="text" class="form-control visually-hidden" dmx-bind:value="order_item_id">
                                      <input id="text101" name="order_id" type="text" class="form-control visually-hidden" dmx-bind:value="session_variables.data.current_order">
                                      <input id="text111" name="user_deleted" type="text" class="form-control visually-hidden" dmx-bind:value="list_user_shift_info.data.query_list_user_shift[0].servo_user_user_id">
                                      <input id="text121" name="deleted_product_id" type="text" class="form-control visually-hidden" dmx-bind:value="servo_products_product_id">
                                      <input id="text15" name="deleted_item_quantity" type="number" class="form-control visually-hidden" dmx-bind:value="order_item_quantity">
                                      <input id="text16" name="deleted_order_item_id" type="number" class="form-control visually-hidden" dmx-bind:value="order_item_id">
                                      <button id="btn212" class="btn text-secondary" data-bs-target="#productInfo" type="submit"><i class="far fa-trash-alt fa-lg"><br></i></button>
                                    </form>
                                  </div>
                                  <form id="create_value_update_order_item_delete" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_value_updates/create_value_update_order_item_delete.php" dmx-on:success="notifies1.success('Success');list_order_items.load({order_id: session_variables.data.current_order})">
                                    <div class="row">
                                      <div class="col d-flex">
                                        <input id="orderItemUpdatedID2" name="order_item_id" type="number" class="form-control inline-edit visually-hidden" dmx-bind:value="order_item_id">
                                        <input id="userUpdatedUser" name="user_updated" type="number" class="form-control inline-edit visually-hidden" dmx-bind:value="list_user_shift_info.data.query_list_user_shift[0].servo_user_user_id">
                                        <input id="userUpdatedValue2" name="updated_value" class="form-control inline-edit visually-hidden" dmx-bind:value="'Deleted'">
                                        <input id="updatedTime2" name="updated_time" class="form-control inline-edit visually-hidden" dmx-bind:value="dateTime.datetime" type="datetime-local">
                                      </div>
                                    </div>
                                  </form>



                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>

                    </div>
                    <div class="row" id="orderUpdate">
                      <form is="dmx-serverconnect-form" id="updateOrderCashierStandard" method="post" action="dmxConnect/api/servo_orders/update_order_discount_note.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="read_item_order.data.query" dmx-on:success="notifies1.success('Success');list_order_items.load({order_id: session_variables.data.current_order});readCustomerOrder.load({order_id: session_variables.data.current_order})">


                        <div class="mb-3 row">
                          <label for="inp_order_extra_info" class="col-sm-2 col-form-label">{{trans.data.info[lang.value]}}</label>

                          <div class="col-sm-10">
                            <textarea type="textarea" class="form-control" id="inp_order_extra_info" name="order_extra_info" dmx-bind:value="readCustomerOrder.data.query.order_extra_info" aria-describedby="inp_order_notes_help"></textarea>
                          </div>
                        </div>
                        <div class="mb-3 row">
                          <label for="inp_order_notes" class="col-sm-2 col-form-label">{{trans.data.note[lang.value]}}</label>

                          <div class="col-sm-10">
                            <textarea type="textarea" class="form-control" id="inp_order_notes" name="order_notes" dmx-bind:value="readCustomerOrder.data.query.order_notes" aria-describedby="inp_order_notes_help"></textarea>
                          </div>
                        </div><input id="order_id3" name="order_id" class="form-control visually-hidden" dmx-bind:value="readCustomerOrder.data.query.order_id">

                        <div class="row">
                          <label for="inp_order_extra_info" class="col-sm-2 col-form-label">{{trans.data.discount[lang.value]}}</label>
                          <div class="col"><input id="orderDiscount" name="order_discount" class="form-control" dmx-bind:value="readCustomerOrder.data.query.order_discount" required="" type="number" data-msg-required="!" min="" data-rule-min="0" data-msg-min="Min 0!" dmx-bind:max="100">
                            <input id="orderCustomer" name="order_customer" class="form-control visually-hidden" dmx-bind:value="readCustomerOrder.data.query.order_customer">
                          </div>
                        </div>
                        <div class="row mt-2 mb-3">

                          <label for="inp_order_extra_info" class="col-sm-2 col-form-label"></label>
                          <div class="col-sm-10 d-flex justify-content-start">
                            <button class="btn me-md-1 pt-md-2 pb-md-2 ps-md-2 pe-md-2 me-2 bg-info" dmx-bind:value="read_item_order.data.query.Save" type="submit" dmx-hide="(read_item_order.data.query.order_status == 'Paid')">
                              <i class="fas fa-check fa-2x"></i>
                            </button>
                          </div>

                        </div>
                      </form>



                    </div>

                  </div>

                  <div class="tab-pane fade" id="navTabs1_23" role="tabpanel">
                    <div class="row mt-2 visually-hidden">
                      <form is="dmx-serverconnect-form" id="updateOrderCashier" method="post" action="dmxConnect/api/servo_orders/update_order_ordered_paid.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="read_item_order.data.query" dmx-on:success="notifies1.success('Success');list_orders_all_shift_department.load({current_shift: session_variables.data.current_shift, department_id: list_user_shift_info.data.query_list_user_shift[0].user_shift_department_id});updateOrderCashier.reset();readItemModal.hide()">
                        <input id="order_id1" name="order_id" class="form-control visually-hidden" dmx-bind:value="session_variables.data.current_order">
                        <div class="mb-3 row">
                          <label for="inp_order_amount_tendered" class="col-sm-2 col-form-label">{{trans.data.amountTendered[lang.value]}}</label>
                          <div class="col-sm-10">
                            <input type="number" class="form-control" id="inp_order_amount_tendered" name="order_amount_tendered" dmx-bind:value="readCustomerOrder.data.query.order_amount_tendered" aria-describedby="inp_order_notes_help" required="" data-msg-required="!" min="" data-msg-min="Min 0" dmx-bind:min="list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`)" dmx-bind:disabled="(readCustomerOrder.data.query.order_status == 'Paid')" data-rule-min="1">
                          </div>
                        </div>
                        <div class="mb-3 row">
                          <label for="inp_order_balance" class="col-sm-2 col-form-label">{{trans.data.balance[lang.value]}}</label>
                          <div class="col-sm-10">
                            <input type="number" class="form-control" id="inp_order_balance" name="order_balance" aria-describedby="inp_order_notes_help" dmx-bind:value="(updateOrderCashier.inp_order_amount_tendered.value - orderTotal.value)" disabled="true" dmx-bind:disabled="(readCustomerOrder.data.query.order_status == 'Paid')">
                          </div>
                        </div>
                        <div class="mb-3 row">
                          <div class="col-sm-10 visually-hidden">
                            <input type="number" class="form-control" id="inp_order_cashier_id" name="servo_users_cashier_id" aria-describedby="inp_order_notes_help" dmx-bind:value="session_variables.data.user_id">
                          </div>
                          <div class="col-sm-10 visually-hidden">
                            <input class="form-control" id="inp_order_order_status" name="order_status" dmx-bind:value="'Ordered'" aria-describedby="inp_order_notes_help">
                          </div>
                        </div>
                        <div class="mb-3 row">
                          <label for="customersearch" class="col-sm-2 col-form-label">{{trans.data.paymentMethod[lang.value]}}</label>
                          <div class="col-sm-10">




                            <select id="select2" class="form-select" dmx-bind:options="payment_methods.data.query" optiontext="payment_method_name" optionvalue="payment_method_id" dmx-bind:value="readCustomerOrder.data.query.servo_payment_methods_payment_method" name="servo_payment_methods_payment_method" dmx-bind:disabled="(read_item_order.data.query.order_status == 'Paid')">
                            </select>
                          </div>
                        </div>
                        <div class="mb-3 row">

                        </div>


                        <div class="mb-3 row">
                          <div class="col-sm-2">
                            &nbsp;</div>
                          <div class="col-sm-10 d-flex justify-content-start">
                            <button class="btn btn-success pt-md-2 pb-md-2 ps-md-2 pe-md-2" id="receive_payment" dmx-on:click="updateOrderCashier.inp_order_order_status.setValue('Paid');updateOrderCashier.submit()" dmx-bind:disabled="(read_item_order.data.query.order_status == 'Paid')"><i class="fas fa-hand-holding-usd fa-2x"></i></button>
                          </div>

                        </div>
                      </form>
                    </div>
                    <div class="row mt-2">
                      <form is="dmx-serverconnect-form" id="createOrderTransaction" method="post" action="dmxConnect/api/servo_customer_cash_transactions/create_transaction.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="read_item_order.data.query" dmx-on:success="createOrderTransaction.reset();list_customer_transactions.load({customer_id: session_variables.data.current_customer});list_customer_transactions_order.load({order_id: session_variables.data.current_order});notifies1.success('Success');updateOrderCashier.reset();readItemModal.hide();list_customer_transactions_amounts.load({customer_id: session_variables.data.current_customer});list_customer_orders_totals.load({customer_id: session_variables.data.current_customer});list_customer_transactions_order_totals.load({order_id: session_variables.data.current_order})" dmx-on:error="notifies1.danger('Error!')">
                        <input id="transactionOrderId" name="transaction_order" class="form-control visually-hidden" dmx-bind:value="session_variables.data.current_order">
                        <input id="transactionCustomer" name="customer_id" class="form-control visually-hidden" dmx-bind:value="session_variables.data.current_customer">
                        <input id="transactionDate" name="transaction_date" class="form-control visually-hidden" dmx-bind:value="dateTime.datetime">
                        <input id="transactionUserApproved" name="user_approved_id" class="form-control visually-hidden" dmx-bind:value="session_variables.data.user_id">
                        <input id="transactionType" name="transaction_type" class="form-control visually-hidden" dmx-bind:value="'Settlement'">
                        <div class="mb-3 row">
                          <label for="transactionAmount1" class="col-sm-2 col-form-label">{{trans.data.total[lang.value]}}</label>
                          <div class="col-sm-10">
                            <input type="number" class="form-control" id="transactionAmount" name="transaction_amount" aria-describedby="inp_order_notes_help" required="" data-msg-required="!" min="" data-msg-min="Min 0" dmx-bind:min="1" data-rule-min="1" dmx-bind:value="-variableCustomerTotalToPay.value.round(0)" dmx-bind:max="-(variableCustomerTotalToPay.value)" max="" data-msg-max=">Max!">
                          </div>
                        </div>
                        <div class="mb-3 row">
                          <label for="transactionAmountTendered" class="col-sm-2 col-form-label">{{trans.data.amountTendered[lang.value]}}</label>
                          <div class="col-sm-10">
                            <input type="number" class="form-control" id="transactionAmountTendered" name="transaction_amount_tendered" aria-describedby="inp_order_notes_help" required="" data-msg-required="!" min="" data-msg-min="Min 0" dmx-bind:min="createOrderTransaction.transactionAmount.value" data-rule-min="1">
                          </div>
                        </div>
                        <div class="mb-3 row">
                          <label for="transactinBalance" class="col-sm-2 col-form-label">{{trans.data.balance[lang.value]}}</label>
                          <div class="col-sm-10">
                            <input type="number" class="form-control" id="transactinBalance" name="transaction_balance" aria-describedby="inp_order_notes_help" dmx-bind:value="(createOrderTransaction.transactionAmountTendered.value - createOrderTransaction.transactionAmount.value)" readonly="true">
                          </div>
                        </div>
                        <div class="mb-3 row">
                          <label for="customersearch" class="col-sm-2 col-form-label">{{trans.data.paymentMethod[lang.value]}}</label>
                          <div class="col-sm-10 d-flex">




                            <select id="orderTransactionPaymentMethod" class="form-select" dmx-bind:options="payment_methods.data.query" optiontext="payment_method_name" optionvalue="payment_method_id" name="transaction_payment_method" dmx-bind:disabled="((read_item_order.data.query.order_status == 'Paid')||(createCustomerTransaction.transactionPaymentMethod1.value == '1'))" required="" data-msg-required="!">
                              <option selected="" value="">----</option>
                            </select>
                            <button id="payFromDeposit" class="btn ms-2 fw-bold btn-success" dmx-text="trans.data.payFromDeposit[lang.value]+' : '+netDeposits.value" dmx-on:click="createOrderTransaction.transactionType.disable();createOrderTransaction.orderTransactionPaymentMethod.setValue(1)" dmx-show="createOrderTransaction.transactionAmount.value<=netDeposits.value&amp;&amp;createOrderTransaction.transactionAmount.value>0"></button>
                          </div>
                        </div>


                        <div class="mb-3 row">
                          <div class="col-sm-2">
                            &nbsp;</div>
                          <div class="col-sm-10 d-flex justify-content-start">
                            <button class="btn btn-success pt-md-2 pb-md-2 ps-md-2 pe-md-2" id="receive_payment1" dmx-on:click="updateOrderCashier.inp_order_order_status.setValue('Paid');updateOrderCashier.submit()" dmx-bind:disabled="(read_item_order.data.query.order_status == 'Paid')" type="submit" dmx-show="createOrderTransaction.transactionAmount.value>0"><i class="fas fa-hand-holding-usd fa-2x"></i></button>
                          </div>

                        </div>
                      </form>
                    </div>
                  </div>


                  <div class="tab-pane fade" id="navTabs1_4" role="tabpanel">
                    <div class="row mt-2">
                      <div class="col">
                        <div class="table-responsive">
                          <table class="table table-hover table-sm">
                            <thead>
                              <tr>
                                <th>#</th>

                                <th>{{trans.data.type[lang.value]}}</th>
                                <th>{{trans.data.attention[lang.value]}}</th>
                                <th>{{trans.data.paymentMethod[lang.value]}}</th>
                                <th>{{trans.data.dateTime[lang.value]}}</th>
                                <th>{{trans.data.status[lang.value]}}</th>
                                <th>{{trans.data.note[lang.value]}}</th>
                                <th>{{trans.data.total[lang.value]}}</th>
                                <th>{{trans.data.amountTendered[lang.value]}}</th>
                                <th>{{trans.data.balance[lang.value]}}</th>
                                <th></th>
                                <th></th>

                              </tr>
                            </thead>
                            <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_customer_transactions_order.data.query" id="tableRepeat5">
                              <tr>
                                <td dmx-text="customer_transaction_id"></td>

                                <td dmx-text="transaction_type"></td>
                                <td dmx-text="user_fname+' '+user_lname+' | '+user_username"></td>
                                <td dmx-text="payment_method_name"></td>
                                <td dmx-text="transaction_date"></td>
                                <td dmx-text="transaction_status"></td>
                                <td dmx-text="transaction_note"></td>

                                <td dmx-text="transaction_amount.formatNumber('0', ',', ',')"></td>
                                <td dmx-text="transaction_amount_tendered.formatNumber('0', ',', ',')"></td>
                                <td dmx-text="transaction_balance.formatNumber('0', ',', ',')"></td>
                                <td>
                                  <button id="btn15" class="btn" data-bs-toggle="modal" data-bs-target="#printTransactionReceiptModalGeneral" dmx-on:click="read_customer_transaction.load({customer_cash_transaction_id: customer_transaction_id})"><i class="fas fa-receipt fa-lg"></i>
                                  </button>
                                </td>
                                <td>
                                  <form id="deleteOrderTransaction" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_customer_cash_transactions/delete_transaction.php" dmx-on:success="list_customer_transactions_order.load({order_id: readCustomerOrder.data.query.order_id});list_customer_transactions.load({customer_id: session_variables.data.current_customer});list_customer_transactions_order_totals.load({order_id: session_variables.data.current_order})" onsubmit=" return confirm('CONFIRM DELETE?');">
                                    <input id="text3" name="customer_transaction_id" type="text" class="form-control visually-hidden" dmx-bind:value="customer_transaction_id">
                                    <button id="btn9" class="btn text-secondary" type="submit">
                                      <i class="far fa-trash-alt fa-lg"></i>
                                    </button>
                                  </form>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                    <div class="row mt-2 visually-hidden">
                    </div>

                  </div>
                  <div class="tab-pane fade" id="navTabs1_5" role="tabpanel">
                    <div class="row mt-2 visually-hidden">
                      <form is="dmx-serverconnect-form" id="updateOrderCashier1" method="post" action="dmxConnect/api/servo_orders/update_order_ordered_paid.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="read_item_order.data.query" dmx-on:success="notifies1.success('Success');list_orders_all_shift_department.load({current_shift: session_variables.data.current_shift, department_id: list_user_shift_info.data.query_list_user_shift[0].user_shift_department_id});updateOrderCashier.reset();readItemModal.hide()">
                        <input id="order_id2" name="order_id1" class="form-control visually-hidden" dmx-bind:value="session_variables.data.current_order">
                        <div class="mb-3 row">
                          <label for="inp_order_amount_tendered1" class="col-sm-2 col-form-label">{{trans.data.amountTendered[lang.value]}}</label>
                          <div class="col-sm-10">
                            <input type="number" class="form-control" id="inp_order_amount_tendered1" name="order_amount_tendered1" dmx-bind:value="readCustomerOrder.data.query.order_amount_tendered" aria-describedby="inp_order_notes_help" required="" data-msg-required="!" min="" data-msg-min="Min 0" dmx-bind:min="list_order_items.data.query.sum(`(order_item_price * order_item_quantity)`)" dmx-bind:disabled="(readCustomerOrder.data.query.order_status == 'Paid')" data-rule-min="1">
                          </div>
                        </div>
                        <div class="mb-3 row">
                          <label for="inp_order_balance1" class="col-sm-2 col-form-label">{{trans.data.balance[lang.value]}}</label>
                          <div class="col-sm-10">
                            <input type="number" class="form-control" id="inp_order_balance1" name="order_balance1" aria-describedby="inp_order_notes_help" dmx-bind:value="(updateOrderCashier.inp_order_amount_tendered.value - orderTotal.value)" disabled="true" dmx-bind:disabled="(readCustomerOrder.data.query.order_status == 'Paid')">
                          </div>
                        </div>
                        <div class="mb-3 row">
                          <div class="col-sm-10 visually-hidden">
                            <input type="number" class="form-control" id="inp_order_cashier_id1" name="servo_users_cashier_id1" aria-describedby="inp_order_notes_help" dmx-bind:value="session_variables.data.user_id">
                          </div>
                          <div class="col-sm-10 visually-hidden">
                            <input class="form-control" id="inp_order_order_status1" name="order_status1" dmx-bind:value="'Ordered'" aria-describedby="inp_order_notes_help">
                          </div>
                        </div>
                        <div class="mb-3 row">
                          <label for="customersearch" class="col-sm-2 col-form-label">{{trans.data.paymentMethod[lang.value]}}</label>
                          <div class="col-sm-10">




                            <select id="select3" class="form-select" dmx-bind:options="payment_methods.data.query" optiontext="payment_method_name" optionvalue="payment_method_id" dmx-bind:value="readCustomerOrder.data.query.servo_payment_methods_payment_method" name="servo_payment_methods_payment_method1" dmx-bind:disabled="(read_item_order.data.query.order_status == 'Paid')">
                            </select>
                          </div>
                        </div>
                        <div class="mb-3 row">

                        </div>


                        <div class="mb-3 row">
                          <div class="col-sm-2">
                            &nbsp;</div>
                          <div class="col-sm-10 d-flex justify-content-start">
                            <button class="btn btn-success pt-md-2 pb-md-2 ps-md-2 pe-md-2" id="receive_payment2" dmx-on:click="updateOrderCashier.inp_order_order_status.setValue('Paid');updateOrderCashier.submit()" dmx-bind:disabled="(read_item_order.data.query.order_status == 'Paid')"><i class="fas fa-hand-holding-usd fa-2x"></i></button>
                          </div>

                        </div>
                      </form>
                    </div>
                    <div class="row mt-2">
                      <form is="dmx-serverconnect-form" id="coveragePartner" method="post" action="dmxConnect/api/servo_orders/update_order_coverage_partner.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="read_item_order.data.query" dmx-on:success="notifies1.success('Success');readCustomerOrder.load({order_id: session_variables.data.current_order});list_order_items.load({order_id: session_variables.data.current_order})" dmx-on:error="notifies1.danger('Error!')">
                        <input id="orderIdCoverage" name="order_id" class="form-control visually-hidden" dmx-bind:value="session_variables.data.current_order">
                        <input id="orderCoverageStatus" name="coverage_payment_status" class="form-control visually-hidden" dmx-bind:value="'Ordered'">
                        <div class="mb-3 row">
                          <label for="transactionAmount1" class="col-sm-2 col-form-label">{{trans.data.coverage[lang.value]}}</label>
                          <div class="col-sm-10">
                            <input type="number" class="form-control" id="coveragePercentage" name="coverage_percentage" aria-describedby="inp_order_notes_help" required="" data-msg-required="!" dmx-bind:value="readCustomerOrder.data.query.coverage_percentage" min="" data-rule-min="0" data-msg-min="MIn 0!" dmx-bind:max="100">
                          </div>
                        </div>
                        <div class="mb-3 row">
                          <label for="coveragePartner" class="col-sm-2 col-form-label">{{trans.data.Partner[lang.value]}}</label>
                          <div class="col-sm-10">
                            <select id="select4" class="form-select" dmx-bind:options="list_customers_special.data.query_list_customers" optiontext="customer_first_name+' '+customer_last_name+' '+customer_phone_number" optionvalue="customer_id" name="coverage_partner" dmx-bind:value="readCustomerOrder.data.query.coverage_partner">
                              <option value="%">{{trans.data.partner[lang.value]}}</option>
                            </select>
                          </div>
                        </div>


                        <div class="mb-3 row">
                          <div class="col-sm-10 d-flex justify-content-start">
                            <button class="btn btn-success pt-md-2 pb-md-2 ps-md-2 pe-md-2" id="receive_payment22" dmx-bind:disabled="(read_item_order.data.query.order_status == 'Paid')" type="submit"><i class="fas fa-check"></i></button>
                          </div>

                        </div>
                      </form>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="navTabs1_10" role="tabpanel">

                    <div class="row">
                      <div class="col">
                        <div class="table-responsive">
                          <table class="table table-hover table-sm">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>{{trans.data.product[lang.value]}}</th>
                                <th>{{trans.data.quantity[lang.value]}}</th>
                                <th>{{trans.data.dateTime[lang.value]}}</th>
                                <th>{{trans.data.user[lang.value]}}</th>
                                <th>{{trans.data.user[lang.value]}}</th>
                              </tr>
                            </thead>
                            <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_order_items_deleted.data.list_order_items_deleted" id="tableRepeat9">
                              <tr>
                                <td dmx-text="deleted_order_item_id"></td>
                                <td dmx-text="product_name"></td>
                                <td dmx-text="deleted_item_quantity"></td>
                                <td dmx-text="time_deleted"></td>
                                <td dmx-text="user_username"></td>
                                <td>
                                  <div class="row" id="deleteDeletedItem" is="dmx-if" dmx-bind:condition="(profile_privileges.data.profile_privileges[0].delete_order == 'Yes')">
                                    <form id="deleteItemDelete" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_order_items/delete_order_item_deleted.php" dmx-on:success="notifies1.success('Success!');list_order_items_deleted.load({order_id: session_variables.data.current_order})" dmx-on:error="notifies1.warning('Error')">
                                      <input id="deleteOrderItemId" name="order_item_delete_id" type="text" class="form-control visually-hidden" dmx-bind:value="order_item_delete_id">
                                      <button id="btn31" class="btn text-secondary" type="submit">
                                        <i class="far fa-trash-alt fa-lg"></i>
                                      </button>
                                    </form>
                                  </div>

                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>

                    </div>

                  </div>
                  <div class="tab-pane fade" id="navTabs1_11" role="tabpanel">

                    <div class="row">
                      <div class="col">
                        <div class="table-responsive">
                          <table class="table table-hover table-sm">
                            <thead>
                              <tr>
                                <th>Updated time</th>
                                <th>Order item</th>
                                <th>Product name</th>
                                <th>Updated value</th>
                                <th>Old value</th>
                                <th>New value</th>
                                <th>User username</th>
                              </tr>
                            </thead>
                            <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_value_updates_per_order.data.query_list_updates_per_order" id="tableRepeat12">
                              <tr>
                                <td dmx-text="updated_time"></td>
                                <td dmx-text="updated_order_item_id"></td>
                                <td dmx-text="product_name"></td>
                                <td dmx-text="updated_value"></td>
                                <td dmx-text="old_value"></td>
                                <td dmx-text="new_value"></td>
                                <td dmx-text="user_username"></td>
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
            <div class="modal-footer">

            </div>
            <div class="row text-end" is="dmx-if" id="conditional7" dmx-bind:condition="(profile_privileges.data.profile_privileges[0].delete_order == 'Yes')">
              <form id="form1" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_orders/delete_order_and_items.php" dmx-on:success="notifies1.success('Success');list_orders_all_shift.load();customerOrderModal.hide();list_customer_orders_totals.load({customer_id: session_variables.data.current_customer});list_customer_transactions_amounts.load({customer_id: session_variables.data.current_customer})" onsubmit=" return confirm('CONFIRM DELETE?');">
                <input id="text12" name="order_id" type="number" class="form-control visually-hidden" dmx-bind:value="readCustomerOrder.data.query.order_id">

                <button id="btn16" class="btn text-secondary" type="submit">
                  <i class="far fa-trash-alt fa-lg"></i>
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <main>
    <div class="mt-auto ms-2 me-2">




      <div class="row servo-page-header">
        <div class="col-auto" dmx-animate-enter="slideInLeft">
          <i class="fas fa-coins fa-2x"></i>
        </div>
        <div class="col-auto page-heading">
          <h4 class="servo-page-heading">{{trans.data.finance[lang.value]}}</h4>
        </div>
        <div class="col style13 page-button d-flex justify-content-end" id="pagebuttons">
          <div id="conditional1" is="dmx-if" dmx-bind:condition="(profile_privileges.data.profile_privileges[0].create_customer == 'Yes')"><button id="btn1" class="btn style12 fw-light add-button text-body bg-light pill me-2" data-bs-toggle="modal" data-bs-target="#createItemModal" style="float: right;"><i class="fas fa-plus"></i>
            </button></div>

        </div>
      </div>
      <div class="row">
        <div class="col">
          <ul class="nav nav-tabs nav-fill" id="navTabs1_tabs" role="tablist">
            <li class="nav-item">
              <a class="nav-link active text-body fw-bold" id="navTabsOverview" data-bs-toggle="tab" href="#" data-bs-target="#navTabs_overview" role="tab" aria-controls="navTabs1_1" aria-selected="true">
                <i class="far fa-chart-bar fa-sm" style="margin-right: 3px;"></i>
                {{trans.data.overview[lang.value]}}</a>

            </li>
            <li class="nav-item">
              <a class="nav-link text-body fw-bold" id="navTabsCustomerList" data-bs-toggle="tab" href="#" data-bs-target="#navTabs_customer_list" role="tab" aria-controls="navTabs1_2" aria-selected="false"><i class="fas fa-wallet" style="margin-right: 5px;"></i>{{trans.data.wallets[lang.value]}}</a>
            </li>
          </ul>
          <div class="tab-content" id="navTabs1_content">
            <div class="tab-pane fade show active" id="navTabs_overview" role="tabpanel">
              <dmx-value id="variableTotalCustomerDebt1" dmx-bind:value="variableTotalCustomerDebtVariable.value.toNumber()"></dmx-value>
              <dmx-value id="variableTotalCustomerTransactions1" dmx-bind:value="list_customer_transactions_amounts.data.custom_list_transaction_amounts[0].Settlements.toNumber()"></dmx-value>
              <dmx-value id="variableTotalCustomerDebtVariable1" dmx-bind:value="((list_customer_transactions_amounts.data.custom_list_transaction_amounts[0].Settlements).toNumber().default(0) -(list_customer_orders_totals.data.custom_list_customer_orders_totals[0]['Customer Orders Totals']).toNumber().default(0)).formatNumber('0',',',',')"></dmx-value>
              <dmx-value id="variableTotalCustomerCoverageDebt1" dmx-bind:value="((list_customer_transactions_amounts.data.custom_list_transaction_amounts[0].Settlements).toNumber().default(0) -(list_customer_orders_totals.data.custom_list_customer_orders_totals[0]['Customer Orders Totals']).toNumber().default(0)).formatNumber('0',',',',')"></dmx-value>
              <dmx-value id="variableTotalCoverageDebt1" dmx-bind:value="((list_customer_orders_totals.data.custom_list_customer_orders_totals[0]['Coverage Totals']).toNumber().default(0)).formatNumber('0',',',',')"></dmx-value>
              <dmx-value id="variableTotalCovered1" dmx-bind:value="((list_customer_orders_totals.data.custom_list_customer_orders_totals[0]['Total Covered']).toNumber().default(0)).formatNumber('0',',',',')"></dmx-value>
              <div class="row bg-light rounded mt-2 ms-1 me-1 pb-4">

                <div class="col-12 col-lg-6">
                  <div class="row mt-2 ms-0">
                    <div id="totalDebt1" class="text-center mt-2 me-2 pt-4 pb-4 ps-4 pe-4 col rounded" style="background: #ff2a5c !important;">
                      <div class="row">
                        <div class="col">
                          <i class="far fa-question-circle fa-lg"></i>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <h1 dmx-text=""></h1>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <h4 dmx-text="trans.data.totalDebt[lang.value]">{{trans.data.totalOrders[lang.value]}}</h4>
                        </div>
                      </div>
                    </div>
                    <div class="bg-info text-center mt-2 me-2 pt-4 pb-4 ps-4 pe-4 col rounded" id="totalDeposits1" style="background: #ff2afa !important;">

                      <div class="row">
                        <div class="col">
                          <i class="fas fa-piggy-bank fa-lg"></i>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <h1 dmx-text="(totalDeposits.value-(totalDepositPayments.value + totalDepositSettlements.value)).formatNumber('0',',',',')"></h1>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">

                          <h4 dmx-text="trans.data.totalDeposits[lang.value]"></h4>
                        </div>
                      </div>
                    </div>

                    <div id="totalSettlements1" class="bg-info text-center mt-2 me-2 pt-4 pb-4 ps-4 pe-4 col rounded" style="background: #07b853 !important;">
                      <div class="row">
                        <div class="col">
                          <i class="fas fa-arrow-circle-down fa-lg"></i>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <h1 dmx-text="list_customer_transactions_amounts.data.custom_list_transaction_amounts[0].Settlements.toNumber().formatNumber('0', ',', ',').default(0)"></h1>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <h4>{{trans.data.totalSettlements[lang.value]}}</h4>
                        </div>
                      </div>
                    </div>
                    <div id="totalPayout1" class="text-center mt-2 me-2 pt-4 pb-4 ps-4 pe-4 col rounded" style="background: #b81f07 !important;">
                      <div class="row">
                        <div class="col">
                          <i class="fas fa-angle-up fa-lg"></i>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <h1 dmx-text="(list_customer_transactions.data.query.where(`transaction_type`, 'Payment', '==')).sum('transaction_amount').formatNumber('0',',',',').default('0')"></h1>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <h4>{{trans.data.totalPayout[lang.value]}}</h4>
                        </div>
                      </div>
                    </div>
                    <div id="totalOrders1" class="bg-info text-center mt-2 me-2 pt-4 pb-4 ps-4 pe-4 col visually-hidden" style="background: #606370 !important;">
                      <div class="row">
                        <div class="col">
                          <i class="fas fa-clipboard-list fa-lg"></i>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <h1 dmx-text="list_customer_orders.data.query_list_customer_orders.data.count().formatNumber('0',',',',').default(0)">{{trans.data.totalOrders[lang.value]}}</h1>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">

                          <h4 dmx-text="trans.data.orders[lang.value]"></h4>
                        </div>
                      </div>
                    </div>
                    <div id="totalCoverageDebt1" class="bg-info text-center mt-2 me-2 pt-4 pb-4 ps-4 pe-4 col visually-hidden" style="background: #ff8f2b !important;">
                      <div class="row">
                        <div class="col">
                          <i class="fas fa-people-arrows fa-lg"></i>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <h1 dmx-text="variableTotalCoverageDebt.value.default(0)">{{trans.data.totalOrders[lang.value]}}</h1>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">

                          <h4 dmx-text="trans.data.totalCoverage[lang.value]"></h4>
                        </div>
                      </div>
                    </div>
                    <div id="totalCovered1" class="text-center mt-2 me-2 pt-4 pb-4 ps-4 pe-4 col visually-hidden" style="background: #176de0 !important;" dmx-hide="(read_customer.data.query_read_customer.customer_class == 'standard')">
                      <div class="row">
                        <div class="col">
                          <i class="fas fa-arrow-circle-up fa-lg"></i>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <h1 dmx-text="variableTotalCovered.value.default(0)">{{trans.data.totalOrders[lang.value]}}</h1>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">

                          <h4 dmx-text="trans.data.totalCovered[lang.value]"></h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="mt-3 col-lg-6">
                  <div class="row">
                    <div class="col visually-hidden">
                      <dmx-chart id="chart2" responsive="true" dmx-bind:data="list_customer_transactions.data.query" label-x="list_customer_transactions.data.query[0].transaction_date" dataset-1:value="transaction_amount" smooth="true" thickness="3" height="350" colors="colors9"></dmx-chart>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                    </div>
                  </div>
                </div>
              </div>

            </div>
            <div class="tab-pane fade" id="navTabs_customer_list" role="tabpanel">
              <div class="row">
                <div class="col scrollable">

                  <div class="row justify-content-sm-between justify-content-md-between justify-content-lg-between justify-content-xl-between justify-content-xxl-between justify-content-between sorter mt-2 mb-2 ms-0 me-0 shadow-none visually-hidden">
                    <div class="col-auto col-9 col-sm-9 col-lg-3 d-flex col-xxl"><input id="customerfilter" name="customerfilter" type="text" class="form-control mb-2 search form-control-sm" dmx-bind:placeholder="trans.data.name[lang.value]+'  '" style="background: #242424 !important;">
                      <input id="customerfilter2" name="customerfilter1" type="text" class="form-control search form-control-sm ms-lg-2 mb-2 ms-2" dmx-bind:placeholder="trans.data.surname[lang.value]+'  '" style="background: #242424 !important;">
                    </div>
                    <div class="col-sm-2 col-lg-1 col-auto">
                      <button id="btn29" class="btn align-self-lg-start btn-outline-secondary btn-sm" dmx-on:click="customerfilter.setValue(NULL); customerfilter2.setValue(NULL)">
                        <i class="fas fa-backspace"></i>
                      </button>
                    </div>

                    <div class="d-flex flex-sm-wrap col-md-5 justify-content-lg-end col-xl-6 justify-content-xl-end justify-content-xxl-end col-auto flex-wrap col-sm-auto col-lg-6">
                      <ul class="pagination flex-xl-wrap flex-xxl-wrap flex-lg-wrap flex-md-wrap flex-sm-wrap flex-wrap" dmx-populate="list_customers.data.query_list_customers" dmx-state="listcustomers" dmx-offset="offset" dmx-generator="bs5paging">
                        <li class="page-item" dmx-class:disabled="list_customers.data.query_list_customers.page.current == 1" aria-label="First">
                          <a href="javascript:void(0)" class="page-link" dmx-on:click="listcustomers.set('offset',list_customers.data.query_list_customers.page.offset.first)"><span aria-hidden="true">‹‹</span></a>
                        </li>
                        <li class="page-item" dmx-class:disabled="list_customers.data.query_list_customers.page.current == 1" aria-label="Previous">
                          <a href="javascript:void(0)" class="page-link" dmx-on:click="listcustomers.set('offset',list_customers.data.query_list_customers.page.offset.prev)"><span aria-hidden="true">‹</span></a>
                        </li>
                        <li class="page-item" dmx-class:active="title == list_customers.data.query_list_customers.page.current" dmx-class:disabled="!active" dmx-repeat="list_customers.data.query_list_customers.getServerConnectPagination(2,1,'...')" style="">
                          <a href="javascript:void(0)" class="page-link" dmx-on:click="listcustomers.set('offset',(page-1)*list_customers.data.query_list_customers.limit)">{{title}}</a>
                        </li>
                        <li class="page-item" dmx-class:disabled="list_customers.data.query_list_customers.page.current ==  list_customers.data.query_list_customers.page.total" aria-label="Next">
                          <a href="javascript:void(0)" class="page-link" dmx-on:click="listcustomers.set('offset',list_customers.data.query_list_customers.page.offset.next)"><span aria-hidden="true">›</span></a>
                        </li>
                        <li class="page-item" dmx-class:disabled="list_customers.data.query_list_customers.page.current ==  list_customers.data.query_list_customers.page.total" aria-label="Last">
                          <a href="javascript:void(0)" class="page-link" dmx-on:click="listcustomers.set('offset',list_customers.data.query_list_customers.page.offset.last)"><span aria-hidden="true">››</span></a>
                        </li>
                      </ul>
                    </div>
                    <div class="col-xl-1 col-md-2 col-sm-2 col-3 offset-lg-1 col-lg col-lg-1"><select id="customer_sort_limit" class="form-select" name="customer_sort_limit">
                        <option value="5">5</option>
                        <option selected="" value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="'250">250</option>
                        <option value="500">500</option>
                      </select></div>
                  </div>
                  <div class="table-responsive bg-light mt-2 rounded" id="customerList">
                    <table class="table table-hover table-sm">
                      <thead>
                        <tr class="text-center">
                          <th>#</th>
                          <th>{{trans.data.name[lang.value]}}</th>
                          <th>{{trans.data.type[lang.value]}}</th>
                          <th>{{trans.data.description[lang.value]}}</th>
                          <th>{{trans.data.format[lang.value]}}</th>
                          <th>{{trans.data.currency[lang.value]}}</th>
                          <th>{{trans.data.user[lang.value]}}</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_wallets.data.query_list_wallets_paged.data" id="tableRepeat7">
                        <tr class="text-center">
                          <td dmx-text="wallet_id"></td>
                          <td dmx-text="wallet_name"></td>
                          <td>

                            <h6 class="me-2">{{trans.data.getValueOrKey(wallet_type)[lang.value]}}<sup><i class="far fa-building fa-lg" style="margin-left: 5px;" dmx-show="wallet_type=='external'"></i></sup></h6>

                          </td>
                          <td dmx-text="wallet_description"></td>
                          <td dmx-text="payment_method_name"></td>
                          <td dmx-text="currency_name"></td>
                          <td dmx-text="user_username"></td>
                          <td>
                            <button id="btn2" class="btn text-body " data-bs-toggle="modal" data-bs-target="#readItemModal" dmx-on:click="read_wallet.load({wallet_id: wallet_id});list_wallet_transactions.load({wallet_id: wallet_id});wallet_report_per_wallet.load({wallet_id: wallet_id})">
                              <i class="far fa-edit fa-sm"></i>
                            </button>
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
  <script src="bootstrap/5/js/bootstrap.bundle.min.js"></script>
  <script src="bootstrap/5/js/bootstrap.min.js"></script>
</body>

</html>