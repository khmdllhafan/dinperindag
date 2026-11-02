<?php

namespace App\Controllers\admin;

use CodeIgniter\Controller;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ApiController extends Controller
{
    public function getChartData()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('perjalanan_dinas');

        $tahun = date('Y');

        $query = $builder->select("MONTH(tanggal) AS bulan, COUNT(*) AS jumlah")
            ->where("YEAR(tanggal)", $tahun)
            ->groupBy("MONTH(tanggal)")
            ->orderBy("MONTH(tanggal)", "ASC")
            ->get();

        $result = $query->getResultArray();

        $data = array_fill(0, 12, 0);

        foreach ($result as $row) {
            $data[$row['bulan'] - 1] = (int) $row['jumlah'];
        }

        return $this->response->setJSON($data);
    }

    public function getDinluBidang()
    {
        $db = \Config\Database::connect();
        $query = $db->query("
            SELECT b.bidang, COUNT(DISTINCT p.id_perdin) AS jumlah_perdin
            FROM pivot p
            JOIN pegawai pg ON p.id_pegawai = pg.id_pegawai
            JOIN bidang b ON pg.bidang = b.bidang
            GROUP BY b.bidang
            ORDER BY jumlah_perdin DESC;
        ");
        $data = $query->getResultArray();
        return $this->response->setJSON($data);
    }

    public function getDinluPegawai()
    {
        $db = \Config\Database::connect();
        $query = $db->query("
            SELECT pg.nama, COUNT(DISTINCT p.id_perdin) AS jumlah_perdin
            FROM pivot p
            JOIN pegawai pg ON p.id_pegawai = pg.id_pegawai
            GROUP BY pg.nama
            ORDER BY jumlah_perdin DESC;
        ");
        $data = $query->getResultArray();
        return $this->response->setJSON($data);
    }

    public function getBidangList()
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT bidang FROM bidang");
        $data = $query->getResultArray();
        return $this->response->setJSON($data);
    }

    public function getPegawaiPNS()
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT nip, nama, jabatan, bidang FROM pegawai WHERE status = 'PNS'");
        $data = $query->getResultArray();
        return $this->response->setJSON($data);
    }

    public function getPegawaiNonPNS()
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT nama, jabatan, bidang FROM pegawai WHERE status = 'NON-PNS'");
        $data = $query->getResultArray();
        return $this->response->setJSON($data);
    }

    public function getDinasLuarData()
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT nama, kegiatan, tujuan, no_sp, tanggal, tanggal_pulang, pembuat FROM perjalanan_dinas");
        $data = $query->getResultArray();
        return $this->response->setJSON($data);
    }

    public function exportLaporanBulanan()
    {
        $bulan = $this->request->getGet('bulan') ?? date('m');
        $tahun = $this->request->getGet('tahun') ?? date('Y');

        $db = \Config\Database::connect();

        $query = $db->query("
            SELECT 
                pj.nama AS nama_pegawai,
                pj.kegiatan,
                pj.tujuan,
                pj.no_sp,
                pj.tanggal,
                pj.tanggal_pulang,
                pj.pembuat
            FROM 
                perjalanan_dinas pj
            WHERE 
                MONTH(pj.tanggal) = ?
                AND YEAR(pj.tanggal) = ?
        ", [$bulan, $tahun]);

        $data = $query->getResultArray();

        if (empty($data)) {
            return $this->response->setJSON(['error' => 'Data tidak ditemukan untuk bulan dan tahun ini.']);
        }

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header
        $headers = ['Nama Pegawai', 'Kegiatan', 'Tujuan', 'No. SP', 'Tanggal', 'Tanggal Pulang', 'Pembuat'];
        $colIndex = 'A';
        foreach ($headers as $header) {
            $sheet->setCellValue($colIndex . '1', $header);
            $colIndex++;
        }
        $sheet->getStyle('A1:G1')->getFont()->setBold(true);
        $sheet->getStyle('A1:G1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A1:G1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle('A1:G1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FFCCCCCC');
        $sheet->getStyle('A1:G1')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN)->getColor()->setARGB('FF000000');

        // Data
        $row = 2;
        foreach ($data as $d) {
            $sheet->setCellValue('A' . $row, $d['nama_pegawai']);
            $sheet->setCellValue('B' . $row, $d['kegiatan']);
            $sheet->setCellValue('C' . $row, $d['tujuan']);
            $sheet->setCellValue('D' . $row, $d['no_sp']);
            $sheet->setCellValue('E' . $row, $d['tanggal']);
            $sheet->setCellValue('F' . $row, $d['tanggal_pulang']);
            $sheet->setCellValue('G' . $row, $d['pembuat']);
            $row++;
        }

        // Border style
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_LEFT,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ];

        $lastRow = $row - 1;
        $sheet->getStyle("A2:G$lastRow")->applyFromArray($styleArray);

        // Auto column width
        foreach (range('A', 'G') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Download
        $fileName = "Laporan_Dinas_{$bulan}_{$tahun}.xlsx";
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        header('Cache-Control: max-age=0');

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
}
