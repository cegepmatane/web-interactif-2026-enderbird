<h3>Articles récents</h3>
<ul>
  <?php wp_get_archives([
    'type'  => 'postbypost',
    'limit' => 5
  ]); ?>
</ul>