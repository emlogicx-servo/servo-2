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
    <script src="js/jquery-3.5.1.min.js"></script>
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


    <script src="dmxAppConnect/dmxBootstrap5Tooltips/dmxBootstrap5Tooltips.js" defer=""></script>
    <link rel="stylesheet" href="fontawesome5/css/all.min.css" />
    <link rel="stylesheet" href="dmxAppConnect/dmxValidator/dmxValidator.css" />
    <script src="dmxAppConnect/dmxValidator/dmxValidator.js" defer></script>
</head>

<body is="dmx-app" id="departments">


    <dmx-value id="lang" dmx-bind:value="browser1.language"></dmx-value>
    <dmx-json-datasource id="trans" is="dmx-serverconnect" url="assets/translation/translation.JSON"></dmx-json-datasource>


    <dmx-serverconnect id="read_sales_point" url="dmxConnect/api/servo_departments/read_department.php" dmx-param:id="id" noload dmx-param:item_id="" dmx-param:branch_id="read_item_branch.data.queryReadBranch.branch_id" dmx-param:department_id=""></dmx-serverconnect>
    <dmx-serverconnect id="delete_sales_point" url="dmxConnect/api/servo_departments/delete_department.php"></dmx-serverconnect>
    <dmx-serverconnect id="list_sales_points" url="dmxConnect/api/servo_sales_points/list_sales_points.php"></dmx-serverconnect>
    <div is="dmx-browser" id="browser1"></div>
    <dmx-notifications id="notifies1" position="bottom"></dmx-notifications>
    <?php include 'header.php'; ?><main class="mt-4">
        <div class="modal create-modal" id="createItemModal" is="dmx-bs5-modal" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{trans.data.createDepartment[lang.value]}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal readitem" id="readItemModal" is="dmx-bs5-modal" tabindex="-1">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">{{trans.data.departmentDetails[lang.value]}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">


                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>

    </main>
    <main>
        <div class="mt-auto ms-3 me-3">




            <div class="row servo-page-header">
                <div class="col-auto" dmx-animate-enter="slideInLeft">
                    <i class="fas fa-store fa-lg"></i>
                </div>
                <div class="col-auto page-heading">
                    <h5 class="servo-page-heading">{{trans.data.salesPoints[lang.value]}}</h5>
                </div>
                <div class="col style13 page-button visually-hidden" id="pagebuttons">
                    <button id="btn1" class="btn style12 fw-light text-warning" data-bs-toggle="modal" data-bs-target="#createItemModal" style="float: right;"><i class="fas fa-plus fa-2x style14"></i></button>
                </div>
            </div>
            <div class="row servo-page-header mt-2">

                <div class="col">
                    <form id="createSalesPoint" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_sales_points/create_sales_point.php" class="d-flex" dmx-on:success="list_sales_points.load();notifies1.success('Success!')">
                        <input id="text4" name="sales_point_name" type="text" class="form-control" dmx-bind:placeholder="trans.data.name[lang.value]" required="" data-msg-required="!">
                        <button id="btn4" class="btn ms-2 bg-info text-white" type="submit">
                            <i class="fas fa-plus"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col">


                    <div class="table-responsive servo-shadow">
                        <table class="table table-hover table-sm table-borderless">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{trans.data.name[lang.value]}}</th>
                                    <th>{{trans.data.account[lang.value]}}</th>
                                </tr>
                            </thead>
                            <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="list_sales_points.data.query_list_sales_points" id="listSalesPoints">
                                <tr>
                                    <td dmx-text="sales_point_id"></td>
                                    <td class="w-auto">
                                        <form id="updateSalesPoint" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_sales_points/update_sales_point.php" dmx-on:success="list_sales_points.load();notifies1.success('Success!')" class="d-flex">

                                            <div class="row">
                                                <div class="col-auto w-auto"><input id="text6" name="sales_point_name" type="text" class="form-control" dmx-bind:value="sales_point_name" style="width: 150px !important;"><input id="text5" name="sales_point_id" type="number" class="form-control visually-hidden" dmx-bind:value="sales_point_id"></div>
                                            </div>

                                            <button id="btn2" class="btn text-success ms-2" type="submit">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>


                                    </td>
                                    <td dmx-text="customer_first_name+' '+customer_last_name">Cell</td>

                                    <td>
                                        <form id="deleteSalesPoint" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_sales_points/delete_sales_point.php" dmx-on:success="list_sales_points.load();notifies1.success('Success!')" dmx-on:error="notifies1.danger('Error!')">

                                            <input id="text1" name="sales_point_id" type="number" class="form-control visually-hidden" dmx-bind:value="sales_point_id">
                                            <button id="btn3" class="btn text-muted" type="submit">
                                                <i class="far fa-trash-alt"></i>
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
    </main>
    <script src="bootstrap/5/js/bootstrap.bundle.min.js"></script>
</body>

</html>