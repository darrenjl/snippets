<?php
interface Observer {
    function update(Float $temperature, Float $windSpeed, Float $pressure);
}

interface Subject {
    function registerObserver(Observer $o);
    function removeObserver(Observer $o);
    function notifyObservers();
}

class WeatherStation implements Subject{
    private $temperature;
    private $windSpeed;
    private $pressure;
    private $observers;

    function updateData(Float $temperature, Float $windSpeed, Float $pressure)
    {
        $this->temperature = $temperature;
        $this->windSpeed = $windSpeed;
        $this->pressure = $pressure;
        $this->notifyObservers();
    }
    
    function registerObserver(Observer $o)
    {
        $this->observers[] = $o;
    }
    
    function removeObserver(Observer $o)
    {
        //todo implement remove from array
    }
    
    function notifyObservers()
    {
        foreach ($this->observers as $obs) {
            $obs->update($this->temperature, $this->windSpeed, $this->pressure);
        }
    }
}

class UserInterface implements Observer {

    function __construct(Subject $s)
    {
        $s->registerObserver($this);
    }

    function update(Float $temperature, Float $windSpeed, Float $pressure)
    {
        $this->display($temperature, $windSpeed, $pressure);
    }
    function display(Float $temperature, Float $windSpeed, Float $pressure){
        print "(UI Display) Weather updated: temp - $temperature, wind speed - $windSpeed, pressure - $pressure" . PHP_EOL;
    }
}

class Alerter implements Observer {

    function __construct(Subject $s)
    {
        $s->registerObserver($this);
    }

    function update(Float $temperature, Float $windSpeed, Float $pressure)
    {
        $this->alert($temperature, $windSpeed, $pressure);
    }
    function alert(Float $temperature, Float $windSpeed, Float $pressure){
        print "(Alert) Weather updated: temp - $temperature, wind speed - $windSpeed, pressure - $pressure" . PHP_EOL;
    }
}

$station = new WeatherStation();

$ui = new UserInterface($station);
$alerter = new Alerter($station);

$station->updateData(79.6, 21.5, 14.0);


