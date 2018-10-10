<?php
use Migrations\AbstractSeed;

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
        $data = [
            [
                'id' => '13',
                'email' => 'youcef-pino@hotmail.fr',
                'password' => '$2y$10$fDghZhJLlIihmPgwealg/OUlokg815O1we58xM0d0lxJTRdz3TdA2',
                'created' => '9',
                'modified' => '9',
                'role' => 'admin',
            ],
            [
                'id' => '19',
                'email' => 'bobeponge@hotmail.com',
                'password' => '$2y$10$kp4q8ymbMI8/3Wha.bPBOOhOtjaEv2rOoDqKRT.MTm.vjcVJSROge',
                'created' => '18',
                'modified' => '18',
                'role' => 'toBeCustomer',
            ],
            [
                'id' => '20',
                'email' => 'cynt@bidon.com',
                'password' => '$2y$10$ef31Ud4bEAmKSE6bH4cZOuS4pSIYNUqm9pdpTQkt9xR7qRC/tioe6',
                'created' => '18',
                'modified' => '18',
                'role' => 'toBeCustomer',
            ],
            [
                'id' => '21',
                'email' => 'camarche@gmail.com',
                'password' => '$2y$10$m.UL/Ur2BldPSaC473W.kucYjgbXx9w5.9jSky6csnN8z9BErrjQy',
                'created' => '18',
                'modified' => '18',
                'role' => 'toBeCustomer',
            ],
            [
                'id' => '26',
                'email' => 'bobeponge@hotmail.dessin',
                'password' => '$2y$10$khjiKWDH9wgC.91mpbtI1uMr0yrcY5UKsJSQ2ZoTYdU.8agB/V3lu',
                'created' => '18',
                'modified' => '18',
                'role' => 'toBeEmploye',
            ],
            [
                'id' => '28',
                'email' => 'grr@grr.com',
                'password' => '$2y$10$S1GbIEVdTU1u45kGsU9wLOeE/1oDVonl2Q8m87GBhJnuP9lY/WktK',
                'created' => '18',
                'modified' => '10',
                'role' => 'toBeEmploye',
            ],
        ];

        $table = $this->table('users');
        $table->insert($data)->save();
    }
}
