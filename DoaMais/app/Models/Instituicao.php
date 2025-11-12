<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Instituicao extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'cnpj',
        'telefone',
        'endereco',
    ];

    // --- RELACIONAMENTOS ---

    /**
     * Uma Instituicao PERTENCE A UM User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Uma Instituicao TEM MUITAS Doacoes recebidas.
     */
    public function doacoesRecebidas(): HasMany
    {
        return $this->hasMany(Doacao::class);
    }

    /**
     * Uma Instituicao TEM MUITOS Itens de Estoque.
     */
    public function estoqueItens(): HasMany
    {
        return $this->hasMany(Estoque::class);
    }
}