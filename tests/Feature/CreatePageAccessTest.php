<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreatePageAccessTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Halaman form create tidak boleh tertelan route show ({kategori}/{produk}).
     */
    public function test_admin_can_render_the_create_pages(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)
            ->get('/kategori/create')
            ->assertOk()
            ->assertSee('Tambah Kategori');

        $this->actingAs($admin)
            ->get('/produk/create')
            ->assertOk()
            ->assertSee('Tambah Produk');
    }

    public function test_staff_is_forbidden_from_the_create_pages(): void
    {
        $staff = User::factory()->create(['role' => 'staff']);

        $this->actingAs($staff)->get('/kategori/create')->assertForbidden();
        $this->actingAs($staff)->get('/produk/create')->assertForbidden();
    }

    public function test_guest_is_redirected_to_login(): void
    {
        $this->get('/kategori/create')->assertRedirect('/login');
        $this->get('/produk/create')->assertRedirect('/login');
    }

    public function test_non_numeric_parameter_is_not_found(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)->get('/kategori/abc')->assertNotFound();
        $this->actingAs($admin)->get('/produk/abc')->assertNotFound();
    }
}
