<?php
namespace Todo\Services;
use Todo\Common\SingletonTrait;
use Todo\Entities\TaskEntity;
use Todo\Services\TaskServiceInterface;

class DatabaseTaskService implements TaskServiceInterface {
  
  use SingletonTrait;

  /**
   * @var Database
   */
  private PDO $db;

  protected function __construct() {
    $this->db = new PDO('mysql:host=db_todo_pdo_server;dbname=todo','root','root',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
  }

  public function get ( int $id ) : ?TaskEntity {
    $query = $this->db->prepare('SELECT * FROM Task WHERE id = :id');
    $query -> execute([
        ':id' => $id,
    ]);
    $data = $query->fetch();
    return $data;
  }

  public function list ( array $args = [] ) : array{
    $query = $this->db->prepare('SELECT * FROM Task');
    $query->execute();
    $data = $query->fetchAll();

    foreach ( $data as $task ) :
      if ( isset( $args['search'] ) && ! str_contains( $task->getTitle(), $args['search'] ) )
        continue;

      if ( isset( $args['hideCompleted'] ) && $args['hideCompleted'] && $task->isCompleted() )
        continue;
    
      $results[] = $task;
    endforeach;

    return array(
      'page' => $args['page'] ?? 1,
      'perPage' => $args['perPage'] ?? 10,
      'total' => count($data),
      'tasks' => $results
    );
  }

  public function create ( TaskEntity $task ) : TaskEntity{
    $query = $this->db->prepare('INSERT INTO Task VALUE (:title,:description,:completed,:createdAt,:updatedAt,:completedAt)');
    $query -> execute([
        'title' => $task->getTitle(),
        'description' => $task->getDescription(),
        'completed' => $task->isCompleted(),
        'createdAt' => $task->getCreatedAt(),
        'updatedAt' => $task->getUpdatedAt(),
        'completedAt' => $task->getCompletedAt(),
    ]);
    return $task;
  }
  
  public function update ( TaskEntity $task ) : TaskEntity{
    $query = $this->db->prepare('UPDATE Task SET title = :title, description = :description, completed = :completed, createdAt = :createdAt, updatedAt = :updatedAt, completedAt = :completedAt)');
    $query -> execute([
        'title' => $task->getTitle(),
        'description' => $task->getDescription(),
        'completed' => $task->isCompleted(),
        'createdAt' => $task->getCreatedAt(),
        'updatedAt' => $task->getUpdatedAt(),
        'completedAt' => $task->getCompletedAt(),
    ]);
    return $task;
  }
  
  public function delete ( int $id ) : void{
    $query = $this->db->prepare('DELETE FROM Task WHERE id = :id;');
    $query -> execute([
        'id' => $id,
    ]);

  }

}