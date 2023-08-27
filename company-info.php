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
  <script src="dmxAppConnect/dmxBootbox5/bootstrap-modbox.min.js" defer></script>
  <script src="dmxAppConnect/dmxBootbox5/dmxBootbox5.js" defer></script>

</head>

<body id="brands" is="dmx-app">

  <dmx-value id="lang" dmx-bind:value="browser1.language"></dmx-value>
  <dmx-json-datasource id="trans" is="dmx-serverconnect" url="assets/translation/translation.JSON"></dmx-json-datasource>

  <dmx-serverconnect id="read_company_information" url="dmxConnect/api/servo_company_information/read_company_information.php" dmx-param:id="id" dmx-param:item_id="" dmx-param:branch_id="read_item_branch.data.queryReadBranch.branch_id" dmx-param:company_info_id="1"></dmx-serverconnect>
  <dmx-serverconnect id="list_company_information" url="dmxConnect/api/servo_branches/list_branches.php"></dmx-serverconnect>
  <div is="dmx-browser" id="browser1"></div>
  <dmx-notifications id="notifies1" position="bottom"></dmx-notifications>
  <?php include 'header.php'; ?><main class="mt-4">
    <div class="modal" id="modal1" is="dmx-bs5-modal" tabindex="-1">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-body"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form is="dmx-serverconnect-form" id="serverconnectFormCompanyInfo" method="post" action="dmxConnect/api/servo_company_information/create_company_information.php" dmx-generator="bootstrap5" dmx-form-type="horizontal">
              <div class="mb-3 row">
                <label for="inp_company_name" class="col-sm-2 col-form-label">{{trans.data.companyName[lang.value]}}</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inp_company_name" name="company_name" aria-describedby="inp_company_name_help">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="inp_company_address" class="col-sm-2 col-form-label">{{trans.data.companyAddress[lang.value]}}</label>
                <div class="col-sm-10">
                  <textarea type="text" class="form-control" id="inp_company_address" name="company_address" aria-describedby="inp_company_address_help"></textarea>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="inp_company_phone_number" class="col-sm-2 col-form-label">{{trans.data.companyPhone[lang.value]}}</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inp_company_phone_number" name="company_phone_number" aria-describedby="inp_company_phone_number_help">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="inp_company_payment_numbers" class="col-sm-2 col-form-label">{{trans.data.companyPaymentNumbers[lang.value]}}</label>
                <div class="col-sm-10">
                  <textarea type="text" class="form-control" id="inp_company_payment_numbers" name="company_payment_numbers" aria-describedby="inp_company_payment_numbers_help"></textarea>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="inp_company_payment_numbers2" class="col-sm-2 col-form-label">{{trans.data.message[lang.value]}}</label>
                <div class="col-sm-10">
                  <textarea type="text" class="form-control" id="inp_company_payment_numbers2" name="company_message" aria-describedby="inp_company_payment_numbers_help"></textarea>
                </div>
              </div>
              <div class="mb-3 row">
                <div class="col-sm-2">&nbsp;</div>
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-primary">OK</button>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col">
          <h5 class="text-body">Company Information</h5>
        </div>
        <div class="col d-flex justify-content-end">
          <button id="btn1" class="btn text-body" data-bs-toggle="modal" data-bs-target="#modal1">
            <i class="fas fa-plus fa-lg"></i>
          </button>
        </div>
      </div>
    </div>

    <div class="container mt-auto">





      <form is="dmx-serverconnect-form" id="CompanyInfo" method="post" action="dmxConnect/api/servo_company_information/update_company_information.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="read_company_information.data.query" dmx-on:success="notifies1.success('Success');read_company_information.load({company_info_id: read_company_information.data.query.company_info_id})">
        <div class="mb-3 row">
          <div class="col-sm-10">
            <input type="number" class="form-control visually-hidden" id="inp_company_info_id" name="company_info_id" dmx-bind:value="read_company_information.data.query.company_info_id" aria-describedby="inp_company_info_id_help" placeholder="Enter Company info">
          </div>
        </div>
        <div class="mb-3 row">
          <label for="inp_company_name" class="col-sm-2 col-form-label">{{trans.data.companyName[lang.value]}}</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="inp_company_name" name="company_name" dmx-bind:value="read_company_information.data.query.company_name" aria-describedby="inp_company_name_help">
          </div>
        </div>
        <div class="mb-3 row">
          <label for="inp_company_address" class="col-sm-2 col-form-label">{{trans.data.companyAddress[lang.value]}}</label>
          <div class="col-sm-10">
            <textarea type="text" class="form-control" id="inp_company_address" name="company_address" dmx-bind:value="read_company_information.data.query.company_address" aria-describedby="inp_company_address_help"></textarea>
          </div>
        </div>
        <div class="mb-3 row">
          <label for="inp_company_phone_number" class="col-sm-2 col-form-label">{{trans.data.companyPhone[lang.value]}}</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="inp_company_phone_number" name="company_phone_number" dmx-bind:value="read_company_information.data.query.company_phone_number" aria-describedby="inp_company_phone_number_help">
          </div>
        </div>

        <div class="mb-3 row">
          <label for="inp_company_payment_numbers" class="col-sm-2 col-form-label">{{trans.data.companyPaymentNumbers[lang.value]}}</label>
          <div class="col-sm-10">
            <textarea type="text" class="form-control" id="inp_company_payment_numbers" name="company_payment_numbers" dmx-bind:value="read_company_information.data.query.company_payment_numbers" aria-describedby="inp_company_payment_numbers_help"></textarea>
          </div>
        </div>
        <div class="mb-3 row">
          <label for="inp_company_payment_numbers1" class="col-sm-2 col-form-label">{{trans.data.message[lang.value]}}</label>
          <div class="col-sm-10">
            <textarea type="text" class="form-control" id="inp_company_payment_numbers1" name="company_message" dmx-bind:value="read_company_information.data.query.company_message" aria-describedby="inp_company_payment_numbers_help"></textarea>
          </div>
        </div>
        <div class="mb-3 row">
          <label for="inpCompanyReceiptFooter" class="col-sm-2 col-form-label">{{trans.data.info[lang.value]}}</label>
          <div class="col-sm-10">
            <textarea type="text" class="form-control" id="inpCompanyReceiptFooter" name="company_receipt_footer" dmx-bind:value="read_company_information.data.query.company_receipt_footer" aria-describedby="inp_company_payment_numbers_help"></textarea>
          </div>
        </div>
        <div class="mb-3 row visually-hidden">
          <label for="inp_company_phone_number1" class="col-sm-2 col-form-label"></label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="inp_company_phone_number1" name="company_logo" dmx-bind:value="read_company_information.data.query.company_logo" aria-describedby="inp_company_phone_number_help">
          </div>
        </div>

        <div class="mb-3 row">
          <div class="col-sm-10">
            <button type="submit" class="btn btn-primary" dmx-bind:value="read_company_information.data.query.Save">OK</button>
          </div>
        </div>
      </form>
      <div class="row mt-2">
        <div class="col">
          <h3>{{trans.data.logo[lang.value]}}</h3>
        </div>
      </div>
      <div class="row" is="dmx-if" id="conditional1" dmx-bind:condition="(read_company_information.data.query.company_logo == NULL)">
        <form is="dmx-serverconnect-form" id="CompanyLogo" method="post" action="dmxConnect/api/servo_company_information/update_company_logo.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="read_company_information.data.query" dmx-on:success="notifies1.success('Success');read_company_information.load({company_info_id: read_company_information.data.query.company_info_id})">
          <div class="row">
            <div class="col visually-hidden"><input id="companyLogo" name="company_logo" type="text" class="form-control" dmx-bind:value="read_company_information.data.query.company_logo">
              <input id="companyInfoId" name="company_info_id" type="text" class="form-control" dmx-bind:value="read_company_information.data.query.company_info_id">
            </div>

          </div>

          <div class="mb-3 row justify-content-sm-center">

            <div class="col text-center">
              <div class="row justify-content-center visually-hidden">
                <div class="col d-flex justify-content-center"><img dmx-bind:src="'uploads/'+read_company_information.data.query.company_logo" width="300px"></div>
              </div>
              <div class="row justify-content-center">
                <div class="col d-flex justify-content-center"><input id="companyLogo" name="company_logo_file" type="file" class="form-control"></div>
              </div>

            </div>

          </div>
          <div class="mb-3 row justify-content-center">
            <div class="col-sm-10 d-flex justify-content-center">
              <button type="submit" class="btn text-info" dmx-bind:value="read_company_information.data.query.Save">
                <i class="fas fa-upload fa-2x"></i>
              </button>
            </div>
          </div>
        </form>
      </div>
      <div class="row" is="dmx-if" id="conditional2" dmx-bind:condition="(read_company_information.data.query.company_logo != NULL)">
        <form is="dmx-serverconnect-form" id="deleteLogo" method="post" action="dmxConnect/api/servo_company_information/delete_company_logo.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="read_company_information.data.query" dmx-on:success="notifies1.success('Success');read_company_information.load({company_info_id: read_company_information.data.query.company_info_id})">
          <div class="row">
            <div class="col visually-hidden"><input id="companyLogo1" name="company_logo" type="text" class="form-control" dmx-bind:value="read_company_information.data.query.company_logo">
              <input id="companyInfoId1" name="company_info_id" type="text" class="form-control" dmx-bind:value="read_company_information.data.query.company_info_id">
            </div>

          </div>

          <div class="mb-3 row justify-content-sm-center">

            <div class="col text-center">
              <div class="row">
                <div class="col d-flex justify-content-center"><img dmx-bind:src="'uploads/'+read_company_information.data.query.company_logo" width="300px"></div>
              </div>
              <div class="row">
                <div class="col d-flex justify-content-center"><button id="btn3" class="btn mt-3 text-body" type="submit">
                    <i class="far fa-trash-alt fa-lg"></i>
                  </button></div>
              </div>

            </div>

          </div>
        </form>
      </div>

    </div>
  </main>
  <script src="bootstrap/5/js/bootstrap.bundle.min.js"></script>
</body>

</html>