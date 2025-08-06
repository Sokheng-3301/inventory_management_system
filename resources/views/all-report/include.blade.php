<div class="col-md-12 grid-margin">
    <div class="row">
        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
            <h3 class="font-weight-bold">{{ __('nav.reportInYear') }} </h3>
            <h6 class="font-weight-normal mb-0">{{ __('nav.allReport') }}</h6>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12">
                        @include('layout.back-button')
        </div>
        <div class="col-md-3 mb-4 stretch-card transparent">
            <a href="{{ route('inventory.list') }}" class="w-100 d-block">
                <div class="card border">
                    <div class="card-body">
                        <p class="mb-4">{{ __('nav.inventory_list') }}</p>
                        <p class="fs-30 mb-2">
                            {{ $count_item }}
                        </p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 mb-4 stretch-card transparent">
            <a href="{{ route('expenses.index') }}" class="w-100 d-block">
                <div class="card border">
                    <div class="card-body">
                        <p class="mb-4">{{ __('nav.expenseReport') }}</p>
                        <p class="fs-30 mb-2">
                            $ {{ $expense }}
                        </p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 mb-4 stretch-card transparent">
            <a href="{{ route('givens.index') }}" class="w-100 d-block">
                <div class="card border">
                    <div class="card-body">
                        <p class="mb-4">{{ __('nav.itemhasGiven') }}</p>
                        <p class="fs-30 mb-2">
                            {{ $given_item }}
                        </p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 mb-4 stretch-card transparent">
            <a href="{{ route('returneds.index') }}" class="w-100 d-block">
                <div class="card border">
                    <div class="card-body">
                        <p class="mb-4">{{ __('nav.itemReturned') }}</p>
                        <p class="fs-30 mb-2">
                            {{ $returned_item }}
                        </p>
                    </div>
                </div>
            </a>
        </div>

    </div>
</div>
