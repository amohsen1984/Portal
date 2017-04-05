@extends('layouts.default')

@section('title')
   Eztato - Properties List
@stop

@section('description')
    This is an individual page description
@stop

@section('content')

    <script>

    </script>
    
   <section   ng-app="eztato" ng-controller="listProperties" class="list">
        <div class="row">
            <div class="column medium-6 search">
                <form action="#">
                    <input type="text" placeholder="search property or seller" class="properties-search" ng-enter="GetProperties();" ng-model="filter">
                </form>
            </div>
            <div class="column medium-6 filters">
                <div class="property-filter">
                   <div class="filter-label">Showing: </div>
                   <div class="filter-options">
                       <div class="filter-options-current">all properties</div>
                       <ul class="filter-options-list">
                           <li>all properties</li>
                           <li>unassigned properties</li>
                           <li>my properties</li>
                       </ul>
                   </div>
                   
                </div>
            </div>
        </div>
        <div class="row column">
            <article class="list-property" ng-repeat="property in list">
               <section class="card-body">
                   <div class="list-property-name"><a href="<% URL::asset('/property') %>/{{ property.i_property }}">{{ property.property_address }}, {{ property.property_city }}, {{ property.property_code }}</a></div>
                   
                   <div class="list-property-seller" ng-repeat="seller in property.sellers">
                       <span class="name">{{ seller.seller_first_name}} {{ seller.seller_last_name}}</span> 
                       <span class="phone">t:{{ seller.seller_tel }}</span> 
                       <span class="email">e:<a href="mailto:{{ seller.seller_email }}">{{ seller.seller_emai}}l</a></span>
                    </div>
                   
               </section>
                <footer class="row">
                    <div class="list-status column small-6">{{ property.property_status }}</div>
                    <div class="list-agents column small-6 text-right"><span class="agent plus">+</span></div>
                </footer>
            </article>                
        </div>
    </section>

@stop