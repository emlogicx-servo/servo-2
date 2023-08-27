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
        "name": "limit"
      },
      {
        "type": "text",
        "name": "offset"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_list_data_reading_sessions",
      "module": "dbconnector",
      "action": "select",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [
            {
              "table": "servo_data_reading_session",
              "column": "data_reading_session_id"
            },
            {
              "table": "servo_data_reading_session",
              "column": "data_reading_session_date"
            },
            {
              "table": "servo_data_reading_session",
              "column": "data_reading_session_user"
            },
            {
              "table": "servo_data_reading_session",
              "column": "data_reading_session_customer"
            },
            {
              "table": "servo_data_reading_session",
              "column": "data_reading_session_notes"
            },
            {
              "table": "servo_data_reading_session",
              "column": "data_reading_session_asset"
            },
            {
              "table": "servo_user",
              "column": "user_id"
            },
            {
              "table": "servo_user",
              "column": "user_fname"
            },
            {
              "table": "servo_user",
              "column": "user_username",
              "aggregate": ""
            },
            {
              "table": "servo_customers",
              "column": "customer_id"
            },
            {
              "table": "servo_customers",
              "column": "customer_first_name"
            },
            {
              "table": "servo_customers",
              "column": "customer_last_name"
            }
          ],
          "table": {
            "name": "servo_data_reading_session"
          },
          "primary": "data_reading_session_id",
          "joins": [
            {
              "table": "servo_user",
              "column": "*",
              "type": "LEFT",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_user",
                    "column": "user_id",
                    "operator": "equal",
                    "value": {
                      "table": "servo_data_reading_session",
                      "column": "data_reading_session_user"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "user_id"
            },
            {
              "table": "servo_customers",
              "column": "*",
              "type": "LEFT",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_customers",
                    "column": "customer_id",
                    "operator": "equal",
                    "value": {
                      "table": "servo_data_reading_session",
                      "column": "data_reading_session_customer"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "customer_id"
            }
          ],
          "query": "SELECT servo_data_reading_session.data_reading_session_id, servo_data_reading_session.data_reading_session_date, servo_data_reading_session.data_reading_session_user, servo_data_reading_session.data_reading_session_customer, servo_data_reading_session.data_reading_session_notes, servo_data_reading_session.data_reading_session_asset, servo_user.user_id, servo_user.user_fname, servo_user.user_username, servo_customers.customer_id, servo_customers.customer_first_name, servo_customers.customer_last_name\nFROM servo_data_reading_session\nLEFT JOIN servo_user ON (servo_user.user_id = servo_data_reading_session.data_reading_session_user) LEFT JOIN servo_customers ON (servo_customers.customer_id = servo_data_reading_session.data_reading_session_customer)",
          "params": []
        }
      },
      "output": true,
      "meta": [
        {
          "type": "number",
          "name": "data_reading_session_id"
        },
        {
          "type": "datetime",
          "name": "data_reading_session_date"
        },
        {
          "type": "number",
          "name": "data_reading_session_user"
        },
        {
          "type": "number",
          "name": "data_reading_session_customer"
        },
        {
          "type": "text",
          "name": "data_reading_session_notes"
        },
        {
          "type": "number",
          "name": "data_reading_session_asset"
        },
        {
          "type": "number",
          "name": "user_id"
        },
        {
          "type": "text",
          "name": "user_fname"
        },
        {
          "type": "text",
          "name": "user_username"
        },
        {
          "type": "number",
          "name": "customer_id"
        },
        {
          "type": "text",
          "name": "customer_first_name"
        },
        {
          "type": "text",
          "name": "customer_last_name"
        }
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>