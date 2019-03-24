<?php

namespace App\Providers;

use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Lang;
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
        Blade::directive('date', function (Carbon $date) {
            return "<?php echo $date->format('d/m/Y'); ?>";
        });

        Blade::directive('time', function ($expression) {
            return "<?php echo ($expression)->format('H:i'); ?>";
        });

        Blade::directive('duration', function ($timeInSeconds, $withSeconds = false) {

            $seconds = $timeInSeconds % 60;

            $time = floor($timeInSeconds / 60);
            $minutes = ($time % 60);

            $time = floor($time / 60);
            $hours = floor($time / 60);

            $timeAsText = '';
            if ($hours > 0 ) {
                $timeAsText .= sprintf("%d h", $hours);
            }

            if ($minutes > 0 ) {
                $timeAsText .= sprintf("%d m", $hours);
            }

            if ($withSeconds && $seconds > 0 ) {
                $timeAsText .= sprintf("%d s", $hours);
            }

            if (empty($timeAsText)) {
                $timeAsText = '0 s';
            }

            return "<?php echo ($timeAsText); ?>";
        });
    }
}
