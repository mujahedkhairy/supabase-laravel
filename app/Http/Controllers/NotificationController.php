<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Models\User; // Ensure you have a User model or similar to fetch user data
use App\Models\Notification;

class NotificationController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => env('SUPABASE_URL'),
            'headers' => [
                'apikey' => env('SUPABASE_KEY'),
                'Authorization' => 'Bearer ' . env('SUPABASE_KEY'),
            ]
        ]);
    }

    /**
     * Display the form to send notifications.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showNotificationForm()
    {
        return view('notifications.form');
    }

    /**
     * Send notification to all users.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendNotificationToAll(Request $request)
    {
        $title = $request->input('title');     // Get the title from form input
        $message = $request->input('message'); // Get the message from form input

        // Fetch all users
        $users = User::all();
        echo 'All users: ';
        print_r($users->toArray()); // Convert the collection to an array for readability
        echo '<br>'; // Just for

        // Send notification to each user
        foreach ($users as $user) {
           
            // Save each notification to the database
            $notification = new Notification([
                'user_id' => $user->id,
                'title' => $title,
                'message' => $message,
                'read_status' => false,
            ]);
            $notification->save();



            // $this->client->post(env('SUPABASE_URL'), [
            //     'json' => [
            //         'user_id' => $user->id,
            //         'title' => $title,
            //         'message' => $message,
            //         'read_status' => false
            //     ]
            // ]);
        }

        // Redirect back to the form with a success message
        return redirect('/notifications/form')->with('success', 'Notifications sent successfully to all users!');
    }
}
