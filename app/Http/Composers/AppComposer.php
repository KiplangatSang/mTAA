<?php

namespace App\Http\Composers;

use App\Repositories\AppRepository;
use Illuminate\View\View;

class AppComposer
{
    public function compose(View $view)
    {
        $appRepo = new AppRepository();
        $data = $appRepo->getAppData();
       return $view->with('data', $data);
    }
}
