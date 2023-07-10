<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CalculatorController;
use App\Http\Controllers\ConverterController;
use App\Http\Controllers\StrmanuController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




// Route::get('/',function() {
//     $n="Reddy";
//     return view('welcome')->with('name',$n);
// });

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/about', function () {
    return view('about');
});


Route::get('/contact', function () {
    return view('contact');
});

Route::get('/history', function () {
    return view('history');
});

Route::get('/gallery', function () {
    return view('gallery');
});

Route::get('/calculator/form', function () {
    return view('calculator.form');
});

Route::get('/calculator/result', function () {
    $a=request()->get('a');
    $b=request()->get('b');
    $opr=request()->get('opr');
    $result=null;

    if($opr=='add')
    $result=$a+$b;
    elseif($opr=='sub')
    $result=$a-$b;
    elseif($opr=='mul')
    $result=$a*$b;
    return view('calculator.result')
    ->with('result',$result)
    ->with('a',$a)
    ->with('b',$b)
    ->with('opr',$opr);
});

Route::get('/man/form', function () {
    return view('man.form');
});
Route::get('/man/result', function () {
    $str=request()->get('str');
    $opr=request()->get('opr');
    $result=null;

    if($opr=='srv')
    $result=strrev($str);
    elseif($opr=='noofw')
    $result=str_word_count($str);
    elseif($opr=='noofl')
    $result=strlen($str);
    return view('man.result')
    ->with('result',$result)
    ->with('str',$str)
    ->with('opr',$opr);
});


// always use get mthod to get data from server
// Route::get('/converter/index', [ConverterController::class, 'index']);
Route::get('/converter', [ConverterController::class, 'index']);
Route::get('/converter/create', [ConverterController::class, 'create']);
// always  use post method to send data to server(first time) store
Route::post('/converter/store/{id}', [ConverterController::class, 'store']);
Route::get('/converter/show/{id}', [ConverterController::class, 'show']);
Route::get('/converter/edit/{id}', [ConverterController::class, 'edit']);
// update an information for existing resource then use put then 
Route::put('/converter/update/{id}', [ConverterController::class, 'update']);
// delete existing resource then use delete request
// Route::get('/converter/destroy/{id}', [ConverterController::class, 'destroy']);
Route::delete('/converter/destroy/{id}', [ConverterController::class, 'destroy']);
//Route::resource('/temperture/destroy/{id}', ConverterController::class);
                    
                    
// Route::get('/calculator/form', [CalculatorController::class, 'form']);
Route::middleware('auth')->group(
    function () {
        Route::get('/calculator/form', [CalculatorController::class, 'form'])->name('calculator.form');
        Route::get('/calculator/result', [CalculatorController::class, 'result']);
        Route::get('/calculator/logs', [CalculatorController::class, 'logs']);
        Route::get('/calculator/show/{id}', [CalculatorController::class, 'show']);
        Route::get('/calculator/update/{id}', [CalculatorController::class, 'update']);
        Route::post('/calculator/savedata/{id}', [CalculatorController::class, 'savedata']);
        Route::get('/calculator/queries', [CalculatorController::class, 'queries']);
        // Route::post('calculator/destroy/{id}', [CalculatorController::class, 'destroy']);
        Route::delete('/converter/delete/{id}', [ConverterController::class, 'destroy']);
    });
    // Route::get('calculator/show/api/{id}', [CalculatorController::class, 'api']);
//Route::get('/calculator/form', [CalculatorController::class, 'form'])->name('calculator.form');
// Autherisation 
// Route::get('/calculator/form', [CalculatorController::class, 'form'])->name('calculator.form')->middleware('auth');
// Route::get('/calculator/result', [CalculatorController::class, 'result']);
// Route::get('/calculator/logs', [CalculatorController::class, 'logs']);
// Route::get('/calculator/show/{id}', [CalculatorController::class, 'show']);
// Route::get('/calculator/update/{id}', [CalculatorController::class, 'update']);
// Route::post('/calculator/savedata/{id}', [CalculatorController::class, 'savedata']);
// Route::get('/calculator/queries', [CalculatorController::class, 'queries']);
// Route::post('calculator/destroy/{id}', [CalculatorController::class, 'destroy']);
// Route::get('calculator/show/api/{id}', [CalculatorController::class, 'api']);


Route::get('/string/form', function () {
});

Route::get('/string/result', function () {
});


Route::get('/stringman/form', [StrmanuController::class, 'form']);
Route::get('/stringman/result', [StrmanuController::class, 'result']);
Route::get('/stringman/logs', [StrmanuController::class, 'logs']);

Route::get('/stringman/form', function () {
});

Route::get('/stringman/result', function () {
});
 



Route::get('/dashboard', function () {
    // return view('dashboard');
    return redirect()->route('home');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php'; 