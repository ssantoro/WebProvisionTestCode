<?php

namespace App\Console\Commands;

use App\Models\MachineMemoryWord;
use App\Models\TestOptimal;
use App\Models\WebproviseTravel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SeedWebproviseTravels extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed:travels';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'seed travels';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $travels = json_decode(file_get_contents("https://5f27781bf5d27e001612e057.mockapi.io/webprovise/travels"));

        foreach ($travels as $t) {

            $t->id = str_replace('uuid-t','',$t->id);
            $t->companyId = str_replace('uuid-','',$t->companyId);

            $model = WebproviseTravel::where('id',$t->id)->first();
            if(!$model) {
                $model = new WebproviseTravel();
            }
            if(is_numeric($t->id)) {
                $model->id = $t->id;
                $model->createdAt = date('Y-m-d H:i:s',strtotime($t->createdAt));
                $model->employeeName = $t->employeeName;
                $model->departure = $t->departure;
                $model->destination = $t->destination;
                $model->price = $t->price;
                $model->companyId = $t->companyId != 0 && is_numeric($t->companyId) ? $t->companyId:null;
                $model->save();
            }

        }

    }

}
