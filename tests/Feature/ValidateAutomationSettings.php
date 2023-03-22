<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ValidateAutomationSettings extends TestCase
{


    private $questions = [
        'Q1' => "What is the returns window that you use for a majority or all of your orders?",
        'Q2' => "Reason to be communicated if an order is not eligible for return/exchange :",
        'Q3' => "Is the return policy the same for all orders regardless of the shipping method used, discount code used or any other factors?",
        'Q4' => "Is the return policy the same for all the items that you sell?",
        'Q5' => "If the return/exchange is deemed acceptable, what are the resolutions that you would like to offer?",
        'Q6' => "Reason to be communicated if all return types are not available:",
        'Q7' => "If the returns/exchanges is deemed as acceptable, will the resolutions offered for returns/exchanges will remain the same for all orders, regardless of the exact SKU or other factors such as discounts used, customer's location or other factors?",
        'Q8' => "Would you like your customers to explain why they are returning their order?",
        'Q9' => "Add a list of return reasons :",
        'Q10' => "Would the list of return reasons or the follow up details be the same for every order, regardless of the variables such as the exact sku, discount code used or shipping method ?",
        'Q11' => "What the return method(s) do you use for a majority or all of your orders? If you don't use the same method for all, don't worry. Just mention what you use for the majority.",
        'Q12' => "What messaging would you like to be displayed to the customer for this?",
        'Q13' => "Will the return method be same across all orders/items?"
    ];
    private $configs = [
        'config1' => "config1",
        'config2' => "config2",
        'config3' => "config3",
        'config4' => "config4",
        'config5' => "config5",
        'config6' => "config6",
        'config7' => "config7",
    ];

    private $valid_configs = [
        'config1' => "valid_config1",
        'config2' => "valid_config2",
        'config3' => "valid_config3",
        'config4' => "valid_config4",
        'config5' => "valid_config5",
        'config6' => "valid_config6",
        'config7' => "valid_config7",
    ];

    private $invalid_configs = [
        'config1' => "invalid_config1",
        'config2' => "invalid_config2",
        'config3' => "invalid_config3",
        'config4' => "invalid_config4",
        'config5' => "invalid_config5",
        'config6' => "invalid_config6",
        'config7' => "invalid_config7",
    ];
    /**
     * Test to check if the correct settings are posted successfully with status code 201
     */
    public function test_making_a_valid_post_request_without_configs()
    {
        $automation_settings = [
            $this->questions->Q1 => "yes",
            $this->questions->Q2 => "reason",
            $this->questions->Q3 => "yes",
            $this->questions->Q4 => "yes",
            $this->questions->Q5 => "return offer",
            $this->questions->Q6 => "reason if all return types are not available",
            $this->questions->Q7 => "yes",
            $this->questions->Q8 => "a",
            $this->questions->Q10 => "yes",
            $this->questions->Q11 => "a",
            $this->questions->Q12 => "message displayed to customer",
            $this->questions->Q13 => "yes",
        ];
        $response = $this->postJson('/refund_automation_settings', $automation_settings);


        $response
            ->assertStatus(201)
            ->assertJsonFragment([
                'created' => true,
            ]);
    }

    /**
     * Test to check if the valid settings with question 3 answer as "no" is successfull
     */

    public function test_making_a_valid_post_request_with_config_type_two()
    {
        $automation_settings = [
            $this->questions->Q1 => "yes",
            $this->questions->Q2 => "reason",
            $this->questions->Q3 => "no",
            $this->configs->config => $this->valid_configs->config2,
            $this->questions->Q4 => "yes",
            $this->questions->Q5 => "return offer",
            $this->questions->Q6 => "reason if all return types are not available",
            $this->questions->Q7 => "yes",
            $this->questions->Q8 => "a",
            $this->questions->Q10 => "yes",
            $this->questions->Q11 => "a",
            $this->questions->Q12 => "message displayed to customer",
            $this->questions->Q13 => "yes",
        ];
        $response = $this->postJson('/refund_automation_settings', $automation_settings);


        $response
            ->assertStatus(201)
            ->assertJsonFragment([
                'created' => true,
            ]);
    }

    /**
     * Test to check if the invalid settings with question 3 answer as "no" and without config 2 returns status code 422
     */

    public function test_making_an_invalid_post_request_by_missing_config2()
    {
        $automation_settings = [
            $this->questions->Q1 => "yes",
            $this->questions->Q2 => "reason",
            $this->questions->Q3 => "no",
            $this->questions->Q4 => "yes",
            $this->questions->Q5 => "return offer",
            $this->questions->Q6 => "reason if all return types are not available",
            $this->questions->Q7 => "yes",
            $this->questions->Q8 => "a",
            $this->questions->Q10 => "yes",
            $this->questions->Q11 => "a",
            $this->questions->Q12 => "message displayed to customer",
            $this->questions->Q13 => "yes",
        ];
        $response = $this->postJson('/refund_automation_settings', $automation_settings);

        $response
            ->assertStatus(422);
    }

    /**
     * Test to check if the valid settings with question 3 answer as "no" is successfull
     */
    public function test_making_a_valid_post_request_with_config3()
    {
        $automation_settings = [
            $this->questions->Q1 => "yes",
            $this->questions->Q2 => "reason",
            $this->questions->Q3 => "yes",
            $this->questions->Q4 => "no",
            $this->configs->config => $this->valid_configs->config3,
            $this->questions->Q5 => "return offer",
            $this->questions->Q6 => "reason if all return types are not available",
            $this->questions->Q7 => "yes",
            $this->questions->Q8 => "a",
            $this->questions->Q10 => "yes",
            $this->questions->Q11 => "a",
            $this->questions->Q12 => "message displayed to customer",
            $this->questions->Q13 => "yes",
        ];
        $response = $this->postJson('/refund_automation_settings', $automation_settings);


        $response
            ->assertStatus(201)
            ->assertJsonFragment([
                'created' => true,
            ]);
    }

    public function test_making_an_invalid_post_by_missing_config3()
    {
        $automation_settings = [
            $this->questions->Q1 => "yes",
            $this->questions->Q2 => "reason",
            $this->questions->Q3 => "yes",
            $this->questions->Q4 => "no",
            $this->questions->Q5 => "return offer",
            $this->questions->Q6 => "reason if all return types are not available",
            $this->questions->Q7 => "yes",
            $this->questions->Q8 => "a",
            $this->questions->Q10 => "yes",
            $this->questions->Q11 => "a",
            $this->questions->Q12 => "message displayed to customer",
            $this->questions->Q13 => "yes",
        ];
        $response = $this->postJson('/refund_automation_settings', $automation_settings);

        $response
            ->assertStatus(422);
    }

    public function test_making_a_valid_post_request_with_config4()
    {
        $automation_settings = [
            $this->questions->Q1 => "yes",
            $this->questions->Q2 => "reason",
            $this->questions->Q3 => "yes",
            $this->questions->Q4 => "yes",
            $this->configs->config => $this->valid_configs->config3,
            $this->questions->Q5 => "return offer",
            $this->questions->Q6 => "reason if all return types are not available",
            $this->questions->Q7 => "no",
            $this->configs->config4 => $this->valid_configs->config4,
            $this->questions->Q8 => "a",
            $this->questions->Q10 => "yes",
            $this->questions->Q11 => "a",
            $this->questions->Q12 => "message displayed to customer",
            $this->questions->Q13 => "yes",
        ];
        $response = $this->postJson('/refund_automation_settings', $automation_settings);

        $response
            ->assertStatus(201)
            ->assertJsonFragment([
                'created' => true,
            ]);
    }

    public function test_making_an_invalid_post_by_missing_config4()
    {
        $automation_settings = [
            $this->questions->Q1 => "yes",
            $this->questions->Q2 => "reason",
            $this->questions->Q3 => "yes",
            $this->questions->Q4 => "yes",
            $this->questions->Q5 => "return offer",
            $this->questions->Q6 => "reason if all return types are not available",
            $this->questions->Q7 => "no",
            $this->questions->Q8 => "a",
            $this->questions->Q10 => "yes",
            $this->questions->Q11 => "a",
            $this->questions->Q12 => "message displayed to customer",
            $this->questions->Q13 => "yes",
        ];
        $response = $this->postJson('/refund_automation_settings', $automation_settings);


        $response
            ->assertStatus(422);
    }

    public function test_making_a_valid_post_request_with_Question_nine()
    {
        $automation_settings = [
            $this->questions->Q1 => "yes",
            $this->questions->Q2 => "reason",
            $this->questions->Q3 => "yes",
            $this->questions->Q4 => "yes",
            $this->configs->config => $this->valid_configs->config3,
            $this->questions->Q5 => "return offer",
            $this->questions->Q6 => "reason if all return types are not available",
            $this->questions->Q7 => "no",
            $this->questions->Q8 => "b",
            $this->questions->Q9 => "list of reasons",
            $this->questions->Q10 => "yes",
            $this->questions->Q11 => "a",
            $this->questions->Q12 => "message displayed to customer",
            $this->questions->Q13 => "yes",
        ];
        $response = $this->postJson('/refund_automation_settings', $automation_settings);

        $response
            ->assertStatus(201)
            ->assertJsonFragment([
                'created' => true,
            ]);
    }

    public function test_making_a_invalid_post_request_with_Question_nine()
    {
        $automation_settings = [
            $this->questions->Q1 => "yes",
            $this->questions->Q2 => "reason",
            $this->questions->Q3 => "yes",
            $this->questions->Q4 => "yes",
            $this->configs->config => $this->valid_configs->config3,
            $this->questions->Q5 => "return offer",
            $this->questions->Q6 => "reason if all return types are not available",
            $this->questions->Q7 => "no",
            $this->questions->Q8 => "a",
            $this->questions->Q9 => "list of reasons",
            $this->questions->Q10 => "yes",
            $this->questions->Q11 => "a",
            $this->questions->Q12 => "message displayed to customer",
            $this->questions->Q13 => "yes",
        ];
        $response = $this->postJson('/refund_automation_settings', $automation_settings);

        $response
            ->assertStatus(422);
    }

    public function test_making_a_valid_post_request_with_config5()
    {
        $automation_settings = [
            $this->questions->Q1 => "yes",
            $this->questions->Q2 => "reason",
            $this->questions->Q3 => "yes",
            $this->questions->Q4 => "yes",
            $this->questions->Q5 => "return offer",
            $this->questions->Q6 => "reason if all return types are not available",
            $this->questions->Q7 => "yes",
            $this->questions->Q8 => "b",
            $this->questions->Q9 => "list of reasons",
            $this->questions->Q10 => "no",
            $this->configs->config5 => $this->valid_configs->config5,
            $this->questions->Q11 => "a",
            $this->questions->Q12 => "message displayed to customer",
            $this->questions->Q13 => "yes",
        ];
        $response = $this->postJson('/refund_automation_settings', $automation_settings);

        $response
            ->assertStatus(201)
            ->assertJsonFragment([
                'created' => true,
            ]);
    }

    public function test_making_an_invalid_post_request_without_config5()
    {
        $automation_settings = [
            $this->questions->Q1 => "yes",
            $this->questions->Q2 => "reason",
            $this->questions->Q3 => "yes",
            $this->questions->Q4 => "yes",
            $this->questions->Q5 => "return offer",
            $this->questions->Q6 => "reason if all return types are not available",
            $this->questions->Q7 => "yes",
            $this->questions->Q8 => "b",
            $this->questions->Q9 => "list of reasons",
            $this->questions->Q10 => "no",
            $this->questions->Q11 => "a",
            $this->questions->Q12 => "message displayed to customer",
            $this->questions->Q13 => "yes",
        ];
        $response = $this->postJson('/refund_automation_settings', $automation_settings);

        $response
            ->assertStatus(422);
    }

    public function test_making_a_valid_post_request_with_config6()
    {
        $automation_settings = [
            $this->questions->Q1 => "yes",
            $this->questions->Q2 => "reason",
            $this->questions->Q3 => "yes",
            $this->questions->Q4 => "yes",
            $this->questions->Q5 => "return offer",
            $this->questions->Q6 => "reason if all return types are not available",
            $this->questions->Q7 => "yes",
            $this->questions->Q8 => "c",
            $this->configs->config6 => $this->valid_configs->config6,
            $this->questions->Q9 => "list of reasons",
            $this->questions->Q10 => "no",
            $this->questions->Q11 => "a",
            $this->questions->Q12 => "message displayed to customer",
            $this->questions->Q13 => "yes",
        ];
        $response = $this->postJson('/refund_automation_settings', $automation_settings);

        $response
            ->assertStatus(201)
            ->assertJsonFragment([
                'created' => true,
            ]);
    }

    public function test_making_a_valid_post_request_without_config6()
    {
        $automation_settings = [
            $this->questions->Q1 => "yes",
            $this->questions->Q2 => "reason",
            $this->questions->Q3 => "yes",
            $this->questions->Q4 => "yes",
            $this->questions->Q5 => "return offer",
            $this->questions->Q6 => "reason if all return types are not available",
            $this->questions->Q7 => "yes",
            $this->questions->Q8 => "c",
            $this->questions->Q9 => "list of reasons",
            $this->questions->Q10 => "no",
            $this->questions->Q11 => "a",
            $this->questions->Q12 => "message displayed to customer",
            $this->questions->Q13 => "yes",
        ];
        $response = $this->postJson('/refund_automation_settings', $automation_settings);

        $response
            ->assertStatus(422);
    }
}