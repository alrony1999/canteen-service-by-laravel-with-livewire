<main id="main" class="main-site">

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="/" class="link">home</a></li>
                <li class="item-link"><span>detail</span></li>
            </ul>
        </div>
        @if (Session::has('success_message'))
            <div class="alert alert-success">
                <strong>Success </strong>{{ Session::get('success_message') }}
            </div>
        @endif
        <div class="row">

            <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 main-content-area">
                <div class="wrap-product-detail">
                    <div class="detail-media">
                        <div class="product-gallery" wire:ignore>
                            <ul class="slides">

                                <li data-thumb="{{ asset('assets/images/foods') }}/{{ $food->image }}">
                                    <img src="{{ asset('assets/images/foods') }}/{{ $food->image }}" />
                                </li>
                                @php
                                    $images = explode(',', $food->images);
                                @endphp
                                @foreach ($images as $image)
                                    @if ($image)
                                        <li data-thumb="{{ asset('assets/images/foods') }}/{{ $image }}">
                                            <img src="{{ asset('assets/images/foods') }}/{{ $image }}"
                                                alt="{{ $food->name }}" />
                                        </li>
                                    @endif
                                @endforeach


                            </ul>
                        </div>
                    </div>
                    <div class="detail-info">
                        <div class="product-rating">
                            <style>
                                .color-gray {
                                    color: #e6e6e6 !important;
                                }

                            </style>
                            @php
                                $avgrating = 0;
                            @endphp
                            @foreach ($food->orderItems->where('review_status', 1) as $orderItem)
                                @php
                                    $avgrating = $avgrating + $orderItem->review->rating;
                                @endphp
                            @endforeach
                            @php
                                if ($avgrating) {
                                    $avgrating = $avgrating / $food->orderItems->where('review_status', 1)->count();
                                }
                            @endphp
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $avgrating)
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                @else
                                    <i class="fa fa-star color-gray" aria-hidden="true"></i>
                                @endif
                            @endfor

                            <a href="#"
                                class="count-review">{{ $food->orderItems->where('review_status', 1)->count() }}</a>
                        </div>
                        <h2 class="product-name">{{ $food->name }}</h2>
                        <div class="short-desc">
                            {{ $food->short_description }}
                        </div>

                        <div class="wrap-price"><span class="product-price"><i
                                    class="fa fa-rmb"></i>{{ $food->regular_price }}</span>
                        </div>
                        <div class="stock-info in-stock">
                            <p class="availability">Availability: <b>
                                    Available

                                    {{-- {{ $food->stock_status }} --}}
                                </b></p>
                        </div>
                        <div class="quantity">
                            <span>Quantity:</span>
                            <div class="quantity-input">
                                <input type="text" name="product-quatity" value="1" data-max="120" pattern="[0-9]*">

                                <a class="btn btn-reduce" href="#"></a>
                                <a class="btn btn-increase" href="#"></a>
                            </div>
                        </div>
                        <div class="wrap-butons">
                            <a href="#" class="btn add-to-cart"
                                wire:click.prevent="store({{ $food->id }},'{{ $food->name }}',{{ $food->regular_price }})">Add
                                to Cart</a>

                        </div>
                    </div>
                    <div class="advance-info">
                        <div class="tab-control normal">
                            <a href="#description" class="tab-control-item active">description</a>
                            <a href="#review" class="tab-control-item">Reviews</a>
                        </div>
                        <div class="tab-contents">
                            <div class="tab-content-item active" id="description">
                                {{ $food->description }}
                            </div>

                            <div class="tab-content-item " id="review">
                                <div class="wrap-review-form">

                                    <style>
                                        .width-0-percent {
                                            width: 0%
                                        }

                                        .width-20-percent {
                                            width: 20%
                                        }

                                        .width-40-percent {
                                            width: 40%
                                        }

                                        .width-60-percent {
                                            width: 60%
                                        }

                                        .width-80-percent {
                                            width: 80%
                                        }

                                        .width-100-percent {
                                            width: 100%
                                        }

                                    </style>

                                    <div id="comments">
                                        <h2 class="woocommerce-Reviews-title">
                                            {{ $food->orderItems->where('review_status', 1)->count() }} review for
                                            <span>{{ $food->name }}</span>
                                        </h2>
                                        <ol class="commentlist">
                                            @foreach ($food->orderItems->where('review_status', 1) as $orderItem)
                                                <li class="comment byuser comment-author-admin bypostauthor even thread-even depth-1"
                                                    id="li-comment-20">
                                                    <div id="comment-20" class="comment_container">
                                                        @if ($orderItem->user->profile)
                                                            <img alt="{{ $orderItem->user->name }}"
                                                                src="{{ asset('assets/images/profile') }}/{{ $orderItem->user->profile->image }}"
                                                                height="80" width="80">
                                                        @endif
                                                        <div class="comment-text">
                                                            <div class="star-rating">
                                                                <span
                                                                    class="width-{{ $orderItem->review->rating * 20 }}-percent">Rated
                                                                    <strong
                                                                        class="rating">{{ $orderItem->review->rating }}</strong>
                                                                    out of
                                                                    5</span>
                                                            </div>
                                                            <p class="meta">
                                                                <strong
                                                                    class="woocommerce-review__author">{{ $orderItem->user->name }}</strong>
                                                                <span class="woocommerce-review__dash">–</span>
                                                                <time class="woocommerce-review__published-date"
                                                                    datetime="2008-02-14 20:00">{{ Carbon\Carbon::parse($orderItem->review->created_at)->format('d F Y g:i A') }}</time>
                                                            </p>
                                                            <div class="description">
                                                                <p>{{ $orderItem->review->comment }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ol>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end main products area-->

            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 sitebar">

                <div class="widget mercado-widget widget-product">
                    <h2 class="widget-title">Popular Foods</h2>
                    <div class="widget-content">
                        <ul class="products">

                            @foreach ($popular_foods as $p_food)
                                <li class="product-item">
                                    <div class="product product-widget-style">
                                        <div class="thumbnnail">
                                            <a href="{{ route('food.details', ['slug' => $p_food->slug]) }}"
                                                title="{{ $p_food->name }}">
                                                <figure><img
                                                        src="{{ asset('assets/images/foods') }}/{{ $p_food->image }}"
                                                        alt="{{ $p_food->name }}" height="300"></figure>
                                            </a>
                                        </div>
                                        <div class="product-info">
                                            <a href="#" class="product-name"><span>{{ $p_food->name }}</span></a>
                                            <div class="wrap-price"><span class="product-price"><i
                                                        class="fa fa-rmb"></i>{{ $p_food->regular_price }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>

            </div>
            <!--end sitebar-->

            <div class="single-advance-box col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="wrap-show-advance-info-box style-1 box-in-site">
                    <h3 class="title-box">Related Foods</h3>
                    <div class="wrap-products">

                        <div class="products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5"
                            data-loop="false" data-nav="true" data-dots="false"
                            data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"3"},"1200":{"items":"5"}}'>
                            @foreach ($related_foods as $r_food)
                                <div class="product product-style-2 equal-elem ">
                                    <div class="product-thumnail">
                                        <a href="{{ route('food.details', ['slug' => $r_food->slug]) }}"
                                            title="{{ $r_food->name }}">
                                            <figure><img
                                                    src="{{ asset('assets/images/foods') }}/{{ $r_food->image }}"
                                                    width="214" height="214" alt="{{ $r_food->name }}">
                                            </figure>
                                        </a>
                                        <div class="group-flash">
                                            <span class="flash-item new-label">new</span>
                                        </div>
                                        <div class="wrap-btn">
                                            <a href="#" class="function-link">quick view</a>
                                        </div>
                                    </div>
                                    <div class="product-info">
                                        <a href="#" class="product-name"><span>{{ $r_food->name }}</span></a>
                                        <div class="wrap-price"><span class="product-price"><i
                                                    class="fa fa-rmb"></i>{{ $r_food->regular_price }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach




                        </div>
                    </div>
                    <!--End wrap-products-->
                </div>
            </div>

        </div>
        <!--end row-->

    </div>
    <!--end container-->

</main>
