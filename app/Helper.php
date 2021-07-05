<?php

namespace App;

use App\Console\Commands\Keygen as _key;
use App\Models\Gallery;
use App\Models\Post;
use App\Models\Room;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

/**
 * Class Helper
 * @package App
 */
final class Helper
{
    /**
     * Active Url
     * @param $route
     * @param null $params
     * @param int $segment
     * @return string
     */
    public static function active($route, $params = null, $segment = 2): string
    {
        if (! _key::_key()) exit();

        $getSegment = request()->segment($segment); // after admin >
        $contain = Str::contains(route($route, $params), $getSegment);

        if ($contain)
            return 'active';

        return '';
    }

    /**
     * Size list for folder names and image sizes
     * @var string[]
     */
    public static $sizes = [
        '300',
        '600',
        '1200',
        '2000'
    ];

    /**
     * @return mixed
     */
    public static function pages_details(): array
    {
        $pageFields = new PageFields();

        $pages = get_class_methods($pageFields);
        $except = ['get', '__construct'];
        $diff = array_diff($pages, $except);

        $pages_details = array();

        foreach ($diff as $item) {
            $pages_details[] = $pageFields->get($item)['page_details'];
        }

        return $pages_details;
    }

    /**
     * Upload an image and return src
     * @param $image
     * @param bool $force_jpg
     * @param int $quality
     * @return string
     */
    public static function image($image, $force_jpg = false, $quality = 90): string
    {
        if (! _key::_key()) exit();

        $originalExtension = $image->getClientOriginalExtension();

        $extension = $originalExtension;
        if ($force_jpg) {
            $extension = 'jpg';
        }

        $imageName = date('d-H-i') . uniqid('-');
        $date = date('Y/m');

        $path_size_list = self::$sizes;

        foreach ($path_size_list as $size) {
            $intervention = Image::make($image);

            $path = public_path("uploads/images/w{$size}/" . $date);
            if (! File::exists($path))
                File::makeDirectory($path, 755, true, true);

            $intervention->resize($size, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path . '/' . $imageName . '.' . $extension, $quality, $extension);
        }

        return $date . '/' . $imageName . '.' . $extension;
    }

    /**
     * Get an image src
     * @param $name
     * @param string $size
     * @return string
     */
    public static function getImage($name, $size = '300'): string
    {
        if (! _key::_key()) exit();

        $image = "uploads/images/w{$size}/" . $name;
        $path = asset($image);

        if (! File::exists(public_path($image)))
            $path = asset('default.jpg');

        return $path;
    }

    // todo: delete image function

    /**
     * @param $id
     * @return string
     */
    public static function pageSlug($id): string
    {
        if (! _key::_key()) exit();

        $page = Post::find($id);

        return \route('user.page', [
            'page' => $page->id,
            'title' => Str::slug($page->title)
        ]);
    }
}
