<?php

namespace App\Providers;

use App\Team;
use Validator;
use iBourgeois\Spark\Spark;
use Illuminate\Http\Request;
use iBourgeois\Spark\Providers\AppServiceProvider as ServiceProvider;

class SparkServiceProvider extends ServiceProvider
{
    /**
     * Meta-data included in invoices generated by Spark.
     *
     * @var array
     */
    protected $invoiceWith = [
        'vendor' => 'Your Company',
        'product' => 'Your Product',
        'street' => 'PO Box 111',
        'location' => 'Your Town, 12345',
        'phone' => '555-555-5555',
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }

    /**
     * Customize general Spark options.
     *
     * @return void
     */
    protected function customizeSpark()
    {
        Spark::configure([
            'models' => [
                'teams' => Team::class,
            ]
        ]);
    }

    /**
     * Customize Spark's new user registration logic.
     *
     * @return void
     */
    protected function customizeRegistration()
    {
        // Spark::validateRegistrationsWith(function (Request $request) {
        //     return [
        //         'name' => 'required|max:255',
        //         'email' => 'required|email|unique:users',
        //         'password' => 'required|confirmed|min:6',
        //         'terms' => 'required|accepted',
        //     ];
        // });

        // Spark::validateSubscriptionsWith(function (Request $request) {
        //     return [
        //         'plan' => 'required',
        //         'terms' => 'required|accepted',
        //         'stripe_token' => 'required',
        //     ];
        // });

        // Spark::createUsersWith(function (Request $request) {
        //     // Return New User Instance...
        // });
    }

    /**
     * Customize the roles that may be assigned to team members.
     *
     * @return void
     */
    protected function customizeRoles()
    {
        Spark::defaultRole('member');

        Spark::roles([
            'admin' => 'Administrator',
            'member' => 'Member',
        ]);
    }

    /**
     * Customize the tabs on the settings screen.
     *
     * @return void
     */
    protected function customizeSettingsTabs()
    {
        Spark::settingsTabs()->configure(function ($tabs) {
            return [
                $tabs->profile(),
                $tabs->teams(),
                $tabs->security(),
                $tabs->subscription(),
                // $tabs->make('Name', 'view', 'fa-icon'),
            ];
        });

        Spark::teamSettingsTabs()->configure(function ($tabs) {
            return [
                $tabs->owner(),
                $tabs->membership(),
                // $tabs->make('Name', 'view', 'fa-icon'),
            ];
        });
    }

    /**
     * Customize Spark's profile update logic.
     *
     * @return void
     */
    protected function customizeProfileUpdates()
    {
        // Spark::validateProfileUpdatesWith(function (Request $request) {
        //     return [
        //         'name' => 'required|max:255',
        //         'email' => 'required|email|unique:users,email,'.$request->user()->id,
        //     ];
        // });

        // Spark::updateProfilesWith(function (Request $request) {
        //     // Update $request->user()...
        // });
    }

    /**
     * Customize the subscription plans for the application.
     *
     * @return void
     */
    protected function customizeSubscriptionPlans()
    {
        // Spark::free()
        //         ->features([
        //             'Feature 1',
        //             'Feature 2',
        //             'Feature 3',
        //         ]);

        // Spark::plan('Basic', 'stripe-id')->price(10)
        //         ->trialDays(7)
        //         ->features([
        //             'Feature 1',
        //             'Feature 2',
        //             'Feature 3',
        //         ]);
    }
}
