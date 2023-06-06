<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Company;

class EmployeeControllerTest extends TestCase{
    use RefreshDatabase, WithFaker;

    public function testCreateEmployee(){
        $this->withoutExceptionHandling();
        $company = Company::factory()->create();

        $response = $this->post(route('employees.store'),[
            'company_id' => $company->id,
            'first_name' => 'Example',
            'last_name' => 'employee',
            'email' => 'employee@example.com',
            'phone' => '0123456789',
        ]);

        $response->assertRedirect(route('employees.index'));

        $this->assertDatabaseHas('employees',[
            'email'=>'employee@example.com'

        ]);
    }


}
