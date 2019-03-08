<?php
    const PI = 3.1415;
    
    class Figure
    {
        public $type;
        public function getArea() {}
        public function getType()
        {
            echo $this->type;
        }
    }
    
    class Rectangle extends Figure
    {
        public $a,$b;
        public function __construct($inputObj)
        {
            $this->type=$inputObj->type;
            $this->a=$inputObj->a;
            $this->b=$inputObj->b;
        }
        public function getArea()
        {
            return $this->a * $this->b;
        }   
    }
    
    class Circle extends Figure
    {
        public $radius;
        public function __construct($inputObj)
        {
            $this->type=$inputObj->type;
            $this->radius=$inputObj->radius;
        }
        public function getArea()
        {
            return PI * ($this->radius*2);
        }   
    }

    class Pyramid extends Figure
    {
        public $sidesOfBase;
        function __construct($inputObj)
        {
            $this->type=$inputObj->type;
            $this->sidesOfBase=$inputObj->sidesOfBase;
        }
        public function getArea()
        {
         return 0;
        }  
    }
            
    function сreateRandomFigure ()
    {  
       $fig = rand (0,2);
       $randObj = new stdClass();
       switch ($fig) {
           case 0:
                $randObj->type = "circle";
                $randObj->radius = rand(1,20);
                return new Circle($randObj);
                break;
            case 1:
                $randObj->type = "rectangle";
                $randObj->a = rand(1,20);
                $randObj->b = rand(1,20);
                return new Rectangle($randObj);
                break;
            case 2:
                $randObj->type = "pyramid";
                $randObj->sidesOfBase = rand(1,20);
                return new Pyramid($randObj);
                break;
        }
    }
        
    function cmp($a, $b)
    {
        if ($a->getArea() == $b->getArea()) {
            return 0;
        }
        return ($a->getArea() < $b->getArea()) ? 1 : -1;
    }
    
    //main
    $string=file_get_contents("figures.json");
    $json=json_decode($string);
    $collection=array();
    
    for ($i = 0;$i < count($json); $i++) {
        $currentObj=$json[$i];
        switch ($currentObj->type) {
            case "circle":
                $collection[]=new Circle($currentObj);
                break;
            case "rectangle": 
                $collection[]=new Rectangle($currentObj);
                break;
            case "pyramid": 
                $collection[]=new Pyramid($currentObj);
                break;
        }
    }
    
     //Создание десяти случайных фигур и добавление их к считанным из figures.json
    for ($i = 0;$i < 10; $i++) {  
    $collection[] = сreateRandomFigure(); 
    }

    //Сортировка
    usort($collection, "cmp");
    foreach ($collection as $key => $value) {
         echo ($collection[$key]->getType().", area=".$collection[$key]->getArea()."<br>");
    }

    // Сохранение фигур в файл
    $json = json_encode($collection);
    $file = fopen('SavedFigures.json', 'w');
    $write = fwrite($file,$json);
    fclose($file);
