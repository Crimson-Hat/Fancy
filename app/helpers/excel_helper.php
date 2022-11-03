<?php

defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('create_excel')) {
    function create_excel($excel, $filename)
    {
        header('Content-Type: ' . get_mime_by_extension('xlsx') . ' charset=utf-8');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($excel, 'Xlsx');
        $objWriter->save('php://output');
        exit;
    }
}
