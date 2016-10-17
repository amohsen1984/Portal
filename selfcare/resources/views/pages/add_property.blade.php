@extends('layouts.default')

@section('title')
   Eztato - Register new property
@stop

@section('description')
    This is an individual page description
@stop

@section('content')
   
   <div class="row columns">
      {{ $error or '' }}
       <div class="card">
          <form action="{{ route('property_store')}}" method="post">
          {!! csrf_field() !!}
           <div class="card-header"><h1>Register New Property</h1></div>
           <section class="card-body">
           <div class="row column">
               <h3>Property Address</h3>
           </div>
           <div class="row">
               <div class="columns medium-6">
                   <div>
                       <label for="postcode">Post Code:</label>
                       <input type="text" name="postcode" id="postcode">
                   </div>
                   <div>
                       <label for="address">Address:</label>
                       <input type="text" name="address" id="address">
                   </div>
                   <div>
                       <label for="city">City:</label>
                       <input type="text" name="city" id="city">
                   </div>
               </div>
               
               <div class="columns medium-6">
                   <div>
                       <label for="state">County:</label>
                       <input type="text" name="state" id="state">
                   </div>
                   <div>
                       <label for="country">Country:</label>
                       <input type="text" name="country" value="United Kingdom" id="country">
                   </div>
               </div>
           </div>
            <div class="row column">
                <h3>Property Details</h3>
            </div>
            <div class="row">
                <div class="columns medium-6">
                    <div>
                       <label for="type">Type: </label> 
                       <select name="type" id="type" >
                           <option>Apartment</option>
                           <option>Terrace</option>
                           <option>Semi-detached</option>
                           <option>Detached</option>
                       </select>
                   </div>
                   <div>
                       <label for="price">Asking Price:</label>
                        <input type="text" name="price" value="">
                   </div>
                   <div>
                       <label for="floors">Floors:</label>
                       <input id="floors" type="number" value="1">
                   </div>
                   <div>
                       <label for="bedrooms">Bedrooms:</label>
                       <input id="bedrooms" type="number" value="2">
                   </div>
                </div>
                <div class="columns medium-6">
                    <div>
                       <label for="bathrooms">Bathrooms:</label>
                       <input id="bathrooms" type="number" value="2">
                   </div>
                   <div>
                        <label for="reception">Reception Rooms:</label>
                        <input id="reception" type="number" value="1">
                   </div>
                   <div>
                        <label for="new">New Build:</label>
                        <select name="new" id="new">
                           <option>Yes</option>
                           <option>No</option>
                       </select>
                   </div>
                   <div>
                        <label for="chain">Part of Chain:</label>
                        <select name="chain" id="chain">
                           <option>Yes</option>
                           <option>No</option>
                       </select>
                   </div>
                </div>
            </div>
            <div class="row column">
                <h3>Property Description</h3>
                <div class="property-description-editor">
                       <textarea name="description" id="" cols="30" rows="10">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Praesentium exercitationem, assumenda provident distinctio. Animi harum repellat doloribus, maiores! Et id, praesentium rerum numquam esse enim. Quasi ex recusandae quod? Aliquam. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit nihil et, eaque rem dolorum, culpa repudiandae repellendus provident aperiam, tempore error. Doloremque quaerat, deserunt a eos placeat tempora, ad numquam. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam assumenda totam molestias, veniam, nam ipsum hic, corporis quis adipisci nihil saepe maiores? Voluptatem ea explicabo inventore exercitationem odio, recusandae quaerat. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste facilis molestias neque quaerat dolores illum, dignissimos doloremque possimus amet optio nemo quis officia quibusdam, veritatis aliquam, placeat harum totam dolorum.
                       </textarea>
                </div>
            </div>       
        </section>
        <footer>
            <div class="button-main-group">
                <button type="submit" class="small-button disable-editing" data-for="property">Add Property</button>
            </div>
        </footer>
       </form>
       </div>
   </div>
    
@stop