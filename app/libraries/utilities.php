<?php
  class App_File_Zip_Exception extends Exception {};
  class App_File_Zip {
  /**
   * Zip a file, or entire directory recursively.
   *
   * @param string $source directory or file name
   * @param string $destinationPathAndFilename full path to output
   * @throws App_File_Zip_Exception
   * @return boolean whether zip was a success
   */
  public static function CreateFromFilesystem($source, $destinationPathAndFilename) {
      $base = realpath(dirname($destinationPathAndFilename));
      if (!is_writable($base)) {
          throw new App_File_Zip_Exception('Destination must be writable directory.');
      }
      if (!is_dir($base)) {
          throw new App_File_Zip_Exception('Destination must be a writable directory.');
      }
      if (!file_exists($source)) {
          throw new App_File_Zip_Exception('Source doesnt exist in location: ' . $source);
      }
      $source = realpath($source);
      if (!extension_loaded('zip') || !file_exists($source)) {
          return false;
      }
      $zip = new ZipArchive();
      $zip->open($destinationPathAndFilename, ZipArchive::CREATE);
      if (is_dir($source) === true) {
          $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);
          $baseName = realpath($source);
          foreach ($files as $file) {
              if( in_array(substr($file, strrpos($file, DIRECTORY_SEPARATOR)+1), array('.', '..')) ) {
                  continue;
              }

              $relative = substr($file, strlen($baseName));
              if (is_dir($file) === true) { // Add directory
                  $added = $zip->addEmptyDir(trim($relative, "\\/"));
                  if (!$added) {
                      throw new App_File_Zip_Exception('Unable to add directory named: ' . trim($relative, "\\/"));
                  }
              } else if (is_file($file) === true) {
                  // Add file
                  $added = $zip->addFromString(trim($relative, "\\/"), file_get_contents($file));
                  if (!$added) {
                      throw new App_File_Zip_Exception('Unable to add file named: ' . trim($relative, "\\/"));
                  }
              }
          }
      } else if (is_file($source) === true) {
          // Add file
          $added = $zip->addFromString(trim(basename($source), "\\/"), file_get_contents($source));
          if (!$added) {
              throw new App_File_Zip_Exception('Unable to add file named: ' . trim($relative, "\\/"));
          }
      } else {
          throw new App_File_Zip_Exception('Source must be a directory or a file.');
      }
      $zip->setArchiveComment('Created with App_Framework');
      return $zip->close();
    }
  }
    
  function rrmdir($dir) { 
     if (is_dir($dir)) { 
       $objects = scandir($dir); 
       foreach ($objects as $object) { 
         if ($object != "." && $object != "..") { 
           if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object); 
         } 
       } 
       reset($objects); 
       rmdir($dir); 
     } 
   }

   function rrmDirOlderThan($dir) {
      $objects = scandir($dir);
      foreach($objects as $object) {
        if($object != "." && $object != "..") {
          if(filetype($dir."/".$object) == "dir") {
            if(filemtime($dir."/".$object) <= time()-10800) { // Plus vieux que 3h
              rrmdir($dir."/".$object);
            }
          }
        }
      }
   }
 ?>