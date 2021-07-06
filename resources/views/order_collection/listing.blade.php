@extends( 'layouts.fortuna' )

@push( 'pageStyles' )
<style>
  .aboutWrap .articleBlock .info p,
  .aboutWrap .storyArticle .info p {
    font-size: 1rem;
    line-height: 1.875rem;
  }
  .pageNav .links a {
    color: #ffffff;
    font-size: 1.0625rem;
    margin-left: 50px;
  }
  .investorsContain table {
    font-family: 'fs_lucaslight' !important;
  }
  .accordionWrap table.table th {
    text-transform: inherit;
  }
  .extraInfo p:first-of-type {
    margin-bottom: 0 !important;
  }
  img.col-12.col-sm-5.image.float-left.img-fluid.mr-lg-5.mr-3 {
    padding-bottom: 70px;
  }
  .extraInfo {
    margin-top: -44px;
  }
  @media only screen and (max-width: 576px) {
    .accordionWrap .table th {
      background: #000000;
      font-size: 0.875rem;
      font-family: 'fs_lucasbold';
      padding-left: 20px;
    }
    .table {
      width: 100%;
      max-width: 100%;
      margin-bottom: 1rem;
      background-color: transparent;
    }
    .accordionWrap .table td {
      padding-left: 20px;
      padding-right: 90px;
      font-size: 14px;
    }
    .pageNavMobile .shape {
      height: 10px;
      background: #000000;
    }
    .pageNav .links a {
      color: #ffffff;
      font-size: 0.875rem;
      margin-left: 50px;
    }
  }
  @media only screen and (max-width: 400px) {
    .accordionWrap .table td {
      padding-left: 20px;
      padding-right: 15px;
      font-size: 14px;
    }
    .extraInfoBlock p {
      font-size: 0.875rem;
      font-family: 'fs_lucaslight';
      line-height: 1.875rem;
    }
    .introArticle .introduction.content {
      font-weight: 300;
      line-height: 1.875rem;
    }
    .investorsContain tbody td,
    .investorsContain thead th {
      padding-left: 13px;
    }
    .mr-3,
    .mx-3 {
      margin-right: 1rem !important;
    }
    .col-12.descr {
      padding-left: 0px;
      padding-right: 0;
    }
    .extraInfo p:first-of-type {
      margin-bottom: 0 !important;
      padding-right: 0px;
      padding-left: 0;
    }
    .offset-1 {
      margin-left: 0;
    }
    .extraInfo p {
      padding: 0px;
      padding-bottom: 10px;
    }
  }
</style>
@endpush

@section( 'content' )
  <div class="container-fluid pageNav pageTopFix d-none d-sm-block">
    <div class="row">
      <div class="col-12 col-md-8 text-lg-right links">
        <a title="Performance Targets" class="d-inline"
          href="/investments/performance-targets">Philosophy</a>
        <a title="NAV Evolution" class="d-inline" href="/investments/nav-evolution">Business
          model</a>
        <a title="Governance" class="d-inline" href="/investments/portfolio">Portfolio</a>
      </div>
      @isset( $page->title )
      <div class="col-12 col-md title">
        <h1>{{ ucfirst( $page->title ) }}</h1>
      </div>
      @endisset
    </div>
  </div>

  <div class="container-fluid pageNavMobile d-block d-sm-none">
    <div class="row">
      <div class="col col-lg-7 shape"></div>
      @isset( $portfolio->title )
      <div class="col-auto col-lg-5 title">
        <h1>{{ $portfolio->title }}</h1>
      </div>
      @endisset
    </div>
  </div>

  <div class="container contentWrap investorsContain mobileCustomPadding investor">
    <div class="container-fluid">
      <div class="row">

        <div class="col-12 extraInfo">
          @isset( $page->description )
          <div class="col-11 offset-1 py-lg-5 py-4">
            {!! $page->description !!}
          </div>
          @endisset

          @isset( $portfolio->description )
          <div class="info pt-lg-5 pt-3">
            @isset( $portfolio->portfolio_specific_image )
              <img class="col-12 col-sm-5 image float-left img-fluid mr-lg-5 mr-3" src="resources/img/article-imag-computer-mania.jpg" alt="Computermania">
            @else
              <img class="col-12 col-sm-5 image float-left img-fluid mr-lg-5 mr-3" src="/{{ ltrim( $site_settings->logo ) }}" alt="{{ $site_settings->site_name }}">
            @endisset

            @isset( $portfolio->title )
            <h1>Computer Mania</h1>
            @endisset

            @isset( $portfolio->description )
            <div class="col-12 descr">
              {!! $portfolio->description !!}
            </div>
            @endisset
          </div>
          @endisset

          <div class="table-responsive">
            <table class="table mt-lg-5 mt-3">
              <thead>
                <tr>
                  <th colspan="2">Retail</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Effective Equity Interest:</td>
                  <td>15%</td>
                </tr>
                <tr>
                  <td>Status:</td>
                  <td>Delisted</td>
                </tr>
                <tr>
                  <td>Leadership:</td>
                  <td>Stephen van der Watt (Executive Chairman) Jandre de Milander (CEO) Ed van
                    Niekerk (CEO)</td>
                </tr>
                <tr>
                  <td>FIH Directors:</td>
                  <td>Christo Claassen</td>
                </tr>
                <tr>
                  <td>Date of 1st investment:</td>
                  <td>May 2021</td>
                </tr>
                <tr>
                  <td>Geographics:</td>
                  <td>South Africa</td>
                </tr>
                <tr>
                  <td>Social Media links:</td>
                  <td>LinkedIn Twitter Facebook Instagram</td>
                </tr>
                <tr>
                  <td>No of Employees:</td>
                  <td>150</td>
                </tr>
                <tr>
                  <td>Website:</td>
                  <td><a href="www.computermania.co.za">www.computermania.co.za</a></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

{{-- @push( 'pageScripts' )
<script>
  var a = [].slice.call(document.querySelectorAll('.tableContain table'));
    try {
      a.map((t) => {
        t.classList.add('table')
      });
    } catch (err) {
      /**/
    }
</script>
<script>
  if (document.addEventListener || typeof document.addEventListener !== "undefined") {
      document.addEventListener("DOMContentLoaded", (evt) => {
        run_fix();
      });
    } else if (document.attachEvent || typeof document.attachEvent !== "undefined") {
      document.attachEvent("onreadystatechange", (evt) => {
        if (document.readyState === "complete") {
          run_fix()
        }
      });
    }

    function run_fix() {
      var el, pn;
      try {
        el = fix_this_table('.investorsContain table', ['col-12', 'table'])
        pn = el.parentNode;
        do {
          pn = pn.parentNode;
        } while (!pn.classList.contains('investor'));
        try {
          pn.classList.remove('extraInfoBlock')
          console.log(pn.classList);
        } catch (err) {
          /*console.warn( "\r\n\t" + err + "\r\n" )*/
        }
      } catch (err) {
        /*console.warn( "\r\n\t" + err + "\r\n" )*/
      }
    }

    function fix_this_table(sel, aca) {
      var a, err;
      a = document.querySelector(sel);
      try {
        aca.map((c) => {
          a.classList.add(c)
        })
      } catch (err) {
        /* console.log( "\r\n\t" + err + "\r\n" ); */
      }
      return a;
    }
</script>
@endpush --}}

@endsection
