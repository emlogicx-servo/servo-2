
exports.up = function(knex) {
  return knex.schema
    .createTable('role_user', async function (table) {
      table.increments('id');
    })
    .renameTable('servo_permissions_user', 'servo_permissions_role')

};

exports.down = function(knex) {
  return knex.schema
    .renameTable('servo_permissions_role', 'servo_permissions_user')
    .dropTable('role_user')
};
