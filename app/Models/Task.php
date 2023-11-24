<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // protected $guarded = [];
    protected $fillable =['name','source_id','email','code','phone','status'];

    public function getSources()
    {
        return $this->belongsTo(Source::class, 'source_id');
    }
}
