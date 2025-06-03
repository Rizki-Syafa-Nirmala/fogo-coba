<?php

namespace App\Filament\Auth;

use Filament\Pages\Auth\Register as AuthRegister;
use Filament\Forms\Form;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Grid;
use Tapp\FilamentGoogleAutocomplete\Forms\Components\GoogleAutocomplete;
use Filament\Forms\Components\Hidden;


class Registermitra extends AuthRegister
{
    // protected static string $view = 'filamentf.user.pages.auth.register';


    public function getHeading(): string
    {
        return 'Buat Akun MItra';
    }

    public function form(Form $form): Form
    {
        return $form ->schema([

            $this->getNameFormComponent()
                ->label('Nama Restoran'),
            $this->getEmailFormComponent()
                ->label('Email'),
                TextInput::make('no_telp')
                ->tel()
                ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
                ->label('Nomor Telepon')
                ->required(),
                GoogleAutocomplete::make('google_search')
                ->label('Cari alamat')
                ->countries(['ID'])
                ->language('id')
                ->withFields([
                    TextInput::make('alamat')
                        ->label('Alamat Lengkap')
                        ->extraInputAttributes([
                            'data-google-field' => '{street_number} {route}, {sublocality_level_1}, {administrative_area_level_2}, {administrative_area_level_1}',
                        ]),
                    TextInput::make('kota')
                        ->label('Kota')
                        ->extraInputAttributes([
                            'data-google-field' => '{administrative_area_level_2}',
                        ]),
                    TextInput::make('latitude')
                        ->extraInputAttributes([
                            'data-google-field' => '{latitude}',
                        ]),
                    TextInput::make('longitude')
                        ->extraInputAttributes([
                            'data-google-field' => '{longitude}',
                        ]),
                    ]),

            $this->getPasswordFormComponent(),
            $this->getPasswordConfirmationFormComponent(),

        ])
        ->statePath('data');
    }
}
