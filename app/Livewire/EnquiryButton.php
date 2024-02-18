<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Support\Facades\Cookie;
use Livewire\Component;

class EnquiryButton extends Component
{
    public $saved;

    public $product;

    public function toggleSaved()
    {
        //        ray('toggleSaved');
        $this->saved = ! $this->saved;
        $this->dispatch('basket-updated', saved: $this->saved, product_id: $this->product->id)->to(name: EnquiryBasket::class);
    }

    public function mount(Product $product)
    {
        $this->product = $product;
        //        ray($product);
        $basket_list_string = Cookie::get('basket_list');
        $basket_list_array = $basket_list_string ? explode(',', $basket_list_string) : [];
        $this->saved = in_array($this->product->id, $basket_list_array) ? true : false;
    }

    public function render()
    {
        return view('livewire.enquiry-button');
    }
}
