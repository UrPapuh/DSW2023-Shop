<?php
namespace Shop\Models;

interface Event {
  function now() : \DateTime; // Fecha actual a 0
  function isExpired(): bool; // Fue celebrado/Esta caducado
  function daysUntil(): int; // Dias hasta el evento/Caducarse
}