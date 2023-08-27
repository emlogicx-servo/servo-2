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
      "name": "list_profile_settings",
      "module": "dbconnector",
      "action": "select",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [
            {
              "table": "servo_profile_settings",
              "column": "profile_settings_id"
            },
            {
              "table": "servo_profile_settings",
              "column": "profile"
            },
            {
              "table": "servo_profile_settings",
              "column": "create_po"
            },
            {
              "table": "servo_profile_settings",
              "column": "delete_po"
            },
            {
              "table": "servo_profile_settings",
              "column": "edit_po_item_quantity"
            },
            {
              "table": "servo_profile_settings",
              "column": "edit_po_item_price"
            },
            {
              "table": "servo_profile_settings",
              "column": "create_order"
            },
            {
              "table": "servo_profile_settings",
              "column": "delete_order"
            },
            {
              "table": "servo_profile_settings",
              "column": "edit_order_item_quantity"
            },
            {
              "table": "servo_profile_settings",
              "column": "edit_order_item_price"
            },
            {
              "table": "servo_profile_settings",
              "column": "create_customer"
            },
            {
              "table": "servo_profile_settings",
              "column": "delete_customer"
            },
            {
              "table": "servo_profile_settings",
              "column": "edit_customer"
            },
            {
              "table": "servo_profile_settings",
              "column": "edit_order_details"
            },
            {
              "table": "servo_profile_settings",
              "column": "delete_po_item"
            },
            {
              "table": "servo_profile_settings",
              "column": "delete_order_item"
            },
            {
              "table": "servo_profile_settings",
              "column": "create_ao"
            },
            {
              "table": "servo_profile_settings",
              "column": "delete_ao"
            },
            {
              "table": "servo_profile_settings",
              "column": "edit_ao_item_quantity"
            },
            {
              "table": "servo_profile_settings",
              "column": "delete_ao_item"
            },
            {
              "table": "servo_profile_settings",
              "column": "create_user"
            },
            {
              "table": "servo_profile_settings",
              "column": "delete_user"
            },
            {
              "table": "servo_profile_settings",
              "column": "edit_user"
            },
            {
              "table": "servo_profile_settings",
              "column": "approve_po"
            }
          ],
          "table": {
            "name": "servo_profile_settings"
          },
          "primary": "profile_settings_id",
          "joins": [],
          "query": "SELECT profile_settings_id, profile, create_po, delete_po, edit_po_item_quantity, edit_po_item_price, create_order, delete_order, edit_order_item_quantity, edit_order_item_price, create_customer, delete_customer, edit_customer, edit_order_details, delete_po_item, delete_order_item, create_ao, delete_ao, edit_ao_item_quantity, delete_ao_item, create_user, delete_user, edit_user, approve_po\nFROM servo_profile_settings",
          "params": []
        }
      },
      "output": true,
      "meta": [
        {
          "type": "number",
          "name": "profile_settings_id"
        },
        {
          "type": "text",
          "name": "profile"
        },
        {
          "type": "text",
          "name": "create_po"
        },
        {
          "type": "text",
          "name": "delete_po"
        },
        {
          "type": "text",
          "name": "edit_po_item_quantity"
        },
        {
          "type": "text",
          "name": "edit_po_item_price"
        },
        {
          "type": "text",
          "name": "create_order"
        },
        {
          "type": "text",
          "name": "delete_order"
        },
        {
          "type": "text",
          "name": "edit_order_item_quantity"
        },
        {
          "type": "text",
          "name": "edit_order_item_price"
        },
        {
          "type": "text",
          "name": "create_customer"
        },
        {
          "type": "text",
          "name": "delete_customer"
        },
        {
          "type": "text",
          "name": "edit_customer"
        },
        {
          "type": "text",
          "name": "edit_order_details"
        },
        {
          "type": "text",
          "name": "delete_po_item"
        },
        {
          "type": "text",
          "name": "delete_order_item"
        },
        {
          "type": "text",
          "name": "create_ao"
        },
        {
          "type": "text",
          "name": "delete_ao"
        },
        {
          "type": "text",
          "name": "edit_ao_item_quantity"
        },
        {
          "type": "text",
          "name": "delete_ao_item"
        },
        {
          "type": "text",
          "name": "create_user"
        },
        {
          "type": "text",
          "name": "delete_user"
        },
        {
          "type": "text",
          "name": "edit_user"
        },
        {
          "type": "text",
          "name": "approve_po"
        }
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>