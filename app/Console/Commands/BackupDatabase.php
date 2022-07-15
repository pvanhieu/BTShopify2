<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use File;
use DB;

class BackupDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'database:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        DB::table('product')->orderBy('id')->chunk('10', function ($products, $i=1) {
            $columns = array('id','name','price','quantity','description');
            $file = fopen(storage_path('backup/'.date('d-m-Y')."-$i-backup.csv"), 'w');
            fputcsv($file, $columns);
            foreach ($products as $product) {
                $row['id'] = $product->id;
                $row['name'] = $product->name;
                $row['price'] = $product->price;
                $row['quantity'] = $product->quantity;
                $row['description'] = $product->description;
                fputcsv($file, array($row['id'],$row['name'],$row['price'],$row['quantity'],$row['description']));
            }
            fclose($file);
            $i++;
        });
    }
}
