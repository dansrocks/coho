<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

/**
 * Class CustomBladeServiceProvider
 *
 * @package App\Providers
 */
class CustomBladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('date', function ($date) {
            return "<?php echo ({$date})->format('d/m/Y'); ?>";
        });

        Blade::directive('time', function ($expression) {
            return "<?php echo ({$expression})->format('H:i'); ?>";
        });

        Blade::directive('duration', function ($timeInSeconds) {
            return "<?php echo TimeDurationHelper::showDurationHumanFriendly({$timeInSeconds}, false); ?>";
        });
    }
}
