<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Producto;

class SearchProducts extends Component
{
    public $search;

    protected $queryString = ['search'];

    public function render()
    {
        $products = collect();
        if ($this->search != '') {
            $products = Producto::where('nombre', 'like', '%' . $this->search . '%')->get();
        }

        return view('livewire.search-products', compact('products'));
    }
}
