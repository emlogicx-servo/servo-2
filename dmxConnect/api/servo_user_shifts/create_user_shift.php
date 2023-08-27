<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "datetime",
        "name": "time_checkin"
      },
      {
        "type": "datetime",
        "name": "time_checkout"
      },
      {
        "type": "number",
        "name": "balance_checkin"
      },
      {
        "type": "number",
        "name": "balance_checkout"
      },
      {
        "type": "number",
        "name": "servo_user_user_id"
      },
      {
        "type": "number",
        "name": "servo_shifts_shift_id"
      },
      {
        "type": "text",
        "name": "user_shift_notes"
      },
      {
        "type": "text",
        "name": "user_shift_code"
      },
      {
        "type": "text",
        "name": "assigned"
      },
      {
        "type": "number",
        "name": "servo_service_service_id"
      },
      {
        "type": "number",
        "name": "servo_sales_point_sales_point_id"
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "validate_single_user_shift",
        "module": "validator",
        "action": "validate",
        "options": {
          "data": [
            {
              "name": "validate_1",
              "value": "{{$_POST.user_shift_code}}",
              "rules": {
                "db:notexists": {
                  "param": {
                    "connection": "servodb",
                    "table": "servo_user_shifts",
                    "column": "user_shift_code"
                  },
                  "message": "Already Taken"
                }
              },
              "fieldName": "user_shift_code"
            }
          ]
        }
      },
      {
        "name": "insert_create_user_shift",
        "module": "dbupdater",
        "action": "insert",
        "options": {
          "connection": "servodb",
          "sql": {
            "type": "insert",
            "values": [
              {
                "table": "servo_user_shifts",
                "column": "time_checkin",
                "type": "datetime",
                "value": "{{$_POST.time_checkin}}"
              },
              {
                "table": "servo_user_shifts",
                "column": "time_checkout",
                "type": "datetime",
                "value": "{{$_POST.time_checkout}}"
              },
              {
                "table": "servo_user_shifts",
                "column": "balance_checkin",
                "type": "number",
                "value": "{{$_POST.balance_checkin}}"
              },
              {
                "table": "servo_user_shifts",
                "column": "balance_checkout",
                "type": "number",
                "value": "{{$_POST.balance_checkout}}"
              },
              {
                "table": "servo_user_shifts",
                "column": "servo_user_user_id",
                "type": "number",
                "value": "{{$_POST.servo_user_user_id}}"
              },
              {
                "table": "servo_user_shifts",
                "column": "servo_shifts_shift_id",
                "type": "number",
                "value": "{{$_POST.servo_shifts_shift_id}}"
              },
              {
                "table": "servo_user_shifts",
                "column": "user_shift_notes",
                "type": "text",
                "value": "{{$_POST.user_shift_notes}}"
              },
              {
                "table": "servo_user_shifts",
                "column": "user_shift_code",
                "type": "text",
                "value": "{{$_POST.user_shift_code}}"
              },
              {
                "table": "servo_user_shifts",
                "column": "assigned",
                "type": "text",
                "value": "{{$_POST.assigned}}"
              },
              {
                "table": "servo_user_shifts",
                "column": "servo_service_service_id",
                "type": "number",
                "value": "{{$_POST.servo_service_service_id}}"
              },
              {
                "table": "servo_user_shifts",
                "column": "servo_sales_point_sales_point_id",
                "type": "number",
                "value": "{{$_POST.servo_sales_point_sales_point_id}}"
              }
            ],
            "table": "servo_user_shifts",
            "returning": "user_shift_id",
            "query": "INSERT INTO servo_user_shifts\n(time_checkin, time_checkout, balance_checkin, balance_checkout, servo_user_user_id, servo_shifts_shift_id, user_shift_notes, user_shift_code, assigned, servo_service_service_id, servo_sales_point_sales_point_id) VALUES (:P1 /* {{$_POST.time_checkin}} */, :P2 /* {{$_POST.time_checkout}} */, :P3 /* {{$_POST.balance_checkin}} */, :P4 /* {{$_POST.balance_checkout}} */, :P5 /* {{$_POST.servo_user_user_id}} */, :P6 /* {{$_POST.servo_shifts_shift_id}} */, :P7 /* {{$_POST.user_shift_notes}} */, :P8 /* {{$_POST.user_shift_code}} */, :P9 /* {{$_POST.assigned}} */, :P10 /* {{$_POST.servo_service_service_id}} */, :P11 /* {{$_POST.servo_sales_point_sales_point_id}} */)",
            "params": [
              {
                "name": ":P1",
                "type": "expression",
                "value": "{{$_POST.time_checkin}}"
              },
              {
                "name": ":P2",
                "type": "expression",
                "value": "{{$_POST.time_checkout}}"
              },
              {
                "name": ":P3",
                "type": "expression",
                "value": "{{$_POST.balance_checkin}}"
              },
              {
                "name": ":P4",
                "type": "expression",
                "value": "{{$_POST.balance_checkout}}"
              },
              {
                "name": ":P5",
                "type": "expression",
                "value": "{{$_POST.servo_user_user_id}}"
              },
              {
                "name": ":P6",
                "type": "expression",
                "value": "{{$_POST.servo_shifts_shift_id}}"
              },
              {
                "name": ":P7",
                "type": "expression",
                "value": "{{$_POST.user_shift_notes}}"
              },
              {
                "name": ":P8",
                "type": "expression",
                "value": "{{$_POST.user_shift_code}}"
              },
              {
                "name": ":P9",
                "type": "expression",
                "value": "{{$_POST.assigned}}"
              },
              {
                "name": ":P10",
                "type": "expression",
                "value": "{{$_POST.servo_service_service_id}}"
              },
              {
                "name": ":P11",
                "type": "expression",
                "value": "{{$_POST.servo_sales_point_sales_point_id}}"
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
        ],
        "output": true
      }
    ]
  }
}
JSON
);
?>