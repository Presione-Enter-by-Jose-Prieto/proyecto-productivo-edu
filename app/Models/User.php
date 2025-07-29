<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    /**
     * Relación muchos a muchos con cursos (cursos en los que está inscrito el usuario)
     */
    public function cursos()
    {
        return $this->belongsToMany(Curso::class, 'curso_usuario')
            ->withPivot('estado', 'fecha_inscripcion')
            ->withTimestamps();
    }

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'avatar',
        'role'
    ];

    protected $attributes = [
        'role' => 'user',
        'avatar' => 'storage/avatars/default-avatar.png'
    ];

    /**
     * Obtener la URL completa del avatar del usuario.
     *
     * @return string
     */
    public function getAvatarUrlAttribute()
    {
        if (str_starts_with($this->avatar, 'http')) {
            return $this->avatar;
        }
        
        return $this->avatar ? asset($this->avatar) : asset('storage/avatars/default-avatar.png');
    }

    /**
     * Obtener los cursos creados por el usuario (docente).
     */
    public function cursosCreados(): HasMany
    {
        return $this->hasMany(Curso::class, 'user_id');
    }

    /**
     * Verificar si el usuario es un docente.
     */
    public function esDocente(): bool
    {
        return $this->role === 'docente';
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
