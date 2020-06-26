<?php

use App\Http\Controllers\Api\AuthController;
use \App\Http\Controllers\Api\UserController;
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

Route::prefix('v1/')->name("v1.")->middleware(["ACLPermissions"])->group(function (){

    Route::group(['prefix' => "auth"], function () {

        Route::post('login', [AuthController::class, "login"]);

    });

    Route::group(['middleware' => ["apiJWT"]], function (){

        Route::name("api.")->group(function (){

            Route::prefix("auth")->name("auth.")->group(function () {

                Route::post('logout', [AuthController::class, "logout"])->name("logout")
                    ->wheres = [
                    "label"        =>"Desloga o usuário!",
                    "group"        =>"Atenticação",
                    "roles_ids"    =>"2", // example = "1,2,3"
                ];
                Route::post('refresh', [AuthController::class, "refresh"])->name("refresh")
                    ->wheres = [
                    "label"        =>"Atualiza o Token!",
                    "group"        =>"Atenticação",
                    "roles_ids"    =>"2", // example = "1,2,3"
                ];
                Route::post('me', [AuthController::class, "me"])->name("me")
                    ->wheres = [
                    "label"        =>"Retorna dados do usuário!",
                    "group"        =>"Atenticação",
                    "roles_ids"    =>"2", // example = "1,2,3"
                ];

            });

            Route::prefix("users")->name("users.")->group(function (){

                Route::get("/", [ UserController::class, "index" ])->name("index")
                    ->wheres = [
                    "label"        =>"Retorna lista de usuários!",
                    "group"        =>"Usuários",
                    "roles_ids"    =>"2", // example = "1,2,3"
                ];

                Route::get("/{id}", [ UserController::class, "show" ])->name("show")
                    ->wheres = [
                    "label"        =>"Retorna um só usuário!",
                    "group"        =>"Usuários",
                    "roles_ids"    =>"2", // example = "1,2,3"
                ];

                Route::post("/store", [ UserController::class, "store" ])->name("store")
                    ->wheres = [
                    "label"        =>"Cadastra usuário!",
                    "group"        =>"Usuários",
                    "roles_ids"    =>"2", // example = "1,2,3"
                ];

                Route::post("/update/{id}", [ UserController::class, "update" ])->name("update")
                    ->wheres = [
                    "label"        =>"Atualiza usuário!",
                    "group"        =>"Usuários",
                    "roles_ids"    =>"2", // example = "1,2,3"
                ];

                Route::delete("/destroy/{id}", [ UserController::class, "destroy" ])->name("destroy")
                    ->wheres = [
                    "label"        =>"Deleta usuário!",
                    "group"        =>"Usuários",
                    "roles_ids"    =>"2", // example = "1,2,3"
                ];

            });

        });

    });

});
