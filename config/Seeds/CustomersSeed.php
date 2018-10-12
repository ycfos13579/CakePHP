<?php
use Migrations\AbstractSeed;

/**
 * Customers seed.
 */
class CustomersSeed extends AbstractSeed
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
                'id' => '4',
                'address_id' => '8',
                'name' => 'Oussama Youcef Bokari',
                'customer' => '1235fgfdg',
                'created' => '2018-10-11 13:13:35',
                'modified' => '2018-10-11 13:13:35',
            ],
            [
                'id' => '6',
                'address_id' => '8',
                'name' => 'michel shrerer',
                'customer' => 'travailleur',
                'created' => '2018-10-11 17:09:53',
                'modified' => '2018-10-11 17:09:53',
            ],
        ];

        $table = $this->table('customers');
        $table->insert($data)->save();
    }
}
