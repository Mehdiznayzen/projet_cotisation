<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Depense extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'montant',
        'date',
        'motif',
        'justificatif',
        'commentaire',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}