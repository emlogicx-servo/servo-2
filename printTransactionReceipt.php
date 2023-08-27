<!-- Wappler include head-page="customers.php" appconnect="local" is="dmx-app" bootstrap5="darkly" bootstrap_icons="local" fontawesome_5="local" jquery_slim_35="cdn" moment_2="cdn" components="{dmxBootstrap5Modal:{},dmxBootstrap5TableGenerator:{}}" id="printTransactionReceipt" -->
<main class="mt-4" id="printTransactionReceipt">


  <div class="modal readitem" id="printTransactionReceiptModal" is="dmx-bs5-modal" tabindex="-1" dmx-on:hidden-bs-modal="customerOrderModal.show()" style="z-index: 9000000000000; background: white !important; border: none !important;">
    <div class="modal-dialog modal-xl" role="document" style="margin: 0px !important; width: 100% !important; height: 99% !important; max-width: 100% !important; max-height: 99% !important; boder: none !important;">
      <div class="modal-content" style="max-height: 100% !important; height: 100% !important; border: none !important;">
        <dmx-value id="TransactionReceiptTitleContent" dmx-bind:value="trans.data.receipt[lang.value]"></dmx-value>
        <div class="modal-header invoiceHead" id="invoiceHead">
          <button id="printTransactionReceiptButton" class="btn text-white bg-info" onclick="window.print()"><i class="fas fa-print fa-lg"></i>
          </button>

          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="transactionReceipt" style="background: white;">
          <div class="container" id="cutomerTransactionContent">
            <div class="row justify-content-between" id="transactionHeader">
              <div class="col">
                <img dmx-bind:src="'uploads/'+companyInfo.data.query.company_logo" width="300">
              </div>
              <div class="col">
              </div>
              <div class="col">
                <h5 class="text-info fw-bolder" dmx-text="companyInfo.data.query.company_address"></h5>
              </div>
            </div>
            <div class="row justify-content-center row-cols-1" id="transactionNumber">

              <div class="col">
                <h3 class="text-info fw-bolder text-center" dmx-text="trans.data.receipt[lang.value]+' :'+read_customer_transaction.data.query.customer_transaction_id" id="transactionTitle"></h3>
              </div>
            </div>
            <div class="row justify-content-center row-cols-1" id="transactionInformation">

              <div class="col">
                <h5 class="text-info fw-bolder text-start" dmx-text="trans.data.customer[lang.value]+' : '+read_customer.data.query_read_customer.customer_id"></h5>
                <h5 class="text-info fw-bolder text-start" dmx-text="trans.data.name[lang.value]+' : '+read_customer.data.query_read_customer.customer_first_name+' '+read_customer.data.query_read_customer.customer_last_name"></h5>
                <h5 class="text-info fw-bolder text-start" dmx-text="trans.data.dateTime[lang.value]+' : '+dateTime.datetime"></h5>
                <h5 class="text-info fw-bolder text-start" dmx-text="trans.data.user[lang.value]+' : '+list_customer_orders.data.query_list_customer_orders.data[0].user_username"></h5>
              </div>
            </div>
            <div class="row justify-content-center row-cols-1" id="transactionTable">

              <div class="col">
                <div class="table-responsive" style="background: white !important; color: black !important;">
                  <table class="table">
                    <tbody style="color: black !important;">
                      <tr>
                        <td class="fw-bold">{{trans.data.description[lang.value]}}</td>
                        <td class="fw-bold">{{trans.data.reference[lang.value]}}</td>
                        <td class="fw-bold">{{trans.data.paymentMethod[lang.value]}}</td>
                        <td class="fw-bold">{{trans.data.amount[lang.value]}}</td>
                      </tr>
                      <tr class="fw-bold">
                        <td></td>
                        <td>{{read_customer_transaction.data.query.transaction_order}}</td>
                        <td>{{read_customer_transaction.data.query.payment_method_name}}</td>
                        <td>{{read_customer_transaction.data.query.transaction_amount.formatNumber('0',',',',')}}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="row justify-content-between row-cols-6">
              <div class="col">
                <h5 dmx-text="trans.data.signatureClient[lang.value]" class="fw-bolder" style="color: black !important;">Fancy display heading</h5>

              </div>
              <div class="col">
                <h5 dmx-text="trans.data.signatureCashier[lang.value]" class="fw-bolder" style="color: black !important;">Fancy display heading</h5>
              </div>
            </div>
          </div>
          <div class="modal-footer" style="display: none !important;">
          </div>
        </div>
      </div>
    </div>


  </div>
