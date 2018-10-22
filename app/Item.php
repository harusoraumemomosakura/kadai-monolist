<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['code', 'name', 'url', 'image_url'];

    public function users()
    {  //Laravel では中間テーブルに対応する存在を Pivot と呼ぶ。withPivot('type') として、 type を考慮する必要があることを伝えています
        return $this->belongsToMany(User::class)->withPivot('type')->withTimestamps();
    }
    
     //Want のみの User 一覧を取得したい場合中身は単に type = 'want' なものを絞り込んでいるだけです。
    public function want_users()
    {
        return $this->users()->where('type', 'want');
    }
    
      //Have のみの User 一覧を取得したい場合中身は単に type = 'have' なものを絞り込んでいるだけです。
    public function have_users()
    {
        return $this->users()->where('type', 'have');
    }
    
}