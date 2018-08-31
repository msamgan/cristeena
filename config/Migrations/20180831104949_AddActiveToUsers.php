<?php
use Migrations\AbstractMigration;

class AddActiveToUsers extends AbstractMigration
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
        $table->addColumn('active', 'enum', [
            'values' => [
                'yes',
                'no'
            ],
            'default' => 'yes',
            'null' => true,
            'after' => 'profile_image'
        ]);
        $table->update();
    }
}
