<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use PhpAmqpLib\Connection\AMQPStreamConnection;

Route::get('/', function () {
    return view('welcome');
});