<?php
use Migrations\AbstractSeed;
use Cake\Auth\DefaultPasswordHasher;
/**
 * Users seed.
 */
class UsersSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $hasher = new DefaultPasswordHasher();
        $data = [
            [
                'role_id' => 1,
                'name' => 'Default Admin',
                'slug' => 'default-admin'."-".time(),
                'email' => 'admin@project.com',
                'password' => $hasher->hash('123456'),
                'created' => date('Y-m-d H:i:s')
            ],
            [
                'role_id' => 2,
                'name' => 'Default User',
                'slug' => 'default-user'."-".time(),
                'email' => 'user@project.com',
                'password' => $hasher->hash('123456'),
                'created' => date('Y-m-d H:i:s')
            ]
        ];

        $table = $this->table('users');
        $table->insert($data)->save();
    }
}
