<?php
require('../../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "project_id"
      },
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
    "steps": {
      "name": "query_list_project_notes",
      "module": "dbconnector",
      "action": "select",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [
            {
              "table": "servo_project_notes",
              "column": "project_note_id"
            },
            {
              "table": "servo_project_notes",
              "column": "project_note"
            },
            {
              "table": "servo_project_notes",
              "column": "project_note_user_created"
            },
            {
              "table": "servo_project_notes",
              "column": "date_created"
            },
            {
              "table": "servo_project_notes",
              "column": "project_note_project_id"
            },
            {
              "table": "servo_user",
              "column": "user_username"
            },
            {
              "table": "servo_user",
              "column": "user_fname"
            },
            {
              "table": "servo_user",
              "column": "user_lname"
            }
          ],
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.project_id}}",
              "test": "149"
            }
          ],
          "table": {
            "name": "servo_project_notes"
          },
          "primary": "project_note_id",
          "joins": [
            {
              "table": "servo_projects",
              "column": "*",
              "type": "LEFT",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_projects",
                    "column": "project_id",
                    "operator": "equal",
                    "value": {
                      "table": "servo_project_notes",
                      "column": "project_note_project_id"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "project_id"
            },
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
                      "table": "servo_project_notes",
                      "column": "project_note_user_created"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "user_id"
            }
          ],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_project_notes.project_note_project_id",
                "field": "servo_project_notes.project_note_project_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.project_id}}",
                "data": {
                  "table": "servo_project_notes",
                  "column": "project_note_project_id",
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
                    "name": "project_note_project_id"
                  }
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          },
          "query": "SELECT servo_project_notes.project_note_id, servo_project_notes.project_note, servo_project_notes.project_note_user_created, servo_project_notes.date_created, servo_project_notes.project_note_project_id, servo_user.user_username, servo_user.user_fname, servo_user.user_lname\nFROM servo_project_notes\nLEFT JOIN servo_projects ON servo_projects.project_id = servo_project_notes.project_note_project_id LEFT JOIN servo_user ON servo_user.user_id = servo_project_notes.project_note_user_created\nWHERE servo_project_notes.project_note_project_id = :P1 /* {{$_GET.project_id}} */\nORDER BY servo_project_notes.project_note_id DESC",
          "orders": [
            {
              "table": "servo_project_notes",
              "column": "project_note_id",
              "direction": "DESC"
            }
          ]
        }
      },
      "output": true,
      "meta": [
        {
          "type": "number",
          "name": "project_note_id"
        },
        {
          "type": "text",
          "name": "project_note"
        },
        {
          "type": "number",
          "name": "project_note_user_created"
        },
        {
          "type": "datetime",
          "name": "date_created"
        },
        {
          "type": "number",
          "name": "project_note_project_id"
        },
        {
          "type": "text",
          "name": "user_username"
        },
        {
          "type": "text",
          "name": "user_fname"
        },
        {
          "type": "text",
          "name": "user_lname"
        }
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>