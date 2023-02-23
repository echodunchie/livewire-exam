<div>
    <form wire:submit.prevent="submit">
        <div class="form-group">
            <label>File</label>
            <input type="file" wire:model="upload">

            @error('upload') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label>File Description</label>
            <input type="input" wire:model="description">

            @error('description') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <button type="submit">Upload</button>
        </div>
    </form>
    <div class="row">
        <div class="col-sm-12">
            @if ($saved)
                <p>The file {{ $upload->getClientOriginalName() }} with the size of {{ round($upload->getSize() / 1024, 0) }} KB has been uploaded!</p>
                <p>The file can be found locally at {{ $saved }}.
            @endif
        </div>
    </div>
</div>