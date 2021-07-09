<?php


use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run()
    {
        $data = [
            [
                'email'    => 'user@test.te',
                'password' => sha1('password'),
            ],[
                'email'    => 'user1@test.te',
                'password' => sha1('password'),
            ]
        ];

        $posts = $this->table('users');
        $posts->insert($data)
            ->saveData();
    }
}
