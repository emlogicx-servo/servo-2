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
        "type": "text",
        "name": "company_message"
      },
      {
        "type": "text",
        "name": "company_logo"
      },
      {
        "type": "file",
        "name": "company_logo_file",
        "sub": [
          {
            "type": "text",
            "name": "name"
          },
          {
            "type": "text",
            "name": "type"
          },
          {
            "type": "number",
            "name": "size"
          },
          {
            "type": "text",
            "name": "error"
          }
        ],
        "outputType": "file"
      },
      {
        "type": "text",
        "name": "company_receipt_footer"
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "upload",
        "module": "upload",
        "action": "upload",
        "options": {
          "path": "/uploads",
          "fields": "{{$_POST.company_logo_file}}"
        },
        "meta": [
          {
            "name": "name",
            "type": "text"
          },
          {
            "name": "path",
            "type": "text"
          },
          {
            "name": "url",
            "type": "text"
          },
          {
            "name": "type",
            "type": "text"
          },
          {
            "name": "size",
            "type": "text"
          },
          {
            "name": "error",
            "type": "number"
          }
        ],
        "outputType": "file"
      },
      {
        "name": "insert_company_info",
        "module": "dbupdater",
        "action": "insert",
        "options": {
          "connection": "servodb",
          "sql": {
            "type": "insert",
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
                "column": "company_logo",
                "type": "text",
                "value": "{{upload.name}}"
              },
              {
                "table": "servo_company_info",
                "column": "company_receipt_footer",
                "type": "text",
                "value": "{{$_POST.company_receipt_footer}}"
              }
            ],
            "table": "servo_company_info",
            "returning": "company_info_id",
            "query": "INSERT INTO servo_company_info\n(company_name, company_address, company_phone_number, company_payment_numbers, company_message, company_logo, company_receipt_footer) VALUES (:P1 /* {{$_POST.company_name}} */, :P2 /* {{$_POST.company_address}} */, :P3 /* {{$_POST.company_phone_number}} */, :P4 /* {{$_POST.company_payment_numbers}} */, :P5 /* {{$_POST.company_message}} */, :P6 /* {{upload.name}} */, :P7 /* {{$_POST.company_receipt_footer}} */)",
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
                "value": "{{upload.name}}"
              },
              {
                "name": ":P7",
                "type": "expression",
                "value": "{{$_POST.company_receipt_footer}}"
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
    ]
  }
}
JSON
);
?>