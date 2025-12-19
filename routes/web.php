<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;








Route::get('/', function () {
    return redirect()->route('login');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

    Route::view('board', 'board')
    ->middleware(['auth', 'verified'])
    ->name('board');

        Route::view('budgets', 'budgets')
    ->middleware(['auth', 'verified'])
    ->name('budgets');

            Route::view('financials', 'financials')
    ->middleware(['auth', 'verified'])
    ->name('financials');

                Route::view('governing', 'governing')
    ->middleware(['auth', 'verified'])
    ->name('governing');

                    Route::view('insurance', 'insurance')
    ->middleware(['auth', 'verified'])
    ->name('insurance');

                    Route::view('meetings', 'meetings')
    ->middleware(['auth', 'verified'])
    ->name('meetings');

                        Route::view('miamidade', 'miamidade')
    ->middleware(['auth', 'verified'])
    ->name('miamidade');


                        Route::view('records', 'records')
    ->middleware(['auth', 'verified'])
    ->name('records');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('profile.edit');
    Route::get('settings/password', Password::class)->name('user-password.edit');
    Route::get('settings/appearance', Appearance::class)->name('appearance.edit');

    Route::get('settings/two-factor', TwoFactor::class)
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});
