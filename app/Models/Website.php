<?php

namespace App\Models;

use App\Models\FavouriteWeb;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Website extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function favourites()
    {
        return $this->hasMany(FavouriteWeb::class);
    }

    public function isFavourite()
    {
        return $this->favourites()->where('user_id', Auth::id())->exists();
    }

}
