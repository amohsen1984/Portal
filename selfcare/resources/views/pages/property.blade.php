@extends('layouts.default')

@section('title')
   Eztato - Properties List
@stop

@section('description')
    This is an individual page description
@stop

@section('content')
   
   <div class="row column">
            <article class="property">
               <div class="card-header">
                   <div class="property-name">{{ $property['property_address'] }}, {{ $property['property_city'] }}, {{ $property['property_code'] }}</div>
               </div>
                <section class="card-body">
                   <div class="property-meta">
                       <b>Characteristics:</b>
                       <div>
                           <label for="type">Type: </label> 
                           <select name="type" id="type"  disabled="disabled">
                               <option {{ ($property['property_type'] == "Apartment" ? 'selected="selected"':'') }}>Apartment</option>
                               <option {{ ($property['property_type'] == "Terrace" ? 'selected="selected"':'') }}>Terrace</option>
                               <option {{ ($property['property_type'] == "Semi-detached" ?  'selected="selected"':'') }}>Semi-detached</option>
                               <option {{ ($property['property_type'] == "Detached" ? 'selected="selected"':'') }}>Detached</option>
                           </select>
                       </div>
                       <div>
                           <label for="price">Asking Price:</label>
                            <input name="price" type="text" value="{{ $property['property_price'] }}" disabled="disabled">
                       </div>
                       <div>
                           <label for="floors">Floors:</label>
                           <input id="floors" name="floors" type="number" value="{{ $property['property_floors'] }}" disabled="disabled">
                       </div>
                       <div>
                           <label for="bedrooms">Bedrooms:</label>
                           <input id="bedrooms" name="bedrooms" type="number" value="{{ $property['property_bedrooms'] }}" disabled="disabled">
                       </div>
                       <div>
                           <label for="bathrooms">Bathrooms:</label>
                           <input id="bathrooms" name="bathrooms" type="number" value="{{ $property['property_bathrooms'] }}"  disabled="disabled">
                       </div>
                       <div>
                            <label for="reception">Reception Rooms:</label>
                            <input id="reception" name="receptions" type="number" value="{{ $property['property_reception_rooms'] }}"  disabled="disabled">
                       </div>
                       <div>
                            <label for="new">New Build:</label>
                            <select name="new" id="new" disabled="disabled">
                               <option {{ ($property['property_new_built'] == "Yes" ? 'selected="selected"':'') }}>Yes</option>
                               <option {{ $property['property_new_built'] == "No" ? 'selected="selected"':''}}>No</option>
                           </select>
                       </div>
                       <div>
                            <label for="chain">Part of Chain:</label>
                            <select name="chain" id="chain" disabled="disabled">
                               <option  {{ ($property['property_chain'] == "Yes" ? 'selected="selected"':'') }}>Yes</option>
                               <option {{ ($property['property_chain'] == "No" ? 'selected="selected"':'') }}>No</option>
                           </select>
                       </div>
                   </div>
                   <div class="property-description">
                       <b>Description:</b>
                       <div class="property-description-editor">
                           <textarea name="description" id="" cols="30" rows="10" disabled="disabled">{{ $property['property_description'] }}
                           </textarea>
                       </div>
                   </div>
                   <div class="property-status">{{$property['property_status']}}</div>
                </section>
                <footer>
                    <div>
                        <a href="#" class="small-button gray-button enable-editing" data-for="property">Edit Property</a>
                    </div>
                    <div>
                        <a href="#" class="small-button gray-button disable-editing" data-for="property">Cancel</a>
                        <a href="#" class="small-button disable-editing" data-for="property">Save Changes</a>
                    </div>
                </footer>
            </article>
            
            <section class="offers">
            <article class="offer">
                <div class="card">
                   <header>
                       <div class="offer-price">£160,000</div>
                       <div class="offer-buyer">James Jones</div>
                   </header>
                   <div class="card-body">
                       <ul class="offer-details">
                        <li class="offer-position">Buying Position: <span class="green">Cash Buyer</span></li>
                        <li class="offer-financial-position">Financial Position: <span class="green">Approved</span></li>
                        <li class="offer-moving-day">Moving Day: <span class="green">Anytime</span></li>
                    </ul>
                    </div>
                    <div class="card-body">
                        <div class="column small-6 text-right">
                            <a href="#" class="small-button red-button">Reject</a>
                        </div>
                        <div class="column small-6 text-left">
                            <a href="#" class="small-button">Accept</a>
                        </div>
                    </div>
                </div>
            </article>
            <article class="offer">
                <div class="card">
                   <header>
                       <div class="offer-price">£190,000</div>
                       <div class="offer-buyer">Sara Jones</div>
                   </header>
                    <div class="card-body">
                        <ul class="offer-details">
                            <li class="offer-buying-position">Buying Position: <span class="bold">Seller</span></li>
                            <li class="offer-financial-position">Financial Position: <span class="green">Approved</span></li>
                            <li class="offer-moving-day">Moving Day: <span class="bold">15 September</span></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="column small-6 text-right">
                            <a href="#" class="small-button red-button">Reject</a>
                        </div>
                        <div class="column small-6 text-left">
                            <a href="#" class="small-button">Accept</a>
                        </div>
                    </div>
                </div>
            </article>
        </section>
        <section class="viewings">
            <article class="viewing" id="8123">
                <div class="card">
                    <div class="card-body">
                        <div class="viewing-icon"><img src="img/icon-profile.png" alt=""></div>
                        <div class="viewing-meta">
                            <div class="viewing-details-time">
                                <datetime><b>Thursday</b> 24/07/2016  12:45</datetime>
                            </div>
                            <div class="viewing-details-details">
                                Jessica Stone, first time buyer looking for a property in the area
                            </div>
                        </div>
                     </div>
                     <div class="card-body viewing-comments">
                        <textarea name="new-comment" class="viewing-comments-add"></textarea>
                     </div>
                    <footer>
                    <div class="button-main-group">
                        <a href="#" class="small-button gray-button">Cancel Viewing</a>
                        <a href="#" class="small-button gray-button show-comment" data-for="8123">Add Comment</a>
                    </div>
                    <div class="button-comment-group">
                        <a href="#" class="small-button gray-button hide-comment" data-for="8123">Cancel</a>
                        <a href="#" class="small-button hide-comment" data-for="8123">Post</a>
                    </div>
                    </footer>
                </div>
            </article>
            <article class="viewing" id="8111">
                <div class="card">
                    <div class="card-body">
                        <div class="viewing-icon"><img src="img/icon-profile.png" alt=""></div>
                        <div class="viewing-meta">
                            <div class="viewing-details-time">
                                <datetime><b>Thursday</b> 24/07/2016  12:45</datetime>
                            </div>
                            <div class="viewing-details-details">
                                James Jones, landlord looking for more flats in the area.
                            </div>
                        </div>
                     </div>
                     <div class="card-body viewing-comments">
                        <div class="viewing-comment">
                           <div class="comment-content">
                               <p>Mr. Jones really liked the flat, but not soo keen on price.</p>
                           </div>
                            <div class="comment-meta">
                                <span class="comment-meta-author">Lukasz Gladki</span>
                                <span class="comment-meta-date">22/09/2016</span>
                            </div>
                        </div>
                         <div class="viewing-comment">
                           <div class="comment-content">
                               <p>Shame, price isn't really negotiable.</p>
                           </div>
                            <div class="comment-meta">
                                <span class="comment-meta-author">Sam Moore</span>
                                <span class="comment-meta-date">22/09/2016</span>
                            </div>
                        </div>
                        <textarea name="new-comment" class="viewing-comments-add"></textarea>
                     </div>
                    <footer>
                    <div class="button-main-group">
                        <a href="#" class="small-button gray-button">Cancel Viewing</a>
                        <a href="#" class="small-button gray-button show-comment" data-for="8111">Add Comment</a>
                    </div>
                    <div class="button-comment-group">
                        <a href="#" class="small-button gray-button hide-comment" data-for="8111">Cancel</a>
                        <a href="#" class="small-button hide-comment" data-for="8111">Post</a>
                    </div>
                    </footer>
                </div>
            </article>
            </section>
</div>
    
@stop