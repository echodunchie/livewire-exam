<div class="mt-5 ">
    <div class="container mt-5 px-2">

        <div class="mb-2 d-flex justify-content-between align-items-center">

            <div class="form-group">
                <label>File</label>
                <input type="file" wire:model="excel_file">

                @error('upload') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-responsive table-borderless mt-5">
                <thead>
                    <tr class="bg-light">
                        <th scope="col" width="5%">Title</th>
                        <th scope="col" width="20%">
                            <select wire:model="column_header_title">
                                <option value="">Select Option</option>
                                <option value="title">Title</option>
                                <option value="first_name">First Name</option>
                                <option value="last_name">Last Name</option>
                                <option value="mobile_number">Mobile Number</option>
                                <option value="company_name">Company Name</option>
                            </select>
                        </th>
                    </tr>
                    <tr class="bg-light">
                        <th scope="col" width="5%">First Name</th>
                        <th scope="col" width="20%">
                            <select wire:model="column_header_first_name">
                                <option value="">Select Option</option>
                                <option value="title">Title</option>
                                <option value="first_name">First Name</option>
                                <option value="last_name">Last Name</option>
                                <option value="mobile_number">Mobile Number</option>
                                <option value="company_name">Company Name</option>
                            </select>
                        </th>
                    </tr>
                    <tr class="bg-light">
                        <th scope="col" width="5%">Last Name</th>
                        <th scope="col" width="20%">
                            <select wire:model="column_header_last_name">
                                <option value="">Select Option</option>
                                <option value="title">Title</option>
                                <option value="first_name">First Name</option>
                                <option value="last_name">Last Name</option>
                                <option value="mobile_number">Mobile Number</option>
                                <option value="company_name">Company Name</option>
                            </select>
                        </th>
                    </tr>
                    <tr class="bg-light">
                        <th scope="col" width="5%">Mobile Number</th>
                        <th scope="col" width="20%">
                            <select wire:model="column_header_mobile_number">
                                <option value="">Select Option</option>
                                <option value="title">Title</option>
                                <option value="first_name">First Name</option>
                                <option value="last_name">Last Name</option>
                                <option value="mobile_number">Mobile Number</option>
                                <option value="company_name">Company Name</option>
                            </select>
                        </th>
                    </tr>
                    <tr class="bg-light">
                        <th scope="col" width="5%">Company Name</th>
                        <th scope="col" width="20%">
                            <select wire:model="column_header_company_name">
                                <option value="">Select Option</option>
                                <option value="title">Title</option>
                                <option value="first_name">First Name</option>
                                <option value="last_name">Last Name</option>
                                <option value="mobile_number">Mobile Number</option>
                                <option value="company_name">Company Name</option>
                            </select>
                        </th>
                    </tr>
                </thead>
                </tbody>
            </table>

            <button wire:click="save" class="btn btn-success">Save</button>

            @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
            @endif


            @if (session()->has('error-message'))
            <div class="alert alert-danger">
                {{ session('error-message') }}
            </div>
            @endif

            <div class="table-responsive mt-5">
                <table class="table table-sm">
                    <thead>
                        <tr class="bg-light">
                            <th scope="col" width="20%">Title</th>
                            <th scope="col" width="20%">First Name</th>
                            <th scope="col" width="20%">Last Name</th>
                            <th scope="col" width="20%">Mobile Number</th>
                            <th scope="col" width="20%">Company Name</th>
                            <th scope="col" width="20%">Option</th>
                        </tr>

                        @foreach ($contacts as $contact)
                        <tr class="bg-light">
                            <th scope="col" width="20%">{{ $contact->title }}</th>
                            <th scope="col" width="20%">{{ $contact->first_name }}</th>
                            <th scope="col" width="20%">{{ $contact->last_name }}</th>
                            <th scope="col" width="20%">{{ $contact->mobile_number }}</th>
                            <th scope="col" width="20%">{{ $contact->company_name }}</th>
                            <th scope="col" width="20%"><button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateModal{{ $contact->id }}">Update</button></th>
                            <th scope="col" width="20%"><button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target=" #deleteModal{{$contact->id}}">Delete</button></th>
                        </tr>

                        <div class=" modal fade" id="updateModal{{$contact->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Update Contact</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row g-3 align-items-center">
                                            <div class="col-auto">
                                                <label for="inputPassword6" class="col-form-label">Title</label>
                                            </div>
                                            <div class="col-auto">
                                                <input type="text" value="{{$contact->title}}" class="text">
                                            </div>
                                        </div>
                                        <div class="row g-3 align-items-center">
                                            <div class="col-auto">
                                                <label for="inputPassword6" class="col-form-label">First Name</label>
                                            </div>
                                            <div class="col-auto">
                                                <input type="text" value="{{$contact->first_name}}" class="text">
                                            </div>
                                        </div>
                                        <div class="row g-3 align-items-center">
                                            <div class="col-auto">
                                                <label for="inputPassword6" class="col-form-label">Last Name</label>
                                            </div>
                                            <div class="col-auto">
                                                <input type="text" value="{{$contact->last_name}}" class="text">
                                            </div>
                                        </div>
                                        <div class="row g-3 align-items-center">
                                            <div class="col-auto">
                                                <label for="inputPassword6" class="col-form-label">Mobile Number</label>
                                            </div>
                                            <div class="col-auto">
                                                <input type="text" value="{{$contact->mobile_number}}" class="text">
                                            </div>
                                        </div>
                                        <div class="row g-3 align-items-center">
                                            <div class="col-auto">
                                                <label for="inputPassword6" class="col-form-label">Company Name</label>
                                            </div>
                                            <div class="col-auto">
                                                <input type="text" value="{{$contact->company_name}}" class="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" wire:click="updateContact({{ $contact->id }}, '{{ $contact->title }}', '{{ $contact->first_name }}',)" class="btn btn-primary" data-bs-dismiss="modal">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class=" modal fade" id="deleteModal{{$contact->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Contact</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete {{$contact->title}} {{$contact->first_name}}?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" wire:click="deleteContact({{$contact->id}})" class="btn btn-primary" data-bs-dismiss="modal">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @endforeach

                    </thead>
                    </tbody>
                </table>

                @if (session()->has('table-message'))
                <div class="alert alert-success">
                    {{ session('table-message') }}
                </div>
                @endif

                @if (session()->has('error-table-message'))
                <div class="alert alert-danger">
                    {{ session('error-table-message') }}
                </div>
                @endif

            </div>
        </div>
    </div>