<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 404;
});

Route::get('/{address}/{port}', function ($address, $port) {
    $address = gethostbyname($address);
    $newAddress = "steam://connect/{$address}:{$port}";
    // return $newAddress;
    return redirect()->to($newAddress);
});
