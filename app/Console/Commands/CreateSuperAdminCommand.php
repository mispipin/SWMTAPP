<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateSuperAdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:superadmin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Membuat akun Super Admin baru secara interaktif';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('--- Pembuatan Akun Super Admin SWMT ---');

        $name = $this->ask('Masukkan Nama Lengkap');
        $email = $this->ask('Masukkan Email');

        if (User::where('email', $email)->exists()) {
            $this->error('Gagal: Email ini sudah terdaftar di sistem.');
            return;
        }

        $password = $this->secret('Masukkan Password');
        $confirmPassword = $this->secret('Konfirmasi Password');

        if ($password !== $confirmPassword) {
            $this->error('Gagal: Konfirmasi password tidak cocok.');
            return;
        }

        try {
            User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
                'role' => 'superadmin',
            ]);

            $this->info('Sukses! Akun Super Admin berhasil dibuat.');
            $this->info('Email: ' . $email);
        } catch (\Exception $e) {
            $this->error('Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
