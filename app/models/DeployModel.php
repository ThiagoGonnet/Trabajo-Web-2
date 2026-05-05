<?php

class DeployModel(){
    private function deploy()
  {
    $query = $this->db->query('SHOW TABLES');
    $tables = $query->fetchAll();
    if (count($tables) == 0) {
      $sql = <<<END
        CREATE TABLE IF NOT EXISTS ejemplo (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nombre VARCHAR(50)
        );
        END;
      $this->db->query($sql);
    }
  }
}
