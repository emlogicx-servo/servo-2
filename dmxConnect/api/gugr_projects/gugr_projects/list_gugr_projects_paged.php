<?php
require('../../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "sort"
      },
      {
        "type": "text",
        "name": "dir"
      },
      {
        "type": "text",
        "name": "gugr_project_filter"
      },
      {
        "type": "text",
        "name": "gugr_project_status"
      },
      {
        "type": "text",
        "name": "offset"
      },
      {
        "type": "text",
        "name": "limit"
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "query_stats",
        "module": "dbupdater",
        "action": "custom",
        "options": {
          "connection": "servodb",
          "sql": {
            "query": "SELECT\n\n(select count(*) from servo_projects where project_status = 'Active' and project_type =\"Query\") as QueryActive,\n\n(select count(*) from servo_projects where project_status = 'Pending' and project_type =\"Query\") as QueryPending,\n\n(select count(*) from servo_projects where project_status = 'Completed' and project_type =\"Query\") as QueryCompleted,\n\n(select count(*) from servo_projects where project_status = 'Active') as Active,\n\n(select count(*) from servo_projects where project_status = 'Pending') as Pending,\n\n(select count(*) from servo_projects where project_status = 'Completed') as Completed",
            "params": []
          }
        },
        "output": true,
        "meta": [
          {
            "name": "QueryActive",
            "type": "text"
          },
          {
            "name": "QueryPending",
            "type": "text"
          },
          {
            "name": "QueryCompleted",
            "type": "text"
          },
          {
            "name": "Active",
            "type": "text"
          },
          {
            "name": "Pending",
            "type": "text"
          },
          {
            "name": "Completed",
            "type": "text"
          }
        ]
      },
      {
        "name": "query_list_gugr_projects",
        "module": "dbconnector",
        "action": "paged",
        "options": {
          "connection": "servodb",
          "sql": {
            "type": "SELECT",
            "columns": [
              {
                "table": "servo_projects",
                "column": "project_id"
              },
              {
                "table": "servo_projects",
                "column": "project_user_created"
              },
              {
                "table": "userConcerned",
                "column": "user_profile"
              },
              {
                "table": "servo_projects",
                "column": "project_status"
              },
              {
                "table": "servo_projects",
                "column": "project_date_created"
              },
              {
                "table": "servo_projects",
                "column": "project_date_due"
              },
              {
                "table": "servo_projects",
                "column": "project_notes"
              },
              {
                "table": "servo_projects",
                "column": "project_code"
              },
              {
                "table": "userConcerned",
                "column": "user_fname",
                "alias": "userConcerned_fname"
              },
              {
                "table": "userConcerned",
                "column": "user_lname",
                "alias": "userConcerned_lname"
              },
              {
                "table": "userConcerned",
                "column": "user_username",
                "alias": "userConcerned_username"
              },
              {
                "table": "servo_user",
                "column": "user_fname"
              },
              {
                "table": "servo_user",
                "column": "user_lname"
              },
              {
                "table": "servo_user",
                "column": "user_username"
              },
              {
                "table": "servo_projects",
                "column": "project_type"
              }
            ],
            "table": {
              "name": "servo_projects"
            },
            "joins": [
              {
                "table": "servo_user",
                "column": "*",
                "type": "LEFT",
                "clauses": {
                  "condition": "AND",
                  "rules": [
                    {
                      "table": "servo_user",
                      "column": "user_id",
                      "operator": "equal",
                      "value": {
                        "table": "servo_projects",
                        "column": "project_user_created"
                      },
                      "operation": "="
                    }
                  ]
                },
                "primary": "user_id"
              },
              {
                "table": "servo_user",
                "column": "*",
                "alias": "userConcerned",
                "type": "LEFT",
                "clauses": {
                  "condition": "AND",
                  "rules": [
                    {
                      "table": "userConcerned",
                      "column": "user_id",
                      "operator": "equal",
                      "value": {
                        "table": "servo_projects",
                        "column": "project_user_concerned"
                      },
                      "operation": "="
                    }
                  ]
                },
                "primary": "user_id"
              }
            ],
            "query": "select `servo_projects`.`project_id`, `servo_projects`.`project_user_created`, `userConcerned`.`user_profile`, `servo_projects`.`project_status`, `servo_projects`.`project_date_created`, `servo_projects`.`project_date_due`, `servo_projects`.`project_notes`, `servo_projects`.`project_code`, `userConcerned`.`user_fname` as `userConcerned_fname`, `userConcerned`.`user_lname` as `userConcerned_lname`, `userConcerned`.`user_username` as `userConcerned_username`, `servo_user`.`user_fname`, `servo_user`.`user_lname`, `servo_user`.`user_username`, `servo_projects`.`project_type` from `servo_projects` left join `servo_user` on `servo_user`.`user_id` = `servo_projects`.`project_user_created` left join `servo_user` as `userConcerned` on `userConcerned`.`user_id` = `servo_projects`.`project_user_concerned` where `servo_projects`.`project_status` like ? and `servo_projects`.`project_code` like ? and `servo_projects`.`project_type` = ? order by `servo_projects`.`project_id` DESC",
            "params": [
              {
                "operator": "contains",
                "type": "expression",
                "name": ":P1",
                "value": "{{$_GET.gugr_project_status}}",
                "test": ""
              },
              {
                "operator": "contains",
                "type": "expression",
                "name": ":P2",
                "value": "{{$_GET.gugr_project_filter}}",
                "test": ""
              }
            ],
            "orders": [
              {
                "table": "servo_projects",
                "column": "project_id",
                "direction": "DESC"
              }
            ],
            "primary": "project_id",
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "servo_projects.project_status",
                  "field": "servo_projects.project_status",
                  "type": "string",
                  "operator": "contains",
                  "value": "{{$_GET.gugr_project_status}}",
                  "data": {
                    "table": "servo_projects",
                    "column": "project_status",
                    "type": "text",
                    "columnObj": {
                      "type": "enum",
                      "enumValues": [
                        "Pending",
                        "Active",
                        "Completed",
                        "Suspended",
                        "Cancelled",
                        "Paused"
                      ],
                      "default": "",
                      "maxLength": 9,
                      "primary": false,
                      "nullable": true,
                      "name": "project_status"
                    }
                  },
                  "operation": "LIKE",
                  "table": "servo_projects"
                },
                {
                  "id": "servo_projects.project_code",
                  "field": "servo_projects.project_code",
                  "type": "string",
                  "operator": "contains",
                  "value": "{{$_GET.gugr_project_filter}}",
                  "data": {
                    "table": "servo_projects",
                    "column": "project_code",
                    "type": "text",
                    "columnObj": {
                      "type": "string",
                      "default": "",
                      "maxLength": 128,
                      "primary": false,
                      "nullable": true,
                      "name": "project_code"
                    }
                  },
                  "operation": "LIKE",
                  "table": "servo_projects"
                },
                {
                  "id": "servo_projects.project_type",
                  "field": "servo_projects.project_type",
                  "type": "string",
                  "operator": "equal",
                  "value": "Query",
                  "data": {
                    "table": "servo_projects",
                    "column": "project_type",
                    "type": "text",
                    "columnObj": {
                      "type": "enum",
                      "enumValues": [
                        "Query",
                        "Transport",
                        "Work Order"
                      ],
                      "default": "",
                      "maxLength": 10,
                      "primary": false,
                      "nullable": true,
                      "name": "project_type"
                    }
                  },
                  "operation": "=",
                  "table": "servo_projects"
                }
              ],
              "conditional": null,
              "valid": true
            }
          }
        },
        "meta": [
          {
            "name": "offset",
            "type": "number"
          },
          {
            "name": "limit",
            "type": "number"
          },
          {
            "name": "total",
            "type": "number"
          },
          {
            "name": "page",
            "type": "object",
            "sub": [
              {
                "name": "offset",
                "type": "object",
                "sub": [
                  {
                    "name": "first",
                    "type": "number"
                  },
                  {
                    "name": "prev",
                    "type": "number"
                  },
                  {
                    "name": "next",
                    "type": "number"
                  },
                  {
                    "name": "last",
                    "type": "number"
                  }
                ]
              },
              {
                "name": "current",
                "type": "number"
              },
              {
                "name": "total",
                "type": "number"
              }
            ]
          },
          {
            "name": "data",
            "type": "array",
            "sub": [
              {
                "type": "number",
                "name": "project_id"
              },
              {
                "type": "number",
                "name": "project_user_created"
              },
              {
                "type": "text",
                "name": "user_profile"
              },
              {
                "type": "text",
                "name": "project_status"
              },
              {
                "type": "datetime",
                "name": "project_date_created"
              },
              {
                "type": "datetime",
                "name": "project_date_due"
              },
              {
                "type": "text",
                "name": "project_notes"
              },
              {
                "type": "text",
                "name": "project_code"
              },
              {
                "type": "text",
                "name": "userConcerned_fname"
              },
              {
                "type": "text",
                "name": "userConcerned_lname"
              },
              {
                "type": "text",
                "name": "userConcerned_username"
              },
              {
                "type": "text",
                "name": "user_fname"
              },
              {
                "type": "text",
                "name": "user_lname"
              },
              {
                "type": "text",
                "name": "user_username"
              },
              {
                "type": "text",
                "name": "project_type"
              }
            ]
          }
        ],
        "outputType": "object",
        "output": true,
        "type": "dbconnector_paged_select"
      },
      {
        "name": "query_list_gugr_projects_projects",
        "module": "dbconnector",
        "action": "paged",
        "options": {
          "connection": "servodb",
          "sql": {
            "type": "SELECT",
            "columns": [
              {
                "table": "servo_projects",
                "column": "project_id"
              },
              {
                "table": "servo_projects",
                "column": "project_user_created"
              },
              {
                "table": "userConcerned",
                "column": "user_profile"
              },
              {
                "table": "servo_projects",
                "column": "project_status"
              },
              {
                "table": "servo_projects",
                "column": "project_date_created"
              },
              {
                "table": "servo_projects",
                "column": "project_date_due"
              },
              {
                "table": "servo_projects",
                "column": "project_notes"
              },
              {
                "table": "servo_projects",
                "column": "project_code"
              },
              {
                "table": "userConcerned",
                "column": "user_fname",
                "alias": "userConcerned_fname"
              },
              {
                "table": "userConcerned",
                "column": "user_lname",
                "alias": "userConcerned_lname"
              },
              {
                "table": "userConcerned",
                "column": "user_username",
                "alias": "userConcerned_username"
              },
              {
                "table": "servo_user",
                "column": "user_fname"
              },
              {
                "table": "servo_user",
                "column": "user_lname"
              },
              {
                "table": "servo_user",
                "column": "user_username"
              },
              {
                "table": "servo_projects",
                "column": "project_type"
              }
            ],
            "table": {
              "name": "servo_projects"
            },
            "joins": [
              {
                "table": "servo_user",
                "column": "*",
                "type": "LEFT",
                "clauses": {
                  "condition": "AND",
                  "rules": [
                    {
                      "table": "servo_user",
                      "column": "user_id",
                      "operator": "equal",
                      "value": {
                        "table": "servo_projects",
                        "column": "project_user_created"
                      },
                      "operation": "="
                    }
                  ]
                },
                "primary": "user_id"
              },
              {
                "table": "servo_user",
                "column": "*",
                "alias": "userConcerned",
                "type": "LEFT",
                "clauses": {
                  "condition": "AND",
                  "rules": [
                    {
                      "table": "userConcerned",
                      "column": "user_id",
                      "operator": "equal",
                      "value": {
                        "table": "servo_projects",
                        "column": "project_user_concerned"
                      },
                      "operation": "="
                    }
                  ]
                },
                "primary": "user_id"
              }
            ],
            "query": "select `servo_projects`.`project_id`, `servo_projects`.`project_user_created`, `userConcerned`.`user_profile`, `servo_projects`.`project_status`, `servo_projects`.`project_date_created`, `servo_projects`.`project_date_due`, `servo_projects`.`project_notes`, `servo_projects`.`project_code`, `userConcerned`.`user_fname` as `userConcerned_fname`, `userConcerned`.`user_lname` as `userConcerned_lname`, `userConcerned`.`user_username` as `userConcerned_username`, `servo_user`.`user_fname`, `servo_user`.`user_lname`, `servo_user`.`user_username`, `servo_projects`.`project_type` from `servo_projects` left join `servo_user` on `servo_user`.`user_id` = `servo_projects`.`project_user_created` left join `servo_user` as `userConcerned` on `userConcerned`.`user_id` = `servo_projects`.`project_user_concerned` where `servo_projects`.`project_status` like ? and `servo_projects`.`project_code` like ? and `servo_projects`.`project_type` = ? order by `servo_projects`.`project_status` DESC, `servo_projects`.`project_date_created` DESC, `servo_projects`.`project_code` DESC",
            "params": [
              {
                "operator": "contains",
                "type": "expression",
                "name": ":P1",
                "value": "{{$_GET.gugr_project_status}}",
                "test": ""
              },
              {
                "operator": "contains",
                "type": "expression",
                "name": ":P2",
                "value": "{{$_GET.gugr_project_filter}}",
                "test": ""
              }
            ],
            "orders": [
              {
                "table": "servo_projects",
                "column": "project_status",
                "direction": "DESC",
                "recid": 1
              },
              {
                "table": "servo_projects",
                "column": "project_date_created",
                "direction": "DESC",
                "recid": 2
              },
              {
                "table": "servo_projects",
                "column": "project_code",
                "direction": "DESC",
                "recid": 3
              }
            ],
            "primary": "project_id",
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "servo_projects.project_status",
                  "field": "servo_projects.project_status",
                  "type": "string",
                  "operator": "contains",
                  "value": "{{$_GET.gugr_project_status}}",
                  "data": {
                    "table": "servo_projects",
                    "column": "project_status",
                    "type": "text",
                    "columnObj": {
                      "type": "enum",
                      "enumValues": [
                        "Pending",
                        "Active",
                        "Completed",
                        "Suspended",
                        "Cancelled",
                        "Paused"
                      ],
                      "default": "",
                      "maxLength": 9,
                      "primary": false,
                      "nullable": true,
                      "name": "project_status"
                    }
                  },
                  "operation": "LIKE"
                },
                {
                  "id": "servo_projects.project_code",
                  "field": "servo_projects.project_code",
                  "type": "string",
                  "operator": "contains",
                  "value": "{{$_GET.gugr_project_filter}}",
                  "data": {
                    "table": "servo_projects",
                    "column": "project_code",
                    "type": "text",
                    "columnObj": {
                      "type": "string",
                      "default": "",
                      "maxLength": 128,
                      "primary": false,
                      "nullable": true,
                      "name": "project_code"
                    }
                  },
                  "operation": "LIKE"
                },
                {
                  "id": "servo_projects.project_type",
                  "field": "servo_projects.project_type",
                  "type": "string",
                  "operator": "equal",
                  "value": "Query",
                  "data": {
                    "table": "servo_projects",
                    "column": "project_type",
                    "type": "text",
                    "columnObj": {
                      "type": "enum",
                      "enumValues": [
                        "Query",
                        "Transport",
                        "Work Order"
                      ],
                      "default": "",
                      "maxLength": 10,
                      "primary": false,
                      "nullable": true,
                      "name": "project_type"
                    }
                  },
                  "operation": "="
                }
              ],
              "conditional": null,
              "valid": true
            }
          }
        },
        "meta": [
          {
            "name": "offset",
            "type": "number"
          },
          {
            "name": "limit",
            "type": "number"
          },
          {
            "name": "total",
            "type": "number"
          },
          {
            "name": "page",
            "type": "object",
            "sub": [
              {
                "name": "offset",
                "type": "object",
                "sub": [
                  {
                    "name": "first",
                    "type": "number"
                  },
                  {
                    "name": "prev",
                    "type": "number"
                  },
                  {
                    "name": "next",
                    "type": "number"
                  },
                  {
                    "name": "last",
                    "type": "number"
                  }
                ]
              },
              {
                "name": "current",
                "type": "number"
              },
              {
                "name": "total",
                "type": "number"
              }
            ]
          },
          {
            "name": "data",
            "type": "array",
            "sub": [
              {
                "type": "number",
                "name": "project_id"
              },
              {
                "type": "number",
                "name": "project_user_created"
              },
              {
                "type": "text",
                "name": "user_profile"
              },
              {
                "type": "text",
                "name": "project_status"
              },
              {
                "type": "datetime",
                "name": "project_date_created"
              },
              {
                "type": "datetime",
                "name": "project_date_due"
              },
              {
                "type": "text",
                "name": "project_notes"
              },
              {
                "type": "text",
                "name": "project_code"
              },
              {
                "type": "text",
                "name": "userConcerned_fname"
              },
              {
                "type": "text",
                "name": "userConcerned_lname"
              },
              {
                "type": "text",
                "name": "userConcerned_username"
              },
              {
                "type": "text",
                "name": "user_fname"
              },
              {
                "type": "text",
                "name": "user_lname"
              },
              {
                "type": "text",
                "name": "user_username"
              },
              {
                "type": "text",
                "name": "project_type"
              }
            ]
          }
        ],
        "outputType": "object",
        "output": true,
        "type": "dbconnector_paged_select",
        "disabled": true
      }
    ]
  }
}
JSON
);
?>