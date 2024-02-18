<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Cookie;
use Livewire\Attributes\On;
use Livewire\Component;

class EnquiryBasket extends Component
{
    public int $counter;

    public string $basket_list_string;

    public array $basket_list_array;

    #[On('basket-updated')]
    public function updateBasket($saved, $product_id)
    {
        if ($saved) {
            array_push($this->basket_list_array, $product_id);
        } else {
            $this->basket_list_array = array_diff($this->basket_list_array, [$product_id]);
        }
        $this->basket_list_string = implode(',', $this->basket_list_array);

        Cookie::queue('basket_list', $this->basket_list_string);

        $this->broadcastCounter();
    }

    public function broadcastCounter()
    {
        $this->getCounter();
        $this->dispatch('counter-broadcast', $this->counter);
    }

    public function getCounter()
    {
        $this->counter = count($this->basket_list_array);
    }

    public function mount()
    {
        $this->getBasketListCookieString();
        $this->getBasketListArray();
        $this->broadcastCounter();
    }

    public function getBasketListCookieString()
    {
        $this->basket_list_string = Cookie::get('basket_list', '');
    }

    public function getBasketListArray()
    {
        $this->basket_list_array = $this->basket_list_string ? explode(',', $this->basket_list_string) : [];
    }

    public function clear()
    {
        $this->basket_list_array = [];
        Cookie::queue('basket_list', '');
        $this->counter = 0;
        $this->broadcastCounter();
    }
}
