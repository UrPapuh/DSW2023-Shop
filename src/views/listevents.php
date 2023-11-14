<?php
use Shop\Models\Event;
use Shop\Models\Product;
use Shop\Models\MixedService;
?>
<h3>List Events (Product, EventService, MixedService)</h3>
<table>
  <thead>
    <tr>
      <th>Tipo</th>
      <th>Nombre</th>
      <th>Precio Base</th>
      <th>Impuestos</th>
      <th>Sesiones</th>
      <th>Perecedero</th>
      <th>Fecha limite</th>
      <th>Dias</th>
      <th>Caducado</th>
      <th>Precio de venta</th>
    </tr>
  </thead>
  <tbody>
  <?php
  foreach ($this->services as $service) {
    if ($service instanceof Event) {
      $manufacturer = '-';
      $weight = '-';
      $volume = '-';
      $perishable = '-';
      if ($service instanceof Product) {
        $manufacturer = $service->manufacturer;
        $weight = $service->weight;
        $volume = $service->volume;
        $perishable = $service->perishable ? 'SI':'NO';
      }
      $sessions = '-';
      if ($service instanceof MixedService) {
        $sessions = $service->getSessions();
      }
      $days = $service->daysUntil();
      $expired = $service->isExpired() ? 'SI':'NO';
  ?>
    <tr>
      <td><?=get_class($service)?></td>
      <td><?=$service->name?></td>
      <td><?=round($service->price, 2)?> €</td>
      <td><?=$service->tax?> %</td>
      <td><?=$sessions?></td>
      <td><?=$perishable?></td>
      <td><?=print_r($service->deadline, true)?></td>
      <td><?=$days?></td>
      <td><?=$expired?></td>
      <td><?=round($service->getPrice(), 2)?> €</td>
    </tr>
  <?php
    }
  }
  ?>
  </tbody>
</table>
