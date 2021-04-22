<?php

namespace Tests\Feature;

use App\Models\Apartment;
use App\Models\Category;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ApartmentTest extends TestCase
{

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_apartments_status_with_token_and_json_structure()
    {
        $user = User::where('email', '=', 'admin@admin.com')->get()->first();
        $response = $this->get('/api/apartments?api_token='.$user->api_token);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
    }

    public function test_apartments_status_ko_without_token()
    {
        $response = $this->get('/api/apartments');
        $response->assertStatus(Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function test_get_apartment_for_id_ok()
    {
        $user = User::where('email', '=', 'admin@admin.com')->get()->first();
        $response = $this->get('/api/apartment/1?api_token='.$user->api_token);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJson(['status' => Response::HTTP_OK]);
    }

    public function test_get_apartment_for_id_ko()
    {
        $user = User::where('email', '=', 'admin@admin.com')->get()->first();
        $response = $this->get('/api/apartment/10000?api_token='.$user->api_token);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJson(['status' => Response::HTTP_INTERNAL_SERVER_ERROR]);
    }

    public function test_save_data_of_apartment_ok()
    {
        $user = User::where('email', '=', 'admin@admin.com')->get()->first();
        $category = Category::find(1);
        $response = $this->post('/api/apartment/create?api_token='.$user->api_token, [
            'category_id' => $category->id,
            'name' => 'apartment test',
            'description' => 'apartment long text test',
            'quantity' => 1,
            'active' => 1
        ]);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJson(['status' => Response::HTTP_OK]);
    }

    public function test_save_data_of_apartment_ko_without_a_critical_field()
    {
        $user = User::where('email', '=', 'admin@admin.com')->get()->first();
        $response = $this->post('/api/apartment/create?api_token='.$user->api_token, [
            'name' => 'apartment test',
            'description' => 'apartment long text test',
            'quantity' => 1,
            'active' => 1
        ]);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJson(['status' => Response::HTTP_INTERNAL_SERVER_ERROR]);
    }

    public function test_update_data_of_apartment_ok()
    {
        $user = User::where('email', '=', 'admin@admin.com')->get()->first();
        $apartment = Apartment::where('name', '=', 'apartment test')->get()->first();

        $apartment->name ='apartment test modified';

        $response = $this->post('/api/apartment/update/'.$apartment->id.'?api_token='.$user->api_token, $apartment->toArray());

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJson(['status' => Response::HTTP_OK]);
    }

    public function test_update_data_of_apartment_ko()
    {
        $user = User::where('email', '=', 'admin@admin.com')->get()->first();
        $apartment = Apartment::where('name', '=', 'apartment test modified')->get()->first();
        $apartment->name = '';
        $response = $this->post('/api/apartment/update/'.$apartment->id.'?api_token='.$user->api_token, $apartment->toArray());
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJson(['status' => Response::HTTP_INTERNAL_SERVER_ERROR]);
    }

    public function test_trash_apartment_by_id_ok()
    {
        $user = User::where('email', '=', 'admin@admin.com')->get()->first();
        $apartment = Apartment::where('name', '=', 'apartment test modified')->get()->first();
        $response = $this->get('/api/apartment/trash/'.$apartment->id.'?api_token='.$user->api_token);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJson(['status' => Response::HTTP_OK]);
    }

    public function test_delete_apartment_by_id_ok()
    {
        $user = User::where('email', '=', 'admin@admin.com')->get()->first();
        Apartment::withTrashed()->where('name', '=', 'apartment test modified')->restore();
        $apartment = Apartment::where('name', '=', 'apartment test modified')->get()->first();
        $response = $this->get('/api/apartment/delete/'.$apartment->id.'?api_token='.$user->api_token);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJson(['status' => Response::HTTP_OK]);
    }

    public function test_delete_apartment_by_id_ko()
    {
        $user = User::where('email', '=', 'admin@admin.com')->get()->first();
        $response = $this->get('/api/apartment/delete/1000?api_token='.$user->api_token);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJson(['status' => Response::HTTP_INTERNAL_SERVER_ERROR]);
    }

}
