<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "number",
        "name": "expense_amount"
      },
      {
        "type": "datetime",
        "name": "expense_date_requested"
      },
      {
        "type": "datetime",
        "name": "expense_date_paid"
      },
      {
        "type": "number",
        "name": "expense_user_paid"
      },
      {
        "type": "number",
        "name": "expense_user_received"
      },
      {
        "type": "text",
        "name": "expense_description"
      },
      {
        "type": "text",
        "name": "expense_status"
      },
      {
        "type": "text",
        "name": "expense_type"
      },
      {
        "type": "number",
        "name": "expense_department"
      },
      {
        "type": "number",
        "name": "expense_shift"
      },
      {
        "type": "number",
        "name": "expense_payment_method"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "create_expense",
      "module": "dbupdater",
      "action": "insert",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "insert",
          "values": [
            {
              "table": "servo_expenses",
              "column": "expense_amount",
              "type": "number",
              "value": "{{$_POST.expense_amount}}"
            },
            {
              "table": "servo_expenses",
              "column": "expense_date_requested",
              "type": "datetime",
              "value": "{{$_POST.expense_date_requested}}"
            },
            {
              "table": "servo_expenses",
              "column": "expense_date_paid",
              "type": "datetime",
              "value": "{{$_POST.expense_date_paid}}"
            },
            {
              "table": "servo_expenses",
              "column": "expense_user_paid",
              "type": "number",
              "value": "{{$_POST.expense_user_paid}}"
            },
            {
              "table": "servo_expenses",
              "column": "expense_user_received",
              "type": "number",
              "value": "{{$_POST.expense_user_received}}"
            },
            {
              "table": "servo_expenses",
              "column": "expense_description",
              "type": "text",
              "value": "{{$_POST.expense_description}}"
            },
            {
              "table": "servo_expenses",
              "column": "expense_status",
              "type": "text",
              "value": "{{$_POST.expense_status}}"
            },
            {
              "table": "servo_expenses",
              "column": "expense_type",
              "type": "text",
              "value": "{{$_POST.expense_type}}"
            },
            {
              "table": "servo_expenses",
              "column": "expense_department",
              "type": "number",
              "value": "{{$_POST.expense_department}}"
            },
            {
              "table": "servo_expenses",
              "column": "expense_shift",
              "type": "number",
              "value": "{{$_POST.expense_shift.default(null)}}"
            },
            {
              "table": "servo_expenses",
              "column": "expense_payment_method",
              "type": "number",
              "value": "{{$_POST.expense_payment_method}}"
            }
          ],
          "table": "servo_expenses",
          "returning": "expense_id",
          "query": "INSERT INTO servo_expenses\n(expense_amount, expense_date_requested, expense_date_paid, expense_user_paid, expense_user_received, expense_description, expense_status, expense_type, expense_department, expense_shift, expense_payment_method) VALUES (:P1 /* {{$_POST.expense_amount}} */, :P2 /* {{$_POST.expense_date_requested}} */, :P3 /* {{$_POST.expense_date_paid}} */, :P4 /* {{$_POST.expense_user_paid}} */, :P5 /* {{$_POST.expense_user_received}} */, :P6 /* {{$_POST.expense_description}} */, :P7 /* {{$_POST.expense_status}} */, :P8 /* {{$_POST.expense_type}} */, :P9 /* {{$_POST.expense_department}} */, :P10 /* {{$_POST.expense_shift.default(null)}} */, :P11 /* {{$_POST.expense_payment_method}} */)",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.expense_amount}}"
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.expense_date_requested}}"
            },
            {
              "name": ":P3",
              "type": "expression",
              "value": "{{$_POST.expense_date_paid}}"
            },
            {
              "name": ":P4",
              "type": "expression",
              "value": "{{$_POST.expense_user_paid}}"
            },
            {
              "name": ":P5",
              "type": "expression",
              "value": "{{$_POST.expense_user_received}}"
            },
            {
              "name": ":P6",
              "type": "expression",
              "value": "{{$_POST.expense_description}}"
            },
            {
              "name": ":P7",
              "type": "expression",
              "value": "{{$_POST.expense_status}}"
            },
            {
              "name": ":P8",
              "type": "expression",
              "value": "{{$_POST.expense_type}}"
            },
            {
              "name": ":P9",
              "type": "expression",
              "value": "{{$_POST.expense_department}}"
            },
            {
              "name": ":P10",
              "type": "expression",
              "value": "{{$_POST.expense_shift.default(null)}}",
              "test": ""
            },
            {
              "name": ":P11",
              "type": "expression",
              "value": "{{$_POST.expense_payment_method}}",
              "test": ""
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
  }
}
JSON
);
?>