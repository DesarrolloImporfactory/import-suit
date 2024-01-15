<?php

namespace App\Http\Livewire\Products;

use App\Models\Category;
use App\Models\Multimedia;
use App\Models\Product;
use App\Models\Provider;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ClientProducts extends Component
{

    public function render()
    {
        $user = User::find(auth()->user()->id);
        return view('livewire.products.client-products', [
            'intent' => $user->createSetupIntent(),
            'paymentMethods' => $user->paymentMethods()
        ])->extends('layouts.app')->section('content');
    }

    public function getSuscription($plan)
    {
        $user = User::find(auth()->user()->id);
        if(!$user->defaultPaymentMethod()){
            $this->emit('er','No tiene un metodo de pago creado!');
            return;
        }
        
        if (!$user->stripe_id) {
            $user->createAsStripeCustomer();
        }

        $user->newSubscription('importador 3 en 1', $plan)
            ->create($this->defaultPaymentMethod->id);
    }

    public function getDefaultPaymentMethodProperty()
    {
        return auth()->user()->defaultPaymentMethod();
    }

    public function addMethodPaymed($paymentMethod)
    {
        $user = User::find(auth()->user()->id);
        $user->addPaymentMethod($paymentMethod);
        if (!$user->hasPaymentMethod()) {
            $user->addPaymentMethod($paymentMethod);
        } else {
            $user->addPaymentMethod($paymentMethod);
            $user->updateDefaultPaymentMethod($paymentMethod);
        }
    }

    public function deleteMethodPaymed($paymentMethod)
    {

        auth()->user()->deletePaymentMethod($paymentMethod);
    }

    public function defaultMethodPaymed($paymentMethod)
    {

        auth()->user()->updateDefaultPaymentMethod($paymentMethod);
    }
}
