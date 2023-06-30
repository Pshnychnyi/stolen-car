<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class UpdateMakesCarData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:car-makes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            Db::beginTransaction();

            $getAllMakes = 'https://vpic.nhtsa.dot.gov/api/vehicles/getallmakes?format=json';

            $makes = Http::get($getAllMakes);

            $data = json_decode($makes->getBody(), true);

            $result = $data['Results'];

            foreach (array_chunk($result,500) as $t)
            {
                Db::table('makes')->insertOrIgnore($result);
            }

            echo 'End';
            Db::commit();
        } catch (\Exception $e) {
            echo $e->getMessage();
            Db::rollBack();
        }
    }
}
