<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    protected $guarded=[];
    public function user(){
        return $this->belongsTo(User::class,'created_by');
    }
    public function getCreatedAtAttribute($val){
        return Carbon::parse($val)->format('j.n.Y, g:i A');
    }
    public function path() : Attribute {
        return Attribute::make(
            get: function ($value) {
                if ($value !== null) {
                    return url($value);
                }
                return null;
            }
        );
    }
    public function getTypeAttribute($val){
        $image_extensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'tif', 'tiff', 'webp', 'svg', 'ico', 'jfif', 'heif', 'bat', 'raw', 'exif', 'eps'];
        $video_extensions = ['mp4', 'mov', 'avi', 'mkv', 'flv', 'wmv', 'webm', 'm4v', '3gp', 'mpg', 'mpeg', 'm2ts', 'ts', 'vob', 'rm', 'rmvb', 'asf', 'divx'];
        $other_file_extensions = ['txt', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'csv', 'zip', 'rar', '7z', 'tar', 'gz', 'bz2', 'xml', 'json', 'html', 'css', 'js', 'sql', 'log', 'md', 'java', 'cpp', 'py', 'php', 'rb', 'c', 'h', 'exe', 'dll', 'msi'];
        if (in_array($val,$image_extensions)){
            return 'image';
        }else if (in_array($val,$video_extensions)){
            return 'video';
        }else if (in_array($val,$other_file_extensions)){
            return 'file';
        }
    }
}
