<?php

namespace Modules\Resource\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Modules\Resource\Repositories\ResourceRepository;
use App\Http\Controllers\Admin\AdminController;
use App;

class GalleryController extends AdminController {

    /**
     * [$resource description]
     * @var \Modules\Resource\Repositories\ResourceRepository
     */
    protected $resource;
    /**
     * @var App\Hocs\Core\Images\ImageFactory
     */
    private $imageUploader;

    /**
     * @var App\Hocs\Core\Uploads\Uploader
     */
    private $uploader;

    /**
     * @var App\Hocs\Core\Uploads\Upload
     */
    private $upload;

    public function __construct(ResourceRepository $resource)
    {
        parent::__construct();
        $this->resource = $resource;
        $this->upload = App::make('Upload');
        $this->uploader = App::make('Uploader');
        $this->imageUploader = App::make('ImageFactory');
    }

    public function getIndex(Request $request)
    {
        $filter = [
            'extensions' => array('jpg', 'jpeg', 'png', 'bmp', 'gif')
        ];

        $images = $this->resource->getResources(20, $filter);

        return view('resource::admin/gallery/index', compact('images'));
    }


    public function getDelete(Request $request)
    {
        $resource = $this->resource->getByName($request->get('image'));
        if($resource) {
            $imageName = $resource->getName();

            if($resource->delete()) {
                // Xóa luôn cả file
                $uploadPath = public_path() . '/'. config('upload.upload_folder') .'/';
                $arrayResizeImage = config('image.array_resize_image');
                $targetFolder = get_image_folder($imageName);
                @unlink($uploadPath . $targetFolder . '/'. $imageName);
                foreach($arrayResizeImage as $key => $value) {
                    @unlink($uploadPath . $targetFolder . '/'. $key . $imageName);
                }
            }
        }
    }


    public function ajaxUploadImage(Request $request)
    {
        $extension = $request->file('file')->getClientOriginalExtension();
        $data = [];
        if(in_array($extension, array('gif', 'png', 'jpg', 'bmp', 'jpeg'))) {
            $resultUpload = $this->imageUploader->upload('file', config('image.array_resize_image'), 'resize');
            if($resultUpload['status'] > 0) {
                $data['name'] = $resultUpload['filename'];
                $data['extension'] = $extension;
                $data['size'] = $resultUpload['size'];
                list($width, $height) = getimagesize($resultUpload['path']);
                $data['width'] = $width;
                $data['height'] = $height;
            }
        } else {
            $resultUpload = $this->uploader->upload('file');
            $data['name'] = $resultUpload;
            $data['extension'] = $extension;
            $data['size'] = filesize($this->uploader->getUploadFolderPathToDay() . '/' . $resultUpload);
        }

        if($data) {
            $this->resource->create($data);
            return response()->json(['code' => 1]);
        }

        return response()->json(['code' => 0]);
    }

    public function ajaxUploadImages(Request $request)
    {
        $resultUpload = $this->imageUploader->uploadMulti('file', config('image.array_resize_image'), 'resize');

//        foreach($resultUpload['filename'] as $filename) {
//            $data = [];
//            $extension = $this->upload->getExtension($filename);
//            $filePath = $this->uploader->getUploadFolderPathToDay().'/'.$filename;
//            if(in_array($extension, array('gif', 'png', 'jpg', 'bmp', 'jpeg'))) {
//                $data['name'] = $filename;
//                $data['extension'] = $extension;
//                $data['size'] = filesize($filePath);
//                list($width, $height) = getimagesize($filePath);
//                $data['width'] = $width;
//                $data['height'] = $height;
//            } else {
//                $data['name'] = $filename;
//                $data['extension'] = $extension;
//                $data['size'] = filesize($filePath);
//            }
//
//            if($data) {
//                $this->resource->create($data);
//            }
//        }

        foreach($resultUpload as $fileItem) {
            $data = [];
            $extension = $fileItem['extension'];
            $filename = $fileItem['new_name'];
            $filePath = rtrim($fileItem['path_upload'],'/').'/'.$fileItem['new_name'];
            if(in_array($extension, array('gif', 'png', 'jpg', 'bmp', 'jpeg'))) {
                $data['name'] = $filename;
                $data['extension'] = $extension;
                $data['size'] = $fileItem['size'];
                list($width, $height) = getimagesize($filePath);
                $data['width'] = $width;
                $data['height'] = $height;
            } else {
                $data['name'] = $filename;
                $data['extension'] = $extension;
                $data['size'] = filesize($filePath);
            }

            if($data) {
                $this->resource->create($data);
            }
        }

        return response()->json(['code' => 1]);
    }
}