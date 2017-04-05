//define angular module 
var app = angular.module("eztato", []);

//ng-enter directive
angular.module('eztato').directive('ngEnter', function() {
    return function(scope, element, attrs) {
        element.bind("keydown keypress", function(event) {
            if(event.which === 13) {
                scope.$apply(function(){
                    scope.$eval(attrs.ngEnter, {'event': event});
                });

                event.preventDefault();
            }
        });
    };
});


//list properties controller in angular
app.controller("listProperties", listProperties);
function listProperties ($scope, $http){

    $scope.filter = "";
    $scope.list = [];

    $scope.GetProperties = function () {
        
        //api credential
        var api_info = { url: "http://local-portal/ES_Portal/api/public/index.php/" + "property" };

        // use $.param jQuery function to serialize data from JSON 
        var data = $.param({
        });


        //if filter is not empty
        if($scope.filter != "") {

            data = $.param({
                property_address: "contain(" + $scope.filter + ")",
                property_code: "contain(" + $scope.filter + ")",
            });
        }
    
        //config
        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded',
                'CUSTOMER': '1'
            },
        };

        
        //$(".se-pre-con").fadeIn("slow");
        $http.get(api_info.url + "?" + data,  config)
        .then(function (response) {
            //$(".se-pre-con").fadeOut("slow");
            console.log(response);
            $scope.list = response.data;

        });
    };

     $scope.GetProperties(); 
};  

(function($) {
    $.fn.toggleDisabled = function(){
        return this.each(function(){
            this.disabled = !this.disabled;
        });
    };


})(jQuery);
//$(document).foundation();
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