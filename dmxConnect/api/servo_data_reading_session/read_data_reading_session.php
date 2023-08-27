<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "data_reading_session_id"
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
      "name": "query_read_data_reading_session",
      "module": "dbconnector",
      "action": "single",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [],
          "table": {
            "name": "servo_data_reading_session"
          },
          "primary": "data_reading_session_id",
          "joins": [],
          "query": "SELECT *\nFROM servo_data_reading_session\nWHERE data_reading_session_id = :P1 /* {{$_GET.data_reading_session_id}} */",
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
                "id": "servo_data_reading_session.data_reading_session_id",
                "field": "servo_data_reading_session.data_reading_session_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.data_reading_session_id}}",
                "data": {
                  "table": "servo_data_reading_session",
                  "column": "data_reading_session_id",
                  "type": "number",
                  "columnObj": {
                    "type": "increments",
                    "primary": true,
                    "nullable": false,
                    "name": "data_reading_session_id"
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
          "type": "number",
          "name": "data_reading_session_id"
        },
        {
          "type": "datetime",
          "name": "data_reading_session_date"
        },
        {
          "type": "number",
          "name": "data_reading_session_user"
        },
        {
          "type": "number",
          "name": "data_reading_session_customer"
        },
        {
          "type": "text",
          "name": "data_reading_session_notes"
        },
        {
          "type": "number",
          "name": "data_reading_session_asset"
        }
      ],
      "outputType": "object",
      "output": true
    }
  }
}
JSON
);
?>