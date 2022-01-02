<?php

namespace App\View\Components;

use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\View\Component;

class Following extends Component
{
    public $users;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct( UserRepositoryInterface $userRepository)
    {
        $this->users  = $userRepository->following();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.following');
    }
}
