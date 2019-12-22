<?php
use Kirby\Toolkit\Query;
Kirby::plugin('vitamin2/retrotree', [
    'sections' => [
        'retrotree' => [
            'props' => [
                 'headline' => function ($headline = 'Retro Tree') {
                     return $headline;
                 },
                 'treeMaxDepth' => function($treeMaxDepth = 3) {
                     return $treeMaxDepth;
                 },
                 'showContent' => function($query = 'site') {
                     return $query;
                 },
                 'showStatus' => function($showStatus = true) {
                     return $showStatus;
                 },
                 'showSlug' => function($showSlug = true) {
                     return $showSlug;
                 },
                 'treeEndMessage' => function($treeEndMessage = 'no more entries') {
                     return $treeEndMessage;
                 },
                 'showPageIcon' => function($showPageIcon = false) {
                     return $showPageIcon;
                 },
                 'treeDefaultIcon' => function($treeDefaultIcon = 'page') {
                     return $treeDefaultIcon;
                 }
             ],
            'computed' => [

                'tree' => function () {
                  $kirby = new Kirby();

                  if ($this->showContent === "site") {
                    $data = $kirby->site()->pages();
                  }else if ($this->showContent === "page") {
                    $query = new Query($this->showContent,[ 'page' => $this->model()]);
                    $page = $query->result();
                    $data = $kirby->site()->find($page)->childrenAndDrafts();
                  }else{
                    $data = $kirby->site()->pages();
                  }

                  function generateList($data){
                    $list=[];
                    foreach($data as $page) {
                      $list[] = [
                        'url'   => (string)$page->url(),
                        'title' => (string)$page->title(),
                        'panel' => $page->panelUrl(),
                        'slug' => $page->slug(),
                        'status' => $page->status(),
                        'icon' => $page->panelIcon(),
                        'child' => generateList($page->childrenAndDrafts()),
                        'depth' => $page->depth(),
                      ];
                    }
                    return $list;
                  }
                  $json = generateList($data);
                  $jsonOutput[] = [
                      'data' => $json,
                  ];
                  return $jsonOutput;
                },
            ]
        ]
    ]
]);
