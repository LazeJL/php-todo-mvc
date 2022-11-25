<?php
namespace Todo\Controllers;
use Todo\Services\TaskServiceInterface;
use Tode\Entities\TaskEntity;

abstract class AbstractController {
  
  protected TaskServiceInterface $taskService;
  
  public function __construct( TaskServiceInterface $taskService ) {
    $this->taskService = $taskService;
  }
  
  abstract public function render() : void;
  
}