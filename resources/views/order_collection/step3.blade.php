@extends('templates.layouts.index')

@push( 'pageHeaderScripts' )
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDwbqZDZkfmonJqI3wao6QIlcwlmjJEtrE&callback=initMap"></script>
@endpush

@push( 'pageStyles' )
  <style id="delivery-collection-options">
    .no-submit {
      max-height: unset;
      padding: 0 1rem!important;
      max-width: 100% !important;
      width: 100%;
      text-align: left !important;
    }
    .address,
    .trading-hours {
      margin-bottom: 1.5rem !important;
    }
    address p, 
    .trading-hours p, 
    .trading-hours * p {
      margin-top: 0 !important;
      line-height: 1.25 !important;
    }
    input[type=submit] {
      background-color: green;
      color: white;
    }

    :focus, 
    :active, 
    :hover {
      box-shadow: none !important;
      outline: none !important;
    }
    .shipping-options-list-options input[type="radio"] + label {
      color: #9a9a9a;
    }
    details[open] summary,
    details[open] summary details[open] summary {
      color: #b7b7b7;
    }
    details:not([open]) summary, 
    details:not([open]) summary details:not([open]) summary, 
    details[open] summary details:not([open]) summary {
      color: #1f1f1f;
    }
    details summary, 
    details p {
      margin: 0.5rem 0;
      color: #262626;
      font-style: normal;
      font-weight: 300;
      font-size: 13px !important;
      line-height: inherit;
    }
    .shipping-options-list-options .local-collection-points > [class*=col] {
      padding-left: 0 !important;
    }
    .shipping-options-list-options [class*=col] {
      font-weight: 300;
      font-size: 13px;
      color: #262626;
    }
    address.order-summary {
      white-space: normal;
    }
    .regional-collection-points .local-collection-points {
      border-bottom: 1px solid #f0f0f0;
    }
    .regional-collection-points summary {
      margin-bottom: 1rem;
      padding: 0.618rem 0;
      font-weight: 400;
      margin-top: 0;
      color: #1f1f1f;
      font-size: 14px;
      font-weight: 600;
      text-transform: uppercase;
    }
    .shipping-options-list-options [class*=col]{
      font-weight: 300;
      font-size: 13px;
      color: #262626;
    }
    .decollect-maps {
      width: 100%;
      max-height: 320px;
    }
    @media only screen and (max-width: 992px) {
      .decollect-maps {
        max-height: 250px;
      }
      .arrow {
        z-index: 9 !important;
      }
      .arrow div:after {
        left: 37.5% !important;
      }
      .shipping-options-list-options .col-lg-1:first-of-type {
        position: absolute;
        top: 0;
        left: -30px;
        z-index: 10;
      }
      .shipping-options-list-options .col-lg-1 {
        position: relative !important;
        top: unset !important;
        left: unset !important;
        z-index: 10;
      }
    }
  </style>
@endpush

@php 
  $canContinue = !1;
  if ( in_array( env('APP_ENV'), ['local', 'development'] ) ) {
    session()->put( 'basket.id', 274 );
  } 
@endphp

@section('content')

<div class="container mt-3">
    <div class="row">
        <div class="col-12 col-lg-9 custom-checkout-padding">
            <div class="row">                
                <div class="col-12 padding-0 text-center-sm px-4 px-lg-3">
                    @include( 'order_collection::step3_page_navigation' )

                    <div class="col-12 padding-0 text-center-sm px-4 px-lg-3 shipping-options-block">
                        <div class="row">
                            @include( 'order_collection::options_header' )
                            <form class="col-12 no-submit">
                                <div class="row align-items-center">
                                    <div class="col-12 padding-0 shipping-options-list-options">
                                        @if($order->collection_code == null)
                                        {{-- DELIVERY/COURIER OPTS::: --}}
                                          @include( 'order_collection::components.shipping_courier.options' )
                                        {{-- DELIVERY/COURIER OPTS::: --}}
                                        @elseif($order->collection_code != null)
                                        {{-- COLLECTION POINTS::: --}}
                                          @include( 'order_collection::components.collection.options' )
                                        {{-- COLLECTION POINTS::: --}}
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @include( 'order_collection::components.product_assembly.options' )
                </div>
          </div>
          @include( 'order_collection::order_summary' )
    </div>
</div>

