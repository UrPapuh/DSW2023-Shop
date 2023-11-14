<?php
use Shop\Models\Product;
use Shop\Models\Event;
use Shop\Models\Session;
?>
<h3>List Only Services (EventService, SessionService, MixedService, parent class Service)</h3>
<table>
  <thead>
    <tr>
      <th>Tipo</th>
      <th>Nombre</th>
      <th>Precio Base</th>
      <th>Impuestos</th>
      <th>Sesiones</th>
      <th>Fecha limite</th>
      <th>Dias</th>
      <th>Caducado</th>
      <th>Precio de venta</th>
    </tr>
  </thead>
  <tbody>
  <?php
  foreach ($this->services as $service) {
    if (!$service instanceof Product) {
      $deadline = '-';
      $days = '-';
      $expired = '-';
      if ($service instanceof Event) {
        $deadline = print_r($service->deadline, true);
        $days = $service->daysUntil();
        $expired = $service->isExpired() ? 'SI':'NO';
      }
      $sessions = '-';
      if ($service instanceof Session) {
        $sessions = $service->getSessions();
      }
  ?>
    <tr>
      <td><?=get_class($service)?></td>
      <td><?=$service->name?></td>
      <td><?=round($service->price, 2)?> €</td>
      <td><?=$service->tax?> %</td>
      <td><?=$sessions?></td>
      <td><?=$deadline?></td>
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