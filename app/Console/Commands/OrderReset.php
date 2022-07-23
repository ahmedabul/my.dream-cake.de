<?php

namespace App\Console\Commands;

use App\Order;
use Illuminate\Console\Command;
use phpDocumentor\Reflection\Types\Null_;

class OrderReset extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Command runs every 24 Hours to reset all Orders, they were NOT delivered to deliver they agin';

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
       Order::reset(); 
    }
}
