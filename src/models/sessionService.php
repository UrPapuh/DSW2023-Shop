<?php
namespace Shop\Models;

use Shop\Models\Service;
use Shop\Models\Session;

class SessionService extends Service implements Session {
  private int $sessions; // Numero de sesiones

  public function __Construct(string $name, float $price, float $tax, int $sessions){
    parent::__Construct($name, $price, $tax);
    $this->sessions = $sessions;
  }

  /**
   * Override metodo getPrice()
   * (precio + impuestos) * numSesiones
   */
  public function getPrice(): float {
    $price = parent::getPrice(); // Precio Base + Impuestos
    return $price * $this->sessions;
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
    if ($this->sessions > 0) {
      $this->sessions--;
    }
  }
}