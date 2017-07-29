<?php

use Illuminate\Database\Seeder;

class BanksTableSeeder extends Seeder 
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $banks = ['FIRST CITY MONUMENT BANK PLC', 'UNITY BANK PLC', 'STANBIC IBTC BANK PLC', 'STERLING BANK PLC', 'Aso Savings and Loans', 'ACCESS BANK NIGERIA', 'AFRIBANK NIGERIA PLC', 'DIAMOND BANK PLC', 'ECOBANK NIGERIA PLC', 'ENTERPRISE BANK LIMITED', 'FIDELITY BANK PLC', 'FIRST BANK PLC', 'GTBANK PLC', 'HERITAGE BANK', 'KEYSTONE BANK PLC', 'SKYE BANK PLC', 'STANDARD CHARTERED BANK NIGERIA LIMITED', 'UNION BANK OF NIGERIA PLC', 'UNITED BANK FOR AFRICA (UBA) PLC', 'WEMA BANK PLC', 'ZENITH BANK PLC'];

        $bank_code = [12345, 567, 789, 90743, 2346, 22323, 23323];
 
        foreach($banks as $bank){
           
	        DB::table('banks')->insert([
	            'bank_code' => $bank_code[ array_rand($bank_code, 1) ],
	            'bank_name' => $bank,
	        ]);
        }

    }
}
