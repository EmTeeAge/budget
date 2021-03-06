<?php

namespace Tests\Feature;

use App\Models\Earning;
use App\Models\Space;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EarningTest extends TestCase
{
    public function testUnauthorizedUserCantDeleteEarning()
    {
        $user = factory(User::class)->create();

        $space = factory(Space::class)->create();

        $earning = factory(Earning::class)->create([
            'space_id' => $space->id
        ]);

        $this->actingAs($user);

        $response = $this->delete('/earnings/' . $earning->id);

        $response->assertStatus(403);
    }
}
