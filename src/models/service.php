<?php
namespace Shop\Models;

class Service {
  public string $name; // Nombre del producto o servicio
  public float $price; // Precio en € decimal
  public float $tax; // % impuesto

  public function __Construct(string $name, float $price, float $tax = 7){
    $this->name = $name;
    $this->price = $price;
    $this->tax = $tax;
  }

  /**
   * Precio = Precio Base + Impuestos
   */
  public function getPrice(): float {
    return $this->price + ($this->price * $this->tax / 100);
  }

  /**
   * Setter impuesto
   */
  public function setTax(float $tax): void {
    $this->tax = $tax;
  }
}