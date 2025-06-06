<div>
    <div class="col-md-12">
        <div class="main-section">
            <div class="main-top-heading">
                <h2>Buy Online & Save!</h2>
                <h4>Faster service. More savings.</h4>
            </div>

            <div class="select-multi-options">
                <h3 class="select-opt-heading">Select all that apply</h3>
                <form action="">
                    <div class="select-opt-main">
                        @foreach($bugs as $bug)
                            <label class="profile-option">
                                <input type="checkbox" wire:click="markSelected({{ $bug->id }})" @if(in_array($bug->id, $selectedBugs)) checked @endif>
                                <div class="profile-card">
                                    <div class="profile-img">
                                        <img src="{{ asset('storage/'.$bug->image) }}" alt="Ant" class="img-fluid">
                                        <span class="checkmark">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="43" height="43" viewBox="0 0 43 43" fill="none">
                                                <circle cx="21.5329" cy="21.4673" r="20.3537" fill="#0080FF" stroke="white" stroke-width="1.77287"/>
                                                <path d="M33.5542 12.5472C33.6497 12.6425 33.7255 12.7557 33.7772 12.8803C33.8289 13.0049 33.8555 13.1385 33.8555 13.2734C33.8555 13.4083 33.8289 13.5419 33.7772 13.6665C33.7255 13.7911 33.6497 13.9043 33.5542 13.9995L19.1952 28.3586C19.0999 28.4541 18.9867 28.5299 18.8621 28.5816C18.7375 28.6333 18.6039 28.6599 18.469 28.6599C18.3341 28.6599 18.2005 28.6333 18.0759 28.5816C17.9513 28.5299 17.8381 28.4541 17.7429 28.3586L10.5634 21.179C10.3708 20.9865 10.2626 20.7253 10.2626 20.4529C10.2626 20.1805 10.3708 19.9193 10.5634 19.7267C10.7559 19.5341 11.0172 19.426 11.2895 19.426C11.5619 19.426 11.8231 19.5341 12.0157 19.7267L18.469 26.1821L32.1019 12.5472C32.1971 12.4517 32.3103 12.3759 32.4349 12.3242C32.5595 12.2725 32.6931 12.2459 32.828 12.2459C32.9629 12.2459 33.0965 12.2725 33.2211 12.3242C33.3457 12.3759 33.4589 12.4517 33.5542 12.5472Z" fill="white"/>
                                            </svg>
                                        </span>
                                    </div>
                                    <span>{{ $bug->name }}</span>
                                </div>
                            </label>
                        @endforeach
                    </div>
                    <div class="btn-main">
                        <button type="button" class="btn-site" wire:click="storeBugs">Next</button>
                    </div>
                </form>
            </div>

            <div class="slider-dot-main">
                <span class="active"></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
</div>
