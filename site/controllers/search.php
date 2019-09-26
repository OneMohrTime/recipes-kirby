<?php

return function ($site) {

  $query   = get('q');
  $results = $site->index()->search($query, 'title|text|ingredients');
  $results = $results->paginate(20);

  return [
    'query'      => $query,
    'results'    => $results,
    'pagination' => $results->pagination()
  ];

};