<?php
namespace Php8Solutions\Image;

use PDO;

class Thumbnail{
    protected $original;
    protected $originalWidth;
    protected $originalHeight;
    protected $basename;
    protected $imageType;
    protected $messages = [];

    public function __construct(string $image, 
    protected string $path, 
    protected int $max = 120, 
    protected string $suffix = '_thb')
    {
        /**
         * Comprobar que $image es un archivo y se puede leer
         * para guardar getimagesize() en $dimensions.
         * Exception esta precedida por una barra para indicar
         * que queremos usar la clase Exception en lugar
         * de una personalizada.
         */
        if(is_file($image) && is_readable($image)){
            $dimensions = getimagesize($image);
        }else{
            throw new \Exception("$image doesn't appear to be an image");
        }
        /**
         * Evaluar las propiedades de $dimensions para
         * comprobar que tiene anchura y MIME y se pueden leer.
         */
        if(!is_array($dimensions)){
            throw new \Exception("$image doesn't appear to be an image.");
        }else{
            if($dimensions[0] == 0){
                throw new \Exception("Cannot determine the size of $image.");
            }
            // Check the MIME type.
            if(!$this->checkType($dimensions['mime'])){
                throw new \Exception("Cannot process that type of file.");
            }
        }
        if(is_dir($path) && is_writable($path)){
            $this->path = rtrim($path, '/\\') . DIRECTORY_SEPARATOR;
        }else{
            throw new \Exception("Cannot write to $path");
        }
        /**
         * Asumiendo que el script paso todas las pruebas
         * ahora si se pueden asignar las propiedades a nuestro
         * archivo
         */
        $this->original = $image;
        $this->originalWidth = $dimensions[0];
        $this->originalHeight = $dimensions[1];
        $this->basename = pathinfo($image, PATHINFO_FILENAME);
        // asegurar que max siempre sea entero positivo
        $this->max = abs($max);
        if($suffix != '_thb'){
            $this->suffix = $this->setSuffix($suffix) ?? '_thb';
        }
    }

    public function create(){
        $ratio = $this->calculateRatio();
        $thumbWidth = round($this->originalWidth * $ratio);
        $thumbHeight = round($this->originalHeight * $ratio);
        $resource = $this->createImageResource();
        // crear recurso para el thumbnail
        $thumb = imagecreatetruecolor($thumbWidth, $thumbHeight);
        imagecopyresampled($thumb, $resource, 0,0,0,0, $thumbWidth, $thumbHeight, $this->originalWidth, $this->originalHeight);
        $newname = $this->basename . $this->suffix;
        switch($this->imageType){
            case 'jpeg':
                $newname .= '.jpg';
                $sucess = imagejpeg($thumb, $this->path . $newname);
                break;
            case 'png':
                $newname .= '.png';
                $sucess = imagepng($thumb, $this->path . $newname);
                break;
            case 'webp':
                $newname .= '.webp';
                $sucess = imagewebp($thumb, $this->path . $newname);
                break;
        }
        if($sucess){
            $this->messages[] = "$newname created successfully!.";
        }else{
            $this->messages[] = "Couldn't create a thumbnail for " .
            basename($this->original);
        }
        imagedestroy($resource);
        imagedestroy($thumb);
    }

    public function getMessages(){
        return $this->messages;
    }

    /**
     * El metodo checkType() compara el tipo MIME con un
     * array de tipos de imagenes aceptables. Si encuentra
     * alguno, se almacena en $imageType, de lo contrario,
     * devuelve falso.
     */
    protected function checkType($mime){
        $mimetypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if(in_array($mime, $mimetypes)){
            // extract the characters after '/'
            $this->imageType = substr($mime, strpos($mime, '/')+1);
            return true;
        }
        return false;
    }

    /**
     * El metodo setSuffix() debe 
     * asegurarse que el valor no contenga
     * un caracter especial
     */
    protected function setSuffix($suffix){
        if(preg_match('/^\w+$/', $suffix)){
            if(!str_starts_with($suffix, '_')){
                return '_' . $suffix;
            }else{
                return $suffix;
            }
        }
    }

    protected function calculateRatio()
    {
        // comprobar si las dimensiones son menores a las 
        // maximas permitidas $max.
        if($this->originalWidth <= $this->max && 
        $this->originalHeight <= $this->max)
        {
            return 1;
            /**
             * Si el ancho es mayor que la altura, entonces se usa
             * el ancho para calcular el scaling ratio
             */
        }elseif($this->originalWidth > $this->originalHeight)
        {
            return $this->max/$this->originalWidth;
        }else{
            return $this->max/$this->originalHeight;
        }
    }

    /**
     * Este metodo crea el recurso para la copia de la imagen, el
     * metodo checktype() comprueba primero el recurso para la
     * imagen original
     */
    protected function createImageResource(){
        switch($this->imageType){
            case 'jpeg':
                return imagecreatefromjpeg($this->original);
            case 'png':
                return imagecreatefrompng($this->original);
            case 'gif':
                return imagecreatefromgif($this->original);
            case 'webp':
                return imagecreatefromwebp($this->original);
        }
    }

}