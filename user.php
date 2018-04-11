<?php
define('_VALID', true);
require 'include/config.php';
require 'include/function_smarty.php';
require 'include/function_user.php';
$template   = 'user';
$options    = getUserQuery();
$uid = $options['uid'];
$username   = urldecode($options['username']);
$module     = $options['module'];
if ( !$username ) {
    require 'classes/auth.class.php';
    $auth   = new Auth();
    $auth->check();
}

$cache_opt = array(
    'host'=>$config['mem_host'],
    'port'=>$config['mem_port'],
    'prefix'=>'puc',
    'expire'=>600,
    'length'=>0
);
$public_cache = Cache::getInstance('MemcacheAction',$cache_opt);

$user = $public_cache -> get($uid);
if (!$user) {
    $sql    = "SELECT * FROM signup WHERE UID = {$uid} LIMIT 1";
    $rs     = $conn->execute($sql);
    $user   = $rs->getrows();
    $user   = $user['0'];
    $public_cache->set($uid,$user);
}
if ( !$user ) {
    VRedirect::go($config['BASE_URL']. '/error/user_missing');
}

$key = 'online_'.$uid;
$users_online = $public_cache->get($key);
if (!$users_online) {
    $sql        = "SELECT * FROM users_online WHERE UID = {$uid} AND online > " .(time()-300). " LIMIT 1";
    $rs     = $conn->execute($sql);
    $users_onlines   = $rs->getrows();
    $users_online   = $users_onlines['0'];
    $public_cache->set($key,$users_online,300);
}
if ( $users_online )
	$online = true;
else
	$online = false;

