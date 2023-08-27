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
        "name": "shift_id"
      },
      {
        "type": "text",
        "name": "user_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_list_user_shift",
      "module": "dbconnector",
      "action": "select",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "distinct": false,
          "columns": [
            {
              "table": "servo_user_shifts",
              "column": "user_shift_id",
              "field": "servo_user_shifts.user_shift_id"
            },
            {
              "table": "servo_user_shifts",
              "column": "servo_user_user_id",
              "field": "servo_user_shifts.servo_user_user_id"
            },
            {
              "table": "servo_user_shifts",
              "column": "servo_shifts_shift_id",
              "field": "servo_user_shifts.servo_shifts_shift_id"
            },
            {
              "table": "servo_user_shifts",
              "column": "servo_service_service_id",
              "field": "servo_user_shifts.servo_service_service_id"
            },
            {
              "table": "servo_user_shifts",
              "column": "servo_sales_point_sales_point_id",
              "field": "servo_user_shifts.servo_sales_point_sales_point_id"
            },
            {
              "table": "servo_services",
              "column": "service_name",
              "field": "servo_services.service_name"
            },
            {
              "table": "servo_user",
              "column": "user_profile",
              "field": "servo_user.user_profile"
            },
            {
              "table": "servo_shifts",
              "column": "shift_status",
              "field": "servo_shifts.shift_status"
            },
            {
              "table": "servo_shifts",
              "column": "shift_start",
              "field": "servo_shifts.shift_start"
            },
            {
              "table": "servo_shifts",
              "column": "shift_stop",
              "field": "servo_shifts.shift_stop"
            },
            {
              "table": "servo_customers",
              "column": "customer_id",
              "field": "servo_customers.customer_id"
            },
            {
              "table": "servo_services",
              "column": "servo_service_sales_point",
              "field": "servo_services.servo_service_sales_point"
            },
            {
              "table": "servo_sales_point",
              "column": "sales_point_customer_id"
            },
            {
              "table": "servo_sales_point",
              "column": "sales_point_name"
            },
            {
              "table": "servo_sales_point",
              "column": "sales_point_id"
            }
          ],
          "table": {
            "name": "servo_user_shifts",
            "alias": "servo_user_shifts"
          },
          "joins": [
            {
              "table": "servo_user",
              "column": "*",
              "alias": "servo_user",
              "type": "LEFT",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_user",
                    "column": "user_id",
                    "field": "servo_user.user_id",
                    "operation": "=",
                    "operator": "equal",
                    "value": {
                      "table": "servo_user_shifts",
                      "column": "servo_user_user_id",
                      "field": "servo_user_shifts.servo_user_user_id"
                    }
                  }
                ]
              },
              "primary": "user_id"
            },
            {
              "table": "servo_services",
              "column": "*",
              "alias": "servo_services",
              "type": "LEFT",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_services",
                    "column": "service_id",
                    "field": "servo_services.service_id",
                    "operation": "=",
                    "operator": "equal",
                    "value": {
                      "table": "servo_user_shifts",
                      "column": "servo_service_service_id",
                      "field": "servo_user_shifts.servo_service_service_id"
                    }
                  }
                ]
              },
              "primary": "service_id"
            },
            {
              "table": "servo_sales_point",
              "column": "*",
              "alias": "servo_sales_point",
              "type": "LEFT",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_sales_point",
                    "column": "sales_point_id",
                    "field": "servo_sales_point.sales_point_id",
                    "operation": "=",
                    "operator": "equal",
                    "value": {
                      "table": "servo_services",
                      "column": "servo_service_sales_point",
                      "field": "servo_services.servo_service_sales_point"
                    }
                  }
                ]
              },
              "primary": "sales_point_id"
            },
            {
              "table": "servo_department",
              "column": "*",
              "type": "LEFT",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_department",
                    "column": "department_id",
                    "field": "servo_department.department_id",
                    "operation": "=",
                    "operator": "equal",
                    "value": {
                      "table": "servo_user",
                      "column": "servo_user_departments_department_id",
                      "field": "servo_user.servo_user_departments_department_id"
                    }
                  }
                ]
              },
              "primary": "department_id"
            },
            {
              "table": "servo_shifts",
              "column": "*",
              "type": "LEFT",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_shifts",
                    "column": "shift_id",
                    "field": "servo_shifts.shift_id",
                    "operation": "=",
                    "operator": "equal",
                    "value": {
                      "table": "servo_user_shifts",
                      "column": "servo_shifts_shift_id",
                      "field": "servo_user_shifts.servo_shifts_shift_id"
                    }
                  }
                ]
              },
              "primary": "shift_id"
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
                    "field": "servo_customers.customer_id",
                    "operation": "=",
                    "operator": "equal",
                    "value": {
                      "table": "servo_sales_point",
                      "column": "sales_point_customer_id",
                      "field": "servo_sales_point.sales_point_customer_id"
                    }
                  }
                ]
              },
              "primary": "customer_id"
            }
          ],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "table": "servo_user_shifts",
                "column": "servo_shifts_shift_id",
                "field": "servo_user_shifts.servo_shifts_shift_id",
                "operation": "=",
                "operator": "equal",
                "value": "{{$_GET.shift_id}}"
              },
              {
                "table": "servo_user_shifts",
                "column": "servo_user_user_id",
                "field": "servo_user_shifts.servo_user_user_id",
                "operation": "=",
                "operator": "equal",
                "value": "{{$_GET.user_id}}"
              }
            ]
          },
          "orders": [
            {
              "table": "servo_user_shifts",
              "column": "user_shift_id",
              "field": "servo_user_shifts.user_shift_id",
              "direction": "DESC",
              "recid": 1
            }
          ],
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.shift_id}}",
              "test": "50"
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P2",
              "value": "{{$_GET.user_id}}",
              "test": "5"
            }
          ],
          "primary": "user_shift_id",
          "query": "select `servo_user_shifts`.`user_shift_id`, `servo_user_shifts`.`servo_user_user_id`, `servo_user_shifts`.`servo_shifts_shift_id`, `servo_user_shifts`.`servo_service_service_id`, `servo_user_shifts`.`servo_sales_point_sales_point_id`, `servo_services`.`service_name`, `servo_user`.`user_profile`, `servo_shifts`.`shift_status`, `servo_shifts`.`shift_start`, `servo_shifts`.`shift_stop`, `servo_customers`.`customer_id`, `servo_services`.`servo_service_sales_point`, `servo_sales_point`.`sales_point_customer_id`, `servo_sales_point`.`sales_point_name`, `servo_sales_point`.`sales_point_id` from `servo_user_shifts` as `servo_user_shifts` left join `servo_user` as `servo_user` on `servo_user`.`user_id` = `servo_user_shifts`.`servo_user_user_id` left join `servo_services` as `servo_services` on `servo_services`.`service_id` = `servo_user_shifts`.`servo_service_service_id` left join `servo_sales_point` as `servo_sales_point` on `servo_sales_point`.`sales_point_id` = `servo_services`.`servo_service_sales_point` left join `servo_department` on `servo_department`.`department_id` = `servo_user`.`servo_user_departments_department_id` left join `servo_shifts` on `servo_shifts`.`shift_id` = `servo_user_shifts`.`servo_shifts_shift_id` left join `servo_customers` on `servo_customers`.`customer_id` = `servo_sales_point`.`sales_point_customer_id` where `servo_user_shifts`.`servo_shifts_shift_id` = ? and `servo_user_shifts`.`servo_user_user_id` = ? order by `servo_user_shifts`.`user_shift_id` DESC"
        }
      },
      "output": true,
      "meta": [
        {
          "type": "number",
          "name": "user_shift_id"
        },
        {
          "type": "number",
          "name": "servo_user_user_id"
        },
        {
          "type": "number",
          "name": "servo_shifts_shift_id"
        },
        {
          "type": "number",
          "name": "servo_service_service_id"
        },
        {
          "type": "number",
          "name": "servo_sales_point_sales_point_id"
        },
        {
          "type": "text",
          "name": "service_name"
        },
        {
          "type": "text",
          "name": "user_profile"
        },
        {
          "type": "text",
          "name": "shift_status"
        },
        {
          "type": "datetime",
          "name": "shift_start"
        },
        {
          "type": "datetime",
          "name": "shift_stop"
        },
        {
          "type": "number",
          "name": "customer_id"
        },
        {
          "type": "number",
          "name": "servo_service_sales_point"
        },
        {
          "type": "number",
          "name": "sales_point_customer_id"
        },
        {
          "type": "text",
          "name": "sales_point_name"
        },
        {
          "type": "number",
          "name": "sales_point_id"
        }
      ],
      "outputType": "array",
      "type": "dbconnector_select"
    }
  }
}
JSON
);
?>