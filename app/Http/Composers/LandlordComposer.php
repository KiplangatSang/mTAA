<?php
namespace App\Http\Composers;
use App\Repositories\AppRepository;
use App\Repositories\LandlordRepository;
use Illuminate\View\View;

class LandlordComposer
{
    public function compose(View $view)
    {
        $appRepo = new LandlordRepository();
        $landlorddata = $appRepo->getAppData();
       return $view->with('landlorddata', $landlorddata);
    }
}
