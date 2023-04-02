<?php

namespace Database\Factories;

use App\Models\user\Account;
use App\Models\user\Customer;
use App\Models\user\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Feedback>
 */
class FeedbackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $feedback_types = ['ROOM', 'SERVICE'];
        $ratings = [1, 2, 3, 4, 5];
        $feedback_status = ['Feedbacked', 'Not feedbacked yet'];

        $employee_model = new Employee();
        $customer_model = new Customer();
        $employee_id_accounts = $employee_model->newQuery()->get('id');
        $customer_id_accounts = $customer_model->newQuery()->get('id');

        return [
            'date_request' => fake()->dateTimeInInterval('-5 years', '+1 years', 'Asia/Ho_Chi_Minh'),
            'date_response' => fake()->dateTimeInInterval('-3 years', '+ 2 months', 'Asia/Ho_Chi_Minh'),
            'feedback_type' => fake()->randomElement($feedback_types),
            'image' => fake()->imageUrl(),
            'rating' => fake()->randomElement($ratings),
            'title' => fake()->sentence(),
            'comment' => fake()->paragraph(),
            'feedback_status' => fake()->randomElement($feedback_status),
            'employee_id' => fake()->randomElement($employee_id_accounts),
            'customer_id' => fake()->randomElement($customer_id_accounts),
        ];
    }
}