@push( 'pageScripts' )
  <script type="text/javascript" id="realtime-summary-updating">
    // var inputElems  = document.querySelectorAll("input[data-address]");
    var inputElems  = document.querySelectorAll('[id*=option]');
    var summaryAddr = document.querySelector('address.order-summary');
    var inputSubmit = document.querySelector('input[type*=submit][disabled]')

    window.document.addEventListener('DOMContentLoaded', function()
    {
      try {
        inputElems.forEach( elem => inputListeners( elem ) );
      } catch( err ) { console.warn( "\n" + err + "\n" ); }

      return;
    });

    function inputListeners( elem )
    {
      elem.addEventListener( 'change', function( evt )
      {
        var detailPrnt, tempElemSel, detailElm;
        var address, splitAddr, summaryAddress, pElem, paraAddress;

        if ( this.dataset.collection_code && typeof this.dataset.collection_code  != undefined ) {
          try {
            detailPrnt  = this.parentNode.closest( '.row' );
            tempElemSel = detailPrnt.lastElementChild;
            detailElm   = tempElemSel.querySelector( 'details' );

            if ( typeof detailElm == undefined || detailElm == null ) {
              if( ! detailElm.hasAttribute( 'open' ) ) { detailElm.setAttribute( 'open', '' ); }
              delete( detailElm, detailPrnt, tempElemSel );
            }
          } catch( err ) { console.warn( "\n" + err + "\n" ); }

          try {
            address        = this.dataset.address;
            splitAddr      = address.split( ", " );
            summaryAddress = splitAddr.join( ', \r\n' );
          } catch( err ) { console.warn( "\n" + err + "\n" ); }

          try {
              pElem = document.createElement( 'p' );
              pElem.innerText = decodeURIComponent( summaryAddress );
              paraAddress = document.createElement( 'address' );
              paraAddress.appendChild( pElem );
          } catch( err ) { console.warn( "\n" + err + "\n" ); }

          if ( summaryAddr.children.length > 0 ) {
            try {
              summaryAddr.replaceChild( paraAddress, summaryAddr.firstElementChild  );
            } catch( err ) { console.error( "\n" + err + "\n" ); }

          } else {
            summaryAddr.appendChild( paraAddress );
          }
        }

        try {
          inputSubmit.removeAttribute('disabled');
        } catch( err ) { console.log( "\r\n" + err + "\r\n" ); }

        return;

      }, false );
    }
  </script>

  <script id="html5-details-accordion-emulate">
    if ( window.document.addEventListener ) {
      window.document.addEventListener( 
        'DOMContentLoaded', 
        accordion_one_open, 
        false 
      );
    } else {
      window.document.attachEvent( 
        'onload', 
        accordion_one_open
      );
    }

    function accordion_one_open()
    {
      let details = document.querySelectorAll( 'details:not(.mt-lg-2)' );

      details.forEach( d => { 
        d.addEventListener( 'click', function( evt ) { 

          evt.stopPropagation();
          parent_close( details, evt );

        }, false )
      });
    }

    function parent_close( el, ev=null )
    {
      var details, ncnt, i, ctgt;

      i = 0;
      ctgt = 'regional-collection-points';
      details = el;
      evt = ev.srcElement;
      ncnt = details.length - 1;

      try {
        for( i; i <= ncnt; i++ ) {

          if (evt.parentNode != details[i] && (evt.classList.length <= 0 && ! details[i].parentNode.classList.contains(ctgt))) {
            continue;
          }

          details[i].removeAttribute( 'open' );
        }

      } catch( error ) { console.warn( "\n" + error + "\n" ) }

      return;
    }
    </script>

    <script id="accordion-animation">
    class Accordion
    {

      constructor(el)
      {
        this.el = el;
        this.summary = el.querySelector('summary');
        this.content = el.querySelector('.content');
        this.animation = null;
        this.isClosing = false;
        this.isExpanding = false;
        this.summary.addEventListener('click', (e) => this.onClick(e));
      }

      // Function called when user clicks on the summary
      onClick(e)
      {
        e.preventDefault();
        this.el.style.overflow = 'hidden';

        if (this.isClosing || !this.el.open) {
          this.open();

        } else if (this.isExpanding || this.el.open) {
          this.shrink();
        }
      }

      // Function called to close the content with an animation
      shrink()
      {
        this.isClosing = true;
        const startHeight = `${this.el.offsetHeight}px`;
        const endHeight = `${this.summary.offsetHeight}px`;

        if (this.animation) {
          this.animation.cancel();
        }

        this.animation = this.el.animate({
          height: [startHeight, endHeight]
        }, {
          duration: 400,
          easing: 'ease-out'
        });

        this.animation.onfinish = () => this.onAnimationFinish(false);
        this.animation.oncancel = () => this.isClosing = false;
      }

      // Function called to open the element after click
      open()
      {
        this.el.style.height = `${this.el.offsetHeight}px`;
        this.el.open = true;

        window.requestAnimationFrame(() => this.expand());
      }

      // Function called to expand the content with an animation
      expand()
      {
        this.isExpanding = true;
        const startHeight = `${this.el.offsetHeight}px`;
        const endHeight = `${this.summary.offsetHeight + this.content.offsetHeight}px`;

        if (this.animation) {
          this.animation.cancel();
        }

        this.animation = this.el.animate({
          height: [startHeight, endHeight]
        }, {
          duration: 400,
          easing: 'ease-out'
        });

        this.animation.onfinish = () => this.onAnimationFinish(true);
        this.animation.oncancel = () => this.isExpanding = false;
      }

      // Callback when the shrink or expand animations are done
      onAnimationFinish(open)
      {
        this.el.open = open;
        this.animation = null;
        this.isClosing = false;
        this.isExpanding = false;
        this.el.style.height = this.el.style.overflow = '';
      }
    }

    try {
      document.querySelectorAll( 'details details' )
              .forEach(( el ) => { new Accordion( el ) });

    } catch( error ) { console.warn( "\n" + error + "\n" ); }
  </script>

  @php
    $colOpts = ( new \App\Models\CollectionPoint )
      ->where('status', 'PUBLISHED')->orWhere('status', 'SCHEDULED')
      ->where('status_date', '>=', now())
    ->get();
  @endphp

  @if( NULL != $colOpts && count( $colOpts ) > 0 )
    {{-- // Initialize and add the map --}}
    <script id="store-gmaps">
      function initMap()
      {
        @forelse( $colOpts as $key=>$store )
          @if( NULL != $store->latitude && NULL != $store->longitude )

            var uluru = {
              lat: {{ $store->latitude }}, 
              lng: {{ $store->longitude }}
            };

            var map = new google.maps.Map(
              document.getElementById( 'map_{{ $store->id }}' ), 
              {
                zoom: 16, 
                center: uluru 
              }
            );

            var marker = new google.maps.Marker({
              position: uluru, 
              map: map
            });

          @endif
        @empty
        @endforelse
      }
    </script>
  @endif
@endpush

{{-- @include( 'includes.pages.tab_open_check' ) --}}

@endsection
