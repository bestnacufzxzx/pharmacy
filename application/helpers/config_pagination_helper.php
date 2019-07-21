<?php
/**
 * @author   Natan Felles <natanfelles@gmail.com>
 */
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('config_pagination'))
{
	function config_pagination()
	{
		return [
            'full_tag_open'=>'<nav aria-label="Page navigation example"><ul class="pagination mt-3">',
            'full_tag_close'=>'</ul></nav>',
            'cur_tag_open'=>'<li class="page-item active"> <a class="page-link" href="#">',
            'cur_tag_close'=>'<span class="sr-only">(current)</span></a> </li>',
            'attributes' => ['class'=>'page-link'],
            'page_query_string'=>TRUE
        ];
	}
}
