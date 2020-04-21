<?php namespace App\Hocs\Core\Uploads;

use App\Exceptions\MimeNotExistException;
use App\Hocs\Core\Uploads\Exceptions\FileTypeIsNotAllowedException;
use App\Hocs\Core\Uploads\Exceptions\NoFileSelectedException;
use App\Hocs\Core\Uploads\Exceptions\UploadException;
use App\Hocs\Core\Uploads\Exceptions\UploadMaxFileSizeException;
use App\Hocs\Core\Uploads\Exceptions\UploadPathDoesNotExistException;
use Request;

class Upload {

	protected $uploadFolder = 'uploads';

	public function __construct($config = []) {
		if (empty($config))
		{
			$config = (array) config('upload');
		}

		$this->extensions = array_get($config, 'extensions');
		$this->fileSize   = array_get($config, 'file_size');
		$this->uploadFolder = array_get($config, 'upload_folder', 'uploads');
	}

	/**
	 * Upload file
	 *
	 * @param  string $fileControl
	 * @param  string $pathUpload
	 * @throws NoFileSelectedException|UploadException|FileTypeIsNotAllowedException|UploadMaxFileSizeException|UploadPathDoesNotExistException
	 * @return string|null
	 */
	public function upload($fileControl, $pathUpload) {
		//Duong dan luu anh
		$pathUpload = rtrim($pathUpload, '/') . '/';

		if(!isset($_FILES[$fileControl])) {
			throw new Exceptions\NoFileSelectedException("Chưa chọn file upload");
		}

		//Upload code
		$uploadErrorCode = $_FILES[$fileControl]['error'];

		if($uploadErrorCode > 0) {
			throw new Exceptions\UploadException($uploadErrorCode);
		}

		if($this->checkExtension($_FILES[$fileControl]['name']) == false) {
			throw new Exceptions\FileTypeIsNotAllowedException($this->getExtensions());
		}

		if($this->checkFilesizeLimit($_FILES[$fileControl]['tmp_name']) == false) {
			throw new Exceptions\UploadMaxFileSizeException($this->getFileSizeLimit());
		}

		if(!file_exists($pathUpload)) {
			throw new Exceptions\UploadPathDoesNotExistException("Đưòng dẫn upload không tồn tại. Bạn đã tạo folder lưu trữ file này chưa?");
		}

		$newFileName = $this->generateNewFileName($_FILES[$fileControl]['name']);

		if(move_uploaded_file($_FILES[$fileControl]['tmp_name'], $pathUpload . $newFileName)) {
			return $newFileName;
		}
	}



	/**
	 * Upload multiple
	 * @param  string $fileControl Name of input file
	 * @param  string $pathUpload  Path upload
	 * @return array
	 */
	public function uploadMulti($fileControl, $pathUpload) {
		$arrayResult = array();
		$pathUpload = rtrim($pathUpload, '/') . '/';
		foreach ($_FILES[$fileControl]["error"] as $key => $error) {
		    $extension = $this->getExtension($_FILES[$fileControl]["name"][$key]);

		    if ($error == UPLOAD_ERR_OK
		   	&& in_array($extension, $this->getExtensions())) {
				$tmp_name = $_FILES[$fileControl]["tmp_name"][$key];
				$originalName = $_FILES[$fileControl]["name"][$key];
				$newName = $this->generateNewFileName($originalName);
				$newFilePath = $pathUpload . $newName;
				move_uploaded_file($tmp_name, $newFilePath);
				$arrayResult[] = [
				    'original_name' => $originalName,
                    'new_name' => $newName,
                    'size' => filesize($newFilePath),
                    'extension' => $extension,
                    'path_upload' => $pathUpload
                ];
		   }
		}

		return $arrayResult;
	}


	public function uploadFromUrl($url, $pathUpload)
	{
		// Clean path upload
		$pathUpload = rtrim($pathUpload, '/');
		$pathUpload = rtrim($pathUpload, '//');

		$contentFile = file_get_contents($url);
		$tempFilePath = public_path().'/uploads/temp.txt';
		file_put_contents($tempFilePath, $contentFile);
		$mimes = array_flip(config('mime'));
		$fileMime = mime_content_type($tempFilePath);

		if(!array_key_exists($fileMime, $mimes)) {
			throw new MimeNotExistException("Mime not exist in config/mime.php", 1);
		}

		// Get extension
		$extension = $mimes[$fileMime];

		// New file name
		$filename = md5($url).'.'.$extension;
		$ipClient = Request::server('REMOTE_ADDR');
		if(!$ipClient) $ipClient = time() . rand(111111,999999) . rand(111111,999999);

		$frefix = date("Y_m_d").'___'.time().'___';
		$nFilename = str_replace('.', '--', $filename);
		$nFilename = removeTitle($nFilename);
		$filenameMd5 = $frefix . md5($nFilename . $ipClient);
		$newFileName = $filenameMd5 . '.' . $extension;

		// Write content to new file
		$newFilePath = $pathUpload.'/'.$newFileName;
		file_put_contents($newFilePath, $contentFile);

		unlink($tempFilePath);

		if(is_readable($newFilePath)) {
			return [
				'code' => 200,
				'filename' => $newFileName
			];
		}

		return ['code' => 0];
	}


	/**
	 * Get extension
	 * @param  string $filename
	 * @return mixed
	 */
	public function getExtension($filename) {
		$info = new \SplFileInfo($filename);
		return strtolower($info->getExtension());
	}


	/**
	 * Generate new file name
	 *
	 * @param  string $filename
	 *
	 * @return string
	 */
	public function generateNewFileName($filename) {
		$ipClient = get_client_ip();
		if(!$ipClient) $ipClient = time() . rand(111111,999999) . rand(111111,999999);

		$prefix = date("Y_m_d").'___'.time().'___';
		$nFilename = str_replace('.', '--', $filename);
		$nFilename = removeTitle($nFilename);
		$filenameMd5 = $prefix . md5($nFilename . $ipClient);
		return $filenameMd5 . '.' . $this->getExtension($filename);
	}


	/**
	 * Get config extensions
	 *
	 * @return array
	 */
	public function getExtensions() {
		return $this->extensions;
	}

	/**
	 * Get config limit file size
	 *
	 * @return integer
	 */
	public function getFileSizeLimit() {
		return $this->fileSize;
	}


	/**
	 * Kiem tra extension
	 * @param  string $filename [description]
	 * @return bool
	 */
	protected function checkExtension($filename) {
		$extension = $this->getExtension($filename);

		if(!in_array($extension, $this->extensions)){
			return false;
		}

		return true;
	}


	/**
	 * Kiem tra dung luong upload cho phep
	 * @param  string $filename [description]
	 * @return bool
	 */
	protected function checkFilesizeLimit($filename) {
		if(filesize($filename) / 1024 > $this->fileSize){
			return false;
		}

		return true;
	}

	public function getUploadFolder() {
		return $this->uploadFolder;
	}

	public function getUploadFolderPath() {
		return public_path()  . '/' . $this->getUploadFolder();
	}
}