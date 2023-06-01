<?php

use App\Notifications\NewCompanyNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use App\Models\Company;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;

class CompanyControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateCompanySendsEmailNotification()
    {
        Notification::fake();
        // Create a user using the UserFactory
        $user = User::factory()->create();

        // Simulate a company creation request
        $response = $this->actingAs($user)->post(route('companies.store'), [
            'name' => 'Example Company',
            'email' => 'example@example.com',
            'logo' => UploadedFile::fake()->image('logo.jpg'),
            'website' => 'https://www.example.com',
        ]);

        // Retrieve the created company
        $company = Company::where('name', 'Example Company')->first();


        Notification::send($user, new NewCompanyNotification($company));

        // Ensure the email notification is sent to the admin user
        Notification::assertSentTo(
            $user,
            NewCompanyNotification::class,
            function ($notification) use ($company) {
                return $notification->company->id === $company->id;
            }
        );



    }
}


