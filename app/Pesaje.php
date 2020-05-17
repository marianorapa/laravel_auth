<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property int $peso
 * @property string $created_at
 * @property string $updated_at
 * @property Ticket[] $tickets
 */
class Pesaje extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pesaje';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['peso', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
//    public function bruto()
//    {
//        return $this->hasOne('App\Ticket', 'bruto');
//    }
//
//    public function tara()
//    {
//        return $this->hasOne('App\Ticket', 'tara');
//    }


    public function ticket()
    {
        return $this->belongsTo('App\Ticket', 'id');
    }

}
