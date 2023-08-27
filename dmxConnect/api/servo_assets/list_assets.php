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
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "list_assets",
      "module": "dbconnector",
      "action": "select",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [],
          "table": {
            "name": "servo_assets"
          },
          "primary": "asset_id",
          "joins": [],
          "query": "SELECT *\nFROM servo_assets",
          "params": []
        }
      },
      "output": true,
      "meta": [
        {
          "type": "number",
          "name": "asset_id"
        },
        {
          "type": "number",
          "name": "asset_name"
        },
        {
          "type": "number",
          "name": "asset_lat"
        },
        {
          "type": "number",
          "name": "asset_long"
        }
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>