<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Badge extends Component
{
    public $status;

    public function __construct($status)
    {
        $this->status = $status;
    }

    public function render()
    {
        return view('components.badge');
    }

    public function statusClass()
    {
        switch ($this->status) {
            case 'PENDIENTE':
                return 'bg-pending';
            case 'EN PROGRESO':
                return 'bg-in-progress';
            case 'COMPLETADA':
                return 'bg-completed';
            default:
                return 'bg-gray-400';
        }
    }
}