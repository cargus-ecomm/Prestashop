<div class="ship-and-go-map right w-100 mb-3">
    <div id="widget"></div>
</div>
<div class="alert alert-warning d-none location-alert mt-2 mr-2" role="alert"></div>
<div class="alert alert-danger d-none location-error mt-2 mr-2" role="alert">
    A aparut o problema la salvarea locatiei. Incercati din nou!
</div>

<button type="submit" class="btn btn-primary float-xs-right d-none continue-extra w-50 mb-2 m-auto" name="confirmDeliveryOption" value="1">
    Continue
</button>


{literal}
<script>
    var CARGUS_SHIP_GO_CARRIER_ID       = '{/literal}{$CARGUS_SHIP_GO_CARRIER_ID}{literal}';
    var UPDATE_SHIP_GO_LOCATION_LINK    = '{/literal}{$UPDATE_SHIP_GO_LOCATION_LINK}{literal}';
    var cargus_url                       = '{/literal}{$smarty.const.__PS_BASE_URI__}{literal}';
</script>
{/literal}
<script src="{$smarty.const.__PS_BASE_URI__}modules/cargus/assets/js/ship_and_go.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
