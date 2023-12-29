<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Validation\Rules\Password;

class LoginForm extends Form
{
    #[Validate('required|email')]
    public $email = '';
 
    #[Validate('required')]
    public $password = '';
    #[Validate('bool')]
    public $remember = false;
}
