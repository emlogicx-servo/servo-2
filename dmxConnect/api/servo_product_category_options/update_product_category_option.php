<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "number",
        "name": "category_option_category_id"
      },
      {
        "type": "text",
        "name": "category_option_option"
      },
      {
        "type": "number",
        "name": "category_option_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "update_product_category_option",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "update",
          "values": [
            {
              "table": "servo_product_category_options",
              "column": "category_option_option",
              "type": "text",
              "value": "{{$_POST.category_option_option}}"
            }
          ],
          "table": "servo_product_category_options",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "category_option_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.category_option_id}}",
                "data": {
                  "column": "category_option_id"
                },
                "operation": "="
              }
            ]
          },
          "query": "UPDATE servo_product_category_options\nSET category_option_option = :P1 /* {{$_POST.category_option_option}} */\nWHERE category_option_id = :P2 /* {{$_POST.category_option_id}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.category_option_option}}"
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P2",
              "value": "{{$_POST.category_option_id}}"
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