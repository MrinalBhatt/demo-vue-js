<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;

Route::get('/fetch-data', [ApiController::class, 'getApiData']);

