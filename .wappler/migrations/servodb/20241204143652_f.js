
exports.up = function (knex) {
  return knex.schema
    .createTable('role_user', async function (table) {
      table.increments('id');
    })
    .table('servo_role_user', async function (table) {
      table.integer('user_id').alter().unsigned();
      table.foreign('user_id').references('id').inTable('servo_user').onUpdate('CASCADE').onDelete('CASCADE');
    })

};

exports.down = function (knex) {
  return knex.schema
    .table('servo_role_user', async function (table) {
      await table.dropForeign('user_id');
      table.integer('id').alter();
    })
    .dropTable('role_user')
};
