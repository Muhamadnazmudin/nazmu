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
        $config['upload_path']
=
sys_get_temp_dir();

        $config['allowed_types'] =
            'pdf';

        $config['max_size'] =
            10240;

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
            | REGEX LAMA
            | (TIDAK DIUBAH)
            |--------------------------------------------------------------------------
            */
            $pattern_smk = '/No\. Ijazah:\s*([0-9A-Za-z]+).*?'
                .'Program Keahlian:\s*(.*?)\s*'
                .'Konsentrasi Keahlian:\s*(.*?)\s*'
                .'Dengan ini menyatakan bahwa:\s*(.*?)\s*'
                .'tempat, tanggal lahir:\s*(.*?),\s*([0-9A-Za-z ]+)\s*'
                .'Nomor Induk Siswa Nasional:\s*([0-9A-Za-z]+).*?'
                .'satuan pendidikan:\s*(.*?)\s*'
                .'Nomor Pokok Sekolah Nasional:\s*([0-9A-Za-z]+)/is';

            $pattern_non_smk = '/No\. Ijazah:\s*([0-9A-Za-z]+).*?'
                .'menyatakan bahwa:\s*(.*?)\s*'
                .'tempat, tanggal lahir:\s*(.*?),\s*([0-9A-Za-z ]+)\s*'
                .'Nomor Induk Siswa Nasional:\s*([0-9A-Za-z]+).*?'
                .'satuan pendidikan:\s*(.*?)\s*'
                .'Nomor Pokok Sekolah Nasional:\s*([0-9A-Za-z]+)/is';

            $rows = [];

            /*
            |--------------------------------------------------------------------------
            | Parsing Lama
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

                foreach (
                    $matches
                    as $m
                ) {

                    $rows[] = [

                        'jenis' =>
                            'SMK',

                        'no_ijazah' =>
                            trim($m[1]),

                        'program_keahlian' =>
                            trim($m[2]),

                        'konsentrasi' =>
                            trim($m[3]),

                        'nama' =>
                            trim($m[4]),

                        'tempat_lahir' =>
                            trim($m[5]),

                        'tanggal_lahir' =>
                            trim($m[6]),

                        'nisn' =>
                            trim($m[7]),

                        'satuan_pendidikan' =>
                            trim($m[8]),

                        'npsn' =>
                            trim($m[9]),
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

                foreach (
                    $matches
                    as $m
                ) {

                    $jenjang = 'UMUM';

                    if (stripos($text,'SEKOLAH MENENGAH ATAS') !== false) $jenjang='SMA';
                    elseif (stripos($text,'MADRASAH ALIYAH') !== false) $jenjang='MA';
                    elseif (stripos($text,'SEKOLAH MENENGAH PERTAMA') !== false) $jenjang='SMP';
                    elseif (stripos($text,'MADRASAH TSANAWIYAH') !== false) $jenjang='MTs';
                    elseif (stripos($text,'SEKOLAH DASAR') !== false) $jenjang='SD';
                    elseif (stripos($text,'MADRASAH IBTIDAIYAH') !== false) $jenjang='MI';
                    elseif (stripos($text,'SEKOLAH LUAR BIASA') !== false) $jenjang='SLB';
                    elseif (stripos($text,'PAKET A') !== false) $jenjang='Paket A';
                    elseif (stripos($text,'PAKET B') !== false) $jenjang='Paket B';
                    elseif (stripos($text,'PAKET C') !== false) $jenjang='Paket C';

                    $rows[] = [

                        'jenis' =>
                            $jenjang,

                        'no_ijazah' =>
                            trim($m[1]),

                        'program_keahlian' =>
                            '',

                        'konsentrasi' =>
                            '',

                        'nama' =>
                            trim($m[2]),

                        'tempat_lahir' =>
                            trim($m[3]),

                        'tanggal_lahir' =>
                            trim($m[4]),

                        'nisn' =>
                            trim($m[5]),

                        'satuan_pendidikan' =>
                            trim($m[6]),

                        'npsn' =>
                            trim($m[7]),
                    ];
                }
            }

            /*
|--------------------------------------------------------------------------
| Save School
|--------------------------------------------------------------------------
*/
if (!empty($rows)) {

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
    | Save Logs
    |--------------------------------------------------------------------------
    */
    $this->load->library(
        'user_agent'
    );

    $this->db
        ->insert(
            'scrap_ijazah_logs',
            [

                'school_name' =>
                    $nama_sekolah,

                'npsn' =>
                    $npsn,

                'jumlah_siswa' =>
                    $jumlah_siswa,

                'ip_address' =>
                    $this->input
                        ->ip_address(),

                'browser' =>
                    $this->agent
                        ->browser()
                    .
                    ' '
                    .
                    $this->agent
                        ->version(),

                'platform' =>
                    $this->agent
                        ->platform(),

                'created_at' =>
                    date(
                        'Y-m-d H:i:s'
                    )
            ]
        );
}

            /*
|--------------------------------------------------------------------------
| Excel Generation
|--------------------------------------------------------------------------
*/
$is_smk = false;

