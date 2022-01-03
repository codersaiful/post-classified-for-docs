jQuery(function ($) {
    'use strict';
    $(document).ready(function () {
        
        console.log( WPPCD_DATA );


        $('.widget .each-taxonomy-item-wrapper').not('.wppcd-active-taxonomy-wrapper').each(function(){
            $(this).addClass('collapse-able');
            $(this).attr('data-status','collapsed');
        });
        
        $('.widget .each-taxonomy-item-wrapper').each(function(){
            let post_count = $(this).find('ul.item-list').data('post_count');
            $(this).find('h3.item-heading').append('<span class="wppcd-only-login-user" title="Taxonomy ID"> ( ' + post_count + ' ) </span>');
        });

        $(document.body).on('click','.widget .each-taxonomy-item-wrapper.collapse-able h3.item-heading',function(){
            let wrapper = $(this).closest('.collapse-able');
            let items = wrapper.find('ul.item-list');
            let status = wrapper.attr('data-status');
            if( status == 'collapsed' ){
                wrapper.attr('data-status','opened');
                items.fadeIn('fast');
            }else{
                wrapper.attr('data-status','collapsed');
                items.fadeOut('fast');
            }
        });

    });
});
