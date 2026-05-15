<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Smalot\PdfParser\Parser;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\DataType;

class ScrapIjazah extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->helper([
    'url',
    'file',
    'download'
]);

        $this->load->library([
            'upload',
            'pagination'
        ]);

        $this->load->model(
            'ScrapIjazah_model'
        );

        $this->load->model(
            'ScrapIjazahLog_model'
        );
    }


    /*
|--------------------------------------------------------------------------
| Smart OCR Repair
|--------------------------------------------------------------------------
*/
private function smart_repair($text, $type = 'name')
{
    $text = trim($text);

    if (empty($text)) {
        return $text;
    }

    /*
    |--------------------------------------------------------------------------
    | Pola error Arial Round 3DM
    |--------------------------------------------------------------------------
    */
    $variants = [];

    $variants[] = $text;

    $rules = [

    // fi jadi c
    'cq' => 'fif',
    'cf' => 'fif',
    'c'  => 'fi',

    // q jadi f
    'q'  => 'f',

    // wa jadi oa
    'oa' => 'wa',
    'o'  => 'w',

    // j jadi g
    'g'  => 'j',

    // b jadi 3
    '3'  => 'b',

    // fing
    'cng' => 'fing',

    // ifin
    'icn' => 'ifin',
];

    foreach ($rules as $bad => $good) {

        $variants[] =
            str_ireplace(
                $bad,
                $good,
                $text
            );
    }

    /*
    |--------------------------------------------------------------------------
    | Dictionary
    |--------------------------------------------------------------------------
    */
    $dictionary = [];

    if ($type === 'jurusan') {

        $dictionary = [

            'Teknik Otomotif',
            'Teknik Kendaraan Ringan',
            'Teknik Komputer dan Jaringan',
            'Teknik Sepeda Motor',
            'Desain Komunikasi Visual',
            'Multimedia',
            'Rekayasa Perangkat Lunak',
            'Teknik Elektronika',
        ];

    } else {

        $path =
            APPPATH .
            'dictionaries/nama.txt';

        if (file_exists($path)) {

            $dictionary =
                file(
                    $path,
                    FILE_IGNORE_NEW_LINES
                    | FILE_SKIP_EMPTY_LINES
                );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Cari yang paling mirip
    |--------------------------------------------------------------------------
    */
    $bestText = $text;
    $bestScore = 999;

    foreach ($variants as $variant) {

        foreach ($dictionary as $dict) {

            $distance =
                levenshtein(
                    strtolower($variant),
                    strtolower($dict)
                );

            if (
                $distance
                < $bestScore
            ) {

                $bestScore =
                    $distance;

                $bestText =
                    $dict;
            }
        }
    }

    /*
    |--------------------------------------------------------------------------
    | threshold aman
    |--------------------------------------------------------------------------
    */
    if ($bestScore <= 3) {

        return $bestText;
    }

    return $text;
}

private function repair_arial_round($text)
{
    $text = trim($text);

    /*
    |--------------------------------------------------------------------------
    | Fix Awal Nama
    |--------------------------------------------------------------------------
    */

    // Geky -> Jeky
    // Gefri -> Jefri
    $text = preg_replace(
        '/^Ge/i',
        'Je',
        $text
    );

    /*
    |--------------------------------------------------------------------------
    | Fix OCR Arial Round 3DM
    |--------------------------------------------------------------------------
    */

    $replacements = [

        /*
        |--------------------------------------------------------------------------
        | fi ligature rusak
        |--------------------------------------------------------------------------
        */

        // Alcto -> Alfito
        'cto' => 'fito',

        // Rocj -> Rofiq
        'ocj' => 'ofiq',

        // Aricn -> Arifin
        'icn' => 'ifin',

        // Acq -> Afif
        'cq' => 'fif',

        // Acf -> Afif
        'cf' => 'fif',

        // cng -> fing
        'cng' => 'fing',

        // cn -> fin
        'cn' => 'fin',

        /*
        |--------------------------------------------------------------------------
        | q sering harusnya f
        |--------------------------------------------------------------------------
        */

        // Noqa -> Nofa
        'oqa' => 'ofa',

        // Aqandi -> Afandi
        'aqa' => 'afa',

        // Nauqal -> Naufal
        'qal' => 'fal',

        /*
        |--------------------------------------------------------------------------
        | wa jadi oa
        |--------------------------------------------------------------------------
        */

        // Oulan -> Wulan
        'Oa' => 'Wa',
        'iq' => 'if',

        /*
        |--------------------------------------------------------------------------
        | angka jadi huruf
        |--------------------------------------------------------------------------
        */

        // Su3khan -> Subkhan
        '3' => 'b',
    ];

    $text = str_ireplace(
        array_keys($replacements),
        array_values($replacements),
        $text
    );

    return trim($text);
}
    /*
|--------------------------------------------------------------------------
| Clean Number
|--------------------------------------------------------------------------
*/
private function clean_number($text)
{
    $map = [

        'W' => '3',
        'w' => '3',

        'O' => '0',
        'o' => '0',

        'I' => '1',
        'l' => '1',

        'S' => '5',
        'B' => '8',
        'G' => '6',
        'Z' => '2'
    ];

    $text = strtr(
        trim($text),
        $map
    );

    return preg_replace(
        '/[^0-9]/',
        '',
        $text
    );
}

/*
|--------------------------------------------------------------------------
| Clean Text
|--------------------------------------------------------------------------
*/
private function clean_text($text)
{
    $text = trim($text);

    $text = preg_replace(
        '/\s+/',
        ' ',
        $text
    );

    return $text;
}

/*
|--------------------------------------------------------------------------
| Clean Name
|--------------------------------------------------------------------------
*/
private function clean_name($text)
{
    $text = trim($text);

    /*
    |--------------------------------------------------------------------------
    | Rapikan Spasi
    |--------------------------------------------------------------------------
    */
    $text = preg_replace(
        '/\s+/',
        ' ',
        $text
    );

    /*
    |--------------------------------------------------------------------------
    | OCR Repair Umum
    |--------------------------------------------------------------------------
    */

    $replacements = [

        /*
        |--------------------------------------------------------------------------
        | Awal huruf
        |--------------------------------------------------------------------------
        */

        // Geky -> Jeky
        '/^G([eE])/' => 'J$1',

        // Oulan -> Wulan
        '/^O([a-z])/i' => 'W$1',

        /*
        |--------------------------------------------------------------------------
        | fi sering jadi c / cq / cj
        |--------------------------------------------------------------------------
        */

        // Acq -> Afif
        '/cq$/i' => 'fif',

        // Acf -> Afif
        '/cf$/i' => 'fif',

        // Rocj -> Rofiq
        '/ocj/i' => 'ofiq',

        // Aricn -> Arifin
        '/icn/i' => 'ifin',

        // cng -> fing
        '/cng/i' => 'fing',

        /*
        |--------------------------------------------------------------------------
        | q sering harusnya f
        |--------------------------------------------------------------------------
        */

        // Nauqal -> Naufal
        '/qal$/i' => 'fal',

        // Aqandi -> Afandi
        '/^Aq/' => 'Af',

        /*
        |--------------------------------------------------------------------------
        | angka jadi huruf
        |--------------------------------------------------------------------------
        */

        // Su3khan -> Subkhan
        '/3/' => 'b',

        /*
        |--------------------------------------------------------------------------
        | j kebaca q
        |--------------------------------------------------------------------------
        */

        // Khadij -> Khadiq
        '/dij$/i' => 'diq',

        /*
        |--------------------------------------------------------------------------
        | wa jadi oa
        |--------------------------------------------------------------------------
        */

        '/^Oa/i' => 'Wa',

        /*
        |--------------------------------------------------------------------------
        | uswatun
        |--------------------------------------------------------------------------
        */

        '/^Bwatun/i' => 'Uswatun',
    ];

    foreach ($replacements as $pattern => $replacement) {

        $text = preg_replace(
            $pattern,
            $replacement,
            $text
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Dictionary Repair
    |--------------------------------------------------------------------------
    */
    $text = $this->smart_repair(
        $text,
        'name'
    );

    /*
    |--------------------------------------------------------------------------
    | Final Rapih
    |--------------------------------------------------------------------------
    */
    return ucwords(
        strtolower(
            trim($text)
        )
    );
}

/*
|--------------------------------------------------------------------------
| Clean School
|--------------------------------------------------------------------------
*/
private function clean_school($text)
{
    return trim($text);
}
private function normalize_text($text)
{
    $replace = [

        // angka kebaca huruf
        '3' => 'b',

        // huruf aneh umum Arial Round
        'q' => 'f',
        'Q' => 'F',

        'Ci' => 'ci',
        'Fe3' => 'Feb',

        // typo OCR umum
        'ft' => 'ot',
        'Ft' => 'Ot',

        'garingan' => 'jaringan',
        'ftomotif' => 'otomotif',
        'otomotiq' => 'otomotif',
        'komunikasi VisuaI' => 'Komunikasi Visual',

        // nama
        'Su3khan' => 'Subkhan',
        'balviansah' => 'Calviansah'
    ];

    $text = strtr(
        trim($text),
        $replace
    );

    $text = preg_replace(
        '/\s+/',
        ' ',
        $text
    );
    /*
|--------------------------------------------------------------------------
| Jurusan OCR Repair
|--------------------------------------------------------------------------
*/

// Garingan -> Jaringan
$text = preg_replace(
    '/\bGaringan\b/ui',
    'Jaringan',
    $text
);

// umum:
// kalau diawali G lalu "ari"
// besar kemungkinan harusnya Jari
$text = preg_replace(
    '/\bGari/ui',
    'Jari',
    $text
);

    return trim($text);
}

    public function index()
    {
        $limit = 10;

        $page = $this->input->get('page');

        if (!$page || $page < 1) {
            $page = 1;
        }

        $offset =
            ($page - 1) * $limit;

        $total =
            $this->ScrapIjazah_model
                ->count_schools();

        $data['schools'] =
            $this->ScrapIjazah_model
                ->get_schools(
                    $limit,
                    $offset
                );

        /*
        |--------------------------------------------------------------------------
        | Pagination
        |--------------------------------------------------------------------------
        */
        $config['base_url'] =
            site_url(
                'scrap-ijazah'
            );

        $config['total_rows'] =
            $total;

        $config['per_page'] =
            $limit;

        $config['page_query_string'] =
            TRUE;

        $config[
            'query_string_segment'
        ] = 'page';

        $config['full_tag_open'] =
            '<div class="pagination-wrap mt-4">';

        $config['full_tag_close'] =
            '</div>';

        $config['num_tag_open'] =
            '<a>';

        $config['num_tag_close'] =
            '</a>';

        $config['cur_tag_open'] =
            '<span class="active">';

        $config['cur_tag_close'] =
            '</span>';

        $config['prev_link'] =
            '&laquo;';

        $config['next_link'] =
            '&raquo;';

        $this->pagination
            ->initialize($config);

        $data['pagination'] =
            $this->pagination
                ->create_links();

        $data['start_no'] =
            $offset + 1;

        $data['title'] =
            'Scrap e-Ijazah';

        $this->load->view(
            'public/scrapijazah/index',
            $data
        );
    }


    public function process()
{
    /*
    |--------------------------------------------------------------------------
    | Upload Config
    |--------------------------------------------------------------------------
    */
    $config['upload_path'] =
        sys_get_temp_dir();

    $config['allowed_types'] =
        'pdf';

    $config['max_size'] =
        100240;

    $config['encrypt_name'] =
        TRUE;

    $this->upload
        ->initialize($config);

    if (
        !$this->upload
            ->do_upload(
                'pdf_file'
            )
    ) {

        $this->session
            ->set_flashdata(
                'error',
                strip_tags(
                    $this->upload
                        ->display_errors()
                )
            );

        redirect(
            'scrap-ijazah'
        );
    }

    $u =
        $this->upload
            ->data();

    $filepath =
        $u['full_path'];

    try {

        /*
        |--------------------------------------------------------------------------
        | Parse PDF
        |--------------------------------------------------------------------------
        */
        $parser =
            new Parser();

        $pdf =
            $parser
                ->parseFile(
                    $filepath
                );

        $text =
            $pdf->getText();


        /*
        |--------------------------------------------------------------------------
        | Normalize PDF Text
        | untuk PDF e-Ijazah baru
        |--------------------------------------------------------------------------
        */
        $text =
            preg_replace(
                '/\s+/',
                ' ',
                $text
            );

        $text =
            str_replace(
                [
                    'No Ijazah',
                    'No Ijaza',
                    'No.Ijazah'
                ],
                'No. Ijazah',
                $text
            );

        $text =
            str_replace(
                [
                    'Program Keahlian',
                    'ProgramKeahlian'
                ],
                'Program Keahlian',
                $text
            );

        $text =
            str_replace(
                [
                    'Konsentrasi Keahlian',
                    'KonsentrasiKeahlian'
                ],
                'Konsentrasi Keahlian',
                $text
            );


        /*
|--------------------------------------------------------------------------
| REGEX SMK
|--------------------------------------------------------------------------
*/
$pattern_smk =
'/No\.?\s*Ijazah\s*:?\s*([0-9A-Za-z]+).*?'
.'Program Keahlian\s*:?\s*(.*?)\s*'
.'Konsentrasi Keahlian\s*:?\s*(.*?)\s*'
.'Dengan ini menyatakan bahwa\s*:?\s*(.*?)\s*'
.'tempat,\s*tanggal lahir\s*:?\s*(.*?),\s*(.*?)\s*'
.'Nomor Induk Siswa Nasional\s*:?\s*([0-9A-Za-z]+).*?'
.'satuan pendidikan\s*:?\s*(.*?)\s*'
.'Nomor Pokok Sekolah Nasional\s*:?\s*([0-9A-Za-z]+)/is';


/*
|--------------------------------------------------------------------------
| REGEX NON SMK
|--------------------------------------------------------------------------
*/
$pattern_non_smk =
'/No\.?\s*Ijazah\s*:?\s*([0-9A-Za-z]+).*?'
.'menyatakan bahwa\s*:?\s*(.*?)\s*'
.'tempat,\s*tanggal lahir\s*:?\s*(.*?),\s*(.*?)\s*'
.'Nomor Induk Siswa Nasional\s*:?\s*([0-9A-Za-z]+).*?'
.'satuan pendidikan\s*:?\s*(.*?)\s*'
.'Nomor Pokok Sekolah Nasional\s*:?\s*([0-9A-Za-z]+)/is';


$rows = [];


/*
|--------------------------------------------------------------------------
| Parsing SMK
|--------------------------------------------------------------------------
*/
if (
    preg_match_all(
        $pattern_smk,
        $text,
        $matches,
        PREG_SET_ORDER
    )
) {

    foreach ($matches as $m) {

        $rows[] = [

            'jenis' => 'SMK',

            'no_ijazah' =>
                $this->clean_number(
                    $m[1]
                ),

            'program_keahlian' =>
    $this->smart_repair(
        $this->repair_arial_round(
            trim($m[2])
        ),
        'jurusan'
    ),

            'konsentrasi' =>
                $this->normalize_text(
                    trim($m[3])
                ),

            'nama' =>
    $this->clean_name(
        $this->repair_arial_round(
            trim($m[4])
        )
    ),

            'tempat_lahir' =>
    $this->normalize_text(
        $this->repair_arial_round(
            trim($m[5])
        )
    ),

            'tanggal_lahir' =>
                trim($m[6]),

            'nisn' =>
                $this->clean_number(
                    $m[7]
                ),

            'satuan_pendidikan' =>
                strtoupper(
                    $this->normalize_text(
                        trim($m[8])
                    )
                ),

            'npsn' =>
                $this->clean_number(
                    $m[9]
                ),
        ];
    }

} elseif (

    preg_match_all(
        $pattern_non_smk,
        $text,
        $matches,
        PREG_SET_ORDER
    )
) {

    /*
    |--------------------------------------------------------------------------
    | Parsing SMA / SMP / Lainnya
    |--------------------------------------------------------------------------
    */
    foreach ($matches as $m) {

        $jenjang = 'UMUM';

        if (
            stripos(
                $text,
                'SEKOLAH MENENGAH ATAS'
            ) !== false
        ) {

            $jenjang = 'SMA';

        } elseif (

            stripos(
                $text,
                'SEKOLAH MENENGAH PERTAMA'
            ) !== false
        ) {

            $jenjang = 'SMP';

        } elseif (

            stripos(
                $text,
                'SEKOLAH DASAR'
            ) !== false
        ) {

            $jenjang = 'SD';
        }

        $rows[] = [

            'jenis' =>
                $jenjang,

            'no_ijazah' =>
                $this->clean_number(
                    $m[1]
                ),

            'program_keahlian' =>
                '',

            'konsentrasi' =>
                '',

            'nama' =>
                $this->clean_name(
                    $m[2]
                ),

            'tempat_lahir' =>
                $this->normalize_text(
                    $m[3]
                ),

            'tanggal_lahir' =>
                trim(
                    $m[4]
                ),

            'nisn' =>
                $this->clean_number(
                    $m[5]
                ),

            'satuan_pendidikan' =>
                strtoupper(
                    $this->normalize_text(
                        $m[6]
                    )
                ),

            'npsn' =>
                $this->clean_number(
                    $m[7]
                ),
        ];
    }
}


/*
|--------------------------------------------------------------------------
| Tidak ada data
|--------------------------------------------------------------------------
*/
if (empty($rows)) {

    throw new Exception(
        'Format PDF tidak dikenali.'
    );
}

        /*
        |--------------------------------------------------------------------------
        | Save School + Logs
        |--------------------------------------------------------------------------
        */
        $jenjang =
            $rows[0]['jenis'];

        $nama_sekolah =
            $rows[0]['satuan_pendidikan'];

        $npsn =
            $rows[0]['npsn'];

        $jumlah_siswa =
            count($rows);

        $cek =
            $this->ScrapIjazah_model
                ->get_school_by_npsn(
                    $npsn
                );

        if ($cek) {

            $this->ScrapIjazah_model
                ->update_school(
                    $npsn,
                    [
                        'jumlah_siswa' =>
                            $jumlah_siswa,
                        'created_at' =>
                            date(
                                'Y-m-d H:i:s'
                            )
                    ]
                );

        } else {

            $this->ScrapIjazah_model
                ->insert_school([
                    'jenjang' =>
                        $jenjang,
                    'nama_sekolah' =>
                        $nama_sekolah,
                    'npsn' =>
                        $npsn,
                    'jumlah_siswa' =>
                        $jumlah_siswa,
                    'created_at' =>
                        date(
                            'Y-m-d H:i:s'
                        )
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Generate Excel
        |--------------------------------------------------------------------------
        */
        $spreadsheet =
            new Spreadsheet();

        $sheet =
            $spreadsheet
                ->getActiveSheet();

        /*
|--------------------------------------------------------------------------
| Header Excel
|--------------------------------------------------------------------------
*/
$headers = array_keys(
    $rows[0]
);

$col = 'A';

foreach ($headers as $header) {

    $sheet->setCellValue(
        $col.'1',
        $header
    );

    $col++;
}

/*
|--------------------------------------------------------------------------
| Write Data
|--------------------------------------------------------------------------
*/
$rowNum = 2;

foreach ($rows as $row) {

    $col = 'A';

    foreach ($row as $key => $value) {

        /*
        nomor wajib string
        */
        if (
            in_array(
                $key,
                [
                    'no_ijazah',
                    'nisn',
                    'npsn'
                ]
            )
        ) {

            $sheet
                ->setCellValueExplicit(
                    $col.$rowNum,
                    (string)$value,
                    DataType::TYPE_STRING
                );

        } else {

            $sheet
                ->setCellValue(
                    $col.$rowNum,
                    $value
                );
        }

        $col++;
    }

    $rowNum++;
}

        $filename =
            'data_ijazah_'
            . date('Ymd_His')
            . '.xlsx';

        $writer =
            new Xlsx(
                $spreadsheet
            );

        $tmpPath =
            sys_get_temp_dir()
            . '/'
            . $filename;

        $writer->save(
            $tmpPath
        );

        $data =
            file_get_contents(
                $tmpPath
            );

        @unlink(
            $filepath
        );

        @unlink(
            $tmpPath
        );

        force_download(
            $filename,
            $data
        );

        exit;

    } catch (
        Exception $e
    ) {

        @unlink(
            $filepath
        );

        $this->session
            ->set_flashdata(
                'error',
                $e->getMessage()
            );

        redirect(
            'scrap-ijazah'
        );
    }
}


    public function download()
{
    $filename =
        $this->session
            ->flashdata(
                'download_file'
            );

    if (!$filename) {

        redirect(
            'scrap-ijazah'
        );
    }

    $path =
        sys_get_temp_dir()
        .
        DIRECTORY_SEPARATOR
        .
        $filename;

    if (!file_exists($path)) {

        redirect(
            'scrap-ijazah'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Clean Buffer
    |--------------------------------------------------------------------------
    */
    if (ob_get_length()) {

        ob_end_clean();
    }

    /*
    |--------------------------------------------------------------------------
    | Download File
    |--------------------------------------------------------------------------
    */
    header(
        'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
    );

    header(
        'Content-Disposition: attachment; filename="'.$filename.'"'
    );

    header(
        'Content-Length: '.filesize($path)
    );

    header(
        'Cache-Control: max-age=0'
    );

    readfile($path);

    @unlink($path);

    /*
    |--------------------------------------------------------------------------
    | Redirect Back
    |--------------------------------------------------------------------------
    */
    echo '
    <script>
        setTimeout(function(){

            window.location.href =
            "'.base_url('scrap-ijazah').'";

        }, 500);
    </script>';

    exit;
}

}