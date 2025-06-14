<div class="col-md-12">
    <div class="main-section">
        <div class="main-top-heading">
            <h2>Schedule Appointment</h2>
            <h4>Faster service. More savings.</h4>
        </div>

        <div class="select-multi-options">

            <form action="">
                <div class="Date-picker-main">
                    <h3>Reserve a Date & Time</h3>

                    <div class="date-picker">
                        <input type="text" id="calendar" class="form-control" placeholder="Select date">

                        <div id="dates">
                            <div class="custom-radio-group mb-3">
                                <input type="radio" id="option1" wire:model.defer="appointment_time" class="custom-radio" checked>
                                <label for="option1" class="custom-radio-label">Mon  06/02/2025  AM</label>
                            </div>
                            <div class="custom-radio-group">
                                <input type="radio" id="option2" wire:model.defer="appointment_time" class="custom-radio" checked>
                                <label for="option2" class="custom-radio-label">Mon  06/02/2025  PM</label>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" wire:model.defer="appointment_date" id="appointment_date">
                    <input type="hidden" wire:model.defer="appointment_time" id="appointment_time">
                </div>
                <div class="btn-main">
                    <button type="button" class="btn-site btn-invert me-3 me-sm-5" href="/payment-info" wire:navigate>Back</button>
                    <button type="button" class="btn-site" wire:click="saveAppointment">Schedule</button>
                </div>
            </form>

        </div>

        <div class="slider-dot-main">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span class="active"></span>
            <span></span>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script>
            function formatDateForDisplay(date) {
                const day = date.toLocaleDateString('en-US', { weekday: 'short' }); // e.g., Mon
                const mm = ("0" + (date.getMonth() + 1)).slice(-2);
                const dd = ("0" + date.getDate()).slice(-2);
                const yyyy = date.getFullYear();
                return `${day} ${mm}/${dd}/${yyyy}`;
            }

            function formatDateForLivewire(date) {
                // YYYY-MM-DD
                const yyyy = date.getFullYear();
                const mm = ("0" + (date.getMonth() + 1)).slice(-2);
                const dd = ("0" + date.getDate()).slice(-2);
                return `${yyyy}-${mm}-${dd}`;
            }

            function renderRadioOptions(displayDate, saveDate, time) {
                const html = `
            <div class="custom-radio-group mb-2">
                <input type="radio" id="option1" name="customRadio" class="custom-radio" value="AM" ${time === 'AM' ? 'checked' : ''}>
                <label for="option1" class="custom-radio-label">${displayDate} AM</label>
            </div>
            <div class="custom-radio-group">
                <input type="radio" id="option2" name="customRadio" class="custom-radio" value="PM" ${time === 'PM' ? 'checked' : ''}>
                <label for="option2" class="custom-radio-label">${displayDate} PM</label>
            </div>
        `;
                document.getElementById("dates").innerHTML = html;

                let dateInput = document.getElementById("appointment_date");
                dateInput.value = saveDate;
                dateInput.dispatchEvent(new Event('input'));

                // Set appointment_time hidden input and update on radio change
                document.querySelectorAll('input[name="customRadio"]').forEach(radio => {
                    radio.addEventListener('change', function () {
                        let timeInput = document.getElementById("appointment_time");
                        timeInput.value = this.value;
                        timeInput.dispatchEvent(new Event('input'));
                    });
                });

                // Default select AM and trigger Livewire input
                let timeInput = document.getElementById("appointment_time");
                timeInput.value = "AM";
                timeInput.dispatchEvent(new Event('input'));
            }

            document.addEventListener("DOMContentLoaded", function () {
                const tomorrow = new Date(@json($appointment_date ?? ''));
                const time = @json($appointment_time ?? 'AM');
                const displayDate = formatDateForDisplay(tomorrow);
                const saveDate = formatDateForLivewire(tomorrow);
                renderRadioOptions(displayDate, saveDate, time);

                flatpickr("#calendar", {
                    inline: true,
                    minDate: "today",
                    dateFormat: "Y-m-d",
                    defaultDate: tomorrow,
                    onChange: function (selectedDates) {
                        if (selectedDates.length) {
                            const display = formatDateForDisplay(selectedDates[0]);
                            const save = formatDateForLivewire(selectedDates[0]);
                            renderRadioOptions(display, save, 'AM');
                        }
                    },
                });
            });
        </script>
    </div>
</div>
