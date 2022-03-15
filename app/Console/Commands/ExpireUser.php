<?php

namespace App\Console\Commands;

use App\Event;
use App\Mail\UserExpire;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class ExpireUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expire:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Expired User';

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
        $now = Carbon::now();
        $events = Event::query()->whereDate('end_date', '<', $now)->get();
        foreach ($events as $event) {
            $user_queries = User::query()->where('event_id', '=', $event->id)
                ->get();
            foreach ($user_queries as $user_query) {
                $user = User::query()
                    ->where('id', $user_query->id)
                    ->first();
                $email = $user->email;
                $name = $user->name;
                Mail::to($email)->send(new UserExpire($name));
                $user->reviveExpired();
            }
        }
    }
}
