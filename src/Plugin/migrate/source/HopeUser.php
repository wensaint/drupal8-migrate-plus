<?php

namespace Drupal\migrate_hopecms_db\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;
use Drupal\migrate\Row;

/**
 * Source plugin for beer user accounts.
 *
 * @MigrateSource(
 *   id = "hope_user"
 * )
 */
class HopeUser extends SqlBase {

  /**
   * {@inheritdoc}   
   */
  public function query() {
    return $this->select('migrate_user', 'mea')
      ->fields('mea', ['UserID', 'UserName', 'RealName', 'UserPassword', 'Email',
                            'Sex', 'RegTime', 'LastLoginTime', 'Status','UpdateTime',
                            'Basic','Course','Academic','Literature','Book','Paper','Awards','Projects','Age','Mobile','Tel']);
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = [
      'UserID' => $this->t('Account ID'),
      'UserName' => $this->t('UserName'),
      'RealName' => $this->t('RealName'),
      'UserPassword' => $this->t('UserPassword'),
      'Email' => $this->t('Email'),
      'Sex' => $this->t('Sex'),
      'RegTime' => $this->t('RegTime'),
      'LastLoginTime' => $this->t('LastLoginTime'),
      'Status' => $this->t('Status'),
      'UpdateTime' => $this->t('UpdateTime'),
      'Status' => $this->t('Status'),
      'Basic' => $this->t('Basic'),
      'Course' => $this->t('Course'),
      'Academic' => $this->t('Academic'),
      'Literature' => $this->t('Literature'),
      'Book' => $this->t('Book'),
      'Paper' => $this->t('Paper'),
      'Awards' => $this->t('Awards'),
      'Projects' => $this->t('Projects'),
      'Age' => $this->t('Age'),
      'Mobile' => $this->t('Mobile'),
      'Tel' => $this->t('Tel'),
    ];

    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    return [
      'UserID' => [
        'type' => 'integer',
        'alias' => 'mea',
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  /*
  public function prepareRow(Row $row) {
    /**
     * prepareRow() is the most common place to perform custom run-time
     * processing that isn't handled by an existing process plugin. It is called
     * when the raw data has been pulled from the source, and provides the
     * opportunity to modify or add to that data, creating the canonical set of
     * source data that will be fed into the processing pipeline.
     *
     * In our particular case, the list of a user's favorite beers is a pipe-
     * separated list of beer IDs. The processing pipeline deals with arrays
     * representing multi-value fields naturally, so we want to explode that
     * string to an array of individual beer IDs.
     */
    /*
    if ($value = $row->getSourceProperty('beers')) {
      $row->setSourceProperty('beers', explode('|', $value));
    }
    /**
     * Always call your parent! Essential processing is performed in the base
     * class. Be mindful that prepareRow() returns a boolean status - if FALSE
     * that indicates that the item being processed should be skipped. Unless
     * we're deciding to skip an item ourselves, let the parent class decide.
     */
    /*
    return parent::prepareRow($row);
  }
  */
}
