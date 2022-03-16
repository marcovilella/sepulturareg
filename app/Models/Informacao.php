<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Informacao extends Model
{
    public $timestamps = FALSE;
    
    use HasFactory, Notifiable;

    protected $fillable = [
        'cemiterio',
        'quadra',
        'jazigo',
        'nome_permissionario',
        'permissionario_vivo',
        'manutencao_permissao_jazigo',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
