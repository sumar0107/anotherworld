<?php

/*
 * Implementation of hook_migrate_api().
 */

function migrate_repin_migrate_api() {
  return array(
      'api' => 2,
  );
}

abstract class BasicMigrationRepin extends Migration {

  public $folder;
  public $term_tid;

  public function __construct() {
    parent::__construct();
    $this->description = 'Migration from mysql into nodes.';

// define the connection to db old site
    Database::addConnectionInfo('for_migration', 'default', array(
        'driver' => 'mysql',
        'database' => 'db_repininfo_1',
        'username' => 'drupaluser',
        'password' => '',
        'host' => 'localhost',
        'port' => 3306,
        'prefix' => '',
    ));

    $this->map = new MigrateSQLMap($this->machineName,
                    array(
                        'id_page' => array(
                            'type' => 'int',
                            'unsigned' => TRUE,
                            'not null' => TRUE,
                            'description' => 'Content ID',
                        )
                    ),
                    MigrateDestinationNode::getKeySchema(),
                    'for_migration'
    );

    $query = Database::getConnection('default', 'for_migration')
            ->select('sp_cat_' . $this->folder, 'cat');
    $query->join('sp_pages', 'p', 'cat.id_sp = p.id_sp');
    $query->join('urls', 'u', 'p.id_url = u.id_url');
    $query->fields('cat', array('name', 'text', 'short_text', 'id_sp'));
    $query->fields('p', array('id_page', 'date_publish'));
    $query->groupBy('cat.id_sp');
    $query->condition('active', 1);
    $query->condition('url', $this->folder . '%', 'LIKE');
//    $query->range(0, 1);
//    $query->condition('id_page', 3343);

    $this->source = new MigrateSourceSQL($query);
    $this->destination = new MigrateDestinationNode('page');

// Basic fields
    $this->addFieldMapping('title', 'name');
    $this->addFieldMapping('uid')
            ->defaultValue(1);
    $this->addFieldMapping('body', 'text');
    $this->addFieldMapping('body:summary', 'short_text');

// Unmapped destination fields
    $this->addUnmigratedDestinations(array('is_new', 'status', 'promote',
        'revision', 'language', 'sticky', 'revision_uid', 'path', 'created', 'changed'));
  }

  public function prepare(stdClass $node, stdClass $row) {
    // дата создания
    $node->created = strtotime($row->date_publish);

    $node->field_category['und'][0]['tid'] = $this->term_tid;
    $node->body['und'][0]['format'] = 'full_html';

// Сохраняем тэги
    $query = Database::getConnection('default', 'for_migration')
            ->select('sp_pages', 'p');
    $query->join('tags_union', 'tu', 'p.id_page = tu.id_object');
    $query->join('tags', 't', 't.id_tag = tu.id_tag');
    $query->fields('t', array('name'));
    $query->orderBy('tu.id_tag', 'DESC');
    $query->condition('p.id_page', $row->id_page);
    $result = $query->execute();
    $tags = $result->fetchAll();
    if ($tags) {
      foreach ($tags as $tag) {
        $term = taxonomy_get_term_by_name($tag->name, 'tags');
        if (!$term = reset($term)) {
          $term = new stdClass();
          $term->name = $tag->name;
          $term->vid = 1;
          taxonomy_term_save($term);
        }
        $node->field_tags['und'][]['tid'] = $term->tid;
      }
    }

// Сохраняем главную картинку
    if (file_exists('c:/www/repin.info/data/img/' . $this->folder . '/' . $row->id_sp . '.jpg')) {
      $handle = fopen('c:/www/repin.info/data/img/' . $this->folder . '/' . $row->id_sp . '.jpg', 'r');
      $file = file_save_data($handle, 'public://pages/' . $row->id_sp . '.jpg', FILE_EXISTS_RENAME);
      $node->field_img['und'][0] = (array) $file;
      fclose($handle);
    }
// Сохраняем картинки, которые в текстах
    if (preg_match_all('~<a class="(fr|fl) zoomImage" href="([^"]*)"[^>]*><img[^>]*></a>~iUs', $row->text, $matches)) {
      foreach ($matches[2] as $key => $img) {
        $img_name = preg_replace('~^.*/([^/]*\.[^/]*)$~', '$1', $img);
        if (file_exists('c:/www/repin.info/data/img/' . $this->folder . '/' . $img_name)) {
          $handle = fopen('c:/www/repin.info/data/img/' . $this->folder . '/' . $img_name, 'r');
          $file = file_save_data($handle, 'public://pages/' . $img_name, FILE_EXISTS_RENAME);
          fclose($handle);
          $node->field_imgs['und'][] = (array) $file;
// Создаем пресет
          $img_mini = theme('image_style', array('style_name' => 'small_pages',
              'path' => $file->uri,
              'getsize' => FALSE,
              'attributes' => array('class' => array(
                      'image-small-pages',
                      ($matches[1][$key] == 'fr' ) ? 'right' : 'left',
                  )
                  )));
          $a_html = '<a class="colorbox colorbox-insert-image" href="' . file_create_url($file->uri) . '" rel="gallery-all">' . $img_mini . '</a>';
          global $base_url;
          $a_html = str_replace($base_url, '', $a_html);
          $row->text = str_replace($matches[0][$key], $a_html, $row->text);
        }
      }
      $node->body['und'][0]['value'] = $row->text;
    }
  }

}

