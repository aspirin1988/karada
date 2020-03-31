<?php

namespace App;

use App\Http\Controllers\MediaController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class MediaCollection extends Model
{
    protected $guarded = [];

    public function getMedia()
    {
        $medias = MediaCollectionRelation::where('collection_id', $this->id)->orderBy('order_field', 'desc')->get();
        foreach ($medias as $key=>$media){
            $medias[$key]->data = $media->getMedia();
        }
        return $medias;
    }

    public static function getImages($id)
    {
        $medias = MediaCollectionRelation::where('collection_id', $id)->orderBy('order_field', 'desc')->get();
        $result = [];
        foreach ($medias as $key=>$media){
            $result[] = $media->getMedia();
        }
        return $result;
    }

    public function uploadFile($name, $file)
    {
        $file_path = '/images/image/' . date('Y-m-d') . '/';

        if (!file_exists(public_path() . $file_path)) {
            mkdir(public_path() . $file_path, 0777, true);
        }

        $result = Storage::put($file_path . $name, file_get_contents($file->getRealPath()));

        $input =[
            'image'=>$file_path . $name,
        ];

        $media = Media::create($input);

        $input_relation =[
            'collection_id'=>$this->id,
            'media_id'=>$media->id,
        ];

        MediaCollectionRelation::create($input_relation);

        return $result;
    }
}
