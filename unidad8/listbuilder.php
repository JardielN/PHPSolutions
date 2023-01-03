<?php
class ListBuilder extends RecursiveIteratorIterator
{
    protected $array;
    protected $output = '';

    public function __construct(array $array)
    {
        /**
         * Para usar una matriz con un iterador SPL, primero debe convertirse en un iterador, por lo que la primera línea dentro del constructor crea una nueva instancia de RecursiveArrayIterator y la asigna a la propiedad $array de ListBuilder.
         */
        $this->array = new RecursiveArrayIterator($array);
        // Call the RecursiveIteratorIterator parent constructor
        /**
         * Debido a que estamos reemplazando el constructor RecursiveIteratorIterator, debemos invocar el constructor principal y pasarle la propiedad $array como primer argumento. Llamar a parent::SELF_FIRST como segundo argumento da acceso tanto a las claves como a los valores de la matriz que se está procesando. Sin este segundo argumento, no tendríamos acceso a las claves.
         */
        parent::__construct($this->array, parent::SELF_FIRST);
    }

    protected function run(){
        self::beginIteration();
        while(self::valid()){
            self::next();
        }
        self::endIteration();
    }

    public function beginIteration(): void
    {
        $this->output .= '<ul>';
    }
    public function endIteration(): void
    {
        $this->output .= '</ul>';
    }

    public function beginChildren(): void
    {
        $this->output .= '<ul>';
    }
    public function endChildren(): void
    {
        $this->output .= '</ul>';
    }

    public function nextElement(): void
    {
        // Check whether there's a subarray
        if(parent::callHasChildren()){
            // Display the subarray's key
            $this->output .= '<li>' . self::key();
        }else{
            // Display the current element
            $this->output .= '<li>' . self::current() . '</li>';
        }
    }

    public function __toString()
    {
        // Generate the list
        $this->run();
        return $this->output;
    }
}