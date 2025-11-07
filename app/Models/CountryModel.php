<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CountryModel extends Model
{
    protected $table = "table_country_lang";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'alias',
        'name',
        'name_en'
    ];

    
}
