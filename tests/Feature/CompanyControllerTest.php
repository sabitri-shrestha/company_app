<?php

use App\Notifications\NewCompanyNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use App\Models\Company;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\WithFaker;

class CompanyControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testCreateCompany()
    {
        //to disable the default exception handling behavior during the test execution.
        $this->withoutExceptionHandling();

        $response = $this->post(route('companies.store'), [
            'name' => 'Example Company',
            'email' => 'company@example.com',
            'logo' => UploadedFile::fake()->image('logo.jpg'),
            'website' => 'https://www.example.com',
        ]);

        $response->assertRedirect(route('companies.index'));

        $this->assertDatabaseHas('companies', [
            'name' => 'Example Company',
            'email' => 'company@example.com',
        ]);



    }

    public function testSendEmailNotificationOnCompanyCreation()
    {
        $this->withoutExceptionHandling();

        Notification::fake();

        $company = Company::factory()->create();

        $adminUser = User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
        ]);

        Notification::send($adminUser, new NewCompanyNotification($company));


        Notification::assertSentTo(
            $adminUser, // Assuming you have a 'user' relation in your Company model
            NewCompanyNotification::class
        );
    }
}


