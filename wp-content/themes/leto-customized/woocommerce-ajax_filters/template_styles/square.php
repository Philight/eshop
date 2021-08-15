<?php
if( ! class_exists('BeRocket_AAPF_Template_Style_example') ) {
    class BeRocket_AAPF_Template_Style_example extends BeRocket_AAPF_Template_Style {
        function __construct() {
            $this->data = array(
                'slug'          => 'square',
                'template'      => 'checkbox',
                'name'          => 'Square',
                'file'          => __FILE__,
                'style_file'    => 'css/square.css',
                'script_file'   => '',
                'image'         => plugin_dir_url( __FILE__ ) . 'images/square.png',
                'version'       => '1.0',
                'name_price'    => 'Price Ranges Square',
                'image_price'   => plugin_dir_url( __FILE__ ) . 'paid/images/square-price.png',
            );
            parent::__construct();
        }
        function template_full($template, $terms, $berocket_query_var_title) {
            $this->array_set($template, array('template', 'attributes', 'class'));
            $template['template']['attributes']['class'][] = 'bapf_ckbox_square';
            return $template;
        }

        function template_single_item($template, $term, $i, $berocket_query_var_title) {
            $template['content']['checkbox']['attributes']['style']['display'] = 'display:none;';

            $template['content']['label']['content'] = array(
                'filter-btn-wrapper'    => array(
                    'type'                  => 'tag',
                    'tag'                   => 'div',
                    'attributes'            => array(
                        'class'                 => array(
                            'main'              => 'filter-btn-wrapper',
                        )
                    ),    
                    'content'           => array(    
                        'filter-btn-span'   => array(
                            'type'              => 'tag',
                            'tag'               => 'span',
                            'attributes'        => array(
                                'class'             => array(
                                    'main'              => 'filter-btn-span',
                                ),

                            ),
                            'content'   => array(
                                'name' => $term->name
                            )
                        ),  
                    )
                )
            );
            return $template;
        }
    }
    new BeRocket_AAPF_Template_Style_example();
}
