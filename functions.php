<?php

// Remove as rotas REST API padrão
//remove_action('rest_api_init', 'create_initial_rest_routes', 99);

add_filter('rest_endpoint', function ($endpoints){
  unset($endpoints['/wp/v2/users']);
  unset($endpoints['/wp/v2/users/(?P<id>[\d]+)']);
  return $endpoints;
});


// Define o diretório base do tema
$dirbase = get_template_directory();

// Inclui os arquivos dos endpoints customizados
require_once $dirbase . '/endpoints/user_post.php';
require_once $dirbase . '/endpoints/user_get.php';

require_once $dirbase . '/endpoints/photo_post.php';
require_once $dirbase . '/endpoints/photo_get.php';
require_once $dirbase . '/endpoints/photo_delete.php';

require_once $dirbase . '/endpoints/comment_post.php';
require_once $dirbase . '/endpoints/comment_get.php';

require_once $dirbase . '/endpoints/password.php';

update_option('large_size_w', 1000);
update_option('large_size_h', 1000);
update_option('large_size_crop', 1);


// Muda o prefixo da URL da API REST para 'json'
function change_api() {
  return 'json';
}
add_filter('rest_url_prefix', 'change_api');

// Define o tempo de expiração do token JWT para 24 horas
function expire_token() {
  return time() + (60 * 60 * 24);
}
add_action('jwt_auth_expire', 'expire_token');

?>