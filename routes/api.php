<?php

use App\Http\Controllers\FarmController;
use App\Http\Controllers\TurbineController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/farms', [FarmController::class, 'index']);
Route::get('/farms/{farmId}', [FarmController::class, 'show'])
    ->whereNumber('farmId');

Route::get('/farms/{farmId}/turbines', [TurbineController::class, 'index'])
    ->whereNumber('farmId');
Route::get('/farms/{farmId}/turbines/{turbineId}', [TurbineController::class, 'show'])
    ->whereNumber(['farmId', 'turbineId']);

Route::get('/turbines', [TurbineController::class, 'index']);
Route::get('/turbines/{turbineId}', [TurbineController::class, 'show'])
    ->whereNumber('turbineId');


//
//
//`/turbines/components` -> `ComponentController::index`
//
//`/turbines/components/{componentId}` -> `ComponentController::show`
//
//`/turbines/inspections` -> `InspectionController::index`
//
//`/turbines/inspections/{inspectionId}` -> `InspectionController::show`
//
//`/components` -> `ComponentController::index`
//
//`/components/{componentId}` -> `ComponentController::show`
//
//`/components/{componentId}/grades` -> `GradeController::index`
//
//`/components/{componentId}/grades/{gradeId}` -> `GradeController::show`
//
//`/inspections` -> `InspectionController::index`
//
//`/inspections/{inspectionId}` -> `InspectionController::show`
//
//`/inspections/{inspectionId}/grades` -> `GradeController::index`
//
//`/inspections/{inspectionId}/grades/{gradeId}` -> `GradeController::show`
//
//`/grades` -> `GradeController::index`
//
//`/grades/{gradeId}` -> `GradeController::show`
//
//`/component-type` -> `ComponentTypeController::index`
//
//`/component-type/{componentTypeId}` -> `ComponentTypeController::show`
//
//`/grade-type` -> `GradeTypeController::index`
//
//`/grade-type/{gradeTypeId}` -> `GradeTypeController::show`
