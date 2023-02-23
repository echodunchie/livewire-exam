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
            <button wire:click="save">Save</button>

        </div>
    </div>
</div>