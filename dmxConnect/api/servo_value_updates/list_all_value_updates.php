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
      "name": "query",
      "module": "dbconnector",
      "action": "select",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [],
          "params": [],
          "table": {
            "name": "servo_changes_updates"
          },
          "primary": "update_id",
          "joins": [],
          "query": "SELECT *\nFROM servo_changes_updates"
        }
      },
      "output": true,
      "meta": [
        {
          "type": "number",
          "name": "update_id"
        },
        {
          "type": "number",
          "name": "user_updated"
        },
        {
          "type": "text",
          "name": "old_value"
        },
        {
          "type": "text",
          "name": "new_value"
        },
        {
          "type": "number",
          "name": "order_item_id"
        },
        {
          "type": "number",
          "name": "po_item_id"
        },
        {
          "type": "text",
          "name": "updated_value"
        },
        {
          "type": "datetime",
          "name": "updated_time"
        }
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>