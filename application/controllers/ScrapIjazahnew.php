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
            'upload'
        ]);
    }
/*
|--------------------------------------------------------------------------
| Index
|--------------------------------------------------------------------------
*/
public function index()
{
    $data['title'] =
        'Scrap e-Ijazah';

    $this->load->view(
        'public/scrapijazah/index',
        $data
    );
}
/*
|--------------------------------------------------------------------------
| Repair OCR Glyph Arial Round 3DM
|--------------------------------------------------------------------------
*/
private function repair_glyph($text)
{
    $exact = [

        /*
        |--------------------------------------------------------------------------
        | NAMA SISWA
        |--------------------------------------------------------------------------
        */
        'Acq' => 'Aji',
        'Ditio' => 'Dito',
        'Kirnawan' => 'Kurniawan',
        'Aricn' => 'Arifin',
        'RocJ' => 'Rofi',
        'KhadiJ' => 'Khadiq',

        'Oahyu' => 'Wahyu',
        'Oulan' => 'Wulan',
        'Oarih' => 'Warih',

        'Mis3ahuddin' =>
            'Misbahuddin',

        'Pengem3ara' =>
            'Pengembara',

        'Su3khan' =>
            'Subkhan',

        'Saiqul' =>
            'Saiful',

        'Nauqal' =>
            'Naufal',

        'bahyaningsih' =>
            'Wahyaningsih',

        'bitra' =>
            'Citra',

        'RizCi' =>
            'Rizki',

        'balviansah' =>
            'Balviansyah',

        'Fe3riyana' =>
            'Febriyana',

        'A3astiar' =>
            'Abastiar',

        'Pra3owo' =>
            'Prabowo',

        'A3ad' =>
            'Abad',

        'Aagus' =>
            'Bagus',

        'Rocngudin' =>
            'Rofingudin',

        'Uilang' =>
            'Wilang',

        'Noqa' =>
            'Nofa',

        'Aqandi' =>
            'Afandi',

        'Geky' =>
            'Jeky',

        'Syaqarudin' =>
            'Syafarudin',

        /*
        |--------------------------------------------------------------------------
        | JURUSAN
        |--------------------------------------------------------------------------
        */
        'ftomotiq' =>
            'Otomotif',

        'Garingan' =>
            'Jaringan',

        /*
        |--------------------------------------------------------------------------
        | UMUM
        |--------------------------------------------------------------------------
        */
        'bah3a' =>
            'bahwa',

        'Sis3a' =>
            'Siswa',

        'Pur3orejo' =>
            'Purworejo',

        'Z3ahir' =>
            'Zwahir',
    ];

    return str_ireplace(
        array_keys($exact),
        array_values($exact),
        $text
    );
}
/*
|--------------------------------------------------------------------------
| Normalize Nomor Ijazah
|--------------------------------------------------------------------------
*/
private function normalize_ijazah_number($no)
{
    $map = [

        'W' => '0',
        'O' => '0',

        'I' => '1',
        'L' => '1',

        'S' => '5',
        'B' => '8',
        'G' => '6',
        'Z' => '2'
    ];

    return strtr(
        strtoupper(
            trim($no)
        ),
        $map
    );
}
/*
|--------------------------------------------------------------------------
| Process PDF
|--------------------------------------------------------------------------
*/
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
        102400;

    $config['encrypt_name'] =
        TRUE;

    $this->upload
        ->initialize($config);

    /*
    |--------------------------------------------------------------------------
    | Upload gagal
    |--------------------------------------------------------------------------
    */
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

    $upload =
        $this->upload
            ->data();

    $filepath =
        $upload['full_path'];

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
            $pdf
                ->getText();

        /*
        |--------------------------------------------------------------------------
        | OCR Repair
        |--------------------------------------------------------------------------
        */
        $text =
            $this
                ->repair_glyph(
                    $text
                );

        /*
        |--------------------------------------------------------------------------
        | Normalize nomor ijazah
        |--------------------------------------------------------------------------
        */
        $text =
            preg_replace_callback(
                '/No\.\s*Ijazah:\s*([A-Z0-9]+)/i',
                function ($match) {

                    return
                        'No. Ijazah: ' .
                        $this
                            ->normalize_ijazah_number(
                                $match[1]
                            );
                },
                $text
            );

        /*
        |--------------------------------------------------------------------------
        | Rapikan spacing
        |--------------------------------------------------------------------------
        */
        $text =
            preg_replace(
                '/\s+/',
                ' ',
                $text
            );

        /*
        |--------------------------------------------------------------------------
        | Siapkan rows
        |--------------------------------------------------------------------------
        */
        $rows = [];
        /*
|--------------------------------------------------------------------------
| REGEX e-Ijazah SMK
|--------------------------------------------------------------------------
*/
$pattern =
    '/No\.\s*Ijazah:\s*(.*?)\s*'
    .'Program\s+Keahlian:\s*(.*?)\s*'
    .'Konsentrasi\s+Keahlian:\s*(.*?)\s*'
    .'Dengan\s+ini\s+menyatakan\s+bahwa:\s*(.*?)\s*'
    .'tempat,\s*tanggal\s+lahir:\s*(.*?),\s*(.*?)\s*'
    .'Nomor\s+Induk\s+Siswa\s+Nasional:\s*(.*?)\s*'
    .'L\s*U\s*L\s*U\s*S.*?'
    .'satuan\s+pendidikan:\s*(.*?)\s*'
    .'Nomor\s+Pokok\s+Sekolah\s+Nasional:\s*(.*?)(?:\s|$)/is';

