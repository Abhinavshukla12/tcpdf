<?php

namespace App\Controllers;

use App\Models\GridModel;
use CodeIgniter\Controller;
use TCPDF;

class GridController extends Controller
{
    public function index()
    {
        $model = new GridModel();
        $data['gridData'] = $model->getData();

        return view('grid_view', $data);
    }

    public function generatePdf()
    {
        $session = session();
        $data = $session->get('printData');

        if (!$data) {
            return $this->response->setJSON(['success' => false, 'message' => 'No data available.']);
        }

        try {
            // Initialize TCPDF
            $pdf = new TCPDF();
            $pdf->AddPage();

            // Set font and write HTML
            $pdf->SetFont('helvetica', '', 12);
            $html = '<h1>Print Data</h1><table border="1" cellpadding="4"><thead><tr><th>ID</th><th>Name</th><th>Value</th></tr></thead><tbody>';

            foreach ($data as $row) {
                $html .= '<tr><td>' . $row['id'] . '</td><td>' . $row['name'] . '</td><td>' . $row['value'] . '</td></tr>';
            }

            $html .= '</tbody></table>';
            $pdf->writeHTML($html);

            // Generate PDF file
            $fileName = 'grid_data_' . time() . '.pdf';
            $filePath = WRITEPATH . 'uploads/' . $fileName;
            $pdf->Output($filePath, 'F');

            // Provide the download link
            $downloadLink = base_url('uploads/' . $fileName);

            return $this->response->setJSON(['success' => true, 'link' => $downloadLink]);
        } catch (\Exception $e) {
            return $this->response->setJSON(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
