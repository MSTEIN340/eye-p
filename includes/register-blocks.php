<?php

function up_register_blocks() {

    /* Note! These are path names to block.json files, not block names.
    Path Names are CASE SENSITIVE in Linux, so if you do this wrong it will work
    in WAMP but not in LAMP.
    */
    $blocks = [


    ];

    foreach($blocks as $block) {

        $str = ((UP_PLUGIN_DIR  . 'build/blocks/' . $block['name']));
        //echo $str;
        register_block_type(
            $str, // Add the namespace to the block name
            isset($block['options']) ? $block['options'] : []
        ); // Only registers Options if they are present.
    }
}