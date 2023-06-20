<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKlasemen extends Model
{
    function tampil_data()
    {
        return $this->db->table('klasemen')->orderBy('point', 'desc')->orderBy('gk', 'asc')->orderBy('gm', 'desc')->get()->getResultArray();
    }
    function tambah($data)
    {
        return $this->db->table('match')->insert($data);
    }
    function inserttim($data)
    {
        return $this->db->table('match')->insert($data);
    }
    function edit_tim1($data1, $klub1)
    {
        return $this->db->table('klasemen')->update($data1, array('nama' => $klub1));
    }
    function edit_tim2($data2, $klub2)
    {
        return $this->db->table('klasemen')->update($data2, array('nama' => $klub2));
    }
}
