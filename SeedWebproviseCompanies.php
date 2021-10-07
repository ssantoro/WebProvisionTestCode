<?php

namespace App\Console\Commands;

use App\Models\MachineMemoryWord;
use App\Models\TestOptimal;
use App\Models\WebproviseCompany;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SeedWebproviseCompanies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed:companies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'seed companies';

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
        $companies = json_decode(file_get_contents("https://5f27781bf5d27e001612e057.mockapi.io/webprovise/companies"));

        foreach ($companies as $c) {
            $c->id = str_replace('uuid-','',$c->id);
            $c->parentId = str_replace('uuid-','',$c->parentId);
            $model = WebproviseCompany::where('id',$c->id)->first();
            if(!$model) {
                $model = new WebproviseCompany();
            }
            if(is_numeric($c->id)) {
                $model->id = $c->id;
                $model->createdAt = date('Y-m-d H:i:s',strtotime($c->createdAt));
                $model->name = $c->name;
                $model->parentId = $c->parentId != 0 && is_numeric($c->parentId) ? $c->parentId:null;
                $model->save();
            }

        }


    }

}
