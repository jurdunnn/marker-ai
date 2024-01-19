<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\ExamForm;
use App\Livewire\ExamIndex;
use App\Livewire\ExamShow;
use App\Livewire\StudentForm;
use App\Livewire\StudentIndex;
use App\Livewire\StudentShow;
use App\Livewire\SubjectForm;
use App\Livewire\SubjectIndex;
use App\Livewire\SubjectShow;
use App\Livewire\TranscriptForm;
use App\Livewire\TranscriptIndex;
use App\Livewire\TranscriptShow;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['verified'])->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Exam
    Route::group(['prefix' => 'exam'], function () {
        Route::get('list', ExamIndex::class)->name('exam.index');
        Route::get('{id}', ExamShow::class)->name('exam.show');
        Route::get('{id}/edit', ExamForm::class)->name('exam.edit');
    });

    // Student
    Route::group(['prefix' => 'student'], function () {
        Route::get('list', StudentIndex::class)->name('student.index');
        Route::get('{id}', StudentShow::class)->name('student.show');
        Route::get('{id}/edit', StudentForm::class)->name('student.edit');
    });

    // Transcript
    Route::group(['prefix' => 'transcript'], function () {
        Route::get('list', TranscriptIndex::class)->name('transcript.index');
        Route::get('{id}', TranscriptShow::class)->name('transcript.show');
        Route::get('{id}/edit', TranscriptForm::class)->name('transcript.edit');
    });

    // Subject
    Route::group(['prefix' => 'subject'], function () {
        Route::get('list', SubjectIndex::class)->name('subject.index');
        Route::get('{id}', SubjectShow::class)->name('subject.show');
        Route::get('{id}/edit', SubjectForm::class)->name('subject.edit');
    });
});

require __DIR__ . '/auth.php';
