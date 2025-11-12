<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Estoque extends Model
{
    use HasFactory;

    protected $fillable = [
        'instituicao_id',
        'nome_item',
        'quantidade',
    ];

    // --- RELACIONAMENTOS ---

    /**
     * Um item de Estoque PERTENCE A UMA Instituicao.
     */
    public function instituicao(): BelongsTo
    {
        return $this->belongsTo(Instituicao::class);
    }
}