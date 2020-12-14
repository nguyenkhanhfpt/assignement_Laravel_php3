<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendWeeklyReport;
use App\Bill;
use Carbon\Carbon;
use DB;

class WeeklyReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weekly:report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Weekly Report';

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
        $statistical = Bill::select(DB::raw(DB::raw('count(id) as count')))
            ->whereDate('date_buy', '>' ,Carbon::now()->subDays(7))
            ->get();

        $datas = $statistical[0]->count;

        Mail::to(config('settings.mail_admin'))->send(new SendWeeklyReport($datas));
    }
}
