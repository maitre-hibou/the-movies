<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

final class DefaultLayout extends Component
{
    public function render(): View
    {
        return view('layouts.default');
    }
}
