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
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js" integrity="sha256-CutOzxCRucUsn6C6TcEYsauvvYilEniTXldPa6/wu0k=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="bootstrap/5/darkly/bootstrap.min.css" />
  <script src="dmxAppConnect/dmxTyped/dmxTyped.js" defer=""></script>
  <script src="dmxAppConnect/dmxTyped/typed.min.js" defer=""></script>
  <link rel="stylesheet" href="dmxAppConnect/dmxDatePicker/daterangepicker.min.css" />
  <script src="dmxAppConnect/dmxDatePicker/daterangepicker.min.js" defer=""></script>
  <link rel="stylesheet" href="dmxAppConnect/dmxDatePicker/dmxDatePicker.css" />
  <script src="dmxAppConnect/dmxDatePicker/dmxDatePicker.js" defer=""></script>


  <script src="dmxAppConnect/dmxFormatter/dmxFormatter.js" defer=""></script>
  <link rel="stylesheet" href="dmxAppConnect/dmxDatePicker/bgthemes/dark-calendar.css" />
  <link rel="stylesheet" href="fontawesome5/css/all.min.css" />
  <script src="dmxAppConnect/dmxBootstrap5PagingGenerator/dmxBootstrap5PagingGenerator.js" defer=""></script>
  <script src="dmxAppConnect/dmxBootstrap5Navigation/dmxBootstrap5Navigation.js" defer></script>
  <script src="dmxAppConnect/dmxBrowser/dmxBrowser.js" defer></script>
  <script src="dmxAppConnect/dmxCharts/Chart.min.js" defer></script>
  <script src="dmxAppConnect/dmxCharts/dmxCharts.js" defer></script>
  <link rel="stylesheet" href="dmxAppConnect/dmxNotifications/dmxNotifications.css" />
  <script src="dmxAppConnect/dmxNotifications/dmxNotifications.js" defer></script>
  <script src="dmxAppConnect/dmxStateManagement/dmxStateManagement.js" defer></script>
  <script src="dmxAppConnect/dmxBootstrap5Collapse/dmxBootstrap5Collapse.js" defer></script>
  <script src="dmxAppConnect/dmxBootstrap5Modal/dmxBootstrap5Modal.js" defer></script>
  <link rel="stylesheet" href="dmxAppConnect/dmxBootstrap5TableGenerator/dmxBootstrap5TableGenerator.css" />
  <script src="dmxAppConnect/dmxDownload/dmxDownload.js" defer></script>
  <link rel="stylesheet" href="dmxAppConnect/dmxValidator/dmxValidator.css" />
  <script src="dmxAppConnect/dmxValidator/dmxValidator.js" defer></script>
</head>

