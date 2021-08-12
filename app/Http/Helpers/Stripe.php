<?php

namespace App\Http\Helpers;

use App\{User, Brand};

class Stripe
{
    private $mode;
    private $stripe;

    public function __construct()
    {
        $this->mode = config('stripe.settings.mode');
        $this->stripe = new \Stripe\StripeClient(config("stripe.{$this->mode}.secret_key"));
        \Stripe\Stripe::setApiKey(config("stripe.{$this->mode}.secret_key"));
    }

    public function createCustomer($email)
    {
        $user = User::where('email', $email)->first();

        $source = $this->stripe->source->create([
            "type" => "sepa_debit",
            "sepa_debit" => ["iban" => $user->brand->iban],
            "currency" => "eur",
            "owner" => [
              "name" => "Jenny Rosen",
            ],
        ]);

        $customer = \Stripe\Customer::create([
            'email' => $email,
            'source' => $source['id'],
        ]);
        
        $user->brand->card()->create([
            'stripe_cus_id' => $customer['id']
        ]);
    }

    public function deleteCustomer($brandId)
    {
        $customerId = Brand::find($brandId)->card->stripe_cus_id;
        $this->stripe->customers->delete($customerId);
    }
}