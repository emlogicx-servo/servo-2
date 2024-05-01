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
        "name": "offset"
      },
      {
        "type": "text",
        "name": "limit"
      },
      {
        "type": "text",
        "name": "po_filter"
      },
      {
        "type": "text",
        "name": "department_id"
      },
      {
        "type": "text",
        "name": "vendor_id"
      },
      {
        "type": "text",
        "name": "po_invoice_id"
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "query",
        "module": "dbconnector",
        "action": "select",
        "options": {
          "connection": "servodb",
          "sql": {
            "type": "SELECT",
            "columns": [],
            "table": {
              "name": "servo_purchase_orders"
            },
            "joins": [
              {
                "table": "servo_user",
                "column": "*",
                "type": "INNER",
                "clauses": {
                  "condition": "AND",
                  "rules": [
                    {
                      "table": "servo_user",
                      "column": "user_id",
                      "operator": "equal",
                      "value": {
                        "table": "servo_purchase_orders",
                        "column": "servo_users_user_ordered_id"
                      },
                      "operation": "="
                    }
                  ]
                }
              }
            ],
            "query": "SELECT *\nFROM servo_purchase_orders\nINNER JOIN servo_user ON (servo_user.user_id = servo_purchase_orders.servo_users_user_ordered_id)\nORDER BY servo_purchase_orders.time_ordered DESC",
            "params": [],
            "orders": [
              {
                "table": "servo_purchase_orders",
                "column": "time_ordered",
                "direction": "DESC"
              }
            ]
          }
        },
        "output": true,
        "meta": [
          {
            "type": "number",
            "name": "po_id"
          },
          {
            "type": "number",
            "name": "servo_vendors_vendor_id"
          },
          {
            "type": "number",
            "name": "servo_users_user_ordered_id"
          },
          {
            "type": "number",
            "name": "servo_users_user_approved_id"
          },
          {
            "type": "number",
            "name": "servo_users_user_received_id"
          },
          {
            "type": "datetime",
            "name": "time_ordered"
          },
          {
            "type": "datetime",
            "name": "time_approved"
          },
          {
            "type": "datetime",
            "name": "time_received"
          },
          {
            "type": "text",
            "name": "po_status"
          },
          {
            "type": "number",
            "name": "payment_method"
          },
          {
            "type": "text",
            "name": "payment_status"
          },
          {
            "type": "text",
            "name": "po_notes"
          },
          {
            "type": "number",
            "name": "servo_departments_department_id"
          },
          {
            "type": "datetime",
            "name": "po_need_by_date"
          },
          {
            "type": "number",
            "name": "transfer_source_department_id"
          },
          {
            "type": "text",
            "name": "po_type"
          },
          {
            "type": "number",
            "name": "po_discount"
          },
          {
            "type": "text",
            "name": "po_payment_status"
          },
          {
            "type": "text",
            "name": "po_invoice_id"
          },
          {
            "type": "datetime",
            "name": "po_eta"
          },
          {
            "type": "text",
            "name": "po_goods_description"
          },
          {
            "type": "text",
            "name": "po_project_name"
          },
          {
            "type": "text",
            "name": "po_pr_number"
          },
          {
            "type": "text",
            "name": "po_importation_declaration_number"
          },
          {
            "type": "text",
            "name": "po_final_invoice_ref"
          },
          {
            "type": "number",
            "name": "po_agreed_advance_payment"
          },
          {
            "type": "number",
            "name": "po_agreed_balance"
          }
        ],
        "outputType": "array",
        "disabled": true
      },
      {
        "name": "list_purchase_orders_paged",
        "module": "dbconnector",
        "action": "paged",
        "options": {
          "connection": "servodb",
          "sql": {
            "type": "SELECT",
            "columns": [
              {
                "table": "servo_purchase_orders",
                "column": "po_id"
              },
              {
                "table": "servo_purchase_orders",
                "column": "time_ordered"
              },
              {
                "table": "servo_purchase_orders",
                "column": "time_approved"
              },
              {
                "table": "servo_purchase_orders",
                "column": "po_status"
              },
              {
                "table": "servo_purchase_orders",
                "column": "po_notes"
              },
              {
                "table": "servo_purchase_orders",
                "column": "po_need_by_date"
              },
              {
                "table": "servo_user",
                "column": "user_username"
              },
              {
                "table": "servo_vendors",
                "column": "vendor_name"
              },
              {
                "table": "servo_purchase_orders",
                "column": "servo_users_user_received_id"
              },
              {
                "table": "servo_purchase_orders",
                "column": "po_type"
              },
              {
                "table": "servo_purchase_orders",
                "column": "transfer_source_department_id"
              },
              {
                "table": "servo_department",
                "column": "department_name"
              },
              {
                "table": "source_department",
                "column": "department_name",
                "alias": "source_department_name"
              },
              {
                "table": "source_department",
                "column": "department_id",
                "alias": "source_department_id"
              },
              {
                "table": "servo_department",
                "column": "department_id"
              },
              {
                "table": "servo_purchase_orders",
                "column": "po_invoice_id"
              },
              {
                "table": "servo_purchase_orders",
                "column": "po_eta"
              },
              {
                "table": "servo_purchase_orders",
                "column": "po_goods_description"
              },
              {
                "table": "servo_purchase_orders",
                "column": "po_project_name"
              },
              {
                "table": "servo_purchase_orders",
                "column": "po_payment_status"
              },
              {
                "table": "servo_purchase_orders",
                "column": "po_pr_number"
              },
              {
                "table": "servo_purchase_orders",
                "column": "po_final_invoice_ref"
              },
              {
                "table": "servo_purchase_orders",
                "column": "po_agreed_advance_payment"
              },
              {
                "table": "servo_purchase_orders",
                "column": "po_agreed_balance"
              },
              {
                "table": "servo_purchase_orders",
                "column": "po_importation_declaration_number"
              }
            ],
            "table": {
              "name": "servo_purchase_orders"
            },
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
                        "table": "servo_purchase_orders",
                        "column": "servo_users_user_ordered_id"
                      },
                      "operation": "="
                    }
                  ]
                },
                "primary": "user_id"
              },
              {
                "table": "servo_vendors",
                "column": "*",
                "type": "LEFT",
                "clauses": {
                  "condition": "AND",
                  "rules": [
                    {
                      "table": "servo_vendors",
                      "column": "vendor_id",
                      "operator": "equal",
                      "value": {
                        "table": "servo_purchase_orders",
                        "column": "servo_vendors_vendor_id"
                      },
                      "operation": "="
                    }
                  ]
                },
                "primary": "vendor_id"
              },
              {
                "table": "servo_department",
                "column": "*",
                "alias": "source_department",
                "type": "LEFT",
                "clauses": {
                  "condition": "AND",
                  "rules": [
                    {
                      "table": "source_department",
                      "column": "department_id",
                      "operator": "equal",
                      "value": {
                        "table": "servo_purchase_orders",
                        "column": "transfer_source_department_id"
                      },
                      "operation": "="
                    }
                  ]
                },
                "primary": "department_id"
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
                      "operator": "equal",
                      "value": {
                        "table": "servo_purchase_orders",
                        "column": "servo_departments_department_id"
                      },
                      "operation": "="
                    }
                  ]
                },
                "primary": "department_id"
              }
            ],
            "query": "select `servo_purchase_orders`.`po_id`, `servo_purchase_orders`.`time_ordered`, `servo_purchase_orders`.`time_approved`, `servo_purchase_orders`.`po_status`, `servo_purchase_orders`.`po_notes`, `servo_purchase_orders`.`po_need_by_date`, `servo_user`.`user_username`, `servo_vendors`.`vendor_name`, `servo_purchase_orders`.`servo_users_user_received_id`, `servo_purchase_orders`.`po_type`, `servo_purchase_orders`.`transfer_source_department_id`, `servo_department`.`department_name`, `source_department`.`department_name` as `source_department_name`, `source_department`.`department_id` as `source_department_id`, `servo_department`.`department_id`, `servo_purchase_orders`.`po_invoice_id`, `servo_purchase_orders`.`po_eta`, `servo_purchase_orders`.`po_goods_description`, `servo_purchase_orders`.`po_project_name`, `servo_purchase_orders`.`po_payment_status`, `servo_purchase_orders`.`po_pr_number`, `servo_purchase_orders`.`po_final_invoice_ref`, `servo_purchase_orders`.`po_agreed_advance_payment`, `servo_purchase_orders`.`po_agreed_balance`, `servo_purchase_orders`.`po_importation_declaration_number` from `servo_purchase_orders` left join `servo_user` on `servo_user`.`user_id` = `servo_purchase_orders`.`servo_users_user_ordered_id` left join `servo_vendors` on `servo_vendors`.`vendor_id` = `servo_purchase_orders`.`servo_vendors_vendor_id` left join `servo_department` as `source_department` on `source_department`.`department_id` = `servo_purchase_orders`.`transfer_source_department_id` left join `servo_department` on `servo_department`.`department_id` = `servo_purchase_orders`.`servo_departments_department_id` where `servo_purchase_orders`.`po_type` = ? and (`servo_purchase_orders`.`servo_departments_department_id` = ?) and (`servo_purchase_orders`.`po_id` = ?) and (`servo_purchase_orders`.`servo_vendors_vendor_id` = ?) and (`servo_purchase_orders`.`po_invoice_id` = ?) order by `servo_purchase_orders`.`time_ordered` DESC, `servo_purchase_orders`.`po_id` DESC, `servo_user`.`user_username` ASC, `servo_department`.`department_name` ASC, `servo_vendors`.`vendor_name` ASC, `servo_purchase_orders`.`po_status` ASC, `servo_purchase_orders`.`po_invoice_id` ASC, `servo_purchase_orders`.`po_eta` ASC",
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
                "value": "{{$_GET.department_id}}",
                "test": "?"
              },
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P2",
                "value": "{{$_GET.po_filter}}",
                "test": "?"
              },
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P3",
                "value": "{{$_GET.vendor_id}}",
                "test": "?"
              },
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P4",
                "value": "{{$_GET.po_invoice_id}}",
                "test": "?"
              }
            ],
            "orders": [
              {
                "table": "servo_purchase_orders",
                "column": "time_ordered",
                "direction": "DESC",
                "recid": 1
              },
              {
                "table": "servo_purchase_orders",
                "column": "po_id",
                "direction": "DESC",
                "recid": 2
              },
              {
                "table": "servo_user",
                "column": "user_username",
                "direction": "ASC",
                "recid": 3
              },
              {
                "table": "servo_department",
                "column": "department_name",
                "direction": "ASC",
                "recid": 4
              },
              {
                "table": "servo_vendors",
                "column": "vendor_name",
                "direction": "ASC",
                "recid": 5
              },
              {
                "table": "servo_purchase_orders",
                "column": "po_status",
                "direction": "ASC",
                "recid": 6
              },
              {
                "table": "servo_purchase_orders",
                "column": "po_invoice_id",
                "direction": "ASC",
                "recid": 7
              },
              {
                "table": "servo_purchase_orders",
                "column": "po_eta",
                "direction": "ASC",
                "recid": 8
              }
            ],
            "primary": "po_id",
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "servo_purchase_orders.po_type",
                  "field": "servo_purchase_orders.po_type",
                  "type": "string",
                  "operator": "equal",
                  "value": "Purchase",
                  "data": {
                    "table": "servo_purchase_orders",
                    "column": "po_type",
                    "type": "text",
                    "columnObj": {
                      "type": "enum",
                      "enumValues": [
                        "Purchase",
                        "Transfer"
                      ],
                      "default": "",
                      "maxLength": 8,
                      "primary": false,
                      "nullable": true,
                      "name": "po_type"
                    }
                  },
                  "operation": "=",
                  "table": "servo_purchase_orders"
                },
                {
                  "condition": "AND",
                  "rules": [
                    {
                      "id": "servo_purchase_orders.servo_departments_department_id",
                      "field": "servo_purchase_orders.servo_departments_department_id",
                      "type": "double",
                      "operator": "equal",
                      "value": "{{$_GET.department_id}}",
                      "data": {
                        "table": "servo_purchase_orders",
                        "column": "servo_departments_department_id",
                        "type": "number",
                        "columnObj": {
                          "type": "reference",
                          "default": "",
                          "primary": false,
                          "nullable": true,
                          "references": "department_id",
                          "inTable": "servo_department",
                          "referenceType": "integer",
                          "onUpdate": "RESTRICT",
                          "onDelete": "RESTRICT",
                          "name": "servo_departments_department_id"
                        }
                      },
                      "operation": "=",
                      "table": "servo_purchase_orders"
                    }
                  ],
                  "conditional": "{{$_GET.department_id}}",
                  "table": "servo_purchase_orders",
                  "id": "servo_purchase_orders.undefined"
                },
                {
                  "condition": "AND",
                  "rules": [
                    {
                      "id": "servo_purchase_orders.po_id",
                      "field": "servo_purchase_orders.po_id",
                      "type": "double",
                      "operator": "equal",
                      "value": "{{$_GET.po_filter}}",
                      "data": {
                        "table": "servo_purchase_orders",
                        "column": "po_id",
                        "type": "number",
                        "columnObj": {
                          "type": "increments",
                          "primary": true,
                          "nullable": false,
                          "name": "po_id"
                        }
                      },
                      "operation": "=",
                      "table": "servo_purchase_orders"
                    }
                  ],
                  "conditional": "{{$_GET.po_filter}}",
                  "table": "servo_purchase_orders",
                  "id": "servo_purchase_orders.undefined"
                },
                {
                  "condition": "AND",
                  "rules": [
                    {
                      "id": "servo_purchase_orders.servo_vendors_vendor_id",
                      "field": "servo_purchase_orders.servo_vendors_vendor_id",
                      "type": "double",
                      "operator": "equal",
                      "value": "{{$_GET.vendor_id}}",
                      "data": {
                        "table": "servo_purchase_orders",
                        "column": "servo_vendors_vendor_id",
                        "type": "number",
                        "columnObj": {
                          "type": "reference",
                          "default": "",
                          "primary": false,
                          "nullable": true,
                          "references": "vendor_id",
                          "inTable": "servo_vendors",
                          "referenceType": "integer",
                          "onUpdate": "RESTRICT",
                          "onDelete": "RESTRICT",
                          "name": "servo_vendors_vendor_id"
                        }
                      },
                      "operation": "=",
                      "table": "servo_purchase_orders"
                    }
                  ],
                  "conditional": "{{$_GET.vendor_id}}",
                  "table": "servo_purchase_orders",
                  "id": "servo_purchase_orders.undefined"
                },
                {
                  "condition": "AND",
                  "rules": [
                    {
                      "id": "servo_purchase_orders.po_invoice_id",
                      "field": "servo_purchase_orders.po_invoice_id",
                      "type": "string",
                      "operator": "equal",
                      "value": "{{$_GET.po_invoice_id}}",
                      "data": {
                        "table": "servo_purchase_orders",
                        "column": "po_invoice_id",
                        "type": "text",
                        "columnObj": {
                          "type": "string",
                          "default": "",
                          "maxLength": 128,
                          "primary": false,
                          "nullable": true,
                          "name": "po_invoice_id"
                        }
                      },
                      "operation": "=",
                      "table": "servo_purchase_orders"
                    }
                  ],
                  "conditional": "{{$_GET.po_invoice_id}}",
                  "table": "servo_purchase_orders",
                  "id": "servo_purchase_orders.undefined"
                }
              ],
              "conditional": null,
              "valid": true
            },
            "offsetTest": "?",
            "limitTest": "?"
          }
        },
        "output": true,
        "meta": [
          {
            "name": "offset",
            "type": "number"
          },
          {
            "name": "limit",
            "type": "number"
          },
          {
            "name": "total",
            "type": "number"
          },
          {
            "name": "page",
            "type": "object",
            "sub": [
              {
                "name": "offset",
                "type": "object",
                "sub": [
                  {
                    "name": "first",
                    "type": "number"
                  },
                  {
                    "name": "prev",
                    "type": "number"
                  },
                  {
                    "name": "next",
                    "type": "number"
                  },
                  {
                    "name": "last",
                    "type": "number"
                  }
                ]
              },
              {
                "name": "current",
                "type": "number"
              },
              {
                "name": "total",
                "type": "number"
              }
            ]
          },
          {
            "name": "data",
            "type": "array",
            "sub": [
              {
                "type": "number",
                "name": "po_id"
              },
              {
                "type": "datetime",
                "name": "time_ordered"
              },
              {
                "type": "datetime",
                "name": "time_approved"
              },
              {
                "type": "text",
                "name": "po_status"
              },
              {
                "type": "text",
                "name": "po_notes"
              },
              {
                "type": "datetime",
                "name": "po_need_by_date"
              },
              {
                "type": "text",
                "name": "user_username"
              },
              {
                "type": "text",
                "name": "vendor_name"
              },
              {
                "type": "number",
                "name": "servo_users_user_received_id"
              },
              {
                "type": "text",
                "name": "po_type"
              },
              {
                "type": "number",
                "name": "transfer_source_department_id"
              },
              {
                "type": "text",
                "name": "department_name"
              },
              {
                "type": "text",
                "name": "source_department_name"
              },
              {
                "type": "number",
                "name": "source_department_id"
              },
              {
                "type": "number",
                "name": "department_id"
              },
              {
                "type": "text",
                "name": "po_invoice_id"
              },
              {
                "type": "datetime",
                "name": "po_eta"
              },
              {
                "type": "text",
                "name": "po_goods_description"
              },
              {
                "type": "text",
                "name": "po_project_name"
              },
              {
                "type": "text",
                "name": "po_payment_status"
              },
              {
                "type": "text",
                "name": "po_pr_number"
              },
              {
                "type": "text",
                "name": "po_final_invoice_ref"
              },
              {
                "type": "number",
                "name": "po_agreed_advance_payment"
              },
              {
                "type": "number",
                "name": "po_agreed_balance"
              },
              {
                "type": "text",
                "name": "po_importation_declaration_number"
              }
            ]
          }
        ],
        "outputType": "object",
        "type": "dbconnector_paged_select"
      }
    ]
  }
}
JSON
);
?>