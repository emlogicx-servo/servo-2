<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
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
        "name": "data_field_reading_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "update_data_field_reading",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "update",
          "values": [
            {
              "table": "servo_data_field_readings",
              "column": "data_field_reading_data_field",
              "type": "number",
              "value": "{{$_POST.data_field_reading_data_field}}"
            },
            {
              "table": "servo_data_field_readings",
              "column": "data_field_reading_date",
              "type": "datetime",
              "value": "{{$_POST.data_field_reading_date}}"
            },
            {
              "table": "servo_data_field_readings",
              "column": "data_field_reading_value",
              "type": "number",
              "value": "{{$_POST.data_field_reading_value}}"
            },
            {
              "table": "servo_data_field_readings",
              "column": "data_field_reading_user",
              "type": "number",
              "value": "{{$_POST.data_field_reading_user}}"
            },
            {
              "table": "servo_data_field_readings",
              "column": "data_field_reading_note",
              "type": "text",
              "value": "{{$_POST.data_field_reading_note}}"
            },
            {
              "table": "servo_data_field_readings",
              "column": "data_reading_session_id",
              "type": "number",
              "value": "{{$_POST.data_reading_session_id}}"
            }
          ],
          "table": "servo_data_field_readings",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "data_field_reading_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.data_field_reading_id}}",
                "data": {
                  "column": "data_field_reading_id"
                },
                "operation": "="
              }
            ]
          },
          "returning": "data_field_reading_id",
          "query": "UPDATE servo_data_field_readings\nSET data_field_reading_data_field = :P1 /* {{$_POST.data_field_reading_data_field}} */, data_field_reading_date = :P2 /* {{$_POST.data_field_reading_date}} */, data_field_reading_value = :P3 /* {{$_POST.data_field_reading_value}} */, data_field_reading_user = :P4 /* {{$_POST.data_field_reading_user}} */, data_field_reading_note = :P5 /* {{$_POST.data_field_reading_note}} */, data_reading_session_id = :P6 /* {{$_POST.data_reading_session_id}} */\nWHERE data_field_reading_id = :P7 /* {{$_POST.data_field_reading_id}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.data_field_reading_data_field}}"
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.data_field_reading_date}}"
            },
            {
              "name": ":P3",
              "type": "expression",
              "value": "{{$_POST.data_field_reading_value}}"
            },
            {
              "name": ":P4",
              "type": "expression",
              "value": "{{$_POST.data_field_reading_user}}"
            },
            {
              "name": ":P5",
              "type": "expression",
              "value": "{{$_POST.data_field_reading_note}}"
            },
            {
              "name": ":P6",
              "type": "expression",
              "value": "{{$_POST.data_reading_session_id}}"
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P7",
              "value": "{{$_POST.data_field_reading_id}}"
            }
          ]
        }
      },
      "meta": [
        {
          "name": "affected",
          "type": "number"
        }
      ]
    }
  }
}
JSON
);
?>