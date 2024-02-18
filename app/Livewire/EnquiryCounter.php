<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class EnquiryCounter extends Component
{
    public int $counter;

    //    public string $basket_list_string;
    //
    //    //public array $basket_list = [123];
    //    public array $basket_list_array;
    //
    //    //private string $defaultProduct = '123';
    //    private ?string $defaultProduct = null;

    //    #[On('enquiry-updated')]
    //    public function updateBasket($saved, $product_id)
    //    {
    //        if ($saved) {
    //            array_push($this->basket_list_array, $product_id);
    //        } else {
    //            $this->basket_list = array_diff($this->basket_list_array, [$product_id]);
    //        }
    //        $this->basket_list_string = implode(',', $this->basket_list_array);
    //
    //        Cookie::queue('basket_list', $this->basket_list_string);
    //
    //        $this->counter = count($this->basket_list_array);
    //
    //        $this->dispatch('basket-updated');
    //
    //    }

    //    public function clear()
    //    {
    //        //$this->basket_list = [123];
    //        Cookie::queue('basket_list', '');
    //        $this->counter = count($this->basket_list);
    //    }
    //
    //    public function mount()
    //    {
    //        $this->basket_list_string = $this->getBasketListCookieString();
    //        ray($this->basket_list_string);
    //        //$this->basket_list = Cookie::get('basket_list') ? explode(',', Cookie::get('basket_list')) : [$this->defaultProduct];
    //        $this->basket_list_array = $this->basket_list_string ? explode(',', $this->basket_list_string) : [];
    //        ray($this->basket_list_array);
    //        $this->counter = count($this->basket_list_array);
    //    }

    //    public function getBasketListCookieString()
    //    {
    //        if ($this->defaultProduct) {
    //            $basket_list_string = $this->defaultProduct;
    //        } else {
    //            $basket_list_string = Cookie::get('basket_list');
    //        }
    //        ray($basket_list_string);
    //
    //        return $basket_list_string;
    //
    //    }

    #[On('counter-broadcast')]
    public function counterBroadcasted($counter)
    {
        //ray($counter);
        $this->counter = $counter;
    }

    public function render()
    {
        return view('livewire.enquiry-counter');
    }
}
