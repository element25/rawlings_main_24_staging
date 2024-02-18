<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Support\Facades\Cookie;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ContactForm extends Component
{
    #[Validate('required', message: 'Please enter your name')]
    public $name = '';

    #[Validate('required|email', message: 'Please enter your email address')]
    public $email = '';

    #[Validate('required', message: 'Please enter your phone number')]
    public $phone = '';

    #[Validate('required', message: 'Please enter details on how we can help you ')]
    public $enquiry = '';

    public $market = '';

    public $markets = [];

    #[Validate('required|min:1', message: 'Please enter the areas that you need help with')]
    public $services = [];

    public $source = '';

    public $products = [];

    //#[Validate('required')]
    public $basket_list_string;

    public $basket_list_array;

    public function rules()
    {
        return [
            'market' => ['required', 'in:'.implode(',', collect($this->markets)->pluck('value')->toArray())],
        ];
    }

    public function messages()
    {
        return [
            'market' => 'Please select your main market sector',
        ];
    }

    public function validate_market($value)
    {
        $this->market = $value;
        $this->validateOnly('market');
    }

    public function send()
    {
        $this->validate();
        $this->reset();
        //$this->redirect('/contact-us');

    }

    public function removeItem($product_id)
    {
        $this->basket_list_array = explode(',', $this->basket_list_string);
        //ray($this->basket_list_array);
        $this->basket_list_array = array_diff($this->basket_list_array, [$product_id]);
        $this->basket_list_string = implode(',', $this->basket_list_array);

        Cookie::queue('basket_list', $this->basket_list_string);

        $this->getProducts();

        $this->dispatch('basket-updated', saved: false, product_id: $product_id)->to(name: EnquiryBasket::class);

    }

    public function getProducts()
    {
        //ray($this->basket_list_array);
        $this->products = $this->basket_list_array ? Product::whereIn('id', $this->basket_list_array)->get() : collect();

        //ray($this->products);
    }

    public function checkErorrs($input)
    {
        $errors = $this->getErrorBag();
        ray($errors);
    }

    public function clear()
    {
        $this->redirect('/contact-us');

    }

    public function mount()
    {
        $this->getBasketListCookieString();
        $this->getBasketListArray();
        $this->getProducts();

        $this->markets = [
            ['id' => '0', 'value' => '', 'name' => 'Your market sector'], //USED AS PLACEHOLDER
            ['id' => '1', 'value' => 'Beer_Cider', 'name' => 'Beer & Cider'],
            ['id' => '2', 'value' => 'Wines', 'name' => 'Wines'],
            ['id' => '3', 'value' => 'Spirits', 'name' => 'Spirits'],
            ['id' => '4', 'value' => 'Soft_Drinks', 'name' => 'Soft Drinks'],
            ['id' => '5', 'value' => 'Food', 'name' => 'Food'],
            ['id' => '6', 'value' => 'Health_Beauty', 'name' => 'Health & Beauty'],
            ['id' => '7', 'value' => 'Candles_Diffusers', 'name' => 'Candles & Diffusers'],
            ['id' => '8', 'value' => 'Closures_Pumps', 'name' => 'Closures & Pumps'],
        ];
    }

    public function getBasketListCookieString()
    {
        $this->basket_list_string = Cookie::get('basket_list');
        //ray($this->basket_list_string);
    }

    public function getBasketListArray()
    {
        $this->basket_list_array = explode(',', $this->basket_list_string);
        //ray($this->basket_list_array);
    }

    public function render()
    {
        //ray($this->products);
        //$this->products = $this->getProducts();

        return view('livewire.contact-form');
    }
}