foreach ($rows as $r) {

    if ($r['jenis'] === 'SMK') {

        $is_smk = true;
        break;
    }
}

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
if ($is_smk) {

    $header = [

        'A1' => 'jenis',
        'B1' => 'no_ijazah',
        'C1' => 'program_keahlian',
        'D1' => 'konsentrasi',
        'E1' => 'nama',
        'F1' => 'tempat_lahir',
        'G1' => 'tanggal_lahir',
        'H1' => 'nisn',
        'I1' => 'satuan_pendidikan',
        'J1' => 'npsn',
    ];

} else {

    $header = [

        'A1' => 'jenis',
        'B1' => 'no_ijazah',
        'C1' => 'nama',
        'D1' => 'tempat_lahir',
        'E1' => 'tanggal_lahir',
        'F1' => 'nisn',
        'G1' => 'satuan_pendidikan',
        'H1' => 'npsn',
    ];
}


/*
|--------------------------------------------------------------------------
| Write Header
|--------------------------------------------------------------------------
*/
foreach ($header as $k => $v) {

    $sheet->setCellValue(
        $k,
        $v
    );
}


/*
|--------------------------------------------------------------------------
| Write Data
|--------------------------------------------------------------------------
*/
$rowNum = 2;

foreach ($rows as $r) {

    if ($is_smk) {

        $sheet->setCellValue(
            'A'.$rowNum,
            $r['jenis']
        );

        $sheet->setCellValueExplicit(
            'B'.$rowNum,
            $r['no_ijazah'],
            DataType::TYPE_STRING
        );

        $sheet->setCellValue(
            'C'.$rowNum,
            $r['program_keahlian']
        );

        $sheet->setCellValue(
            'D'.$rowNum,
            $r['konsentrasi']
        );

        $sheet->setCellValue(
            'E'.$rowNum,
            $r['nama']
        );

        $sheet->setCellValue(
            'F'.$rowNum,
            $r['tempat_lahir']
        );

        $sheet->setCellValue(
            'G'.$rowNum,
            $r['tanggal_lahir']
        );

        $sheet->setCellValueExplicit(
            'H'.$rowNum,
            $r['nisn'],
            DataType::TYPE_STRING
        );

        $sheet->setCellValue(
            'I'.$rowNum,
            $r['satuan_pendidikan']
        );

        $sheet->setCellValue(
            'J'.$rowNum,
            $r['npsn']
        );

    } else {

        $sheet->setCellValue(
            'A'.$rowNum,
            $r['jenis']
        );

        $sheet->setCellValueExplicit(
            'B'.$rowNum,
            $r['no_ijazah'],
            DataType::TYPE_STRING
        );

        $sheet->setCellValue(
            'C'.$rowNum,
            $r['nama']
        );

        $sheet->setCellValue(
            'D'.$rowNum,
            $r['tempat_lahir']
        );

        $sheet->setCellValue(
            'E'.$rowNum,
            $r['tanggal_lahir']
        );

        $sheet->setCellValueExplicit(
            'F'.$rowNum,
            $r['nisn'],
            DataType::TYPE_STRING
        );

        $sheet->setCellValue(
            'G'.$rowNum,
            $r['satuan_pendidikan']
        );

        $sheet->setCellValue(
            'H'.$rowNum,
            $r['npsn']
        );
    }

    $rowNum++;
}


/*
|--------------------------------------------------------------------------
| Save Temporary File
|--------------------------------------------------------------------------
*/
$filename =
    'data_ijazah_' .
    date(
        'Ymd_His'
    ) .
    '.xlsx';

$tmpPath =
    sys_get_temp_dir()
    .
    DIRECTORY_SEPARATOR
    .
    $filename;


$writer =
    new Xlsx(
        $spreadsheet
    );

$writer->save(
    $tmpPath
);


/*
|--------------------------------------------------------------------------
| Cleanup Upload PDF
|--------------------------------------------------------------------------
*/
@unlink($filepath);


/*
|--------------------------------------------------------------------------
| Auto Download
|--------------------------------------------------------------------------
*/
/*
|--------------------------------------------------------------------------
| Force Download
|--------------------------------------------------------------------------
*/
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

            @unlink($filepath);

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