<?php

namespace App\Listeners;

use App\Mail\SeriesCreated as SeriesCreatedMail;
use App\Events\SeriesCreated as SeriesCreatedEvent;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class EmailUsersAboutSeriesCreated
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(SeriesCreatedEvent $event)
    {
        $usersList = User::all();
        foreach ($usersList as $index => $user) {
            $email = new SeriesCreatedMail(
                $event->seriesId,
                $event->seriesName,
                $event->seriesSeasons,
                $event->seriesEpisodes
            );
            $when = now()->addSeconds($index * 10);
            Mail::to($user)->later($when, $email);
        }
    }
}
