<?php

namespace App\Filament\Auth;

use Filament\Pages\Auth\Register as AuthRegister;
use Filament\Forms\Form;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Grid;



class Registeruser extends AuthRegister
{
    // protected static string $view = 'filamentf.user.pages.auth.register';
    public function getHeading(): string
    {
        return 'Buat Akun Pelanggan';
    }


    public function form(Form $form): Form
    {
        return $form ->schema([

            Grid::make(2)->schema([

                $this->getNameFormComponent()
                    ->label('Nama Depan'),
                TextInput::make('last_name')
                    ->label('Nama Belakang')
                    ->required(),
            ]),
            $this->getEmailFormComponent()
                ->label('Email'),
                TextInput::make('no_telp')
                ->tel()
                ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
                ->label('Nomor Telepon')
                ->required(),
                TextArea::make('alamat')
                    ->required()
                    ->maxLength(255),
            $this->getPasswordFormComponent(),
            $this->getPasswordConfirmationFormComponent(),

        ])
        ->statePath('data');
    }

    protected function handleRegistration(array $data): \App\Models\User
    {
        $latitude = null;
        $longitude = null;

        // Panggil Google Maps Geocoding API
        $response = Http::get('https://maps.googleapis.com/maps/api/geocode/json', [
            'address' => $data['alamat'],
            'key' => 'AIzaSyDFsFnnUtIyrzuRELhaswaiTK-weF2GwmQ',
        ]);

        if ($response->ok() && isset($response['results'][0])) {
            $location = $response['results'][0]['geometry']['location'];
            $latitude = $location['lat'];
            $longitude = $location['lng'];
        }

        return User::create([
            'name' => $data['name'] . ' ' . $data['last_name'],
            'email' => $data['email'],
            'no_telp' => $data['no_telp'],
            'alamat' => $data['alamat'],
            'latitude' => $latitude,
            'longitude' => $longitude,
            'password' => Hash::make($data['password']),
        ]);
    }
}
