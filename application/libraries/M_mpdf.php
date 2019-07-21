<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class M_mpdf {
 
    public $mpdf;
 
    public function __construct($param = '"en-GB-x","A4","","",10,10,10,10,6,3')
    {
        $this->defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
        $this->fontDirs = $this->defaultConfig['fontDir'];

        $this->defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
        $this->fontData = $this->defaultFontConfig['fontdata'];
        $this->mpdf = new \Mpdf\Mpdf([
            'fontDir' => array_merge($this->fontDirs, [
                APPPATH . '../font'
            ]),
            'fontdata' => $this->fontData + [
                'cordia' => [
                    'R' => "CordiaNew.ttf",
					'B' => "CordiaNewBold.ttf",
					'I' => "CordiaNewItalic.ttf",
					'BI' => "CordiaNewBoldItalic.ttf",
                ]
            ],
            'default_font_size' => 16,
            'default_font' => 'cordia'
        ]);
    }
}