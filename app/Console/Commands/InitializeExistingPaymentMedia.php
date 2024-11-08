<?php

namespace App\Console\Commands;

use App\Models\Event;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class InitializeExistingPaymentMedia extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:initialize-media';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialize existing payment media';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $events = Event::all();

        foreach ($events as $key => $value) {

            $visitors = $value->visitors;

            foreach ($visitors as $key => $visitor) {
                if ($visitor->is_offline) {

                    $path = $visitor->meta['payment_path'];

                    // check if the path is available
                    if (Storage::exists($path)) {
                        $media = $visitor->addMedia(storage_path('app/' . $path), 'payments')
                            ->preservingOriginal()
                            ->toMediaCollection('payment');
                    }

                }else{
                    print_r('Unavailable');
                }

                print_r("\n");
            }
        }
    }
}
