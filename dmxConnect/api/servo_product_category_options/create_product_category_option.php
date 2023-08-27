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
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "insert_product_category_option",
      "module": "dbupdater",
      "action": "insert",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "insert",
          "values": [
            {
              "table": "servo_product_category_options",
              "column": "category_option_category_id",
              "type": "number",
              "value": "{{$_POST.category_option_category_id}}"
            },
            {
              "table": "servo_product_category_options",
              "column": "category_option_option",
              "type": "text",
              "value": "{{$_POST.category_option_option}}"
            }
          ],
          "table": "servo_product_category_options",
          "returning": "category_option_id",
          "query": "INSERT INTO servo_product_category_options\n(category_option_category_id, category_option_option) VALUES (:P1 /* {{$_POST.category_option_category_id}} */, :P2 /* {{$_POST.category_option_option}} */)",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.category_option_category_id}}"
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.category_option_option}}"
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