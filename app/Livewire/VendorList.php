<?php

namespace App\Livewire;

use App\Models\Vendor;
use Livewire\Component;

class VendorList extends Component
{
    public $vendors = [];  // To store the list of vendors from the database

    // Set polling interval (in seconds)
    protected $pollingInterval = 1; // Update data every 10 seconds

    public function mount()
    {
        $this->fetchVendors(); // Fetch data when the component is mounted
    }

    // Fetch vendors from the database
    public function fetchVendors()
    {
        // Fetch all vendors from the database
        $this->vendors = Vendor::all();  // Fetching all vendors from the `vendors` table
    }

    public function render()
    {
        return view('livewire.vendor-list');  // Render the vendor list view
    }

    // Set up polling to refresh data every 10 seconds automatically
    public function getListeners()
    {
        return [
            "refreshVendorList" => "fetchVendors", // Automatically refresh the data every time the interval expires
        ];
    }

    // Refresh data every 10 seconds using Livewire's polling
    public function refreshData()
    {
        $this->fetchVendors();  // Refresh the data automatically
    }
}
