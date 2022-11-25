<?php
namespace Todo\Controllers;
use Todo\Controllers\AbstractController;

class TaskListController extends AbstractController {
  
  public function render () : void {
   echo get_template( __PROJECT_ROOT__ . "/Views/list.php", [
     'tasks' => $this->taskService->list( array (
      "search" => $_GET["search"] ?? null,
      "order-by" => $_GET["order-by"] ?? null
     ))['tasks']
   ] );
  }
  
}