<?php

abstract class Pizza
{
    function getDescription()
    {
        return $this->description;
    }
    abstract function cost();
}

class ThinCrustPizza extends Pizza
{
    function __construct()
    {
        $this->description = 'Thin crust pizza';;
    }

    function cost()
    {
        return 11.99;
    }
}

class ThickCrustPizza extends Pizza
{
    function __construct()
    {
        $this->description = 'Thick crust pizza';
    }

    function cost()
    {
        return 13.99;
    }
}

abstract class ToppingDecorator extends Pizza
{
    // in java you could change this to abstract to ensure 
    // decorators implement
    function getDescription() {
        return 'Unimplemented';
    }
}

class Cheese extends ToppingDecorator
{   
    private $pizza;
    function __construct(Pizza $pizza)
    {
        $this->pizza = $pizza;
    }

    function getDescription()
    {
        return $this->pizza->getDescription() . ' + cheese';
    }

    function cost(){
        return $this->pizza->cost() + 0.50;
    }
}
class Olives extends ToppingDecorator
{
    private $pizza;
    function __construct(Pizza $pizza)
    {
        $this->pizza = $pizza;
    }

    function getDescription()
    {
        return $this->pizza->getDescription() . ' + olives';
    }

    function cost(){
        return $this->pizza->cost() + 1.50;
    }
}
class Peppers extends ToppingDecorator
{
    private $pizza;
    function __construct(Pizza $pizza)
    {
        $this->pizza = $pizza;
    }

    function getDescription()
    {
        return $this->pizza->getDescription() . ' + peppers';
    }

    function cost(){
        return $this->pizza->cost() + 0.10;
    }
}

$pizza = new ThickCrustPizza();
$pizza = new Cheese($pizza);
$pizza = new Olives($pizza);
$pizza = new Peppers($pizza);
print $pizza->getDescription() . ', $' . $pizza->cost();