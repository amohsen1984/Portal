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
           
           @foreach($property_list as $property)
           
            <article class="list-property">
               <section class="card-body">
                   <div class="list-property-name"><a href="{{ $property['i_property'] }}">{{ $property['address'] }}, {{ $property['city'] }}, {{ $property['code'] }}</a></div>
                   <div class="list-property-seller"><span class="name">Margaret Newcastle</span> <span class="phone">t:0605399231</span> <span class="email">e:<a href="mailto:margatet@gmail.com">margatet@gmail.com</a></span></div>
               </section>
                <footer class="row">
                    <div class="list-status column small-6">{{ $property['status'] }}</div>
                    <div class="list-agents column small-6 text-right"><span class="agent plus">+</span></div>
                </footer>
            </article>
            @endforeach
        </div>
    </section>
    
@stop