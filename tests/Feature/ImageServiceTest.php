<?php

namespace Tests\Feature;

use App\Models\Berita;
use App\Models\Infografis;
use App\Models\User;
use App\Services\ImageService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class ImageServiceTest extends TestCase
{
    use RefreshDatabase;

    protected string $testDir;

    protected function setUp(): void
    {
        parent::setUp();
        $this->testDir = public_path('uploads/test_compression');
        if (! File::isDirectory($this->testDir)) {
            File::makeDirectory($this->testDir, 0755, true, true);
        }
    }

    protected function tearDown(): void
    {
        if (File::isDirectory($this->testDir)) {
            File::deleteDirectory($this->testDir);
        }
        // Clean up uploads/berita test files
        $beritaUploads = glob(public_path('uploads/berita/*'));
        foreach ($beritaUploads as $f) {
            if (is_file($f) && str_ends_with($f, '.webp')) {
                @unlink($f);
            }
        }
        // Clean up uploads/infografis test files
        $infoUploads = glob(public_path('uploads/infografis/*'));
        foreach ($infoUploads as $f) {
            if (is_file($f) && str_ends_with($f, '.webp')) {
                @unlink($f);
            }
        }
        parent::tearDown();
    }

    public function test_compress_and_upload_creates_compressed_image(): void
    {
        $file = UploadedFile::fake()->image('large_photo.jpg', 2400, 1600);

        $savedFilename = ImageService::compressAndUpload($file, $this->testDir, 1200, 80);

        $this->assertNotEmpty($savedFilename);
        $savedPath = $this->testDir.'/'.$savedFilename;
        $this->assertFileExists($savedPath);

        // Verify image dimensions were scaled down
        [$width, $height] = getimagesize($savedPath);
        $this->assertLessThanOrEqual(1200, $width);
        $this->assertTrue(str_ends_with($savedFilename, '.webp'));
    }

    public function test_compress_and_upload_handles_png_with_transparency(): void
    {
        $file = UploadedFile::fake()->image('logo.png', 800, 600);

        $savedFilename = ImageService::compressAndUpload($file, $this->testDir, 1920, 85);

        $this->assertNotEmpty($savedFilename);
        $savedPath = $this->testDir.'/'.$savedFilename;
        $this->assertFileExists($savedPath);
        $this->assertTrue(str_ends_with($savedFilename, '.webp'));
    }

    public function test_compress_and_upload_handles_non_raster_gracefully(): void
    {
        $file = UploadedFile::fake()->create('document.pdf', 100, 'application/pdf');

        $savedFilename = ImageService::compressAndUpload($file, $this->testDir);

        $this->assertNotEmpty($savedFilename);
        $savedPath = $this->testDir.'/'.$savedFilename;
        $this->assertFileExists($savedPath);
        $this->assertTrue(str_ends_with($savedFilename, '.pdf'));
    }

    public function test_admin_berita_upload_uses_compression(): void
    {
        $admin = User::factory()->create(['is_admin' => true, 'is_active' => true]);
        $image = UploadedFile::fake()->image('headline.jpg', 2000, 1500);

        $response = $this->actingAs($admin)->post('/admin/berita', [
            'title' => 'Berita Uji Coba Kompresi',
            'category' => 'Kesehatan',
            'content' => 'Isi berita pengujian sistem kompresi gambar.',
            'status' => 'published',
            'image' => $image,
        ]);

        $response->assertRedirect('/admin/berita');
        $berita = Berita::where('title', 'Berita Uji Coba Kompresi')->first();
        $this->assertNotNull($berita);
        $this->assertTrue(str_ends_with($berita->image, '.webp'));
        $this->assertFileExists(public_path('uploads/berita/'.$berita->image));
    }

    public function test_admin_infografis_upload_uses_compression(): void
    {
        $admin = User::factory()->create(['is_admin' => true, 'is_active' => true]);
        $image = UploadedFile::fake()->image('poster.png', 1600, 2400);

        $response = $this->actingAs($admin)->post('/admin/infografis', [
            'title' => 'Poster Vaksinasi Kompresi',
            'description' => 'Poster infografis vaksinasi.',
            'image' => $image,
        ]);

        $response->assertRedirect('/admin/infografis');
        $infografis = Infografis::where('title', 'Poster Vaksinasi Kompresi')->first();
        $this->assertNotNull($infografis);
        $this->assertTrue(str_ends_with($infografis->image, '.webp'));
        $this->assertFileExists(public_path('uploads/infografis/'.$infografis->image));
    }
}
