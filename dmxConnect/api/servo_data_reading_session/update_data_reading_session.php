<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
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
      },
      {
        "type": "number",
        "name": "data_reading_session_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "update_data_reading_session",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "update",
          "values": [
            {
              "table": "servo_data_reading_session",
              "column": "data_reading_session_date",
              "type": "datetime",
              "value": "{{$_POST.data_reading_session_date}}"
            },
            {
              "table": "servo_data_reading_session",
              "column": "data_reading_session_user",
              "type": "number",
              "value": "{{$_POST.data_reading_session_user}}"
            },
            {
              "table": "servo_data_reading_session",
              "column": "data_reading_session_customer",
              "type": "number",
              "value": "{{$_POST.data_reading_session_customer}}"
            },
            {
              "table": "servo_data_reading_session",
              "column": "data_reading_session_notes",
              "type": "text",
              "value": "{{$_POST.data_reading_session_notes}}"
            },
            {
              "table": "servo_data_reading_session",
              "column": "data_reading_session_asset",
              "type": "number",
              "value": "{{$_POST.data_reading_session_asset}}"
            }
          ],
          "table": "servo_data_reading_session",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "data_reading_session_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.data_reading_session_id}}",
                "data": {
                  "column": "data_reading_session_id"
                },
                "operation": "="
              }
            ]
          },
          "returning": "data_reading_session_id",
          "query": "UPDATE servo_data_reading_session\nSET data_reading_session_date = :P1 /* {{$_POST.data_reading_session_date}} */, data_reading_session_user = :P2 /* {{$_POST.data_reading_session_user}} */, data_reading_session_customer = :P3 /* {{$_POST.data_reading_session_customer}} */, data_reading_session_notes = :P4 /* {{$_POST.data_reading_session_notes}} */, data_reading_session_asset = :P5 /* {{$_POST.data_reading_session_asset}} */\nWHERE data_reading_session_id = :P6 /* {{$_POST.data_reading_session_id}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.data_reading_session_date}}"
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.data_reading_session_user}}"
            },
            {
              "name": ":P3",
              "type": "expression",
              "value": "{{$_POST.data_reading_session_customer}}"
            },
            {
              "name": ":P4",
              "type": "expression",
              "value": "{{$_POST.data_reading_session_notes}}"
            },
            {
              "name": ":P5",
              "type": "expression",
              "value": "{{$_POST.data_reading_session_asset}}"
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P6",
              "value": "{{$_POST.data_reading_session_id}}"
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