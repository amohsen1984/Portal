@extends('layouts.default')

@section('title')
   Eztato - Properties List
@stop

@section('description')
    This is an individual page description
@stop

@section('content')
   
   <section class="list">
        <div class="row">
            <div class="column medium-6 search">
                <form action="#">
                    <input type="text" placeholder="search property or seller" class="properties-search">
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
           @if(is_array($property_list))
           @foreach($property_list as $property)
            <article class="list-property">
               <section class="card-body">
                   <div class="list-property-name"><a href="{{ URL::asset('/property') }}/{{ $property['i_property'] }}">{{ $property['property_address'] }}, {{ $property['property_city'] }}, {{ $property['property_code'] }}</a></div>
                   
                   @foreach($property['Sellers'] as $seller)
                   <div class="list-property-seller">
                       <span class="name">{{ $seller['seller_first_name'] or '' }} {{ $seller['seller_last_name'] or ''}}</span> 
                       <span class="phone">t:{{ $seller['seller_tel'] or '' }}</span> 
                       <span class="email">e:<a href="mailto:{{ $seller['seller_email'] or '' }}">{{ $seller['seller_email'] or '' }}</a></span>
                    </div>
                   @endforeach
                   
               </section>
                <footer class="row">
                    <div class="list-status column small-6">{{ $property['property_status'] }}</div>
                    <div class="list-agents column small-6 text-right"><span class="agent plus">+</span></div>
                </footer>
            </article>                
            @endforeach
            @else
            <div class="empty-alert">No Properties</div>
            @endif
        </div>
    </section>
    
@stop