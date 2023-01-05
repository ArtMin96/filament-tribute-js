<?php

namespace ArtMin96\FilamentTributeJs;

use Filament\PluginServiceProvider;
use Spatie\LaravelPackageTools\Package;

class FilamentTributeJsServiceProvider extends PluginServiceProvider
{
    public static string $name = 'filament-tribute-js';

    protected array $styles = [
        'plugin-filament-tribute-js-style' => __DIR__.'/../resources/dist/filament-tribute-js.css',
    ];

    protected array $scripts = [
        'plugin-filament-tribute-js' => __DIR__.'/../resources/dist/filament-tribute-js.js',
    ];

    protected array $beforeCoreScripts = [
        'plugin-filament-tribute-js-component-script' => __DIR__ . '/../resources/dist/component.js',
    ];

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasAssets()
            ->hasViews()
            ->hasRoute('web');
    }
}