/*
|--------------------------------------------------------------------------
| Parsing semua ijazah
|--------------------------------------------------------------------------
*/
if (
    preg_match_all(
        $pattern,
        $text,
        $matches,
        PREG_SET_ORDER
    )
) {

    foreach (
        $matches
        as $m
    ) {

        $rows[] = [

            'jenis' =>
                'SMK',

            'no_ijazah' =>
                trim(
                    $m[1]
                ),

            'program_keahlian' =>
                ucwords(
                    trim(
                        $m[2]
                    )
                ),

            'konsentrasi' =>
                ucwords(
                    trim(
                        $m[3]
                    )
                ),

            'nama' =>
                ucwords(
                    trim(
                        $m[4]
                    )
                ),

            'tempat_lahir' =>
                ucwords(
                    trim(
                        $m[5]
                    )
                ),

            'tanggal_lahir' =>
                trim(
                    $m[6]
                ),

            'nisn' =>
                preg_replace(
                    '/[^0-9]/',
                    '',
                    $m[7]
                ),

            'satuan_pendidikan' =>
                strtoupper(
                    trim(
                        $m[8]
                    )
                ),

            'npsn' =>
                preg_replace(
                    '/[^0-9]/',
                    '',
                    $m[9]
                ),
        ];
    }
}
/*
|--------------------------------------------------------------------------
| Data kosong
|--------------------------------------------------------------------------
*/
if (empty($rows)) {

    throw new Exception(
        'Format ijazah tidak dikenali.'
    );
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
$headers = [

    'jenis',
    'no_ijazah',
    'program_keahlian',
    'konsentrasi',
    'nama',
    'tempat_lahir',
    'tanggal_lahir',
    'nisn',
    'satuan_pendidikan',
    'npsn'
];

$col = 'A';

foreach (
    $headers
    as $header
) {

    $sheet
        ->setCellValue(
            $col . '1',
            strtoupper($header)
        );

    $col++;
}

/*
|--------------------------------------------------------------------------
| Isi Data
|--------------------------------------------------------------------------
*/
$rowNum = 2;

foreach (
    $rows
    as $row
) {

    $col = 'A';

    foreach (
        $headers
        as $key
    ) {

        $value =
            isset($row[$key])
            ? $row[$key]
            : '';

        /*
        |--------------------------------------------------------------------------
        | Nomor wajib string
        |--------------------------------------------------------------------------
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
                    $col . $rowNum,
                    (string)$value,
                    DataType::TYPE_STRING
                );

        } else {

            $sheet
                ->setCellValue(
                    $col . $rowNum,
                    $value
                );
        }

        $col++;
    }

    $rowNum++;
}

/*
|--------------------------------------------------------------------------
| Auto Width
|--------------------------------------------------------------------------
*/
foreach (
    range('A', 'J')
    as $columnID
) {

    $sheet
        ->getColumnDimension(
            $columnID
        )
        ->setAutoSize(
            true
        );
}

/*
|--------------------------------------------------------------------------
| Save File
|--------------------------------------------------------------------------
*/
$filename =
    'data_ijazah_' .
    date('Ymd_His') .
    '.xlsx';

$tmpFile =
    sys_get_temp_dir()
    . '/' .
    $filename;

$writer =
    new Xlsx(
        $spreadsheet
    );

$writer->save(
    $tmpFile
);

/*
|--------------------------------------------------------------------------
| Bersihkan Buffer
|--------------------------------------------------------------------------
*/
if (
    ob_get_length()
) {

    ob_end_clean();
}

/*
|--------------------------------------------------------------------------
| Download Excel
|--------------------------------------------------------------------------
*/
header(
    'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
);

header(
    'Content-Disposition: attachment; filename="' .
    $filename .
    '"'
);

header(
    'Cache-Control: max-age=0'
);

header(
    'Content-Length: ' .
    filesize(
        $tmpFile
    )
);

readfile(
    $tmpFile
);

/*
|--------------------------------------------------------------------------
| Cleanup
|--------------------------------------------------------------------------
*/
@unlink(
    $filepath
);

@unlink(
    $tmpFile
);

exit;

} catch (
    Exception $e
) {

    @unlink(
        $filepath
    );

    show_error(
        $e->getMessage()
    );
}
}
    }