<!-- Wappler include head-page="../SERVO/customers_copy.php" appConnect="local" is="dmx-app" bootstrap5="local" bootstrap_icons="local" fontawesome_5="local" jquery_slim_35="local" moment_2="cdn" components="{dmxBootstrap5Navigation:{},dmxCharts:{}}" -->
<div class="tab-content" id="navTabs1_content">
    <div class="tab-pane fade show active visually-hidden" id="navTabs_overview" role="tabpanel">
        <dmx-value id="variableTotalCustomerDebt1" dmx-bind:value="variableTotalCustomerDebtVariable.value.toNumber()"></dmx-value>
        <dmx-value id="variableTotalCustomerTransactions1" dmx-bind:value="list_customer_transactions_amounts.data.custom_list_transaction_amounts[0].Settlements.toNumber()"></dmx-value>
        <dmx-value id="variableTotalCustomerDebtVariable1" dmx-bind:value="((list_customer_transactions_amounts.data.custom_list_transaction_amounts[0].Settlements).toNumber().default(0) -(list_customer_orders_totals.data.custom_list_customer_orders_totals[0]['Customer Orders Totals']).toNumber().default(0)).formatNumber('4','.',',')"></dmx-value>
        <dmx-value id="variableTotalCustomerCoverageDebt1" dmx-bind:value="((list_customer_transactions_amounts.data.custom_list_transaction_amounts[0].Settlements).toNumber().default(0) -(list_customer_orders_totals.data.custom_list_customer_orders_totals[0]['Customer Orders Totals']).toNumber().default(0)).formatNumber('4','.',',')"></dmx-value>
        <dmx-value id="variableTotalCoverageDebt1" dmx-bind:value="((list_customer_orders_totals.data.custom_list_customer_orders_totals[0]['Coverage Totals']).toNumber().default(0)).formatNumber('4','.',',')"></dmx-value>
        <dmx-value id="variableTotalCovered1" dmx-bind:value="((list_customer_orders_totals.data.custom_list_customer_orders_totals[0]['Total Covered']).toNumber().default(0)).formatNumber('4','.',',')"></dmx-value>
        <div class="row">

            <div class="col-12 col-lg-6">
                <div class="row mt-2 ms-0">
                    <div id="totalDebt1" class="bg-info text-center mt-2 me-2 pt-4 pb-4 ps-4 pe-4 col" style="background: #ff2a5c !important;">
                        <div class="row">
                            <div class="col">
                                <i class="far fa-question-circle fa-lg"></i>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h1 dmx-text="variableTotalCustomerDebtVariable.value"></h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h4 dmx-text="trans.data.totalDebt[lang.value]">{{trans.data.totalOrders[lang.value]}}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="bg-info text-center mt-2 me-2 pt-4 pb-4 ps-4 pe-4 col" id="totalDeposits1" style="background: #ff2afa !important;">

                        <div class="row">
                            <div class="col">
                                <i class="fas fa-piggy-bank fa-lg"></i>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h1 dmx-text="(totalDeposits.value-(totalDepositPayments.value + totalDepositSettlements.value)).formatNumber('4','.',',')" class="text-white"></h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">

                                <h4 dmx-text="trans.data.totalDeposits[lang.value]"></h4>
                            </div>
                        </div>
                    </div>

                    <div id="totalSettlements1" class="bg-info text-center mt-2 me-2 pt-4 pb-4 ps-4 pe-4 col" style="background: #07b853 !important;">
                        <div class="row">
                            <div class="col">
                                <i class="fas fa-arrow-circle-down fa-lg"></i>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h1 dmx-text="list_customer_transactions_amounts.data.custom_list_transaction_amounts[0].Settlements.toNumber().formatNumber('3', '.', ',').default(0)" class="text-white"></h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h4>{{trans.data.totalSettlements[lang.value]}}</h4>
                            </div>
                        </div>
                    </div>
                    <div id="totalPayout1" class="text-center mt-2 me-2 pt-4 pb-4 ps-4 pe-4 col" style="background: #b81f07 !important;">
                        <div class="row">
                            <div class="col">
                                <i class="fas fa-angle-up fa-lg"></i>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h1 dmx-text="(list_customer_transactions.data.query.where(`transaction_type`, 'Payment', '==')).sum('transaction_amount').formatNumber('4','.',',').default('0')" class="text-white"></h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h4>{{trans.data.totalPayout[lang.value]}}</h4>
                            </div>
                        </div>
                    </div>
                    <div id="totalOrders1" class="bg-info text-center mt-2 me-2 pt-4 pb-4 ps-4 pe-4 col" style="background: #606370 !important;">
                        <div class="row">
                            <div class="col">
                                <i class="fas fa-clipboard-list fa-lg"></i>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h1 dmx-text="list_customer_orders.data.query_list_customer_orders.data.count().formatNumber('4','.',',').default(0)" class="text-white">{{trans.data.totalOrders[lang.value]}}</h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">

                                <h4 dmx-text="trans.data.orders[lang.value]"></h4>
                            </div>
                        </div>
                    </div>
                    <div id="totalCoverageDebt1" class="bg-info text-center mt-2 me-2 pt-4 pb-4 ps-4 pe-4 col" style="background: #ff8f2b !important;">
                        <div class="row">
                            <div class="col">
                                <i class="fas fa-people-arrows fa-lg"></i>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h1 dmx-text="variableTotalCoverageDebt.value.default(0)" class="text-white">{{trans.data.totalOrders[lang.value]}}</h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">

                                <h4 dmx-text="trans.data.totalCoverage[lang.value]"></h4>
                            </div>
                        </div>
                    </div>
                    <div id="totalCovered1" class="text-center mt-2 me-2 pt-4 pb-4 ps-4 pe-4 col" style="background: #176de0 !important;" dmx-hide="(read_customer.data.query_read_customer.customer_class == 'standard')">
                        <div class="row">
                            <div class="col">
                                <i class="fas fa-arrow-circle-up fa-lg"></i>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h1 dmx-text="variableTotalCovered.value.default(0)" class="text-white">{{trans.data.totalOrders[lang.value]}}</h1>
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
            <div class="col-lg-6 mt-3 pt-2 pb-2 ps-2 pe-2 text-light">
                <div class="row">
                    <div class="col">
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
    <div class="tab-pane  scrollable show active fade" id="navTabs_customer_list" role="tabpanel">
        <div class="row scrollable mt-2 mb-2 ms-0 me-0">
            <div class="rounded bg-light col">

                <div class="row justify-content-sm-between justify-content-md-between justify-content-lg-between justify-content-xl-between justify-content-xxl-between justify-content-between sorter shadow-none mt-2 mb-2 rounded bg-light">
                    <div class="d-flex col-xxl flex-wrap col-auto col-sm-auto col-md col-lg-auto align-items-baseline"><input id="customerfilter" name="customerfilter" type="search" class="form-control search mb-2 me-2" dmx-bind:placeholder="trans.data.name[lang.value]+'  '">
                        <input id="customerfilter2" name="customerfilter1" type="search" class="form-control search mb-2 me-2" dmx-bind:placeholder="trans.data.surname[lang.value]+'  '">
                        <button id="btn29" class="btn align-self-lg-start bg-opacity-10 me-2 bg-body visually-hidden" dmx-on:click="customerfilter.setValue(NULL); customerfilter2.setValue(NULL)">
                            <i class="fas fa-backspace fa-sm"></i>
                        </button>
                        <ul class="pagination flex-xl-wrap flex-xxl-wrap flex-lg-wrap flex-md-wrap flex-sm-wrap flex-wrap rounded me-2 bg-opacity-10 bg-primary" dmx-populate="list_customers.data.query_list_customers" dmx-state="listcustomers" dmx-offset="offset" dmx-generator="bs5paging">
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
                        </ul><select id="customer_sort_limit" class="form-select" name="customer_sort_limit" style="width: auto !important">
                            <option value="500">500</option>
                        </select>
                    </div>

                </div>
                <div class="row ms-0 me-0">
                    <div class="col rounded scrollable">
                        <div class="table-responsive servo-shadow" id="customerList">
                            <table class="table table-hover table-sm table-borderless">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{trans.data.name[lang.value]}}</th>
                                        <th>{{trans.data.surname[lang.value]}}</th>
                                        <th>{{trans.data.phoneNumber[lang.value]}}</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_customers.data.query_list_customers.data" id="tableRepeat1">
                                    <tr>
                                        <td dmx-text="customer_id"></td>
                                        <td dmx-text="customer_first_name"></td>
                                        <td dmx-text="customer_last_name"></td>
                                        <td dmx-text="customer_phone_number"></td>
                                        <td>
                                            <button id="btn28" class="btn text-warning" dmx-hide="(customer_class == 'standard')"><i class="fas fa-people-arrows fa-sm"></i></button>

                                        </td>
                                        <td>

                                        </td>
                                        <td class="text-center">

                                            <button id="btn2" class="btn open text-primary bg-primary bg-opacity-10" data-bs-target="#readItemModal" dmx-bind:value="customer_id" dmx-on:click="session_variables.set('current_customer',customer_id); read_customer.load({customer_id: customer_id});list_customer_transactions.load({customer_id: customer_id});list_customer_orders.load({customer_id: customer_id, offset: listCustomerOrders.data.customerOrdersOffset, limit: c_order_sort_limit.value});list_customer_data_reading_sessions.load({customer_id: customer_id});list_customer_transactions_amounts.load({customer_id: customer_id});list_customer_orders_totals.load({customer_id: customer_id});list_customer_covered_orders.load({customer_id: customer_id, offset: listCustomerCoveredOrders.data.offset, limit: c_order_sort_limit2.value})"><i class="fas fa-pencil-alt fa-sm" style=""><br></i></button>

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
    <div class="tab-pane fade visually-hidden" id="navTabs1_3" role="tabpanel">
    </div>
</div>