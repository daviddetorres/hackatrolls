<?php $this->layout('impact_discover/layout') ?>

<?php $this->section('impact-discover-content') ?>

<?= $this->insert('impact_discover/partials/filters') ?>

<?= $this->insert('impact_discover/partials/sdg_list') ?>

<?= $this->insertIf('impact_discover/partials/map', ['map' => $this->map]); ?>

<?php $this->replace() ?>