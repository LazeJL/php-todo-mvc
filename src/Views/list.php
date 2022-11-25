<?php 
  /**
  * @var TaskEntity[] $tasks
  */
?>
<?php
echo get_header( [ 'title' => 'Accueil' ] );
?>
  <div class="container mx-auto flex flex-row items-stretch space-x-8">
    <!-- Filters -->
    <aside class="block w-1/4 mt-[7.1rem]">
      <?= get_template( __PROJECT_ROOT__ . "/Views/fragments/filter-form.php", [
        // TODO y aura sûrement un truc à faire ici 🤔
      ] ); ?>
    </aside>
    <!-- /Filters -->
    
    <main class="container mx-auto flex-1">
      <!-- Header + Search Form -->
      <header class="flex flex-row mt-8 items-center justify-space-between  mb-8">
        <h1 class="text-2xl font-bold uppercase tracking-widest flex-1">
          Tâches
        </h1>
        
        <a class="p-4 rounded bg-teal-400 hover:bg-teal-500 duration-300 transition-colors flex items-center font-medium text-sm uppercase text-white tracking-widest justify-center" href="/task">
          Créer <i class="iconoir-add-circled-outline block ml-2 text-xl"></i>
        </a>
      </header>
      <!-- /Header + Search Form -->
      
      <form method="post">
        
        <!-- Task -->
        <?php
          $atmdate = "";
          $page = $_GET['page'] ?? 1;
          switch ($page){
            case 1:
                $page = 0;
                break;
            case 2:
                $page = 10;
                break;
            case 3:
                $page = 20;
                break;
          }

          $tasks = array_slice($tasks, $page, 10);

          foreach ($tasks as $task){
              $taskDate = date('d-m-Y', strtotime($task->getCreatedAt())); 
              if ($taskDate != $atmdate) {
                  $atmdate = $taskDate;
                  echo "<h2 class='text-xl font-bold uppercase tracking-widest flex-1 mt-8 mb-4'>$taskDate</h2>";
              }

              echo get_template( __PROJECT_ROOT__ . "/Views/fragments/task-card.php", [
                  'task' => $task
              ]);
          }
          ?>

        <?php  
          if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
            $url = "https://";   
          else  
            $url = "http://";   
          // Append the host(domain name, ip) to the URL.   
          $url.= $_SERVER['HTTP_HOST'];   
    
          // Append the requested resource location to the URL   
          $url.= $_SERVER['REQUEST_URI'];    
        ?>
        
        <!-- Pagination + Submit -->
        <div class="flex flex-row justify-space-between items-center">
          <!-- Submit -->
          <button type="submit" class="p-4 rounded bg-teal-400 hover:bg-teal-500 duration-300 transition-colors flex items-center font-medium text-sm uppercase text-white tracking-widest justify-center">
            Enregistrer <i class="iconoir-save-floppy-disk block ml-2 text-xl"></i>
          </button>
          
          <!-- Pagination -->
          <div class="flex-1 flex flex-row justify-end space-x-4 my-8">
            <a href="<?php 
              $donne = $_GET;
              $donne["page"] = 1;
              $query = http_build_query($donne);
              echo "?".$query;
              ?>" class="block bg-slate-50 hover:bg-slate-200 rounded p-4 text-sm cursor-pointer transition-colors duration-300">
              1
            </a>
            <a href="<?php 
              $donne = $_GET;
              $donne["page"] = 2;
              $query = http_build_query($donne);
              echo "?".$query;
              ?>" class="block bg-slate-50 hover:bg-slate-200 rounded p-4 text-sm cursor-pointer transition-colors duration-300">
              2
            </a>
            <a href="<?php 
              $donne = $_GET;
              $donne["page"] = 3;
              $query = http_build_query($donne);
              echo "?".$query;
              ?>" class="block bg-slate-50 hover:bg-slate-200 rounded p-4 text-sm cursor-pointer transition-colors duration-300">
              3
            </a>
          </div>
        </div>
        <!-- /Pagination -->
      </form>
    </main>
  </div>
<?php echo get_footer(); ?>