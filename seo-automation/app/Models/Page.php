<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $guarded = [] ;

    public static function insertInfo($info , $site_id){

        $page_id = self::create([
            'status' => $info['status'] ,
            'title' => $info['title'] ,
            'meta_description' => $info['meta-desc'] ,
            'has_canonical' => $info['canonical'] ,
            'site_id' => $site_id
        ]);


        Image::insert(
            collect($info['images'])
                ->map(fn($src)=>['src'=>$src, 'page_id'=>$page_id->id])
                ->all()
        );

        Video::insert(
            collect($info['videos'])->map(fn($src)=>['src'=>$src, 'page_id'=>$page_id->id])->all()
        );

        Link::insert(
            collect($info['internal-urls'])->map(fn($href)=>['href'=>$href, 'page_id'=>$page_id->id])->all()
        );
    }
}
