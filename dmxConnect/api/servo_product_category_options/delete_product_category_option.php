<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "name": "delete_category_option",
  "module": "dbupdater",
  "action": "delete",
  "options": {
    "connection": "servodb",
    "sql": {
      "type": "delete",
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
      "query": "DELETE\nFROM servo_product_category_options\nWHERE category_option_id = :P1 /* {{$_POST.category_option_id}} */",
      "params": [
        {
          "operator": "equal",
          "type": "expression",
          "name": ":P1",
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
JSON
);
?>