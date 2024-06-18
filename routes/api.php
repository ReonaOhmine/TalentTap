<?php
use App\Http\Controllers\MessagesController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/send-message', [MessagesController::class, 'sendMessage']);
    Route::get('/get-messages', [MessagesController::class, 'getMessages']);
});
