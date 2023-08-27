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
        "name": "data_reading_session_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "list_data_field_readings",
      "module": "dbconnector",
      "action": "select",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [
            {
              "table": "servo_data_field_readings",
              "column": "data_field_reading_id"
            },
            {
              "table": "servo_data_field_readings",
              "column": "data_field_reading_data_field"
            },
            {
              "table": "servo_data_field_readings",
              "column": "data_field_reading_date"
            },
            {
              "table": "servo_data_field_readings",
              "column": "data_field_reading_value"
            },
            {
              "table": "servo_data_field_readings",
              "column": "data_field_reading_user"
            },
            {
              "table": "servo_data_field_readings",
              "column": "data_field_reading_note"
            },
            {
              "table": "servo_data_field_readings",
              "column": "data_reading_session_id"
            },
            {
              "table": "servo_data_fields",
              "column": "data_field_id"
            },
            {
              "table": "servo_data_fields",
              "column": "data_field_name"
            },
            {
              "table": "servo_data_fields",
              "column": "data_field_unit"
            },
            {
              "table": "servo_data_reading_session",
              "column": "data_reading_session_id"
            },
            {
              "table": "servo_user",
              "column": "user_username"
            }
          ],
          "table": {
            "name": "servo_data_field_readings"
          },
          "primary": "data_field_reading_id",
          "joins": [
            {
              "table": "servo_data_fields",
              "column": "*",
              "type": "INNER",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_data_fields",
                    "column": "data_field_id",
                    "operator": "equal",
                    "value": {
                      "table": "servo_data_field_readings",
                      "column": "data_field_reading_data_field",
                      "type": "number"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "data_field_id"
            },
            {
              "table": "servo_data_reading_session",
              "column": "*",
              "type": "INNER",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_data_reading_session",
                    "column": "data_reading_session_id",
                    "operator": "equal",
                    "value": {
                      "table": "servo_data_field_readings",
                      "column": "data_reading_session_id",
                      "type": "number"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "data_reading_session_id"
            },
            {
              "table": "servo_user",
              "column": "*",
              "type": "INNER",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_user",
                    "column": "user_id",
                    "operator": "equal",
                    "value": {
                      "table": "servo_data_field_readings",
                      "column": "data_field_reading_user"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "user_id"
            }
          ],
          "query": "SELECT servo_data_field_readings.data_field_reading_id, servo_data_field_readings.data_field_reading_data_field, servo_data_field_readings.data_field_reading_date, servo_data_field_readings.data_field_reading_value, servo_data_field_readings.data_field_reading_user, servo_data_field_readings.data_field_reading_note, servo_data_field_readings.data_reading_session_id, servo_data_fields.data_field_id, servo_data_fields.data_field_name, servo_data_fields.data_field_unit, servo_data_reading_session.data_reading_session_id, servo_user.user_username\nFROM servo_data_field_readings\nINNER JOIN servo_data_fields ON (servo_data_fields.data_field_id = servo_data_field_readings.data_field_reading_data_field) INNER JOIN servo_data_reading_session ON (servo_data_reading_session.data_reading_session_id = servo_data_field_readings.data_reading_session_id) INNER JOIN servo_user ON (servo_user.user_id = servo_data_field_readings.data_field_reading_user)\nWHERE servo_data_field_readings.data_reading_session_id = :P1 /* {{$_GET.data_reading_session_id}} */\nORDER BY servo_data_field_readings.data_field_reading_date DESC",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.data_reading_session_id}}"
            }
          ],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_data_field_readings.data_reading_session_id",
                "field": "servo_data_field_readings.data_reading_session_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.data_reading_session_id}}",
                "data": {
                  "table": "servo_data_field_readings",
                  "column": "data_reading_session_id",
                  "type": "number",
                  "columnObj": {
                    "type": "reference",
                    "primary": false,
                    "nullable": true,
                    "references": "data_reading_session_id",
                    "inTable": "servo_data_reading_session",
                    "referenceType": "integer",
                    "onUpdate": "RESTRICT",
                    "onDelete": "RESTRICT",
                    "name": "data_reading_session_id"
                  }
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          },
          "orders": [
            {
              "table": "servo_data_field_readings",
              "column": "data_field_reading_date",
              "direction": "DESC",
              "recid": 1
            }
          ]
        }
      },
      "output": true,
      "meta": [
        {
          "type": "number",
          "name": "data_field_reading_id"
        },
        {
          "type": "number",
          "name": "data_field_reading_data_field"
        },
        {
          "type": "datetime",
          "name": "data_field_reading_date"
        },
        {
          "type": "number",
          "name": "data_field_reading_value"
        },
        {
          "type": "number",
          "name": "data_field_reading_user"
        },
        {
          "type": "text",
          "name": "data_field_reading_note"
        },
        {
          "type": "number",
          "name": "data_reading_session_id"
        },
        {
          "type": "number",
          "name": "data_field_id"
        },
        {
          "type": "text",
          "name": "data_field_name"
        },
        {
          "type": "text",
          "name": "data_field_unit"
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