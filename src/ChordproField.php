<?php

namespace Henryavila\LaravelNovaChordproField;

use Laravel\Nova\Fields\Textarea;

class ChordproField extends Textarea
{
	public $component = 'laravel-nova-chordpro-field';

	public function __construct($name, $attribute = null, callable $resolveCallback = null)
	{
		parent::__construct($name, $attribute, $resolveCallback);

		$this->rows(20);
	}

	public function showTabs(bool $value = true): self
	{
		$this->withMeta(['showTabs' => $value]);

		return $this;
	}

	public function useSimpleChord(bool $value = true): self
	{
		$this->withMeta(['useSimpleChord' => $value]);

		return $this;
	}

	public function showChords(bool $value = true): self
	{
		$this->withMeta(['showChords' => $value]);

		return $this;
	}
}
