<?php
use Migrations\AbstractSeed;

/**
 * Files seed.
 */
class FilesSeed extends AbstractSeed
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
                'name' => 'Béjaia.jpg',
                'path' => 'Files/',
                'created' => '2018-10-08 23:46:13',
                'modified' => '2018-10-08 23:46:13',
                'status' => '1',
            ],
            [
                'id' => '2',
                'name' => 'youc.png',
                'path' => 'Files/',
                'created' => '2018-10-11 13:35:01',
                'modified' => '2018-10-11 13:35:01',
                'status' => '1',
            ],
        ];

        $table = $this->table('files');
        $table->insert($data)->save();
    }
}
