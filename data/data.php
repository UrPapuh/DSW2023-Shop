<?php
// Dependencias
use Shop\Controllers\Shop;
use Shop\Models\Service;
use Shop\Models\Product;
use Shop\Models\EventService;
use Shop\Models\SessionService;
use Shop\Models\MixedService;

// Controlador
$shop = new Shop();

// Productos
$p1 = new Product('Producto 1', 100, 7, 'Marta 1', 1000, 2000);
$p2 = new Product('Producto 2', 200, 7, 'Marta 2', 2000, 3000);
$date = (new \DateTime())->sub(new \DateInterval("P1D")); // Caducado (ayer)
$p3 = new Product('Producto 3', 300, 7, 'Marca 3', 3000, 4000, true, $date);
$date = $date->add(new \DateInterval("P3D")); // +3 dias
$p4 = new Product('Producto 4', 400, 7, 'Marca 4', 4000, 5000, true, $date);
$date = $date->add(new \DateInterval("P22D")); // +25 dias
$p5 = new Product('Producto 5', 500, 7, 'Marca 5', 5000, 6000, true, $date);
$shop->add($p1);
$shop->add($p2);
$shop->add($p3);
$shop->add($p4);
$shop->add($p5);

// Servicios
// -> Eventos
$date = (new \DateTime())->sub(new \DateInterval("P1D")); // Caducado (ayer)
$e1 = new EventService('Evento 1', 100, 7, $date);
$date = new \DateTime(); // Caduca Hoy
$e2 = new EventService('Evento 2', 200, 7, $date);
$date = $date->add(new \DateInterval("P2M")); // +2 mes
$e3 = new EventService('Evento 3', 300, 7, $date);
$shop->add($e1);
$shop->add($e2);
$shop->add($e3);
// -> Sesiones
$ss1 = new SessionService('Sesion 1', 100, 7, 2);
$ss2 = new SessionService('Sesion 2', 200, 7, 0);
$shop->add($ss1);
$shop->add($ss2);
// -> Mixto
$date = (new \DateTime())->sub(new \DateInterval("P1D")); // Caducado (ayer)
$m1 = new MixedService('Mixto 1', 100, 7, 10, $date);
$date = $date->add(new \DateInterval("P2D")); // +2 dias
$m2 = new MixedService('Mixto 2', 200, 7, 10, $date);
$shop->add($m1);
$shop->add($m2);
// -> Normales
$s1 = new Service('Normal 1', 10.50, 7);
$s2 = new Service('Normal 2', 2.75, 10);
$shop->add($s1);
$shop->add($s2);