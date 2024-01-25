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
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "query_gugr_tasks_stats",
        "module": "dbconnector",
        "action": "select",
        "options": {
          "connection": "servodb",
          "sql": {
            "type": "select",
            "columns": [],
            "params": [],
            "table": {
              "name": "servo_project_tasks"
            },
            "primary": "task_id",
            "joins": [],
            "query": "select * from `servo_project_tasks`"
          }
        },
        "output": true,
        "meta": [
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
            "type": "number",
            "name": "task_project"
          },
          {
            "type": "number",
            "name": "task_asset"
          },
          {
            "type": "text",
            "name": "task_location_lat"
          },
          {
            "type": "text",
            "name": "task_location_lon"
          },
          {
            "type": "text",
            "name": "task_description"
          },
          {
            "type": "number",
            "name": "task_department"
          },
          {
            "type": "text",
            "name": "task_type"
          },
          {
            "type": "datetime",
            "name": "task_date_created"
          },
          {
            "type": "datetime",
            "name": "task_date_due"
          },
          {
            "type": "text",
            "name": "task_code"
          },
          {
            "type": "datetime",
            "name": "task_date_completed"
          }
        ],
        "outputType": "array"
      },
      {
        "name": "query_project_stats",
        "module": "dbconnector",
        "action": "select",
        "options": {
          "connection": "servodb",
          "sql": {
            "type": "select",
            "columns": [],
            "params": [],
            "table": {
              "name": "servo_projects"
            },
            "primary": "project_id",
            "joins": [],
            "query": "select * from `servo_projects` where `servo_projects`.`project_type` = ?",
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "servo_projects.project_type",
                  "field": "servo_projects.project_type",
                  "type": "string",
                  "operator": "equal",
                  "value": "Work Order",
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
        "output": true,
        "meta": [
          {
            "type": "number",
            "name": "project_id"
          },
          {
            "type": "datetime",
            "name": "project_start"
          },
          {
            "type": "datetime",
            "name": "project_stop"
          },
          {
            "type": "number",
            "name": "project_user_created"
          },
          {
            "type": "number",
            "name": "project_user_concerned"
          },
          {
            "type": "text",
            "name": "project_notes"
          },
          {
            "type": "text",
            "name": "project_status"
          },
          {
            "type": "number",
            "name": "project_customer"
          },
          {
            "type": "number",
            "name": "project_asset"
          },
          {
            "type": "text",
            "name": "project_location_lat"
          },
          {
            "type": "text",
            "name": "project_location_lon"
          },
          {
            "type": "text",
            "name": "project_description"
          },
          {
            "type": "number",
            "name": "project_department"
          },
          {
            "type": "text",
            "name": "project_type"
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
            "name": "project_code"
          }
        ],
        "outputType": "array"
      },
      {
        "name": "query_query_stats_copy",
        "module": "dbconnector",
        "action": "select",
        "options": {
          "connection": "servodb",
          "sql": {
            "type": "select",
            "columns": [],
            "params": [],
            "table": {
              "name": "servo_projects"
            },
            "primary": "project_id",
            "joins": [],
            "query": "select * from `servo_projects` where `servo_projects`.`project_type` = ?",
            "wheres": {
              "condition": "AND",
              "rules": [
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
        "output": true,
        "meta": [
          {
            "type": "number",
            "name": "project_id"
          },
          {
            "type": "datetime",
            "name": "project_start"
          },
          {
            "type": "datetime",
            "name": "project_stop"
          },
          {
            "type": "number",
            "name": "project_user_created"
          },
          {
            "type": "number",
            "name": "project_user_concerned"
          },
          {
            "type": "text",
            "name": "project_notes"
          },
          {
            "type": "text",
            "name": "project_status"
          },
          {
            "type": "number",
            "name": "project_customer"
          },
          {
            "type": "number",
            "name": "project_asset"
          },
          {
            "type": "text",
            "name": "project_location_lat"
          },
          {
            "type": "text",
            "name": "project_location_lon"
          },
          {
            "type": "text",
            "name": "project_description"
          },
          {
            "type": "number",
            "name": "project_department"
          },
          {
            "type": "text",
            "name": "project_type"
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
            "name": "project_code"
          }
        ],
        "outputType": "array"
      }
    ]
  }
}
JSON
);
?>