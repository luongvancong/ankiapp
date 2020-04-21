<?php namespace App\Hocs\Core\Images;

use App\Hocs\Core\Uploads\Uploader;

class ImageFactory {

    protected $upload;

    protected $image;

    public function __construct(Uploader $upload, Image $image) {
        $this->upload = $upload;
        $this->image  = $image;
    }

    public function upload($fileControl, $arrayThumbs = [], $optional = 'resize') {

        if (empty($arrayThumbs))
        {
            $arrayThumbs = config('image.thumbs');
        }

        $return = [
            'status'   => 0,
            'size'     => 0,
            'filename' => '',
            'path'     => '',
            'thumbs'   => []
        ];

        if($fileName = $this->upload->upload($fileControl))
        {
            $thumbs = [];

            $pathUpload = $this->upload->getUploadFolderPathToDay() . '/';

            if($optional == 'resize')
            {
                $thumbs = $this->image->resize($pathUpload . $fileName, $pathUpload, $arrayThumbs);
            }
            else if ($optional == 'crop')
            {
                $thumbs = $this->image->crop($pathUpload . $fileName, $pathUpload, $arrayThumbs);
            }

            $return['status']   = 1;
            $return['thumbs']   = $thumbs;
            $return['filename'] = $fileName;
            $return['path']     = $pathUpload . $fileName;
            $return['size']     = filesize($pathUpload . $fileName);
        }

        return $return;
    }


    public function uploadMulti($fileControl, array $arrayThumbs = array(), $action = 'resize') {
        if (empty($arrayThumbs))
        {
            $arrayThumbs = config('image.thumbs');
        }

        $arrayResult = [];

        $pathUpload = $this->upload->getUploadFolderPathToDay() . '/';

        $resultUpload = $this->upload->uploadMulti($fileControl, $pathUpload);

        foreach($resultUpload as $k => $item) {
            $fileName = $item['new_name'];
            $pathUpload = $item['path_upload'];
            $thumbs = array();
            if($action == 'resize') {
                $thumbs = $this->image->resize($pathUpload . $fileName, $pathUpload, $arrayThumbs);
            } else if ($action == 'crop') {
                $thumbs = $this->image->crop($pathUpload . $fileName, $pathUpload, $arrayThumbs);
            }
            $item['thumbs'] = $thumbs;
            $arrayResult[] = $item;
        }

        return $arrayResult;
    }


    public function uploadFromUrl($url, array $arrayThumbs = array(), $action = 'resize')
    {
        if (empty($arrayThumbs))
        {
            $arrayThumbs = config('image.thumbs');
        }

        $return = [
            'status'   => 0,
            'size'     => 0,
            'filename' => '',
            'path'     => '',
            'thumbs'   => []
        ];

        $resultUpload = $this->upload->uploadFromUrl($url);
        if($resultUpload['code'] == 200) {
            $fileName = $resultUpload['filename'];
            $thumbs = [];

            $pathUpload = $this->upload->getUploadFolderPathToDay() . '/';

            if($action == 'resize')
            {
                $thumbs = $this->image->resize($pathUpload . $fileName, $pathUpload, $arrayThumbs);
            }
            else if ($action == 'crop')
            {
                $thumbs = $this->image->crop($pathUpload . $fileName, $pathUpload, $arrayThumbs);
            }

            $return['status']   = 1;
            $return['thumbs']   = $thumbs;
            $return['filename'] = $fileName;
            $return['path']     = $pathUpload . $fileName;
            $return['size']     = filesize($pathUpload . $fileName);
        }

        return $return;
    }
}