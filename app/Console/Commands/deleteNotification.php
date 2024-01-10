<?php

namespace App\Console\Commands;

use App\Models\AdminNotification;
use App\Models\DesignerNotification;
use Illuminate\Console\Command;

class deleteNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-notification';

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
        // $thresholdTime = now()->subHours(24);
        $thresholdTime = now()->subHours(24);
        AdminNotification::where('status', false)
            ->where('updated_at', '<', $thresholdTime)
            ->delete();
        DesignerNotification::where('status', false)
            ->where('updated_at', '<', $thresholdTime)
            ->delete();
    }
}
