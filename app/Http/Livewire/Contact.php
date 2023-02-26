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

    public $contacts_update; 
    
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

    public $search;

    protected $queryString = ['search'];

    public function mount()
    {
        $this->column_header_title = 'title';
        $this->column_header_first_name = 'first_name';
        $this->column_header_last_name = 'last_name';
        $this->column_header_mobile_number = 'mobile_number';
        $this->column_header_company_name = 'company_name';

        $this->refreshTable(); 
    }

    
    public function querySearch()
    {
        $this->contacts = ContactModel::where('title', 'like', '%' . $this->search . '%')
        ->orWhere('first_name', 'like', '%' . $this->search . '%')
        ->orWhere('last_name', 'like', '%' . $this->search . '%')
        ->orWhere('mobile_number', 'like', '%' . $this->search . '%')
        ->orWhere('company_name', 'like', '%' . $this->search . '%')
        ->get();
    }


    public function saveContact()
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

            $this->refreshTable();
            session()->flash('message', 'Contacts has successfully imported!');
            
            
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
        $this->first_name_update_text = $contact->first_name;
        $this->last_name_update_text = $contact->last_name;
        $this->mobile_number_update_text = $contact->mobile_number;
        $this->company_name_update_text = $contact->company_name;

        $this->dispatchBrowserEvent('show-edit-form');
    }


    public function updateContact($id)
    {
        try {

            DB::commit();

            ContactModel::where('id', $id)->update([
                'title' => $this->title_update_text,
                'first_name' => $this->first_name_update_text,
                'last_name' => $this->last_name_update_text,
                'mobile_number' => $this->mobile_number_update_text,
                'company_name' => $this->company_name_update_text
            ]);

            $this->refreshTable();
            session()->flash('table-message', 'Contact has successfuly updated!');

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
  
            DB::commit();

            $this->refreshTable();
            session()->flash('table-message', 'Contact has successfully removed!');

        } catch(\Throwable $th){
            DB::rollBack();

            Log::error($th->getMessage());

            session()->flash('error-table-message', 'There is a problem Deleting the row');
        }
      
    }


    public function render()
    {
        return view('livewire.contact',[
            'contacts' => ContactModel::where('title', 'like', '%' . $this->search . '%')->get()
        ]);
    }

    // private methods

    private function refreshTable(){
        $this->contacts = ContactModel::all();
    }

}