<?php

namespace App\Livewire;

class Appointment extends BaseComponent
{
    public string $appointment_date = '';
    public string $appointment_time = '';

    public function mount()
    {
        if ($this->loadLead()) {
            return $this->redirect('/', true);
        }

        if (!is_null($this->lead->appointment_date) && !is_null($this->lead->appointment_time)) {
            $this->appointment_date = $this->lead->appointment_date ?? null;
            $this->appointment_time = $this->lead->appointment_time ?? null;
        }

        // Fallback defaults (optional)
        if (!$this->appointment_date) {
            $this->appointment_date = now()->addDay()->format('Y-m-d'); // default tomorrow
        }

        if (!$this->appointment_time) {
            $this->appointment_time = 'AM';
        }
    }

    public function render()
    {
        return view('livewire.appointment');
    }

    public function saveAppointment()
    {
        $this->validate([
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required|in:AM,PM',
        ]);

        $this->lead->update([
            'appointment_date' => $this->appointment_date,
            'appointment_time' => $this->appointment_time,
        ]);

        return $this->redirect('/success', true);

    }
}
