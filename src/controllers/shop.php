<?php
namespace Shop\Controllers;

use Shop\Models\Service;
use Shop\Models\Product;
use Shop\Models\EventService;
use Shop\Models\SessionService;
use Shop\Models\MixedService;

class Shop {
  private array $services;

  public function add(Service $service) {
    $this->services[] = $service;
  }
  
  /**
   * Listar todos los servicios (Service)
   */
  public function listAll() {
    require('../src/views/listall.php');
  }

  /**
   * Listar todos los productos
   */
  public function listProducts() {
    require('../src/views/listproducts.php');
  }

  /**
   * Listar todos los servicios (EventService, SessionService, MixedService, only Service)
   */
  public function listServices() {
    require('../src/views/listservices.php');
  }

  /**
   * Listar todos los servicios con fecha de expiracion (Products, EventService, MixedService)
   */
  public function listEvents() {
    require('../src/views/listevents.php');
  }

  /**
   * Listar los servicios con fecha de expiracion no caducados (isExpired() == false)
   */
  public function listSalables() {
    require('../src/views/listsalables.php');
  }
}