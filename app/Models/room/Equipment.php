<?php

namespace App\Models\room;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'equipment_name',
        'image',
        'description',
        'price',
        'number',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'equipments';
}
