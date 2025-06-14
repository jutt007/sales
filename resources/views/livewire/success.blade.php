<div class="col-md-12">
    <div class="main-section">
        <div class="main-top-heading">
            <h2>Sign The Agreement</h2>
            <h4>Click the link. Review. Sign.</h4>
        </div>

        <div class="select-multi-options">

            <form action="">
                <div class="location-form">
                    <div class="sign-agreement">
                        <h3>Check your phone for a text <br/> with a link</h3>
                        <div id="countdown">00 : 00 : 30</div>
                        <p>Please review and sign the agreement.</p>
                        <h4>Once that is signed, your appointment will get <br/> booked!</h4>
                    </div>
                </div>
                <div class="btn-main">
                    <a style="text-decoration: none;" class="btn-site btn-invert me-3 me-sm-5" href="/appointment">Back</a>
                    <button type="button" class="btn-site" wire:click="finishProcess">Done</button>
                </div>
            </form>

        </div>

        <div class="slider-dot-main">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span class="active"></span>
        </div>
        <script>

            let seconds = 30;



            const countdownEl = document.getElementById('countdown');



            function formatTime(seconds) {

                const hrs = String(Math.floor(seconds / 3600)).padStart(2, '0');

                const mins = String(Math.floor((seconds % 3600) / 60)).padStart(2, '0');

                const secs = String(seconds % 60).padStart(2, '0');

                return `${hrs} : ${mins} : ${secs}`;

            }



            countdownEl.textContent = formatTime(seconds);



            const timer = setInterval(() => {

                seconds--;

                countdownEl.textContent = formatTime(seconds);



                if (seconds <= 0) {

                    clearInterval(timer);

                    countdownEl.textContent = "00 : 00 : 00";

                }

            }, 1000);

        </script>
    </div>
</div>
