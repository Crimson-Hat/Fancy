<?php

defined('BASEPATH') or exit('No direct script access allowed');
/*
 *  ==============================================================================
 *  Author  : Mian Saleem
 *  Email   : saleem@tecdiary.com
 *  For     : DOMPDF
 *  Web     : https://github.com/dompdf/dompdf
 *  License : LGPL-2.1
 *      : https://github.com/dompdf/dompdf/blob/master/LICENSE.LGPL
 *  ==============================================================================
 */

use Dompdf\Dompdf;
use ArUtil\I18N\Arabic;
use ArUtil\I18N\Identifier;

class Tec_dompdf extends DOMPDF
{
    public function __construct()
    {
        parent::__construct();
    }

    public function generate($content, $name = 'download.pdf', $output_type = null, $footer = null, $margin_bottom = null, $header = null, $margin_top = null, $orientation = 'P')
    {
        $html = '';
        if (is_array($content)) {
            foreach ($content as $page) {
                $html .= $header ? '<header>' . $header . '</header>' : '';
                $html .= '<footer>' . ($footer ? $footer . '<br><span class="pagenum"></span>' : '<span class="pagenum"></span>') . '</footer>';
                $html .= '<div class="page">' . $page['content'] . '</div>';
            }
        } else {
            $html .= $header ? '<header>' . $header . '</header>' : '';
            $html .= $footer ? '<footer>' . $footer . '</footer>' : '';
            $html .= $content;
        }

        // Fix arabic characters
        $Arabic = new Arabic('Glyphs');
        $p      = Identifier::identify($html);
        for ($i = count($p) - 1; $i >= 0; $i -= 2) {
            $utf8ar = $Arabic->utf8Glyphs(substr($html, $p[$i - 1], $p[$i] - $p[$i - 1]));
            $html   = substr_replace($html, $utf8ar, $p[$i - 1], $p[$i] - $p[$i - 1]);
        }

        // $this->set_option('debugPng', true);
        // $this->set_option('debugLayout', true);
        $this->set_option('isPhpEnabled', true);
        $this->set_option('isHtml5ParserEnabled', true);
        $this->set_option('isRemoteEnabled', true);
        $this->loadHtml($html);
        $this->setPaper('A4', ($orientation == 'P' ? 'portrait' : 'landscape'));
        $this->getOptions()->setIsFontSubsettingEnabled(true);
        $this->render();

        if ($output_type == 'S') {
            $output = $this->output();
            write_file('assets/uploads/' . $name, $output);
            return 'assets/uploads/' . $name;
        }
        $this->stream($name);
        return true;
    }
}
