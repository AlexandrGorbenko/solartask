<?php

namespace Tests\Feature;

use App\Comment;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentsTest extends TestCase
{



    /**
     * Store test
     *
     * @return void
     */
    public function testStore()
    {

        $response = $this->json('POST', route('comments.store'), [
            'parent_id' => 1,
            'text' => 'Test text',
        ]);


        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);


        /**
         * For group test
         */
//        $comment_id = $response->json()['data']['id'];
//        Comment::where('id', 0)->delete();
//        Comment::where('id', $comment_id)->update(['id' => 0]);

    }

    /**
     * Update test
     *
     * return void
     */
    public function testUpdate() {

        $this->assertDatabaseHas('comments', [
            'id' => 0
        ]);

        $text = str_random(10);

        $response = $this->json('POST', route('comments.update', ['id' => 0]), [
            'text' => $text,
        ]);


        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
                'data' => [
                    'text' => $text
                ]
            ]);
    }

    /**
     * Delete test
     *
     * @return void
     */
    public function testDelete() {

        $this->assertDatabaseHas('comments', [
            'id' => 0
        ]);

        $response = $this->json('POST', route('comments.delete', ['id' => 0]));

        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true
            ]);

        $this->assertDatabaseMissing('comments', [
            'id' => 0
        ]);


    }
}
