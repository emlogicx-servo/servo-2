<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "company_name"
      },
      {
        "type": "text",
        "name": "company_address"
      },
      {
        "type": "text",
        "name": "company_phone_number"
      },
      {
        "type": "text",
        "name": "company_payment_numbers"
      },
      {
        "type": "number",
        "name": "company_info_id"
      },
      {
        "type": "text",
        "name": "company_message"
      },
      {
        "type": "text",
        "name": "logolink"
      },
      {
        "type": "text",
        "name": "company_receipt_footer"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "update",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "update",
          "values": [
            {
              "table": "servo_company_info",
              "column": "company_name",
              "type": "text",
              "value": "{{$_POST.company_name}}"
            },
            {
              "table": "servo_company_info",
              "column": "company_address",
              "type": "text",
              "value": "{{$_POST.company_address}}"
            },
            {
              "table": "servo_company_info",
              "column": "company_phone_number",
              "type": "text",
              "value": "{{$_POST.company_phone_number}}"
            },
            {
              "table": "servo_company_info",
              "column": "company_payment_numbers",
              "type": "text",
              "value": "{{$_POST.company_payment_numbers}}"
            },
            {
              "table": "servo_company_info",
              "column": "company_message",
              "type": "text",
              "value": "{{$_POST.company_message}}"
            },
            {
              "table": "servo_company_info",
              "column": "company_receipt_footer",
              "type": "text",
              "value": "{{$_POST.company_receipt_footer}}"
            }
          ],
          "table": "servo_company_info",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "company_info_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.company_info_id}}",
                "data": {
                  "column": "company_info_id"
                },
                "operation": "="
              }
            ]
          },
          "query": "UPDATE servo_company_info\nSET company_name = :P1 /* {{$_POST.company_name}} */, company_address = :P2 /* {{$_POST.company_address}} */, company_phone_number = :P3 /* {{$_POST.company_phone_number}} */, company_payment_numbers = :P4 /* {{$_POST.company_payment_numbers}} */, company_message = :P5 /* {{$_POST.company_message}} */, company_receipt_footer = :P6 /* {{$_POST.company_receipt_footer}} */\nWHERE company_info_id = :P7 /* {{$_POST.company_info_id}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.company_name}}"
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.company_address}}"
            },
            {
              "name": ":P3",
              "type": "expression",
              "value": "{{$_POST.company_phone_number}}"
            },
            {
              "name": ":P4",
              "type": "expression",
              "value": "{{$_POST.company_payment_numbers}}"
            },
            {
              "name": ":P5",
              "type": "expression",
              "value": "{{$_POST.company_message}}"
            },
            {
              "name": ":P6",
              "type": "expression",
              "value": "{{$_POST.company_receipt_footer}}"
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P7",
              "value": "{{$_POST.company_info_id}}"
            }
          ],
          "returning": "company_info_id"
        }
      },
      "meta": [
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