<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "data_field_reading_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query",
      "module": "dbconnector",
      "action": "single",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [],
          "table": {
            "name": "servo_data_field_readings"
          },
          "primary": "data_field_reading_id",
          "joins": [],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_data_field_readings.data_field_reading_id",
                "field": "servo_data_field_readings.data_field_reading_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.data_field_reading_id}}",
                "data": {
                  "table": "servo_data_field_readings",
                  "column": "data_field_reading_id",
                  "type": "number",
                  "columnObj": {
                    "type": "increments",
                    "primary": true,
                    "nullable": false,
                    "name": "data_field_reading_id"
                  }
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          },
          "query": "SELECT *\nFROM servo_data_field_readings\nWHERE data_field_reading_id = :P1 /* {{$_GET.data_field_reading_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.data_field_reading_id}}"
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
        }
      ],
      "outputType": "object"
    }
  }
}
JSON
);
?>