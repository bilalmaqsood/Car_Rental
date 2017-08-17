<?php

use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('clients')->insert(array (
            array (
                'id' => 1,
                'user_id' => 4,
                'status' => 0,
                'dlc' => 0,
                'insurance' => NULL,
                'driving' => NULL,
                'dvla' => 'JCP',
                'postcode' => 'cv3 4gh',
                'dob' => '1999-08-14',
                'pco_number' => '25',
                'pco_release_date' => '2017-01-01',
                'pco_expiry_date' => '2017-12-31',
                'documents' => '[{"doc": "driving_licence", "path": "http://qwikkar.srhive.com/storage/images/HX4CeW3sejdjcPhgi9sz5P0eOBqVp0anUtEuMliH.png", "title": "Driving Licence", "isShowingDoc": false}, {"doc": "pco_licence", "path": "http://qwikkar.srhive.com/storage/images/WKzEiQ7DS1i9qn1NehwjqZmZohnX4j3BgsTB4G4i.jpeg", "title": "PCO Licence", "isShowingDoc": false}, {"doc": "dbs_certificate", "path": "http://qwikkar.srhive.com/storage/images/7uaTIz58CwOL8fjwo74pxonb3TH3Irkmjl5lyfMS.jpeg", "title": "DBS certificate", "isShowingDoc": false}, {"doc": "proof_of_address", "path": "http://qwikkar.srhive.com/storage/images/XbagUBLRQEjTcUPUG6NgRursai7dXmdOySTFWldt.jpeg", "title": "Proof of address", "isShowingDoc": false}]',
                'created_at' => '2017-08-15 12:15:27',
                'updated_at' => '2017-08-16 18:24:31',
            ),
            array (
                'id' => 2,
                'user_id' => 6,
                'status' => 0,
                'dlc' => 0,
                'insurance' => '458745874',
                'driving' => '47854125',
                'dvla' => NULL,
                'postcode' => 'TD9 5ZN',
                'dob' => '2017-08-16',
                'pco_number' => '58745587',
                'pco_release_date' => NULL,
                'pco_expiry_date' => '2018-02-14',
                'documents' => NULL,
                'created_at' => '2017-08-16 09:30:24',
                'updated_at' => '2017-08-16 09:30:24',
            ),
            array (
                'id' => 3,
                'user_id' => 8,
                'status' => 0,
                'dlc' => 0,
                'insurance' => NULL,
                'driving' => NULL,
                'dvla' => 'wertyu',
                'postcode' => 'AB2 0AB',
                'dob' => '1999-08-01',
                'pco_number' => '123456789',
                'pco_release_date' => '2017-08-16',
                'pco_expiry_date' => '2017-08-16',
                'documents' => NULL,
                'created_at' => '2017-08-16 17:45:52',
                'updated_at' => '2017-08-16 17:45:52',
            ),
        ));
    }
}