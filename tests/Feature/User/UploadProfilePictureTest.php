<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UploadProfilePictureTest extends TestCase
{
    use RefreshDatabase;

    const UPLOAD_PROFILE_IMAGE_URL = '/api/v1/user/profile-image/upload';
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        User::factory()->create();
        $this->user = User::first();
        $this->actingAs( $this->user);
    }

    public function test_profile_image_can_be_uploaded()
    {
        Storage::fake('avatars');

        $file = UploadedFile::fake()->image('avatar.jpg');

        $this->post(self::UPLOAD_PROFILE_IMAGE_URL, [
            'image' => $file,
        ]);

        $this->user->refresh();

        $this->assertTrue(!is_null($this->user->avatar));

        Storage::disk('avatars')->delete($file->hashName());
    }
}
