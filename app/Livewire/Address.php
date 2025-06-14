<?php

namespace App\Livewire;

class Address extends BaseComponent
{
    public string $address;
    public string $latitude;
    public string $longitude;
    public string $isCommercial;

    protected $listeners = ['saveAddress'];

    public function mount()
    {
        if ($this->loadLead()) {
            return $this->redirect('/', true);
        }

        $this->address = $this->lead->address ?? '';
        $this->latitude = $this->lead->latitude ?? '40.7128';
        $this->longitude = $this->lead->longitude ?? '-74.0060';
        $this->isCommercial = $this->lead->is_commercial;
    }

    public function render()
    {
        return view('livewire.address');
    }

    public function saveAddress($address, $lat, $lng)
    {
        $this->address = $address;
        $this->latitude = $lat;
        $this->longitude = $lng;

        $this->lead->update([
            'address' => $address,
            'latitude' => $lat,
            'longitude' => $lng
        ]);
    }

    public function saveIsCommercial()
    {
        if ($this->lead) {
            $this->lead->update([
                'is_commercial' => $this->isCommercial
            ]);
        }

        return $this->redirect('/user-info', true);
    }
}
