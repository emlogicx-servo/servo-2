<?php
require('../../../dmxConnectLib/dmxConnect.php');


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
        "name": "customer_id"
      },
      {
        "type": "text",
        "name": "po_id"
      },
      {
        "type": "text",
        "name": "asset_id"
      },
      {
        "type": "text",
        "name": "project_id"
      },
      {
        "type": "text",
        "name": "project_task_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_list_files",
      "module": "dbconnector",
      "action": "select",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [
            {
              "table": "servo_files",
              "column": "file_id"
            },
            {
              "table": "servo_files",
              "column": "file_customer_id"
            },
            {
              "table": "servo_files",
              "column": "file_asset_id"
            },
            {
              "table": "servo_files",
              "column": "file_order_id"
            },
            {
              "table": "servo_files",
              "column": "file_transaction_id"
            },
            {
              "table": "servo_files",
              "column": "file_name"
            },
            {
              "table": "servo_files",
              "column": "file_user_created"
            },
            {
              "table": "servo_files",
              "column": "file_date_created"
            },
            {
              "table": "servo_files",
              "column": "file_description"
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
            }
          ],
          "table": {
            "name": "servo_files"
          },
          "primary": "file_id",
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
                      "table": "servo_files",
                      "column": "file_user_created"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "user_id"
            }
          ],
          "query": "select `servo_files`.`file_id`, `servo_files`.`file_customer_id`, `servo_files`.`file_asset_id`, `servo_files`.`file_order_id`, `servo_files`.`file_transaction_id`, `servo_files`.`file_name`, `servo_files`.`file_user_created`, `servo_files`.`file_date_created`, `servo_files`.`file_description`, `servo_user`.`user_fname`, `servo_user`.`user_lname`, `servo_user`.`user_username` from `servo_files` left join `servo_user` on `servo_user`.`user_id` = `servo_files`.`file_user_created` where (`servo_files`.`file_customer_id` = ?) and (`servo_files`.`file_po_id` = ?) and (`servo_files`.`file_asset_id` = ?) and (`servo_files`.`file_project_id` = ?) and (`servo_files`.`file_project_task_id` = ?)",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.customer_id}}",
              "test": ""
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P2",
              "value": "{{$_GET.po_id}}",
              "test": ""
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P3",
              "value": "{{$_GET.asset_id}}",
              "test": ""
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P4",
              "value": "{{$_GET.project_id}}",
              "test": ""
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P5",
              "value": "{{$_GET.project_task_id}}",
              "test": ""
            }
          ],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "condition": "AND",
                "rules": [
                  {
                    "id": "servo_files.file_customer_id",
                    "field": "servo_files.file_customer_id",
                    "type": "double",
                    "operator": "equal",
                    "value": "{{$_GET.customer_id}}",
                    "data": {
                      "table": "servo_files",
                      "column": "file_customer_id",
                      "type": "number",
                      "columnObj": {
                        "type": "integer",
                        "default": "",
                        "primary": false,
                        "nullable": true,
                        "name": "file_customer_id"
                      }
                    },
                    "operation": "="
                  }
                ],
                "conditional": "{{$_GET.customer_id}}"
              },
              {
                "condition": "AND",
                "rules": [
                  {
                    "id": "servo_files.file_po_id",
                    "field": "servo_files.file_po_id",
                    "type": "double",
                    "operator": "equal",
                    "value": "{{$_GET.po_id}}",
                    "data": {
                      "table": "servo_files",
                      "column": "file_po_id",
                      "type": "number",
                      "columnObj": {
                        "type": "integer",
                        "default": "",
                        "primary": false,
                        "nullable": true,
                        "name": "file_po_id"
                      }
                    },
                    "operation": "="
                  }
                ],
                "conditional": "{{$_GET.po_id}}"
              },
              {
                "condition": "AND",
                "rules": [
                  {
                    "id": "servo_files.file_asset_id",
                    "field": "servo_files.file_asset_id",
                    "type": "double",
                    "operator": "equal",
                    "value": "{{$_GET.asset_id}}",
                    "data": {
                      "table": "servo_files",
                      "column": "file_asset_id",
                      "type": "number",
                      "columnObj": {
                        "type": "integer",
                        "default": "",
                        "primary": false,
                        "nullable": true,
                        "name": "file_asset_id"
                      }
                    },
                    "operation": "="
                  }
                ],
                "conditional": "{{$_GET.asset_id}}"
              },
              {
                "condition": "AND",
                "rules": [
                  {
                    "id": "servo_files.file_project_id",
                    "field": "servo_files.file_project_id",
                    "type": "double",
                    "operator": "equal",
                    "value": "{{$_GET.project_id}}",
                    "data": {
                      "table": "servo_files",
                      "column": "file_project_id",
                      "type": "number",
                      "columnObj": {
                        "type": "integer",
                        "primary": false,
                        "nullable": false,
                        "name": "file_project_id"
                      }
                    },
                    "operation": "="
                  }
                ],
                "conditional": "{{$_GET.project_id}}"
              },
              {
                "condition": "AND",
                "rules": [
                  {
                    "id": "servo_files.file_project_task_id",
                    "field": "servo_files.file_project_task_id",
                    "type": "double",
                    "operator": "equal",
                    "value": "{{$_GET.project_task_id}}",
                    "data": {
                      "table": "servo_files",
                      "column": "file_project_task_id",
                      "type": "number",
                      "columnObj": {
                        "type": "integer",
                        "default": "",
                        "primary": false,
                        "nullable": true,
                        "name": "file_project_task_id"
                      }
                    },
                    "operation": "="
                  }
                ],
                "conditional": null
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
          "name": "file_id"
        },
        {
          "type": "number",
          "name": "file_customer_id"
        },
        {
          "type": "number",
          "name": "file_asset_id"
        },
        {
          "type": "number",
          "name": "file_order_id"
        },
        {
          "type": "number",
          "name": "file_transaction_id"
        },
        {
          "type": "text",
          "name": "file_name"
        },
        {
          "type": "number",
          "name": "file_user_created"
        },
        {
          "type": "datetime",
          "name": "file_date_created"
        },
        {
          "type": "text",
          "name": "file_description"
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
        }
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>