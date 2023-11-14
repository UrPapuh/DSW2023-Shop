<?php
namespace Shop\Models;

use Shop\Models\Service;
use Shop\Models\Session;
use Shop\Models\Event;

class MixedService extends Service implements Event, Session {
  private int $sessions; // Numero de sesiones
  public \DateTime $deadline; // Fecha limite

  public function __Construct(string $name, float $price, float $tax, int $sessions, \DateTime $deadline){
    parent::__Construct($name, $price, $tax);
    $this->sessions = $sessions;
    $this->deadline = $deadline;
  }

  /**
   * Override metodo getPrice()
   * precio + impuestos * numSesiones
   */
  public function getPrice(): float {
    $price = parent::getPrice(); // Precio Base + Impuestos
    return $price * $this->sessions;
  }


  /**
   * Devuelve la fecha actual a 0
   */
  public function now() : \DateTime {
    return (new \DateTime())->setTime(0,0,0,0);
  }

  /**
   * true:false si paso o no la fecha limite
   */
  public function isExpired(): bool { // Fue celebrado/Esta caducado
    return ($this->now()) >= ($this->deadline);
  }
  
  /**
   * Dias hasta la fecha limite
   */
  public function daysUntil(): int {
    return ($this->now())->diff($this->deadline)->days;
  }

  /**
   * Getter numero de sesiones
   */
  public function getSessions(): int {
    return $this->sessions;
  }

  /**
   * Decrementar numero de sesiones
   */
  public function deSession(): void {
    if (!$this->isExpired() && $this->sessions > 0) {
      $this->sessions--;
    }
  }
}