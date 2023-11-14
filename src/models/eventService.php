<?php
namespace Shop\Models;

use Shop\Models\Service;
use Shop\Models\Event;

class EventService extends Service implements Event {
  public \DateTime $deadline; // Fecha de ejecucion del evento

  public function __Construct(string $name, float $price, float $tax, \DateTime $deadline){
    parent::__Construct($name, $price, $tax);
    $this->deadline = $deadline;
  }

  /**
   * Override metodo getPrice()
   * El precio de los eventos se incrementará un 20% una semana antes del evento, y un
   * 50% si se contrata el mismo día del evento.
   */
  public function getPrice(): float {
    $price = parent::getPrice(); // Precio Base + Impuestos
    if ($this->now() == $this->deadline) { // Mismo dia (+50%)
      $price += ($price * 50 / 100);
    } else if ($this->daysUntil() <= 7) { // 1 semana antes (+20%)
      $price += ($price * 20 / 100);
    }
    return $price;
  }

  /**
   * Devuelve la fecha actual a 0
   */
  public function now() : \DateTime {
    return (new \DateTime())->setTime(0,0,0,0);
  }

  /**
   * true:false si fue celebrado
   */
  public function isExpired(): bool {
    return ($this->now()) >= ($this->deadline);
  }
  
  /**
   * Dias hasta celebrarse el evento
   */
  public function daysUntil(): int {
    return ($this->now())->diff($this->deadline)->days;
  }
}
