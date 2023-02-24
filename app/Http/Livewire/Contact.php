<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Imports\ContactImports;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Contact as ContactModel;
use App\Models\Contacts;
use Illuminate\Support\Collection;
use App\Services\ContactService;

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

    public $title_update_text;

    public $first_name_update_text;

    public $last_name_update_text;

    public $mobile_number_update_text;

    public $company_name_update_text;

    public function mount()
    {
        $this->column_header_title = 'title';
        $this->column_header_first_name = 'first_name';
        $this->column_header_last_name = 'last_name';
        $this->column_header_mobile_number = 'mobile_number';
        $this->column_header_company_name = 'company_name';

        $this->contacts = ContactModel::all();
    }

    public function save()
    {
        try {
            
            $contactsCollections =  Excel::toCollection(new ContactImports(), $this->excel_file->store('contacts'));

            $columnHeaders = [
                'column_header_title' => $this->column_header_title,
                'column_header_first_name' => $this->column_header_first_name,
                'column_header_last_name' => $this->column_header_last_name,
                'column_header_mobile_number' => $this->column_header_mobile_number,
                'column_header_company_name' => $this->column_header_company_name,
            ];

            $data = ContactService::mapExcellCollectionsByColumnHeadersToArray($contactsCollections, $columnHeaders);
            
            DB::beginTransaction();

            ContactModel::insert($data);

            DB::commit();
            
            $this->contacts = ContactModel::all();

            session()->flash('message', 'Contacts was successfully imported!');
            
            
        } catch (\Throwable $th) {

            DB::rollBack();

            Log::error($th->getMessage());

            session()->flash('error-message', 'There is a problem importing the file');
        }
      
    }

    public function findContact($id)
    {
        $contact = ContactModel::find($id);

        $this->title_update_text = $contact->title;

        // HELP TO RENDER TEXTFIELDS


        // dd($this->title_update_text);

        // $this->first_name_update_text = $contact->first_name;
    }


    public function updateContact($id, $title, $fname)
    {

        try {
          
            dd($id, $title, $fname);
            // $contact->update([
            //     'title' => $this->title_update_text ,
            //     'first_name' => $this->first_name_update_text,
            //     'last_name' => $this->last_name_update_text,
            //     'mobile_number' => $this->mobile_number_update_text,
            //     'company_name' => $this->company_name_update_text
            // ]);

            $this->contacts = ContactModel::all();

            DB::commit();

            session()->flash('table-message', 'Contact has been updated!');
        } catch (\Throwable $th) {
            DB::rollBack();

            Log::error($th->getMessage());

            session()->flash('error-table-message', 'There is a problem Updating the row');
        }
    }


    public function deleteContact($id)
    {
        try {

            DB::beginTransaction();

            ContactModel::destroy($id);
  
            $this->contacts = ContactModel::all();

            DB::commit();

            session()->flash('table-message', 'Contact has been removed!');

        } catch(\Throwable $th){
            DB::rollBack();

            Log::error($th->getMessage());

            session()->flash('error-table-message', 'There is a problem Deleting the row');
        }
      
    }

    public function render()
    {
        return view('livewire.contact');
    }
}