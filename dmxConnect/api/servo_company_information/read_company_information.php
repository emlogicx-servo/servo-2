<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "sort"
      },
      {
        "type": "text",
        "name": "dir"
      },
      {
        "type": "text",
        "name": "company_info_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query",
      "module": "dbconnector",
      "action": "single",
      "options": {
        "sql": {
          "type": "SELECT",
          "columns": [],
          "table": {
            "name": "servo_company_info"
          },
          "joins": [],
          "query": "SELECT *\nFROM servo_company_info\nWHERE company_info_id = :P1 /* {{$_GET.company_info_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.company_info_id}}"
            }
          ],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_company_info.company_info_id",
                "field": "servo_company_info.company_info_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.company_info_id}}",
                "data": {
                  "table": "servo_company_info",
                  "column": "company_info_id",
                  "type": "number"
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          },
          "primary": "company_info_id"
        },
        "connection": "servodb"
      },
      "output": true,
      "meta": [
        {
          "type": "number",
          "name": "company_info_id"
        },
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
          "type": "text",
          "name": "company_receipt_footer"
        }
      ],
      "outputType": "object",
      "type": "dbconnector_single"
    }
  }
}
JSON
);
?>