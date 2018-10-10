<?php
use Migrations\AbstractSeed;

/**
 * AddressesTags seed.
 */
class AddressesTagsSeed extends AbstractSeed
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
                'address_id' => '8',
                'tag_id' => '3',
            ],
        ];

        $table = $this->table('addresses_tags');
        $table->insert($data)->save();
    }
}
