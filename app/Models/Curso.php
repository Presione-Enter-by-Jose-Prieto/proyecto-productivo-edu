<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Curso extends Model
{
    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'imagenes_adicionales',
        'categoria',
        'nivel',
        'duracion_horas',
        'fecha_inicio',
        'fecha_fin',
        'cupo_maximo',
        'estado',
        'objetivos',
        'requisitos',
        'user_id',
        'aprobado',
        'telefono_contacto',
        'lugar'
    ];

    protected $casts = [
        'fecha_inicio' => 'date:Y-m-d',
        'fecha_fin' => 'date:Y-m-d',
        'objetivos' => 'array',
        'requisitos' => 'array',
        'duracion_horas' => 'integer',
        'cupo_maximo' => 'integer',
        'aprobado' => 'boolean',
    ];
    
    protected $appends = ['imagen_url', 'nivel_formateado', 'categoria_formateada'];
    
    /**
     * Los atributos que deberían ser mutados a fechas.
     *
     * @var array
     */
    protected $dates = [
        'fecha_inicio',
        'fecha_fin',
        'created_at',
        'updated_at'
    ];

    /**
     * Relación con el usuario (docente) que creó el curso.
     */
    public function docente(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Obtener la URL de la imagen del curso.
     * 
     * @return string|null URL de la imagen o null si no hay imagen
     */
    public function getImagenUrlAttribute(): ?string
    {
        if (empty($this->imagen)) {
            return null;
        }
        
        return Storage::exists('public/' . $this->imagen) 
            ? asset('storage/' . $this->imagen)
            : null;
    }
    
    /**
     * Obtener el nivel del curso formateado.
     */
    public function getNivelFormateadoAttribute(): string
    {
        return ucfirst($this->nivel);
    }
    
    /**
     * Obtener la categoría del curso formateada.
     */
    public function getCategoriaFormateadaAttribute(): string
    {
        $categorias = [
            'deportivo' => 'Deportivo',
            'disciplinario' => 'Disciplinario',
            'pedagogico' => 'Pedagógico',
            'idiomas' => 'Idiomas',
            'otro' => 'Otro'
        ];
        
        return $categorias[$this->categoria] ?? 'Sin categoría';
    }

    /**
     * Verificar si el curso está publicado.
     */
    public function estaPublicado(): bool
    {
        return $this->estado === 'publicado';
    }
    
    /**
     * Verificar si el curso está aprobado.
     */
    public function estaAprobado(): bool
    {
        return (bool) $this->aprobado;
    }

    /**
     * Verificar si el curso está lleno.
     */
    public function estaLleno(): bool
    {
        return $this->estudiantes()->count() >= $this->cupo_maximo;
    }
    
    /**
     * Obtener la duración formateada del curso.
     */
    public function getDuracionFormateadaAttribute(): string
    {
        return $this->duracion_horas . ' horas';
    }
    
    /**
     * Obtener el rango de fechas formateado.
     */
    public function getRangoFechasAttribute(): string
    {
        return $this->fecha_inicio->format('d/m/Y') . ' - ' . $this->fecha_fin->format('d/m/Y');
    }
    
    /**
     * Obtener la cantidad de estudiantes inscritos.
     */
    public function getInscritosCountAttribute(): int
    {
        return $this->estudiantes()->count();
    }
    
    /**
     * Obtener el porcentaje de ocupación del curso.
     */
    public function getPorcentajeOcupacionAttribute(): int
    {
        if ($this->cupo_maximo === 0) return 0;
        return min(100, (int) round(($this->getInscritosCountAttribute() / $this->cupo_maximo) * 100));
    }
}
