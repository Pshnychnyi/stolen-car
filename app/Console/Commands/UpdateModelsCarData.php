<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class UpdateModelsCarData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:car-models';

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

            $getAllModels = 'https://vpic.nhtsa.dot.gov/api/vehicles/getmodelsformakeid/0?format=json';

            $models = Http::get($getAllModels);
            $data = json_decode($models->getBody(), true);
            $result = $data['Results'];

            foreach (array_chunk($result,500) as $t)
            {
                DB::table('models')->insertOrIgnore($t);
            }


            echo 'End';
            Db::commit();
        } catch (\Exception $e) {
            echo $e->getMessage();
            Db::rollBack();
        }

    }
}