</main>
<main class="mt-4" id="printTransactionReceipGeneral">


  <div class="modal readitem" id="printTransactionReceiptModalGeneral" is="dmx-bs5-modal" tabindex="-1" style="z-index: 9000000000000; background: white !important; border: none !important;" dmx-on:hidden-bs-modal="readItemModal.show()" style="z-index: 9000000000000; background: white !important; border: none !important;">
    <div class="modal-dialog modal-xl" role="document" style="margin: 0px !important; width: 100% !important; height: 99% !important; max-width: 100% !important; max-height: 99% !important; boder: none !important;">
      <div class="modal-content" style="max-height: 100% !important; height: 100% !important; border: none !important;">
        <dmx-value id="TransactionReceiptTitleContent1" dmx-bind:value="trans.data.receipt[lang.value]"></dmx-value>
        <div class="modal-header invoiceHead" id="invoiceHead1">
          <button id="printTransactionReceiptButton1" class="btn text-primary" onclick="window.print()"><i class="fas fa-print fa-lg"></i>
          </button>

          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="transactionReceipt1" style="background: white;">
          <div class="container" id="cutomerTransactionContent1">
            <div class="row justify-content-between" id="transactionHeader1">
              <div class="col">
                <img dmx-bind:src="'uploads/'+companyInfo.data.query.company_logo" width="300">
              </div>
              <div class="col">
              </div>
              <div class="col">
                <h5 class="text-info fw-bolder" dmx-text="companyInfo.data.query.company_address"></h5>
              </div>
            </div>
            <div class="row justify-content-center row-cols-1" id="transactionNumber1">

              <div class="col d-flex justify-content-center">
                <h3 class="text-info fw-bolder text-center me-2" dmx-text="trans.data.receipt[lang.value]+' :'" id="transactionTitlerReceipt" dmx-hide="read_customer_transaction.data.query.transaction_type=='Payment'"></h3>
                <h3 class="text-info fw-bolder text-center me-2" dmx-text="trans.data.voucher[lang.value]+' :'" id="transactionTitleVoucher" dmx-hide="read_customer_transaction.data.query.transaction_type!=='Payment'"></h3>
                <h3 class="text-info fw-bolder text-center" dmx-text="' '+read_customer_transaction.data.query.customer_transaction_id" id="transactionTitle2"></h3>
              </div>
            </div>
            <div class="row justify-content-center row-cols-1" id="transactionInformation1">

              <div class="col">
                <h5 class="text-info fw-bolder text-start" dmx-text="trans.data.customer[lang.value]+' : '+read_customer.data.query_read_customer.customer_id"></h5>
                <h5 class="text-info fw-bolder text-start" dmx-text="trans.data.name[lang.value]+' : '+read_customer.data.query_read_customer.customer_first_name+' '+read_customer.data.query_read_customer.customer_last_name"></h5>
                <h5 class="text-info fw-bolder text-start" dmx-text="trans.data.dateTime[lang.value]+' : '+dateTime.datetime"></h5>
                <h5 class="text-info fw-bolder text-start" dmx-text="trans.data.user[lang.value]+' : '+list_customer_orders.data.query_list_customer_orders.data[0].user_username"></h5>
              </div>
            </div>
            <div class="row justify-content-center row-cols-1" id="transactionTable1">

              <div class="col">
                <div class="table-responsive" style="background: white !important; color: black !important;">
                  <table class="table">
                    <tbody style="color: black !important;">
                      <tr>
                        <td class="fw-bold">{{trans.data.description[lang.value]}}</td>
                        <td class="fw-bold">{{trans.data.reference[lang.value]}}</td>
                        <td class="fw-bold">{{trans.data.paymentMethod[lang.value]}}</td>
                        <td class="fw-bold">{{trans.data.amount[lang.value]}}</td>
                      </tr>
                      <tr class="fw-bold">
                        <td></td>
                        <td>{{read_customer_transaction.data.query.transaction_order}}</td>
                        <td>{{read_customer_transaction.data.query.payment_method_name}}</td>
                        <td>{{read_customer_transaction.data.query.transaction_amount.formatNumber('0',',',',')}}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="row justify-content-between row-cols-6">
              <div class="col">
                <h5 dmx-text="trans.data.signatureClient[lang.value]" class="fw-bolder" style="color: black !important;"></h5>

              </div>
              <div class="col">
                <h5 dmx-text="trans.data.signatureCashier[lang.value]" class="fw-bolder" style="color: black !important;"></h5>
              </div>
            </div>
          </div>
          <div class="modal-footer" style="display: none !important;">
          </div>
        </div>
      </div>
    </div>


  </div>
</main>