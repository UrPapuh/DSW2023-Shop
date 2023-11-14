<?php
namespace Shop\Models;

use Shop\Models\Service;
use Shop\Models\Event;

class Product extends Service implements Event {
  public string $manufacturer; // Nombre de fabricante
  public float $weight; // Peso en g
  public float $volume; // Volumen en cm3
  public bool $perishable; // Perecedero?
  public \DateTime $deadline; // Fecha de caducidad

  public function __Construct(string $name, float $price, float $tax, string $manufacturer, float $weight, float $volume, bool $perishable = false, \DateTime $deadline = null){
    parent::__Construct($name, $price, $tax);
    $this->manufacturer = $manufacturer;
    $this->weight = $weight;
    $this->volume = $volume;
    $this->perishable = $perishable;
    if (!$perishable || $deadline == null) {
      $this->deadline = (new \DateTime())->setTime(0,0,0,0);
    } else {
      $this->deadline = $deadline;
    }
  }

  /**
   * Override metodo getPrice()
   * El precio de los productos perecederos disminuirá en un 10% un mes antes de caducar, y
   * en un 25% diez días antes de la fecha límite.
   */
  public function getPrice(): float {
    $price = parent::getPrice(); // Precio Base + Impuestos
    if ($this->perishable) {
      $diff = ($this->now())->diff($this->deadline);
      if ($diff->days <= 10) { // 10 dias (25%)
        $price -= ($price * 25 / 100);
      } else if ($diff->days <= 30) { // 1 mes (10%)
        $price -= ($price * 10 / 100);
      }
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
   * true:false si esta caducado o no
   */
  public function isExpired(): bool {
    if ($this->perishable) {
      return ($this->now()) >= ($this->deadline);
    } else {
      return false;
    }
  }

  /**
   * Dias hasta caducarse
   */
  public function daysUntil(): int {
    if ($this->perishable) {
      return ($this->now())->diff($this->deadline)->days;
    } else {
      return 0;
    }
  }

  /**
   * Calculo coste de envio
   */
  public function getShippingCost(): float {
    $price = 2 + ($this->weight * 0.0002); // coste fijo + coste por gramo
    $exCost = $this->volume/1000;
    if ($exCost >= 1) {
      $price += (int)$exCost; // + coste extra por volumen
    }
    return $price;
  }
}