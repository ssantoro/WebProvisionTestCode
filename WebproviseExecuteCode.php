<?php

namespace App\Console\Commands;

use App\Models\MachineMemoryWord;
use App\Models\TestOptimal;
use App\Models\WebproviseCompany;
use App\Models\WebproviseTravel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SeedWebproviseCompanies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'webp:exec';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Webprovide Execute Code';

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
        $companies = WebproviseCompany::all();

        $output = [];
        foreach ($companies as $c) {
            $temp = [];
            $temp['id'] = $c->id;
            $temp['name'] = $c->name;
            $temp['children'] = $this->getChildren($c->id,[]);
            $temp['cost'] = $this->getCostOfTravel($c->id);
            $this->info(print_r($temp));
            $output[] = $temp;
        }
        dd($output);
    }

    public function getChildren($companyId,$array) {

        $children = WebproviseCompany::where('parentId',$companyId)->get();

        foreach($children as $child) {
            $temp = [];
            $temp['id'] = $child->id;
            $temp['name'] = $child->name;
            $temp['children'] = $this->getChildren($child->id,[]);
            $temp['cost'] = $this->getCostOfTravel($child->id);
            $array[] = $temp;
        }
        return $array;
    }

    public function getCostOfTravel($companyId) {

        $cost = WebproviseTravel::select(
            DB::raw('SUM(price) as cost')
        )->where('companyId',$companyId)
            ->first();
        return $cost ? $cost->cost: 0;

    }

}
