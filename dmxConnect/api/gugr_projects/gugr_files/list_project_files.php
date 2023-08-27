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
        "name": "project_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_list_project_files",
      "module": "dbconnector",
      "action": "select",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [
            {
              "table": "servo_project_files",
              "column": "project_file_id"
            },
            {
              "table": "servo_project_files",
              "column": "project_file"
            },
            {
              "table": "servo_project_files",
              "column": "project_file_type"
            },
            {
              "table": "servo_project_files",
              "column": "project_file_description"
            },
            {
              "table": "servo_project_files",
              "column": "project_file_creator"
            },
            {
              "table": "servo_project_files",
              "column": "project_file_date_created"
            },
            {
              "table": "servo_project_files",
              "column": "project_file_status"
            },
            {
              "table": "servo_project_files",
              "column": "project_file_project_id"
            },
            {
              "table": "servo_user",
              "column": "user_username"
            }
          ],
          "table": {
            "name": "servo_project_files"
          },
          "primary": "project_file_id",
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
                      "table": "servo_project_files",
                      "column": "project_file_creator"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "user_id"
            }
          ],
          "query": "SELECT servo_project_files.project_file_id, servo_project_files.project_file, servo_project_files.project_file_type, servo_project_files.project_file_description, servo_project_files.project_file_creator, servo_project_files.project_file_date_created, servo_project_files.project_file_status, servo_project_files.project_file_project_id, servo_user.user_username\nFROM servo_project_files\nLEFT JOIN servo_user ON servo_user.user_id = servo_project_files.project_file_creator\nWHERE servo_project_files.project_file_project_id = :P1 /* {{$_GET.project_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.project_id}}",
              "test": ""
            }
          ],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_project_files.project_file_project_id",
                "field": "servo_project_files.project_file_project_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.project_id}}",
                "data": {
                  "table": "servo_project_files",
                  "column": "project_file_project_id",
                  "type": "number",
                  "columnObj": {
                    "type": "reference",
                    "primary": false,
                    "nullable": false,
                    "references": "project_id",
                    "inTable": "servo_projects",
                    "referenceType": "integer",
                    "onUpdate": "RESTRICT",
                    "onDelete": "RESTRICT",
                    "name": "project_file_project_id"
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
          "name": "project_file_id"
        },
        {
          "type": "text",
          "name": "project_file"
        },
        {
          "type": "text",
          "name": "project_file_type"
        },
        {
          "type": "text",
          "name": "project_file_description"
        },
        {
          "type": "number",
          "name": "project_file_creator"
        },
        {
          "type": "datetime",
          "name": "project_file_date_created"
        },
        {
          "type": "text",
          "name": "project_file_status"
        },
        {
          "type": "number",
          "name": "project_file_project_id"
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