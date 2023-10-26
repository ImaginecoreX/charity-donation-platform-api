<?php

namespace App\Http\Middleware;

class GenerateUniqueID {

  public $pattern;
  public $lastID;

  public function __construct($pattern, $lastID)
  {
    $this->pattern = $pattern;
    $this->lastID = $lastID;
  }

  function generate(): string
  {

    // Extract the numeric part from the last ID
    $lastNumber = (int) substr($this->lastID, 4);

    // Increment the numeric part
    $nextNumber = $lastNumber + 1;

    // Create the new unique ID in the specified pattern
    $newID = $this->pattern . '-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

    return $newID;

  }

}