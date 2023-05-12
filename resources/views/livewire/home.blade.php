<x-app-layout>
    <section class="mt-50 mb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="shop-product-fillter">
                        <div class="totall-product">
                            <p> We found <strong class="text-brand">{{$products->total()}}</strong> items for you!</p>
                        </div>
                        <div class="sort-by-product-area">
                            <div class="sort-by-cover mr-10">
                                <div class="sort-by-product-wrap">
                                    <div class="sort-by">
                                        <span><i class="fi-rs-apps"></i>Show:</span>
                                    </div>
                                    <div class="sort-by-dropdown-wrap">
                                        <span> {{$pageSize}} <i class="fi-rs-angle-small-down"></i></span>
                                    </div>
                                </div>
                                <div class="sort-by-dropdown">
                                    <ul>
                                        <li><a class="{{$pageSize == 10 ? 'active' : ''}}" wire:click.prevent="resizePage(10)">10</a></li>
                                        <li><a class="{{$pageSize == 15 ? 'active' : ''}}" wire:click.prevent="resizePage(15)">15</a></li>
                                        <li><a class="{{$pageSize == 25 ? 'active' : ''}}" wire:click.prevent="resizePage(25)">25</a></li>
                                        <li><a class="{{$pageSize == 35 ? 'active' : ''}}" wire:click.prevent="resizePage(35)">35</a></li>
                                        <li><a class="{{$pageSize == 0 ? 'active' : ''}}" wire:click.prevent="resizePage(0)">All</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="sort-by-cover">
                                <div class="sort-by-product-wrap">
                                    <div class="sort-by">
                                        <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                                    </div>
                                    <div class="sort-by-dropdown-wrap">
                                        <span> Featured <i class="fi-rs-angle-small-down"></i></span>
                                    </div>
                                </div>
                                <div class="sort-by-dropdown">
                                    <ul>
                                        <li><a class="active" href="#">Featured</a></li>
                                        <li><a href="#">Price: Low to High</a></li>
                                        <li><a href="#">Price: High to Low</a></li>
                                        <li><a href="#">Release Date</a></li>
                                        <li><a href="#">Avg. Rating</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row product-grid-3">
                        @foreach ($products as $p)
                            <div class="col-lg-4 col-md-4 col-6 col-sm-6">
                                <div class="product-cart-wrap mb-30 border-gray-300">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="{{ route('product.details', $p->id) }}">
                                                <img class="default-img" src="{{ json_decode($p->images)[0] }}"
                                                    alt="">
                                                <img class="hover-img" src="{{ json_decode($p->images)[1] }}"
                                                    alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category py-1">
                                            <a href="">{{ $p->category->name }}</a>
                                        </div>
                                        <h2><a href="{{route('product.details', $p->id)}}">{{ $p->name }}</a></h2>
                                        <div class="product-price">
                                            <span>${{ $p->price }}</span>
                                            <span class="old-price">${{ $p->old_price }}</span>
                                        </div>
                                        <div class="product-action-1 show">
                                            <form action="{{ route('cart.add') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $p->id }}">
                                                <a onclick="event.preventDefault();this.closest('form').submit();"
                                                    aria-label="Add To Cart" class="action-btn hover-up">
                                                    <i class="fi-rs-shopping-cart-add"></i>
                                                </a>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!--pagination-->
                    <div class="pagination-area mt-15 mb-sm-5 mb-lg-0">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-start">
                                <li class="page-item active"><a class="page-link" href="#">01</a></li>
                                <li class="page-item"><a class="page-link" href="#">02</a></li>
                                <li class="page-item"><a class="page-link" href="#">03</a></li>
                                <li class="page-item"><a class="page-link dot" href="#">...</a></li>
                                <li class="page-item"><a class="page-link" href="#">16</a></li>
                                <li class="page-item"><a class="page-link" href="#"><i
                                            class="fi-rs-angle-double-small-right"></i></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                @include('livewire.sidebar')
            </div>
        </div>
    </section>
</x-app-layout>
