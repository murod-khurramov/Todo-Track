<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    public function test_it_displays_user_tasks_on_dashboard()
    {
        $task = Task::factory()->create([
            'user_id' => $this->user->id,
            'title' => 'Sample Task',
        ]);

        $response = $this->get(route('tasks.index'));

        $response->assertStatus(200);
        $response->assertViewIs('dashboard');
        $response->assertViewHas('tasks', function ($tasks) use ($task) {
            return $tasks->contains($task);
        });
    }
}
