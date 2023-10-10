# Laravel Nova Chordpro Field

Add a [Chordpro](https://www.chordpro.org/chordpro/chordpro-introduction/)  viewer and editor into Laraavel Nova.
The editor is a simple TextArea. The viewer display a fully formatted song.


The following chordpro code
```
{title: 005 - Tua Vontade}
{subtitle: Adoradores 2}
{key: E}
{tempo: 75}
{time: 6/8}
{duration: 03:57}


{c: (INTRODUÇÃO)}
[E]x//     [F#m7]x//     [D9]x//     [D9]x//
[E]x//     [F#m7]x//     [D9]x//     [D9]x//


[E]Norte ou Sul, [F#m7]noite ou  di[E/G#]-a eu te [A]seguirei [A] 
[E]Mesmo que o mundo [F#m7]me abando [E/G#]- ne eu [A]serei fiel [A]
[B]Onde mandares [A]irei segurando em [E]tuas mãos [E]  
[B/D#]Sejas meus olhos e [A/C#]guies o meu cora[E]ção

{soc}
[E]    Que eu [B]siga a tua vonta [B]- de e que 
[C#m7]sempre a missão me acompa [C#m7]- nhe
Que eu [B/D#]seja a estrela da noi [B/D#]- te 
sempre a bri[A/E]lhar por [E]Ti
[E]    Eu sou [B]filho do Rei do univer [B]- so,
{eoc}
```
will be rendered inside Laravel Nova Field as
![image](https://github.com/henryavila/laravel-nova-chordpro-field/assets/8429941/1e803e48-af04-4ee2-b9c9-8b67183eb070)

also, supports dark mode

![image](https://github.com/henryavila/laravel-nova-chordpro-field/assets/8429941/44878bb4-785f-40db-857f-928d0e19c8ee)




This package is built with https://github.com/chordproject/chorpro-parser and https://github.com/eKoopmans/html2pdf.js and allows to
- Edit chordpro (simple TextArea editor)
- View a fully formatted song
- Generate a pdf with the formatted song
- Translate the displayed text like "Key", "Time", etc

## Prerequisites
[Laravel Nova 4+](https://nova.laravel.com/)


## Installation

In a Laravel nova instance, install `henryavila/laravel-nova-chordpro-field`
```bash
composer require henryavila/laravel-nova-chordpro-field
```


## Localization

Publish the package language files to your application's `resources/lang/vendor` directory:

```bash
php artisan vendor:publish --provider="Henryavila\LaravelNovaChordproField\FieldServiceProvider"
```

## Usage

Assuming you have a Nova Resource with the `chordpro` content in the `chordpro`  column, the following code will render the chordpro as displayed in the image above

```php

// Laravel Nova Resource
use \Henryavila\LaravelNovaChordproField\ChordproField;

public function fields(Request $request): array
 {
      return [
        ...
        ChordproField::make('Chordpro')
              ->alwaysShow()
              ->rules('required'),
        ...
    ];
}
```
## Usage Options
| Option  | Description | Default Value |
| ------------- | ------------- |------------- |
| `showTabs()`  | Display tablature  |`true` |
| `useSimpleChord()`  | Simplify the chords. Ex: `E/G#` becomes `E`  |`false` |
| `showChords()`  | Display the chords. If set to false, will display just the lyrics  |`true` |
| `rows()`  | Number of rows in the edit form  |`20` |



### Usign all options with differents values
```php
// Laravel Nova Resource
use \Henryavila\LaravelNovaChordproField\ChordproField;

public function fields(Request $request): array
 {
      return [
        ...
        ChordproField::make('Chordpro')
              ->alwaysShow()
              ->rows(30)
              ->showTabs(false)
              ->useSimpleChord()
              ->showChords(false)
              ->rules('required'),
        ...
    ];
}
```



