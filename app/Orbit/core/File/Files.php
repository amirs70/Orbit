<?php


namespace App\Orbit\core\File;


use App\Orbit\core\File\FileMimes;
use Illuminate\Http\File;

class Files
{

    private static ?self $obj = null;
    private ?File $mFile;

    private ?string $file = null;

    public static function getInstance($file): Files
    {
        if (is_null(self::$obj)) {
            self::$obj = new Files($file);
        }
        return self::$obj;
    }

    private function __construct($file)
    {
        if (file_exists($file)) {
            $this->mFile = new File($file);
            $this->file = $file;
        }
    }

    /**
     * Header file inline
     */
    public function header(): void
    {
        if (!is_null($this->file)) {
            header("Content-Type: " . FileMimes::get($this->mFile->getExtension()));
            header("Content-Length: " . $this->mFile->getSize());
            readfile($this->file);
            exit;
        }
        abort(404);
    }

}
