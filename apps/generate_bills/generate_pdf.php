<?php

namespace Dompdf;

require_once 'dompdf/autoload.inc.php';

class Generate_Pdf
{
    function generate_pdf($html)
    {
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
    }
}
