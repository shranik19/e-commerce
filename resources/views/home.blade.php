@extends('layout')
@section('content')
    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all"style="background: rgb(196, 98, 6);">
                            <i class="fa fa-bars"></i>
                            <span>All departments</span>
                        </div>
                        <ul>
                            @foreach ($categories as $category)
                                <li>
                                    <a class="
                    {{ request()->getQueryString() == 'category=' . $category->slug ? 'text-primary' : '' }}"
                                        href="/products?category={{ $category->slug }}">{{ $category->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">

                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>9812345678</h5>
                                <span>support 24/7 time</span>
                            </div>
                        </div>
                    </div>
                    <div class="hero__item set-bg" data-setbg="img/hero/banner.jpg">

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">

                    @foreach ($sliderCategories as $category)
                        <div class="col-lg-3">
                            <div class="categories__item set-bg" data-setbg="{{ Storage::url($category->image_url) }}">
                                <h5><a
                                        href="/products?category={{ $category->slug }}">{{ $category->name }}>{{ $category->name }}</a>
                                </h5>
                            </div>
                        </div>
                    @endforeach



                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->
@endsection
