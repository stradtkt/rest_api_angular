<?php

namespace App\Services;

use App\Models\User;

class NotificationService
{
    public function sendWelcomeMessage(User $user)
    {
        // Custom logic
        return "Welcome, {$user->name}!";
    }

    public function sendReminder(User $user)
    {
        // More logic
        return "Hey {$user->name}, don't forget to check your tasks!";
    }
}
