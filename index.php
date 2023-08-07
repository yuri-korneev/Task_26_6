<?php

$doc = 'document.html';
$dom = new DomDocument('1.0', 'UTF-8');
$dom->loadHTMLFile($doc);


class MyIterator implements Iterator {

    
    public $items;
    public $position;

    public function __construct($dom, $tag) { 
        
        $this->items = $dom->getElementsByTagName($tag); 
    
    }
   
    public function rewind(): void {
        $this->position = 0;
      }

    public function valid(): bool {

        return isset($this->items[$this->position]);

      }
   
    public function current() {
     
      return $this->items[$this->position];
    }
   
    public function next(): void {

      ++$this->position;
    }
   
    public function key() {
      
      return $this->position;
    }

    public function deleteTag($keys) {

      $keys->parentNode->removeChild($keys);

    }
   
  }

$tagMeta = "meta";

$htmlIterator = new MyIterator($dom, $tagMeta); 


foreach($htmlIterator as $keys) {

   if ($keys->getAttribute('name') == 'keywords') {
    
    $htmlIterator->deleteTag($keys);

  }

}

foreach($htmlIterator as $keys) {

  if ($keys->getAttribute('name') == 'description') {
   
    $htmlIterator->deleteTag($keys);

 }

}


$tagTitle = "title";

$htmlIterator1 = new MyIterator($dom, $tagTitle); 

foreach($htmlIterator1 as $keys) {
   
    $htmlIterator->deleteTag($keys);

 }


$dom->saveHTMLFile("documentNew.html");

?>