<body id="products" is="dmx-app">
  <dmx-serverconnect id="load_users_1" url="dmxConnect/api/servo_users/list_users.php"></dmx-serverconnect>
  <dmx-session-manager id="session1"></dmx-session-manager>
  <dmx-query-manager id="list_gugr_projects"></dmx-query-manager>

  <dmx-serverconnect id="listGugrProjects" url="dmxConnect/api/gugr_projects/gugr_projects/list_gugr_projects_paged.php" dmx-param:offset="list_gugr_projects.data.offset_gugr_projects" dmx-param:gugr_project_filter="gugrProjectFilter.value" dmx-param:limit="gugrProjectLimit.value" dmx-param:gugr_project_status="gugrProjectStatusFilter.value" credentials dmx-param:dir="query.dir_gugr_projects" dmx-param:sort="query.sort_gugr_projects"></dmx-serverconnect>
  <dmx-serverconnect id="listGugrProjectsFiles" url="dmxConnect/api/gugr_projects/gugr_files/list_project_files.php" dmx-param:offset="list_gugr_projects.data.offset_gugr_projects" dmx-param:gugr_project_filter="gugrProjectFilter.value" dmx-param:limit="gugrProjectLimit.value" dmx-param:gugr_project_status="gugrProjectStatusFilter.value" credentials="" dmx-param:dir="query.dir_gugr_projects" dmx-param:sort="query.sort_gugr_projects"></dmx-serverconnect>

  <dmx-serverconnect id="readGuGrProject" url="dmxConnect/api/gugr_projects/gugr_projects/read_gugr_project.php" dmx-param:product_price_id="load_product_prices.data.query[0].product_price_id" dmx-param:project_id="session1.data.current_project"></dmx-serverconnect>
  <dmx-serverconnect id="deleteProjectFile" url="dmxConnect/api/gugr_projects/gugr_files/delete_project_file.php" dmx-param:product_price_id="load_product_prices.data.query[0].product_price_id" dmx-param:project_id="session1.data.current_project"></dmx-serverconnect>

  <dmx-value id="lang" dmx-bind:value="browser1.language"></dmx-value>
  <dmx-json-datasource id="trans" is="dmx-serverconnect" url="assets/translation/translation.JSON"></dmx-json-datasource>



  <div is="dmx-browser" id="browser1"></div>
  <dmx-notifications id="notifies1" position="bottom"></dmx-notifications>
  <?php include 'gugr-header.php'; ?><main class="mt-4">
    <div class="modal readitem" id="readItemModal" is="dmx-bs5-modal" tabindex="-1" style="" nocloseonclick="true">
      <div class="modal-dialog modal-xl modal-fullscreen-xxl-down modal-dialog-scrollable" role="document" style="margin: 0px !important; width: 100% !important; height: 99% !important; max-width: 100% !important; max-height: 99% !important;">
        <div class="modal-content" style="max-height: 100% !important; height: 100% !important;">
          <div class="modal-header">
            <h4 dmx-text="trans.data.query[lang.value]+' : #'+readGuGrProject.data.query_read_gugr_project.project_code" class="text-white fw-bold"></h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">


            <div class="row">
              <div class="col">
                <ul class="nav nav-tabs" id="navTabs2_tabs" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="navTabs2_1_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs2_1" role="tab" aria-controls="navTabs1_1" aria-selected="true"><i class="fas fa-info" style="margin-right: 5px;"></i>
                      {{trans.data.info[lang.value]}}</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="navTabs2_2_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs2_2" role="tab" aria-controls="navTabs1_2" aria-selected="false"><i class="far fa-file"></i>
                      {{trans.data.files[lang.value]}}</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="navTabs2_3_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs2_3" role="tab" aria-controls="navTabs1_3" aria-selected="false">{{trans.data.treatment[lang.value]}}<i class="fas fa-tasks"></i></a>
                  </li>
                </ul>
                <div class="tab-content" id="navTabs2_content">
                  <div class="tab-pane fade show active mt-2" id="navTabs2_1" role="tabpanel">
                    <div class="row">
                      <div class="col-xl-4 text-sm-center text-center text-md-center rounded rounded-1 border-light col-12 col-md-5 col-lg-5 mt-2 pt-3 pb-2 ps-3 pe-3">
                        <div class="row">
                          <div class="col bg-secondary pt-3 ps-3 pe-3">
                            <h3 class="text-start"><i class="far fa-file-alt" style="margin-right: 5px;"></i>{{trans.data.info[lang.value]}}</h3>
                            <form is="dmx-serverconnect-form" id="updateProjectReception" method="post" action="dmxConnect/api/gugr_projects/gugr_projects/update_gugr_project_reception.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="readGuGrProject.data.query_read_gugr_project" dmx-on:success="readGuGrProject.load({project_id: readGuGrProject.data.query_read_gugr_project.project_id}); listGugrProjects.load({gugr_project_filter: gugrProjectFilter.value, gugr_project_status: gugrProjectStatusFilter.value, offset: list_gugr_projects.data.offset_gugr_projects, limit: gugrProjectLimit.value}); listGugrProjects.load({gugr_project_filter: gugrProjectFilter.value, gugr_project_status: gugrProjectStatusFilter.value, offset: list_gugr_projects.data.offset_gugr_projects, limit: gugrProjectLimit.value})">
                              <input id="text2" name="project_id" type="text" class="form-control visually-hidden" dmx-bind:value="readGuGrProject.data.query_read_gugr_project.project_id">
                              <div class="form-group mb-3 row">

                                <label for="inp_project_code" class="col-sm-2 col-form-label col">{{trans.data.code[lang.value]}}</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="inp_project_code" name="project_code" dmx-bind:value="readGuGrProject.data.query_read_gugr_project.project_code" aria-describedby="inp_project_code_help">
                                </div>
                              </div>
                              <div class="form-group mb-3 row">
                                <label for="inp_project_description" class="col-sm-2 col-form-label">{{trans.data.description[lang.value]}}</label>
                                <div class="col-sm-10">
                                  <textarea type="text" class="form-control" id="inp_project_description" name="project_description" dmx-bind:value="readGuGrProject.data.query_read_gugr_project.project_description" aria-describedby="inp_project_description_help" style="height: 150px;"></textarea>
                                </div>
                              </div>
                              <div class="form-group mb-3 row">
                                <label for="inp_project_date_due_2" class="col-sm-2 col-form-label">{{trans.data.dateDue[lang.value]}}</label>
                                <div class="col-sm-10">
                                  <input type="datetime-local" class="form-control" id="inp_project_date_due_2" name="project_date_due" dmx-bind:value="readGuGrProject.data.query_read_gugr_project.project_date_due" aria-describedby="inp_project_date_due_help">
                                </div>
                              </div>
                              <div class="form-group mb-3 row">
                                <div class="col-sm-10 text-end">
                                  <button type="submit" class="btn btn-primary bg-info" dmx-bind:value="readGuGrProject.data.query_read_gugr_project.Save" dmx-bind:disabled="state.executing">{{trans.data.update[lang.value]}} <span class="spinner-border spinner-border-sm" role="status" dmx-show="state.executing"></span></button>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>



                      </div>
                      <div class="col-xl-4 col-12 text-sm-center text-center text-md-center rounded rounded-1 border-light col-md-3 col-lg-3 mt-2 pt-3 pb-2 ps-3 pe-3">
                        <div class="row">
                          <div class="col bg-secondary pt-3 ps-3 pe-3">
                            <h3 class="text-start"><i class="fas fa-exclamation-triangle" style="margin-right: 5px;"></i>{{trans.data.status[lang.value]}}</h3>
                            <form is="dmx-serverconnect-form" id="updateProjectStatus" method="post" action="dmxConnect/api/gugr_projects/gugr_projects/update_gugr_project_status.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="readGuGrProject.data.query_read_gugr_project" dmx-on:success="readGuGrProject.load({project_id: readGuGrProject.data.query_read_gugr_project.project_id});updateProjectStatus.reset(); listGugrProjects.load({gugr_project_filter: gugrProjectFilter.value, gugr_project_status: gugrProjectStatusFilter.value, offset: list_gugr_projects.data.offset_gugr_projects, limit: gugrProjectLimit.value})">
                              <input id="text3" name="project_id" type="text" class="form-control visually-hidden" dmx-bind:value="readGuGrProject.data.query_read_gugr_project.project_id">
                              <div class="form-group mb-3 row">

                                <label for="inp_project_status1" class="col-sm-2 col-form-label col">{{trans.data.status[lang.value]}}</label>
                                <div class="col-sm-10">
                                  <select id="select1" class="form-select" name="project_status" dmx-bind:value="trans.data.getKeyOrValue(readGuGrProject.data.query_read_gugr_project.project_status)[lang.value]">
                                    <option selected="" value="#">----</option>
                                    <option value="Active">Actif</option>
                                    <option value="Copmpleted">Cloturé</option>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group mb-3 row">
                                <div class="col-sm-10 text-end">
                                  <button type="submit" class="btn bg-info btn-info" dmx-bind:value="readGuGrProject.data.query_read_gugr_project.Save" dmx-bind:disabled="state.executing">{{trans.data.update[lang.value]}}<span class="spinner-border spinner-border-sm" role="status" dmx-show="state.executing"></span></button>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>



                      </div>
                      <div class="col-12 text-sm-center text-center text-md-center rounded rounded-1 border-light col-md-3 col-lg-3 col-xl-3 mt-2 pt-3 pb-2 ps-3 pe-3">
                        <div class="row">
                          <div class="col bg-secondary pt-3 ps-3 pe-3">
                            <h3 class="text-start"><i class="far fa-user" style="margin-right: 5px;"></i>{{trans.data.assignment[lang.value]}}</h3>
                            <form is="dmx-serverconnect-form" id="updateProjectAssignment" method="post" action="dmxConnect/api/gugr_projects/gugr_projects/update_gugr_project_userConcerned.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="readGuGrProject.data.query_read_gugr_project" dmx-on:success="readGuGrProject.load({project_id: readGuGrProject.data.query_read_gugr_project.project_id});updateProjectStatus.reset()">
                              <input id="text6" name="project_id" type="text" class="form-control visually-hidden" dmx-bind:value="readGuGrProject.data.query_read_gugr_project.project_id">
                              <div class="form-group mb-3 row">
                                <label for="inp_project_date_due_1" class="col-sm-2 col-form-label">{{trans.data.user[lang.value]}}</label>
                                <div class="col-sm-10 text-dark">
                                  <select id="selectUserAssign1" class="form-select" dmx-bind:options="load_users_1.data.query_list_users" required="" data-msg-required="!" optionvalue="user_id" name="project_user_concerned" dmx-bind:value="readGuGrProject.data.query_read_gugr_project.project_user_concerned" optiontext="user_username">
                                    <option selected="" value="#">----</option>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group mb-3 row">
                                <div class="col-sm-10 text-end">
                                  <button type="submit" class="btn bg-info btn-info" dmx-bind:value="readGuGrProject.data.query_read_gugr_project.Save" dmx-bind:disabled="state.executing">{{trans.data.update[lang.value]}} <span class="spinner-border spinner-border-sm" role="status" dmx-show="state.executing"></span></button>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>



                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade mt-2" id="navTabs2_2" role="tabpanel">
                    <div class="row justify-content-xxl-end row-cols-xxl-12 row-cols-12 mt-3 mb-2 justify-content-end">
                      <div class="col text-end"><button id="btn4" class="btn btn-info w-auto" dmx-on:click="" data-bs-toggle="collapse" data-bs-target="#uploadFileCollapse"><i class="fas fa-file-upload"></i>
                        </button></div>
                    </div>

                    <div class="collapse" id="uploadFileCollapse" is="dmx-bs5-collapse">
                      <div class="container">
                        <div class="row mt-xl-3 mt-3">
                          <div class="col mt-md-3 ms-lg-2 me-lg-2 ms-2 me-2 pt-2 pb-2 ps-5 pe-2 rounded rounded-2 bg-secondary">
                            <h3 class="mt-3">{{trans.data.uploadFile[lang.value]}}</h3>
                            <form id="uploadProjectfile" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/gugr_projects/gugr_files/create_project_file.php" dmx-on:success="notifies1.success('File Uploaded'); uploadFileCollapse.hide();uploadProjectfile.reset();listGugrProjectsFiles.load({project_id: readGuGrProject.data.query_read_gugr_project.project_id})" dmx-on:error="assetNotification.danger('Error!')">
                              <input id="fileCreator" name="project_file_creator" type="text" class="form-control visually-hidden" dmx-bind:value="list_user_info.data.query_list_user_info.user_id">
                              <input id="fileDateCreated" name="project_file_date_created" type="datetime-local" class="form-control visually-hidden" dmx-bind:value="dateTime.datetime">
                              <input id="projectFileProjectId" name="project_file_project_id" type="number" class="form-control visually-hidden" dmx-bind:value="readGuGrProject.data.query_read_gugr_project.project_id">


                              <div class="form-group mb-3 row">
                                <label for="fileUpload" class="col-sm-2 col-form-label col-lg-2">{{trans.data.uploadFileCollapse.lang.value]}}</label>
                                <div class="col-sm-10 offset-md-4 col-lg-5 offset-lg-1">
                                  <input id="projectFileProjectFile" name="project_file" class="form-control visually-hidden"><input type="file" class="form-control" id="fileUpload" name="project_file" aria-describedby="input1_help" data-rule-maxtotalsize="100MB" data-msg-maxtotalsize="Max 100MB!" required="" data-msg-required="!">
                                </div>
                              </div>
                              <div class="form-group mb-3 row">
                                <label for="fileUpload1" class="col-sm-2 col-form-label col-lg-2">{{trans.data.description.lang.value]}}</label>
                                <div class="col-sm-10 offset-md-4 col-lg-5 offset-lg-1">
                                  <textarea id="projectFileProjectFile1" name="project_file_description" class="form-control"></textarea>
                                </div>
                              </div>
                              <div class="form-group mb-3 row">
                                <div class="col-2 col-xxl-6 offset-xxl-4 offset-sm-2 col-sm-2 offset-md-4 offset-lg-3">
                                  <button id="submitProjectFile" class="btn btn-info" type="submit"><i class="fas fa-check fa-2x"></i></button>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col">
                        <div class="table-responsive">
                          <table class="table table-striped table-hover table-sm">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>{{trans.data.file[lang.value]}}</th>
                                <th>{{trans.data.description[lang.value]}}</th>
                                <th>{{trans.data.dateCreated[lang.value]}}</th>
                                <th>{{trans.data.user[lang.value]}}</th>
                                <th></th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="listGugrProjectsFiles.data.query_list_project_files" id="tableRepeat3">
                              <tr>
                                <td dmx-text="project_file_id"></td>
                                <td dmx-text="project_file"></td>
                                <td dmx-text="project_file_description"></td>
                                <td dmx-text="project_file_date_created"></td>
                                <td dmx-text="user_username"></td>
                                <td>
                                  <dmx-download id="downloadFile" dmx-bind:url="'uploads/project_files/'+project_file"></dmx-download><button id="btn3" class="btn text-info" dmx-on:click="run({confirm:{message:'Télécharger Ficher?',then:{steps:{run:{action:`downloadFile.download()`}}},name:'confirm'}})">
                                    <i class="fas fa-download"></i></button>

                                </td>
                                <td>
                                  <form id="deleteProjectFile" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/gugr_projects/gugr_files/delete_project_file.php" dmx-on:success="listGugrProjectsFiles.load({project_id: readGuGrProject.data.query_read_gugr_project.project_id})">
                                    <input id="text4" name="project_file_id" type="text" class="form-control visually-hidden" dmx-bind:value="project_file_id">
                                    <input id="text5" name="project_file" type="text" class="form-control visually-hidden" dmx-bind:value="project_file">
                                  </form>
                                  <button id="btn5" class="btn text-secondary" dmx-on:click="run({confirm:{message:'Supprimer Ficher?',then:{steps:{run:{action:`deleteProjectFile.submit()`}}},name:'confirm'}})">
                                    <i class="far fa-trash-alt"></i></button>

                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>

                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade mt-2" id="navTabs2_3" role="tabpanel">
                    <div class="row justify-content-center">
                      <div class="col"></div>

                    </div>



                  </div>

                </div>

              </div>
            </div>
          </div>
          <div class="modal-footer bg-dark">
            <form id="form1" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/servo_products/delete_product.php" dmx-on:success="notifies1.success('Success');readItemModal.hide();list_item_products.load()" onsubmit=" return confirm('CONFIRM DELETE?');">
              <input id="text1" name="product_id" type="hidden" class="form-control" dmx-bind:value="read_item_product.data.query_read_product.product_id">

              <button id="btn51" class="btn text-secondary" type="submit">
                <i class="far fa-trash-alt fa-lg"></i>
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>

    </div>
    <div class="modal create-modal" id="createItemModal" is="dmx-bs5-modal" tabindex="-1">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{trans.data.new[lang.value]}} {{trans.data.newQuery[lang.value]}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col">
                <form is="dmx-serverconnect-form" id="formCreateNewRequest" method="post" action="dmxConnect/api/gugr_projects/gugr_projects/create_gugr_project.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-on:success="formCreateNewRequest.reset();notifies1.success('Success');listGugrProjects.load({gugr_project_filter: gugrProjectFilter.value, gugr_project_status: gugrProjectStatusFilter.value, offset: list_gugr_projects.data.offset_gugr_projects, limit: gugrProjectLimit.value});createItemModal.hide();readGuGrProject.load({project_id: formCreateNewRequest.data.last_project_insert['last_insert_id()']})" dmx-on:error="notifies1.danger('Error!')">
                  <div class="mb-3 row">
                    <label for="inp_product_name" class="col-sm-2 col-form-label"><b>{{trans.data.code[lang.value]}}</b></label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="gugrprojectcode" name="project_code" aria-describedby="inp_product_name_help">
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label for="inp_product_name" class="col-sm-2 col-form-label"><b>{{trans.data.description[lang.value]}}</b></label>
                    <div class="col-sm-10">
                      <textarea type="text" class="form-control" id="gugrDescription" name="project_description" aria-describedby="inp_product_name_help"></textarea>
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label for="inp_product_name" class="col-sm-2 col-form-label"><b>{{trans.data.dateDue[lang.value]}}</b></label>
                    <div class="col-sm-10">
                      <input id="gugrProjectDateDue" name="project_date_due" type="datetime-local" class="form-control">
                    </div>
                  </div>
                  <input id="gugrProjectType" name="project_type" type="text" class="form-control visually-hidden" dmx-bind:value="'Query'">
                  <input id="gugrProjectStatus" name="project_status" type="text" class="form-control visually-hidden" dmx-bind:value="'Pending'">
                  <input id="gugrProjectUser" name="project_user_created" type="text" class="form-control visually-hidden" dmx-bind:value="list_user_info.data.query_list_user_info.user_id">
                  <input id="gugrProjectDateCreated" name="project_date_created" type="datetime-local" class="form-control visually-hidden" dmx-bind:value="dateTime.datetime">


                  <div class="mb-3 row">
                    <div class="col-sm-2">&nbsp;</div>
                    <div class="col-sm-10">
                      <button type="submit" class="btn btn-info">{{trans.data.register[lang.value]}}</button>
                    </div>
                  </div>
                </form>
              </div>

            </div>

          </div>
          <div class="modal-footer">
          </div>

        </div>
      </div>
    </div>



  </main>
  <main>
    <div class="mt-auto ms-2 me-2">




      <div class="row servo-page-header">
        <div class="col-auto " dmx-animate-enter="slideInLeft">
          <i class="fas fa-folder fa-2x" style="color: #fffa18 !important;"></i>
        </div>
        <div class="col-auto page-heading">
          <h4 class="servo-page-heading fw-bold text-white">{{trans.data.queryManagement[lang.value]}}</h4>
        </div>

        <div class="col style13 page-button" id="pagebuttons">
          <button id="btn1" class="btn style12  btn-dark text-white fw-bold" data-bs-toggle="modal" data-bs-target="#createItemModal" style="background: #47d92e !important; float: right;"><i class="fas fa-plus style14 fa-lg"></i> {{trans.data.createQuery[lang.value]}}</button>
        </div>
      </div>
      <ul class="nav nav-tabs" id="navTabs1_tabs" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="navTabs1_1_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_11" role="tab" aria-controls="navTabs1_1" aria-selected="true"><i class="fas fa-folder" style="margin-right: 5px;"></i>
            {{trans.data.queries[lang.value]}}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="navTabs1_2_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_21" role="tab" aria-controls="navTabs1_2" aria-selected="false"></a>
        </li>
      </ul>
      <div class="tab-content" id="navTabs1_content">

        <div class="tab-pane fade show active mt-3 scrollable" id="navTabs1_11" role="tabpanel">

          <div class="row justify-content-between justify-content-sm-between justify-content-md-between justify-content-lg-between justify-content-xl-between justify-content-xxl-between mb-xl-2 mb-2 sorter">
            <div class="col-xxl-3 col-12 col-sm-12 col-lg-3"><input id="gugrProjectFilter" name="text13" type="text" class="form-control mb-2 form-control-sm" dmx-bind:placeholder="trans.data.search[lang.value]+'  '" style="background: #242424 !important;"></div>

            <div class="col-xl-4 col-xxl-4 flex-sm-wrap col-md flex-md-wrap flex-lg-wrap col-lg col-lg-3 col-sm-auto col-auto" style="">
              <ul class="pagination" dmx-populate="listGugrProjects.data.query_list_gugr_projects" dmx-state="list_gugr_projects" dmx-offset="offset_gugr_projects" dmx-generator="bs5paging">
                <li class="page-item" dmx-class:disabled="listGugrProjects.data.query_list_gugr_projects.page.current == 1" aria-label="First">
                  <a href="javascript:void(0)" class="page-link" dmx-on:click="list_gugr_projects.set('offset_gugr_projects',listGugrProjects.data.query_list_gugr_projects.page.offset.first)"><span aria-hidden="true">&lsaquo;&lsaquo;</span></a>
                </li>
                <li class="page-item" dmx-class:disabled="listGugrProjects.data.query_list_gugr_projects.page.current == 1" aria-label="Previous">
                  <a href="javascript:void(0)" class="page-link" dmx-on:click="list_gugr_projects.set('offset_gugr_projects',listGugrProjects.data.query_list_gugr_projects.page.offset.prev)"><span aria-hidden="true">&lsaquo;</span></a>
                </li>
                <li class="page-item" dmx-class:active="title == listGugrProjects.data.query_list_gugr_projects.page.current" dmx-class:disabled="!active" dmx-repeat="listGugrProjects.data.query_list_gugr_projects.getServerConnectPagination(2,1,'...')">
                  <a href="javascript:void(0)" class="page-link" dmx-on:click="list_gugr_projects.set('offset_gugr_projects',(page-1)*listGugrProjects.data.query_list_gugr_projects.limit)">{{title}}</a>
                </li>
                <li class="page-item" dmx-class:disabled="listGugrProjects.data.query_list_gugr_projects.page.current ==  listGugrProjects.data.query_list_gugr_projects.page.total" aria-label="Next">
                  <a href="javascript:void(0)" class="page-link" dmx-on:click="list_gugr_projects.set('offset_gugr_projects',listGugrProjects.data.query_list_gugr_projects.page.offset.next)"><span aria-hidden="true">&rsaquo;</span></a>
                </li>
                <li class="page-item" dmx-class:disabled="listGugrProjects.data.query_list_gugr_projects.page.current ==  listGugrProjects.data.query_list_gugr_projects.page.total" aria-label="Last">
                  <a href="javascript:void(0)" class="page-link" dmx-on:click="list_gugr_projects.set('offset_gugr_projects',listGugrProjects.data.query_list_gugr_projects.page.offset.last)"><span aria-hidden="true">&rsaquo;&rsaquo;</span></a>
                </li>
              </ul>
            </div>
            <div class="offset-lg-1 col-auto col-xxl col-sm-5 col-md-4 col-lg-3 col-xl-2 col-xxl-2 col-4"><select id="gugrProjectStatusFilter" class="form-select" name="gugrProjectStatusFilter">
                <option value="#">-----</option>
                <option value="Pending">Registered</option>
                <option value="Active">Active</option>
                <option value="Closed">Closed</option>
              </select></div>
            <div class="col-lg-1 col-xl-1 col-md-2 col-sm-2 col-3 offset-lg-1 offset-sm-1"><select id="gugrProjectLimit" class="form-select" name="product_category_sort_limit">
                <option value="5">5</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
                <option value="''">{{trans.data.all[lang.value]}}</option>
              </select></div>

          </div>
          <div class="row">

            <div class="col">
              <h5>{{trans.data.total[lang.value]}} : {{list_item_products.data.query_list_products.total}}&nbsp;</h5>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <div class="table-responsive" id="projectsTable">
                <table class="table table-hover table-sm">
                  <thead>
                    <tr>
                      <th class="sorting" dmx-on:click="list_gugr_projects.set('sort_gugr_projects','project_id');list_gugr_projects.set('dir_gugr_projects',list_gugr_projects.data.dir_gugr_projects == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="list_gugr_projects.data.sort_gugr_projects=='project_id' && list_gugr_projects.data.dir_gugr_projects == 'asc'" dmx-class:sorting_desc="list_gugr_projects.data.sort_gugr_projects=='project_id' && list_gugr_projects.data.dir_gugr_projects == 'desc'">{{trans.data.project[lang.value]}}</th>
                      <th class="sorting" dmx-on:click="list_gugr_projects.set('sort_gugr_projects','project_code');list_gugr_projects.set('dir_gugr_projects',list_gugr_projects.data.dir_gugr_projects == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="list_gugr_projects.data.sort_gugr_projects=='project_code' && list_gugr_projects.data.dir_gugr_projects == 'asc'" dmx-class:sorting_desc="list_gugr_projects.data.sort_gugr_projects=='project_code' && list_gugr_projects.data.dir_gugr_projects == 'desc'">{{trans.data.code[lang.value]}}</th>
                      <th class="sorting" dmx-on:click="list_gugr_projects.set('sort_gugr_projects','user_username');list_gugr_projects.set('dir_gugr_projects',list_gugr_projects.data.dir_gugr_projects == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="list_gugr_projects.data.sort_gugr_projects=='user_username' && list_gugr_projects.data.dir_gugr_projects == 'asc'" dmx-class:sorting_desc="list_gugr_projects.data.sort_gugr_projects=='user_username' && list_gugr_projects.data.dir_gugr_projects == 'desc'">{{trans.data.username[lang.value]}}</th>
                      <th class="sorting" dmx-on:click="list_gugr_projects.set('sort_gugr_projects','project_status');list_gugr_projects.set('dir_gugr_projects',list_gugr_projects.data.dir_gugr_projects == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="list_gugr_projects.data.sort_gugr_projects=='project_status' && list_gugr_projects.data.dir_gugr_projects == 'asc'" dmx-class:sorting_desc="list_gugr_projects.data.sort_gugr_projects=='project_status' && list_gugr_projects.data.dir_gugr_projects == 'desc'">{{trans.data.status[lang.value]}}</th>
                      <th class="sorting" dmx-on:click="list_gugr_projects.set('sort_gugr_projects','project_date_created');list_gugr_projects.set('dir_gugr_projects',list_gugr_projects.data.dir_gugr_projects == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="list_gugr_projects.data.sort_gugr_projects=='project_date_created' && list_gugr_projects.data.dir_gugr_projects == 'asc'" dmx-class:sorting_desc="list_gugr_projects.data.sort_gugr_projects=='project_date_created' && list_gugr_projects.data.dir_gugr_projects == 'desc'">{{trans.data.dateCreated[lang.value]}}</th>
                      <th class="sorting" dmx-on:click="list_gugr_projects.set('sort_gugr_projects','project_date_due');list_gugr_projects.set('dir_gugr_projects',list_gugr_projects.data.dir_gugr_projects == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="list_gugr_projects.data.sort_gugr_projects=='project_date_due' && list_gugr_projects.data.dir_gugr_projects == 'asc'" dmx-class:sorting_desc="list_gugr_projects.data.sort_gugr_projects=='project_date_due' && list_gugr_projects.data.dir_gugr_projects == 'desc'">{{trans.data.dateDue[lang.value]}}</th>

                      <th class="sorting" dmx-on:click="list_gugr_projects.set('sort_gugr_projects','userConcerned_username');list_gugr_projects.set('dir_gugr_projects',list_gugr_projects.data.dir_gugr_projects == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="list_gugr_projects.data.sort_gugr_projects=='userConcerned_username' && list_gugr_projects.data.dir_gugr_projects == 'asc'" dmx-class:sorting_desc="list_gugr_projects.data.sort_gugr_projects=='userConcerned_username' && list_gugr_projects.data.dir_gugr_projects == 'desc'">{{trans.data.attention[lang.value]}}</th>
                      <th class="sorting" dmx-on:click="list_gugr_projects.set('sort_gugr_projects','userConcerned_username');list_gugr_projects.set('dir_gugr_projects',list_gugr_projects.data.dir_gugr_projects == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="list_gugr_projects.data.sort_gugr_projects=='userConcerned_username' &amp;&amp; list_gugr_projects.data.dir_gugr_projects == 'asc'" dmx-class:sorting_desc="list_gugr_projects.data.sort_gugr_projects=='userConcerned_username' &amp;&amp; list_gugr_projects.data.dir_gugr_projects == 'desc'"></th>
                    </tr>
                  </thead>
                  <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="listGugrProjects.data.query_list_gugr_projects.data" id="tableRepeat2" dmx-state="list_gugr_projects" dmx-sort="sort_gugr_projects" dmx-order="dir_gugr_projects">
                    <tr dmx-show="list_user_info.data.query_list_user_info.user_username==userConcerned_username">
                      <td dmx-text="project_id"></td>
                      <td dmx-text="project_code"></td>
                      <td dmx-text="user_username"></td>
                      <td dmx-text="trans.data.getValueOrKey(project_status)[lang.value]" dmx-class:green-state="readGuGrProject.data.query_read_gugr_project.project_status=='Completed'" dmx-class:yellow-state="readGuGrProject.data.query_read_gugr_project.project_status=='Active'" dmx-class:red-state="readGuGrProject.data.query_read_gugr_project.project_status=='Pending'"></td>
                      <td dmx-text="project_date_created"></td>
                      <td dmx-text="project_date_due"></td>

                      <td dmx-text="userConcerned_username"></td>
                      <td>
                        <button id="btn2" class="btn" data-bs-toggle="modal" data-bs-target="#readItemModal" dmx-on:click="session1.set('current_project',project_id);read_item_gugur_project.load({product_id: project_id});listGugrProjectsFiles.load({project_id: project_id})">
                          <i class="far fa-edit"></i></button>
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
  </main>
  <script src="bootstrap/5/js/bootstrap.bundle.min.js"></script>
</body>

</html>