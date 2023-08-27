<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "po_id"
      },
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
      "name": "query_list_updates_per_po",
      "module": "dbupdater",
      "action": "custom",
      "options": {
        "connection": "servodb",
        "sql": {
          "query": "SELECT old_value, new_value, updated_order_item_id, updated_value, updated_time, product_name, user_username, product_min_stock\nFROM servo_changes_updates \nleft join servo_order_items on order_item_id = updated_order_item_id\nleft join servo_user on user_id = user_updated\nleft join servo_products on servo_products.product_id = updated_product_id\nwhere updated_po_id = :p1\nORDER BY updated_time DESC",
          "params": [
            {
              "name": ":p1",
              "value": "{{$_GET.po_id}}",
              "test": "29"
            }
          ]
        }
      },
      "output": true,
      "meta": [
        {
          "name": "old_value",
          "type": "text"
        },
        {
          "name": "new_value",
          "type": "text"
        },
        {
          "name": "updated_order_item_id",
          "type": "number"
        },
        {
          "name": "updated_value",
          "type": "text"
        },
        {
          "name": "updated_time",
          "type": "datetime"
        },
        {
          "name": "product_name",
          "type": "text"
        },
        {
          "name": "user_username",
          "type": "text"
        },
        {
          "name": "product_min_stock",
          "type": "number"
        }
      ],
      "type": "dbcustom_query"
    }
  }
}
JSON
);
?>