<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class OtpForm extends Form
{
    #[Validate('required|max:6')]
    public $otp = '';
}
