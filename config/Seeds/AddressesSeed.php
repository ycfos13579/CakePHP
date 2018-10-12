<?php
use Migrations\AbstractSeed;

/**
 * Addresses seed.
 */
class AddressesSeed extends AbstractSeed
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
                'id' => '8',
                'user_id' => '13',
                'title' => '287 rue de limoges',
                'slug' => 'nvgn djasldkasdas;ld',
                'body' => 'ad efsdf sef ',
                'published' => '0',
                'created' => '2018-10-08 20:16:50',
                'modified' => '2018-10-08 22:58:32',
            ],
        ];

        $table = $this->table('addresses');
        $table->insert($data)->save();
    }
}
