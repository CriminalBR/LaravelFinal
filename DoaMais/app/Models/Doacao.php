<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Doacao extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'instituicao_id',
        'descricao_item',
        'quantidade',
        'status',
    ];

    // --- RELACIONAMENTOS ---

    /**
     * Uma Doacao PERTENCE A UM User (o doador).
     */
    public function doador(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Uma Doacao PERTENCE A UMA Instituicao (a recebedora).
     */
    public function instituicao(): BelongsTo
    {
        return $this->belongsTo(Instituicao::class);
    }
}