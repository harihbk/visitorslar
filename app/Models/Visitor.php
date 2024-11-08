<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    // Specify the table name (in case it's not the plural form of the model name)
    protected $table = 'visitor';

    // Specify the fillable fields (columns that can be mass-assigned)
    protected $fillable = [
        'name', 
        'company', 
        'vehicleno', 
        'refno', 
        'intime', 
        'outtime',
        'file_path'
    ];

    // Disable timestamps if you don't want the 'created_at' and 'updated_at' fields
    // public $timestamps = false; // Uncomment this line if timestamps are not needed

    // Optionally, specify the data types for columns if needed
    protected $casts = [
        'intime' => 'datetime',
        'outtime' => 'datetime',
    ];
}
