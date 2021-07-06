
<div class="col-12 padding-0 shipping-options-list">
    <div class="row align-items-center">

        <h1 class="col-12 col-lg-1">Select</h1>

        <h1 class="col-12 col-lg-2">Type</h1>

        <h1 class="col-12 col-lg-4">Description</h1>

      @if($order->collection_code == null)
        <h1 class="col-12 col-lg-4">Estimated Time of arrival</h1>
      @else
        <h1 class="col-12 col-lg-4">Estimated Collection time</h1>
      @endif

        <h1 class="col-12 col-lg-1 pl-lg-0 pl-3">Price</h1>

    </div>
</div>
