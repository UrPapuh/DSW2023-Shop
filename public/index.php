<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pagina de filtrados</title>
  <link rel="stylesheet" type="text/css" href="list.css" />
</head>
<body>
  <form action="index.php" method="get">
    <label for="filter">Filter:</label>
    <select name="filter">
      <option value="all">All</option>
      <option value="products">Only Products</option>
      <option value="services">Only Services</option>
      <option value="events">Only With Deadline</option>
      <option value="salables">Only Salables</option>
    </select>
    <button type="submit">Filter</button>
  </form>
  <?php
    require_once('../vendor/autoload.php');
    require_once('../data/data.php'); // Volcado de datos

    $filter = isset($_GET['filter']) ? $_GET['filter']:'all';
    switch ($filter) {
      case 'all':
        $shop->listAll();
        break;
      case 'products':
        $shop->listProducts();
        break;
      case 'services':
        $shop->listServices();
        break;
      case 'events':
        $shop->listEvents();
        break;
      case 'salables':
        $shop->listSalables();
        break;
    }
  ?>
</body>
</html>