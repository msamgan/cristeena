<?php
use Migrations\AbstractMigration;

class CreateUsers extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('users');
        $table->addColumn('role_id', 'integer', [
            'default' => 3,
            'limit' => 11,
            'null' => false,
        ])->addIndex(['role_id'])->addForeignKey(
            'role_id',
            'roles',
            'id'
        );
        $table->addColumn('name', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('slug', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('email', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('password', 'text', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('profile_image', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('created', 'timestamp', [
            'default' => CURRENT_TIMESTAMP,
            'null' => true,
        ]);
        $table->create();

    }
}
