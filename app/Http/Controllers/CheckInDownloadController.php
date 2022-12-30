<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;

class CheckInDownloadController extends Controller
{
    public function download()
    {
        $options = new Options();
        $options->setIsRemoteEnabled(true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml(view('pdfs.check-in')->render());
        $dompdf->setPaper('A4');
        $dompdf->render();
        $dompdf->stream('check-in-sheet-' . Carbon::now()->format('Y-m-d') . '.pdf', [
            'Attachment' => false,
        ]);
    }
}
