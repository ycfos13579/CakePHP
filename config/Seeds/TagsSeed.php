<?php
use Migrations\AbstractSeed;

/**
 * Tags seed.
 */
class TagsSeed extends AbstractSeed
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
        $data = [
            [
                'id' => '1',
                'title' => 'premier tag',
                'created' => '2018-09-27 14:39:31',
                'modified' => '2018-09-27 14:39:31',
            ],
            [
                'id' => '2',
                'title' => 'cvd',
                'created' => '2018-09-27 16:45:37',
                'modified' => '2018-09-27 16:45:37',
            ],
            [
                'id' => '3',
                'title' => 'bmbm',
                'created' => '2018-10-07 17:18:40',
                'modified' => '2018-10-07 17:18:40',
            ],
        ];

        $table = $this->table('tags');
        $table->insert($data)->save();
    }
}
