<?php

namespace Henryavila\LaravelNovaChordproField;

use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;

class FieldServiceProvider extends ServiceProvider
{
	public static $name = 'laravel-nova-chordpro-field';

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->publishes([
			__DIR__ . "/../resources/lang" => lang_path(
				"vendor/" . static::$name
			),
		]);

		Nova::serving(function (ServingNova $event) {
			Nova::script('laravel-nova-chordpro-field', __DIR__ . '/../dist/js/field.js');
			Nova::style('laravel-nova-chordpro-field', __DIR__ . '/../dist/css/field.css');
			Nova::translations(static::getTranslations());
		});
	}


	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	private static function getTranslations(): array
	{
		$translationFile = lang_path(
			"vendor/" . static::$name . "/" . app()->getLocale() . ".json"
		);

		if (!is_readable($translationFile)) {
			$translationFile =
				__DIR__ . "/../resources/lang/" . app()->getLocale() . ".json";

			if (!is_readable($translationFile)) {
				return [];
			}
		}

		return json_decode(file_get_contents($translationFile), true);
	}
}
