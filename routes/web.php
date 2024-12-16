<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\SparepartController;
use App\Http\Controllers\TransactionSparepartController;
use App\Http\Controllers\ReportSparepartController;

Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/change-password', [UserController::class, 'changePassword'])->name('changePassword');
Route::put('/update-password', [UserController::class, 'updatePassword'])->name('updatePassword');


Route::resources([
    'roles'         => RoleController::class,
    'users'         => UserController::class,
    'units'         => UnitController::class,
    'locations'     => LocationController::class,
    'spareparts'    => SparepartController::class,    
]);

Route::post('/spareparts/addDetail', [SparepartController::class, 'addDetail'])->name('sparepartsCreateDetail');
Route::delete('/spareparts/deleteDetail/{id}', [SparepartController::class, 'deleteDetail'])->name('sparepartsDeleteDetail');

Route::get('/warehouse-spareparts-in', [TransactionSparepartController::class, 'warehouseSparepartIn'])->name('warehouseSparepartIn');
Route::post('/warehouse-spareparts-in-insert', [TransactionSparepartController::class, 'warehouseSparepartInInsert'])->name('warehouseSparepartInInsert');

Route::get('/stock-warehouse-spareparts', [TransactionSparepartController::class, 'warehouseSparepartStock'])->name('warehouseSparepartStock');

Route::get('/warehouse-spareparts-out', [TransactionSparepartController::class, 'warehouseSparepartOut'])->name('warehouseSparepartOut');
Route::post('/warehouse-spareparts-out-insert', [TransactionSparepartController::class, 'warehouseSparepartOutInsert'])->name('warehouseSparepartOutInsert');

Route::get('/stock-warehouse-spareparts/export-excel', [TransactionSparepartController::class, 'stockPerLocation']);

Route::get('/location-sparepart-in', [TransactionSparepartController::class, 'locationSparepartIn'])->name('locationSparepartIn');
Route::get('/location-sparepart-in-insert', [TransactionSparepartController::class, 'locationSparepartInInInsert'])->name('locationSparepartInInInsert');

Route::get('/location-sparepart-buy', [TransactionSparepartController::class, 'locationSparepartBuy'])->name('locationSparepartBuy');
Route::post('/location-sparepart-buy-insert', [TransactionSparepartController::class, 'locationSparepartBuyInsert'])->name('locationSparepartBuyInsert');

Route::get('/location-sparepart-out', [TransactionSparepartController::class, 'locationSparepartOut'])->name('locationSparepartOut');
Route::post('/location-sparepart-out-insert', [TransactionSparepartController::class, 'locationSparepartOutInsert'])->name('locationSparepartOutInsert');

Route::get('/location-sparepart-stock', [TransactionSparepartController::class, 'locationSparepartStock'])->name('locationSparepartStock');

Route::get('/report-all-sparepart', [ReportSparepartController::class, 'reportAllSparepart'])->name('reportAllSparepart');
Route::get('/report-all-sparepart/export-excel', [ReportSparepartController::class, 'stockAllPerLocation']);
Route::get('/report-all-sparepart/export-excel-all', [ReportSparepartController::class, 'stockAll']);
Route::get('/report-sparepart-unit', [ReportSparepartController::class, 'sparepartUnit']);
Route::get('/report-stock-sparepart', [ReportSparepartController::class, 'reportStockSparepart'])->name('reportStockSparepart');

Route::get('/sparepart-unit', [ReportSparepartController::class, 'reportSparepartUnit'])->name('reportSparepartUnit');

Route::get('/export-unit', [UnitController::class, 'exportExcel'])->name('exportExcelUnit');
Route::get('/export-user', [UserController::class, 'exportExcel'])->name('exportExcelUser');

