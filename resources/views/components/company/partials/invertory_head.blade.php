  <div class="ic-stage-wrapper">
      <div
          class="ic-stage {{ Request::routeIs('company.product.index') || Request::routeIs('company.product.create') || Request::routeIs('company.product.csv.create') || Request::routeIs('company.product.edit') ? 'active' : '' }}">
          <a href="{{ route('company.product.index') }}">Products</a>
      </div>
      <div
          class="ic-stage {{ Request::routeIs('company.delivery.index') || Request::routeIs('company.delivery.create') || Request::routeIs('company.delivery.edit') ? 'active' : '' }}">
          <a href="{{ route('company.delivery.index') }}">Deliveries</a>
      </div>
      <div
          class="ic-stage {{ Request::routeIs('company.packaging.index') || Request::routeIs('company.packaging.create') || Request::routeIs('company.packaging.edit') ? 'active' : '' }}">
          <a href="{{ route('company.packaging.index') }}">Packaging Material</a>
      </div>

  </div>
