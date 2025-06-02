<div>
    <div class="row">
        @foreach($bugs as $bug)
            <div class="col-2 m-3">
                <div class="card">
                    <div class="card-body">
                        <p>{{ $bug->name }}</p>
                        @if($bug->image)
                            <img src="{{ asset('storage/'.$bug->image) }}" width="100">
                        @endif
                        <input type="checkbox" wire:click="markSelected({{ $bug->id }})" @if(in_array($bug->id, $selectedBugs)) checked @endif>
                    </div>
                </div>
            </div>
        @endforeach
        <button type="button" class="btn btn-primary" wire:click="storeBugs">Next</button>
    </div>
</div>
