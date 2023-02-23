<?php

namespace App\Http\Livewire;

use App\Imports\ContactImports;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\TemporaryUploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Psr\Log\LoggerInterface;

class Contact extends Component
{

    use WithFileUploads;

    public $excel_file;

    public $contacts;

    public $column_header_title;
    public $column_header_first_name;
    public $column_header_last_name;
    public $column_header_mobile_number;
    public $column_header_company_name;

    public function mount()
    {
        $this->column_header_title = 'title';
        $this->column_header_first_name = 'first_name';
        $this->column_header_last_name = 'last_name';
        $this->column_header_mobile_number = 'mobile_number';
        $this->column_header_company_name = 'company_name';

        $this->contacts = \App\Models\Contact::all();
    }


    public function save()
    {
        try {
            $data = $this->parseData();
            DB::beginTransaction();
            \App\Models\Contact::insert($data);

            DB::commit();
            session()->flash('message', 'Successfully saved!');
            $this->contacts = \App\Models\Contact::all();
            
        } catch (\Throwable $th) {
            session()->flash('error-message', 'Error! Please see the log file!');
            Log::error($th->getMessage());
            DB::rollBack();

        }
      
    }

    public function parseData()
    {   
        $data = Excel::toCollection(new ContactImports(), $this->excel_file->store('contacts'));

        $data = $data->all()[0];
        $data->shift();
        $data = $data->map(function ($row) {

            $title = $row[0];
            $first_name = $row[1];
            $last_name = $row[2];
            $mobile_number = $row[3];
            $company_name = $row[4];

            return [
                'title' => ${$this->column_header_title},
                'first_name' => ${$this->column_header_first_name},
                'last_name' => ${$this->column_header_last_name},
                'mobile_number' => ${$this->column_header_mobile_number},
                'company_name' => ${$this->column_header_company_name},
            ];
        });

        return $data->all();
    }

    
    public function render()
    {
        return view('livewire.contact');
    }
}
