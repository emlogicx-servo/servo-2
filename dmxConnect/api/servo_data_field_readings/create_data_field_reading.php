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
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "create_data_field_reading",
      "module": "dbupdater",
      "action": "insert",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "insert",
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
          "returning": "data_field_reading_id",
          "query": "INSERT INTO servo_data_field_readings\n(data_field_reading_data_field, data_field_reading_date, data_field_reading_value, data_field_reading_user, data_field_reading_note, data_reading_session_id) VALUES (:P1 /* {{$_POST.data_field_reading_data_field}} */, :P2 /* {{$_POST.data_field_reading_date}} */, :P3 /* {{$_POST.data_field_reading_value}} */, :P4 /* {{$_POST.data_field_reading_user}} */, :P5 /* {{$_POST.data_field_reading_note}} */, :P6 /* {{$_POST.data_reading_session_id}} */)",
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
            }
          ]
        }
      },
      "meta": [
        {
          "name": "identity",
          "type": "text"
        },
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