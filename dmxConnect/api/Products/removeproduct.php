<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "productid"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "delete",
      "module": "dbupdater",
      "action": "delete",
      "options": {
        "connection": "testdb",
        "sql": {
          "type": "delete",
          "table": "products",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "id",
                "field": "id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.productid}}",
                "data": {
                  "column": "id"
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          },
          "query": "DELETE\nFROM products\nWHERE id = :P1 /* {{$_POST.productid}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_POST.productid}}"
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