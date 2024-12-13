
exports.up = function(knex) {
  return knex.schema
    .createTable('role_user', async function (table) {
      table.increments('id');
    })
    .createTable('servo_permissions_user', async function (table) {
      table.increments('id');
      table.integer('role_id');
      table.integer('permission_id');
    })

};

exports.down = function(knex) {
  return knex.schema
    .dropTable('servo_permissions_user')
    .dropTable('role_user')
};
