<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class UploadCsv extends Component
{
    use WithFileUploads;

    public $excel_fil;
    
    public $column_header_title, 
    $column_header_first_name, 
    $column_header_last_name, 
    $column_header_mobile_number, 
    $column_header_company_name;


    public function render()
    {
        return view('livewire.upload-csv');
    }
}
