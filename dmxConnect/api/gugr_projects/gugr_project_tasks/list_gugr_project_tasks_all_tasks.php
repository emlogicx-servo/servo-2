<?php
require('../../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "offset"
      },
      {
        "type": "text",
        "name": "limit"
      },
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
        "name": "user_concerned"
      },
      {
        "type": "text",
        "name": "task_status"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "list_project_tasks_paged",
      "module": "dbconnector",
      "action": "paged",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "select",
          "columns": [
            {
              "table": "servo_project_tasks",
              "column": "task_id"
            },
            {
              "table": "servo_project_tasks",
              "column": "task_start"
            },
            {
              "table": "servo_project_tasks",
              "column": "task_stop"
            },
            {
              "table": "servo_project_tasks",
              "column": "task_user_created"
            },
            {
              "table": "servo_project_tasks",
              "column": "task_user_concerned"
            },
            {
              "table": "servo_project_tasks",
              "column": "task_notes"
            },
            {
              "table": "servo_project_tasks",
              "column": "task_status"
            },
            {
              "table": "servo_project_tasks",
              "column": "task_date_created"
            },
            {
              "table": "userCreated",
              "column": "user_id",
              "alias": "userCreatedID"
            },
            {
              "table": "userCreated",
              "column": "user_username",
              "alias": "userCratedName"
            },
            {
              "table": "userConcerned",
              "column": "user_id",
              "alias": "userConcernedID"
            },
            {
              "table": "userConcerned",
              "column": "user_username",
              "alias": "userConcernedName"
            },
            {
              "table": "servo_project_tasks",
              "column": "task_description"
            },
            {
              "table": "servo_project_tasks",
              "column": "task_date_completed"
            }
          ],
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.task_status}}",
              "test": ""
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P2",
              "value": "{{$_GET.user_concerned}}",
              "test": ""
            }
          ],
          "table": {
            "name": "servo_project_tasks"
          },
          "primary": "task_id",
          "joins": [
            {
              "table": "servo_user",
              "column": "*",
              "alias": "userCreated",
              "type": "LEFT",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "userCreated",
                    "column": "user_id",
                    "operator": "equal",
                    "operation": "=",
                    "value": {
                      "table": "servo_project_tasks",
                      "column": "task_user_created"
                    }
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
                    "operation": "=",
                    "value": {
                      "table": "servo_project_tasks",
                      "column": "task_user_concerned"
                    }
                  }
                ]
              },
              "primary": "user_id"
            }
          ],
          "query": "select `servo_project_tasks`.`task_id`, `servo_project_tasks`.`task_start`, `servo_project_tasks`.`task_stop`, `servo_project_tasks`.`task_user_created`, `servo_project_tasks`.`task_user_concerned`, `servo_project_tasks`.`task_notes`, `servo_project_tasks`.`task_status`, `servo_project_tasks`.`task_date_created`, `userCreated`.`user_id` as `userCreatedID`, `userCreated`.`user_username` as `userCratedName`, `userConcerned`.`user_id` as `userConcernedID`, `userConcerned`.`user_username` as `userConcernedName`, `servo_project_tasks`.`task_description`, `servo_project_tasks`.`task_date_completed` from `servo_project_tasks` left join `servo_user` as `userCreated` on `userCreated`.`user_id` = `servo_project_tasks`.`task_user_created` left join `servo_user` as `userConcerned` on `userConcerned`.`user_id` = `servo_project_tasks`.`task_user_concerned` where (`servo_project_tasks`.`task_status` = ?) and (`servo_project_tasks`.`task_user_concerned` = ?) order by `servo_project_tasks`.`task_date_created` DESC, `servo_project_tasks`.`task_status` ASC",
          "orders": [
            {
              "table": "servo_project_tasks",
              "column": "task_date_created",
              "direction": "DESC",
              "recid": 1
            },
            {
              "table": "servo_project_tasks",
              "column": "task_status",
              "direction": "ASC",
              "recid": 2
            }
          ],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "condition": "AND",
                "rules": [
                  {
                    "id": "servo_project_tasks.task_status",
                    "field": "servo_project_tasks.task_status",
                    "type": "string",
                    "operator": "equal",
                    "value": "{{$_GET.task_status}}",
                    "data": {
                      "table": "servo_project_tasks",
                      "column": "task_status",
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
                        "name": "task_status"
                      }
                    },
                    "operation": "="
                  }
                ],
                "conditional": "{{$_GET.task_status}}"
              },
              {
                "condition": "AND",
                "rules": [
                  {
                    "id": "servo_project_tasks.task_user_concerned",
                    "field": "servo_project_tasks.task_user_concerned",
                    "type": "double",
                    "operator": "equal",
                    "value": "{{$_GET.user_concerned}}",
                    "data": {
                      "table": "servo_project_tasks",
                      "column": "task_user_concerned",
                      "type": "number",
                      "columnObj": {
                        "type": "reference",
                        "default": "",
                        "primary": false,
                        "nullable": true,
                        "references": "user_id",
                        "inTable": "servo_user",
                        "referenceType": "integer",
                        "onUpdate": "RESTRICT",
                        "onDelete": "RESTRICT",
                        "name": "task_user_concerned"
                      }
                    },
                    "operation": "="
                  }
                ],
                "conditional": "{{$_GET.user_concerned}}"
              }
            ],
            "conditional": "{{$_GET.user_concerned}}",
            "valid": true
          }
        }
      },
      "output": true,
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
              "name": "task_id"
            },
            {
              "type": "datetime",
              "name": "task_start"
            },
            {
              "type": "datetime",
              "name": "task_stop"
            },
            {
              "type": "number",
              "name": "task_user_created"
            },
            {
              "type": "number",
              "name": "task_user_concerned"
            },
            {
              "type": "text",
              "name": "task_notes"
            },
            {
              "type": "text",
              "name": "task_status"
            },
            {
              "type": "datetime",
              "name": "task_date_created"
            },
            {
              "type": "number",
              "name": "userCreatedID"
            },
            {
              "type": "text",
              "name": "userCratedName"
            },
            {
              "type": "number",
              "name": "userConcernedID"
            },
            {
              "type": "text",
              "name": "userConcernedName"
            },
            {
              "type": "text",
              "name": "task_description"
            },
            {
              "type": "datetime",
              "name": "task_date_completed"
            }
          ]
        }
      ],
      "outputType": "object"
    }
  }
}
JSON
);
?>