<?php

namespace App\Filament\Resources\CheckInResource\Widgets;

use Carbon\Carbon;
use Dompdf\Dompdf;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Response;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CheckInCode extends Widget
{
    protected static string $view = 'filament.resources.check-in-resource.widgets.check-in-code';

    public function download()
    {
        return redirect()->route('check-in-download');
    }
}
