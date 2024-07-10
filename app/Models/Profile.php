<?php

namespace App\Models;

use App\Models\Trait\ImageTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    use ImageTrait;

    public const STATUS_LIST = [
        0 => 'inactif',
        1 => 'actif',
        2 => 'en attente',
    ];

    protected $table = 'profiles';

    protected $fillable = [
        'first_name',
        'last_name',
        'status',
    ];


    /**
     * Allows status property to be saved as an integer
     *
     * @return Attribute
     */
    protected function status(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => self::STATUS_LIST[$value],
            set: fn (string $value) => array_search(strtolower($value), self::STATUS_LIST),
        );
    }
}
