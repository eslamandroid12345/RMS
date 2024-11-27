<?php

namespace App\Providers;

use App\Http\Services\Api\Timesheet\TimesheetDesktopService;
use App\Http\Services\Api\Timesheet\TimesheetService;
use App\Http\Services\Api\Timesheet\TimesheetWebsiteService;
use Illuminate\Support\ServiceProvider;

class PlatformServiceProvider extends ServiceProvider
{
    private const VERSIONS = [1, 2];
    private const PLATFORMS = ['website', 'desktop'];
    private const DEFAULT_VERSION = 1;
    private const DEFAULT_PLATFORM = 'website';
    private const SERVICES = [
        2 => [
            TimesheetService::class => [
                TimesheetDesktopService::class,
            ],
        ],
        1 => [
            TimesheetService::class => [
                TimesheetWebsiteService::class,
            ],
        ],
    ];
    private ?int $version;
    private ?string $platform;

    public function __construct($app)
    {
        parent::__construct($app);

        foreach (self::VERSIONS as $version) {
            foreach (self::PLATFORMS as $platform) {
                $pattern = app()->isProduction()
                    ? "v$version/$platform/*"
                    : "api/v$version/$platform/*";

                if (request()->is($pattern)) {
                    $this->version = $version;
                    $this->platform = $platform;
                    return;
                }
            }
        }

        $this->version = self::DEFAULT_VERSION;
        $this->platform = self::DEFAULT_PLATFORM;
    }

    private function getTargetService(array $services)
    {
        foreach ($services as $service) {
            if ($service::platform() == $this->platform) {
                return $service;
            }
        }

        return $services[0];
    }

    private function initiate(): void
    {
        $services = self::SERVICES[$this->version] ?? [];

        foreach ($services as $abstractService => $targetServices) {
            $this->app->singleton($abstractService, $this->getTargetService($targetServices));
        }
    }

    public function register(): void
    {
        $this->initiate();
    }

    public function boot(): void
    {
        //
    }
}
