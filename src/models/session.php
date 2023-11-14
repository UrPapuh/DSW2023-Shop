<?php
namespace Shop\Models;

interface Session {
  function getSessions(): int; // Devuelve el numero de sesiones
  function deSession(): void; // Disminuir el numero de sesiones
}