<?php

namespace App\Models;

use CodeIgniter\Model;

class GridModel extends Model
{
    protected $table = 'grid_data'; // Your table name
    protected $primaryKey = 'id';

    public function getData()
    {
        return $this->findAll();
    }
}