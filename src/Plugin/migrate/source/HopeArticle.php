<?php

namespace Drupal\migrate_hopecms_db\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;
use Drupal\migrate\Row;

/**
 * Source plugin for beer content.
 *
 * @MigrateSource(
 *   id = "hope_article"
 * )
 */
class HopeArticle extends SqlBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    /**
     * An important point to note is that your query *must* return a single row
     * for each item to be imported. Here we might be tempted to add a join to
     * migrate_example_beer_topic_node in our query, to pull in the
     * relationships to our categories. Doing this would cause the query to
     * return multiple rows for a given node, once per related value, thus
     * processing the same node multiple times, each time with only one of the
     * multiple values that should be imported. To avoid that, we simply query
     * the base node data here, and pull in the relationships in prepareRow()
     * below.
     */
    $query = $this->select('migrate_article', 'b')
                 ->fields('b', ['GeneralID', 'NodeID', 'Title', 'SubTitle', 'Author',
                   'Hits', 'Inputer','DefaultPicUrl', 'InputTime', 'UpdateTime','Priority','URLRedirect','Content']);
    return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = [
      'GeneralID' => $this->t('Beer ID'),
      'NodeID' => $this->t('Name of beer'),
      'Title' => $this->t('Full description of the beer'),
      'SubTitle' => $this->t('Abstract for this beer'),
      'Author' => $this->t('Account ID of the author'),
      'Hits' => $this->t('Countries of origin. Multiple values, delimited by pipe'),
      'Inputer' => $this->t('Image path'),
      'DefaultPicUrl' => $this->t('Image ALT'),
      'InputTime' => $this->t('InputTime'),
      'UpdateTime' => $this->t('UpdateTime'),
      // Note that this field is not part of the query above - it is populated
      // by prepareRow() below. You should document all source properties that
      // are available for mapping after prepareRow() is called.
      'Priority' => $this->t('Priority'),
      'URLRedirect' => $this->t('URLRedirect'),
      'Content' => $this->t('Content'),
    ];

    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    return [
      'GeneralID' => [
        'type' => 'integer',
        'alias' => 'b',
      ],
    ];
  }

  /**
   * {@inheritdoc}
  */
  
  public function prepareRow(Row $row) {
    /**
     * As explained above, we need to pull the style relationships into our
     * source row here, as an array of 'style' values (the unique ID for
     * the beer_term migration).
     */  
    /*  
    $terms = $this->select('migrate_example_beer_topic_node', 'bt')
                 ->fields('bt', ['style'])
      ->condition('bid', $row->getSourceProperty('bid'))
      ->execute()
      ->fetchCol();
    $row->setSourceProperty('terms', $terms);
    */

    // decode content
    if ($value = $row->getSourceProperty('Content')) {
      $row->setSourceProperty('Content', html_entity_decode($value));
    }
    return parent::prepareRow($row);
  }  
}
