<?php

namespace App\Console\Commands;

use App\Models\Subscription;
use Illuminate\Console\Command;

class DeleteRecordCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-record-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'delete subscription if payment not done';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $thresholdTime = now()->subHours(24);
        Subscription::where('is_active', false)
            ->where('created_at', '<', $thresholdTime)
            ->delete();

            $this->info('Records deleted successfully.');
    }
}
