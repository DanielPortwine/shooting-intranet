<?php

namespace App\Http\Controllers;

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
        $dompdf->stream('check-in.pdf', [
            'Attachment' => false,
        ]);
    }
}
