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
			"options": {"loginUrl":"login.php","forbiddenUrl":"login.php","provider":"servo_login"}
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
  <link rel="stylesheet" href="css/style-cud.css" />
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js" integrity="sha256-CutOzxCRucUsn6C6TcEYsauvvYilEniTXldPa6/wu0k=" crossorigin="anonymous"></script>
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
  <link rel="stylesheet" href="bootstrap/5/cerulean/bootstrap.min.css" />
  <script src="dmxAppConnect/dmxScheduler/dmxScheduler.js" defer></script>
</head>

<body id="products" is="dmx-app">
  <dmx-scheduler id="scheduler1" dmx-on:tick="listGugrProjectsSteps.load({user_concerned: list_user_info.data.query_list_user_info.user_id});listGugrProjectsStepsAll.load({});listGugrProjectTasksAll.load({});listGugrNotes.load({project_id: readGuGrProject.data.query_read_gugr_project.project_id});listGugrProjectsStepsAll.load({});gugr_stats.load({});listGugrProjectsProjects.load({});listGugrProjects.load({});gugr_stats.load({})" delay="10"></dmx-scheduler>
  <dmx-serverconnect id="load_users_1" url="dmxConnect/api/servo_users/list_users.php"></dmx-serverconnect>
  <dmx-session-manager id="session1"></dmx-session-manager>
  <dmx-query-manager id="list_gugr_assignments"></dmx-query-manager>
  <dmx-query-manager id="list_gugr_assignments_all"></dmx-query-manager>
  <dmx-query-manager id="list_gugr_projects"></dmx-query-manager>
  <dmx-query-manager id="list_gugr_all_tasks"></dmx-query-manager>
  <dmx-query-manager id="list_gugr_projects_projects"></dmx-query-manager>
  <dmx-query-manager id="listGugrProjectTasks"></dmx-query-manager>

  <dmx-serverconnect id="listGugrProjects" url="dmxConnect/api/gugr_projects/gugr_projects/list_gugr_projects_paged.php" dmx-param:offset="list_gugr_projects.data.offset_gugr_projects" dmx-param:gugr_project_filter="gugrProjectFilter.value" dmx-param:limit="gugrProjectLimit.value" dmx-param:gugr_project_status="gugrProjectStatusFilter.value" dmx-param:dir="query.dir_gugr_projects" dmx-param:sort="query.sort_gugr_projects"></dmx-serverconnect>
  <dmx-serverconnect id="listGugrProjectsProjects" url="dmxConnect/api/gugr_projects/gugr_projects/list_gugr_projects_paged_projects.php" dmx-param:offset="list_gugr_projects_projects.data.offset_gugr_projects_projects" dmx-param:gugr_project_filter="gugrProjectFilterProjects.value" dmx-param:limit="gugrProjectLimitProjects.value" dmx-param:gugr_project_status="gugrProjectStatusFilterProjects.value" dmx-param:dir="query.dir_gugr_projects_projects" dmx-param:sort="query.sort_gugr_projects_projects"></dmx-serverconnect>
  <dmx-serverconnect id="listGugrProjectsSteps" url="dmxConnect/api/gugr_projects/gugr_projects/list_gugr_projects_paged_steps.php" dmx-param:user_concerned="list_user_info.data.query_list_user_info.user_id" dmx-param:sort="query.sort_gugr_assignments" dmx-param:dir="query.dir_gugr_assignments" dmx-param:offset="query.offset_gugr_assignments" dmx-param:limit="gugrAssignmentLimit.value" dmx-param:step_status="gugrAssignmentStatusFilter.value"></dmx-serverconnect>
  <dmx-serverconnect id="listGugrProjectsStepsAll" url="dmxConnect/api/gugr_projects/gugr_projects/list_gugr_projects_paged_steps_all.php" dmx-param:gugr_project_status="gugrProjectStatusFilter.value" dmx-param:user_concerned="list_user_info.data.query_list_user_info.user_id" dmx-param:sort="list_gugr_assignments_all.data.sort_gugr_assignments_all" dmx-param:dir="list_gugr_assignments_all.data.dir_gugr_asignments_all" dmx-param:offset="list_gugr_assignments_all.data.offset_list_gugr_assignments_all" dmx-param:limit="gugrAssignmentLimitAll.value" dmx-param:project_step_status="gugrAssignmenttStatusFilterAll.value"></dmx-serverconnect>
  <dmx-serverconnect id="listGugrProjectSteps" url="dmxConnect/api/gugr_projects/gugr_steps/list_gugr_steps.php" dmx-param:project_id=""></dmx-serverconnect>
  <dmx-serverconnect id="listGugrProjectsFiles" url="dmxConnect/api/gugr_projects/gugr_files/list_project_files.php" dmx-param:offset="list_gugr_projects.data.offset_gugr_projects" dmx-param:gugr_project_filter="gugrProjectFilter.value" dmx-param:limit="gugrProjectLimit.value" dmx-param:gugr_project_status="gugrProjectStatusFilter.value" credentials="" dmx-param:dir="query.dir_gugr_projects" dmx-param:sort="query.sort_gugr_projects"></dmx-serverconnect>

  <dmx-serverconnect id="readGuGrProject" url="dmxConnect/api/gugr_projects/gugr_projects/read_gugr_project.php" dmx-param:product_price_id="load_product_prices.data.query[0].product_price_id" dmx-param:project_id="" noload=""></dmx-serverconnect>
  <dmx-serverconnect id="deleteProjectFile" url="dmxConnect/api/gugr_projects/gugr_files/delete_project_file.php" dmx-param:product_price_id="load_product_prices.data.query[0].product_price_id" dmx-param:project_id="session1.data.current_project"></dmx-serverconnect>
  <dmx-serverconnect id="listGugrNotes" url="dmxConnect/api/gugr_projects/gugr_notes/list_gugr_project_notes.php" dmx-param:project_id="readGuGrProject.data.query_read_gugr_project.project_id"></dmx-serverconnect>
  <dmx-serverconnect id="listGugrUserProjectTasks" url="dmxConnect/api/gugr_projects/gugr_project_tasks/list_gugr_project_tasks.php" dmx-param:offset="" dmx-param:limit="" dmx-param:user_concerned="list_user_info.data.query_list_user_info.user_id" dmx-param:sort="" dmx-param:dir=""></dmx-serverconnect>
  <dmx-serverconnect id="listGugrUserProjectTasksProject" url="dmxConnect/api/gugr_projects/gugr_project_tasks/list_gugr_project_tasks_project.php" dmx-param:offset="" dmx-param:limit="" dmx-param:user_concerned="list_user_info.data.query_list_user_info.user_id" dmx-param:sort="" dmx-param:dir="" dmx-param:project_id="readGuGrProject.data.query_read_gugr_project.project_id"></dmx-serverconnect>
  <dmx-serverconnect id="listGugrUserProjectTasksTable" url="dmxConnect/api/gugr_projects/gugr_project_tasks/list_gugr_project_tasks.php" dmx-param:offset="listGugrProjectTasks.data.offset_gugr_project_tasks" dmx-param:limit="taskStatsModal.gugrProjecTaskstLimit.value" dmx-param:user_concerned="list_user_info.data.query_list_user_info.user_id" dmx-param:sort="listGugrProjectTasks.data.sort_gugr_project_tasks" dmx-param:dir="listGugrProjectTasks.data.dir_gugr_project_tasks"></dmx-serverconnect>
  <dmx-serverconnect id="listGugrUserProjectTasksAll" url="dmxConnect/api/gugr_projects/gugr_project_tasks/list_gugr_project_tasks_all.php" dmx-param:offset="" dmx-param:limit="" dmx-param:user_concerned="list_user_info.data.query_list_user_info.user_id" dmx-param:sort="" dmx-param:dir="" dmx-param:project_id="readGuGrProject.data.query_read_gugr_project.project_id"></dmx-serverconnect>
  <dmx-serverconnect id="listGugrProjectTasksAll" url="dmxConnect/api/gugr_projects/gugr_project_tasks/list_gugr_project_tasks_all_tasks.php" dmx-param:offset="query.offset_all_tasks" dmx-param:limit="taskStatsAllModal.gugrLimitAllTasks.value" dmx-param:user_concerned="taskStatsAllModal.gugrProjectUserConcerned.value" dmx-param:sort="" dmx-param:dir="" dmx-param:project_id="readGuGrProject.data.query_read_gugr_project.project_id" dmx-param:task_status="taskStatsAllModal.gugrProjectTaskStatusFilterAllTasks.value"></dmx-serverconnect>
  <dmx-serverconnect id="gugr_stats" url="dmxConnect/api/gugr_projects/gugr_projects/gugr_stats.php"></dmx-serverconnect>

  <dmx-value id="lang" dmx-bind:value="browser1.language"></dmx-value>
  <dmx-json-datasource id="trans" is="dmx-serverconnect" url="assets/translation/translation.JSON"></dmx-json-datasource>



  <div is="dmx-browser" id="browser1"></div>
  <dmx-notifications id="notifies1" position="bottom" timeout="1000" extended-timeout="0" closable="true" newest-on-top="true"></dmx-notifications>
  <?php include 'gugr-header.php'; ?><main id="mainbody">
    <div class="mt-auto ms-2 me-2">




      <div class="row servo-page-header row-cols-12">
        <div class="col-auto " dmx-animate-enter="slideInLeft">
          <i class="fas fa-folder fa-2x" style="color: #fffa18 !important;"></i>
        </div>
        <div class="col-auto page-heading col-7">
          <h4 class="servo-page-heading fw-bold" style="color: #004d71;">{{trans.data.queryManagement[lang.value]}}</h4>
        </div>

      </div>
      <ul class="nav nav-tabs nav-fill" id="navTabs1_tabs" role="tablist">
        <li class="nav-item" dmx-hide="list_user_info.data.query_list_user_info.user_profile!=='gugr-admin'&amp;&amp;list_user_info.data.query_list_user_info.user_profile!=='gugr-cordo'"><a class="nav-link active" id="navTabs1_1_tab5" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_5" role="tab" aria-controls="navTabs1_1" aria-selected="true"><i class="far fa-eye" style="margin-right: 5px;"></i>
          </a></li>
        <li class="nav-item">
          <a class="nav-link" id="navTabs1_1_tab1" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_1" role="tab" aria-controls="navTabs1_1" aria-selected="true"><i class="fas fa-tasks" style="margin-right: 5px;"></i>

            {{trans.data.myAssignments[lang.value]}}<span class="badge rounded-pill bg-danger" dmx-html="listGugrProjectsSteps.data.query_stats[0].StepPending" style="margin-left: 5px;">New</span></a>
        </li>
        <li class="nav-item" dmx-hide="list_user_info.data.query_list_user_info.user_profile!=='gugr-cordo'">
          <a class="nav-link" id="navTabs1_1_tab2" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_2" role="tab" aria-controls="navTabs1_1" aria-selected="true"><i class="far fa-eye" style="margin-right: 5px;"></i>

            {{trans.data.allAssignments[lang.value]}}<span class="badge rounded-pill bg-danger" dmx-html="listGugrProjectsStepsAll.data.query_stats[0].Pending" style="margin-left: 5px;">New</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="navTabs1_1_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_11" role="tab" aria-controls="navTabs1_1" aria-selected="true"><i class="fas fa-copy" style="margin-right: 5px;"></i>
            {{trans.data.queries[lang.value]}}<span class="badge rounded-pill bg-danger" dmx-html="listGugrProjects.data.query_stats[0].QueryPending" style="margin-left: 5px;">New</span>
          </a>
        </li>
        <li class="nav-item" dmx-hide="list_user_info.data.query_list_user_info.user_profile!=='gugr-admin'&amp;&amp;list_user_info.data.query_list_user_info.user_profile!=='gugr-cordo'"><a class="nav-link" id="navTabs1_1_tab4" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_4" role="tab" aria-controls="navTabs1_1" aria-selected="true"><i class="fas fa-folder-open" style="margin-right: 5px;"></i>
            {{trans.data.projects[lang.value]}}<span class="badge rounded-pill bg-danger" dmx-html="listGugrProjectsProjects.data.query_stats[0].Pending" style="margin-left: 5px;">New</span></a></li>
        <li class="nav-item"><a class="nav-link" id="navTabs1_1_tab3" data-bs-toggle="tab" href="#" data-bs-target="#navTabs1_3" role="tab" aria-controls="navTabs1_1" aria-selected="true"><i class="far fa-calendar-check" style="margin-right: 5px;"></i>
            {{trans.data.myTasks[lang.value]}}</a></li>


      </ul>
      <div class="tab-content" id="navTabs1_content">

        <div class="tab-pane fade mt-3 scrollable show active" id="navTabs1_5" role="tabpanel" dmx-hide="list_user_info.data.query_list_user_info.user_profile!=='gugr-admin'&amp;&amp;list_user_info.data.query_list_user_info.user_profile!=='gugr-cordo'">
          <div class="row">
            <div class="col-auto ">
              <div class="row row-cols-12 justify-content-center gx-2 gy-2 mt-2 pt-3 pb-3 ps-3 pe-3">
                <h1>{{trans.data.queries[lang.value]}}</h1>
                <div class="col text-center bg-danger me-3 pt-3 pb-3 ps-3 pe-3">
                  <h1 dmx-text="listGugrProjects.data.query_stats[0].QueryPending" class="fw-bold"></h1>

                  <h5>{{trans.data.pending[lang.value]}}</h5>
                </div>
                <div class="col text-center bg-warning me-3 pt-3 pb-3 ps-3 pe-3">
                  <h1 dmx-text="listGugrProjects.data.query_stats[0].QueryActive" class="fw-bold"></h1>

                  <h5>{{trans.data.Active[lang.value]}}</h5>
                </div>
                <div class="col text-center bg-success bg-opacity-100 me-3 pt-3 pb-3 ps-3 pe-3">
                  <h1 dmx-text="listGugrProjects.data.query_stats[0].QueryCompleted" class="fw-bold"></h1>

                  <h5>{{trans.data.Completed[lang.value]}}</h5>
                </div>



              </div>
            </div>
            <div class="col-auto ">
              <div class="row row-cols-12 justify-content-center gx-2 gy-2 mt-2 pt-3 pb-3 ps-3 pe-3">
                <h1>{{trans.data.assignments[lang.value]}}</h1>
                <div class="col text-center bg-danger me-3 pt-3 pb-3 ps-3 pe-3">
                  <h1 dmx-text="listGugrProjectsStepsAll.data.query_stats[0].Pending.toNumber().default(0).formatNumber('0','.',',')" class="fw-bold"></h1>

                  <h5>{{trans.data.pending[lang.value]}}</h5>
                </div>
                <div class="col text-center bg-warning me-3 pt-3 pb-3 ps-3 pe-3">
                  <h1 dmx-text="listGugrProjectsStepsAll.data.query_stats[0].Active.toNumber().default(0).formatNumber('0','.',',')" class="fw-bold"></h1>

                  <h5>{{trans.data.Active[lang.value]}}</h5>
                </div>
                <div class="col text-center bg-success bg-opacity-100 me-3 pt-3 pb-3 ps-3 pe-3">
                  <h1 dmx-text="listGugrProjectsStepsAll.data.query_stats[0].Completed.toNumber().default(0).formatNumber('0','.',',')" class="fw-bold"></h1>

                  <h5>{{trans.data.Completed[lang.value]}}</h5>
                </div>



              </div>
            </div>
            <div class="col-auto ">
              <div class="row row-cols-12 justify-content-center gx-2 gy-2 mt-2 pt-3 pb-3 ps-3 pe-3">
                <h1>{{trans.data.projects[lang.value]}}</h1>
                <div class="col text-center bg-danger me-3 pt-3 pb-3 ps-3 pe-3">
                  <h1 dmx-text="listGugrProjectsProjects.data.query_stats[0].Pending.toNumber().default(0)" class="fw-bold"></h1>

                  <h5>{{trans.data.pending[lang.value]}}</h5>
                </div>
                <div class="col text-center bg-warning me-3 pt-3 pb-3 ps-3 pe-3">
                  <h1 dmx-text="listGugrProjectsProjects.data.query_stats[0].Active.toNumber().default(0)" class="fw-bold"></h1>

                  <h5>{{trans.data.Active[lang.value]}}</h5>
                </div>
                <div class="col text-center bg-success bg-opacity-100 me-3 pt-3 pb-3 ps-3 pe-3">
                  <h1 dmx-text="listGugrProjectsProjects.data.query_stats[0].Completed.toNumber().default(0)" class="fw-bold"></h1>

                  <h5>{{trans.data.Completed[lang.value]}}</h5>
                </div>



              </div>
            </div>
            <div class="col-auto ">
              <div class="row row-cols-12 justify-content-center gx-2 gy-2 mt-2 pt-3 pb-3 ps-3 pe-3">
                <h1>{{trans.data.tasks[lang.value]}}</h1>
                <div class="col text-center bg-danger me-3 pt-3 pb-3 ps-3 pe-3">
                  <h1 dmx-text="gugr_stats.data.query_gugr_tasks_stats.where('task_status', 'Pending', '==').count()" class="fw-bold"></h1>

                  <h5>{{trans.data.pending[lang.value]}}</h5>
                </div>
                <div class="col text-center bg-warning me-3 pt-3 pb-3 ps-3 pe-3">
                  <h1 dmx-text="gugr_stats.data.query_gugr_tasks_stats.where('task_status', 'Active', '==').count()" class="fw-bold"></h1>

                  <h5>{{trans.data.Active[lang.value]}}</h5>
                </div>
                <div class="col text-center bg-success bg-opacity-100 me-3 pt-3 pb-3 ps-3 pe-3">
                  <h1 dmx-text="gugr_stats.data.query_gugr_tasks_stats.where('task_status', 'Completed', '==').count()" class="fw-bold"></h1>

                  <h5>{{trans.data.Completed[lang.value]}}</h5>
                </div>



              </div>
            </div>
          </div>












        </div>
        <div class="tab-pane mt-3 scrollable fade" id="navTabs1_1" role="tabpanel">
          <div class="row">

            <div class="col-lg-8">
              <div class="row">
                <div class="row mb-xl-2 mb-2 sorter shadow-none justify-content-start row-cols-12 justify-content-xxl-start justify-content-xl-start justify-content-sm-start justify-content-md-start justify-content-lg-start align-items-start visually-hidden">


                  <div class="flex-sm-wrap col-md flex-md-wrap flex-lg-wrap col-sm-auto col-auto col-lg-auto col-xxl-auto col-xxl-2 col-xl-auto" style="">
                    <ul class="pagination" dmx-populate="listGugrProjects.data.query_list_gugr_projects" dmx-state="list_gugr_projects" dmx-offset="offset_gugr_projects" dmx-generator="bs5paging">
                      <li class="page-item" dmx-class:disabled="listGugrProjects.data.query_list_gugr_projects.page.current == 1" aria-label="First">
                        <a href="javascript:void(0)" class="page-link" dmx-on:click="list_gugr_projects.set('offset_gugr_projects',listGugrProjects.data.query_list_gugr_projects.page.offset.first)"><span aria-hidden="true">‹‹</span></a>
                      </li>
                      <li class="page-item" dmx-class:disabled="listGugrProjects.data.query_list_gugr_projects.page.current == 1" aria-label="Previous">
                        <a href="javascript:void(0)" class="page-link" dmx-on:click="list_gugr_projects.set('offset_gugr_projects',listGugrProjects.data.query_list_gugr_projects.page.offset.prev)"><span aria-hidden="true">‹</span></a>
                      </li>
                      <li class="page-item" dmx-class:active="title == listGugrProjects.data.query_list_gugr_projects.page.current" dmx-class:disabled="!active" dmx-repeat="listGugrProjects.data.query_list_gugr_projects.getServerConnectPagination(2,1,'...')">
                        <a href="javascript:void(0)" class="page-link" dmx-on:click="list_gugr_projects.set('offset_gugr_projects',(page-1)*listGugrProjects.data.query_list_gugr_projects.limit)">{{title}}</a>
                      </li>
                      <li class="page-item" dmx-class:disabled="listGugrProjects.data.query_list_gugr_projects.page.current ==  listGugrProjects.data.query_list_gugr_projects.page.total" aria-label="Next">
                        <a href="javascript:void(0)" class="page-link" dmx-on:click="list_gugr_projects.set('offset_gugr_projects',listGugrProjects.data.query_list_gugr_projects.page.offset.next)"><span aria-hidden="true">›</span></a>
                      </li>
                      <li class="page-item" dmx-class:disabled="listGugrProjects.data.query_list_gugr_projects.page.current ==  listGugrProjects.data.query_list_gugr_projects.page.total" aria-label="Last">
                        <a href="javascript:void(0)" class="page-link" dmx-on:click="list_gugr_projects.set('offset_gugr_projects',listGugrProjects.data.query_list_gugr_projects.page.offset.last)"><span aria-hidden="true">››</span></a>
                      </li>
                    </ul>
                  </div>
                  <div class="col-auto col-md-4 col-lg-3 col-4 col-sm-2 col-xl-auto col-xxl-auto"><select id="gugrAssignmenttStatusFilter" class="form-select" name="gugrProjectStatusFilter">
                      <option selected="" value="">-----</option>
                      <option value="Pending">Registered</option>
                      <option value="Active">Active</option>
                      <option value="Completed">Closed</option>
                    </select></div>
                  <div class="col-md-2 col-sm-2 col-auto col-lg-auto col-xl-auto col-xxl-auto"><select id="gugrAssignmentLimit" class="form-select" name="product_assignment_limit">
                      <option value="5">5</option>
                      <option value="25">25</option>
                      <option value="50">50</option>
                      <option value="100">100</option>
                      <option value="''">{{trans.data.all[lang.value]}}</option>
                    </select></div>

                </div>

              </div>
              <div class="row mb-xl-2 mb-2 sorter shadow-none justify-content-start row-cols-12 justify-content-xxl-start justify-content-xl-start justify-content-sm-start justify-content-md-start justify-content-lg-start align-items-start">


                <div class="col-auto" style="">
                  <ul class="pagination" dmx-populate="listGugrProjectsSteps.data.query_list_gugr_projects" dmx-state="list_gugr_assignments" dmx-offset="offset_gugr_assignments" dmx-generator="bs5paging">
                    <li class="page-item" dmx-class:disabled="listGugrProjectsSteps.data.query_list_gugr_projects.page.current == 1" aria-label="First">
                      <a href="javascript:void(0)" class="page-link" dmx-on:click="list_gugr_assignments.set('offset_gugr_assignments',listGugrProjectsSteps.data.query_list_gugr_projects.page.offset.first)"><span aria-hidden="true">&lsaquo;&lsaquo;</span></a>
                    </li>
                    <li class="page-item" dmx-class:disabled="listGugrProjectsSteps.data.query_list_gugr_projects.page.current == 1" aria-label="Previous">
                      <a href="javascript:void(0)" class="page-link" dmx-on:click="list_gugr_assignments.set('offset_gugr_assignments',listGugrProjectsSteps.data.query_list_gugr_projects.page.offset.prev)"><span aria-hidden="true">&lsaquo;</span></a>
                    </li>
                    <li class="page-item" dmx-class:active="title == listGugrProjectsSteps.data.query_list_gugr_projects.page.current" dmx-class:disabled="!active" dmx-repeat="listGugrProjectsSteps.data.query_list_gugr_projects.getServerConnectPagination(2,1,'...')">
                      <a href="javascript:void(0)" class="page-link" dmx-on:click="list_gugr_assignments.set('offset_gugr_assignments',(page-1)*listGugrProjectsSteps.data.query_list_gugr_projects.limit)">{{title}}</a>
                    </li>
                    <li class="page-item" dmx-class:disabled="listGugrProjectsSteps.data.query_list_gugr_projects.page.current ==  listGugrProjectsSteps.data.query_list_gugr_projects.page.total" aria-label="Next">
                      <a href="javascript:void(0)" class="page-link" dmx-on:click="list_gugr_assignments.set('offset_gugr_assignments',listGugrProjectsSteps.data.query_list_gugr_projects.page.offset.next)"><span aria-hidden="true">&rsaquo;</span></a>
                    </li>
                    <li class="page-item" dmx-class:disabled="listGugrProjectsSteps.data.query_list_gugr_projects.page.current ==  listGugrProjectsSteps.data.query_list_gugr_projects.page.total" aria-label="Last">
                      <a href="javascript:void(0)" class="page-link" dmx-on:click="list_gugr_assignments.set('offset_gugr_assignments',listGugrProjectsSteps.data.query_list_gugr_projects.page.offset.last)"><span aria-hidden="true">&rsaquo;&rsaquo;</span></a>
                    </li>
                  </ul>
                </div>
                <div class="col-auto col-md-4 col-lg-3 col-4 col-sm-2 col-xl-auto col-xxl-auto"><select id="gugrAssignmentStatusFilter" class="form-select" name="gugrAssignmentStatusFilter">
                    <option selected="" value="">-----</option>
                    <option value="Pending">{{trans.data.Pending[lang.value]}}</option>
                    <option value="Active">{{trans.data.Active[lang.value]}}</option>
                    <option value="Completed">{{trans.data.Completed[lang.value]}}</option>
                  </select></div>
                <div class="col-md-2 col-sm-2 col-auto col-lg-auto col-xl-auto col-xxl-auto"><select id="gugrAssignmentLimit" class="form-select" name="gugrAssignmentLimit">
                    <option value="5">5</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="''">{{trans.data.all[lang.value]}}</option>
                  </select></div>

              </div>
              <div class="row">
                <div class="col bg-light me-2 rounded rounded-2">
                  <div class="table-responsive">
                    <table class="table table-hover table-sm">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>{{trans.data.object[lang.value]}}</th>
                          <th>{{trans.data.status[lang.value]}}</th>
                          <th>{{trans.data.dateDue[lang.value]}}</th>
                          <th>{{trans.data.note[lang.value]}}</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="listGugrProjectsSteps.data.query_list_gugr_projects.data" id="tableRepeat5">
                        <tr>
                          <td dmx-text="project_step_id"></td>
                          <td dmx-text="project_code"></td>
                          <td>
                            <h6 dmx-text="trans.data.getValueOrKey(step_status)[lang.value]" dmx-class:green-state="step_status=='Completed'" class="fw-bold pt-1 pb-1 ps-1 pe-1" dmx-class:yellow-state="step_status=='Active'" dmx-class:red-state="step_status=='Pending'" style="/* padding-left: 5px */ text-align: center;"></h6>
                          </td>
                          <td>
                            <p dmx-text="step_end_date" dmx-class:red-state="step_end_date&lt;=dateTime.datetime" class="pt-1 pb-1 ps-2 pe-1 fw-bold text-body text-center"></p>
                          </td>
                          <td dmx-text="step_description"></td>
                          <td>
                            <button id="btn2" class="btn text-body" data-bs-toggle="modal" data-bs-target="#readItemModal" dmx-on:click="session1.set('current_project',project_id);readGuGrProject.load({project_id: project_id});listGugrProjectsFiles.load({project_id: project_id});listGugrProjectSteps.load({project_id: project_id})">
                              <i class="far fa-edit"></i></button>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>


                </div>
              </div>
            </div>
            <div class="col-lg d-flex visually-hidden">
              <div class="row"></div>
              <h2>{{trans.data.overview[lang.value]}}</h2>
              <h5>{{trans.data.Active[lang.value]}}</h5>

              <div class="d-block">
                <h4 dmx-text="listGugrProjects.data.query_stats[0].Active+'  '"></h4>
              </div>
              <div class="d-block">
                <h4 dmx-text="listGugrProjects.data.query_stats[0].Active+'  '"></h4>
              </div>
              <div class="d-block">
                <h4 dmx-text="listGugrProjects.data.query_stats[0].Active+'  '"></h4>
              </div>
            </div>

          </div>





        </div>
        <div class="tab-pane fade mt-3 scrollable" id="navTabs1_2" role="tabpanel" dmx-hide="list_user_info.data.query_list_user_info.user_profile!=='gugr-cordo'">
          <div class="row">

            <div class="bg-light me-2 rounded rounded-2 col">
              <div class="row mb-xl-2 mb-2 sorter shadow-none row-cols-12 justify-content-xxl-start justify-content-xl-start justify-content-sm-start justify-content-md-start justify-content-lg-start align-items-start">


                <div class="col-auto" style="">
                  <ul class="pagination" dmx-populate="listGugrProjectsStepsAll.data.query_list_gugr_projects" dmx-state="list_gugr_assignments" dmx-offset="offset_list_gugr_assignments_all" dmx-generator="bs5paging">
                    <li class="page-item" dmx-class:disabled="listGugrProjectsStepsAll.data.query_list_gugr_projects.page.current == 1" aria-label="First">
                      <a href="javascript:void(0)" class="page-link" dmx-on:click="list_gugr_assignments.set('offset_list_gugr_assignments_all',listGugrProjectsStepsAll.data.query_list_gugr_projects.page.offset.first)"><span aria-hidden="true">‹‹</span></a>
                    </li>
                    <li class="page-item" dmx-class:disabled="listGugrProjectsStepsAll.data.query_list_gugr_projects.page.current == 1" aria-label="Previous">
                      <a href="javascript:void(0)" class="page-link" dmx-on:click="list_gugr_assignments.set('offset_list_gugr_assignments_all',listGugrProjectsStepsAll.data.query_list_gugr_projects.page.offset.prev)"><span aria-hidden="true">‹</span></a>
                    </li>
                    <li class="page-item" dmx-class:active="title == listGugrProjectsStepsAll.data.query_list_gugr_projects.page.current" dmx-class:disabled="!active" dmx-repeat="listGugrProjectsStepsAll.data.query_list_gugr_projects.getServerConnectPagination(2,1,'...')">
                      <a href="javascript:void(0)" class="page-link" dmx-on:click="list_gugr_assignments.set('offset_list_gugr_assignments_all',(page-1)*listGugrProjectsStepsAll.data.query_list_gugr_projects.limit)">{{title}}</a>
                    </li>
                    <li class="page-item" dmx-class:disabled="listGugrProjectsStepsAll.data.query_list_gugr_projects.page.current ==  listGugrProjectsStepsAll.data.query_list_gugr_projects.page.total" aria-label="Next">
                      <a href="javascript:void(0)" class="page-link" dmx-on:click="list_gugr_assignments.set('offset_list_gugr_assignments_all',listGugrProjectsStepsAll.data.query_list_gugr_projects.page.offset.next)"><span aria-hidden="true">›</span></a>
                    </li>
                    <li class="page-item" dmx-class:disabled="listGugrProjectsStepsAll.data.query_list_gugr_projects.page.current ==  listGugrProjectsStepsAll.data.query_list_gugr_projects.page.total" aria-label="Last">
                      <a href="javascript:void(0)" class="page-link" dmx-on:click="list_gugr_assignments.set('offset_list_gugr_assignments_all',listGugrProjectsStepsAll.data.query_list_gugr_projects.page.offset.last)"><span aria-hidden="true">››</span></a>
                    </li>
                  </ul>
                </div>
                <div class="col-auto col-md-4 col-lg-3 col-4 col-sm-2 col-xl-auto col-xxl-auto"><select id="gugrAssignmenttStatusFilterAll" class="form-select" name="gugrProjectStatusFilter">
                    <option selected="" value="">-----</option>
                    <option value="Pending">{{trans.data.Pending[lang.value]}}</option>
                    <option value="Active">{{trans.data.Active[lang.value]}}</option>
                    <option value="Completed">{{trans.data.Completed[lang.value]}}</option>
                  </select></div>
                <div class="col-md-2 col-sm-2 col-auto col-lg-auto col-xl-auto col-xxl-auto"><select id="gugrAssignmentLimitAll" class="form-select" name="product_assignment_limit">
                    <option value="5">5</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="''">{{trans.data.all[lang.value]}}</option>
                  </select></div>

              </div>
              <div class="row">
                <div class="col">
                  <div class="table-responsive">
                    <table class="table table-hover table-sm">
                      <thead>
                        <tr class="text-center">
                          <th class="sorting" dmx-on:click="list_gugr_assignments.set('sort_gugr_assignments_all','project_step_id');list_gugr_assignments.set('dir_gugr_asignments_all',list_gugr_assignments.data.dir_gugr_asignments_all == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="list_gugr_assignments.data.sort_gugr_assignments_all=='project_step_id' &amp;&amp; list_gugr_assignments.data.dir_gugr_asignments_all == 'asc'" dmx-class:sorting_desc="list_gugr_assignments.data.sort_gugr_assignments_all=='project_step_id' &amp;&amp; list_gugr_assignments.data.dir_gugr_asignments_all == 'desc'">#</th>
                          <th class="sorting" dmx-on:click="list_gugr_assignments.set('sort_gugr_assignments_all','project_code');list_gugr_assignments.set('dir_gugr_asignments_all',list_gugr_assignments.data.dir_gugr_asignments_all == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="list_gugr_assignments.data.sort_gugr_assignments_all=='project_code' &amp;&amp; list_gugr_assignments.data.dir_gugr_asignments_all == 'asc'" dmx-class:sorting_desc="list_gugr_assignments.data.sort_gugr_assignments_all=='project_code' &amp;&amp; list_gugr_assignments.data.dir_gugr_asignments_all == 'desc'">{{trans.data.query[lang.value]}}</th>
                          <th class="sorting" dmx-on:click="list_gugr_assignments.set('sort_gugr_assignments_all','step_description');list_gugr_assignments.set('dir_gugr_asignments_all',list_gugr_assignments.data.dir_gugr_asignments_all == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="list_gugr_assignments.data.sort_gugr_assignments_all=='step_description' &amp;&amp; list_gugr_assignments.data.dir_gugr_asignments_all == 'asc'" dmx-class:sorting_desc="list_gugr_assignments.data.sort_gugr_assignments_all=='step_description' &amp;&amp; list_gugr_assignments.data.dir_gugr_asignments_all == 'desc'">{{trans.data.object[lang.value]}}</th>
                          <th class="sorting" dmx-on:click="list_gugr_assignments.set('sort_gugr_assignments_all','step_end_date');list_gugr_assignments.set('dir_gugr_asignments_all',list_gugr_assignments.data.dir_gugr_asignments_all == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="list_gugr_assignments.data.sort_gugr_assignments_all=='step_end_date' &amp;&amp; list_gugr_assignments.data.dir_gugr_asignments_all == 'asc'" dmx-class:sorting_desc="list_gugr_assignments.data.sort_gugr_assignments_all=='step_end_date' &amp;&amp; list_gugr_assignments.data.dir_gugr_asignments_all == 'desc'">{{trans.data.dateDue[lang.value]}}</th>
                          <th class="sorting" dmx-on:click="list_gugr_assignments.set('sort_gugr_assignments_all','step_status');list_gugr_assignments.set('dir_gugr_asignments_all',list_gugr_assignments.data.dir_gugr_asignments_all == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="list_gugr_assignments.data.sort_gugr_assignments_all=='step_status' &amp;&amp; list_gugr_assignments.data.dir_gugr_asignments_all == 'asc'" dmx-class:sorting_desc="list_gugr_assignments.data.sort_gugr_assignments_all=='step_status' &amp;&amp; list_gugr_assignments.data.dir_gugr_asignments_all == 'desc'">{{trans.data.status[lang.value]}}</th>
                          <th class="sorting" dmx-on:click="list_gugr_assignments.set('sort_gugr_assignments_all','user_fname');list_gugr_assignments.set('dir_gugr_asignments_all',list_gugr_assignments.data.dir_gugr_asignments_all == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="list_gugr_assignments.data.sort_gugr_assignments_all=='user_fname' &amp;&amp; list_gugr_assignments.data.dir_gugr_asignments_all == 'asc'" dmx-class:sorting_desc="list_gugr_assignments.data.sort_gugr_assignments_all=='user_fname' &amp;&amp; list_gugr_assignments.data.dir_gugr_asignments_all == 'desc'">{{trans.data.attention[lang.value]}}</th>
                          <th class="sorting"></th>
                        </tr>
                      </thead>
                      <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="listGugrProjectsStepsAll.data.query_list_gugr_projects.data" id="tableRepeat10" dmx-state="list_gugr_assignments" dmx-sort="sort_gugr_assignments_all" dmx-order="dir_gugr_asignments_all">
                        <tr>
                          <td dmx-text="project_step_id" class="text-center"></td>
                          <td dmx-text="project_code" class="text-center"></td>
                          <td dmx-text="step_description"></td>
                          <td>
                            <p dmx-text="step_end_date" dmx-class:red-state="step_end_date&lt;=dateTime.datetime" class="pt-1 pb-1 ps-2 pe-1 fw-bold text-body text-center"></p>
                          </td>
                          <h6 dmx-text="trans.data.getValueOrKey(step_status)[lang.value]" dmx-class:green-state="step_status=='Completed'" class="fw-bold pt-1 pb-1 ps-1 pe-1" dmx-class:yellow-state="step_status=='Active'" dmx-class:red-state="step_status=='Pending'" style="/* padding-left: 5px */ text-align: center;"></h6>
                          </td>
                          <td class="text-center">
                            <h6 dmx-text="trans.data.getValueOrKey(step_status)[lang.value]" dmx-class:green-state="step_status=='Completed'" class="fw-bold pt-1 pb-1 ps-1 pe-1" dmx-class:yellow-state="step_status=='Active'" dmx-class:red-state="step_status=='Pending'" style="/* padding-left: 5px */ text-align: center;"></h6>
                          </td>
                          <td dmx-text="user_fname" class="text-center"></td>
                          <td class="text-center">
                            <button id="btn23" class="btn text-body" data-bs-toggle="modal" data-bs-target="#readItemModal" dmx-on:click="session1.set('current_project',project_id);readGuGrProject.load({project_id: project_id});listGugrProjectsFiles.load({project_id: project_id});listGugrProjectSteps.load({project_id: project_id})">
                              <i class="far fa-edit"></i></button>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>



            </div>
            <div class="col-lg d-flex visually-hidden">
              <div class="row"></div>
              <h2>{{trans.data.overview[lang.value]}}</h2>
              <h5>{{trans.data.Active[lang.value]}}</h5>

              <div class="d-block">
                <h4 dmx-text="listGugrProjects.data.query_stats[0].Active+'  '"></h4>
              </div>
              <div class="d-block">
                <h4 dmx-text="listGugrProjects.data.query_stats[0].Active+'  '"></h4>
              </div>
              <div class="d-block">
                <h4 dmx-text="listGugrProjects.data.query_stats[0].Active+'  '"></h4>
              </div>
            </div>

          </div>





        </div>
        <div class="tab-pane fade scrollable" id="navTabs1_11" role="tabpanel">
          <div class="row">

            <div class="col-12 col-lg-12">
              <div class="row mb-xl-2 mb-2 sorter shadow-none justify-content-start row-cols-12 justify-content-xxl-start justify-content-xl-start justify-content-sm-start justify-content-md-start justify-content-lg-start align-items-start">

                <div class="col-lg-3 col-sm-2 col-auto col-xxl-auto"><input id="gugrProjectFilter" name="text13" type="search" class="form-control mb-2" dmx-bind:placeholder="trans.data.search[lang.value]+'  '"></div>

                <div class="col-auto" style="">
                  <ul class="pagination" dmx-populate="listGugrProjects.data.query_list_gugr_projects" dmx-state="list_gugr_projects" dmx-offset="offset_gugr_projects" dmx-generator="bs5paging">
                    <li class="page-item" dmx-class:disabled="listGugrProjects.data.query_list_gugr_projects.page.current == 1" aria-label="First">
                      <a href="javascript:void(0)" class="page-link" dmx-on:click="list_gugr_projects.set('offset_gugr_projects',listGugrProjects.data.query_list_gugr_projects.page.offset.first)"><span aria-hidden="true">‹‹</span></a>
                    </li>
                    <li class="page-item" dmx-class:disabled="listGugrProjects.data.query_list_gugr_projects.page.current == 1" aria-label="Previous">
                      <a href="javascript:void(0)" class="page-link" dmx-on:click="list_gugr_projects.set('offset_gugr_projects',listGugrProjects.data.query_list_gugr_projects.page.offset.prev)"><span aria-hidden="true">‹</span></a>
                    </li>
                    <li class="page-item" dmx-class:active="title == listGugrProjects.data.query_list_gugr_projects.page.current" dmx-class:disabled="!active" dmx-repeat="listGugrProjects.data.query_list_gugr_projects.getServerConnectPagination(2,1,'...')">
                      <a href="javascript:void(0)" class="page-link" dmx-on:click="list_gugr_projects.set('offset_gugr_projects',(page-1)*listGugrProjects.data.query_list_gugr_projects.limit)">{{title}}</a>
                    </li>
                    <li class="page-item" dmx-class:disabled="listGugrProjects.data.query_list_gugr_projects.page.current ==  listGugrProjects.data.query_list_gugr_projects.page.total" aria-label="Next">
                      <a href="javascript:void(0)" class="page-link" dmx-on:click="list_gugr_projects.set('offset_gugr_projects',listGugrProjects.data.query_list_gugr_projects.page.offset.next)"><span aria-hidden="true">›</span></a>
                    </li>
                    <li class="page-item" dmx-class:disabled="listGugrProjects.data.query_list_gugr_projects.page.current ==  listGugrProjects.data.query_list_gugr_projects.page.total" aria-label="Last">
                      <a href="javascript:void(0)" class="page-link" dmx-on:click="list_gugr_projects.set('offset_gugr_projects',listGugrProjects.data.query_list_gugr_projects.page.offset.last)"><span aria-hidden="true">››</span></a>
                    </li>
                  </ul>
                </div>
                <div class="col-auto col-md-4 col-lg-3 col-4 col-sm-2 col-xl-auto col-xxl-auto"><select id="gugrProjectStatusFilter" class="form-select" name="gugrProjectStatusFilter">
                    <option selected="" value="">-----</option>
                    <option value="Pending">{{trans.data.Pending[lang.value]}}</option>
                    <option value="Active">{{trans.data.Active[lang.value]}}</option>
                    <option value="Completed">{{trans.data.Completed[lang.value]}}</option>
                  </select></div>
                <div class="col-md-2 col-sm-2 col-auto col-lg-auto col-xl-auto col-xxl-auto"><select id="gugrProjectLimit" class="form-select" name="product_category_sort_limit">
                    <option value="5">5</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="''">{{trans.data.all[lang.value]}}</option>
                  </select></div>
                <div class="col-md-2 col-sm-2 col-auto col-lg-auto col-xl-auto col-xxl-auto"><button id="btn1" class="btn style12 fw-bold shadow-none text-white bg-primary" data-bs-toggle="modal" data-bs-target="#createItemModal" style="/* background: #47d92e !important */ float: right;" dmx-hide="list_user_info.data.query_list_user_info.user_profile!=='gugr-reception'&amp;&amp;list_user_info.data.query_list_user_info.user_profile!=='gugr-admin'&amp;&amp;list_user_info.data.query_list_user_info.user_profile!=='gugr-cordo'"><i class="fas fa-plus style14" style="margin-right: 5px;"></i> {{trans.data.createQuery[lang.value]}}</button></div>

              </div>
              <div class="row">
                <div class="col me-2 rounded rounded-2">
                  <div class="table-responsive" id="projectsTable">
                    <table class="table table-hover table-sm">
                      <thead>
                        <tr>
                          <th class="sorting" dmx-on:click="list_gugr_projects.set('sort_gugr_projects','project_id');list_gugr_projects.set('dir_gugr_projects',list_gugr_projects.data.dir_gugr_projects == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="list_gugr_projects.data.sort_gugr_projects=='project_id' &amp;&amp; list_gugr_projects.data.dir_gugr_projects == 'asc'" dmx-class:sorting_desc="list_gugr_projects.data.sort_gugr_projects=='project_id' &amp;&amp; list_gugr_projects.data.dir_gugr_projects == 'desc'">#</th>
                          <th class="sorting" dmx-on:click="list_gugr_projects.set('sort_gugr_projects','project_code');list_gugr_projects.set('dir_gugr_projects',list_gugr_projects.data.dir_gugr_projects == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="list_gugr_projects.data.sort_gugr_projects=='project_code' &amp;&amp; list_gugr_projects.data.dir_gugr_projects == 'asc'" dmx-class:sorting_desc="list_gugr_projects.data.sort_gugr_projects=='project_code' &amp;&amp; list_gugr_projects.data.dir_gugr_projects == 'desc'">{{trans.data.object[lang.value]}}</th>
                          <th class="sorting" dmx-on:click="list_gugr_projects.set('sort_gugr_projects','project_code');list_gugr_projects.set('dir_gugr_projects',list_gugr_projects.data.dir_gugr_projects == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="list_gugr_projects.data.sort_gugr_projects=='project_code' &amp;&amp; list_gugr_projects.data.dir_gugr_projects == 'asc'" dmx-class:sorting_desc="list_gugr_projects.data.sort_gugr_projects=='project_code' &amp;&amp; list_gugr_projects.data.dir_gugr_projects == 'desc'">{{trans.data.expeditor[lang.value]}}</th>
                          <th class="sorting" dmx-on:click="list_gugr_projects.set('sort_gugr_projects','userConcerned_username');list_gugr_projects.set('dir_gugr_projects',list_gugr_projects.data.dir_gugr_projects == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="list_gugr_projects.data.sort_gugr_projects=='userConcerned_username' &amp;&amp; list_gugr_projects.data.dir_gugr_projects == 'asc'" dmx-class:sorting_desc="list_gugr_projects.data.sort_gugr_projects=='userConcerned_username' &amp;&amp; list_gugr_projects.data.dir_gugr_projects == 'desc'">{{trans.data.attention[lang.value]}}</th>
                          <th class="sorting visually-hidden" dmx-on:click="list_gugr_projects.set('sort_gugr_projects','user_username');list_gugr_projects.set('dir_gugr_projects',list_gugr_projects.data.dir_gugr_projects == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="list_gugr_projects.data.sort_gugr_projects=='user_username' &amp;&amp; list_gugr_projects.data.dir_gugr_projects == 'asc'" dmx-class:sorting_desc="list_gugr_projects.data.sort_gugr_projects=='user_username' &amp;&amp; list_gugr_projects.data.dir_gugr_projects == 'desc'">{{trans.data.username[lang.value]}}</th>

                          <th class="sorting" dmx-on:click="list_gugr_projects.set('sort_gugr_projects','project_date_created');list_gugr_projects.set('dir_gugr_projects',list_gugr_projects.data.dir_gugr_projects == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="list_gugr_projects.data.sort_gugr_projects=='project_date_created' &amp;&amp; list_gugr_projects.data.dir_gugr_projects == 'asc'" dmx-class:sorting_desc="list_gugr_projects.data.sort_gugr_projects=='project_date_created' &amp;&amp; list_gugr_projects.data.dir_gugr_projects == 'desc'">{{trans.data.dateCreated[lang.value]}}</th>
                          <th class="sorting" dmx-on:click="list_gugr_projects.set('sort_gugr_projects','project_date_due');list_gugr_projects.set('dir_gugr_projects',list_gugr_projects.data.dir_gugr_projects == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="list_gugr_projects.data.sort_gugr_projects=='project_date_due' &amp;&amp; list_gugr_projects.data.dir_gugr_projects == 'asc'" dmx-class:sorting_desc="list_gugr_projects.data.sort_gugr_projects=='project_date_due' &amp;&amp; list_gugr_projects.data.dir_gugr_projects == 'desc'">{{trans.data.dateDue[lang.value]}}</th>


                          <th class="sorting" dmx-on:click="list_gugr_projects.set('sort_gugr_projects','project_status');list_gugr_projects.set('dir_gugr_projects',list_gugr_projects.data.dir_gugr_projects == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="list_gugr_projects.data.sort_gugr_projects=='project_status' &amp;&amp; list_gugr_projects.data.dir_gugr_projects == 'asc'" dmx-class:sorting_desc="list_gugr_projects.data.sort_gugr_projects=='project_status' &amp;&amp; list_gugr_projects.data.dir_gugr_projects == 'desc'">{{trans.data.status[lang.value]}}</th>
                          <th class="sorting" dmx-on:click="list_gugr_projects.set('sort_gugr_projects','userConcerned_username');list_gugr_projects.set('dir_gugr_projects',list_gugr_projects.data.dir_gugr_projects == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="list_gugr_projects.data.sort_gugr_projects=='userConcerned_username' &amp;&amp; list_gugr_projects.data.dir_gugr_projects == 'asc'" dmx-class:sorting_desc="list_gugr_projects.data.sort_gugr_projects=='userConcerned_username' &amp;&amp; list_gugr_projects.data.dir_gugr_projects == 'desc'"></th>
                        </tr>
                      </thead>
                      <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="listGugrProjects.data.query_list_gugr_projects.data" id="tableRepeat2" dmx-state="list_gugr_projects" dmx-sort="sort_gugr_projects" dmx-order="dir_gugr_projects">
                        <tr>
                          <td dmx-text="project_id"></td>
                          <td dmx-text="project_code"></td>
                          <td dmx-text="project_notes"></td>
                          <td dmx-text="userConcerned_username"></td>
                          <td dmx-text="user_username" class="visually-hidden"></td>

                          <td dmx-text="project_date_created"></td>
                          <td dmx-class:red-state="project_date_due&gt;=dateTime.datetime" class="text-center">
                            <p dmx-text="project_date_due" dmx-class:red-state="project_date_due&lt;=dateTime.datetime" class="pt-1 pb-1 ps-2 pe-1 fw-bold text-body text-center"></p>
                          </td>


                          <td>
                            <h6 dmx-text="trans.data.getValueOrKey(project_status)[lang.value]" dmx-class:green-state="project_status=='Completed'" class="fw-bold pt-1 pb-1 ps-1 pe-1" dmx-class:yellow-state="project_status=='Active'" dmx-class:red-state="project_status=='Pending'" style="/* padding-left: 5px */ text-align: center;"></h6>

                          </td>
                          <td class="text-center">
                            <button id="btn2" class="btn text-body" data-bs-toggle="modal" data-bs-target="#readItemModal" dmx-on:click="session1.set('current_project',project_id);readGuGrProject.load({project_id: project_id});listGugrProjectsFiles.load({project_id: project_id});listGugrProjectSteps.load({project_id: project_id})">
                              <i class="far fa-edit"></i></button>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>


                </div>
              </div>
            </div>
            <div class="col-lg d-flex visually-hidden">
              <div class="row"></div>
              <h2>{{trans.data.overview[lang.value]}}</h2>
              <h5>{{trans.data.Active[lang.value]}}</h5>

              <div class="d-block">
                <h4 dmx-text="listGugrProjects.data.query_stats[0].Active+'  '"></h4>
              </div>
              <div class="d-block">
                <h4 dmx-text="listGugrProjects.data.query_stats[0].Active+'  '"></h4>
              </div>
              <div class="d-block">
                <h4 dmx-text="listGugrProjects.data.query_stats[0].Active+'  '"></h4>
              </div>
            </div>

          </div>





        </div>
        <div class="tab-pane fade scrollable" id="navTabs1_4" role="tabpanel">
          <div class="row row-cols-12 align-items-baseline mt-3">

            <div class="d-flex align-items-baseline flex-wrap col-sm-auto col-auto col-md-auto col-lg-auto col-xl-auto col-xxl-auto">
              <ul class="pagination mb-1 me-2" dmx-populate="listGugrProjectsProjects.data.query_list_gugr_projects_projects" dmx-state="list_gugr_projects" dmx-offset="offset_gugr_projects_projects" dmx-generator="bs5paging">
                <li class="page-item" dmx-class:disabled="listGugrProjectsProjects.data.query_list_gugr_projects_projects.page.current == 1" aria-label="First">
                  <a href="javascript:void(0)" class="page-link" dmx-on:click="list_gugr_projects.set('offset_gugr_projects_projects',listGugrProjectsProjects.data.query_list_gugr_projects_projects.page.offset.first)"><span aria-hidden="true">‹‹</span></a>
                </li>
                <li class="page-item" dmx-class:disabled="listGugrProjectsProjects.data.query_list_gugr_projects_projects.page.current == 1" aria-label="Previous">
                  <a href="javascript:void(0)" class="page-link" dmx-on:click="list_gugr_projects.set('offset_gugr_projects_projects',listGugrProjectsProjects.data.query_list_gugr_projects_projects.page.offset.prev)"><span aria-hidden="true">‹</span></a>
                </li>
                <li class="page-item" dmx-class:active="title == listGugrProjectsProjects.data.query_list_gugr_projects_projects.page.current" dmx-class:disabled="!active" dmx-repeat="listGugrProjectsProjects.data.query_list_gugr_projects_projects.getServerConnectPagination(2,1,'...')">
                  <a href="javascript:void(0)" class="page-link" dmx-on:click="list_gugr_projects.set('offset_gugr_projects_projects',(page-1)*listGugrProjectsProjects.data.query_list_gugr_projects_projects.limit)">{{title}}</a>
                </li>
                <li class="page-item" dmx-class:disabled="listGugrProjectsProjects.data.query_list_gugr_projects_projects.page.current ==  listGugrProjectsProjects.data.query_list_gugr_projects_projects.page.total" aria-label="Next">
                  <a href="javascript:void(0)" class="page-link" dmx-on:click="list_gugr_projects.set('offset_gugr_projects_projects',listGugrProjectsProjects.data.query_list_gugr_projects_projects.page.offset.next)"><span aria-hidden="true">›</span></a>
                </li>
                <li class="page-item" dmx-class:disabled="listGugrProjectsProjects.data.query_list_gugr_projects_projects.page.current ==  listGugrProjectsProjects.data.query_list_gugr_projects_projects.page.total" aria-label="Last">
                  <a href="javascript:void(0)" class="page-link" dmx-on:click="list_gugr_projects.set('offset_gugr_projects_projects',listGugrProjectsProjects.data.query_list_gugr_projects_projects.page.offset.last)"><span aria-hidden="true">››</span></a>
                </li>
              </ul>
            </div>
            <div class="d-flex align-items-baseline flex-wrap col-sm-auto col-auto col-md-auto col-lg-auto col-xl-auto col-xxl-auto">
              <select id="gugrProjectStatusFilterProjects" class="form-select mb-1 me-2" name="gugrProjectStatusFilterProjects">
                <option selected="" value="">-----</option>
                <option value="Pending">Registered</option>
                <option value="Active">Active</option>
                <option value="Completed">Closed</option>
              </select>
            </div>
            <div class="d-flex align-items-baseline flex-wrap col-sm-auto col-auto col-md-auto col-lg-auto col-xl-auto col-xxl-auto">
              <select id="gugrProjectLimitProjects" class="form-select mb-1 me-2" name="gugr_project_limit_projects">
                <option value="5">5</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
                <option value="''">{{trans.data.all[lang.value]}}</option>
              </select>
            </div>
            <div class="d-flex align-items-baseline flex-wrap col-sm-auto col-auto col-md-auto col-lg-auto col-xl-auto col-xxl-auto">
              <input id="gugrProjectFilter1" name="text1" type="text" class="form-control form-control-sm mb-1 me-2" dmx-bind:placeholder="trans.data.search[lang.value]+'  '" style="width: 200px;">
            </div>
            <div class="d-flex align-items-baseline flex-wrap col-sm-auto col-auto col-md-auto col-lg-auto col-xl-auto col-xxl-auto">
              <button id="btn22" class="btn text-white fw-bold bg-primary" data-bs-toggle="modal" data-bs-target="#createProject">
                <i class="fas fa-plus" style="margin-right: 5px;"></i>&nbsp;{{trans.data.createProject[lang.value]}}</button>
            </div>
            <div class="col-lg d-flex visually-hidden">
              <div class="row"></div>
              <h2>{{trans.data.overview[lang.value]}}</h2>
              <h5>{{trans.data.Active[lang.value]}}</h5>

              <div class="d-block">
                <h4 dmx-text="listGugrProjects.data.query_stats[0].Active+'  '"></h4>
              </div>
              <div class="d-block">
                <h4 dmx-text="listGugrProjects.data.query_stats[0].Active+'  '"></h4>
              </div>
              <div class="d-block">
                <h4 dmx-text="listGugrProjects.data.query_stats[0].Active+'  '"></h4>
              </div>
            </div>

          </div>
          <div class="row">
            <div class="col me-2 rounded rounded-2">
              <div class="table-responsive">
                <table class="table table-hover table-sm">
                  <thead class="text-center">
                    <tr>
                      <th class="sorting" dmx-on:click="list_gugr_assignments.set('sort_gugr_projects_projects','project_id');list_gugr_assignments.set('dir_gugr_projects_projects',list_gugr_assignments.data.dir_gugr_projects_projects == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="list_gugr_assignments.data.sort_gugr_projects_projects=='project_id' &amp;&amp; list_gugr_assignments.data.dir_gugr_projects_projects == 'asc'" dmx-class:sorting_desc="list_gugr_assignments.data.sort_gugr_projects_projects=='project_id' &amp;&amp; list_gugr_assignments.data.dir_gugr_projects_projects == 'desc'">#</th>
                      <th class="sorting" dmx-on:click="list_gugr_assignments.set('sort_gugr_projects_projects','project_code');list_gugr_assignments.set('dir_gugr_projects_projects',list_gugr_assignments.data.dir_gugr_projects_projects == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="list_gugr_assignments.data.sort_gugr_projects_projects=='project_code' &amp;&amp; list_gugr_assignments.data.dir_gugr_projects_projects == 'asc'" dmx-class:sorting_desc="list_gugr_assignments.data.sort_gugr_projects_projects=='project_code' &amp;&amp; list_gugr_assignments.data.dir_gugr_projects_projects == 'desc'">{{trans.data.code[lang.value]}}</th>
                      <th class="sorting" dmx-on:click="list_gugr_assignments.set('sort_gugr_projects_projects','project_date_created');list_gugr_assignments.set('dir_gugr_projects_projects',list_gugr_assignments.data.dir_gugr_projects_projects == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="list_gugr_assignments.data.sort_gugr_projects_projects=='project_date_created' &amp;&amp; list_gugr_assignments.data.dir_gugr_projects_projects == 'asc'" dmx-class:sorting_desc="list_gugr_assignments.data.sort_gugr_projects_projects=='project_date_created' &amp;&amp; list_gugr_assignments.data.dir_gugr_projects_projects == 'desc'">{{trans.data.dateCreated[lang.value]}}</th>
                      <th class="sorting" dmx-on:click="list_gugr_assignments.set('sort_gugr_projects_projects','project_date_due');list_gugr_assignments.set('dir_gugr_projects_projects',list_gugr_assignments.data.dir_gugr_projects_projects == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="list_gugr_assignments.data.sort_gugr_projects_projects=='project_date_due' &amp;&amp; list_gugr_assignments.data.dir_gugr_projects_projects == 'asc'" dmx-class:sorting_desc="list_gugr_assignments.data.sort_gugr_projects_projects=='project_date_due' &amp;&amp; list_gugr_assignments.data.dir_gugr_projects_projects == 'desc'">{{trans.data.dateDue[lang.value]}}</th>
                      <th class="sorting" dmx-on:click="list_gugr_assignments.set('sort_gugr_projects_projects','project_notes');list_gugr_assignments.set('dir_gugr_projects_projects',list_gugr_assignments.data.dir_gugr_projects_projects == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="list_gugr_assignments.data.sort_gugr_projects_projects=='project_notes' &amp;&amp; list_gugr_assignments.data.dir_gugr_projects_projects == 'asc'" dmx-class:sorting_desc="list_gugr_assignments.data.sort_gugr_projects_projects=='project_notes' &amp;&amp; list_gugr_assignments.data.dir_gugr_projects_projects == 'desc'">{{trans.data.note[lang.value]}}</th>

                      <th class="sorting" dmx-on:click="list_gugr_assignments.set('sort_gugr_projects_projects','project_status');list_gugr_assignments.set('dir_gugr_projects_projects',list_gugr_assignments.data.dir_gugr_projects_projects == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="list_gugr_assignments.data.sort_gugr_projects_projects=='project_status' &amp;&amp; list_gugr_assignments.data.dir_gugr_projects_projects == 'asc'" dmx-class:sorting_desc="list_gugr_assignments.data.sort_gugr_projects_projects=='project_status' &amp;&amp; list_gugr_assignments.data.dir_gugr_projects_projects == 'desc'">{{trans.data.status[lang.value]}}</th>
                      <th class="sorting" dmx-on:click="list_gugr_assignments.set('sort_gugr_projects_projects','user_username');list_gugr_assignments.set('dir_gugr_projects_projects',list_gugr_assignments.data.dir_gugr_projects_projects == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="list_gugr_assignments.data.sort_gugr_projects_projects=='user_username' &amp;&amp; list_gugr_assignments.data.dir_gugr_projects_projects == 'asc'" dmx-class:sorting_desc="list_gugr_assignments.data.sort_gugr_projects_projects=='user_username' &amp;&amp; list_gugr_assignments.data.dir_gugr_projects_projects == 'desc'">{{trans.data.user[lang.value]}}</th>
                      <th dmx-on:click="list_gugr_assignments.set('sort_gugr_projects_projects','user_username');list_gugr_assignments.set('dir_gugr_projects_projects',list_gugr_assignments.data.dir_gugr_projects_projects == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="list_gugr_assignments.data.sort_gugr_projects_projects=='user_username' &amp;&amp; list_gugr_assignments.data.dir_gugr_projects_projects == 'asc'" dmx-class:sorting_desc="list_gugr_assignments.data.sort_gugr_projects_projects=='user_username' &amp;&amp; list_gugr_assignments.data.dir_gugr_projects_projects == 'desc'"></th>
                    </tr>
                  </thead>
                  <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="listGugrProjectsProjects.data.query_list_gugr_projects_projects.data" id="tableRepeat6" dmx-state="list_gugr_assignments" dmx-sort="sort_gugr_projects_projects" dmx-order="dir_gugr_projects_projects" class="text-center">
                    <tr>
                      <td dmx-text="project_id"></td>
                      <td dmx-text="project_code"></td>
                      <td dmx-text="project_date_created"></td>
                      <td dmx-class:red-state="project_date_due>=dateTime.datetime" class="text-center">
                        <p dmx-text="project_date_due" dmx-class:red-state="project_date_due<=dateTime.datetime" class="pt-1 pb-1 ps-2 pe-1 fw-bold text-body">Fancy display heading</p>
                      </td>
                      <td dmx-text="project_notes"></td>

                      <td>
                        <h6 dmx-text="trans.data.getValueOrKey(project_status)[lang.value]" dmx-class:green-state="project_status=='Completed'" class="fw-bold pt-1 pb-1 ps-1 pe-1" dmx-class:yellow-state="project_status=='Active'" dmx-class:red-state="project_status=='Pending'" style="/* padding-left: 5px */ text-align: center;">Fancy display heading</h6>

                      </td>
                      <td dmx-text="user_username"></td>
                      <td>
                        <button id="btn13" class="btn text-body" data-bs-toggle="modal" data-bs-target="#readItemModalProject" dmx-on:click="session1.set('current_project',project_id);readGuGrProject.load({project_id: project_id});listGugrProjectsFiles.load({project_id: project_id});listGugrProjectSteps.load({project_id: project_id})">
                          <i class="far fa-edit"></i></button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>


            </div>
          </div>





        </div>
        <div class="tab-pane fade mt-3 scrollable" id="navTabs1_3" role="tabpanel">
          <div class="modal" id="createTask" is="dmx-bs5-modal" tabindex="-1">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title text-dark">{{trans.data.createNewTask[lang.value]}}</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="row row-cols-12 mb-0 me-2 pt-2 pb-2">
                    <div class="col-sm-12 bg-opacity-10 bg-primary col-12 col-xxl-12 col-lg-12 col-xl-12 ms-2 me-2 pt-3 pb-2 pe-3">
                      <form id="createProjectTaskForm" is="dmx-serverconnect-form" method="post" action="dmxConnect/api/gugr_projects/gugr_project_tasks/create_gugr_project_task.php" dmx-on:success="notifies1.success('Success!');listGugrUserProjectTasks.load({});listGugrUserProjectTasksAll.load({});createProjectTaskForm.reset()" dmx-on:error="notifies1.danger('Error!')">
                        <textarea id="taskDescription" name="task_description" type="text" class="form-control" style="height: 100px;"></textarea>
                        <input id="taskDateCreated" name="task_date_created" type="datetime-local" class="form-control visually-hidden" dmx-bind:value="dateTime.datetime">
                        <input id="taskStatus" name="task_status" class="form-control visually-hidden" dmx-bind:value="'Pending'">
                        <input id="taskUserCreated" name="task_user_created" class="form-control visually-hidden" dmx-bind:value="list_user_info.data.query_list_user_info.user_id" type="number">
                        <input id="taskUserConcerned" name="task_user_concerned" class="form-control visually-hidden" dmx-bind:value="list_user_info.data.query_list_user_info.user_id" type="number">
                        <input id="taskProject" name="task_project" class="form-control visually-hidden" type="number">
                        <div class="row justify-content-end mt-1 ps-2 pe-2">
                          <small class="text-muted">{{trans.data.createNewTAsk[lang.value]}}</small>
                          <button id="btn15" class="btn mt-1 mb-2 w-25 btn-primary visually-hidden" type="submit">
                            <i class="fas fa-plus-circle"></i>
                          </button>
                        </div>

                      </form>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary w-auto" dmx-on:click="createProjectTaskForm.submit()">
                    <i class="fas fa-plus"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div class="modal" id="taskStatsModal" is="dmx-bs5-modal" tabindex="-1">
            <div class="modal-dialog modal-fullscreen-xl-down modal-xl" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">{{trans.data.myTasks[lang.value]}}</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="row mb-xl-2 mb-2 sorter shadow-none bg-light justify-content-start justify-content-md-start justify-content-lg-start justify-content-xl-start justify-content-xxl-start row-cols-12 justify-content-sm-start">


                    <div class="flex-sm-wrap flex-md-wrap flex-lg-wrap col-sm-auto col-auto col-md-auto col-lg-auto col-xl-auto col-xxl-auto" style="">
                      <ul class="pagination" dmx-populate="listGugrUserProjectTasks.data.list_project_tasks_paged" dmx-state="list_gugr_projects" dmx-offset="offset_gugr_project_tasks" dmx-generator="bs5paging">
                        <li class="page-item" dmx-class:disabled="listGugrUserProjectTasks.data.list_project_tasks_paged.page.current == 1" aria-label="First">
                          <a href="javascript:void(0)" class="page-link" dmx-on:click="list_gugr_projects.set('offset_gugr_project_tasks',listGugrUserProjectTasks.data.list_project_tasks_paged.page.offset.first)"><span aria-hidden="true">‹‹</span></a>
                        </li>
                        <li class="page-item" dmx-class:disabled="listGugrUserProjectTasks.data.list_project_tasks_paged.page.current == 1" aria-label="Previous">
                          <a href="javascript:void(0)" class="page-link" dmx-on:click="list_gugr_projects.set('offset_gugr_project_tasks',listGugrUserProjectTasks.data.list_project_tasks_paged.page.offset.prev)"><span aria-hidden="true">‹</span></a>
                        </li>
                        <li class="page-item" dmx-class:active="title == listGugrUserProjectTasks.data.list_project_tasks_paged.page.current" dmx-class:disabled="!active" dmx-repeat="listGugrUserProjectTasks.data.list_project_tasks_paged.getServerConnectPagination(2,1,'...')">
                          <a href="javascript:void(0)" class="page-link" dmx-on:click="list_gugr_projects.set('offset_gugr_project_tasks',(page-1)*listGugrUserProjectTasks.data.list_project_tasks_paged.limit)">{{title}}</a>
                        </li>
                        <li class="page-item" dmx-class:disabled="listGugrUserProjectTasks.data.list_project_tasks_paged.page.current ==  listGugrUserProjectTasks.data.list_project_tasks_paged.page.total" aria-label="Next">
                          <a href="javascript:void(0)" class="page-link" dmx-on:click="list_gugr_projects.set('offset_gugr_project_tasks',listGugrUserProjectTasks.data.list_project_tasks_paged.page.offset.next)"><span aria-hidden="true">›</span></a>
                        </li>
                        <li class="page-item" dmx-class:disabled="listGugrUserProjectTasks.data.list_project_tasks_paged.page.current ==  listGugrUserProjectTasks.data.list_project_tasks_paged.page.total" aria-label="Last">
                          <a href="javascript:void(0)" class="page-link" dmx-on:click="list_gugr_projects.set('offset_gugr_project_tasks',listGugrUserProjectTasks.data.list_project_tasks_paged.page.offset.last)"><span aria-hidden="true">››</span></a>
                        </li>
                      </ul>
                    </div>
                    <div class="col-auto col-xl-2 col-md-auto col-sm-auto col-3 col-sm-2 col-lg-2 col-xxl-auto"><select id="gugrProjectTaskStatusFilter" class="form-select" name="gugrProjectStatusFilter1">
                        <option selected="" value="">-----</option>
                        <option value="Pending">Registered</option>
                        <option value="Active">Active</option>
                        <option value="Completed">Closed</option>
                      </select></div>
                    <div class="offset-sm-1 col-md-auto col-auto col-sm-auto col-sm-2 col-lg-auto offset-xl-1 col-xl-1 col-xxl-auto">

                      <select id="gugrProjecTaskstLimit" class="form-select" name="product_category_sort_limit1">
                        <option value="5">5</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="''">{{trans.data.all[lang.value]}}</option>
                      </select>
                    </div>
                    <div class="col-xl-2 offset-xl-1 col-md-auto col-auto col-sm-auto col-lg-2 col-xxl-auto">
                    </div>

                  </div>
                  <div class="row">
                    <div class="col bg-light rounded rounded-2 ms-2 me-2">
                      <div class="table-responsive">
                        <table class="table table-hover table-sm">
                          <thead class="text-center">
                            <tr>
                              <th class="sorting" dmx-on:click="list_gugr_projects.set('sort_gugr_project_tasks','task_id');list_gugr_projects.set('dir_gugr_project_tasks',list_gugr_projects.data.dir_gugr_project_tasks == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="list_gugr_projects.data.sort_gugr_project_tasks=='task_id' &amp;&amp; list_gugr_projects.data.dir_gugr_project_tasks == 'asc'" dmx-class:sorting_desc="list_gugr_projects.data.sort_gugr_project_tasks=='task_id' &amp;&amp; list_gugr_projects.data.dir_gugr_project_tasks == 'desc'">#</th>
                              <th class="sorting" dmx-on:click="list_gugr_projects.set('sort_gugr_project_tasks','task_date_created');list_gugr_projects.set('dir_gugr_project_tasks',list_gugr_projects.data.dir_gugr_project_tasks == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="list_gugr_projects.data.sort_gugr_project_tasks=='task_date_created' &amp;&amp; list_gugr_projects.data.dir_gugr_project_tasks == 'asc'" dmx-class:sorting_desc="list_gugr_projects.data.sort_gugr_project_tasks=='task_date_created' &amp;&amp; list_gugr_projects.data.dir_gugr_project_tasks == 'desc'">{{trans.data.dateTime[lang.value]}}</th>
                              <th class="sorting" dmx-on:click="list_gugr_projects.set('sort_gugr_project_tasks','task_user_created');list_gugr_projects.set('dir_gugr_project_tasks',list_gugr_projects.data.dir_gugr_project_tasks == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="list_gugr_projects.data.sort_gugr_project_tasks=='task_user_created' &amp;&amp; list_gugr_projects.data.dir_gugr_project_tasks == 'asc'" dmx-class:sorting_desc="list_gugr_projects.data.sort_gugr_project_tasks=='task_user_created' &amp;&amp; list_gugr_projects.data.dir_gugr_project_tasks == 'desc'">{{trans.data.user[lang.value]}}</th>
                              <th class="sorting" dmx-on:click="list_gugr_projects.set('sort_gugr_project_tasks','task_user_concerned');list_gugr_projects.set('dir_gugr_project_tasks',list_gugr_projects.data.dir_gugr_project_tasks == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="list_gugr_projects.data.sort_gugr_project_tasks=='task_user_concerned' &amp;&amp; list_gugr_projects.data.dir_gugr_project_tasks == 'asc'" dmx-class:sorting_desc="list_gugr_projects.data.sort_gugr_project_tasks=='task_user_concerned' &amp;&amp; list_gugr_projects.data.dir_gugr_project_tasks == 'desc'">{{trans.data.attention[lang.value]}}</th>
                              <th class="sorting" dmx-on:click="list_gugr_projects.set('sort_gugr_project_tasks','task_notes');list_gugr_projects.set('dir_gugr_project_tasks',list_gugr_projects.data.dir_gugr_project_tasks == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="list_gugr_projects.data.sort_gugr_project_tasks=='task_notes' &amp;&amp; list_gugr_projects.data.dir_gugr_project_tasks == 'asc'" dmx-class:sorting_desc="list_gugr_projects.data.sort_gugr_project_tasks=='task_notes' &amp;&amp; list_gugr_projects.data.dir_gugr_project_tasks == 'desc'">{{trans.data.note[lang.value]}}</th>
                              <th class="sorting" dmx-on:click="list_gugr_projects.set('sort_gugr_project_tasks','task_status');list_gugr_projects.set('dir_gugr_project_tasks',list_gugr_projects.data.dir_gugr_project_tasks == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="list_gugr_projects.data.sort_gugr_project_tasks=='task_status' &amp;&amp; list_gugr_projects.data.dir_gugr_project_tasks == 'asc'" dmx-class:sorting_desc="list_gugr_projects.data.sort_gugr_project_tasks=='task_status' &amp;&amp; list_gugr_projects.data.dir_gugr_project_tasks == 'desc'">{{trans.data.status[lang.value]}}</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="listGugrUserProjectTasks.data.list_project_tasks_paged.data" id="tableRepeat4" dmx-state="list_gugr_projects" dmx-sort="sort_gugr_project_tasks" dmx-order="dir_gugr_project_tasks">
                            <tr>
                              <td dmx-text="task_id"></td>
                              <td dmx-text="task_date_created" class="text-center"></td>
                              <td dmx-text="userCratedName" class="text-center"></td>
                              <td dmx-text="userConcernedName" class="text-center"></td>
                              <td dmx-text="task_description"></td>
                              <td dmx-text="task_status" dmx-class:text-success="task_status=='Completed'" dmx-class:text-danger="task_status=='Pending'" class="text-center"></td>
                              <td class="text-center">
                                <form id="updateTaskToComplete" is="dmx-serverconnect-form" method="post" action="dmxConnect/api/gugr_projects/gugr_project_tasks/update_gugr_project_task_to_completed.php" dmx-on:success="notifies1.success('Success');listGugrUserProjectTasks.load({})">
                                  <input id="text9" name="task_status" type="text" class="form-control visually-hidden" dmx-bind:value="'Completed'">
                                  <input id="text10" name="task_id" type="text" class="form-control visually-hidden" dmx-bind:value="task_id">
                                  <input id="text11" class="visually-hidden" name="task_date_completed" type="datetime-local" dmx-bind:value="dateTime.datetime">
                                  <button id="btn14" class="btn text-danger visually-hidden" type="submit">
                                    <i class="fas fa-thumbs-up"></i></button>
                                </form>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>


                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                </div>
              </div>
            </div>
          </div>
          <div class="modal" id="taskStatsAllModal" is="dmx-bs5-modal" tabindex="-1">
            <div class="modal-dialog modal-fullscreen-xl-down modal-xl" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">{{trans.data.allTasks[lang.value]}}</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="row mb-xl-2 mb-2 sorter shadow-none bg-light justify-content-start justify-content-md-start justify-content-lg-start justify-content-xl-start justify-content-xxl-start row-cols-12 justify-content-sm-start">


                    <div class="flex-sm-wrap flex-md-wrap flex-lg-wrap col-sm-auto col-auto col-md-auto col-lg-auto col-xl-auto col-xxl-auto" style="">
                      <ul class="pagination" dmx-populate="listGugrProjectTasksAll.data.list_project_tasks_paged" dmx-state="list_gugr_projects" dmx-offset="offset_all_tasks" dmx-generator="bs5paging">
                        <li class="page-item" dmx-class:disabled="listGugrProjectTasksAll.data.list_project_tasks_paged.page.current == 1" aria-label="First">
                          <a href="javascript:void(0)" class="page-link" dmx-on:click="list_gugr_projects.set('offset_all_tasks',listGugrProjectTasksAll.data.list_project_tasks_paged.page.offset.first)"><span aria-hidden="true">‹‹</span></a>
                        </li>
                        <li class="page-item" dmx-class:disabled="listGugrProjectTasksAll.data.list_project_tasks_paged.page.current == 1" aria-label="Previous">
                          <a href="javascript:void(0)" class="page-link" dmx-on:click="list_gugr_projects.set('offset_all_tasks',listGugrProjectTasksAll.data.list_project_tasks_paged.page.offset.prev)"><span aria-hidden="true">‹</span></a>
                        </li>
                        <li class="page-item" dmx-class:active="title == listGugrProjectTasksAll.data.list_project_tasks_paged.page.current" dmx-class:disabled="!active" dmx-repeat="listGugrProjectTasksAll.data.list_project_tasks_paged.getServerConnectPagination(2,1,'...')">
                          <a href="javascript:void(0)" class="page-link" dmx-on:click="list_gugr_projects.set('offset_all_tasks',(page-1)*listGugrProjectTasksAll.data.list_project_tasks_paged.limit)">{{title}}</a>
                        </li>
                        <li class="page-item" dmx-class:disabled="listGugrProjectTasksAll.data.list_project_tasks_paged.page.current ==  listGugrProjectTasksAll.data.list_project_tasks_paged.page.total" aria-label="Next">
                          <a href="javascript:void(0)" class="page-link" dmx-on:click="list_gugr_projects.set('offset_all_tasks',listGugrProjectTasksAll.data.list_project_tasks_paged.page.offset.next)"><span aria-hidden="true">›</span></a>
                        </li>
                        <li class="page-item" dmx-class:disabled="listGugrProjectTasksAll.data.list_project_tasks_paged.page.current ==  listGugrProjectTasksAll.data.list_project_tasks_paged.page.total" aria-label="Last">
                          <a href="javascript:void(0)" class="page-link" dmx-on:click="list_gugr_projects.set('offset_all_tasks',listGugrProjectTasksAll.data.list_project_tasks_paged.page.offset.last)"><span aria-hidden="true">››</span></a>
                        </li>
                      </ul>
                    </div>
                    <div class="col-auto col-xl-2 col-md-auto col-sm-auto col-3 col-sm-2 col-lg-2 col-xxl-auto"><select id="gugrProjectTaskStatusFilterAllTasks" class="form-select" name="gugrProjectStatusFilterAllTasks">
                        <option selected="" value="">-----</option>
                        <option value="Pending">Registered</option>
                        <option value="Active">Active</option>
                        <option value="Completed">Closed</option>
                      </select></div>
                    <div class="col-auto col-xl-2 col-md-auto col-sm-auto col-3 col-sm-2 col-lg-2 col-xxl-auto"><select id="gugrProjectUserConcerned" class="form-select" name="gugrProjectUserConcerned" dmx-bind:options="load_users_1.data.query_list_users" optiontext="user_username+' | '+user_fname+' '+user_lname" optionvalue="user_id">
                        <option value="">-----</option>
                      </select></div>
                    <div class="offset-sm-1 col-md-auto col-auto col-sm-auto col-sm-2 col-lg-auto offset-xl-1 col-xl-1 col-xxl-auto">

                      <select id="gugrLimitAllTasks" class="form-select" name="product_category_sort_limit2">
                        <option value="5">5</option>
                        <option value="25">25</option>
                        <option selected="" value="50">50</option>
                        <option value="100">100</option>
                        <option value="''">{{trans.data.all[lang.value]}}</option>
                      </select>
                    </div>
                    <div class="col-xl-2 offset-xl-1 col-md-auto col-auto col-sm-auto col-lg-2 col-xxl-auto">
                    </div>

                  </div>
                  <div class="row">
                    <div class="col bg-light rounded rounded-2 ms-2 me-2">
                      <div class="table-responsive">
                        <table class="table table-hover table-sm">
                          <thead class="text-center">
                            <tr>
                              <th class="sorting" dmx-on:click="list_gugr_projects.set('sort_gugr_project_tasks','task_id');list_gugr_projects.set('dir_gugr_project_tasks',list_gugr_projects.data.dir_gugr_project_tasks == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="list_gugr_projects.data.sort_gugr_project_tasks=='task_id' &amp;&amp; list_gugr_projects.data.dir_gugr_project_tasks == 'asc'" dmx-class:sorting_desc="list_gugr_projects.data.sort_gugr_project_tasks=='task_id' &amp;&amp; list_gugr_projects.data.dir_gugr_project_tasks == 'desc'">#</th>
                              <th class="sorting" dmx-on:click="list_gugr_projects.set('sort_gugr_project_tasks','task_date_created');list_gugr_projects.set('dir_gugr_project_tasks',list_gugr_projects.data.dir_gugr_project_tasks == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="list_gugr_projects.data.sort_gugr_project_tasks=='task_date_created' &amp;&amp; list_gugr_projects.data.dir_gugr_project_tasks == 'asc'" dmx-class:sorting_desc="list_gugr_projects.data.sort_gugr_project_tasks=='task_date_created' &amp;&amp; list_gugr_projects.data.dir_gugr_project_tasks == 'desc'">{{trans.data.dateTime[lang.value]}}</th>
                              <th class="sorting" dmx-on:click="list_gugr_projects.set('sort_gugr_project_tasks','task_user_created');list_gugr_projects.set('dir_gugr_project_tasks',list_gugr_projects.data.dir_gugr_project_tasks == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="list_gugr_projects.data.sort_gugr_project_tasks=='task_user_created' &amp;&amp; list_gugr_projects.data.dir_gugr_project_tasks == 'asc'" dmx-class:sorting_desc="list_gugr_projects.data.sort_gugr_project_tasks=='task_user_created' &amp;&amp; list_gugr_projects.data.dir_gugr_project_tasks == 'desc'">{{trans.data.user[lang.value]}}</th>
                              <th class="sorting" dmx-on:click="list_gugr_projects.set('sort_gugr_project_tasks','task_user_concerned');list_gugr_projects.set('dir_gugr_project_tasks',list_gugr_projects.data.dir_gugr_project_tasks == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="list_gugr_projects.data.sort_gugr_project_tasks=='task_user_concerned' &amp;&amp; list_gugr_projects.data.dir_gugr_project_tasks == 'asc'" dmx-class:sorting_desc="list_gugr_projects.data.sort_gugr_project_tasks=='task_user_concerned' &amp;&amp; list_gugr_projects.data.dir_gugr_project_tasks == 'desc'">{{trans.data.attention[lang.value]}}</th>
                              <th class="sorting" dmx-on:click="list_gugr_projects.set('sort_gugr_project_tasks','task_notes');list_gugr_projects.set('dir_gugr_project_tasks',list_gugr_projects.data.dir_gugr_project_tasks == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="list_gugr_projects.data.sort_gugr_project_tasks=='task_notes' &amp;&amp; list_gugr_projects.data.dir_gugr_project_tasks == 'asc'" dmx-class:sorting_desc="list_gugr_projects.data.sort_gugr_project_tasks=='task_notes' &amp;&amp; list_gugr_projects.data.dir_gugr_project_tasks == 'desc'">{{trans.data.note[lang.value]}}</th>
                              <th class="sorting" dmx-on:click="list_gugr_projects.set('sort_gugr_project_tasks','task_status');list_gugr_projects.set('dir_gugr_project_tasks',list_gugr_projects.data.dir_gugr_project_tasks == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="list_gugr_projects.data.sort_gugr_project_tasks=='task_status' &amp;&amp; list_gugr_projects.data.dir_gugr_project_tasks == 'asc'" dmx-class:sorting_desc="list_gugr_projects.data.sort_gugr_project_tasks=='task_status' &amp;&amp; list_gugr_projects.data.dir_gugr_project_tasks == 'desc'">{{trans.data.status[lang.value]}}</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody is="dmx-repeat" dmx-generator="bs5table" id="tableRepeat8" dmx-state="list_gugr_projects" dmx-sort="sort_gugr_project_tasks" dmx-order="dir_gugr_project_tasks" dmx-bind:repeat="listGugrProjectTasksAll.data.list_project_tasks_paged.data">
                            <tr>
                              <td dmx-text="task_id"></td>
                              <td dmx-text="task_date_created" class="text-center"></td>
                              <td dmx-text="userCratedName" class="text-center"></td>
                              <td dmx-text="userConcernedName" class="text-center"></td>
                              <td dmx-text="task_description"></td>
                              <td dmx-text="task_status" dmx-class:text-success="task_status=='Completed'" dmx-class:text-danger="task_status=='Pending'" class="text-center"></td>
                              <td class="text-center">
                                <form id="updateTaskToComplete2" is="dmx-serverconnect-form" method="post" action="dmxConnect/api/gugr_projects/gugr_project_tasks/update_gugr_project_task_to_completed.php" dmx-on:success="notifies1.success('Success');listGugrUserProjectTasks.load({})">
                                  <input id="text16" name="task_status2" type="text" class="form-control visually-hidden" dmx-bind:value="'Completed'">
                                  <input id="text16" name="task_id2" type="text" class="form-control visually-hidden" dmx-bind:value="task_id">
                                  <input id="text16" class="visually-hidden" name="task_date_completed2" type="datetime-local" dmx-bind:value="dateTime.datetime">
                                  <button id="btn24" class="btn text-danger visually-hidden" type="submit">
                                    <i class="fas fa-thumbs-up"></i></button>
                                </form>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>


                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <button id="btn16" class="btn btn-primary w-25 me-3 fw-bold" data-bs-toggle="modal" data-bs-target="#createTask">{{trans.data.createNewTask[lang.value]}}
            </button>
            <button id="btn18" class="btn btn-primary w-25 me-3 fw-bold" data-bs-toggle="modal" data-bs-target="#taskStatsModal">{{trans.data.myTasks[lang.value]}}
            </button>
            <button id="btn25" class="btn w-25 bg-danger text-white h-auto fw-bold" data-bs-toggle="modal" data-bs-target="#taskStatsAllModal" dmx-hide="list_user_info.data.query_list_user_info.user_profile!=='gugr-admin'&amp;&amp;list_user_info.data.query_list_user_info.user_profile!=='gugr-cordo'" dmx-on:click="listGugrProjectTasksAll.load({})">{{trans.data.allTasks[lang.value]}}
            </button>
          </div>
          <div class="row mt-2 ps-2 pe-2 row-cols-12">


            <div class="col-xl-auto col-lg col-md col-xxl">
              <div class="mt-auto" style="max-width: 98% !important; width: 98% !important; overflow-x: overflow;">




                <div class="row y-scroll flex-nowrap scrollable row-cols-7" style="height: auto; overflow: scroll;">
                  <div class="border-danger scrollable ms-1 ps-2 w-25 col">
                    <div class="row rounded text-danger pt-2 pb-1">
                      <h5 dmx-text="trans.data.pending[lang.value]+': '+(list_order_items_shift_all.data.query.where(`order_item_group_type`, 'Ingredient', '!==')).count()" class="text-center fw-bold"></h5>
                    </div>
                    <div class="row scrollable">
                      <div dmx-repeat:repeat1="listGugrUserProjectTasks.data.list_project_tasks_all.where(`task_status`, 'Pending', '==')">
                        <main>
                          <div class="row justify-content-start" style="">
                            <div class="rounded-2 border-secondary execution-card shadow-none mt-1 mb-1 ms-3 me-2 pt-2 pb-3 ps-3 pe-3 bg-secondary col" dmx-animate-enter.delay:500.duration:500="pulse" dmx-class:main-group-product="order_item_group_type=='Main'" dmx-class:accessory-product="order_item_group_type=='Accessory'">

                              <div class="row">

                                <div class="col">



                                  <div class="row">
                                    <div class="col">
                                      <h6 class="fw-bold me-3 pt-1 pb-1 ps-1 pe-1 text-body"><i class="far fa-user fa-sm" style="margin-right: 5px;"> {{userCratedName}}</i></h6>

                                      <h6 class="fw-bold text-info"><i class="fas fa-user-alt fa-sm" style="margin-right: 5px;"> {{userConcernedName}}</i></h6>


                                    </div>

                                  </div>
                                  <div class="row">
                                    <div class="col">
                                      <h6 dmx-text="'#'+task_id+" class="fw-bold text-body"><i class="fas fa-clipboard-list fa-lg"></i></h6>
                                      <h6 dmx-text="task_date_created" class="fw-bold text-body"></h6>
                                      <h6 dmx-text="task_date_due" class="fw-bold text-body"></h6>
                                    </div>
                                  </div>


                                </div>
                                <div class="col rounded mt-1 me-1 pt-1 bg-light">
                                  <h5 dmx-text="product_name" class="text-center fw-bolder"></h5>
                                  <h6 dmx-text="task_description" class="fw-bold text-center bg-opacity-10 rounded ms-1 me-1 pt-1 pb-1 ps-1 pe-1 text-body">

                                  </h6>

                                </div>



                                <div>
                                  <div>

                                  </div>
                                </div>

                              </div>
                              <div class="row row-cols-12">
                                <div class="d-flex justify-content-between col">
                                  <form id="deletePersonalTask" is="dmx-serverconnect-form" method="post" action="dmxConnect/api/gugr_projects/gugr_project_tasks/delete_gugr_project_task.php" dmx-on:success="notifies1.success('Success');listGugrUserProjectTasks.load({});listGugrUserProjectTasksAll.load({})" onsubmit="return confirm ('Confirm Delete')">
                                    <input id="text12" name="task_id" type="text" class="form-control visually-hidden" dmx-bind:value="task_id">
                                    <input id="text12" class="visually-hidden" name="task_date_completed" type="datetime-local" dmx-bind:value="dateTime.datetime">
                                    <button id="btn17" class="btn rounded me-3 text-muted rounded-9" type="submit">
                                      <i class="far fa-trash-alt"></i></button>
                                  </form>
                                  <form id="updateTaskToActive" is="dmx-serverconnect-form" method="post" action="dmxConnect/api/gugr_projects/gugr_project_tasks/update_gugr_project_task_to_completed.php" dmx-on:success="notifies1.success('Success');listGugrUserProjectTasks.load({});listGugrUserProjectTasksAll.load({})">
                                    <input id="text91" name="task_status" type="text" class="form-control visually-hidden" dmx-bind:value="'Active'">
                                    <input id="text101" name="task_id" type="text" class="form-control visually-hidden" dmx-bind:value="task_id">
                                    <input id="text111" class="visually-hidden" name="task_date_completed" type="datetime-local" dmx-bind:value="dateTime.datetime">
                                    <button id="btn141" class="btn text-danger bg-opacity-10 rounded" type="submit">
                                      <i class="fas fa-thumbs-up"></i></button>
                                  </form>

                                </div>
                              </div>
                            </div>

                          </div>

                        </main>
                      </div>
                    </div>




                  </div>
                  <div class="border-danger scrollable ms-1 ps-2 w-25 col">
                    <div class="row rounded text-danger pt-2 pb-1">
                      <h5 dmx-text="trans.data.Active[lang.value]+': '+(list_order_items_shift_all.data.query.where(`order_item_group_type`, 'Ingredient', '!==')).count()" class="text-center fw-bold"></h5>
                    </div>
                    <div class="row scrollable">
                      <div dmx-repeat:repeat12="listGugrUserProjectTasks.data.list_project_tasks_all.where(`task_status`, 'Active', '==')">
                        <main>
                          <div class="row justify-content-start" style="">
                            <div class="col rounded-2 border-secondary execution-card shadow-none mt-1 mb-1 ms-3 me-2 pt-2 pb-3 ps-3 pe-3 bg-secondary" dmx-animate-enter.delay:500.duration:500="pulse" dmx-class:main-group-product="order_item_group_type=='Main'" dmx-class:accessory-product="order_item_group_type=='Accessory'">

                              <div class="row">

                                <div class="col">



                                  <div class="row">
                                    <div class="col">
                                      <h6 class="fw-bold me-3 pt-1 pb-1 ps-1 pe-1 text-body"><i class="far fa-user fa-sm" style="margin-right: 5px;"> {{userCratedName}}</i></h6>

                                      <h6 class="fw-bold text-info"><i class="fas fa-user-alt fa-sm" style="margin-right: 5px;"> {{userConcernedName}}</i></h6>


                                    </div>

                                  </div>
                                  <div class="row">
                                    <div class="col">
                                      <h6 dmx-text="'#'+task_id+" class="fw-bold text-body"><i class="fas fa-clipboard-list fa-lg"></i></h6>
                                      <h6 dmx-text="task_date_created" class="fw-bold text-body"></h6>
                                      <h6 dmx-text="task_date_due" class="fw-bold text-body"></h6>
                                    </div>
                                  </div>


                                </div>
                                <div class="col rounded mt-1 me-1 pt-1 bg-light">
                                  <h5 dmx-text="product_name" class="text-center fw-bolder"></h5>
                                  <h6 dmx-text="task_description" class="fw-bold text-center bg-opacity-10 rounded ms-1 me-1 pt-1 pb-1 ps-1 pe-1 text-body">

                                  </h6>

                                </div>



                                <div>
                                  <div>

                                  </div>
                                </div>

                              </div>
                              <div class="row row-cols-12">
                                <div class="d-flex justify-content-between col">
                                  <form id="deletePersonalTask1" is="dmx-serverconnect-form" method="post" action="dmxConnect/api/gugr_projects/gugr_project_tasks/delete_gugr_project_task.php" dmx-on:success="notifies1.success('Success');listGugrUserProjectTasks.load({});listGugrUserProjectTasksAll.load({})" onsubmit="return confirm ('Confirm Delete')">
                                    <input id="text13" name="task_id" type="text" class="form-control visually-hidden" dmx-bind:value="task_id">
                                    <input id="text13" class="visually-hidden" name="task_date_completed" type="datetime-local" dmx-bind:value="dateTime.datetime">
                                    <button id="btn19" class="btn rounded me-3 text-muted rounded-9" type="submit">
                                      <i class="far fa-trash-alt"></i></button>
                                  </form>
                                  <form id="updateTaskToActive1" is="dmx-serverconnect-form" method="post" action="dmxConnect/api/gugr_projects/gugr_project_tasks/update_gugr_project_task_to_completed.php" dmx-on:success="notifies1.success('Success');listGugrUserProjectTasks.load({});listGugrUserProjectTasksAll.load({})">
                                    <input id="text13" name="task_status" type="text" class="form-control visually-hidden" dmx-bind:value="'Completed'">
                                    <input id="text13" name="task_id" type="text" class="form-control visually-hidden" dmx-bind:value="task_id">
                                    <input id="text13" class="visually-hidden" name="task_date_completed" type="datetime-local" dmx-bind:value="dateTime.datetime">
                                    <button id="btn19" class="btn text-danger bg-opacity-10 rounded" type="submit">
                                      <i class="fas fa-thumbs-up"></i></button>
                                  </form>

                                </div>
                              </div>
                            </div>

                          </div>

                        </main>
                      </div>
                    </div>




                  </div>
                  <div class="border-danger scrollable ms-1 ps-2 w-25 col">
                    <div class="row rounded text-danger pt-2 pb-1">
                      <h5 dmx-text="trans.data.Completed[lang.value]+': '+(list_order_items_shift_all.data.query.where(`order_item_group_type`, 'Ingredient', '!==')).count()" class="text-center fw-bold"></h5>
                    </div>
                    <div class="row scrollable">
                      <div dmx-repeat:repeat123="listGugrUserProjectTasks.data.list_project_tasks_all.where(`task_status`, 'Completed', '==')">
                        <main>
                          <div class="row justify-content-start" style="">
                            <div class="col rounded-2 border-secondary execution-card shadow-none mt-1 mb-1 ms-3 me-2 pt-2 pb-3 ps-3 pe-3 bg-secondary" dmx-animate-enter.delay:500.duration:500="pulse" dmx-class:main-group-product="order_item_group_type=='Main'" dmx-class:accessory-product="order_item_group_type=='Accessory'">

                              <div class="row">

                                <div class="col">



                                  <div class="row">
                                    <div class="col">
                                      <h6 class="fw-bold me-3 pt-1 pb-1 ps-1 pe-1 text-body"><i class="far fa-user fa-sm" style="margin-right: 5px;"> {{userCratedName}}</i></h6>

                                      <h6 class="fw-bold text-info"><i class="fas fa-user-alt fa-sm" style="margin-right: 5px;"> {{userConcernedName}}</i></h6>


                                    </div>

                                  </div>
                                  <div class="row">
                                    <div class="col">
                                      <h6 dmx-text="'#'+task_id+" class="fw-bold text-body"><i class="fas fa-clipboard-list fa-lg"></i></h6>
                                      <h6 dmx-text="task_date_created" class="fw-bold text-body"></h6>
                                      <h6 dmx-text="task_date_due" class="fw-bold text-body"></h6>
                                    </div>
                                  </div>


                                </div>
                                <div class="col rounded mt-1 me-1 pt-1 bg-light">
                                  <h5 dmx-text="product_name" class="text-center fw-bolder"></h5>
                                  <h6 dmx-text="task_description" class="fw-bold text-center bg-opacity-10 rounded ms-1 me-1 pt-1 pb-1 ps-1 pe-1 text-body">

                                  </h6>

                                </div>



                                <div>
                                  <div>

                                  </div>
                                </div>

                              </div>
                              <div class="row row-cols-12">
                                <div class="d-flex justify-content-between col">
                                  <form id="deletePersonalTask2" is="dmx-serverconnect-form" method="post" action="dmxConnect/api/gugr_projects/gugr_project_tasks/delete_gugr_project_task.php" dmx-on:success="notifies1.success('Success');listGugrUserProjectTasks.load({});listGugrUserProjectTasksAll.load({})" onsubmit="return confirm ('Confirm Delete')">
                                    <input id="text14" name="task_id" type="text" class="form-control visually-hidden" dmx-bind:value="task_id">
                                    <input id="text14" class="visually-hidden" name="task_date_completed" type="datetime-local" dmx-bind:value="dateTime.datetime">
                                    <button id="btn20" class="btn rounded me-3 text-muted rounded-9" type="submit">
                                      <i class="far fa-trash-alt"></i></button>
                                  </form>
                                  <form id="updateTaskToActive2" is="dmx-serverconnect-form" method="post" action="dmxConnect/api/gugr_projects/gugr_project_tasks/update_gugr_project_task_to_completed.php" dmx-on:success="notifies1.success('Success');listGugrUserProjectTasks.load({});listGugrUserProjectTasksAll.load({})">
                                    <input id="text14" name="task_status" type="text" class="form-control visually-hidden" dmx-bind:value="'Validated'">
                                    <input id="text14" name="task_id" type="text" class="form-control visually-hidden" dmx-bind:value="task_id">
                                    <input id="text14" class="visually-hidden" name="task_date_completed" type="datetime-local" dmx-bind:value="dateTime.datetime">
                                    <button id="btn20" class="btn text-danger bg-opacity-10 rounded" type="submit">
                                      <i class="fas fa-thumbs-up"></i></button>
                                  </form>

                                </div>
                              </div>
                            </div>

                          </div>

                        </main>
                      </div>
                    </div>




                  </div>





                </div>
              </div>


            </div>
            <div class="col-lg d-flex visually-hidden">
              <div class="row"></div>
              <h2>{{trans.data.overview[lang.value]}}</h2>
              <h5>{{trans.data.Active[lang.value]}}</h5>

              <div class="d-block">
                <h4 dmx-text="listGugrProjects.data.query_stats[0].Active+'  '"></h4>
              </div>
              <div class="d-block">
                <h4 dmx-text="listGugrProjects.data.query_stats[0].Active+'  '"></h4>
              </div>
              <div class="d-block">
                <h4 dmx-text="listGugrProjects.data.query_stats[0].Active+'  '"></h4>
              </div>
            </div>

          </div>





        </div>



      </div>

    </div>
  </main>
  <main class="mt-4">
    <div class="modal readitem" id="readItemModal" is="dmx-bs5-modal" tabindex="-1" style="" nocloseonclick="true">
      <div class="modal-dialog modal-xl modal-fullscreen-xxl-down modal-dialog-scrollable" role="document" style="margin: 0px !important; width: 100% !important; height: 99% !important; max-width: 100% !important; max-height: 99% !important;">
        <div class="modal-content" style="max-height: 100% !important; height: 100% !important;">
          <div class="modal-header border-0">
            <div class="d-block me-1">

              <h5 dmx-text="trans.data.query[lang.value]+' : #'+readGuGrProject.data.query_read_gugr_project.project_code" class="fw-bold pt-1 pb-1 ps-2 pe-2 rounded-pill bg-secondary bg-opacity-75"></h5>
            </div>

            <div class="d-block">
              <h5 dmx-text="trans.data.getValueOrKey(readGuGrProject.data.query_read_gugr_project.project_status)[lang.value]" style="padding: 4px 10px 4px 10px;" dmx-class:red-state="readGuGrProject.data.query_read_gugr_project.project_status=='Pending'" dmx-class:yellow-state="readGuGrProject.data.query_read_gugr_project.project_status=='Active'" dmx-class:green-state="readGuGrProject.data.query_read_gugr_project.project_status=='Completed'" class="fw-bold rounded-pill"></h5>
            </div>
            <div class="d-block">
              <h5 dmx-text="updateProjectAssignment.selectUserAssign1.selectedText" style="padding: 10px;"></h5>
            </div><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">


            <div class="row">
              <div class="col">
                <ul class="nav nav-tabs nav-fill" id="navTabs2_tabs" role="tablist">

                  <li class="nav-item">
                    <a class="nav-link active" id="navTabs2_1_tab1" data-bs-toggle="tab" href="#" data-bs-target="#navTabs2_4" role="tab" aria-controls="navTabs1_1" aria-selected="true"><i class="fas fa-tasks" style="margin-right: 5px;"></i>
                      {{trans.data.assignment[lang.value]}}</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="navTabs2_2_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs2_2" role="tab" aria-controls="navTabs1_2" aria-selected="false"><i class="far fa-file"></i>
                      {{trans.data.files[lang.value]}}</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="navTabs2_3_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs2_3" role="tab" aria-controls="navTabs1_3" aria-selected="false">{{trans.data.treatment[lang.value]}}<i class="far fa-comment"></i></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="navTabs2_1_tab" data-bs-toggle="tab" href="#" data-bs-target="#navTabs2_1" role="tab" aria-controls="navTabs1_1" aria-selected="true"><i class="fas fa-info" style="margin-right: 5px;"></i>
                      {{trans.data.info[lang.value]}}</a>
                  </li>
                </ul>
                <div class="tab-content" id="navTabs2_content">

                  <div class="tab-pane fade mt-2 show active" id="navTabs2_4" role="tabpanel">
                    <div class="row">
                      <div class="col-xl-4 text-sm-center text-center text-md-center rounded rounded-1 border-light col-12 col-md-5 col-lg-5 mt-2 pt-3 pb-2 ps-3 pe-3" dmx-show="list_user_info.data.query_list_user_info.user_profile=='gugr-cordo'">
                        <div class="row">
                          <div class="col pt-3 ps-3 pe-3 border rounded border-secondary bg-light">

                            <h3 class="text-start mb-2"><i class="far fa-plus-square" style="margin-right: 5px;"></i>{{trans.data.assignment[lang.value]}}</h3>
                            <form is="dmx-serverconnect-form" id="createGugrStep" method="post" action="dmxConnect/api/gugr_projects/gugr_steps/create_gugr_step.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="readGuGrProject.data.query_read_gugr_project" dmx-on:success="readGuGrProject.load({project_id: readGuGrProject.data.query_read_gugr_project.project_id});createGugrStep.reset(); listGugrProjects.load({gugr_project_filter: gugrProjectFilter.value, gugr_project_status: gugrProjectStatusFilter.value, offset: list_gugr_projects.data.offset_gugr_projects, limit: gugrProjectLimit.value});listGugrProjectSteps.load({project_id: readGuGrProject.data.query_read_gugr_project.project_id});notifies1.success('Success!')" dmx-on:error="notifies1.warning('Error!')">
                              <input id="stepProject" name="step_project" type="number" class="form-control visually-hidden" dmx-bind:value="readGuGrProject.data.query_read_gugr_project.project_id">
                              <input id="stepUserCreated" name="step_user_created" type="number" class="form-control visually-hidden" dmx-bind:value="list_user_info.data.query_list_user_info.user_id">
                              <input id="stepStatus" name="step_status" class="form-control visually-hidden" dmx-bind:value="'Pending'">
                              <div class="form-group mb-3 row" id="stepUserAssigned">
                                <label for="stepStartDate" class="col-sm-2 col-form-label">{{trans.data.user[lang.value]}}</label>
                                <div class="col-sm-10 text-dark">
                                  <select id="selectUserAssign3" class="form-select" dmx-bind:options="load_users_1.data.query_list_users" required="" data-msg-required="!" optionvalue="user_id" name="step_users_concerned" dmx-bind:value="readGuGrProject.data.query_read_gugr_project.project_user_concerned" optiontext="user_username">
                                    <option selected="" value="#">----</option>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group mb-3 row">
                                <label for="stepDescription" class="col-sm-2 col-form-label">{{trans.data.object[lang.value]}}</label>
                                <div class="col-sm-10">
                                  <textarea type="text" class="form-control" id="stepDescription" name="step_description" aria-describedby="inp_project_description_help" style="height: 150px;"></textarea>
                                </div>
                              </div>

                              <div class="form-group mb-3 row">
                                <label for="stepStartDate" class="col-sm-2 col-form-label">{{trans.data.dateCreated[lang.value]}}</label>
                                <div class="col-sm-10">
                                  <input type="datetime-local" class="form-control" id="stepStartDate" name="step_start_date" aria-describedby="inp_project_date_due_help" dmx-bind:value="dateTime.datetime">
                                </div>
                              </div>
                              <div class="form-group mb-3 row">
                                <label for="inp_project_date_due_3" class="col-sm-2 col-form-label">{{trans.data.dateDue[lang.value]}}</label>
                                <div class="col-sm-10">
                                  <input type="datetime-local" class="form-control" id="inp_project_date_due_3" name="step_end_date" aria-describedby="inp_project_date_due_help" required="" data-msg-required="!">
                                </div>
                              </div>

                              <div class="form-group mb-3 row">
                                <div class="col-sm-10 text-end">
                                  <button type="submit" class="btn btn-primary bg-primary" dmx-bind:value="readGuGrProject.data.query_read_gugr_project.Save" dmx-bind:readonly="state.executing" dmx-hide="list_user_info.data.query_list_user_info.user_profile!=='gugr-cordo'">{{trans.data.update[lang.value]}} <span class="spinner-border spinner-border-sm" role="status" dmx-show="state.executing"></span></button>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>



                      </div>
                      <div class="scrollable col-xl-4 col-12 text-sm-center text-center text-md-center rounded rounded-1 border-light col-md-3 col-lg-3 mt-2 pt-3 pb-2 ps-3 pe-3 ">
                        <div class="row ">
                          <div dmx-repeat:repeat1="listGugrProjectSteps.data.query_list_project_steps">
                            <main>
                              <div class="row mb-2">
                                <div class="col bg-secondary pt-3 pb-3 ps-3 pe-3">

                                  <h5 class="text-start"><i class="fas fa-tasks fa-sm" style="margin-right: 5px;"></i>
                                    <i class="far fa-user" style="color: #34e034;" dmx-hide="step_users_concerned!==list_user_info.data.query_list_user_info.user_id"></i>
                                  </h5>
                                  <form is="dmx-serverconnect-form" id="updateGugrStepStandard" method="post" action="dmxConnect/api/gugr_projects/gugr_steps/update_gugr_step_standard.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="readGuGrProject.data.query_read_gugr_project" dmx-on:success="readGuGrProject.load({project_id: readGuGrProject.data.query_read_gugr_project.project_id});updateProjectStatus.reset();listGugrProjectSteps.load({project_id: readGuGrProject.data.query_read_gugr_project.project_id}); listGugrProjects.load({gugr_project_filter: gugrProjectFilter.value, gugr_project_status: gugrProjectStatusFilter.value, offset: list_gugr_projects.data.offset_gugr_projects, limit: gugrProjectLimit.value});notifies1.success('Success!')" dmx-on:error="notifies1.danger('Error!')">
                                    <input id="projectStepId" name="project_step_id" type="text" class="form-control visually-hidden" dmx-bind:value="project_step_id">
                                    <div class="form-group mb-3 row">
                                      <label for="stepStartDate" class="col-sm-2 col-form-label">{{trans.data.user[lang.value]}}</label>
                                      <div class="col-sm-10 text-dark">
                                        <select id="stepUserConcerned" class="form-select" dmx-bind:options="load_users_1.data.query_list_users" required="" data-msg-required="!" optionvalue="user_id" name="step_users_concerned" dmx-bind:value="step_users_concerned" optiontext="user_username" dmx-bind:readonly="list_user_info.data.query_list_user_info.user_profile!=='gugr-cordo'">
                                          <option selected="" value="#">----</option>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="form-group mb-3 row">

                                      <label for="inp_project_status1" class="col-sm-2 col-form-label col">{{trans.data.status[lang.value]}}</label>
                                      <div class="col-sm-10">
                                        <select id="select2" class="form-select" name="step_status" dmx-bind:value="step_status" dmx-bind:readonly="list_user_info.data.query_list_user_info.user_profile!=='gugr-cordo'">
                                          <option value="Pending">{{trans.data.pending[lang.value]}}</option>
                                          <option value="Active">{{trans.data.Active[lang.value]}}</option>
                                          <option value="Completed">{{trans.data.Completed[lang.value]}}</option>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="form-group mb-3 row">
                                      <label for="stepDescription1" class="col-sm-2 col-form-label">{{trans.data.object[lang.value]}}</label>
                                      <div class="col-sm-10">
                                        <textarea type="text" class="form-control" id="stepDescription1" name="step_description" aria-describedby="inp_project_description_help" style="height: 150px;" dmx-bind:value="step_description" dmx-bind:readonly="list_user_info.data.query_list_user_info.user_profile!=='gugr-cordo'"></textarea>
                                      </div>
                                    </div>
                                    <div class="form-group mb-3 row">
                                      <label for="inp_project_date_due_1" class="col-sm-2 col-form-label">{{trans.data.dateDue[lang.value]}}</label>
                                      <div class="col-sm-10">
                                        <input type="datetime-local" class="form-control" id="inp_project_date_due_1" name="step_end_date" aria-describedby="inp_project_date_due_help" dmx-bind:value="step_end_date" dmx-bind:readonly="list_user_info.data.query_list_user_info.user_profile!=='gugr-cordo'">
                                      </div>
                                    </div>
                                    <div class="form-group mb-3 row">
                                      <div class="col-sm-10 text-end">
                                        <button type="submit" class="btn bg-info btn-info" dmx-bind:value="readGuGrProject.data.query_read_gugr_project.Save" dmx-bind:readonly="state.executing" dmx-hide="(list_user_info.data.query_list_user_info.user_profile!=='gugr-cordo')">{{trans.data.update[lang.value]}}<span class="spinner-border spinner-border-sm" role="status" dmx-show="state.executing"></span></button>
                                      </div>
                                    </div>
                                  </form>
                                  <div class="row">
                                    <div class="col d-flex justify-content-end">

                                      <form id="updateStepActive" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/gugr_projects/gugr_steps/update_gugr_step_active.php" dmx-on:success="listGugrProjectSteps.load({project_id: readGuGrProject.data.query_read_gugr_project.project_id});notifies1.success('Success!')" dmx-on:error="notifies1.danger('Error!')">

                                        <input id="stepId1" name="project_step_id" type="number" class="form-control visually-hidden" dmx-bind:value="project_step_id">
                                        <input id="stepId3" name="step_status" type="number" class="form-control visually-hidden" dmx-bind:value="'Active'">
                                        <button id="btn10" class="btn text-danger" type="submit" dmx-hide="(list_user_info.data.query_list_user_info.user_id!==step_users_concerned || step_status=='Active')&amp;&amp;(list_user_info.data.query_list_user_info.user_profile!=='gugr-cordo')">
                                          <i class="far fa-eye fa-lg"></i></button>
                                      </form>
                                      <form id="updateStepCompleted" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/gugr_projects/gugr_steps/update_gugr_step_completed.php" dmx-on:success="listGugrProjectSteps.load({project_id: readGuGrProject.data.query_read_gugr_project.project_id});notifies1.success('Success!')" dmx-on:error="notifies1.danger('Error!')">

                                        <input id="stepId2" name="project_step_id" type="number" class="form-control visually-hidden" dmx-bind:value="project_step_id"><input id="stepId4" name="step_status" type="number" class="form-control visually-hidden" dmx-bind:value="'Completed'"><button id="btn12" class="btn text-success" type="submit" dmx-hide="list_user_info.data.query_list_user_info.user_id!==step_users_concerned||step_status=='Completed'">
                                          <i class="far fa-thumbs-up fa-lg"></i></button>
                                      </form>
                                      <form id="deleteGugrStep" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/gugr_projects/gugr_steps/delete_gugr_step.php" dmx-on:success="listGugrProjectSteps.load({project_id: readGuGrProject.data.query_read_gugr_project.project_id})" onsubmit="return confirm('Confirm Delete!');">

                                        <input id="deleteStepId" name="project_step_id" type="number" class="form-control visually-hidden" dmx-bind:value="project_step_id"><button id="btn7" class="btn text-body" type="submit" dmx-hide="list_user_info.data.query_list_user_info.user_profile!=='gugr-cordo'">
                                          <i class="far fa-trash-alt fa-lg"></i></button>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </main>
                          </div>


                        </div>



                      </div>
                      <div class="col-12 text-sm-center text-center text-md-center rounded rounded-1 border-light col-md-3 col-lg-3 col-xl-3 mt-2 pt-3 pb-2 ps-3 pe-3">
                        <div class="row visually-hidden">
                          <div class="col bg-secondary pt-3 ps-3 pe-3">
                            <h3 class="text-start"><i class="far fa-user" style="margin-right: 5px;"></i>{{trans.data.assignment[lang.value]}}</h3>
                            <form is="dmx-serverconnect-form" id="updateProjectAssignment1" method="post" action="dmxConnect/api/gugr_projects/gugr_projects/update_gugr_project_userConcerned.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="readGuGrProject.data.query_read_gugr_project" dmx-on:success="readGuGrProject.load({project_id: readGuGrProject.data.query_read_gugr_project.project_id});updateProjectStatus.reset();notifies1.success('Success!');  listGugrProjects.load({gugr_project_filter: gugrProjectFilter.value, gugr_project_status: gugrProjectStatusFilter.value, offset: list_gugr_projects.data.offset_gugr_projects, limit: gugrProjectLimit.value})" dmx-on:error="notifies1.danger('Error!')">
                              <input id="text7" name="project_id1" type="text" class="form-control visually-hidden" dmx-bind:value="readGuGrProject.data.query_read_gugr_project.project_id">
                              <div class="form-group mb-3 row">
                                <label for="stepStartDate" class="col-sm-2 col-form-label">{{trans.data.user[lang.value]}}</label>
                                <div class="col-sm-10 text-dark">
                                  <select id="selectUserAssign2" class="form-select" dmx-bind:options="load_users_1.data.query_list_users" required="" data-msg-required="!" optionvalue="user_id" name="project_user_concerned1" dmx-bind:value="readGuGrProject.data.query_read_gugr_project.project_user_concerned" optiontext="user_username">
                                    <option selected="" value="#">----</option>
                                  </select>
                                </div>
                              </div>


                              <div class="form-group mb-3 row">
                                <div class="col-sm-10 text-end">
                                  <button type="submit" class="btn bg-info btn-info" dmx-bind:value="readGuGrProject.data.query_read_gugr_project.Save" dmx-bind:readonly="state.executing">{{trans.data.update[lang.value]}} <span class="spinner-border spinner-border-sm" role="status" dmx-show="state.executing"></span></button>
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
                      <div class="col text-end"><button id="btn4" class="btn w-auto text-white bg-primary" dmx-on:click="" data-bs-toggle="collapse" data-bs-target="#uploadFileCollapse"><i class="fas fa-file-upload"></i>
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
                                <label for="fileUpload" class="col-sm-2 col-form-label col-lg-2">{{trans.data.object.lang.value]}}</label>
                                <div class="col-sm-10 offset-md-4 col-lg-5 offset-lg-1">
                                  <textarea id="projectFileProjectFile1" name="project_file_description" class="form-control"></textarea>
                                </div>
                              </div>
                              <div class="form-group mb-3 row">
                                <div class="offset-xxl-4 offset-sm-2 offset-md-4 offset-lg-3 text-end offset-xl-3 col-xl col-xl-5 col-lg-5 col-sm-10 col-md-9 col-xxl-4">
                                  <button id="submitProjectFile" class="btn btn-primary w-auto" type="submit"><i class="fas fa-check fa-sm"></i></button>
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
                                <th>{{trans.data.object[lang.value]}}</th>
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
                                <td>
                                  <form id="updateProjectFileDescription" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/gugr_projects/gugr_files/update_project_file_description.php" dmx-on:success="notifies1.success('Success!');listGugrProjectsFiles.load({project_id: readGuGrProject.data.query_read_gugr_project.project_id})" dmx-on:error="notifies1.danger('Error!')">
                                    <input id="ProjectFileID1" name="project_file_id" type="number" class="form-control visually-hidden" dmx-bind:value="project_file_id">
                                    <textarea id="ProjectFileDescription1" name="project_file_description" type="text" class="form-control" dmx-bind:value="project_file_description"></textarea>
                                    <button id="btn6" class="btn text-info" type="submit">
                                      <i class="fas fa-check"></i>
                                    </button>
                                  </form>
                                </td>
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
                    <div class="row row-cols-md-12">
                      <div class="col-12 col-md-4">
                        <div class="row justify-content-center">
                          <div class="col">
                            <h4>{{trans.data.messages[lang.value]}}</h4>
                            <div class="row">
                              <form id="createProjectNote" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/gugr_projects/gugr_notes/create_gugr_project_note.php" dmx-on:success="listGugrNotes.load({project_id: readGuGrProject.data.query_read_gugr_project.project_id});createProjectNote.reset();notifies1.success('Success!')">
                                <div class="form-group mb-3 row">
                                  <div class="rounded ms-3 pt-4 pb-3 ps-4 pe-4 col-sm-11 col-md-11 bg-secondary" style="">
                                    <h4>{{trans.data.leaveMessage[lang.value]}}</h4>
                                    <input id="projectNoteDateCreated" name="date_created" type="datetime-local" class="form-control visually-hidden" dmx-bind:value="dateTime.datetime"><input type="number" class="form-control visually-hidden" id="projectNoteProjectId" name="project_note_project_id" aria-describedby="input1_help" dmx-bind:value="readGuGrProject.data.query_read_gugr_project.project_id">
                                    <input type="number" class="form-control visually-hidden" id="projectNoteUserCreated" name="project_note_user_created" aria-describedby="input1_help" dmx-bind:value="list_user_info.data.query_list_user_info.user_id">
                                    <textarea type="text" class="form-control" id="projectNoteNote" name="project_note" aria-describedby="input1_help" style="height: 150px;"></textarea>

                                    <div class="row justify-content-end me-0"><button id="btn9" class="btn mt-2 bg-primary text-white w-25" type="submit">
                                        <i class="far fa-paper-plane fa-lg"></i>
                                      </button></div>
                                  </div>
                                </div>
                              </form>
                            </div>

                          </div>

                        </div>

                      </div>
                      <div class="scrollable col-md-5">
                        <h5 class="text-start"><i class="fas fa-comments fa-lg" style="margin-right: 5px;"></i></h5>
                        <div dmx-repeat:repeatprojectnotes="listGugrNotes.data.query_list_project_notes">
                          <main>
                            <div class="row mb-2">
                              <div class="col bg-secondary ms-3 me-5 pt-3 pb-3 ps-3 pe-3 rounded-3">
                                <div class="row">
                                  <div class="col d-flex">
                                    <h6 class="fw-bold me-2" dmx-class:green-state="project_note_user_created==list_user_info.data.query_list_user_info.user_id">
                                      <i class="far fa-user fa-sm" style="margin-right: 5px;"></i>{{user_username}}
                                    </h6>
                                    <h6 class="fw-bold">
                                      <i class="far fa-clock" style="margin-right: 5px;"></i>{{date_created}}
                                    </h6>
                                  </div>
                                </div>
                                <div class="row justify-content-end row-cols-12">

                                  <form is="dmx-serverconnect-form" id="updateProjectNote" method="post" action="dmxConnect/api/gugr_projects/gugr_notes/update_gugr_note.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="readGuGrProject.data.query_read_gugr_project" dmx-on:success="readGuGrProject.load({project_id: readGuGrProject.data.query_read_gugr_project.project_id});updateProjectStatus.reset();listGugrProjectSteps.load({project_id: readGuGrProject.data.query_read_gugr_project.project_id}); listGugrProjects.load({gugr_project_filter: gugrProjectFilter.value, gugr_project_status: gugrProjectStatusFilter.value, offset: list_gugr_projects.data.offset_gugr_projects, limit: gugrProjectLimit.value});notifies1.success('Success!');listGugrNotes.load({project_id: readGuGrProject.data.query_read_gugr_project.project_id})" dmx-on:error="notifies1.danger('Error!')">

                                    <input id="projectNoteProject1" name="project_note_id" type="text" class="form-control visually-hidden" dmx-bind:value="project_note_id">

                                    <div class="form-group mb-3 row">
                                      <div class="col-sm-10">
                                        <h5 dmx-text="project_note" class="fw-bold text-body">Fancy display heading</h5>
                                        <textarea type="text" class="form-control" id="projectNoteNote1" name="project_note" aria-describedby="inp_project_description_help" style="display: none; height: 150px; border: none; background: transparent;" dmx-bind:value="project_note"></textarea>
                                      </div>
                                    </div>
                                    <div class="form-group mb-3 row">
                                      <div class="col-sm-10 text-end visually-hidden">
                                        <button type="submit" class="btn bg-info btn-info" dmx-bind:value="readGuGrProject.data.query_read_gugr_project.Save" dmx-bind:readonly="state.executing">{{trans.data.update[lang.value]}}<span class="spinner-border spinner-border-sm" role="status" dmx-show="state.executing"></span></button>
                                      </div>
                                    </div>
                                  </form>


                                </div>
                                <div class="row justify-content-end row-cols-12 text-end">
                                  <form id="deleteGugrNote" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/gugr_projects/gugr_notes/delete_gugr_project_note.php" dmx-on:success="listGugrNotes.load({project_id: readGuGrProject.data.query_read_gugr_project.project_id})" onsubmit="return confirm('Confirm Delete!');">

                                    <input id="deleteNoteId" name="project_note_id" type="number" class="form-control visually-hidden" dmx-bind:value="project_note_id"><button id="btn8" class="btn text-body" type="submit" dmx-hide="project_note_user_created!==list_user_info.data.query_list_user_info.user_id">
                                      <i class="far fa-trash-alt"></i></button>
                                  </form>
                                </div>








                              </div>

                            </div>


                          </main>
                        </div>
                      </div>
                    </div>





                  </div>
                  <div class="tab-pane fade mt-2" id="navTabs2_1" role="tabpanel">
                    <div class="row">
                      <div class="col-xl-4 text-sm-center text-center text-md-center rounded rounded-1 border-light col-12 col-md-5 col-lg-5 mt-2 pt-3 pb-2 ps-3 pe-3">
                        <div class="row">
                          <div class="col pt-3 ps-3 pe-3 bg-light">

                            <h5 class="text-start fw-bold"><i class="far fa-file-alt" style="margin-right: 5px;"></i>{{trans.data.info[lang.value]}}</h5>
                            <div class="row rounded mb-3 ms-0 me-0 pt-4 pb-3 border-secondary bg-secondary">
                              <p class="text-start" dmx-text="readGuGrProject.data.query_read_gugr_project.project_code"></p>
                              <p class="text-start" dmx-text="trans.data.dateCreated[lang.value]+': '+readGuGrProject.data.query_read_gugr_project.project_date_created"></p>
                              <p class="text-start" dmx-text="trans.data.dateDue[lang.value]+': '+readGuGrProject.data.query_read_gugr_project.project_date_due"></p>
                            </div>
                            <form is="dmx-serverconnect-form" id="updateProjectReception" method="post" action="dmxConnect/api/gugr_projects/gugr_projects/update_gugr_project_reception.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="readGuGrProject.data.query_read_gugr_project" dmx-on:success="readGuGrProject.load({project_id: readGuGrProject.data.query_read_gugr_project.project_id}); listGugrProjects.load({gugr_project_filter: gugrProjectFilter.value, gugr_project_status: gugrProjectStatusFilter.value, offset: list_gugr_projects.data.offset_gugr_projects, limit: gugrProjectLimit.value}); listGugrProjects.load({gugr_project_filter: gugrProjectFilter.value, gugr_project_status: gugrProjectStatusFilter.value, offset: list_gugr_projects.data.offset_gugr_projects, limit: gugrProjectLimit.value})">
                              <input id="text2" name="project_id" type="text" class="form-control visually-hidden" dmx-bind:value="readGuGrProject.data.query_read_gugr_project.project_id">
                              <div class="form-group mb-3 row">

                                <label for="inp_project_code" class="col-sm-2 col-form-label col">{{trans.data.object[lang.value]}}</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="inp_project_code" name="project_code" dmx-bind:value="readGuGrProject.data.query_read_gugr_project.project_code" aria-describedby="inp_project_code_help" dmx-bind:readonly="(list_user_info.data.query_list_user_info.user_profile!=='gugr-reception')&amp;&amp;(list_user_info.data.query_list_user_info.user_profile!=='gugr-cordo')">
                                </div>
                              </div>
                              <div class="form-group mb-3 row">

                                <label for="inp_project_code1" class="col-sm-2 col-form-label col">{{trans.data.expeditor[lang.value]}}</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="inp_project_code1" name="project_notes" dmx-bind:value="readGuGrProject.data.query_read_gugr_project.project_notes" aria-describedby="inp_project_code_help" dmx-bind:readonly="(list_user_info.data.query_list_user_info.user_profile!=='gugr-reception')&amp;&amp;(list_user_info.data.query_list_user_info.user_profile!=='gugr-cordo')">
                                </div>
                              </div>
                              <div class="form-group mb-3 row">
                                <label for="inp_project_description" class="col-sm-2 col-form-label">{{trans.data.note[lang.value]}}</label>
                                <div class="col-sm-10">
                                  <textarea type="text" class="form-control" id="inp_project_description" name="project_description" dmx-bind:value="readGuGrProject.data.query_read_gugr_project.project_description" aria-describedby="inp_project_description_help" style="height: 150px;" dmx-bind:readonly="(list_user_info.data.query_list_user_info.user_profile!=='gugr-reception')&amp;&amp;(list_user_info.data.query_list_user_info.user_profile!=='gugr-cordo')"></textarea>
                                </div>
                              </div>
                              <div class="form-group mb-3 row" dmx-hide="(list_user_info.data.query_list_user_info.user_profile!=='gugr-cordo')">
                                <label for="inp_project_date_due_2" class="col-sm-2 col-form-label">{{trans.data.dateDue[lang.value]}}</label>
                                <div class="col-sm-10">
                                  <input type="datetime-local" class="form-control" id="inp_project_date_due_2" name="project_date_due" dmx-bind:value="readGuGrProject.data.query_read_gugr_project.project_date_due" aria-describedby="inp_project_date_due_help">
                                </div>
                              </div>
                              <div class="form-group mb-3 row">
                                <div class="col-sm-10 text-end" dmx-hide="list_user_info.data.query_list_user_info.user_profile!=='gugr-reception'&amp;&amp;list_user_info.data.query_list_user_info.user_profile!=='gugr-cordo'">
                                  <button type="submit" class="btn btn-primary text-white bg-primary" dmx-bind:value="readGuGrProject.data.query_read_gugr_project.Save" dmx-bind:readonly="state.executing">{{trans.data.update[lang.value]}} <span class="spinner-border spinner-border-sm" role="status" dmx-show="state.executing"></span></button>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>



                      </div>
                      <div class="col-xl-4 col-12 text-sm-center text-center text-md-center rounded rounded-1 border-light col-md-3 col-lg-3 mt-2 pt-3 pb-2 ps-3 pe-3">
                        <div class="row">
                          <div class="col bg-secondary pt-3 ps-3 pe-3 rounded rounded-3" dmx-show="list_user_info.data.query_list_user_info.user_profile=='gugr-cordo'">
                            <h5 class="text-start fw-bold"><i class="fas fa-hourglass-half" style="margin-right: 5px;"></i>{{trans.data.status[lang.value]}}</h5>
                            <form is="dmx-serverconnect-form" id="updateProjectStatus" method="post" action="dmxConnect/api/gugr_projects/gugr_projects/update_gugr_project_status.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="readGuGrProject.data.query_read_gugr_project" dmx-on:success="readGuGrProject.load({project_id: readGuGrProject.data.query_read_gugr_project.project_id});updateProjectStatus.reset(); listGugrProjects.load({gugr_project_filter: gugrProjectFilter.value, gugr_project_status: gugrProjectStatusFilter.value, offset: list_gugr_projects.data.offset_gugr_projects, limit: gugrProjectLimit.value});notifies1.success('Success!')" dmx-on:error="notifies1.danger('Error!')">
                              <input id="text3" name="project_id" type="text" class="form-control visually-hidden" dmx-bind:value="readGuGrProject.data.query_read_gugr_project.project_id">
                              <div class="form-group mb-3 row">

                                <label for="inp_project_status1" class="col-sm-2 col-form-label col">{{trans.data.status[lang.value]}}</label>
                                <div class="col-sm-10">
                                  <select id="select1" class="form-select" name="project_status" dmx-bind:value="readGuGrProject.data.query_read_gugr_project.project_status">
                                    <option value="Pending">{{trans.data.pending[lang.value]}}</option>
                                    <option value="Active">{{trans.data.Active[lang.value]}}</option>
                                    <option value="Completed">{{trans.data.Completed[lang.value]}}</option>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group mb-3 row">
                                <div class="col-sm-10 text-end">
                                  <button type="submit" class="btn btn-primary text-white bg-primary" dmx-bind:value="readGuGrProject.data.query_read_gugr_project.Save" dmx-bind:readonly="state.executing">{{trans.data.update[lang.value]}}<span class="spinner-border spinner-border-sm" role="status" dmx-show="state.executing"></span></button>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>



                      </div>
                      <div class="col-12 text-sm-center text-center text-md-center rounded rounded-1 border-light col-md-3 col-lg-3 col-xl-3 mt-2 pt-3 pb-2 ps-3 pe-3">
                        <div class="row">
                        </div>



                      </div>
                    </div>
                  </div>

                </div>

              </div>
            </div>
          </div>
          <div class="modal-footer border-0">
            <form id="deleteProjectForm2" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/gugr_projects/gugr_projects/delete_gugr_project.php" dmx-on:success="notifies1.success('Success');readItemModal.hide(); listGugrProjects.load({gugr_project_filter: gugrProjectFilter.value, gugr_project_status: gugrProjectStatusFilter.value, offset: list_gugr_projects.data.offset_gugr_projects, limit: gugrProjectLimit.value})" onsubmit=" return confirm('CONFIRM DELETE?');" dmx-on:error="notifies1.danger('Error!')">
              <input id="text8" name="project_id" class="form-control visually-hidden" dmx-bind:value="readGuGrProject.data.query_read_gugr_project.project_id" type="number">

              <button id="btn11" class="btn text-secondary" type="submit">
                <i class="far fa-trash-alt fa-lg"></i>
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="modal readitem" id="readItemModalProject" is="dmx-bs5-modal" tabindex="-1" style="" nocloseonclick="true">
      <div class="modal-dialog modal-xl modal-fullscreen-xxl-down modal-dialog-scrollable" role="document" style="margin: 0px !important; width: 100% !important; height: 99% !important; max-width: 100% !important; max-height: 99% !important;">
        <div class="modal-content" style="max-height: 100% !important; height: 100% !important;">
          <div class="modal-header border-0">
            <div class="d-block me-2">

              <h5 dmx-text="trans.data.project[lang.value]+' : #'+readGuGrProject.data.query_read_gugr_project.project_id" class="fw-bold bg-body"></h5>
            </div>
            <div class="d-block me-2">

              <h5 dmx-text="readGuGrProject.data.query_read_gugr_project.project_code" class="fw-bold bg-secondary  pt-1 pb-1 ps-2 pe-2 rounded-pill"></h5>
            </div>

            <div class="d-block">
              <h5 dmx-text="trans.data.getValueOrKey(readGuGrProject.data.query_read_gugr_project.project_status)[lang.value]" style="padding: 4px 10px 4px 10px;" dmx-class:red-state="readGuGrProject.data.query_read_gugr_project.project_status=='Pending'" dmx-class:yellow-state="readGuGrProject.data.query_read_gugr_project.project_status=='Active'" dmx-class:green-state="readGuGrProject.data.query_read_gugr_project.project_status=='Completed'" class="fw-bold"></h5>
            </div>
            <div class="d-block">
              <h5 dmx-text="updateProjectAssignment.selectUserAssign1.selectedText" style="padding: 10px;"></h5>
            </div><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">


            <div class="row">
              <div class="col">
                <ul class="nav nav-tabs nav-fill" id="navTabs2_tabs1" role="tablist">

                  <li class="nav-item">
                    <a class="nav-link active" id="navTabs2_1_tab2" data-bs-toggle="tab" href="#" data-bs-target="#navTabs2_51" role="tab" aria-controls="navTabs1_1" aria-selected="true"><i class="fas fa-tasks" style="margin-right: 5px;"></i>
                      {{trans.data.tasks[lang.value]}}</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="navTabs2_2_tab1" data-bs-toggle="tab" href="#" data-bs-target="#navTabs2_52" role="tab" aria-controls="navTabs1_2" aria-selected="false"><i class="far fa-file"></i>
                      {{trans.data.files[lang.value]}}</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="navTabs2_3_tab1" data-bs-toggle="tab" href="#" data-bs-target="#navTabs2_53" role="tab" aria-controls="navTabs1_3" aria-selected="false">{{trans.data.treatment[lang.value]}}<i class="far fa-comment"></i></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="navTabs2_1_tab2" data-bs-toggle="tab" href="#" data-bs-target="#navTabs2_5" role="tab" aria-controls="navTabs1_1" aria-selected="true"><i class="fas fa-info" style="margin-right: 5px;"></i>
                      {{trans.data.info[lang.value]}}</a>
                  </li>
                </ul>
                <div class="tab-content" id="navTabs2_content1">

                  <div class="tab-pane fade mt-3 scrollable show active" id="navTabs2_51" role="tabpanel">



                    <div class="row">
                      <button id="btn231" class="btn btn-primary w-25 me-3" data-bs-toggle="modal" data-bs-target="#createTask1">{{trans.data.createNewTask[lang.value]}}</button>
                      <button id="btn232" class="btn btn-primary w-25" data-bs-toggle="modal" data-bs-target="#taskStatsModalProject" dmx-on:click="listGugrUserProjectTasksProject.load({project_id: readGuGrProject.data.query_read_gugr_project.project_id})">{{trans.data.allTasks[lang.value]}}
                      </button>
                    </div>
                    <div class="row mt-2 ps-2 pe-2 row-cols-12">


                      <div class="col-xl-auto col-lg col-md col-xxl">
                        <div class="mt-auto" style="max-width: 98% !important; width: 98% !important; overflow-x: overflow;">




                          <div class="row y-scroll flex-nowrap scrollable row-cols-7" style="height: auto; overflow: scroll;">
                            <div class="border-danger scrollable ms-1 ps-2 w-25 col">
                              <div class="row rounded text-danger pt-2 pb-1">
                                <h5 dmx-text="trans.data.pending[lang.value]+': '+(list_order_items_shift_all.data.query.where(`order_item_group_type`, 'Ingredient', '!==')).count()" class="text-center fw-bold"></h5>
                              </div>
                              <div class="row scrollable">
                                <div dmx-repeat:repeat1="listGugrUserProjectTasksAll.data.list_project_tasks_all.where(`task_status`, 'Pending', '==')">
                                  <main>
                                    <div class="row justify-content-start" style="">
                                      <div class="rounded-2 border-secondary execution-card shadow-none mt-1 mb-1 ms-3 me-2 pt-2 pb-3 ps-3 pe-3 bg-secondary col" dmx-animate-enter.delay:500.duration:500="pulse" dmx-class:main-group-product="order_item_group_type=='Main'" dmx-class:accessory-product="order_item_group_type=='Accessory'">

                                        <div class="row">

                                          <div class="col">



                                            <div class="row">
                                              <div class="col">
                                                <h6 class="fw-bold me-3 pt-1 pb-1 ps-1 pe-1 text-body"><i class="far fa-user fa-sm" style="margin-right: 5px;"> {{userCratedName}}</i></h6>

                                                <h6 class="fw-bold text-info"><i class="fas fa-user-alt fa-sm" style="margin-right: 5px;"> {{userConcernedName}}</i></h6>


                                              </div>

                                            </div>
                                            <div class="row">
                                              <div class="col">
                                                <h6 dmx-text="'#'+task_id+" class="fw-bold text-body"><i class="fas fa-clipboard-list fa-lg"></i></h6>
                                                <h6 dmx-text="task_date_created" class="fw-bold text-body"></h6>
                                                <h6 dmx-text="task_date_due" class="fw-bold text-body"></h6>
                                              </div>
                                            </div>


                                          </div>
                                          <div class="col rounded mt-1 me-1 pt-1 bg-light">
                                            <h5 dmx-text="product_name" class="text-center fw-bolder"></h5>
                                            <h6 dmx-text="task_description" class="fw-bold text-center bg-opacity-10 rounded ms-1 me-1 pt-1 pb-1 ps-1 pe-1 text-body">

                                            </h6>

                                          </div>



                                          <div>
                                            <div>

                                            </div>
                                          </div>

                                        </div>
                                        <div class="row row-cols-12">
                                          <div class="d-flex justify-content-between col">
                                            <form id="deletePersonalTask3" is="dmx-serverconnect-form" method="post" action="dmxConnect/api/gugr_projects/gugr_project_tasks/delete_gugr_project_task.php" dmx-on:success="notifies1.success('Success');listGugrUserProjectTasks.load({});listGugrUserProjectTasksAll.load({})" onsubmit="return confirm ('Confirm Delete')">
                                              <input id="text15" name="task_id" type="text" class="form-control visually-hidden" dmx-bind:value="task_id">
                                              <input id="text15" class="visually-hidden" name="task_date_completed" type="datetime-local" dmx-bind:value="dateTime.datetime">
                                              <button id="btn23" class="btn rounded me-3 text-muted rounded-9" type="submit">
                                                <i class="far fa-trash-alt"></i></button>
                                            </form>
                                            <form id="updateTaskToActive3" is="dmx-serverconnect-form" method="post" action="dmxConnect/api/gugr_projects/gugr_project_tasks/update_gugr_project_task_to_completed.php" dmx-on:success="notifies1.success('Success');listGugrUserProjectTasks.load({});listGugrUserProjectTasksAll.load({})">
                                              <input id="text151" name="task_status" type="text" class="form-control visually-hidden" dmx-bind:value="'Active'">
                                              <input id="text152" name="task_id" type="text" class="form-control visually-hidden" dmx-bind:value="task_id">
                                              <input id="text153" class="visually-hidden" name="task_date_completed" type="datetime-local" dmx-bind:value="dateTime.datetime">
                                              <button id="btn23" class="btn text-danger bg-opacity-10 rounded" type="submit">
                                                <i class="fas fa-thumbs-up"></i></button>
                                            </form>

                                          </div>
                                        </div>
                                      </div>

                                    </div>

                                  </main>
                                </div>
                              </div>




                            </div>
                            <div class="border-danger scrollable ms-1 ps-2 w-25 col">
                              <div class="row rounded text-danger pt-2 pb-1">
                                <h5 dmx-text="trans.data.Active[lang.value]+': '+(list_order_items_shift_all.data.query.where(`order_item_group_type`, 'Ingredient', '!==')).count()" class="text-center fw-bold"></h5>
                              </div>
                              <div class="row scrollable">
                                <div dmx-repeat:repeat1="listGugrUserProjectTasksAll.data.list_project_tasks_all.where(`task_status`, 'Active', '==')">
                                  <main>
                                    <div class="row justify-content-start" style="">
                                      <div class="col rounded-2 border-secondary execution-card shadow-none mt-1 mb-1 ms-3 me-2 pt-2 pb-3 ps-3 pe-3 bg-secondary" dmx-animate-enter.delay:500.duration:500="pulse" dmx-class:main-group-product="order_item_group_type=='Main'" dmx-class:accessory-product="order_item_group_type=='Accessory'">

                                        <div class="row">

                                          <div class="col">



                                            <div class="row">
                                              <div class="col">
                                                <h6 class="fw-bold me-3 pt-1 pb-1 ps-1 pe-1 text-body"><i class="far fa-user fa-sm" style="margin-right: 5px;"> {{userCratedName}}</i></h6>

                                                <h6 class="fw-bold text-info"><i class="fas fa-user-alt fa-sm" style="margin-right: 5px;"> {{userConcernedName}}</i></h6>


                                              </div>

                                            </div>
                                            <div class="row">
                                              <div class="col">
                                                <h6 dmx-text="'#'+task_id+" class="fw-bold text-body"><i class="fas fa-clipboard-list fa-lg"></i></h6>
                                                <h6 dmx-text="task_date_created" class="fw-bold text-body"></h6>
                                                <h6 dmx-text="task_date_due" class="fw-bold text-body"></h6>
                                              </div>
                                            </div>


                                          </div>
                                          <div class="col rounded mt-1 me-1 pt-1 bg-light">
                                            <h5 dmx-text="product_name" class="text-center fw-bolder"></h5>
                                            <h6 dmx-text="task_description" class="fw-bold text-center bg-opacity-10 rounded ms-1 me-1 pt-1 pb-1 ps-1 pe-1 text-body">

                                            </h6>

                                          </div>



                                          <div>
                                            <div>

                                            </div>
                                          </div>

                                        </div>
                                        <div class="row row-cols-12">
                                          <div class="d-flex justify-content-between col">
                                            <form id="deletePersonalTask3" is="dmx-serverconnect-form" method="post" action="dmxConnect/api/gugr_projects/gugr_project_tasks/delete_gugr_project_task.php" dmx-on:success="notifies1.success('Success');listGugrUserProjectTasks.load({});listGugrUserProjectTasksAll.load({})" onsubmit="return confirm ('Confirm Delete')">
                                              <input id="text15" name="task_id" type="text" class="form-control visually-hidden" dmx-bind:value="task_id">
                                              <input id="text15" class="visually-hidden" name="task_date_completed" type="datetime-local" dmx-bind:value="dateTime.datetime">
                                              <button id="btn23" class="btn rounded me-3 text-muted rounded-9" type="submit">
                                                <i class="far fa-trash-alt"></i></button>
                                            </form>
                                            <form id="updateTaskToActive3" is="dmx-serverconnect-form" method="post" action="dmxConnect/api/gugr_projects/gugr_project_tasks/update_gugr_project_task_to_completed.php" dmx-on:success="notifies1.success('Success');listGugrUserProjectTasks.load({});listGugrUserProjectTasksAll.load({})">
                                              <input id="text15" name="task_status" type="text" class="form-control visually-hidden" dmx-bind:value="'Completed'">
                                              <input id="text15" name="task_id" type="text" class="form-control visually-hidden" dmx-bind:value="task_id">
                                              <input id="text15" class="visually-hidden" name="task_date_completed" type="datetime-local" dmx-bind:value="dateTime.datetime">
                                              <button id="btn23" class="btn text-danger bg-opacity-10 rounded" type="submit">
                                                <i class="fas fa-thumbs-up"></i></button>
                                            </form>

                                          </div>
                                        </div>
                                      </div>

                                    </div>

                                  </main>
                                </div>
                              </div>




                            </div>
                            <div class="border-danger scrollable ms-1 ps-2 w-25 col">
                              <div class="row rounded text-danger pt-2 pb-1">
                                <h5 dmx-text="trans.data.Completed[lang.value]+': '+(list_order_items_shift_all.data.query.where(`order_item_group_type`, 'Ingredient', '!==')).count()" class="text-center fw-bold"></h5>
                              </div>
                              <div class="row scrollable">
                                <div dmx-repeat:repeat1="listGugrUserProjectTasksAll.data.list_project_tasks_all.where(`task_status`, 'Completed', '==')">
                                  <main>
                                    <div class="row justify-content-start" style="">
                                      <div class="col rounded-2 border-secondary execution-card shadow-none mt-1 mb-1 ms-3 me-2 pt-2 pb-3 ps-3 pe-3 bg-secondary" dmx-animate-enter.delay:500.duration:500="pulse" dmx-class:main-group-product="order_item_group_type=='Main'" dmx-class:accessory-product="order_item_group_type=='Accessory'">

                                        <div class="row">

                                          <div class="col">



                                            <div class="row">
                                              <div class="col">
                                                <h6 class="fw-bold me-3 pt-1 pb-1 ps-1 pe-1 text-body"><i class="far fa-user fa-sm" style="margin-right: 5px;"> {{userCratedName}}</i></h6>

                                                <h6 class="fw-bold text-info"><i class="fas fa-user-alt fa-sm" style="margin-right: 5px;"> {{userConcernedName}}</i></h6>


                                              </div>

                                            </div>
                                            <div class="row">
                                              <div class="col">
                                                <h6 dmx-text="'#'+task_id+" class="fw-bold text-body"><i class="fas fa-clipboard-list fa-lg"></i></h6>
                                                <h6 dmx-text="task_date_created" class="fw-bold text-body"></h6>
                                                <h6 dmx-text="task_date_due" class="fw-bold text-body"></h6>
                                              </div>
                                            </div>


                                          </div>
                                          <div class="col rounded mt-1 me-1 pt-1 bg-light">
                                            <h5 dmx-text="product_name" class="text-center fw-bolder"></h5>
                                            <h6 dmx-text="task_description" class="fw-bold text-center bg-opacity-10 rounded ms-1 me-1 pt-1 pb-1 ps-1 pe-1 text-body">

                                            </h6>

                                          </div>



                                          <div>
                                            <div>

                                            </div>
                                          </div>

                                        </div>
                                        <div class="row row-cols-12">
                                          <div class="d-flex justify-content-between col">
                                            <form id="deletePersonalTask3" is="dmx-serverconnect-form" method="post" action="dmxConnect/api/gugr_projects/gugr_project_tasks/delete_gugr_project_task.php" dmx-on:success="notifies1.success('Success');listGugrUserProjectTasks.load({});listGugrUserProjectTasksAll.load({})" onsubmit="return confirm ('Confirm Delete')">
                                              <input id="text1512" name="task_id" type="text" class="form-control visually-hidden" dmx-bind:value="task_id">
                                              <input id="text1513" class="visually-hidden" name="task_date_completed" type="datetime-local" dmx-bind:value="dateTime.datetime">
                                              <button id="btn2311" class="btn rounded me-3 text-muted rounded-9" type="submit">
                                                <i class="far fa-trash-alt"></i></button>
                                            </form>
                                            <form id="updateTaskToActive3" is="dmx-serverconnect-form" method="post" action="dmxConnect/api/gugr_projects/gugr_project_tasks/update_gugr_project_task_to_completed.php" dmx-on:success="notifies1.success('Success');listGugrUserProjectTasks.load({});listGugrUserProjectTasksAll.load({})">
                                              <input id="text1512" name="task_status" type="text" class="form-control visually-hidden" dmx-bind:value="'Validated'">
                                              <input id="text1523" name="task_id" type="text" class="form-control visually-hidden" dmx-bind:value="task_id">
                                              <input id="text1534" class="visually-hidden" name="task_date_completed" type="datetime-local" dmx-bind:value="dateTime.datetime">
                                              <button id="btn23" class="btn text-danger bg-opacity-10 rounded" type="submit">
                                                <i class="fas fa-thumbs-up"></i></button>
                                            </form>

                                          </div>
                                        </div>
                                      </div>

                                    </div>

                                  </main>
                                </div>
                              </div>




                            </div>





                          </div>
                        </div>


                      </div>
                      <div class="col-lg d-flex visually-hidden">
                        <div class="row"></div>
                        <h2>{{trans.data.overview[lang.value]}}</h2>
                        <h5>{{trans.data.Active[lang.value]}}</h5>

                        <div class="d-block">
                          <h4 dmx-text="listGugrProjects.data.query_stats[0].Active+'  '"></h4>
                        </div>
                        <div class="d-block">
                          <h4 dmx-text="listGugrProjects.data.query_stats[0].Active+'  '"></h4>
                        </div>
                        <div class="d-block">
                          <h4 dmx-text="listGugrProjects.data.query_stats[0].Active+'  '"></h4>
                        </div>
                      </div>

                    </div>





                  </div>
                  <div class="tab-pane fade mt-2" id="navTabs2_52" role="tabpanel">
                    <div class="row justify-content-xxl-end row-cols-xxl-12 row-cols-12 mt-3 mb-2 justify-content-end">
                      <div class="col text-end"><button id="btn23" class="btn w-auto text-white bg-primary" dmx-on:click="" data-bs-toggle="collapse" data-bs-target="#uploadFileCollapse1"><i class="fas fa-file-upload"></i>
                        </button></div>
                    </div>

                    <div class="collapse" id="uploadFileCollapse1" is="dmx-bs5-collapse">
                      <div class="container">
                        <div class="row mt-xl-3 mt-3">
                          <div class="col mt-md-3 ms-lg-2 me-lg-2 ms-2 me-2 pt-2 pb-2 ps-5 pe-2 rounded rounded-2 bg-secondary">
                            <h3 class="mt-3">{{trans.data.uploadFile[lang.value]}}</h3>
                            <form id="uploadProjectfile1" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/gugr_projects/gugr_files/create_project_file.php" dmx-on:success="notifies1.success('File Uploaded'); uploadFileCollapse.hide();uploadProjectfile&amp;.reset();listGugrProjectsFiles.load({project_id: readGuGrProject.data.query_read_gugr_project.project_id})" dmx-on:error="assetNotification.danger('Error!')">
                              <input id="fileCreator1" name="project_file_creator" type="text" class="form-control visually-hidden" dmx-bind:value="list_user_info.data.query_list_user_info.user_id">
                              <input id="fileDateCreated1" name="project_file_date_created" type="datetime-local" class="form-control visually-hidden" dmx-bind:value="dateTime.datetime">
                              <input id="projectFileProjectId1" name="project_file_project_id" type="number" class="form-control visually-hidden" dmx-bind:value="readGuGrProject.data.query_read_gugr_project.project_id">


                              <div class="form-group mb-3 row">
                                <label for="fileUpload" class="col-sm-2 col-form-label col-lg-2">{{trans.data.uploadFileCollapse.lang.value]}}</label>
                                <div class="col-sm-10 offset-md-4 col-lg-5 offset-lg-1">
                                  <input id="projectFileProjectFile2" name="project_file" class="form-control visually-hidden"><input type="file" class="form-control" id="fileUpload" name="project_file" aria-describedby="input1_help" data-rule-maxtotalsize="100MB" data-msg-maxtotalsize="Max 100MB!" required="" data-msg-required="!">
                                </div>
                              </div>
                              <div class="form-group mb-3 row">
                                <label for="fileUpload" class="col-sm-2 col-form-label col-lg-2">{{trans.data.object.lang.value]}}</label>
                                <div class="col-sm-10 offset-md-4 col-lg-5 offset-lg-1">
                                  <textarea id="projectFileProjectFile2" name="project_file_description" class="form-control"></textarea>
                                </div>
                              </div>
                              <div class="form-group mb-3 row">
                                <div class="offset-xxl-4 offset-sm-2 offset-md-4 offset-lg-3 text-end offset-xl-3 col-xl col-xl-5 col-lg-5 col-sm-10 col-md-9 col-xxl-4">
                                  <button id="submitProjectFile1" class="btn btn-primary w-auto" type="submit"><i class="fas fa-check fa-sm"></i></button>
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
                                <th>{{trans.data.object[lang.value]}}</th>
                                <th>{{trans.data.dateCreated[lang.value]}}</th>
                                <th>{{trans.data.user[lang.value]}}</th>
                                <th></th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="listGugrProjectsFiles.data.query_list_project_files" id="tableRepeat7">
                              <tr>
                                <td dmx-text="project_file_id"></td>
                                <td dmx-text="project_file"></td>
                                <td>
                                  <form id="updateProjectFileDescription1" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/gugr_projects/gugr_files/update_project_file_description.php" dmx-on:success="notifies1.success('Success!');listGugrProjectsFiles.load({project_id: readGuGrProject.data.query_read_gugr_project.project_id})" dmx-on:error="notifies1.danger('Error!')">
                                    <input id="ProjectFileID2" name="project_file_id1" type="number" class="form-control visually-hidden" dmx-bind:value="project_file_id">
                                    <textarea id="ProjectFileDescription2" name="project_file_description1" type="text" class="form-control" dmx-bind:value="project_file_description"></textarea>
                                    <button id="btn23" class="btn text-info" type="submit">
                                      <i class="fas fa-check"></i>
                                    </button>
                                  </form>
                                </td>
                                <td dmx-text="project_file_date_created"></td>
                                <td dmx-text="user_username"></td>
                                <td>
                                  <dmx-download id="downloadFile1" dmx-bind:url="'uploads/project_files/'+project_file"></dmx-download><button id="btn23" class="btn text-info" dmx-on:click="run({confirm:{message:'Télécharger Ficher?',then:{steps:{run:{action:`downloadFile.download()`}}},name:'confirm'}})">
                                    <i class="fas fa-download"></i></button>

                                </td>
                                <td>
                                  <form id="deleteProjectFile1" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/gugr_projects/gugr_files/delete_project_file.php" dmx-on:success="listGugrProjectsFiles.load({project_id: readGuGrProject.data.query_read_gugr_project.project_id})">
                                    <input id="text15" name="project_file_id1" type="text" class="form-control visually-hidden" dmx-bind:value="project_file_id">
                                    <input id="text15" name="project_file1" type="text" class="form-control visually-hidden" dmx-bind:value="project_file">
                                  </form>
                                  <button id="btn23" class="btn text-secondary" dmx-on:click="run({confirm:{message:'Supprimer Ficher?',then:{steps:{run:{action:`deleteProjectFile.submit()`}}},name:'confirm'}})">
                                    <i class="far fa-trash-alt"></i></button>

                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>

                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade mt-2" id="navTabs2_53" role="tabpanel">
                    <div class="row row-cols-md-12">
                      <div class="col-12 col-md-4">
                        <div class="row justify-content-center">
                          <div class="col">
                            <h4>{{trans.data.messages[lang.value]}}</h4>
                            <div class="row">
                              <form id="createProjectNote1" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/gugr_projects/gugr_notes/create_gugr_project_note.php" dmx-on:success="listGugrNotes.load({project_id: readGuGrProject.data.query_read_gugr_project.project_id});createProjectNote.reset();notifies1.success('Success!')">
                                <div class="form-group mb-3 row">
                                  <div class="rounded ms-3 pt-4 pb-3 ps-4 pe-4 col-sm-11 col-md-11 bg-secondary" style="">
                                    <h4>{{trans.data.leaveMessage[lang.value]}}</h4>
                                    <input id="projectNoteDateCreated1" name="date_created" type="datetime-local" class="form-control visually-hidden" dmx-bind:value="dateTime.datetime"><input type="number" class="form-control visually-hidden" id="projectNoteProjectId1" name="project_note_project_id" aria-describedby="input1_help" dmx-bind:value="readGuGrProject.data.query_read_gugr_project.project_id">
                                    <input type="number" class="form-control visually-hidden" id="projectNoteUserCreated1" name="project_note_user_created" aria-describedby="input1_help" dmx-bind:value="list_user_info.data.query_list_user_info.user_id">
                                    <textarea type="text" class="form-control" id="projectNoteNote2" name="project_note" aria-describedby="input1_help" style="height: 150px;"></textarea>

                                    <div class="row justify-content-end me-0"><button id="btn23" class="btn mt-2 bg-primary text-white w-25" type="submit">
                                        <i class="far fa-paper-plane fa-lg"></i>
                                      </button></div>
                                  </div>
                                </div>
                              </form>
                            </div>

                          </div>

                        </div>

                      </div>
                      <div class="scrollable col-md-5">
                        <h5 class="text-start"><i class="fas fa-comments fa-lg" style="margin-right: 5px;"></i></h5>
                        <div dmx-repeat:repeatprojectnotes="listGugrNotes.data.query_list_project_notes">
                          <main>
                            <div class="row mb-2">
                              <div class="col bg-secondary ms-3 me-5 pt-3 pb-3 ps-3 pe-3 rounded-3">
                                <div class="row">
                                  <div class="col d-flex">
                                    <h6 class="fw-bold me-2" dmx-class:green-state="project_note_user_created==list_user_info.data.query_list_user_info.user_id">
                                      <i class="far fa-user fa-sm" style="margin-right: 5px;"></i>{{user_username}}
                                    </h6>
                                    <h6 class="fw-bold">
                                      <i class="far fa-clock" style="margin-right: 5px;"></i>{{date_created}}
                                    </h6>
                                  </div>
                                </div>
                                <div class="row justify-content-end row-cols-12">

                                  <form is="dmx-serverconnect-form" id="updateProjectNote1" method="post" action="dmxConnect/api/gugr_projects/gugr_notes/update_gugr_note.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="readGuGrProject.data.query_read_gugr_project" dmx-on:success="readGuGrProject.load({project_id: readGuGrProject.data.query_read_gugr_project.project_id});updateProjectStatus.reset();listGugrProjectSteps.load({project_id: readGuGrProject.data.query_read_gugr_project.project_id}); listGugrProjects.load({gugr_project_filter: gugrProjectFilter.value, gugr_project_status: gugrProjectStatusFilter.value, offset: list_gugr_projects.data.offset_gugr_projects, limit: gugrProjectLimit.value});notifies1.success('Success!');listGugrNotes.load({project_id: readGuGrProject.data.query_read_gugr_project.project_id})" dmx-on:error="notifies1.danger('Error!')">

                                    <input id="projectNoteProject2" name="project_note_id1" type="text" class="form-control visually-hidden" dmx-bind:value="project_note_id">

                                    <div class="form-group mb-3 row">
                                      <div class="col-sm-10">
                                        <h5 dmx-text="project_note" class="fw-bold text-body">Fancy display heading</h5>
                                        <textarea type="text" class="form-control" id="projectNoteNote2" name="project_note1" aria-describedby="inp_project_description_help" style="display: none; height: 150px; border: none; background: transparent;" dmx-bind:value="project_note"></textarea>
                                      </div>
                                    </div>
                                    <div class="form-group mb-3 row">
                                      <div class="col-sm-10 text-end visually-hidden">
                                        <button type="submit" class="btn bg-info btn-info" dmx-bind:value="readGuGrProject.data.query_read_gugr_project.Save" dmx-bind:readonly="state.executing">{{trans.data.update[lang.value]}}<span class="spinner-border spinner-border-sm" role="status" dmx-show="state.executing"></span></button>
                                      </div>
                                    </div>
                                  </form>


                                </div>
                                <div class="row justify-content-end row-cols-12 text-end">
                                  <form id="deleteGugrNote1" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/gugr_projects/gugr_notes/delete_gugr_project_note.php" dmx-on:success="listGugrNotes.load({project_id: readGuGrProject.data.query_read_gugr_project.project_id})" onsubmit="return confirm('Confirm Delete!');">

                                    <input id="deleteNoteId1" name="project_note_id1" type="number" class="form-control visually-hidden" dmx-bind:value="project_note_id"><button id="btn23" class="btn text-body" type="submit" dmx-hide="project_note_user_created!==list_user_info.data.query_list_user_info.user_id">
                                      <i class="far fa-trash-alt"></i></button>
                                  </form>
                                </div>








                              </div>

                            </div>


                          </main>
                        </div>
                      </div>
                    </div>





                  </div>
                  <div class="tab-pane fade mt-2" id="navTabs2_5" role="tabpanel">
                    <div class="row">
                      <div class="col-xl-4 text-sm-center text-center text-md-center rounded rounded-1 border-light col-12 col-md-5 col-lg-5 mt-2 pt-3 pb-2 ps-3 pe-3">
                        <div class="row">
                          <div class="col pt-3 ps-3 pe-3 bg-light">

                            <h5 class="text-start fw-bold"><i class="far fa-file-alt" style="margin-right: 5px;"></i>{{trans.data.info[lang.value]}}</h5>
                            <div class="row rounded mb-3 ms-0 me-0 pt-4 pb-3 border-secondary bg-secondary">
                              <p class="text-start" dmx-text="readGuGrProject.data.query_read_gugr_project.project_code"></p>
                              <p class="text-start" dmx-text="trans.data.dateCreated[lang.value]+': '+readGuGrProject.data.query_read_gugr_project.project_date_created"></p>
                              <p class="text-start" dmx-text="trans.data.dateDue[lang.value]+': '+readGuGrProject.data.query_read_gugr_project.project_date_due"></p>
                            </div>
                            <form is="dmx-serverconnect-form" id="updateProjectReception1" method="post" action="dmxConnect/api/gugr_projects/gugr_projects/update_gugr_project_reception.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="readGuGrProject.data.query_read_gugr_project" dmx-on:success="readGuGrProject.load({project_id: readGuGrProject.data.query_read_gugr_project.project_id}); listGugrProjects.load({gugr_project_filter: gugrProjectFilter.value, gugr_project_status: gugrProjectStatusFilter.value, offset: list_gugr_projects.data.offset_gugr_projects, limit: gugrProjectLimit.value}); listGugrProjects.load({gugr_project_filter: gugrProjectFilter.value, gugr_project_status: gugrProjectStatusFilter.value, offset: list_gugr_projects.data.offset_gugr_projects, limit: gugrProjectLimit.value})"><input id="text15" name="project_id" type="text" class="form-control visually-hidden" dmx-bind:value="readGuGrProject.data.query_read_gugr_project.project_id">
                              <div class="form-group mb-3 row">
                                <label for="inp_project_description1" class="col-sm-2 col-form-label">{{trans.data.object[lang.value]}}</label>
                                <div class="col-sm-10">
                                  <textarea type="text" class="form-control" id="inp_project_description1" name="project_description" dmx-bind:value="readGuGrProject.data.query_read_gugr_project.project_description" aria-describedby="inp_project_description_help" style="height: 150px;" dmx-bind:readonly="(list_user_info.data.query_list_user_info.user_profile!=='gugr-reception')&amp;&amp;(list_user_info.data.query_list_user_info.user_profile!=='gugr-cordo')"></textarea>
                                </div>
                              </div>
                              <div class="form-group mb-3 row">
                                <label for="inp_project_date_due_4" class="col-sm-2 col-form-label">{{trans.data.dateDue[lang.value]}}</label>
                                <div class="col-sm-10">
                                  <input type="datetime-local" class="form-control" id="inp_project_date_due_4" name="project_date_due" dmx-bind:value="readGuGrProject.data.query_read_gugr_project.project_date_due" aria-describedby="inp_project_date_due_help" dmx-bind:readonly="(list_user_info.data.query_list_user_info.user_profile!=='gugr-reception')&amp;&amp;(list_user_info.data.query_list_user_info.user_profile!=='gugr-cordo')">
                                </div>
                              </div>
                              <div class="form-group mb-3 row">
                                <div class="col-sm-10 text-end" dmx-hide="list_user_info.data.query_list_user_info.user_profile!=='gugr-reception'&amp;&amp;list_user_info.data.query_list_user_info.user_profile!=='gugr-cordo'">
                                  <button type="submit" class="btn btn-primary text-white bg-primary" dmx-bind:value="readGuGrProject.data.query_read_gugr_project.Save" dmx-bind:readonly="state.executing">{{trans.data.update[lang.value]}} <span class="spinner-border spinner-border-sm" role="status" dmx-show="state.executing"></span></button>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>



                      </div>
                      <div class="col-xl-4 col-12 text-sm-center text-center text-md-center rounded rounded-1 border-light col-md-3 col-lg-3 mt-2 pt-3 pb-2 ps-3 pe-3">
                        <div class="row">
                          <div class="col bg-secondary pt-3 ps-3 pe-3 rounded rounded-3" dmx-show="list_user_info.data.query_list_user_info.user_profile=='gugr-cordo'">
                            <h5 class="text-start fw-bold"><i class="fas fa-hourglass-half" style="margin-right: 5px;"></i>{{trans.data.status[lang.value]}}</h5>
                            <form is="dmx-serverconnect-form" id="updateProjectStatus1" method="post" action="dmxConnect/api/gugr_projects/gugr_projects/update_gugr_project_status.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-populate="readGuGrProject.data.query_read_gugr_project" dmx-on:success="readGuGrProject.load({project_id: readGuGrProject.data.query_read_gugr_project.project_id});updateProjectStatus.reset();notifies1.success('Success!');listGugrProjectsProjects.load({})" dmx-on:error="notifies1.danger('Error!')">
                              <input id="text15" name="project_id" type="text" class="form-control visually-hidden" dmx-bind:value="readGuGrProject.data.query_read_gugr_project.project_id">
                              <div class="form-group mb-3 row">

                                <label for="inp_project_status1" class="col-sm-2 col-form-label col">{{trans.data.status[lang.value]}}</label>
                                <div class="col-sm-10">
                                  <select id="select3" class="form-select" name="project_status" dmx-bind:value="readGuGrProject.data.query_read_gugr_project.project_status">
                                    <option value="Pending">{{trans.data.pending[lang.value]}}</option>
                                    <option value="Active">{{trans.data.Active[lang.value]}}</option>
                                    <option value="Completed">{{trans.data.Completed[lang.value]}}</option>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group mb-3 row">
                                <div class="col-sm-10 text-end">
                                  <button type="submit" class="btn btn-primary text-white bg-primary" dmx-bind:value="readGuGrProject.data.query_read_gugr_project.Save" dmx-bind:readonly="state.executing">{{trans.data.update[lang.value]}}<span class="spinner-border spinner-border-sm" role="status" dmx-show="state.executing"></span></button>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>



                      </div>
                      <div class="col-12 text-sm-center text-center text-md-center rounded rounded-1 border-light col-md-3 col-lg-3 col-xl-3 mt-2 pt-3 pb-2 ps-3 pe-3">
                        <div class="row">
                        </div>



                      </div>
                    </div>
                  </div>

                </div>

              </div>
            </div>
          </div>
          <div class="modal-footer border-0">
            <form id="updateStepActive1" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/gugr_projects/gugr_projects/delete_gugr_project.php" dmx-on:success="notifies1.success('Success');readItemModal.hide(); listGugrProjects.load({gugr_project_filter: gugrProjectFilter.value, gugr_project_status: gugrProjectStatusFilter.value, offset: list_gugr_projects.data.offset_gugr_projects, limit: gugrProjectLimit.value})" onsubmit=" return confirm('CONFIRM DELETE?');" dmx-on:error="notifies1.danger('Error!')">
              <input id="text1532" name="project_step_id1" class="form-control visually-hidden" dmx-bind:value="readGuGrProject.data.query_read_gugr_project.project_id" type="number">

            </form>
            <form id="deleteProjectForm34" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/gugr_projects/gugr_projects/delete_gugr_project.php" dmx-on:success="notifies1.success('Success');readItemModal.hide(); listGugrProjects.load({gugr_project_filter: gugrProjectFilter.value, gugr_project_status: gugrProjectStatusFilter.value, offset: list_gugr_projects.data.offset_gugr_projects, limit: gugrProjectLimit.value})" onsubmit=" return confirm('CONFIRM DELETE?');" dmx-on:error="notifies1.danger('Error!')">
              <input id="text1522" name="project_id4" class="form-control visually-hidden" dmx-bind:value="readGuGrProject.data.query_read_gugr_project.project_id" type="number">

            </form>
            <form id="deleteProjectForm31" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/gugr_projects/gugr_projects/delete_gugr_project.php" dmx-on:success="notifies1.success('Success');readItemModalProject.hide(); listGugrProjectsProjects.load({gugr_project_filter: gugrProjectFilter.value, gugr_project_status: gugrProjectStatusFilter.value, offset: list_gugr_projects.data.offset_gugr_projects, limit: gugrProjectLimit.value})" onsubmit=" return confirm('CONFIRM DELETE?');" dmx-on:error="notifies1.danger('Error!')">
              <input id="text1531" name="project_id" class="form-control visually-hidden" dmx-bind:value="readGuGrProject.data.query_read_gugr_project.project_id" type="number">

              <button id="btn2313" class="btn text-secondary" type="submit">
                <i class="far fa-trash-alt fa-lg"></i>
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>


    <div class="modal" id="createTask1" is="dmx-bs5-modal" tabindex="-1" dmx-on:hidden-bs-modal="readItemModalProject.toggle();readItemModalProject.toggle()" dmx-on:show-bs-modal="readItemModalProject.toggle()">
      <div class="modal-dialog modal-lg modal-fullscreen-xxl-down">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-dark">{{trans.data.createNewTask[lang.value]}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row row-cols-12 mb-0 me-2 pt-2 pb-2">
              <div class="col-sm-12 bg-opacity-10 bg-primary col-12 col-xxl-12 col-lg-12 col-xl-12 ms-2 me-2 pt-3 pb-2 pe-3">
                <form id="createProjectTaskForm1" is="dmx-serverconnect-form" method="post" action="dmxConnect/api/gugr_projects/gugr_project_tasks/create_gugr_project_task.php" dmx-on:success="notifies1.success('Success!');listGugrUserProjectTasks.load({});listGugrUserProjectTasksAll.load({});createProjectTaskForm1.reset()" dmx-on:error="notifies1.danger('Error!')">
                  <textarea id="taskDescription1" name="task_description" type="text" class="form-control" style="height: 100px;"></textarea>
                  <input id="taskDateCreated1" name="task_date_created" type="datetime-local" class="form-control visually-hidden" dmx-bind:value="dateTime.datetime">
                  <input id="taskStatus1" name="task_status" class="form-control visually-hidden" dmx-bind:value="'Pending'">
                  <input id="taskProject" name="task_project" class="form-control visually-hidden" dmx-bind:value="readGuGrProject.data.query_read_gugr_project.project_id">
                  <input id="taskUserCreated1" name="task_user_created" class="form-control visually-hidden" dmx-bind:value="list_user_info.data.query_list_user_info.user_id" type="number">
                  <div class="form-group mb-3">
                    <label for="taskUserConcerned" class="form-label">{{trans.data.user[lang.value]}}</label>
                    <select id="taskUserConcerned" class="form-select" dmx-bind:options="load_users_1.data.query_list_users" optiontext="user_username+' | '+user_fname+' '+user_lname" optionvalue="user_id" name="task_user_concerned" required="" data-msg-required="!">
                      <option value="">-----</option>
                    </select>
                  </div>
                  <div class="row justify-content-end mt-1 ps-2 pe-2">
                    <small class="text-muted">{{trans.data.createNewTAsk[lang.value]}}</small>
                    <button id="btn233" class="btn mt-1 mb-2 w-25 btn-primary bg-primary" type="submit">
                      <i class="fas fa-plus-circle"></i>
                    </button>
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
    <div class="modal create-modal" id="createItemModal" is="dmx-bs5-modal" tabindex="-1">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-light border-0">
            <h5 class="modal-title fw-bold">{{trans.data.newQuery[lang.value]}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body bg-light">
            <div class="row">
              <div class="col">
                <form is="dmx-serverconnect-form" id="formCreateNewRequest" method="post" action="dmxConnect/api/gugr_projects/gugr_projects/create_gugr_project.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-on:success="formCreateNewRequest.reset();notifies1.success('Success');listGugrProjects.load({gugr_project_filter: gugrProjectFilter.value, gugr_project_status: gugrProjectStatusFilter.value, offset: 0, limit: gugrProjectLimit.value});createItemModal.hide();readGuGrProject.load({project_id: formCreateNewRequest.data.last_project_insert[0]['last_insert_id()']});readItemModal.show()" dmx-on:error="notifies1.danger('Error!')">
                  <div class="mb-3 row">
                    <label for="inp_product_name" class="col-sm-2 col-form-label"><b>{{trans.data.object[lang.value]}}</b></label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="gugrprojectcode" name="project_code" aria-describedby="inp_product_name_help">
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label for="inp_product_name" class="col-sm-2 col-form-label"><b>{{trans.data.expeditor[lang.value]}}</b></label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="gugrprojectcode1" name="project_notes" aria-describedby="inp_product_name_help">
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label for="inp_product_name" class="col-sm-2 col-form-label"><b>{{trans.data.note[lang.value]}}</b></label>
                    <div class="col-sm-10">
                      <textarea type="text" class="form-control" id="gugrDescription" name="project_description" aria-describedby="inp_product_name_help"></textarea>
                    </div>
                  </div>
                  <div class="mb-3 row" dmx-show="(list_user_info.data.query_list_user_info.user_profile=='gugr-cordo')||(list_user_info.data.query_list_user_info.user_profile=='gugr-admin')">
                    <label for="inp_product_name" class="col-sm-2 col-form-label"><b>{{trans.data.dateDue[lang.value]}}</b></label>
                    <div class="col-sm-10">
                      <input id="gugrProjectDateDue" name="project_date_due" type="datetime-local" class="form-control" dmx-bind:value="dateTime.datetime">
                    </div>
                  </div>
                  <input id="gugrProjectType" name="project_type" type="text" class="form-control visually-hidden" dmx-bind:value="'Query'">
                  <input id="gugrProjectStatus" name="project_status" type="text" class="form-control visually-hidden" dmx-bind:value="'Pending'">
                  <input id="gugrProjectUser" name="project_user_created" type="text" class="form-control visually-hidden" dmx-bind:value="list_user_info.data.query_list_user_info.user_id">
                  <input id="gugrProjectDateCreated" name="project_date_created" type="datetime-local" class="form-control visually-hidden" dmx-bind:value="dateTime.datetime">


                  <div class="mb-3 row">
                    <div class="col-sm-2">&nbsp;</div>
                    <div class="col-sm-10">
                      <button type="submit" class="btn btn-primary">{{trans.data.register[lang.value]}}</button>
                    </div>
                  </div>
                </form>
              </div>

            </div>

          </div>
          <div class="modal-footer border-0 bg-light">
          </div>

        </div>
      </div>
    </div>
    <div class="modal create-modal" id="createProject" is="dmx-bs5-modal" tabindex="-1">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-light border-0">
            <h5 class="modal-title fw-bold">{{trans.data.newProject[lang.value]}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body bg-light">
            <div class="row">
              <div class="col">
                <form is="dmx-serverconnect-form" id="formCreateNewProject" method="post" action="dmxConnect/api/gugr_projects/gugr_projects/create_gugr_project.php" dmx-generator="bootstrap5" dmx-form-type="horizontal" dmx-on:success="formCreateNewProject.reset();notifies1.success('Success');listGugrProjects.load({gugr_project_filter: gugrProjectFilter.value, gugr_project_status: gugrProjectStatusFilter.value, offset: 0, limit: gugrProjectLimit.value});createProject.hide();readGuGrProject.load({project_id: formCreateNewProject.data.last_project_insert[0]['last_insert_id()']});readItemModalProject.show();listGugrProjectsProjects.load({})" dmx-on:error="notifies1.danger('Error!')">
                  <div class="mb-3 row">
                    <label for="inp_product_name" class="col-sm-2 col-form-label"><b>{{trans.data.code[lang.value]}}</b></label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="gugrprojectcode2" name="project_code" aria-describedby="inp_product_name_help">
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label for="inp_product_name" class="col-sm-2 col-form-label"><b>{{trans.data.object[lang.value]}}</b></label>
                    <div class="col-sm-10">
                      <textarea type="text" class="form-control" id="gugrDescription1" name="project_description" aria-describedby="inp_product_name_help"></textarea>
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label for="inp_product_name" class="col-sm-2 col-form-label"><b>{{trans.data.dateDue[lang.value]}}</b></label>
                    <div class="col-sm-10">
                      <input id="gugrProjectDateDue1" name="project_date_due" type="datetime-local" class="form-control">
                    </div>
                  </div>
                  <input id="gugrProjectType1" name="project_type" type="text" class="form-control visually-hidden" dmx-bind:value="'Work Order'">
                  <input id="gugrProjectStatus1" name="project_status" type="text" class="form-control visually-hidden" dmx-bind:value="'Pending'">
                  <input id="gugrProjectUser1" name="project_user_created" type="text" class="form-control visually-hidden" dmx-bind:value="list_user_info.data.query_list_user_info.user_id">
                  <input id="gugrProjectDateCreated1" name="project_date_created" type="datetime-local" class="form-control visually-hidden" dmx-bind:value="dateTime.datetime">


                  <div class="mb-3 row">
                    <div class="col-sm-2">&nbsp;</div>
                    <div class="col-sm-10">
                      <button type="submit" class="btn btn-primary">{{trans.data.register[lang.value]}}</button>
                    </div>
                  </div>
                </form>
              </div>

            </div>

          </div>
          <div class="modal-footer border-0 bg-light">
          </div>

        </div>
      </div>
    </div>
    <div class="modal" id="taskStatsModalProject" is="dmx-bs5-modal" tabindex="-1" dmx-on:show-bs-modal="readItemModalProject.toggle()" dmx-on:hide-bs-modal="readItemModalProject.toggle()">
      <div class="modal-dialog modal-fullscreen-xl-down modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{trans.data.tasks[lang.value]}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row mb-xl-2 mb-2 sorter shadow-none bg-light justify-content-start justify-content-md-start justify-content-lg-start justify-content-xl-start justify-content-xxl-start row-cols-12 justify-content-sm-start">


              <div class="flex-sm-wrap flex-md-wrap flex-lg-wrap col-sm-auto col-auto col-md-auto col-lg-auto col-xl-auto col-xxl-auto" style="">
                <ul class="pagination" dmx-populate="listGugrUserProjectTasks.data.list_project_tasks_paged" dmx-state="list_gugr_projects" dmx-offset="offset_gugr_project_tasks" dmx-generator="bs5paging">
                  <li class="page-item" dmx-class:disabled="listGugrUserProjectTasks.data.list_project_tasks_paged.page.current == 1" aria-label="First">
                    <a href="javascript:void(0)" class="page-link" dmx-on:click="list_gugr_projects.set('offset_gugr_project_tasks',listGugrUserProjectTasks.data.list_project_tasks_paged.page.offset.first)"><span aria-hidden="true">‹‹</span></a>
                  </li>
                  <li class="page-item" dmx-class:disabled="listGugrUserProjectTasks.data.list_project_tasks_paged.page.current == 1" aria-label="Previous">
                    <a href="javascript:void(0)" class="page-link" dmx-on:click="list_gugr_projects.set('offset_gugr_project_tasks',listGugrUserProjectTasks.data.list_project_tasks_paged.page.offset.prev)"><span aria-hidden="true">‹</span></a>
                  </li>
                  <li class="page-item" dmx-class:active="title == listGugrUserProjectTasks.data.list_project_tasks_paged.page.current" dmx-class:disabled="!active" dmx-repeat="listGugrUserProjectTasks.data.list_project_tasks_paged.getServerConnectPagination(2,1,'...')">
                    <a href="javascript:void(0)" class="page-link" dmx-on:click="list_gugr_projects.set('offset_gugr_project_tasks',(page-1)*listGugrUserProjectTasks.data.list_project_tasks_paged.limit)">{{title}}</a>
                  </li>
                  <li class="page-item" dmx-class:disabled="listGugrUserProjectTasks.data.list_project_tasks_paged.page.current ==  listGugrUserProjectTasks.data.list_project_tasks_paged.page.total" aria-label="Next">
                    <a href="javascript:void(0)" class="page-link" dmx-on:click="list_gugr_projects.set('offset_gugr_project_tasks',listGugrUserProjectTasks.data.list_project_tasks_paged.page.offset.next)"><span aria-hidden="true">›</span></a>
                  </li>
                  <li class="page-item" dmx-class:disabled="listGugrUserProjectTasks.data.list_project_tasks_paged.page.current ==  listGugrUserProjectTasks.data.list_project_tasks_paged.page.total" aria-label="Last">
                    <a href="javascript:void(0)" class="page-link" dmx-on:click="list_gugr_projects.set('offset_gugr_project_tasks',listGugrUserProjectTasks.data.list_project_tasks_paged.page.offset.last)"><span aria-hidden="true">››</span></a>
                  </li>
                </ul>
              </div>
              <div class="col-auto col-xl-2 col-md-auto col-sm-auto col-3 col-sm-2 col-lg-2 col-xxl-auto"><select id="gugrProjectTaskStatusFilter1" class="form-select" name="gugrProjectStatusFilter3">
                  <option selected="" value="">-----</option>
                  <option value="Pending">Registered</option>
                  <option value="Active">Active</option>
                  <option value="Completed">Closed</option>
                </select></div>
              <div class="offset-sm-1 col-md-auto col-auto col-sm-auto col-sm-2 col-lg-auto offset-xl-1 col-xl-1 col-xxl-auto">

                <select id="gugrProjecTaskstLimit1" class="form-select" name="product_category_sort_limit3">
                  <option value="5">5</option>
                  <option value="25">25</option>
                  <option value="50">50</option>
                  <option value="100">100</option>
                  <option value="''">{{trans.data.all[lang.value]}}</option>
                </select>
              </div>
              <div class="col-xl-2 offset-xl-1 col-md-auto col-auto col-sm-auto col-lg-2 col-xxl-auto">
              </div>

            </div>
            <div class="row">
              <div class="col bg-light rounded rounded-2 ms-2 me-2">
                <div class="table-responsive">
                  <table class="table table-hover table-sm">
                    <thead class="text-center">
                      <tr>
                        <th class="sorting" dmx-on:click="list_gugr_projects.set('sort_gugr_project_tasks','task_id');list_gugr_projects.set('dir_gugr_project_tasks',list_gugr_projects.data.dir_gugr_project_tasks == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="list_gugr_projects.data.sort_gugr_project_tasks=='task_id' &amp;&amp; list_gugr_projects.data.dir_gugr_project_tasks == 'asc'" dmx-class:sorting_desc="list_gugr_projects.data.sort_gugr_project_tasks=='task_id' &amp;&amp; list_gugr_projects.data.dir_gugr_project_tasks == 'desc'">#</th>
                        <th class="sorting" dmx-on:click="list_gugr_projects.set('sort_gugr_project_tasks','task_date_created');list_gugr_projects.set('dir_gugr_project_tasks',list_gugr_projects.data.dir_gugr_project_tasks == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="list_gugr_projects.data.sort_gugr_project_tasks=='task_date_created' &amp;&amp; list_gugr_projects.data.dir_gugr_project_tasks == 'asc'" dmx-class:sorting_desc="list_gugr_projects.data.sort_gugr_project_tasks=='task_date_created' &amp;&amp; list_gugr_projects.data.dir_gugr_project_tasks == 'desc'">{{trans.data.dateTime[lang.value]}}</th>
                        <th class="sorting" dmx-on:click="list_gugr_projects.set('sort_gugr_project_tasks','task_user_created');list_gugr_projects.set('dir_gugr_project_tasks',list_gugr_projects.data.dir_gugr_project_tasks == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="list_gugr_projects.data.sort_gugr_project_tasks=='task_user_created' &amp;&amp; list_gugr_projects.data.dir_gugr_project_tasks == 'asc'" dmx-class:sorting_desc="list_gugr_projects.data.sort_gugr_project_tasks=='task_user_created' &amp;&amp; list_gugr_projects.data.dir_gugr_project_tasks == 'desc'">{{trans.data.user[lang.value]}}</th>
                        <th class="sorting" dmx-on:click="list_gugr_projects.set('sort_gugr_project_tasks','task_user_concerned');list_gugr_projects.set('dir_gugr_project_tasks',list_gugr_projects.data.dir_gugr_project_tasks == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="list_gugr_projects.data.sort_gugr_project_tasks=='task_user_concerned' &amp;&amp; list_gugr_projects.data.dir_gugr_project_tasks == 'asc'" dmx-class:sorting_desc="list_gugr_projects.data.sort_gugr_project_tasks=='task_user_concerned' &amp;&amp; list_gugr_projects.data.dir_gugr_project_tasks == 'desc'">{{trans.data.attention[lang.value]}}</th>
                        <th class="sorting" dmx-on:click="list_gugr_projects.set('sort_gugr_project_tasks','task_notes');list_gugr_projects.set('dir_gugr_project_tasks',list_gugr_projects.data.dir_gugr_project_tasks == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="list_gugr_projects.data.sort_gugr_project_tasks=='task_notes' &amp;&amp; list_gugr_projects.data.dir_gugr_project_tasks == 'asc'" dmx-class:sorting_desc="list_gugr_projects.data.sort_gugr_project_tasks=='task_notes' &amp;&amp; list_gugr_projects.data.dir_gugr_project_tasks == 'desc'">{{trans.data.note[lang.value]}}</th>
                        <th class="sorting" dmx-on:click="list_gugr_projects.set('sort_gugr_project_tasks','task_status');list_gugr_projects.set('dir_gugr_project_tasks',list_gugr_projects.data.dir_gugr_project_tasks == 'desc' ? 'asc' : 'desc')" dmx-class:sorting_asc="list_gugr_projects.data.sort_gugr_project_tasks=='task_status' &amp;&amp; list_gugr_projects.data.dir_gugr_project_tasks == 'asc'" dmx-class:sorting_desc="list_gugr_projects.data.sort_gugr_project_tasks=='task_status' &amp;&amp; list_gugr_projects.data.dir_gugr_project_tasks == 'desc'">{{trans.data.status[lang.value]}}</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody is="dmx-repeat" dmx-generator="bs5table" id="tableRepeat7" dmx-state="list_gugr_projects" dmx-sort="sort_gugr_project_tasks" dmx-order="dir_gugr_project_tasks" dmx-bind:repeat="listGugrUserProjectTasksProject.data.list_project_tasks">
                      <tr>
                        <td dmx-text="task_id"></td>
                        <td dmx-text="task_date_created" class="text-center"></td>
                        <td dmx-text="userCratedName" class="text-center"></td>
                        <td dmx-text="userConcernedName" class="text-center"></td>
                        <td dmx-text="task_description"></td>
                        <td dmx-text="task_status" dmx-class:text-success="task_status=='Completed'" dmx-class:text-danger="task_status=='Pending'" class="text-center"></td>
                        <td class="text-center">
                          <form id="updateTaskToComplete1" is="dmx-serverconnect-form" method="post" action="dmxConnect/api/gugr_projects/gugr_project_tasks/update_gugr_project_task_to_completed.php" dmx-on:success="notifies1.success('Success');listGugrUserProjectTasks.load({})">
                            <input id="text157" name="task_status1" type="text" class="form-control visually-hidden" dmx-bind:value="'Completed'">
                            <input id="text156" name="task_id1" type="text" class="form-control visually-hidden" dmx-bind:value="task_id">
                            <input id="text154" class="visually-hidden" name="task_date_completed1" type="datetime-local" dmx-bind:value="dateTime.datetime">
                            <button id="btn234" class="btn text-danger" type="submit">
                              <i class="fas fa-thumbs-up"></i></button>
                          </form>
                        </td>
                      </tr>
                    </tbody>
                  </table>
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

  <script src="bootstrap/5/js/bootstrap.bundle.min.js"></script>
</body>

</html>