$(document).foundation();
$(document).ready(function(){
    
    $('html').click(function() {
        $('.filter-options-list').hide();
    });
    
    $('.filter-options-current').click(function() {
        event.stopPropagation();
        $(this).next().toggle(); 
    });
})