/**
 * Migration class to importing from mysql into nodes.
 */
class MigrateRepinCrime extends BasicMigrationRepin {

  public function __construct() {
    $this->folder = 'crime';
    $this->term_tid = 1525;
    parent::__construct();
  }

}

/**
 * Migration class to importing from mysql into nodes.
 */
class MigrateRepinMistique extends BasicMigrationRepin {

  public function __construct() {
    $this->folder = 'mistique';
    $this->term_tid = 1526;
    parent::__construct();
  }

}

/**
 * Migration class to importing from mysql into nodes.
 */
class MigrateRepinSecret extends BasicMigrationRepin {

  public function __construct() {
    $this->folder = 'secret';
    $this->term_tid = 1527;
    parent::__construct();
  }

}

class MigrateRepinMystery extends BasicMigrationRepin {

  public function __construct() {
    $this->folder = 'mystery';
    $this->term_tid = 1528;
    parent::__construct();
  }

}

class MigrateRepinSpace extends BasicMigrationRepin {

  public function __construct() {
    $this->folder = 'space';
    $this->term_tid = 1529;
    parent::__construct();
  }

}

class MigrateRepinDarkages extends BasicMigrationRepin {

  public function __construct() {
    $this->folder = 'darkages';
    $this->term_tid = 1530;
    parent::__construct();
  }

}

class MigrateRepinCelebrity extends BasicMigrationRepin {

  public function __construct() {
    $this->folder = 'celebrity';
    $this->term_tid = 1531;
    parent::__construct();
  }

}

class MigrateRepinXfiles extends BasicMigrationRepin {

  public function __construct() {
    $this->folder = 'xfiles';
    $this->term_tid = 1532;
    parent::__construct();
  }

}

class MigrateRepinLosttribes extends BasicMigrationRepin {

  public function __construct() {
    $this->folder = 'losttribes';
    $this->term_tid = 1534;
    parent::__construct();
  }

}

class MigrateRepinAbroad extends BasicMigrationRepin {

  public function __construct() {
    $this->folder = 'abroad';
    $this->term_tid = 1535;
    parent::__construct();
  }

}

class MigrateRepinExotictravel extends BasicMigrationRepin {

  public function __construct() {
    $this->folder = 'exotictravel';
    $this->term_tid = 1536;
    parent::__construct();
  }

}

class MigrateRepinAnimals extends BasicMigrationRepin {

  public function __construct() {
    $this->folder = 'animals';
    $this->term_tid = 1537;
    parent::__construct();
  }

}

class MigrateRepinNational extends BasicMigrationRepin {

  public function __construct() {
    $this->folder = 'national';
    $this->term_tid = 1538;
    parent::__construct();
  }

}

class MigrateRepinNaturejoke extends BasicMigrationRepin {

  public function __construct() {
    $this->folder = 'naturejoke';
    $this->term_tid = 1539;
    parent::__construct();
  }

}

class MigrateRepinSamizdat extends BasicMigrationRepin {

  public function __construct() {
    $this->folder = 'samizdat';
    $this->term_tid = 1541;
    parent::__construct();
  }

}
