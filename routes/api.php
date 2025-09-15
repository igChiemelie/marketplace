<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Webhook\PaystackWebhookController;

Route::post('/paystack/webhook', [PaystackWebhookController::class, 'handle'])
    ->name('paystack.webhook');
