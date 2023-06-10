<?php

namespace App\Http\Controllers;
use Notification;
use Illuminate\Http\Request;
use App\Notifications\Ticket;
use App\Models\User as User;

class TicketNotificationController extends Controller
{
    public function sendOfferNotification() {
        $userSchema = User::first();

        $offerData = [
            'name' => 'BOGO',
            'body' => 'You received an offer.',
            'thanks' => 'Thank you',
            'offerText' => 'Check out the offer',
            'offerUrl' => url('/'),
            'offer_id' => 007
        ];

        Notification::send($userSchema, new Ticket($offerData));

        dd('Task completed!');
    }
}
