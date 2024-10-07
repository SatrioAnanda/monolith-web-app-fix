<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employees extends Model
{
    use HasFactory;

    protected $table = 'employees';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'fullname',
        'company_id',
        'department',
        'email',
        'phone',
    ];

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Companies::class, "company_id", "company_id");
    }
}
