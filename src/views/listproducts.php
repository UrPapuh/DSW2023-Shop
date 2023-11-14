<?php 
use Shop\Models\Product; 
?>
<h3>List Only Products</h3>
<table>
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Precio Base</th>
      <th>Impuestos</th>
      <th>Fabricante</th>
      <th>Peso</th>
      <th>Volumen</th>
      <th>Perecedero?</th>
      <th>Fecha de caducidad</th>
      <th>Caducado?</th>
      <th>Precio de venta</th>
    </tr>
  </thead>
  <tbody>
  <?php
  foreach ($this->services as $product) {
    if ($product instanceof Product) {
  ?>
    <tr>
      <td><?=$product->name?></td>
      <td><?=round($product->price, 2)?> €</td>
      <td><?=$product->tax?> %</td>
      <td><?=$product->manufacturer?></td>
      <td><?=$product->weight?> g</td>
      <td><?=$product->volume?> cm3</td>
      <td><?=$product->perishable ? 'SI':'NO'?></td>
      <td><?=print_r($product->deadline, true)?></td>
      <td><?=$product->isExpired() ? 'SI':'NO'?></td>
      <td><?=round($product->getPrice(), 2)?> €</td>
    </tr>
  <?php
    }
  }
  ?>
  </tbody>
</table>
