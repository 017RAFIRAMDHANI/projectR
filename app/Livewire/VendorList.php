<?php

namespace App\Livewire;

use App\Models\Vendor;
use Livewire\Component;
use Livewire\WithPagination;
class VendorList extends Component
{
    public $vendors = [];
    public $search = '';
    public $isSearching = false;

    public function mount()
    {
        $this->fetchVendors();
    }

    public function fetchVendors()
    {
        if ($this->search) {
            $this->vendors = Vendor::where('company_name', 'LIKE', "%{$this->search}%")
                ->orWhere('requestor_name', 'LIKE', "%{$this->search}%")
                ->orWhere('email', 'LIKE', "%{$this->search}%")
                ->orWhere('phone_number', 'LIKE', "%{$this->search}%")
                ->get();
            $this->isSearching = true;
        } else {
            $this->vendors = Vendor::all();
            $this->isSearching = false;
        }
    }

public function updatedSearch()
{
    $this->isSearching = !empty($this->search);  // Update status pencarian
    $this->fetchVendors();  // Ambil data sesuai dengan pencarian
}


    public function render()
    {
        return view('livewire.vendor-list', ['isSearching' => $this->isSearching]);
    }
    // Set up polling to refresh data every 10 seconds automatically
    // public function getListeners()
    // {
    //     return [
    //         "refreshVendorList" => "fetchVendors", // Automatically refresh the data every time the interval expires
    //     ];
    // }

    // // Refresh data every 10 seconds using Livewire's polling
    // public function refreshData()
    // {
    //     $this->fetchVendors();  // Refresh the data automatically
    // }
}
