<?php
class Pagination
{
    var $page;
    var $page_items;
    var $total_items;
    var $total_pages;
    var $limit;
    var $id;
    function __construct( $page_items = NULL, $page=NULL )
    {
        global $config;
        
        $this->page         = ( isset($_GET['page']) && is_numeric($_GET['page']) ) ? intval($_GET['page']) : 1;
        $this->page         = ( isset($page) && is_numeric($page) ) ? intval($page) : $this->page;
        $this->page         = ( $this->page < 1 ) ? $this->page = 1 : $this->page;
        $this->page_items   = ( isset($page_items) && is_numeric($page_items) ) ? intval($page_items) : intval($config['items_per_page']);
    }
    
    function Pagination( $page_items = NULL, $page=NULL )
    {
        $this->__construct($page_items, $id, $page);
    }
    
    function getLimit( $total_items )
    {
        $this->total_items = ( $total_items == 0 ) ? 1 : $total_items;
        $this->total_pages = ceil($this->total_items/$this->page_items);
        settype($this->total_pages, 'integer');    
        if( $this->page > $this->total_pages )
            $this->page = $this->total_pages;
        $this->limit        = $this->page_items;
        
        if ( $this->page >= 2 )
            $this->limit = ($this->page - 1) * $this->page_items. ', ' .$this->page_items;
        
        return $this->limit;
    }
    
    function getPagination( $base = NULL, $id=NULL, $index = 3)
    {
        global $config, $lang;

        $this->id       = ( isset($id) ) ? $id : NULL;         
        $url            = htmlspecialchars($this->stripPageNew($base), ENT_QUOTES, 'UTF-8');
        $separator      = ( strstr($url, '?') ) ? '&' : '?';
        $output         = array();
        $prev_page      = ( $this->page > 1 ) ? $this->page - 1: 1;
        $next_page      = $this->page+1;
        $tp             = $this->total_pages;
		
        if ( $this->page != 1 )
            $output[]   = '<li><a href="' .$url . $separator. 'page=' .$prev_page. '"' .$this->getID($prev_page, 'prev_page'). '>&laquo;</a></li>';
        if ( $this->total_pages > (($index*2)+3) && $this->page >= ($index+3) ) {
            $output[]   = '<li class="hidden-xs"><a href="' .$url . $separator. 'page=1"' .$this->getID(1). '>1</a></li>';
            $output[]   = '<li class="hidden-xs"><a href="' .$url . $separator. 'page=2"' .$this->getID(2). '>2</a></li>';
        }
        if ( $this->page > $index+3 )
            $output[]   = '<li class="disabled hidden-xs"><span>&nbsp;...&nbsp;</span><li>';
        for ( $i=1; $i<=$this->total_pages; $i++ ) {
            if ( $this->page == $i ) {
                $output[]   = '<li class="active"><span>' .$this->page. '</span></li>';
            } elseif ( ($i >= ($this->page-$index) && $i < $this->page) or ($i <= ($this->page+$index) && $i > $this->page) ) {
                $output[]   = '<li class="hidden-xs"><a href="' .$url . $separator . 'page=' .$i. '"' .$this->getID($i). '>' .$i. '</a></li>';
            }
        }
        
        if ( $this->page < ($this->total_pages-6) )
            $output[]   = '<li class="disabled hidden-xs"><span>&nbsp;...&nbsp;</span><li>';              
        if ( $this->total_pages > (($index*2)+3) && $this->page <= $this->total_pages-($index+3) ) {
            $output[]   = '<li class="hidden-xs"><a href="' .$url . $separator. 'page=' .($this->total_pages-2). '"' .$this->getID(($this->total_pages-2)). '>' .($this->total_pages-2). '</a></li>';
            $output[]   = '<li class="hidden-xs"><a href="' .$url . $separator. 'page=' .($this->total_pages-1). '"' .$this->getID(($this->total_pages-1)). '>' .($this->total_pages-1). '</a></li>';
        }
        if ( $this->page != $this->total_pages )
            $output[]   = '<li><a href="' .$url . $separator. 'page=' .$next_page. '"' .$this->getID($next_page, 'next_page'). ' class="prevnext">&raquo;</a></li>';
        $output_str = replace_page(implode('', $output));
		if ($tp > 1)
        return $output_str;
    }
    
