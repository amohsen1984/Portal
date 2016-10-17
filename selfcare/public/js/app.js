(function($) {
    $.fn.toggleDisabled = function(){
        return this.each(function(){
            this.disabled = !this.disabled;
        });
    };
})(jQuery);
$(document).foundation();
$(document).ready(function(){
    $(".disable-editing").hide();
    $(".enable-editing").show();  
    
    $('html').click(function() {
        $('.filter-options-list').hide();
    });
    
    $('.filter-options-current').click(function() {
        event.stopPropagation();
        $(this).next().toggle(); 
    });
    
    $('.enable-editing').click(function() { 
        var target = $( this ).data( "for" );
        $("."+target).find("input, select, textarea").prop('disabled', false);
        $(".enable-editing").hide();
        $(".disable-editing").show();
    });
    
    $('.disable-editing').click(function() {
        var target = $( this ).data( "for" );
        console.log(target);
        $("."+target).find("input, select, textarea").prop('disabled', true);
        $(".disable-editing").hide();
        $(".enable-editing").show();
    });
    
    $('.show-comment').click(function() { 
        var target = "#" + $( this ).data( "for" );
        $(target).find("textarea, input").show();
        $(target + " .button-main-group").hide();
        $(target + " .button-comment-group").show();
    });
    
    $('.hide-comment').click(function() { 
        var target = "#" + $( this ).data( "for" );
        $(target).find("textarea, input").hide();
        $(target + " .button-main-group").show();
        $(target + " .button-comment-group").hide();
    });
    
    
})