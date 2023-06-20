<?php

namespace App\Controllers;

use App\Models\ModelKlasemen;

class Klasemen extends BaseController
{
    protected $klasemen;
    public function __construct()
    {
        $this->klasemen = new ModelKlasemen();
    }
    public function index()
    {
        $data = array(
            'head' => 'Halaman Utama',
            'title' => 'Data Klasemen',
            'tampil' => $this->klasemen->tampil_data()
        );
        return view('v_klasemen', $data);
    }

    public function formtambahbanyak()
    {
        if ($this->request->isAJAX()) {
            $msg = [
                'data' => view('klasemen/formtambahbanyak')
            ];
        }
        echo json_encode($msg);
    }

    public function simpandatabanyak()
    {
        if ($this->request->isAJAX()) {
            $klub1 = $this->request->getVar('tim1');
            $klub2 = $this->request->getVar('tim2');
            $skor1 = $this->request->getVar('skor1');
            $skor2 = $this->request->getPost('skor2');

            $jmldata = count($klub1);
            $db =  \Config\Database::connect();
            for ($i = 0; $i < $jmldata; $i++) {
                if ($skor1[$i] > $skor2[$i]) {
                    $menang[$i] = 1;
                    $seri[$i] = 0;
                    $kalah[$i] = 0;
                    $pointim1[$i] = 3;
                    $pointim2[$i] = 0;
                } elseif ($skor1[$i] == $skor2[$i]) {
                    $menang[$i] = 0;
                    $seri[$i] = 1;
                    $kalah[$i] = 0;
                    $pointim1[$i] = 1;
                    $pointim2[$i] = 1;
                } elseif ($skor1[$i] < $skor2[$i]) {
                    $menang[$i] = 0;
                    $seri[$i] = 0;
                    $kalah[$i] = 1;
                    $pointim1[$i] = 0;
                    $pointim2[$i] = 3;
                }
                $main[$i] = 1;

                // Retrieve current values from the database
                $currentData1 = $db->table('klasemen')->where('nama', $klub1[$i])->get()->getRow();
                $currentData2 = $db->table('klasemen')->where('nama', $klub2[$i])->get()->getRow();

                // Calculate the new values by adding the current values with the new data
                $data1 = array(
                    'main' => $currentData1->main + $main[$i],
                    'menang' => $currentData1->menang + $menang[$i],
                    'seri' => $currentData1->seri + $seri[$i],
                    'kalah' => $currentData1->kalah + $kalah[$i],
                    'gm' => $currentData1->gm + $skor1[$i],
                    'gk' => $currentData1->gk + $skor2[$i],
                    'point' => $currentData1->point + $pointim1[$i]
                );

                $data2 = array(
                    'main' => $currentData2->main + $main[$i],
                    'menang' => $currentData2->menang + $kalah[$i],
                    'seri' => $currentData2->seri + $seri[$i],
                    'kalah' => $currentData2->kalah + $menang[$i],
                    'gm' => $currentData2->gm + $skor2[$i],
                    'gk' => $currentData2->gk + $skor1[$i],
                    'point' => $currentData2->point + $pointim2[$i]
                );
                $this->klasemen->inserttim([
                    'skor_klub1' => $skor1[$i],
                    'skor_klub2' => $skor2[$i],
                    'pertandingan' => $klub1[$i] . " vs " . $klub2[$i]
                ]);
                $db->table('klasemen')->where('nama', $klub1[$i])->update($data1);
                $db->table('klasemen')->where('nama', $klub2[$i])->update($data2);
            }
        }

        $msg = [
            'sukses' => 'data berhasil disimpan'
        ];
        echo json_encode($msg);
    }
    public function tambahtim()
    {
        $validation = \Config\Services::validation();
        $valid = $this->validate([
            'tim' => [
                'label' => 'Nama Tim',
                'rules' => 'is_unique[klasemen.nama]',
                'errors' => [
                    'is_unique' => '{field} Sudah Ada'
                ]
            ]
        ]);

        if (!$valid) {
            $sessErorr = ['err_nama' => $validation->getError('tim')];
            session()->setFlashdata($sessErorr);
            return redirect()->to(base_url('klasemen'));
        } else {
            $data = array(
                'nama' => $this->request->getPost('tim'),
                'kota' => $this->request->getPost('kota'),
                'main' => 0,
                'menang' => 0,
                'seri' => 0,
                'kalah' => 0,
                'gm' => 0,
                'gk' => 0,
                'point' => 0,
            );
            $this->klasemen->inserttim($data);
            return redirect()->to(base_url('klasemen'));
        }
    }

    public function simpandata()
    {
        $klub1 = $this->request->getPost('tim1');
        $klub2 = $this->request->getPost('tim2');
        $data = array(
            'pertandingan' => $this->request->getPost('tim1') . " vs " . $this->request->getPost('tim2'),
            'skor_klub1' => $this->request->getPost('skor1'),
            'skor_klub2' => $this->request->getPost('skor2')
        );

        $skor1 = $this->request->getPost('skor1');
        $skor2 = $this->request->getPost('skor2');
        if ($skor1 > $skor2) {
            $menang = +1;
            $seri = +0;
            $kalah = +0;
            $pointim1 = +3;
            $pointim2 = +0;
        } elseif ($skor1 = $skor2) {
            $menang = +0;
            $seri = +1;
            $kalah = +0;
            $pointim1 = +1;
            $pointim2 = +1;
        } elseif ($skor1 < $skor2) {
            $menang = +0;
            $seri = +1;
            $kalah = +0;
            $pointim1 = +0;
            $pointim2 = +3;
        }

        $data1 = array(
            'main' => +1,
            'menang' => $menang,
            'seri' => $seri,
            'kalah' => $kalah,
            'gm' => +$skor1,
            'gk' => +$skor2,
            'point' => $pointim1
        );

        $data2 = array(
            'main' => +1,
            'menang' => $kalah,
            'seri' => $seri,
            'kalah' => $menang,
            'gm' => +$skor2,
            'gk' => +$skor1,
            'point' => $pointim2
        );
        $this->klasemen->tambah($data) && $this->klasemen->edit_tim1($data1, $klub1) && $this->klasemen->edit_tim2($data2, $klub2);
        return redirect()->to(base_url('klasemen'));
    }
}
