<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "wallet_id"
      },
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
        "name": "user_id"
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "read_wallet",
        "module": "dbconnector",
        "action": "single",
        "options": {
          "connection": "servodb",
          "sql": {
            "type": "SELECT",
            "columns": [
              {
                "table": "servo_wallets",
                "column": "wallet_name"
              },
              {
                "table": "servo_wallets",
                "column": "wallet_type"
              },
              {
                "table": "servo_wallets",
                "column": "wallet_description"
              },
              {
                "table": "servo_wallets",
                "column": "wallet_creation_date"
              },
              {
                "table": "servo_wallets",
                "column": "wallet_user_created"
              },
              {
                "table": "servo_wallets",
                "column": "wallet_currency"
              },
              {
                "table": "servo_wallets",
                "column": "wallet_format"
              },
              {
                "table": "servo_wallets",
                "column": "wallet_id"
              },
              {
                "table": "servo_currencies",
                "column": "currency_name"
              },
              {
                "table": "servo_payment_methods",
                "column": "payment_method_name"
              },
              {
                "table": "servo_user",
                "column": "user_username"
              },
              {
                "table": "servo_user",
                "column": "user_fname"
              },
              {
                "table": "servo_user",
                "column": "user_lname"
              }
            ],
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
                "value": "{{$_GET.wallet_id}}",
                "test": ""
              }
            ],
            "table": {
              "name": "servo_wallets"
            },
            "primary": "wallet_id",
            "joins": [
              {
                "table": "servo_currencies",
                "column": "*",
                "type": "LEFT",
                "clauses": {
                  "condition": "AND",
                  "rules": [
                    {
                      "table": "servo_currencies",
                      "column": "currency_id",
                      "operator": "equal",
                      "value": {
                        "table": "servo_wallets",
                        "column": "wallet_currency"
                      },
                      "operation": "="
                    }
                  ]
                },
                "primary": "currency_id"
              },
              {
                "table": "servo_payment_methods",
                "column": "*",
                "type": "LEFT",
                "clauses": {
                  "condition": "AND",
                  "rules": [
                    {
                      "table": "servo_payment_methods",
                      "column": "payment_method_id",
                      "operator": "equal",
                      "value": {
                        "table": "servo_wallets",
                        "column": "wallet_format"
                      },
                      "operation": "="
                    }
                  ]
                },
                "primary": "payment_method_id"
              },
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
                        "table": "servo_wallets",
                        "column": "wallet_user_created"
                      },
                      "operation": "="
                    }
                  ]
                },
                "primary": "user_id"
              }
            ],
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "servo_wallets.wallet_id",
                  "field": "servo_wallets.wallet_id",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{$_GET.wallet_id}}",
                  "data": {
                    "table": "servo_wallets",
                    "column": "wallet_id",
                    "type": "number",
                    "columnObj": {
                      "type": "increments",
                      "primary": true,
                      "nullable": false,
                      "name": "wallet_id"
                    }
                  },
                  "operation": "="
                }
              ],
              "conditional": null,
              "valid": true
            },
            "query": "SELECT servo_wallets.wallet_name, servo_wallets.wallet_type, servo_wallets.wallet_description, servo_wallets.wallet_creation_date, servo_wallets.wallet_user_created, servo_wallets.wallet_currency, servo_wallets.wallet_format, servo_wallets.wallet_id, servo_currencies.currency_name, servo_payment_methods.payment_method_name, servo_user.user_username, servo_user.user_fname, servo_user.user_lname\nFROM servo_wallets\nLEFT JOIN servo_currencies ON servo_currencies.currency_id = servo_wallets.wallet_currency LEFT JOIN servo_payment_methods ON servo_payment_methods.payment_method_id = servo_wallets.wallet_format LEFT JOIN servo_user ON servo_user.user_id = servo_wallets.wallet_user_created\nWHERE servo_wallets.wallet_id = :P1 /* {{$_GET.wallet_id}} */"
          }
        },
        "output": true,
        "meta": [
          {
            "type": "text",
            "name": "wallet_name"
          },
          {
            "type": "text",
            "name": "wallet_type"
          },
          {
            "type": "text",
            "name": "wallet_description"
          },
          {
            "type": "datetime",
            "name": "wallet_creation_date"
          },
          {
            "type": "number",
            "name": "wallet_user_created"
          },
          {
            "type": "number",
            "name": "wallet_currency"
          },
          {
            "type": "number",
            "name": "wallet_format"
          },
          {
            "type": "number",
            "name": "wallet_id"
          },
          {
            "type": "text",
            "name": "currency_name"
          },
          {
            "type": "text",
            "name": "payment_method_name"
          },
          {
            "type": "text",
            "name": "user_username"
          },
          {
            "type": "text",
            "name": "user_fname"
          },
          {
            "type": "text",
            "name": "user_lname"
          }
        ],
        "outputType": "object"
      },
      {
        "name": "query_wallet_privileges",
        "module": "dbconnector",
        "action": "select",
        "options": {
          "connection": "servodb",
          "sql": {
            "type": "select",
            "columns": [
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
                "column": "user_lname"
              },
              {
                "table": "servo_user",
                "column": "user_username"
              },
              {
                "table": "servo_wallet_privileges",
                "column": "wallet_privilege_wallet_id"
              },
              {
                "table": "servo_wallet_privileges",
                "column": "wallet_privilege_deposit"
              },
              {
                "table": "servo_wallet_privileges",
                "column": "wallet_privilege_user_id"
              },
              {
                "table": "servo_wallet_privileges",
                "column": "wallet_privilege_transfer"
              },
              {
                "table": "servo_wallet_privileges",
                "column": "wallet_privilege_payout"
              },
              {
                "table": "servo_wallet_privileges",
                "column": "wallet_privilege_id"
              },
              {
                "table": "servo_wallet_privileges",
                "column": "wallet_privilege_transfer_to"
              },
              {
                "table": "servo_wallet_privileges",
                "column": "wallet_privilege_approve"
              },
              {
                "table": "servo_wallet_privileges",
                "column": "wallet_privilege_receive"
              }
            ],
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
                "value": "{{$_GET.wallet_id}}",
                "test": ""
              }
            ],
            "table": {
              "name": "servo_user"
            },
            "primary": "user_id",
            "joins": [
              {
                "table": "servo_wallet_privileges",
                "column": "*",
                "type": "RIGHT",
                "clauses": {
                  "condition": "AND",
                  "rules": [
                    {
                      "table": "servo_wallet_privileges",
                      "column": "wallet_privilege_user_id",
                      "operator": "equal",
                      "operation": "=",
                      "value": {
                        "table": "servo_user",
                        "column": "user_id"
                      }
                    }
                  ]
                },
                "primary": "wallet_privilege_id"
              }
            ],
            "query": "select `servo_user`.`user_id`, `servo_user`.`user_fname`, `servo_user`.`user_lname`, `servo_user`.`user_username`, `servo_wallet_privileges`.`wallet_privilege_wallet_id`, `servo_wallet_privileges`.`wallet_privilege_deposit`, `servo_wallet_privileges`.`wallet_privilege_user_id`, `servo_wallet_privileges`.`wallet_privilege_transfer`, `servo_wallet_privileges`.`wallet_privilege_payout`, `servo_wallet_privileges`.`wallet_privilege_id`, `servo_wallet_privileges`.`wallet_privilege_transfer_to`, `servo_wallet_privileges`.`wallet_privilege_approve`, `servo_wallet_privileges`.`wallet_privilege_receive` from `servo_user` right join `servo_wallet_privileges` on `servo_wallet_privileges`.`wallet_privilege_user_id` = `servo_user`.`user_id` where `servo_wallet_privileges`.`wallet_privilege_wallet_id` = ?",
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "servo_wallet_privileges.wallet_privilege_wallet_id",
                  "field": "servo_wallet_privileges.wallet_privilege_wallet_id",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{$_GET.wallet_id}}",
                  "data": {
                    "table": "servo_wallet_privileges",
                    "column": "wallet_privilege_wallet_id",
                    "type": "number",
                    "columnObj": {
                      "type": "reference",
                      "primary": false,
                      "nullable": true,
                      "references": "wallet_id",
                      "inTable": "servo_wallets",
                      "referenceType": "integer",
                      "onUpdate": "RESTRICT",
                      "onDelete": "RESTRICT",
                      "name": "wallet_privilege_wallet_id"
                    }
                  },
                  "operation": "="
                }
              ],
              "conditional": null,
              "valid": true
            }
          }
        },
        "output": true,
        "meta": [
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
            "name": "user_lname"
          },
          {
            "type": "text",
            "name": "user_username"
          },
          {
            "type": "number",
            "name": "wallet_privilege_wallet_id"
          },
          {
            "type": "text",
            "name": "wallet_privilege_deposit"
          },
          {
            "type": "number",
            "name": "wallet_privilege_user_id"
          },
          {
            "type": "text",
            "name": "wallet_privilege_transfer"
          },
          {
            "type": "text",
            "name": "wallet_privilege_payout"
          },
          {
            "type": "number",
            "name": "wallet_privilege_id"
          },
          {
            "type": "text",
            "name": "wallet_privilege_transfer_to"
          },
          {
            "type": "text",
            "name": "wallet_privilege_approve"
          },
          {
            "type": "text",
            "name": "wallet_privilege_receive"
          }
        ],
        "outputType": "array"
      },
      {
        "name": "query_wallet_privileges_user",
        "module": "dbconnector",
        "action": "select",
        "options": {
          "connection": "servodb",
          "sql": {
            "type": "select",
            "columns": [
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
                "column": "user_lname"
              },
              {
                "table": "servo_user",
                "column": "user_username"
              },
              {
                "table": "servo_wallet_privileges",
                "column": "wallet_privilege_wallet_id"
              },
              {
                "table": "servo_wallet_privileges",
                "column": "wallet_privilege_deposit"
              },
              {
                "table": "servo_wallet_privileges",
                "column": "wallet_privilege_user_id"
              },
              {
                "table": "servo_wallet_privileges",
                "column": "wallet_privilege_transfer"
              },
              {
                "table": "servo_wallet_privileges",
                "column": "wallet_privilege_payout"
              },
              {
                "table": "servo_wallet_privileges",
                "column": "wallet_privilege_id"
              },
              {
                "table": "servo_wallet_privileges",
                "column": "wallet_privilege_approve"
              },
              {
                "table": "servo_wallet_privileges",
                "column": "wallet_privilege_receive"
              },
              {
                "table": "servo_wallet_privileges",
                "column": "wallet_privilege_transfer_to"
              }
            ],
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
                "value": "{{$_GET.wallet_id}}",
                "test": ""
              },
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P2",
                "value": "{{$_GET.user_id}}",
                "test": ""
              }
            ],
            "table": {
              "name": "servo_user"
            },
            "primary": "user_id",
            "joins": [
              {
                "table": "servo_wallet_privileges",
                "column": "*",
                "type": "RIGHT",
                "clauses": {
                  "condition": "AND",
                  "rules": [
                    {
                      "table": "servo_wallet_privileges",
                      "column": "wallet_privilege_user_id",
                      "operator": "equal",
                      "operation": "=",
                      "value": {
                        "table": "servo_user",
                        "column": "user_id"
                      }
                    }
                  ]
                },
                "primary": "wallet_privilege_id"
              }
            ],
            "query": "select `servo_user`.`user_id`, `servo_user`.`user_fname`, `servo_user`.`user_lname`, `servo_user`.`user_username`, `servo_wallet_privileges`.`wallet_privilege_wallet_id`, `servo_wallet_privileges`.`wallet_privilege_deposit`, `servo_wallet_privileges`.`wallet_privilege_user_id`, `servo_wallet_privileges`.`wallet_privilege_transfer`, `servo_wallet_privileges`.`wallet_privilege_payout`, `servo_wallet_privileges`.`wallet_privilege_id`, `servo_wallet_privileges`.`wallet_privilege_approve`, `servo_wallet_privileges`.`wallet_privilege_receive`, `servo_wallet_privileges`.`wallet_privilege_transfer_to` from `servo_user` right join `servo_wallet_privileges` on `servo_wallet_privileges`.`wallet_privilege_user_id` = `servo_user`.`user_id` where `servo_wallet_privileges`.`wallet_privilege_wallet_id` = ? and `servo_wallet_privileges`.`wallet_privilege_user_id` = ?",
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "servo_wallet_privileges.wallet_privilege_wallet_id",
                  "field": "servo_wallet_privileges.wallet_privilege_wallet_id",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{$_GET.wallet_id}}",
                  "data": {
                    "table": "servo_wallet_privileges",
                    "column": "wallet_privilege_wallet_id",
                    "type": "number",
                    "columnObj": {
                      "type": "reference",
                      "primary": false,
                      "nullable": true,
                      "references": "wallet_id",
                      "inTable": "servo_wallets",
                      "referenceType": "integer",
                      "onUpdate": "RESTRICT",
                      "onDelete": "RESTRICT",
                      "name": "wallet_privilege_wallet_id"
                    }
                  },
                  "operation": "=",
                  "table": "servo_user"
                },
                {
                  "id": "servo_wallet_privileges.wallet_privilege_user_id",
                  "field": "servo_wallet_privileges.wallet_privilege_user_id",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{$_GET.user_id}}",
                  "data": {
                    "table": "servo_wallet_privileges",
                    "column": "wallet_privilege_user_id",
                    "type": "number",
                    "columnObj": {
                      "type": "reference",
                      "primary": false,
                      "nullable": true,
                      "references": "user_id",
                      "inTable": "servo_user",
                      "referenceType": "integer",
                      "onUpdate": "RESTRICT",
                      "onDelete": "RESTRICT",
                      "name": "wallet_privilege_user_id"
                    }
                  },
                  "operation": "=",
                  "table": "servo_user"
                }
              ],
              "conditional": null,
              "valid": true
            }
          }
        },
        "output": true,
        "meta": [
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
            "name": "user_lname"
          },
          {
            "type": "text",
            "name": "user_username"
          },
          {
            "type": "number",
            "name": "wallet_privilege_wallet_id"
          },
          {
            "type": "text",
            "name": "wallet_privilege_deposit"
          },
          {
            "type": "number",
            "name": "wallet_privilege_user_id"
          },
          {
            "type": "text",
            "name": "wallet_privilege_transfer"
          },
          {
            "type": "text",
            "name": "wallet_privilege_payout"
          },
          {
            "type": "number",
            "name": "wallet_privilege_id"
          },
          {
            "type": "text",
            "name": "wallet_privilege_approve"
          },
          {
            "type": "text",
            "name": "wallet_privilege_receive"
          },
          {
            "type": "text",
            "name": "wallet_privilege_transfer_to"
          }
        ],
        "outputType": "array"
      },
      {
        "name": "query_wallet_privileges_user_transfer_to",
        "module": "dbconnector",
        "action": "select",
        "options": {
          "connection": "servodb",
          "sql": {
            "type": "select",
            "columns": [
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
                "column": "user_lname"
              },
              {
                "table": "servo_user",
                "column": "user_username"
              },
              {
                "table": "servo_wallet_privileges",
                "column": "wallet_privilege_wallet_id"
              },
              {
                "table": "servo_wallet_privileges",
                "column": "wallet_privilege_deposit"
              },
              {
                "table": "servo_wallet_privileges",
                "column": "wallet_privilege_user_id"
              },
              {
                "table": "servo_wallet_privileges",
                "column": "wallet_privilege_transfer"
              },
              {
                "table": "servo_wallet_privileges",
                "column": "wallet_privilege_payout"
              },
              {
                "table": "servo_wallet_privileges",
                "column": "wallet_privilege_id"
              },
              {
                "table": "servo_wallet_privileges",
                "column": "wallet_privilege_approve"
              },
              {
                "table": "servo_wallet_privileges",
                "column": "wallet_privilege_receive"
              },
              {
                "table": "servo_wallet_privileges",
                "column": "wallet_privilege_transfer_to"
              }
            ],
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
                "value": "{{$_GET.wallet_id}}",
                "test": ""
              },
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P2",
                "value": "{{$_GET.user_id}}",
                "test": ""
              }
            ],
            "table": {
              "name": "servo_user"
            },
            "primary": "user_id",
            "joins": [
              {
                "table": "servo_wallet_privileges",
                "column": "*",
                "type": "RIGHT",
                "clauses": {
                  "condition": "AND",
                  "rules": [
                    {
                      "table": "servo_wallet_privileges",
                      "column": "wallet_privilege_user_id",
                      "operator": "equal",
                      "operation": "=",
                      "value": {
                        "table": "servo_user",
                        "column": "user_id"
                      }
                    }
                  ]
                },
                "primary": "wallet_privilege_id"
              }
            ],
            "query": "select `servo_user`.`user_id`, `servo_user`.`user_fname`, `servo_user`.`user_lname`, `servo_user`.`user_username`, `servo_wallet_privileges`.`wallet_privilege_wallet_id`, `servo_wallet_privileges`.`wallet_privilege_deposit`, `servo_wallet_privileges`.`wallet_privilege_user_id`, `servo_wallet_privileges`.`wallet_privilege_transfer`, `servo_wallet_privileges`.`wallet_privilege_payout`, `servo_wallet_privileges`.`wallet_privilege_id`, `servo_wallet_privileges`.`wallet_privilege_approve`, `servo_wallet_privileges`.`wallet_privilege_receive`, `servo_wallet_privileges`.`wallet_privilege_transfer_to` from `servo_user` right join `servo_wallet_privileges` on `servo_wallet_privileges`.`wallet_privilege_user_id` = `servo_user`.`user_id` where `servo_wallet_privileges`.`wallet_privilege_wallet_id` = ? and `servo_wallet_privileges`.`wallet_privilege_user_id` = ?",
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "servo_wallet_privileges.wallet_privilege_wallet_id",
                  "field": "servo_wallet_privileges.wallet_privilege_wallet_id",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{$_GET.wallet_id}}",
                  "data": {
                    "table": "servo_wallet_privileges",
                    "column": "wallet_privilege_wallet_id",
                    "type": "number",
                    "columnObj": {
                      "type": "reference",
                      "primary": false,
                      "nullable": true,
                      "references": "wallet_id",
                      "inTable": "servo_wallets",
                      "referenceType": "integer",
                      "onUpdate": "RESTRICT",
                      "onDelete": "RESTRICT",
                      "name": "wallet_privilege_wallet_id"
                    }
                  },
                  "operation": "=",
                  "table": "servo_user"
                },
                {
                  "id": "servo_wallet_privileges.wallet_privilege_user_id",
                  "field": "servo_wallet_privileges.wallet_privilege_user_id",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{$_GET.user_id}}",
                  "data": {
                    "table": "servo_wallet_privileges",
                    "column": "wallet_privilege_user_id",
                    "type": "number",
                    "columnObj": {
                      "type": "reference",
                      "primary": false,
                      "nullable": true,
                      "references": "user_id",
                      "inTable": "servo_user",
                      "referenceType": "integer",
                      "onUpdate": "RESTRICT",
                      "onDelete": "RESTRICT",
                      "name": "wallet_privilege_user_id"
                    }
                  },
                  "operation": "=",
                  "table": "servo_user"
                }
              ],
              "conditional": null,
              "valid": true
            }
          }
        },
        "output": true,
        "meta": [
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
            "name": "user_lname"
          },
          {
            "type": "text",
            "name": "user_username"
          },
          {
            "type": "number",
            "name": "wallet_privilege_wallet_id"
          },
          {
            "type": "text",
            "name": "wallet_privilege_deposit"
          },
          {
            "type": "number",
            "name": "wallet_privilege_user_id"
          },
          {
            "type": "text",
            "name": "wallet_privilege_transfer"
          },
          {
            "type": "text",
            "name": "wallet_privilege_payout"
          },
          {
            "type": "number",
            "name": "wallet_privilege_id"
          },
          {
            "type": "text",
            "name": "wallet_privilege_approve"
          },
          {
            "type": "text",
            "name": "wallet_privilege_receive"
          },
          {
            "type": "text",
            "name": "wallet_privilege_transfer_to"
          }
        ],
        "outputType": "array"
      }
    ]
  }
}
JSON
);
?>