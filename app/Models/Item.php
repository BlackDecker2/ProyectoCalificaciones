<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model {
    protected $table = 'items';

    public function file() {
        return $this->belongsTo(File::class);
    }
}

