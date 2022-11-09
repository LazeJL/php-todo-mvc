<?php
class TaskListController extends AbstractController {
  
  public function render () : void {
   echo get_template( __PROJECT_ROOT__ . "/Views/list.php", [
     'tasks' => $this->taskService->list( array (
      "search" => $_GET["search"],
      "order-by" => $_GET["order-by"]
     ))['tasks']
   ] );
  }
  
}