
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
                <input id="option_{{ $counter }}"
                    data-description="{{ $option->shipping_description }}"
                    data-arrival="{{$option->shipping_time }}"
                    data-title="{{$option->shipping_title }}"
                    data-collection_code="{{$option->collection_code }}" 
                    data-address="@isset( $option->address_line_1 ){{ $option->address_line_1 }},@endisset @isset( $option->address_line_2 ){{ $option->address_line_2 }},@endisset {{ $option->suburb }}, {{ $option->city }}, {{ $option->province }}, {{ $option->country }}, {{ $option->postal_code }}"
                    type="radio" 
                    name="option"
                    value="{{ number_format( $option->shipping_cost, 2, ".", "" ) }}"
                    required 
                >
                <label for="option_{{ $counter }}"></label>
              </div>
              <div class="col col-lg-2 strong mt-1 mt-lg-0 pl-lg-3 pl-3">
                {{ $option->shipping_title }}
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
                    <div class="col-12 col-lg-5">
                      <address>
                      @isset( $option->address_line_1 )
                        {!! $option->address_line_1 !!}, <br>
                      @endisset
                      @isset( $option->address_line_2 )
                        {!! $option->address_line_2 !!}, <br>
                      @endisset
                      @isset( $option->suburb )
                        {!! $option->suburb !!},  <br>
                      @endisset
                      @isset( $option->city )
                        {!! $option->city !!}, <br>
                      @endisset
                      @isset( $option->province )
                        {!! $option->province !!}, <br> 
                      @endisset
                      @isset( $option->country )
                        {!! $option->country !!}, <br>
                      @endisset
                      @isset( $option->postal_code )
                        {!! $option->postal_code !!}
                      @endisset
                      </address>
                      @isset( $option->trading_hours )
                      {!! $option->trading_hours !!}
                      @endisset
                    </div>

                    <div class="col-12 col-lg-7 mt-3 mt-lg-0">
                    @isset( $option->id )
                      <div style="width:100%;height:250px;" class="decollect-maps" id="map_{{ $option->id }}"></div>
                    @endisset
                    </div>
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
