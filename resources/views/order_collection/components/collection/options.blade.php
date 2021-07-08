@isset( $collection_points )

    @php
      $colOpts = $collection_points;
      $counter = 0;
      $pointsOfCollection = $collection_points->groupBy( 'province' );
    @endphp

    @forelse($pointsOfCollection as $key=>$collection_points )
      <details class="row regional-collection-points" @if( $counter === 0 ) open @endif>
        <summary class="px-lg-3 px-0">{{ ucwords( $key ) }}</summary>
        @foreach( $collection_points as $k=>$option)

          @isset( $option )
          <div class="content col-12 local-collection-points mb-lg-3 mb-2" style="border-bottom:1px solid #f0f0f0;">
            <div class="row my-lg-2 my-3">

              <div class="col-auto col-lg-1 mt-1 mt-lg-0 pr-0 pr-lg-3">
                @php
                  $address  = ( isset( $option->address_line_1 ) ) ? $option->address_line_1.', ' : ''; 
                  $address .= ( isset( $option->address_line_2 ) ) ? $option->address_line_2.', ' : '';
                  $address .= ( isset( $option->suburb ) ) ? $option->suburb.', ' : '';
                  $address .= ( isset( $option->city ) ) ? $option->city.', ' : ''; 
                  $address .= ( isset( $option->province ) ) ? $option->province.', ' : '';
                  $address .= ( isset( $option->country ) ) ? $option->country.', ' : '';
                  $address .= ( isset( $option->postal_code ) ) ? $option->postal_code : '';
                @endphp

                <input id="option_{{ $counter }}"
                    data-description="{{ $option->shipping_description }}"
                    data-arrival="{{ $option->shipping_time }}"
                    data-title="{{ $option->shipping_title ?? $option->title }}"
                    data-collection_code="{{ $option->collection_code }}" 
                    data-address="{{ $address }}"
                    type="radio" 
                    name="option"
                    value="{{ number_format( $option->shipping_cost, 2, ".", "" ) }}"
                  required 
                >
                <label for="option_{{ $counter }}"></label>
              </div>

              <div class="col col-lg-2 strong mt-1 mt-lg-0 pl-lg-3 pl-3">
                {{ $option->shipping_title ?? $option->title }}
              </div>
              <div class="col-12 col-lg-4 mt-1 mt-lg-0">
                {{ $option->shipping_description }}
              </div>
              <div class="col-12 col-lg-4 mt-1 mt-lg-0">
                {{ $option->shipping_time }}
              </div>
              <div class="col-12 col-lg-1 mt-1 mt-lg-0">R
                {{ number_format( $option->shipping_cost, 2, ".", "" ) }}
              </div>

              <div class="col-12 offset-0 col-lg-11 offset-lg-1">
                <details class="mt-lg-2 mt-3">
                  <summary>Address & Hours</summary>

                  <div class="content row">
                    <section class="col-12 @isset( $impossible_variable ) col-lg-12 @else col-lg-5 @endisset address">
                      <h4>Physical/Collection Address</h4>
                      <address class="my-lg-2">
                      @isset( $option->address_line_1 )
                        <p>{{ $option->address_line_1 }}, </p>
                      @endisset
                      @isset( $option->address_line_2 )
                        <p>{{ $option->address_line_2 }}, </p>
                      @endisset
                      @isset( $option->suburb )
                        <p>{{ $option->suburb }}, </p>
                      @endisset
                      @isset( $option->city )
                        <p>{{ $option->city }}, </p>
                      @endisset
                      @isset( $option->province )
                        <p>{{ $option->province }}, </p> 
                      @endisset
                      @isset( $option->country )
                        <p>{{ $option->country }}, </p>
                      @endisset
                      @isset( $option->postal_code )
                        <p>{{ $option->postal_code }} </p>
                      @endisset
                      </address>
                    </section>

                    <section class="col-12 col-lg-7 mt-3 mt-lg-0 trading-hours">
                      <h4>Trading/Opening Hours</h4>
                      @isset( $option->trading_hours )
                        {!! $option->trading_hours !!}
                      @endisset
                    </section>

                    @isset( $impossible_variable )
                    <div class="col-12 @isset( $impossible_variable ) col-lg-7 @else col-lg-12 @endisset mt-3 mt-lg-0">
                      @isset( $option->id )
                        <div style="width:100%;height:250px;" class="decollect-maps" id="map_{{ $option->id }}"></div>
                      @endisset
                    </div>
                    @endisset

                  </div>
                </details>

              </div>
            </div>
          </div>                                                    
          @endisset

          @php $counter++; @endphp
        @endforeach

      </details>
    @empty
    @endforelse

@endisset

@php
foreach( ['collection_id', 'address_id', 'shipper', 'shipperOpt'] as $collection_property ) {
  if ( session()->has( $collection_property ) ) {
    session()->forget( $collection_property );
  }
}
@endphp