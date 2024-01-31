<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class professionnel extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['name','prenom','date_naiss','prop_recue','prop_acceptee','num_tel','num_cni','password','email'];

    public function Mission()
    {
        return $this->belongsToMany(Mission::class,'mission_particulier_professionel');
    }

    public function Experience()
    {
        return $this->hasMany(Experience::class);
    }

    public function Particulier()
    {
        return $this->belongsToMany(particulier::class,'mission_particulier_professionel');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
