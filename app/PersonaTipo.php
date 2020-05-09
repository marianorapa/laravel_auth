<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property integer $tipo_documento_id
 * @property integer $domicilio_id
 * @property string $nro_documento
 * @property string $telefono
 * @property string $email
 * @property string $observaciones
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property Domicilio $domicilio
 * @property TipoDocumento $tipoDocumento
 * @property Empresa $empresa
 * @property Persona $persona
 */
class PersonaTipo extends Model
{

    use SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'persona_tipo';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['nro_documento', 'telefono', 'email', 'observaciones'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function domicilio()
    {
        return $this->belongsTo('App\Domicilio');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipoDocumento()
    {
        return $this->belongsTo('App\TipoDocumento');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function empresa()
    {
        return $this->hasOne('App\Empresa', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function persona()
    {
        return $this->hasOne('App\Persona', 'id');
    }
}
