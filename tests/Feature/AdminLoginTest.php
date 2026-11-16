<?php

use App\Models\User;

it('menampilkan halaman login untuk tamu', function (): void {
    $this->get(route('admin.login'))
        ->assertOk()
        ->assertSee('Masuk ke Panel Admin');
});

it('menerima kredensial admin yang valid', function (): void {
    $user = User::factory()->create(['is_admin' => true]);

    $this->post(route('admin.login.store'), [
        'email' => $user->email,
        'password' => 'password',
    ])->assertRedirect(route('admin.dashboard'));

    $this->assertAuthenticatedAs($user);
});

it('menolak kredensial yang salah', function (): void {
    $user = User::factory()->create(['is_admin' => true]);

    $this->post(route('admin.login.store'), [
        'email' => $user->email,
        'password' => 'salah-password',
    ])->assertSessionHasErrors('email');

    $this->assertGuest();
});

it('menolak akun non admin meski kredensial benar', function (): void {
    $user = User::factory()->create(['is_admin' => false]);

    $this->post(route('admin.login.store'), [
        'email' => $user->email,
        'password' => 'password',
    ])->assertSessionHasErrors('email');

    $this->assertGuest();
});

it('menghapus sesi saat admin logout', function (): void {
    $user = User::factory()->create(['is_admin' => true]);

    $this->actingAs($user)
        ->post(route('admin.logout'))
        ->assertRedirect(route('admin.login'));

    $this->assertGuest();
});
