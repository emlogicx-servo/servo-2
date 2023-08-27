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
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "create_data_reading_session",
        "module": "dbupdater",
        "action": "insert",
        "options": {
          "connection": "servodb",
          "sql": {
            "type": "insert",
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
            "returning": "data_reading_session_id",
            "query": "INSERT INTO servo_data_reading_session\n(data_reading_session_date, data_reading_session_user, data_reading_session_customer, data_reading_session_notes, data_reading_session_asset) VALUES (:P1 /* {{$_POST.data_reading_session_date}} */, :P2 /* {{$_POST.data_reading_session_user}} */, :P3 /* {{$_POST.data_reading_session_customer}} */, :P4 /* {{$_POST.data_reading_session_notes}} */, :P5 /* {{$_POST.data_reading_session_asset}} */)",
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
      },
      {
        "name": "custom",
        "module": "dbupdater",
        "action": "custom",
        "options": {
          "connection": "servodb",
          "sql": {
            "query": "SELECT last_insert_id()",
            "params": []
          }
        },
        "output": true,
        "meta": [
          {
            "name": "last_insert_id()",
            "type": "number"
          }
        ],
        "outputType": "array"
      },
      {
        "name": "current_data_reading_session",
        "module": "core",
        "action": "setvalue",
        "options": {
          "value": "{{custom[0]['last_insert_id()']}}",
          "key": "current_data_reading_session"
        },
        "meta": [],
        "outputType": "number"
      }
    ]
  }
}
JSON
);
?>