<?php

defined('BASEPATH') or exit('No direct script access allowed');
/*
 *  ==============================================================================
 *  Author  : Mian Saleem
 *  Email   : saleem@tecdiary.com
 *  For     : PhpSpreadsheet
 *  Web     : https://github.com/PHPOffice/PhpSpreadsheet
 *  License : MIT
 *          : https://github.com/PHPOffice/PhpSpreadsheet/blob/master/LICENSE
 *  ==============================================================================
 */

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Excel extends Spreadsheet
{
    public function __construct()
    {
        parent::__construct();
    }

    public function __get($var)
    {
        return get_instance()->$var;
    }

    public function dace($sheet, $name = '')
    {
        $writer = new Xlsx($sheet);
        $writer->save($name ?: 'download.xlsx');
    }
}