if ( $options['module'] != '' ) {
    $profile_menu  = $module;
    $template       = 'user_' .$module;
    require 'modules/user/' .$module. '.php';
} else {
    $options    = getUserModule($options['query']);
    $module     = $options['module'];
    if ( !$module == '' ) {
        if ( $module == 'favorite' ) {
            $submodules_allowed = array('videos', 'photos', 'games');
            if ( isset($options['query']['0']) && in_array($options['query']['0'], $submodules_allowed) ) {
                $submodule  = $options['query']['0'];
                $template   = 'user_favorite_' .$submodule;
                require 'modules/user/favorite_' .$submodule. '.php';
            } else {
                session_write_close();
                header('Location: ' .$config['BASE_URL']. '/error/invalid_module');
                die();
            }
        } else {
            $template = 'user_' .$module;
            require 'modules/user/' .$module. '.php';
        }
    } else {
        $prefs          = get_user_prefs($uid);
        $is_friend      = is_friend($uid);
        $friends        = get_user_friends($uid, $prefs['show_friends'], $is_friend);
        $playlist       = get_user_playlist($uid, $prefs['show_playlist'], $is_friend);
        $favorites      = get_user_favorites($uid, $prefs['show_favorites'], $is_friend);
        $subscriptions  = get_user_subscriptions($uid, $prefs['show_subscriptions'], $is_friend);
        $subscribers    = get_user_subscribers($uid, $prefs['show_subscribers'], $is_friend);
        $albums         = get_user_albums($uid);
        $photos         = get_user_favorite_photos($uid, $prefs['show_favorites'], $is_friend);
        $favorite_games          = get_user_favorite_games($uid, $prefs['show_favorites'], $is_friend);

        $show_wall      = false;
        $wall_public    = $prefs['wall_public'];
        $walls          = array();
        $walls_total    = 0;
        if ( $wall_public == '1' ) {
            $show_wall  = true;
        } else {
            if ( $is_friend ) {
                $show_wall  = true;
            } elseif ( isset($_SESSION['uid']) && $_SESSION['uid'] == $uid ) {
                $show_wall  = true;
            }
        }
        
        if ( $show_wall ) {
            $page = intval($_GET['page']);
            $key = 'wall_'.$uid."_".$page;
            $walls_arr = array();
            $walls_arr = $public_cache->get($key);
            if (empty($walls_arr)) {
                require 'classes/pagination.class.php';
                $sql            = "SELECT COUNT(wall_id) AS total_walls FROM wall WHERE OID = " .$uid. " AND status = '1'";
                $rsc            = $conn->CacheExecute(3000,$sql);
                $walls_total    = $rsc->fields['total_walls'];
                $pagination     = new Pagination(10);
                $limit          = $pagination->getLimit($walls_total);
                $sql            = "SELECT w.wall_id, w.UID, w.message, w.addtime, u.username, u.photo, u.gender
                               FROM wall AS w, signup AS u WHERE w.OID = " .$uid. " AND w.status = '1' AND w.UID = u.UID
                                               ORDER BY w.addtime DESC LIMIT {$limit}";
                $rs             = $conn->CacheExecute(3000,$sql);
                $walls          = $rs->getrows();
                $walls_arr['walls'] = $walls;
                $page_link      = $pagination->getPagination('user/' .$username, 'p_wall_comments_' .$uid. '_');
                $walls_arr['page_link'] = $page_link;
                $start_num      = $pagination->getStartItem();
                $walls_arr['start_num'] = $start_num;
                $end_num        = $pagination->getEndItem();
                $walls_arr['end_num'] = $end_num;
                $public_cache->set($key,$walls_arr,300);
            }
            if (!empty($walls_arr)) {
                $walls = $walls_arr['walls'];
                $page_link = $walls_arr['page_link'];
                $start_num = $walls_arr['start_num'];
                $end_num = $walls_arr['end_num'];
            }
			
            $smarty->assign('page_link', $page_link);
			$smarty->assign('start_num', $start_num);
			$smarty->assign('end_num', $end_num);
			unset($walls_arr);
        }
        
        $blog           = array();
        $key = 'blog_'.$uid;
        $blog = $public_cache->get($key);
        if (!$blog) {
            $sql            = "SELECT BID, UID, title, content, total_views, total_comments, addtime
                               FROM blog WHERE UID = " .$uid. " AND status = '1'
                               ORDER BY addtime DESC LIMIT 1";
            $rs             = $conn->CacheExecute(3000,$sql);
            if ( $conn->Affected_Rows() == 1 ) {
                $blog       = $rs->getrows();
                $blog       = $blog['0'];
    			$blog['content'] = blog_output($blog['content']);
    			$public_cache->set($key,$blog);
            }
        }
        $sql            = "UPDATE signup SET profile_viewed = profile_viewed+1, popularity = popularity+0.1 WHERE UID = " .$uid. " LIMIT 1";
        $conn->execute($sql);
          
        $self_title         = $username. '\' Profile - Free Adult Sex Tube Porno';
      
        $smarty->assign('friends', $friends);
        $smarty->assign('playlist', $playlist);
        $smarty->assign('favorites', $favorites);
        $smarty->assign('subscriptions', $subscriptions);
        $smarty->assign('subscribers', $subscribers);
        $smarty->assign('videos', get_user_videos($uid));
        $smarty->assign('games', get_user_games($uid));
        $smarty->assign('show_wall', $show_wall);
        $smarty->assign('walls', $walls);
        $smarty->assign('walls_total', $walls_total);
        $smarty->assign('albums', $albums);
        $smarty->assign('blog', $blog);
        $smarty->assign('photos', $photos);
        $smarty->assign('favorite_games', $favorite_games);
    }
}

$self_title = ( isset($self_title) ) ? $self_title . ' - ' .$config['site_name'] : $config['site_name'];

$smarty->assign('errors',$errors);
$smarty->assign('messages',$messages);
$smarty->assign('menu', 'community');
$smarty->assign('submenu', '');
$smarty->assign('username', $username);
$smarty->assign('user', $user);
$smarty->assign('online', $online);
$smarty->assign('popularity', '$popularity');
$smarty->assign('points', '$points');
$smarty->assign('profile', true);
$smarty->assign('self_title', $self_title);
$smarty->display('header.tpl');
if ( isset($profile_menu) ) {
    $smarty->assign('profile_menu', $profile_menu);
    $smarty->display('user_profile_menu.tpl');
}
$smarty->display('errors.tpl');
$smarty->display('messages.tpl');
$smarty->display($template. '.tpl');
$smarty->display('footer.tpl');
$smarty->gzip_encode();
?>
