<?php

use App\Http\Controllers\DoorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\VendorController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::get('/sitemap', [SitemapController::class, 'getSiteMap']);
Route::get('/{URL}', [DoorController::class, 'show_seodoor'])->name("seodoor");
Route::post('/{URL}', [DoorController::class, 'store_log_seodoor']);

Route::get('/admin/plantypes', [PlanController::class, 'planTypeIndex'])->name("create-plan-type");
Route::post('/admin/plantypes', [PlanController::class, 'planTypeStore']);

Route::get('/admin/vendors', [VendorController::class, 'index'])->name("create-vendor");
Route::post('/admin/vendors', [VendorController::class, 'store']);
Route::get('/admin/vendors/{id}', [VendorController::class, 'show'])->name("single-vendor");
Route::post('/admin/vendors/{id}', [VendorController::class, 'update']);
// TODO router doors
Route::get('/admin/vendors/{vendor_id}/doors', [DoorController::class, 'index'])->name("doors");
Route::post('/admin/vendors/{vendor_id}/doors', [DoorController::class, 'store']);
Route::get('/admin/vendors/{vendor_id}/doors/{id}', [DoorController::class, 'show'])->name("single-door");
Route::delete('/admin/vendors/{vendor_id}/doors/{id}', [DoorController::class, 'del'])->name("delete-door");


Route::get('admin/update', function () {
    // execute command
    exec("cd /home/ubuntu/seodoor/;  git pull; php artisan config:cache; php artisan route:cache; php artisan route:cache", $output);
    return $output;
    // print output from command
    // $this->comment(implode(PHP_EOL, $output));
});
