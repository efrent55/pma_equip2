<?php

use Illuminate\Database\Seeder;
use App\Account;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $account = new Account();
        $account->code = '201';
        $account->description = 'Land';
        $account->classification = 0;
        $account->save();

        $account = new Account();
        $account->code = '202';
        $account->description = 'Land Improvement';
        $account->classification = 0;
        $account->save();

        $account = new Account();
        $account->code = '211';
        $account->description = 'Office Buildings';
        $account->classification = 0;
        $account->save();

        $account = new Account();
        $account->code = '212';
        $account->description = 'School Buildings';
        $account->classification = 0;
        $account->save();

        $account = new Account();
        $account->code = '213';
        $account->description = 'Hospitals and Health Centers';
        $account->classification = 0;
        $account->save();

        $account = new Account();
        $account->code = '215';
        $account->description = 'Other Structures';
        $account->classification = 0;
        $account->save();

        $account = new Account();
        $account->code = '221';
        $account->description = 'Office Equipment';
        $account->classification = 1;
        $account->save();

        $account = new Account();
        $account->code = '222';
        $account->description = 'Furniture and Fixtures';
        $account->classification = 1;
        $account->save();

        $account = new Account();
        $account->code = '223';
        $account->description = 'IT Equipment and Software';
        $account->classification = 1;
        $account->save();

        $account = new Account();
        $account->code = '226';
        $account->description = 'Machineries';
        $account->classification = 1;
        $account->save();

        $account = new Account();
        $account->code = '229';
        $account->description = 'Communication Equipment';
        $account->classification = 1;
        $account->save();

        $account = new Account();
        $account->code = '230';
        $account->description = 'Construction and Heavy Equipment';
        $account->classification = 1;
        $account->save();

        $account = new Account();
        $account->code = '231';
        $account->description = 'Firefighting Equipment';
        $account->classification = 1;
        $account->save();

        $account = new Account();
        $account->code = '232';
        $account->description = 'Hospital Equipment';
        $account->classification = 1;
        $account->save();

        $account = new Account();
        $account->code = '233';
        $account->description = 'Medical, Dental and Laboratory Equipment';
        $account->classification = 1;
        $account->save();

        $account = new Account();
        $account->code = '234';
        $account->description = 'Military and Police Equipment';
        $account->classification = 1;
        $account->save();

        $account = new Account();
        $account->code = '235';
        $account->description = 'Sports Equipment';
        $account->classification = 1;
        $account->save();

        $account = new Account();
        $account->code = '236';
        $account->description = 'Technical and Scientific Equipment';
        $account->classification = 1;
        $account->save();

        $account = new Account();
        $account->code = '240';
        $account->description = 'Other Machineries and Equipment';
        $account->classification = 1;
        $account->save();

        $account = new Account();
        $account->code = '241';
        $account->description = 'Motor Vehicles';
        $account->classification = 1;
        $account->save();

        $account = new Account();
        $account->code = '248';
        $account->description = 'Other Transportation Equipment';
        $account->classification = 1;
        $account->save();

        $account = new Account();
        $account->code = '250';
        $account->description = 'Other Property, Plant and Equipment';
        $account->classification = 1;
        $account->save();
    }
}