    function getStartItem()
    {
        $start_item = 1;
        if ( $this->page >= 2 )
            $start_item = (($this->page - 1) * $this->page_items)+1;
        if ( $start_item >= $this->total_items )
            $start_item = $this->total_items;
        
        return $start_item;
    }
    
    function getEndItem()
    {
        $end_item = $this->getStartItem();
        $end_item = ($end_item + $this->page_items)-1;
        if ( $end_item >= $this->total_items )
            $end_item = $this->total_items;
        
        return $end_item;
    }
    
    function getAdminPagination( $remove=NULL, $url =NULL, $index =3 )
    {
        $url            = $this->stripPage();
        $url            = ( $remove ) ? str_replace($remove, '', $url) : $url;
        $separator      = ( strstr($url, '?') ) ? '&' : '?';
        $output         = array();
        $prev_page      = ( $this->page > 1 ) ? $this->page - 1: 1;
        $next_page      = $this->page+1;
        
        $output[]   = '<span>Total Items: <b>' .$this->total_items. '</b> - Displaying page <b>' .$this->page. '</b> of <b>' .$this->total_pages. '</b>&nbsp;</span>';
        if ( $this->page != 1 )
            $output[]   = '<a href="' .$url . $separator. 'page=' .$prev_page. '">&laquo;</a>';
        if ( $this->total_pages > (($index*2)+3) && $this->page >= ($index+3) ) {
            $output[]   = '<a href="' .$url . $separator. 'page=1">1</a>';
            $output[]   = '<a href="' .$url . $separator. 'page=2">2</a>';
        }
        if ( $this->page > $index+3 )
            $output[]   = '<span>..</span>';        
        for ( $i=1; $i<=$this->total_pages; $i++ ) {
            if ( $this->page == $i )
                    $output[] = '<a href="' .$url . $separator. 'page=' .$this->page. '" class="active">' .$this->page. '</a>';
            elseif ( ($i >= ($this->page-$index) && $i < $this->page) or ($i <= ($this->page+$index) && $i > $this->page) )
                    $output[]   = '<a href="' .$url . $separator. 'page=' .$i. '">' .$i. '</a>';
        }
        
        if ( $this->page < ($this->total_pages-6) )
            $output[]   = '<span>..</span>';              
        if ( $this->total_pages > (($index*2)+3) && $this->page <= $this->total_pages-($index+3) ) {
            $output[]   = '<a href="' .$url . $separator. 'page=' .($this->total_pages-2). '">' .($this->total_pages-2). '</a>';
            $output[]   = '<a href="' .$url . $separator. 'page=' .($this->total_pages-1). '">' .($this->total_pages-1). '</a>';        
        }
        if ( $this->page != $this->total_pages )
            $output[]   = '<a href="' .$url . $separator. 'page=' .$next_page. '">&raquo;</a>';
        
        return implode('', $output);
    }
    
    function getPage()
    {
        return $this->page;
    }
    
    function getTotalPages()
    {
        return $this->total_pages;
    }
    
    function getID( $page, $add=NULL )
    {
        if ( $this->id != '' ) {
            $id     = ' id="' .$this->id . $page;
            $id    .= ( isset($add) ) ? '_' .$add. '"' : '"';
            return $id;
        }
    }
    
    function stripPageNew( $base )
    {
        global $config;
    
        $query = NULL;
        foreach ( $_GET as $key => $value ) {
            if ( $key != 'page' && $key != 'isMakeHtml') {
                $query .= '&' .$key. '=' .$value;
            }
        }
        
        if ( $query ) {
            $query = '?' .substr($query, 1);
        }
        
        return '/' .$base . $query;
    }
        
    function stripPage()
    {
        global $config;    
    
        $query_string = NULL;
        foreach ( $_GET as $key => $value ) {
            if ( $key != 'page' )
                $query_string .= '&' .$key. '=' .$value;
        }
                        
        return $config['BASE_URL'].$_SERVER['SCRIPT_NAME']. ( $query_string ) ? '?' .substr($query_string, 1) : '';
    }
}
?>
