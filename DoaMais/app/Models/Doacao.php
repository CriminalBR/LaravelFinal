<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Instituicao; 
use App\Models\User;

class Doacao extends Model
{
    use HasFactory;

    /**
     * Os atributos que podem ser preenchidos em massa.
     */
    protected $fillable = [
        'user_id',
        'instituicao_id',
        'descricao_item',
        'quantidade',
        'status',
    ];

    /**
     * Define o relacionamento: Uma Doação pertence a um User (Doador).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Define o relacionamento: Uma Doação pertence a uma Instituicao.
     */
    public function instituicao(): BelongsTo
    {
        return $this->belongsTo(Instituicao::class);
    }
}